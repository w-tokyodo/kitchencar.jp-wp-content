<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package KitchinCar_Gourmet_Championship
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
		<article id="post-<?php the_ID(); ?> kgc_shop" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title">
					<?php the_title(); ?>
				</h1>
				<div class="entry-fields__copy">
					<?php echo SCF::get('shop-copy'); ?>
				</div>
				<div class="entry-fields__thumbnail">
					<?php the_post_thumbnail('kgc_thumbnail_post'); ?>
					<?php $image = get_post_meta($post->ID, 'shop-image', true); echo wp_get_attachment_image($image, 'kgc_thumbnail_car');?>
				</div>
			</header>
			<div class="entry-fields">
				<div class="entry-fields__content">
					<?php echo SCF::get('shop-content'); ?>
				</div>
				<div class="entry-fields__menu">
				<?php $p_player_group = SCF::get( 'shop-menu' ); foreach ( $p_player_group as $field_name => $field_value ) { 	?>
					<dl>
						<td><?php echo esc_html( $field_value['shop-menu-item'] ); ?></td>
						<td><?php echo esc_html( $field_value['shop-menu-price'] ); ?>円</td>
					</dl>
				<?php } ?>
				</div>
			</div>
		</article>
	<?php endwhile; ?>

</div>

		<!-- <?php get_template_part("template-parts/content","contact"); ?> -->
		<!-- <?php get_template_part("template-parts/content","sponsor"); ?> -->

<?php
get_footer();