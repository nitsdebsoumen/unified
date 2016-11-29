<?php
class LangHelper extends AppHelper {
    function getStringBetween($str, $from, $to) {
        $sub = substr($str, strpos($str, $from) + strlen($from), strlen($str));
        $del = substr($sub, 0, strpos($sub, $to));
        $str = str_replace('define("', '', $str);
        $str = str_replace('","', '', $str);
        $str = str_replace($del, '', $str);
        $str = str_replace('");', '', $str);
        return $str;
    }
    
}
?>