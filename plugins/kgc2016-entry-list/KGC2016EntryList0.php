<?php

require_once 'KGC2016AbstractEntryList.php';

class KGC2016EntryList0 extends KGC2016AbstractEntryList {

    const EP = 'entry-list-0';
    # const TITLE = '出店キッチンカー第一弾！';

    private $exp;
    private $single_view = '';
    private $single_array = [];

    public function __construct() {
        add_action( 'init', [ $this, 'add_rewrite_endpoint' ] );
        add_filter( 'query_vars', [ $this, 'query_vars' ] );
        add_action( 'template_redirect', [ $this, 'template_redirect' ] );
    }

    public function add_rewrite_endpoint() {
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
        $this->single_view = $wp_query->query[self::EP];
        # add_filter( 'wp_title', [ $this, 'title' ], 10, 2 );
        $this->render();
    }

    private function render() {
        $this->_pre_render();
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
        $this->single_view ? kgc2016_entry_list_render_single( $this->single_array ) /* $this->render_single() */ : $this->render_list();
        get_footer();
        die();
    }

    /*
    private function render_single() {
?>
    <div class="content-area">
        <pre><?= var_export( $this->single_array, true ) ?></pre>
    </div>
<?php
    }
    */

    private function render_list() {
        $reExp = [];
        $exists = [];
        while ( $row = $this->exp->nextRow() ) {
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
                    <?php if ( current_user_can( 'administrator' ) ) { ?><th>No.</th><?php } ?>
                    <th>キッチンカー名</th>
                    <th>自慢の一品</th>
                    <th>説明</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $reExp as $reRow ) { $this->render_row( $reRow ); } ?>
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
        if ( $this->single_view && ! current_user_can( 'administrator' ) ) {
            wp_die( 'Forbidden', '', 'response=403' );
        }
        $exp = $this->get_form();
        if ( empty( $exp->dataIterator->columns ) ) {
            wp_die( 'Not Found.', '', 'response=404' );
        }
        $this->exp = $exp;
        if ( $this->single_view ) {
            while ( $row = $this->exp->nextRow() ) {
                if ( $row['submit_time'] === $this->single_view ) {
                    $this->single_array = $row;
                    break;
                }
            }
        }
    }

    /*
    public function title( $title, $sep ) {
        $string = self::TITLE;
        if ( $this->single_array ) {
            $string = $this->single_array['your-shop-name'] . " $sep " . $string;
        }
        $title = $string . " $sep $title";
        return '$title';
    }
    */

}
