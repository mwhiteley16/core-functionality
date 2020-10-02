(function($){

     var initializeBlock = function( $block ) {

          var options = {
               cellAlign: 'left',
               setGallerySize: true,
               autoPlay: 6000,
               wrapAround: false,
               dragThreshold: 25,
               pageDots: true,
               prevNextButtons: true,
               imagesLoaded: true,
               adaptiveHeight: true,
               cellSelector: '.acf-slideshow-block__slide',
          }

          // setup slideshow
          var $carousel = $('.acf-slideshow-block__slides').flickity( options );

          //var flkty = $carousel.data('flickity');
          //var $cellButtonGroup = $('');
          //var $cellButtons = $cellButtonGroup.find('i.far');

          // previous
          //var $previousButton = $('.fa-arrow-left').on( 'click', function() {
          //     $carousel.flickity('previous');
          //});

          // next
          //var $nextButton = $('.fa-arrow-right').on( 'click', function() {
          //     $carousel.flickity('next');
          //});

          // update selected cellButtons
          // $carousel.on( 'select.flickity', function() {
          //      $cellButtons.filter('.is-selected')
          //           .removeClass('is-selected');
          //      $cellButtons.eq( flkty.selectedIndex )
          //           .addClass('is-selected');
          //
          //      // enable/disable previous/next buttons
          //      if ( !flkty.slides[ flkty.selectedIndex - 1 ] ) {
          //           $previousButton.attr( 'disabled', 'disabled' );
          //           $nextButton.removeAttr('disabled'); // <-- remove disabled from the next
          //      } else if ( !flkty.slides[ flkty.selectedIndex +1 ] ) {
          //           $nextButton.attr( 'disabled', 'disabled' );
          //           $previousButton.removeAttr('disabled'); //<-- remove disabled from the prev
          //      } else {
          //           $previousButton.removeAttr('disabled');
          //           $nextButton.removeAttr('disabled');
          //      }
          // });

    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){
        $('.acf-slideshow-block').each(function(){
            initializeBlock( $(this) );
        });
    });

     if( window.acf ) {
          window.acf.addAction( 'render_block_preview/type=acf-slideshow', initializeBlock );
     }

})(jQuery);
