<?php

namespace App\Infrastructure\API\SocialMedia\Facebook;

use App\Influencer\SocialMedia\FacebookPage\User as FacebookPageUser;

use Http;

class FacebookPage extends API
{
    public function getFacebookPagePosts()
    {
        return Http::get($this->completeUrl."/{$this->user->getId()}/published_posts?access_token={$this->user->getToken()}&limit=100");
    }

    public function getFacebookPagePostInfo($post_id)
    {
        return Http::get($this->completeUrl."/{$post_id}?access_token={$this->user->getToken()}&fields=message,created_time,permalink_url,full_picture,properties,shares");
    }

    public function getFacebookPagePostInsights($post_id)
    {
        return Http::get($this->completeUrl."/{$post_id}/insights?access_token={$this->user->getToken()}&date_preset=maximum&period=lifetime&metric=post_impressions,post_engaged_users,post_reactions_by_type_total,post_impressions_unique");
    }

    public function getFacebookPagePostComments($post_id)
    {
        return Http::get($this->completeUrl."/{$post_id}/comments?access_token={$this->user->getToken()}&summary=total_count");
    }

    public function getFacebookPageInfo()
    {
        return Http::get($this->completeUrl."/{$this->user->getId()}?fields=name,username,picture,engagement,fan_count,link&access_token={$this->user->getToken()}");
    }

    public function getInstagramBusinessAccount()
    {
        return Http::get($this->completeUrl."/{$this->user->getId()}?fields=instagram_business_account&access_token={$this->user->getToken()}");
    }

    public function getInstagramAccounts()
    {
        return Http::get($this->completeUrl."/{$this->user->getId()}/instagram_accounts?access_token={$this->user->getToken()}");
    }

	
}