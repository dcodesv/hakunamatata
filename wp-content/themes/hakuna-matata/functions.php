<?php

function hakunamatata_style(){
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('remixicons', 'https://cdn.remixicon.com/releases/v2.0.0/remixicon.css');
    wp_enqueue_style('imports', get_stylesheet_directory_uri() . '/css/imports.css');
    wp_enqueue_script('functions', get_stylesheet_directory_uri() . '/js/functions.js', true);
}
add_action('wp_enqueue_scripts', 'hakunamatata_style');
add_theme_support('post-thumbnails');

/*NUEVA NAVEGACION*/
register_nav_menus(array(
    'menu_principal' => __('Menu Principal', 'hakunamatata')
));

/*WOOCOMMERCE*/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
add_theme_support( 'woocommerce' );
}
define('WOOCOMMERCE_USE_CSS', true);