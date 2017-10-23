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

    private function get_number() {
        return (int) get_post_meta( $this->post->ID, 'kgc_entry_number_2017', true );
    }

    private function get_food_image() {
        $size = apply_filters( 'KGCShop_image_size', 'medium', 'food' );
        $image = get_the_post_thumbnail( $this->post->ID, $size );
        if ( ! $image ) {
            $src = get_stylesheet_directory_uri() . '/static/assets/img/thumbnail.jpg';
            $image = '<img src="' . $src . '" />';
        }
        return $image;
    }

    private function get_car_image() {
        $size = apply_filters( 'KGCShop_image_size', 'medium', 'car' );
        $image = wp_get_attachment_image(
            get_post_meta( $this->post->ID, 'shop-image', true ),
            $size
        );
        if ( ! $image ) {
            $src = get_stylesheet_directory_uri() . '/static/assets/img/thumbnail.jpg';
            $image = '<img src="' . $src . '" />';
        }
        return $image;
    }

    private function get_copy() {
        if ( ! $copy = get_the_excerpt( $this->post ) ) {
            $copy = SCF::get('shop-copy') ?: '';
        }
        return $copy;
    }

    private function get_category() {
        if ( ! $category = $this->_get_the_area() ) {
            $category = get_the_term_list($this->post->ID, 'kgc_shop_cat');
        }
        return $category;
    }

    private function _get_the_area() {
        $area = get_the_terms( $this->post, 'kgc_area' );
        if ( ! $area || is_wp_error( $area ) ) {
            return '';
        }
        $area = $area[0];
        $html = '<a href="' . esc_url( get_term_link( $area, 'kgc_area' ) ) . '" ';
        if ( $color = get_term_meta( $area->term_id, 'color', true ) ) {
            $html .= 'style="background-color:' . $color . ';" ';
        }
        $html .= 'rel="tag">' . $area->name . '</a>';
        return $html;
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

    private function get_genre() {
        return get_post_meta( $this->post->ID, 'kgc_genre', true );
    }

}
