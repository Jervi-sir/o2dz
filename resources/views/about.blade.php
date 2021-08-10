<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="images/logo.svg"/>

    <title>About us</title>
</head>
<body>
    
    <div class="body">
        <div class="about">
            @include('elements.header')
            <div class="center">
              <p class="arabic-font"> تم إنشاء هذا الموقع بعناية واحترام لجميع الأشخاص الذين يمرون بأوقات عصيبة. نأمل أن يستفيد الجميع بهذا التطبيق حتى نتمكن من توفير سهولة ايجاد اماكن توفر معدات الاكسيجين </p>
              <p class="arabic-font">يهدف هذا التطبيق إلى أرشفة موقع ورقم هاتف المتاجر التي توفر الأكسجين بالقرب من منزلك</p>
        
              <div class="thankx">
                <h4 class="arabic-font">شكرًا لك على استخدام هذا الموقع ومشاركته مع أحبائك</h4>
                <h4>Merci de partager ce site avec vos proches</h4>
              </div>
            </div>
            <footer>
              Made by :: 2KingsWebsites
            </footer>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 
    </div>
    <style>
        .body {
            height: 100vh;
        }
        .about .center {
          margin: 30px;
        }
        .about .center p {
          text-align: center;
          margin-top: 3rem;
        }
      
        .about .thankx {
          text-align: center;
          margin-top: 5rem;
        }
      
        .about .thankx h4 {
          font-weight: 100;
        }
        
        .about footer {
          position: fixed;
          bottom: 0;
          left: 0;
          right: 0;
          transform: translate(0, -50%);
        }
      </style>

</body>
</html>