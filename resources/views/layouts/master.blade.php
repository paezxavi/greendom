<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">

        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="/js/bootstrap/popper.js"></script>
        <script src="/js/bootstrap/bootstrap.min.js"></script>


        <title>My App</title>

    </head>
    <body>

        <div id="app">

            <ul class="nav nav-tabs">
                <router-link tag="li" class="nav-item active" to="/" exact>
                    <a class="nav-link">Home</a>
                </router-link>

                <router-link tag="li" class="nav-item" to="/about">
                    <a class="nav-link">About</a>
                </router-link>

                <router-link tag="li" class="nav-item" to="/contact">
                    <a class="nav-link">Contact</a>
                </router-link>
            </ul>

            <section class="section">
                <div class="container">
                    <router-view></router-view>
                </div>
            </section>

        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
