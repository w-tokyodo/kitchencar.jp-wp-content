<?php

/**
 * Import KGCShop class
 */
require_once KGC_THEME_DIR . '/inc/class-kgc-shop.php';

add_filter( 'KGCShop_image_size', function( $size, $context ) {
	switch ( $context ) {
		case 'food' :
			$size = 'kgc_thumbnail';
			break;
		case 'car' :
			$size = 'kgc_thumbnail_car';
			break;
		default :
			break;
	}
	return $size;
}, 10, 2 );

?><div class="archive-area">
	<div class="archive-area__headline">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/title_shop.png" alt="">
	</div>
	<div class="frontShop__info">
		全国から
		<span class="frontShop__info__number"><?= esc_html( kgc_get_entries_num( 2017 ) ) ?></span>
		店舗が集結!!
	</div>
	<?php if (is_tax('kgc_shop_cat')): ?>
		<div class="archive-area__cat"><?php if ($terms = get_the_terms($post->ID, 'kgc_shop_cat')) { foreach ( $terms as $term ) { echo esc_html($term->name) ; }}?></div>
	<?php endif ;?>
	<div class="frontShop__inner col-3">
	<?php while(have_posts()): the_post();
		$shop = new KGCShop( $post ); ?>
		<div class="col-3__item frontShop__item">
				<a href="<?php the_permalink(); ?>">
					<div class="col-3__img frontShop__thumb">
						<?= $shop->food_image ?>
						<div class="frontShop__car">
							<?= $shop->car_image ?>
						</div>
					</div>
				</a>
				<div class="col-3__title frontShop__cat"><?= $shop->category ?></div>
				<a href="<?php the_permalink(); ?>">
					<div class="col-3__title frontShop__title">
						<?= esc_html( $shop->name ) ?>
					</div>
					<div class="col-3__title frontShop__copy"><?= esc_html( $shop->copy ) ?></div>
				</a>
		</div>
	<?php endwhile; ?>
	</div>
	<?php /* <ul class="cat-list"><?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'kgc_shop_cat','hide_empty' => 0)); ?>
		<li class="cat-item"><a href="<?php echo esc_url(home_url( '/kgc_shop' )); ?>">全ジャンル</a></li>
	</ul> */ ?>
	<div class="nav-link">
		<div class="nav-link__left"><?php previous_posts_link( '&laquo; 前の店舗一覧' ); ?></div>
		<div class="nav-link__right"><?php next_posts_link( '次の店舗一覧&raquo;', '' ); ?></div>
		</div>
	</div>
</div>
