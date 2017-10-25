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
	<div class="frontCopyright">
		<div class="frontCopyright__inner">
			<p>Copyright (C) 2017 キッチンカースタジアムグルメ選手権. All Rights Reserved.</p>
		</div>
	</div>
</div>
<div id="menu">
	<ul class="menu__list">
		<?php
		$only_li_menu = array(
			'container' => '',//<div>を出力しない
			'items_wrap' => '%3$s',//<ul>を出力しない
		);
		wp_nav_menu($only_li_menu);
		?>
	</ul>

</div>
<?php wp_footer(); ?>
</body>
</html>
