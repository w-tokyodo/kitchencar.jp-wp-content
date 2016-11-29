<?php

add_action( 'init', function() {
	register_post_type(
		'kitchencar',
		[
			'label' => 'キッチンカー',
			'public' => true,
            'has_archive' => true,
			'supports' => [ 'title', 'editor', 'author', 'custom-fields', 'thumbnail' ]
		]
	);
	register_post_type(
		'kgc_entry',
		[
			'label' => '選手権エントリー',
			'public' => true,
			'supports' => [ 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail' ]
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
