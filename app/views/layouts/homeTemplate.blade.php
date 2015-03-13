<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@section('title')
            Tech4i2--Project Dashboard---
        @show</title>

    @section('header')


        {{ HTML::style('css/dashboard.css') }}
        {{ HTML::style('css/topLevel.css') }}
        {{ HTML::script('js/popup.js') }}


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


<!-- Container -->




            {{ $content}}










<div class="container1">
    @if(Session::has('message'))
        <p class="alert">{{ Session::get('message') }}</p>
    @endif
</div>


<!-- Scripts are placed here -->






</body>



</html>