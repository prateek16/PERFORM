




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@section('title')
            Tech4i2::Welcome::
        @show</title>

    @section('header')

        {{ HTML::style('css/login.css') }}
    @show


</head>


<body>

<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser.
    Please <a href="http://browsehappy.com/">upgrade your browser</a> or
    <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->








            {{ $content }}




    <div class="container1">
        @if(Session::has('message'))
                <p class="alert" style="color: rgb(29, 91, 157);">{{ Session::get('message') }}</p>
        @endif
    </div>


    <!-- Scripts are placed here -->






</body>


</html>