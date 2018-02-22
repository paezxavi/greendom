<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/bulma.css">

        <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
        <script src="/js/jquery-3.2.1.min.js"></script>

        <title>GreenDom</title>

    </head>
    <body>

          <div id="app">

            <nav class="navbar is-transparent greendom-navbar" >
              <div class="navbar-brand">
                <a class="navbar-item" href="{{ route('home') }}">
                  <img src="http://www.greendom.eu/wp-content/uploads/2014/01/logo-n.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
                </a>
                <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </div>

              <div id="navbarExampleTransparentExample" class="navbar-menu">
                <div class="navbar-start">
                  <router-link class="navbar-item" tag="a" to="/home">
                      Home
                  </router-link>
                  <router-link class="navbar-item" tag="a" to="/about">
                      About
                  </router-link>

                  <router-link class="navbar-item" tag="a" to="/contact">
                      Contact
                  </router-link>
                  <router-link class="navbar-item" tag="a" to="/devis/{{ $user }}">
                      Tableau de bord
                  </router-link>
                </div>
                <div class="navbar-end">
                  <div class="navbar-item">
                    <div class="field is-grouped">
                      <p class="control">
                        <router-link class="button is-success" tag="a" to="/devis/{{ $user }}"> <!--Il faut definir comment faire la route-->
                            Devis
                        </router-link>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </nav>

            <section class="section">
                <div class="container">
                    <router-view></router-view>
                </div>
            </section>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
