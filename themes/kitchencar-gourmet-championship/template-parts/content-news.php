		<div class="frontNews">
				<div class="frontNews__inner">
						<div class="frontNews__headline"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/title_news.png" alt=""></div>
						<ul class="frontNews__list">
						<?php $loop = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 5,'category_name' => '2017') ); while ( $loop->have_posts() ) : $loop->the_post(); ?>
								<li class="frontNews__item">
										<a href="<?php the_permalink(); ?>">
												<div class="frontNews__item__date">
													<?php if (has_post_thumbnail()) { ;?>
														<?php the_post_thumbnail('kgc_news_thumbnail'); ?>
													<?php } else { ;?>
														<img src="<?php echo get_stylesheet_directory_uri();?>/static/assets/img/ktc_thumbnail.jpg" alt="サムネイル画像無し">
													<?php }; ?>
												</div>
												<div class="frontNews__item__title">
													<div class="news_date">
														<?php the_time('Y.m.d'); ?>
													</div>
													<?php the_title(); ?>
												</div>
										</a>
								</li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
						</ul>
						<a href="<?php echo esc_url(home_url('/2017')); ?>" class="btn">もっと見る</a>
				</div>
		</div>
