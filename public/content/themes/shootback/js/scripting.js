'use strict';
// Get all localized variables

var main_color = Shootback.main_color;
var images_loaded_active = Shootback.ts_enable_imagesloaded;
var ts_logo_content = Shootback.ts_logo_content;
var ts_onepage_layout = Shootback.ts_onepage_layout;

if (typeof ts_logo_content !== 'undefined') {
    addLogoToMenu(ts_logo_content);
}

jQuery(document).on('click', '.ts-get-calendar', function(){
    var tsYear  = jQuery(this).attr('data-year');
    var tsMonth = jQuery(this).attr('data-month');
    var classSize = 'ts-big-calendar';

    if(jQuery(this).parent().find('.ts-events-calendar').hasClass('ts-small-calendar')){
        classSize = 'ts-small-calendar';
    }

    var tsCalendar = jQuery(this).parent();
    var data = {};

    data = {
        action  : 'ts_draw_calendar',
        nonce   : Shootback.ts_security,
        tsYear  : tsYear,
        tsMonth : tsMonth,
        size    : classSize
    };

    jQuery.post(Shootback.ajaxurl, data, function(response) {

        if( response ) {
            jQuery(tsCalendar).html(response);
        }
    });
    return false;
});

function ts_set_like(){
    jQuery('.touchsize-likes').on('click',function() {
        var link, id, postfix;

        link = jQuery(this);
        if(link.hasClass('active')) return false;

        id = jQuery(this).attr('data-id'),
        postfix = link.find('.touchsize-likes-postfix').text();

        jQuery.post(Shootback.ajaxurl, { action:'touchsize-likes', likes_id:id, postfix:postfix }, function(data){
            console.log(link);
            link.addClass('active');
            link.html(data).attr('title','You already like this');
        });

        return false;
    });
}

function setScrollContainerWidth(){

    jQuery('.scroll-container').each(function(){
        // Set this element
        var element = jQuery(this);

        // Get the width of the parent.
        var elementParent = jQuery(element).parent().parent().parent().parent();
        var parentWidth = jQuery(elementParent).width();

        // Check if grid or thumb view
        if ( jQuery(elementParent).hasClass('ts-grid-view') && jQuery(window).width() > 1024 || jQuery(elementParent).hasClass('ts-thumbnail-view') && jQuery(window).width() > 1024 ) {

            // Set the width of the scroller.
            if ( jQuery(elementParent).hasClass('no-gutter') ) {
                jQuery(element).css('width', parentWidth);
            } else{
                jQuery(element).css('width', parentWidth + 39);
            }
        } else {
            jQuery(element).css('width', 1200);
        }
        // Check if mosaic view
        if ( jQuery(elementParent).find('.mosaic-view').length > 0 && jQuery(window).width() < 1024 ) {
            jQuery(element).css('width', 800);
        }
    });
}

/* Testimonials */
jQuery(function(){
    jQuery('ul.testimonials-controls li').click(function(){
        var testimonial_id = jQuery(this).attr('id');
            jQuery(this).parent().prev().find('li').hide();
            jQuery(this).parent().find('li.active').removeClass('active');
            jQuery(this).parent().prev().find('#' + testimonial_id).show();
            jQuery(this).addClass('active');
    });
});


/* Article carousel */

function initCarousel() {
    jQuery('.carousel-wrapper').each(function () {
        var thisElem = jQuery(this);
        var numberOfElems = parseInt(jQuery('.carousel-container', thisElem).children().length, 10);
        var oneElemWidth;
        var numberOfColumns = [
            ['col-lg-2', 6],
            ['col-lg-3', 4],
            ['col-lg-4', 3],
            ['col-lg-6', 2],
            ['col-lg-12', 1]
        ];
        var curentNumberOfColumns;
        var moveMargin;
        var leftHiddenElems = 0;
        var rightHiddenElems;
        var curentMargin = 0;
        var numberOfElemsDisplayed;
        var index = 0;
        var carouselContainerWidth;
        var carouselContainerWidthPercentage;
        var elemWidth;
        var elemWidthPercentage;

        while (index < numberOfColumns.length) {
            if (jQuery('.carousel-container>div', thisElem).hasClass(numberOfColumns[index][0])) {
                curentNumberOfColumns = numberOfColumns[index][1];
                break;
            }
            index++;
        }

        elemWidth = 100 / numberOfElems;
        elemWidth = elemWidth.toFixed(4);
        elemWidthPercentage = elemWidth + '%';

        function showHideArrows(){
            if(curentNumberOfColumns >= numberOfElems){

                jQuery('ul.carousel-nav > li.carousel-nav-left', thisElem).css('opacity','0.4');
                jQuery('ul.carousel-nav > li.carousel-nav-right', thisElem).css('opacity','0.4');

            } else if(leftHiddenElems === 0){

                jQuery('ul.carousel-nav > li.carousel-nav-left', thisElem).css('opacity','0.4');
                jQuery('ul.carousel-nav > li.carousel-nav-right', thisElem).css('opacity','1');

            } else if (rightHiddenElems === 0 ){

                jQuery('ul.carousel-nav > li.carousel-nav-left', thisElem).css('opacity','1');
                jQuery('ul.carousel-nav > li.carousel-nav-right', thisElem).css('opacity','0.4');

            } else {
                jQuery('ul.carousel-nav > li.carousel-nav-left', thisElem).css('opacity','1');
                jQuery('ul.carousel-nav > li.carousel-nav-right', thisElem).css('opacity','1');
            }
        }

        function reinitCarousel() {

            showHideArrows();
            jQuery('.carousel-container', thisElem).css('margin-left', 0);
            leftHiddenElems = 0;
            jQuery('ul.carousel-nav > li', thisElem).unbind('click');

            if (jQuery(window).width() <= 973) {

                carouselContainerWidth = 100 * numberOfElems;
                carouselContainerWidthPercentage = carouselContainerWidth + '%';
                rightHiddenElems = numberOfElems - 1;
                moveMargin = 100;
                curentMargin = 0;

                jQuery('ul.carousel-nav > li', thisElem).unbind('click');

                jQuery('ul.carousel-nav > li', thisElem).click(function () {

                    thisElem.find('img.lazy').lazyload();

                    if (jQuery(this).hasClass('carousel-nav-left')) {
                        if (leftHiddenElems > 0) {
                            curentMargin = curentMargin + moveMargin;
                            jQuery('.carousel-container', thisElem).css('margin-left', curentMargin + '%');
                            rightHiddenElems++;
                            leftHiddenElems--;
                        }
                    } else {
                        if (rightHiddenElems > 0) {
                            curentMargin = curentMargin - moveMargin;
                            jQuery('.carousel-container', thisElem).css('margin-left', curentMargin + '%');
                            rightHiddenElems--;
                            leftHiddenElems++;
                        }
                    }
                    // Trigger arrows color change
                    showHideArrows();

                    echo.render();
                });

            } else {

                while (index < numberOfColumns.length) {
                    if (jQuery('.carousel-container>div', thisElem).hasClass(numberOfColumns[index][0])) {
                        numberOfElemsDisplayed = numberOfColumns[index][1];
                        moveMargin = 100 / numberOfElemsDisplayed;
                        rightHiddenElems = numberOfElems - numberOfElemsDisplayed;
                        oneElemWidth = 100 / numberOfColumns[index][1];
                        break;
                    }
                    index++;
                }

                carouselContainerWidth = oneElemWidth * numberOfElems;
                carouselContainerWidthPercentage = carouselContainerWidth + '%';

                curentMargin = 0;

                jQuery('ul.carousel-nav > li', thisElem).click(function () {

                    thisElem.find('img.lazy').lazyload();
                    
                    if (jQuery(this).hasClass('carousel-nav-left')) {
                        if (leftHiddenElems > 0) {
                            curentMargin = curentMargin + moveMargin + 0.00001;
                            jQuery('.carousel-container', thisElem).css('margin-left', curentMargin + '%');
                            rightHiddenElems++;
                            leftHiddenElems--;
                        }
                    } else {
                        if (rightHiddenElems > 0) {
                            curentMargin = curentMargin - moveMargin;
                            jQuery('.carousel-container', thisElem).css('margin-left', curentMargin + '%');
                            rightHiddenElems--;
                            leftHiddenElems++;
                        }
                    }
                    // Trigger arrows color change
                    showHideArrows();
                });
            }

            //Set the container total width
            jQuery('.carousel-container', thisElem).width(carouselContainerWidthPercentage).css({
                'max-height': '9999px',
                'opacity': '1'
            });

            //Set width for each element
            jQuery('.carousel-container>div', thisElem).each(function () {
                jQuery(this).attr('style', 'width: ' + elemWidthPercentage + ' !important; float:left;');
            });
        }

        reinitCarousel();

        jQuery(window).resize(function () {
            reinitCarousel();
        });
    });
}


jQuery(function() {

    var Page = (function() {

        var $navArrows = jQuery( '#nav-arrows' ).hide(),
            $shadow = jQuery( '#shadow' ).hide(),
            slicebox = jQuery( '.sb-slider' ).slicebox( {
                onReady : function() {

                    $navArrows.show();
                    $shadow.show();

                },
                orientation : 'r',
                cuboidsRandom : false,
                disperseFactor : 50
            } ),

            init = function() {

                initEvents();

            },
            initEvents = function() {

                // add navigation events
                $navArrows.children( ':first' ).on( 'click', function() {

                    slicebox.next();
                    return false;

                } );

                $navArrows.children( ':last' ).on( 'click', function() {

                    slicebox.previous();
                    return false;

                } );

            };

            return { init : init };

    })();

    Page.init();

});

function visibleBeforeAnimation(){
    jQuery('.ts-grid-view.animated, .ts-thumbnail-view.animated, .ts-big-posts.animated, .ts-list-view.animated, .ts-super-posts.animated').each(function(){
        jQuery(this).find('article').each(function(index){
            var thisElem = jQuery(this);
            if( !thisElem.hasClass('shown') && thisElem.isOnScreen() === true ){
                thisElem.addClass('shown');
                thisElem.stop().delay(100*index).animate({opacity: 1},1000);
            }
        });
    });
    jQuery('.content-block.animated').each(function(index){
        var thisElem = jQuery(this);
        var pixelsFromTransform = 0;
        if( thisElem.hasClass('slideup') ){
            pixelsFromTransform = 250;
        }
        if( thisElem.isOnScreen() === true ){
            thisElem.addClass('shown');
            thisElem.animate({opacity: 1},800);
        }
    });

    jQuery('.ts-counters').each(function(index){
        var thisElem = jQuery(this);
        if ( thisElem.isOnScreen() ) {
            startCounters();
        };
    });

    jQuery('.ts-horizontal-skills > li').each(function(index){
        var thisElem = jQuery(this);
        if ( thisElem.isOnScreen() ) {
            jQuery('.ts-horizontal-skills').countTo();
        };
    });

    jQuery('.ts-vertical-skills > li').each(function(index){
        var thisElem = jQuery(this);
        if ( thisElem.isOnScreen() ) {
            jQuery('.ts-vertical-skills').countTo();
        };
    });

}

function animateArticlesOnLoad(){
    var thisElem;
    // If adds fade effect to articles in grid view
    jQuery(window).on('scroll',function(){
        jQuery('.ts-grid-view.animated, .ts-thumbnail-view.animated, .ts-big-posts.animated, .ts-list-view.animated, .ts-super-posts.animated').each(function(){
            jQuery(this).find('article').each(function(index){
                thisElem = jQuery(this);
                if( !thisElem.hasClass('shown') && thisElem.isOnScreen() === true ){
                    thisElem.addClass("shown");
                    thisElem.stop().delay(100*index).animate({opacity: 1},1200);
                }
            });
        });
    });
}

jQuery.fn.isOnScreen = function(){

    var win = jQuery(window);

    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();

    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();

    return (!(viewport.bottom < bounds.top || viewport.top > bounds.bottom));

};

function animateBlocksOnScroll(){
    var thisElem;
    jQuery(window).on('scroll',function(){
        jQuery('.content-block.animated').each(function(index){
            var thisElem = jQuery(this);
            var pixelsFromTransform = 0;
            if( thisElem.hasClass('slideup') ){
                pixelsFromTransform = 150;
            }
            if( !thisElem.hasClass('shown') && thisElem.isOnScreen() === true ){
                thisElem.addClass('shown');
                thisElem.stop().delay(100*index).animate({opacity: 1},1000);
            }
        });

        jQuery('.ts-counters').each(function(index){
            var thisElem = jQuery(this);
            if( !thisElem.hasClass('shown') && thisElem.isOnScreen() === true ){
                thisElem.addClass('shown');
                startCounters();
            }
        });

        jQuery('.ts-horizontal-skills > li').each(function(index){
            var thisElem = jQuery(this);
            if( !thisElem.hasClass('animated') && thisElem.isOnScreen() === true ){
                thisElem.addClass('shown');
                jQuery('.ts-horizontal-skills').countTo();
            }
        });

        jQuery('.ts-vertical-skills > li').each(function(index){
            var thisElem = jQuery(this);
            if( !thisElem.hasClass('animated') && thisElem.isOnScreen() === true ){
                thisElem.addClass('shown');
                jQuery('.ts-vertical-skills').countTo();
            }
        });

    });

}

function activateStickyMenu(){
    var menu = jQuery('#header .ts-header-menu').not('.ts-sidebar-menu').last(),
        // sticky_height = 0,
        offset = 0;

    // there are no menu on the page
    if ( menu.length < 1 ) {
        offset = 200;
        // sticky_height = 80;
        menu = jQuery('#header');
    }
    // else
    //     sticky_height = jQuery('.ts-sticky-menu ul').height();

    if( jQuery(window).scrollTop() > offset && !jQuery('.ts-sticky-menu').hasClass('active') ){
        // jQuery('.ts-sticky-menu').outerHeight(sticky_height);
        jQuery('.ts-sticky-menu').addClass('active');
    }

    jQuery(window).on('scroll',function(){

        // check if the offset of the menu has changed
        if(menu.length > 0 && offset !== menu.offset().top )
            offset = menu.offset().top;

        if( jQuery(window).scrollTop() > offset && !jQuery('.ts-sticky-menu').hasClass('active') ){
            // jQuery('.ts-sticky-menu').outerHeight(sticky_height);
            jQuery('.ts-sticky-menu').addClass('active');
        }

        if( jQuery(window).scrollTop() <= offset && jQuery('.ts-sticky-menu').hasClass('active') ) {
            jQuery('.ts-sticky-menu').removeClass('active');
            // jQuery('.ts-sticky-menu').outerHeight(0);
        }
    });
}

function startOnePageNav(){
    jQuery('.main-menu a').click(function(e){
        e.preventDefault();
        var navItemUrl = jQuery(this).attr('href');
        jQuery(document).scrollTo(navItemUrl,500);
    });
}

function filterButtonsRegister(){
    // Adds active class to "all" button
    jQuery('.ts-filters > li:first').addClass('active');

    // Code to change the .active class on click
    jQuery('.ts-filters > li a').click(function(e){
        e.preventDefault();

        var thisElem = jQuery(this);
        jQuery('.ts-filters > li.active').removeClass('active');
        thisElem.parent().addClass('active');
        return false;
    });
}

function resizeVideo(iframe_width, iframe_height){

    if(jQuery('.embedded_videos').length){
        jQuery('.embedded_videos iframe').each(function(){
            var iframe_width = jQuery(this).width();
            var iframe_height = jQuery(this).height();

            var iframe_proportion = iframe_width/iframe_height;

            if ( iframe_height > iframe_width){
                iframe_proportion = jQuery(this).attr('width')/jQuery(this).attr('height');
            }

            var iframe_parent_width = jQuery(this).parents('.embedded_videos').parent().width();
            jQuery(this).attr('width',iframe_parent_width);
            jQuery(this).attr('height',iframe_parent_width/iframe_proportion);
        });

        jQuery('.embedded_videos .wp-video').each(function(){
            var iframe = jQuery(this);
            var iframe_width = jQuery(this).width();
            var iframe_height = jQuery(this).height();
            var iframe_proportion = iframe_width/iframe_height;

            var iframe_parent_width = jQuery(this).parents('.embedded_videos').parent().width();

            jQuery(iframe).css('width',iframe_parent_width);
            jQuery(iframe).css('height',iframe_parent_width/iframe_proportion);
            jQuery(iframe).find('.wp-video-shortcode').css('width',iframe_parent_width);
            jQuery(iframe).find('.wp-video-shortcode').css('height',iframe_parent_width/iframe_proportion);

            setTimeout(function(){
                jQuery(window).trigger('resize');
            },400);

        });
    }
}

function twitterWidgetAnimated(){
    /*Tweets widget*/
    var delay = 4000; //millisecond delay between cycles

    function cycleThru(variable, j){
        var jmax = jQuery(variable + " li").length;
        jQuery(variable + " li:eq(" + j + ")")
            .css('display', 'block')
            .animate({opacity: 1}, 600)
            .animate({opacity: 1}, delay)
            .animate({opacity: 0}, 800, function(){
                if(j+1 === jmax){
                    j=0;
                }else{
                    j++;
                }
                jQuery(this).css('display', 'none').animate({opacity: 0}, 10);
                cycleThru(variable, j);
            });
    }

    jQuery('.tweets').each(function(index, val) {
        //iterate through array or object
        var parent_tweets = jQuery(val).attr('id');
        var actioner = '#' + parent_tweets + ' .ts-twitter-container.dynamic .slides_container .widget-items';
        cycleThru(actioner, 0);
    });
}

function ts_filters(){
    // cache container
    var $container = jQuery('.ts-filters-container');

    // initialize isotope

    $container.isotope({
        itemSelector : '.item'
    });

    jQuery(window).on('resize', function(){
        setTimeout(function(){
            $container.isotope('layout');
        }, 400);
    });

    jQuery(".ts-filters a").click(function(){
        var selector = jQuery(this).attr("data-filter");
        $container.isotope({ filter: selector });
        return false;
    });
}

function activateFancyBox(){
    if( jQuery("a[rel^='fancybox']").length > 0 ){
        jQuery("a[rel^='fancybox']").fancybox({
            prevEffect  : 'none',
            nextEffect  : 'none',
            padding: 0,
            helpers : {
                title   : {
                    type: 'outside'
                },
                thumbs  : {
                    width   : 50,
                    height  : 50
                }
            }
        });
    }
}

//Add logo to the center of all menu item list
function addLogoToMenu(logoContent){
    var menu_item_number = jQuery(".menu-with-logo > .main-menu > li").length;
    var middle = Math.round(menu_item_number / 2);
    jQuery(".menu-with-logo > .main-menu > li:nth-child(" + middle + ")").after(jQuery('<li class="menu-logo">'+logoContent+'</li>'));
    if (typeof logoContent !== 'undefined') {
        jQuery(".ts-sticky-menu .main-menu > li:nth-child(" + middle + ")").after(jQuery('<li class="menu-logo">'+logoContent+'</li>'));
    }
    if (jQuery("#nav").hasClass('menu-with-logo')){
        jQuery('#ts-mobile-menu').before('<div class="brand-logo">'+logoContent+'</div>');
    }
}

jQuery(document).on('click', '#ts-mobile-menu .trigger', function(event){
    event.preventDefault();
    jQuery(this).parent().next().slideToggle();
});

jQuery(document).on('click', '#ts-mobile-menu .menu-item-has-children > a', function(event){
    event.preventDefault();
    if (jQuery(this).next().attr('class').split(' ')[0] === 'ts_is_mega_div') {
        jQuery(this).next().children().slideToggle();
    }else{
        jQuery(this).next().slideToggle();
    }
});

jQuery(document).on('click', '.ts-vertical-menu .menu-item-has-children > a', function(event){
    event.preventDefault();
    jQuery(this).parent().toggleClass('collapsed');
    jQuery(this).next().slideToggle();
});

function ExpireCookie(minutes, content) {
    var date = new Date();
    var m = minutes;
    date.setTime(date.getTime() + (m * 60 * 1000));
    jQuery.cookie(content, m, { expires: date, path:'/' });
}

/* Time calculating in seconds! [example: fb_like_modal(30)] P.S. After 30 seconds, the function will be run */
function fb_likeus_modal(ShowTime){
    var modalContainer = jQuery('#fbpageModal');
    var timeExe = ShowTime*1000;
    var closeBtn = modalContainer.find('button[data-dismiss="modal"]');
    var cookie = jQuery.cookie('ts_fb_modal_cookie'),
        setTime = 360;

    if( cookie != setTime ){
        modalContainer.delay(timeExe).queue(function() {
            jQuery(this).hide();
            jQuery(this).modal('show'); //calling modal() function
            jQuery(this).dequeue();
        });
    }else{
        modalContainer.modal('hide');
    }
    //If you clicked on the close button, the function sends a cookie for 30 minutes which helps to not display modal at every recharge page
    closeBtn.on('click', function(){
        ExpireCookie(setTime, 'ts_fb_modal_cookie');
    });
}

/* This function aligns the vertical center elements */
function alignElementVerticalyCenter(){
    var container = jQuery('.site-section');

    jQuery(container).each(function(){
        if( jQuery(this).hasClass('ts-fullscreen-row') ){
            var windowHeight = jQuery(window).height();
            var containerHeight = windowHeight;
        }else{
            var windowHeight = '100%';
            var containerHeight = jQuery(this).outerHeight();
        }

        var innerContent = jQuery(this).find('.container').height();
        var insertPadding = Math.round((containerHeight-innerContent)/2);
        var Bottom = 0;

        if( jQuery(this).attr('data-alignment') == 'middle' && jQuery(this).hasClass('ts-fullscreen-row') ){
            jQuery(this).css({'padding-top':insertPadding,'padding-bottom':insertPadding,'min-height':windowHeight});
        }else if( jQuery(this).attr('data-alignment') == 'top' && jQuery(this).hasClass('ts-fullscreen-row') ){
            jQuery(this).css('min-height',windowHeight);
        }else if( jQuery(this).attr('data-alignment') == 'bottom' && jQuery(this).hasClass('ts-fullscreen-row') ){
            Bottom = jQuery(this).css('padding-bottom');
            jQuery(this).css({'width':'100%','height':containerHeight,'position':'relative','min-height':windowHeight});
            jQuery(this).find('.container').css({'width':'100%','height':'100%'});
            jQuery(this).find('.row-align-bottom').css({'position':'absolute','width':'100%','bottom':Bottom});
        }
    });

    // align the elements vertically in the middle for banner box
    if( jQuery('.ts-banner-box').length > 0 ){
        jQuery('.ts-banner-box').each(function(){
            var containerHeight = jQuery(this).outerHeight();
            var innerContent = jQuery(this).find('.container').height();
            var insertPadding = Math.round((containerHeight-innerContent)/2);

            jQuery(this).css({'padding-top':insertPadding,'padding-bottom':insertPadding});
        });
    }

}

function alignMegaMenu(){
    setTimeout(function(){
        if ( jQuery('.main-menu').length > 0 ) {
            jQuery('.main-menu').each(function(){
                if( !jQuery(this).parent().hasClass('mobile_menu') ){
                    var thisElem = jQuery(this).find('.is_mega .ts_is_mega_div');
                    if ( jQuery(thisElem).length > 0 ) {
                        var windowWidth = jQuery(window).width();
                        var thisElemWidth = jQuery(thisElem).outerWidth();
                        jQuery(thisElem).removeAttr('style');
                        var menuOffset = jQuery(thisElem).offset().left;
                        var result = Math.round((windowWidth-thisElemWidth)/2);

                        var result2 = result - menuOffset;
                        jQuery(thisElem).css('left',result2);
                    };
                }
            });
        };
    },100);
}

function fb_comments_width(){
    setTimeout(function(){
        jQuery('#comments .fb-comments').css('width','100%');
        jQuery('#comments .fb-comments > span').css('width','100%');
        jQuery('#comments .fb-comments > span > iframe').css('width','100%');
    },300);
}

function startCounters(){
    
    jQuery('.ts-counters').each(function(){

        var current = jQuery(this);
        var $chart = current.find('.chart');
        var $cnvSize = (jQuery(this).data('counter-type') == 'with-track-bar') ? 160 : 'auto';
        var bar_color = current.attr('data-bar-color');
        var track_color = '#fff';

        if( bar_color == 'transparent' ) track_color = false;
        
        $chart.easyPieChart({
            animate: 2000,
            scaleColor: false,
            barColor: bar_color,
            trackColor: track_color,
            size: $cnvSize,
            lineWidth: 10,
            lineCap: 'square',
            onStep: function(from, to, percent) {
                jQuery(this.el).find('.percent').text(Math.round(percent)).css({
                    "line-height": $cnvSize+'px',
                    width: $cnvSize
                })
            }
        });

    });

}

function startSly(){
    jQuery(function($){
        (function () {
            var $frame  = $('.slyframe');
                var $slidee = $frame.children('ul').eq(0);
                var $wrap   = $frame.parent();

                // Call Sly on frame
                $frame.sly({
                    horizontal: 1,
                    itemNav: 'centered',
                    smart: 1,
                    activateOn: 'click',
                    mouseDragging: 1,
                    touchDragging: 1,
                    releaseSwing: 1,
                    startAt: 0,
                    scrollBar: $wrap.find('.slyscrollbar'),
                    scrollBy: 1,
                    pagesBar: $wrap.find('.pages'),
                    activatePageOn: 'click',
                    speed: 300,
                    elasticBounds: 1,
                    easing: 'easeOutExpo',
                    dragHandle: 1,
                    dynamicHandle: 1,
                    clickBar: 1
                });
        }());
    });
}

function mosaicViewScroller(){

    //Check if mosaic view have scroll
    jQuery('.mosaic-view').each(function(){
        if(jQuery(this).attr('data-scroll') === 'true'){
            jQuery(this).mCustomScrollbar({
                horizontalScroll: true,
                theme: "dark",
                scrollInertia: 75,
                advanced:{
                    autoExpandHorizontalScroll:true
                },
                callbacks:{
                    onScroll: function(){
                        showMosaic();
                    }
                }

            });
        }else if(jQuery(this).attr('data-scroll') === 'false'){
            jQuery(this).mCustomScrollbar("destroy");
        }
    })

}

function showMosaic(){
    jQuery('.mosaic-view').each(function(){
        if(jQuery(this).hasClass('fade-effect')){
            jQuery(this).find('.scroll-container > div').each(function(index){
                var thisElem = jQuery(this);
                var parentOffset = thisElem.parent().parent().parent().parent().offset().left;
                var parentWidth = thisElem.parent().parent().parent().parent().outerWidth();

                if( !thisElem.hasClass('shown') && thisElem.offset().left < parentOffset+parentWidth ){
                    thisElem.delay(index*2).animate({opacity:1},1000).addClass('shown');
                }
            });
        }
    });
}

function getFrameSize(content){
    
    var frame = jQuery(content),
        new_iframe_url = frame.attr('src').split('?feature=oembed'),
        videoLink = new_iframe_url[0],
        videoWidth = frame.width(),
        videoHeight = frame.height(),
        container = jQuery(".video-container").width(),
        calc = parseFloat(parseFloat(videoWidth/videoHeight).toPrecision(1)),
        frameHeight = parseInt(container/calc)

    var frameOptions = {
        iframe:frame,
        videourl:videoLink,
        iwidth:container,
        iheight:frameHeight
    }
    return frameOptions
}
function autoPlayVideo(){
    var content = jQuery('#post-video').find('iframe');
    if(content.length != 0 && content.length > 0){
        var option = getFrameSize(content);
    }

    if ( option.videourl.indexOf('youtube') >= 0 ){
        var videoid = option.videourl.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)\/embed\/([^\s&]+)/);
    if(videoid == null) {
       alert('Video [id] not available!');
    }
    }else if( option.videourl.indexOf('vimeo') >= 0 ){
        var videoid = option.videourl.match(/(?:https?:\/{2})?(?:w{3}\.)?player\.vimeo\.com\/video\/([0-9]*)/);
    if(videoid == null) {
       alert('Video [id] not available!');
    }
    }else{
        alert('No valid video url!');
    };

    jQuery('.overimg').css("display","none");
    option.iframe.css('display','block').attr("src",option.videourl+'?autoplay=1');
}


function getVideoThumb(){
    
    var content = jQuery('#post-video').find('iframe');

    // ----- If you want to get the video feature image, decomment the code below ------
    // if(content.length != 0 && content.length > 0){
    //     var iframe = jQuery('#post-video iframe'),
    //         new_iframe_url = iframe.attr('src').split('?feature=oembed'),
    //         videoLink = new_iframe_url[0];

    //     jQuery('.over-image').empty();

    //     if ( videoLink.indexOf('youtube') >= 0 ){
    //         var videoid = videoLink.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)\/embed\/([^\s&]+)/);

    //         jQuery('.over-image').append('<img src="http://img.youtube.com/vi/'+videoid[1]+'/maxresdefault.jpg"/>');

    //     }else if( videoLink.indexOf('vimeo') >= 0 ){
    //         var videoid = videoLink.match(/(?:https?:\/{2})?(?:w{3}\.)?player\.vimeo\.com\/video\/([0-9]*)/);

    //         jQuery.getJSON('http://vimeo.com/api/v2/video/'+videoid[1]+'.json?callback=?',{format:"json"},function(data,status){
    //             var videourl=data[0].url,
    //             largeThumb=data[0].thumbnail_large,
    //             raw=largeThumb.split('_'),
    //             urlsnip=raw[0],
    //             hdThumb=urlsnip+'_1280.jpg';
    //             jQuery('.over-image').append('<img src="'+hdThumb+'"/>');
    //         });
    //     };
    // }
}

function videoPostShow(){

    if ( jQuery('.video-post-open').prev().height() <= 120 ){
        jQuery('.video-post-open').hide();
        jQuery('.video-post-open').prev().find('.content-cortina').hide();
    } else{
        jQuery('.video-post-open').prev().addClass('content-is-big');
    }

    jQuery('.video-post-open').click(function(){
        var element = jQuery(this);

        // Hide the details button if content is smaller



        // If show less
        if ( jQuery(element).hasClass('opened') ){
            jQuery(element).prev().css('height', '100px');
            jQuery(element).prev().find('.content-cortina').show();
            jQuery(element).find('i.icon-up').removeClass('icon-up').addClass('icon-down');
            jQuery(element).removeClass('opened');
        }

        // If show more
        else if ( !jQuery(element).hasClass('opened') ){
            jQuery(element).prev().css('height','auto');
            jQuery(element).prev().find('.content-cortina').hide();
            jQuery(element).find('i.icon-down').removeClass('icon-down').addClass('icon-up');
            jQuery(element).addClass('opened');
        }
        return false;
    });
}

function singleVideoResize(){
    jQuery('.video-single-resize').click(function(){
        var container = jQuery('.featured-image.video-featured-image > .container');
        var iframe = jQuery(container).find('iframe');
        var is_iframe = true;

        if( jQuery(iframe).length <= 0 ){
            iframe = jQuery(container).find('.wp-video');
            is_iframe = false;
            jQuery(iframe).animate({opacity: 0},300);
        }
        var element = jQuery(this);

        var iframe_width = jQuery(iframe).width();
        var iframe_height = jQuery(iframe).height();
        var iframe_proportion = iframe_width/iframe_height;

        setTimeout(function(){
            // If make smaller
            if ( !jQuery(container).hasClass('is-smaller') ) {
                jQuery(container).addClass('is-smaller');
                jQuery(element).removeClass('in').addClass('out');
                jQuery(element).find('i:last-child').removeClass('icon-left').addClass('icon-right');
                jQuery(element).find('i:first-child').removeClass('icon-right').addClass('icon-left');
            }
            else if( jQuery(container).hasClass('is-smaller') ){
                jQuery(container).removeClass('is-smaller');
                jQuery(element).removeClass('out').addClass('in');
                jQuery(element).find('i:first-child').removeClass('icon-left').addClass('icon-right');
                jQuery(element).find('i:last-child').removeClass('icon-right').addClass('icon-left');
            }

            var iframe_parent_width = jQuery(iframe).parents('.embedded_videos').parent().width();
            jQuery(iframe).css('width',iframe_parent_width);
            jQuery(iframe).css('height',iframe_parent_width/iframe_proportion);
            jQuery(iframe).find('.wp-video-shortcode, .mejs-layer').css('width',iframe_parent_width);
            jQuery(iframe).find('.wp-video-shortcode, .mejs-layer').css('height',iframe_parent_width/iframe_proportion);
            jQuery(iframe).find('.mejs-time-rail').css('width',iframe_parent_width);
        },400);

        setTimeout(function(){
            jQuery(window).trigger('resize');
            jQuery(iframe).animate({opacity: 1},150);
        },700);

        return false;
    });
}


function ts_video_view(){

    jQuery('.ts-featured-area .nav-tabs li').on('click', function(){
        jQuery('.ts-featured-area .nav-tabs li.active').removeClass('active');
        setTimeout(function(){
            // resizeVideo();
        },400);
    });

    jQuery("li.has-submenu[role='item']").on("click", function (e){
        e.preventDefault();
        jQuery(this).toggleClass('openned');
    });

    //Check if mosaic view have scroll
    jQuery('.mosaic-view').each(function(){
        if(jQuery(this).attr('data-scroll') === 'true'){
            jQuery(this).mCustomScrollbar({
                horizontalScroll:true,
                theme:"dark",
                scrollInertia:75,
                advanced:{
                    autoExpandHorizontalScroll:true
                },
                callbacks:{
                    onScroll: function(){
                        showMosaic();
                    }
                }

            });
        }else if(jQuery(this).attr('data-scroll') === 'false'){
            jQuery(this).mCustomScrollbar("destroy");
        }
    })

    jQuery(".ts-featured-area .nav-tabs.is-scrollable, .scroll-view").mCustomScrollbar({
        horizontalScroll:true,
        theme:"dark",
        scrollInertia:75,
        advanced:{
            autoExpandHorizontalScroll:true
        },
        callbacks:{
            onScroll: function(){
                showMosaic();
            }
        }

    });

}

/* ***
* Count down element
*/
function ts_count_down_element() {
    // find all the countdown on the page

    var countdowns = jQuery('.ts-countdown');

    countdowns.each(function(index) {
        // save contect
        var ctx = jQuery(this);

        // get date and time
        var countdown_data = ctx.find('.time-remaining'),
            date = countdown_data.data('date'),
            time = countdown_data.data('time');

        // get dom elements of the countdown
        var $days = ctx.find('.ts-days'),
            $hours = ctx.find('.ts-hours'),
            $minutes = ctx.find('.ts-minutes'),
            $seconds = ctx.find('.ts-seconds');

        // start the countdown
        var days, hours, minutes, seconds, sec_remaining, date_diff;

        start_countdown();

        function start_countdown(){
            var curr_date = new Date(),
                event_date = new Date(date + ' ' + time);

            if ( curr_date > event_date ) {
                ctx.remove();
                return;
            }

            date_diff =  Math.abs(Math.floor( (event_date - curr_date) / 1000));

            days = Math.floor( date_diff / (24*60*60) );
            sec_remaining = date_diff - days * 24*60*60;

            hours = Math.floor( sec_remaining / (60*60) );
            sec_remaining = sec_remaining - hours * 60*60;

            minutes = Math.floor( sec_remaining / (60) );
            sec_remaining = sec_remaining - minutes * 60;

            $days.text( days );
            $hours.text( hours );
            $minutes.text( minutes );
            $seconds.text( sec_remaining );

            setTimeout(start_countdown, 1000);
        }
    });
}

function ts_fullscreen_scroll_btn(){
    var container = jQuery('.site-section'),
        scroll = jQuery('.site-section').attr('data-scroll-btn');

    if ( scroll === 'yes' ) {
        container.find('.ts-scroll-down-btn > a').on('click', function(e){
            e.preventDefault();

            jQuery('html, body').animate({

                scrollTop: jQuery(this).parents('.site-section').outerHeight()

            }, 1000)
        })
    };
}


/* ******************************* */
/*          Video Carousel         */
/* ******************************* */

(function($) {
    $.fn.ts_video_carousel = function(options) {
        var ts_slider_options = $.extend({
            transition: 700
        }, options);

        var $context = $(this),
            $slides = $(this).find('.slides'),
            $slide = $slides.children('li'),
            $nav_arrows = null;

        var viewport = $(window).width(),
            slide_width = $slide.eq(0).outerWidth(true),
            current = 0,
            ts_delay = null;

        // get the height of the slide thumb ( afte the iframe has been resized )
        $(window).load(function(){
            if ( $nav_arrows !== null){
                $nav_arrows.css({ 'height': $slide.find('.thumb').height() });
            }
        });

        $(window).resize(function(){
            // delay the calculation of the viewport on resize
            if ( ts_delay !== null ){
                clearTimeout(ts_delay);
            }

            ts_delay = setTimeout(function(){
                viewport = $(window).width();
                if ( $nav_arrows !== null){
                    $nav_arrows.css({ 'height': $slide.find('.thumb').height() });
                }
                ts_setWidths();
            }, 400);
        });

        // create navigations
        (function ts_createElements(){
            var navigations =  '<div class="nav-arrow prev"><span class="nav-icon icon-left"></span></div>\
                                <div class="nav-arrow next"><span class="nav-icon icon-right"></span></div>';
            $slides.after(navigations);
        })();

        // set initial states for slider elements
        (function ts_video_slider_init(){
            $slides.width( slide_width * $slide.size() );
            $slide.eq(0).addClass('current-active');
            $nav_arrows = $context.find('.nav-arrow');
            $nav_arrows.eq(0).addClass('fade-me');
            ts_setWidths();
        })();

        function ts_setWidths(){
            if ( viewport < slide_width ) {
                $slide.width( viewport );
                slide_width = viewport;

                $slide.css( {
                    'left': slide_width * current * -1
                });
            } else {
                $slide.removeAttr('style');
                slide_width = $slide.width();

                $slide.css( {
                    'left': slide_width * current * -1
                });
            }

            if ( viewport < $context.parent('.ts-video-slider-wrap').width() ) {
                $context.parent('.ts-video-slider-wrap').width(viewport);
            } else {
                $context.parent('.ts-video-slider-wrap').removeAttr('style');
            }
        };

        $slide.on( 'click', function(){
            if ( $(this).index() < current ){
                $slide.eq(current).removeClass('current-active');
                current--;

            } else if( $(this).index() > current) {
                $slide.eq(current).removeClass('current-active');
                current++;
            }
            ts_changeSlide()
        });

        $nav_arrows.on('click', function(){
            if ( $(this).hasClass('next') ) {
                if ( current !== $slide.size() - 1) {
                    $slide.eq(current).removeClass('current-active');
                    current++;
                    $nav_arrows.eq(0).removeClass('fade-me');
                    ts_changeSlide();
                }
                if ( $nav_arrows.eq(0).hasClass('fade-me') ){
                    $nav_arrows.eq(0).removeClass('fade-me');
                }
            }
            else if( $(this).hasClass('prev') ){
                if ( parseFloat($slide.eq(0).css('left').replace( 'px', '')) < 0 && current > 0 ) {
                    $slide.eq(current).removeClass('current-active');
                    current--;
                    ts_changeSlide();
                }

                if ( $nav_arrows.eq(1).hasClass('fade-me') ){
                    $nav_arrows.eq(1).removeClass('fade-me');
                }
            }
        });

        function ts_changeSlide(){
            $slide.animate({
                'left': ( slide_width ) * current * -1
            }, {
                duration: ts_slider_options.transition,
                complete: function() {
                    $slide.eq(current).addClass('current-active');
                }
            });

            if ( current === 0){
                $nav_arrows.eq(0).addClass('fade-me');
            }
            else if( current === $slide.size() - 1){
                $nav_arrows.eq(1).addClass('fade-me');
            }
        }
    }
})(jQuery);

function ts_scroll_top(){
    jQuery(window).scroll(function() {
        if(jQuery(this).scrollTop() > 200){
            jQuery('#ts-back-to-top').stop().animate({
                bottom: '30px'    
            }, 500);
        }else{
            jQuery('#ts-back-to-top').stop().animate({
               bottom: '-100px'    
            }, 500);
        }
    });
    jQuery('#ts-back-to-top').on('click',function() {
        jQuery('html, body').stop().animate({
           scrollTop: 0
        }, 500, function() {
            jQuery('#ts-back-to-top').stop().animate({
                bottom: '-100px'    
            }, 500);
        });
    });
}

// Detect device
function isMobile() {
    try{ document.createEvent("TouchEvent"); return true; }
    catch(e){ return false; }
}

/*
 *
 *
    CALCULATE EXCERPT
 *
 *  
 */
function calculateExcerpt(){
    if ( jQuery('.ts-big-posts').length ) {
        
        jQuery('.ts-big-posts').each(function(){
            var thisElem = jQuery(this),
                contentExcerpt = thisElem.find('.entry-excerpt'),
                contentImg = thisElem.find('.image-holder > img'),
                checkImg = thisElem.find('article .row > header');

            if (checkImg.length) {
                thisElem.find('img.lazy').lazyload({
                    effect : "fadeIn",
                    load : function(){
                        contentImg.removeClass('lazy').addClass('lazy-loaded');
                    }
                });

                setTimeout(function(){
                    if ( contentImg.hasClass('lazy-loaded') && !isMobile() || !contentImg.hasClass('lazy') ) {
                        var secOffsetTop = thisElem.find('.row > section').offset().top,
                            btnOffsetTop = thisElem.find('.article-view-more').offset().top,
                            exptOffsetTop = contentExcerpt.offset().top;

                        var cntHeight = contentImg.outerHeight(), // get article height
                            cntExcerptTop = exptOffsetTop - secOffsetTop, // get excerpt position top in px
                            cntExcerptBottom = cntHeight - (contentExcerpt.outerHeight()+cntExcerptTop), // get excerpt position bottom
                            excerptOffsets = cntExcerptTop + cntExcerptBottom,
                            btnHeight = thisElem.find('.article-view-more').outerHeight(), // get height of button readmore
                            cntExcerptCalc = cntHeight - excerptOffsets,
                            cntSection = thisElem.find('.row > section').outerHeight(); // get section height

                        var cntButtonTop = btnOffsetTop - secOffsetTop - 30;

                        if ( cntHeight < cntSection ) {
                            contentExcerpt.height(cntExcerptCalc);
                        };

                        if ( cntExcerptCalc < 30 ) {
                            contentExcerpt.hide();
                        };

                        if ( cntHeight < (cntButtonTop + btnHeight) ) {
                            thisElem.find('.article-view-more').css('display','none');
                        } else {
                            thisElem.find('.article-view-more').removeAttr('style');
                        };
                    };
                },1000);
            };    
        });
    };

    // Single gallery horizontal
    if ( jQuery('.single_gallery1').length || jQuery('.single_gallery6').length ) {
        var aside = jQuery('.post-header-title'),
            excerpt = aside.find('.entry-excerpt'),
            asideOffset = aside.offset().top,
            excerptOffset = excerpt.offset().top,
            excerptTop = excerptOffset - asideOffset,
            excerptBottom = aside.height() - excerptTop;

            console.log(excerptBottom);

        excerpt.css({
            'height' : excerptBottom + 30
        });
    };
}

jQuery(document).ready(function($){

    if( jQuery(".ts-map-create").length > 0 ){
        google.maps.event.addDomListener(window, "load", initialize);
    }

    jQuery(document).on('click', '.ts-item-tab', function (e) {
        e.preventDefault();

        var id = jQuery(this).find('a').attr('href'),
            parent = jQuery(this).closest('.ts-tab-container');
        
        parent.find('.active').removeClass('active');

        jQuery(this).addClass('active');

        jQuery(id).addClass('active');  

    });
    
    // Preloader
    if ( jQuery('.ts-page-loading').length ) {
        NProgress.configure({
            showSpinner : false,
            ease: 'ease',
            speed: 500,
            parent : '.ts-page-loading',
        });
        NProgress.start();
    };

    ts_scroll_top();
    //Count To
    $.fn.countTo = function() {

        var element = this;

        function execute() {

            element.each(function(){

                var item = $(this).find('.countTo-item');

                item.each(function(){

                    var current = $(this),
                        percent = current.find('.skill-level').attr('data-percent');
                    
                    if ( !current.hasClass('animated') ) {
                        current.find('.skill-title').css({'color' : 'inherit'});
                        if( element.hasClass('ts-horizontal-skills') ){
                            current.find('.skill-level').animate({'width' : percent+'%'}, 800);
                        } else {
                            current.find('.skill-level').animate({'height' : percent+'%'}, 800);
                        }
                        current.addClass('animated');
                    }

                    if ( current.hasClass('animated') && element.attr('data-percentage') == 'true' && current.find('.percent').length < 1 ) {
                        current.append('<span class="percent">'+percent+'%'+'</span>');
                        current.find('.percent').css({'left' : percent+'%'}).delay(1600).fadeIn();
                    };

                    if ( percent == 100 ) {
                        item.addClass('full');
                    };

                })

            })

        }

        execute();

        return this;
    };

    /*
     *
     *  Single gallery type
     *
    */
    // Gallery horizontal
    if (jQuery('.gallery-type').hasClass('single_gallery1') || jQuery('.ts-gallery-element').hasClass('ts-horizontal-gallery')) {
        var $gallery = jQuery('#ts-main-gallery, .ts-horizontal-gallery #ts-main-gallery');
        var flkty = $gallery.data('flickity');

        $gallery.flickity({
            wrapAround: false,
            freeScroll: true,
            contain: true
        });

        $gallery.flickity().on( 'cellSelect settle', function() {
            jQuery("img.lazy").lazyload({
                effect : "fadeIn",
                skip_invisible : false,
                load : function(){
                    jQuery(this).removeClass('lazy');
                    jQuery(this).addClass('ts-lazyloaded');
                }
            });
        });

        // scrollbar
        jQuery('.single-ts-gallery .single_gallery1 .post-header-title .entry-excerpt').mCustomScrollbar({
            axis : 'y',
            theme : "dark",
            scrollInertia: 75,
        });
    };
    // Gallery justified
    if (jQuery('.gallery-type').hasClass('single_gallery2') || jQuery('.ts-gallery-element').hasClass('ts-justified-gallery')) {
        var options = {
                minMargin: 5,
                maxMargin: 15,
                itemSelector: ".item",
                firstItemClass: "first-item"
            };

        jQuery(".single_gallery2 .inner-gallery-container, .ts-justified-gallery .inner-gallery-container").rowGrid(options);

        // endless scrolling
        jQuery(window).scroll(function() {
            if(jQuery(window).scrollTop() + jQuery(window).height() == jQuery(document).height()) {
                jQuery(".single_gallery2 .inner-gallery-container, .ts-justified-element .inner-gallery-container").rowGrid("appended");
            }
        });

        // Lazyload
        jQuery("img.lazy").lazyload({
            effect : "fadeIn",
            load : function(){
                jQuery(this).removeClass('lazy').addClass('ts-lazyloaded');
            }
        });
    };
    // Vertical slider
    if (jQuery('.gallery-type').hasClass('single_gallery4') || jQuery('.ts-gallery-element').hasClass('ts-vertical-gallery')) {
        jQuery('.ts-gallery-vertical, .ts-vertical-gallery .vertical-layout').bxSlider({
            mode: 'vertical',
            slideMargin: 5,
            pagerCustom: '#ts-gallery-pager'
        });

        // scrollbar
        jQuery('.ts-gallery-vertical #ts-gallery-pager, .ts-vertical-gallery #ts-gallery-pager').mCustomScrollbar({
            axis : 'y',
            theme : "dark",
            scrollInertia: 75,
        });
    };
    // Masonry gallery
    if (jQuery('.gallery-type').hasClass('single_gallery5') || jQuery('.ts-gallery-element').hasClass('ts-masonry-gallery')) {
        var container = jQuery('.single_gallery5 .inner-gallery-container, .ts-masonry-gallery .inner-gallery-container');
        container.isotope({
            itemSelector : '.item'
        });
        jQuery("img.lazy").lazyload({
            effect : "fadeIn",
            load : function(){
                jQuery(this).parent().addClass('was-loaded');
                jQuery(this).removeClass('lazy').addClass('ts-lazyloaded');
                setTimeout(function(){
                    container.isotope('layout');
                },500);
            }
        });
    };
    // Gallery horizontal scroll
    if (jQuery('.gallery-type').hasClass('single_gallery6') || jQuery('.ts-gallery-element').hasClass('ts-horizontal-scroll-gallery')) {
        // scrollbar
        jQuery('.single-ts-gallery .single_gallery6 .inner-gallery-container, .ts-horizontal-scroll-gallery .inner-gallery-container').mCustomScrollbar({
            horizontalScroll: true,
            axis: 'x',
            theme: "dark",
            scrollInertia: 75,
            advanced:{
                autoExpandHorizontalScroll:true
            },
            callbacks:{
                whileScrolling: function(){
                    // Lazyload
                    if(this.mcs.direction == 'x'){
                        jQuery("img.lazy").lazyload({
                            effect : "fadeIn",
                            skip_invisible : false,
                            threshold : 200,
                            load : function(){
                                jQuery(this).removeClass('lazy');
                                jQuery(this).addClass('ts-lazyloaded');
                            }
                        });
                    }
                }
            }
        });

        // excerpt scroll
        jQuery('.single-ts-gallery .single_gallery6 .post-header-title .entry-excerpt').mCustomScrollbar({
            axis : 'y',
            theme : "dark",
            scrollInertia: 75,
        });
    };
    // Trigger caption at galleries
    jQuery('.single-ts-gallery .trigger-caption .button-trigger-cap, .ts-gallery-element .trigger-caption .button-trigger-cap').on('click', function(e){
        e.preventDefault();
        jQuery(this).closest('.trigger-caption').prev().toggleClass('shown');
    })

    /* Widget Tabs */

    jQuery('.tabs-control > li > a').click(function () {
        var this_id = jQuery(this).attr('href'); // Get the id of the div to show
        var tabs_container_divs = '.' + jQuery(this).parent().parent().next().attr('class') + ' >  div'; // All of elements to hide
        jQuery(tabs_container_divs).hide(); // Hide all other divs
        jQuery(this).parent().parent().next().find(this_id).show(); // Show the selected element
        jQuery(this).parent().parent().find('.active').removeClass('active'); // Remove '.active' from elements
        jQuery(this).addClass('active'); // Add class '.active' to the active element
        return false;
    });

    jQuery('.toggle_title').click(function () {
        jQuery(this).next().slideToggle('fast');
        jQuery(this).find('.toggler').toggleClass('toggled');
    });

    jQuery('.tabs-switch li a').click(function () {
        var tab_id = jQuery(this).attr('href');
        if (jQuery(this).parent().parent().next().find(tab_id).is(':hidden')) {
            jQuery(this).parent().parent().find('li').removeClass('active');
            jQuery(this).parent().addClass('active');
            jQuery(this).parent().parent().next().find('div').hide('fast');
        }
        jQuery(this).parent().parent().next().find(tab_id).show('fast');
        return false;
    });

    var $container = jQuery('.shortcode_accordion > div'),
        $trigger = jQuery('.shortcode_accordion > h3');
    $container.hide();
    $trigger.first().addClass('toggled').next().show();
    $trigger.on('click', function (e) {
        if (jQuery(this).next().is(':hidden')) {
            $trigger.removeClass('toggled').next().slideUp(300);
            jQuery(this).toggleClass('toggled').next().slideDown(300);
        }
        e.preventDefault();
    });

    jQuery('.shortcode_infobox .close').click(function () {
        jQuery(this).parent().fadeOut(500);
    });

    if(jQuery('#post-video').find('iframe').length > 0){
        var option = getFrameSize('#post-video iframe');
    }

    jQuery('.video-single-resize').on('click', function(){
        var date = new Date();
        date.setTime(date.getTime() + (1 * 60 * 1000));
        if( jQuery('.video-featured-image > .container').hasClass('is-smaller') != true ){
            var videoType = 'small';
        }else{
            var videoType = 'big';
        }
        jQuery.cookie('ts_single_video_resize_type', videoType, { expires: date, path:'/' });

        ExpireCookie(1, 'ts_single_video_resize');
    });

    jQuery('a.videoPlay').on('click',function(event){
        event.preventDefault();
        setTimeout(function(){
            autoPlayVideo();
        },500)
    });

    jQuery('#searchbox .search-trigger').on('click', function(e){
        e.preventDefault();
        jQuery(this).next().addClass('active');
    })

    jQuery('#searchbox .search-close').on('click', function(e){
        e.preventDefault();
        jQuery(this).parent().removeClass('active');
    })

    jQuery("body").keydown(function (e) {

        if(e.which == 27){
            jQuery("#searchbox .search-close").parent().removeClass('active');
        }
    })

    jQuery('.single .post-rating .rating-items > li').each(function(){
        var bar_width = jQuery(this).find('.bar-progress').data('bar-size');

        jQuery(this).find('.bar-progress').css({width: bar_width+'%'});
    })


    jQuery('.share-options li').click(function(){
        var social = jQuery(this).attr('data-social');
        var postId = jQuery(this).attr('data-post-id');
        var socialCount = jQuery(this).find('.how-many');

        var data = {
                action      : 'ts_set_share',
                ts_security : Shootback.ts_security,
                postId      : postId,
                social      : social
            };

        jQuery.post(Shootback.ajaxurl, data, function(response){

            if( response && response !== '-1' ){
                jQuery(socialCount).text(response);
                jQuery('.counted').text(parseInt(jQuery('.counted').text()) + 1);
            }
        });
    });

    // Show more button on share
    jQuery('.share-options .show-more').on('click', function(e){
        e.preventDefault();
        if ( jQuery(this).children().attr('data-tooltip') !== 'hide' ) {
            jQuery(this).children().attr('data-tooltip','hide');
        } else {
            jQuery(this).children().attr('data-tooltip','show more');
        };
        var this_item = jQuery(this).parent().find('.share-menu-item');
        this_item.each(function(){
            if( !jQuery(this).hasClass('shown') ){
                jQuery(this).toggleClass('hidden');
            }
        })
    });

    // Gallery overlay sharing
    jQuery('.overlay-effect .entry-controls .share-box .share-link').on('click', function(e){
        e.preventDefault();
        jQuery(this).toggleClass('shown');
    })

    $('.ts-vertical-menu').find('.menu-item-has-children').each(function(){
        var url_link = $(this).children('a').attr('href');
        $(this).children('a').attr('href','#');
        $(this).append('<span class="menu-item-url-link"><a href="'+url_link+'" title="View page"><i class="icon-link"></i></a></span>')
    });

    $('.menu-item-type-taxonomy').each(function(){
        if($(this).find('.ts_is_mega_div').length !== 0){
            $(this).addClass('menu-item-has-children is_mega');
        }
    })

    $('.ts-user-login-modal').find('form > p').each(function(){
        var inputResult = $(this).children('label').html();
        $(this).children('input').attr('placeholder',inputResult);
    })
    $('.ts-user-login-modal').find('.login-submit input[type="submit"]').attr('class','btn medium active');

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        if ( $(this).attr('data-video-type') == 'upload' ) {
            $('#ts-video-type').val('upload');
        } else{
            $('#ts-video-type').val('url');
        }
    });

    function ts_ajax_load_more(){

        $('.ts-pagination-more').click(function(){

            var loop            = parseInt( $(this).attr('data-loop') );
            var args            = $(this).attr('data-args');
            var paginationNonce = $(this).find('input[type="hidden"]').val();
            var loadmoreButton  = $(this);
            var $container      = $(this).prev();
            console.log($container);

            // Show preloader
            $('#ts-loading-preload').addClass('shown');
            loadmoreButton.attr('data-loop', loop + 1);

            jQuery.post(Shootback.ajaxurl, {
                    action         : 'ts_pagination',
                    args           : args,
                    paginationNonce: paginationNonce,
                    loop           : loop
                },  function(data){
                        if( data !== '0' ){
                            if( $container.hasClass('ts-filters-container') ){
                                var data_content = $(data).appendTo($container);
                                $container.isotope('appended', $(data_content));
                                setTimeout(function(){
                                    $container.isotope('layout');
                                },1200);
                            }else{
                                $container.append($(data));
                            }
                            jQuery("img.lazy").lazyload({
                                effect : "fadeIn",
                                load : function(){
                                    setTimeout(function(){
                                        $container.isotope('layout');
                                    },1200);
                                }
                            });
                        }else{
                            loadmoreButton.remove();
                        }
                        // Hide the preloader
                        setTimeout(function(){
                            $('#ts-loading-preload').removeClass('shown');
                        },800);
                    }
            );
        });
    }
    ts_ajax_load_more();

    //circle share effect on single video page
    $('.post-share-box-circle').find('label').on('click', function(e){
        e.preventDefault();
        $(this).toggleClass('shown');
    });

    function ts_send_date_ajax(id){

        $(document).on('click', '.contact-form-submit', function(event) {
            event.preventDefault();
            
            var form         = $(this).closest('form'),
                name         = form.find('.contact-form-name'),
                email        = form.find('.contact-form-email'),
                subject      = form.find('.contact-form-subject'),
                message      = form.find('.contact-form-text'),
                emailRegEx   = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                errors       = 0,
                custom_field = form.find('.ts_contact_custom_field'),
                data         = {},
                this_element = jQuery(this);

            String.prototype.trim = function() {
                return this.replace(/^\s+|\s+$/g,"");
            };

            if ( emailRegEx.test(email.val()) ) {
                email.removeClass('invalid');
            } else {
                email.addClass('invalid');
                errors = errors + 1;
            }

            jQuery(custom_field).each(function(i,val){
                if(jQuery(this).hasClass('contact-form-require')){
                    if (jQuery(this).val().trim() !== '') {
                        jQuery(this).removeClass('invalid');
                    } else {
                        jQuery(this).addClass('invalid');
                        errors = errors + 1;
                    }
                }
            });

            if (name.val().trim() !== '') {
                name.removeClass('invalid');
            } else {
                name.addClass('invalid');
                errors = errors + 1;
            }


            if ( subject.length !== 0 ) {
                if (subject.val().trim() !== '') {
                    subject.removeClass('invalid');
                } else {
                    subject.addClass('invalid');
                    errors = errors + 1;
                }
            }

            if (message.val().trim() !== '') {
                message.removeClass('invalid');
            } else {
                message.addClass('invalid');
                errors = errors + 1;
            }
            
            if ( errors === 0 ) {

                data['action']  = 'shootback_contact_me';
                data['token']   = Shootback.contact_form_token;
                data['name']    = name.val().trim();
                data['from']    = email.val().trim();
                data['subject'] = (subject.length) ? subject.val().trim() : '';
                data['message'] = message.val().trim();
                data['custom_field'] = new Array();

                jQuery(custom_field).each(function(i,val){
                    var title = jQuery(this).next().val();
                    var value = jQuery(this).val();
                    var require = jQuery(this).next().next().val();
                    var new_item = {value : value, title: title, require: require};
                    data['custom_field'].push(new_item);
                });

                $.post(Shootback.ajaxurl, data, function(data, textStatus, xhr) {
                    form.find('.contact-form-messages').html('');
                    console.log(data.status);
                    if ( data !== '-1' ) {
                        if ( data.status === 'ok' ) {
                            form.find('.contact-form-messages').removeClass("hidden").html(Shootback.contact_form_success).addClass('success');
                            jQuery(this_element).attr('disabled', 'disabled');
                            form.find("input, textarea").not(".contact-form-submit").val('');

                        } else {
                            form.find('.contact-form-messages').removeClass("hidden").html('<div class="invalid">' + data.message + '</div>');
                        }

                        if ( typeof data.token !== "undefined" ) {
                            Shootback.contact_form_error = data.token;
                        }

                    } else {
                        form.addClass('hidden');
                        form.find('.contact-form-messages').html(Shootback.contact_form_error);
                        $(clickElement).removeAttr('disabled');
                    }
                });
            }
        });
    }
    ts_send_date_ajax();


    jQuery('.ts-select-by-category li').click(function(){

        var idCategory = jQuery(this).attr('data-category-li');

        jQuery('.ts-select-by-category li').each(function(){
            if( jQuery(this).hasClass('active') ){
                jQuery(this).removeClass('active');
            }
        })
        jQuery("img.lazy").lazyload({
            effect : "fadeIn",
            threshold : 200
        });

        jQuery(this).addClass('active');

        jQuery(this).closest('section').find('.ts-tabbed-category').each(function(){
            jQuery(this).css('display', 'none').removeClass('shown');
        });

        jQuery(this).closest('section').find('.ts-tabbed-category').each(function(){
            var categories = jQuery(this).attr('data-category').split('\\');
            for(var category in categories){
                if( idCategory == categories[category] ){
                    var thisHtml = jQuery(this).css('display', '').get(0).outerHTML;
                    jQuery('[data-category-div="' + idCategory + '"]').find('.ts-cat-row').append(thisHtml);
                    jQuery(this).remove();
                }
            }
        });
    });
    
    if( jQuery('.ts-video-fancybox').length > 0 ){
        jQuery('.ts-video-fancybox').fancybox({
            maxWidth    : 800,
            maxHeight   : 600,
            fitToView   : false,
            width       : '70%',
            height      : '70%',
            autoSize    : false,
            closeClick  : false,
            openEffect  : 'none',
            closeEffect : 'none'
        });
    }

});

var map, mapAddress, latlng, mapLat, mapLng, mapType, mapStyle, mapZoom,
    mapTypeCtrl, mapZoomCtrl, mapScaleCtrl, mapScroll, mapDraggable, mapMarker;
var style = '';

    var infinite_loading = false;
    jQuery(window).on('scroll',function() {
        jQuery(".ts-infinite-scroll").each(function(){
            var thisElem = jQuery(this);
            if( thisElem.prev().offset().top + thisElem.parent().height() - 120 < jQuery(window).scrollTop() + jQuery(window).height() && infinite_loading == false ){
                
                infinite_loading = true;
                jQuery(thisElem).trigger("click");
                setTimeout(function(){
                    infinite_loading = false;
                }, 1000)
            }
        });
    });
function ts_select_post_by_category(){
    jQuery('.ts-select-by-category li:first-child').each(function(){
        jQuery(this).trigger('click');
    });
}

function initialize(){
    jQuery('.ts-map-create').each(function(){
        var element = jQuery(this);
        mapAddress = jQuery(element).attr('data-address');
        mapLat = jQuery(element).attr('data-lat');
        mapLng = jQuery(element).attr('data-lng');
        mapStyle = jQuery(element).attr('data-style');
        mapZoom = jQuery(element).attr('data-zoom');
        mapTypeCtrl = (jQuery(element).attr('data-type-ctrl') === 'true') ? true : false;
        mapZoomCtrl = (jQuery(element).attr('data-zoom-ctrl') === 'true') ? true : false;
        mapScaleCtrl = (jQuery(element).attr('data-scale-ctrl') === 'true') ? true : false;
        mapScroll = (jQuery(element).attr('data-scroll') === 'true') ? true : false;
        mapDraggable = (jQuery(element).attr('data-draggable') === 'true') ? true : false;
        mapMarker = jQuery(element).attr('data-marker');

        if( jQuery(element).attr('data-type') === 'ROADMAP' )
            mapType = google.maps.MapTypeId.ROADMAP
        else if( jQuery(element).attr('data-type') === 'HYBRID' )
            mapType = google.maps.MapTypeId.HYBRID
        else if( jQuery(element).attr('data-type') === 'SATELLITE' )
            mapType = google.maps.MapTypeId.SATELLITE
        else if( jQuery(element).attr('data-type') === 'TERRAIN' )
            mapType = google.maps.MapTypeId.TERRAIN
        else
            mapType = google.maps.MapTypeId.ROADMAP

        // How you would like to style the map. 
        // This is where you would paste any style found on Snazzy Maps.
        if ( mapStyle === 'map-style-essence' ){
            style = [{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill"},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#7dcdcd"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]}]

        } else if( mapStyle === 'map-style-subtle-grayscale' ){
            style = [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]

        } else if( mapStyle === 'map-style-shades-of-grey' ){
            style = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]}]

        } else if( mapStyle === 'map-style-purple' ){
            style = [{"featureType":"all","elementType":"all","stylers":[{"visibility":"simplified"},{"hue":"#bc00ff"},{"saturation":"0"}]},{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#e8b8f9"}]},{"featureType":"administrative.country","elementType":"labels","stylers":[{"color":"#ff0000"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#3e114e"},{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"},{"color":"#a02aca"}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#2e093b"}]},{"featureType":"landscape.natural","elementType":"labels.text","stylers":[{"color":"#9e1010"},{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"labels.text.fill","stylers":[{"color":"#ff0000"}]},{"featureType":"landscape.natural.landcover","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#58176e"}]},{"featureType":"landscape.natural.landcover","elementType":"labels.text.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#a02aca"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#d180ee"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#a02aca"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"off"},{"color":"#ff0000"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#a02aca"},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#cc81e7"},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"visibility":"simplified"},{"hue":"#bc00ff"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#6d2388"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#c46ce3"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#b7918f"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#280b33"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"simplified"},{"color":"#a02aca"}]}];

        } else if( mapStyle === 'map-style-best-ski-pros' ){
            style = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#2c3645"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#dcdcdc"}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"color":"#476653"}]},{"featureType":"landscape.natural.landcover","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#93d09e"}]},{"featureType":"landscape.natural.terrain","elementType":"labels","stylers":[{"visibility":"on"},{"color":"#0d6f32"}]},{"featureType":"landscape.natural.terrain","elementType":"labels.text.stroke","stylers":[{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#62bf85"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#95c4a7"}]},{"featureType":"road","elementType":"labels.text","stylers":[{"color":"#334767"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#334767"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b7b7b7"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"on"},{"color":"#364a6a"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.rail","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#535353"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#3fc672"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#4d6489"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]}]

        } else {
            style = '';
        }

        latlng = new google.maps.LatLng(mapLat, mapLng);

        var mapOptions = {
            zoom: parseInt(mapZoom),
            center: latlng,
            styles: style,
            zoomControl: mapZoomCtrl,
            scaleControl: mapScaleCtrl,
            mapTypeControl: mapTypeCtrl,
            scrollwheel: mapScroll,
            draggable: mapDraggable,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
            },
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL
            },
            mapTypeId: mapType
        }
        var idElement = jQuery(element).attr('id');

        map = new google.maps.Map(document.getElementById(idElement), mapOptions);

        var marker = new google.maps.Marker({
            map: map,
            icon: mapMarker,
            position: latlng,
            title: mapAddress
        });
    });
}

jQuery('[data-parallax="yes"]').parallax("50%", 0.3);


jQuery(window).on('resize orientationchange', function(){
    mosaicViewScroller();
});

/* Running functions on page load */
jQuery(window).on('load resize orientationchange', function(){
    alignMegaMenu();
    setScrollContainerWidth();

    // Vertical gallery height resize calculate
    if ( jQuery('.gallery-type').hasClass('single_gallery4') || jQuery('.ts-gallery-element').hasClass('ts-vertical-gallery') ) {
        jQuery('.single_gallery4, .ts-vertical-gallery').find('.item-gallery').each(function(){
            var thisElem = jQuery(this),
                galleryContainer = thisElem.closest('.inner-gallery-container'),
                galleryPager = galleryContainer.find('#ts-gallery-pager'),
                thisHeight = thisElem.height();

            thisElem.parent().height(thisHeight);

            galleryContainer.height(thisHeight);

            galleryPager.height(thisHeight);

        });
    };
});

jQuery(window).load(function() {
    ts_set_like();
    fb_likeus_modal(5);
    initCarousel();
    startSly();
    animateArticlesOnLoad();
    animateBlocksOnScroll();
    visibleBeforeAnimation();
    activateStickyMenu();
    filterButtonsRegister();
    twitterWidgetAnimated();
    ts_filters();
    activateFancyBox();
    fb_comments_width();
    alignElementVerticalyCenter();
    showMosaic();
    mosaicViewScroller();
    ts_video_view();
    alignMegaMenu();
    resizeVideo();
    videoPostShow();
    singleVideoResize();
    getVideoThumb();
    setScrollContainerWidth();
    ts_count_down_element();
    ts_fullscreen_scroll_btn();
    ts_select_post_by_category();
    calculateExcerpt();

    jQuery('.joyslider').addClass('active');

    // Hide preloader
    if ( jQuery('.ts-page-loading').length ) {
        NProgress.done(true);
        setTimeout(function() {
            jQuery('.ts-page-loading').addClass('shown');
        }, 900);
        setTimeout(function(){
            jQuery('.ts-page-loading').fadeOut(500);
        },1100);
    }

    // If onepage layout - run the onepage menu
    if ( ts_onepage_layout == 'yes' ) {
        startOnePageNav();
    }

    jQuery("img.lazy").lazyload({
        effect : "fadeIn",
        threshold : 200
    });

    jQuery('.flexslider').each(function(){
        var nav_control;
        if( jQuery(this).hasClass('with-thumbs') ){
            nav_control = 'thumbnails';
        } else{
            nav_control = 'none';
        }
        var nav_animation = jQuery(this).attr('data-animation');
        jQuery(this).flexslider({
            animation: nav_animation,
            controlNav: nav_control,
            prevText: "",
            nextText: "",
            smoothHeight: true

        });
    });

    jQuery('.ts-bxslider').each(function(){
        var current = '#'+jQuery(this).find(".bxslider").attr('id');
        var caption = jQuery(current).find('.slider-caption');

        jQuery(current).bxSlider({
            auto: true,
            autoHover: true,
            mode: 'fade',
            pause: 5000,
            nextSelector: '#slider-next',
            prevSelector: '#slider-prev',
            nextText: '<i class="icon-right"></i>',
            prevText: '<i class="icon-left"></i>',
            speed: 1000,
            onSliderLoad: function(){
                jQuery(current).children('li').eq(0).addClass('active-slide');
                caption.find('.title').addClass('animated');
                caption.find('.sub').addClass('animated');
            },
            onSlideBefore: function(){
                caption.find('.title').removeClass('animated');
                caption.find('.sub').removeClass('animated');
            },
            onSlideAfter: function(currentSlide, totalSlides, currentSlideHtmlObject){
                jQuery('.active-slide').removeClass('active-slide');
                jQuery(current).children('li').eq(currentSlideHtmlObject).addClass('active-slide');
                caption.find('.title').addClass('animated');
                caption.find('.sub').addClass('animated');
            }
        });
    });

    jQuery('.panel-heading a[data-toggle="collapse"]').on('click', function(){
        var panelCollapse = jQuery(this).parent().next();
        if ( panelCollapse.hasClass('in')) {
            jQuery(this).find('i').css({
                '-webkit-transform': 'rotate(0deg)',
                '-o-transform': 'rotate(0deg)',
                '-mz-transform': 'rotate(0deg)',
                'transform': 'rotate(0deg)'
            })
        } else {
            jQuery(this).find('i').css({
                '-webkit-transform': 'rotate(90deg)',
                '-o-transform': 'rotate(90deg)',
                '-mz-transform': 'rotate(90deg)',
                'transform': 'rotate(90deg)'
            })
        }
    });

    jQuery('.megaWrapper').each(function(){
        if( jQuery(this).hasClass('ts-behold-menu') ){
            jQuery(this).removeClass('ts-behold-menu').addClass('ts-mega-menu');
        }
        jQuery(this).find('.ts_is_mega_div .sub-menu').addClass('ts_is_mega');
        jQuery(this).find('.ts_is_mega_div').parent().addClass('is_mega');
    })

    var all_anchor = jQuery('.ts-article-accordion > .panel-group').find('.panel-title > a');

    all_anchor.on('click', function(){
        all_anchor.not(this).parent().parent().removeClass('hidden');
        jQuery(this).parent().parent().addClass('hidden');
    });

    if ( isMobile() == false ) {
        jQuery('body').addClass('desktop-version');
    };

}); //end load function

//joySlider
(function() {
    jQuery.fn.JoySlider = function(op) {
        var joy_options = jQuery.extend({
            auto: true,             // boolean: animate automatically
            nav: true,              // boolean: show slider controls
            loop: true,             // boolean: go to first slide after the last slide
            preview: true,          // boolean: show/hide preview slides
            speed: 400,             // integer: transition between slides
            timeout: 5000,          // ingeger: time between slides transition
            gutter: 40,             // integer: space between preview slides
            previewTimeout: 5000    // integer: time between preview slides transiton
        }, op);

        // jquery objects
    var joy_slider = jQuery(this),
        // slider container
        container = joy_slider.find('.slider-container'),
        // slides container
        slides_container = container.find('.slides-container'),
        // slides
        slides = slides_container.children('.slide'),
        // preview slides container
        preview_slides_container,
        // preview slides
        preview_slides,
        // slider controls
        navigation = null,
        // preview slides progress
        progress = null;

        // number of slides
    var count_slides = slides.size(),
        // the width of one preview slide
        preview_slide_width = 0,
        // the width of one slide
        slide_width = 0,
        // slides timer for slides timeout
        timer = 0,
        // get the remaining time before the timer trigger
        timer_remaining = 0,
        // current active slide
        current = 0,
        // the index of the clicked element
        clicked = 0,
        // slider container width
        container_width = 0,
        // slider transition completion if it's true allow changing the slide
        // otherwise don't change the slide
        transition_complete = true,
        // if the slider was stopped dont start to change automaticaly
        // when the slide is changed
        status = true; // false: stopped
                       // true: play

    // function create slider elements
    (function createElements() {
        // create slider navigation
        if ( joy_options.nav ) {
            var nav = '<ul class="slider-controls">' +
                '<li><a href="#" class="prev-slide" data-direction="previous">' +
                    '<i class="icon-left"></i></a></li>' +
                '<li><a href="#" class="next-slide" data-direction="next">' +
                    '<i class="icon-right"></i></a></li>' +
                '<li><a href="#" data-stop="stop">' +
                    '<i class="icon-pause"></i></a></li>' +
            '</ul>';
            // append slider controls inside DOM
            // the save a reverence to the object
            navigation = container.append(nav).find('.slider-controls li');
        }
        // create preview slides
        if ( joy_options.preview ) {
            var prev_slides = '<div class="container slides-main-contanier"><div class="slides-tab-nav"><ul class="slides-preview-container">';

            // create preview slides
            slides.each(function(){
                var slide_index = ( jQuery(this).index() < 9 ) ? '0' + (jQuery(this).index() + 1) : jQuery(this).index() + 1; 
                var custom_font = jQuery(this).data('custom-font');
                var meta_categoty = '';
                var meta_likes = '';

                if( typeof(jQuery(this).data('slide-meta-date')) !== 'undefined' ){
                    meta_categoty += '<ul class="entry-meta-date">' +
                                        '<li>' +
                                            jQuery(this).data('slide-meta-date') +
                                        '</li>' +
                                    '</ul>';
                }
                if( typeof(jQuery(this).data('slide-meta-likes')) !== 'undefined' && jQuery(this).data('slide-meta-likes') != 'nolikes' ){

                    var meta_likes_icon = jQuery(this).data('slide-meta-likes-icon');
                    var classActive = (document.cookie.indexOf('touchsize_likes_' + jQuery(this).data('slide-meta-id')) !== -1) ? ' active' : '';
                    meta_likes += '<div class="stream-likes">'+
                                        '<a title="Like this" data-id="touchsize-likes-'+jQuery(this).data('slide-meta-id')+'" class="touchsize-likes' + classActive + '" href="#">'+
                                            '<span class="touchsize-likes-count icon-' + meta_likes_icon + '">' + jQuery(this).data('slide-meta-likes') + '</span>'+
                                            '<span class="touchsize-likes-postfix"></span>'+
                                        '</a>'+
                                        '</div>';
                }

                prev_slides += '<li class="slide-preview">' +
                                    '<div class="progress"></div>' +
                                    '<div class="preview-data">' +
                                        meta_categoty +
                                        '<h4 class="entry-title">' + jQuery(this).data('slide-title') + '</h4>' + meta_likes +
                                    '</div>' +
                                '</li>';
            });

            prev_slides += '</ul></div></div>';
            // insert preview slides inside the DOM and get a reference to the them
            preview_slides = container.append(prev_slides).find('.slide-preview');

            // get slides preview container
            preview_slides_container = preview_slides.parent('.slides-preview-container');

            progress = preview_slides.find('.progress');
        }
        setWidths();
    })();

    // set widths for slides base on container width
    function setWidths() {
        // get slider container width
        container_width = container.width();
        // set slides container width based on number of slider
        slides_container.width(container_width * count_slides);
        // Get the size of the container (of content)
        var content_container = jQuery(container).find('.slides-main-contanier').width();
        // set the width of the slide based on slider container width
        slides.width(container_width);
        // save slide width
        slide_width = container_width;

        if ( joy_options.preview ) {
            // calculate preview slide width
            preview_slide_width = ( (content_container + joy_options.gutter) / 3);
            // set preview slides container width
            preview_slides_container.width( preview_slide_width * count_slides);
            // set slides preview width
            preview_slides.width( preview_slide_width - joy_options.gutter);
            // set preview slide margin right
            preview_slides.css({ 'margin-right': joy_options.gutter + 'px' });

            if ( current > 0)
                var left = 1;
                
                if ( current === slides.size() - 1)
                    left = 2;

                preview_slides_container.css({
                    'left': (preview_slide_width * (current - left) ) * -1 + 'px'
                }, joy_options.speed );
            
            
            previewSlideToggleClass();
        }

        slides.css({
            'left': current * slide_width * -1 + 'px'
        });
    };

    var timeBetweenResize = null;
    
    // calculate again slides width on window resize
    jQuery(window).resize(function () {
        stopTimeout(); 

        clearInterval(timeBetweenResize);
        timeBetweenResize = setTimeout(function(){
            setWidths();

            if ( joy_options.auto && status)
                startTimeout();

        }, 400);
    });

    // enable click events on preview slides click
    if ( joy_options.preview ) {
        preview_slides.on('click', function(){

            if( jQuery(this).index() == current )
                return;

            // set current active slide to the index of the clicked element
            current = jQuery(this).index();
            // change the slides
            changeSlide();
        });
    }

    // enable click events on slider navigation items
    if ( joy_options.nav ) {
        navigation.on('click', 'a', function(event){
            event.preventDefault();
            var context = jQuery(this);

            if(context.data('stop') === 'stop') {

                if(context.hasClass('stop')) {
                    context.removeClass('stop');

                    // add back the icon to stop the slides
                    context.children().removeClass().addClass('icon-pause');
                    
                    // the slide can change automatically when preview slider are clicked
                    status = true;
                    
                    // resume the timer if it was stopped
                    startTimeout();
                }
                else {
                    context.addClass('stop');

                    // the slider is stopped add the icon to start the slider
                    context.children().removeClass().addClass('icon-play');
                    
                    // don't allow changind the slides
                    status = false;

                    transition_complete = true;
                    
                    stopTimeout();
                }
            }

            // Until the transition is completed 
            // don't allow slide change
            if(!transition_complete)
                return;
             
            // go to previous slide
            if ( jQuery(this).data('direction') === 'previous') {
                if ( current === 0 ) {
                    if( !joy_options.loop )
                        return;

                    current = count_slides - 1;
                    changeSlide();
                }
                else {
                    current--;
                    changeSlide();

                }
                transition_complete = false;

            }
            // got to next slide
            else if( jQuery(this).data('direction') === 'next' ) {
                if(current === count_slides - 1) {
                    if ( !joy_options.loop )
                        return;

                    current = 0;
                    changeSlide();
                }
                else {
                    current++;
                    changeSlide();
                }
                transition_complete = false;
            }
        });
    }

    if( joy_options.auto && status ){
        changeSlide();
    }

    // change current slide
    function changeSlide(){
        if(joy_options.auto && status ){
            stopTimeout();
        }

        // disable preview slide transition is there are less then 3 slides
        if(slides.size() > 3) {
            if(clicked === count_slides - 1 && current === 0 && joy_options.preview ) {
                preview_slides_container.animate({
                    'left': '0'
                }, joy_options.speed );
            }

            else if(clicked === 0 && current === count_slides - 1 && joy_options.preview ){
                preview_slides_container.animate({
                    'left': ((count_slides - 3)  * preview_slide_width) * -1 + 'px'
                }, joy_options.speed );
            }

            // slide to right
            if ( clicked <= current ) {
                // change only the slide dont't change preview slide contianer position
                if(current !== count_slides - 1 && current > 1  && joy_options.preview ){
                    preview_slides_container.animate({
                        'left': '+=' + preview_slide_width * -1 + 'px'
                    }, joy_options.speed);
                }
            }
            // slide to left
            else if (clicked >= current ) {
                if( current > 0 && current < count_slides - 2  && joy_options.preview ) {
                    preview_slides_container.animate({
                        'left': '-=' + preview_slide_width * -1 + 'px'
                    }, joy_options.speed );
                }
            }
        }
        slides.animate({
            'left': current * slide_width * -1 + 'px'
        }, {
            queue: false,
            duration: joy_options.speed,
            complete: function() {
                transition_complete = true;
            }
        });

        if ( joy_options.preview ) {
            // toggle active class on the preview slides
            previewSlideToggleClass();
        }

        if( joy_options.auto && status){
            startTimeout();
        }

        clicked = current;
    }

    function previewSlideToggleClass() {
        // remeve active class from slides
        preview_slides.removeClass('slide-preview-active');
        // add active class to clicked slide
        preview_slides.eq(current).addClass('slide-preview-active');
    }

    // create a timer for slides timeout
    function startTimeout(){

        timer = setInterval( function() {
            if ( current === count_slides - 1)
                current = -1;

            current++;
            changeSlide();
        },joy_options.timeout);

        if ( joy_options.preview && joy_options.auto ){
            progress.eq(current).animate({
                "width": "100%"
            }, joy_options.timeout);
        }
    }

    // clear the timer previus created
    function stopTimeout(){
        if ( joy_options.preview && joy_options.auto )
            progress.stop().width(0);
        clearInterval(timer);
        timer = null;
    }
    };
}(jQuery));
