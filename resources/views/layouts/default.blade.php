<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="utf-8">
    <title>fashion-site | @yield('title', 'Home')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>

  <body>
    @section('body')
      <style>
          html, body {
              background-color: #fff;
              color: #636b6f;
              font-family: 'Raleway', sans-serif;
              font-weight: 100;
              height: 100vh;
              margin: 0;
          }

          /* .full-height {
              height: 10vh;
          } */

          .flex-center {
              align-items: center;
              display: flex;
              justify-content: center;
          }

          .position-ref {
              position: relative;
          }

          .top-right {
              position: absolute;
              right: 10px;
              top: 18px;
          }

          .content {
              text-align: center;
          }

          .title {
              font-size: 84px;
          }

          .links > a {
              color: #636b6f;
              padding: 0 25px;
              font-size: 12px;
              font-weight: 600;
              letter-spacing: .1rem;
              text-decoration: none;
              text-transform: uppercase;
          }

          .m-b-md {
              margin-bottom: 30px;
          }
      </style>

      <div class="flex-center position-ref full-height">
          @if (Route::has('login'))
              <div class="top-right links">
                  @auth
                      <a href="{{ url('/home') }}">Home</a>
                  @else
                      <a href="{{ route('login') }}">Login</a>
                      <a href="{{ route('register') }}">Register</a>
                  @endauth
              </div>
          @endif


        <div class='container'>
          @yield('content')
        </div>
    </div>


    @show

    @yield('footer')
      <script src="{{ asset('js/app.js') }}"></script>
  </body>

</html>
