<?php
/**
 * KitchinCar Gourmet Championship Theme Customizer.
 *
 * @package KitchinCar_Gourmet_Championship
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kitchincar_gourmet_championship_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'kitchincar_gourmet_championship_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function kitchincar_gourmet_championship_customize_preview_js() {
	wp_enqueue_script( 'kitchincar_gourmet_championship_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'kitchincar_gourmet_championship_customize_preview_js' );
