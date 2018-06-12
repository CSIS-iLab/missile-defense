/**
 * Collapsible Content
 */

(function($) {
  function expandCollapsibleContent() {
    var collapsibleContent = $(".collapsible-content-container .collapsible-title");
    if ( collapsibleContent.length ) {
        collapsibleContent.on("click", function() {
          $(this).toggleClass('expanded');
          $(this).siblings(".collapsible-content").slideToggle();
          $(this).children("i").toggleClass('rotated');
        })
    }
  }
  expandCollapsibleContent();
})(jQuery);