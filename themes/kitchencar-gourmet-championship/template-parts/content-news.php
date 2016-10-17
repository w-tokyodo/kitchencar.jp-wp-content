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