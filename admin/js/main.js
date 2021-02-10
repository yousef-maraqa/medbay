(function($) {

	"use strict";

	var fullHeight = function() {
$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});
		$('.js-fullheight').css('height', $(window).height());
		

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

})(jQuery);
