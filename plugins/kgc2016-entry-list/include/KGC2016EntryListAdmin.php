<?php

class KGC2016EntryListAdmin {

    private $list;

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_menu_page' ] );
    }

    public function add_menu_page() {
        add_menu_page(
            'KGC2016 List', 'KGC2016 List', 'administrator', 'kgc2016_list', [ $this, 'menu_page' ]
        );
    }

    public function menu_page() {
        $this->list = new KGC2016EntryList();

        if ( 'view' === filter_input( INPUT_GET, 'action' ) ) {
            if ( $submit_time = filter_input( INPUT_GET, 'submit_time' ) ) {
                $this->single_view( $this->list->get( $submit_time ) );
            }
        }
        else {
            $this->list_view();
        }
    }

    private function single_view( Array $itemArray ) {
        echo '<div class="wrap">';
        printf(
            '<h1>%s <a href="%s" class="page-title-action">%s</a></h1>',
            esc_html( $itemArray['your-shop-name'] ),
            admin_url( sprintf( 'admin.php?page=%s', $_REQUEST['page'] ) ),
            'Back to List'
        );
        var_dump( $itemArray );
        echo '</div>';
    }

    private function list_view() {
        echo '<div class="wrap">';
        echo '<h1>KGC2016 Entries</h1>';
        $this->list_table();
        echo '</div>';
    }

    private function list_table() {
        $table = new KGC2016EntryListTable();
        $table->set_list_array( $this->list->get() );
        $table->prepare_items();
        $table->display();
    }

}
