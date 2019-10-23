<?php

class class_eqw_product{

    function __construct(){
        
        /**
         * https://businessbloomer.com/woocommerce-visual-hook-guide-single-product-page/
         */
        $this->single_product_enquiry_position = 52;
        
        $this->loop_product_enquiry_position = 'woocommerce_after_shop_loop_item';

        $this->add_to_enquiry_text_loop = get_option('pi_eqw_enquiry_loop_button_text','Add to Enquiry');
        $this->add_to_enquiry_text_single = get_option('pi_eqw_enquiry_single_button_text','Add to Enquiry');

        add_action( 'woocommerce_single_product_summary', array($this,'add_enquiry_button'), $this->single_product_enquiry_position);

        add_action($this->loop_product_enquiry_position, array($this,'add_loop_enquiry_button'), 50 );

    }

    function add_enquiry_button(){
        global $product;

        if(!$this->showButtonOnSinglePage($product)) return;
        
        if($product->is_type('variable') ){
            echo '<button class="button pi-custom-button add-to-enquiry add-to-enquiry-single" href="javascript:void(0)" data-action="pi_add_to_enquiry" data-id="'.$product->get_id().'">' . $this->add_to_enquiry_text_single. '</button>';
        }else{
            echo '<button class="button pi-custom-button add-to-enquiry add-to-enquiry-single" href="javascript:void(0)" data-action="pi_add_to_enquiry" data-id="'.$product->get_id().'">' . $this->add_to_enquiry_text_single. '</button>';
        }
    }

    function add_loop_enquiry_button() {
        global $product;

        if(!$this->showButtonOnLoopPage($product)) return;

        if($product->is_type('variable') ){
            echo '<div style="margin-bottom:10px;">
            <a class="button pi-custom-button add-to-enquiry-loop" href="'.$product->get_permalink().'">'.$this->add_to_enquiry_text_loop.'</a>
            </div>';
        }else{
            echo '<div style="margin-bottom:10px;">
            <a class="button pi-custom-button add-to-enquiry add-to-enquiry-loop" href="javascript:void(0)" data-action="pi_add_to_enquiry" data-id="'.$product->get_id().'">'.$this->add_to_enquiry_text_loop.'</a>
            </div>';
        }
    }

    function showButtonOnLoopPage($product){
        if( $product->is_type('grouped') || $product->is_type('variable') ) return false;


        /**
         * this show enquiry if product is out of stock and you want to show when product is out of stock
         */
        /*
        $pi_eqw_loop_show_on_out_of_stock = get_option('pi_eqw_loop_show_on_out_of_stock', 0);
        if($pi_eqw_loop_show_on_out_of_stock == 1){
            if(!$product->is_in_stock()){
                return true;
            }
        }
        */
        /**
         * global loop is off, 
         * but still you can enable it for single product from product overwrite
         * enable it for out of stocks
         */
        $pi_eqw_enquiry_loop = get_option('pi_eqw_enquiry_loop',0);
        if($pi_eqw_enquiry_loop != 1) return false;

        return true;
    }

    function showButtonOnSinglePage($product){
        if( $product->is_type('grouped') || $product->is_type('variable')) return false;


         /**
         * this show enquiry if product is out of stock and you want to show when product is out of stock
         */
        /*
        $pi_eqw_single_show_on_out_of_stock = get_option('pi_eqw_single_show_on_out_of_stock', 0);
        if($pi_eqw_single_show_on_out_of_stock == 1){
            if(!$product->is_in_stock()){
                return true;
            }
        }
        */
        /**
         * global single is off, 
         * but still you can enable it for single product from product overwrite
         * enable it for out of stocks
         */
        $pi_eqw_enquiry_single = get_option('pi_eqw_enquiry_single',1);
        if($pi_eqw_enquiry_single != 1) return false;

        return true;
    }
}

new class_eqw_product();

