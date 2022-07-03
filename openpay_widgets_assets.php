<?php
/*
Plugin Name: Openpay Widgets
Plugin URI: https://github.com/openpay-innovations/openpay-widgets-woocommerce
Description: Reminds customers to choose Openpay as their payment method at checkout. Works only when WooCommerce is active.
Version: 1.1.1
Author: Opy
Author URI: https://www.opy.com/

Copyright: Openpay | All Rights Reserved
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Openpay_JsPlugin')) {
    
    class Openpay_JsPlugin
    {
        /**
         * @var     Openpay_JsPlugin        $instance   A static reference to an instance of this class.
         */
        protected static $instance;

        /**
         * @var     int                 $version    A reference to the plugin version, which will match
         *                                          the value in the comments above.
         */
        public static $version = '1.0.0';

        /**
         * Import required classes.
         *
         * @since   2.0.0
         * @used-by self::init()
         * @used-by self::deactivate_plugin()
         */
        public static function load_classes()
        {
            require_once dirname(__FILE__) . '/partial/openpaywidget.php';
        }

       
        public function __construct()
        {

                    add_action('wp_enqueue_scripts', array($this, 'init_Openpay_assets'), 10, 0);
                    add_action('wp_footer', array($this, 'add_script_footer'), 10, 0);
                    add_action('wp_head', array($this, 'generate_head_hooks'), 10, 0);
                    add_action('woocommerce_proceed_to_checkout', array($this, 'generate_cart_hooks'), 10, 0);
                    add_action('woocommerce_single_product_summary', array($this, 'generate_product_hooks'), 15, 0);
                    add_action('woocommerce_after_shop_loop_item_title', array($this, 'generate_category_hooks'), 11);
                    add_action('wp_footer', array($this, 'add_script_footerr'));
                    add_action('wp_ajax_get_price_product', array($this, 'get_price_product'));
                    add_action('wp_ajax_nopriv_get_price_product', array($this,'get_price_product'));
                    
                    add_action('admin_head', array($this, 'openpayadmincss'));

                      $openpay_widget_options = get_option('openpay_widget_option_name'); // Array of All Options
            $enable_0 = $openpay_widget_options['enable_0']; // Enable
            $region_1 = $openpay_widget_options['region_1']; // Region
            $plan_tiers_2 = $openpay_widget_options['plan_tiers_2']; // Plan Tiers
            $show_info_belt_widget_6 = $openpay_widget_options['show_info_belt_widget_6']; // Show Info Belt Widget
            $show_info_belt_widget_sticky_61 = $openpay_widget_options['show_info_belt_widget_sticky_61']; // Show Info Belt Widget
            $show_cart_widget_8 = $openpay_widget_options['show_cart_widget_8']; // Show Cart Widget
            $show_product_page_widget_9 = $openpay_widget_options['show_product_page_widget_9']; // Show Product Page Widget
            $show_catalog_page_widget_10 = $openpay_widget_options['show_catalog_page_widget_10']; // Show Catalog Page Widget
            $show_checkout_page_widget_12 = $openpay_widget_options['show_checkout_page_widget_12']; // Show Openpay Logo


            if ($enable_0 == 'yes') {
                if ($show_checkout_page_widget_12 == 'yes') {
                    add_filter('wc_get_template', array($this, 'Openpaycheckout_widget'), 10, 5);
                }
            }
        }


        public function Openpaycheckout_widget($located, $template_name, $args, $template_path, $default_path)
        {


            $openpay_widget_options = get_option('openpay_widget_option_name'); // Array of All Options
            $enable_0 = $openpay_widget_options['enable_0']; // Enable
            $region_1 = $openpay_widget_options['region_1']; // Region
            $plan_tiers_2 = $openpay_widget_options['plan_tiers_2']; // Plan Tiers
            $show_info_belt_widget_6 = $openpay_widget_options['show_info_belt_widget_6']; // Show Info Belt Widget
            $show_info_belt_widget_sticky_61 = $openpay_widget_options['show_info_belt_widget_sticky_61']; // Show Info Belt Widget
            $show_cart_widget_8 = $openpay_widget_options['show_cart_widget_8']; // Show Cart Widget
            $show_product_page_widget_9 = $openpay_widget_options['show_product_page_widget_9']; // Show Product Page Widget
            $show_catalog_page_widget_10 = $openpay_widget_options['show_catalog_page_widget_10']; // Show Catalog Page Widget
            $show_checkout_page_widget_12 = $openpay_widget_options['show_checkout_page_widget_12']; // Show Openpay Logo


            
            if ($template_name=='checkout/payment-method.php' && $args['gateway']->id == 'openpay') {
                return plugin_dir_path(__FILE__).'partial/openpay-payment-template.php';
            }
                    return $located;
        }
         
         
        

       
        public function generate_product_hooks()
        {

            $openpay_widget_options = get_option('openpay_widget_option_name'); // Array of All Options
            $enable_0 = $openpay_widget_options['enable_0']; // Enable
            $region_1 = $openpay_widget_options['region_1']; // Region
            $plan_tiers_2 = $openpay_widget_options['plan_tiers_2']; // Plan Tiers
            $show_info_belt_widget_6 = $openpay_widget_options['show_info_belt_widget_6']; // Show Info Belt Widget
            $show_info_belt_widget_sticky_61 = $openpay_widget_options['show_info_belt_widget_sticky_61']; // Show Info Belt Widget
            $show_cart_widget_8 = $openpay_widget_options['show_cart_widget_8']; // Show Cart Widget
            $show_product_page_widget_9 = $openpay_widget_options['show_product_page_widget_9']; // Show Product Page Widget
            $show_catalog_page_widget_10 = $openpay_widget_options['show_catalog_page_widget_10']; // Show Catalog Page Widget
            $show_openpay_logo_11 = $openpay_widget_options['show_openpay_logo_11']; // Show Openpay Logo
            
            $openpay_logo_18 = $openpay_widget_options['openpay_logo_18'];
            $openpay_pdp_infoicon = $openpay_widget_options['openpay_pdp_infoicon'];
            $openpay_pdp_logo_position = $openpay_widget_options['openpay_pdp_logo_position'];
            $openpay_pdp_learnmore_text = $openpay_widget_options['openpay_pdp_learnmore_text'];


            if ($enable_0 == 'yes') {
                if ($show_product_page_widget_9 == 'yes') {
                    global $product;
                    $child_prices = array();

                    $tax_display_mode = get_option('woocommerce_tax_display_shop');

                    if ($product->is_type('variable')) {
                        foreach ($product->get_children() as $child_id) {
                            $child = wc_get_product($child_id);

                            $child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax($child) : wc_get_price_excluding_tax($child);
                        }
                    } elseif ($product->is_type('grouped')) {
                        foreach ($product->get_children() as $child_id) {
                            $child = wc_get_product($child_id);

                            $child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax($child) : wc_get_price_excluding_tax($child);
                        }
                    }

                    if (!empty($child_prices)) {
                        $price = min($child_prices);
                    } else {
                        $price = wc_get_price_including_tax($product);
                    }

                    ?>
            <div  class="opyproduct"><opy-product-page amount="<?php echo $price; ?>" logo="<?php echo $openpay_logo_18; ?>" logo-position="<?php echo $openpay_pdp_logo_position; ?>" more-info-text="<?php echo $openpay_pdp_learnmore_text; ?>" info-icon="<?php echo $openpay_pdp_infoicon; ?>"></opy-product-page></div>
                <?php }
            }
        }


        function add_script_footerr()
        {

            if (is_product()) {
                ?>

<script type="text/javascript">

    jQuery(document).on('change', '.woocommerce select', function () {

        var variationid = jQuery("input[name=variation_id]").val();

        var product_id = jQuery("input[name=product_id]").val();





        var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';



        if(variationid) {

          var data = {

            'action': 'get_price_product',

            'variationid': variationid,

            'product_id': product_id,

          };



          jQuery.post(ajax_url, data, function(response) {

            if(response) {

              //console.log(response);

          var sephtml = response.html;

          var finalhtml = sephtml.replace(/\\/g, "");

          jQuery('.opyproduct').html(finalhtml);

            }

          });

        }



  });




</script>

                <?php
            }
        }



        function get_price_product()
        {

            $variationid = $_POST['variationid'];

            $product_id = $_POST['product_id'];


            global $product;

            $product = wc_get_product($variationid);

            $child_prices = array();

            $tax_display_mode = get_option('woocommerce_tax_display_shop');

            if ($product->is_type('variable')) {
                foreach ($product->get_children() as $child_id) {
                    $child = wc_get_product($child_id);

                    $child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax($child) : wc_get_price_excluding_tax($child);
                }
            } elseif ($product->is_type('grouped')) {
                foreach ($product->get_children() as $child_id) {
                    $child = wc_get_product($child_id);

                    $child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax($child) : wc_get_price_excluding_tax($child);
                }
            }

            if (!empty($child_prices)) {
                $variationprice = min($child_prices);
            } else {
                $variationprice = $product->get_price();
            }
            
            $openpay_widget_options = get_option('openpay_widget_option_name');
            $openpay_logo_18 = $openpay_widget_options['openpay_logo_18'];
            $openpay_pdp_infoicon = $openpay_widget_options['openpay_pdp_infoicon'];
            $openpay_pdp_logo_position = $openpay_widget_options['openpay_pdp_logo_position'];
            $openpay_pdp_learnmore_text = $openpay_widget_options['openpay_pdp_learnmore_text'];

            $html.= '<div  class="opyproduct"><opy-product-page amount="' .$variationprice.'" logo="'.$openpay_logo_18.'" more-info-text="'.$openpay_pdp_learnmore_text.'" info-icon="'.$openpay_pdp_infoicon.'" logo-position="'.$openpay_pdp_logo_position.'"></opy-product-page></div>';

            

        
    

            $p_id = $_POST['product_id'];

            //$arr = array('a' => $p_id, 'b' => utf8_encode($html));

            $arr = array('html' => utf8_encode($html));

            wp_send_json($arr);

            die();
        }


        public function generate_category_hooks()
        {
            $openpay_widget_options = get_option('openpay_widget_option_name'); // Array of All Options
            $enable_0 = $openpay_widget_options['enable_0']; // Enable
            $region_1 = $openpay_widget_options['region_1']; // Region
            $plan_tiers_2 = $openpay_widget_options['plan_tiers_2']; // Plan Tiers
            $show_info_belt_widget_6 = $openpay_widget_options['show_info_belt_widget_6']; // Show Info Belt Widget
            $show_info_belt_widget_sticky_61 = $openpay_widget_options['show_info_belt_widget_sticky_61']; // Show Info Belt Widget
            $show_cart_widget_8 = $openpay_widget_options['show_cart_widget_8']; // Show Cart Widget
            $show_product_page_widget_9 = $openpay_widget_options['show_product_page_widget_9']; // Show Product Page Widget
            $show_catalog_page_widget_10 = $openpay_widget_options['show_catalog_page_widget_10']; // Show Catalog Page Widget
            $show_openpay_logo_11 = $openpay_widget_options['show_openpay_logo_11']; // Show Openpay Logo
            $openpay_logo_17 = $openpay_widget_options['openpay_logo_17'];


            if ($enable_0 == 'yes') {
                if ($show_catalog_page_widget_10 == 'yes') {
                    global $product;
                    $child_prices = array();

                    $tax_display_mode = get_option('woocommerce_tax_display_shop');

                    if ($product->is_type('variable')) {
                        foreach ($product->get_children() as $child_id) {
                            $child = wc_get_product($child_id);

                            $child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax($child) : wc_get_price_excluding_tax($child);
                        }
                    } elseif ($product->is_type('grouped')) {
                        foreach ($product->get_children() as $child_id) {
                            $child = wc_get_product($child_id);

                            $child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax($child) : wc_get_price_excluding_tax($child);
                        }
                    }

                    if (!empty($child_prices)) {
                        $price = min($child_prices);
                    } else {
                        $price = wc_get_price_including_tax($product);
                    }

                     $showlogo = ($show_openpay_logo_11 === 'yes') ? 'false' : 'true';



                    ?>
            <div class="opycatalog"><opy-product-listing amount="<?php echo $price;?>" hide-logo="<?php echo $showlogo;?>" logo="<?php echo $openpay_logo_17; ?>"></opy-product-listing></div>
                <?php }
            }
        }

        public function generate_cart_hooks()
        {

            if (!is_checkout() && !is_cart()) {
                return;
            }
            global $woocommerce;
            $cart_total = $woocommerce->cart->total;

            $openpay_widget_options = get_option('openpay_widget_option_name'); // Array of All Options
            $enable_0 = $openpay_widget_options['enable_0']; // Enable
            $region_1 = $openpay_widget_options['region_1']; // Region
            $plan_tiers_2 = $openpay_widget_options['plan_tiers_2']; // Plan Tiers
            $show_info_belt_widget_6 = $openpay_widget_options['show_info_belt_widget_6']; // Show Info Belt Widget
            $show_info_belt_widget_sticky_61 = $openpay_widget_options['show_info_belt_widget_sticky_61']; // Show Info Belt Widget
             $show_cart_widget_8 = $openpay_widget_options['show_cart_widget_8']; // Show Cart Widget
            
            $show_product_page_widget_9 = $openpay_widget_options['show_product_page_widget_9']; // Show Product Page Widget
            $show_catalog_page_widget_10 = $openpay_widget_options['show_catalog_page_widget_10']; // Show Catalog Page Widget
            $show_openpay_logo_11 = $openpay_widget_options['show_openpay_logo_11']; // Show Openpay Logo
            $openpay_logo_19 = $openpay_widget_options['openpay_logo_19'];
            
            $openpay_pdp_infoicon = $openpay_widget_options['openpay_pdp_infoicon'];
            $openpay_pdp_logo_position = $openpay_widget_options['openpay_pdp_logo_position'];
            $openpay_pdp_learnmore_text = $openpay_widget_options['openpay_pdp_learnmore_text'];
            
            $openpay_cart_infoicon = $openpay_widget_options['openpay_cart_infoicon'];
            $openpay_cart_learnmore_text = $openpay_widget_options['openpay_cart_learnmore_text'];

            if ($enable_0 == 'yes') {
                if ($show_cart_widget_8  == 'yes') {
                    ?>

            <div class="opycart"><opy-cart amount="<?php echo $cart_total;?>" logo="<?php echo $openpay_logo_19; ?>" more-info-text="<?php echo $openpay_cart_learnmore_text; ?>" info-icon="<?php echo $openpay_cart_infoicon; ?>"></opy-cart></div>

                <?php }
            }
        }

        function generate_head_hooks()
        {
            $openpay_widget_options = get_option('openpay_widget_option_name'); // Array of All Options
            $enable_0 = $openpay_widget_options['enable_0']; // Enable
            $region_1 = $openpay_widget_options['region_1']; // Region
            $plan_tiers_2 = $openpay_widget_options['plan_tiers_2']; // Plan Tiers
            $show_info_belt_widget_6 = $openpay_widget_options['show_info_belt_widget_6']; // Show Info Belt Widget
            $show_info_belt_widget_sticky_61 = $openpay_widget_options['show_info_belt_widget_sticky_61']; // Show Info Belt Widget
            $show_cart_widget_8 = $openpay_widget_options['show_cart_widget_8']; // Show Cart Widget
            $show_product_page_widget_9 = $openpay_widget_options['show_product_page_widget_9']; // Show Product Page Widget
            $show_catalog_page_widget_10 = $openpay_widget_options['show_catalog_page_widget_10']; // Show Catalog Page Widget
            $show_openpay_logo_11 = $openpay_widget_options['show_openpay_logo_11']; // Show Openpay Logo


            if ($enable_0 == 'yes') {
                $openpay_widget_options = get_option('openpay_widget_option_name');
                $info_belt_widget_color_7 = $openpay_widget_options['info_belt_widget_color_7']; // Info Belt Widget Color
                if (($show_info_belt_widget_6 == 'homepage') && is_front_page()) {
                    ?>

<div id="openpayinfobelt"><opy-info-belt color="<?php echo $info_belt_widget_color_7; ?>"></opy-info-belt></div><div id="openpaybottom"></div>
                <?php } elseif ($show_info_belt_widget_6 == 'acrossthesite') {?>
                    <div id="openpayinfobelt"><opy-info-belt color="<?php echo $info_belt_widget_color_7; ?>"></opy-info-belt></div><div id="openpaybottom"></div>

                    <?php
                }
            }
        }

       
        public function init_Openpay_assets()
        {

            $openpay_widget_options = get_option('openpay_widget_option_name'); // Array of All Options
            $enable_0 = $openpay_widget_options['enable_0']; // Enable
            $region_1 = $openpay_widget_options['region_1']; // Region
            $plan_tiers_2 = $openpay_widget_options['plan_tiers_2']; // Plan Tiers
            $show_info_belt_widget_6 = $openpay_widget_options['show_info_belt_widget_6']; // Show Info Belt Widget
            $show_info_belt_widget_sticky_61 = $openpay_widget_options['show_info_belt_widget_sticky_61']; // Show Info Belt Widget
            $show_cart_widget_8 = $openpay_widget_options['show_cart_widget_8']; // Show Cart Widget
            $show_product_page_widget_9 = $openpay_widget_options['show_product_page_widget_9']; // Show Product Page Widget
            $show_catalog_page_widget_10 = $openpay_widget_options['show_catalog_page_widget_10']; // Show Catalog Page Widget
            $show_openpay_logo_11 = $openpay_widget_options['show_openpay_logo_11']; // Show Openpay Logo

            if ($enable_0 == 'yes') {
                if (($show_info_belt_widget_6 == 'yes') || ($show_cart_widget_8 == 'yes') || ($show_product_page_widget_9 == 'yes') || ($show_catalog_page_widget_10 == 'yes')) {
                    wp_enqueue_style('openpay_widget_style', plugins_url('css/openpay-widgets.css', __FILE__), '1.0.0', false);
                }
            }
        }

    

        function add_script_footer()
        {
            
            if(get_option('woocommerce_openpay_settings')){
                $payment_plugin_options = get_option('woocommerce_openpay_settings');               
            
                $minimum_checkout = $payment_plugin_options['minimum'];
                $maximum_checkout = $payment_plugin_options['maximum'];
            } else {
                $minimum_checkout = "";
                $maximum_checkout = "";
            }
            
            $openpay_widget_options = get_option('openpay_widget_option_name'); // Array of All Options
            $enable_0 = $openpay_widget_options['enable_0']; // Enable
            $region_1 = $openpay_widget_options['region_1']; // Region
            $plan_tiers_2 = $openpay_widget_options['plan_tiers_2']; // Plan Tiers
            $show_info_belt_widget_6 = $openpay_widget_options['show_info_belt_widget_6']; // Show Info Belt Widget
            $show_info_belt_widget_sticky_61 = $openpay_widget_options['show_info_belt_widget_sticky_61']; // Show Info Belt Widget
            $show_cart_widget_8 = $openpay_widget_options['show_cart_widget_8']; // Show Cart Widget
            $show_product_page_widget_9 = $openpay_widget_options['show_product_page_widget_9']; // Show Product Page Widget
            $show_catalog_page_widget_10 = $openpay_widget_options['show_catalog_page_widget_10']; // Show Catalog Page Widget
            $show_openpay_logo_11 = $openpay_widget_options['show_openpay_logo_11']; // Show Openpay Logo
            $currency_15 = $openpay_widget_options['currency_15'];
            $custom_css_16 = $openpay_widget_options['custom_css_16'];

            if ($enable_0 == 'yes') {
                if (($show_info_belt_widget_6 == 'homepage') || ($show_info_belt_widget_6 == 'acrossthesite') ||($show_cart_widget_8 == 'yes') || ($show_product_page_widget_9 == 'yes') || ($show_catalog_page_widget_10 == 'yes')) { ?>
<script type='text/javascript' src='https://unpkg.com/@webcomponents/webcomponentsjs@2.4.3/webcomponents-loader.js'></script>
<script type='text/javascript' src='https://widgets.openpay.com.au/lib/openpay-widgets.min.js'></script>
            <script type="text/javascript">
        
                OpenpayWidgets.Config({
                    region: '<?= $region_1?>',
                    currency: '<?=  $currency_15 ?>',
                    planTiers: [<?= $plan_tiers_2 ?>],
                    minEligibleAmount: <?= $minimum_checkout ?>,
                    maxEligibleAmount: <?= $maximum_checkout ?>,
                    type: 'Online'
                    
                });

               
               </script>
              

                    <?php if (!empty($custom_css_16)) { ?>
                     <style type="text/css">
                        <?php echo $custom_css_16; ?>
                   
               </style>
                   
                    <?php } ?>

                <?php }
                if (($show_info_belt_widget_sticky_61 == 'yes') && ($show_info_belt_widget_6 !== 'off')) { ?>
 <script type="text/javascript">
window.onscroll = function() {opyinfobelt()};
var optopbar = document.getElementById("openpayinfobelt");
var optopbarbottom = document.getElementById("openpaybottom");
var sticky = optopbar.offsetTop;

function opyinfobelt() {
  if (window.pageYOffset >= sticky) {
    optopbar.classList.add("openpaysticky")
    optopbarbottom.classList.add("openpaybottom")
  } else {
    optopbar.classList.remove("openpaysticky");
    optopbarbottom.classList.add("openpaybottom")
  }
}
</script> 
                <?php }
            }
        }
    


        

        function openpayadmincss()
        {
            echo '<style>
    
         
         .openpaywrap {
        border-collapse: collapse;
        width: 100%;
}
.openpaywrap h2 {font-size: 18px;padding-top: 20px;}
.openpaywrap td, .openpaywrap th {
  border: 1px solid #ddd;
  padding: 8px;

}
.openpaywrap th {
  width:300px;
}
.openpaywrap tr:nth-child(even){background-color: #f2f2f2;}

.openpaywrap tr:hover {background-color: #ddd;}

.openpaywrap th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
}

.openpaywrap select {
    width: 350px;
}

.openpaywrap select[multiple] {
    width: 350px !important;
}



.openpaywrap input[text="text"] {
    width: 350px;
}
.openpaywrap .button {
    margin-left: 225px;
}
.openpaywrap textarea {
    width: 350px;
}

         </style>';
        }


       
    
       
        public static function init()
        {
            self::load_classes();
           
            if (is_null(self::$instance)) {
                self::$instance = new self;
            }
            return self::$instance;
        }

       
        public static function activate_plugin()
        {
            if (!current_user_can('activate_plugins')) {
                return;
            }

           

            self::init();
        }

        
        public static function deactivate_plugin()
        {
            if (!current_user_can('activate_plugins')) {
                return;
            }

            self::load_classes();
        }

      
        public static function uninstall_plugin()
        {
            if (!current_user_can('activate_plugins')) {
                return;
            }
        }
    }

    register_activation_hook(__FILE__, array('Openpay_JsPlugin', 'activate_plugin'));
    register_deactivation_hook(__FILE__, array('Openpay_JsPlugin', 'deactivate_plugin'));
    register_uninstall_hook(__FILE__, array('Openpay_JsPlugin', 'uninstall_plugin'));

    add_action('plugins_loaded', array('Openpay_JsPlugin', 'init'), 10, 0);
}
