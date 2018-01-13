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
            <section class="hero is-success is-medium">
              <!-- Hero head: will stick at the top -->
              <div class="hero-head">
                <nav class="navbar">
                  <div class="container">
                    <div class="navbar-brand">
                      <a class="navbar-item">
                        <img src="http://www.greendom.eu/wp-content/uploads/2014/01/logo-n.png" alt="Logo">
                      </a>
                      <span class="navbar-burger burger" data-target="navbarMenuHeroA">
                        <span></span>
                        <span></span>
                        <span></span>
                      </span>
                    </div>
                    <div id="navbarMenuHeroA" class="navbar-menu">
                      <div class="navbar-end">
                        <a class="navbar-item is-active">
                          Home
                        </a>
                        <a class="navbar-item">
                          Examples
                        </a>
                        <a class="navbar-item">
                          Documentation
                        </a>
                        <span class="navbar-item">
                          <a class="button is-primary is-inverted">
                            <span class="icon">
                              <i class="fab fa-github"></i>
                            </span>
                            <span>Download</span>
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </nav>
              </div>

              <!-- Hero content: will be in the middle -->
              <div class="hero-body">
                <div class="container has-text-centered">
                  <h1 class="title">
                    GreenDom
                  </h1>
                  <h2 class="subtitle">
                    Smart LED Systems
                  </h2>
                </div>
              </div>

              <!-- Hero footer: will stick at the bottom -->
              <div class="hero-foot">
                <nav class="tabs is-boxed">
                  <div class="container">
                    <ul>
                        <router-link tag="li" to="/" exact>
                            <a>Home</a>
                        </router-link>

                        <router-link tag="li" to="/about">
                            <a>About</a>
                        </router-link>

                        <router-link tag="li" to="/contact">
                            <a class="nav-link">Contact</a>
                        </router-link>

                        <router-link tag="li" to="/devis">
                            <a class="nav-link">Tableau de bord</a>
                            <!--Il faut créer la page du tableau de bord-->
                        </router-link>
                    </ul>
                  </div>
                </nav>
              </div>
            </section>

            <section class="section">
                <div class="container">
                    <router-view></router-view>
                </div>
            </section>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
