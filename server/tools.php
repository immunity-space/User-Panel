<?php

function RandomString()
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring .= $characters[rand(0, strlen($characters) - 1)]; // Concatenate characters
    }
    return $randstring;
}
?>
