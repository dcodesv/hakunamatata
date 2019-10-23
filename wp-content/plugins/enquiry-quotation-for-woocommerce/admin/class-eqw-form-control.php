<?php

class Class_Pi_Eqw_Form_Control{

    public $plugin_name;

    private $settings = array();

    private $active_tab;

    private $this_tab = 'form_control';

    private $tab_name = "Form control";

    private $setting_key = 'pi_eqw_form_control';
    

    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;

        $this->settings = array(
            
            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>"Making enquiry form field as required", 'type'=>"setting_category"),
            array('field'=>'pi_eqw_name_required','type'=>'switch','label'=>"Name Field",'default'=>1,'pro'=>true),
            array('field'=>'pi_eqw_email_required','type'=>'switch','label'=>"Email Field",'default'=>1,'pro'=>true),
            array('field'=>'pi_eqw_phone_required','type'=>'switch','label'=>"Phone Field",'default'=>1,'pro'=>true),
            array('field'=>'pi_eqw_subject_required','type'=>'switch','label'=>"Subject Field",'default'=>1,'pro'=>true),
            array('field'=>'pi_eqw_message_required','type'=>'switch','label'=>"Message Field",'default'=>1,'pro'=>true),
            
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

new Class_Pi_Eqw_Form_Control($this->plugin_name);