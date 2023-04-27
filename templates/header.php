<head>
    <title>PHPizza</title>
    <!-- Importing in materialize CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
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
</head>

<body class="grey lighten-4">
    <nav class="white">
        <div class="nav-wrapper container">
            <a href="/phpizza/index.php" class="brand-logo grey-text text-darken-3">
                PHPizza
            </a>
            <a href="#" data-target="mobile-menu" class="sidenav-trigger">
                <i class="material-icons orange-text">menu</i>
            </a>
            <ul class="right hide-on-med-and-down">
                <li><a href="/phpizza/order.php" class="grey-text text-darken-3">Order</a></li>

                <!-- If the user is logged in we give them the option to either visit the
                account settings page or to logout -->
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                    <li>
                        <a class='dropdown-trigger grey-text text-darken-3' href='#' data-target='dropdown1'>Account</a>
                        <ul id='dropdown1' class='dropdown-content'>
                            <li><a href="/phpizza/account/settings.php">Settings</a></li>
                            <li><a href="#" onclick="logout()">Logout</a></li>
                        </ul>
                    </li>

                <!-- If the user is not logged in, we present them the option to login or
                register -->
                <?php else: ?>
                    <li><a href="/phpizza/auth/auth.php" class="grey-text text-darken-3">Login / Register</a></li>
                <?php endif; ?>

            </ul>
        </div>
    </nav>

    <!-- All the same logic follows but this is our responsove design mobile view -->
    <ul class="sidenav" id="mobile-menu">
        <li><a href="/phpizza/order.php" class="orange-text">Order</a></li>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
            <li><a href="/phpizza/account/settings.php" class="orange-text">Settings</a></li>
            <li><a href="#" class="orange-text" onclick="logout()">Logout</a></li>
        <?php else: ?>
            <li><a href="/phpizza/auth/auth.php" class="orange-text">Login / Register</a></li>
        <?php endif; ?>
    </ul>

    <!-- Contains the scripts for the dropdown menus and the logout functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);

            var dropdowns = document.querySelectorAll('.dropdown-trigger');
            var dropdownInstances = M.Dropdown.init(dropdowns);
        });

        /* Presents the user with a logout confirmation, if the user confirms
        we run the logout script and redirect them back to the index */
        function logout() {
            if (confirm('Are you sure you want to log out?')) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        location.href = '/phpizza/index.php';
                    }
                };
                xhr.open("GET", "/phpizza/auth/logout.php", true);
                xhr.send();
            }
        }
    </script>