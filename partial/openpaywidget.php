<?php

/**

 */

if (!defined('WCOPENPAY_ABSPATH'))
    define( 'WCOPENPAY_ABSPATH', __DIR__ . '/' );

require_once WCOPENPAY_ABSPATH.'class/WC_Gateway_Openpay.php';

class OpenpayWidget
{
    private $openpay_widget_options;

    public function __construct()
    {
        add_action('admin_menu', array( $this, 'openpay_widget_add_plugin_page' ));
        add_action('admin_init', array( $this, 'openpay_widget_page_init' ));
    }

    public function openpay_widget_add_plugin_page()
    {
        add_menu_page(
            'Openpay Widgets', // page_title
            'Openpay Widgets', // menu_title
            'manage_options', // capability
            'openpay-widget', // menu_slug
            array( $this, 'openpay_widget_create_admin_page' ), // function
            'dashicons-admin-generic', // icon_url
            3 // position
        );
    }

    public function openpay_widget_create_admin_page()
    {
        $this->openpay_widget_options = get_option('openpay_widget_option_name'); ?>

        <div class="openpaywrap">
            <h1>Openpay Widgets</h1>
            
            <?php settings_errors(); ?>

            <form method="post" action="options.php">
                <?php
                    settings_fields('openpay_widget_option_group');
                    do_settings_sections('openpay-widget-admin');
                    submit_button();
                ?>
            </form>
        </div>
    <?php }

    public function openpay_widget_page_init()
    {
        register_setting(
            'openpay_widget_option_group', // option_group
            'openpay_widget_option_name', // option_name
            array( $this, 'openpay_widget_sanitize' ) // sanitize_callback
        );

        add_settings_section(
            'openpay_widget_setting_section', // id
            'General Configuration', // title
            array( $this, 'openpay_widget_section_info' ), // callback
            'openpay-widget-admin' // page
        );

        add_settings_field(
            'enable_0', // id
            'Enable Widget', // title
            array( $this, 'enable_0_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

        add_settings_field(
            'region_1', // id
            'Region', // title
            array( $this, 'region_1_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

        add_settings_field(
            'plan_tiers_2', // id
            'Plan Tiers', // title
            array( $this, 'plan_tiers_2_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

       

        add_settings_field(
            'currency_15', // id
            'Currency', // title
            array( $this, 'currency_15_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

        add_settings_field(
            'minimum_checkout_value_4', // id
            'Minimum Order Value', // title
            array( $this, 'minimum_checkout_value_4_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

        add_settings_field(
            'maximum_checkout_value_5', // id
            'Maximum Order Value', // title
            array( $this, 'maximum_checkout_value_5_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

        

        add_settings_field(
            'show_info_belt_widget_6', // id
            'Show Info Belt Widget', // title
            array( $this, 'show_info_belt_widget_6_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

        add_settings_field(
            'info_belt_widget_color_7', // id
            'Info Belt Widget Color', // title
            array( $this, 'info_belt_widget_color_7_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

        add_settings_field(
            'show_info_belt_widget_sticky_61', // id
            'Info Belt Widget Sticky', // title
            array( $this, 'show_info_belt_widget_sticky_61_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

       

        add_settings_field(
            'show_catalog_page_widget_10', // id
            'Show Catalog Page Widget', // title
            array( $this, 'show_catalog_page_widget_10_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

        add_settings_field(
            'show_openpay_logo_11', // id
            'Show Openpay Logo on Catalog Widget ', // title
            array( $this, 'show_openpay_logo_11_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

         add_settings_field(
             'openpay_logo_17', // id
             'Catalog Page Widget Logo', // title
             array( $this, 'openpay_logo_17_callback' ), // callback
             'openpay-widget-admin', // page
             'openpay_widget_setting_section' // section
         );

         add_settings_field(
             'show_product_page_widget_9', // id
             'Show Product Page Widget', // title
             array( $this, 'show_product_page_widget_9_callback' ), // callback
             'openpay-widget-admin', // page
             'openpay_widget_setting_section' // section
         );

         add_settings_field(
             'openpay_logo_18', // id
             'Product Page Widget Logo', // title
             array( $this, 'openpay_logo_18_callback' ), // callback
             'openpay-widget-admin', // page
             'openpay_widget_setting_section' // section
         );

         add_settings_field(
             'show_cart_widget_8', // id
             'Show Cart Page Widget', // title
             array( $this, 'show_cart_widget_8_callback' ), // callback
             'openpay-widget-admin', // page
             'openpay_widget_setting_section' // section
         );

         add_settings_field(
             'openpay_logo_19', // id
             'Cart Page Widget Logo', // title
             array( $this, 'openpay_logo_19_callback' ), // callback
             'openpay-widget-admin', // page
             'openpay_widget_setting_section' // section
         );

        add_settings_field(
            'show_checkout_page_widget_12', // id
            'Show Checkout Page Widget', // title
            array( $this, 'show_checkout_page_widget_12_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

        add_settings_field(
            'fornightly_checkout_13', // id
            'Instalment Text', // title
            array( $this, 'fornightly_checkout_13_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );

        add_settings_field(
            'instruction_checkout_14', // id
            'Redirect Text', // title
            array( $this, 'instruction_checkout_14_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );
        add_settings_field(
            'custom_css_15', // id
            'Widget Custom CSS', // title
            array( $this, 'custom_css_16_callback' ), // callback
            'openpay-widget-admin', // page
            'openpay_widget_setting_section' // section
        );
    }

    public function openpay_widget_sanitize($input)
    {
        $sanitary_values = array();
        if (isset($input['enable_0'])) {
            $sanitary_values['enable_0'] = $input['enable_0'];
        }

        if (isset($input['region_1'])) {
            $sanitary_values['region_1'] = $input['region_1'];
        }

        if (isset($input['plan_tiers_2'])) {
            $sanitary_values['plan_tiers_2'] = implode(', ', $input['plan_tiers_2']);
        }

        if (isset($input['minimum_checkout_value_4'])) {
            $sanitary_values['minimum_checkout_value_4'] = sanitize_text_field($input['minimum_checkout_value_4']);
        }

        if (isset($input['maximum_checkout_value_5'])) {
            $sanitary_values['maximum_checkout_value_5'] = sanitize_text_field($input['maximum_checkout_value_5']);
        }

        if (isset($input['show_info_belt_widget_6'])) {
            $sanitary_values['show_info_belt_widget_6'] = $input['show_info_belt_widget_6'];
        }

        if (isset($input['show_info_belt_widget_sticky_61'])) {
            $sanitary_values['show_info_belt_widget_sticky_61'] = $input['show_info_belt_widget_sticky_61'];
        }

        if (isset($input['info_belt_widget_color_7'])) {
            $sanitary_values['info_belt_widget_color_7'] = $input['info_belt_widget_color_7'];
        }

        if (isset($input['show_cart_widget_8'])) {
            $sanitary_values['show_cart_widget_8'] = $input['show_cart_widget_8'];
        }

        if (isset($input['show_product_page_widget_9'])) {
            $sanitary_values['show_product_page_widget_9'] = $input['show_product_page_widget_9'];
        }

        if (isset($input['show_catalog_page_widget_10'])) {
            $sanitary_values['show_catalog_page_widget_10'] = $input['show_catalog_page_widget_10'];
        }

        if (isset($input['show_openpay_logo_11'])) {
            $sanitary_values['show_openpay_logo_11'] = $input['show_openpay_logo_11'];
        }

        if (isset($input['show_checkout_page_widget_12'])) {
            $sanitary_values['show_checkout_page_widget_12'] = $input['show_checkout_page_widget_12'];
        }

        if (isset($input['fornightly_checkout_13'])) {
            $sanitary_values['fornightly_checkout_13'] = sanitize_text_field($input['fornightly_checkout_13']);
        }

        if (isset($input['instruction_checkout_14'])) {
            $sanitary_values['instruction_checkout_14'] = esc_textarea($input['instruction_checkout_14']);
        }
        if (isset($input['currency_15'])) {
            $sanitary_values['currency_15'] = $input['currency_15'];
        }
        if (isset($input['custom_css_16'])) {
            $sanitary_values['custom_css_16'] = esc_textarea($input['custom_css_16']);
        }

        if (isset($input['openpay_logo_17'])) {
            $sanitary_values['openpay_logo_17'] = $input['openpay_logo_17'];
        }

        if (isset($input['openpay_logo_18'])) {
            $sanitary_values['openpay_logo_18'] = $input['openpay_logo_18'];
        }

        if (isset($input['openpay_logo_19'])) {
            $sanitary_values['openpay_logo_19'] = $input['openpay_logo_19'];
        }

        return $sanitary_values;
    }

    public function openpay_widget_section_info()
    {
    }

    public function enable_0_callback()
    {
        ?> 

        <select name="openpay_widget_option_name[enable_0]" id="enable_0">
            <?php $selected = (isset($this->openpay_widget_options['enable_0']) && $this->openpay_widget_options['enable_0'] === 'yes') ? 'selected' : '' ; ?>
            <option value="yes" <?php echo $selected; ?>> Yes</option>
            <?php $selected = (isset($this->openpay_widget_options['enable_0']) && $this->openpay_widget_options['enable_0'] === 'no') ? 'selected' : '' ; ?>
            <option value="no" <?php echo $selected; ?>> No</option>
        </select> <?php
    }

    public function region_1_callback()
    {
        ?> <select name="openpay_widget_option_name[region_1]" id="region_1">
            <?php $selected = (isset($this->openpay_widget_options['region_1']) && $this->openpay_widget_options['region_1'] === 'AU') ? 'selected' : '' ; ?>
            <option value="AU" <?php echo $selected; ?>> Australia</option>
            <?php $selected = (isset($this->openpay_widget_options['region_1']) && $this->openpay_widget_options['region_1'] === 'UK') ? 'selected' : '' ; ?>
            <option value="UK" <?php echo $selected; ?>> United Kingdom</option>
        </select> <?php
    }

    public function plan_tiers_2_callback()
    {
                 

        ?> 

       <select name="openpay_widget_option_name[plan_tiers_2][]" id="plan_tiers_2" style="width:30%;" multiple='multiple'>

                    <?php $expldval = explode(',', $this->openpay_widget_options['plan_tiers_2']);

                    $selected_items = array();

                    foreach ($expldval as $item) {
                        $selected_items[] = $item;
                    }

                    ?>

                    <?php for ($i = 1; $i < 25; $i++) { ?>
                         <?php if (in_array($i, $selected_items)) { ?>
                            <option value="<?php echo $i ?>" selected ><?php echo $i; ?></option>

                         <?php } else { ?>
                            <option value="<?php echo $i ?>" ><?php echo $i; ?></option>                    

                         <?php }
                    } ?>

                </select> <?php
    }



    


   

    public function currency_15_callback()
    {
        ?> <select name="openpay_widget_option_name[currency_15]" id="currency_15">
           <?php $selected = (isset($this->openpay_widget_options['currency_15']) && $this->openpay_widget_options['currency_15'] === '$') ? 'selected' : '' ; ?>
            <option value="$" <?php echo $selected; ?>>$</option>
           <?php $selected = (isset($this->openpay_widget_options['currency_15']) && $this->openpay_widget_options['currency_15'] === 'A$') ? 'selected' : '' ; ?>
            <option value="A$" <?php echo $selected; ?>>A$</option>
           <?php $selected = (isset($this->openpay_widget_options['currency_15']) && $this->openpay_widget_options['currency_15'] === 'AU$') ? 'selected' : '' ; ?>
            <option value="AU$" <?php echo $selected; ?>>AU$</option>
           <?php $selected = (isset($this->openpay_widget_options['currency_15']) && $this->openpay_widget_options['currency_15'] === 'AUD') ? 'selected' : '' ; ?>
            <option value="AUD" <?php echo $selected; ?>>AUD</option>
           <?php $selected = (isset($this->openpay_widget_options['currency_15']) && $this->openpay_widget_options['currency_15'] === '£') ? 'selected' : '' ; ?>
            <option value="£" <?php echo $selected; ?>>£</option>
           <?php $selected = (isset($this->openpay_widget_options['currency_15']) && $this->openpay_widget_options['currency_15'] === 'GBP') ? 'selected' : '' ; ?>
            <option value="GBP" <?php echo $selected; ?>>GBP</option>
        </select> <?php
    }

    public function minimum_checkout_value_4_callback()
    {
                  
        $gateway = WC_Gateway_Openpay::getInstance();
        $minimum_checkout = $gateway->get_option('minimum');
        
        printf(
            '<input class="regular-text" type="text" name="openpay_widget_option_name[minimum_checkout_value_4]" id="minimum_checkout_value_4" value="%s" disabled>',
            isset($minimum_checkout) ? esc_attr($minimum_checkout) : ''
        );
    }

    public function maximum_checkout_value_5_callback()
    {
        
        $op_gateway = WC_Gateway_Openpay::getInstance();
        $maximum_checkout = $op_gateway->get_option('maximum');
        
        printf(
            '<input class="regular-text" type="text" name="openpay_widget_option_name[maximum_checkout_value_5]" id="maximum_checkout_value_5" value="%s" disabled>',
            isset($maximum_checkout) ? esc_attr($maximum_checkout) : ''
        );
    }
   

    public function show_info_belt_widget_6_callback()
    {
        ?> 

        <select name="openpay_widget_option_name[show_info_belt_widget_6]" id="show_info_belt_widget_6">
            <?php $selected = (isset($this->openpay_widget_options['show_info_belt_widget_6']) && $this->openpay_widget_options['show_info_belt_widget_6'] === 'homepage') ? 'selected' : '' ; ?>
            <option value="homepage" <?php echo $selected; ?>> Home Page</option>
            <?php $selected = (isset($this->openpay_widget_options['show_info_belt_widget_6']) && $this->openpay_widget_options['show_info_belt_widget_6'] === 'acrossthesite') ? 'selected' : '' ; ?>
            <option value="acrossthesite" <?php echo $selected; ?>> Across the Site</option>
            <?php $selected = (isset($this->openpay_widget_options['show_info_belt_widget_6']) && $this->openpay_widget_options['show_info_belt_widget_6'] === 'off') ? 'selected' : '' ; ?>
            <option value="off" <?php echo $selected; ?>> Off</option>
        </select> <?php
    }

    public function info_belt_widget_color_7_callback()
    {
        ?> <select name="openpay_widget_option_name[info_belt_widget_color_7]" id="info_belt_widget_color_7">
            <?php $selected = (isset($this->openpay_widget_options['info_belt_widget_color_7']) && $this->openpay_widget_options['info_belt_widget_color_7'] === 'amber') ? 'selected' : '' ; ?>
            <option value="amber" <?php echo $selected; ?>>Amber</option>
            <?php $selected = (isset($this->openpay_widget_options['info_belt_widget_color_7']) && $this->openpay_widget_options['info_belt_widget_color_7'] === 'grey') ? 'selected' : '' ; ?>
            <option value="grey" <?php echo $selected; ?>> Grey</option>
            <?php $selected = (isset($this->openpay_widget_options['info_belt_widget_color_7']) && $this->openpay_widget_options['info_belt_widget_color_7'] === 'white') ? 'selected' : '' ; ?>
            <option value="white" <?php echo $selected; ?>>White</option>
            
        </select> <?php
    }

    public function show_info_belt_widget_sticky_61_callback()
    {
        ?> 

       

        <select name="openpay_widget_option_name[show_info_belt_widget_sticky_61]" id="show_info_belt_widget_sticky_61">
           <?php $selected = (isset($this->openpay_widget_options['show_info_belt_widget_sticky_61']) && $this->openpay_widget_options['show_info_belt_widget_sticky_61'] === 'yes') ? 'selected' : '' ; ?>
            <option value="yes" <?php echo $selected; ?>> Yes</option>
           <?php $selected = (isset($this->openpay_widget_options['show_info_belt_widget_sticky_61']) && $this->openpay_widget_options['show_info_belt_widget_sticky_61'] === 'no') ? 'selected' : '' ; ?>
            <option value="no" <?php echo $selected; ?>> No</option>
            
        </select> <?php
    }

    

    public function show_product_page_widget_9_callback()
    {
        ?> <select name="openpay_widget_option_name[show_product_page_widget_9]" id="show_product_page_widget_9">
            <?php $selected = (isset($this->openpay_widget_options['show_product_page_widget_9']) && $this->openpay_widget_options['show_product_page_widget_9'] === 'yes') ? 'selected' : '' ; ?>
            <option value="yes" <?php echo $selected; ?>> Yes</option>
            <?php $selected = (isset($this->openpay_widget_options['show_product_page_widget_9']) && $this->openpay_widget_options['show_product_page_widget_9'] === 'no') ? 'selected' : '' ; ?>
            <option value="no" <?php echo $selected; ?>> No</option>
        </select> <?php
    }

    public function openpay_logo_18_callback()
    {
        ?> 

       

        <select name="openpay_widget_option_name[openpay_logo_18]" id="openpay_logo_18">
            <?php $selected = (isset($this->openpay_widget_options['openpay_logo_18']) && $this->openpay_widget_options['openpay_logo_18'] === 'grey-on-amberbg') ? 'selected' : '' ; ?>
            <option value="grey-on-amberbg" <?php echo $selected; ?>> Grey Logo with Amber Background</option>       
            <?php $selected = (isset($this->openpay_widget_options['openpay_logo_18']) && $this->openpay_widget_options['openpay_logo_18'] === 'grey') ? 'selected' : '' ; ?>
             <option value="grey" <?php echo $selected; ?>> Grey</option>
             <?php $selected = (isset($this->openpay_widget_options['openpay_logo_18']) && $this->openpay_widget_options['openpay_logo_18'] === 'amber') ? 'selected' : '' ; ?>
              <option value="amber" <?php echo $selected; ?>> Amber </option>  
             <?php $selected = (isset($this->openpay_widget_options['openpay_logo_18']) && $this->openpay_widget_options['openpay_logo_18'] === 'white') ? 'selected' : '' ; ?>
            <option value="white" <?php echo $selected; ?>> White</option>
        </select> <?php
    }

    public function show_catalog_page_widget_10_callback()
    {
        ?> <select name="openpay_widget_option_name[show_catalog_page_widget_10]" id="show_catalog_page_widget_10">
            <?php $selected = (isset($this->openpay_widget_options['show_catalog_page_widget_10']) && $this->openpay_widget_options['show_catalog_page_widget_10'] === 'yes') ? 'selected' : '' ; ?>
            <option value="yes" <?php echo $selected; ?>> Yes</option>
            <?php $selected = (isset($this->openpay_widget_options['show_catalog_page_widget_10']) && $this->openpay_widget_options['show_catalog_page_widget_10'] === 'no') ? 'selected' : '' ; ?>
            <option value="no" <?php echo $selected; ?>> No</option>
        </select> <?php
    }

    public function openpay_logo_17_callback()
    {
        ?> 

       

        <select name="openpay_widget_option_name[openpay_logo_17]" id="openpay_logo_17">
            <?php $selected = (isset($this->openpay_widget_options['openpay_logo_17']) && $this->openpay_widget_options['openpay_logo_17'] === 'grey') ? 'selected' : '' ; ?>
            <option value="grey" <?php echo $selected; ?>> Grey</option>
             <?php $selected = (isset($this->openpay_widget_options['openpay_logo_17']) && $this->openpay_widget_options['openpay_logo_17'] === 'white') ? 'selected' : '' ; ?>
            <option value="white" <?php echo $selected; ?>> White</option>
            
        </select> <?php
    }

    public function show_openpay_logo_11_callback()
    {
        ?> <select name="openpay_widget_option_name[show_openpay_logo_11]" id="show_openpay_logo_11">
            <?php $selected = (isset($this->openpay_widget_options['show_openpay_logo_11']) && $this->openpay_widget_options['show_openpay_logo_11'] === 'yes') ? 'selected' : '' ; ?>
            <option value="yes" <?php echo $selected; ?>> Yes</option>
            <?php $selected = (isset($this->openpay_widget_options['show_openpay_logo_11']) && $this->openpay_widget_options['show_openpay_logo_11'] === 'no') ? 'selected' : '' ; ?>
            <option value="no" <?php echo $selected; ?>> No</option>
        </select> <?php
    }

    public function show_cart_widget_8_callback()
    {
        ?> <select name="openpay_widget_option_name[show_cart_widget_8]" id="show_cart_widget_8">
            <?php $selected = (isset($this->openpay_widget_options['show_cart_widget_8']) && $this->openpay_widget_options['show_cart_widget_8'] === 'yes') ? 'selected' : '' ; ?>
            <option value="yes" <?php echo $selected; ?>> Yes</option>
            <?php $selected = (isset($this->openpay_widget_options['show_cart_widget_8']) && $this->openpay_widget_options['show_cart_widget_8'] === 'no') ? 'selected' : '' ; ?>
            <option value="no" <?php echo $selected; ?>> No</option>
        </select> <?php
    }

    public function openpay_logo_19_callback()
    {
        ?> 

       

        <select name="openpay_widget_option_name[openpay_logo_19]" id="openpay_logo_19">
            <?php $selected = (isset($this->openpay_widget_options['openpay_logo_19']) && $this->openpay_widget_options['openpay_logo_19'] === 'grey-on-amberbg') ? 'selected' : '' ; ?>
            <option value="grey-on-amberbg" <?php echo $selected; ?>> Grey Logo with Amber Background</option>
            <?php $selected = (isset($this->openpay_widget_options['openpay_logo_19']) && $this->openpay_widget_options['openpay_logo_19'] === 'grey') ? 'selected' : '' ; ?>
            <option value="grey" <?php echo $selected; ?>> Grey</option>
           
        </select> <?php
    }

    public function show_checkout_page_widget_12_callback()
    {
        ?> 

       

        <select name="openpay_widget_option_name[show_checkout_page_widget_12]" id="show_checkout_page_widget_12">
          <?php $selected = (isset($this->openpay_widget_options['show_checkout_page_widget_12']) && $this->openpay_widget_options['show_checkout_page_widget_12'] === 'yes') ? 'selected' : '' ; ?>
            <option value="yes" <?php echo $selected; ?>> Yes</option>
          <?php $selected = (isset($this->openpay_widget_options['show_checkout_page_widget_12']) && $this->openpay_widget_options['show_checkout_page_widget_12'] === 'no') ? 'selected' : '' ; ?>
            <option value="no" <?php echo $selected; ?>> No</option>
        </select> <?php
    }

    public function fornightly_checkout_13_callback()
    {
         

        printf(
            '<input class="regular-text" type="text" name="openpay_widget_option_name[fornightly_checkout_13]" id="fornightly_checkout_13" value="%s" >',
            isset($this->openpay_widget_options['fornightly_checkout_13']) ? esc_attr($this->openpay_widget_options['fornightly_checkout_13']) : 'Pay in interest free fortnightly instalments.'
        );
    }

    public function instruction_checkout_14_callback()
    {
       
        printf(
            '<textarea class="large-text" rows="5" name="openpay_widget_option_name[instruction_checkout_14]" id="instruction_checkout_14">%s</textarea>',
            isset($this->openpay_widget_options['instruction_checkout_14']) ? esc_attr($this->openpay_widget_options['instruction_checkout_14']) : 'You will be redirected to Openpay&apos;s website to complete your order when you click "Proceed to Openpay".'
        );
    }

    public function custom_css_16_callback()
    {
       
        printf(
            '<textarea class="large-text" rows="5" name="openpay_widget_option_name[custom_css_16]" id="custom_css_16">%s</textarea>',
            isset($this->openpay_widget_options['custom_css_16']) ? esc_attr($this->openpay_widget_options['custom_css_16']) : ''
        );
    }
}
if (is_admin()) {
    $openpay_widget = new OpenpayWidget();
}


 
 
