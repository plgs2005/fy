<?php

namespace App\Infrastructure\API\SocialMedia\Facebook;

use App\Influencer\SocialMedia\InstagramBusiness\User as InstagramUser;

use Http;
use Carbon\Carbon;

class Instagram extends API
{
    public function getInstagramAccountInsights()
    {
        //If since and until are not passed api returns data for the last 2 days by default
        //return Http::get($this->completeUrl."/{$this->user->getId()}/insights?access_token={$this->user->getToken()}&metric=impressions,reach&period=days_28");
        return Http::get($this->completeUrl."/{$this->user->getId()}/insights?metric=impressions,reach&period=week&since=1590710400&until=1593302400&access_token={$this->user->getToken()}");
    }

    public function getInstagramTags()
    {
        return Http::get($this->completeUrl."/{$this->user->getId()}/tags?access_token={$this->user->getToken()}");
    }

    public function getInstagramUser()
    {
        return Http::get($this->completeUrl."/{$this->user->getId()}?access_token={$this->user->getToken()}&fields=media_count,follows_count,followers_count,id,ig_id,username,website,name,profile_picture_url");
    }

    /**
     * 
     */
    public function getInstagramAudience($days = null)
    {
        $metrics = "audience_gender_age,audience_country,audience_city,audience_locale";
        $period = "lifetime";

        if (!is_null($days) AND $days != 0) {
            if ($days >30) {
                $days = 30; 
            }
            
            $today = Carbon::today();
            $until = Carbon::today()->format('U');
            $since = $today->subDays($days)->format('U');
            
            $metrics = "follower_count,impressions,profile_views,reach,website_clicks";
            $period = "day&since={$since}&until={$until}";
            dump($period);
            dump($this->completeUrl."/{$this->user->getId()}/insights?access_token={$this->user->getToken()}&metric={$metrics}&period={$period}");
        }

        return Http::get($this->completeUrl."/{$this->user->getId()}/insights?access_token={$this->user->getToken()}&metric={$metrics}&period={$period}");
    }

    public function getInstagramMedias($next = null)
    {
        if ($next == null) {
            return Http::get($this->completeUrl."/{$this->user->getId()}/media?access_token={$this->user->getToken()}");
        } else {
            return Http::get($next);
        }
    }

    public function getInstagramStories()
    {
        return Http::get($this->completeUrl."/{$this->user->getId()}/stories?access_token={$this->user->getToken()}");
    }

    public function getInstagramStory($storyId)
    {
        return Http::get($this->completeUrl."/{$storyId}/insights?metric=impressions,reach,taps_back,taps_forward,exits,replies&access_token={$this->user->getToken()}");
    }

    public function getInstagramMedia($mediaId)
    {
        return Http::get($this->completeUrl."/{$mediaId}/insights?metric=impressions,reach,engagement,saved&access_token={$this->user->getToken()}");
    }

    public function getInstagramMediaInfo($mediaId)
    {
        return Http::get($this->completeUrl."/{$mediaId}?fields=caption,comments_count,like_count,media_type,media_url,permalink,timestamp&access_token={$this->user->getToken()}");
    }

    public function getPost($url)
    {
        $username = $this->user->getUsername();
        $res = Http::get($this->completeUrl."/{$this->user->getId()}?fields=business_discovery.username($username){media{media_url,media_type,timestamp,caption,permalink,id}}&access_token={$this->user->getToken()}")->Json();

        foreach ($res['business_discovery']['media']['data'] as $post) {
            if ($post['permalink'] == $url) {
                return $post;
            } else {
                return false;
            }
        }
    }

    //Varre o perfil instagram do usuário logado ou do username informado.
    //Ao informar um username apenas retorna dados se for um perfil publico do instagram
    //Calcula com base em todas as postagens ou no periodo informado (Ex ultimos 60dias) o total e media de comentarios e likes e o engajamento.
    //Retorna os dados em um array.
    public function getInstagramUserMetrics($username = null, $period = null)
    {
        if (is_null($username)) {
            $username = $this->user->getUsername();
        }
        if (!is_null($period) AND $period != 0) {
            $today = Carbon::today();
            $periodEnd = $today->subDays($period);
        }
        
        $response = Http::get($this->completeUrl."/{$this->user->getId()}?fields=business_discovery.username($username){biography,followers_count,media_count,media{comments_count,like_count,media_url,media_type,timestamp,caption}}&access_token={$this->user->getToken()}");
        $followers = $response['business_discovery']['followers_count'];
        $biography = (isset($response['business_discovery']['biography'])) ? $response['business_discovery']['biography'] : null;

        $totalComments = 0;
        $totalLikes = 0;
        $hashtags = '';
        $count=0;
        $continue = true;

        while ($continue AND isset($response['business_discovery']['media']['paging']['cursors']['after'])) {
            if ($count > 0) {
                $after = $response['business_discovery']['media']['paging']['cursors']['after'];
                $response =  Http::get($this->completeUrl."/{$this->user->getId()}?fields=business_discovery.username($username){followers_count,media_count,media.after({$after}){comments_count,like_count,media_url,media_type,timestamp,caption}}&access_token={$this->user->getToken()}");
            }
            
            foreach ($response['business_discovery']['media']['data'] as $media) {
                if (isset($today)) {
                    $temp = new Carbon($media['timestamp']);
                    if ($temp->isBefore($periodEnd)) {
                        $continue = false;
                        break;
                    } 
                }
                if (isset($media['caption'])) {
                    $hashtags .= $this->captionHashtags($media['caption']);
                }
                $totalComments = $totalComments+$media['comments_count'];
                $totalLikes = $totalLikes+$media['like_count'];
                $count++;
            }
        }

        if($count>0) {
            $return['followers'] = $followers;
            $return['biography'] = $biography;
            $return['totalComments'] = $totalComments;
            $return['avgComments'] = $totalComments/$count;
            $return['totalLikes'] = $totalLikes;
            $return['avgLikes'] = $totalLikes/$count;
            $return['totalPosts'] = $count;
            $return['engagement'] = ((($totalComments+$totalLikes)/$count)/$followers)*100;
            $return['hashtags'] = $hashtags;

            return $return;
        } else {
            return 'No media found in the specified period';
        }
        
    }

    //Retorna uma string com todas as hashtags existentes na string de entrada
    public function captionHashtags($caption)
    {
        $temp = null;
        $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
        );
        //Retira acentos para que letras acentuadas nao sejam removidas na prox linha
        $caption = strtr($caption, $table);
        //Remove qualquer simbolo/emoji etc inclusive letras acentuadas
        $caption = preg_replace('/[\x00-\x1F\x80-\xFF]/', ' ', $caption);
        $firstPos = strpos($caption, '#');
        $lastPos = strrpos($caption, '#');

        //Verifica se existe # na string.
        if ($firstPos !== false) {
            //Se as duas posicoes forem iguais existe apenas 1 hashtag na string
            if ($firstPos === $lastPos) {
                $temp = strstr($caption, '#');
                if (strpos($temp, ' ') !== false) {
                    $temp = strstr($temp, ' ', true);
                } 
                //Existe mais de 1 hashtag na string 
            } else {
                $temp2 = explode(' ', $caption);

                foreach ($temp2 as $value) {
                    if (strpos($value, '#') !== false) {
                        $value = strstr($value, '#');
                        if (strpos($value, ' ') !== false) {
                            $value = strstr($value, ' ', true);
                        }
                        $temp .= $value;
                    }
                }
            }
        } else {
            return false;
        }
        return $temp;
    }

    //calcula o total e media de impressoes e alcance das ultimas 30 postagens.
    //Limitado a 30 pois sao muitas chamadas na api do instagram. Pelo menos 10seg para rodar a funcao.
    public function getInstagramUserImpressionsReach($period = null)
    {
        if (!is_null($period) AND $period != 0) {
            $today = Carbon::today();
            $periodEnd = $today->subDays($period);
        }

        $count = 0;
        $reach = 0;
        $impressions = 0;
        $continue = true;
        $medias = $this->getInstagramMedias()->Json();

        while ($continue AND isset($medias['paging']['next'])) {
            if ($count > 0) {
                $medias = Http::get($medias['paging']['next']);
            }

            foreach ($medias['data'] as $value) {
                $media = $this->getInstagramMedia($value['id'])->Json();
                
                if(isset($media['data'])) {
                    foreach ($media['data'] as $value2) {
                        if ($value2['name'] == 'impressions') {
                            $impressions = $impressions+$value2['values'][0]['value'];
                        }
                        if ($value2['name'] == 'reach') {
                            $reach = $reach+$value2['values'][0]['value'];
                        }
                    }
                }
                $count++;
                if ($count >= 30) {
                    $continue = false;
                    break;
                }
            }
        }

        $retorno['medias'] = $count;
        $retorno['reach'] = $reach;
        $retorno['avgReach'] = $reach/$count;
        $retorno['impressions'] = $impressions;
        $retorno['avgImpressions'] = $impressions/$count;

        return $retorno;
    }
}
