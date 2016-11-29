<?php
/**
 * Plugin Name: Kitchencar Gourmet Championship - Entry List
 */

add_action( 'plugins_loaded', 'init_kgc2016_entry_list' );

function init_kgc2016_entry_list() {
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

    new KGC2016EntryListView_0();
    new KGC2016EntryListAdmin();
}

function kgc2016_entry_list_render_single( Array $args ) {
?>
    <div class="content-area">
        <pre><?= var_export( $args, true ) ?></pre>
    </div>
<?php
}
