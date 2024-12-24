<!doctype html>
<html class="no-js supports-no-cookies" lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="theme-color" content="#cf987e">
  <link rel="canonical" href="index.html">
  <link rel="icon" href="{{asset('assets')}}/cdn/shop/files/logo/apple-icon-114x114.png" type="image/png" /><!-- Title and description -->
  
  <title>
    HQ SHOP
  </title>

    <meta property="og:type" content="website">
    <meta property="og:title" content="Airi - Clean, Minimal eCommerce Shopify Theme">
    <meta property="og:description" content="">
    <meta property="og:url" content="index.html">
    <meta property="og:site_name" content="Airi - Clean, Minimal eCommerce Shopify Theme">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Airi - Clean, Minimal eCommerce Shopify Theme">
    <meta name="twitter:description" content="">
    <meta property="og:image" content="https://cdn.shopify.com/s/files/1/0075/0374/0992/files/logo-black_cb92d06e-cae0-4796-884d-8845e5fec67e.png?height=628&pad_color=ffffff&v=1613756199&width=1200" />
    <meta property="og:image:secure_url" content="https://cdn.shopify.com/s/files/1/0075/0374/0992/files/logo-black_cb92d06e-cae0-4796-884d-8845e5fec67e.png?height=628&pad_color=ffffff&v=1613756199&width=1200" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="628" />
  {{-- toastr --}}
  <!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


  <!-- CSS -->
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="{{asset('assets')}}/cdn/shop/t/41/assets/timber.scss36da.css?v=94185598538301799841702906858" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('assets')}}/cdn/shop/t/41/assets/plugins-extra6da9.css?v=98141723695170321121702906858" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('assets')}}/cdn/shop/t/41/assets/theme-customc498.css?v=42927666119418513311704809325" rel="stylesheet" type="text/css" media="all" />

<!-- Header hook for plugins -->
  
  
<script integrity="sha256-n5Uet9jVOXPHGd4hH4B9Y6+BxkTluaaucmYaxAjUcvY=" data-source-attribution="shopify.loadfeatures" defer="defer" src="{{asset('assets')}}/cdn/shopifycloud/shopify/assets/storefront/load_feature-9f951eb7d8d53973c719de211f807d63af81c644e5b9a6ae72661ac408d472f6.js" crossorigin="anonymous"></script>
<script data-source-attribution="shopify.dynamic_checkout.dynamic.init">var Shopify=Shopify||{};Shopify.PaymentButton=Shopify.PaymentButton||{isStorefrontPortableWallets:!0,init:function(){window.Shopify.PaymentButton.init=function(){};var t=document.createElement("script");t.src="{{asset('assets')}}/cdn/shopifycloud/portable-wallets/latest/portable-wallets.en.js",t.type="module",document.head.appendChild(t)}};
</script>
<script data-source-attribution="shopify.dynamic_checkout.cart.bootstrap">document.addEventListener("DOMContentLoaded",(function(){function t(){return document.querySelector("#dynamic-checkout-cart")}if(t())Shopify.PaymentButton.init();else{new MutationObserver((function(e,n){t()&&(Shopify.PaymentButton.init(),n.disconnect())})).observe(document.body,{childList:!0,subtree:!0})}}));
</script>
<link rel="stylesheet" media="screen" href="{{asset('assets')}}/cdn/shop/t/41/compiled_assets/styles4564.css?10759">
<script id="sections-script" data-sections="video-banner-text,trending-product,brand-area,top-collection-area,newslatter-area,latest-blog,header" defer="defer" src="{{asset('assets')}}/cdn/shop/t/41/compiled_assets/scripts4564.js?10759"></script>
<script>window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.end');</script>
<script src="{{asset('assets')}}/cdn/shop/t/41/assets/pluginsc2c6.js?v=38993975501938333781702906718"></script><script src="{{asset('assets')}}/cdn/shop/t/41/assets/wishliste868.js?v=164725692185917909391702906718" defer="defer"></script><script src="{{asset('assets')}}/cdn/shop/t/41/assets/themef8bd.js?v=87166446093406222691703599493"></script>
{{-- <script async>
  window.money_format = `<span class="money">\${{amount}} USD</span>`;
</script> --}}
  

<style>
  body,head,h2,a,strong,span, li {
    font-family: 'Trebuchet MS', sans-serif !important;
    color: black;
  }
  div, li{
    font-size: 16px;
  }
  strong{
    font-size: 16px;
  }
  </style>
</head>
<body id="airi-clean-minimal-ecommerce-shopify-theme" class="template-index" >
<div class="  wrapper enable-header-transparent ">
<div id="shopify-section-header" class="shopify-section">

<!-- Header Area Start -->
{{-- @include('customer.headerinter') --}}
@include('customer.headerss')



<!-- Header Area End -->
<!-- Mobile Header area Start -->

@yield('maininter-content')
    {{-- <div id="shopify-section-footer" class="shopify-section"> --}}

<!-- Footer Start -->
@include('customer.footerinter')