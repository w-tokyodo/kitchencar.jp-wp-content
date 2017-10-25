<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package KitchinCar_Gourmet_Championship
 */

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

$term = get_queried_object();
$map = SCF::get_term_meta( $term, 'kgc_area', 'kgc2017_area_map' );

get_header(); ?>

<div class="content-header">
	<div class="content-header__image">
		<a href="/">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/single-header.png" >
		</a>
	</div>
</div>


<div class="archive-area">
	<div class="archive-area__headline">
		<header style="text-align:center">
			<h1 style="font-family:serif;"><?= esc_html( $term->name ) ?></h1>
		</header>
	</div>
	<div class="frontShop__info">
		<p><?= esc_html( $term->description ) ?></p>
	</div>
	<div><?= wp_get_attachment_image( $map, 'full' ) ?></div>
	<div class="frontShop__inner col-3">
	<?php while(have_posts()): the_post();
		$shop = new KGCShop( $post ); ?>
		<div class="col-3__item frontShop__item" style="
			height: 210px;
		">
				<a href="<?php the_permalink(); ?>">
					<div class="col-3__img frontShop__thumb">
						<?= $shop->food_image ?>
						<div class="frontShop__car">
							<?= $shop->car_image ?>
						</div>
						<div style="
							font-size: .9em;
							padding: .25em;
							color: #333;
							display: inline-block;
							border: solid 1px #333;
							border-radius: 2em;
							position: absolute;
							top: 4px;
							left: 4px;
							background-color: #fff;
							height: 1em;
							line-height: 1em;
						"><?= esc_html( $shop->number ) ?></div>
					</div>
				</a>
				<a href="<?php the_permalink(); ?>">
					<div class="col-3__title frontShop__title">
						<?= esc_html( $shop->name ) ?>
					</div>
					<div class="col-3__title frontShop__copy"><?= esc_html( $shop->copy ) ?></div>
				</a>
		</div>
	<?php endwhile; ?>
	</div>

	<div class="archive-area__headline" style="text-align:center">
		<p style="font-family:serif;">その他のエリアも見る <small><a href="<?= esc_url( get_post_type_archive_link( 'kgc_shop' ) ) ?>">&gt;&gt; すべてのキッチンカー</a></small></p>
		<ul class="cat-list"><?php
			$areas = get_terms( array(
				'taxonomy' => 'kgc_area',
				'exclude' => $term->term_id
			) );
			foreach ( $areas as $area ) {
				$area_color = get_term_meta( $area->term_id, 'color', true ) ?: 'inherit';
				echo '<li class="cat-item" style="line-height:2em;margin-right:5px;">';
				echo '<a href="' . esc_url( get_term_link( $area, 'kgc_area' ) ) . '" style="background-color:' . esc_attr( $area_color ) . '">' . esc_html( $area->name ) . '</a>';
				echo '</li>';
			} ?>
		</ul>
	</div>
	<div class="nav-link">
		<div class="nav-link__left"><?php previous_posts_link( '&laquo; 前の店舗一覧' ); ?></div>
		<div class="nav-link__right"><?php next_posts_link( '次の店舗一覧&raquo;', '' ); ?></div>
		</div>
	</div>
</div>

<?php
get_footer();
