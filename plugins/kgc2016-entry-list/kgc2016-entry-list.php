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
    $id = $wp_query->query['entry-raw'];
    get_header();
?>
    <div class="content-header">
    	<div class="content-header__image">
    		<a href="<?php echo esc_url(home_url( '/' )); ?>">
    			<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/single-header.png" >
    		</a>
    	</div>
    </div>
<?php
    if ( empty( $id ) ) { kgc2016_entry_list_render_table(); }
    else { kgc2016_entry_list_render_single( $id ); }
?>
<?php
    get_footer();
    die();
}

function kgc2016_entry_list_render_table() {
    $exp = kgc2016_entry_list_get_form();
    $reExp = [];
    $exists = [];
    while ( $row = $exp->nextRow() ) {
        if ( isset( $exists[$row['your-shop-name']] ) && $row['your-menu'] === $exists[$row['your-shop-name']] ) {
            continue;
        }
        array_unshift( $reExp, $row );
        $exists[$row['your-shop-name']] = $row['your-menu'];
    }
?>
    <div class="content-area" style="width:75%;">
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
    </div>
<?php
}

function kgc2016_entry_list_render_row( Array $row ) {
?>
                <tr>
                    <td><h3><small><?= esc_html( $row['your-copy'] ) ?></small><br><?= kgc2016_entry_list_render_shop_name( $row['your-shop-name'], $row['submit_time'] ) ?></h3></td>
                    <td><?= esc_html( $row['your-menu'] ) ?><br><small>( <?= esc_html( $row['your-price'] ) ?> 円 )</small></td>
                    <td><small>&lt;<?= esc_html( $row['your-genre'] ) ?>&gt;</small> <?= esc_html( $row['your-content'] ) ?></td>
                </tr>
<?php
}

function kgc2016_entry_list_render_shop_name( $name, $id ) {
    if ( ! is_user_logged_in() ) {
        return esc_html( $name );
    }
    return sprintf( '<a href="%s">%s</a>', esc_attr( $id ), esc_html( $name ) );
}

function kgc2016_entry_list_render_single( $submit_time ) {
    $exp = kgc2016_entry_list_get_form();
    while ( $row = $exp->nextRow() ) {
        if ( $row['submit_time'] === $submit_time ) {
            break;
        }
    }
?>
    <div class="content-area">
        <pre><?= var_export( $row, true ) ?></pre>
    </div>
<?php
}
