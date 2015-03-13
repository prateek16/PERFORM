<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>@section('title')
            Tech4i2--Project Dashboard---
        @show</title>

    @section('header')
        {{ HTML::style('css/dashboard.css') }}
        {{ HTML::style('css/topLevel.css') }}
        {{ HTML::style('css/programLevel.css') }}
        {{ HTML::style('css/projectLevel.css') }}
    @show

    <style>
        @section('styles')

        @show
    </style>
</head>


<body>

<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->









            {{ $content}}











<div class="container1">
    @if(Session::has('message'))
        <p class="alert">{{ Session::get('message') }}</p>
    @endif
</div>


<!-- Scripts are placed here -->



{{--{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js') }}--}}
{{ HTML::script('js/formalize.js') }}
{{ HTML::script('js/gallery.js') }}

</body>


</html>