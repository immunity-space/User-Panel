<?php

function randomCode($int)
    {
    $characters =
        '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $int; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}
function detect()
    {
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if ((substr($_SERVER['HTTP_USER_AGENT'], 0, 6) == "Opera/") || (strpos($userAgent, 'opera')) != false) {
            $name = true;
        } elseif ((strpos($userAgent, 'chrome')) != false) {
            $name = true;
        } elseif ((strpos($userAgent, 'safari')) != false && (strpos($userAgent, 'chrome')) == false && (strpos($userAgent, 'chrome')) == false) {
            $name = true;
        } elseif (preg_match('/msie/', $userAgent)) {
            $name = true;
        } elseif ((strpos($userAgent, 'firefox')) != false) {
            $name = true;
        } else {
            $name = true;
        }
  

        return array(
            'isdtc' => $name,
        );
    }

?>