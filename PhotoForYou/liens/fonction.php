<?php
    function nospec ($cat){
        $i = 0;
        $Array = array('€', '#', '+', '*', "'", '"', '²', '&', '~', '"', '{', '(', '[', '|', '`', '^', ')', '}', '=', '}', '^', '$', '£', 
        '¤', '%', '*', ',', '?', ';', ':', '/', '!', '§', '>', '<');
        /* if (preg_match('[$Array]', $cat))
        {
            $i = 1;
            return $i;
        }
        else
        { */
            $string = str_replace(' ', '', $cat);
            $string = str_replace(array('ê', 'ë', 'é', 'è'), 'e', $cat);
            $string = str_replace(array('ù', 'µ', 'û', 'ü'), 'u', $cat);
            $string = str_replace(array('à', 'ä', 'â'), 'a', $cat);
            $string = str_replace(array('ô', 'ö', 'ò'), 'o', $cat);
            $string = str_replace(array('î', 'ï', 'ì', ), 'i', $cat);
            $string = str_replace(array('ÿ'), 'y', $cat);
            $string = str_replace(array('ç'), 'c', $cat);
            $string = str_replace(array('ñ'), 'n', $cat);
            return $string;
        //}
    }
?>