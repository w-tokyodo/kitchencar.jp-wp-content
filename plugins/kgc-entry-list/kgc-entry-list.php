<?php
/**
 * Plugin Name: Kitchencar Gourmet Championship - Entry List
 */

/**
 * Form name of Contact Form 7
 */
define( 'KGC_ENTRY_FORM', 'Kitchencar Gourmet Championship 2017' );

add_action( 'plugins_loaded', 'init_kgc_entry_list' );

function init_kgc_entry_list() {
    global $CF7DBPlugin_minimalRequiredPhpVersion;
    if ( ! isset( $CF7DBPlugin_minimalRequiredPhpVersion ) ) {
        return;
    }
    spl_autoload_register( function ( $class ) {
        $filename = trailingslashit( __DIR__ . '/include' ) . $class . '.php';
        if ( file_exists( $filename ) ) {
            require $filename;
        }
    } );

    new KGCEntryListAdmin();
}
