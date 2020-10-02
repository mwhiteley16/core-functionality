<?php
/**
 * Slideshow Block
 *
 * @package      ClientName
 * @author       Matt Whiteley
 * @since        3.0.0
 * @license      GPL-2.0+
**/

// ACF Variable custom meta


// Block ID
$block_id = $block['id'];

// Block Classes
$block_classes = 'acf-block acf-tabs-block';

if( ! empty( $block['align'] ) ) { // get align class if present
     $block_classes .= ' align' . $block['align'];
}

if( ! empty( $block['className'] ) ) { // get custom class name if present
     $block_classes .= ' ' . $block['className'];
}

?>

<div id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $block_classes ); ?>">

     <div id="acf-tabs-<?php echo $block['id']; ?>" class="acf-tabs-block__interior">

          <?php if ( have_rows( 'wd_block_tabs' ) ) : ?>

               <ul class="acf-tabs-block__tablist" role="tablist">

                    <?php
                    $tablist_count = 0; // set initial tab count
                    $tablist_aria_state = 'true'; // set initial aria selected state
                    ?>

                    <?php while ( have_rows( 'wd_block_tabs' ) ) : the_row(); $tablist_count++; ?>

                         <li class="acf-tabs-block__tab" role="tab" aria-controls="tabpanel-<?php echo $block['id']; ?>-<?php echo $tablist_count; ?>" tabindex="0" aria-selected="<?php echo $tablist_aria_state; ?>">
                              <?php the_sub_field( 'wd_tab_label' ); ?>
                         </li>

                         <?php // set aria state to false for all subsequent tabs
                         $tablist_aria_state = 'false'; ?>

                    <?php endwhile; ?>

               </ul>

               <main class="acf-tabs-block__tabpanels">

                    <?php
                    $tabpanel_count = 0; // set initial tab count
                    $tabpanel_aria_state = 'true'; // set initial aria expanded state
                    ?>

                    <?php while ( have_rows( 'wd_block_tabs' ) ) : the_row(); $tabpanel_count++; ?>

                         <div id="tabpanel-<?php echo $block['id']; ?>-<?php echo $tabpanel_count; ?>" class="acf-tabs-block__tabpanel" role="tabpanel" aria-expanded="<?php echo $tabpanel_aria_state; ?>">
                              <?php the_sub_field( 'wd_tab_content' ); ?>
                         </div>

                         <?php // set aria state to false for all subsequent tabs
                         $tabpanel_aria_state = 'false'; ?>

                    <?php endwhile; ?>

               </main>

          <?php endif; ?>

     </div>

</div>
