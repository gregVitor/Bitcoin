<?php

if (!function_exists('curRequest')) {
    /**
     * Create request curl
     *
     * @param string $domain
     * @param string $method
     * @return mixed
     */
    function curRequest(
        string $domain,
        string $method = "GET"
    ) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $domain,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_SSL_VERIFYPEER => false

        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
