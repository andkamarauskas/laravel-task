<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('device.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'device_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'category' => 'required',
        ]);

        $device = new Device();
        $device->device_id = $request->device_id;
        $device->latitude = $request->latitude;
        $device->longitude = $request->longitude;
        $device->category = $request->category;
        $device->save();

        if($device->category == 'Work')
        {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET',
                'http://nominatim.openstreetmap.org/reverse?format=json&lat='
                .$device->latitude 
                .'&lon='
                . $device->longitude
                . '&zoom=18&addressdetails=1');
            $res = $res->getBody();
            $res = json_decode($res);
            $address = $res->display_name;

            Mail::send('emails.send', ['device_id' => $device->device_id, 'address' => $address], function($message) 
            {
               $name = "Name"; 
               $message->from('no-reply@xxxxx.com',$name); 
               $message->to('kroy.webxpert@gmail.com')->subject('Test Mail'); 
           });
        }

        return redirect()->route('home', ['id' => $device->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        //
    }
}
