<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Influencer\User\User;
use App\Influencer\Category\Category;
use App\Influencer\Campaign\Campaign;

// Essa controller existe apenas para chamar manualmente as funcoes abaixo por enquanto
class AdminController extends Controller
{

    public function updateUsers()
    {
        dd(\App\Influencer\Post\Post::updatePosts());
    }

    public function updateStories()
    {
        dd(\App\Influencer\Post\Post::updateStories());
    }

    public function updateInsights()
    {
        dd(\App\Influencer\Post\Post::updateInsights());
    }

    public function updateStoryInsights()
    {
        dd(\App\Influencer\Post\Post::updateInsights('story'));
    }

    //Atualiza todos os posts, stories e insigths. Craido para facilitar
    public function updateAll()
    {
        \App\Influencer\SocialMedia\SocialMedia::verifyAllTokens();
        \App\Jobs\UpdatePostData::dispatch();
        \App\Jobs\UpdatePostInsights::dispatch();
        dump(\App\Influencer\Post\Post::updateStories());
        dump(\App\Influencer\Post\Post::updateInsights('story'));
        dump(\App\Influencer\SocialMedia\SocialMedia::updateData());
    }

    //funcao de teste que puxa os stories do usuario
    public function igTest()
    {
        $socialMedias = \App\Influencer\SocialMedia\SocialMedia::get();
        foreach ($socialMedias as $socialMedia) {
            dump($socialMedia->posts);
        }

        die;
        //-------------------------
        $user = Auth::user();
        $instagram = \App\Influencer\SocialMedia\InstagramBusiness\User::make($user);
        $api = new \App\Infrastructure\API\SocialMedia\Facebook\Instagram($instagram);

        // $res = $api->getInstagramAccountInsights()->Json();
        // dump($res);
        // die;

        //-----------------

        // $res = $api->getInstagramStories()->Json();
        // dump($res);
        // foreach ($res['data'] as $media) {
        //     $temp = $api->getInstagramMediaInfo($media['id'])->Json();
        //     $temp2 = $api->getInstagramStory($media['id'])->Json();
        //     dump($temp);
        //     dump($temp2);
        // }

        //--------------------------------

        $data = $api->getInstagramMedias()->Json();
        //dd($data);
        $continue = true;
        $while = 0;
        $foreach = 0;
        while ($continue AND isset($data['paging']['next'])) {
            dump("While : $while");
            foreach ($data['data'] as $postId) {
                if ($foreach >= 6) {break;
                }
                dump("Foreach : $foreach");
                    $media = $api->getInstagramMediaInfo($postId['id'])->Json();
                    dump($media);
                    // if ($media['media_type'] == 'CAROUSEL_ALBUM') {
                        
                        $insight = $api->getInstagramMedia($postId['id'])->Json();
                        dump($insight);
                    // }
                $foreach++;
            }
            $while++;
            break;
        }
    }

    public function campaigns()
    {
        $campaigns = \App\Influencer\Campaign\Campaign::get();
        foreach ($campaigns as $key => $campaign) {
            if (!$campaign->adminAcceptInfluencer()) {
                // $campaigns->forget($key);
            }
        }
        return view('app/admin/campaigns', compact('campaigns'));
    }

    public function campaignDetail($id)
    {
        $campaign = \App\Influencer\Campaign\Campaign::find($id);
        return view('app/admin/accept_influencer', compact('campaign'));
    }

    public function storeAcceptInfluencer(Request $request)
    {
        $campaign = \App\Influencer\Campaign\Campaign::find($request->campaignId);
        if ($request->command == 'accept') {
            $campaign->influencers()->updateExistingPivot($request->userId, ['admin_accept' => 1]);
        }
        if ($request->command == 'reject') {
            $campaign->influencers()->updateExistingPivot($request->userId, ['admin_accept' => 0]);
        }
        return redirect()->back();
    }

    public function influencerDetail($id)
    {
        $user = User::find($id);
        dump($user);
    }

    public function listInfluencers($campaignId)
    {
        $campaign = campaign::find($campaignId);
        $influencers = User::role('Influencer')->get();
        $category = new Category;
        $categories = $category->getAllCategories();


        return view('app/admin/list_influencer', compact('influencers', 'campaign', 'categories'));
    }

    public function postListInfluencers(Request $request, $campaignId)
    {
        $campaign = campaign::find($campaignId);

        $influencers = User::role('Influencer')->whereHas(
            'categories', function ($query) use ($request) {
                $query->where('id', $request->category_id);
            }, 
        )->get();
        $category = new Category;
        $categories = $category->getAllCategories();

        return view('app/admin/list_influencer', compact('influencers', 'campaign', 'categories'));
    }

    public function addInfluencerToCampaign(Request $request)
    {
        $user = User::find($request->userId);
        $campaign = Campaign::find($request->campaignId);

        try {
            $campaign->influencers()->save($user);

            if ($campaign->manual_select_influencers == 1) {
                $campaign->influencers()->updateExistingPivot($user->id, ['brand_accept' => 0, 'value' => 100, 'manual_add' => 1]);
            } else {
                $campaign->influencers()->updateExistingPivot($user->id, ['brand_accept' => 1, 'value' => 100, 'manual_add' => 1]);
            }

            return redirect()->back()->with('message', 'Influencer added to campaign');
        } catch (\Throwable $th) {
            $msg = "Influencer: $user->first_name $user->last_name, is already part of Campaign: ".$campaign->name;
            return redirect()->back()->with('error', $msg);
        }
        
    }
    

    
}
