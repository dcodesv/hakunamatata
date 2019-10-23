<?php

class class_pisol_eqw_email{


    function __construct($items){

        $this->items = $items;

        $this->email = $this->explodeEmail(get_option('pi_eqw_email', get_option('admin_email')));


        $this->subject = get_option('pi_eqw_email_subject','New Enquiry');

        $this->message = $this->message();

        $this->customer_email = sanitize_email($_POST['pi_email']);
        $this->customer_subject = 'Your enquiry is submitted';
        $this->send_copy_to_customer = 1;

        add_action('phpmailer_init',array($this,'attachInlineImage'));

    }

    function explodeEmail($email_ids){
        $array = explode(',',$email_ids);
        return $array[0];
    }

    function sendEmail(){
        $this->send();
        if($this->send_copy_to_customer == 1){
            $this->sendCustomer();
        }
    }

    function message(){
        ob_start();  
        include_once('partials/email-template.php');
        $template = ob_get_contents();  
        ob_end_clean();  

        ob_start();  
        $this->products = class_eqw_enquiry_cart::getProductsInEnquirySession();
        include_once('partials/pisol-eqw-email.php');
        $content = ob_get_contents();  
        ob_end_clean();  

        $logo = $this->logo();

        $find = array('{content}','{logo}');

        $replace = array($content, $logo);

        $message = str_replace( $find, $replace, $template);
        
        return $message;
    }

    function send(){
        $headers = array('Content-Type: text/html; charset=UTF-8', 'Reply-To: '.$this->customer_email);
         
        if(wp_mail($this->email, $this->subject, $this->message, $headers)){
           return true;
        }
        return false;
    }

    function sendCustomer(){
        $headers = array('Content-Type: text/html; charset=UTF-8');
         
        if(wp_mail($this->customer_email, $this->customer_subject, $this->message, $headers)){
           return true;
        }
        return false;
    }
    
    function attachInlineImage() {  
        global $phpmailer;  
        /** attach logo */
        $file = plugin_dir_path( dirname( __FILE__ ) ) . '/public/img/Logo.png'; //phpmailer will load this file  
        $uid = 'pi_logo'; //will map it to this UID  
        $name = 'Logo.png'; //this will be the file name for the attachment  
        if (is_file($file)) {  
          $phpmailer->AddEmbeddedImage($file, $uid, $name);  
        }  
        /* end attach logo */

        $this->attachProductImages($phpmailer);
    }  

    function attachImage($image_id, $phpmailer){
        $file = get_attached_file($image_id);
        $uid = 'image_'.$image_id;
        $name = 'image_'.$image_id;
        if (is_file($file)) {  
            $phpmailer->AddEmbeddedImage($file, $uid, $name);  
        }  
    }

    function attachProductImages($phpmailer){
        foreach($this->products as $key => $product){
            $prod = wc_get_product($product['id']);
            $image_id = $prod->get_image_id();
            $this->attachImage($image_id, $phpmailer);
        }
    }

    function logo(){
        $show_logo = get_option('pi_eqw_email_disable_logo',1);
        $pi_eqw_company_logo = get_option('pi_eqw_company_logo',"");
        $image_id = 'pi_logo';
        if($show_logo == 1){
            return '<img alt="Image" border="0" src="cid:'.$image_id.'" style="max-width:100%; width:300px; height:auto;">';
        }else{
            return "";
        }
    }
}


