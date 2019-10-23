<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hakuna Matata</title>
    <?php wp_head();?>
</head>
<body>
<header>
    <nav class="nav-header">
        <img src="<?php echo get_stylesheet_directory_uri()?>/img/logo-text.png" alt="logo-hakuna-matata">
        <div class="nav-menu">
        <?php
            wp_nav_menu(array(
                'theme_location' => 'menu_principal'
            ));
        ?>
        </div>
        <div class="nav-social">
            <a href=""><i class="ri-facebook-fill"></i></a>
            <a href=""><i class="ri-instagram-fill"></i></a>
            <a href=""><i class="ri-youtube-fill"></i></a>
        </div>

        <div id="menu-mobile" class="menu-mobile">
            <ul class="nav-menu nav-menu-mobile">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu_principal'
                    ));
                ?>
            </ul>
            <div class="nav-social nav-social-mobile">
                <a href=""><i class="ri-facebook-fill"></i></a>
                <a href=""><i class="ri-instagram-fill"></i></a>
                <a href=""><i class="ri-youtube-fill"></i></a>
            </div>  
        </div>
        <div id="menu-mobile-button" class="menu-mobile-button"><i class="ri-menu-3-fill"></i></div>
    </nav>
</header>