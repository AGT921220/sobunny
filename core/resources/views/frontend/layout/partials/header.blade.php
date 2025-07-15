<!DOCTYPE html>
<html lang="{{get_user_lang()}}" dir="{{get_user_lang_direction()}}">

<head>
    {!! renderHeadStartHooks() !!}
    <meta name="google-site-verification" content="-sKH0SOWM14OAHDfC_PtF0i5cA2T2DjEYnteCMJ8o1o" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    


    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11560117755"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11560117755');
</script>

<title>Sobunny: Your Platform for Exclusive Escort Experiences</title>

<meta name="description" content="Exclusive luxury escort services in Miami, New York, Los Angeles, Las Vegas, Chicago, Washington DC, Atlanta, Boston, Austin, San Francisco, Philadelphia, Dallas. Find discreet dates and premium companions for unique experiences in these cities.">
<meta name="keywords" content="luxury escorts Miami, discreet dates New York, premium companions Los Angeles, luxury dates Las Vegas, escort agency Chicago, high-end escorts Washington DC, luxury companions USA">

<meta name="robots" content="index, follow">
<meta name="author" content="sobunny USA">
<meta name="revisit-after" content="7 days">
<meta name="Distribution" content="Global">
<meta name="googlebot" content="index, follow">
<meta name="twitter:title" content="Luxury Escort Services in Major US Cities">
<meta name="twitter:description" content="Explore luxury escort services in Miami, Los Angeles, New York, and other cities for a discreet and premium experience.">
<meta name="copyright" content="© 2025 Sobunny, All Rights Reserved.">
<meta name="robots" content="noarchive">
<meta property="og:title" content="Exclusive Escorts in Miami, New York, Los Angeles, Las Vegas, Chicago, Washington DC, Atlanta, Boston, Austin, San Francisco, Philadelphia, Dallas | Sobunny.com">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Sobunny.com: Verified Escorts in Major US Cities">
<meta property="og:description" content="Explore verified independent escorts in cities like Miami, New York, Los Angeles, Las Vegas, and more. Find the perfect companion with Sobunny's premium escort services.">
<meta property="og:url" content="https://www.sobunny.com">
<meta name="twitter:site" content="@sobunnytw">
<meta name="twitter:creator" content="@sobunnytw">
<meta name="twitter:title" content="Exclusive Escorts in Major US Cities | Sobunny.com">
<meta name="twitter:description" content="Discover verified independent escorts in Miami, New York, Los Angeles, Las Vegas, Chicago, Washington DC, and more. Find discreet and premium companions with Sobunny.">
<meta name="mobile-web-app-capable" content="yes">









    {!! render_favicon_by_id(get_static_option('site_favicon')) !!}
    @include('frontend.layout.partials.custom-font')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/plugin.css') }}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/new-css-add.css') }}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/dynamic-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/helpers.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/common/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery.ihavecookies.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/main.css')}}">

    @if(get_user_lang_direction() == 'rtl')
        <link rel="stylesheet" href="{{asset('assets/common/css/rtl.css')}}">
    @endif

    <link rel="canonical" href="{{canonical_url()}}" />
    @include('frontend.layout.partials.root-style')

    <!-- page css -->
    @yield('style')


</head>
@yield('terms')

<body class="new-style bodyNone">

    {!! renderBodyStartHooks() !!}
    @include('frontend.layout.partials.notice')


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            setTimeout(() => {
                document.querySelector(".bodyNone").style.display = "block";
            }, 500);
        });
    </script>