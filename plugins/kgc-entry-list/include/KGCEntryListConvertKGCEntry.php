<?php

class KGCEntryListConvertKGCEntry {

    private $existed = false;
    private $post_id = 0;

    public function __construct() {
        // $this->entries = get_option( $this->optkey ) ?: [];
    }

    public function convert_to_kgc_entry( $submit_time ) {
        if ( ! $args = $this->get_pre_entry( $submit_time ) ) {
            return false;
        }
        if ( $id = $this->insert_post( $args ) ) {
            $this->post_id = $id;
            $this->entries[$submit_time] = $id;
            update_option( $this->optkey, $this->entries );
        }
        return $this->post_id ?: false;
    }

    private function get_pre_entry( $submit_time ) {
        $list = new KGCEntryList();
        return $list->get( $submit_time );
    }

    private function insert_post( Array $args ) {
        $postarr = [
            'post_title' => $args['your-shop-name'],
            'post_content' => $args['your-content'],
            'post_excerpt' => $args['your-copy'],
            'post_type' => 'kgc_shop',
        ];
        $id = wp_insert_post( $postarr, true );
        if ( ! is_wp_error( $id ) ) {
            wp_set_object_terms( $id, '', 'kgc_number' );
            $this->add_post_meta( $id, $args );
            $this->create_media( $id, $args );
            return $id;
        }
        return false;
    }

    private function add_post_meta( $id, Array $args ) {
        add_post_meta( $id, 'kgc_manager_name', $args['your-name'] );
        add_post_meta( $id, 'kgc_manager_email', $args['your-email'] );
        add_post_meta( $id, 'kgc_manager_tel', $args['your-tel'] );
        add_post_meta( $id, 'kgc_genre', $args['your-genre'] );
    }

    private function create_media( $id, Array $args ) {
        $array = [
            [ $id, $args['file-car'],  $args['file-car_URL'],  'car'  ],
            [ $id, $args['file-menu'], $args['file-menu_URL'], 'menu' ],
        ];
        foreach ( $array as $arr ) {
            call_user_func_array( [ $this, 'insert_attachment' ], $arr );
        }
    }

    /**
     * @see https://codex.wordpress.org/Function_Reference/wp_insert_attachment
     */
    private function insert_attachment( $id, $filename, $fileurl, $context ) {
        $updir = wp_upload_dir();
        if ( ! $data = file_get_contents( $fileurl ) ) {
            return;
        }
        $filetype = wp_check_filetype( $filename );
        $filename = $updir['basedir'] . $updir['subdir'] . '/' . $filename;
        if ( false === file_put_contents( $filename, $data ) ) {
            return;
        }
        $attachment = [
        	'guid'           => $updir['url'] . '/' . basename( $filename ),
        	'post_mime_type' => $filetype['type'],
        	'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
        	'post_content'   => '',
        	'post_status'    => 'inherit'
        ];
        $attach_id = wp_insert_attachment( $attachment, $filename, $id );
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
        wp_update_attachment_metadata( $attach_id, $attach_data );
        if ( $context === 'car' ) {
            set_post_thumbnail( $id, $attach_id );
        }
        else {
            add_post_meta( $id, 'kgc_menu_image', $attach_id );
        }
    }

}
