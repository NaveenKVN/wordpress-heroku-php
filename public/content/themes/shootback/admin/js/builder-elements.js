jQuery(document).ready(function($) {

    var builderElements       = $("#builder-elements>div.builder-element"),
    elementType               = $("#ts-element-type"),
    firstBuilderElement       = elementType.find("option:first").val(),

    lastPostsDisplayMode      = $('#last-posts-display-mode-options>div'),
    lastPostsFirstDisplayMode = $("#last-posts-display-mode").find('option:first').val(),

    listGalleriesDisplayMode      = $('#list-galleries-display-mode-options>div'),
    listGalleriesFirstDisplayMode = $("#list-galleries-display-mode").find('option:first').val(),

    latestCustomPostsDisplayMode      = $('#latest-custom-posts-display-mode-options>div'),
    latestCustomPostsFirstDisplayMode = $("#latest-custom-posts-display-mode").find('option:first').val(),

    listVideosDisplayMode      = $('#list-videos-display-mode-options>div'),
    listVideosFirstDisplayMode = $("#list-videos-display-mode").find('option:first').val(),

    listPortfoliosDisplayMode = $('#list-portfolios-display-mode-options>div'),
    listPortfoliosFirstDisplayMode = $("#list-portfolios-display-mode").find('option:first').val();

    // Layout Builder Initialization
    makeSelected(builderElements, firstBuilderElement);
    makeSelected(lastPostsDisplayMode, 'last-posts-' + lastPostsFirstDisplayMode);

    makeSelected(listGalleriesDisplayMode, 'list-galleries-' + listGalleriesFirstDisplayMode);

    makeSelected(latestCustomPostsDisplayMode, 'latest-custom-posts-' + latestCustomPostsFirstDisplayMode);

    makeSelected(listVideosDisplayMode, 'list-videos-' + listVideosFirstDisplayMode);

    makeSelected(listPortfoliosDisplayMode, 'list-portfolios-' + listVideosFirstDisplayMode);

    // read element settings and open editor settings for selected element
    readElementProperties(window.currentEditedElement);

    // Show selected element from builderElements and hide the rest
    function makeSelected (builderElements, selected) {
        $.each(builderElements, function(index, el) {
            var element = $(el);
            if (element.hasClass(selected)) {
                element.removeClass('hidden');
            } else {
                if(!element.hasClass('hidden')) {
                    element.addClass('hidden');
                }
            }
        });
        if( jQuery('li[data-value="'+selected+'"]').parent().parent().attr('class') == 'builder-element-array' ){
            jQuery('.builder-element-array ul li.selected').removeClass('selected');
            jQuery('.builder-element-array ul li[data-value="'+selected+'"]').addClass('selected');

            var categoryTab = jQuery('.builder-element-array ul li[data-value="' + selected + '"]').attr('data-ts-tab-element');

            jQuery('.ts-tab-elements li.selected').removeClass('selected');

            jQuery('.ts-tab-elements li[data-ts-tab="' + categoryTab + '"]').addClass('selected');

            jQuery('.builder-element-array li').each(function(){
                if( selected !== 'empty' ){
                    if( jQuery(this).attr('data-ts-tab-element') == categoryTab ){
                        jQuery(this).css('display', '');
                    }else{
                        jQuery(this).css('display', 'none');
                    }
                }else{
                    jQuery(this).css('display', '');
                }
            });
        }
    }

    jQuery(document).on('click', '.ts-tab-elements li', function(){
        var categoryTab = jQuery(this).attr('data-ts-tab');
        jQuery('.ts-tab-elements li.selected').removeClass('selected');
        jQuery('.builder-element-array li.selected').removeClass('selected');
        jQuery(this).addClass('selected');

        jQuery('.builder-element').addClass('hidden');
        jQuery('.builder-element-array li').each(function(){
            if( jQuery(this).attr('data-ts-tab-element') == categoryTab ){
                jQuery(this).css('display', '');
            }else{
                jQuery(this).css('display', 'none');
            }
            if( categoryTab == 'ts-all-tab' ){
                jQuery(this).css('display', '');
            }
        });
    });

    // Elements Editor -> Change Element Type
    $(document).on("change", "#ts-element-type", function(event) {
        var selected = $(this).val();
        makeSelected(builderElements, selected);
    });

    // Lists Portfolios -> How to display
    $(document).on("change", "#list-portfolios-display-mode", function(event) {
        var selected = 'list-portfolios-' + $(this).val();
        makeSelected(listPortfoliosDisplayMode, selected);
    });

    // Lists Posts -> How to display
    $(document).on("change", "#last-posts-display-mode", function(event) {
        var selected = 'last-posts-' + $(this).val();
        makeSelected(lastPostsDisplayMode, selected);
    });

    $(document).on("change", "#list-galleries-display-mode", function(event) {
        var selected = 'list-galleries-' + $(this).val();
        makeSelected(listGalleriesDisplayMode, selected);
    });

    $(document).on("change", "#latest-custom-posts-display-mode", function(event) {
        var selected = 'latest-custom-posts-' + $(this).val();
        makeSelected(latestCustomPostsDisplayMode, selected);
    });

    // List Videos -> How to display
    $(document).on("change", "#list-videos-display-mode", function(event) {
        var selected = 'list-videos-' + $(this).val();
        makeSelected(listVideosDisplayMode, selected);
    });

    // read "data-*" properties and transform them to object
    function readElementProperties (element) {

        var elementType = element.attr('data-element-type'),
            listOfElements = $('#ts-element-type'),
            elementsOptions = $('.builder-elements');

        // slider
        var sliderID = function (element) {
            return (element.attr('data-slider-id') > 0) ? element.attr('data-slider-id') : 0 ;
        };

        // ------- Funtions for parsing element display mode options ------------------------------

        // Enable carousel mode
        var enableCarousel = function (element) {

            var validValues     = ['y', 'n'],
                enableCarousel  = element.attr('data-enable-carousel');

            return ($.inArray(enableCarousel, validValues) > -1) ?
                                    enableCarousel : 'n';
        };

        // How to display title
        var displayTitle = function (element) {
            // Display title variants
            var displayTitleVariants = ['title-above-image', 'title-below-image'];

            // How to display Title
            var displayTitle = element.attr('data-display-title');

            return ($.inArray(displayTitle, displayTitleVariants) > -1) ?
                                    displayTitle : 'title-above-image';
        };

        // Show Meta
        var showMeta = function (element) {
            var showMeta = element.attr('data-show-meta'),
                showMetaVariants = ['y', 'n'];
            return ($.inArray(showMeta, showMetaVariants) > -1) ? showMeta : 'y';
        };

        var showMetaThumbnail = function (element) {
            var showMeta = element.attr('data-meta-thumbnail'),
                showMetaVariants = ['y', 'n'];
            return ($.inArray(showMeta, showMetaVariants) > -1) ? showMeta : 'y';
        };

        // Show Label
        var showLabel = function (element) {
            var showLabel = element.attr('data-show-label'),
                showLabelVariants = ['y', 'n'];
            return ($.inArray(showLabel, showLabelVariants) > -1) ? showLabel : 'y';
        };

        // Nuber of elements per row
        var elementsPerRow = function (element) {
            var elementsPerRow = element.attr('data-elements-per-row');
            return ( elementsPerRow > 12 || elementsPerRow < 0 ) ? 1 : elementsPerRow;
        };

        // Limit number of posts
        var postsLimit = function (element) {
            var postsLimit = element.attr('data-posts-limit');
            return (postsLimit < -1 || postsLimit > 102) ? 9 : postsLimit;
        };

        // Limit number of posts
        var imageHeight = function (element) {
            var imageHeight = element.attr('data-height');
            return (imageHeight < -1 || imageHeight >= 4000) ? 585 : imageHeight;
        };

        // Order posts by
        var orderBy = function (element) {
            var orderBy = element.attr('data-order-by'),
                orderByVariants = ['comments', 'date', 'views', 'likes', 'start-date'];

            return ($.inArray(orderBy, orderByVariants) != -1 ) ?  orderBy : 'date';
        };

        // Order direction
        var orderDirection = function (element) {
            var orderDirection = element.attr('data-order-direction'),
                orderDirectionVariants = ['asc', 'desc'];

            return ($.inArray(orderDirection, orderDirectionVariants) != -1) ? orderDirection : 'desc';
        };

        // Show image
        var imageShow = function (element) {
            var imageShow = element.attr('data-image'),
                imageShowVariants = ['y', 'n'];

            return ($.inArray(imageShow, imageShowVariants) != -1) ? imageShow : 'n';
        };

        // Enable number of row
        var numberRow = function (element) {
            var numberRow = element.attr('data-rows'),
                numberRowVariants = ['2', '3'];

            return ($.inArray(numberRow, numberRowVariants) != -1) ? numberRow : '2';
        };

        // Change effects to scroll
        var effectsScrollMosaic = function (element) {
            var effectsScrollMosaic = element.attr('data-effects-scroll'),
                effectsScrollMosaicVariants = ['default', 'fade'];

            return ($.inArray(effectsScrollMosaic, effectsScrollMosaicVariants) != -1) ? effectsScrollMosaic : 'fade';
        };

        var layoutMosaic = function (element) {
            var layoutMosaic = element.attr('data-layout'),
                layoutMosaicVariants = ['rectangles', 'square'];

            return ($.inArray(layoutMosaic, layoutMosaicVariants) != -1) ? layoutMosaic : 'square';
        };

        // Enable number of row
        var displayScroll = function (element) {
            var displayScroll = element.attr('data-scroll'),
                displayScrollVariants = ['y', 'n'];

            return ($.inArray(displayScroll, displayScrollVariants) != -1) ? displayScroll : 'n';
        };

        //Pagination enable
        var enablePagination = function (element) {
            var enablePagination = element.attr('data-pagination'),
                enablePaginationVariants = ['n', 'y', 'load-more', 'infinite'];

            return ($.inArray(enablePagination, enablePaginationVariants) != -1) ? enablePagination : 'n';
        };

        var imagePosition = function (element) {
            var imagePosition = element.attr('data-image-position'),
                imagePositionVariants = ['left', 'right', 'mosaic'];

            return ($.inArray(imagePosition, imagePositionVariants) != -1) ? imagePosition : 'left';
        };

        var showExcerpt = function (element) {
            var showExcerpt = element.attr('data-excerpt'),
                showExcerptVariants = ['y', 'n'];

            return ($.inArray(showExcerpt, showExcerptVariants) != -1) ? showExcerpt : 'y';
        };

        //Pagination enable
        var showRelated = function (element) {
            var showRelated = element.attr('data-related-posts'),
                showRelatedVariants = ['n', 'y'];

            return ($.inArray(showRelated, showRelatedVariants) != -1) ? showRelated : 'n';
        };
        // Image split
        var imageSplit = function (element) {
            var imageSplit = element.attr('data-image-split');

            return (imageSplit < 1 && imageSplit > 11) ? 4 : imageSplit;
        };

        // Content split
        var contentSplit = function (element) {
            var contentSplit = element.attr('data-content-split');

            return (contentSplit < 1 && contentSplit > 11) ? 4 : contentSplit;
        };

        var showRelatedPosts = function (element) {
            var showRelatedPosts = element.attr('data-related-posts'),
                showRelatedPostsVariants = ['y', 'n'];

            return ($.inArray(showRelatedPosts, showRelatedPostsVariants) != -1) ? showRelatedPosts : 'y';
        };

        var specialEffects = function (element) {
            var specialEffects = element.attr('data-special-effects'),
                specialEffectsVariation = ['none', 'opacited', 'rotate-in', '3dflip', 'scaler'];

            return ($.inArray(specialEffects, specialEffectsVariation) != -1) ? specialEffects : 'none';
        };

        var gutter = function (element) {
            var gutter = element.attr('data-gutter'),
                gutterVariation = ['n', 'y'];

            return ($.inArray(gutter, gutterVariation) != -1) ? gutter : 'n';
        };

        // -------------------------- Call to action functions ------------------------------
        var callactionText = function (element) {
            return element.attr('data-callaction-text');
        };

        var callactionLink = function (element) {
            return (element.attr('data-callaction-link')) ? element.attr('data-callaction-link') : '';
        };

        var callactionButtonText = function (element) {
            return (element.attr('data-callaction-button-text')) ? element.attr('data-callaction-button-text') : '';
        };

        // ---------------------------- Advertising --------------------------------------

        var advertising = function (element) {
            return element.attr('data-advertising');
        };

        // ---------------------------- Delimiter ---------------------------------------

        var delimiterType = function (element) {
            var delimiterType = element.attr('data-delimiter-type'),
                delimiterVariants = [
                    'dotsslash',
                    'doubleline',
                    'lines',
                    'squares',
                    'gradient',
                    'line',
                    'iconed icon-close'
                ];

            return ($.inArray(delimiterType, delimiterVariants) != -1) ? delimiterType : 'line';
        };

        var titleStyle = function (element) {
            var elementStyle = element.attr('data-style'),
                styles = [
                    'title-icon',
                    'lineariconcenter',
                    '2lines',
                    'simpleleft',
                    'lineafter',
                    'linerect',
                    'leftrect',
                    'simplecenter'
                ];

            return ($.inArray(elementStyle, styles) != -1) ? elementStyle : 'simpleleft';
        };

        var titleSizes= function (element) {
            var elementSize = element.attr('data-size'),
                sizes = [
                    'h1',
                    'h2',
                    'h3',
                    'h4',
                    'h5',
                    'h6'
                ];

            return ($.inArray(elementSize, sizes) != -1) ? elementSize : 'h1';
        };


        // ---------------------------- Page -----------------------------------------------

        var pageID = function (element) {
            return element.attr('data-page-id');
        };

        // ---------------------------- Post ------------------------------------------------

        var postID = function (element) {
            return element.attr('data-post-id');
        };

        var menuStyle = function (element) {
            return element.attr('data-element-style');
        };

        var getSidebarID = function (element) {
            return element.attr('data-sidebar-id');
        };


        if (elementType === 'logo') {

            dataAttr = {};
            dataAttr['element-type'] = 'logo';

            listOfElements.find('option[value="logo"]').attr("selected", "selected");

            var logoOptions = builderElements.filter(function(index){
                return $(this).hasClass('logo');
            });

            logoOptions.find('#logo-align').val(element.attr('data-logo-align'));
            makeSelected(builderElements, 'logo');

        } else if (elementType === 'social-buttons') {

            dataAttr = {};
            dataAttr['element-type'] = 'social-buttons';
            listOfElements.find('option[value="social-buttons"]').attr("selected", "selected");

            var socialOptions = builderElements.filter(function(index){
                return $(this).hasClass('social-buttons');
            });
            socialOptions.find('#social_content').val(element.attr('data-social-settings'));
            socialOptions.find('#social-align').val(element.attr('data-social-align'));
            socialOptions.find('#social-buttons-admin-label').val(element.attr('data-admin-label'));
            makeSelected(builderElements, 'social-buttons');

        } else if (elementType === 'cart') {

            dataAttr = {};
            dataAttr['element-type'] = 'cart';

            listOfElements.find('option[value="cart"]').attr("selected", "selected");
            makeSelected(builderElements, 'cart');

            var cartOptions = builderElements.filter(function(index){
                return $(this).hasClass('cart');
            });

            cartOptions.find('#cart-align').val(element.attr('data-cart-align'));


        } else if (elementType === 'breadcrumbs') {

            dataAttr = {};
            dataAttr['element-type'] = 'breadcrumbs';

            listOfElements.find('option[value="breadcrumbs"]').attr("selected", "selected");

            var breadcrumbsOptions = builderElements.filter(function(index){
                return $(this).hasClass('breadcrumbs');
            });

            makeSelected(builderElements, 'breadcrumbs');

        } else if (elementType === 'searchbox') {

            listOfElements.find('option[value="searchbox"]').attr("selected", "selected");

            var searchboxOptions = builderElements.filter(function(index){
                return $(this).hasClass('searchbox');
            });

            searchboxOptions.find("#searchbox-align").val(element.attr('data-align'));
            makeSelected(builderElements, 'searchbox');

        } else if (elementType === 'menu') {

            listOfElements.find('option[value="menu"]').attr("selected", "selected");
            makeSelected(builderElements, 'menu');

            var menuOptions = builderElements.filter(function(index){
                return $(this).hasClass('menu');
            }), menuID = menuStyle(element);


            menuOptions.find('#menu-styles option[value="' + menuID + '"]').attr("selected", "selected");
            menuOptions.find("#menu-custom[value="+element.attr('data-menu-custom')+"]").attr('checked','checked');
            menuOptions.find("#menu-element-bg-color").val(element.attr('data-menu-bg-color'));
            menuOptions.find("#menu-element-text-color").val(element.attr('data-menu-text-color'));
            menuOptions.find("#menu-element-bg-color-hover").val(element.attr('data-menu-bg-color-hover'));
            menuOptions.find("#menu-element-text-color-hover").val(element.attr('data-menu-text-color-hover'));
            menuOptions.find("#menu-element-submenu-bg-color").val(element.attr('data-submenu-bg-color'));
            menuOptions.find("#menu-element-submenu-text-color").val(element.attr('data-submenu-text-color'));
            menuOptions.find("#menu-element-submenu-bg-color-hover").val(element.attr('data-submenu-bg-color-hover'));
            menuOptions.find("#menu-element-submenu-text-color-hover").val(element.attr('data-submenu-text-color-hover'));
            menuOptions.find("#menu-admin-label").val(element.attr('data-admin-label'));
            menuOptions.find("#menu-text-align").val(element.attr('data-menu-text-align'));
            menuOptions.find("#menu-uppercase").val(element.attr('data-uppercase'));
            menuOptions.find("#menu-name").val(element.attr('data-name'));
            menuOptions.find("#menu-description").val(element.attr('data-description'));
            menuOptions.find("#menu-icons").val(element.attr('data-icons'));


            if (jQuery('.colors-section-picker-div').length) {

                if ( element.attr('data-menu-custom') == 'yes' ) {
                    jQuery('.menu-custom-colors').removeClass('hidden');
                } else{
                    jQuery('.menu-custom-colors').addClass('hidden');
                }
            }

        } else if (elementType === 'sidebar') {

            listOfElements.find('option[value="sidebar"]').attr("selected", "selected");
            makeSelected(builderElements, 'sidebar');

            var sidebarOptions = builderElements.filter(function(index){
                return $(this).hasClass('sidebar');
            }), sidebarID = getSidebarID(element);

            sidebarOptions.find('#ts_sidebar_sidebars option[value="' + sidebarID + '"]').attr("selected", "selected");
            sidebarOptions.find("#sidebar-admin-label").val(element.attr('data-admin-label'));

        } else if (elementType === 'slider') {

            listOfElements.find('option[value="slider"]').attr("selected", "selected");
            makeSelected(builderElements, 'slider');

            var sliderOptions = builderElements.filter(function(index){
                return $(this).hasClass('slider');
            }), slider_id = sliderID(element);

            sliderOptions.find('#slider-name option[value="' + slider_id + '"]').attr("selected", "selected");
            sliderOptions.find("#slider-admin-label").val(element.attr('data-admin-label'));

        } else if (elementType === 'image-carousel') {

            listOfElements.find('option[value="image-carousel"]').attr("selected", "selected");

            var carouselOptions = builderElements.filter(function(index){
                return $(this).hasClass('image-carousel');
            });

            carouselOptions.find('#carousel_image_gallery').val(element.attr('data-images'));
            carouselOptions.find('#carousel_height').val(element.attr('data-carousel-height'));
            carouselOptions.find("#image-carousel-admin-label").val(element.attr('data-admin-label'));

            makeSelected(builderElements, 'image-carousel');

        } else if (elementType === 'list-portfolios') {

            var listPortfoliosOptions = builderElements.filter(function(index){
                return $(this).hasClass('list-portfolios');
            }), category;

            listPortfoliosOptions.find('option[selected="selected"]').removeAttr('selected');

            listOfElements.find('option[value="list-portfolios"]').attr("selected", "selected");
            listPortfoliosOptions.find("#list-portfolios-admin-label").val(element.attr('data-admin-label'));

            category = element.attr('data-category') ? element.attr('data-category').split(',') : [];

            listPortfoliosOptions.find('#list-portfolios-category option').each(function(index, el) {
                var element = $(el);

                if ( $.inArray(element.val(), category) > -1 ) {
                    element.attr("selected", "selected");
                }
            });

            // How to display last posts
            var displayModeVariants = ['grid', 'list', 'thumbnails', 'big-post', 'super-post'],
                displayMode = element.attr('data-display-mode');

            displayMode = ($.inArray(displayMode, displayModeVariants) > -1) ? displayMode : 'grid';
            listPortfoliosOptions.find('#list-portfolios-display-mode option[value="' +  displayMode + '"]').attr("selected", "selected");
            makeSelected(listPortfoliosDisplayMode, 'list-portfolios-' + displayMode);

            if (displayMode === 'grid') {
                listPortfoliosOptions.find('#list-portfolios-grid-behavior option[value="' +  element.attr('data-behavior') + '"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-grid-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-grid-show-meta-' + showMeta(element)).attr("checked", "checked");
                listPortfoliosOptions.find('#list-portfolios-grid-el-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-grid-nr-of-posts').val(postsLimit(element));
                listPortfoliosOptions.find('#list-portfolios-grid-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-grid-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-grid-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");

            } else if (displayMode === 'list') {
                listPortfoliosOptions.find('#list-portfolios-list-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-list-show-meta-' + showMeta(element)).attr("checked", "checked");
                listPortfoliosOptions.find('#list-portfolios-list-nr-of-posts').val(postsLimit(element));
                listPortfoliosOptions.find('#list-portfolios-list-image-split option[value="'+imageSplit(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-list-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-list-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-list-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");

            } else if (displayMode === 'thumbnails') {
                listPortfoliosOptions.find('#list-portfolios-thumbnail-title option[value="' + element.attr('data-display-title')  + '"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-thumbnail-behavior option[value="'+element.attr('data-behavior')+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-thumbnail-posts-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-thumbnail-limit').val(postsLimit(element));
                listPortfoliosOptions.find('#list-portfolios-thumbnail-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-thumbnail-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-thumbnail-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-thumbnail-gutter option[value="'+gutter(element)+'"]').attr("selected", "selected");

            } else if (displayMode === 'big-post') {

                listPortfoliosOptions.find('#list-portfolios-big-post-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-big-post-show-meta-' + showMeta(element)).attr("checked", "checked");
                listPortfoliosOptions.find('#list-portfolios-big-post-nr-of-posts').val(postsLimit(element));
                listPortfoliosOptions.find('#list-portfolios-big-post-split option[value="'+imageSplit(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-big-post-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-big-post-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-big-post-show-related-' + showRelatedPosts(element)).attr("checked", "checked");
                listPortfoliosOptions.find('#list-portfolios-big-post-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");

            } else if (displayMode === 'super-post') {

                listPortfoliosOptions.find('#list-portfolios-super-post-posts-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-super-post-limit').val(postsLimit(element));
                listPortfoliosOptions.find('#list-portfolios-super-post-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-super-post-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listPortfoliosOptions.find('#list-portfolios-super-post-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");

            } else {

                e['display-title'] = 'above-image';
                e['show-meta'] = 'y';
                e['elements-per-row'] = 3;
                e['posts-limit'] = 9;
                e['order-by'] = 'date';
                e['order-direction'] = 'desc';
                e['special-effects'] = 'none';
                e['pagination'] = 'n';
            }
            makeSelected(builderElements, 'list-portfolios');

        } else if (elementType === 'tab') {

            dataAttr = {};
            dataAttr['element-type'] = 'tab';

            var TabOptions = builderElements.filter(function(index){
                return $(this).hasClass('tab');
            });

            listOfElements.find('option[value="tab"]').attr("selected", "selected");
            makeSelected(builderElements, 'tab');
            TabOptions.find('#tab_content').val(element.attr('data-tab'));
            TabOptions.find("#tab-admin-label").val(element.attr('data-admin-label'));
            TabOptions.find("#tab-mode").val(element.attr('data-mode'));


        } else if (elementType === 'video-carousel') {

            dataAttr = {};
            dataAttr['element-type'] = 'video-carousel';

            var videoCarousel = builderElements.filter(function(index){
                return $(this).hasClass('video-carousel');
            });

            listOfElements.find('option[value="video-carousel"]').attr("selected", "selected");
            makeSelected(builderElements, 'video-carousel');
            videoCarousel.find('#video-carousel_content').val(element.attr('data-video-carousel'));
            videoCarousel.find("#video-carousel-admin-label").val(element.attr('data-admin-label'));
            videoCarousel.find("#video-carousel-source").val(element.attr('data-source'));

        } else if (elementType === 'count-down') {

            dataAttr = {};
            dataAttr['element-type'] = 'count-down';

            var countDown = builderElements.filter(function(index){
                return $(this).hasClass('count-down');
            });

            listOfElements.find('option[value="count-down"]').attr("selected", "selected");
            makeSelected(builderElements, 'count-down');
            countDown.find("#count-down-admin-label").val(element.attr('data-admin-label'));
            countDown.find("#count-down-title").val(element.attr('data-title'));
            countDown.find("#count-down-date").val(element.attr('data-date'));
            countDown.find("#count-down-hours").val(element.attr('data-hours'));
            countDown.find("#count-down-style").val(element.attr('data-style'));

        } else if (elementType === 'testimonials') {

            dataAttr = {};
            dataAttr['element-type'] = 'testimonials';

            var TestimonialsOptions = builderElements.filter(function(index){
                return $(this).hasClass('testimonials');
            });

            listOfElements.find('option[value="testimonials"]').attr("selected", "selected");
            makeSelected(builderElements, 'testimonials');
            TestimonialsOptions.find('#testimonials-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");

            TestimonialsOptions.find('#testimonials_content').val(element.attr('data-testimonials'));

            TestimonialsOptions.find('#testimonials-enable-carousel option[value="' +  element.attr('data-enable-carousel') + '"]').attr("selected", "selected");
            TestimonialsOptions.find("#testimonials-admin-label").val(element.attr('data-admin-label'));

        } else if (elementType === 'skills') {

            var skillsOptions = builderElements.filter(function(index){
                return $(this).hasClass('skills');
            });

            listOfElements.find('option[value="skills"]').attr("selected", "selected");
            makeSelected(builderElements, 'skills');
            skillsOptions.find("#skills-admin-label").val(element.attr('data-admin-label'));
            skillsOptions.find("#skills-display-mode").val(element.attr('data-display-mode'));
            skillsOptions.find('#skills_content').val(element.attr('data-skills'));

        } else if (elementType === 'list-products') {

            var listProductsOptions = builderElements.filter(function(index){
                return $(this).hasClass('list-products');
            }), category;

            listOfElements.find('option[value="list-products"]').attr("selected", "selected");
            listProductsOptions.find('option[selected="selected"]').removeAttr('selected');
            makeSelected(builderElements, 'list-products');

            listProductsOptions.find("#list-products-admin-label").val(element.attr('data-admin-label'));
            category = element.attr('data-category') ? element.attr('data-category').split(',') : [];

            listProductsOptions.find('#list-products-category option').each(function(index, el) {
                var element = $(el);

                if ($.inArray(element.val(), category) > -1) {
                    element.attr("selected", "selected");
                }
            });

            listProductsOptions.find('#list-products-behavior option[value="'+element.attr('data-behavior')+'"]' ).attr("selected", "selected");
            listProductsOptions.find('#list-products-el-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
            listProductsOptions.find('#list-products-nr-of-posts').val(postsLimit(element));
            listProductsOptions.find('#list-products-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
            listProductsOptions.find('#list-products-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
            listProductsOptions.find('#list-products-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
            listProductsOptions.find("#list-products-admin-label").val(element.attr('data-admin-label'));


        } else if (elementType === 'last-posts') {

            var lastPostsOptions = builderElements.filter(function(index){
                return $(this).hasClass('last-posts');
            }), category;

            listOfElements.find('option[value="last-posts"]').attr("selected", "selected");
            lastPostsOptions.find('option[selected="selected"]').removeAttr('selected');

            lastPostsOptions.find('#last-posts-exclude').val(element.attr('data-id-exclude'));
            lastPostsOptions.find('#last-posts-exclude-first').val(element.attr('data-exclude-first'));
            lastPostsOptions.find("#last-posts-admin-label").val(element.attr('data-admin-label'));
            lastPostsOptions.find("#last-posts-featured").val(element.attr('data-featured'));

            category = element.attr('data-category') ? element.attr('data-category').split(',') : [];

            lastPostsOptions.find('#last-posts-category option').each(function(index, el) {
                var elem = $(el);

                if ($.inArray(elem.val(), category) > -1) {
                    elem.attr("selected", "selected");
                }
            });

            // How to display last posts
            var displayModeVariants = ['grid', 'list', 'thumbnails', 'big-post', 'super-post', 'timeline', 'mosaic'],
                displayMode = element.attr('data-display-mode');

            displayMode = ($.inArray(displayMode, displayModeVariants) > -1) ? displayMode : 'grid';
            lastPostsOptions.find('#last-posts-display-mode option[value="' +  displayMode + '"]').attr("selected", "selected");
            makeSelected(lastPostsDisplayMode, 'last-posts-' + displayMode);

            if (displayMode === 'grid') {
                lastPostsOptions.find('#last-posts-grid-behavior option[value="'+element.attr('data-behavior')+'"]' ).attr("selected", "selected");
                lastPostsOptions.find('#last-posts-grid-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-grid-show-meta-' + showMeta(element)).attr("checked", "checked");
                lastPostsOptions.find('#last-posts-grid-el-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-grid-nr-of-posts').val(postsLimit(element));
                lastPostsOptions.find('#last-posts-grid-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-grid-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-grid-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-grid-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-grid-related option[value="'+showRelated(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-grid-image option[value="'+element.attr('data-show-image')+'"]' ).attr("selected", "selected");
                ts_show_post_exclude_first('last-posts', 'grid');

            } else if (displayMode === 'list') {
                lastPostsOptions.find('#last-posts-list-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-list-show-meta-' + showMeta(element)).attr("checked", "checked");
                lastPostsOptions.find('#last-posts-list-nr-of-posts').val(postsLimit(element));
                lastPostsOptions.find('#last-posts-list-image-split option[value="'+imageSplit(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-list-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-list-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-list-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-list-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-list-image option[value="'+element.attr('data-show-image')+'"]' ).attr("selected", "selected");
                ts_show_post_exclude_first('last-posts', 'list');

            } else if (displayMode === 'thumbnails') {
                lastPostsOptions.find('#last-posts-thumbnail-title option[value="' +  element.attr('data-display-title') + '"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-thumbnails-behavior option[value="'+element.attr('data-behavior')+'"]' ).attr("selected", "selected");
                lastPostsOptions.find('#last-posts-thumbnail-posts-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-thumbnail-limit').val(postsLimit(element));
                lastPostsOptions.find('#last-posts-thumbnail-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-thumbnails-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-thumbnail-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-thumbnail-gutter option[value="'+gutter(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-thumbnail-show-meta-' + showMetaThumbnail(element)).attr("checked", "checked");
                lastPostsOptions.find('#last-posts-thumbnails-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                ts_show_post_exclude_first('last-posts', 'thumbnails');

            } else if (displayMode === 'big-post') {

                lastPostsOptions.find('#last-posts-big-post-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-big-post-show-meta-' + showMeta(element)).attr("checked", "checked");
                lastPostsOptions.find('#last-posts-big-post-nr-of-posts').val(postsLimit(element));
                lastPostsOptions.find('#last-posts-big-post-image-split option[value="'+imageSplit(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-big-post-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-big-post-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-big-post-related option[value="'+showRelated(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-big-post-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-big-post-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-big-post-image-position option[value="'+imagePosition(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-big-post-excerpt option[value="'+showExcerpt(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-big-post-carousel option[value="'+element.attr('data-carousel')+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-big-post-image option[value="'+element.attr('data-show-image')+'"]' ).attr("selected", "selected");
                ts_show_post_exclude_first('last-posts', 'big-post');

            } else if (displayMode === 'super-post') {

                lastPostsOptions.find('#last-posts-super-post-posts-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-super-post-limit').val(postsLimit(element));
                lastPostsOptions.find('#last-posts-super-post-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-super-post-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-super-post-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-super-post-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                ts_show_post_exclude_first('last-posts', 'super-post');

            } else if (displayMode === 'timeline') {
                lastPostsOptions.find('#last-posts-timeline-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-timeline-show-meta-' + showMeta(element)).attr("checked", "checked");
                lastPostsOptions.find('#last-posts-timeline-post-limit').val(postsLimit(element));
                lastPostsOptions.find('#last-posts-timeline-image option[value="'+imageShow(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-timeline-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-timeline-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-timeline-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                ts_show_post_exclude_first('last-posts', 'timeline');

            } else if (displayMode === 'mosaic') {
                lastPostsOptions.find('#last-posts-mosaic-rows option[value="'+numberRow(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-mosaic-scroll option[value="'+displayScroll(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-mosaic-effects option[value="'+effectsScrollMosaic(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-mosaic-layout option[value="'+layoutMosaic(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-mosaic-gutter option[value="'+gutter(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-mosaic-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-mosaic-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                lastPostsOptions.find('#last-posts-mosaic-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");

                if( layoutMosaic(element) == 'rectangles' ){
                    lastPostsOptions.find('#last-posts-mosaic-post-limit-rows-' + numberRow(element)).val(postsLimit(element));
                }else{
                    lastPostsOptions.find('#last-posts-mosaic-post-limit-rows-squares').val(postsLimit(element));
                }

                ts_show_post_exclude_first('last-posts', 'mosaic');

            } else {

                e['display-title'] = 'above-image';
                e['show-meta'] = 'y';
                e['elements-per-row'] = 3;
                e['posts-limit'] = 9;
                e['order-by'] = 'date';
                e['order-direction'] = 'desc';
                e['special-effects'] = 'none';
                e['image'] = 'n';
                e['layout'] = 'rectangles-gutter';
                e['height'] = '585';
                e['gutter'] = 'y';
                e['effects-scroll'] = 'fade';
                e['rows'] = '2';
            }
            makeSelected(builderElements, 'last-posts');

        } else if (elementType === 'list-galleries') {

            var listGalleriesOptions = builderElements.filter(function(index){
                return $(this).hasClass('list-galleries');
            }), category;

            listOfElements.find('option[value="list-galleries"]').attr("selected", "selected");
            listGalleriesOptions.find('option[selected="selected"]').removeAttr('selected');

            listGalleriesOptions.find('#list-galleries-exclude').val(element.attr('data-id-exclude'));
            listGalleriesOptions.find('#list-galleries-exclude-first').val(element.attr('data-exclude-first'));
            listGalleriesOptions.find("#list-galleries-admin-label").val(element.attr('data-admin-label'));
            listGalleriesOptions.find("#list-galleries-featured").val(element.attr('data-featured'));

            category = element.attr('data-category') ? element.attr('data-category').split(',') : [];

            listGalleriesOptions.find('#list-galleries-category option').each(function(index, el) {
                var elem = $(el);

                if ($.inArray(elem.val(), category) > -1) {
                    elem.attr("selected", "selected");
                }
            });

            // How to display last posts
            var displayModeVariants = ['grid', 'list', 'thumbnails', 'big-post', 'super-post', 'timeline', 'mosaic'],
                displayMode = element.attr('data-display-mode');

            displayMode = ($.inArray(displayMode, displayModeVariants) > -1) ? displayMode : 'grid';
            listGalleriesOptions.find('#list-galleries-display-mode option[value="' +  displayMode + '"]').attr("selected", "selected");
            makeSelected(listGalleriesDisplayMode, 'list-galleries-' + displayMode);

            if (displayMode === 'grid') {
                listGalleriesOptions.find('#list-galleries-grid-behavior option[value="'+element.attr('data-behavior')+'"]' ).attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-grid-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-grid-show-meta-' + showMeta(element)).attr("checked", "checked");
                listGalleriesOptions.find('#list-galleries-grid-el-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-grid-nr-of-posts').val(postsLimit(element));
                listGalleriesOptions.find('#list-galleries-grid-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-grid-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-grid-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-grid-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-grid-related option[value="'+showRelated(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-grid-image option[value="'+element.attr('data-show-image')+'"]' ).attr("selected", "selected");
                ts_show_post_exclude_first('list-galleries', 'grid');

            } else if (displayMode === 'list') {
                listGalleriesOptions.find('#list-galleries-list-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-list-show-meta-' + showMeta(element)).attr("checked", "checked");
                listGalleriesOptions.find('#list-galleries-list-nr-of-posts').val(postsLimit(element));
                listGalleriesOptions.find('#list-galleries-list-image-split option[value="'+imageSplit(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-list-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-list-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-list-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-list-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-list-image option[value="'+element.attr('data-show-image')+'"]' ).attr("selected", "selected");
                ts_show_post_exclude_first('list-galleries', 'list');

            } else if (displayMode === 'thumbnails') {
                listGalleriesOptions.find('#list-galleries-thumbnail-title option[value="' +  element.attr('data-display-title') + '"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-thumbnails-behavior option[value="'+element.attr('data-behavior')+'"]' ).attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-thumbnail-posts-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-thumbnail-limit').val(postsLimit(element));
                listGalleriesOptions.find('#list-galleries-thumbnail-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-thumbnails-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-thumbnail-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-thumbnail-gutter option[value="'+gutter(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-thumbnail-show-meta-' + showMetaThumbnail(element)).attr("checked", "checked");
                listGalleriesOptions.find('#list-galleries-thumbnails-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                ts_show_post_exclude_first('list-galleries', 'thumbnails');

            } else if (displayMode === 'big-post') {

                listGalleriesOptions.find('#list-galleries-big-post-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-big-post-show-meta-' + showMeta(element)).attr("checked", "checked");
                listGalleriesOptions.find('#list-galleries-big-post-nr-of-posts').val(postsLimit(element));
                listGalleriesOptions.find('#list-galleries-big-post-image-split option[value="'+imageSplit(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-big-post-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-big-post-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-big-post-related option[value="'+showRelated(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-big-post-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-big-post-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-big-post-image-position option[value="'+imagePosition(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-big-post-excerpt option[value="'+showExcerpt(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-big-post-carousel option[value="'+element.attr('data-carousel')+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-big-post-image option[value="'+element.attr('data-show-image')+'"]' ).attr("selected", "selected");
                ts_show_post_exclude_first('list-galleries', 'big-post');

            } else if (displayMode === 'super-post') {

                listGalleriesOptions.find('#list-galleries-super-post-posts-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-super-post-limit').val(postsLimit(element));
                listGalleriesOptions.find('#list-galleries-super-post-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-super-post-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-super-post-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-super-post-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                ts_show_post_exclude_first('list-galleries', 'super-post');

            } else if (displayMode === 'timeline') {
                listGalleriesOptions.find('#list-galleries-timeline-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-timeline-show-meta-' + showMeta(element)).attr("checked", "checked");
                listGalleriesOptions.find('#list-galleries-timeline-post-limit').val(postsLimit(element));
                listGalleriesOptions.find('#list-galleries-timeline-image option[value="'+imageShow(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-timeline-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-timeline-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-timeline-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                ts_show_post_exclude_first('list-galleries', 'timeline');

            } else if (displayMode === 'mosaic') {
                listGalleriesOptions.find('#list-galleries-mosaic-rows option[value="'+numberRow(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-mosaic-scroll option[value="'+displayScroll(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-mosaic-effects option[value="'+effectsScrollMosaic(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-mosaic-layout option[value="'+layoutMosaic(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-mosaic-gutter option[value="'+gutter(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-mosaic-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-mosaic-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listGalleriesOptions.find('#list-galleries-mosaic-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");

                if( layoutMosaic(element) == 'rectangles' ){
                    listGalleriesOptions.find('#list-galleries-mosaic-post-limit-rows-' + numberRow(element)).val(postsLimit(element));
                }else{
                    listGalleriesOptions.find('#list-galleries-mosaic-post-limit-rows-squares').val(postsLimit(element));
                }

                ts_show_post_exclude_first('list-galleries', 'mosaic');

            } else {

                e['display-title'] = 'above-image';
                e['show-meta'] = 'y';
                e['elements-per-row'] = 3;
                e['posts-limit'] = 9;
                e['order-by'] = 'date';
                e['order-direction'] = 'desc';
                e['special-effects'] = 'none';
                e['image'] = 'n';
                e['layout'] = 'rectangles-gutter';
                e['height'] = '585';
                e['gutter'] = 'y';
                e['effects-scroll'] = 'fade';
                e['rows'] = '2';
            }
            makeSelected(builderElements, 'list-galleries');

        } else if (elementType === 'accordion') {

            var accordionOptions = builderElements.filter(function(index){
                return $(this).hasClass('accordion');
            }), posts_type, category;

            listOfElements.find('option[value="accordion"]').attr("selected", "selected");
            accordionOptions.find('option[selected="selected"]').removeAttr('selected');

            accordionOptions.find('#accordion-admin-label').val(element.attr('data-admin-label'));
            accordionOptions.find('#accordion-posts-type').val(element.attr('data-posts-type'));
            accordionOptions.find('#accordion-featured').val(element.attr('data-featured'));
            accordionOptions.find('#accordion-order-by').val(element.attr('data-order-by'));
            accordionOptions.find("#accordion-order-direction").val(element.attr('data-order-direction'));
            accordionOptions.find("#accordion-nr-of-posts").val(element.attr('data-nr-of-posts'));
            accordionOptions.find("#accordion-posts-type").val(element.attr('data-posts-type'));

            category = element.attr('data-category') ? element.attr('data-category').split(',') : [];

            jQuery('#accordion-' + element.attr('data-posts-type') + '-category option').each(function(index, el) {
                var elem = $(el);

                if ($.inArray(elem.val(), category) > -1) {
                    elem.attr("selected", "selected");
                }
            });

            makeSelected(builderElements, 'accordion');

        } else if (elementType === 'latest-custom-posts') {

            var latestCustomPostsOptions = builderElements.filter(function(index){
                return $(this).hasClass('latest-custom-posts');
            }), posts_type, category;

            listOfElements.find('option[value="latest-custom-posts"]').attr("selected", "selected");
            latestCustomPostsOptions.find('option[selected="selected"]').removeAttr('selected');

            latestCustomPostsOptions.find('#latest-custom-posts-exclude').val(element.attr('data-id-exclude'));
            latestCustomPostsOptions.find('#latest-custom-posts-exclude-first').val(element.attr('data-exclude-first'));
            latestCustomPostsOptions.find("#latest-custom-posts-admin-label").val(element.attr('data-admin-label'));
            latestCustomPostsOptions.find("#latest-custom-posts-featured").val(element.attr('data-featured'));

            posts_type = element.attr('data-post-type') ? element.attr('data-post-type').split(',') : [];

            latestCustomPostsOptions.find('#latest-custom-posts-type option').each(function(index, el) {
                var elem = $(el);

                if ($.inArray(elem.val(), posts_type) > -1) {
                    elem.attr("selected", "selected");
                }
            });

            category = element.attr('data-category') ? element.attr('data-category').split(',') : [];

            jQuery(posts_type).each(function(i, value){
                jQuery('#latest-custom-posts-category-' + value + ' option').each(function(index, el) {
                    var elem = $(el);

                    if ($.inArray(elem.val(), category) > -1) {
                        elem.attr("selected", "selected");
                    }
                });
            });

            // How to display last posts
            var displayModeVariants = ['grid', 'list', 'thumbnails', 'big-post', 'super-post', 'timeline', 'mosaic'],
                displayMode = element.attr('data-display-mode');

            displayMode = ($.inArray(displayMode, displayModeVariants) > -1) ? displayMode : 'grid';
            latestCustomPostsOptions.find('#latest-custom-posts-display-mode option[value="' +  displayMode + '"]').attr("selected", "selected");
            makeSelected(latestCustomPostsDisplayMode, 'latest-custom-posts-' + displayMode);

            if (displayMode === 'grid') {
                latestCustomPostsOptions.find('#latest-custom-posts-grid-behavior option[value="'+element.attr('data-behavior')+'"]' ).attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-grid-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-grid-show-meta-' + showMeta(element)).attr("checked", "checked");
                latestCustomPostsOptions.find('#latest-custom-posts-grid-el-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-grid-nr-of-posts').val(postsLimit(element));
                latestCustomPostsOptions.find('#latest-custom-posts-grid-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-grid-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-grid-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-grid-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-grid-related option[value="'+showRelated(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-grid-image option[value="'+element.attr('data-show-image')+'"]' ).attr("selected", "selected");
                ts_show_post_exclude_first('latest-custom-posts', 'grid');

            } else if (displayMode === 'list') {
                latestCustomPostsOptions.find('#latest-custom-posts-list-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-list-show-meta-' + showMeta(element)).attr("checked", "checked");
                latestCustomPostsOptions.find('#latest-custom-posts-list-nr-of-posts').val(postsLimit(element));
                latestCustomPostsOptions.find('#latest-custom-posts-list-image-split option[value="'+imageSplit(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-list-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-list-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-list-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-list-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                 latestCustomPostsOptions.find('#latest-custom-posts-list-image option[value="'+element.attr('data-show-image')+'"]' ).attr("selected", "selected");
                ts_show_post_exclude_first('latest-custom-posts', 'list');

            } else if (displayMode === 'thumbnails') {
                latestCustomPostsOptions.find('#latest-custom-posts-thumbnail-title option[value="' +  element.attr('data-display-title') + '"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-thumbnails-behavior option[value="'+element.attr('data-behavior')+'"]' ).attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-thumbnail-posts-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-thumbnail-limit').val(postsLimit(element));
                latestCustomPostsOptions.find('#latest-custom-posts-thumbnail-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-thumbnails-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-thumbnail-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-thumbnail-gutter option[value="'+gutter(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-thumbnail-show-meta-' + showMetaThumbnail(element)).attr("checked", "checked");
                latestCustomPostsOptions.find('#latest-custom-posts-thumbnails-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                ts_show_post_exclude_first('latest-custom-posts', 'thumbnails');

            } else if (displayMode === 'big-post') {

                latestCustomPostsOptions.find('#latest-custom-posts-big-post-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-big-post-show-meta-' + showMeta(element)).attr("checked", "checked");
                latestCustomPostsOptions.find('#latest-custom-posts-big-post-nr-of-posts').val(postsLimit(element));
                latestCustomPostsOptions.find('#latest-custom-posts-big-post-image-split option[value="'+imageSplit(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-big-post-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-big-post-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-big-post-related option[value="'+showRelated(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-big-post-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-big-post-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-big-post-image-position option[value="'+imagePosition(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-big-post-excerpt option[value="'+showExcerpt(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-big-post-carousel option[value="'+element.attr('data-carousel')+'"]').attr("selected", "selected");
                 latestCustomPostsOptions.find('#latest-custom-posts-big-post-image option[value="'+element.attr('data-show-image')+'"]' ).attr("selected", "selected");
                ts_show_post_exclude_first('latest-custom-posts', 'big-post');

            } else if (displayMode === 'super-post') {

                latestCustomPostsOptions.find('#latest-custom-posts-super-post-posts-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-super-post-limit').val(postsLimit(element));
                latestCustomPostsOptions.find('#latest-custom-posts-super-post-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-super-post-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-super-post-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-super-post-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                ts_show_post_exclude_first('latest-custom-posts', 'super-post');

            } else if (displayMode === 'timeline') {
                latestCustomPostsOptions.find('#latest-custom-posts-timeline-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-timeline-show-meta-' + showMeta(element)).attr("checked", "checked");
                latestCustomPostsOptions.find('#latest-custom-posts-timeline-post-limit').val(postsLimit(element));
                latestCustomPostsOptions.find('#latest-custom-posts-timeline-image option[value="'+imageShow(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-timeline-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-timeline-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-timeline-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                ts_show_post_exclude_first('latest-custom-posts', 'timeline');

            } else if (displayMode === 'mosaic') {
                latestCustomPostsOptions.find('#latest-custom-posts-mosaic-rows option[value="'+numberRow(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-mosaic-scroll option[value="'+displayScroll(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-mosaic-effects option[value="'+effectsScrollMosaic(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-mosaic-layout option[value="'+layoutMosaic(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-mosaic-gutter option[value="'+gutter(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-mosaic-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-mosaic-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                latestCustomPostsOptions.find('#latest-custom-posts-mosaic-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");

                if( layoutMosaic(element) == 'rectangles' ){
                    latestCustomPostsOptions.find('#latest-custom-posts-mosaic-post-limit-rows-' + numberRow(element)).val(postsLimit(element));
                }else{
                    latestCustomPostsOptions.find('#latest-custom-posts-mosaic-post-limit-rows-squares').val(postsLimit(element));
                }

                ts_show_post_exclude_first('latest-custom-posts', 'mosaic');

            } else {

                e['display-title'] = 'above-image';
                e['show-meta'] = 'y';
                e['elements-per-row'] = 3;
                e['posts-limit'] = 9;
                e['order-by'] = 'date';
                e['order-direction'] = 'desc';
                e['special-effects'] = 'none';
                e['image'] = 'n';
                e['layout'] = 'rectangles-gutter';
                e['height'] = '585';
                e['gutter'] = 'y';
                e['effects-scroll'] = 'fade';
                e['rows'] = '2';
            }
            makeSelected(builderElements, 'latest-custom-posts');

        } else if (elementType === 'callaction') {

            var callactionOptions = builderElements.filter(function(index){
                return $(this).hasClass('callaction');
            });

            listOfElements.find('option[value="callaction"]').attr("selected", "selected");
            makeSelected(builderElements, 'callaction');
            callactionOptions.find('#callaction-text').val(callactionText(element));
            callactionOptions.find('#callaction-link').val(callactionLink(element));
            callactionOptions.find('#callaction-button-text').val(callactionButtonText(element));
            callactionOptions.find("#callaction-admin-label").val(element.attr('data-admin-label'));

        } else if (elementType === 'teams') {

            var teamsOptions = builderElements.filter(function(index){
                return $(this).hasClass('teams');
            }),category;

            category = element.attr('data-category') ? element.attr('data-category').split(',') : [];

             teamsOptions.find('#teams-category option').each(function(index, el) {
                var elem = $(el);

                if ($.inArray(elem.val(), category) > -1) {
                    elem.attr("selected", "selected");
                }
            });

            listOfElements.find('option[value="teams"]').attr("selected", "selected");
            makeSelected(builderElements, 'teams');

            teamsOptions.find('#teams-elements-per-row option[value="' + elementsPerRow(element) + '"]').attr("selected", "selected");
            teamsOptions.find('#teams-post-limit').val(postsLimit(element));
            teamsOptions.find('#teams-remove-gutter option[value="' +  element.attr('data-remove-gutter') + '"]').attr("selected", "selected");
            teamsOptions.find('#teams-enable-carousel option[value="' +  element.attr('data-enable-carousel') + '"]').attr("selected", "selected");
            teamsOptions.find("#teams-admin-label").val(element.attr('data-admin-label'));

        } else if (elementType === 'pricing-tables') {
            var pricingTablesOptions = builderElements.filter(function(index){
                return $(this).hasClass('pricing-tables');
            });
            pricingTablesOptions.find("#pricing-tables-admin-label").val(element.attr('data-admin-label'));

            listOfElements.find('option[value="pricing-tables"]').attr("selected", "selected");
            makeSelected(builderElements, 'pricing-tables');

            category = element.attr('data-category') ? element.attr('data-category').split(',') : [];

             pricingTablesOptions.find('#pricing-tables-category option').each(function(index, el) {
                var elem = $(el);

                if ($.inArray(elem.val(), category) > -1) {
                    elem.attr("selected", "selected");
                }
            });

            pricingTablesOptions.find('#pricing-tables-elements-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
            pricingTablesOptions.find('#pricing-tables-post-limit').val(postsLimit(element));
            pricingTablesOptions.find('#pricing-tables-remove-gutter option[value="' +  element.attr('data-remove-gutter') + '"]').attr("selected", "selected");
            pricingTablesOptions.find('#pricing-tables-enable-carousel option[value="' +  element.attr('data-enable-carousel') + '"]').attr("selected", "selected");

        } else if (elementType === 'advertising') {

            var advertisingOptions = builderElements.filter(function(index){
                return $(this).hasClass('advertising');
            });

            listOfElements.find('option[value="advertising"]').attr("selected", "selected");
            makeSelected(builderElements, 'advertising');
            advertisingOptions.find('#advertising').val(advertising(element));
            advertisingOptions.find("#advertising-admin-label").val(element.attr('data-admin-label'));

        } else if (elementType === 'empty') {

            listOfElements.find('option[value="empty"]').attr("selected", "selected");
            makeSelected(builderElements, 'empty');

        } else if (elementType === 'delimiter') {

            var delimiterOptions = builderElements.filter(function(index){
                return $(this).hasClass('delimiter');
            });

            listOfElements.find('option[value="delimiter"]').attr("selected", "selected");
            makeSelected(builderElements, 'delimiter');

            delimiterOptions.find('#delimiter-color').val(element.attr('data-delimiter-color'));
            delimiterOptions.find('#delimiter-type option[value="'+delimiterType(element)+'"]').attr("selected", "selected");
            delimiterOptions.find("#delimiter-admin-label").val(element.attr('data-admin-label'));

        } else if (elementType === 'title') {

            var titleOptions = builderElements.filter(function(index){
                return $(this).hasClass('title');
            });
            listOfElements.find('option[value="title"]').attr("selected", "selected");
            makeSelected(builderElements, 'title');
            titleOptions.find('#builder-element-title-icon option[value="'+element.attr('data-title-icon')+'"]').attr("selected", "selected");
            titleOptions.find('#title-title').val(element.attr('data-title'));
            titleOptions.find('#builder-element-title-color').val(element.attr('data-title-color'));
            titleOptions.find('#title-subtitle').val(element.attr('data-subtitle'));
            titleOptions.find('#builder-element-title-subtitle-color').val(element.attr('data-subtitle-color'));
            titleOptions.find('#title-size option[value="' +titleSizes(element)+ '"]').attr("selected", "selected");
            titleOptions.find('#title-style option[value="'+titleStyle(element)+'"]').attr("selected", "selected");
            titleOptions.find("#title-admin-label").val(element.attr('data-admin-label'));

        } else if (elementType === 'video') {

            var videoOptions = builderElements.filter(function(index){
                return $(this).hasClass('video');
            });

            videoOptions.find('#video-embed').val(element.attr('data-embed'));

            listOfElements.find('option[value="video"]').attr("selected", "selected");
            makeSelected(builderElements, 'video');
            videoOptions.find("#video-admin-label").val(element.attr('data-admin-label'));
            videoOptions.find("#video-lightbox").val(element.attr('data-lightbox'));
            videoOptions.find("#video-title").val(element.attr('data-title'));

        } else if (elementType === 'facebook-block') {

            var facebookOptions = builderElements.filter(function(index){
                return $(this).hasClass('facebook-block');
            });

            facebookOptions.find('#facebook-url').val(element.attr('data-facebook-url'));
            facebookOptions.find('#facebook-background option[value="' + element.attr('data-facebook-background')+ '"]').attr("selected", "selected");

            listOfElements.find('option[value="facebook-block"]').attr("selected", "selected");
            makeSelected(builderElements, 'facebook-block');

        } else if (elementType === 'image') {

            var imageOptions = builderElements.filter(function(index){
                return $(this).hasClass('image');
            });

            imageOptions.find('#image_url').val(element.attr('data-image-url'));
            imageOptions.find('#image-target').val(element.attr('data-image-target'));
            imageOptions.find('#image-lightbox').val(element.attr('data-image-lightbox'));
            imageOptions.find('#forward-image-url').val(element.attr('data-forward-url'));
            imageOptions.find('#image_preview').html($('<img>').attr('src', element.attr('data-image-url')).attr('style', 'max-width:400px'));
            imageOptions.find("#image-admin-label").val(element.attr('data-admin-label'));
            imageOptions.find("#image-retina").val(element.attr('data-retina'));
            imageOptions.find("#image-align").val(element.attr('data-align'));

            listOfElements.find('option[value="image"]').attr("selected", "selected");
            makeSelected(builderElements, 'image');

        } else if (elementType === 'powerlink') {

            var powerlinkOptions = builderElements.filter(function(index){
                return $(this).hasClass('powerlink');
            });

            powerlinkOptions.find("#powerlink-admin-label").val(element.attr('data-admin-label'));
            powerlinkOptions.find('#image-powerlink-url').val(element.attr('data-image'));
            powerlinkOptions.find('#powerlink_preview').html($('<img>').attr('src', element.attr('data-image')).attr('style', 'max-width:400px'));
            powerlinkOptions.find("#powerlink-title").val(element.attr('data-title'));
            powerlinkOptions.find('#powerlink-button-url').val(element.attr('data-button-url'));
            powerlinkOptions.find("#powerlink-button-text").val(element.attr('data-button-text'));

            listOfElements.find('option[value="powerlink"]').attr("selected", "selected");
            makeSelected(builderElements, 'powerlink');

        } else if (elementType === 'filters') {

            var filtersOptions = builderElements.filter(function(index){
                return $(this).hasClass('filters');
            });

            filtersOptions.find('#filters-post-type option[value="' + element.attr('data-post-type')+ '"]').attr("selected", "selected");

            var category = element.attr('data-categories').split(',');

            filtersOptions.find('#filters-' + element.attr('data-post-type') + '-category option').each(function(){
                for(var cat in category){
                    if( jQuery(this).val() == category[cat] ) jQuery(this).attr('selected', 'selected');
                }
            });

            filtersOptions.find('#filters-posts-limit').val(element.attr('data-posts-limit'));
            filtersOptions.find('#filters-elements-per-row option[value="' +  elementsPerRow(element) + '"]').attr("selected", "selected");
            filtersOptions.find('#filters-order-by').val(element.attr('data-order-by'));
            filtersOptions.find('#filters-order-direction option[value="'+element.attr('data-direction')+'"]').attr("selected", "selected");
            filtersOptions.find('#filters-special-effects option[value="'+element.attr('data-special-effects')+'"]').attr("selected", "selected");
            filtersOptions.find('#filters-gutter option[value="'+element.attr('data-gutter')+'"]').attr("selected", "selected");
            filtersOptions.find("#filters-admin-label").val(element.attr('data-admin-label'));
            makeSelected(builderElements, 'filters');
            listOfElements.find('option[value="filters"]').attr("selected", "selected");

        } else if (elementType === 'feature-blocks') {

            var featureBlocksOptions = builderElements.filter(function(index){
                return $(this).hasClass('feature-blocks');
            });

            listOfElements.find('option[value="feature-blocks"]').attr("selected", "selected");
            makeSelected(builderElements, 'feature-blocks');

            featureBlocksOptions.find('#feature-blocks-category option[value="' +  element.attr('data-category') + '"]').attr("selected", "selected");
            featureBlocksOptions.find('#feature-blocks-style option[value="' +  element.attr('data-style') + '"]').attr("selected", "selected");
            featureBlocksOptions.find('#feature-blocks-per-row option[value="' +  elementsPerRow(element) + '"]').attr("selected", "selected");
            featureBlocksOptions.find('#feature-blocks-limit').val(postsLimit(element));

        } else if (elementType === 'banner') {

            var bannerOptions = builderElements.filter(function(index){
                return $(this).hasClass('banner');
            });

            listOfElements.find('option[value="banner"]').attr("selected", "selected");
            makeSelected(builderElements, 'banner');

            bannerOptions.find('#image-banner-url').val(element.attr('data-banner-image'));
            bannerOptions.find('#banner-image-preview').html($('<img>').attr('src', element.attr('data-banner-image')).attr('style', 'max-width:400px'));
            bannerOptions.find('#banner-title').val(element.attr('data-banner-title'));
            bannerOptions.find('#banner-subtitle').val(element.attr('data-banner-subtitle'));
            bannerOptions.find('#banner-button-title').val(element.attr('data-banner-button-title'));
            bannerOptions.find('#banner-button-url').val(element.attr('data-banner-button-url'));
            bannerOptions.find('#banner-button-background').val(element.attr('data-banner-button-background'));
            bannerOptions.find('#banner-font-color').val(element.attr('data-banner-font-color'));
            bannerOptions.find('#banner-text-align').val(element.attr('data-banner-text-align'));
            bannerOptions.find('#banner-height').val(element.attr('data-banner-height'));
            bannerOptions.find("#banner-admin-label").val(element.attr('data-admin-label'));
            bannerOptions.find("#banner-button-text-color").val(element.attr('data-button-text-color'));

        } else if (elementType === 'toggle') {

            var toggleOptions = builderElements.filter(function(index){
                return $(this).hasClass('toggle');
            });

            listOfElements.find('option[value="toggle"]').attr("selected", "selected");
            makeSelected(builderElements, 'toggle');

            toggleOptions.find('#toggle-title').val(element.attr('data-toggle-title'));
            toggleOptions.find('#toggle-description').val(element.attr('data-toggle-description'));
            toggleOptions.find('#toggle-state').val(element.attr('data-toggle-state'));
            toggleOptions.find("#toggle-admin-label").val(element.attr('data-admin-label'));


        } else if (elementType === 'timeline') {

            var timelineOptions = builderElements.filter(function(index){
                return $(this).hasClass('timeline');
            });

            listOfElements.find('option[value="timeline"]').attr("selected", "selected");
            makeSelected(builderElements, 'timeline');

            timelineOptions.find("#timeline-admin-label").val(element.attr('data-admin-label'));
            timelineOptions.find('#timeline_content').val(element.attr('data-timeline'));

        } else if (elementType === 'map') {

            var mapOptions = builderElements.filter(function(index){
                return $(this).hasClass('map');
            });

            mapOptions.find('option[selected="selected"]').removeAttr('selected');

            mapOptions.find("#map-admin-label").val(element.attr('data-admin-label'));
            mapOptions.find('#map-address').val(element.attr('data-map-address'));
            mapOptions.find('#map-width').val(element.attr('data-map-width'));
            mapOptions.find('#map-height').val(element.attr('data-map-height'));
            mapOptions.find('#map-latitude').val(element.attr('data-map-latitude'));
            mapOptions.find('#map-longitude').val(element.attr('data-map-longitude'));
            mapOptions.find('#map-zoom').val(element.attr('data-map-zoom'));
            mapOptions.find('#map-type option[value="'+element.attr('data-map-type')+'"]').attr("selected", "selected");
            mapOptions.find('#map-style option[value="'+element.attr('data-map-style')+'"]').attr("selected", "selected");
            mapOptions.find('#map-type-control option[value="'+element.attr('data-map-type-control')+'"]').attr("selected", "selected");
            mapOptions.find('#map-zoom-control option[value="'+element.attr('data-map-zoom-control')+'"]').attr("selected", "selected");
            mapOptions.find('#map-scale-control option[value="'+element.attr('data-map-scale-control')+'"]').attr("selected", "selected");
            mapOptions.find('#map-scroll-wheel option[value="'+element.attr('data-map-scroll-wheel')+'"]').attr("selected", "selected");
            mapOptions.find('#map-draggable-direction option[value="'+element.attr('data-map-draggable-direction')+'"]').attr("selected", "selected");
            mapOptions.find('#map-marker-icon option[value="'+element.attr('data-map-marker-icon')+'"]').attr("selected", "selected");
            mapOptions.find("#map-marker-attachment").val(element.attr('data-map-marker-img'));
            mapOptions.find('#map-marker-image-preview').html($('<img>').attr('src', element.attr('data-map-marker-img')));

            listOfElements.find('option[value="map"]').attr("selected", "selected");
            makeSelected(builderElements, 'map');

            setTimeout(function(){
                initialize();
            },100)

        }  else if (elementType === 'counters') {

            var countersOptions = builderElements.filter(function(index){
                return $(this).hasClass('counters');
            });

            listOfElements.find('option[value="counters"]').attr("selected", "selected");
            makeSelected(builderElements, 'counters');

            countersOptions.find("#counters-admin-label").val(element.attr('data-admin-label'));
            countersOptions.find('#counters-text').val(element.attr('data-counters-text'));
            countersOptions.find('#counters-precents').val(element.attr('data-counters-precents'));
            countersOptions.find('#counters-text-color').val(element.attr('data-counters-text-color'));
            countersOptions.find('#counters-track-bar').val(element.attr('data-track-bar'));
            countersOptions.find('#counters-track-bar-color').val(element.attr('data-track-bar-color'));
            countersOptions.find('#counters-icon').val(element.attr('data-track-bar-icon'));

        }  else if (elementType === 'alert') {

            var alertOptions = builderElements.filter(function(index){
                return $(this).hasClass('alert');
            });

            listOfElements.find('option[value="alert"]').attr("selected", "selected");
            makeSelected(builderElements, 'alert');

            alertOptions.find("#alert-admin-label").val(element.attr('data-admin-label'));
            alertOptions.find('#alert-icon option[value="'+element.attr('data-icon')+'"]').attr("selected", "selected");
            alertOptions.find('#alert-title').val(element.attr('data-title'));
            alertOptions.find('#alert-text').val(element.attr('data-text').replace(/<br \/>/g, '\n'));
            alertOptions.find('#alert-background-color').val(element.attr('data-background-color'));
            alertOptions.find('#alert-text-color').val(element.attr('data-text-color'));

        }  else if (elementType === 'spacer') {

            var spacerOptions = builderElements.filter(function(index){
                return $(this).hasClass('spacer');
            });

            listOfElements.find('option[value="spacer"]').attr("selected", "selected");
            makeSelected(builderElements, 'spacer');

            spacerOptions.find('#spacer-height').val(element.attr('data-height'));
            spacerOptions.find("#spacer-admin-label").val(element.attr('data-admin-label'));

        } else if (elementType === 'icon') {

            var iconOptions = builderElements.filter(function(index){
                return $(this).hasClass('icon');
            });

            listOfElements.find('option[value="icon"]').attr("selected", "selected");
            makeSelected(builderElements, 'icon');

            iconOptions.find('#builder-element-icon-size').val(element.attr('data-icon-size'));
            iconOptions.find('#builder-element-icon-color').val(element.attr('data-icon-color'));
            iconOptions.find('#builder-element-icon option[value="'+element.attr('data-icon')+'"]').attr("selected", "selected");
            iconOptions.find('#builder-element-icon-align option[value="'+element.attr('data-icon-align')+'"]').attr("selected", "selected");
            iconOptions.find("#icon-admin-label").val(element.attr('data-admin-label'));

        }else if (elementType === 'listed-features') {

            var ListFeaturesOptions = builderElements.filter(function(index){
                return $(this).hasClass('listed-features');
            });

            listOfElements.find('option[value="listed-features"]').attr("selected", "selected");
            makeSelected(builderElements, 'listed-features');

            ListFeaturesOptions.find('#listed-features_content').val(element.attr('data-features'));
            ListFeaturesOptions.find('#listed-features-align').val(element.attr('data-features-align'));
            ListFeaturesOptions.find('#listed-features-color-style').val(element.attr('data-color-style'));
            ListFeaturesOptions.find("#listed-features-admin-label").val(element.attr('data-admin-label'));

        } else if (elementType === 'clients') {

            dataAttr = {};
            dataAttr['element-type'] = 'clients';

            var ClientsBlockOptions = builderElements.filter(function(index){
                return $(this).hasClass('clients');
            });

            listOfElements.find('option[value="clients"]').attr("selected", "selected");
            makeSelected(builderElements, 'clients');
            ClientsBlockOptions.find('#clients-enable-carousel-' +  enableCarousel(element) ).attr("checked", "checked");
            ClientsBlockOptions.find('#clients-row option[value="' +  elementsPerRow(element) + '"]').attr("selected", "selected");
            ClientsBlockOptions.find('#clients_content').val(element.attr('data-clients'));
            ClientsBlockOptions.find("#clients-admin-label").val(element.attr('data-admin-label'));

        }  else if (elementType === 'features-block') {

            dataAttr = {};
            dataAttr['element-type'] = 'features-block';

            var FeaturesOptions = builderElements.filter(function(index){
                return $(this).hasClass('features-block');
            });

            FeaturesOptions.find("#features-block-admin-label").val(element.attr('data-admin-label'));
            listOfElements.find('option[value="features-block"]').attr("selected", "selected");
            makeSelected(builderElements, 'features-block');
            FeaturesOptions.find('#features-block-row option[value="' +  elementsPerRow(element) + '"]').attr("selected", "selected");
            FeaturesOptions.find('#features-block-style').val(element.attr('data-style'));
            FeaturesOptions.find('#features-block_content').val(element.attr('data-features-block'));
            FeaturesOptions.find('#features-block-gutter').val(element.attr('data-gutter'));


        } else if (elementType === 'page') {

            var post_id = postID(element);
                window.rtSelectPageInSearchResults = post_id;

            var pageOptions = builderElements.filter(function(index){
                return $(this).hasClass('page');
            });

            pageOptions.find('#search-page').val(element.attr('data-search'));
            pageOptions.find('#search-page-criteria option[value="'+element.attr('data-criteria')+'"]').attr("selected", "selected");
            pageOptions.find('#search-page-order-by option[value="'+element.attr('data-order-by')+'"]').attr("selected", "selected");
            pageOptions.find('#search-page-direction option[value="'+element.attr('data-direction')+'"]').attr("selected", "selected");

            listOfElements.find('option[value="page"]').attr("selected", "selected");
            makeSelected(builderElements, 'page');

            var searchButton = pageOptions.find('#search-type-page').eq(0);
            $(searchButton).trigger('click');
            pageOptions.find('input[name=pageID]').find("input[value="+post_id+"]").attr("checked", "checked");

        } else if (elementType === 'post') {

            var post_id = postID(element),
                postOptions = builderElements.filter(function(index){
                    return $(this).hasClass('post');
                });

            listOfElements.find('option[value="post"]').attr("selected", "selected");
            makeSelected(builderElements, 'post');

            window.rtSelectPostInSearchResults = post_id;

            postOptions.find('#search-post').val(element.attr('data-search'));
            postOptions.find('#search-post-criteria option[value="'+element.attr('data-criteria')+'"]').attr("selected", "selected");
            postOptions.find('#search-post-order-by option[value="'+element.attr('data-order-by')+'"]').attr("selected", "selected");
            postOptions.find('#search-post-direction option[value="'+element.attr('data-direction')+'"]').attr("selected", "selected");
            postOptions.find('#search-type-post').eq(0).trigger('click');
            postOptions.find('input[name=postID]').find("input[value="+post_id+"]").attr("checked", "checked");

        } else if (elementType === 'buttons') {

            var buttonsOptions = builderElements.filter(function(index){
                return $(this).hasClass('buttons');
            });

            listOfElements.find('option[value="buttons"]').attr("selected", "selected");
            makeSelected(builderElements, 'buttons');
            buttonsOptions.find('#builder-element-button-icon option[value="'+element.attr('data-button-icon')+'"]').attr("selected", "selected");
            buttonsOptions.find('#button-text').val(element.attr('data-text'));
            buttonsOptions.find('#button-icon-align').val(element.attr('data-icon-align'));
            buttonsOptions.find('#button-size').val(element.attr('data-size'));
            buttonsOptions.find('#button-target').val(element.attr('data-target'));
            buttonsOptions.find('#button-text-color').val(element.attr('data-text-color'));
            buttonsOptions.find('#button-background-color').val(element.attr('data-bg-color'));
            buttonsOptions.find('#button-url').val(element.attr('data-url'));
            buttonsOptions.find('#button-align').val(element.attr('data-button-align'));
            buttonsOptions.find("#buttons-admin-label").val(element.attr('data-admin-label'));
            buttonsOptions.find("#button-mode-display").val(element.attr('data-mode-display'));
            buttonsOptions.find("#button-border-color").val(element.attr('data-border-color'));

        } else if (elementType === 'ribbon') {

            var ribbonOptions = builderElements.filter(function(index){
                return $(this).hasClass('ribbon');
            });

            listOfElements.find('option[value="ribbon"]').attr("selected", "selected");
            makeSelected(builderElements, 'ribbon');

            ribbonOptions.find("#ribbon-admin-label").val(element.attr('data-admin-label'));
            ribbonOptions.find("#ribbon-title").val(element.attr('data-title'));
            ribbonOptions.find("#ribbon-text").val(element.attr('data-text'));
            ribbonOptions.find("#ribbon-text-color").val(element.attr('data-text-color'));
            ribbonOptions.find("#ribbon-background-color").val(element.attr('data-background'));
            ribbonOptions.find("#ribbon-align").val(element.attr('data-align'));
            ribbonOptions.find("#ribbon-attachment").val(element.attr('data-image'));
            ribbonOptions.find('#builder-element-ribbon-icon option[value="'+element.attr('data-button-icon')+'"]').attr("selected", "selected");
            ribbonOptions.find('#ribbon-button-text').val(element.attr('data-button-text'));
            ribbonOptions.find('#ribbon-button-size').val(element.attr('data-button-size'));
            ribbonOptions.find('#ribbon-button-target').val(element.attr('data-button-target'));
            ribbonOptions.find('#ribbon-button-background-color').val(element.attr('data-button-background-color'));
            ribbonOptions.find('#ribbon-button-url').val(element.attr('data-button-url'));
            ribbonOptions.find('#ribbon-button-align').val(element.attr('data-button-align'));
            ribbonOptions.find("#ribbon-button-mode-display").val(element.attr('data-button-mode-display'));
            ribbonOptions.find("#ribbon-button-border-color").val(element.attr('data-button-border-color'));
            ribbonOptions.find("#ribbon-button-text-color").val(element.attr('data-button-text-color'));
            ribbonOptions.find('#ribbon-image-preview').html($('<img>').attr('src', element.attr('data-image')));

        } else if (elementType === 'contact-form') {

            var contactFormOptions = builderElements.filter(function(index){
                return $(this).hasClass('contact-form');
            });

            listOfElements.find('option[value="contact-form"]').attr("selected", "selected");
            makeSelected(builderElements, 'contact-form');

            contactFormOptions.find("#contact-form-admin-label").val(element.attr('data-admin-label'));
            contactFormOptions.find('#contact-form_content').val(element.attr('data-contact-form'));

            if (element.attr('data-hide-icon') === '1') {
                contactFormOptions.find('#contact-form-hide-icon').attr("checked", "checked");
            } else {
                contactFormOptions.find('#contact-form-hide-icon').removeAttr("checked");
            }

            if (element.attr('data-hide-subject') === '1') {
                contactFormOptions.find('#contact-form-hide-subject').attr("checked", "checked");
            } else {
                contactFormOptions.find('#contact-form-hide-subject').removeAttr("checked");
            }

        } else if (elementType === 'featured-area') {

            var featuredAreaOptions = builderElements.filter(function(index){
                return $(this).hasClass('featured-area');
            });

            var featuredAreaCategories;

            featuredAreaOptions.find("#featured-area-admin-label").val(element.attr('data-admin-label'));

            listOfElements.find('option[value="featured-area"]').attr("selected", "selected");
            makeSelected(builderElements, 'featured-area');

            featuredAreaOptions.find('#featured-area-custom-post option[value="'+element.attr('data-custom-post')+'"]').attr("selected", "selected");
            featuredAreaOptions.find("#featured-area-style").val(element.attr('data-style'));
            featuredAreaOptions.find("#featured-area-exclude-first").val(element.attr('data-exclude-first'));
            featuredAreaOptions.find("#featured-area-order-by").val(element.attr('data-order-by'));
            featuredAreaOptions.find("#featured-area-order-direction").val(element.attr('data-order-direction'));

            featuredAreaCategories = element.attr('data-selected-categories');

            if (typeof featuredAreaCategories !== "undefined") {
                featuredAreaCategories = featuredAreaCategories.split(',');
            } else {
                featuredAreaCategories = [];
            }

            featuredAreaOptions.find('#featured-area-categories-video option').each(function(index, el) {

                var element = $(el);
                if ( $.inArray( element.val(), featuredAreaCategories ) > -1 ) {
                    element.attr("selected", "selected");
                }
            });

            featuredAreaOptions.find('#featured-area-categories-posts option').each(function(index, el) {

                var element = $(el);
                if ( $.inArray( element.val(), featuredAreaCategories ) > -1 ) {
                    element.attr("selected", "selected");
                }
            });

            featuredAreaOptions.find('#featured-area-categories-gallery option').each(function(index, el) {

                var element = $(el);
                if ( $.inArray( element.val(), featuredAreaCategories ) > -1 ) {
                    element.attr("selected", "selected");
                }
            });

        } else if (elementType === 'shortcodes') {

            var shortcodesOptions = builderElements.filter(function(index){
                return $(this).hasClass('shortcodes');
            });

            listOfElements.find('option[value="shortcodes"]').attr("selected", "selected");
            makeSelected(builderElements, 'shortcodes');

            shortcodesOptions.find('#ts-shortcodes').val(element.attr('data-shortcodes'));
            shortcodesOptions.find('#shortcodes-paddings').val(element.attr('data-paddings'));
            shortcodesOptions.find("#shortcodes-admin-label").val(element.attr('data-admin-label'));

        } else if (elementType === 'text') {

            var textOptions = builderElements.filter(function(index){
                return $(this).hasClass('text');
            });
            var text_container = jQuery('.tsz-text-editor-modal');
            text_container.find("#text-admin-label").val(element.attr('data-admin-label'));

            listOfElements.find('option[value="text"]').attr("selected", "selected");

            makeSelected(builderElements, 'text');
            var content_editor = element.attr('data-text').replace(/--quote--/g, '"');

            tinymce.get("ts_editor_id").execCommand('mceInsertContent', false, content_editor);

        } else if (elementType === 'list-videos') {

            var listVideosOptions = builderElements.filter(function(index){
               return $(this).hasClass('list-videos');
            }), category;

            listOfElements.find('option[value="list-videos"]').attr("selected", "selected");
            listVideosOptions.find('option[selected="selected"]').removeAttr('selected');

            listVideosOptions.find('#list-videos-exclude').val(element.attr('data-id-exclude'));
            listVideosOptions.find('#list-videos-exclude-first').val(element.attr('data-exclude-first'));
            listVideosOptions.find("#list-videos-admin-label").val(element.attr('data-admin-label'));
            listVideosOptions.find("#list-videos-featured").val(element.attr('data-featured'));

            category = element.attr('data-category') ? element.attr('data-category').split(',') : [];

            listVideosOptions.find('#list-videos-category option').each(function(index, el) {
                var elem = $(el);

                if ($.inArray(elem.val(), category) > -1) {
                    elem.attr("selected", "selected");
                }
            });

            // How to display last posts
            var displayModeVariants = ['grid', 'list', 'thumbnails', 'big-post', 'super-post', 'timeline', 'mosaic'],
               displayMode = element.attr('data-display-mode');

            displayMode = ($.inArray(displayMode, displayModeVariants) > -1) ? displayMode : 'grid';
            listVideosOptions.find('#list-videos-display-mode option[value="' +  displayMode + '"]').attr("selected", "selected");
            makeSelected(listVideosDisplayMode, 'list-videos-' + displayMode);

            if (displayMode === 'grid') {
                listVideosOptions.find('#list-videos-grid-behavior option[value="'+element.attr('data-behavior')+'"]' ).attr("selected", "selected");
                listVideosOptions.find('#list-videos-grid-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-grid-show-meta-' + showMeta(element)).attr("checked", "checked");
                listVideosOptions.find('#list-videos-grid-el-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-grid-nr-of-posts').val(postsLimit(element));
                listVideosOptions.find('#list-videos-grid-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-grid-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-grid-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-grid-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-grid-related option[value="'+showRelated(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-grid-image option[value="'+element.attr('data-show-image')+'"]' ).attr("selected", "selected");
                ts_show_post_exclude_first('list-videos', 'grid');

            } else if (displayMode === 'list') {
                listVideosOptions.find('#list-videos-list-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-list-show-meta-' + showMeta(element)).attr("checked", "checked");
                listVideosOptions.find('#list-videos-list-nr-of-posts').val(postsLimit(element));
                listVideosOptions.find('#list-videos-list-image-split option[value="'+imageSplit(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-list-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-list-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-list-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-list-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-list-image option[value="'+element.attr('data-show-image')+'"]' ).attr("selected", "selected");

            } else if (displayMode === 'thumbnails') {
                listVideosOptions.find('#list-videos-thumbnails-behavior option[value="'+element.attr('data-behavior')+'"]' ).attr("selected", "selected");
                listVideosOptions.find('#list-videos-thumbnail-posts-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-thumbnail-limit').val(postsLimit(element));
                listVideosOptions.find('#list-videos-thumbnail-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-thumbnails-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-thumbnail-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-thumbnail-gutter option[value="'+gutter(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-thumbnail-show-meta-' + showMetaThumbnail(element)).attr("checked", "checked");
                listVideosOptions.find('#list-videos-thumbnails-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-thumbnails-title option[value="' +  element.attr('data-display-title') + '"]').attr("selected", "selected");
                ts_show_post_exclude_first('list-videos', 'thumbnails');

            } else if (displayMode === 'big-post') {

                listVideosOptions.find('#list-videos-big-post-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-big-post-show-meta-' + showMeta(element)).attr("checked", "checked");
                listVideosOptions.find('#list-videos-big-post-nr-of-posts').val(postsLimit(element));
                listVideosOptions.find('#list-videos-big-post-image-split option[value="'+imageSplit(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-big-post-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-big-post-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-big-post-related option[value="'+showRelated(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-big-post-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-big-post-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-big-post-image-position option[value="'+imagePosition(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-big-post-excerpt option[value="'+showExcerpt(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-big-post-carousel option[value="'+element.attr('data-carousel')+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-big-post-image option[value="'+element.attr('data-show-image')+'"]' ).attr("selected", "selected");
                ts_show_post_exclude_first('list-videos', 'big-post');

            } else if (displayMode === 'super-post') {

                listVideosOptions.find('#list-videos-super-post-posts-per-row option[value="'+elementsPerRow(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-super-post-limit').val(postsLimit(element));
                listVideosOptions.find('#list-videos-super-post-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-super-post-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-super-post-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-super-post-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                ts_show_post_exclude_first('list-videos', 'super-post');

            } else if (displayMode === 'timeline') {
                listVideosOptions.find('#list-videos-timeline-title option[value="' +  displayTitle(element) + '"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-timeline-show-meta-' + showMeta(element)).attr("checked", "checked");
                listVideosOptions.find('#list-videos-timeline-post-limit').val(postsLimit(element));
                listVideosOptions.find('#list-videos-timeline-image option[value="'+imageShow(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-timeline-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-timeline-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-timeline-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");
                ts_show_post_exclude_first('list-videos', 'timeline');

            } else if (displayMode === 'mosaic') {
                listVideosOptions.find('#list-videos-mosaic-rows option[value="'+numberRow(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-mosaic-scroll option[value="'+displayScroll(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-mosaic-effects option[value="'+effectsScrollMosaic(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-mosaic-layout option[value="'+layoutMosaic(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-mosaic-gutter option[value="'+gutter(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-mosaic-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-mosaic-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
                listVideosOptions.find('#list-videos-mosaic-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");

                if( layoutMosaic(element) == 'rectangles' ){
                    listVideosOptions.find('#list-videos-mosaic-post-limit-rows-' + numberRow(element)).val(postsLimit(element));
                }else{
                    listVideosOptions.find('#list-videos-mosaic-post-limit-rows-squares').val(postsLimit(element));
                }

                ts_show_post_exclude_first('list-videos', 'mosaic');
            } else {

                e['display-title'] = 'above-image';
                e['show-meta'] = 'y';
                e['elements-per-row'] = 3;
                e['posts-limit'] = 9;
                e['order-by'] = 'date';
                e['order-direction'] = 'desc';
                e['special-effects'] = 'none';
                e['image'] = 'n';
                e['layout'] = 'rectangles-gutter';
                e['height'] = '585';
                e['gutter'] = 'y';
                e['effects-scroll'] = 'fade';
                e['rows'] = '2';
            }
            makeSelected(builderElements, 'list-videos');

       } else if (elementType === 'events') {

            var eventsOptions = builderElements.filter(function(index){
               return $(this).hasClass('events');
            }), category;

            listOfElements.find('option[value="events"]').attr("selected", "selected");
            eventsOptions.find('option[selected="selected"]').removeAttr('selected');

            eventsOptions.find("#events-admin-label").val(element.attr('data-admin-label'));
            eventsOptions.find('#events-exclude').val(element.attr('data-id-exclude'));
            eventsOptions.find('#events-exclude-first').val(element.attr('data-exclude-first'));
            eventsOptions.find('#events-nr-of-posts').val(element.attr('data-posts-limit'));

            category = element.attr('data-category') ? element.attr('data-category').split(',') : [];

            eventsOptions.find('#events-category option').each(function(index, el) {
                var elem = $(el);

                if ($.inArray(elem.val(), category) > -1) {
                    elem.attr("selected", "selected");
                }
            });

            eventsOptions.find('#events-order-by option[value="'+orderBy(element)+'"]').attr("selected", "selected");
            eventsOptions.find('#events-order-direction option[value="'+orderDirection(element)+'"]').attr("selected", "selected");
            eventsOptions.find('#events-special-effects option[value="'+specialEffects(element)+'"]').attr("selected", "selected");
            eventsOptions.find('#events-pagination option[value="'+enablePagination(element)+'"]').attr("selected", "selected");

            makeSelected(builderElements, 'events');

       } else if (elementType === 'calendar') {

            var calendarOptions = builderElements.filter(function(index){
                return $(this).hasClass('calendar');
            });

            listOfElements.find('option[value="calendar"]').attr("selected", "selected");
            makeSelected(builderElements, 'calendar');

            calendarOptions.find("#calendar-admin-label").val(element.attr('data-admin-label'));
            calendarOptions.find("#calendar-size").val(element.attr('data-size'));

        } else if (elementType === 'chart') {

            dataAttr = {};
            dataAttr['element-type'] = 'chart';
            listOfElements.find('option[value="chart"]').attr("selected", "selected");

            var chartOptions = builderElements.filter(function(index){
                return $(this).hasClass('chart');
            });
            chartOptions.find('#chart-admin-label').val(element.attr('data-admin-label'));
            chartOptions.find('#chart_pie_content').val(element.attr('data-chart_pie'));
            chartOptions.find('#chart_line_content').val(element.attr('data-chart_line'));
            chartOptions.find('#chart-mode').val(element.attr('data-mode'));
            chartOptions.find('#chart-title').val(element.attr('data-title'));
            chartOptions.find('#chart-label').val(element.attr('data-label'));
            chartOptions.find('#chart-scaleShowGridLines').val(element.attr('data-scaleShowGridLines'));
            chartOptions.find('#chart-scaleGridLineColor').val(element.attr('data-scaleGridLineColor'));
            chartOptions.find('#chart-scaleGridLineWidth').val(element.attr('data-scaleGridLineWidth'));
            chartOptions.find('#chart-scaleShowHorizontalLines').val(element.attr('data-scaleShowHorizontalLines'));
            chartOptions.find('#chart-scaleShowVerticalLines').val(element.attr('data-scaleShowVerticalLines'));
            chartOptions.find('#chart-bezierCurve').val(element.attr('data-bezierCurve'));
            chartOptions.find('#chart-bezierCurveTension').val(element.attr('data-bezierCurveTension'));
            chartOptions.find('#chart-pointDot').val(element.attr('data-pointDot'));
            chartOptions.find('#chart-pointDotRadius').val(element.attr('data-pointDotRadius'));
            chartOptions.find('#chart-pointDotStrokeWidth').val(element.attr('data-pointDotStrokeWidth'));
            chartOptions.find('#chart-pointHitDetectionRadius').val(element.attr('data-pointHitDetectionRadius'));
            chartOptions.find('#chart-datasetStroke').val(element.attr('data-datasetStroke'));
            chartOptions.find('#chart-datasetStrokeWidth').val(element.attr('data-datasetStrokeWidth'));
            chartOptions.find('#chart-datasetFill').val(element.attr('data-datasetFill'));
            chartOptions.find('#chart-segmentShowStroke').val(element.attr('data-segmentShowStroke'));
            chartOptions.find('#chart-segmentStrokeColor').val(element.attr('data-segmentStrokeColor'));
            chartOptions.find('#chart-segmentStrokeWidth').val(element.attr('data-segmentStrokeWidth'));
            chartOptions.find('#chart-percentageInnerCutout').val(element.attr('data-percentageInnerCutout'));
            chartOptions.find('#chart-animationSteps').val(element.attr('data-animationSteps'));
            chartOptions.find('#chart-animateRotate').val(element.attr('data-animateRotate'));
            chartOptions.find('#chart-animateScale').val(element.attr('data-animateScale'));

            makeSelected(builderElements, 'chart');

        } else if (elementType === 'gallery') {

            dataAttr = {};
            dataAttr['element-type'] = 'gallery';
            listOfElements.find('option[value="gallery"]').attr("selected", "selected");

            var galleryOptions = builderElements.filter(function(index){
                return $(this).hasClass('gallery');
            });
            galleryOptions.find('#gallery-admin-label').val(element.attr('data-admin-label'));
            galleryOptions.find('#gallery-type').val(element.attr('data-gallery-type'));
            galleryOptions.find('#gallery_image_gallery').val(element.attr('data-images'));

            makeSelected(builderElements, 'gallery');

        }
    }

    /**
     * Retrive data from builder element
     */
    function updateElement (element) {
        $.each(element, function(name, value) {
            element.attr('data-' + name, value);
        });
    }

    jQuery( document ).on( 'click', '#builder-save, .ts-save-editor', function(){
        event.preventDefault();

        setTimeout(function(){
            jQuery('#ts-builder-elements-modal').css('opacity',1);
        },500);

        var elementType, elements, dataAttr;
        var gridMode, listMode, thumbnailsMode, galleryMode, superPostMode, timelineMode;
        var et = $('#ts-element-type');

        elementType = et.val();
        elementName = et.find(":selected").text();

        if (elementType === 'logo') {

            dataAttr = {};
            dataAttr['element-type'] = 'logo';
            elements = $("#builder-elements> .logo");
            dataAttr['logo-align'] = elements.find("#logo-align").val();

        } else if (elementType === 'cart') {

            dataAttr = {};
            dataAttr['element-type'] = 'cart';
            elements = $("#builder-elements>.cart");
            dataAttr['cart-align'] = elements.find("#cart-align").val();


        } else if (elementType === 'breadcrumbs') {

            dataAttr = {};
            dataAttr['element-type'] = 'breadcrumbs';
            elements = $("#builder-elements>.breadcrumbs");

        } else if (elementType === 'social-buttons') {

            dataAttr = {};
            dataAttr['element-type'] = 'social-buttons';
            elements = $("#builder-elements>.social-buttons");
            items_array = '[';

           jQuery('#social_items > li').each(function(){

                if ( jQuery(this).index() + 1 < jQuery('#social_items > li').length ) { var comma = ','}else{var comma = ''};
                item_image = jQuery(this).find('[data-role="media-url"]').val().replace(/"/g, '--quote--');
                item_id = jQuery(this).find('[data-builder-name="item_id"]').val();
                item_url = jQuery(this).find('[data-builder-name="url"]').val().replace(/"/g, '--quote--');
                item_color = jQuery(this).find('[data-builder-name="color"]').val().replace(/"/g, '--quote--');
                items_array = items_array + '{"id":' + '"' +  item_id + '"' + ',"image":' + '"' + item_image + '"' + ',"color":' + '"' + item_color + '"' + ',"url":' + '"' + item_url + '"' + '}' + comma;

            });
            items_array = items_array + ']';
            jQuery('#social_content').val(items_array);

            dataAttr['social-settings'] = elements.find('#social_content').val();
            dataAttr['admin-label'] = elements.find('#social-buttons-admin-label').val();
            dataAttr['social-align'] = elements.find('#social-align').val();

            if( elements.find('#social-buttons-admin-label').val().length > 0 ){
               elementName = elements.find('#social-buttons-admin-label').val();
            }

        } else if (elementType === 'searchbox') {

            elements = $("#builder-elements>.searchbox");
            dataAttr = {};
            dataAttr['element-type'] = 'searchbox';
            dataAttr['align'] = elements.find("#searchbox-align").val();

        } else if (elementType === 'menu') {

            elements = $("#builder-elements>.menu");
            dataAttr = {};
            dataAttr['element-type'] = 'menu';
            dataAttr['element-style'] = elements.find("#menu-styles option:selected").val();
            dataAttr['menu-custom'] = elements.find("#menu-custom:checked").val();
            dataAttr['menu-bg-color'] = elements.find("#menu-element-bg-color").val();
            dataAttr['menu-text-color'] = elements.find("#menu-element-text-color").val();
            dataAttr['menu-bg-color-hover'] = elements.find("#menu-element-bg-color-hover").val();
            dataAttr['menu-text-color-hover'] = elements.find("#menu-element-text-color-hover").val();
            dataAttr['submenu-bg-color'] = elements.find("#menu-element-submenu-bg-color").val();
            dataAttr['submenu-text-color'] = elements.find("#menu-element-submenu-text-color").val();
            dataAttr['submenu-bg-color-hover'] = elements.find("#menu-element-submenu-bg-color-hover").val();
            dataAttr['submenu-text-color-hover'] = elements.find("#menu-element-submenu-text-color-hover").val();
            dataAttr['menu-text-align'] = elements.find("#menu-text-align").val();
            dataAttr['admin-label'] = elements.find("#menu-admin-label").val();
            dataAttr['uppercase'] = elements.find("#menu-uppercase").val();
            dataAttr['name'] = elements.find("#menu-name").val();
            dataAttr['icons'] = elements.find("#menu-icons").val();
            dataAttr['description'] = elements.find("#menu-description").val();

            if( elements.find('#menu-admin-label').val().length > 0 ){
               elementName = elements.find('#menu-admin-label').val();
            }

        } else if (elementType === 'skills') {

            elements = $("#builder-elements>.skills");

            items_array = '[';
            jQuery('#skills_items > li').each(function(){

                if ( jQuery(this).index() + 1 < jQuery('#skills_items > li').length ) { var comma = ','}else{var comma = ''};
                item_id = jQuery(this).find('[data-builder-name="item_id"]').val();
                item_title = jQuery(this).find('[data-builder-name="title"]').val().replace(/"/g, '--quote--');
                item_percentage = jQuery(this).find('[data-builder-name="percentage"]').val();
                item_color = jQuery(this).find('[data-builder-name="color"]').val();

                items_array = items_array +  '{"id":' + '"' + item_id + '"' + ',"title":' + '"' + item_title + '"' + ',"percentage":' + '"' + item_percentage + '"' + ',"color":' + '"' + item_color + '"' + '}' + comma;

            });

            items_array = items_array + ']';
            jQuery('#skills_content').val(items_array);

            dataAttr = {};
            dataAttr['element-type'] = 'skills';
            dataAttr['admin-label'] = elements.find("#skills-admin-label").val();
            dataAttr['display-mode'] = elements.find("#skills-display-mode").val();
            dataAttr['skills'] = elements.find('#skills_content').val();

            if( elements.find('#skills-admin-label').val().length > 0 ){
                elementName = elements.find('#skills-admin-label').val();
            }

        } else if (elementType === 'image-carousel') {

            elements = $("#builder-elements>.image-carousel");
            dataAttr = {};
            dataAttr['element-type'] = 'image-carousel';
            dataAttr['carousel-height'] = elements.find("#carousel_height").val();
            dataAttr['images'] = elements.find("#carousel_image_gallery").val();
            dataAttr['admin-label'] = elements.find("#image-carousel-admin-label").val();



        } else if (elementType === 'sidebar') {

            elements = $("#builder-elements>.sidebar");
            dataAttr = {};
            dataAttr['element-type'] = 'sidebar';
            dataAttr['sidebar-id'] = elements.find("#ts_sidebar_sidebars option:selected").val();
            dataAttr['admin-label'] = elements.find("#sidebar-admin-label").val();

            if( elements.find('#sidebar-admin-label').val().length > 0 ){
               elementName = elements.find('#sidebar-admin-label').val();
            }

        } else if (elementType === 'slider') {

            elements = $("#builder-elements>.slider");
            dataAttr = {};

            dataAttr['element-type'] = 'slider';
            dataAttr['slider-id'] = elements.find("#slider-name option:selected").val();
            dataAttr['admin-label'] = elements.find("#slider-admin-label").val();

            if( elements.find('#slider-admin-label').val().length > 0 ){
               elementName = elements.find('#slider-admin-label').val();
            }


        } else if (elementType === 'list-portfolios') {

            elements = $("#builder-elements>.list-portfolios");
            dataAttr = {};

            dataAttr['element-type'] = 'list-portfolios';
            dataAttr['category'] = elements.find('select#list-portfolios-category').val();
            dataAttr['display-mode'] = elements.find('select#list-portfolios-display-mode').val();
            dataAttr['admin-label'] = elements.find("#list-portfolios-admin-label").val();

            if( elements.find('#list-portfolios-admin-label').val().length > 0 ){
               elementName = elements.find('#list-portfolios-admin-label').val();
            }

            if (dataAttr['display-mode'] === 'grid') {

                gridMode = elements.find("#list-portfolios-display-mode-options>.list-portfolios-grid");
                dataAttr['behavior'] = gridMode.find('#list-portfolios-grid-behavior').val();
                dataAttr['display-title'] = gridMode.find('#list-portfolios-grid-title').val();
                dataAttr['show-meta'] = gridMode.find('#list-portfolios-grid-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['elements-per-row'] = gridMode.find('#list-portfolios-grid-el-per-row').val();
                dataAttr['posts-limit'] = gridMode.find('#list-portfolios-grid-el-per-row').val();
                dataAttr['elements-per-row'] = gridMode.find('#list-portfolios-grid-el-per-row').val();
                dataAttr['posts-limit'] = gridMode.find('#list-portfolios-grid-nr-of-posts').val();
                dataAttr['order-by'] = gridMode.find('#list-portfolios-grid-order-by').val();
                dataAttr['order-direction'] = gridMode.find('#list-portfolios-grid-order-direction').val();
                dataAttr['special-effects'] = gridMode.find('#list-portfolios-grid-special-effects').val();

            } else if (dataAttr['display-mode'] === 'list') {

                listMode = elements.find("#list-portfolios-display-mode-options>.list-portfolios-list");
                dataAttr['display-title'] = listMode.find('#list-portfolios-list-title').val();
                dataAttr['show-meta'] = listMode.find('#list-portfolios-list-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = listMode.find('#list-portfolios-list-nr-of-posts').val();
                dataAttr['image-split'] = listMode.find('#list-portfolios-list-image-split').val();
                dataAttr['content-split'] = listMode.find('#list-portfolios-list-content-split').val();
                dataAttr['order-by'] = listMode.find('#list-portfolios-list-order-by').val();
                dataAttr['order-direction'] = listMode.find('#list-portfolios-list-order-direction').val();
                dataAttr['related-posts'] = listMode.find('#list-portfolios-list-show-related-y').attr('checked') ? 'y' : 'n';
                dataAttr['special-effects'] = listMode.find('#list-portfolios-list-special-effects').val();

            } else if (dataAttr['display-mode'] === 'thumbnails') {

                thumbnailsMode = elements.find("#list-portfolios-display-mode-options>.list-portfolios-thumbnails");
                dataAttr['display-title'] = thumbnailsMode.find('#list-portfolios-thumbnail-title').val();
                dataAttr['behavior'] = thumbnailsMode.find('#list-portfolios-thumbnail-behavior').val();
                dataAttr['elements-per-row'] = thumbnailsMode.find("#list-portfolios-thumbnail-posts-per-row").val();
                dataAttr['posts-limit'] = thumbnailsMode.find("#list-portfolios-thumbnail-limit").val();
                dataAttr['order-by'] = thumbnailsMode.find('#list-portfolios-thumbnail-order-by').val();
                dataAttr['order-direction'] = thumbnailsMode.find('#list-portfolios-thumbnail-order-direction').val();
                dataAttr['special-effects'] = thumbnailsMode.find('#list-portfolios-thumbnail-special-effects').val();
                dataAttr['gutter'] = thumbnailsMode.find('#list-portfolios-thumbnail-gutter').val();

            } else if (dataAttr['display-mode'] === 'big-post') {

                bigPostMode = elements.find("#list-portfolios-display-mode-options>.list-portfolios-big-post");
                dataAttr['display-title'] = bigPostMode.find('#list-portfolios-big-post-title').val();
                dataAttr['show-meta'] = bigPostMode.find('#list-portfolios-big-post-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = bigPostMode.find('#list-portfolios-big-post-nr-of-posts').val();
                dataAttr['image-split'] = bigPostMode.find('#list-portfolios-big-post-image-split').val();
                dataAttr['order-by'] = bigPostMode.find('#list-portfolios-big-post-order-by').val();
                dataAttr['order-direction'] = bigPostMode.find('#list-portfolios-big-post-order-direction').val();
                dataAttr['related-posts'] = bigPostMode.find('#list-portfolios-big-post-show-related-y').attr('checked') ? 'y' : 'n';
                dataAttr['special-effects'] = bigPostMode.find('#list-portfolios-big-post-special-effects').val();

            } else if (dataAttr['display-mode'] === 'super-post') {

                superPostMode = elements.find("#list-portfolios-display-mode-options>.list-portfolios-super-post");
                dataAttr['elements-per-row'] = superPostMode.find("#list-portfolios-super-post-posts-per-row").val();
                dataAttr['posts-limit'] = superPostMode.find('#list-portfolios-super-post-limit').val();
                dataAttr['order-by'] = superPostMode.find('#list-portfolios-super-post-order-by').val();
                dataAttr['order-direction'] = superPostMode.find('#list-portfolios-super-post-order-direction').val();
                dataAttr['related-posts'] = superPostMode.find('#list-portfolios-super-post-show-related-y').attr('checked') ? 'y' : 'n';
                dataAttr['special-effects'] = superPostMode.find('#list-portfolios-super-post-special-effects').val();
            }

        } else if (elementType === 'testimonials') {

            elements = $("#builder-elements>.testimonials");

            items_array = '[';
            jQuery('#testimonials_items > li').each(function(){

                if ( jQuery(this).index() + 1 < jQuery('#testimonials_items > li').length ) { var comma = ','}else{var comma = ''};
                item_id = jQuery(this).find('[data-builder-name="item_id"]').val();
                item_image = jQuery(this).find('[data-role="media-url"]').val().replace(/"/g, '--quote--');
                item_text = jQuery(this).find('[data-builder-name="text"]').val().replace(/"/g, '--quote--').replace(/\r?\n/g, '<br />');
                item_name = jQuery(this).find('[data-builder-name="name"]').val().replace(/"/g, '--quote--');
                item_company = jQuery(this).find('[data-builder-name="company"]').val().replace(/"/g, '--quote--');
                item_url = jQuery(this).find('[data-builder-name="url"]').val().replace(/"/g, '--quote--');

                items_array = items_array +  '{"id":' + '"' + item_id + '"' + ',"image":' + '"' + item_image + '"' + ',"text":' + '"' + item_text + '"' + ',"name":' + '"' + item_name + '"' + ',"company":' + '"' + item_company + '"' + ',"url":' + '"' + item_url + '"' + '}' + comma;

            });

            items_array = items_array + ']';
            jQuery('#testimonials_content').val(items_array);
            dataAttr = {};

            dataAttr['elements-per-row'] = isNaN(parseInt(elements.find('#testimonials-row').val(), 10)) ? 3 : parseInt(elements.find('#testimonials-row').val(), 10);
            dataAttr['enable-carousel'] = elements.find('#testimonials-enable-carousel').val();
            dataAttr['element-type'] = 'testimonials';
            dataAttr['testimonials'] = elements.find('#testimonials_content').val();
            dataAttr['admin-label'] = elements.find("#testimonials-admin-label").val();

            if( elements.find('#testimonials-admin-label').val().length > 0 ){
                elementName = elements.find('#testimonials-admin-label').val();
            }

        } else if (elementType === 'tab') {

            elements = $("#builder-elements>.tab");

            items_array = '[';
            jQuery('#tab_items > li').each(function(){

                if ( jQuery(this).index() + 1 < jQuery('#tab_items > li').length ) { var comma = ','}else{var comma = ''};
                item_id = jQuery(this).find('[data-builder-name="item_id"]').val();
                item_title = jQuery(this).find('[data-builder-name="title"]').val().replace(/"/g, '--quote--');
                item_text = jQuery(this).find('[data-builder-name="text"]').val().replace(/"/g, '--quote--').replace(/\r?\n/g, '<br />');

                items_array = items_array +  '{"id":' + '"' + item_id + '"' + ',"title":' + '"' + item_title + '"' + ',"text":' + '"' + item_text + '"' + '}' + comma;

            });

            items_array = items_array + ']';
            jQuery('#tab_content').val(items_array);
            dataAttr = {};

            dataAttr['element-type'] = 'tab';
            dataAttr['tab'] = elements.find('#tab_content').val();
            dataAttr['admin-label'] = elements.find("#tab-admin-label").val();
            dataAttr['mode'] = elements.find("#tab-mode").val();

            if( elements.find('#tab-admin-label').val().length > 0 ){
                elementName = elements.find('#tab-admin-label').val();
            }

        } else if (elementType === 'video-carousel') {

            elements = $("#builder-elements>.video-carousel");

            items_array = '[';
            jQuery('#video-carousel_items > li').each(function(){

                if ( jQuery(this).index() + 1 < jQuery('#video-carousel_items > li').length ) { var comma = ','}else{var comma = ''};
                item_id = jQuery(this).find('[data-builder-name="item_id"]').val();
                item_title = jQuery(this).find('[data-builder-name="title"]').val().replace(/"/g, '--quote--');
                item_url = jQuery(this).find('[data-builder-name="url"]').val().replace(/"/g, '--quote--');
                item_embed = jQuery(this).find('[data-builder-name="embed"]').val().replace(/"/g, '--quote--');
                item_text = jQuery(this).find('[data-builder-name="text"]').val().replace(/"/g, '--quote--').replace(/\r?\n/g, '<br />');

                items_array = items_array +  '{"id":' + '"' + item_id + '"' + ',"title":' + '"' + item_title + '"' + ',"text":' + '"' + item_text + '"' + ',"url":' + '"' + item_url + '"' + ',"embed":' + '"' + item_embed + '"' + '}' + comma;

            });

            items_array = items_array + ']';
            jQuery('#video-carousel_content').val(items_array);
            dataAttr = {};

            dataAttr['element-type'] = 'video-carousel';
            dataAttr['video-carousel'] = elements.find('#video-carousel_content').val();
            dataAttr['admin-label'] = elements.find("#video-carousel-admin-label").val();
            dataAttr['source'] = elements.find("#video-carousel-source").val();

            if( elements.find('#video-carousel-admin-label').val().length > 0 ){
                elementName = elements.find('#video-carousel-admin-label').val();
            }

        } else if (elementType === 'count-down') {

            elements = $("#builder-elements>.count-down");
            dataAttr = {};

            dataAttr['element-type'] = 'count-down';
            dataAttr['admin-label'] = elements.find("#count-down-admin-label").val();
            dataAttr['title'] = elements.find("#count-down-title").val();
            dataAttr['date'] = elements.find("#count-down-date").val();
            dataAttr['hours'] = elements.find("#count-down-hours").val();
            dataAttr['style'] = elements.find("#count-down-style").val();

            if( elements.find('#count-down-admin-label').val().length > 0 ){
                elementName = elements.find('#count-down-admin-label').val();
            }

        } else if (elementType === 'list-products') {

            elements = $("#builder-elements>.list-products");
            dataAttr = {};

            dataAttr['element-type'] = 'list-products';
            dataAttr['category'] = elements.find('select#list-products-category').val();
            dataAttr['admin-label'] = elements.find("#list-products-admin-label").val();

            if( elements.find('#list-products-admin-label').val().length > 0 ){
                elementName = elements.find('#list-products-admin-label').val();
            }

            gridMode = elements.find("#list-products-options>.list-products");
            dataAttr['behavior'] = gridMode.find('#list-products-behavior').val();
            dataAttr['elements-per-row'] = gridMode.find('#list-products-el-per-row').val();
            dataAttr['posts-limit'] = gridMode.find('#list-products-el-per-row').val();
            dataAttr['elements-per-row'] = gridMode.find('#list-products-el-per-row').val();
            dataAttr['posts-limit'] = gridMode.find('#list-products-nr-of-posts').val();
            dataAttr['order-by'] = gridMode.find('#list-products-order-by').val();
            dataAttr['order-direction'] = gridMode.find('#list-products-order-direction').val();
            dataAttr['special-effects'] = gridMode.find('#list-products-special-effects').val();

        } else if (elementType === 'last-posts') {

            elements = $("#builder-elements>.last-posts");
            dataAttr = {};

            dataAttr['element-type'] = 'last-posts';
            dataAttr['category'] = elements.find('select#last-posts-category').val();
            dataAttr['display-mode'] = elements.find('select#last-posts-display-mode').val();
            dataAttr['id-exclude'] = elements.find('#last-posts-exclude').val();
            dataAttr['exclude-first'] = elements.find('#last-posts-exclude-first').val();
            dataAttr['admin-label'] = elements.find("#last-posts-admin-label").val();
            dataAttr['featured'] = elements.find("#last-posts-featured").val();

            if( elements.find('#last-posts-admin-label').val().length > 0 ){
                elementName = elements.find('#last-posts-admin-label').val();
            }

            if (dataAttr['display-mode'] === 'grid') {

                gridMode = elements.find("#last-posts-display-mode-options>.last-posts-grid");
                dataAttr['behavior'] = gridMode.find('#last-posts-grid-behavior').val();
                dataAttr['display-title'] = gridMode.find('#last-posts-grid-title').val();
                dataAttr['show-meta'] = gridMode.find('#last-posts-grid-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['elements-per-row'] = gridMode.find('#last-posts-grid-el-per-row').val();
                dataAttr['posts-limit'] = gridMode.find('#last-posts-grid-el-per-row').val();
                dataAttr['elements-per-row'] = gridMode.find('#last-posts-grid-el-per-row').val();
                dataAttr['posts-limit'] = gridMode.find('#last-posts-grid-nr-of-posts').val();
                dataAttr['order-by'] = gridMode.find('#last-posts-grid-order-by').val();
                dataAttr['order-direction'] = gridMode.find('#last-posts-grid-order-direction').val();
                dataAttr['special-effects'] = gridMode.find('#last-posts-grid-special-effects').val();
                dataAttr['pagination'] = gridMode.find('#last-posts-grid-pagination').val();
                dataAttr['related-posts'] = gridMode.find('#last-posts-grid-related').val();
                dataAttr['show-image'] = gridMode.find('#last-posts-grid-image').val();

            } else if (dataAttr['display-mode'] === 'list') {

                listMode = elements.find("#last-posts-display-mode-options>.last-posts-list");
                dataAttr['display-title'] = listMode.find('#last-posts-list-title').val();
                dataAttr['show-meta'] = listMode.find('#last-posts-list-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = listMode.find('#last-posts-list-nr-of-posts').val();
                dataAttr['image-split'] = listMode.find('#last-posts-list-image-split').val();
                dataAttr['content-split'] = listMode.find('#last-posts-list-content-split').val();
                dataAttr['order-by'] = listMode.find('#last-posts-list-order-by').val();
                dataAttr['order-direction'] = listMode.find('#last-posts-list-order-direction').val();
                dataAttr['related-posts'] = listMode.find('#last-posts-list-show-related-y').attr('checked') ? 'y' : 'n';
                dataAttr['special-effects'] = listMode.find('#last-posts-list-special-effects').val();
                dataAttr['pagination'] = listMode.find('#last-posts-list-pagination').val();
                dataAttr['show-image'] = listMode.find('#last-posts-list-image').val();

            } else if (dataAttr['display-mode'] === 'thumbnails') {

                thumbnailsMode = elements.find("#last-posts-display-mode-options>.last-posts-thumbnails");
                dataAttr['display-title'] = thumbnailsMode.find('#last-posts-thumbnail-title').val();
                dataAttr['behavior'] = thumbnailsMode.find('#last-posts-thumbnails-behavior').val();
                dataAttr['elements-per-row'] = thumbnailsMode.find("#last-posts-thumbnail-posts-per-row").val();
                dataAttr['posts-limit'] = thumbnailsMode.find("#last-posts-thumbnail-limit").val();
                dataAttr['order-by'] = thumbnailsMode.find('#last-posts-thumbnail-order-by').val();
                dataAttr['order-direction'] = thumbnailsMode.find('#last-posts-thumbnails-order-direction').val();
                dataAttr['special-effects'] = thumbnailsMode.find('#last-posts-thumbnail-special-effects').val();
                dataAttr['gutter'] = thumbnailsMode.find('#last-posts-thumbnail-gutter').val();
                dataAttr['meta-thumbnail'] = thumbnailsMode.find('#last-posts-thumbnail-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['pagination'] = thumbnailsMode.find('#last-posts-thumbnails-pagination').val();

            } else if (dataAttr['display-mode'] === 'big-post') {

                bigPostMode = elements.find("#last-posts-display-mode-options>.last-posts-big-post");
                dataAttr['display-title'] = bigPostMode.find('#last-posts-big-post-title').val();
                dataAttr['show-meta'] = bigPostMode.find('#last-posts-big-post-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = bigPostMode.find('#last-posts-big-post-nr-of-posts').val();
                dataAttr['image-split'] = bigPostMode.find('#last-posts-big-post-image-split').val();
                dataAttr['order-by'] = bigPostMode.find('#last-posts-big-post-order-by').val();
                dataAttr['order-direction'] = bigPostMode.find('#last-posts-big-post-order-direction').val();
                dataAttr['related-posts'] = bigPostMode.find('#last-posts-big-post-related').val();
                dataAttr['special-effects'] = bigPostMode.find('#last-posts-big-post-special-effects').val();
                dataAttr['pagination'] = bigPostMode.find('#last-posts-big-post-pagination').val();
                dataAttr['image-position'] = bigPostMode.find('#last-posts-big-post-image-position').val();
                dataAttr['excerpt'] = bigPostMode.find('#last-posts-big-post-excerpt').val();
                dataAttr['carousel'] = bigPostMode.find('#last-posts-big-post-carousel').val();
                dataAttr['show-image'] = bigPostMode.find('#last-posts-big-post-image').val();

            } else if (dataAttr['display-mode'] === 'timeline') {

                timelineMode = elements.find("#last-posts-display-mode-options>.last-posts-timeline");
                dataAttr['display-title'] = timelineMode.find('#last-posts-timeline-title').val();
                dataAttr['show-meta'] = timelineMode.find('#last-posts-timeline-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = timelineMode.find('#last-posts-timeline-post-limit').val();
                dataAttr['image'] = timelineMode.find('#last-posts-timeline-image').val();
                dataAttr['order-by'] = timelineMode.find('#last-posts-timeline-order-by').val();
                dataAttr['order-direction'] = timelineMode.find('#last-posts-timeline-order-direction').val();
                dataAttr['pagination'] = timelineMode.find('#last-posts-timeline-pagination').val();

            } else if (dataAttr['display-mode'] === 'mosaic') {

                mosaicMode = elements.find("#last-posts-display-mode-options>.last-posts-mosaic");
                dataAttr['order-by'] = mosaicMode.find('#last-posts-mosaic-order-by').val();
                dataAttr['order-direction'] = mosaicMode.find('#last-posts-mosaic-order-direction').val();
                dataAttr['effects-scroll'] = mosaicMode.find('#last-posts-mosaic-effects').val();
                dataAttr['gutter'] = mosaicMode.find('#last-posts-mosaic-gutter').val();
                dataAttr['layout'] = mosaicMode.find('#last-posts-mosaic-layout').val();
                dataAttr['rows'] = mosaicMode.find('#last-posts-mosaic-rows').val();
                dataAttr['scroll'] = mosaicMode.find('#last-posts-mosaic-scroll').val();
                dataAttr['pagination'] = mosaicMode.find('#last-posts-mosaic-pagination').val();

                if( dataAttr['layout'] == 'rectangles' ){
                    dataAttr['posts-limit'] = mosaicMode.find("#last-posts-mosaic-post-limit-rows-" + dataAttr['rows'] + "").val();
                }else{
                    dataAttr['posts-limit'] = mosaicMode.find("#last-posts-mosaic-post-limit-rows-squares").val();
                }

            } else if (dataAttr['display-mode'] === 'super-post') {

                superPostMode = elements.find("#last-posts-display-mode-options>.last-posts-super-post");
                dataAttr['elements-per-row'] = superPostMode.find("#last-posts-super-post-posts-per-row").val();
                dataAttr['posts-limit'] = superPostMode.find('#last-posts-super-post-limit').val();
                dataAttr['order-by'] = superPostMode.find('#last-posts-super-post-order-by').val();
                dataAttr['order-direction'] = superPostMode.find('#last-posts-super-post-order-direction').val();
                dataAttr['related-posts'] = superPostMode.find('#last-posts-super-post-show-related-y').attr('checked') ? 'y' : 'n';
                dataAttr['special-effects'] = superPostMode.find('#last-posts-super-post-special-effects').val();
                dataAttr['pagination'] = superPostMode.find('#last-posts-super-post-pagination').val();
            }

        } else if (elementType === 'list-galleries') {

            elements = $("#builder-elements>.list-galleries");
            dataAttr = {};

            dataAttr['element-type'] = 'list-galleries';
            dataAttr['category'] = elements.find('select#list-galleries-category').val();
            dataAttr['display-mode'] = elements.find('select#list-galleries-display-mode').val();
            dataAttr['id-exclude'] = elements.find('#list-galleries-exclude').val();
            dataAttr['exclude-first'] = elements.find('#list-galleries-exclude-first').val();
            dataAttr['admin-label'] = elements.find("#list-galleries-admin-label").val();
            dataAttr['featured'] = elements.find("#list-galleries-featured").val();

            if( elements.find('#list-galleries-admin-label').val().length > 0 ){
                elementName = elements.find('#list-galleries-admin-label').val();
            }

            if (dataAttr['display-mode'] === 'grid') {

                gridMode = elements.find("#list-galleries-display-mode-options>.list-galleries-grid");
                dataAttr['behavior'] = gridMode.find('#list-galleries-grid-behavior').val();
                dataAttr['display-title'] = gridMode.find('#list-galleries-grid-title').val();
                dataAttr['show-meta'] = gridMode.find('#list-galleries-grid-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['elements-per-row'] = gridMode.find('#list-galleries-grid-el-per-row').val();
                dataAttr['posts-limit'] = gridMode.find('#list-galleries-grid-el-per-row').val();
                dataAttr['elements-per-row'] = gridMode.find('#list-galleries-grid-el-per-row').val();
                dataAttr['posts-limit'] = gridMode.find('#list-galleries-grid-nr-of-posts').val();
                dataAttr['order-by'] = gridMode.find('#list-galleries-grid-order-by').val();
                dataAttr['order-direction'] = gridMode.find('#list-galleries-grid-order-direction').val();
                dataAttr['special-effects'] = gridMode.find('#list-galleries-grid-special-effects').val();
                dataAttr['pagination'] = gridMode.find('#list-galleries-grid-pagination').val();
                dataAttr['related-posts'] = gridMode.find('#list-galleries-grid-related').val();
                dataAttr['show-image'] = gridMode.find('#list-galleries-grid-image').val();

            } else if (dataAttr['display-mode'] === 'list') {

                listMode = elements.find("#list-galleries-display-mode-options>.list-galleries-list");
                dataAttr['display-title'] = listMode.find('#list-galleries-list-title').val();
                dataAttr['show-meta'] = listMode.find('#list-galleries-list-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = listMode.find('#list-galleries-list-nr-of-posts').val();
                dataAttr['image-split'] = listMode.find('#list-galleries-list-image-split').val();
                dataAttr['content-split'] = listMode.find('#list-galleries-list-content-split').val();
                dataAttr['order-by'] = listMode.find('#list-galleries-list-order-by').val();
                dataAttr['order-direction'] = listMode.find('#list-galleries-list-order-direction').val();
                dataAttr['related-posts'] = listMode.find('#list-galleries-list-show-related-y').attr('checked') ? 'y' : 'n';
                dataAttr['special-effects'] = listMode.find('#list-galleries-list-special-effects').val();
                dataAttr['pagination'] = listMode.find('#list-galleries-list-pagination').val();
                dataAttr['show-image'] = listMode.find('#list-galleries-list-image').val();

            } else if (dataAttr['display-mode'] === 'thumbnails') {

                thumbnailsMode = elements.find("#list-galleries-display-mode-options>.list-galleries-thumbnails");
                dataAttr['display-title'] = thumbnailsMode.find('#list-galleries-thumbnail-title').val();
                dataAttr['behavior'] = thumbnailsMode.find('#list-galleries-thumbnails-behavior').val();
                dataAttr['elements-per-row'] = thumbnailsMode.find("#list-galleries-thumbnail-posts-per-row").val();
                dataAttr['posts-limit'] = thumbnailsMode.find("#list-galleries-thumbnail-limit").val();
                dataAttr['order-by'] = thumbnailsMode.find('#list-galleries-thumbnail-order-by').val();
                dataAttr['order-direction'] = thumbnailsMode.find('#list-galleries-thumbnails-order-direction').val();
                dataAttr['special-effects'] = thumbnailsMode.find('#list-galleries-thumbnail-special-effects').val();
                dataAttr['gutter'] = thumbnailsMode.find('#list-galleries-thumbnail-gutter').val();
                dataAttr['meta-thumbnail'] = thumbnailsMode.find('#list-galleries-thumbnail-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['pagination'] = thumbnailsMode.find('#list-galleries-thumbnails-pagination').val();

            } else if (dataAttr['display-mode'] === 'big-post') {

                bigPostMode = elements.find("#list-galleries-display-mode-options>.list-galleries-big-post");
                dataAttr['display-title'] = bigPostMode.find('#list-galleries-big-post-title').val();
                dataAttr['show-meta'] = bigPostMode.find('#list-galleries-big-post-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = bigPostMode.find('#list-galleries-big-post-nr-of-posts').val();
                dataAttr['image-split'] = bigPostMode.find('#list-galleries-big-post-image-split').val();
                dataAttr['order-by'] = bigPostMode.find('#list-galleries-big-post-order-by').val();
                dataAttr['order-direction'] = bigPostMode.find('#list-galleries-big-post-order-direction').val();
                dataAttr['related-posts'] = bigPostMode.find('#list-galleries-big-post-related').val();
                dataAttr['special-effects'] = bigPostMode.find('#list-galleries-big-post-special-effects').val();
                dataAttr['pagination'] = bigPostMode.find('#list-galleries-big-post-pagination').val();
                dataAttr['image-position'] = bigPostMode.find('#list-galleries-big-post-image-position').val();
                dataAttr['excerpt'] = bigPostMode.find('#list-galleries-big-post-excerpt').val();
                dataAttr['carousel'] = bigPostMode.find('#list-galleries-big-post-carousel').val();
                dataAttr['show-image'] = bigPostMode.find('#list-galleries-big-post-image').val();

            } else if (dataAttr['display-mode'] === 'timeline') {

                timelineMode = elements.find("#list-galleries-display-mode-options>.list-galleries-timeline");
                dataAttr['display-title'] = timelineMode.find('#list-galleries-timeline-title').val();
                dataAttr['show-meta'] = timelineMode.find('#list-galleries-timeline-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = timelineMode.find('#list-galleries-timeline-post-limit').val();
                dataAttr['image'] = timelineMode.find('#list-galleries-timeline-image').val();
                dataAttr['order-by'] = timelineMode.find('#list-galleries-timeline-order-by').val();
                dataAttr['order-direction'] = timelineMode.find('#list-galleries-timeline-order-direction').val();
                dataAttr['pagination'] = timelineMode.find('#list-galleries-timeline-pagination').val();

            } else if (dataAttr['display-mode'] === 'mosaic') {

                mosaicMode = elements.find("#list-galleries-display-mode-options>.list-galleries-mosaic");
                dataAttr['order-by'] = mosaicMode.find('#list-galleries-mosaic-order-by').val();
                dataAttr['order-direction'] = mosaicMode.find('#list-galleries-mosaic-order-direction').val();
                dataAttr['effects-scroll'] = mosaicMode.find('#list-galleries-mosaic-effects').val();
                dataAttr['gutter'] = mosaicMode.find('#list-galleries-mosaic-gutter').val();
                dataAttr['layout'] = mosaicMode.find('#list-galleries-mosaic-layout').val();
                dataAttr['rows'] = mosaicMode.find('#list-galleries-mosaic-rows').val();
                dataAttr['scroll'] = mosaicMode.find('#list-galleries-mosaic-scroll').val();
                dataAttr['pagination'] = mosaicMode.find('#list-galleries-mosaic-pagination').val();

                if( dataAttr['layout'] == 'rectangles' ){
                    dataAttr['posts-limit'] = mosaicMode.find("#list-galleries-mosaic-post-limit-rows-" + dataAttr['rows'] + "").val();
                }else{
                    dataAttr['posts-limit'] = mosaicMode.find("#list-galleries-mosaic-post-limit-rows-squares").val();
                }

            } else if (dataAttr['display-mode'] === 'super-post') {

                superPostMode = elements.find("#list-galleries-display-mode-options>.list-galleries-super-post");
                dataAttr['elements-per-row'] = superPostMode.find("#list-galleries-super-post-posts-per-row").val();
                dataAttr['posts-limit'] = superPostMode.find('#list-galleries-super-post-limit').val();
                dataAttr['order-by'] = superPostMode.find('#list-galleries-super-post-order-by').val();
                dataAttr['order-direction'] = superPostMode.find('#list-galleries-super-post-order-direction').val();
                dataAttr['related-posts'] = superPostMode.find('#list-galleries-super-post-show-related-y').attr('checked') ? 'y' : 'n';
                dataAttr['special-effects'] = superPostMode.find('#list-galleries-super-post-special-effects').val();
                dataAttr['pagination'] = superPostMode.find('#list-galleries-super-post-pagination').val();
            }

        } else if (elementType === 'accordion') {

            elements = $("#builder-elements>.accordion");
            dataAttr = {};

            dataAttr['element-type'] = 'accordion';
            dataAttr['admin-label'] = elements.find("#accordion-admin-label").val();
            dataAttr['posts-type'] = elements.find('#accordion-posts-type').val();
            dataAttr['featured'] = elements.find('#accordion-featured').val();
            dataAttr['nr-of-posts'] = elements.find("#accordion-nr-of-posts").val();
            dataAttr['order-by'] = elements.find("#accordion-order-by").val();
            dataAttr['order-direction'] = elements.find("#accordion-order-direction").val();
            dataAttr['category'] = '';

            var arrayCategories = elements.find('#accordion-' + dataAttr['posts-type'] + '-category').val();
            if( typeof(arrayCategories) !== 'undefined' ){
               for(index in arrayCategories){
                   dataAttr['category'] =  dataAttr['category'] + arrayCategories[index] + ',';
               }
            }

            if( elements.find('#accordion-admin-label').val().length > 0 ){
                elementName = elements.find('#accordion-admin-label').val();
            }

        }else if (elementType === 'latest-custom-posts') {

            elements = $("#builder-elements>.latest-custom-posts");
            dataAttr = {};

            dataAttr['element-type'] = 'latest-custom-posts';
            dataAttr['post-type'] = elements.find('select#latest-custom-posts-type').val();
            dataAttr['display-mode'] = elements.find('select#latest-custom-posts-display-mode').val();
            dataAttr['id-exclude'] = elements.find('#latest-custom-posts-exclude').val();
            dataAttr['exclude-first'] = elements.find('#latest-custom-posts-exclude-first').val();
            dataAttr['admin-label'] = elements.find("#latest-custom-posts-admin-label").val();
            dataAttr['featured'] = elements.find("#latest-custom-posts-featured").val();
            dataAttr['category'] = '';

            for(key in dataAttr['post-type']){
                var arrayCategories = elements.find('#latest-custom-posts-category-' + dataAttr['post-type'][key]).val();
                if( typeof(arrayCategories) !== 'undefined' ){
                   for(index in arrayCategories){
                       dataAttr['category'] =  dataAttr['category'] + arrayCategories[index] + ',';
                   }
                }
            }

            if( elements.find('#latest-custom-posts-admin-label').val().length > 0 ){
                elementName = elements.find('#latest-custom-posts-admin-label').val();
            }

            if (dataAttr['display-mode'] === 'grid') {

                gridMode = elements.find("#latest-custom-posts-display-mode-options>.latest-custom-posts-grid");
                dataAttr['behavior'] = gridMode.find('#latest-custom-posts-grid-behavior').val();
                dataAttr['display-title'] = gridMode.find('#latest-custom-posts-grid-title').val();
                dataAttr['show-meta'] = gridMode.find('#latest-custom-posts-grid-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['elements-per-row'] = gridMode.find('#latest-custom-posts-grid-el-per-row').val();
                dataAttr['posts-limit'] = gridMode.find('#latest-custom-posts-grid-el-per-row').val();
                dataAttr['elements-per-row'] = gridMode.find('#latest-custom-posts-grid-el-per-row').val();
                dataAttr['posts-limit'] = gridMode.find('#latest-custom-posts-grid-nr-of-posts').val();
                dataAttr['order-by'] = gridMode.find('#latest-custom-posts-grid-order-by').val();
                dataAttr['order-direction'] = gridMode.find('#latest-custom-posts-grid-order-direction').val();
                dataAttr['special-effects'] = gridMode.find('#latest-custom-posts-grid-special-effects').val();
                dataAttr['pagination'] = gridMode.find('#latest-custom-posts-grid-pagination').val();
                dataAttr['related-posts'] = gridMode.find('#latest-custom-posts-grid-related').val();
                dataAttr['show-image'] = gridMode.find('#latest-custom-posts-grid-image').val();

            } else if (dataAttr['display-mode'] === 'list') {

                listMode = elements.find("#latest-custom-posts-display-mode-options>.latest-custom-posts-list");
                dataAttr['display-title'] = listMode.find('#latest-custom-posts-list-title').val();
                dataAttr['show-meta'] = listMode.find('#latest-custom-posts-list-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = listMode.find('#latest-custom-posts-list-nr-of-posts').val();
                dataAttr['image-split'] = listMode.find('#latest-custom-posts-list-image-split').val();
                dataAttr['content-split'] = listMode.find('#latest-custom-posts-list-content-split').val();
                dataAttr['order-by'] = listMode.find('#latest-custom-posts-list-order-by').val();
                dataAttr['order-direction'] = listMode.find('#latest-custom-posts-list-order-direction').val();
                dataAttr['related-posts'] = listMode.find('#latest-custom-posts-list-show-related-y').attr('checked') ? 'y' : 'n';
                dataAttr['special-effects'] = listMode.find('#latest-custom-posts-list-special-effects').val();
                dataAttr['pagination'] = listMode.find('#latest-custom-posts-list-pagination').val();
                dataAttr['show-image'] = listMode.find('#latest-custom-posts-list-image').val();

            } else if (dataAttr['display-mode'] === 'thumbnails') {

                thumbnailsMode = elements.find("#latest-custom-posts-display-mode-options>.latest-custom-posts-thumbnails");
                dataAttr['display-title'] = thumbnailsMode.find('#latest-custom-posts-thumbnail-title').val();
                dataAttr['behavior'] = thumbnailsMode.find('#latest-custom-posts-thumbnails-behavior').val();
                dataAttr['elements-per-row'] = thumbnailsMode.find("#latest-custom-posts-thumbnail-posts-per-row").val();
                dataAttr['posts-limit'] = thumbnailsMode.find("#latest-custom-posts-thumbnail-limit").val();
                dataAttr['order-by'] = thumbnailsMode.find('#latest-custom-posts-thumbnail-order-by').val();
                dataAttr['order-direction'] = thumbnailsMode.find('#latest-custom-posts-thumbnails-order-direction').val();
                dataAttr['special-effects'] = thumbnailsMode.find('#latest-custom-posts-thumbnail-special-effects').val();
                dataAttr['gutter'] = thumbnailsMode.find('#latest-custom-posts-thumbnail-gutter').val();
                dataAttr['meta-thumbnail'] = thumbnailsMode.find('#latest-custom-posts-thumbnail-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['pagination'] = thumbnailsMode.find('#latest-custom-posts-thumbnails-pagination').val();

            } else if (dataAttr['display-mode'] === 'big-post') {

                bigPostMode = elements.find("#latest-custom-posts-display-mode-options>.latest-custom-posts-big-post");
                dataAttr['display-title'] = bigPostMode.find('#latest-custom-posts-big-post-title').val();
                dataAttr['show-meta'] = bigPostMode.find('#latest-custom-posts-big-post-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = bigPostMode.find('#latest-custom-posts-big-post-nr-of-posts').val();
                dataAttr['image-split'] = bigPostMode.find('#latest-custom-posts-big-post-image-split').val();
                dataAttr['order-by'] = bigPostMode.find('#latest-custom-posts-big-post-order-by').val();
                dataAttr['order-direction'] = bigPostMode.find('#latest-custom-posts-big-post-order-direction').val();
                dataAttr['related-posts'] = bigPostMode.find('#latest-custom-posts-big-post-related').val();
                dataAttr['special-effects'] = bigPostMode.find('#latest-custom-posts-big-post-special-effects').val();
                dataAttr['pagination'] = bigPostMode.find('#latest-custom-posts-big-post-pagination').val();
                dataAttr['image-position'] = bigPostMode.find('#latest-custom-posts-big-post-image-position').val();
                dataAttr['excerpt'] = bigPostMode.find('#latest-custom-posts-big-post-excerpt').val();
                dataAttr['carousel'] = bigPostMode.find('#latest-custom-posts-big-post-carousel').val();
                dataAttr['show-image'] = bigPostMode.find('#latest-custom-posts-big-post-image').val();

            } else if (dataAttr['display-mode'] === 'timeline') {

                timelineMode = elements.find("#latest-custom-posts-display-mode-options>.latest-custom-posts-timeline");
                dataAttr['display-title'] = timelineMode.find('#latest-custom-posts-timeline-title').val();
                dataAttr['show-meta'] = timelineMode.find('#latest-custom-posts-timeline-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = timelineMode.find('#latest-custom-posts-timeline-post-limit').val();
                dataAttr['image'] = timelineMode.find('#latest-custom-posts-timeline-image').val();
                dataAttr['order-by'] = timelineMode.find('#latest-custom-posts-timeline-order-by').val();
                dataAttr['order-direction'] = timelineMode.find('#latest-custom-posts-timeline-order-direction').val();
                dataAttr['pagination'] = timelineMode.find('#latest-custom-posts-timeline-pagination').val();

            } else if (dataAttr['display-mode'] === 'mosaic') {

                mosaicMode = elements.find("#latest-custom-posts-display-mode-options>.latest-custom-posts-mosaic");
                dataAttr['posts-limit'] = mosaicMode.find("#latest-custom-posts-mosaic-post-limit").val();
                dataAttr['order-by'] = mosaicMode.find('#latest-custom-posts-mosaic-order-by').val();
                dataAttr['order-direction'] = mosaicMode.find('#latest-custom-posts-mosaic-order-direction').val();
                dataAttr['effects-scroll'] = mosaicMode.find('#latest-custom-posts-mosaic-effects').val();
                dataAttr['gutter'] = mosaicMode.find('#latest-custom-posts-mosaic-gutter').val();
                dataAttr['layout'] = mosaicMode.find('#latest-custom-posts-mosaic-layout').val();
                dataAttr['rows'] = mosaicMode.find('#latest-custom-posts-mosaic-rows').val();
                dataAttr['scroll'] = mosaicMode.find('#latest-custom-posts-mosaic-scroll').val();
                dataAttr['pagination'] = mosaicMode.find('#latest-custom-posts-mosaic-pagination').val();

                if( dataAttr['layout'] == 'rectangles' ){
                    dataAttr['posts-limit'] = mosaicMode.find("#latest-custom-posts-mosaic-post-limit-rows-" + dataAttr['rows'] + "").val();
                }else{
                    dataAttr['posts-limit'] = mosaicMode.find("#latest-custom-posts-mosaic-post-limit-rows-squares").val();
                }

            } else if (dataAttr['display-mode'] === 'super-post') {

                superPostMode = elements.find("#latest-custom-posts-display-mode-options>.latest-custom-posts-super-post");
                dataAttr['elements-per-row'] = superPostMode.find("#latest-custom-posts-super-post-posts-per-row").val();
                dataAttr['posts-limit'] = superPostMode.find('#latest-custom-posts-super-post-limit').val();
                dataAttr['order-by'] = superPostMode.find('#latest-custom-posts-super-post-order-by').val();
                dataAttr['order-direction'] = superPostMode.find('#latest-custom-posts-super-post-order-direction').val();
                dataAttr['related-posts'] = superPostMode.find('#latest-custom-posts-super-post-show-related-y').attr('checked') ? 'y' : 'n';
                dataAttr['special-effects'] = superPostMode.find('#latest-custom-posts-super-post-special-effects').val();
                dataAttr['pagination'] = superPostMode.find('#latest-custom-posts-super-post-pagination').val();
            }

        } else if (elementType === 'callaction') {

            elements = $("#builder-elements>.callaction");
            dataAttr = {};

            dataAttr['element-type'] = 'callaction';
            dataAttr['callaction-text'] = elements.find('#callaction-text').val();
            dataAttr['callaction-link'] = elements.find('#callaction-link').val();
            dataAttr['callaction-button-text'] = elements.find('#callaction-button-text').val();
            dataAttr['admin-label'] = elements.find("#callaction-admin-label").val();

            if( elements.find('#callaction-admin-label').val().length > 0 ){
                elementName = elements.find('#callaction-admin-label').val();
            }


        } else if (elementType === 'teams') {

            elements = $("#builder-elements>.teams");
            dataAttr = {};

            dataAttr['element-type'] = 'teams';
            dataAttr['elements-per-row'] = isNaN(parseInt(elements.find('#teams-elements-per-row').val(), 10)) ? 3 : parseInt(elements.find('#teams-elements-per-row').val(), 10);
            dataAttr['remove-gutter'] = elements.find('#teams-remove-gutter').val();
            dataAttr['enable-carousel'] = elements.find('#teams-enable-carousel').val();

            dataAttr['posts-limit'] = isNaN(parseInt(elements.find('#teams-post-limit').val(), 10)) ? 3 : parseInt(elements.find('#teams-post-limit').val(), 10);

            dataAttr['category'] = elements.find('#teams-category').val();
            dataAttr['admin-label'] = elements.find("#teams-admin-label").val();

            if( elements.find('#teams-admin-label').val().length > 0 ){
                elementName = elements.find('#teams-admin-label').val();
            }

        } else if (elementType === 'pricing-tables') {

            elements = $("#builder-elements>.pricing-tables");
            dataAttr = {};

            dataAttr['element-type'] = 'pricing-tables';
            dataAttr['elements-per-row'] = isNaN(parseInt(elements.find('#pricing-tables-elements-per-row').val(), 10)) ? 3 : parseInt(elements.find('#pricing-tables-elements-per-row').val(), 10);
            dataAttr['remove-gutter'] = elements.find('#pricing-tables-remove-gutter').val();

            dataAttr['posts-limit'] = isNaN(parseInt(elements.find('#pricing-tables-post-limit').val(), 10)) ? 3 : parseInt(elements.find('#pricing-tables-post-limit').val(), 10);

            dataAttr['category'] = elements.find('#pricing-tables-category').val();
            dataAttr['admin-label'] = elements.find("#pricing-tables-admin-label").val();

            if( elements.find('#pricing-tables-admin-label').val().length > 0 ){
                elementName = elements.find('#pricing-tables-admin-label').val();
            }

        } else if (elementType === 'advertising') {

            elements = $("#builder-elements>.advertising");
            dataAttr = {};

            dataAttr['element-type'] = 'advertising';
            dataAttr['advertising'] = elements.find('#advertising').val();
            dataAttr['admin-label'] = elements.find("#advertising-admin-label").val();

            if( elements.find('#advertising-admin-label').val().length > 0 ){
                elementName = elements.find('#advertising-admin-label').val();
            }

        } else if (elementType === 'empty') {

            dataAttr = {};
            dataAttr['element-type'] = 'empty';

        } else if (elementType === 'delimiter') {

            elements = $("#builder-elements>.delimiter");

            dataAttr = {};
            dataAttr['element-type'] = 'delimiter';
            dataAttr['delimiter-type'] = elements.find('#delimiter-type').val();
            dataAttr['delimiter-color'] = elements.find('#delimiter-color').val();
            dataAttr['admin-label'] = elements.find("#delimiter-admin-label").val();

            if( elements.find('#delimiter-admin-label').val().length > 0 ){
                elementName = elements.find('#delimiter-admin-label').val();
            }

        } else if (elementType === 'title') {

            elements = $("#builder-elements>.title");

            dataAttr = {};
            dataAttr['element-type'] = 'title';
            dataAttr['title'] = elements.find('#title-title').val();
            dataAttr['title-color'] = elements.find('#builder-element-title-color').val();
            dataAttr['title-icon'] = elements.find('#builder-element-title-icon').val();
            dataAttr['subtitle'] = elements.find('#title-subtitle').val();
            dataAttr['subtitle-color'] = elements.find('#builder-element-title-subtitle-color').val();
            dataAttr['style'] = elements.find('#title-style').val();
            dataAttr['size'] = elements.find('#title-size').val();
            dataAttr['admin-label'] = elements.find("#title-admin-label").val();

            if( elements.find('#title-admin-label').val().length > 0 ){
                elementName = elements.find('#title-admin-label').val();
            }

        } else if (elementType === 'video') {

            elements = $("#builder-elements>.video");

            dataAttr = {};
            dataAttr['element-type'] = 'video';
            dataAttr['embed'] = elements.find('#video-embed').val();
            dataAttr['admin-label'] = elements.find("#video-admin-label").val();
            dataAttr['lightbox'] = elements.find("#video-lightbox").val();
            dataAttr['title'] = elements.find("#video-title").val();

            if( elements.find('#video-admin-label').val().length > 0 ){
                elementName = elements.find('#video-admin-label').val();
            }

        } else if (elementType === 'facebook-block') {

            elements = $("#builder-elements>.facebook-block");

            dataAttr = {};
            dataAttr['element-type'] = 'facebook-block';
            dataAttr['facebook-url'] = elements.find('#facebook-url').val();
            dataAttr['facebook-background'] = elements.find('#facebook-background').val();

        } else if (elementType === 'image') {

            elements = $("#builder-elements>.image");

            dataAttr = {};
            dataAttr['element-type'] = 'image';
            dataAttr['image-url'] = elements.find('#image_url').val();
            dataAttr['forward-url'] = elements.find('#forward-image-url').val();
            dataAttr['image-target'] = elements.find('#image-target').val();
            dataAttr['image-lightbox'] = elements.find('#image-lightbox').val();
            dataAttr['admin-label'] = elements.find("#image-admin-label").val();
            dataAttr['retina'] = elements.find("#image-retina").val();
            dataAttr['align'] = elements.find("#image-align").val();

            if( elements.find('#image-admin-label').val().length > 0 ){
                elementName = elements.find('#image-admin-label').val();
            }

        }else if (elementType === 'powerlink') {

            elements = $("#builder-elements>.powerlink");

            dataAttr = {};
            dataAttr['element-type'] = 'powerlink';
            dataAttr['admin-label'] = elements.find("#powerlink-admin-label").val();
            dataAttr['title'] = elements.find("#powerlink-title").val();
            dataAttr['image'] = elements.find('#image-powerlink-url').val();
            dataAttr['button-url'] = elements.find('#powerlink-button-url').val();
            dataAttr['button-text'] = elements.find('#powerlink-button-text').val();

            if( elements.find('#powerlink-admin-label').val().length > 0 ){
                elementName = elements.find('#powerlink-admin-label').val();
            }

        } else if (elementType === 'filters') {

            elements = $("#builder-elements>.filters");

            dataAttr = {};
            dataAttr['element-type'] = 'filters';
            dataAttr['post-type'] = elements.find('#filters-post-type').val();

            if( jQuery('#filters-' + dataAttr['post-type'] + '-category').val() !== null ){
                dataAttr['categories'] = jQuery('#filters-' + dataAttr['post-type'] + '-category').val().join();
            }else{
                dataAttr['categories'] = '';
            }
            dataAttr['posts-limit'] = elements.find('#filters-posts-limit').val();
            dataAttr['elements-per-row'] = elements.find('#filters-elements-per-row').val();
            dataAttr['order-by'] = elements.find('#filters-order-by').val();
            dataAttr['direction'] = elements.find('#filters-order-direction').val();
            dataAttr['special-effects'] = elements.find('#filters-special-effects').val();
            dataAttr['gutter'] = elements.find('#filters-gutter').val();
            dataAttr['admin-label'] = elements.find("#filters-admin-label").val();

            if( elements.find('#filters-admin-label').val().length > 0 ){
                elementName = elements.find('#filters-admin-label').val();
            }

        } else if (elementType === 'toggle') {

            elements = $("#builder-elements>.toggle");

            dataAttr = {};
            dataAttr['element-type'] = 'toggle';
            dataAttr['toggle-title'] = elements.find('#toggle-title').val();
            dataAttr['toggle-description'] = elements.find('#toggle-description').val();
            dataAttr['toggle-state'] = elements.find('#toggle-state').val();
            dataAttr['admin-label'] = elements.find("#toggle-admin-label").val();

            if( elements.find('#toggle-admin-label').val().length > 0 ){
                elementName = elements.find('#toggle-admin-label').val();
            }


        } else if (elementType === 'timeline') {

            elements = $("#builder-elements>.timeline");

            items_array = '[';
            jQuery('#timeline_items > li').each(function(){

                if ( jQuery(this).index() + 1 < jQuery('#timeline_items > li').length ) { var comma = ','}else{var comma = ''};
                item_id = jQuery(this).find('[data-builder-name="item_id"]').val();
                item_image = jQuery(this).find('[data-role="media-url"]').val().replace(/"/g, '--quote--');
                item_text = jQuery(this).find('[data-builder-name="text"]').val().replace(/"/g, '--quote--').replace(/\r?\n/g, '<br />');
                item_title = jQuery(this).find('[data-builder-name="title"]').val().replace(/"/g, '--quote--');
                item_align = jQuery(this).find('[data-builder-name="align"]').val();

                items_array = items_array +  '{"id":' + '"' + item_id + '"' + ',"image":' + '"' + item_image + '"' + ',"text":' + '"' + item_text + '"' + ',"title":' + '"' + item_title + '"' + ',"align":' + '"' + item_align + '"' + '}' + comma;

            });
            items_array = items_array + ']';
            jQuery('#timeline_content').val(items_array);
            dataAttr = {};
            dataAttr['timeline'] = elements.find('#timeline_content').val();

            dataAttr['element-type'] = 'timeline';
            dataAttr['admin-label'] = elements.find("#timeline-admin-label").val();

            if( elements.find('#timeline-admin-label').val().length > 0 ){
                elementName = elements.find('#timeline-admin-label').val();
            }


        } else if (elementType === 'banner') {

            elements = $("#builder-elements>.banner");

            dataAttr = {};
            dataAttr['element-type'] = 'banner';
            dataAttr['banner-image'] = elements.find('#image-banner-url').val();
            dataAttr['banner-title'] = elements.find('#banner-title').val();
            dataAttr['banner-subtitle'] = elements.find('#banner-subtitle').val();
            dataAttr['banner-button-title'] = elements.find('#banner-button-title').val();
            dataAttr['banner-button-url'] = elements.find('#banner-button-url').val();
            dataAttr['banner-button-background'] = elements.find('#banner-button-background').val();
            dataAttr['banner-font-color'] = elements.find('#banner-font-color').val();
            dataAttr['banner-text-align'] = elements.find('#banner-text-align').val();
            dataAttr['banner-height'] = elements.find('#banner-height').val();
            dataAttr['admin-label'] = elements.find("#banner-admin-label").val();
            dataAttr['button-text-color'] = elements.find("#banner-button-text-color").val();

            if( elements.find('#banner-admin-label').val().length > 0 ){
                elementName = elements.find('#banner-admin-label').val();
            }

        } else if (elementType === 'map') {

            elements = $("#builder-elements>.map");

            dataAttr = {};
            dataAttr['element-type'] = 'map';
            dataAttr['admin-label'] = elements.find("#map-admin-label").val();
            dataAttr['map-address'] = elements.find('#map-address').val();
            dataAttr['map-width'] = elements.find('#map-width').val();
            dataAttr['map-height'] = elements.find('#map-height').val();
            dataAttr['map-latitude'] = elements.find('#map-latitude').val();
            dataAttr['map-longitude'] = elements.find('#map-longitude').val();
            dataAttr['map-type'] = elements.find('#map-type').val();
            dataAttr['map-style'] = elements.find('#map-style').val();
            dataAttr['map-zoom'] = elements.find('#map-zoom').val();
            dataAttr['map-type-control'] = elements.find('#map-type-control').val();
            dataAttr['map-zoom-control'] = elements.find('#map-zoom-control').val();
            dataAttr['map-scale-control'] = elements.find('#map-scale-control').val();
            dataAttr['map-scroll-wheel'] = elements.find('#map-scroll-wheel').val();
            dataAttr['map-draggable-direction'] = elements.find('#map-draggable-direction').val();
            dataAttr['map-marker-icon'] = elements.find('#map-marker-icon').val();
            dataAttr['map-marker-img'] = elements.find('#map-marker-attachment').val();

            if( elements.find('#map-admin-label').val().length > 0 ){
                elementName = elements.find('#map-admin-label').val();
            }

            setTimeout(function(){
                initialize();
            },100)

        } else if (elementType === 'counters') {

            elements = $("#builder-elements>.counters");

            dataAttr = {};
            dataAttr['element-type'] = 'counters';
            dataAttr['counters-text'] = elements.find('#counters-text').val();
            if( !isNaN(elements.find('#counters-precents').val()) ) {
                dataAttr['counters-precents'] = elements.find('#counters-precents').val();
            }
            dataAttr['admin-label'] = elements.find("#counters-admin-label").val();
            dataAttr['counters-text-color'] = elements.find('#counters-text-color').val();
            dataAttr['track-bar'] = elements.find('#counters-track-bar').val();
            dataAttr['track-bar-color'] = elements.find('#counters-track-bar-color').val();
            dataAttr['track-bar-icon'] = elements.find('#counters-icon').val();

            if( elements.find('#counters-admin-label').val().length > 0 ){
                elementName = elements.find('#counters-admin-label').val();
            }

        } else if (elementType === 'alert') {

            elements = $("#builder-elements>.alert");

            dataAttr = {};
            dataAttr['element-type'] = 'alert';
            dataAttr['admin-label'] = elements.find("#alert-admin-label").val();
            dataAttr['icon'] = elements.find('#alert-icon').val();
            dataAttr['title'] = elements.find('#alert-title').val();
            dataAttr['text'] = elements.find('#alert-text').val().replace(/\r?\n/g, '<br />');
            dataAttr['background-color'] = elements.find('#alert-background-color').val();
            dataAttr['text-color'] = elements.find('#alert-text-color').val();

            if( elements.find('#alert-admin-label').val().length > 0 ){
                elementName = elements.find('#alert-admin-label').val();
            }

        } else if (elementType === 'spacer') {

            elements = $("#builder-elements>.spacer");

            dataAttr = {};
            dataAttr['element-type'] = 'spacer';
            dataAttr['height'] = elements.find('#spacer-height').val();
            dataAttr['admin-label'] = elements.find("#spacer-admin-label").val();

            if( elements.find('#spacer-admin-label').val().length > 0 ){
                elementName = elements.find('#spacer-admin-label').val();
            }

        } else if (elementType === 'icon') {

            elements = $("#builder-elements>.icon");

            dataAttr = {};
            dataAttr['element-type'] = 'icon';
            dataAttr['icon'] = elements.find('#builder-element-icon').val();
            dataAttr['icon-align'] = elements.find('#builder-element-icon-align').val();
            dataAttr['icon-color'] = elements.find('#builder-element-icon-color').val();
            dataAttr['icon-size'] = elements.find('#builder-element-icon-size').val();
            dataAttr['admin-label'] = elements.find("#icon-admin-label").val();

            if( elements.find('#icon-admin-label').val().length > 0 ){
                elementName = elements.find('#icon-admin-label').val();
            }

        } else if (elementType === 'clients') {

            elements = $("#builder-elements>.clients");

            items_array = '[';

            jQuery('#clients_items > li').each(function(){

                if ( jQuery(this).index() + 1 < jQuery('#clients_items > li').length ) { var comma = ','}else{var comma = ''};
                item_image = jQuery(this).find('[data-role="media-url"]').val().replace(/"/g, '--quote--');
                item_id = jQuery(this).find('[data-builder-name="item_id"]').val();
                item_title = jQuery(this).find('[data-builder-name="title"]').val().replace(/"/g, '--quote--');
                item_url = jQuery(this).find('[data-builder-name="url"]').val().replace(/"/g, '--quote--');
                items_array = items_array + '{"id":' + '"' +  item_id + '"' + ',"image":' + '"' + item_image + '"' + ',"title":' + '"' + item_title + '"' + ',"url":' + '"' + item_url + '"' + '}' + comma;

            });
            items_array = items_array + ']';
            jQuery('#clients_content').val(items_array);

            dataAttr = {};
            dataAttr['element-type'] = 'clients';
            dataAttr['enable-carousel'] = elements.find('#clients-enable-carousel-y').attr('checked') ? 'y' : 'n';
            dataAttr['elements-per-row'] = isNaN(parseInt(elements.find('#clients-row').val(), 10)) ? 3 : parseInt(elements.find('#clients-row').val(), 10);

            dataAttr['clients'] = elements.find('#clients_content').val();
            dataAttr['admin-label'] = elements.find("#clients-admin-label").val();

            if( elements.find('#clients-admin-label').val().length > 0 ){
                elementName = elements.find('#clients-admin-label').val();
            }

        } else if (elementType === 'features-block') {

            elements = $("#builder-elements>.features-block");

            items_array = '[';
            jQuery('#features-block_items > li').each(function(){

                if ( jQuery(this).index() + 1 < jQuery('#features-block_items > li').length ) { var comma = ','}else{var comma = ''};
                item_icon = jQuery(this).find('[data-builder-name="icon"]').val();
                item_title = jQuery(this).find('[data-builder-name="title"]').val().replace(/"/g, '--quote--');
                item_text = jQuery(this).find('[data-builder-name="text"]').val().replace(/"/g, '--quote--').replace(/\r?\n/g, '<br />');
                item_id = jQuery(this).find('[data-builder-name="item_id"]').val();
                item_url = jQuery(this).find('[data-builder-name="url"]').val().replace(/"/g, '--quote--');
                item_background = jQuery(this).find('[data-builder-name="background"]').val().replace(/"/g, '--quote--');
                item_font = jQuery(this).find('[data-builder-name="font"]').val().replace(/"/g, '--quote--');
                items_array = items_array +  '{"id":' + '"' + item_id + '"' + ',"icon":' + '"' + item_icon + '"' + ',"title":' + '"' + item_title + '"' + ',"text":' + '"' + item_text + '"' + ',"url":' + '"' + item_url + '"' + ',"background":' + '"' + item_background + '"' + ',"font":' + '"' + item_font + '"' + '}' + comma;

            });
            items_array = items_array + ']';
            jQuery('#features-block_content').val(items_array);

            dataAttr = {};
            dataAttr['style'] = elements.find('#features-block-style').val();
            dataAttr['elements-per-row'] = isNaN(parseInt(elements.find('#features-block-row').val(), 10)) ? 3 : parseInt(elements.find('#features-block-row').val(), 10);
            dataAttr['element-type'] = 'features-block';
            dataAttr['features-block'] = elements.find('#features-block_content').val();
            dataAttr['admin-label'] = elements.find("#features-block-admin-label").val();
            dataAttr['gutter'] = elements.find("#features-block-gutter").val();

            if( elements.find('#features-block-admin-label').val().length > 0 ){
                elementName = elements.find('#features-block-admin-label').val();
            }

        } else if (elementType === 'listed-features') {

            elements = $("#builder-elements>.listed-features");
            items_array = '[';
            jQuery('#listed-features_items > li').each(function(){
                if ( jQuery(this).index() + 1 < jQuery('#listed-features_items > li').length ) { var comma = ','}else{var comma = ''};
                item_icon = jQuery(this).find('[data-builder-name="icon"]').val();
                item_title = jQuery(this).find('[data-builder-name="title"]').val().replace(/"/g, '--quote--');
                item_text = jQuery(this).find('[data-builder-name="text"]').val().replace(/"/g, '--quote--').replace(/\r?\n/g, '<br />');
                item_id = jQuery(this).find('[data-builder-name="item_id"]').val().replace(/"/g, '--quote--');
                item_icon_color = jQuery(this).find('[data-builder-name="iconcolor"]').val().replace(/"/g, '--quote--');
                item_border_color = jQuery(this).find('[data-builder-name="bordercolor"]').val().replace(/"/g, '--quote--');
                item_background_color = jQuery(this).find('[data-builder-name="backgroundcolor"]').val().replace(/"/g, '--quote--');
                item_url = jQuery(this).find('[data-builder-name="url"]').val().replace(/"/g, '--quote--');
                items_array = items_array + '{"id":' + '"' + item_id + '"'+',"icon":' + '"' + item_icon + '"' + ',"title":' + '"' + item_title + '"' + ', "text":' + '"' + item_text + '"' + ',"iconcolor":' + '"' + item_icon_color + '"' + ',"bordercolor":' + '"' + item_border_color + '"' + ',"backgroundcolor":' + '"' + item_background_color + '"' + ',"url":' + '"' + item_url + '"' + '}' + comma;
            });
            items_array = items_array + ']';
            jQuery('#listed-features_content').val(items_array);
            dataAttr = {};
            dataAttr['element-type'] = 'listed-features';
            dataAttr['features'] = elements.find('#listed-features_content').val();
            dataAttr['features-align'] = elements.find('#listed-features-align').val();
            dataAttr['color-style'] = elements.find('#listed-features-color-style').val();
            dataAttr['admin-label'] = elements.find("#listed-features-admin-label").val();

            if( elements.find('#listed-features-admin-label').val().length > 0 ){
                elementName = elements.find('#listed-features-admin-label').val();
            }

        } else if (elementType === 'page') {

            elements = $("#builder-elements>.page");

            dataAttr = {};
            dataAttr['element-type'] = 'page';
            dataAttr['post-id'] = elements.find('input[name=pageID]:checked').val();
            dataAttr['search'] = elements.find('#search-page').val();
            dataAttr['criteria'] = elements.find('#search-page-criteria').val();
            dataAttr['order-by'] = elements.find('#search-page-order-by').val();
            dataAttr['direction'] = elements.find('#search-page-direction').val();

        } else if (elementType === 'post') {

            elements = $("#builder-elements>.post");

            dataAttr = {};
            dataAttr['element-type'] = 'post';
            dataAttr['post-id'] = elements.find('input[name=postID]:checked').val();
            dataAttr['search'] = elements.find('#search-post').val();
            dataAttr['criteria'] = elements.find('#search-post-criteria').val();
            dataAttr['order-by'] = elements.find('#search-post-order-by').val();
            dataAttr['direction'] = elements.find('#search-post-direction').val();

        } else if (elementType === 'buttons') {

            var buttons = $("#builder-elements>.buttons");

            dataAttr = {};
            dataAttr['element-type'] = 'buttons';
            dataAttr['button-icon'] = buttons.find('#builder-element-button-icon').val();

            dataAttr['text'] = buttons.find('#button-text').val();
            dataAttr['icon-align'] = buttons.find('#button-icon-align').val();
            dataAttr['size'] = buttons.find('#button-size').val();
            dataAttr['target'] = buttons.find('#button-target').val();
            dataAttr['text-color'] = buttons.find('#button-text-color').val();
            dataAttr['bg-color'] = buttons.find('#button-background-color').val();
            dataAttr['url'] = buttons.find('#button-url').val();
            dataAttr['button-align'] = buttons.find('#button-align').val();
            dataAttr['admin-label'] = buttons.find("#buttons-admin-label").val();
            dataAttr['mode-display'] = buttons.find("#button-mode-display").val();
            dataAttr['border-color'] = buttons.find('#button-border-color').val();

            if( buttons.find('#buttons-admin-label').val().length > 0 ){
                elementName = buttons.find('#buttons-admin-label').val();
            }

        } else if (elementType === 'ribbon') {

            var ribbon = $("#builder-elements>.ribbon");

            dataAttr = {};
            dataAttr['element-type'] = 'ribbon';
            dataAttr['admin-label'] = ribbon.find("#ribbon-admin-label").val();
            dataAttr['title'] = ribbon.find("#ribbon-title").val();
            dataAttr['text'] = ribbon.find("#ribbon-text").val();
            dataAttr['text-color'] = ribbon.find('#ribbon-text-color').val();
            dataAttr['background'] = ribbon.find('#ribbon-background-color').val();
            dataAttr['align'] = ribbon.find('#ribbon-align').val();
            dataAttr['image'] = ribbon.find('#ribbon-attachment').val();
            dataAttr['button-icon'] = ribbon.find('#builder-element-ribbon-icon').val();
            dataAttr['button-text'] = ribbon.find('#ribbon-button-text').val();
            dataAttr['button-size'] = ribbon.find('#ribbon-button-size').val();
            dataAttr['button-target'] = ribbon.find('#ribbon-button-target').val();
            dataAttr['button-background-color'] = ribbon.find('#ribbon-button-background-color').val();
            dataAttr['button-url'] = ribbon.find('#ribbon-button-url').val();
            dataAttr['button-align'] = ribbon.find('#ribbon-button-align').val();
            dataAttr['button-mode-display'] = ribbon.find("#ribbon-button-mode-display").val();
            dataAttr['button-border-color'] = ribbon.find('#ribbon-button-border-color').val();
            dataAttr['button-text-color'] = ribbon.find('#ribbon-button-text-color').val();

            if( ribbon.find('#ribbon-admin-label').val().length > 0 ){
                elementName = ribbon.find('#ribbon-admin-label').val();
            }

        } else if (elementType === 'contact-form') {

            var form = $("#builder-elements>.contact-form");

            dataAttr = {};
            dataAttr['element-type'] = 'contact-form';
            dataAttr['hide-icon'] = form.find('#contact-form-hide-icon').attr('checked') ? '1' : '0';
            dataAttr['hide-subject'] = form.find('#contact-form-hide-subject').attr('checked') ? '1' : '0';
            dataAttr['admin-label'] = form.find("#contact-form-admin-label").val();

            items_array = '[';
            jQuery('#contact-form_items > li').each(function(){
            	if ( jQuery(this).index() + 1 < jQuery('#contact-form_items > li').length ) { var comma = ','}else{var comma = ''};
                item_id = jQuery(this).find('[data-builder-name="item_id"]').val();
                item_title = jQuery(this).find('[data-builder-name="title"]').val().replace(/"/g, '--quote--');
                item_type = jQuery(this).find('[data-builder-name="type"]').val().replace(/"/g, '--quote--');
                item_require = jQuery(this).find('[data-builder-name="require"]').val().replace(/"/g, '--quote--');
                item_options = jQuery(this).find('[data-builder-name="options"]').val().replace(/"/g, '--quote--');

                items_array = items_array +  '{"id":' + '"' + item_id + '"' + ',"title":' + '"' + item_title + '"' + ',"type":' + '"' + item_type + '"' + ',"require":' + '"' + item_require + '"' + ',"options":' + '"' + item_options + '"' + '}' + comma;

            });

            items_array = items_array + ']';
            jQuery('#contact-form_content').val(items_array);

            dataAttr['contact-form'] = form.find('#contact-form_content').val();
            if( form.find('#contact-form-admin-label').val().length > 0 ){
                elementName = form.find('#contact-form-admin-label').val();
            }

        } else if (elementType === 'featured-area') {

            var featuredArea = $("#builder-elements>.featured-area");

            dataAttr = {};
            dataAttr['element-type'] = 'featured-area';
            if( featuredArea.find('#featured-area-categories-video').val() !== null ){
               dataAttr['selected-categories'] = featuredArea.find('#featured-area-categories-video').val();
            }
            if( featuredArea.find('#featured-area-categories-posts').val() !== null ){
               dataAttr['selected-categories'] = featuredArea.find('#featured-area-categories-posts').val();
            }
            if( featuredArea.find('#featured-area-categories-gallery').val() !== null ){
               dataAttr['selected-categories'] = featuredArea.find('#featured-area-categories-gallery').val();
            }

            dataAttr['admin-label'] = featuredArea.find("#featured-area-admin-label").val();
            dataAttr['style'] = featuredArea.find("#featured-area-style").val();
            dataAttr['custom-post'] = featuredArea.find("#featured-area-custom-post").val();
            dataAttr['exclude-first'] = featuredArea.find("#featured-area-exclude-first").val();
            dataAttr['order-by'] = featuredArea.find("#featured-area-order-by").val();
            dataAttr['order-direction'] = featuredArea.find("#featured-area-order-direction").val();

            if( featuredArea.find('#featured-area-admin-label').val().length > 0 ){
                elementName = featuredArea.find('#featured-area-admin-label').val();
            }

        } else if (elementType === 'shortcodes') {

            var shortcodes = $("#builder-elements>.shortcodes");

            dataAttr = {};
            dataAttr['element-type'] = 'shortcodes';
            dataAttr['shortcodes'] = shortcodes.find('#ts-shortcodes').val();
            dataAttr['admin-label'] = shortcodes.find("#shortcodes-admin-label").val();
            dataAttr['paddings'] = shortcodes.find("#shortcodes-paddings").val();

            if( shortcodes.find('#shortcodes-admin-label').val().length > 0 ){
                elementName = shortcodes.find('#shortcodes-admin-label').val();
            }

        } else if (elementType === 'text') {

            var text = $(".tsz-text-editor-modal");

            dataAttr = {};
            dataAttr['element-type'] = 'text';
            dataAttr['admin-label'] = text.find("#text-admin-label").val();

            if( text.find('#text-admin-label').val().length > 0 ){
                elementName = text.find('#text-admin-label').val();
            }

            jQuery('#wp-ts_editor_id-wrap').find('#ts_editor_id-tmce').trigger('click');
            dataAttr['text'] = tinymce.get('ts_editor_id').getContent().replace(/"/g, '--quote--');

            setTimeout(function(){
                tinymce.get('ts_editor_id').setContent('');
            },800);

        } else if (elementType === 'list-videos') {

            elements = $("#builder-elements>.list-videos");
            dataAttr = {};

            dataAttr['element-type'] = 'list-videos';
            dataAttr['category'] = elements.find('select#list-videos-category').val();
            dataAttr['display-mode'] = elements.find('select#list-videos-display-mode').val();
            dataAttr['id-exclude'] = elements.find('#list-videos-exclude').val();
            dataAttr['exclude-first'] = elements.find('#list-videos-exclude-first').val();
            dataAttr['admin-label'] = elements.find("#list-videos-admin-label").val();
            dataAttr['featured'] = elements.find("#list-videos-featured").val();

            if( elements.find('#list-videos-admin-label').val().length > 0 ){
                elementName = elements.find('#list-videos-admin-label').val();
            }

            if (dataAttr['display-mode'] === 'grid') {

                gridMode = elements.find("#list-videos-display-mode-options>.list-videos-grid");
                dataAttr['behavior'] = gridMode.find('#list-videos-grid-behavior').val();
                dataAttr['display-title'] = gridMode.find('#list-videos-grid-title').val();
                dataAttr['show-meta'] = gridMode.find('#list-videos-grid-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['elements-per-row'] = gridMode.find('#list-videos-grid-el-per-row').val();
                dataAttr['posts-limit'] = gridMode.find('#list-videos-grid-el-per-row').val();
                dataAttr['elements-per-row'] = gridMode.find('#list-videos-grid-el-per-row').val();
                dataAttr['posts-limit'] = gridMode.find('#list-videos-grid-nr-of-posts').val();
                dataAttr['order-by'] = gridMode.find('#list-videos-grid-order-by').val();
                dataAttr['order-direction'] = gridMode.find('#list-videos-grid-order-direction').val();
                dataAttr['special-effects'] = gridMode.find('#list-videos-grid-special-effects').val();
                dataAttr['pagination'] = gridMode.find('#list-videos-grid-pagination').val();
                dataAttr['related-posts'] = gridMode.find('#list-videos-grid-related').val();
                dataAttr['show-image'] = gridMode.find('#list-videos-grid-image').val();

            } else if (dataAttr['display-mode'] === 'list') {

                listMode = elements.find("#list-videos-display-mode-options>.list-videos-list");
                dataAttr['display-title'] = listMode.find('#list-videos-list-title').val();
                dataAttr['show-meta'] = listMode.find('#list-videos-list-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = listMode.find('#list-videos-list-nr-of-posts').val();
                dataAttr['image-split'] = listMode.find('#list-videos-list-image-split').val();
                dataAttr['content-split'] = listMode.find('#list-videos-list-content-split').val();
                dataAttr['order-by'] = listMode.find('#list-videos-list-order-by').val();
                dataAttr['order-direction'] = listMode.find('#list-videos-list-order-direction').val();
                dataAttr['related-posts'] = listMode.find('#list-videos-list-show-related-y').attr('checked') ? 'y' : 'n';
                dataAttr['special-effects'] = listMode.find('#list-videos-list-special-effects').val();
                dataAttr['pagination'] = listMode.find('#list-videos-list-pagination').val();
                dataAttr['show-image'] = listMode.find('#list-videos-list-image').val();

           } else if (dataAttr['display-mode'] === 'thumbnails') {

                thumbnailsMode = elements.find("#list-videos-display-mode-options>.list-videos-thumbnails");
                dataAttr['display-title'] = thumbnailsMode.find('#list-videos-thumbnails-title').val();
                dataAttr['behavior'] = thumbnailsMode.find('#list-videos-thumbnails-behavior').val();
                dataAttr['elements-per-row'] = thumbnailsMode.find("#list-videos-thumbnail-posts-per-row").val();
                dataAttr['posts-limit'] = thumbnailsMode.find("#list-videos-thumbnail-limit").val();
                dataAttr['order-by'] = thumbnailsMode.find('#list-videos-thumbnail-order-by').val();
                dataAttr['order-direction'] = thumbnailsMode.find('#list-videos-thumbnails-order-direction').val();
                dataAttr['special-effects'] = thumbnailsMode.find('#list-videos-thumbnail-special-effects').val();
                dataAttr['gutter'] = thumbnailsMode.find('#list-videos-thumbnail-gutter').val();
                dataAttr['meta-thumbnail'] = thumbnailsMode.find('#list-videos-thumbnail-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['pagination'] = thumbnailsMode.find('#list-videos-thumbnails-pagination').val();

           } else if (dataAttr['display-mode'] === 'big-post') {

                bigPostMode = elements.find("#list-videos-display-mode-options>.list-videos-big-post");
                dataAttr['display-title'] = bigPostMode.find('#list-videos-big-post-title').val();
                dataAttr['show-meta'] = bigPostMode.find('#list-videos-big-post-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = bigPostMode.find('#list-videos-big-post-nr-of-posts').val();
                dataAttr['image-split'] = bigPostMode.find('#list-videos-big-post-image-split').val();
                dataAttr['order-by'] = bigPostMode.find('#list-videos-big-post-order-by').val();
                dataAttr['order-direction'] = bigPostMode.find('#list-videos-big-post-order-direction').val();
                dataAttr['related-posts'] = bigPostMode.find('#list-videos-big-post-related').val();
                dataAttr['special-effects'] = bigPostMode.find('#list-videos-big-post-special-effects').val();
                dataAttr['pagination'] = bigPostMode.find('#list-videos-big-post-pagination').val();
                dataAttr['image-position'] = bigPostMode.find('#list-videos-big-post-image-position').val();
                dataAttr['excerpt'] = bigPostMode.find('#list-videos-big-post-excerpt').val();
                dataAttr['carousel'] = bigPostMode.find('#list-videos-big-post-carousel').val();
                dataAttr['show-image'] = bigPostMode.find('#list-videos-big-post-image').val();

           } else if (dataAttr['display-mode'] === 'timeline') {

                timelineMode = elements.find("#list-videos-display-mode-options>.list-videos-timeline");
                dataAttr['display-title'] = timelineMode.find('#list-videos-timeline-title').val();
                dataAttr['show-meta'] = timelineMode.find('#list-videos-timeline-show-meta-y').attr('checked') ? 'y' : 'n';
                dataAttr['posts-limit'] = timelineMode.find('#list-videos-timeline-post-limit').val();
                dataAttr['image'] = timelineMode.find('#list-videos-timeline-image').val();
                dataAttr['order-by'] = timelineMode.find('#list-videos-timeline-order-by').val();
                dataAttr['order-direction'] = timelineMode.find('#list-videos-timeline-order-direction').val();
                dataAttr['pagination'] = timelineMode.find('#list-videos-timeline-pagination').val();

           } else if (dataAttr['display-mode'] === 'mosaic') {

                mosaicMode = elements.find("#list-videos-display-mode-options>.list-videos-mosaic");
                dataAttr['order-by'] = mosaicMode.find('#list-videos-mosaic-order-by').val();
                dataAttr['order-direction'] = mosaicMode.find('#list-videos-mosaic-order-direction').val();
                dataAttr['effects-scroll'] = mosaicMode.find('#list-videos-mosaic-effects').val();
                dataAttr['gutter'] = mosaicMode.find('#list-videos-mosaic-gutter').val();
                dataAttr['layout'] = mosaicMode.find('#list-videos-mosaic-layout').val();
                dataAttr['rows'] = mosaicMode.find('#list-videos-mosaic-rows').val();
                dataAttr['scroll'] = mosaicMode.find('#list-videos-mosaic-scroll').val();
                dataAttr['pagination'] = mosaicMode.find('#list-videos-mosaic-pagination').val();

                if( dataAttr['layout'] == 'rectangles' ){
                    dataAttr['posts-limit'] = mosaicMode.find("#list-videos-mosaic-post-limit-rows-" + dataAttr['rows'] + "").val();
                }else{
                    dataAttr['posts-limit'] = mosaicMode.find("#list-videos-mosaic-post-limit-rows-squares").val();
                }

           } else if (dataAttr['display-mode'] === 'super-post') {

                superPostMode = elements.find("#list-videos-display-mode-options>.list-videos-super-post");
                dataAttr['elements-per-row'] = superPostMode.find("#list-videos-super-post-posts-per-row").val();
                dataAttr['posts-limit'] = superPostMode.find('#list-videos-super-post-limit').val();
                dataAttr['order-by'] = superPostMode.find('#list-videos-super-post-order-by').val();
                dataAttr['order-direction'] = superPostMode.find('#list-videos-super-post-order-direction').val();
                dataAttr['related-posts'] = superPostMode.find('#list-videos-super-post-show-related-y').attr('checked') ? 'y' : 'n';
                dataAttr['special-effects'] = superPostMode.find('#list-videos-super-post-special-effects').val();
                dataAttr['pagination'] = superPostMode.find('#list-videos-super-post-pagination').val();
           }

       } else if (elementType === 'events') {

            elements = $("#builder-elements>.events");
            dataAttr = {};

            dataAttr['element-type'] = 'events';
            dataAttr['admin-label'] = elements.find("#events-admin-label").val();
            dataAttr['category'] = elements.find('select#events-category').val();
            dataAttr['id-exclude'] = elements.find('#events-exclude').val();
            dataAttr['exclude-first'] = elements.find('#events-exclude-first').val();
            dataAttr['posts-limit'] = elements.find('#events-nr-of-posts').val();
            dataAttr['order-by'] = elements.find('#events-order-by').val();
            dataAttr['order-direction'] = elements.find('#events-order-direction').val();
            dataAttr['special-effects'] = elements.find('#events-special-effects').val();
            dataAttr['pagination'] = elements.find('#events-pagination').val();

            if( elements.find('#events-admin-label').val().length > 0 ){
                elementName = elements.find('#events-admin-label').val();
            }

       } else if (elementType === 'calendar') {

            elements = $("#builder-elements>.calendar");

            dataAttr = {};
            dataAttr['element-type'] = 'calendar';
            dataAttr['admin-label'] = elements.find("#calendar-admin-label").val();
            dataAttr['size'] = elements.find("#calendar-size").val();

            if( elements.find('#calendar-admin-label').val().length > 0 ){
                elementName = elements.find('#calendar-admin-label').val();
            }

        } else if (elementType === 'gallery') {

            elements = $("#builder-elements>.gallery");

            dataAttr = {};
            dataAttr['element-type'] = 'gallery';
            dataAttr['admin-label'] = elements.find("#gallery-admin-label").val();
            dataAttr['gallery-type'] = elements.find("#gallery-type").val();
            dataAttr['images'] = elements.find("#gallery_image_gallery").val();

            if( elements.find('#gallery-admin-label').val().length > 0 ){
                elementName = elements.find('#gallery-admin-label').val();
            }

        } else if (elementType === 'chart') {

            dataAttr = {};
            dataAttr['element-type'] = 'chart';
            elements = $("#builder-elements>.chart");
            items_array = '[';

            jQuery('#chart_line_items > li').each(function(){

                if ( jQuery(this).index() + 1 < jQuery('#chart_line_items > li').length ) { var comma = ','}else{var comma = ''};
                item_id = jQuery(this).find('[data-option-name="item_id"]').val();
                item_title = jQuery(this).find('[data-option-name="title"]').val().replace(/"/g, '--quote--');
                item_fillColor = jQuery(this).find('[data-option-name="fillColor"]').val().replace(/"/g, '--quote--');
                item_strokeColor = jQuery(this).find('[data-option-name="strokeColor"]').val().replace(/"/g, '--quote--');
                item_pointColor = jQuery(this).find('[data-option-name="pointColor"]').val().replace(/"/g, '--quote--');
                item_pointStrokeColor = jQuery(this).find('[data-option-name="pointStrokeColor"]').val().replace(/"/g, '--quote--');
                item_pointHighlightFill = jQuery(this).find('[data-option-name="pointHighlightFill"]').val().replace(/"/g, '--quote--');
                item_pointHighlightStroke = jQuery(this).find('[data-option-name="pointHighlightStroke"]').val().replace(/"/g, '--quote--');
                item_data = jQuery(this).find('[data-option-name="data"]').val().replace(/"/g, '--quote--');

                items_array = items_array + '{"id":' + '"' +  item_id + '"' + ',"title":' + '"' + item_title + '"' + ',"fillColor":' + '"' + item_fillColor + '"' + ',"strokeColor":' + '"' + item_strokeColor + '"' + ',"pointColor":' + '"' + item_pointColor + '"' + ',"pointStrokeColor":' + '"' + item_pointStrokeColor + '"' + ',"pointHighlightFill":' + '"' + item_pointHighlightFill + '"' + ',"pointHighlightStroke":' + '"' + item_pointHighlightStroke + '"' + ',"data":' + '"' + item_data + '"' + '}' + comma;

            });
            items_array = items_array + ']';
            jQuery('#chart_line_content').val(items_array);
            dataAttr['chart_line'] = elements.find('#chart_line_content').val();

            items_array = '[';

            jQuery('#chart_pie_items > li').each(function(){

                if ( jQuery(this).index() + 1 < jQuery('#chart_pie_items > li').length ) { var comma = ','}else{var comma = ''};
                item_id = jQuery(this).find('[data-option-name="item_id"]').val();
                item_title = jQuery(this).find('[data-option-name="title"]').val().replace(/"/g, '--quote--');
                item_value = jQuery(this).find('[data-option-name="value"]').val().replace(/"/g, '--quote--');
                item_color = jQuery(this).find('[data-option-name="color"]').val().replace(/"/g, '--quote--');
                item_highlight = jQuery(this).find('[data-option-name="highlight"]').val().replace(/"/g, '--quote--');

                items_array = items_array + '{"id":' + '"' +  item_id + '"' + ',"title":' + '"' + item_title + '"' + ',"value":' + '"' + item_value + '"' + ',"color":' + '"' + item_color + '"' + ',"highlight":' + '"' + item_highlight + '"' + '}' + comma;

            });
            items_array = items_array + ']';
            jQuery('#chart_pie_content').val(items_array);
            dataAttr['chart_pie'] = elements.find('#chart_pie_content').val();

            dataAttr['admin-label'] = elements.find('#chart-admin-label').val();
            dataAttr['mode'] = elements.find('#chart-mode').val();
            dataAttr['title'] = elements.find('#chart-title').val();
            dataAttr['label'] = elements.find('#chart-label').val();
            dataAttr['scaleShowGridLines'] = elements.find('#chart-scaleShowGridLines').val();
            dataAttr['scaleGridLineColor'] = elements.find('#chart-scaleGridLineColor').val();
            dataAttr['scaleGridLineWidth'] = elements.find('#chart-scaleGridLineWidth').val();
            dataAttr['scaleShowHorizontalLines'] = elements.find('#chart-scaleShowHorizontalLines').val();
            dataAttr['scaleShowVerticalLines'] = elements.find('#chart-scaleShowVerticalLines').val();
            dataAttr['bezierCurve'] = elements.find('#chart-bezierCurve').val();
            dataAttr['bezierCurveTension'] = elements.find('#chart-bezierCurveTension').val();
            dataAttr['pointDot'] = elements.find('#chart-pointDot').val();
            dataAttr['pointDotRadius'] = elements.find('#chart-pointDotRadius').val();
            dataAttr['pointDotStrokeWidth'] = elements.find('#chart-pointDotStrokeWidth').val();
            dataAttr['pointHitDetectionRadius'] = elements.find('#chart-pointHitDetectionRadius').val();
            dataAttr['datasetStroke'] = elements.find('#chart-datasetStroke').val();
            dataAttr['datasetStrokeWidth'] = elements.find('#chart-datasetStrokeWidth').val();
            dataAttr['datasetFill'] = elements.find('#chart-datasetFill').val();
            dataAttr['scaleShowLabelBackdrop'] = elements.find('#chart-scaleShowLabelBackdrop').val();
            dataAttr['segmentShowStroke'] = elements.find('#chart-segmentShowStroke').val();
            dataAttr['segmentStrokeColor'] = elements.find('#chart-segmentStrokeColor').val();
            dataAttr['segmentStrokeWidth'] = elements.find('#chart-segmentStrokeWidth').val();
            dataAttr['percentageInnerCutout'] = elements.find('#chart-percentageInnerCutout').val();
            dataAttr['animationSteps'] = elements.find('#chart-animationSteps').val();
            dataAttr['animateRotate'] = elements.find('#chart-animateRotate').val();
            dataAttr['animateScale'] = elements.find('#chart-animateScale').val();

            if( elements.find('#chart-admin-label').val().length > 0 ){
               elementName = elements.find('#chart-admin-label').val();
            }

        } else {
            dataAttr = {};
        }

        removePreviousOptions(currentEditedElement);

        $.each(dataAttr, function(attr, value) {
            currentEditedElement.attr('data-' + attr, value);
        });

        currentEditedElement.find(".element-name").text(elementName);
        var icon = currentEditedElement.find('.element-icon').attr('class', 'element-icon ' + element_icon(dataAttr['element-type']));

    });

    jQuery( document ).on( 'click', '#builder-save', function(){

        var et = $('#ts-element-type');
        elementType = et.val();

        if( elementType == 'list-portfolios' ||
            elementType == 'last-posts' ||
            elementType == 'pricing-tables' ||
            elementType == 'list-videos' ||
            elementType == 'latest-custom-posts' ||
            elementType == 'events' ||
            elementType == 'accordion' ||
            elementType == 'list-galleries' ||
            elementType == 'filters' ){

            var selectedValue = false;

            jQuery('.' + elementType).find('select.ts-custom-select-input').each(function(){
                var inputId = jQuery(this).attr('id');

                if( inputId !== 'latest-custom-posts-type' && jQuery.isArray(jQuery(this).val()) ){
                    selectedValue = true;
                }
            });

            if( selectedValue == false ){
                noty({
                        layout: 'bottomCenter',
                        type: 'error',
                        timeout: 4000,
                        text: 'No category has been selected !'
                    });

            }else{
                jQuery('#ts-builder-elements-modal button.close').trigger('click');
            }
        }else{
            jQuery('#ts-builder-elements-modal button.close').trigger('click');
        }
    });

    // search post and pages
    $(document).on('click', '.search-posts-buttons', function(event) {
        event.preventDefault();
        var postType,
            search,
            criteria,
            order_by,
            direction,
            searchType = $(this).attr('id'),
            serverResponse = '',
            writeResponseIn,
            responseRadioElementName;

        if (searchType === 'search-type-page' ) {

            postType  = 'page';
            search    = $('#search-page').val();
            criteria  = $('#search-page-criteria').val();
            order_by  = $('#search-page-order-by').val();
            direction = $('#search-page-direction').val();

        } else if (searchType === 'search-type-post') {

            postType  = 'post';
            search    = $('#search-post').val();
            criteria  = $('#search-post-criteria').val();
            order_by  = $('#search-post-order-by').val();
            direction = $('#search-post-direction').val();

        } else {
            postType = false;
            search = '';
        }

        if (searchType === 'search-type-page' ) {
            writeResponseIn = 'search-pages-results';
            responseRadioElementName = 'pageID';
        } else if (searchType === 'search-type-post') {
            writeResponseIn = 'search-posts-results';
            responseRadioElementName = 'postID';
        } else {
            writeResponseIn = false;
        }

        $.post( ajaxurl + '?action=ts_search_content', {
            post_type: postType,
            search: search,
            criteria: criteria,
            order_by: order_by,
            direction: direction

        }).done(function(data) {
            if (data.length) {

                var checked = '';

                $.each(data, function(index, post) {
                    if (searchType === 'search-type-page' ) {
                        checked = (window.rtSelectPageInSearchResults == post.id) ? 'checked="checked"' : '';
                    } else if (searchType === 'search-type-post') {
                        checked = (window.rtSelectPostInSearchResults == post.id ) ? 'checked="checked"' : '';
                    }

                    serverResponse += '<tr><td><input id="' + responseRadioElementName + '-' + post.id + '" type="radio" name="' + responseRadioElementName + '" value="' + post.id + '" ' + checked + '/></td><td><label for="' + responseRadioElementName + '-' + post.id + '">' + post.title + '</label></td></tr>';
                });

            } else {
                serverResponse = 'No posts found.';
            }

        }).fail(function(){
            serverResponse = 'Error. Please try again!';

        }).always(function(){
            $('#' + writeResponseIn).html(serverResponse);
        });
    });

    function removePreviousOptions (element) {

        var elementType = element.attr('data-element-type'),
            attributes;

        if (elementType === 'logo') {

            attributes = ['element-type', 'logo-align'];

        } else if (elementType === 'social-buttons') {

            attributes = ['element-type', 'social-settings', 'social-align', 'admin-label'];

        } else if (elementType === 'cart') {

            attributes = ['element-type', 'cart-align'];

        } else if (elementType === 'breadcrumbs') {

            attributes = ['element-type'];

        } else if (elementType === 'searchbox') {

            attributes = ['element-type', 'align'];

        } else if (elementType === 'menu') {

            attributes = ['element-type', 'element-style', 'name', 'menu-custom', 'menu-bg-color', 'menu-bg-color-hover', 'menu-text-color', 'menu-text-color-hover', 'submenu-bg-color', 'submenu-text-color-hover', 'submenu-bg-color-hover', 'submenu-text-color', 'menu-text-align', 'admin-label', 'uppercase', 'icons', 'description'];

        } else if (elementType === 'sidebar') {

            attributes = ['element-type', 'sidebar-id'];

        } else if (elementType === 'slider') {

            attributes = ['element-type', 'slider-id'];

        } else if (elementType === 'list-portfolios') {

            attributes = ['element-type', 'category', 'display-mode', 'enable-carousel', 'display-title', 'show-meta', 'elements-per-row', 'posts-limit', 'order-by', 'order-direction', 'image-split', 'content-split', 'related-posts', 'show-label', 'special-effects', 'gutter', 'admin-label', 'admin-label'];

        } else if (elementType === 'list-products') {

            attributes = ['element-type', 'category', 'behavior', 'elements-per-row', 'posts-limit', 'order-by', 'order-direction', 'special-effects', 'gutter', 'admin-label'];

        } else if (elementType === 'last-posts') {

            attributes = ['element-type', 'category', 'display-mode', 'behavior', 'display-title', 'show-meta', 'elements-per-row', 'posts-limit', 'order-by', 'order-direction', 'image-split', 'content-split', 'related-posts', 'show-label', 'special-effects', 'gutter', 'id-exclude', 'exclude-first', 'meta-thumbnail', 'pagination', 'admin-label', 'image', 'scroll', 'rows', 'effects-scroll', 'layout', 'featured', 'image-position', 'excerpt', 'carousel', 'show-image'];

        } else if (elementType === 'list-galleries') {

            attributes = ['element-type', 'category', 'display-mode', 'behavior', 'display-title', 'show-meta', 'elements-per-row', 'posts-limit', 'order-by', 'order-direction', 'image-split', 'content-split', 'related-posts', 'show-label', 'special-effects', 'gutter', 'id-exclude', 'exclude-first', 'meta-thumbnail', 'pagination', 'admin-label', 'image', 'scroll', 'rows', 'effects-scroll', 'layout', 'featured', 'image-position', 'excerpt', 'carousel', 'show-image'];

        } else if (elementType === 'latest-custom-posts') {

            attributes = ['element-type', 'post-type', 'category', 'display-mode', 'behavior', 'display-title', 'show-meta', 'elements-per-row', 'posts-limit', 'order-by', 'order-direction', 'image-split', 'content-split', 'related-posts', 'show-label', 'special-effects', 'gutter', 'id-exclude', 'exclude-first', 'meta-thumbnail', 'pagination', 'admin-label', 'image', 'scroll', 'rows', 'effects-scroll', 'layout', 'featured', 'excerpt', 'carousel', 'show-image'];

        } else if (elementType === 'callaction') {

            attributes = ['element-type', 'callaction-text', 'callaction-link', 'callaction-button-text', 'admin-label'];

        } else if (elementType === 'accordion') {

            attributes = ['element-type', 'admin-label', 'category', 'featured', 'order-by', 'order-direction', 'nr-of-posts', 'posts-type'];

        } else if (elementType === 'image-carousel') {

            attributes = ['element-type', 'images', 'carousel-height', 'admin-label'];

        } else if (elementType === 'teams') {

            attributes = ['element-type', 'elements-per-row', 'posts-limit', 'remove-gutter', 'enable-carousel', 'admin-label'];

        } else if (elementType === 'pricing-tables') {

            attributes = ['element-type', 'elements-per-row', 'posts-limit', 'remove-gutter', 'admin-label'];

        } else if (elementType === 'advertising') {

            attributes = ['element-type', 'advertising', 'admin-label'];

        } else if (elementType === 'empty') {

            attributes = ['element-type'];

        } else if (elementType === 'delimiter') {

            attributes = ['element-type', 'delimiter-type', 'delimiter-color', 'admin-label'];

        } else if (elementType === 'title') {

            attributes = ['title-icon', 'element-type', 'title', 'subtitle', 'style', 'size', 'admin-label'];

        } else if (elementType === 'video') {

            attributes = ['element-type',  'embed', 'admin-label', 'lightbox', 'title'];

        } else if (elementType === 'icon') {

            attributes = ['element-type',  'icon', 'icon-size', 'icon-color', 'icon-align', 'admin-label'];

        } else if (elementType === 'clients') {

            attributes = ['element-type',  'clients', 'enable-carousel', 'elements-per-row', 'admin-label'];

        } else if (elementType === 'features-block') {

            attributes = ['element-type',  'features-block', 'elements-per-row', 'style', 'admin-label' ,'gutter'];

        } else if (elementType === 'listed-features') {

            attributes = ['element-type',  'features', 'features-align', 'color-style', 'admin-label'];

        } else if (elementType === 'facebook-block') {

            attributes = ['element-type', 'facebook-url', 'facebook-background'];

        } else if (elementType === 'image') {

            attributes = ['element-type', 'image-url', 'image-target', 'image-lightbox', 'forward-url', 'admin-label', 'retina', 'align'];

        } else if (elementType === 'powerlink') {

            attributes = ['element-type', 'image', 'button-text', 'button-title', 'admin-label', 'title'];

        } else if (elementType === 'filters') {

            attributes = ['element-type', 'categories', 'posts-limit', 'elements-per-row', 'order-by', 'direction', 'admin-label'];

        } else if (elementType === 'spacer') {

            attributes = ['element-type', 'height', 'admin-label'];

        } else if (elementType === 'counters') {

            attributes = ['element-type', 'counters-text', 'counters-precents', 'counters-text-color', 'admin-label', 'track-bar-color', 'track-bar', 'track-bar-icon'];

        } else if (elementType === 'alert') {

            attributes = ['element-type', 'admin-label', 'icon', 'title', 'text', 'background-color', 'text-color'];

        } else if (elementType === 'page') {

            attributes = ['element-type', 'post-id', 'search', 'criteria', 'order-by', 'direction'];

        } else if (elementType === 'post') {

            attributes = ['element-type', 'post-id', 'search', 'criteria', 'order-by', 'direction'];

        } else if (elementType === 'timeline') {

            attributes = ['element-type', 'admin-label', 'timeline'];

        }  else if (elementType === 'toggle') {

            attributes = ['element-type', 'admin-label', 'toggle-title', 'toggle-description', 'toggle-state', 'align-image'];

        } else if (elementType === 'buttons') {

            attributes = ['element-type', 'button-icon', 'text', 'icon-align', 'size', 'target', 'text-color', 'bg-color', 'url', 'button-align', 'admin-label', 'mode-display', 'border-color'];

        } else if (elementType === 'ribbon') {

            attributes = ['element-type', 'text', 'title', 'background', 'align', 'button-icon', 'button-text', 'button-size', 'button-target', 'text-color', 'button-background-color', 'button-url', 'button-button-align', 'admin-label', 'button-mode-display', 'button-border-color', 'image', 'button-text-color'];

        } else if (elementType === 'contact-form') {

            attributes = ['element-type', 'hide-icon', 'hide-subject', 'admin-label', 'contact-form'];

        } else if (elementType === 'featured-area') {

            attributes = ['element-type', 'selected-categories', 'exclude-first', 'admin-label', 'custom-post', 'style', 'order-by', 'order-direction'];

        } else if (elementType === 'shortcodes') {

            attributes = ['element-type', 'shortcodes', 'admin-label', 'paddings'];

        } else if (elementType === 'tab') {

            attributes = ['element-type', 'admin-label', 'tab', 'mode'];

        } else if (elementType === 'video-carousel') {

            attributes = ['element-type', 'admin-label', 'video-carousel', 'source'];

        } else if (elementType === 'count-down') {

            attributes = ['element-type', 'admin-label', 'title', 'date', 'hours', 'style'];

        } else if (elementType === 'testimonials') {

            attributes = ['element-type', 'testimonials', 'elements-per-row', 'enable-carousel', 'admin-label'];

        } else if (elementType === 'map') {

            attributes = ['element-type', 'map-address', 'map-width', 'map-height', 'map-longitude', 'map-latitude', 'map-type', 'map-style',
                            'map-zoom', 'map-type-control', 'map-zoom-control', 'map-scale-control', 'map-scroll-wheel',
                            'map-draggable-direction', 'map-marker-icon', 'map-marker-img', 'admin-label'];

        } else if (elementType === 'banner') {

            attributes = ['element-type', 'banner-image', 'banner-title', 'banner-subtitle', 'banner-button-title', 'banner-button-url', 'banner-button-background', 'banner-font-color', 'banner-text-align', 'banner-height', 'admin-label', 'button-text-color'];

        } else if (elementType === 'text') {

            attributes = ['element-type', 'text', 'admin-label'];

        } else if (elementType === 'list-videos') {

            attributes = ['element-type', 'category', 'display-mode', 'behavior', 'display-title', 'show-meta', 'elements-per-row', 'posts-limit', 'order-by', 'order-direction', 'image-split', 'content-split', 'related-posts', 'show-label', 'special-effects', 'gutter', 'id-exclude', 'exclude-first', 'meta-thumbnail', 'pagination', 'admin-label', 'image', 'scroll', 'rows', 'effects-scroll', 'layout', 'excerpt', 'carousel', 'show-image'];

        } else if (elementType === 'events') {

            attributes = ['element-type', 'category', 'posts-limit', 'order-by', 'order-direction', 'special-effects', 'id-exclude', 'exclude-first', 'pagination', 'admin-label'];

        } else if (elementType === 'calendar') {

            attributes = ['element-type', 'admin-label', 'size'];

        } else if (elementType === 'gallery') {

            attributes = ['element-type', 'admin-label', 'gallery-type', 'images'];

        } else if (elementType === 'skills') {

            attributes = ['element-type', 'admin-label', 'display-mode', 'skills'];

        } else if (elementType === 'chart') {

            attributes = ['element-type', 'admin-label', 'mode', 'label', 'title', 'scaleShowGridLines', 'scaleGridLineColor', 'scaleGridLineWidth', 'scaleShowHorizontalLines', 'scaleShowVerticalLines', 'bezierCurve', 'bezierCurveTension', 'pointDot', 'pointDotRadius', 'pointDotStrokeWidth', 'pointHitDetectionRadius', 'datasetStroke', 'datasetStrokeWidth', 'datasetFill', 'chart_line', 'segmentShowStroke', 'segmentStrokeColor', 'segmentStrokeWidth', 'percentageInnerCutout', 'animationSteps', 'animateRotate', 'animateScale', 'chart_pie'];

        } else {
            attributes = [];
        }

        if (!$.isEmptyObject(attributes)) {
            $.each(attributes, function(index, attribute) {
                element.removeAttr('data-' + attribute);
            });
        }
    }

    function element_icon (element) {

        var icon_class = 'icon-empty';

        switch (element) {

            case 'logo':
                icon_class = 'icon-logo';
                break;

            case 'cart':
                icon_class = 'icon-basket';
                break;

            case 'breadcrumbs':
                icon_class = 'icon-code';
                break;

            case 'social-buttons':
                icon_class = 'icon-social';
                break;

            case 'searchbox':
                icon_class = 'icon-search';
                break;

            case 'menu':
                icon_class = 'icon-menu';
                break;

            case 'menu':
                icon_class = 'icon-menu';
                break;

            case 'sidebar':
                icon_class = 'icon-sidebar';
                break;

            case 'slider':
                icon_class = 'icon-desktop';
                break;

            case 'list-portfolios':
                icon_class = 'icon-briefcase';
                break;

            case 'list-products':
                icon_class = 'icon-basket';
                break;

            case 'pricing-tables':
                icon_class = 'icon-dollar';
                break;

            case 'testimonials':
                icon_class = 'icon-comments';
                break;

            case 'tab':
                icon_class = 'icon-tabs';
                break;

            case 'video-carousel':
                icon_class = 'icon-coverflow';
                break;

            case 'count-down':
                icon_class = 'icon-megaphone';
                break;

            case 'clients':
                icon_class = 'icon-clients';
                break;

            case 'counters':
                icon_class = 'icon-time';
                break;

            case 'facebook-block':
                icon_class = 'icon-facebook';
                break;

            case 'last-posts':
                icon_class = 'icon-view-mode';
                break;

            case 'list-galleries':
                icon_class = 'icon-gallery';
                break;

            case 'latest-custom-posts':
                icon_class = 'icon-window';
                break;

            case 'accordion':
                icon_class = 'icon-clipboard';
                break;

            case 'callaction':
                icon_class = 'icon-direction';
                break;

            case 'teams':
                icon_class = 'icon-team';
                break;

            case 'advertising':
                icon_class = 'icon-money';
                break;

            case 'empty':
                icon_class = 'icon-empty';
                break;

            case 'features-block':
                icon_class = 'icon-tick';
                break;

            case 'delimiter':
                icon_class = 'icon-delimiter';
                break;

            case 'title':
                icon_class = 'icon-font';
                break;

            case 'filters':
                icon_class = 'icon-filter';
                break;

            case 'page':
                icon_class = 'icon-post';
                break;

            case 'post':
                icon_class = 'icon-post';
                break;

            case 'feature-blocks':
                icon_class = 'icon-tick';
                break;

            case 'spacer':
                icon_class = 'icon-resize-vertical';
                break;

            case 'image':
                icon_class = 'icon-image';
                break;

            case 'video':
                icon_class = 'icon-movie';
                break;

            case 'buttons':
                icon_class = 'icon-button';
                break;

            case 'ribbon':
                icon_class = 'icon-ribbon';
                break;

            case 'contact-form':
                icon_class = 'icon-mail';
                break;

            case 'featured-area':
                icon_class = 'icon-featured-area';
                break;

            case 'shortcodes':
                icon_class = 'icon-code';
                break;

            case 'listed-features':
                icon_class = 'icon-list';
                break;

            case 'text':
                icon_class = 'icon-text';
                break;

            case 'image-carousel':
                icon_class = 'icon-coverflow';
                break;

            case 'icon':
                icon_class = 'icon-flag';
                break;

            case 'map':
                icon_class = 'icon-pin';
                break;

            case 'banner':
                icon_class = 'icon-link-ext';
                break;

            case 'toggle':
                icon_class = 'icon-resize-full';
                break;

            case 'timeline':
                icon_class = 'icon-parallel';
                break;

            case 'list-videos':
                icon_class = 'icon-movie';
                break;

            case 'powerlink':
                icon_class = 'icon-ticket';
                break;

            case 'calendar':
                icon_class = 'icon-calendar';
                break;

            case 'events':
                icon_class = 'icon-text';
                break;

            case 'alert':
                icon_class = 'icon-attention';
                break;

            case 'skills':
                icon_class = 'icon-pencil-alt';
                break;

            case 'chart':
                icon_class = 'icon-chart';
                break;

            case 'gallery':
                icon_class = 'icon-gallery';
                break;

            default:
                icon_class = 'icon-empty';
                break;
        }

        return icon_class;
    }

    // Color pickers for elements
    // Button colors
    if ($('#ts-button-text-color-picker').length) {
        $('#ts-button-text-color-picker').hide();
        $('#ts-button-text-color-picker').farbtastic("#button-text-color");

        $("#button-text-color").click(function(e){
            e.stopPropagation();
            $('#ts-button-text-color-picker').show();
        });

        $('html').click(function() {
            $('#ts-button-text-color-picker').hide();
        });
    }

    if ($('#ts-button-bg-color-picker').length) {
        $('#ts-button-bg-color-picker').hide();
        $('#ts-button-bg-color-picker').farbtastic("#button-background-color");

        $("#button-background-color").click(function(e){
            e.stopPropagation();
            $('#ts-button-bg-color-picker').show();
        });

        $('html, #button-text-color').click(function() {
            $('#ts-button-bg-color-picker').hide();
        });
    }

    jQuery('.builder-element-array ul li').click(function(event){
        event.preventDefault();
        var element = jQuery(this).attr('data-value');
        jQuery('.builder-element-array ul').find('.selected').removeClass('selected');
        jQuery(this).addClass('selected');
        jQuery('#ts-element-type option[selected="selected"]').removeAttr('selected');
        jQuery('#ts-element-type option[value="'+element+'"]').attr('selected','selected');
        jQuery('#ts-element-type').trigger('change');
    });

    function ts_show_post_exclude_first(name_element, mode_display_name){

        jQuery('#' + name_element + '-mosaic-scroll').change(function(){
            if( jQuery(this).val() == 'y' ){
                jQuery('.class-' + name_element + '-mosaic-pagination').css('display', 'none');
            }else{
               jQuery('.class-' + name_element + '-mosaic-pagination').css('display', '');
            }
        });

        if( jQuery('#' + name_element + '-mosaic-scroll').val() == 'y' ){
            jQuery('.class-' + name_element + '-mosaic-pagination').css('display', 'none');
        }else{
           jQuery('.class-' + name_element + '-mosaic-pagination').css('display', '');
        }

        if( name_element == 'last-posts' && mode_display_name == 'mosaic' ){
            jQuery('#last-posts-mosaic-scroll').change(function(){
                if( jQuery(this).val() == 'y' ){
                    jQuery('.last-posts-mosaic-pagination').css('display', 'none');
                }else{
                   jQuery('.last-posts-mosaic-pagination').css('display', '');
                }
            });

            if( jQuery('#last-posts-mosaic-scroll').val() == 'y' ){
                jQuery('.last-posts-mosaic-pagination').css('display', 'none');
            }else{
               jQuery('.last-posts-mosaic-pagination').css('display', '');
            }
        }

        jQuery('#' + name_element + '-' + mode_display_name + '-behavior').change(function(){
            if( jQuery(this).val() == 'carousel' || jQuery(this).val() == 'scroll' || jQuery(this).val() == 'tabbed' ){
                jQuery('.' + name_element + '-' + mode_display_name + '-pagination').css('display','none');
            }else{
                jQuery('.' + name_element + '-' + mode_display_name + '-pagination').css('display','');
            }
        });

        jQuery('#' + name_element + '-' + mode_display_name + '-behavior-selector').click(function(){

           if( jQuery('#' + name_element + '-' + mode_display_name + '-behavior').val() == 'carousel' || jQuery('#' + name_element + '-' + mode_display_name + '-behavior').val() == 'scroll' || jQuery('#' + name_element + '-' + mode_display_name + '-behavior').val() == 'tabbed' ){
                jQuery('.' + name_element + '-' + mode_display_name + '-pagination').css('display','none');
           }else{
              jQuery('.' + name_element + '-' + mode_display_name + '-pagination').css('display','');
           }

        });

        if( jQuery('#' + name_element + '-' + mode_display_name + '-behavior').val() == 'carousel' || jQuery('#' + name_element + '-' + mode_display_name + '-behavior').val() == 'scroll' || jQuery('#' + name_element + '-' + mode_display_name + '-behavior').val() == 'tabbed' ){
             jQuery('.' + name_element + '-' + mode_display_name + '-pagination').css('display','none');
        }else{
           jQuery('.' + name_element + '-' + mode_display_name + '-pagination').css('display','');
        }

        jQuery('#' + name_element + '-' + mode_display_name + '-pagination').change(function(){
            if( jQuery(this).val() == 'y' ){
                jQuery('.' + name_element + '-exclude').css('display','none');
            }else{
                jQuery('.' + name_element + '-exclude').css('display','');
            }
        });

        if( jQuery('#' + name_element + '-' + mode_display_name + '-pagination').val() == 'y' ){
            jQuery('.' + name_element + '-exclude').css('display','none');
        }else{
           jQuery('.' + name_element + '-exclude').css('display','');
        }

        jQuery('#' + name_element + '-big-post-carousel').change(function(){
            if( jQuery(this).val() == 'y' ){
                jQuery('.' + name_element + '-big-post-pagination').css('display','none');
            }else{
                jQuery('.' + name_element + '-big-post-pagination').css('display','');
            }
        });

        jQuery('#' + name_element + '-big-post-behavior-selector').click(function(){
           if( jQuery('#' + name_element + '-big-post-carousel').val() == 'y' ){
                jQuery('.' + name_element + '-big-post-pagination').css('display','none');
           }else{
              jQuery('.' + name_element + '-big-post-pagination').css('display','');
           }
        });

        if( jQuery('#' + name_element + '-big-post-carousel').val() == 'y' ){
             jQuery('.' + name_element + '-big-post-pagination').css('display','none');
        }else{
           jQuery('.' + name_element + '-big-post-pagination').css('display','');
        }
    }

    jQuery('#last-posts-display-mode-selector li img').click(function(){
        var mode_display = jQuery(this).attr('data-option');
        ts_show_post_exclude_first('last-posts', mode_display);
        jQuery('#last-posts-' + mode_display + '-order-direction option[value=desc]').attr({'selected':'selected'});
    });

    jQuery('#list-galleries-display-mode-selector li img').click(function(){
        var mode_display = jQuery(this).attr('data-option');
        ts_show_post_exclude_first('list-galleries', mode_display);
        jQuery('#list-galleries-' + mode_display + '-order-direction option[value=desc]').attr({'selected':'selected'});
    });

    jQuery('#latest-custom-posts-display-mode-selector li img').click(function(){
        var mode_display = jQuery(this).attr('data-option');
        ts_show_post_exclude_first('latest-custom-posts', mode_display);
        jQuery('#latest-custom-posts-' + mode_display + '-order-direction option[value=desc]').attr({'selected':'selected'});
    });

    jQuery('[data-value="list-videos"]').click(function(){
        display_mode = jQuery('#list-videos-display-mode-selector').find('li.selected img').attr('data-option');
        ts_show_post_exclude_first('list-videos', display_mode);
    });

    jQuery('[data-value="last-posts"]').click(function(){
        display_mode = jQuery('#last-posts-display-mode-selector').find('li.selected img').attr('data-option');
        ts_show_post_exclude_first('last-posts', display_mode);
    });

    jQuery('[data-value="list-galleries"]').click(function(){
        display_mode = jQuery('#list-galleries-display-mode-selector').find('li.selected img').attr('data-option');
        ts_show_post_exclude_first('list-galleries', display_mode);
    });

    jQuery('[data-value="latest-custom-posts"]').click(function(){
        display_mode = jQuery('#latest-custom-posts-display-mode-selector').find('li.selected img').attr('data-option');
        ts_show_post_exclude_first('latest-custom-posts', display_mode);
    });

    jQuery('#list-videos-display-mode-selector li img').click(function(){
        var mode_display = jQuery(this).attr('data-option');
        ts_show_post_exclude_first('list-videos', mode_display);
        jQuery('#list-videos-' + mode_display + '-order-direction option[value=desc]').attr({'selected':'selected'});
    });

});
