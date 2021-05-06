<?php
/**
 * Returns the HTML for the breaking news banner
 *
 * Add '<?php echo jm_breaking_news(); ?>' anywhere in your theme to display the breaking news.
 *
 * @return string, HTML for the banner
 */
function jm_breaking_news() {
	$html                  = '';
	$jm_breaking_news_args = [
		'post_type'         => 'jm_breaking_news',
		'posts_per_page'    => 1,
	];
	$jm_breaking_news      = new WP_Query( $jm_breaking_news_args );

	if ( $jm_breaking_news->have_posts() ) :
		while ( $jm_breaking_news->have_posts() ) :
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
				$html .= '<section class="breaking-news-box">';
				$html .= '<div class="breaking-news-left" ' . $style . '>';
				$html .= '<h2 class="breaking-news-left-h2" ' . $text_color_style . '>' . __( 'Breaking News', 'jm-breaking-news' ) . '</h2>';
				$html .= '</div>';
				$html .= '<div class="breaking-news-right" ' . $background_color_style . '>';
				if ( $link != '' ) {
					$html .= '<h2 class="breaking-news-right-h2" ' . $news_text_color_style . '><a href="' . $link . '" ' . $target . '>' . get_the_title() . '</a></h2>';
				} else {
					$html .= '<h2 class="breaking-news-right-h2" ' . $news_text_color_style . '>' . get_the_title() . '</h2>';
				}
				$html .= '</div>';
				$html .= '</section>';
			}
		endwhile;
	endif;
	wp_reset_postdata();

	return $html;
}
