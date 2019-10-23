<?php

class Pi_Eqw_Menu{

    public $plugin_name;
    public $menu;
    
    function __construct($plugin_name , $version){
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        add_action( 'admin_menu', array($this,'plugin_menu') );
        add_action($this->plugin_name.'_promotion', array($this,'promotion'));
    }

    function plugin_menu(){
        
        $this->menu = add_submenu_page(
            'edit.php?post_type=pisol_enquiry',
            __( 'Enquiry Setting'),
            __( 'Enquiry Setting'),
            'manage_options',
            'pisol-enquiry-quote',
            array($this, 'menu_option_page')
        );

        add_action("load-".$this->menu, array($this,"bootstrap_style"));
 
    }

    public function bootstrap_style() {
        
		wp_enqueue_style( $this->plugin_name."_bootstrap", plugin_dir_url( __FILE__ ) . 'css/bootstrap.css', array(), $this->version, 'all' );
		
	}

    function menu_option_page(){
        ?>
        <div class="container mt-2">
            <div class="row">
                    <div class="col-12">
                        <div class='bg-dark'>
                        <div class="row">
                            <div class="col-12 col-sm-2 py-2">
                                    <a href="https://www.piwebsolution.com/" target="_blank"><img class="img-fluid ml-2" src="<?php echo plugin_dir_url( __FILE__ ); ?>img/pi-web-solution.png"></a>
                            </div>
                            <div class="col-12 col-sm-10 d-flex">
                                <?php do_action($this->plugin_name.'_tab'); ?>
                                <!--<a class=" px-3 text-light d-flex align-items-center  border-left border-right  bg-info " href="https://www.piwebsolution.com/documentation-for-live-sales-notifications-for-woocommerce-plugin/">
                                    Documentation
                                </a>-->
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-12">
                <div class="bg-light border pl-3 pr-3 pb-3 pt-0">
                    <div class="row">
                        <div class="col">
                        <?php do_action($this->plugin_name.'_tab_content'); ?>
                        </div>
                        <?php do_action($this->plugin_name.'_promotion'); ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <?php
    }

    function promotion(){
        ?>
        <div class="col-12 col-sm-12 col-md-4 pt-3">
            <div class="bg-primary text-light text-center mb-3">
                <a class="" href="<?php echo PI_EQW_BUY_URL; ?>" target="_blank">
                <?php new pisol_promotion('pisol_enquiry_installation_date'); ?>
                </a>
            </div>

            <div class="bg-dark p-3 text-light text-center mb-3">
                <h2 class="text-light font-weight-light "><span>Get Pro for<br><h1 class="h2 font-weight-bold text-light my-1"><?php echo PI_EQW_PRICE; ?></h1><h4 class=" my-1">Regular price <s>$35</s></h4> <strong class="text-primary">LIMITED</strong> PERIOD OFFER<br>  Buy Now !!</span></h2>
                <div class="inside">
                    PRO version offers more features like<br><br>
                    <ul class="text-left">
                        <li class="border-top py-1 font-weight-light h6">Support variable products</li>
                        <li class="border-top py-1 font-weight-light h6">Show enquiry option only when the product is out of stock</li>
                        <li class="border-top py-1 font-weight-light h6">Change the position of the enquiry button on the product loop page and single product page</li>
                        <li class="border-top py-1 font-weight-light h6">Remove add to cart button so you only receive enquiries</li>
                        <li class="border-top py-1 font-weight-light h6">Add multiple email id to admin email list</li>
                        <li class="border-top py-1 font-weight-light h6">Adding custom message in customer email</li>
                        <li class="border-top py-1 font-weight-light h6">Adding custom message in admin email</li>
                        <li class="border-top py-1 font-weight-light h6">Modify the success message on form submission</li>
                        <li class="border-top py-1 font-weight-light h6">Making a form field as non required field</li>
                    </ul>
                    <a class="btn btn-light" href="<?php echo PI_EQW_BUY_URL; ?>" target="_blank">Click to Buy Now</a>
                </div>
            </div>

        </div>
        <?php
    }

    function isWeekend() {
        return (date('N', strtotime(date('Y/m/d'))) >= 6);
    }

}