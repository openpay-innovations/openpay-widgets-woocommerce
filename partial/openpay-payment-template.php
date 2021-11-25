<?php

/**

 * Output a single payment method

 *

 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.

 *

 * HOWEVER, on occasion WooCommerce will need to update template files and you

 * (the theme developer) will need to copy the new files to your theme to

 * maintain compatibility. We try to do this as little as possible, but it does

 * happen. When this occurs the version of the template file will be bumped and

 * the readme will list any important changes.

 *

 * @see       https://docs.woocommerce.com/document/template-structure/

 * @author    WooThemes

 * @package   WooCommerce/Templates

 * @version     2.3.0

 */



if (! defined('ABSPATH')) {
    exit;
}

?>

<li class="wc_payment_method payment_method_<?php echo $gateway->id; ?> price-sec top-info">



  <?php

    global $woocommerce;

  


    ?>


  <?php
    $openpay_widget_options = get_option('openpay_widget_option_name');
    $plan_tiers_2 = $openpay_widget_options['plan_tiers_2'];
    $show_checkout_page_widget_12 = $openpay_widget_options['show_checkout_page_widget_12'];
    $fornightly_checkout_13 = $openpay_widget_options['fornightly_checkout_13'];
    $instruction_checkout_14 = $openpay_widget_options['instruction_checkout_14'];
    $region_1 = $openpay_widget_options['region_1'];

    $openpay_chkwidget_infoicon = (isset($openpay_widget_options['openpay_chkwidget_infoicon']) ? $openpay_widget_options['openpay_chkwidget_infoicon'] : "none");
    $openpay_chkwidget_learnmore_text = (isset($openpay_widget_options['openpay_chkwidget_learnmore_text']) ? $openpay_widget_options['openpay_chkwidget_learnmore_text'] : "");
    
    if ($show_checkout_page_widget_12 =='yes') { ?>
    <input id="payment_method_<?php echo $gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr($gateway->id); ?>" <?php checked($gateway->chosen, true); ?> data-order_button_text="<?php echo esc_attr($gateway->order_button_text); ?>" />



    <label for="payment_method_<?php echo $gateway->id; ?>">

     <span>


          <?php echo esc_attr($gateway->title);  ?> <img src="https://static.openpay.com.au/brand/logo/amber-lozenge-logo.svg" alt="Openpay" class="cpwopenpaylogo"><opy-learn-more-button more-info-text="<?php echo $openpay_chkwidget_learnmore_text; ?>" info-icon="<?php echo $openpay_chkwidget_infoicon; ?>"></opy-learn-more-button></span>

    </label>



    <div class="payment_box payment_method_<?php echo $gateway->id; ?>" <?php if (! $gateway->chosen) :
        ?>style="display:none;"<?php
                                           endif; ?>>

     
<?php echo esc_attr($gateway->description);  ?> 
      

          <div class="openpaycheckout">

             <?php if (!empty($plan_tiers_2)) {
                    $tiers = explode(',', $plan_tiers_2);

                    $tiersmin = sizeof($tiers);
                                               
                    if ($tiersmin == 1) {
                        $checkouttext = ($region_1 == 'AU') ? "<div class='opplantier'>Spread the cost over " .min($tiers)." months.</div>" : "<div class='opplantier'>Pay over " .min($tiers). " interest free <br>monthly instalments.</div>";
                    } else {
                        $checkouttext = ($region_1 == 'AU') ? "<div class='opplantier'>Spread the cost over " .min($tiers)."-".trim(max($tiers), " ")." months.</div>" : "<div class='opplantier'>Pay over " .min($tiers). '-'.trim(max($tiers), " "). " interest free <br>monthly instalments.</div>";
                    }

                    echo  $checkouttext;
        
                    ?>

                    <?php
             } ?>

          
          <?php if (!empty($fornightly_checkout_13)) { ?>
         <div class="opfortnightly"><?php echo $fornightly_checkout_13; ?></div>
         

                <?php
          } ?>

           <?php if (!empty($instruction_checkout_14)) { ?>
         <div class="opinstruction"><?php echo html_entity_decode($instruction_checkout_14); ?></div>
         

                <?php
           } ?>

         

          </div>

   

       

       

      </div>

      

    <?php } else { ?>
        <input id="payment_method_<?php echo $gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr($gateway->id); ?>" <?php checked($gateway->chosen, true); ?> data-order_button_text="<?php echo esc_attr($gateway->order_button_text); ?>" />

        <label for="payment_method_<?php echo $gateway->id; ?>">

          <?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?>

        </label>



        <?php if ($gateway->has_fields() || $gateway->get_description()) : ?>
          <div class="payment_box payment_method_<?php echo $gateway->id; ?>" <?php if (! $gateway->chosen) :
                ?>style="display:none;"<?php
                                                 endif; ?>>

            <?php $gateway->payment_fields(); ?>

          </div>

        <?php endif; ?>



    <?php } ?>

  

</li>

