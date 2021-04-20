<?php

use app\core\Application;

$this->title = 'Profile';
?>
<h1> profile </h1>

    <div class=""><?=Application::$app->user->getDisplayName();?></div>
    <div class=""><?=Application::$app->user->getEmail();?></div>




<div>Artist page</div>



