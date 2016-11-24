<?php
/**
 * Plugin Name:     Kitchencar Gourmet Championship
 * Text Domain:     kitchencar-gourmet-championship
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Kitchencar_Gourmet_Championship
 */

define( 'KGC_PATH', __DIR__ );
define( 'KGC_URI',  plugins_url( '', __FILE__ ) );
define( 'KGC_INC', KGC_PATH . '/inc' );

/**
 * Google Analytics
 */
function kgc_add_ga_codes() {
	$uids = [ /** mimoto */ 'UA-26079619-1' ];
	if ( $uids && ! is_user_logged_in() ) {
		$code = "\tga('create', '%s', 'auto');";
		$eocode = "\tga('send', 'pageview');";
		wp_enqueue_script( 'ga', trailingslashit( KGC_URI ) . 'js/ga.js', [], '', false );
		foreach ( $uids as $uid ) {
			wp_add_inline_script( 'ga', sprintf( $code, $uid ) );
		}
		wp_add_inline_script( 'ga', $eocode );
	}
}
add_action( 'wp_enqueue_scripts', 'kgc_add_ga_codes' );

require_once KGC_INC . '/repositories.php';
