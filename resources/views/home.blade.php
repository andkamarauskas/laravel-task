@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <a href="{{route('device.add')}}" class="btn btn-block btn-success">Add Device</a>
        </div>
        <div class="col-md-9">
            <div style="width: 100%; height: 500px;">
                {!! Mapper::render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
