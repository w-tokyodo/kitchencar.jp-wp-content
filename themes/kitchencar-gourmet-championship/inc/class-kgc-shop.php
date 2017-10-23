<?php

class KGCShop {

    /**
     * @var WP_Post
     */
    private $post;

    /**
     * Constructor
     *
     * @param WP_Post $post
     */
    public function __construct( WP_Post $post ) {
        $this->post = $post;
    }

    public function __get( $name ) {
        $method = 'get_' . $name;
        return method_exists( $this, $method ) ? $this->$method() : '';
    }

    private function get_name() {
        return get_the_title( $this->post );
    }

    private function get_food_image() {
        return get_the_post_thumbnail( $this->post->ID, 'medium' );
    }

    private function get_car_image() {
        return wp_get_attachment_image(
            get_post_meta( $this->post->ID, 'shop-image', true ),
            'medium'
        );
    }

    private function get_copy() {
        if ( ! $copy = get_the_excerpt( $this->post ) ) {
            $copy = SCF::get('shop-copy') ?: '';
        }
        return $copy;
    }

    private function get_category() {
        if ( ! $category = get_the_term_list($this->post->ID, 'kgc_area') ) {
            $category = get_the_term_list($this->post->ID, 'kgc_shop_cat');
        }
        return $category;
    }

    private function get_main_menu_item() {
        if ( ! $menu = get_post_meta( $this->post->ID, 'kgc_menu', true ) ) {
            $menu = SCF::get('shop-menu-item') ?: '';
        }
        return $menu;
    }

    private function get_main_menu_price() {
        if ( ! $price = get_post_meta( $this->post->ID, 'kgc_menu_price', true ) ) {
            $price = SCF::get('shop-menu-price') ?: '';
        }
        return $price;
    }

    /**
     * @access public
     *
     * @return boolean
     */
    public function has_min_menu() {
        return !! $this->get_min_menu_item();
    }

    private function get_min_menu_item() {
        return get_post_meta( $this->post->ID, 'kgc_menu_min', true );
    }

    private function get_min_menu_price() {
        return get_post_meta( $this->post->ID, 'kgc_menu_min_price', true );
    }

    private function get_description() {
        if ( ! $desc = get_the_content( $this->post ) ) {
            $desc = SCF::get('shop-content') ?: '';
        }
        return $desc;
    }

}
