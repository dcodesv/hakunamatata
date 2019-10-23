<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       piwebsolution.com
 * @since      1.0.0
 *
 * @package    Pisol_Enquiry_Quotation_Woocommerce
 * @subpackage Pisol_Enquiry_Quotation_Woocommerce/public/partials
 */

//print_r($this->products);
?>

<div class="woocommerce" id="pi-enquiry-container">
<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-remove">&nbsp;</th>
				<th class="product-thumbnail">&nbsp;</th>
				<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<?php if(!class_eqw_advance::checkHidePrice()): ?>
				<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<?php endif; ?>
				<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Message', 'woocommerce' ); ?></th>
			</tr>
		</thead>
        <tbody id="pi-enquiry-list-row">
        <?php pisol_table_row($this->products); ?>
        </tbody>
</table>
<?php 
/**
 * Placeholder is needed as it is used for label in email
 */
$items = array(
	array('type'=>'text', 'name'=>'pi_name', 'required'=>'required', 'placeholder'=>__('Name','pisol-enquiry-quotation-woocommerce')),
	array('type'=>'email', 'name'=>'pi_email', 'required'=>'required', 'placeholder'=>__('Email','pisol-enquiry-quotation-woocommerce')),
	array('type'=>'text', 'name'=>'pi_phone', 'required'=>'required', 'placeholder'=>__('Phone','pisol-enquiry-quotation-woocommerce')),
	array('type'=>'text', 'name'=>'pi_subject', 'required'=>'required', 'placeholder'=>__('Subject','pisol-enquiry-quotation-woocommerce')),
	array('type'=>'textarea', 'name'=>'pi_message', 'required'=>'required', 'placeholder'=>__('Message','pisol-enquiry-quotation-woocommerce')),
	array('type'=>'submit', 'name'=>'pi_submit',  'value'=>__('Submit Enquiry','pisol-enquiry-quotation-woocommerce')),
);
new class_pisol_form($items); 
?>
</div>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
