<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package KitchinCar_Gourmet_Championship
 */

/**
 * Import KGCShop class
 */
require_once KGC_THEME_DIR . '/inc/class-kgc-shop.php';

get_header(); ?>

<div class="content-header">
	<div class="content-header__image">
		<a href="/">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/single-header.png" >
		</a>
	</div>
</div>

<div class="content-area">
	<?php while(have_posts()): the_post();
		/**
		 * 'kgc_shop' entity
		 * @var KGCShop
		 */
		$shop = new KGCShop( $post ); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="kgc_shop">
				<div class="kgc_shop__column kgc_shop__image">
					<div class="kgc_shop__food">
						<?= $shop->food_image ?>
					</div>
					<div class="kgc_shop__car">
						<?= $shop->car_image ?>
					</div>
				</div>
				<div class="kgc_shop__column kgc_shop__info">
					<div class="kgc_shop__cat">
						<?= $shop->category ?>
					</div>
					<h1 class="kgc_shop__title">
						<?= esc_html( $shop->name ) ?>
					</h1>
					<div class="kgc_shop__copy">
						<?= esc_html( $shop->copy ) ?>
					</div>
					<div class="kgc_shop__menu">
						<dl>
							<dt>自慢の一品</dt>
							<dd>
								<?= esc_html( $shop->main_menu_item ) ?>
								<small><?= esc_html( $shop->main_menu_price ) ?> 円</small>
							</dd>
						<?php if ( $shop->has_min_menu() ) { ?>
							<dt>ミニメニュー</dt>
							<dd>
								<?= esc_html( $shop->min_menu_item ) ?>
								<small><?= esc_html( $shop->min_menu_price ) ?> 円</small>
							</dd>
						<?php } ?>
							<dt>コメント</dt>
							<dd><?= esc_html( $shop->description ) ?></dd>
						</dl>
					</div>
				</div>
			</div><?php

			/**
			 * エリア情報
			 */
			if ( $areas = get_the_terms( $post->ID, 'kgc_area' ) ) :
				$area = $areas[0];
				$map = SCF::get_term_meta( $area, 'kgc_area', 'kgc2017_area_map' );
				$area_color = get_term_meta( $area->term_id, 'color', true ) ?: 'inherit'; ?>

			<div class="archive-area__headline" style="text-align:center">

				<p style="font-family:serif;font-size:1.7em;">出店エリア</p>
				<div><?= wp_get_attachment_image( $map, 'full' ) ?></div>

				<p style="font-family:serif;"><?= esc_html( $area->name ) ?>の他の出店者を見る</p>
				<ul class="cat-list">
					<li class="cat-item" style="line-height:2em;">
						<a href="<?= esc_url( get_term_link( $area, 'kgc_area' ) ) ?>" style="background-color:<?= esc_attr( $area_color ) ?>"><?= esc_html( $area->name ) ?></a>
					</li>
				</ul>

				<p style="font-family:serif;">
					その他のエリアも見る
					<small><a href="<?= esc_url( get_post_type_archive_link( 'kgc_shop' ) ) ?>">&gt;&gt; すべてのキッチンカー</a></small>
				</p>
				<ul class="cat-list"><?php
					$other_areas = get_terms( array(
						'taxonomy' => 'kgc_area',
						'exclude' => $area->term_id
					) );
					foreach ( $other_areas as $other_area ) {
						$other_area_color = get_term_meta( $other_area->term_id, 'color', true ) ?: 'inherit';
						echo '<li class="cat-item" style="line-height:2em;margin-right:5px;">';
						echo '<a href="' . esc_url( get_term_link( $other_area, 'kgc_area' ) ) . '" style="background-color:' . esc_attr( $other_area_color ) . '">' . esc_html( $other_area->name ) . '</a>';
						echo '</li>';
					} ?>
				</ul>
			</div>

<?php
			endif; ?>

		</article>
	<?php endwhile; ?>

</div>
		<?php // get_template_part("template-parts/content","sponsor"); ?>

<?php
get_footer();
