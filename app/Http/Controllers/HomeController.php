<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;
use App\Device;
use Auth;
use GeoHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_devices = Auth::user()->devices;
        $user_devices_amount  = count($user_devices);
        if ($user_devices_amount > 0)
        {
            $device = Device::where('id',$user_devices->last()->id)->first();
            $latitude = $device->latitude;
            $longitude = $device->longitude;
            
            $address = GeoHelper::get_address_from_geo($latitude,$longitude);

            $map_content = 'Device id: ' . $device->device_id .'<br>'.
            'Address: ' . $address .'<br>'.
            'Category: ' . $device->category ;
            Mapper::map($latitude,$longitude)->informationWindow($latitude, $longitude,$map_content, ['markers' => ['animation' => 'DROP']]);

            if($user_devices_amount > 1)
            {
                $max_distance['distance'] = 0;
                $earthRadius = 6371000;
                for ($i=0; $i < $user_devices_amount; $i++) {

                    $latitudeFrom = $user_devices[$i]->latitude;
                    $longitudeFrom = $user_devices[$i]->longitude;

                    for ($z=$i; $z < $user_devices_amount; $z++) {

                        $latitudeTo = $user_devices[$z]->latitude;
                        $longitudeTo = $user_devices[$z]->longitude;

                        $latFrom = deg2rad($latitudeFrom);
                        $lonFrom = deg2rad($longitudeFrom);
                        $latTo = deg2rad($latitudeTo);
                        $lonTo = deg2rad($longitudeTo);

                        $latDelta = $latTo - $latFrom;
                        $lonDelta = $lonTo - $lonFrom;

                        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
                        $distance = $angle * $earthRadius;
                        // echo "i = " . $i . " " ."z=" . $z . "<br>";
                        if($distance > $max_distance['distance']){
                            $max_distance['device1'] = $user_devices[$i];
                            $max_distance['device2'] = $user_devices[$z];
                            $max_distance['distance'] = round($distance,2);
                        }

                    }
                }
                return view('home',['max_distance' => $max_distance]);
                
            }
        }else{
            Mapper::map(54.687157,25.279652);
        }       

        return view('home');
    }
}
