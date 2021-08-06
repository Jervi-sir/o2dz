<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">
    <meta name="Content-Language" content="arabic">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="canonical" href="https://o2dz.com/">
    <meta name="keywords" content="oxygene, algerie, dz, o2dz, fournisseur d'oxygene, help, site oxygene">
    <meta name="author" content="2kings-websites Gacem aka Jervi, Aymen aka iverj">
    <meta name="copyright" content="2kings-websites">
    <meta name="description" content="موقع اين يمكنك العثور على معدات الأكسجين ، كما يمكنك الإعلان عن عروضك إذا كان لديك معدات أكسجين تريد توفيرها">
    
    
    <meta property="og:type" content="website">
    <meta property="og:title" content=" O2dz - trouver des equipements d'oxygene ">
    <meta property="ogdescription" content="موقع اين يمكنك العثور على معدات الأكسجين ، كما يمكنك الإعلان عن عروضك إذا كان لديك معدات أكسجين تريد توفيرها">
    <meta property="og:link" href="https://o2dz.com/">
    <meta property="og:site_name" href="o2dz">

    <link rel="stylesheet" href="css/main.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="images/logo.svg"/>
    <link rel="stylesheet" href="css/toastr.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="js/toastr.js"></script>
    
    @yield('title')
</head>
<body>
    <div class="body">
        @include('elements.header')
        @yield('content')
        
        
        @yield('script')
        @yield('style')
    </div>
</body>
</html>