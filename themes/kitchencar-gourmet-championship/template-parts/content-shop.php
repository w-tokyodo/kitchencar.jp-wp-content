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

?><div class="frontShop">
		<div class="frontShop__inner">
				<div class="frontShop__headline"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/title_shop.png" alt=""></div>
				<div class="frontShop__info">
					全国から
					<span class="frontShop__info__number"><?= esc_html( kgc_get_entries_num( 2017 ) ) ?></span>
					店舗が集結!!
				</div>

				<div class="frontShop__inner col-3">

				<?php
				$loop = new WP_Query(
					array(
						'post_type' => 'kgc_shop',
						'posts_per_page' => 6,
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'kgc_number',
								'field'    => 'slug',
								'terms'    => '2017',
							),
						),
					)
				);

				while ( $loop->have_posts() ) : $loop->the_post();
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
				<?php wp_reset_postdata(); ?>

				</div><a href="/kgc_shop" class="btn">もっと見る</a>
		</div>
</div>
