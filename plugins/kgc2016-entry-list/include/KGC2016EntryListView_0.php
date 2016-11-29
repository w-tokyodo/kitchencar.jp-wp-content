<?php

class KGC2016EntryListView_0 {

    const EP = 'entry-list-0';

    private $submit_time = '';

    public function __construct() {
        add_action( 'init', [ $this, 'init' ] );
        if ( ! is_admin() ) {
            add_filter( 'query_vars', [ $this, 'query_vars' ] );
            add_action( 'template_redirect', [ $this, 'template_redirect' ] );
        }
    }

    public function init() {
        add_rewrite_endpoint( self::EP, EP_ROOT );
    }

    public function query_vars( Array $vars ) {
        $vars[] = self::EP;
        return $vars;
    }

    public function template_redirect() {
        global $wp_query;
        if ( ! isset( $wp_query->query[self::EP] ) ) {
            return;
        }
        $this->submit_time = $wp_query->query[self::EP];
        $this->render();
    }

    private function render() {
        $this->_pre_render();
        $list = new KGC2016EntryList();

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
        $this->submit_time
            ? kgc2016_entry_list_render_single( $list->get( $this->submit_time ) ) /* $this->render_single() */
            : $this->render_list( $list->get() )
        ;
        get_footer();
        die();
    }

    private function render_list( Array $listArray ) {
?>
    <div class="content-area" style="width:75%;">
        <table style="font-size:.75em;">
            <thead>
                <tr>
                    <?php if ( current_user_can( 'administrator' ) ) { ?><th>No.</th><?php } ?>
                    <th>キッチンカー名</th>
                    <th>自慢の一品</th>
                    <th>説明</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $listArray as $item ) { $this->render_row( $item ); } ?>
            </tbody>
        </table>
    </div>
<?php
    }

    private function render_row( Array $row ) {
        static $i = 0;
?>
                <tr>
                    <?php if ( current_user_can( 'administrator' ) ) { ?><td><?= ++$i ?></td><?php } ?>
                    <td><h3><small><?= esc_html( $row['your-copy'] ) ?></small><br><?= $this->render_shop_name( $row['your-shop-name'], $row['submit_time'] ) ?></h3></td>
                    <td><?= esc_html( $row['your-menu'] ) ?><br><small>( <?= esc_html( $row['your-price'] ) ?> 円 )</small></td>
                    <td><small>&lt;<?= esc_html( $row['your-genre'] ) ?>&gt;</small><br><?= esc_html( $row['your-content'] ) ?></td>
                </tr>
<?php
    }

    private function render_shop_name( $name, $submit_time ) {
        if ( ! current_user_can( 'administrator' ) ) {
            return esc_html( $name );
        }
        return sprintf( '<a href="%s">%s</a>', esc_attr( $submit_time ), esc_html( $name ) );
    }

    private function _pre_render() {
        if ( $this->submit_time && ! current_user_can( 'administrator' ) ) {
            wp_die( 'Forbidden', '', 'response=403' );
        }
    }

}
