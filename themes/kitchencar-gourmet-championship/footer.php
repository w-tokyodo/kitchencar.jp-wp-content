<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package KitchenCar_Gourmet_Championship
 */

?>
		<div class="frontSpecial">
				<div class="frontSpecial__inner">
					<div class="frontSpecial__col-2--left">
						<a href="http://www.w-tokyodo.com/neostall/" target="_blank">
								<div class="frontSpecial__image"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/logo-neostall.png" alt=""></div>
								<div class="frontSpecial__text">Powered by Tokyo do.</div>
						</a>
					</div>
					<div class="frontSpecial__col-2--right">
						<a href="http://foodear.jp" target="_blank">
								<div class="frontSpecial__image"><img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/logo-foodear.png" width="100px" alt=""></div>
								<div class="frontSpecial__text">Design by foodear.</div>
						</a>
					</div>
				</div>
		</div>
		<div class="frontCopyright">
				<div class="frontCopyright__inner">
						<p>Copyright (C) 2016 キッチンカースタジアムグルメ選手権. All Rights Reserved.</p>
				</div>
		</div>
		<?php wp_footer(); ?>
		</body>

		</html>
