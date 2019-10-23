<?php

class Class_Pi_Eqw_Email{

    public $plugin_name;

    private $settings = array();

    private $active_tab;

    private $this_tab = 'email';

    private $tab_name = "Email setting";

    private $setting_key = 'pi_eqw_email_setting';
    

    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;

        $this->settings = array(
            
            
            array('field'=>'pi_eqw_email', 'label'=>__('Email id'),'type'=>'text',   'desc'=>'Email id that will receive the enquiry, <strong class="text-danger">In PRO version you can add multiple email separated with coma like this text@email.com, text2@email.com </strong>','default'=> get_option('admin_email')),
            array('field'=>'pi_eqw_email_subject', 'label'=>__('Subject of the email'),'type'=>'text', 'default'=>__('New enquiry received'),  'desc'=>'subject of the email'),
            array('field'=>'pi_eqw_email_to_customer', 'label'=>__('Send enquiry email to custom as well'),'type'=>'switch','default'=>1, 'desc'=>__('Will send the enquiry email copy to customer as well'), 'pro'=>true),
            array('field'=>'pi_eqw_customer_email_subject', 'label'=>__('Subject of the email to customer'),'type'=>'text', 'default'=>__('Your enquiry is submitted'),  'desc'=>'Subject of the enquiry email send to customer', 'pro'=>true),
            array('field'=>'pi_eqw_company_logo', 'label'=>__('Logo added in the email'),'type'=>'image', 'desc'=>'This is the image that will be added inside the email copy, sed to you and the customer','pro'=>true),

            array('field'=>'pi_eqw_email_disable_logo', 'label'=>__('Enable logo in email'),'type'=>'switch','default'=>1, 'desc'=>__('This will remove the logo from the email template'),'pro'=>true),
            
            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>"Custom message for customer email", 'type'=>"setting_category"),

            array('field'=>'pi_eqw_customer_email_above_product_table', 'label'=>__('Above product table'),'type'=>'textarea', 'default'=>"",   'desc'=>__('This message will appear above the product table'),'pro'=>true),
            
            array('field'=>'pi_eqw_customer_email_below_product_table', 'label'=>__('Below product table'),'type'=>'textarea', 'default'=>"",   'desc'=>__('This message will appear below the product table'),'pro'=>true),

            array('field'=>'pi_eqw_customer_email_below_customer_detail', 'label'=>__('Below customer detail'),'type'=>'textarea', 'default'=>"",   'desc'=>__('This message will appear below the customer detail table'),'pro'=>true),

            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>"Custom message for admin email", 'type'=>"setting_category"),

            array('field'=>'pi_eqw_admin_email_above_product_table', 'label'=>__('Above product table'),'type'=>'textarea', 'default'=>"",   'desc'=>__('This message will appear above the product table'),'pro'=>true),
            
            array('field'=>'pi_eqw_admin_email_below_product_table', 'label'=>__('Below product table'),'type'=>'textarea', 'default'=>"",   'desc'=>__('This message will appear below the product table'),'pro'=>true),

            array('field'=>'pi_eqw_admin_email_below_customer_detail', 'label'=>__('Below customer detail'),'type'=>'textarea', 'default'=>"",   'desc'=>__('This message will appear below the customer detail table'),'pro'=>true)
            
            
        );
        
        $this->active_tab = (isset($_GET['tab'])) ? sanitize_text_field($_GET['tab']) : 'default';

        if($this->this_tab == $this->active_tab){
            add_action($this->plugin_name.'_tab_content', array($this,'tab_content'));
        }


        add_action($this->plugin_name.'_tab', array($this,'tab'),3);

       
        $this->register_settings();

        if(PI_EQW_DELETE_SETTING){
            $this->delete_settings();
        }

        
    }

    
    function delete_settings(){
        foreach($this->settings as $setting){
            delete_option( $setting['field'] );
        }
    }

    function register_settings(){   

        foreach($this->settings as $setting){
            register_setting( $this->setting_key, $setting['field']);
        }
    
    }

    function tab(){
        ?>
        <a class=" px-3 text-light d-flex align-items-center  border-left border-right  <?php echo ($this->active_tab == $this->this_tab ? 'bg-primary' : 'bg-secondary'); ?>" href="<?php echo admin_url( 'admin.php?page='.sanitize_text_field($_GET['page']).'&tab='.$this->this_tab ); ?>">
            <?php _e( $this->tab_name); ?> 
        </a>
        <?php
    }

    function tab_content(){
        ?>
        <form method="post" action="options.php"  class="pisol-setting-form">
        <?php settings_fields( $this->setting_key ); ?>
        <?php
            foreach($this->settings as $setting){
                new pisol_class_form_eqw($setting, $this->setting_key);
            }
        ?>
        <input type="submit" class="mt-3 btn btn-primary btn-sm" value="Save Option" />
        </form>
       <?php
    }

    

    

   
    
}

new Class_Pi_Eqw_Email($this->plugin_name);