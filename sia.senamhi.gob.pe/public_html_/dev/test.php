<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "http://google.com");
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = json_decode(curl_exec($ch));
        
        echo curl_errno($ch);
        echo curl_error($ch);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_close($ch);
        
        print($result);
?>