<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       piwebsolution.com
 * @since      1.0.0
 *
 * @package    Pisol_Enquiry_Quotation_Woocommerce
 * @subpackage Pisol_Enquiry_Quotation_Woocommerce/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="pisol-enquiry-detail-container">
    <h2>Enquiry #<?php echo $enquiry->ID; ?> detail</h2>
    <hr>
    <h3>Personal Detail</h3>
    <table class="pi-personal-detail">
        <tr>
            <td><strong><?php echo __('Name'); ?></strong> : <?php echo esc_html($enquiry->pi_name); ?></td>
            <td><strong><?php echo __('Email'); ?></strong> : <a href="mailto:<?php echo sanitize_email($enquiry->pi_email); ?>"><?php echo sanitize_email($enquiry->pi_email); ?></a></td>
        </tr>
        <tr>
            <td><strong><?php echo __('Phone'); ?></strong> : <?php echo esc_html($enquiry->pi_phone); ?></td>
            <td><strong><?php echo __('Subject'); ?></strong> : <?php echo esc_html($enquiry->pi_subject); ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <strong><?php echo __('Message'); ?></strong> : <?php echo esc_html($enquiry->pi_message); ?>
            </td>
        </tr>
    </table>
    <hr>
    <h3>Product Detail</h3>
    <table class="pi-product-table" cellspacing="0">
        <thead>
        <tr>
            <th class="pi-img-col">Image</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Message</th>
        </tr>
        </thead>
        <tbody>
        <?php $pi_products_info = unserialize(get_post_meta($enquiry->ID, 'pi_products_info', true)); 
        
        ?>
        <?php if(is_array($pi_products_info)): ?>
        <?php  foreach($pi_products_info as $product): ?>
        <tr>
            <td class="pi-thumb-col">
                <?php if($product['img'] != ""): ?>
                <a href="<?php echo esc_url($product['link']); ?>" target="_blank"><img class="pi-thumb" src="<?php echo esc_url($product['img']); ?>"></a>
                <?php endif; ?> 
            </td>
            <td>
            <a href="<?php echo esc_url($product['link']); ?>" target="_blank"><?php echo esc_html($product['name']); ?></a><br>
            <?php $this->variation_detail($product['variation_detail']); ?>
            </td>
            <td class="pi-bold"><?php echo esc_html($product['price']); ?></td>
            <td class="pi-bold"><?php echo esc_html($product['quantity']); ?></td>
            <td><?php echo esc_html($product['message']); ?></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
</tbody>
    </table>
</div>
