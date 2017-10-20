<?php

class KGCEntryEntity {

    const META_KEY = 'kgc_entry_form_submitted';

    private $entities = [];

    public static function get( $submit_time ) {
        $self = self::getInstance();
        return $self->get_post( $submit_time );
    }

    public static function save( $submit_time, Array $data ) {
        $self = self::getInstance();
        return $self->save_post( $submit_time, $data );
    }

    private static function getInstance() {
        static $instance;
        return $instance ?: $instance = new self();
    }

    private function __construct() {
        //
    }

    private function get_post( $submit_time ) {
        if ( isset( $this->entities[$submit_time] ) ) {
            return $this->entities[$submit_time];
        }
        $args = [
            'post_type' => 'kgc_shop',
            'meta_key' => self::META_KEY,
            'meta_value' => $submit_time,
            'posts_per_page' => 1,
            'post_status' => 'any',
        ];
        $posts = get_posts( $args );
        return $posts ? $posts[0] : false;
    }

    private function save_post( $submit_time, Array $args ) {
        $postarr = [
            'post_title' => $args['your-shop-name'],
            'post_content' => $args['your-content'],
            'post_excerpt' => $args['your-copy'],
            'post_type' => 'kgc_shop',
        ];
        $id = wp_insert_post( $postarr, true );
        if ( ! is_wp_error( $id ) ) {
            wp_set_object_terms( $id, '2017', 'kgc_number' );
            $this->add_post_meta( $id, $args );
            # $this->create_media( $id, $args );
            return $id;
        }
        return false;
    }

    private function add_post_meta( $id, Array $args ) {
        add_post_meta( $id, 'kgc_menu', $args['your-menu'] );
        add_post_meta( $id, 'kgc_menu_price', $args['your-price'] );
        add_post_meta( $id, 'kgc_menu_min', $args['your-menu-min'] );
        add_post_meta( $id, 'kgc_menu_min_price', $args['your-price-min'] );
        add_post_meta( $id, 'kgc_genre', $args['your-genre'] );
        add_post_meta( $id, self::META_KEY, $args['submit_time'] );
    }

}
