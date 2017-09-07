<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package KitchenCar_Gourmet_Championship
 */

get_header(); ?>
		<div class="frontHeader">
			<div class="wrapper">
				<video autoplay loop poster="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/kitchencar_gorumet_grandprix_2017.gif" id="video">
					<source src="<?php echo get_stylesheet_directory_uri(); ?>/movie/kitchencar_gorumet_grandprix_2017.m4v" type="video/mp4">
				</video>
				<div class="main-visual__logo">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/main-visual-2017.png" alt="キッチンカーグルメ選手権2017">
				</div>
			</div>
		</div>
		<?php get_template_part("template-parts/content","information"); ?>
		<?php get_template_part("template-parts/content","news"); ?>
		<?php get_template_part("template-parts/content","event"); ?>
		<!--<?php get_template_part("template-parts/content","shop"); ?> -->
		 <?php get_template_part("template-parts/content","sponsor"); ?>
<?php
//get_sidebar();
get_footer();
