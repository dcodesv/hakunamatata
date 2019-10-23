<?php

function pisol_table_row($products){
    if(is_array($products) && count($products) >0){
        ?>
        
        <?php
        foreach($products as $key => $product){ 
            $product_obj = wc_get_product($product['id']);
            $product_permalink = $product_obj->get_permalink();
            ?>
        <tr class="woocommerce-cart-form__cart-item" id="<?php echo $key; ?>">
            <td class="product-remove">
                <a href="javascript:void(0)" class="remove pi-remove-product"  data-id="<?php echo $key; ?>">&times;</a>
                <input type="hidden" name="products[<?php echo $key; ?>][id]" value="<?php echo $product['id']; ?>"/>
            </td>
            <td class="product-thumbnail pi-thumbnail">
            <?php
				$thumbnail = $product_obj->get_image();
                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );	
                
			?>
            </td>
            <td class="product-name">
                <?php printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $product_obj->get_name() ); 
                class_eqw_enquiry_shortcode::get_variations($product_obj, $product['variation_detail'], true);
                ?>
            </td>
            <?php if(!class_eqw_advance::checkHidePrice()): ?>
            <td class="product-price">
                <?php echo wc_price(class_eqw_enquiry_shortcode::get_price_simple_variation($product_obj, $product['variation'])); ?>
            </td>
            <?php endif; ?>
            <td class="product-quantity">
                <input type="number" class="input-text qty text pi-quantity" value="<?php echo $product['quantity']; ?>" name="products[<?php echo $key; ?>][quantity]" data-hash="<?php echo $key; ?>"/>
                <input type="hidden" value="<?php echo (isset($product['variation']) && $product['variation'] != "" && is_array($product['variation'])) ? json_encode($product['variation']) : ''; ?>" data-hash="<?php echo $key; ?>" name="products[<?php echo $key; ?>][variation]" />
            </td>
            <td class="product-message">
                <textarea name="message" class="pi-message" name="products[<?php echo $key; ?>][message]" data-hash="<?php echo $key; ?>"><?php echo esc_html($product['message']); ?></textarea>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="6" align="right">
                <button href="javascript:void(0)" id="pi-update-enquiry" class="button" disabled="disabled">Update enquiry</button>
            </td>
        </tr>
        
        <?php
    }else{
        echo '<tr>';
        echo '<td colspan="6" align="center">';
        echo __('There are no product added in the enquiry cart');
        echo '</td>';
        echo '</tr>';
    }
}