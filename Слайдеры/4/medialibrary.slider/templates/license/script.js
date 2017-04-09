(function($){
	$(function(){
		var jcarousel = $('.medialibslider');

        var countElement = jcarousel.data("count-element");
        var carouselWrap = jcarousel.data("wrap");
        var autoscrollInterval = jcarousel.data("interval");
        var carouselAutostart = jcarousel.data("autostart");
        var carouselItemStart = jcarousel.data("start") - 1;

		jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var carousel = $(this),
                    width = carousel.innerWidth();

                if (width >= 600) {
                    width = width / countElement;
                } else if (width >= 350) {
                    width = width / 2;
                }

                carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
            })
            .on('jcarousel:createend', function () {
                //Позволяет запускать с нужного элемента
                $(this).jcarousel('scroll', carouselItemStart, false);
            })
            .jcarousel({
                wrap: carouselWrap,
            })
            .jcarouselAutoscroll({
	            interval: autoscrollInterval,
	            target: '+=1',
	            autostart: carouselAutostart
	        });

        $('.medialibslider-control-prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.medialibslider-control-next')
            .jcarouselControl({
                target: '+=1'
            });

    	$('.medialibslider-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .on('click', function(e) {
                e.preventDefault();
            })
            .jcarouselPagination({
                perPage: 1,
                item: function(page) {
                    return '<a href="#' + page + '">' + page + '</a>';
                }
            });

	});
})(jQuery);