<?php

use app\core\Application;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
    <link href="/assets/css/normalize.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title><?php echo $this->title ?> </title>
</head>

<body>
    <header>

        <!-- logo -->
        <div class="logo-container">
            <a class="logo" href="/">
                <img src="/assets/gfx/GROOVE_test_size.svg" alt="logo">
            </a>

        </div>

        <!--toggle-->
        <div class="burguer">
            <img src="/assets/gfx/toggle.svg" alt="toggle">
        </div>

        <!-- nav -->
        <nav>


            <ul id="header-nav" class="nav-links">

                <li class="nav-link"><!-- home -->
                    <a  href="/">Home</a>
                </li>

                <li class="nav-link"><!-- artist -->
                    <a href="artists">Artists</a>
                </li>

                <li class="nav-link"><!-- music -->
                    <a  href="music">Releases</a>
                </li>

                <li class="nav-link"><!-- show -->
                    <a href="live">Live</a>
                </li>
                <?php if (Application::isGuest()): ?>
                    <li class="nav-link"><!-- login -->
                        <a href="login">Login</a>
                    </li>
                <?php else: ?>
                    <li class="nav-link"><!-- login -->
                        <a href="/profile">Welcome - <?php echo Application::$app->user->getDisplayName() ?></a>
                    </li>
                    <li class="nav-link">
                        <a href="/logout">Logout </a>

                    </li>
                <?php endif; ?>
            </ul>

        </nav>
    </header>
    <!-- main -->
    <main>


        {{content}}

    </main>


    <!-- footer -->
    <footer>
        <nav>
        <ul class="nav-links">

            <li class="nav-link"><!-- home -->
                <a  href="/">Home</a>
            </li>

            <li class="nav-link"><!-- artist -->
                <a href="artists">Artists</a>
            </li>

            <li class="nav-link"><!-- music -->
                <a  href="music">Releases</a>
            </li>

            <li class="nav-link"><!-- show -->
                <a href="live">Live</a>
            </li>

            <?php if (Application::isGuest()): ?>
                <li class="nav-link"><!-- login -->
                    <a href="login">Login</a>
                </li>
            <?php else: ?>
                <li class="nav-link"><!-- login -->
                    <a href="/logout">Logout </a>

                </li>
            <?php endif; ?>
        </ul>

        </nav>
    </footer>


    <!-- script -->
    <script src="/assets/js/script.js"></script>



</body>

</html>