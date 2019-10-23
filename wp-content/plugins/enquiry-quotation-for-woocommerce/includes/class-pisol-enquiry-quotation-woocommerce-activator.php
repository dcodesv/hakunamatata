<?php

/**
 * Fired during plugin activation
 *
 * @link       piwebsolution.com
 * @since      1.0.0
 *
 * @package    Pisol_Enquiry_Quotation_Woocommerce
 * @subpackage Pisol_Enquiry_Quotation_Woocommerce/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Pisol_Enquiry_Quotation_Woocommerce
 * @subpackage Pisol_Enquiry_Quotation_Woocommerce/includes
 * @author     PI Websolution <sales@piwebsolution.com>
 */
class Pisol_Enquiry_Quotation_Woocommerce_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option('pi_ewq_do_activation_redirect', true);
		self::createEnquiryCartPage();
	}

	public static function createEnquiryCartPage(){
		$page_saved = get_option('pi_eqw_enquiry_cart',0);
		if($page_saved == 0 || $page_saved == ""){
			$page  = array( 
					'post_title'     => __('Enquiry Cart'),
					'post_type'      => 'page',
					'post_content'   => '[enquiry_cart]',
					'post_status'    => 'publish',
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
					);
			$page_id = wp_insert_post($page, false);
			update_option('pi_eqw_enquiry_cart', $page_id);
		}
	}

}
