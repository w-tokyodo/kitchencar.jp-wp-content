<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package KitchinCar_Gourmet_Championship
 */

$context = 'shop';
if ( isset( $_REQUEST['view'] ) && $_REQUEST['view'] === 'list' ) {
	$context = 'table';
	add_action( 'wp_head', function() {
		echo <<<EOF
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<style>table a { background-color: transparent !important; }</style>
EOF;
	} );
}

get_header(); ?>

<div class="content-header">
	<div class="content-header__image">
		<a href="/">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/static/assets/img/single-header.png" >
		</a>
	</div>
</div>

<?php
get_template_part('template-parts/loop', $context );

get_footer();
