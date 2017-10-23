<div class="frontShop">
		<div class="frontShop__inner">
				<div class="frontShop__headline"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/title_shop.png" alt=""></div>
				<div class="frontShop__info">
					全国から
					<span class="frontShop__info__number"><?= esc_html( kgc_get_entries_num( 2017 ) ) ?></span>
					店舗が集結!!
				</div>

				<div class="frontShop__inner col-3">

				<?php $loop = new WP_Query( array('post_type' => 'kgc_shop', 'posts_per_page' => 6 ,'orderby' => 'rand' ) ); while ( $loop->have_posts() ) : $loop->the_post(); ?>

						<div class="col-3__item frontShop__item">
								<a href="<?php the_permalink(); ?>">
									<div class="col-3__img frontShop__thumb">
										<?php if ( has_post_thumbnail()): ?>
											<?php the_post_thumbnail('kgc_thumbnail'); ?>
										<?php else: ?>
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/thumbnail.jpg" alt="<?php the_title(); ?>">
										<?php endif; ?>
										<div class="frontShop__car">
											<?php $image = get_post_meta($post->ID, 'shop-image', true); echo wp_get_attachment_image($image, 'kgc_thumbnail_car');?>
										</div>
									</div>
								</a>
								<div class="col-3__title frontShop__cat"><?php echo get_the_term_list($post->ID, 'kgc_shop_cat'); ?></div>
								<a href="<?php the_permalink(); ?>">
									<div class="col-3__title frontShop__title">
										<?php
										if(mb_strlen($post->post_title, 'UTF-8')>14){
											$title= mb_substr($post->post_title, 0, 14, 'UTF-8');
											echo $title.'…';
										}else{
											echo $post->post_title;
										}
										?>
									</div>
									<div class="col-3__title frontShop__copy"><?php echo SCF::get('shop-copy'); ?></div>
								</a>
						</div>

				<?php endwhile; ?> 
				<?php wp_reset_postdata(); ?>

				</div><a href="/kgc_shop" class="btn">もっと見る</a>
		</div>
</div>