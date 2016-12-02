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
		<a href="/">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/single-header.png" >
		</a>
	</div>
</div>

<?php if (is_tax('kgc_shop_cat')) : ?>
	<?php get_template_part('template-parts/loop','shop' ); ?>
<?php else :?>


	<div class="archive-area">
		<div class="archive-area__headline">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/title_news.png" alt="">
		</div>
		<ul class="archive-area__list">
		<?php while(have_posts()): the_post(); ?>
			<li class="archive-area__item">
				<a class="news-item"> href="<?php the_permalink(); ?>">
					<div class="archive-area__date">
						<?php the_time("Y.m.d" ); ?>
					</div>
					<div class="archive-area__title">
						<?php the_title(); ?>
					</div>
				</a>
			</li>
		<?php endwhile; ?>
		</ul>
		<div class="nav-link">
			<div class="nav-link__left"><?php previous_posts_link( '&laquo; 最新の記事' ); ?></div>
			<div class="nav-link__right"><?php next_posts_link( '過去の記事&raquo;', '' ); ?></div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php
get_footer();
