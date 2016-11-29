<?php

require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';

class KGC2016EntryListTable extends WP_List_Table {

    /**
     * @var KGC2016EntryListConvertKGCEntry
     */
    private $converter;

    private $converted_now = 0;
    private $current_post_id = 0;
    private $current_submit_time = '';

    public function __construct() {
        $this->converter = new KGC2016EntryListConvertKGCEntry();
        $this->_pre_construct();
        $args = [
            'singular' => 'entry',
            'plural'   => 'entries',
            'ajax'     => false
        ];
        parent::__construct( $args );
    }

    public function get_columns() {
        $columns = [
            # 'cb' => '<input type="checkbox" />',
            'your-shop-name' => 'Shop',
            'your-genre' => 'Genre',
            'your-menu' => 'Menu',
            'Submitted' => 'Date'
        ];
        return $columns;
    }

    public function single_row( $item ) {
        $this->current_post_id = 0;
        $st = $item['submit_time'];
        $this->current_submit_time = $st;
        if ( $id = $this->converter->has_converted( $st ) ) {
            $this->current_post_id = $id;
            echo '<tr style="background-color:#eee;">';
        }
        else {
            echo '<tr>';
        }
		$this->single_row_columns( $item );
		echo '</tr>';
	}

    /*
    public function column_cb( $item ) {
        return '<input type="checkbox" />';
    }
    */

    public function column_default( $item, $column_name ) {
        if ( $column_name === 'your-shop-name' ) {
            return $this->column_shop_name( $item );
        }
        return $item[$column_name];
    }

    private function column_shop_name( $item ) {
        $shop_name = esc_html( $item['your-shop-name'] );
        $db_detail_url = sprintf(
            '?page=%s&action=view&submit_time=%s',
            $_REQUEST['page'],
            $this->current_submit_time
        );
        if ( $this->current_post_id ) {
            $actions = [
                'go-db-page' => sprintf( '<a href="%s">Go Input Content</a>', $db_detail_url, $shop_name )
            ];
            return sprintf(
                '<a href="%s" style="color:#666;">%s</a>%s',
                admin_url( 'post.php?post_type=kgc_entry&post=' . $this->current_post_id . '&action=edit' ),
                $shop_name,
                $this->row_actions( $actions )
            );
        }
        else {
            $add_entry_action = sprintf(
                '<a href="?page=%s&action=%s&submit_time=%s">%s</a>',
                $_REQUEST['page'],
                'add_entry',
                $item['submit_time'],
                'Add Entry'
            );
            $actions = [
                'add_entry' => $add_entry_action
            ];
            return sprintf(
                '<a href="%s">%s</a>%s',
                $db_detail_url,
                $shop_name,
                $this->row_actions( $actions )
            );
        }
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

    private function _pre_construct() {
        if ( $this->current_action() === 'add_entry' && $st = filter_input( INPUT_GET, 'submit_time' ) ) {
            if ( $id = $this->converter->convert_to_kgc_entry( $st ) ) {
                $this->converted_now = $id;
            }
        }
    }

}
