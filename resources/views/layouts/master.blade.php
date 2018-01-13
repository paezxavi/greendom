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
              <div id="navMenu" style="max-width: 1344px; margin-left: auto; margin-right: auto">
                  <div id="topNav" style="1px solid #E6EAEE; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(0, 170, 0);">
                      <nav class="navbar is-transparent">
                          <div class="navbar-brand">
                              <router-link class="navbar-item" tag="a" to="/">
                                  <img src="http://www.greendom.eu/wp-content/uploads/2014/01/logo-n.png" alt="Bulma: a modern CSS framework based on Flexbox" width="100" height="40">
                              </router-link>
                          </div>

                          <div id="navbarExampleTransparentExample" class="navbar-menu">
                            <div class="navbar-start">
                              <router-link class="navbar-item" tag="a" to="/">
                                  Home
                              </router-link>
                            </div>
                          </div>
                        </nav>
                    </div>
                    <div id="bottomNav">
                        <nav class="navbar is-white">
                        <div class="container">
                          <div class="navbar-menu">
                            <div class="navbar-start">
                              <router-link class="navbar-item" tag="a" to="/about">
                                  About
                              </router-link>

                              <router-link class="navbar-item" tag="a" to="/contact">
                                  Contact
                              </router-link>
                              <router-link class="navbar-item" tag="a" to="/devis">
                                  Tableau de bord
                              </router-link>
                            </div>
                            <div class="navbar-end">
                              <div class="navbar-item">
                                <input class="input" type="text" placeholder="Search ...">
                              </div>
                            </div>
                          </div>
                        </div>
                      </nav>
                </div>
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
