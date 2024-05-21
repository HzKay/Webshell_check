<?php
    class handleApi
    {
        private function readApi ($url)
        {
            $client = curl_init($url);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
            $respone = curl_exec($client);
            $result = json_decode($respone);
            return $result;
        }

        
    }
?>