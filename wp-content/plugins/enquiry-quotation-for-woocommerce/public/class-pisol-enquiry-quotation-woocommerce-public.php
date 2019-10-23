<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       piwebsolution.com
 * @since      1.0.0
 *
 * @package    Pisol_Enquiry_Quotation_Woocommerce
 * @subpackage Pisol_Enquiry_Quotation_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Pisol_Enquiry_Quotation_Woocommerce
 * @subpackage Pisol_Enquiry_Quotation_Woocommerce/public
 * @author     PI Websolution <sales@piwebsolution.com>
 */
class Pisol_Enquiry_Quotation_Woocommerce_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pisol_Enquiry_Quotation_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pisol_Enquiry_Quotation_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pisol-enquiry-quotation-woocommerce-public.css', array(), $this->version, 'all' );

		$pi_eqw_enquiry_loop_bg_color = get_option('pi_eqw_enquiry_loop_bg_color', '#ee6443');
		$pi_eqw_enquiry_loop_text_color = get_option('pi_eqw_enquiry_loop_text_color', '#ffffff');

		$pi_eqw_enquiry_single_bg_color = get_option('pi_eqw_enquiry_single_bg_color', '#ee6443');
		$pi_eqw_enquiry_single_text_color = get_option('pi_eqw_enquiry_single_text_color', '#ffffff');

		$css = "
			.add-to-enquiry-loop{
				background-color: $pi_eqw_enquiry_loop_bg_color !important;
				color: $pi_eqw_enquiry_loop_text_color !important;
			}
			.add-to-enquiry-single{
				background-color: $pi_eqw_enquiry_single_bg_color !important;
				color: $pi_eqw_enquiry_single_text_color !important;
			}
		";

		wp_add_inline_style( $this->plugin_name, $css );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pisol_Enquiry_Quotation_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pisol_Enquiry_Quotation_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pisol-enquiry-quotation-woocommerce-public.js', array( 'jquery' ), $this->version, false );

		$enquiry_cart_page_id = get_option('pi_eqw_enquiry_cart',0);
		if($enquiry_cart_page_id != 0 && $enquiry_cart_page_id != ""){
			$cart_page = get_permalink($enquiry_cart_page_id);
		}else{
			$cart_page = false;
		}

		wp_localize_script( $this->plugin_name, 'pi_ajax',
			array( 
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'loading'=> plugin_dir_url( __FILE__ ).'img/loading.svg',
				'cart_page'=>$cart_page
			) 
		);
		$products = class_eqw_enquiry_cart::getProductsInEnquirySession();
		wp_localize_script( $this->plugin_name, 'pisol_products',
		$products
		);
	}

}
