<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creates Pedro Lucas User linked with facebook/instagram and stripe account linked and active
        DB::table('users')->insert(
            [
            'id' => 1,
            'name' => 'Pedro',
            'email'=>'plgs2005@gmail.com',
            'email_verified_at'=>'2020-10-07 14:04:12',
            'password'=>'$2y$10$9idQgxco.8hYLrMIZzK9n.TdqWzMu7FcCUJ13ka4Updc5Z6mmbn6G',//=123
            'phone'=>'+55 11 950903204',
            'stripe_acc'=>'acct_1IEbK2QWfrgwOZdZ',
            'profile_completed'=>1,
            ]
        );
        DB::table('model_has_roles')->insert(
            [
            'role_id'=>3,
            'model_type'=>'App\Influencer\User\User',
            'model_id'=>1
            ]
        );
        DB::table('model_has_roles')->insert(
            [
            'role_id'=>1,
            'model_type'=>'App\Influencer\User\User',
            'model_id'=>1
            ]
        );
        DB::table('social_medias')->insert(
            [
                'user_id'=>1,
                'social_media'=>'facebook',
                'media_user_id'=>3640936975964858,
                'token'=>'EAADiU5AGMcIBAHXROkuOsKaCvzZAim5nqPqSzUzUKdlTRGZAg4yprH5p3RPaQf44jrzlPd0SlS9ZAZCcKGBTBCBXO0clYeGgDp2ifVosOyaJlseOIWjyMq02ZB4ZBiNqZA6JEO0IERBySYca96rnr5tf2ZCSv3QWu4r3vR14Eez6VAZDZD',

            ]
        );
        DB::table('social_medias')->insert(
            [
                'user_id'=>1,
                'social_media'=>'facebook_page',
                'media_user_id'=>100601158352025,
                'token'=>'EAADiU5AGMcIBAHEs0BwJRoUn2HoMfhvJM21GwLzvoWWQbjSkEKLwfW1Yl4ekZB3znXHgCTL5km8ZADPrhnu12NmvXIJlabI1RkA6k0XjnhUPjUxgJ3JafwcS0M3cOVi9JZCOhCI4ayXogW33NrR4F4jnQ7ZAmqLJEFLtYgr6kAZDZD',
                'url'=>'https://www.facebook.com/100601158352025',

            ]
        );
        DB::table('social_medias')->insert(
            [
                'user_id'=>1,
                'social_media'=>'instagram_business',
                'media_user_id'=>17841405567913436,
                'media_username'=>'raphaelvoltani',
                'profile_picture_url'=>'https://scontent.fbfh4-1.fna.fbcdn.net/v/t51.2885-15/18812048_134336060467187_5578166566127665152_a.jpg?_nc_cat=100&ccb=1-3&_nc_sid=86c713&_nc_eui2=AeHU9L31LOLB7lyuThU1i0Yt0SBPMSjki93RIE8xKOSL3bntc61vwVpDcVFQ-gNGfrjcOTQR_x1NXFxxDonFlQVK&_nc_ohc=b5ZSTxpS8T4AX92BcPP&_nc_ht=scontent.fbfh4-1.fna&oh=9343f0ca608ea9186bf85c0be666383a&oe=60B86256',
                'token'=>'EAADiU5AGMcIBAHEs0BwJRoUn2HoMfhvJM21GwLzvoWWQbjSkEKLwfW1Yl4ekZB3znXHgCTL5km8ZADPrhnu12NmvXIJlabI1RkA6k0XjnhUPjUxgJ3JafwcS0M3cOVi9JZCOhCI4ayXogW33NrR4F4jnQ7ZAmqLJEFLtYgr6kAZDZD',
                'url' =>'https://instagram.com/raphaelvoltani',
                'followers' => 176,

            ]
        );
        DB::table('user_status')->insert(
            [
                'user_id'=>1,
                'status'=>'get_initial_data',
            ]
        );

        //Creates Juliano User
        DB::table('users')->insert(
            [
            'id' => 2,
            'name' => 'Juliano',
            'email'=>'juliano@email.com',
            'email_verified_at'=>'2020-10-07 14:04:12',
            'password'=>'$2y$10$9idQgxco.8hYLrMIZzK9n.TdqWzMu7FcCUJ13ka4Updc5Z6mmbn6G',//=123
            'phone'=>'+55 41 998816440',
            'stripe_acc'=>'acct_1IBKn8QgzCFsELS1',
            ]
        );
        DB::table('model_has_roles')->insert(
            [
            'role_id'=>3,
            'model_type'=>'App\Influencer\User\User',
            'model_id'=>2
            ]
        );
        DB::table('model_has_roles')->insert(
            [
            'role_id'=>1,
            'model_type'=>'App\Influencer\User\User',
            'model_id'=>2
            ]
        );
        DB::table('social_medias')->insert(
            [
                'user_id'=>2,
                'social_media'=>'facebook',
                'media_user_id'=>10158376676201293,
                'token'=>'EAADiU5AGMcIBAPEHbZAZCHFRpVSs38NhTbyfvCSMEzpvnsplP5ujHeagoYfUh4LzS4qHQSJAvfALiPiZBqxoHCs3GXl0CpWHtylYoIIKJzGJT2YhYZCHYgiknWn8jyAPXmk5lAbiWK87ViVv2486X0S5EVmDCazBX8dtjOexOgZDZD',

            ]
        );
        DB::table('social_medias')->insert(
            [
                'user_id'=>2,
                'social_media'=>'facebook_page',
                'media_user_id'=>352765585206588,
                'token'=>'EAADiU5AGMcIBALExD5y1mFZCiXo0e4naU4iZCLGdXButcc9hUP0ZAIpTHnZBqTTJceqbge6Ts3T7dgd60cLv7cxdcTQeXgbGZAB3nCKeT0LcpRLAKNkSfTj5raSyd5NBHRE0qBbqx6uhkRvKOCqGDNNvL3FIoZCQeBOetmpvmJQQZDZD',
                'url'=>'https://www.facebook.com/352765585206588',

            ]
        );
        DB::table('social_medias')->insert(
            [
                'user_id'=>2,
                'social_media'=>'instagram_business',
                'media_user_id'=>17841407059241142,
                'media_username'=>'julianogoulart.me',
                'profile_picture_url'=>'https://scontent.fbfh4-1.fna.fbcdn.net/v/t51.2885-15/94298555_1102600283459318_6438343142788825088_n.jpg?_nc_cat=111&ccb=1-3&_nc_sid=86c713&_nc_ohc=41X8bxQ4iBwAX-nkI5O&_nc_ht=scontent.fbfh4-1.fna&oh=59ac91a729408bf3b9a7ad52bb173832&oe=60B69755',
                'token'=>'EAADiU5AGMcIBALExD5y1mFZCiXo0e4naU4iZCLGdXButcc9hUP0ZAIpTHnZBqTTJceqbge6Ts3T7dgd60cLv7cxdcTQeXgbGZAB3nCKeT0LcpRLAKNkSfTj5raSyd5NBHRE0qBbqx6uhkRvKOCqGDNNvL3FIoZCQeBOetmpvmJQQZDZD',
                'url'=>'https://www.instagram.com/julianogoulart.me',
                'followers' => 15128,

            ]
        );
        DB::table('user_status')->insert(
            [
                'user_id'=>2,
                'status'=>'get_initial_data',
            ]
        );


        //Creates Brand1 user with stripe customer account linked and with cards saved on account
        DB::table('users')->insert(
            [
            'id' => 3,
            'name'=>'Fulano',
            'brand_name' => 'Brand1',
            'email'=>'brand1@email.com',
            'email_verified_at'=>'2020-10-07 14:04:12',
            'password'=>'$2y$10$9idQgxco.8hYLrMIZzK9n.TdqWzMu7FcCUJ13ka4Updc5Z6mmbn6G',//=123
            'phone'=>'+55 41 998816440',
            'stripe_cus_id'=>'cus_IqI3AvMOientlD',
            'phone'=>'41 998816440',
            ]
        );
        DB::table('model_has_roles')->insert(
            [
            'role_id'=>2,
            'model_type'=>'App\Influencer\User\User',
            'model_id'=>3
            ]
        );

        //Creates Brand2 user
        DB::table('users')->insert(
            [
            'id' => 4,
            'brand_name' => 'Brand2',
            'email'=>'brand2@email.com',
            'email_verified_at'=>'2020-10-07 14:04:12',
            'password'=>'$2y$10$9idQgxco.8hYLrMIZzK9n.TdqWzMu7FcCUJ13ka4Updc5Z6mmbn6G',//=123
            'phone'=>'+55 41 998816440',
            ]
        );
        DB::table('model_has_roles')->insert(
            [
            'role_id'=>2,
            'model_type'=>'App\Influencer\User\User',
            'model_id'=>4
            ]
        );

        //Inserts influencer1 user
        DB::table('users')->insert(
            [
            'id' => 5,
            'name' => 'Fulano',
            'email'=>'influencer1@gmail.com',
            'email_verified_at'=>'2020-10-07 14:04:12',
            'password'=>'$2y$10$9idQgxco.8hYLrMIZzK9n.TdqWzMu7FcCUJ13ka4Updc5Z6mmbn6G',//=123
            'phone'=>'+55 41 998816440',
            ]
        );
        DB::table('model_has_roles')->insert(
            [
            'role_id'=>3,
            'model_type'=>'App\Influencer\User\User',
            'model_id'=>5
            ]
        );

        //Creates Pedro Lucas 2 user
        DB::table('users')->insert(
            [
            'id' => 6,
            'name' => 'raphael2',
            'email'=>'raphael_voltani@hotmail.com',
            'email_verified_at'=>'2020-10-07 14:04:12',
            'password'=>'$2y$10$9idQgxco.8hYLrMIZzK9n.TdqWzMu7FcCUJ13ka4Updc5Z6mmbn6G',//=123
            'phone'=>'+55 41 998816440',
            ]
        );
        DB::table('model_has_roles')->insert(
            [
            'role_id'=>3,
            'model_type'=>'App\Influencer\User\User',
            'model_id'=>6
            ]
        );
        DB::table('model_has_roles')->insert(
            [
            'role_id'=>1,
            'model_type'=>'App\Influencer\User\User',
            'model_id'=>6
            ]
        );
        DB::table('social_medias')->insert(
            [
                'user_id'=>6,
                'social_media'=>'facebook',
                'media_user_id'=>104738578150556,
                'token'=>'EAADiU5AGMcIBACQXD1sth4NcZCvcZBeVdtSTebNcS0TWZCI6zHIrD2ypPoL48yGyjzoP2sq20LXYwjO1l31kCl7CjibsVGZARZB1BzSIZAcOfu2ZCKGFMNRKnw4ERWb6Dkfv6KZCnLJDIbLlg04AckXagbYo1oWsE4iaSDE1bMlyWDJzBniTCDLh',

            ]
        );
        DB::table('social_medias')->insert(
            [
                'user_id'=>6,
                'social_media'=>'facebook_page',
                'media_user_id'=>104995538122002,
                'token'=>'EAADiU5AGMcIBAGtSKDc26Xzfc9yS6Y1JRq4gVdv0hZCvCq60Nc5FtNCSHPgtfqq19622AelCCtFfR6ZAZCbBIjsGS4PZBCQfT6ZCYSVc3K6Co919f2ZB9b8awWVr3QYkGfzk0dteGkyiuhEftJvwuhXkh0ZAe8EicFfPvxrMZBJRwVNrjUoym7Ip6Qj5kNsZALKwZD',
                'url'=>'https://www.facebook.com/104995538122002',

            ]
        );
        DB::table('social_medias')->insert(
            [
                'user_id'=>6,
                'social_media'=>'instagram_business',
                'media_user_id'=>17841442706695405,
                'media_username'=>'raphavolt2',
                'token'=>'EAADiU5AGMcIBAGtSKDc26Xzfc9yS6Y1JRq4gVdv0hZCvCq60Nc5FtNCSHPgtfqq19622AelCCtFfR6ZAZCbBIjsGS4PZBCQfT6ZCYSVc3K6Co919f2ZB9b8awWVr3QYkGfzk0dteGkyiuhEftJvwuhXkh0ZAe8EicFfPvxrMZBJRwVNrjUoym7Ip6Qj5kNsZALKwZD',
                'url'=>'https://www.instagram.com/raphavolt2',
                'followers' => 1,

            ]
        );
        DB::table('user_status')->insert(
            [
                'user_id'=>6,
                'status'=>'get_initial_data',
            ]
        );

    }
}
