<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/home.css">
        <link rel="stylesheet" href="/css/fontAwesome.css">
        <link rel="stylesheet" href="/css/bulmaAdmin.css">
        <link rel="stylesheet" href="/css/bulma.css">
        <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css">

        <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
        <script src="/js/jquery-3.2.1.min.js"></script>

        <title>GreenDom</title>

    </head>
    <body>

          <div id="app">

            <div class="bd-example is-paddingless">
              <nav class="navbar is-primary">
                <div class="navbar-brand">
                  <a class="navbar-item" href="{{ route('home') }}">
                    <img src="http://www.greendom.eu/wp-content/uploads/2014/01/logo-n.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
                  </a>
                  <div class="navbar-burger burger" data-target="navMenuColorprimary-example">
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                </div>

                <div id="navMenuColorprimary-example" class="navbar-menu">
                  <div class="navbar-start">
                    <div class="navbar-item has-dropdown is-hoverable">
                      <router-link class="navbar-item" tag="a" to="/home">
                          Accueil
                      </router-link>
                      <router-link class="navbar-item" tag="a" to="/about">
                          A propos de nous
                      </router-link>
                      @if (!Auth::check())
                        <router-link class="navbar-item" tag="a" to="/signUp">
                            S'inscrire
                        </router-link>
                      @endif
                      <router-link class="navbar-item" tag="a" to="/contact">
                          Contact
                      </router-link>

                      @if (Auth::check())
                        <router-link class="navbar-item" tag="a" to="/listOrder/{{ Auth::id() }}">
                            Liste des commandes
                        </router-link>
                        @if (Auth::user()->employee)
                          <router-link class="navbar-item" tag="a" to="/tableauDeBord/{{ Auth::id() }}">
                              Tableau de bord
                          </router-link>
                        @endif
                      @endif
                    </div>
                  </div>

                  <div class="navbar-end">
                    <div class="navbar-item">
                      <div class="field is-grouped">
                        <p class="control">
                          @if (Auth::check())
                            <a class="button" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> {{Auth::user()->forename}} {{Auth::user()->name}}</a>
                            <!--/*<router-link class="button is-info" tag="button" to="/commande/{{ Auth::id() }}">
                                Demande
                            </router-link>*/-->
                          @endif
                          @if (!Auth::check())
                            <router-link class="button is-success is-outlined" tag="button" to="/login">
                                Se connecter
                            </router-link>
                          @endif
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </nav>
            </div>


            <section class="section">
                <div class="container">
                    <router-view></router-view>
                </div>
            </section>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
