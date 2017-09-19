<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;
use App\Device;
use Auth;

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
        if (count($user_devices) > 0)
        {
            $device = Device::where('id',$user_devices->last()->id)->first();
            $latitude = $device->latitude;
            $longitude = $device->longitude;
            
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

            $map_content = 'Device id: ' . $device->device_id .'<br>'.
            'Address: ' . $address .'<br>'.
            'Category: ' . $device->category ;
            Mapper::map($latitude,$longitude)->informationWindow($latitude, $longitude,$map_content, ['markers' => ['animation' => 'DROP']]);

            if(count($user_devices) > 1)
            {
                $max_distance['distance'] = 0;
                $earthRadius = 6371000;
                for ($i=0; $i < count($user_devices); $i++) {
                    $latitudeFrom = $user_devices[$i]->latitude;
                    $longitudeFrom = $user_devices[$i]->longitude;
                    for ($z=0; $z < count($user_devices); $z++) {
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
