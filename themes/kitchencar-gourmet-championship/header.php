<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KitchinCar_Gourmet_Championship
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title>キッチンカースタジアムグルメ選手権2016</title>
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/css/app.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>