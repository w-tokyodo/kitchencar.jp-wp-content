<?php

require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';

class KGC2016EntryListTable extends WP_List_Table {

    public function __construct() {
        $args = [
            'singular' => 'entry',
            'plural'   => 'entries',
            'ajax'     => false
        ];
        parent::__construct( $args );
    }

    public function get_columns() {
        $columns = [
            'cb' => '<input type="checkbox" />',
            'your-shop-name' => 'Shop',
            'your-genre' => 'Genre'
        ];
        return $columns;
    }

    public function column_cb( $item ) {
        return '<input type="checkbox" />';
    }

    public function column_default( $item, $column_name ) {
        if ( $column_name === 'your-shop-name' ) {
            return $this->column_shop_name( $item );
        }
        return $item[$column_name];
    }

    private function column_shop_name( $item ) {
        $name = sprintf( '<a href="?page=%s&action=view&submit_time=%s">%s</a>', $_REQUEST['page'], $item['submit_time'], $item['your-shop-name'] );
        $actions = [
            'register' => sprintf( '<a href="?page=%s&action=register&submit_time=%s">Register</a>', $_REQUEST['page'], $item['submit_time'] )
        ];
        return sprintf( '%s%s', $name, $this->row_actions( $actions ) );
    }

    public function set_list_array( Array $listArray ) {
        $this->items = $listArray;
    }

    public function prepare_items() {
        if ( ! $this->items ) {
            return;
        }
        $columns = $this->get_columns();
        $hidden = [];
        $sortable = [];
        $this->_column_headers = [ $columns, $hidden, $sortable ];
    }

}
