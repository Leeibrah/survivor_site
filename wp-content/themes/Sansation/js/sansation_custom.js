/* ************************************************************************* */
					/* ANIMATED PRELOADER EFFECT */
/* ************************************************************************* */
(function($){
 $(document).ready(function () {
	$('.attachment-fadeIn').hide();//hide all the images on the page
	$('.attachment-post-thumbnail').hide();//hide all the thumbnails
	});

	/*var i = 0;//initialize
	var init=0;//Internet Explorer Fix
	$(window).bind("load", function() {//The load event will only fire if the entire page or document is fully loaded
		init = setInterval(functin(){doThis();},500);
	});

	function doThis() {
		var images = $('a[class^="attachment"]').length;//count the number of images on the page
		if (i >= images) {// Loop the images
			clearInterval(init);//When it reaches the last image the loop ends
			delete init;
		}
		$('a[class^="attachment"]').eq(i).fadeIn(500);//fades in the hidden images one by one
		i++;//add 1 to the count
	}*/
$(window).bind("load", function(){
	//$('a[class^="attachment"]').eq(0).fadeIn(500);
	var t = $('a[class^="attachment"]').length, i = 0;

	var init = setInterval(function(){
		$('a[class^="attachment"]').eq(i).fadeIn(500);
		i++;
		if(i == t){
			clearInterval(init);
			delete init;
		}
	},500);
})
$(window).bind("load", function(){
	//$('a[class^="attachment"]').eq(0).fadeIn(500);
	var t = $('img[class^="attachment"]').length, i = 0;

	var init = setInterval(function(){
		$('img[class^="attachment"]').eq(i).fadeIn(500);
		i++;
		if(i == t){
			clearInterval(init);
			delete init;
		}
	},500);
})
})(jQuery);










/* ************************************************************************* */
					/* AUTOMATIC TABLE ROW HIGHLIGHTING */
/* ************************************************************************* */
(function($){
$(document).ready(function() {

$('table tr:odd').addClass('odd');
$('table tr:even').addClass('even');

});
})(jQuery);







/* Image Rollover Fade Effect */
(function($){
$(document).ready(
	function(){
		$('.fade').hover(
			function(){
				$(this).children().first().children().first().stop(true);
				$(this).children().first().children().first().fadeTo('slow', .8);
			},
			function(){
				$(this).children().first().children().first().stop(true);
				$(this).children().first().children().first().fadeTo('slow', 0);
			}
		)
	}
)
})(jQuery);







/* ************************************************************************* */
						/* JQUERY SCROLL PACK */
/* ************************************************************************* */

(function($){
$(function(){$.fn.scrollToTop=function(options){if(options.speed){var speed=options.speed;}else{var speed="slow";}if(options.ease){var ease=options.ease;}else{var ease="jswing";}if(options.start){var start=options.start;}else{var start="0";}var scrollDiv=$(this);$(this).hide().removeAttr("href");if($(window).scrollTop()>start){$(this).fadeIn("slow");}$(window).scroll(function(){if($(window).scrollTop()>start){$(scrollDiv).fadeIn("slow");}else{$(scrollDiv).fadeOut("slow");}});$(this).click(function(event){$("html, body").animate({scrollTop:"0px"},speed,ease);});}});
})(jQuery);












/* ************************************************************************* */
							/* MAIN NAVIGATION */
/* ************************************************************************* */
/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */

;(function($){
	$.fn.superfish = function(op){

		var sf = $.fn.superfish,
			c = sf.c,
			$arrow = $(['<span class="',c.arrowClass,'"> &#187;</span>'].join('')),
			over = function(){
				var $$ = $(this), menu = getMenu($$);
				clearTimeout(menu.sfTimer);
				$$.showSuperfishUl().siblings().hideSuperfishUl();
			},
			out = function(){
				var $$ = $(this), menu = getMenu($$), o = sf.op;
				clearTimeout(menu.sfTimer);
				menu.sfTimer=setTimeout(function(){
					o.retainPath=($.inArray($$[0],o.$path)>-1);
					$$.hideSuperfishUl();
					if (o.$path.length && $$.parents(['li.',o.hoverClass].join('')).length<1){over.call(o.$path);}
				},o.delay);	
			},
			getMenu = function($menu){
				var menu = $menu.parents(['ul.',c.menuClass,':first'].join(''))[0];
				sf.op = sf.o[menu.serial];
				return menu;
			},
			addArrow = function($a){ $a.addClass(c.anchorClass).append($arrow.clone()); };
			
		return this.each(function() {
			var s = this.serial = sf.o.length;
			var o = $.extend({},sf.defaults,op);
			o.$path = $('li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){
				$(this).addClass([o.hoverClass,c.bcClass].join(' '))
					.filter('li:has(ul)').removeClass(o.pathClass);
			});
			sf.o[s] = sf.op = o;
			
			$('li:has(ul)',this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over,out).each(function() {
				if (o.autoArrows) addArrow( $('>a:first-child',this) );
			})
			.not('.'+c.bcClass)
				.hideSuperfishUl();
			
			var $a = $('a',this);
			$a.each(function(i){
				var $li = $a.eq(i).parents('li');
				$a.eq(i).focus(function(){over.call($li);}).blur(function(){out.call($li);});
			});
			o.onInit.call(this);
			
		}).each(function() {
			var menuClasses = [c.menuClass];
			if (sf.op.dropShadows  && !($.browser.msie && $.browser.version < 7)) menuClasses.push(c.shadowClass);
			$(this).addClass(menuClasses.join(' '));
		});
	};

	var sf = $.fn.superfish;
	sf.o = [];
	sf.op = {};
	sf.IE7fix = function(){
		var o = sf.op;
		if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity!=undefined)
			this.toggleClass(sf.c.shadowClass+'-off');
		};
	sf.c = {
		bcClass     : 'sf-breadcrumb',
		menuClass   : 'sf-js-enabled',
		anchorClass : 'sf-with-ul',
		arrowClass  : 'sf-sub-indicator',
		shadowClass : 'sf-shadow'
	};
	sf.defaults = {
		hoverClass	: 'sfHover',
		pathClass	: 'overideThisToUse',
		pathLevels	: 1,
		delay		: 800,
		animation	: {opacity:'show',height:'show'},  // fade-in and slide-down animation
		speed		: 'normal',
		autoArrows	: false,
		dropShadows : false,
		disableHI	: false,		// true disables hoverIntent detection
		onInit		: function(){}, // callback functions
		onBeforeShow: function(){},
		onShow		: function(){},
		onHide		: function(){}
	};
	$.fn.extend({
		hideSuperfishUl : function(){
			var o = sf.op,
				not = (o.retainPath===true) ? o.$path : '';
			o.retainPath = false;
			var $ul = $(['li.',o.hoverClass].join(''),this).add(this).not(not).removeClass(o.hoverClass)
					.find('>ul').hide().css('visibility','hidden');
			o.onHide.call($ul);
			return this;
		},
		showSuperfishUl : function(){
			var o = sf.op,
				sh = sf.c.shadowClass+'-off',
				$ul = this.addClass(o.hoverClass)
					.find('>ul:hidden').css('visibility','visible');
			sf.IE7fix.call($ul);
			o.onBeforeShow.call($ul);
			$ul.animate(o.animation,o.speed,function(){ sf.IE7fix.call($ul); o.onShow.call($ul); });
			return this;
		}
	});

})(jQuery);







/* ************************************************************************* */
						/* JQUERY HOVER INTENT PLUGIN */
/* ************************************************************************* */
(function($){
	/* hoverIntent by Brian Cherne */
	$.fn.hoverIntent = function(f,g) {
		// default configuration options
		var cfg = {
			sensitivity: 7,
			interval: 100,
			timeout: 0
		};
		// override configuration options with user supplied object
		cfg = $.extend(cfg, g ? { over: f, out: g } : f );

		// instantiate variables
		// cX, cY = current X and Y position of mouse, updated by mousemove event
		// pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
		var cX, cY, pX, pY;

		// A private function for getting mouse position
		var track = function(ev) {
			cX = ev.pageX;
			cY = ev.pageY;
		};

		// A private function for comparing current and previous mouse position
		var compare = function(ev,ob) {
			ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			// compare mouse positions to see if they've crossed the threshold
			if ( ( Math.abs(pX-cX) + Math.abs(pY-cY) ) < cfg.sensitivity ) {
				$(ob).unbind("mousemove",track);
				// set hoverIntent state to true (so mouseOut can be called)
				ob.hoverIntent_s = 1;
				return cfg.over.apply(ob,[ev]);
			} else {
				// set previous coordinates for next time
				pX = cX; pY = cY;
				// use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
				ob.hoverIntent_t = setTimeout( function(){compare(ev, ob);} , cfg.interval );
			}
		};

		// A private function for delaying the mouseOut function
		var delay = function(ev,ob) {
			ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			ob.hoverIntent_s = 0;
			return cfg.out.apply(ob,[ev]);
		};

		// A private function for handling mouse 'hovering'
		var handleHover = function(e) {
			// next three lines copied from jQuery.hover, ignore children onMouseOver/onMouseOut
			var p = (e.type == "mouseover" ? e.fromElement : e.toElement) || e.relatedTarget;
			while ( p && p != this ) { try { p = p.parentNode; } catch(e) { p = this; } }
			if ( p == this ) { return false; }

			// copy objects to be passed into t (required for event object to be passed in IE)
			var ev = jQuery.extend({},e);
			var ob = this;

			// cancel hoverIntent timer if it exists
			if (ob.hoverIntent_t) { ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t); }

			// else e.type == "onmouseover"
			if (e.type == "mouseover") {
				// set "previous" X and Y position based on initial entry point
				pX = ev.pageX; pY = ev.pageY;
				// update "current" X and Y position based on mousemove
				$(ob).bind("mousemove",track);
				// start polling interval (self-calling timeout) to compare mouse coordinates over time
				if (ob.hoverIntent_s != 1) { ob.hoverIntent_t = setTimeout( function(){compare(ev,ob);} , cfg.interval );}

			// else e.type == "onmouseout"
			} else {
				// unbind expensive mousemove event
				$(ob).unbind("mousemove",track);
				// if hoverIntent state is true, then call the mouseOut function after the specified delay
				if (ob.hoverIntent_s == 1) { ob.hoverIntent_t = setTimeout( function(){delay(ev,ob);} , cfg.timeout );}
			}
		};

		// bind the function to the two event listeners
		return this.mouseover(handleHover).mouseout(handleHover);
	};
	
})(jQuery);









/* ------------------------------------------------------------------------
 * 	Class: prettyPhoto
 * 	Use: Lightbox clone for jQuery
 * 	Author: Stephane Caron (http://www.no-margin-for-errors.com)
 * 	Version: 2.5.6
 ------------------------------------------------------------------------- */

(function($){$.prettyPhoto={version:'2.5.6'};$.fn.prettyPhoto=function(settings){settings=jQuery.extend({animationSpeed:'normal',opacity:0.80,showTitle:true,allowresize:true,default_width:500,default_height:344,counter_separator_label:'/',theme:'light_rounded',hideflash:false,wmode:'opaque',autoplay:true,modal:false,changepicturecallback:function(){},callback:function(){},markup:'<div class="pp_pic_holder"> \
      <div class="pp_top"> \
       <div class="pp_left"></div> \
       <div class="pp_middle"></div> \
       <div class="pp_right"></div> \
      </div> \
      <div class="pp_content_container"> \
       <div class="pp_left"> \
       <div class="pp_right"> \
        <div class="pp_content"> \
         <div class="pp_loaderIcon"></div> \
         <div class="pp_fade"> \
          <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
          <div class="pp_hoverContainer"> \
           <a class="pp_next" href="#">next</a> \
           <a class="pp_previous" href="#">previous</a> \
          </div> \
          <div id="pp_full_res"></div> \
          <div class="pp_details clearfix"> \
           <a class="pp_close" href="#">Close</a> \
           <p class="pp_description"></p> \
           <div class="pp_nav"> \
            <a href="#" class="pp_arrow_previous">Previous</a> \
            <p class="currentTextHolder">0/0</p> \
            <a href="#" class="pp_arrow_next">Next</a> \
           </div> \
          </div> \
         </div> \
        </div> \
       </div> \
       </div> \
      </div> \
      <div class="pp_bottom"> \
       <div class="pp_left"></div> \
       <div class="pp_middle"></div> \
       <div class="pp_right"></div> \
      </div> \
     </div> \
     <div class="pp_overlay"></div> \
     <div class="ppt"></div>',image_markup:'<img id="fullResImage" src="" />',flash_markup:'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',quicktime_markup:'<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',iframe_markup:'<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',inline_markup:'<div class="pp_inline clearfix">{content}</div>'},settings);if($.browser.msie&&parseInt($.browser.version)==6){settings.theme="light_square";}
if($('.pp_overlay').size()==0)_buildOverlay();var doresize=true,percentBased=false,correctSizes,$pp_pic_holder,$ppt,$pp_overlay,pp_contentHeight,pp_contentWidth,pp_containerHeight,pp_containerWidth,windowHeight=$(window).height(),windowWidth=$(window).width(),setPosition=0,scrollPos=_getScroll();$(window).scroll(function(){scrollPos=_getScroll();_centerOverlay();_resizeOverlay();});$(window).resize(function(){_centerOverlay();_resizeOverlay();});$(document).keydown(function(e){if($pp_pic_holder.is(':visible'))
switch(e.keyCode){case 37:$.prettyPhoto.changePage('previous');break;case 39:$.prettyPhoto.changePage('next');break;case 27:if(!settings.modal)
$.prettyPhoto.close();break;};});$(this).each(function(){$(this).bind('click',function(){_self=this;theRel=$(this).attr('rel');galleryRegExp=/\[(?:.*)\]/;theGallery=galleryRegExp.exec(theRel);var images=new Array(),titles=new Array(),descriptions=new Array();if(theGallery){$('a[rel*='+theGallery+']').each(function(i){if($(this)[0]===$(_self)[0])setPosition=i;images.push($(this).attr('href'));titles.push($(this).find('img').attr('alt'));descriptions.push($(this).attr('title'));});}else{images=$(this).attr('href');titles=($(this).find('img').attr('alt'))?$(this).find('img').attr('alt'):'';descriptions=($(this).attr('title'))?$(this).attr('title'):'';}
$.prettyPhoto.open(images,titles,descriptions);return false;});});$.prettyPhoto.open=function(gallery_images,gallery_titles,gallery_descriptions){if($.browser.msie&&$.browser.version==6){$('select').css('visibility','hidden');};if(settings.hideflash)$('object,embed').css('visibility','hidden');images=$.makeArray(gallery_images);titles=$.makeArray(gallery_titles);descriptions=$.makeArray(gallery_descriptions);image_set=($(images).size()>0)?true:false;_checkPosition($(images).size());$('.pp_loaderIcon').show();$pp_overlay.show().fadeTo(settings.animationSpeed,settings.opacity);$pp_pic_holder.find('.currentTextHolder').text((setPosition+1)+settings.counter_separator_label+$(images).size());if(descriptions[setPosition]){$pp_pic_holder.find('.pp_description').show().html(unescape(descriptions[setPosition]));}else{$pp_pic_holder.find('.pp_description').hide().text('');};if(titles[setPosition]&&settings.showTitle){hasTitle=true;$ppt.html(unescape(titles[setPosition]));}else{hasTitle=false;};movie_width=(parseFloat(grab_param('width',images[setPosition])))?grab_param('width',images[setPosition]):settings.default_width.toString();movie_height=(parseFloat(grab_param('height',images[setPosition])))?grab_param('height',images[setPosition]):settings.default_height.toString();if(movie_width.indexOf('%')!=-1||movie_height.indexOf('%')!=-1){movie_height=parseFloat(($(window).height()*parseFloat(movie_height)/100)-100);movie_width=parseFloat(($(window).width()*parseFloat(movie_width)/100)-100);percentBased=true;}
$pp_pic_holder.fadeIn(function(){imgPreloader="";switch(_getFileType(images[setPosition])){case'image':imgPreloader=new Image();nextImage=new Image();if(image_set&&setPosition>$(images).size())nextImage.src=images[setPosition+1];prevImage=new Image();if(image_set&&images[setPosition-1])prevImage.src=images[setPosition-1];$pp_pic_holder.find('#pp_full_res')[0].innerHTML=settings.image_markup;$pp_pic_holder.find('#fullResImage').attr('src',images[setPosition]);imgPreloader.onload=function(){correctSizes=_fitToViewport(imgPreloader.width,imgPreloader.height);_showContent();};imgPreloader.onerror=function(){alert('Image cannot be loaded. Make sure the path is correct and image exist.');$.prettyPhoto.close();};imgPreloader.src=images[setPosition];break;case'youtube':correctSizes=_fitToViewport(movie_width,movie_height);movie='http://www.youtube.com/v/'+grab_param('v',images[setPosition]);if(settings.autoplay)movie+="&autoplay=1";toInject=settings.flash_markup.replace(/{width}/g,correctSizes['width']).replace(/{height}/g,correctSizes['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,movie);break;case'vimeo':correctSizes=_fitToViewport(movie_width,movie_height);movie_id=images[setPosition];movie='http://vimeo.com/moogaloop.swf?clip_id='+movie_id.replace('http://vimeo.com/','');if(settings.autoplay)movie+="&autoplay=1";toInject=settings.flash_markup.replace(/{width}/g,correctSizes['width']).replace(/{height}/g,correctSizes['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,movie);break;case'quicktime':correctSizes=_fitToViewport(movie_width,movie_height);correctSizes['height']+=15;correctSizes['contentHeight']+=15;correctSizes['containerHeight']+=15;toInject=settings.quicktime_markup.replace(/{width}/g,correctSizes['width']).replace(/{height}/g,correctSizes['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,images[setPosition]).replace(/{autoplay}/g,settings.autoplay);break;case'flash':correctSizes=_fitToViewport(movie_width,movie_height);flash_vars=images[setPosition];flash_vars=flash_vars.substring(images[setPosition].indexOf('flashvars')+10,images[setPosition].length);filename=images[setPosition];filename=filename.substring(0,filename.indexOf('?'));toInject=settings.flash_markup.replace(/{width}/g,correctSizes['width']).replace(/{height}/g,correctSizes['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,filename+'?'+flash_vars);break;case'iframe':correctSizes=_fitToViewport(movie_width,movie_height);frame_url=images[setPosition];frame_url=frame_url.substr(0,frame_url.indexOf('iframe')-1);toInject=settings.iframe_markup.replace(/{width}/g,correctSizes['width']).replace(/{height}/g,correctSizes['height']).replace(/{path}/g,frame_url);break;case'inline':myClone=$(images[setPosition]).clone().css({'width':settings.default_width}).wrapInner('<div id="pp_full_res"><div class="pp_inline clearfix"></div></div>').appendTo($('body'));correctSizes=_fitToViewport($(myClone).width(),$(myClone).height());$(myClone).remove();toInject=settings.inline_markup.replace(/{content}/g,$(images[setPosition]).html());break;};if(!imgPreloader){$pp_pic_holder.find('#pp_full_res')[0].innerHTML=toInject;_showContent();};});};$.prettyPhoto.changePage=function(direction){if(direction=='previous'){setPosition--;if(setPosition<0){setPosition=0;return;};}else{if($('.pp_arrow_next').is('.disabled'))return;setPosition++;};if(!doresize)doresize=true;_hideContent(function(){$.prettyPhoto.open(images,titles,descriptions)});$('a.pp_expand,a.pp_contract').fadeOut(settings.animationSpeed);};$.prettyPhoto.close=function(){$pp_pic_holder.find('object,embed').css('visibility','hidden');$('div.pp_pic_holder,div.ppt,.pp_fade').fadeOut(settings.animationSpeed);$pp_overlay.fadeOut(settings.animationSpeed,function(){$('#pp_full_res').html('');$pp_pic_holder.attr('style','').find('div:not(.pp_hoverContainer)').attr('style','');_centerOverlay();if($.browser.msie&&$.browser.version==6){$('select').css('visibility','visible');};if(settings.hideflash)$('object,embed').css('visibility','visible');setPosition=0;settings.callback();});doresize=true;};_showContent=function(){$('.pp_loaderIcon').hide();projectedTop=scrollPos['scrollTop']+((windowHeight/2)-(correctSizes['containerHeight']/2));if(projectedTop<0)projectedTop=0+$ppt.height();$pp_pic_holder.find('.pp_content').animate({'height':correctSizes['contentHeight']},settings.animationSpeed);$pp_pic_holder.animate({'top':projectedTop,'left':(windowWidth/2)-(correctSizes['containerWidth']/2),'width':correctSizes['containerWidth']},settings.animationSpeed,function(){$pp_pic_holder.find('.pp_hoverContainer,#fullResImage').height(correctSizes['height']).width(correctSizes['width']);$pp_pic_holder.find('.pp_fade').fadeIn(settings.animationSpeed);if(image_set&&_getFileType(images[setPosition])=="image"){$pp_pic_holder.find('.pp_hoverContainer').show();}else{$pp_pic_holder.find('.pp_hoverContainer').hide();}
if(settings.showTitle&&hasTitle){$ppt.css({'top':$pp_pic_holder.offset().top-25,'left':$pp_pic_holder.offset().left+20,'display':'none'});$ppt.fadeIn(settings.animationSpeed);};if(correctSizes['resized'])$('a.pp_expand,a.pp_contract').fadeIn(settings.animationSpeed);settings.changepicturecallback();});};function _hideContent(callback){$pp_pic_holder.find('#pp_full_res object,#pp_full_res embed').css('visibility','hidden');$pp_pic_holder.find('.pp_fade').fadeOut(settings.animationSpeed,function(){$('.pp_loaderIcon').show();if(callback)callback();});$ppt.fadeOut(settings.animationSpeed);}
function _checkPosition(setCount){if(setPosition==setCount-1){$pp_pic_holder.find('a.pp_next').css('visibility','hidden');$pp_pic_holder.find('a.pp_arrow_next').addClass('disabled').unbind('click');}else{$pp_pic_holder.find('a.pp_next').css('visibility','visible');$pp_pic_holder.find('a.pp_arrow_next.disabled').removeClass('disabled').bind('click',function(){$.prettyPhoto.changePage('next');return false;});};if(setPosition==0){$pp_pic_holder.find('a.pp_previous').css('visibility','hidden');$pp_pic_holder.find('a.pp_arrow_previous').addClass('disabled').unbind('click');}else{$pp_pic_holder.find('a.pp_previous').css('visibility','visible');$pp_pic_holder.find('a.pp_arrow_previous.disabled').removeClass('disabled').bind('click',function(){$.prettyPhoto.changePage('previous');return false;});};if(setCount>1){$('.pp_nav').show();}else{$('.pp_nav').hide();}};function _fitToViewport(width,height){hasBeenResized=false;_getDimensions(width,height);imageWidth=width;imageHeight=height;if(((pp_containerWidth>windowWidth)||(pp_containerHeight>windowHeight))&&doresize&&settings.allowresize&&!percentBased){hasBeenResized=true;notFitting=true;while(notFitting){if((pp_containerWidth>windowWidth)){imageWidth=(windowWidth-200);imageHeight=(height/width)*imageWidth;}else if((pp_containerHeight>windowHeight)){imageHeight=(windowHeight-200);imageWidth=(width/height)*imageHeight;}else{notFitting=false;};pp_containerHeight=imageHeight;pp_containerWidth=imageWidth;};_getDimensions(imageWidth,imageHeight);};return{width:Math.floor(imageWidth),height:Math.floor(imageHeight),containerHeight:Math.floor(pp_containerHeight),containerWidth:Math.floor(pp_containerWidth)+40,contentHeight:Math.floor(pp_contentHeight),contentWidth:Math.floor(pp_contentWidth),resized:hasBeenResized};};function _getDimensions(width,height){width=parseFloat(width);height=parseFloat(height);$pp_details=$pp_pic_holder.find('.pp_details');$pp_details.width(width);detailsHeight=parseFloat($pp_details.css('marginTop'))+parseFloat($pp_details.css('marginBottom'));$pp_details=$pp_details.clone().appendTo($('body')).css({'position':'absolute','top':-10000});detailsHeight+=$pp_details.height();detailsHeight=(detailsHeight<=34)?36:detailsHeight;if($.browser.msie&&$.browser.version==7)detailsHeight+=8;$pp_details.remove();pp_contentHeight=height+detailsHeight;pp_contentWidth=width;pp_containerHeight=pp_contentHeight+$ppt.height()+$pp_pic_holder.find('.pp_top').height()+$pp_pic_holder.find('.pp_bottom').height();pp_containerWidth=width;}
function _getFileType(itemSrc){if(itemSrc.match(/youtube\.com\/watch/i)){return'youtube';}else if(itemSrc.match(/vimeo\.com/i)){return'vimeo';}else if(itemSrc.indexOf('.mov')!=-1){return'quicktime';}else if(itemSrc.indexOf('.swf')!=-1){return'flash';}else if(itemSrc.indexOf('iframe')!=-1){return'iframe'}else if(itemSrc.substr(0,1)=='#'){return'inline';}else{return'image';};};function _centerOverlay(){if(doresize){titleHeight=$ppt.height();contentHeight=$pp_pic_holder.height();contentwidth=$pp_pic_holder.width();projectedTop=(windowHeight/2)+scrollPos['scrollTop']-((contentHeight+titleHeight)/2);$pp_pic_holder.css({'top':projectedTop,'left':(windowWidth/2)+scrollPos['scrollLeft']-(contentwidth/2)});$ppt.css({'top':projectedTop-titleHeight,'left':(windowWidth/2)+scrollPos['scrollLeft']-(contentwidth/2)+20});};};function _getScroll(){if(self.pageYOffset){return{scrollTop:self.pageYOffset,scrollLeft:self.pageXOffset};}else if(document.documentElement&&document.documentElement.scrollTop){return{scrollTop:document.documentElement.scrollTop,scrollLeft:document.documentElement.scrollLeft};}else if(document.body){return{scrollTop:document.body.scrollTop,scrollLeft:document.body.scrollLeft};};};function _resizeOverlay(){windowHeight=$(window).height();windowWidth=$(window).width();$pp_overlay.css({'height':$(document).height()});};function _buildOverlay(){$('body').append(settings.markup);$pp_pic_holder=$('.pp_pic_holder');$ppt=$('.ppt');$pp_overlay=$('div.pp_overlay');$pp_pic_holder.attr('class','pp_pic_holder '+settings.theme);$pp_overlay.css({'opacity':0,'height':$(document).height()}).bind('click',function(){if(!settings.modal)
$.prettyPhoto.close();});$('a.pp_close').bind('click',function(){$.prettyPhoto.close();return false;});$('a.pp_expand').bind('click',function(){$this=$(this);if($this.hasClass('pp_expand')){$this.removeClass('pp_expand').addClass('pp_contract');doresize=false;}else{$this.removeClass('pp_contract').addClass('pp_expand');doresize=true;};_hideContent(function(){$.prettyPhoto.open(images,titles,descriptions)});$pp_pic_holder.find('.pp_fade').fadeOut(settings.animationSpeed);return false;});$pp_pic_holder.find('.pp_previous, .pp_arrow_previous').bind('click',function(){$.prettyPhoto.changePage('previous');return false;});$pp_pic_holder.find('.pp_next, .pp_arrow_next').bind('click',function(){$.prettyPhoto.changePage('next');return false;});};_centerOverlay();};function grab_param(name,url){name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(url);if(results==null)
return"";else
return results[1];}})(jQuery);













/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */
