<?php
	add_action('rest_api_init', 'jm_breaking_news_add_bn_data');
	function jm_breaking_news_add_bn_data() {
		register_rest_field( 'jm_breaking_news',
			'jm_breaking_news_in_ex',
			array(
				'get_callback'    => 'jm_breaking_news_get_field',
				'schema'          => array(
					'description' => 'Internal or External Link',
					'type'        => 'string',
					'context'     => array( 'view' )
				)
			)
		);

		register_rest_field( 'jm_breaking_news',
			'jm_breaking_news_internal_link',
			array(
				'get_callback'    => 'jm_breaking_news_get_field',
				'schema'          => array(
					'description' => 'Link',
					'type'        => 'string',
					'context'     => array( 'view' )
				)
			)
		);

		register_rest_field( 'jm_breaking_news',
			'jm_breaking_news_link',
			array(
				'get_callback'    => 'jm_breaking_news_get_field',
				'schema'          => array(
					'description' => 'Link',
					'type'        => 'string',
					'context'     => array( 'view' )
				)
			)
		);

		register_rest_field( 'jm_breaking_news',
			'jm_breaking_news_target',
			array(
				'get_callback'    => 'jm_breaking_news_get_field',
				'schema'          => array(
					'description' => 'Opens in a new window or not',
					'type'        => 'string',
					'context'     => array( 'view' )
				)
			)
		);

		register_rest_field( 'jm_breaking_news',
			'jm_breaking_news_limit',
			array(
				'get_callback'    => 'jm_breaking_news_get_field',
				'schema'          => array(
					'description' => 'How long the post stays visible',
					'type'        => 'string',
					'context'     => array( 'view' )
				)
			)
		);

		register_rest_field( 'jm_breaking_news',
			'jm_breaking_news_color',
			array(
				'get_callback'    => 'jm_breaking_news_get_field',
				'schema'          => array(
					'description' => 'Color for the background of the "Breaking News" section.',
					'type'        => 'string',
					'context'     => array( 'view' )
				)
			)
		);

		register_rest_field( 'jm_breaking_news',
			'jm_breaking_news_background_color',
			array(
				'get_callback'    => 'jm_breaking_news_get_field',
				'schema'          => array(
					'description' => 'Color for the background of the body section.',
					'type'        => 'string',
					'context'     => array( 'view' )
				)
			)
		);

		register_rest_field( 'jm_breaking_news',
			'jm_breaking_news_text_color',
			array(
				'get_callback'    => 'jm_breaking_news_get_field',
				'schema'          => array(
					'description' => 'Color for the text of the "Breaking News" section.',
					'type'        => 'string',
					'context'     => array( 'view' )
				)
			)
		);

		register_rest_field( 'jm_breaking_news',
			'jm_breaking_news_news_text_color',
			array(
				'get_callback'    => 'jm_breaking_news_get_field',
				'schema'          => array(
					'description' => 'Color for the text of the body section.',
					'type'        => 'string',
					'context'     => array( 'view' )
				)
			)
		);
	}

	function jm_breaking_news_get_field( $post, $field_name, $request ) {
		return get_post_meta( get_the_ID(), $field_name, true );
	}
