<?php

class Class_Pi_Eqw_Advance{

    public $plugin_name;

    private $settings = array();

    private $active_tab;

    private $this_tab = 'advance';

    private $tab_name = "Advance option";

    private $setting_key = 'pi_eqw_advance_setting';
    
    

    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;

        $this->settings = array(
            
            array('field'=>'pi_eqw_remove_add_to_cart', 'label'=>__('Remove add to cart button'),'type'=>'switch', 'default'=>0,   'desc'=>__('This will remove the add to cart button from website'),'pro'=>true),

            array('field'=>'pi_eqw_hide_price', 'label'=>__('Hide price'),'type'=>'select', 'default'=>'no',   'desc'=>__('This will hide the price based on the selections, If price is hidden then the add to cart button will also be hidden'), 'value'=>array('no'=>'Dont hide', 'all'=>'Hide for all', 'guest'=>'Hide for non log-in users')),
            
            array('field'=>'pi_eqw_enquiry_cart', 'label'=>__('Select the page where to show the enquiry cart'),'type'=>'select', 'default'=>0, 'value'=>$this->pages(),  'desc'=>'Enquiry button position on show / category page'),

            array('field'=>'pi_eqw_redirect_to_enquiry_cart', 'label'=>__('Redirect WooCommerce cart and checkout page to enquiry cart page'),'type'=>'switch', 'default'=>0,   'desc'=>__('This will redirect all the traffic on cart and checkout page to enquiry cart page')),

            array('field'=>'pi_eqw_success_message', 'label'=>__('Success message shown on form submission'),'type'=>'text', 'default'=>__('Enquiry submitted'),   'desc'=>__('This is the message that is shown on successful submission of the enquiry'),'pro'=>true),

        );
        
        $this->active_tab = (isset($_GET['tab'])) ? sanitize_text_field($_GET['tab']) : 'default';

        if($this->this_tab == $this->active_tab){
            add_action($this->plugin_name.'_tab_content', array($this,'tab_content'));
        }


        add_action($this->plugin_name.'_tab', array($this,'tab'),1);

       
        $this->register_settings();

        if(PI_EQW_DELETE_SETTING){
            $this->delete_settings();
        }
    }

    function pages(){
        $pages = array(0 => 'Select page for Enquiry cart');
        $obj = get_pages();
        foreach($obj as $page){
            $pages[$page->ID] = $page->post_title;
        }
        return $pages;

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

new Class_Pi_Eqw_Advance($this->plugin_name);