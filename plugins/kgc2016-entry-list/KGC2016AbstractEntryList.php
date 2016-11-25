<?php

abstract class KGC2016AbstractEntryList {

    const FORM = 'Kitchencar Gourmet Championship 2016';

    protected function get_form() {
        require_once( ABSPATH . 'wp-content/plugins/contact-form-7-to-database-extension/CFDBFormIterator.php' );
        $exp = new CFDBFormIterator();
        $exp->export( self::FORM );
        return $exp;
    }

}
