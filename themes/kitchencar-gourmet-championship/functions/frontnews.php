<?php
/*
function add_general_fields() {
	add_settings_field('frontnews','フロントニュース','custom_frontnews_fields','general','default',array('label_for' => 'frontnews'));
}

add_filter('admin_init','add_general_fields');

function custom_frontnews_fields() {
	$frontnews = get_option('frontnews');
?>
	<textarea name="frontnews" id="frontnews" cols="30" rows="10">
		<?php echo esc_html($frontnews);?>
	</textarea>
<?php }
add_filter( 'admin_init', 'custom_frontnews_fields' );

function register_setting_fields() {
	register_setting('general','frontnews');
}
add_filter('admin_init','register_setting_fields');
*/

function add_my_option_field() {
	add_settings_field( 'frontnews', 'フロントニュース', 'display_my_option', 'general' );
	register_setting( 'general', 'frontnews' );
}
add_filter( 'admin_init', 'add_my_option_field' );

function display_my_option() {
	$frontnews = get_option( 'frontnews' );
	?>
	<textarea name="frontnews" id="frontnews" cols="50" rows="10"><?php echo esc_html($frontnews);?></textarea>
	<?php
}