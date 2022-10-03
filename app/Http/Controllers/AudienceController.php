<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Influencer\Audience\Audience;
use App\Influencer\Campaign\Campaign;
use App\Influencer\Category\Category;
use App\Infrastructure\API\Countries\Countries;

class AudienceController extends Controller
{
    /**
     *  Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new campaign.
     * 
     * @param \Illuminate\Http\Request $request Laravel request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Campaign $campaign)
    {
        $category = new Category;
        $categories = $category->getAllCategories();
        $countries = Countries::getCountryCodes();
        $languages = \App\Influencer\Utils\Language::languages();
        return view('app/audience/create', compact('categories', 'campaign', 'countries', 'languages'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        $validated = $request->validate(
            [
            'category_id'=> 'required',
            'influencer_size'=> 'required',
            'audience_gender'=> 'required',
            'audience_age'=> 'required',
            'location'=> 'required',
            'language'=> 'required',
            ]
        );
        $validated['brand_id'] = $campaign->brand_id;
        $validated['audience_location'] = json_encode($validated['location']);
        $validated['audience_language'] = json_encode($validated['language']);
        
        $audience = new Audience;
        $audience = $audience->create($validated);
        $audience_id['audience_id'] = $audience->id;
        $campaign->update($audience_id);

        return redirect()->route('campaign.edit.format', [$campaign]);
    }

}
