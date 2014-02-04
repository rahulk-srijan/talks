(function ($) {

  Drupal.behaviors.viewsInfiniteScroll = {
    attach: function (context, settings) {
      $(function(){

        var $container = $('.search-results');
        $container.imagesLoaded( function(){
          $container.infinitescroll({
            navSelector  : 'ul.pager',    // selector for the paged navigation
            nextSelector : '.pager-next a',  // selector for the NEXT link (to page 2)
            itemSelector : '.search-results .search-result',     // selector for all items you'll retrieve
            loading: {
              finishedMsg: 'No more pages to load.',
              msgText: '',
              img: Drupal.settings.basePath + 'sites/all/modules/contrib/views_infinite_scroll/images/ajax-loader.gif'
            }
        }, function(){
          if (jQuery(window).width() < 700)
                search_trim();
            })
    })
  });
  }
};

})(jQuery);