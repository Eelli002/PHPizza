<head>
    <title>PHPizza</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <style type="text/css">
        .brand {
            background: #cbb09c !important;
        }
        .brand-text {
            color: #cbb09c !important;
        }
        form {
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
    <body class = "grey lighten-4">
        <!-- <nav class = "white z-depth-0">
            <div class="container">
                <a href="index.php" class="brand-logo brand-text">PHPizza</a>
                <ul id="nav-mobile" class = "right hide-on-small-and-down">
                    <li><a href="order.php" class = "btn brand z-depth-0">Add a Pizza</a></li>
                    <li><a href="LoginOrRegister.php" class = "btn brand z-depth-0">Login or Register</a></li>
                </ul>
            </div>
        </nav> -->
        <nav class="white">
        <div class="nav-wrapper container">
            <a href="#" class="brand-logo grey-text text-darken-3">
            PHPizza
            </a>
            <a href="#" data-target="mobile-menu" class="sidenav-trigger">
            <i class="material-icons orange-text">menu</i>
            </a>
            <ul class="right hide-on-med-and-down">
            <li><a href="order.php" class="grey-text text-darken-3">Order</a></li>
            <li><a href="login.php" class="grey-text text-darken-3">Login / Register</a></li>
            </ul>
        </div>
        </nav>

        <ul class="sidenav" id="mobile-menu">
        <li><a href="order.php" class="orange-text">Order</a></li>
        <li><a href="login.php" class="orange-text">Login / Register</a></li>
        </ul>

        <!-- On smaller displays we show a drop down menu with links to either
        order a pizza or login/register -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
        });
        </script>