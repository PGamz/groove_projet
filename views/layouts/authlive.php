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
    <link rel="stylesheet" href="/assets/css/normalize.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="/assets/css/video-js.css" rel="stylesheet" />
    <title><?php echo $this->title ?> </title>
    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->
</head>

<body>
<header>

    <!-- logo -->
    <div class="logo-container">
        <a class="logo" href="index.html">
            <img src="assets/gfx/GROOVE_test_size.svg" alt="logo">
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
                <a  href="releases">Releases</a>
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
                <a  href="releases">Releases</a>
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
