<?php

namespace App\Http\Controllers;

use App\Device;
use App\UserDevice;
use GeoHelper;
use Auth;
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
            'geo' => 'required',
            'category' => 'required',
        ]);

        $geo_string = $request->geo;
        $geo = explode(",", $geo_string);
        $latitude = floatval($geo[0]);
        $longitude = floatval($geo[1]);

        $device = new Device();
        $device->device_id = $request->device_id;
        $device->latitude = $latitude;
        $device->longitude = $longitude;
        $device->category = $request->category;
        $device->save();

        $userDevice = new UserDevice;
        $userDevice->user_id = Auth::user()->id;
        $userDevice->device_id = $device->id;
        $userDevice->save();

        if($device->category == 'Work')
        {
            $address = GeoHelper::get_address_from_geo($device->latitude ,$device->longitude);

            Mail::send('emails.send', ['device_id' => $device->device_id, 'address' => $address], function($message) 
            {
               $name = "Andrius"; 
               $message->from('no-reply@laravelapp.com',$name); 
               $message->to('robot@fromskynet.com')->subject('Device Info'); 
           });
        }

        return redirect()->route('home');
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
