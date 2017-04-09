OwlCarouselPhp = function (arParams)
{
	var page = 1;
	var owl;
	var owl_name = '#owl-carousel' + arParams["COUNTER"];
	var cur_page = page;
	
	arParams["MARGIN_OWL"] = parseInt(arParams["MARGIN_OWL"], 10); 
	arParams["STAGE_PADDING_OWL"] = parseInt(arParams["STAGE_PADDING_OWL"], 10);
	arParams["START_POSITION_OWL"] = parseInt(arParams["START_POSITION_OWL"], 10);
	arParams["SMART_SPEED_OWL"] = parseInt(arParams["SMART_SPEED_OWL"], 10);
	arParams["DRAG_END_SPEED_OWL"] = parseInt(arParams["DRAG_END_SPEED_OWL"], 10);
	arParams["VIDEO_HEIGHT_OWL"] = arParams["VIDEO_HEIGHT_OWL"] == "0" ? false : parseInt(arParams["VIDEO_HEIGHT_OWL"], 10);
	arParams["VIDEO_WIDTH_OWL"] = arParams["VIDEO_WIDTH_OWL"] == "0" ? false : parseInt(arParams["VIDEO_WIDTH_OWL"], 10);
	
	if(arParams["ANIMATE_OWL"] == false)
	{
		arParams["ANIMATE_OUT_OWL"] = false;
		arParams["ANIMATE_IN_OWL"] = false;
	}
	
	arParams["AUTO_PLAY_TIMEOUT_OWL"] = parseInt(arParams["AUTO_PLAY_TIMEOUT_OWL"]);
	arParams["AUTO_PLAY_SPEED_OWL"] = arParams["AUTO_PLAY_SPEED_OWL"] == false ? false : parseInt(arParams["AUTO_PLAY_SPEED_OWL"]);

	arParams["ITEM_0_ADAPTIVE_OWL"] = parseInt(arParams["ITEM_0_ADAPTIVE_OWL"]);
	arParams["ITEM_768_ADAPTIVE_OWL"] = parseInt(arParams["ITEM_768_ADAPTIVE_OWL"]);
	arParams["ITEM_992_ADAPTIVE_OWL"] = parseInt(arParams["ITEM_992_ADAPTIVE_OWL"]);
	arParams["ITEM_1200_ADAPTIVE_OWL"] = parseInt(arParams["ITEM_1200_ADAPTIVE_OWL"]);
	
	var adaptiv = {	
		0:{	items:arParams["ITEM_0_ADAPTIVE_OWL"],},
		768:{ items:arParams["ITEM_768_ADAPTIVE_OWL"],},
		992:{ items:arParams["ITEM_992_ADAPTIVE_OWL"],},
		1200:{ items:arParams["ITEM_1200_ADAPTIVE_OWL"],}
	};
	if(arParams["ADAPTIVE_OWL"] == false)
		adaptiv = {};
	
	$(document).ready(function () {
			
				$(owl_name).owlCarousel({
				items: parseInt(arParams["ITEMS_OWL"]),
				loop: arParams["LOOP_OWL"],
				center: arParams["CENTER_OWL"],
				
				mouseDrag: arParams["MOUSE_DRAG_OWL"],
				touchDrag: arParams["TOUCH_DRAG_OWL"],
				pullDrag: arParams["PULLDRAG_OWL"],
				freeDrag: false,

				margin: arParams["MARGIN_OWL"],
				stagePadding: arParams["STAGE_PADDING_OWL"],

				merge: false,
				mergeFit: true,
				autoWidth: arParams["AUTO_WIDTH_OWL"],

				startPosition: arParams["START_POSITION_OWL"],
				rtl: arParams["RTL_OWL"],

				smartSpeed: arParams["SMART_SPEED_OWL"],
				fluidSpeed: false,
				dragEndSpeed: arParams["DRAG_END_SPEED_OWL"],

				responsive: adaptiv,				
				responsiveRefreshRate: 200,
				responsiveBaseElement: window,
				responsiveClass: false,

				fallbackEasing: 'swing',

				info: false,

				nestedItemSelector: false,
				itemElement: 'div',
				stageElement: 'div',

				// Classes and Names
				themeClass: 'owl-theme',
				baseClass: 'owl-carousel',
				itemClass: 'owl-item',
				centerClass: 'center',
				activeClass: 'active',
				
				//
				lazyLoad: arParams["LAZY_LOAD_OWL"],
				
				//
				autoHeight: arParams["AUTO_HEIGHT_OWL"],
				autoHeightClass: 'owl-height',
				
				//
				video: arParams["VIDEO_OWL"],
				videoHeight: arParams["VIDEO_HEIGHT_OWL"],
				videoWidth: arParams["VIDEO_WIDTH_OWL"],
				
				//
				animateOut: arParams["ANIMATE_OUT_OWL"][0],
				animateIn: arParams["ANIMATE_IN_OWL"][0],
				
				//
				autoplay: arParams["AUTO_PLAY_OWL"],
				autoplayTimeout: arParams["AUTO_PLAY_TIMEOUT_OWL"],
				autoplayHoverPause: arParams["AUTO_PLAY_HOVER_PAUSE_OWL"],
				autoplaySpeed: arParams["AUTO_PLAY_SPEED_OWL"],
				
				//
				nav: arParams["NAV_OWL"],
				navRewind: true,
				navText: arParams["NAV_TEXT_OWL"],
				navSpeed: false,
				navElement: 'div',
				navContainer: false,
				navContainerClass: 'owl-nav',
				navClass: [ 'owl-prev', 'owl-next' ],
				slideBy: 1,
				dotClass: 'owl-dot',
				dotsClass: 'owl-dots',
				dots: arParams["DOTS_OWL"],
				dotsEach: arParams["DOTS_EACH_OWL"],
				dotData: false,
				dotsSpeed: false,
				dotsContainer: false,
				controlsClass: 'owl-controls',
				
				//
				URLhashListener: false,
			});	

			$.ajax({
				type: "POST",
				url: window.href,
				dataType: 'json',
				data: "altasib_owl_page=" + page + "&ALTASIB_OWL_COUNTER=" + arParams["COUNTER"],
				success: customDataSuccess,
				error: function(xhr, str){
					$(owl_name).html("There is no information to display!");
				}
			});
				
			if(arParams["LOAD_NEW_PICTURE"]){
				$(owl_name).on('changed.owl.carousel.pos', function(e) { pos() });
			}	
						
			if(arParams["MOUSE_SCROLL_OWL"]){
				$(owl_name).on('mousewheel', '.owl-stage', function (e) {
					if (e.deltaY>0) 
						owl.next();
					else 
						owl.prev();				
					e.preventDefault();
				});
			}
			
			$(owl_name).on('changed.owl.carousel.nophoto', function(e) { 
				setTimeout(vertical_align, 200);	
			});
			
			owl = $(owl_name).data('owlCarousel');	
			
			if(owl.options.autoplay)
			{
				var min = 0;
				var maxOut = arParams["ANIMATE_OUT_OWL"].length -1;
				var maxIn = arParams["ANIMATE_IN_OWL"].length -1;
							
				$(owl_name).on('changed.owl.carousel.generate', function(e) {
					var randOut = min + Math.floor(Math.random() * (maxOut + 1 - min));
					var randIn = min + Math.floor(Math.random() * (maxIn + 1 - min));
					
					owl.settings.animateOut = arParams["ANIMATE_OUT_OWL"][randOut];
					owl.settings.animateIn = arParams["ANIMATE_IN_OWL"][randIn];					
				});
			}
			
	});
	function vertical_align()
	{			
		var heightOwlNoPhoto = $(".alx-owl-noPhoto").height();
		var heightOwlImg = $(".alx-img").height();		
		heightOwlImg -= heightOwlNoPhoto;
		heightOwlImg /= 2;
		$(".alx-owl-noPhoto").css("padding-top",heightOwlImg+"px");
		$(".alx-owl-noPhoto").css("padding-bottom",heightOwlImg+"px");
	}
	function pos()
	{
		var elNotLoad = owl._items.length - owl.options.items - owl.current();
		if(owl.options.loop) elNotLoad = owl._items.length - owl.current();
		if (elNotLoad <= 1 && page == cur_page) {
			page++;
			$.ajax({
					type: "POST",
					url: window.href,
					dataType: 'json',
					data: "altasib_owl_page=" + page + "&ALTASIB_OWL_COUNTER=" + arParams["COUNTER"],
					success: customDataSuccess,
					error: function(xhr, str){page--;}
				});
		}
	}	
	function customDataSuccess(data) {		
		if(page >= data["NavPageCount"]){		
			$(owl_name).off('changed.owl.carousel.pos');	
		}		
		//
		for (var i in data["owl"]) {
			if(owl.options.loop == true && page != 1){				
				content = owl.prepare($(data["owl"][i]["item"]));
				owl._items[owl._items.length-1].after(content);				
				owl._items.push(content);
				owl._mergers.push(content.find('[data-merge]').andSelf('[data-merge]').attr('data-merge') * 1 || 1);
				owl.invalidate('items');
				owl.trigger('added', { content: content, position: owl._items.length});				
			}
			else{
				owl.add(owl.prepare($(data["owl"][i]["item"])));
			}			
		}
		owl.refresh();	
		if(page == 1){
			if(owl.options.loop)
				owl.current(owl._clones.length/2 + owl.options.startPosition);
			else
				owl.current(owl.options.startPosition);				
		}
		else{
			if(owl.options.loop == true){				
				owl._clones = owl.clones();
				for(var j = 0; j<owl._clones.length/2 ; j++){
					$($(owl_name + " .owl-item.cloned")[j]).html(owl._items[owl._items.length - owl._clones.length/2 + j].html());	
					$($(owl_name + ' .owl-item.cloned img')[j]).attr("src", $($(owl_name + ' .owl-item.cloned img')[j]).attr("data-src"));					
				}
			}
		}		
		//		
		owl.refresh();	
		
		if(owl.options.nav)
			$(owl_name+" .owl-controls .owl-nav div").css("display", "inline-block");
		
		cur_page = page;
	}			
}
	