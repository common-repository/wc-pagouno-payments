<?php
/**
 * Plugin Name: PagoUno para WooCommerce
 * Plugin URI: https://wordpress.org/plugins/
 * Description: Acepte pagos con tarjeta de credito y débito con el plugin de pagoUno en WooCommerce
 * Version: 2.0.1
 * Author: pagoUno
 * Author URI: https://www.pagouno.com/
 * WC tested up to: 5.3.0
 * Copyright: 2018-2021 pagouno.com.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: woocommerce-pagouno
 */

  defined( 'ABSPATH' ) or exit;
 
  if ( ! function_exists( 'is_pagouno_woocommerce_activated' ) ) {
    function is_pagouno_woocommerce_activated() {
      if ( class_exists( 'woocommerce' ) ) { return true; } else { add_action( 'admin_notices', 'woocommerce_pagouno_missing_wc_notice' ); return false;  }
    }
  }
  function woocommerce_pagouno_missing_wc_notice() {
    /* translators: 1. URL link. */
    echo '<div class="error"><p><strong>' . sprintf( esc_html__( 'PagoUno requires WooCommerce to be installed and active. You can download %s here.', 'woocommerce-pagouno' ), '<a href="https://woocommerce.com/" target="_blank">WooCommerce</a>' ) . '</strong></p></div>';
  }
  require_once dirname( __FILE__ ) . '/includes/gateway.php';

  add_filter( 'woocommerce_payment_gateways', 'pagouno_add_gateway_class' );
  function pagouno_add_gateway_class( $gateways ) {
      $gateways[] = 'WC_PagoUno_Gateway';
      return $gateways;
  }