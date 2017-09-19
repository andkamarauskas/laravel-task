@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <a href="{{route('device.add')}}" class="btn btn-block btn-success">Add Device</a>
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

                        <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                            <label for="latitude" class="col-md-4 control-label">Latitude</label>

                            <div class="col-md-6">
                                <input id="latitude" type="text" class="form-control" name="latitude" value="{{ old('latitude') }}" required autofocus>

                                @if ($errors->has('latitude'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('latitude') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                            <label for="longitude" class="col-md-4 control-label">Longitude</label>

                            <div class="col-md-6">
                                <input id="longitude" type="text" class="form-control" name="longitude" value="{{ old('longitude') }}" required autofocus>

                                @if ($errors->has('longitude'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('longitude') }}</strong>
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
                    <table>
                        <tr>
                            <th class="col-md-6">Device Id</th>
                            <th class="col-md-6">Category</th>
                        </tr>
                            @foreach(Auth::user()->devices as $device)
                            <tr>
                               <td class="text-center">{{$device->device_id}}</td>
                               <td class="text-center">{{$device->category}}</td> 
                            </tr>
                            @endforeach  
                    </table>
        </div>

        <div class="col-md-9">
            <div style="width: 100%; height: 500px;">
                {!! Mapper::render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
