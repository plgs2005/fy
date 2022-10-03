<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Route::get('/conversion', function () {
    return view('app/conversion');
});

Route::post('/conversion-success', function (Request $request) {
    dump($request->all());
    return view('app/conversion-success');
});

Route::get('/app', 'AppController@index');

Auth::routes(['verify' => true]);

Route::get('/register-type', 'Auth\RegisterController@registerType')->name('registerType');
Route::get('/register-brand', 'Auth\RegisterController@showBrandRegistrationForm')->name('registerBrand');
Route::post('/register-brand', 'Auth\RegisterController@registerBrand');

Route::post('/register-influencer', 'Auth\RegisterController@registerInfluencer')->name('register.influencer')->middleware('XssSanitizer');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth', 'profileCompleted', 'verified');
Route::get('/fb', 'HomeController@fb_request')->name('fb_request');

Route::get('/social', 'SocialMediaController@social_account')->name('userSocialAccounts');
Route::get('/social-connect', 'SocialMediaController@social_connect')->name('userSocialConnect');
Route::post('/social_store', 'SocialMediaController@store_social_account')->name('storeSocialAccount');
Route::get('auth/facebook', 'SocialMediaController@redirectToFacebook');
Route::get('auth/facebook/callback', 'SocialMediaController@handleFacebookCallback');

Route::get('/settings', 'UserController@settings')->name('userSettings');
Route::get('/edit-profile', 'UserController@editProfile')->name('editProfile');
Route::post('/edit-profile', 'UserController@updateProfile');
Route::get('/complete-profile', 'UserController@completeProfile')->name('completeProfile');
Route::post('/complete-profile', 'UserController@saveCompleteProfile');
Route::post('/complete-profile-brand', 'UserController@completeProfileBrand')->name('completeProfileBrand');

Route::group(
    ['middleware' => ['auth']],
    function () {
        Route::post('/store-change-password', 'UserController@storeChangePassword')->name('user.changePassword');
        Route::post('/avatar-update', 'UserController@avatarUpdate')->name('user.avatar.update');

        Route::post('/delete-account', 'UserController@deleteAccount')->name('user.delete.account');
        Route::get('/deleteAccount', 'UserController@deleteAccountView');
        Route::get('/notifications-read', 'UserController@notificationsRead');
    }
);

Route::get('/brand-complete-profile', 'UserController@completeProfileBrand')->name('brand.complete.profile')->middleware('auth', 'role:Brand', 'verified');
Route::post('/brand-complete-profile', 'UserController@storeCompleteProfileBrand')->middleware('auth', 'role:Brand', 'verified');
Route::group(
    ['middleware' => ['role:Brand', 'auth', 'profileCompleted']],
    function () {
        
        // Route::get('/accept-influencer/{campaignId}', 'CampaignController@brandAcceptInfluencer')->name('campaign.accept.influencer');
        // Route::post('/store-accept-influencer', 'CampaignController@brandStoreAcceptInfluencer')->name('campaign.store.accept.influencer');


        //brand routes used by new front end
        Route::get('/brand-profile', 'UserController@brandProfile')->name('brand.profile');
        Route::put('/brand-profile-update', 'UserController@brandProfileUpdate')->name('brand.profile.update');
        Route::get('/brand-campaigns', 'CampaignController@brandCampaigns')->name('brand.campaign.list');
        Route::get('/brand-campaign-show/{id}', 'CampaignController@show');
        Route::get('/show-release-funds/{id}', 'CampaignController@showReleaseFunds');
        Route::get('/show-select-influencers/{id}', 'CampaignController@showSelectInfluencers');
        Route::get('/campaign-copy', 'CampaignController@copyCampaign')->name('campaign.copy');
        Route::get('/campaign-create/{id?}', 'CampaignController@create')->name('campaign.create');
        Route::post('/campaign-create', 'CampaignController@store');
        Route::get('/campaign-delete/{id}', 'CampaignController@destroy');
        Route::post('/campaign-create-partial', 'CampaignController@storePartial');
        Route::get('/campaign-edit/{id}', 'CampaignController@edit')->name('campaign.edit');
        Route::post('/campaign-update', 'CampaignController@store')->name('campaign.update');
        Route::get('/campaign-review/{id}', 'CampaignController@reviewCampaign')->name('brand.campaign.review');
        Route::post('/campaign-review-switch', 'CampaignController@campaignReviewSwitch');
        Route::post('/brand-analytics', 'CampaignController@brandAnalytics')->name('brand.analytics');
        Route::get('/brand-settings', 'UserController@brandSettings')->name('brand.settings');
        Route::post('/brand-settings', 'UserController@storeBrandSettings');
        Route::post('/logo-update', 'UserController@updateBrandLogo')->name('brand.logo.update');

        Route::post('/user-rating', 'CampaignController@storeInfluencerRating')->name('rating.store');
        Route::get('/release-funds/{influencerId}/{campaignId}', 'CampaignController@releaseFunds');
        Route::post('/select-influencers', 'CampaignController@selectInfluencers');
        Route::post('/campaign-analytics', 'CampaignController@campaignAnalytics');
        Route::get('/brand-cards', 'StripeController@brandCards');
        Route::post('/store-card', 'StripeController@storeCard')->name('card.store');
        Route::post('/delete-card', 'StripeController@deleteCard');
        Route::post('/campaign-pay', 'CampaignController@payCampaign')->name('campaign.pay');
        Route::get('/campaign-paid', 'CampaignController@payCampaignSuccess')->name('campaign.pay.success');

        Route::get('/subscribe', 'UserController@subscribe')->name('subscribe');
        Route::post('/store-subscribe', 'StripeController@storeSubscription')->name('subscribe.store');
        Route::post('/subscribe-cancel', 'StripeController@cancelSubscription')->name('subscribe.cancel');
    }
);


Route::get('/connect-facebook', 'UserController@connectFacebook')->middleware('auth', 'role:Influencer', 'verified');
Route::get('/select-fb-page', 'UserController@selectFbPage')->middleware('auth', 'role:Influencer', 'verified');
Route::post('/store-fb-page', 'UserController@storeFbPage')->name('storeFbPage')->middleware('auth', 'role:Influencer', 'verified');
Route::group(
    ['middleware' => ['role:Influencer', 'auth', 'XssSanitizer', 'profileCompleted']],
    function () {
       
        // Route::get('/accept-campaign', 'CampaignController@influenceracceptCampaign')->name('campaign.influencer.accept');
        // Route::post('/store-accept-campaign', 'CampaignController@influencerStoreacceptCampaign')->name('campaign.store.accept');
        Route::get('/campaign-posts/{campaignId}', 'CampaignController@CampaignPosts')->name('campaign.posts');
        
        Route::get('/influencer-analytics', 'CampaignController@influencerCampaignAnalytics')->name('influencer.analytics');

        //Rotas influencer novo front-end
        Route::get('/influencer-profile', 'UserController@influencerProfile')->name('influencer.profile');
        Route::get('/influencer-address', 'UserController@influencerAddress')->name('influencer.address');
        Route::get('/influencer-categories', 'UserController@influencerCategories')->name('influencer.categories');
        Route::get('/influencer-measurements', 'UserController@influencerMeasurements')->name('influencer.measurements');
        Route::post('/influecer-store-address', 'UserController@storeInfluencerAddress')->name('influencer.store.address');
        Route::get('/payments', 'UserController@payments')->name('payments');
        Route::get('/bankInfo', 'UserController@bankInfo');
        Route::post('/withdraw', 'UserController@withdraw')->name('withdraw');
        Route::get('/social-accounts', 'UserController@socialAccounts');
        Route::post('/toggle-social-media', 'UserController@toggleSocialMedia');

        Route::get('/influencer-campaigns/{tab?}', 'CampaignController@influencerCampaigns');
        Route::post('/decline-job', 'CampaignController@declineJob')->name('job.decline');
        Route::post('/accept-job', 'CampaignController@acceptJob')->name('job.accept');
        Route::get('/influencer-campaign-details/{id}', 'CampaignController@influencerCampaignDetails');
        Route::get('/influencer-campaign-posts/{campaign_id}', 'CampaignController@influencerCampaignPosts');
        Route::post('/store-campaign-posts', 'CampaignController@StoreCampaignPosts')->name('store.campaign.posts');
        Route::post('/detach-post', 'CampaignController@detachCampaignPost');

        Route::post('/influencer-store-categories', 'UserController@storeInfluencerCategories')->name('influencer.store.categories');
        Route::delete('/influencer-destroy-categories/{id}', 'UserController@destroyInfluencerCategories')->name('influencer.destroy.categories');
        Route::put('/influencer-profile-update', 'UserController@influencerProfileUpdate')->name('influencer.profile.update');
        Route::put('/influencer-update-measurements', 'UserController@updateMeasurements')->name('influencer.update.measurements');
        Route::get('/giftOnly', 'UserController@giftOnlyCampaigns'); 
        Route::post('/gift-only-switch', 'UserController@storeGiftOnlyCampaigns'); 
    }
);

Route::get('/register-complete', 'UserController@registerComplete')->name('register.complete')->middleware('auth', 'role:Influencer', 'verified');
Route::get('/receive-products', 'UserController@receiveProducts')->name('receive.products')->middleware('auth', 'role:Influencer', 'verified');
Route::post('/store-products-measurements', 'UserController@storeProductsAndMeasurements')->name('influencer.store.products.measurements')->middleware('XssSanitizer', 'auth', 'role:Influencer', 'verified');
Route::put('/set-receive-products', 'UserController@setReceiveProducts')->name('influencer.set.receive.products')->middleware('XssSanitizer', 'auth', 'role:Influencer', 'verified');

Route::group(
    ['middleware' => ['role:Admin', 'auth']],
    function () {
        Route::get('/admin-campaigns', 'AdminController@campaigns')->name('admin.campaigns');
        Route::get('/admin-campaign-detail/{id}', 'AdminController@campaignDetail')->name('admin.campaign.detail');
        Route::post('/admin-accept-influencer', 'AdminController@storeAcceptInfluencer')->name('admin.store.accept.influencer');
        Route::get('/admin-influencer-detail/{id}', 'AdminController@influencerDetail')->name('admin.influencer.detail');
        Route::get('/list-influencer/{campaignId}', 'AdminController@listInfluencers')->name('admin.list.influencer');
        Route::post('/list-influencer/{campaignId}', 'AdminController@postListInfluencers');
        Route::post('/add-influencer-campaign', 'AdminController@addInfluencerToCampaign')->name('admin.add.influencer.campaign');

        Route::get('/admin/update-users', 'AdminController@updateUsers');
        Route::get('/admin/update-insights', 'AdminController@updateInsights');
        Route::get('/admin/update-stories', 'AdminController@updateStories');
        Route::get('/admin/update-story-insights', 'AdminController@updateStoryInsights');
        Route::get('/admin/update-all', 'AdminController@updateAll');
        Route::get('/admin/update-socialMedias', 'SocialMediaController@updateData');

        Route::get('/admin/delete-old_posts', 'AdminController@deleteOldPosts');
    }
);
//-------------------
Route::get('/ig-data', 'SocialMediaController@socialMediaUserData');


Route::get('/stripe-create', 'StripeController@createAccount')->name('stripe.create');
Route::get('/stripe-onboarding', 'StripeController@completeOnboarding')->name('stripe.onboarding');
Route::get('/stripe-pay', 'StripeController@payment')->name('stripe.pay');

Route::get('/ig-test', 'AdminController@igTest');

Route::post(
    '/email/verification-notification',
    function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
)->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/infos', 'ModeloController@check_infos')->name('check_infos');
Route::get('/load-my-data', 'ModeloController@load_my_data')->name('loadData');

Route::get('ajax', 'AdminController@ajaxView')->middleware('auth');
Route::post('ajax', 'AdminController@ajaxCall')->middleware('auth');

Route::get('tests', 'HomeController@randomTests')->middleware('auth');


