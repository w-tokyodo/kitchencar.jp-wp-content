<?php

add_action( 'init', function() {
	register_post_type(
		'kitchencar',
		[
			'label' => 'キッチンカー',
			'public' => true,
            'has_archive' => true,
			'supports' => [ 'title', 'editor', 'custom-fields', 'thumbnail' ]
		]
	);
	register_post_type(
		'kgc_entry',
		[
			'label' => '選手権エントリー',
			'public' => true
		]
	);
	register_taxonomy(
		'kgc_number',
		[ 'kgc_entry' ],
		[
			'label' => '開催年',
			'hierarchical' => false
		]
	);
} );
