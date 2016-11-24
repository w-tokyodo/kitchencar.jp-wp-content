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
    add_action( 'init', 'kgc2016_entry_list_add_rewrite_endpoint' );
    add_filter( 'query_vars', 'kgc2016_entry_list_query_vars' );
    add_action( 'template_redirect', 'kgc2016_entry_list_template_redirect' );
    add_action( 'admin_menu', 'kgc2016_entry_list_admin_menu' );
}

function kgc2016_entry_list_get_form() {
    require_once( ABSPATH . 'wp-content/plugins/contact-form-7-to-database-extension/CFDBFormIterator.php' );
    $exp = new CFDBFormIterator();
    $exp->export( 'Kitchencar Gourmet Championship 2016' );
    return $exp;
}

function kgc2016_entry_list_admin_menu() {
    add_menu_page( 'KGC2016 List', 'KGC2016 List', 'administrator', 'kgc2016_list', 'kgc2016_menu_page' );
}

function kgc2016_menu_page() {
    $exp = kgc2016_entry_list_get_form();
    while ( $row = $exp->nextRow() ) {
        var_dump( $row );
        echo '<hr />';
    }
}

function kgc2016_entry_list_add_rewrite_endpoint() {
    add_rewrite_endpoint( 'entry-raw', EP_ROOT );
}

function kgc2016_entry_list_query_vars( $vars ) {
    $vars[] = 'entry-raw';
    return $vars;
}

function kgc2016_entry_list_template_redirect() {
    global $wp_query;
    if ( ! isset( $wp_query->query['entry-raw'] ) ) {
        return;
    }
    get_header();
?>
    <div class="content-header">
    	<div class="content-header__image">
    		<a href="<?php echo esc_url(home_url( '/' )); ?>">
    			<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/single-header.png" >
    		</a>
    	</div>
    </div>
    <div class="content-area">
        <?= kgc2016_entry_list_render_table() ?>
    </div>
<?php
    get_footer();
    die();
}

function kgc2016_entry_list_render_table() {
    $exp = kgc2016_entry_list_get_form();
    $reExp = [];
    while ( $row = $exp->nextRow() ) {
        array_unshift( $reExp, $row );
    }
?>
        <table style="font-size:.75em;">
            <thead>
                <tr>
                    <th>キッチンカー名</th>
                    <th>自慢の一品</th>
                    <th>説明</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $reExp as $reRow ) { kgc2016_entry_list_render_row( $reRow ); } ?>
            </tbody>
        </table>
<?php
}

function kgc2016_entry_list_render_row( Array $row ) {
?>
                <tr>
                    <td><h3><small><?= esc_html( $row['your-copy'] ) ?></small><br /><?= esc_html( $row['your-shop-name'] ) ?></h3></td>
                    <td><small>( <?= esc_html( $row['your-genre'] ) ?> )</small> <?= esc_html( $row['your-menu'] ) ?> <small>( <?= esc_html( $row['your-price'] ) ?> 円 )</small></td>
                    <td><?= esc_html( $row['your-content'] ) ?></td>
                </tr>
<?php
}
