<?php

require_once 'KGC2016AbstractEntryList.php';

class KGC2016EntryListAdmin extends KGC2016AbstractEntryList {

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_menu_page' ] );
    }

    public function add_menu_page() {
        add_menu_page(
            'KGC2016 List', 'KGC2016 List', 'administrator', 'kgc2016_list', [ $this, 'menu_page' ]
        );
    }

    function menu_page() {
        $exp = $this->get_form();
        while ( $row = $exp->nextRow() ) {
            var_dump( $row );
            echo '<hr />';
        }
    }
}
