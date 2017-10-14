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
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/css/app.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/earlyaccess/sawarabimincho.css" rel="stylesheet"/>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.mmenu.all.js"></script>
	<?php wp_head(); ?>
	<script type="text/javascript">
		$(function () {
			$('#menu').mmenu({
				slidingSubmenus: false
			});
		});
	</script>
</head>
<body <?php body_class(); ?>>
<div class="body__inner">
	<nav class="global_menu">
		<a href="#menu" class="header__menu">
			<?php if ( is_front_page() ): ?>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/btn-menu.png" width="28">
			<?php else: ?>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/btn-menu--white.png"
				     width="28">
			<?php endif; ?>
		</a>
	
	</nav>
