<?php

require_once( ABSPATH . 'wp-content/plugins/contact-form-7-to-database-extension/CFDBFormIterator.php' );

class KGCEntryData {

    private static $list = [];

    public static function getAll() {
        $self = self::getInstance();
        return $self::$list;
    }

    public static function get( $submit_time ) {
        $self = self::getInstance();
        return $self::$list[$submit_time] ?? [];
    }

    private static function getInstance() {
        static $instance;
        return $instance ?: $instance = new self();
    }

    private function __construct() {
        $exp = new CFDBFormIterator();
        $exp->export( KGC_ENTRY_FORM ); /** @see ../kgc-entry-list.php */
        if ( ! empty( $exp->dataIterator->columns ) ) {
            $this->prepare_data( $exp );
        }
    }

    private function prepare_data( CFDBFormIterator $exp ) {
        /**
         * 重複入力チェック用配列
         */
        $cache = [];
        $array = [];
        while ( $row = $exp->nextRow() ) {
            /**
             * 重複チェック
             */
            if ( isset( $cache[$row['your-shop-name']] ) && $row['your-menu'] === $cache[$row['your-shop-name']] ) {
                continue;
            }
            $array[$row['submit_time']] = $row;
            /**
             * 店名キーにメニュー値
             */
            $cache[$row['your-shop-name']] = $row['your-menu'];
        }
        $this::$list = $array;
    }

}
