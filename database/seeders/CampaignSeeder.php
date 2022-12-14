<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('audiences')->insert(
            [
                'id'=>1,
                'category_id'=>1,
                'brand_id'=>3,
                'influencer_size'=>'micro',
                'audience_gender'=>'m',
                'audience_age'=>'18-55',
                'audience_location'=>'["BR"]',
                'audience_language'=>'["pt_BR"]',
                'audience_name'=>'Audience One',
            ]
        );
        DB::table('audiences')->insert(
            [
                'id'=>2,
                'category_id'=>1,
                'brand_id'=>3,
                'influencer_size'=>'medium',
                'audience_gender'=>'f',
                'audience_age'=>'30-60',
                'audience_location'=>'["US"]',
                'audience_language'=>'["eng"]',
                'audience_name'=>'Audience Two',
            ]
        );

        DB::table('campaigns')->insert(
            [
                'id'=>1,
                'brand_id'=>3,
                'name'=>'Campanha1',
                'type'=>'paid',
                'goal'=>'awareness',
                'audience_id'=>1,
                'social_platform_instagram'=>true,
                'social_platform_facebook'=>true,
                'format'=>'video',
                'format_type_feed'=>true,
                'format_type_story'=>true,
                'style'=>'fun',
                'goal_description'=>'aaa',
                'url'=>'https://www.google.com',
                'budget'=>100000,
                'datetime'=>'2021-04-07 04:00:00',
                'paid'=>1,
                'clickmeter_group_id'=>11100939,
                'manual_select_influencers'=>1,
            ]
        );

        DB::table('users_campaigns')->insert(
            [
                'user_id'=>6,
                'campaign_id'=>1,
                'brand_accept'=>0,
                'influencer_accept'=>1,
                'value'=>100,
                'tracking_link_id'=>386852155,
                'tracking_link_url'=>'http://httpslink.com/InfluencifyTest16',
            ]
        );
        DB::table('users_campaigns')->insert(
            [
                'user_id'=>1,
                'campaign_id'=>1,
                'brand_accept'=>0,
                'influencer_accept'=>1,
                'value'=>100,
            ]
        );
        DB::table('users_campaigns')->insert(
            [
                'user_id'=>2,
                'campaign_id'=>1,
                'brand_accept'=>0,
                'influencer_accept'=>1,
                'value'=>100,
            ]
        );

        DB::table('campaigns')->insert(
            [
                'id'=>2,
                'brand_id'=>3,
                'name'=>'Campanha2',
                'type'=>'trade',
                'goal'=>'awareness',
                'audience_id'=>2,
                'social_platform_instagram'=>true,
                'social_platform_facebook'=>false,
                'format'=>'video',
                'format_type_feed'=>false,
                'format_type_story'=>true,
                'style'=>'fun',
                'goal_description'=>'bbbb',
                'url'=>'https://www.google.com',
                'budget'=>200000,
                'datetime'=>'2021-04-07 04:00:00',
                'paid'=>1,
                'clickmeter_group_id'=>11100941,
            ]
        );

        DB::table('users_campaigns')->insert(
            [
                'user_id'=>1,
                'campaign_id'=>2,
                'brand_accept'=>1,
                'influencer_accept'=>1,
                'value'=>100,
                'tracking_link_id'=>386852157,
                'tracking_link_url'=>'http://httpslink.com/InfluencifyTest21',
            ]
        );
        DB::table('users_campaigns')->insert(
            [
                'user_id'=>2,
                'campaign_id'=>2,
                'brand_accept'=>1,
                'influencer_accept'=>1,
                'value'=>100,
                'tracking_link_id'=>386852159,
                'tracking_link_url'=>'http://httpslink.com/InfluencifyTest22',
            ]
        );

        DB::table('campaigns')->insert(
            [
                'id'=>3,
                'brand_id'=>3,
                'name'=>'Campanha3',
                'type'=>'trade',
                'goal'=>'awareness',
                'audience_id'=>2,
                'social_platform_instagram'=>true,
                'social_platform_facebook'=>false,
                'format'=>'video',
                'format_type_feed'=>true,
                'format_type_story'=>false,
                'style'=>'fun',
                'goal_description'=>'cccc',
                'url'=>'https://www.google.com',
                'budget'=>300000,
                'datetime'=>'2021-04-07 04:00:00',
                'paid'=>1,
                'clickmeter_group_id'=>11100943,
            ]
        );

        DB::table('users_campaigns')->insert(
            [
                'user_id'=>1,
                'campaign_id'=>3,
                'brand_accept'=>1,
                'influencer_accept'=>1,
                'value'=>100,
                'tracking_link_id'=>386852163,
                'tracking_link_url'=>'http://httpslink.com/InfluencifyTest31',
            ]
        );
        DB::table('users_campaigns')->insert(
            [
                'user_id'=>2,
                'campaign_id'=>3,
                'brand_accept'=>1,
                'influencer_accept'=>1,
                'value'=>100,
                'tracking_link_id'=>386852167,
                'tracking_link_url'=>'http://httpslink.com/InfluencifyTest32',
            ]
        );

        DB::table('campaigns')->insert(
            [
                'id'=>4,
                'brand_id'=>3,
                'name'=>'Campanha4',
                'type'=>'trade',
                'goal'=>'awareness',
                'audience_id'=>2,
                'social_platform_instagram'=>true,
                'social_platform_facebook'=>false,
                'format'=>'video',
                'format_type_feed'=>true,
                'format_type_story'=>false,
                'style'=>'fun',
                'goal_description'=>'dddd',
                'url'=>'https://www.google.com',
                'budget'=>400000,
                'datetime'=>'2021-04-07 04:00:00',
                'paid'=>1,
                'clickmeter_group_id'=>11100945,
            ]
        );

        DB::table('users_campaigns')->insert(
            [
                'user_id'=>1,
                'campaign_id'=>4,
                'brand_accept'=>1,
                'influencer_accept'=>1,
                'value'=>100,
                'tracking_link_id'=>386852169,
                'tracking_link_url'=>'http://httpslink.com/InfluencifyTest41',
            ]
        );
        DB::table('users_campaigns')->insert(
            [
                'user_id'=>2,
                'campaign_id'=>4,
                'brand_accept'=>1,
                'influencer_accept'=>1,
                'value'=>100,
                'tracking_link_id'=>386852171,
                'tracking_link_url'=>'http://httpslink.com/InfluencifyTest42',
            ]
        );
    }
}
