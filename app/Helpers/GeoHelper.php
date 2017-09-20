<?php

namespace App\Helpers;

class GeoHelper {

    public static function get_address_from_geo($latitude,$longitude) {

    	$client = new \GuzzleHttp\Client();
            $res = $client->request('GET',
                'http://nominatim.openstreetmap.org/reverse?format=json&lat='
                .$latitude 
                .'&lon='
                .$longitude
                . '&zoom=18&addressdetails=1');
            $res = $res->getBody();
            $res = json_decode($res);
            $address = $res->display_name;

        return $address;   
    }
}