<?php
/**
 * Separator Block
 *
 * @package      ClientName
 * @author       Matt Whiteley
 * @since        3.0.0
 * @license      GPL-2.0+
**/

// ACF Variables
$wd_background_color = get_field( 'wd_background_color' );
$wd_block_separator_width_choice = get_field( 'wd_block_separator_width_choice' );
$wd_block_separator_width = get_field( 'wd_block_separator_width' );
$wd_block_separator_height = get_field( 'wd_block_separator_height' );
$wd_block_separator_include_margin = get_field( 'wd_block_separator_include_margin' );
$wd_block_separator_alignment = get_field( 'wd_block_separator_alignment' );

// Block ID
$block_id = 'acf-separator-' . $block['id'];

// Block Classes
$block_classes = 'acf-block acf-separator-block ' . $wd_block_separator_include_margin . ' ' . $wd_block_separator_alignment;

// get align class if present
if( ! empty( $block['align'] ) ) {
     $block_classes .= ' align' . $block['align'];
}

// get custom class name if present
if( ! empty( $block['className'] ) ) {
     $block_classes .= ' ' . $block['className'];
}

// set hr styles
$hr_styles = '';
$hr_styles .= 'height:' . $wd_block_separator_height . 'px;';

if( $wd_block_separator_width_choice == 'user-defined' ) {
     $hr_styles .= 'width:' . $wd_block_separator_width . 'px;';
}

?>

<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $block_classes ); ?>">
     <hr class="has-<?php echo $wd_background_color; ?>-background-color" style="<?php echo esc_attr( $hr_styles ); ?>">
</div>
