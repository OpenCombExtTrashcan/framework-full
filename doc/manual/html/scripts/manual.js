jQuery(function() {
	var doc_index = jQuery('#doc_index');
	var doc_height = jQuery('#doc_index').outerHeight();
	// doc手册目录的高度
	var index_tilte_height = 30;
	// 目录标题的高度
	// var tur_height = ; //教程目录的高度
	// var quick_height = ; //速查手册目录的高度

	resetIndexScroll();
	replaceIndexs();

	(function() {
		jQuery('#manual_index').find("ul").hide(0);
	})();

	function replaceIndexs() {
		doc_index.css({
			'top' : -doc_height, // +indexs_top_for_tilte) ,
			'left' : getDocLeft()
		});
		function getDocLeft() {
			return jQuery('body').outerWidth() / 2 - doc_index.outerWidth() / 2;
		}
	}

	jQuery(window).resize(function() {
		resetIndexScroll();
		replaceIndexs();
	});
	// 改变选单内容高度
	function resetIndexScroll() {
		jQuery('#doc_index .index_scroll').css(
				{
					'height' : window.innerHeight - 30 //???
				});
	}

	jQuery('#doc_index_title').toggle(function() {
		jQuery('#doc_index .index_scroll').slideDown(300);
	}, function() {
		jQuery('#doc_index .index_scroll').slideUp(300);
	});
});
