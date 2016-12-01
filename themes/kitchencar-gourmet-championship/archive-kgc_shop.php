<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package KitchinCar_Gourmet_Championship
 */

get_header(); ?>

<div class="content-header">
	<div class="content-header__image">
		<a href="<?php echo esc_url(home_url( '/2016' )); ?>">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/single-header.png" >
		</a>
	</div>
</div>


<div class="archive-area">
	<div class="archive-area__headline">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/title_shop.png" alt="">
	</div>
	<div class="frontShop__info">
		全国から
		<span class="frontShop__info__number">
		<?php $numposts = $wpdb->get_var("SELECT count(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'kgc_shop'"); if (0 < $numposts) $numposts = number_format($numposts); echo  $numposts ;?>
		</span>
		店舗が集結!!
	</div>
	<div class="frontShop__inner col-3">
	<?php while(have_posts()): the_post(); ?>
		<div class="col-3__item frontShop__item">
				<a href="<?php the_permalink(); ?>">
					<div class="col-3__img frontShop__thumb">
						<?php if ( has_post_thumbnail()): ?>
							<?php the_post_thumbnail('kgc_thumbnail'); ?>
						<?php else: ?>
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/thumbnail.jpg" alt="<?php the_title(); ?>">
						<?php endif; ?>
						<div class="frontShop__car">
							<?php $image = get_post_meta($post->ID, 'shop-image', true); echo wp_get_attachment_image($image, 'kgc_thumbnail_car');?>
						</div>
					</div>
				</a>
				<div class="col-3__title frontShop__cat"><?php echo get_the_term_list($post->ID, 'kgc_shop_cat'); ?></div>
				<a href="<?php the_permalink(); ?>">
					<div class="col-3__title frontShop__title">
						<?php
						if(mb_strlen($post->post_title, 'UTF-8')>14){
							$title= mb_substr($post->post_title, 0, 14, 'UTF-8');
							echo $title.'…';
						}else{
							echo $post->post_title;
						}
						?>
					</div>
					<div class="col-3__title frontShop__copy"><?php echo SCF::get('shop-copy'); ?></div>
				</a>
		</div>
	<?php endwhile; ?>
	</div>
	<div class="nav-link">
		<div class="nav-link__left"><?php previous_posts_link( '&laquo; 最新の記事' ); ?></div>
		<div class="nav-link__right"><?php next_posts_link( '過去の記事&raquo;', '' ); ?></div>
		</div>
	</div>

</div>

<?php
get_footer();
