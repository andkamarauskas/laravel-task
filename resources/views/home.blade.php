@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <button id="add-device-btn" class="btn btn-block btn-success">Add Device</button>
            <div id="add-device-form">
                <p><h3 class="text-center"><strong>Add New Device</strong></h3></p>
                <form class="form-horizontal" method="POST" action="{{ route('device.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('device_id') ? ' has-error' : '' }}">
                        <label for="device_id" class="col-md-4 control-label">Device Id</label>

                        <div class="col-md-6">
                            <input id="device_id" type="text" class="form-control" name="device_id" value="{{ old('device_id') }}" required autofocus>

                            @if ($errors->has('device_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('device_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('geo') ? ' has-error' : '' }}">
                        <label for="geo" class="col-md-4 control-label">Geo</label>

                        <div class="col-md-6">
                            <input id="geo" type="text" class="form-control" name="geo" value="{{ old('geo') }}" required autofocus>

                            @if ($errors->has('geo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('geo') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    

                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                        <label for="category" class="col-md-4 control-label">Category</label>

                        <div class="col-md-6">
                            <select id="category" class="form-control" name="category">
                                <option value="Home">Home</option>
                                <option value="Work">Work</option>
                            </select>

                            @if ($errors->has('category'))
                            <span class="help-block">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-block btn-primary">
                                Send
                            </button>
                        </div>
                    </div>
                </form>
            </div>


            <table class="table table-sm">
                <thead>
                    <tr>
                        <th class="col-md-6">Device Id</th>
                        <th class="col-md-6">Category</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(Auth::user()->devices as $device)
                    <tr>
                     <td>{{$device->device_id}}</td>
                     <td>{{$device->category}}</td> 
                 </tr>
                 @endforeach  
             </tbody>
         </table>
         <p>
             The biggest distance between <strong>{{$max_distance['device1']->device_id}}</strong> and <strong>{{$max_distance['device2']->device_id}}</strong> is <strong>{{$max_distance['distance']}}m</strong>
         </p>
         
     </div>

     <div class="col-md-9">
        <div style="width: 100%; height: 500px;">
            {!! Mapper::render() !!}
        </div>
    </div>
</div>
</div>
@endsection
