<?php

namespace App\Infrastructure\Repository;

use App\Infrastructure\Repository\BaseRepository;
use App\Influencer\SocialMedia\SocialMedia;

class SocialMediaRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new SocialMedia);
    }

    public function fakeReturn()
    {
        return 'fake social media';
    }

    public function getSocialMediaFromUser($socialMedia, $userId)
    {
        return $this->model->where('social_media', $socialMedia)->where('user_id', $userId)->get();
    }

    public function getSocialMediaIdsfromUser($userId)
    {
        $res =  $this->model->where('user_id', $userId)->get();
        foreach ($res as $value) {
            $ar[] = $value->id;
        }
        return collect($ar);
    }

    public function insertIfNew($object)
    {
        $withoutToken = array_diff_key($object, ['token' => 0]);
        $sm = $this->model->where($withoutToken)->first();
        if (is_null($sm)) {
            $sm = SocialMedia::create($object);
        }

        return $sm;
    }

    public function getSocialMediaById($id)
    {
        return $this->model->where('id', $id)->get();
    }

    public function getFacebookPageSocialMedias()
    {
        return $this->model->where('social_media', 'facebook_page')->get();
    }
}
