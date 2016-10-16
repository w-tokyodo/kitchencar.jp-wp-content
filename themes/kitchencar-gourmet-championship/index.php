<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package KitchenCar_Gourmet_Championship
 */

get_header(); ?>
		<div class="frontHeader">
				<div class="frontHeader__inner">
						<div class="frontHeader__visual"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/main-visual.png" alt=""></div>
				</div>
		</div>
		<div class="frontNews">
				<div class="frontNews__inner">
						<div class="frontNews__headline"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/title_news.png" alt=""></div>
						<ul class="frontNews__list">
						<?php $loop = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 5 ) ); while ( $loop->have_posts() ) : $loop->the_post(); ?>
								<li class="frontNews__item">
										<a href="<?php the_permalink(); ?>">
												<div class="frontNews__item__date"><?php the_time('Y年m月d日'); ?></div>
												<div class="frontNews__item__title"><?php the_title(); ?></div>
										</a>
								</li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
						</ul>
						<!-- <a href="#" class="btn">もっと見る</a> -->
				</div>
		</div>
		<div class="frontEvent">
				<div class="frontEvent__inner">
						<div class="frontEvent__headline"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/title_event.png" alt=""></div>
						<div class="frontEvent__content">
							<p>オーナーの個性を表した素敵なキッチンカーが、自慢のグルメを持って日本各地から大集合！
							</p>
							<p>
							レストランで腕を磨いた経験や、こだわり抜いた開発した独自メニューなど自慢の一品を提供している「キッチンカー」のNo.1を決定します！アジア最大級のサッカースタジアム「埼玉スタジアム2002」で、普段は味わえない味をお楽しみください。</p>
						</div>
						<div class="frontEvent__map"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/map.png" alt="">
								<p>埼玉高速鉄道「浦和美園駅」から徒歩15分</p><small>※駐車台数に限りがありますので、公共交通機関にてご来場ください。なお、満車の際はご容赦ください。</small>
						</div>
				</div>
		</div>
		<!--
		<div class="frontShop">
				<div class="frontShop__inner">
						<div class="frontShop__headline"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/title_shop.png" alt=""></div>
						<div class="frontShop__inner col-3">
								<div class="col-3__item">
										<a href="#">
												<div class="col-3__img"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/thumbnail.jpg" alt=""></div>
												<div class="col-3__title frontShop">お店の名前</div>
										</a>
								</div>
								<div class="col-3__item">
										<a href="#">
												<div class="col-3__img"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/thumbnail.jpg" alt=""></div>
												<div class="col-3__title frontShop">コロコロチキンラーメン</div>
										</a>
								</div>
								<div class="col-3__item">
										<a href="#">
												<div class="col-3__img"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/thumbnail.jpg" alt=""></div>
												<div class="col-3__title frontShop">アジアンランチ</div>
										</a>
								</div>
						</div><a href="#" class="btn">もっと見る</a>
				</div>
		</div>
		-->
		<div class="frontContact">
				<div class="frontContact__inner">
						<div class="frontContact__headline"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/title_contact.png" alt=""></div>
						<ul class="frontContact__list"></ul>
						<li class="frontContact__item">株式会社ワークストア・トウキョウドゥ</li>
						<li class="frontContact__item">電　話：03-3737-3000</li>
						<li class="frontContact__item"><a href="https://www.w-tokyodo.com/contact" target="_blank"></a>お問い合わせ：https://www.w-tokyodo.com/contact</li>
				</div>
		</div>
		<div class="frontSponsor">
				<div class="frontSponsor__inner">
						<div class="frontSponsor__headline"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/title_sponsor.png" alt=""></div>
						<ul class="frontSponsor__list col-3">
								<li class="frontSponsor__item col-3__item">
										<a target="_blank" href="http://www.nack5.co.jp/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/logo-nack5.jpg" alt=""></a>
								</li>
								<li class="frontSponsor__item col-3__item">
										<a target="_blank" href="http://www.reds-ss.com/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/logo-reds.png" width="60px" alt=""></a>
								</li>
								<li class="frontSponsor__item col-3__item">
										<a target="_blank" href="https://www.w-tokyodo.com/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/logo-tokyodo.jpg" alt=""></a>
								</li>
						</ul>
				</div>
		</div>
<?php
//get_sidebar();
get_footer();