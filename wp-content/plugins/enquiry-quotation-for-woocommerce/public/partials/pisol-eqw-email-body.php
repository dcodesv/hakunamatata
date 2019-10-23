<?php

function pisol_email_table_row($products){
    ?>
<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0" width="100%" border="0" >
		<thead style="background-color:#ccc;">
			<tr>
				<th class="product-name" ><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<?php if(!class_eqw_advance::checkHidePrice()): ?>
				<th class="product-price" ><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<?php endif; ?>
				<th class="product-quantity" ><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal" ><?php esc_html_e( 'Message', 'woocommerce' ); ?></th>
			</tr>
		</thead>
        <tbody id="pi-enquiry-list-row">
    <?php
    if(is_array($products) && count($products) >0){
        ?>
        
        <?php
        foreach($products as $key => $product){ 
            $product_obj = wc_get_product($product['id']);
            $product_permalink = $product_obj->get_permalink();
            $image_id = 'image_'.$product_obj->get_image_id();
            ?>
        <tr class="woocommerce-cart-form__cart-item" id="<?php echo $key; ?>">
            <td>
                <img alt="" border="0" src="cid:<?php echo $image_id; ?>" style="max-width:100%; width:70px; height:auto;">
            </td>
            <td class="product-name"  style="padding:6px 6px;">
                <?php printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $product_obj->get_name() ); 
                class_eqw_enquiry_shortcode::get_variations($product_obj, $product['variation_detail'],true);
                ?>
            </td>
            <?php if(!class_eqw_advance::checkHidePrice()): ?>
            <td class="product-price"  style="padding:10px 0; text-align:center;">
                <?php echo wc_price(class_eqw_enquiry_shortcode::get_price_simple_variation($product_obj, $product['variation'])); ?>
            </td>
            <?php endif; ?>
            <td class="product-quantity"  style="padding:10px 0; text-align:center;">
                <?php echo esc_html($product['quantity']); ?>
                <input type="hidden" value="<?php echo (isset($product['variation']) && $product['variation'] != "" && is_array($product['variation'])) ? json_encode($product['variation']) : ''; ?>" data-hash="<?php echo $key; ?>" name="products[<?php echo $key; ?>][variation]" />
            </td>
            <td class="product-message"  style="padding:10px 0; text-align:center;">
            <?php echo esc_html($product['message']); ?>
            </td>
        </tr>
        <?php } ?>
        
        <?php
    }else{
        echo '<tr>';
        echo '<td colspan="6" align="center">';
        echo __('There are no product added in the enquiry cart');
        echo '</td>';
        echo '</tr>';
    }
    ?>
</tbody>
</table>
    <?php
}

function pisol_email_form_detail($items){
    $message = '<table class="pi-customer-detail" border="0" width="100%">';
    foreach($items as $item){
        if(isset($_POST[$item['name']]) && $_POST[$item['name']] != ""){
            if(isset($item['placeholder'])){
                $val = str_replace("\\","",esc_html($_POST[$item['name']]));
                $message .= '<tr><th>'.esc_html($item['placeholder']) ."</th><td>".$val.'</td></tr>';
            }
        }
    }
    $message .='</table>';
    return $message;
}