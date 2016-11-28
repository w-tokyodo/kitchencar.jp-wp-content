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
    spl_autoload_register( '_kgc2016_entry_list_autoload' );
    add_action( 'init', 'KGC2016EntryListView_0::init' );
    if ( is_admin() ) {
        new KGC2016EntryListAdmin();
    }
    else {
        new KGC2016EntryListView_0();
    }
}

function _kgc2016_entry_list_autoload( $class ) {
    $filename = trailingslashit( __DIR__ . '/include' ) . $class . '.php';
    if ( file_exists( $filename ) ) {
        require $filename;
    }
}

/**
 * @param array $args {
 *     @type string
 * }
 */
function kgc2016_entry_list_render_single( Array $args ) {
?>
    <div class="content-area">
        <pre><?= var_export( $args, true ) ?></pre>
    </div>
<?php
}
