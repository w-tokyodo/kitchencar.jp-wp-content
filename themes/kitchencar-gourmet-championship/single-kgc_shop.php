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
		<a href="/">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/single-header.png" >
		</a>
	</div>
</div>

<div class="content-area">
	<?php while(have_posts()): the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
			</header>
			<div class="kgc_shop">
				<div class="kgc_shop__column kgc_shop__image">
					<div class="kgc_shop__food">
						<?php the_post_thumbnail('kgc-post-image'); ?>
					</div>
					<div class="kgc_shop__car">
						<?php $image = get_post_meta($post->ID, 'shop-image', true); echo wp_get_attachment_image($image, 'kgc-post-image');?>
					</div>
				</div>
				<div class="kgc_shop__column kgc_shop__info">
					<div class="kgc_shop__cat">
					<?php echo get_the_term_list($post->ID, 'kgc_shop_cat'); ?>
					</div>
					<h1 class="kgc_shop__title">
						<?php the_title(); ?>
					</h1>
					<div class="kgc_shop__copy">
						<?php echo SCF::get('shop-copy'); ?>
					</div>
					<div class="kgc_shop__menu">
						<dl>
						<?php if(post_custom('shop-menu-item')): ?>
							<dt>自慢の一品</dt>
							<dd><?php echo SCF::get('shop-menu-item'); ?></dd>
						<?php endif; ?>
						<?php if(post_custom('shop-menu-price')): ?>
							<dt>価格</dt>
							<dd><?php echo SCF::get('shop-menu-price'); ?>円</dd>
						<?php endif; ?>
						<?php if(post_custom('shop-content')): ?>
							<dt>コメント</dt>
							<dd><?php echo SCF::get('shop-content'); ?></dd>
						<?php endif; ?>
						</dl>
					</div>
				</div>
			</div>
			</div>
		</article>
	<?php endwhile; ?>

</div>

		<!-- <?php get_template_part("template-parts/content","contact"); ?> -->
		<?php get_template_part("template-parts/content","sponsor"); ?>

<?php
get_footer();
