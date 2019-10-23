<?php

class class_pisol_form{

    function __construct($items){
        $this->items = $items;
        $this->template = 'template1';
        $this->errors = array();
        if($this->enquiryPresent()){
            $this->form_page();
        }
    }

    function enquiryPresent(){
        return (class_eqw_enquiry_cart::isThereProductsInEnquirySession());
    }

    function form_page(){
       if(!empty($_POST) && count($_POST) > 0 ){
            $this->validation();
            $this->error();
            if($this->submit_form()){
                 $this->success_msg();
            }else{
                $this->form();
            }

       }else{
            $this->form();
       }
    }

    function form(){
        echo '<form method="post">';
            $this->items();    
        echo '</form>';
    }

    function success_msg(){
            echo '<div class="woocommerce-notices-wrapper">';
            echo '<div class="woocommerce-message"><span id="pi-form-submitted-success"></span>';
            echo __('Enquiry submitted','pisol-enquiry-quotation-woocommerce');
            echo '</div>';
            echo '</div>';
    }

    function validation(){
        foreach($this->items as $item){
            $this->required($item);
        }
    }

    function required($item){
        if(isset($item['required']) && $item['required'] == 'required'){
            if(isset($_POST[$item['name']]) && $_POST[$item['name']] != ""){
                return true;
            }else{
                $this->errors[] = array(
                    'error'=> sprintf(__('Cant leave %s empty'), $item['placeholder'])
                );
            }
        }
        return true;
    }

    function submit_form(){
        if( count($this->errors) <= 0 && !empty($_POST)){
            $save = $this->saveEnquiry();
            $email = $this->sendEmail();
            $clear_product = $this->clearSession();

            if($save && $email && $clear_product){
                return true;
            }else{
                $this->error[] = array('error'=>__('There was some error'));
                return false;
            }
        }
        return false;
    }

    function saveEnquiry(){
        $obj  = new class_eqw_save_enquiry($this->items);
        if($obj->save()){
            return true;
        }
        return false;
    }

    function sendEmail(){
        $email_obj = new class_pisol_eqw_email($this->items);
        $email_obj->sendEmail();
        return true;
    }
    
    function clearSession(){
        class_eqw_enquiry_cart::deleteProductsFromEnquirySession();
        return true;
    }

    function error(){
        $error_msg = "";
        if(is_array($this->errors) && count($this->errors) > 0){
            foreach($this->errors as $error){
                $error_msg .= $error['error'].'<br>';
            }
        }

        if($error_msg  != ""){
            echo '<div class="woocommerce-notices-wrapper">';
            echo '<div class="woocommerce-message">';
            echo $error_msg;
            echo '</div>';
            echo '</div>';
        }
    }

    function items(){
        foreach($this->items as $item){
            $this->item($item);
        }
    }

    function item($item){
        if(method_exists($this,$item['type'])){
            $this->{$item['type']}($item);
        }
    }

    function text($item){
       $field = '<input type="text" name="'.$item['name'].'" '.($item['required'] == 'required' ? 'required' : '').' placeholder="'.$item['placeholder'].'" class="%s" />';

       $this->{$this->template}($field, $item);
    }

    function email($item){
        $field = '<input type="email" name="'.$item['name'].'" '.($item['required'] == 'required' ? 'required' : '').' placeholder="'.$item['placeholder'].'" class="%s" />';
 
        $this->{$this->template}($field, $item);
    }

     function submit($item){
        $field = '<input type="submit" value="'.$item['value'].'" class="%s" />';
 
        $this->{$this->template}($field, $item);
     }

     function textarea($item){
        $field = '<textarea name="'.$item['name'].'" '.($item['required'] == 'required' ? 'required' : '').' placeholder="'.$item['placeholder'].'" class="%s" ></textarea>';
 
        $this->{$this->template}($field, $item);
     }

    function template1($field, $item){
        echo '<div class="pi-row">';
        echo '<div class="pi-col-12">';
        if($item['type'] == 'submit'){
            printf($field, 'pi-btn pi-btn-primary');
        }else{
            printf($field, 'pi-form-control');
        }
        echo '</div>';
        echo '</div>';
    }
}