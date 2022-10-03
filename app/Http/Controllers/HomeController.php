<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Infrastructure\API\SocialMedia\Facebook\Facebook as FacebookAPI;
use App\Infrastructure\API\SocialMedia\Facebook\FacebookPage as FacebookPageAPI;
use App\Infrastructure\API\SocialMedia\Facebook\Instagram as InstagramAPI;

use App\Influencer\SocialMedia\Facebook\User as FacebookUser;
use App\Influencer\SocialMedia\FacebookPage\User as FacebookPageUser;
use App\Influencer\SocialMedia\InstagramBusiness\User as InstagramBusinessUser;

use Jenssegers\Agent\Agent;


use App\Infrastructure\API\ClickMeter\ClickMeterApi;
use App\Influencer\User\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->hasRole('Brand')) {
            return view('app.user.brand.dashboard', ['user'=>$user]);
        } else {
            // $agent = new Agent();
            // if ($agent->isDesktop()) {
                return view('app.user.influencer.home', ['user'=>$user]);
            // }
        }
    }

    public function fb_request(Request $request)
    {
        $user = $request->user();

        $params = $request->all();
        $case = 1;
        if (isset($params['call'])) {
            $case = $params['call'];
        }

        $data['data'] = null;
        $data['casos'] = $this->getCasos();

        $data['data'] = $this->FB_data($user, $case);

        dump($data['data']);
        return view('fb_request')->with($data);
    }

    // FUNÇÕES PRIVADAS - Temporárias para teste
    private static function getCasos()
    {
        return [
            1 => 'Páginas',
            2 => 'Posts',
            3 => 'IG Biz Acc',
            4 => 'Insights',
            5 => 'IG Accounts',
            6 => 'IG Tags',
            7 => 'IG User',
            8 => 'IG Insight - City-Country-Age/Gender',
            9 => 'IG Media',
            10 => 'IG Stories',
            11 => 'IG Last Story',
            12 => 'IG Last Media',
        ];
    }

    private function FB_data($user, $case = 1)
    {
        // Longe de estar ideal para o Solid. É justamente pra fugir desse tipo de código que existe o Open/Closed Principle.
        // Ainda estou estruturando o melhor formato para chamar as APIs.
        if (in_array($case, [1])) {
            $facebookUser = FacebookUser::make($user);
            $api = new FacebookAPI($facebookUser);
        } elseif (in_array($case, [2,3,5])) {
            $facebookPage = FacebookPageUser::make($user);
            $api = new FacebookPageAPI($facebookPage);
        } else {
            $instagramUser = InstagramBusinessUser::make($user);
            $api = new InstagramAPI($instagramUser);
        }

        switch($case){
            case 1:
                $data = $api->getFacebookPages();
                break;

            case 2:
                $data = $api->getFacebookPagePosts();
                break;

            case 3:
                $data = $api->getInstagramBusinessAccount();
                break;

            case 4:
                $data = $api->getInstagramAccountInsights();
                break;

            case 5:
                $data = $api->getInstagramAccounts();
                break;

            case 6:
                $data = $api->getInstagramTags();
                break;

            case 7:
                $data = $api->getInstagramUser();
                break;

            case 8:
                $data = $api->getInstagramAudience();
                break;

            case 9:
                $data = $api->getInstagramMedias();
                break;

            case 10:
                $data = $api->getInstagramStories();
                break;

            case 11:
                $storyId = "17862370241101082";
                $data = $api->getInstagramStory($storyId);
                break;

            case 12:
                $mediaId = "17854018408442122";
                $mediaId = "18089997772168993";
                $data = $api->getInstagramMedia($mediaId);
                break;

            default:
                $data = ['data' => 'NADAAAAAA'];
                break;

        }
        if (isset($data['data']))
            return $data['data'];
        else
            return ["SEM DADOS", $data->body()];
    }

    public function randomTests()
    {
        // \App\Jobs\UpdatePostInsights::dispatch();
        \App\Jobs\UpdatePostData::dispatch();
        // \App\Jobs\NotificationsJob::dispatch(1);
        die;
        $user1 = Auth::user();
        $user2 = User::find(3);//influencer

        $campaign = \App\Influencer\Campaign\Campaign::find(1);
        $user1->notify(new \App\Notifications\BrandCampaignEnded($campaign));

        die;
        phpinfo();
        die;
        $user = Auth::user();
        $user->subscriptionActive();
        die;
        $clickMeter = new ClickMeterApi;
        // $clickMeter->showTags();die;
        // $clickMeter->getDatapoints(); 
        $campaign = \App\Influencer\Campaign\Campaign::find(2);
        dump($campaign);
        $campaign->clicks();
    }
}
