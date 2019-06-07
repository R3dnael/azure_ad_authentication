<?php
class curllcall
{
    /**
        *Make the curl call for an bearer-token to be able to make graph-calls
     *        *
     */
    public function POSTcall($curlurl,$curlopt){
        if (!function_exists('curl_init')) {
            die('Sorry cURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curlurl);
        //set vars
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlopt);
        // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // Should cURL return or print out the data? (true = return, false = print)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return json_decode($server_output, true);
    }

    /**
     * Make a GET call to the graph-endpoint
     * @param $curlurl
     * @param $bearer
     * @return bool|string
     */
    public function GETcall($curlurl,$bearer)
    {
        if (!function_exists('curl_init')) {
            die('Sorry cURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$curlurl");
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . $bearer)
        );
        // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // Should cURL return or print out the data? (true = return, false = print)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        // Download the given URL, and return output
        $output = curl_exec($ch);
        // Close the cURL resource, and free system resources
        curl_close($ch);
        //antwoord omvormen
        return $output;
    }
}