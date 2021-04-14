<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Overpass&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Groove</title>

</head>

<body>
<header>
    <!-- logo -->
    <div class="logo-container">
        <a class="logo" href="/">
            <img src="./gfx/GROOVE_test_size.svg" alt="logo">
        </a>

    </div>

    <!--toggle-->
    <div class="burguer">
        <img src="./gfx/toggle.svg" alt="toggle">
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

            <li class="nav-link"><!-- login -->
                <a href="login">Login</a>
            </li>
        </ul>

    </nav>
</header>

<!-- main -->
<main>

    <section class="block size_d">
        <div class="inscription">
            {{content}}
            <div>
                <a class="question" href="login">
                    <p>Already have an account?</p>
                    <p>Log in</p>
                </a>
            </div>
        </div>

    </section>


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

            <li class="nav-link"><!-- login -->
                <a href="login">Login</a>
            </li>

        </ul>
    </nav>
</footer>


<!-- script -->
<script src="js/script.js"></script>



</body>

</html>
