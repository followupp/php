<?php
/**
 * A PHP package for working with Followupp.co
 *
 * @package    Followupp
 * @author     Justin Velluppillai <justinv@followupp.co
 * @link       http://https://github.com/followupp/php
 * @license    MIT License
 */


class Followupp
{

    private static $api_key = '';

    public static function set_api_key ($apikey) {
        self::$api_key = $apikey;
    }


    public static function request($arguments = array())
    {

        // determine endpoint
        $endpoint = 'www.followupp.co/api/messages';

        // build payload
        $arguments['key'] = self::$api_key;

        // setup curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arguments));
        $response = curl_exec($ch);

        // catch errors
        if (curl_errno($ch)) {
            curl_close($ch);

            return false;
        } else {
            curl_close($ch);

            return json_decode($response);
        }
    }
}

