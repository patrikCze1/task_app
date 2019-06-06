@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Contact page &#9742;</h1>
        <div class="panel-info">

            <div class="text-info contact-left">
                <h3>Address</h3>
                <p>City 2</p>
                <p>Abc 12</p>
                <p>USA, NY</p>
                <h3>Coordinates</h3>
                <p>40.7098916</p>
                <p>-74.0078291</p>

            </div>
            <div class="text-info contact-right">
                <h3>Owner</h3>
                <p>name: Adam Smith</p>
                <p>mail: contact@apptask.com</p>
                <p>phone: 333 221 456 898</p>
                <img src="/storage/img/task_profile.png" width="180" height="150">
            </div>
            <a href="https://www.google.cz/maps/@40.7098916,-74.0078291,17z">
            <img src="/storage/img/map.png" width="100%"></a>
        </div>
    </div>
@endsection
