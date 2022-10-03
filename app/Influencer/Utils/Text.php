<?php

namespace App\Influencer\Utils;

class Text
{
    //Remove todos os acentos emojis e simbolos
    public static function removeAcentoSimbolo($caption)
    {
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
        //Retira acentos para que letras acentuadas nao sejam removidas ao remover simbolos
        $caption = strtr($caption, $table);
        //Remove simbolos e emojis;
        $caption = preg_replace('/[\x00-\x1F\x80-\xFF]/', ' ', $caption);

        return $caption;
    }

    // Retorna uma string com as hashtag encontradas
    public static function captionHashtags($caption)
    {
        $temp = null;
        $caption = \App\Influencer\Utils\Text::removeAcentoSimbolo($caption);

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


}