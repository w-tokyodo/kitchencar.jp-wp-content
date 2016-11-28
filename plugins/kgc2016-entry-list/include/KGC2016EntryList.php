<?php

require_once( ABSPATH . 'wp-content/plugins/contact-form-7-to-database-extension/CFDBFormIterator.php' );

class KGC2016EntryList {

    const FORM = 'Kitchencar Gourmet Championship 2016';

    /**
     * @var CFDBFormIterator
     */
    private $formDB;

    public function __construct() {
        $exp = new CFDBFormIterator();
        $exp->export( self::FORM );
        if ( empty( $exp->dataIterator->columns ) ) {
            wp_die( 'Not Found.', '', 'response=404' );
        }
        $this->formDB = $exp;
    }

    public function get( $arg = 'ASC' ) {
        $arg = strtolower( $arg );
        if ( in_array( $arg, [ 'asc', 'desc' ] ) ) {
            return $this->get_array( $arg );
        }
        return $this->get_single( $arg );
    }

    private function get_array( $arg ) {
        $cache = [];
        $array = [];
        $func = $arg === 'asc' ? 'array_unshift' : 'array_push';
        while ( $row = $this->formDB->nextRow() ) {
            if ( isset( $cache[$row['your-shop-name']] ) && $row['your-menu'] === $cache[$row['your-shop-name']] ) {
                continue;
            }
            $func( $array, $row );
            $cache[$row['your-shop-name']] = $row['your-menu'];
        }
        return $array;
    }

    private function get_single( $submit_time ) {
        while ( $row = $this->formDB->nextRow() ) {
            if ( $row['submit_time'] === $submit_time ) {
                return $row;
            }
        }
        return [];
    }

}
