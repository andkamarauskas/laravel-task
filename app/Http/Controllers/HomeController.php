<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;
use App\Device;

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
    public function index(Request $request)
    {
        
        if ($request->id)
        {
            $device = Device::where('id',$request->id)->first();
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
        }else{
            Mapper::map(54.687157,25.279652);
        }       

        return view('home');
    }
}
