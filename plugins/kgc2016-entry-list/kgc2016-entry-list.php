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
    if ( is_admin() ) {
        require_once 'KGC2016EntryListAdmin.php';
        new KGC2016EntryListAdmin();
    }
    else {
        require_once 'KGC2016EntryList0.php';
        new KGC2016EntryList0();
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
