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
				<div class="frontHeader__inner">
						<div class="frontHeader__visual"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/main-visual.png" alt=""></div>
				</div>
		</div>
		<?php get_template_part("template-parts/content","news"); ?>
		<?php get_template_part("template-parts/content","event"); ?>
		<!-- <?php get_template_part("template-parts/content","shop"); ?> -->
		<?php get_template_part("template-parts/content","contact"); ?>
		<?php get_template_part("template-parts/content","sponsor"); ?>
<?php
//get_sidebar();
get_footer();