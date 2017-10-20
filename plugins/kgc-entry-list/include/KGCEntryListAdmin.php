<?php

class KGCEntryListAdmin {

    public function __construct() {
        add_action( 'admin_menu', function() {
            add_menu_page(
                'KGC List', 'KGC List', 'administrator', 'kgc_list', [ $this, 'menu_page' ]
            );
        } );
    }

    public function menu_page() {
        $table = new KGCEntryListTable();
        $table->save_action();
        $table->prepare_items(); ?>
<div class="wrap">
    <h1>KGC Entries</h1>
    <?php $table->display(); ?>
</div>
<?php
    }

}
