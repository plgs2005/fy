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

use App\Influencer\SocialMedia\SocialMedia;

use App\Influencer\Dados\DadosPost\DadosPost;
use App\Influencer\Dados\Audiencia\Audiencia;

use App\Influencer\Post\Post;

class ModeloController extends Controller
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

    public function load_my_data(Request $request)
    {
        $user = $request->user();
        $instagramUser = InstagramBusinessUser::make($user);
        $api = new InstagramAPI($instagramUser);

        $this->loadLastMedias($api, $user->id);
        $this->loadUserInsight($api);
    }

    private function loadLastMedias($api, $userId)
    {
        $social_media = SocialMedia::where('user_id', $userId)->where('social_media', 'instagram_business')->first();

        $data = $api->getInstagramMedias();
        $dados = $data->json();

        for ($i=0; $i<5; $i++) {
            if(!isset($dados['data'])) continue;

            $id_post = $dados['data'][$i]['id'];

            $mediaInfo = $api->getInstagramMediaInfo($id_post)->json();
            if (!$post = Post::where('post_id', $id_post)->first()) {

                $post = new Post();
                $post->post_id = $id_post;
                $post->social_media_id = $social_media->id;
                $post->timestamp = $mediaInfo['timestamp'];
                $post->permalink = $mediaInfo['permalink'];
                $post->type = $mediaInfo['media_type'];
                $post->save();

            }
            foreach (["comments_count", "like_count", "media_url"] as $tipo_dado) {
                $dado = $mediaInfo[$tipo_dado];
                $dp = new DadosPost();
                $dp->tabela_id = $post->id;
                $dp->tipo = $tipo_dado;
                $dp->valor = $dado;
                if (true) {
                    $dp->save();
                }
            }

            $mediaInsight = $api->getInstagramMedia($id_post)->json();
            if (isset($mediaInsight['error'])) {
                continue;
            }
            foreach ($mediaInsight['data'] as $insight) {
                $dp = new DadosPost();
                $dp->traduzirDados($post->id, $insight);
                if (true) {
                    $dp->save();
                }
            }
        }

        return true;
    }

    private function loadUserInsight($api)
    {
        $userAudience = $api->getInstagramAudience()->json();

        foreach ($userAudience['data'] as $dataToProcess) {
            echo "{$dataToProcess['name']} - {$dataToProcess['title']}<br><br>";
            $dados = $dataToProcess['values'][0]['value'];

            switch ($dataToProcess['name']) {
                case 'audience_gender_age':
                    $genderAge = $this->processGenderAgeData($dados);
                    $this->saveGenderAgeData($genderAge);
                    break;

                case 'audience_country':
                    $country = $this->processCountryData($dados);
                    $this->saveCountryData($country);
                    break;
                    
                case 'audience_city':
                    $city = $this->processCityData($dados);
                    $this->saveCityData($city);
                    break;

                default:
                    break;
            }
        }

        return true;
    }

    public function put_infos(Request $request)
    {
        // [caption, comments_count, like_count, media_type, media_url, permalink, timestamp, id]
        // 'Post Type' => 'POS-TYP','Media Url' => 'POS-MURL','Caption' => 'POS-CAPT',
        // 'Like Count' => 'POS-LIKE','Comments Count' => 'POS-COMM',
        // 'Permalink' => 'POS-LINK','Timestamp' => 'POS-TIME'
        
        // [error][code, error_user_title, error_user_msg] => quando não tem a informação
        // [data][0,1,2,3][name, period, values[0][value], title, description, id] => quando tem info disponível
    }

    private function processGenderAgeData($dados)
    {
        $retorno = ['sex' => [], 'age' => []];
        foreach ($dados as $key => $value)
        {
            $xxx = explode('.', $key);
            if (!isset($retorno['sex'][$xxx[0]])) $retorno['sex'][$xxx[0]] = 0;
            if (!isset($retorno['age'][$xxx[1]])) $retorno['age'][$xxx[1]] = 0;
            $retorno['sex'][$xxx[0]] += $value;
            $retorno['age'][$xxx[1]] += $value;
        }
        
        return $retorno;
    }

    private function saveGenderAgeData($genderAge)
    {
        foreach ($genderAge as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $aud = new Audiencia();
                // TODO: passando o id do usuário no código
                $aud->traduzirDados(3, $key, $key2, $value2);
                if (true) {
                    $aud->save();
                }
            }
        }
    }

    private function processCountryData($dados)
    {
        return $dados;
    }

    private function saveCountryData($country)
    {
        foreach ($country as $key => $value) {
            $aud = new Audiencia();
            // TODO: passando o id do usuário no código
            $aud->traduzirDados(3, 'country', $key, $value);
            if (true) {
                $aud->save();
            }
        }

    }

    private function processCityData($dados)
    {
        return $dados;
    }

    private function saveCityData($city)
    {
        foreach ($city as $key => $value) {
            $aud = new Audiencia();
            // TODO: passando o id do usuário no código
            $aud->traduzirDados(3, 'city', $key, $value);
            if (true) {
                $aud->save();
            }
        }

    }

    public function check_infos(Request $request)
    {
        $user = $request->user();

        $data['data'] = [];

        $data['data']['relacionamento'] = Relacionamento::where(
            'id_recurso_pai', $user->id
        )->get()->toArray();
        $arr = [];
        foreach ($data['data']['relacionamento'] as $rel) {
            $arr[] = $rel['id_recurso_filho'];
        }
        $data['data']['posts'] = Recursos::whereIn('id', $arr)->where('c_modelo', 'POS')->get()->toArray();
        
        return view('check_infos')->with($data);
    }
}
