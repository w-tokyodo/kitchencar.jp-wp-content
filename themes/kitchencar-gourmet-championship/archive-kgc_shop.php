<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package KitchinCar_Gourmet_Championship
 */

$context = 'shop';
if ( isset( $_REQUEST['view'] ) && $_REQUEST['view'] === 'list' ) {
	$context = 'table';
}

get_header(); ?>

<div class="content-header">
	<div class="content-header__image">
		<a href="/">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/single-header.png" >
		</a>
	</div>
</div>

<?php
get_template_part('template-parts/loop', $context );

get_footer();
