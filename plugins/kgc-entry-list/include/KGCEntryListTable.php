<?php

require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';

class KGCEntryListTable extends WP_List_Table {

    private $current_submit_time = null;
    private $current_entity = null;

    private $_save_action = 'save_entity';

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
            'your-shop-name' => 'Shop',
            'your-genre' => 'Genre',
            'your-menu' => 'Menu',
            'Submitted' => 'Date'
        ];
        return $columns;
    }

    public function single_row( $item ) {
        $st = $this->current_submit_time = esc_html( $item['submit_time'] );
        if ( $ent = KGCEntryEntity::get( $st ) ) {
            $this->current_entity = $ent;
            echo '<tr style="background-color:#eee;">';
        }
        else {
            echo '<tr>';
        }
        $this->single_row_columns( $item );
        echo '</tr>';
        // Init properties
        $this->current_submit_time = $this->current_entity = null;
    }

    public function column_default( $item, $column_name ) {
        $method = 'column_' . str_replace( '-', '_', $column_name );
        return method_exists( $this, $method ) ? $this->$method( $item, $column_name ) : $item[$column_name];
    }

    public function column_your_shop_name( $item ) {
        $name = esc_html( $item['your-shop-name'] );
        $actions = [];
        if ( $ent = $this->current_entity ) {
            $name = '<span style="color:#666;">' . $name . '</span>';
            $actions['edit'] = sprintf( '<a href="%s">Edit</a>', get_edit_post_link( $ent->ID ) );
            $actions['view'] = sprintf( '<a href="%s">View</a>', get_permalink( $ent ) );
        }
        else {
            $actions[$this->_save_action] = sprintf(
                '<a href="?page=%s&action=%s&submit_time=%s">%s</a>',
                $_REQUEST['page'],
                $this->_save_action,
                $this->current_submit_time,
                'Save Entity'
            );
        }
        return sprintf( '%s%s', $name, $this->row_actions( $actions ) );
    }

    public function column_your_menu( $item ) {
        return sprintf(
            '%s <small>(%d 円)</small>',
            esc_html( $item['your-menu'] ),
            esc_html( $item['your-price'] )
        );
    }

    public function prepare_items() {
        $columns = $this->get_columns();
        $hidden = [];
        $sortable = [];
        $this->_column_headers = [ $columns, $hidden, $sortable ];
        $this->items = KGCEntryData::getAll();
    }

    public function save_action() {
        if ( ! $this->current_action() === $this->_save_action ) {
            return false;
        }
        if ( ! $st = filter_input( INPUT_GET, 'submit_time' ) ) {
            return false;
        }
        if ( KGCEntryEntity::get( $st ) ) {
            return false;
        }
        if ( ! $data = KGCEntryData::get( $st ) ) {
            return false;
        }
        return KGCEntryEntity::save( $st, $data );
    }

}
