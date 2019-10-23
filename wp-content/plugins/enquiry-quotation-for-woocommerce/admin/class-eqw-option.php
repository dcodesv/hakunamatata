<?php

class Class_Pi_Eqw_Option{

    public $plugin_name;

    private $settings = array();

    private $active_tab;

    private $this_tab = 'default';

    private $tab_name = "Enquiry Button";

    private $setting_key = 'pi_eqw_basic_setting';
    
    

    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;

        $this->settings = array(
            array('field'=>'title', 'class'=> 'bg-dark text-bold text-center', 'class_title'=>'text-light font-weight-light ', 'label'=>"If you are using a Caching plugin, Make sure you do not Cache the enquiry cart page [enquiry_cart], if it is cached then enquiry cart will remain empty. So put the enquiry cart page as an exception in your caching plugin", 'type'=>"setting_category"),
            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>"Enquiry button on shop / category page", 'type'=>"setting_category"),

            array('field'=>'pi_eqw_enquiry_loop', 'label'=>__('Enquiry button on category/show page'),'type'=>'switch', 'default'=>0,   'desc'=>__('This will show enquiry button on loop product like shop, category page')),

            array('field'=>'pi_eqw_enquiry_loop_pro', 'label'=>__('Show button on Variable Product'),'type'=>'switch', 'default'=>0,   'desc'=>__('This will show enquiry button on variable product'), 'pro'=>true),

            array('field'=>'pi_eqw_loop_show_on_out_of_stock_pro', 'label'=>__('Show enquiry option only when product is out of stock'),'type'=>'switch', 'default'=>0,   'desc'=>__('On shop / category product page'), 'pro'=>true),

            array('field'=>'pi_eqw_enquiry_loop_position', 'label'=>__('Position on shop/category page'),'type'=>'select', 'default'=> 'woocommerce_after_shop_loop_item', 'value'=>array('woocommerce_after_shop_loop_item'=>__('At the end of product'), 'woocommerce_before_shop_loop_item'=>__('At the start of the product'), 'woocommerce_before_shop_loop_item_title'=>__('Before product title'), 'woocommerce_after_shop_loop_item_title'=>__('After product title')),  'desc'=>'Enquiry button position on show / category page', 'pro'=>true),

            array('field'=>'pi_eqw_enquiry_loop_bg_color', 'type'=>'color', 'default'=>'#ee6443','label'=>__('Background color'),'desc'=>__('Background color of the button on the shop / category page')),

            array('field'=>'pi_eqw_enquiry_loop_text_color', 'type'=>'color', 'default'=>'#ffffff','label'=>__('Text color'),'desc'=>__('Text color of the button on the shop / category page')),

            array('field'=>'pi_eqw_enquiry_loop_button_text', 'type'=>'text', 'default'=>__('Add to Enquiry'),'label'=>__('Enquiry button text'),'desc'=>__('Text shown in the enquiry button')),
            


            
            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>"Enquiry button on single product page", 'type'=>"setting_category"),

            array('field'=>'pi_eqw_enquiry_single', 'label'=>__('Enquiry button on single product page'),'type'=>'switch', 'default'=>1,   'desc'=>__('This will show enquiry button on single product page')),

            array('field'=>'pi_eqw_enquiry_single_pro', 'label'=>__('Show button on Variable Product'),'type'=>'switch', 'default'=>0,   'desc'=>__('This will show enquiry button on variable product'), 'pro'=>true),

            array('field'=>'pi_eqw_single_show_on_out_of_stock_pro', 'label'=>__('Show enquiry option Only when product is out of stock'),'type'=>'switch', 'default'=>0,   'desc'=>__('On single product page'), 'pro'=>true),

            array('field'=>'pi_eqw_enquiry_single_position', 'label'=>__('Position on single product page'),'type'=>'select', 'default'=> 52, 'value'=> array(4 =>__('Before summary'), 52 => __('After Summary'), 36 => __('After add to cart button'), 29 => __('Before add to cart button')),  'desc'=>'Enquiry button position on single product page', 'pro'=>true),

            array('field'=>'pi_eqw_enquiry_single_bg_color', 'type'=>'color', 'default'=>'#ee6443','label'=>__('Background color'),'desc'=>__('Background color of the button on the shop / category page')),

            array('field'=>'pi_eqw_enquiry_single_text_color', 'type'=>'color', 'default'=>'#ffffff','label'=>__('Text color'),'desc'=>__('Text color of the button on the shop / category page')),

            array('field'=>'pi_eqw_enquiry_single_button_text', 'type'=>'text', 'default'=>__('Add to Enquiry'),'label'=>__('Enquiry button text'),'desc'=>__('Text shown in the enquiry button')),

            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>"Processing image", 'type'=>"setting_category"),

            array('field'=>'pisol_eqw_loading_img', 'type'=>'image','label'=>__('Processing image'),'desc'=>__('Image is shown as loading image'), 'pro'=>true),
           

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

new Class_Pi_Eqw_Option($this->plugin_name);