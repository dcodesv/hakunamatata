<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              piwebsolution.com
 * @since             1.1.6
 * @package           Pisol_Enquiry_Quotation_Woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Enquiry Quotation for WooCommerce
 * Plugin URI:        piwebsolution.com
 * Description:       Product enquiry and quotation plugin for WooCommerce that can save enquiry and email the enquiry as well
 * Version:           1.1.6
 * Author:            PI Websolution
 * Author URI:        piwebsolution.com/enquiry-quotation-woocommerce
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pisol-enquiry-quotation-woocommerce
 * Domain Path:       /languages
 * WC tested up to: 3.7.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if(!is_plugin_active( 'woocommerce/woocommerce.php')){
    function pi_eqw_free_notification_my_error_notice() {
        ?>
        <div class="error notice">
            <p><?php _e( 'Please Install and Activate WooCommerce plugin, without that this plugin cant work', 'pi-edd' ); ?></p>
        </div>
        <?php
    }
    add_action( 'admin_notices', 'pi_eqw_free_notification_my_error_notice' );
    deactivate_plugins(plugin_basename(__FILE__));
    return;
}

if(is_plugin_active( 'enquiry-quotation-for-woocommerce-pro/pisol-enquiry-quotation-woocommerce.php')){
    function pi_eqw_notification_my_pro_notice() {
        ?>
        <div class="error notice">
            <p><?php _e( 'You have the PRO version of Enquiry plugin active, deactivate it then you can use free version'); ?></p>
        </div>
        <?php
    }
    add_action( 'admin_notices', 'pi_eqw_notification_my_pro_notice' );
    deactivate_plugins(plugin_basename(__FILE__));
    return;
}else{

/**
 * Currently plugin version.
 * Start at version 1.1.6 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PISOL_ENQUIRY_QUOTATION_WOOCOMMERCE_VERSION', '1.1.6' );
define( 'PI_EQW_PRICE', '$16' );
define( 'PI_EQW_BUY_URL', 'https://www.piwebsolution.com/checkout/?add-to-cart=1734&variation_id=1736' );
define( 'PI_EQW_DELETE_SETTING', false);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pisol-enquiry-quotation-woocommerce-activator.php
 */
function activate_pisol_enquiry_quotation_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pisol-enquiry-quotation-woocommerce-activator.php';
	Pisol_Enquiry_Quotation_Woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pisol-enquiry-quotation-woocommerce-deactivator.php
 */
function deactivate_pisol_enquiry_quotation_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pisol-enquiry-quotation-woocommerce-deactivator.php';
	Pisol_Enquiry_Quotation_Woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pisol_enquiry_quotation_woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_pisol_enquiry_quotation_woocommerce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pisol-enquiry-quotation-woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pisol_enquiry_quotation_woocommerce() {

	$plugin = new Pisol_Enquiry_Quotation_Woocommerce();
	$plugin->run();

}
run_pisol_enquiry_quotation_woocommerce();

}