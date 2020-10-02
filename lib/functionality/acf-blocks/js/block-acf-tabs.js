(function($){

     var initializeBlock = function( $block ) {

          // variables for specific block ID (in case there are multiple instances of tabbed block)
          var blockID = $('.acf-tabs-block').attr('id');
          var container = $('#' + blockID);

          // click controls for aria properties
          $('.acf-tabs-block__tab').click(function(e) {

               var blockID = $(this).closest('.acf-tabs-block').attr('id');
               var tabTarget = $(this).attr('aria-controls');

               // prevent default event behavior
               e.preventDefault();

               // toggle selected state on tablist elements
               $(this).attr('aria-selected', true);
               $('#' + blockID + ' .acf-tabs-block__tab').not(this).attr( 'aria-selected', false );

               // toggle selected tab
               $('#' + blockID + ' .acf-tabs-block__tabpanel').attr( 'aria-expanded', false );
               $('#' + tabTarget).attr( 'aria-expanded', true );

          });

          // keyup controls for aria properties
          $('.acf-tabs-block__tab').keyup(function(e) {

               var blockID = $(this).closest('.acf-tabs-block').attr('id');
               var tabTarget = $(this).attr('aria-controls');
               var tabCount = $('#' + blockID + ' .acf-tabs-block__tab' ).length;

               // current tab counts
               var tabIndex = $(this).index();
               var tabPrevious = $(this).index() - 1;
               var tabNext = $(this).index() + 1;

               // keyboard controls for return & space keys
               if( e.keyCode == 13 || e.keyCode == 32 ) { // return or space key

                    // prevent default event behavior
                    e.preventDefault();

                    // toggle selected state on tablist elements
                    $(this).attr( 'aria-selected', true );
                    $('#' + blockID + ' .acf-tabs-block__tab').not(this).attr( 'aria-selected', false );

                    // toggle selected tab
                    $('#' + blockID + ' .acf-tabs-block__tabpanel').attr( 'aria-expanded', false );
                    $('#' + tabTarget).attr( 'aria-expanded', true );

               }

               // keyboard controls for end, home, left and right arrows
               switch (e.keyCode) {
                    case 35: // end key
                         e.preventDefault();
                         $('#' + blockID + ' .acf-tabs-block__tab:last-child' ).attr( 'aria-selected', true ).focus();
                         $('#' + blockID + ' .acf-tabs-block__tab:not(:last-child)' ).attr( 'aria-selected', false );
                         $('#' + blockID + ' .acf-tabs-block__tabpanel:last-child').attr( 'aria-expanded', true );
                         $('#' + blockID + ' .acf-tabs-block__tabpanel:not(:last-child)').attr( 'aria-expanded', false );
                    break;

                    case 36: // home key
                         e.preventDefault();
                         $('#' + blockID + ' .acf-tabs-block__tab:first-child' ).attr( 'aria-selected', true ).focus();
                         $('#' + blockID + ' .acf-tabs-block__tab:not(:first-child)' ).attr( 'aria-selected', false );
                         $('#' + blockID + ' .acf-tabs-block__tabpanel:first-child').attr( 'aria-expanded', true );
                         $('#' + blockID + ' .acf-tabs-block__tabpanel:not(:first-child)').attr( 'aria-expanded', false );
                    break;

                    case 37: // left arrow
                         e.preventDefault();
                         var thisIndex = $(this).index();
                         if( thisIndex > 0 ) {
                              $('#' + blockID + ' .acf-tabs-block__tab' ).eq(tabPrevious).attr( 'aria-selected', true ).focus();
                              $('#' + blockID + ' .acf-tabs-block__tab' ).not(':eq(' + tabPrevious + ')' ).attr( 'aria-selected', false );
                              $('#' + blockID + ' .acf-tabs-block__tabpanel' ).eq(tabPrevious).attr( 'aria-expanded', true );
                              $('#' + blockID + ' .acf-tabs-block__tabpanel' ).not(':eq(' + tabPrevious + ')' ).attr( 'aria-expanded', false );
                         }
                    break;

                    case 39: // left arrow
                         e.preventDefault();
                         var thisIndex = $(this).index();
                         if( thisIndex < ( tabCount - 1 ) ) {
                              $('#' + blockID + ' .acf-tabs-block__tab' ).eq(tabNext).attr( 'aria-selected', true ).focus();
                              $('#' + blockID + ' .acf-tabs-block__tab' ).not(':eq(' + tabNext + ')' ).attr( 'aria-selected', false );
                              $('#' + blockID + ' .acf-tabs-block__tabpanel' ).eq(tabNext).attr( 'aria-expanded', true );
                              $('#' + blockID + ' .acf-tabs-block__tabpanel' ).not(':eq(' + tabNext + ')' ).attr( 'aria-expanded', false );
                         }
                    break;
               }

          });


    }

     // Initialize each block on page load (front end).
     $(document).ready(function(){
          initializeBlock( ('.acf-tabs-block') );
     });

     if( window.acf ) {
          window.acf.addAction( 'render_block_preview/type=acf-tabs', initializeBlock );
     }

})(jQuery);
