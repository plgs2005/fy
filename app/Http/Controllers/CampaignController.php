<?php

/**
 * Description
 *
 * @category Category
 * @package  Package
 * @author   Author <author@email.com>
 * @license  license http://license
 * @link     link
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

use App\Influencer\Campaign\Campaign;
use App\Influencer\Audience\Audience;

use App\Events\NewCampaign;
use App\Influencer\Category\Category;
use App\Infrastructure\API\Stripe\StripeApi;
use App\Influencer\User\User;
use App\Influencer\Post\Post;
use App\Infrastructure\API\ClickMeter\ClickMeterApi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Carbon\Carbon;

use Illuminate\Http\JsonResponse;

use Jenssegers\Agent\Agent;
use App\Notification;
use Carbon\CarbonImmutable;
use DateTimeZone;

/*
    TODO:
     - Aqui é apenas um exemplo de um Controller vinculado a um Model
     - Não sei se será usado dessa forma, provavelmente não
     - O mais provável é que toda a interação da Campaign esteja dentro do módulo Campaign
*/

/**
 * Campaign controller class
 */
class CampaignController extends Controller
{
    /**
     *  Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new campaign.
     *
     * @param \Illuminate\Http\Request $request Laravel request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id = null)
    {
        $user = $request->user();
        date_default_timezone_set($user->time_zone);



        if ($user->stripeCustomer()) {
        } else {
            dd('An error accured');
        }

        $campaign = 1;
        if (!is_null($id)) {
            $campaign = $user->brandCampaigns->where('id', $id)->first();
            unset($campaign->id);
            $campaign->name = $campaign->name . ' Copy';
            unset($campaign->datetime);
        }

        $partial_campaigns = $user->brandCampaigns->where('partial', 1);
        if ($partial_campaigns->count() > 1) {
            dd('error');
        }

        if ($partial_campaigns->count() == 1) {
            $partial_campaign = $partial_campaigns->first();
            return redirect('campaign-edit/' . $partial_campaign->id);
        }

        $audiences = $user->brandAudiences;

        $category = new Category;
        $categories = $category->getAllCategories();

        return view('app/campaign/create', ['user' => $user, 'audiences' => $audiences, 'categories' => $categories, 'campaign' => $campaign, 'audience' => null]);
    }

    /**
     * Store a new campaign in storage.
     *
     * @param \Illuminate\Http\Request $request  Laravel request
     * @param \App\Campaign            $campaign Campaign model
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Campaign $campaign)
    {

        $input = $request->all();
        $user = $request->user();
        /*  dd($request->all()); */


        //   dd(Carbon::now($user->time_zone)->toRfc2822String(), getdate());



        if (stripos($input['budget_overrun'], '$') !== false) {
            $input['budget_overrun'] = substr($input['budget_overrun'], 2);
        }

        $v = Validator::make(
            $input,
            [
                'id' => 'nullable|integer',
                'campaign_name' => 'required|string',
                'type' => ['required', 'string', Rule::in(['paid', 'trade'])],
                'goal' => ['required', 'string', Rule::in(['awareness', 'clicks', 'purchase', 'registrations'])],

                'audience_create' => 'required', 'boolean',
                'audience_id' => 'exclude_if:audience_create,true|required|integer',
                'audience_name' => 'exclude_if:audience_create,false|required|string',
                'category_id' => 'exclude_if:audience_create,false|required|integer',
                'audience_age' => 'exclude_if:audience_create,false|required|string',
                'influencer_size' => ['exclude_if:audience_create,false|required|string', Rule::in([null, 'micro', 'medium'])],
                'audience_gender' => ['exclude_if:audience_create,false|required|string', Rule::in(['f', 'm'])],
                'audience_location' => ['exclude_if:audience_create,false|required|string', Rule::in(['United States'])],
                'audience_language' => ['exclude_if:audience_create,false|required|string', Rule::in(['English'])],

                'format' => ['required', 'string', Rule::in(['video', 'photo'])],
                'style' => ['required', 'string', Rule::in(['fun', 'sexy', 'informative', 'review'])],
                'goal_description' => 'required|string|max:255',
                'goal_images' => 'nullable|max:5',
                'goal_images.*' => 'mimes:jpeg,bmp,png|max:10240',
                'physical' => ['nullable', Rule::in(['on'])],
                'digital' => ['nullable', Rule::in(['on'])],
                'service' => ['nullable', Rule::in(['on'])],
                'product_images' => 'nullable|max:5',
                'product_images.*' => 'mimes:jpeg,bmp,png|max:10240',
                'url' => 'nullable|url',
                'instructions' => 'nullable|string|max:255',
                'instruction_images' => 'nullable|max:5',
                'instruction_images.*' => 'mimes:jpeg,bmp,png|max:10240',
                'budget_overrun' => 'nullable|integer',
                'date_budget' => 'required', 'date_format:j M, Y',
                'time_budget' => 'required', 'date_format:g:i:s A',
            ]
        );
        $v->sometimes(
            'product_description',
            'required|string|max:255',
            function ($input) {
                if (isset($input['digital']) or isset($input['physical']) or isset($input['service'])) {
                    return true;
                }
            }
        );
        $v->sometimes(
            ['social_platform_instagram'],
            ['required', Rule::in(['true', 'false'])],
            function ($input) {
                if (!isset($input['social_platform_facebook'])) {
                    return true;
                }
            }
        );
        $v->sometimes(
            ['social_platform_facebook'],
            ['required', Rule::in(['true', 'false'])],
            function ($input) {
                if (!isset($input['social_platform_instagram'])) {
                    return true;
                }
            }
        );
        $v->sometimes(
            ['format_type_feed'],
            ['required', Rule::in(['true', 'false'])],
            function ($input) {
                if (!isset($input['format_type_story'])) {
                    return true;
                }
            }
        );
        $v->sometimes(
            ['format_type_story'],
            ['required', Rule::in(['true', 'false'])],
            function ($input) {
                if (!isset($input['format_type_feed'])) {
                    return true;
                }
            }
        );

        $validated = $v->validate();



        //valida se data hora escolhida para campanha é daqui pelo menos 72H.
        $campaign_datetime = Carbon::parse(str_replace(',', '', $validated['date_budget']) . ' ' . $validated['time_budget']);
        $datetime_min = Carbon::now($user->time_zone);
        $datetime_min->addDays(3)->second(0);
        $datetime_min = Carbon::parse($datetime_min)->format('Y-m-d H:m:s');


        if ($campaign_datetime->isBefore($datetime_min)) {

            return back()->withErrors('Selected date and time for campaign is less than 72H from now')->withInput();
        }


        $user = $request->user();

        if (isset($validated['id']) and !$user->brandCampaigns()->where('id', $validated['id'])->first()) {
            // dd('This campaign id does not belong to you or doesent exist');
            return redirect()->back();
        }

        $temp = $validated['date_budget'] . ' ' . $validated['time_budget'];



        $datetime = Carbon::createFromFormat('j M, Y g:i A', $temp)->toDateTimeString();

        if (!isset($validated['physical'])) {
            $validated['physical'] = 'off';
        }
        if (!isset($validated['digital'])) {
            $validated['digital'] = 'off';
        }
        if (!isset($validated['service'])) {
            $validated['service'] = 'off';
        }

        $physical_product = null;
        $digital_product = null;
        $service = null;
        if ($validated['physical'] == 'on' and $validated['digital'] == 'on' and $validated['service'] == 'on') {
            $physical_product = true;
            $digital_product = true;
            $service = true;
        } elseif ($validated['physical'] == 'on' and $validated['digital'] == 'on') {
            $physical_product = true;
            $digital_product = true;
            $service = null;
        } elseif ($validated['physical'] == 'on' and $validated['service'] == 'on') {
            $physical_product = true;
            $digital_product = null;
            $service = true;
        } elseif ($validated['digital'] == 'on' and $validated['service'] == 'on') {
            $physical_product = null;
            $digital_product = true;
            $service = true;
        } elseif ($validated['physical'] == 'on') {
            $physical_product = true;
            $digital_product = null;
            $service = null;
        } elseif ($validated['digital'] == 'on') {
            $physical_product = null;
            $digital_product = true;
            $service = null;
        } elseif ($validated['service'] == 'on') {
            $physical_product = null;
            $digital_product = null;
            $service = true;
        }

        if (isset($validated['id'])) {
            $campaign = $user->brandCampaigns->where('id', $validated['id'])->first();
        } else {
            $campaign = new Campaign;
        }

        $campaign->brand_id = $user->id;
        $campaign->name = $validated['campaign_name'];
        $campaign->type = $validated['type'];
        $campaign->goal = $validated['goal'];
        $campaign->social_platform_instagram = isset($validated['social_platform_instagram']) ? true : false;
        $campaign->social_platform_facebook = isset($validated['social_platform_facebook']) ? true : false;
        $campaign->format = $validated['format'];
        $campaign->format_type_feed = isset($validated['format_type_feed']) ? true : false;
        $campaign->format_type_story = isset($validated['format_type_story']) ? true : false;
        $campaign->style = $validated['style'];
        $campaign->goal_description = $validated['goal_description'];

        $campaign->physical_product = $physical_product;
        $campaign->digital_product = $digital_product;
        $campaign->service = $service;
        if (isset($validated['product_description'])) {
            $campaign->product_description = $validated['product_description'];
        }

        $campaign->url = $validated['url'];
        $campaign->instructions = $validated['instructions'];
        $campaign->budget = $validated['budget_overrun'] . '00';
        $campaign->datetime = $datetime;

        if ($validated['audience_create'] == "true") {
            $audienceData['brand_id'] = $user->id;
            $audienceData['audience_name'] = $validated['audience_name'];
            $audienceData['category_id'] = $validated['category_id'];
            $audienceData['audience_age'] = $validated['audience_age'];
            $audienceData['influencer_size'] = $validated['influencer_size'];
            $audienceData['audience_gender'] = $validated['audience_gender'];
            $audienceData['audience_location'] = '["US"]';
            $audienceData['audience_language'] = '["eng"]';

            $audience = new Audience;
            $audience = $audience->create($audienceData);

            $campaign->audience_id = $audience->id;
        } else {
            $campaign->audience_id = $validated['audience_id'];
        }
        //salva se não houver imagens
        $campaign->save();

        if (isset($validated['goal_images']) or isset($validated['product_images']) or isset($validated['instruction_images'])) {
            if (isset($validated['goal_images'])) {
                foreach ($validated['goal_images'] as $key => $img) {
                    if ($img->isValid()) {
                        $path[] = $img->storeAs('campaign/' . $campaign->id, 'goal_image_' . $key . '.' . $img->extension(), 'public');
                    }
                }
                $path = json_encode($path);
                $campaign->goal_images = $path;
            }
            unset($path);
            if (isset($validated['product_images'])) {
                foreach ($validated['product_images'] as $key => $img) {
                    if ($img->isValid()) {
                        $path[] = $img->storeAs('campaign/' . $campaign->id, 'product_image_' . $key . '.' . $img->extension(), 'public');
                    }
                }
                $path = json_encode($path);
                $campaign->product_images = $path;
            }
            unset($path);
            if (isset($validated['instruction_images'])) {
                foreach ($validated['instruction_images'] as $key => $img) {
                    if ($img->isValid()) {
                        $path[] = $img->storeAs('campaign/' . $campaign->id, 'instruction_image_' . $key . '.' . $img->extension(), 'public');
                    }
                }
                $path = json_encode($path);
                $campaign->instruction_images = $path;
            }
            //salva se houver imagens
            $campaign->save();
        }

        return redirect()->route('brand.campaign.review', ['id' => $campaign->id]);
    }

    /**
     * Store a new campaign partially in storage.
     * Used when a brand is creating a campaign but decides to close it before filling all the fields and select's to save the progress
     *
     * @param \Illuminate\Http\Request $request  Laravel request
     *
     * @return \Illuminate\Http\Response
     */
    public function storePartial(Request $request)
    {
        $input = $request->all();

        if (stripos($input['budget_overrun'], '$') !== false) {
            $input['budget_overrun'] = substr($input['budget_overrun'], 2);
        }

        $v = Validator::make(
            $input,
            [
                'id' => 'nullable|integer',
                'campaign_name' => 'nullable|string',
                'type' => ['nullable', 'string', Rule::in(['paid', 'trade'])],
                'goal' => ['nullable', 'string', Rule::in(['awareness', 'clicks', 'purchase', 'registrations'])],

                'audience_create' => 'nullable', 'boolean',
                'audience_id' => 'nullable|integer',
                'audience_name' => 'nullable|string',
                'category_id' => 'nullable|integer',
                'audience_age' => 'nullable|string',
                'influencer_size' => ['nullable', 'string', Rule::in(['micro', 'medium'])],
                'audience_gender' => ['nullable', 'string', Rule::in(['f', 'm'])],
                'audience_location' => ['nullable', 'string', Rule::in(['United States'])],
                'audience_language' => ['nullable', 'string', Rule::in(['English'])],
                'social_platform_instagram' => 'nullable', Rule::in(['true', 'false']),
                'social_platform_facebook' => 'nullable', Rule::in(['true', 'false']),

                'format' => ['nullable', 'string', Rule::in(['video', 'photo'])],
                'format_type_feed' => 'nullable', Rule::in(['true', 'false']),
                'format_type_story' => 'nullable', Rule::in(['true', 'false']),
                'style' => ['nullable', 'string', Rule::in(['fun', 'sexy', 'informative', 'review'])],
                'goal_description' => 'nullable|string|max:255',
                // 'goal_images' => 'nullable',
                // 'goal_images.*' =>'mimes:jpeg,bmp,png',
                'physical' => ['nullable', Rule::in(['on'])],
                'digital' => ['nullable', Rule::in(['on'])],
                'service' => ['nullable', Rule::in(['on'])],
                'product_description' => 'nullable|string|max:255',
                // 'product_images' => 'nullable',
                // 'product_images.*' => 'mimes:jpeg,bmp,png',
                'url' => 'nullable|url',
                'instructions' => 'nullable|string|max:255',
                // 'instruction_images' => 'nullable',
                // 'instruction_images.*' =>'mimes:jpeg,bmp,png',
                'budget_overrun' => 'nullable|integer',
                // 'date_budget' => 'nullable','date_format:j M, Y',
                // 'time_budget' => 'nullable','date_format:g:i A',

            ]
        );

        $validated = $v->validate();
        $user = $request->user();


        if (isset($validated['id']) and !$user->brandCampaigns()->where('id', $validated['id'])->first()) {
            // dd('This campaign id does not belong to you or doesent exist');
            return redirect()->back();
        }


        if (!isset($validated['physical'])) {
            $validated['physical'] = 'off';
        }
        if (!isset($validated['digital'])) {
            $validated['digital'] = 'off';
        }
        if (!isset($validated['service'])) {
            $validated['service'] = 'off';
        }

        $physical_product = null;
        $digital_product = null;
        $service = null;
        if ($validated['physical'] == 'on' and $validated['digital'] == 'on' and $validated['service'] == 'on') {
            $physical_product = true;
            $digital_product = true;
            $service = true;
        } elseif ($validated['physical'] == 'on' and $validated['digital'] == 'on') {
            $physical_product = true;
            $digital_product = true;
            $service = null;
        } elseif ($validated['physical'] == 'on' and $validated['service'] == 'on') {
            $physical_product = true;
            $digital_product = null;
            $service = true;
        } elseif ($validated['digital'] == 'on' and $validated['service'] == 'on') {
            $physical_product = null;
            $digital_product = true;
            $service = true;
        } elseif ($validated['physical'] == 'on') {
            $physical_product = true;
            $digital_product = null;
            $service = null;
        } elseif ($validated['digital'] == 'on') {
            $physical_product = null;
            $digital_product = true;
            $service = null;
        } elseif ($validated['service'] == 'on') {
            $physical_product = null;
            $digital_product = null;
            $service = true;
        }

        if (isset($validated['id'])) {
            $campaign = $user->brandCampaigns->where('id', $validated['id'])->first();
        } else {

            $partial_campaigns = $user->brandCampaigns->where('partial', 1);

            if ($partial_campaigns->count() > 1) {
                dd('error');
            }

            if ($partial_campaigns->count() > 0) {
                $campaign = $partial_campaigns->first();
            } else {
                $campaign = new Campaign;
            }
        }

        $campaign->brand_id = $user->id;
        $campaign->name = $validated['campaign_name'];
        $campaign->type = $validated['type'];
        $campaign->goal = $validated['goal'];
        $campaign->social_platform_instagram = $validated['social_platform_instagram'] ? true : false;
        $campaign->social_platform_facebook = $validated['social_platform_facebook'] ? true : false;
        $campaign->format = $validated['format'];
        $campaign->format_type_feed = $validated['format_type_feed'] ? true : false;
        $campaign->format_type_story = $validated['format_type_story'] ? true : false;
        $campaign->style = $validated['style'];
        $campaign->goal_description = $validated['goal_description'];

        $campaign->physical_product = $physical_product;
        $campaign->digital_product = $digital_product;
        $campaign->service = $service;
        if (isset($validated['product_description'])) {
            $campaign->product_description = $validated['product_description'];
        }

        $campaign->url = $validated['url'];
        $campaign->instructions = $validated['instructions'];
        $campaign->budget = $validated['budget_overrun'] . '00';

        if ($validated['audience_create'] == "true") {
            if (isset($validated['category_id'])) {
                $audienceData['brand_id'] = $user->id;
                $audienceData['audience_name'] = $validated['audience_name'];
                $audienceData['category_id'] = $validated['category_id'];
                $audienceData['audience_age'] = $validated['audience_age'];
                $audienceData['influencer_size'] = $validated['influencer_size'];
                $audienceData['audience_gender'] = $validated['audience_gender'];
                $audienceData['audience_location'] = '["US"]';
                $audienceData['audience_language'] = '["eng"]';

                $audience = new Audience;
                try {
                    $audience = $audience->create($audienceData);
                    $campaign->audience_id = $audience->id;
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        } else {
            $campaign->audience_id = $validated['audience_id'];
        }
        $campaign->partial = 1;
        $campaign->save();

        return redirect()->route('home');
    }

    /**
     * Display the specified campaign.
     *
     * @param int $id Campaign Id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $campaign = $user->brandCampaigns()->with('influencers')->with('audience')->where('id', $id)->first();
        return view('app/campaign/details', ['campaign' => $campaign]);
    }

    /**
     * Show the form for editing the specified campaign.
     *
     * @param int $id Campaign Id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = $request->user();
        $campaign = $user->brandCampaigns()->where('id', $id)->first();
        if ($campaign->paid) {
            return redirect()->route('home');
        }
        $audience = $campaign->audience;

        $audiences = $user->brandAudiences;
        $category = new Category;
        $categories = $category->getAllCategories();
        return view('app/campaign/create', ['user' => $user, 'audiences' => $audiences, 'categories' => $categories, 'campaign' => $campaign, 'audience' => $audience]);
    }

    //Exibe a view review campaign
    public function reviewCampaign($id)
    {
        $user = Auth::user();

        $campaign = $user->brandCampaigns()->where('id', $id)->first();
        if ($campaign->paid) {
            return redirect()->route('home');
        }
        $stripeApi = new StripeApi;
        $audience = $campaign->audience;

        //  dd($campaign);
        $cards = $stripeApi->getPaymentMethods($user);
        //dd($cards);
        $session = '';

        return view('app/campaign/review', ['campaign' => $campaign, 'audience' => $audience, 'session' => $session, 'cards' => $cards, 'user' => $user]);
    }

    //Campaign review switches for select different influencers and manual select influencers
    public function campaignReviewSwitch(Request $request)
    {
        $campaign = Campaign::find($request->campaignId);
        if ($request->different_influencers == 'true') {
            $campaign->different_influencers = true;
            $campaign->save();
        } elseif ($request->different_influencers == 'false') {
            $campaign->different_influencers = false;
            $campaign->save();
        }
        if ($request->manual_select == 'true') {
            $campaign->manual_select_influencers = true;
            $campaign->save();
        } elseif ($request->manual_select == 'false') {
            $campaign->manual_select_influencers = false;
            $campaign->save();
        }
    }

    //Processa pagamento da campanha
    public function payCampaign(Request $request)
    {
        $user = $request->user();

        $stripeApi = new StripeApi;
        $input = $request->all();

        if (isset($request['card_number']) and !isset($request['card_id'])) {
            $request->validate(
                [
                    'card_number' => 'required|string|max:19',
                    'name' => 'required|string|max:50',
                    'SecureCard-expiryMonth' => 'required|string|max:2',
                    'SecureCard-expiryYear' => 'required|integer|max:39',
                    'cvv' => 'required|integer|max:999',
                ]
            );

            $cardData['name'] = $request['name'];
            $cardData['number'] = $request['card_number'];
            $cardData['exp_month'] = $request['SecureCard-expiryMonth'];
            $cardData['exp_year'] = '20' . $request['SecureCard-expiryYear'];
            $cardData['cvc'] = $request['cvv'];

            if (isset($request['switch-save-card'])) {
                try {
                    $card = $stripeApi->createCard($cardData);
                    try {
                        $stripeApi->createSetupIntent($user, $card['id']);
                    } catch (\Throwable $th) {
                        return redirect()->back()->with('error', $th->getMessage());
                    }
                } catch (\Throwable $th) {
                    return redirect()->back()->with('error', $th->getMessage());
                }
            }
            $cardId = $card->id;
        } else {

            $v = Validator::make(
                $input,
                [
                    'card_id' => 'required|string|max:50',
                ],
                [
                    'card_id.required' => 'Plese select a saved card to charge for this campaign.',
                ]
            );
            $v->validate();
            $cardId = $request['card_id'];
        }


        $previous = url()->previous();
        $campaignId = substr(strrchr($previous, "/"), 1);
        $campaign = $user->brandCampaigns()->where('id', $campaignId)->first();


        $metadata = ['campaign_id' => $campaign->id, 'campaign_name' => $campaign->name, 'datetime' => $campaign->dateMetadata()];

        try {
            $res = $stripeApi->createPaymentIntent($user, $campaign->budget, $metadata);
            try {

                $stripeApi->confirmPaymentIntent($res->id, $cardId);
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getMessage());
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        $campaign->paid = 1;
        $campaign->save();

        if ($campaign->url) {
            $campaign->createClickmeterGroup();
            if ($campaign->goal == 'purchase' or $campaign->goal == 'registrations') {
                $campaign->createClickmeterConversion();
            }
        }

        event(new NewCampaign($campaign));
        return redirect()->route('campaign.pay.success');
    }

    //Exibe view campanha criada com sucesso
    public function payCampaignSuccess()
    {
        return view('app/campaign/campaign-created');
    }

    /**
     * Remove the specified campaign from storage.
     *
     * @param int $id Campaign Id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $campaign = $user->brandCampaigns->where('id', $id)->first();

        $campaign->delete();
    }

    public function brandCampaigns()
    {
        $user = Auth::user();
        $campaigns = $user->brandCampaigns()->with('influencers')->with('audience')->with('posts')->where('paid', 1)->get();

        foreach ($campaigns as $campaign) {
            $campaign->impression_count();
        }

        return view('app/campaign/brand-campaigns', compact('campaigns', 'user'));
    }

    public function showReleaseFunds($id)
    {
        $user = Auth::user();
        $campaign = $user->brandCampaigns()->with('influencers')->where('id', $id)->first();
        return view('app/campaign/release-funds', ['campaign' => $campaign]);
    }


    public function influencerCampaigns($tab = null)
    {
        $user = Auth::user();
        //Gets user social media ids
        $temp = $user->socialMediasId();

        $campaigns = $user->influencerCampaigns;
        // foreach ($campaigns as $campaign) {
        //     dump($campaign->status());
        // }die;
        foreach ($campaigns as $campaign) {
            $clicksData = $campaign->influencerClicksData($user);

            $campaign->clicks = ($clicksData == 0) ? 0 : $clicksData['clicks'];
            foreach ($campaign->posts as $post) {
                //compares post->social_media_id if it matches one of the users social medias
                if (in_array($post->social_media_id, $temp)) {
                    foreach ($post->metrics as $metric) {
                        if ($metric->tipo == 'impressions') {
                            $campaign->impressions = $campaign->impressions + $metric->valor;
                        }
                        if ($metric->tipo == 'engagement' or $metric->tipo == 'replies') {
                            $campaign->engagement = $campaign->engagement + $metric->valor;
                        }
                    }
                }
            }
        }
        return view('app/user/influencer/campaigns', compact('campaigns', 'user', 'tab'));
    }

    // influencer-campaigns - decline job
    public function declineJob(Request $request)
    {
        $user = $request->user();

        $request->validate(
            [
                'campaign_id' =>                 'required|int',
                'influencer_decline_motive' =>   'required|string|max:500',
            ]
        );

        $campaign = $user->influencerCampaigns->where('id', $request->campaign_id);
        if ($campaign->count()) {
            try {
                $user->influencerCampaigns()->updateExistingPivot($request->campaign_id, ['influencer_decline_motive' => $request->influencer_decline_motive, 'influencer_accept' => 0]);
                $response_array['status'] = 'success';
                $response_array['message'] = 'Job declined';
                return new JsonResponse($response_array, 201);
            } catch (\Throwable $th) {
                $response_array['status'] = 'error';
                $response_array['message'] = $th->getMessage();
                return new JsonResponse($response_array, 201);
            }
        } else {
            dump('error');
        }
    }

    //influencer-campaigns accept job
    public function acceptJob(Request $request)
    {
        $request->validate(
            [
                'campaign_id' =>  'required',
            ]
        );
        $user = $request->user();
        $campaign = $user->influencerCampaigns->where('id', $request->campaign_id)->first();

        if ($campaign->count()) {
            try {
                if ($campaign->url and $campaign->clickmeter_group_id) {
                    $campaign->createUserLink($user);
                }
                $campaignOwner = $campaign->brand;
                $user->influencerCampaigns()->updateExistingPivot($request->campaign_id, ['influencer_accept' => 1]);
                $campaignOwner->notify(new \App\Notifications\BrandCampaignInfluencerAccept($user, $campaign));

                $response_array['status'] = 'success';
                $response_array['message'] = 'Job accepted';
                return new JsonResponse($response_array, 201);
            } catch (\Throwable $th) {
                $response_array['status'] = 'error';
                $response_array['message'] = $th->getMessage();
                return new JsonResponse($response_array, 201);
            }
        } else {
            dump('error');
        }
    }

    public function influencerCampaignDetails($id)
    {
        $user = Auth::user();
        $temp = $user->socialMediasId();
        $campaign = $user->influencerCampaigns->where('id', $id)->first();
        $clicksData = $campaign->influencerClicksData($user);

        $posts = $campaign->posts->whereIn('social_media_id', $temp);
        if ($posts->count() >= 2) {
            $can_add_posts = false;
        } else {
            $can_add_posts = true;
        }

        foreach ($posts as $post) {
            foreach ($post->metrics as $metric) {
                if ($metric->tipo == 'impressions') {
                    $campaign->impressions = $campaign->impressions + $metric->valor;
                }
                if ($metric->tipo == 'engagement' or $metric->tipo == 'replies') {
                    $campaign->engagement = $campaign->engagement + $metric->valor;
                }
            }
        }

        $agent = new Agent();
        if ($agent->isDesktop()) {
            return view('app/campaign/influencer-campaign-details-desktop', compact('campaign', 'user', 'clicksData', 'posts', 'can_add_posts'));
        } else {
            return view('app/campaign/influencer-campaign-details-mobile', compact('campaign', 'user', 'clicksData', 'posts', 'can_add_posts'));
        }
    }

    public function influencerCampaignPosts($campaign_id)
    {
        $user = Auth::user();
        $temp = $user->socialMediasId();
        $campaign = $user->influencerCampaigns->where('id', $campaign_id)->first();
        $campaign_start = Carbon::parse($campaign->datetime);
        $campaign_start->subMinutes(30);
        $campaign_posts = $campaign->posts->whereIn('social_media_id', $temp);
        $campaign_posts->load('social_media');

        $can_add_insta = true;
        $can_add_fb = true;
        if ($campaign_posts->count() >= 2) {
            $can_add_insta = false;
            $can_add_fb = false;
        } elseif ($campaign_posts->count() == 1) {
            foreach ($campaign_posts as $value) {
                if ($value->social_media->social_media == 'instagram_business') {
                    $can_add_insta = false;
                } elseif ($value->social_media->social_media == 'facebok_page') {
                    $can_add_fb = false;
                }
            }
        }

        $posts = $user->posts()->where('media_type', 'IMAGE')->orWhere('media_type', 'VIDEO')->get();
        $posts->load('social_media');

        $fb_page_posts = null;
        $insta_posts = null;
        foreach ($posts as $post) {
            $post_date = Carbon::parse($post->timestamp);
            if ($post->social_media->social_media == 'facebook_page' and $campaign->social_platform_facebook and $post_date->isAfter($campaign_start) and is_null($post->campaign_id)) {
                $fb_page_posts[] = $post;
            } elseif ($post->social_media->social_media == 'instagram_business' and $campaign->social_platform_instagram and $post_date->isAfter($campaign_start) and is_null($post->campaign_id)) {
                $insta_posts[] = $post;
            }
        }

        return view('app/campaign/influencer-campaign-posts', compact('campaign', 'posts', 'fb_page_posts', 'insta_posts', 'user', 'can_add_insta', 'can_add_fb'));
    }

    //Guarda a nota(rating) atribuido pela brand ao influencer
    public function storeInfluencerRating(Request $request)
    {
        $request->validate(
            [
                'campaignId' =>  'required',
                'rating' =>      'required',
                'userId' =>      'required',
            ]
        );
        $user = $request->user();
        $campaign = $user->brandCampaigns()->where('id', $request->campaignId)->first();
        $campaign->influencers()->updateExistingPivot($request->userId, ['rating' => $request->rating]);
    }

    public function brandAcceptInfluencer($campaignId)
    {
        $user = Auth::user();
        $campaign = Campaign::find($campaignId);

        if ($campaign->brand_id == $user->id) {
            $campaign = Campaign::find($campaignId);
            return view('app/campaign/accept_influencer', compact('campaign'));
        }
    }

    public function brandStoreAcceptInfluencer(Request $request)
    {
        $request->validate(
            [
                'campaignId' =>  'required',
                'userId' =>      'required',
            ]
        );
        $user = $request->user();
        $campaign = Campaign::find($request->campaignId);
        if ($campaign->brand_id == $user->id) {
            $campaign->influencers()->updateExistingPivot($request->userId, ['brand_accept' => 1]);
        }
        return redirect()->back();
    }

    public function releaseFunds($influencerId, $campaignId)
    {
        $user = Auth::user();

        $campaign = $user->brandCampaigns()->where('id', $campaignId)->first();
        $influencer = $campaign->influencers()->where('user_id', $influencerId)->first();

        if (!$influencer->pivot->paid) {
            $stripeApi = new StripeApi;

            try {
                $metadata = ['campaign_id' => $campaign->id, 'campaign_name' => $campaign->name, 'datetime' => $campaign->dateMetadata()];
                $stripeApi->transfer($influencer->stripe_acc, $influencer->pivot->value, 'user_id-' . $influencer->id, $metadata);
            } catch (\Throwable $th) {
                $response_array['status'] = 'error';
                return new JsonResponse([$response_array], 201);
            }

            $campaign->influencers()->updateExistingPivot($influencer->id, ['paid' => 1]);

            $response_array['status'] = 'success';
            $influencer->notify(new \App\Notifications\InfluencerFundsReceived($user, $campaign));

            return new JsonResponse([$response_array], 201);
        } else {
            $response_array['status'] = 'error';
            return new JsonResponse([$response_array], 201);
        }
    }

    public function showSelectInfluencers($id)
    {
        $user = Auth::user();
        $campaign = $user->brandCampaigns()->with('influencers')->where('id', $id)->first();
        return view('app/campaign/select-influencers', ['campaign' => $campaign]);
    }

    public function selectInfluencers(Request $request)
    {
        $user = $request->user();
        $campaign = $user->brandCampaigns()->where('id', $request['campaignId'])->first();

        foreach ($campaign->influencers as $influencer) {
            if (in_array($influencer->id, $request['ids'])) {
                $campaign->influencers()->updateExistingPivot($influencer->id, ['brand_accept' => 1]);
            } else {
                $campaign->influencers()->updateExistingPivot($influencer->id, ['brand_accept' => 0]);
            }
        }

        $response_array['status'] = 'success';
        return new JsonResponse([$response_array], 201);
    }

    public function storeCampaignPosts(Request $request)
    {
        // dump($request->all());die;
        $user = $request->User();
        $campaign = Campaign::find($request->campaign_id);
        // dump($campaign);

        //verifica se o usuario faz parta da campanha
        $campaignInfluencers = $campaign->influencers;
        if (!$campaignInfluencers->contains($user)) {
            $response_array['status'] = 'error';
            $response_array['message'] = 'You are not part of this campaign';
            return new JsonResponse($response_array, 201);
        }

        foreach ($request->post_id as $post_id) {
            $post = Post::where('post_id', $post_id)->first();
            $post->campaign_id = $request->campaign_id;
            $post->save();
            $post->update_rules_to_update();
            $dadosPost = \App\Influencer\Dados\DadosPost\DadosPost::where('tabela', 'post')->where('tabela_id', $post->id)->get();
            foreach ($dadosPost as $dadoPost) {
                $dadoPost->setarValidade($post->time_to_update());
                $dadoPost->save();
            }
            $campaignOwner = $campaign->brand;
            $campaignOwner->notify(new \App\Notifications\BrandCampaignInfluencerPosted($user, $campaign));

            $response_array['status'] = 'success';
            $response_array['message'] = 'Posts added to campaign';
            return new JsonResponse($response_array, 201);
        }
    }

    public function detachCampaignPost(Request $request)
    {
        $request->validate(
            [
                'post_id' =>  'required',
            ]
        );
        $user = $request->user();
        $post = Post::find($request->post_id);
        $campaign = $post->campaign;
        $campaign2 = $user->influencerCampaigns->where('id', $campaign->id)->first();

        if ($campaign) {
            $post->campaign_id = null;
            $post->save();

            $response_array['status'] = 'success';
            $response_array['message'] = 'Post removed from campaign';
            return new JsonResponse($response_array, 201);
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = 'Error';
            return new JsonResponse($response_array, 201);
        }
    }

    public function brandAnalytics(Request $request)
    {
        if (isset($request['start']) and isset($request['end'])) {
            $data['start'] = $request['start'];
            $data['end'] = $request['end'];
            $start = Carbon::parse($request['start']);
            $end = Carbon::parse($request['end'])->addDay();
        } else {
            $data['start'] = Carbon::today()->subDays(29);
            $data['end'] = Carbon::today();
            $start = Carbon::today()->subDays(29);
            $end = Carbon::today()->addDay();
        }

        $user = $request->user();
        // $clickMeterApi = new ClickMeterApi;
        $campaigns = $user->brandCampaigns;

        $impressions = 0;
        $spent = 0;
        $influencers = array();

        foreach ($campaigns as $key => $campaign) {

            $days = ($campaign->format_type_feed) ? 7 : 1;
            $campaignStart = Carbon::parse($campaign->datetime);
            $campaignEnd = Carbon::parse($campaign->datetime)->addDays($days);

            if ($campaignStart->between($start, $end) or $campaignEnd->between($start, $end)) {
                $campaign->clicksData($start, $end);

                $spent = $spent + $campaign->budget;
                foreach ($campaign->posts as $post) {
                    foreach ($post->metrics as $metric) {
                        if ($metric->tipo == 'impressions') {
                            $impressions = $impressions + $metric->valor;
                        }
                    }
                }

                //soma valores de clicks para todas as campanhas
                if ($campaign->clicksData) {
                    foreach ($campaign->clicksData as $key => $value) {
                        if ($key == 'countries' or $key == 'cities') {
                            foreach ($value as $key2 => $value2) {
                                foreach ($value2 as $key3 => $value3) {
                                    if ($key3 == 'clicks') {
                                        $clicksData[$key][$key2][$key3] = (isset($clicksData[$key][$key2][$key3])) ? $clicksData[$key][$key2][$key3] + $value3 : $value3;
                                    } else {
                                        $clicksData[$key][$key2][$key3] = $value3;
                                    }
                                }
                            }
                        }
                        if ($key == 'days') {
                            foreach ($value as $key2 => $value2) {
                                $clicksData[$key][$key2] = (isset($clicksData[$key][$key2])) ? $clicksData[$key][$key2] + $value2 : $value2;
                            }
                        }
                    }
                }


                $influencers = array_merge($influencers, $campaign->influencerIds());
            } else {
                $campaigns->forget($key);
            }
        }
        if (isset($clicksData)) {
            $sum = 0;
            foreach ($clicksData['days'] as $key => $value) {
                $sum = $sum + $value;
            }
            if ($sum == 0) {
                $clicksData = null;
            }
        } else {
            $clicksData = null;
        }

        $influencers = count($influencers);

        return view('app/campaign/brand-analytics', ['campaigns' => $campaigns, 'impressions' => $impressions, 'spent' => $spent, 'influencers' => $influencers, 'data' => $data, 'clicksData' => $clicksData]);
    }

    public function copyCampaign(Request $request)
    {
        $user = $request->user();
        $campaigns = $user->brandCampaigns;
        return view('app/campaign/copy-campaign', ['headerTitle' => 'Create Campaign', 'campaigns' => $campaigns, 'user' => $user]);
    }

    //Brand - analytics da campanha - ajax loaded
    public function campaignAnalytics(Request $request)
    {
        $user = $request->user();
        $campaign = $user->brandCampaigns()->where('id', $request['campaignId'])->first();

        $start = (isset($request['start']) ? $request['start'] : $campaign->starts2());
        $end = (isset($request['end']) ? $request['end'] : Carbon::now()->format('Ymd'));
        $campaign->dateRangePickerStart = $start;
        $campaign->dateRangePickerEnd = $end;

        $start = Carbon::parse($start);
        $end = Carbon::parse($end);

        $campaign->clicksData($start, $end);
        return view('app/campaign/brand-campaign-analytics', ['campaign' => $campaign]);
    }
}
