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
			<header class="entry-header">
			</header>
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
			</div>
			</div>
		</article>
	<?php endwhile; ?>

</div>
		<?php get_template_part("template-parts/content","sponsor"); ?>

<?php
get_footer();
