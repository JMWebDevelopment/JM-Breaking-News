<?php
$jm_breaking_news_args = [
	'post_type'      => 'jm_breaking_news',
	'posts_per_page' => 1,
];
$jm_breaking_news = new WP_Query($jm_breaking_news_args);

if ( $jm_breaking_news->have_posts() ) {
	while ( $jm_breaking_news->have_posts() ) {
		$jm_breaking_news->the_post();
		$current_time = strtotime( current_time( 'mysql' ) );
		$post_time    = strtotime( get_the_date( 'r' ) );
		$difference   = ( $current_time - $post_time ) / ( 60 * 60 );
		$limit        = get_post_meta( get_the_ID(), 'jm_breaking_news_limit', true );
		if ( 1 === get_post_meta( get_the_ID(), 'jm_breaking_news_target', true ) ) {
			$target = 'target="_blank"';
		} else {
			$target = '';
		}
		if ( 1 === get_post_meta( get_the_ID(), 'jm_breaking_news_in_ex', true ) ) {
			$link = get_post_meta( get_the_ID(), 'jm_breaking_news_internal_link', true );
		} else {
			$link = get_post_meta( get_the_ID(), 'jm_breaking_news_link', true );
		}
		if ( get_post_meta( get_the_ID(), 'jm_breaking_news_color', true ) ) {
			$style = 'style="background-color:' . get_post_meta( get_the_ID(), 'jm_breaking_news_color', true ) . ';"';
		} else {
			$style = '';
		}
		if ( get_post_meta( get_the_ID(), 'jm_breaking_news_background_color', true ) ) {
			$background_color_style = 'style="background-color:' . get_post_meta( get_the_ID(), 'jm_breaking_news_background_color', true ) . ';"';
		} else {
			$background_color_style = '';
		}
		if ( get_post_meta( get_the_ID(), 'jm_breaking_news_text_color', true ) ) {
			$text_color_style = 'style="color:' . get_post_meta( get_the_ID(), 'jm_breaking_news_text_color', true ) . ';"';
		} else {
			$text_color_style = '';
		}
		if ( get_post_meta( get_the_ID(), 'jm_breaking_news_news_text_color', true ) ) {
			$news_text_color_style = 'style="color:' . get_post_meta( get_the_ID(), 'jm_breaking_news_news_text_color', true ) . ';"';
		} else {
			$news_text_color_style = '';
		}
		$use_limit = apply_filters( 'jm_breaking_news_use_time_limit', true );
		if ( $difference < $limit || false === $use_limit ) {
			?>
			<section <?php echo get_block_wrapper_attributes(); ?>>
				<div class="breaking-news-box">
					<div class="breaking-news-left" <?php echo wp_kses_post( $style ); ?>>
					<h2 class="breaking-news-left-h2" <?php echo wp_kses_post( $text_color_style ); ?>><?php esc_html_e( 'Breaking News', 'jm-breaking-news' ); ?></h2>
					</div>
					<div class="breaking-news-right" <?php echo wp_kses_post( $background_color_style ); ?>>
					<?php
					if ( $link != '' ) {
						?>
						<h2 class="breaking-news-right-h2" <?php echo wp_kses_post( $news_text_color_style ); ?>><a href="<?php echo esc_url( $link ); ?>" <?php echo wp_kses_post( $target ); ?>><?php the_title(); ?></a></h2>
						<?php
					} else {
						?>
						<h2 class="breaking-news-right-h2" <?php echo wp_kses_post( $news_text_color_style ); ?>><?php the_title(); ?></h2>
						<?php
					}
					?>
					</div>
				</div>
			</section>
			<?php
		}
	}
}
wp_reset_postdata();
