<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
</head>
<body>
    <div class="body">
        <div class="team">
            @include('elements.header')
            <div class="center">
                <p class="arabic-font">فريق المطورين</p>
                <h4><a href="https://gacem.netlify.com" target="_blank">2KingsWebsites</a></h4>
                <div class="links">
                  <a class="link" href="https://www.instagram.com/2kingswebsites/?hl=en" target="_blank">
                    <img src="images/instagram.svg" width="40px"/>
                    <span>2kings</span>
                  </a>
                  <a class="link" href="https://github.com/Jervi-sir" target="_blank">
                    <img src="images/github.svg" width="40px"/>
                    <span>Jervi-sir</span>
                  </a>
                  <a class="link" href="https://github.com/Aymendz46" target="_blank">
                    <img src="images/github.svg" width="40px"/>
                    <span>Aymendz 46</span>
                  </a>
                </div>
                <div class="thankx">
                  <h4 class="arabic-font">يمكنك التبرع للمساعدة في تحديث الموقع  🙂 </h4>
                  <h4 class="arabic-font">بالاتصال بنا</h4>
                  <h4 class="arabic-font">او</h4>
                  <h4 class="donate-btn "> <span class="online">Paypal</span> <span class="comming-soon">Coming soon</span> </h4>
                </div>
              </div>
              <footer>
                Made with <i>♥</i> by by :: 2KingsWebsites
            </footer>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 
    </div>
    <style>
        .body {
            height: 100vh;
        }
        .donate-btn {
          position: relative;
          margin: auto;
          width: 150px;
          height: 50px;
          border: none;
          background: #2AFEB7;
          font-size: 18px;
          border-radius: 7px;
        }
        .donate-btn span{
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
        }
        .donate-btn span {
          position: absolute;
          z-index: 10;
        }
        .donate-btn .online {
          filter: blur(1px)
        }
        .comming-soon {
          transform: translate(0%, 100%) rotate(-2deg);
          color: #dc143c;
        }
        .links {
          width: 80%;
          display: grid;
          grid-template-columns: 1fr 1fr 1fr;
          grid-template-rows: 1fr;
          margin: auto;
          justify-items: center;
        }
        .link {
          display: grid;
          width: 50px;
        }
        .link img {
          margin: 0 auto;
        }
      
        .link span {
          font-size: 10px;
        }
        .team a {
          text-decoration: none;
          color: inherit;
        }
        .links a {
          margin: 1rem;
        }
        .team .center {
          margin: 30px;
          text-align: center;
        }
        .team .center p {
          margin-top: 3rem;
          margin-bottom: 0.7rem;
        }
      
        .team .thankx {
          text-align: center;
          margin-top: 5rem;
        }
      
        .team .thankx h4 {
          font-weight: 100;
        }
        
        .team footer {
          position: fixed;
          bottom: 0;
          left: 0;
          right: 0;
          transform: translate(0, -50%);
        }
                
    </style>
      

</body>
</html>