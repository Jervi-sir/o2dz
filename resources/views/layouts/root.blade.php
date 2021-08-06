<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Content-Language" content="arabic">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="oxygene, algerie, dz, o2dz, fournisseur d'oxygene, help, site oxygene">
    <meta name="author" content="2kings-websites Gacem aka Jervi, Aymen aka iverj">
    <meta name="copyright" content="2kings-websites">
    <meta name="description" content="موقع اين يمكنك العثور على معدات الأكسجين ، كما يمكنك الإعلان عن عروضك إذا كان لديك معدات أكسجين تريد توفيرها">
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