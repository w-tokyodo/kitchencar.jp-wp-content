<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package KitchenCar_Gourmet_Championship
 */

get_header(); ?>

<div class="content-header">
	<div class="content-header__image">
		<a href="<?php echo esc_url(home_url( '/' )); ?>">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/single-header.png" >
		</a>
	</div>
</div>

<div class="content-area">
	<?php while(have_posts()): the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title">
					<?php the_title(); ?>
				</h1>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
</div>

		<?php get_template_part("template-parts/content","event"); ?>
		<?php // get_template_part("template-parts/content","contact"); ?>
		<?php // get_template_part("template-parts/content","sponsor"); ?>

<?php
get_footer();
