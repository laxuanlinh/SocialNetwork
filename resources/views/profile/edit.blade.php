<?php
use Illuminate\Support\Facades\Session;
?>
@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form class="form-vertical" role="form" method="post" action="/profile/edit">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group {{ $errors->has('firstname') ? ' has-error':''}}">
                        <label for="first_name" class="control-label">First name</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" value="{{ Auth::user()->firstname ?: Request::old('firstname') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group {{ $errors->has('lastname') ? ' has-error':''}}">
                        <label for="last_name" class="control-label">Last name</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" value="{{ Auth::user()->lastname ?: Request::old('lastname') }}">
                    </div>
                </div>
            </div>
            <div class="form_group {{ $errors->has('location') ? ' has-error':''}}">
                <label for="location" class="control-label">Location</label>
                <input type="text" name="location" class="form-control" id="location" value="{{ Auth::user()->location ?: Request::old('location') }}">
            </div>
            <div class="form-group">
                <button tupe="submit" class="btn btn-default">Update</button>
            </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>
@stop
