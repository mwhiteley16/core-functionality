<?php
/**
 * Register Shortcodes
 * Shortcode uses get_template_part so requires ob_start & ob_get_clean
 *
 * @since 2.0
 */
function newsItems( $atts ) {
extract( shortcode_atts( array (
     'posts' => 3,
), $atts ) );

$news_query= null;
$args = array(
     'post_type'      => 'news',
     'post_status'    => 'publish',
     'posts_per_page' => $posts,
);

$news_query = new WP_Query( $args );
$output = '';
if ( $news_query->have_posts() ) {
     $output .= '<div class="news-shortcode-posts">';
     while ( $news_query->have_posts() ) : $news_query->the_post();
          ob_start();
          get_template_part( 'inc/news-item' );
          $output .= ob_get_clean();
     endwhile;
     $output .= '</div>';
}
return $output;
}

/**
 * Register Shortcodes
 * Basic shortcode with query
 *
 * @since 2.0
 */
function teamItems( $atts ) {
extract( shortcode_atts( array (
     'posts' => 10,
     'type' => 'staff'
), $atts ) );

$team_query= null;
$args = array(
     'post_type'      => 'team',
     'post_status'    => 'publish',
     'posts_per_page' => $posts,
     'tax_query'      => array(
          array(
               'taxonomy' => 'team_member_type',
               'field'    => 'slug',
               'terms'    => $type,
          )
     )
);

$team_query = new WP_Query( $args );
$output = '';
if ( $team_query->have_posts() ) {
     $output .= '<div class="team-shortcode-posts">';
     while ( $team_query->have_posts() ) : $team_query->the_post();
          ob_start();
          $output .= '<div class="team-member-item">';
               $output .= '<div class="team-member-image">' . get_the_post_thumbnail() . '</div>';
               $output .= '<div class="team-member-right">';
                    $output .= '<span class="team-member-title">' . get_the_title() . '</span>';
                    $output .= '<div class="team-member-excerpt">' . get_the_excerpt() . '</div>';
                    $output .= '<a class="team-readmore-link button" href="' . get_the_permalink() . '">Read More</a>';
               $output .= '</div>';
          $output .= '</div>';
          $output .= ob_get_clean();
     endwhile;
     $output .= '</div>';
}
return $output;
}

//add_shortcode('apprenticeday-team', 'teamItems');
//add_shortcode('teamsters-news', 'newsItems');
