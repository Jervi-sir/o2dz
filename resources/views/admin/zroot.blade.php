<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="icon" type="image/png" href="../images/logo.svg"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    @yield('title')
</head>
<body>
    <section class="container">
    @include('admin.sidebar')
    @yield('content')
    </section>
      
    
<script>
    function showModal(element) {
      var modal = $('#myModal');
      var close = $('.close');

      modal.show();
      close.click(function() {
          modal.hide();
          //console.log('close');
      });

      $(window).click(function(event) {
          if(event.target.id == 'myModal'){
              $('#myModal').css({display: "none"});
          }
      });

  }
</script>

</body>
</html>