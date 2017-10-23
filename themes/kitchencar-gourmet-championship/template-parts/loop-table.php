<?php

/**
 * Import KGCShop class
 */
require_once KGC_THEME_DIR . '/inc/class-kgc-shop.php';

add_filter( 'KGCShop_image_size', function( $size ) {
	return 'kgc_thumbnail';
} );

?><div class="container" style="font-size: .75em;">
<table class="table">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">エリア</th>
			<th scope="col">屋号</th>
			<th scope="col">ジャンル</th>
			<th scope="col">メイン商品</th>
			<th scope="col">ミニ商品</th>
			<th scope="col">説明</th>
		</tr>
	</thead>
	<tbody>
		<?php
while( have_posts() ):
	the_post();
	$shop = new KGCShop( $post );
		?><tr>
			<td><?= $shop->number ?></td>
			<td><?= $shop->category ?></td>
			<td><?= $shop->name ?></td>
			<td><?= $shop->genre ?></td>
			<td><?= $shop->main_menu_item ?> <small><?= $shop->main_menu_price ?> 円</small></td>
			<td><?php if ( $shop->has_min_menu() ) { ?><?= $shop->min_menu_item ?> <small><?= $shop->min_menu_price ?> 円</small><?php } ?></td>
			<td><strong><?= $shop->copy ?></strong><br><?= $shop->description ?></td>
		</tr><?php
endwhile;
		?>
	</tbody>
</table>



	<div class="frontShop__inner col-3">
	<?php /* while(have_posts()): the_post();
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
	<?php endwhile; */?>
	</div>

</div>
