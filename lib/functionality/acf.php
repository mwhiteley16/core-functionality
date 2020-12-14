<?php
/**
 * register options page
 * @link https://www.advancedcustomfields.com/resources/options-page/
 *
 */
if( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'position'     => '58.997', // Adds under Genesis options page
		'icon_url'     => 'dashicons-image-filter', // https://developer.wordpress.org/resource/dashicons/
		'redirect'	=> false
	) );
}


/**
 * restrict access to ACF from dashboard based on specific users
 *
 */
add_filter( 'acf/settings/show_admin', 'wd_acf_show_admin' );
function wd_acf_show_admin( $show ) {

     // get current users
     $current_user = wp_get_current_user();

     // create array of approved users
     $approved_users = [
          "matt@whiteleydesigns.com",
     ];

     // allow access to acf if current user is in approved users list
     $access_result = in_array( $current_user->user_email, $approved_users ) ? true : false;
     return $access_result;

}


/**
 * ACF Gutenberg Blocks
 *
 * Categories: common, formatting, layout, widgets, embed
 * Modes: preview, edit, auto
 * Align: left, center, right, wide, full
 * Align Text: left, center, right
 * Align Content: top, center, bottom (top left, etc available with matrix)
 * Dashicons: https://developer.wordpress.org/resource/dashicons/
 * ACF Settings: https://www.advancedcustomfields.com/resources/acf_register_block/
 * Gutenberg Supports: https://developer.wordpress.org/block-editor/developers/block-api/block-supports/
 *
*/
add_action( 'acf/init', 'wd_acf_blocks' );
function wd_acf_blocks() {

 	if( function_exists( 'acf_register_block' ) ) {

          // acf_register_block_type(array(
          //      'name'			=> '',
          //      'title'			=> __( '' ),
          //      'description'		=> __( '' ),
          //      'category'		=> 'wd-blocks',
          //      'icon'			=> [
          //           'background' => '#fff',
          //           'foreground' => '#b5267b',
          //           'src'        => 'star-filled'
          //      ],
          //      'mode'              => 'preview',
          //      'align'             => '',
          //      'keywords'		=> [ '', 'wd', 'acf', 'CLIENT-NAME' ],
          //      'post_type'         => [ 'post', 'page' ],
          //      'render_callback'	=> 'wd_acf_block_render_callback',
          //      'enqueue_script'    => plugin_dir_url(__FILE__) . '/acf-blocks/js/block-acf-NAME.js',
          //      'enqueue_style'     => get_stylesheet_directory_uri() . '/assets/scss/partials/blocks/css-output/blocks-NAME.css',
          //      'supports'          => [
          //           'align' => false, // disable alignment toolbar, defaults to true
          //           // 'align' => [ 'left', 'right', 'full' ] // customize which are available
          //           'align_text' => true, // defaults to false
          //           'align_content' => true, // defaults to false ('matrix' to use align_content matrix)
          //           'anchor' => true, // defaults to false
          //           'multiple' => false, // allows multiple instances of block, defaults to true
          //           'jsx' => true // defaults to false, used for innerBlocks
          //      ]
          // ));

          acf_register_block_type(array(
               'name'			=> 'acf-separator',
               'title'			=> __( 'Separator Block' ),
               'description'		=> __( 'A block to replace the standard block editor separator block.' ),
               'category'		=> 'wd-blocks',
               'icon'			=> [
                    'background' => '#fff',
                    'foreground' => '#b5267b',
                    'src'        => 'minus'
               ],
               'mode'              => 'preview',
               'keywords'		=> [ 'separator', 'hr', 'divider', 'wd', 'acf' ],
               'post_type'         => [ 'post', 'page' ],
               'render_callback'	=> 'wd_acf_block_render_callback',
               'enqueue_style'     => get_stylesheet_directory_uri() . '/assets/scss/partials/blocks/css-output/blocks-separator.css',
               'supports'          => [
                    'align' => [ 'full', 'wide' ],
               ]
          ));

          acf_register_block_type(array(
               'name'			=> 'acf-max-width-block',
               'title'			=> __( 'Max-Width Block' ),
               'description'		=> __( 'A block to wrap any content in a max-width container with alignment options.' ),
               'category'		=> 'wd-blocks',
               'icon'			=> [
                    'background' => '#fff',
                    'foreground' => '#b5267b',
                    'src'        => 'editor-expand'
               ],
               'mode'              => 'preview',
               'keywords'		=> [ 'max-width', 'wd', 'acf' ],
               'post_type'         => [ 'post', 'page' ],
               'render_callback'	=> 'wd_acf_block_render_callback',
               'enqueue_style'     => get_stylesheet_directory_uri() . '/assets/scss/partials/blocks/css-output/blocks-max-width.css',
               'supports'          => [
                    'align'      => false,
                    'align_text' => true,
                    'jsx'        => true
               ]
          ));

 	}
}

// callback to render proper template
function wd_acf_block_render_callback( $block ) {

	// convert name into path friendly slug
	$slug = str_replace('acf/', '', $block['name']);

     // include a template part from within the "blocks/templates" folder
	if( file_exists( dirname(__FILE__) . "/acf-blocks/templates/block-{$slug}.php") ) {
		include( dirname(__FILE__) . "/acf-blocks/templates/block-{$slug}.php" );
	}
}


/**
 *
 * add custom block category for ACF blocks
 *
 * @link https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
 *
 */
function wd_block_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'wd-blocks',
				'title' => __( 'Whiteley Designs Blocks', 'wd-blocks' ),
			),
		)
	);
}
add_filter( 'block_categories', 'wd_block_category', 10, 2);


/**
 * ACF Color Palette
 * @link https://www.advancedcustomfields.com/resources/adding-custom-javascript-fields/
 *
 * Add default color palatte to ACF color picker for branding
 * Match these colors to colors in /functions.php & /assets/scss/partials/base/variables.scss
 *
*/
function wd_acf_color_palette() { ?>
<script type="text/javascript">
(function($) {
     acf.add_filter('color_picker_args', function( args, $field ){
          args.palettes = [
               '#007991',
               '#439a86',
               '#e9d985',
               '#ffffff',
               '#000000'
          ]
          return args;
     });
})(jQuery);
</script>
<?php }
add_action( 'acf/input/admin_footer', 'wd_acf_color_palette' );


/**
 * ACF Radio Color Palette
 * @link https://www.advancedcustomfields.com/resources/acf-load_field/
 * @link https://www.advancedcustomfields.com/resources/dynamically-populate-a-select-fields-choices/
 * @link https://whiteleydesigns.com/create-a-gutenberg-like-color-picker-with-advanced-custom-fields
 *
 * Dynamically populates any ACF field with wd_text_color Field Name with custom color palette
 *
*/
add_filter('acf/load_field/name=wd_text_color', 'wd_acf_dynamic_colors_load');
add_filter('acf/load_field/name=wd_background_color', 'wd_acf_dynamic_colors_load');
function wd_acf_dynamic_colors_load( $field ) {

     // get array of colors created using editor-color-palette
     $colors = get_theme_support( 'editor-color-palette' );

     // if this array is empty, continue
     if( ! empty( $colors ) ) {

          // loop over each color and create option
          foreach( $colors[0] as $color ) {
               $field['choices'][ $color['slug'] ] = $color['name'];
          }
     }

     return $field;
}
