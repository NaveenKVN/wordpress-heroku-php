window.currentEditedElement = undefined;
window.currentEditedRow = undefined;
window.custom_uploader = {};
window.rtSelectPostInSearchResults = undefined;
window.rtSelectPageInSearchResults = undefined;

jQuery(document).ready(function($) {

    var rowOptions = {
        connectWith :'.layout_builder_row',
        placeholder : 'ui-state-highlight',
        items : '>li:not(.empty-row,.row-editor,.edit-row-settings)',
        cancel: 'span.add-element, .edit, .delete'
    };

    var layout = {

        init: function() {
            $('.layout_builder').sortable({
                cancel: 'li a.row-editor, li a.add-column, li a.remove-row, li a.edit-row, .edit, .delete, span.add-element, span.delete-column',
                stop: function( event, ui ) {
                    window.builderDataChanged = true;
                }
            });
            $('.layout_builder_row').sortable(rowOptions);

            $('.elements').sortable({
                items : 'li',
                connectWith :'.elements',
                cancel: '.edit, .delete',
                stop: function( event, ui ) {
                    window.builderDataChanged = true;
                }
            });
        },

        validateAction : function() {
            if (confirm('Are you sure?') === false) {
                return false;
            } else {
                return true;
            }
        },

        columnSize : function (element) {
            var size = $(element).attr('data-columns');
            if ( size < 2  || size > 12 ) {
                return 2;
            } else {
                return size;
            }
        },

        columnSizeInfo : function (size) {

            switch(size) {
                case 2:
                    size = '1/6';
                    break;
                case 3:
                    size = '1/4';
                    break;
                case 4:
                    size = '1/3';
                    break;
                case 5:
                    size = '5/12';
                    break;
                case 6:
                    size = '1/2';
                    break;
                case 7:
                    size = '7/12';
                    break;
                case 8:
                    size = '2/3';
                    break;
                case 9:
                    size = '3/4';
                    break;
                case 10:
                    size = '5/6';
                    break;
                case 11:
                    size = '11/12';
                    break;
                case 12:
                    size = '12/12';
                    break;
                default:
                    size = '';
            }

            return size;
        },

        validateReceived : function (row, ui) {
            if (layout.rowSize(row) == 1) {
                var empty = $('.layout_builder_row li.empty-row');
                if (empty.length) {
                    empty.remove();
                }
            }

            if (layout.rowSize(row) > 12) {
                $(ui.sender).sortable('cancel');
                var n = noty({
                    layout: 'bottomCenter',
                    type: 'error',
                    timeout: 4000,
                    text: 'Decrease the size of this column or one from the row'
                });
            }
        },

        // calculate the size of columns in a specific row
        rowSize : function(row) {
            var sum = 0;

            row.find('>li:not(.empty-row, .row-editor, .edit-row-settings)').each(function(index, element) {
                sum += parseInt($(this).attr("data-columns"), 10);
            });

            return sum;
        },

        // return the row of
        getElementRow : function(ui) {
            return $(ui.item).parent();
        },

        insertRow : function(container, position) {
            var containter = $(containter);

            if (position == 'top') {
                containter.prepend('row');
            } else {
                containter.append('row');
            }

            containter.sortable('refresh');
        },

        insertColumn: function(row, size) {
            if (layout.getRowSize(row) + size > 12) {

            } else {
                $(row).append('row design');
            }
        },

        getColumnSettings: function (column) {
            var settings = {};

            column = $(column);

            settings.columnName = column.attr("data-name-id") ? column.attr("data-name-id") : '';
            settings.bgColor = column.attr("data-bg-color") ? column.attr("data-bg-color") : '';
            settings.textColor = column.attr("data-text-color") ? column.attr("data-text-color") : '';
            settings.columnMaskColor = column.attr("data-mask-color") ? column.attr("data-mask-color") : '';
            settings.columnOpacity = column.attr("data-opacity") ? column.attr("data-opacity") : '';
            settings.bgImage = column.attr("data-bg-image") ? column.attr("data-bg-image") : '';
            settings.bgVideoMp = column.attr("data-bg-video-mp") ? column.attr("data-bg-video-mp") : '';
            settings.bgVideoWebm = column.attr("data-bg-video-webm") ? column.attr("data-bg-video-webm") : '';
            settings.bgPosition = column.attr("data-bg-position") ? column.attr("data-bg-position") : '';
            settings.bgAttachement = column.attr("data-bg-attachment") ? column.attr("data-bg-attachment") : '';
            settings.bgRepeat = column.attr("data-bg-repeat") ? column.attr("data-bg-repeat") : '';
            settings.bgSize = column.attr("data-bg-size") ? column.attr("data-bg-size") : '';
            settings.columnPaddingTop = column.attr("data-padding-top") ? column.attr("data-padding-top") : '';
            settings.columnPaddingBottom = column.attr("data-padding-bottom") ? column.attr("data-padding-bottom") : '';
            settings.columnPaddingLeft = column.attr("data-padding-left") ? column.attr("data-padding-left") : '';
            settings.columnPaddingRight = column.attr("data-padding-right") ? column.attr("data-padding-right") : '';
            settings.columnTextAlign = column.attr("data-text-align") ? column.attr("data-text-align") : '';
            settings.columnMask = column.attr("data-mask") ? column.attr("data-mask") : '';

            return settings;
        },

        getRowSettings: function (row) {
            var settings = {};

            row = $(row);

            settings.rowName = row.attr("data-name-id") ? row.attr("data-name-id") : '';
            settings.bgColor = row.attr("data-bg-color") ? row.attr("data-bg-color") : '';
            settings.textColor = row.attr("data-text-color") ? row.attr("data-text-color") : '';
            settings.rowMaskColor = row.attr("data-mask-color") ? row.attr("data-mask-color") : '';
            settings.rowOpacity = row.attr("data-opacity") ? row.attr("data-opacity") : '';
            settings.bgImage = row.attr("data-bg-image") ? row.attr("data-bg-image") : '';
            settings.bgVideoMp = row.attr("data-bg-video-mp") ? row.attr("data-bg-video-mp") : '';
            settings.bgVideoWebm = row.attr("data-bg-video-webm") ? row.attr("data-bg-video-webm") : '';
            settings.bgPosition = row.attr("data-bg-position") ? row.attr("data-bg-position") : '';
            settings.bgAttachement = row.attr("data-bg-attachment") ? row.attr("data-bg-attachment") : '';
            settings.bgRepeat = row.attr("data-bg-repeat") ? row.attr("data-bg-repeat") : '';
            settings.bgSize = row.attr("data-bg-size") ? row.attr("data-bg-size") : '';

            settings.rowMarginTop = row.attr("data-margin-top") ? row.attr("data-margin-top") : '';
            settings.rowMarginBottom = row.attr("data-margin-bottom") ? row.attr("data-margin-bottom") : '';
            settings.rowPaddingTop = row.attr("data-padding-top") ? row.attr("data-padding-top") : '';
            settings.rowPaddingBottom = row.attr("data-padding-bottom") ? row.attr("data-padding-bottom") : '';
            settings.expandRow = row.attr("data-expand-row") ? row.attr("data-expand-row") : '';
            settings.specialEffects = row.attr("data-special-effects") ? row.attr("data-special-effects") : '';
            settings.rowTextAlign = row.attr("data-text-align") ? row.attr("data-text-align") : '';
            settings.fullscreenRow = row.attr("data-fullscreen-row") ? row.attr("data-fullscreen-row") : '';
            settings.rowMask = row.attr("data-mask") ? row.attr("data-mask") : '';
            settings.rowShadow = row.attr("data-shadow") ? row.attr("data-shadow") : '';
            settings.rowVerticalAlign = row.attr("data-vertical-align") ? row.attr("data-vertical-align") : '';
            settings.scrollDownButton = row.attr("data-scroll-down-button") ? row.attr("data-scroll-down-button") : '';
            settings.rowParallax = row.attr("data-parallax") ? row.attr("data-parallax") : 'no';
            settings.customCss = row.attr("data-custom-css") ? row.attr("data-custom-css") : '';

            return settings;
        },

        getElementData : function (element) {
            var e = $(element),
                elementType = e.attr('data-element-type'),
                elementData = {};

            if (elementType === 'empty') {
                elementData.type = 'empty';

            } else if (elementType === 'logo') {
                elementData.type = 'logo';
                elementData['logo-align'] = e.attr('data-logo-align');

            } else if (elementType === 'cart') {
                elementData.type = 'cart';
                elementData['cart-align'] = e.attr('data-cart-align');

            } else if (elementType === 'breadcrumbs') {

                elementData.type = 'breadcrumbs';

            } else if (elementType === 'social-buttons') {

                elementData.type = 'social-buttons';
                elementData['social-settings'] = e.attr('data-social-settings');
                elementData['social-align'] = e.attr('data-social-align');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'searchbox') {

                elementData.type = 'searchbox';
                elementData['align'] = e.attr('data-align');

            } else if (elementType === 'menu') {

                elementData.type = 'menu';
                elementData['element-style'] = e.attr('data-element-style');
                elementData['menu-custom'] = e.attr('data-menu-custom');
                elementData['menu-bg-color'] = e.attr('data-menu-bg-color');
                elementData['menu-text-color'] = e.attr('data-menu-text-color');
                elementData['menu-bg-color-hover'] = e.attr('data-menu-bg-color-hover');
                elementData['menu-text-color-hover'] = e.attr('data-menu-text-color-hover');
                elementData['submenu-bg-color'] = e.attr('data-submenu-bg-color');
                elementData['submenu-text-color'] = e.attr('data-submenu-text-color');
                elementData['submenu-bg-color-hover'] = e.attr('data-submenu-bg-color-hover');
                elementData['submenu-text-color-hover'] = e.attr('data-submenu-text-color-hover');
                elementData['menu-text-align'] = e.attr('data-menu-text-align');
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['uppercase'] = e.attr('data-uppercase');
                elementData['name'] = e.attr('data-name');
                elementData['icons'] = e.attr('data-icons');
                elementData['description'] = e.attr('data-description');

            } else if (elementType === 'sidebar') {

                elementData.type = 'sidebar';
                elementData['sidebar-id'] = e.attr('data-sidebar-id');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'slider') {

                elementData.type = 'slider';
                elementData['slider-id'] = e.attr('data-slider-id');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'list-portfolios') {

                elementData.type = 'list-portfolios';
                elementData.category = e.attr('data-category');
                elementData['display-mode'] = e.attr('data-display-mode');
                elementData['admin-label'] = e.attr('data-admin-label');

                if (elementData['display-mode'] == 'grid') {

                    elementData['behavior'] = e.attr('data-behavior');
                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');

                } else if (elementData['display-mode'] == 'list') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image-split'] = e.attr('data-image-split');
                    elementData['content-split'] = e.attr('data-content-split');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['related-posts'] = e.attr('data-related-posts');
                    elementData['special-effects'] = e.attr('data-special-effects');

                } else if (elementData['display-mode'] == 'thumbnails') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['behavior'] = e.attr('data-behavior');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['show-label'] = e.attr('data-show-label');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['gutter'] = e.attr('data-gutter');

                } else if (elementData['display-mode'] == 'big-post') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image-split'] = e.attr('data-image-split');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['related-posts'] = e.attr('data-related-posts');
                    elementData['special-effects'] = e.attr('data-special-effects');

                } else if (elementData['display-mode'] == 'super-post') {

                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                }

            } else if (elementType === 'testimonials') {

                elementData.type = 'testimonials';
                elementData['testimonials'] = e.attr('data-testimonials');
                elementData['elements-per-row'] = e.attr('data-elements-per-row');
                elementData['enable-carousel'] = e.attr('data-enable-carousel');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'tab') {

                elementData.type = 'tab';
                elementData['tab'] = e.attr('data-tab');
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['mode'] = e.attr('data-mode');

            } else if (elementType === 'video-carousel') {

                elementData.type = 'video-carousel';
                elementData['video-carousel'] = e.attr('data-video-carousel');
                elementData['source'] = e.attr('data-source');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'count-down') {

                elementData.type = 'count-down';
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['title'] = e.attr('data-title');
                elementData['date'] = e.attr('data-date');
                elementData['hours'] = e.attr('data-hours');
                elementData['style'] = e.attr('data-style');

            } else if (elementType === 'list-products') {

                elementData.type = 'list-products';
                elementData.category = e.attr('data-category');
                elementData['behavior'] = e.attr('data-behavior');
                elementData['elements-per-row'] = e.attr('data-elements-per-row');
                elementData['posts-limit'] = e.attr('data-posts-limit');
                elementData['order-by'] = e.attr('data-order-by');
                elementData['order-direction'] = e.attr('data-order-direction');
                elementData['special-effects'] = e.attr('data-special-effects');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'last-posts') {

                elementData.type = 'last-posts';
                elementData.category = e.attr('data-category');
                elementData['display-mode'] = e.attr('data-display-mode');
                elementData['id-exclude'] = e.attr('data-id-exclude');
                elementData['exclude-first'] = e.attr('data-exclude-first');
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['featured'] = e.attr('data-featured');

                if (elementData['display-mode'] == 'grid') {

                    elementData['behavior'] = e.attr('data-behavior');
                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                    elementData['related-posts'] = e.attr('data-related-posts');
                    elementData['show-image'] = e.attr('data-show-image');

                } else if (elementData['display-mode'] == 'list') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image-split'] = e.attr('data-image-split');
                    elementData['content-split'] = e.attr('data-content-split');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                    elementData['show-image'] = e.attr('data-show-image');

                } else if (elementData['display-mode'] == 'thumbnails') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['behavior'] = e.attr('data-behavior');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['show-label'] = e.attr('data-show-label');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['gutter'] = e.attr('data-gutter');
                    elementData['meta-thumbnail'] = e.attr('data-meta-thumbnail');
                    elementData['pagination'] = e.attr('data-pagination');

                } else if (elementData['display-mode'] == 'big-post') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image-split'] = e.attr('data-image-split');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['related-posts'] = e.attr('data-related-posts');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                    elementData['image-position'] = e.attr('data-image-position');
                    elementData['excerpt'] = e.attr('data-excerpt');
                    elementData['carousel'] = e.attr('data-carousel');
                    elementData['show-image'] = e.attr('data-show-image');

                } else if (elementData['display-mode'] == 'timeline') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image'] = e.attr('data-image');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['pagination'] = e.attr('data-pagination');

                } else if (elementData['display-mode'] == 'mosaic') {

                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['effects-scroll'] = e.attr('data-effects-scroll');
                    elementData['gutter'] = e.attr('data-gutter');
                    elementData['layout'] = e.attr('data-layout');
                    elementData['rows'] = e.attr('data-rows');
                    elementData['scroll'] = e.attr('data-scroll');
                    elementData['pagination'] = e.attr('data-pagination');

                } else if (elementData['display-mode'] == 'super-post') {

                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                }

            } else if (elementType === 'list-galleries') {

                elementData.type = 'list-galleries';
                elementData.category = e.attr('data-category');
                elementData['display-mode'] = e.attr('data-display-mode');
                elementData['id-exclude'] = e.attr('data-id-exclude');
                elementData['exclude-first'] = e.attr('data-exclude-first');
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['featured'] = e.attr('data-featured');

                if (elementData['display-mode'] == 'grid') {

                    elementData['behavior'] = e.attr('data-behavior');
                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                    elementData['related-posts'] = e.attr('data-related-posts');
                    elementData['show-image'] = e.attr('data-show-image');

                } else if (elementData['display-mode'] == 'list') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image-split'] = e.attr('data-image-split');
                    elementData['content-split'] = e.attr('data-content-split');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                    elementData['show-image'] = e.attr('data-show-image');

                } else if (elementData['display-mode'] == 'thumbnails') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['behavior'] = e.attr('data-behavior');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['show-label'] = e.attr('data-show-label');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['gutter'] = e.attr('data-gutter');
                    elementData['meta-thumbnail'] = e.attr('data-meta-thumbnail');
                    elementData['pagination'] = e.attr('data-pagination');

                } else if (elementData['display-mode'] == 'big-post') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image-split'] = e.attr('data-image-split');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['related-posts'] = e.attr('data-related-posts');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                    elementData['image-position'] = e.attr('data-image-position');
                    elementData['excerpt'] = e.attr('data-excerpt');
                    elementData['carousel'] = e.attr('data-carousel');
                    elementData['show-image'] = e.attr('data-show-image');

                } else if (elementData['display-mode'] == 'timeline') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image'] = e.attr('data-image');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['pagination'] = e.attr('data-pagination');

                } else if (elementData['display-mode'] == 'mosaic') {

                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['effects-scroll'] = e.attr('data-effects-scroll');
                    elementData['gutter'] = e.attr('data-gutter');
                    elementData['layout'] = e.attr('data-layout');
                    elementData['rows'] = e.attr('data-rows');
                    elementData['scroll'] = e.attr('data-scroll');
                    elementData['pagination'] = e.attr('data-pagination');

                } else if (elementData['display-mode'] == 'super-post') {

                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                }

            } else if (elementType === 'latest-custom-posts') {

                elementData.type = 'latest-custom-posts';
                elementData['post-type'] = e.attr('data-post-type');
                elementData['category'] = e.attr('data-category');
                elementData['display-mode'] = e.attr('data-display-mode');
                elementData['id-exclude'] = e.attr('data-id-exclude');
                elementData['exclude-first'] = e.attr('data-exclude-first');
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['featured'] = e.attr('data-featured');

                if (elementData['display-mode'] == 'grid') {

                    elementData['behavior'] = e.attr('data-behavior');
                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                    elementData['related-posts'] = e.attr('data-related-posts');
                    elementData['show-image'] = e.attr('data-show-image');

                } else if (elementData['display-mode'] == 'list') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image-split'] = e.attr('data-image-split');
                    elementData['content-split'] = e.attr('data-content-split');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                    elementData['show-image'] = e.attr('data-show-image');

                } else if (elementData['display-mode'] == 'thumbnails') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['behavior'] = e.attr('data-behavior');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['show-label'] = e.attr('data-show-label');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['gutter'] = e.attr('data-gutter');
                    elementData['meta-thumbnail'] = e.attr('data-meta-thumbnail');
                    elementData['pagination'] = e.attr('data-pagination');

                } else if (elementData['display-mode'] == 'big-post') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image-split'] = e.attr('data-image-split');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['related-posts'] = e.attr('data-related-posts');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                    elementData['image-position'] = e.attr('data-image-position');
                    elementData['excerpt'] = e.attr('data-excerpt');
                    elementData['carousel'] = e.attr('data-carousel');
                    elementData['show-image'] = e.attr('data-show-image');

                } else if (elementData['display-mode'] == 'timeline') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image'] = e.attr('data-image');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['pagination'] = e.attr('data-pagination');

                } else if (elementData['display-mode'] == 'mosaic') {

                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['effects-scroll'] = e.attr('data-effects-scroll');
                    elementData['gutter'] = e.attr('data-gutter');
                    elementData['layout'] = e.attr('data-layout');
                    elementData['rows'] = e.attr('data-rows');
                    elementData['scroll'] = e.attr('data-scroll');
                    elementData['pagination'] = e.attr('data-pagination');

                } else if (elementData['display-mode'] == 'super-post') {

                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                }

            } else if (elementType === 'callaction') {

                elementData.type = 'callaction';
                elementData['callaction-text'] = e.attr('data-callaction-text');
                elementData['callaction-link'] = e.attr('data-callaction-link');
                elementData['callaction-button-text'] = e.attr('data-callaction-button-text');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'teams') {

                elementData.type = 'teams';
                elementData['elements-per-row'] = e.attr('data-elements-per-row');
                elementData['posts-limit'] = e.attr('data-posts-limit');
                elementData['category'] = e.attr('data-category');
                elementData['remove-gutter'] = e.attr('data-remove-gutter');
                elementData['enable-carousel'] = e.attr('data-enable-carousel');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'accordion') {

                elementData.type = 'accordion';
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['posts-type'] = e.attr('data-posts-type');
                elementData['category'] = e.attr('data-category');
                elementData['featured'] = e.attr('data-featured');
                elementData['nr-of-posts'] = e.attr('data-nr-of-posts');
                elementData['order-direction'] = e.attr('data-order-direction');
                elementData['order-by'] = e.attr('data-order-by');

            } else if (elementType === 'advertising') {

                elementData.type = 'advertising';
                elementData['advertising'] = e.attr('data-advertising');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'empty') {

                elementData.type = 'empty';

            } else if (elementType === 'delimiter') {

                elementData.type = 'delimiter';
                elementData['delimiter-type'] = e.attr('data-delimiter-type');
                elementData['delimiter-color'] = e.attr('data-delimiter-color');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'title') {

                elementData.type = 'title';
                elementData['title-icon'] = e.attr('data-title-icon');
                elementData['title'] = e.attr('data-title');
                elementData['title-color'] = e.attr('data-title-color');
                elementData['subtitle'] = e.attr('data-subtitle');
                elementData['subtitle-color'] = e.attr('data-subtitle-color');
                elementData['style'] = e.attr('data-style');
                elementData['size'] = e.attr('data-size');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'facebook-block') {

                elementData.type = 'facebook-block';
                elementData['facebook-url'] = e.attr('data-facebook-url');
                elementData['facebook-background'] = e.attr('data-facebook-background');

            } else if (elementType === 'image') {

                elementData.type = 'image';
                elementData['image-url'] = e.attr('data-image-url');
                elementData['forward-url'] = e.attr('data-forward-url');
                elementData['image-target'] = e.attr('data-image-target');
                elementData['image-lightbox'] = e.attr('data-image-lightbox');
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['retina'] = e.attr('data-retina');
                elementData['align'] = e.attr('data-align');

            }else if (elementType === 'powerlink') {

                elementData.type = 'powerlink';
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['title'] = e.attr('data-title');
                elementData['image'] = e.attr('data-image');
                elementData['button-url'] = e.attr('data-button-url');
                elementData['button-text'] = e.attr('data-button-text');

            } else if (elementType === 'video') {

                elementData.type = 'video';
                elementData['embed'] = e.attr('data-embed');
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['lightbox'] = e.attr('data-lightbox');
                elementData['title'] = e.attr('data-title');

            } else if (elementType === 'filters') {

                elementData.type = 'filters';
                elementData['post-type'] = e.attr('data-post-type');
                elementData['categories'] = e.attr('data-categories');
                elementData['elements-per-row'] = e.attr('data-elements-per-row');
                elementData['posts-limit'] = e.attr('data-posts-limit');
                elementData['order-by'] = e.attr('data-order-by');
                elementData['direction'] = e.attr('data-direction');
                elementData['special-effects'] = e.attr('data-special-effects');
                elementData['gutter'] = e.attr('data-gutter');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'toggle') {

                elementData.type = 'toggle';
                elementData['banner-image'] = e.attr('data-banner-image');
                elementData['toggle-title'] = e.attr('data-toggle-title');
                elementData['toggle-description'] = e.attr('data-toggle-description');
                elementData['toggle-state'] = e.attr('data-toggle-state');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'timeline') {

                elementData.type = 'timeline';
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['timeline'] = e.attr('data-timeline');

            } else if (elementType === 'banner') {

                elementData.type = 'banner';
                elementData['banner-image'] = e.attr('data-banner-image');
                elementData['banner-title'] = e.attr('data-banner-title');
                elementData['banner-subtitle'] = e.attr('data-banner-subtitle');
                elementData['banner-button-title'] = e.attr('data-banner-button-title');
                elementData['banner-button-url'] = e.attr('data-banner-button-url');
                elementData['banner-button-background'] = e.attr('data-banner-button-background');
                elementData['banner-font-color'] = e.attr('data-banner-font-color');
                elementData['banner-text-align'] = e.attr('data-banner-text-align');
                elementData['banner-height'] = e.attr('data-banner-height');
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['button-text-color'] = e.attr('data-button-text-color');

            } else if (elementType === 'map') {

                elementData.type = 'map';

                elementData['map-address'] = e.attr('data-map-address');
                elementData['map-width'] = e.attr('data-map-width');
                elementData['map-height'] = e.attr('data-map-height');
                elementData['map-latitude'] = e.attr('data-map-latitude');
                elementData['map-longitude'] = e.attr('data-map-longitude');
                elementData['map-type'] = e.attr('data-map-type');
                elementData['map-style'] = e.attr('data-map-style');
                elementData['map-zoom'] = e.attr('data-map-zoom');
                elementData['map-type-control'] = e.attr('data-map-type-control');
                elementData['map-zoom-control'] = e.attr('data-map-zoom-control');
                elementData['map-scale-control'] = e.attr('data-map-scale-control');
                elementData['map-scroll-wheel'] = e.attr('data-map-scroll-wheel');
                elementData['map-draggable-direction'] = e.attr('data-map-draggable-direction');
                elementData['map-marker-icon'] = e.attr('data-map-marker-icon');
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['map-marker-img'] = e.attr('data-map-marker-img');

            } else if (elementType === 'counters') {

                elementData.type = 'counters';
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['counters-text'] = e.attr('data-counters-text');
                elementData['counters-precents'] = e.attr('data-counters-precents');
                elementData['counters-text-color'] = e.attr('data-counters-text-color');
                elementData['track-bar'] = e.attr('data-track-bar');
                elementData['track-bar-color'] = e.attr('data-track-bar-color');
                elementData['track-bar-icon'] = e.attr('data-track-bar-icon');

            } else if (elementType === 'alert') {

                elementData.type = 'alert';
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['icon'] = e.attr('data-icon');
                elementData['title'] = e.attr('data-title');
                elementData['text'] = e.attr('data-text');
                elementData['background-color'] = e.attr('data-background-color');
                elementData['text-color'] = e.attr('data-text-color');

            } else if (elementType === 'spacer') {

                elementData.type = 'spacer';
                elementData['height'] = e.attr('data-height');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'icon') {

                elementData.type = 'icon';
                elementData['icon'] = e.attr('data-icon');
                elementData['icon-size'] = e.attr('data-icon-size');
                elementData['icon-color'] = e.attr('data-icon-color');
                elementData['icon-align'] = e.attr('data-icon-align');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'clients') {

                elementData.type = 'clients';
                elementData['clients'] = e.attr('data-clients');
                elementData['elements-per-row'] = e.attr('data-elements-per-row');
                elementData['enable-carousel'] = e.attr('data-enable-carousel');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'skills') {

                elementData.type = 'skills';
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['display-mode'] = e.attr('data-display-mode');
                elementData['skills'] = e.attr('data-skills');

            } else if (elementType === 'features-block') {

                elementData.type = 'features-block';
                elementData['features-block'] = e.attr('data-features-block');
                elementData['elements-per-row'] = e.attr('data-elements-per-row');
                elementData['style'] = e.attr('data-style');
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['gutter'] = e.attr('data-gutter');

            } else if (elementType === 'listed-features') {

                elementData.type = 'listed-features';
                elementData['features'] = e.attr('data-features');
                elementData['features-align'] = e.attr('data-features-align');
                elementData['color-style'] = e.attr('data-color-style');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'pricing-tables') {

                elementData.type = 'pricing-tables';
                elementData['category'] = e.attr('data-category');
                elementData['elements-per-row'] = e.attr('data-elements-per-row');
                elementData['posts-limit'] = e.attr('data-posts-limit');
                elementData['remove-gutter'] = e.attr('data-remove-gutter');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'page') {

                elementData.type = 'page';
                elementData['post-id'] = e.attr('data-post-id');
                elementData['search'] = e.attr('data-search');
                elementData['criteria'] = e.attr('data-criteria');
                elementData['order-by'] = e.attr('data-order-by');
                elementData['direction'] = e.attr('data-direction');

            } else if (elementType === 'post') {

                elementData.type = 'post';
                elementData['post-id'] = e.attr('data-post-id');
                elementData['search'] = e.attr('data-search');
                elementData['criteria'] = e.attr('data-criteria');
                elementData['order-by'] = e.attr('data-order-by');
                elementData['direction'] = e.attr('data-direction');

            } else if (elementType === 'buttons') {

                elementData.type = 'buttons';

                elementData['button-icon'] = e.attr('data-button-icon');

                elementData['text'] = e.attr('data-text');
                elementData['icon-align'] = e.attr('data-icon-align');
                elementData['size'] = e.attr('data-size');
                elementData['target'] = e.attr('data-target');
                elementData['text-color'] = e.attr('data-text-color');
                elementData['bg-color'] = e.attr('data-bg-color');
                elementData['url'] = e.attr('data-url');
                elementData['button-align'] = e.attr('data-button-align');
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['mode-display'] = e.attr('data-mode-display');
                elementData['border-color'] = e.attr('data-border-color');

            } else if (elementType === 'ribbon') {

                elementData.type = 'ribbon';

                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['title'] = e.attr('data-title');
                elementData['text'] = e.attr('data-text');
                elementData['text-color'] = e.attr('data-text-color');
                elementData['background'] = e.attr('data-background');
                elementData['align'] = e.attr('data-align');
                elementData['button-icon'] = e.attr('data-button-icon');
                elementData['button-text'] = e.attr('data-button-text');
                elementData['button-size'] = e.attr('data-button-size');
                elementData['button-target'] = e.attr('data-button-target');
                elementData['button-url'] = e.attr('data-button-url');
                elementData['button-align'] = e.attr('data-button-align');
                elementData['button-mode-display'] = e.attr('data-button-mode-display');
                elementData['button-background-color'] = e.attr('data-button-background-color');
                elementData['button-border-color'] = e.attr('data-button-border-color');
                elementData['image'] = e.attr('data-image');
                elementData['button-text-color'] = e.attr('data-button-text-color');

            } else if (elementType === 'contact-form') {

                elementData.type = 'contact-form';
                elementData['hide-icon'] = e.attr('data-hide-icon');
                elementData['contact-form'] = e.attr('data-contact-form');
                elementData['hide-subject'] = e.attr('data-hide-subject');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'featured-area') {

                elementData.type = 'featured-area';
                elementData['selected-categories'] = e.attr('data-selected-categories');
                elementData['custom-post'] = e.attr('data-custom-post');
                elementData['style'] = e.attr('data-style');
                elementData['exclude-first'] = e.attr('data-exclude-first');
                elementData['order-by'] = e.attr('data-order-by');
                elementData['order-direction'] = e.attr('data-order-direction');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'shortcodes') {

                elementData.type = 'shortcodes';
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['paddings'] = e.attr('data-paddings');
                elementData['shortcodes'] = e.attr('data-shortcodes');

            } else if (elementType === 'text') {

                elementData.type = 'text';
                elementData['text'] = e.attr('data-text');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'image-carousel') {

                elementData.type = 'image-carousel';
                elementData['carousel-height'] = e.attr('data-carousel-height');
                elementData['images'] = e.attr('data-images');
                elementData['admin-label'] = e.attr('data-admin-label');

            } else if (elementType === 'list-videos') {

                elementData.type = 'list-videos';
                elementData.category = e.attr('data-category');
                elementData['display-mode'] = e.attr('data-display-mode');
                elementData['id-exclude'] = e.attr('data-id-exclude');
                elementData['exclude-first'] = e.attr('data-exclude-first');
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['featured'] = e.attr('data-featured');

                if (elementData['display-mode'] == 'grid') {

                    elementData['behavior'] = e.attr('data-behavior');
                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                    elementData['related-posts'] = e.attr('data-related-posts');
                    elementData['show-image'] = e.attr('data-show-image');

                } else if (elementData['display-mode'] == 'list') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image-split'] = e.attr('data-image-split');
                    elementData['content-split'] = e.attr('data-content-split');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['related-posts'] = e.attr('data-related-posts');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                    elementData['show-image'] = e.attr('data-show-image');

                } else if (elementData['display-mode'] == 'thumbnails') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['behavior'] = e.attr('data-behavior');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['show-label'] = e.attr('data-show-label');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['gutter'] = e.attr('data-gutter');
                    elementData['meta-thumbnail'] = e.attr('data-meta-thumbnail');
                    elementData['pagination'] = e.attr('data-pagination');

                } else if (elementData['display-mode'] == 'big-post') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image-split'] = e.attr('data-image-split');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['related-posts'] = e.attr('data-related-posts');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                    elementData['image-position'] = e.attr('data-image-position');
                    elementData['excerpt'] = e.attr('data-excerpt');
                    elementData['carousel'] = e.attr('data-carousel');
                    elementData['show-image'] = e.attr('data-show-image');

                } else if (elementData['display-mode'] == 'timeline') {

                    elementData['display-title'] = e.attr('data-display-title');
                    elementData['show-meta'] = e.attr('data-show-meta');
                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['image'] = e.attr('data-image');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['pagination'] = e.attr('data-pagination');

                } else if (elementData['display-mode'] == 'mosaic') {

                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['effects-scroll'] = e.attr('data-effects-scroll');
                    elementData['gutter'] = e.attr('data-gutter');
                    elementData['layout'] = e.attr('data-layout');
                    elementData['rows'] = e.attr('data-rows');
                    elementData['scroll'] = e.attr('data-scroll');
                    elementData['pagination'] = e.attr('data-pagination');

                } else if (elementData['display-mode'] == 'super-post') {

                    elementData['posts-limit'] = e.attr('data-posts-limit');
                    elementData['elements-per-row'] = e.attr('data-elements-per-row');
                    elementData['order-by'] = e.attr('data-order-by');
                    elementData['order-direction'] = e.attr('data-order-direction');
                    elementData['special-effects'] = e.attr('data-special-effects');
                    elementData['pagination'] = e.attr('data-pagination');
                }

            } else if (elementType === 'events') {

                elementData.type = 'events';
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData.category = e.attr('data-category');
                elementData['id-exclude'] = e.attr('data-id-exclude');
                elementData['exclude-first'] = e.attr('data-exclude-first');
                elementData['posts-limit'] = e.attr('data-posts-limit');
                elementData['order-by'] = e.attr('data-order-by');
                elementData['order-direction'] = e.attr('data-order-direction');
                elementData['special-effects'] = e.attr('data-special-effects');
                elementData['pagination'] = e.attr('data-pagination');

            } else if (elementType === 'calendar') {

                elementData.type = 'calendar';
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['size'] = e.attr('data-size');

            } else if (elementType === 'chart') {

                elementData.type = 'chart';
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['mode'] = e.attr('data-mode');
                elementData['label'] = e.attr('data-label');
                elementData['title'] = e.attr('data-title');
                elementData['scaleShowGridLines'] = e.attr('data-scaleShowGridLines');
                elementData['scaleGridLineColor'] = e.attr('data-scaleGridLineColor');
                elementData['scaleGridLineWidth'] = e.attr('data-scaleGridLineWidth');
                elementData['scaleShowHorizontalLines'] = e.attr('data-scaleShowHorizontalLines');
                elementData['scaleShowVerticalLines'] = e.attr('data-scaleShowVerticalLines');
                elementData['bezierCurve'] = e.attr('data-bezierCurve');
                elementData['bezierCurveTension'] = e.attr('data-bezierCurveTension');
                elementData['pointDot'] = e.attr('data-pointDot');
                elementData['pointDotRadius'] = e.attr('data-pointDotRadius');
                elementData['pointDotStrokeWidth'] = e.attr('data-pointDotStrokeWidth');
                elementData['pointHitDetectionRadius'] = e.attr('data-pointHitDetectionRadius');
                elementData['datasetStroke'] = e.attr('data-datasetStroke');
                elementData['datasetStrokeWidth'] = e.attr('data-datasetStrokeWidth');
                elementData['datasetFill'] = e.attr('data-datasetFill');
                elementData['chart_line'] = e.attr('data-chart_line');
                elementData['segmentShowStroke'] = e.attr('data-segmentShowStroke');
                elementData['segmentStrokeColor'] = e.attr('data-segmentStrokeColor');
                elementData['segmentStrokeWidth'] = e.attr('data-segmentStrokeWidth');
                elementData['percentageInnerCutout'] = e.attr('data-percentageInnerCutout');
                elementData['animationSteps'] = e.attr('data-animationSteps');
                elementData['animateRotate'] = e.attr('data-animateRotate');
                elementData['animateScale'] = e.attr('data-animateScale');
                elementData['chart_pie'] = e.attr('data-chart_pie');

            } else if (elementType === 'gallery') {

                elementData.type = 'gallery';
                elementData['admin-label'] = e.attr('data-admin-label');
                elementData['gallery-type'] = e.attr('data-gallery-type');
                elementData['images'] = e.attr('data-images');

            }

            return elementData;
        },

        save: function (location) {

            var content = $('#section-content>ul'),
                templateData = {},
                template_id,
                template_name;

            if ( location === 'page' ) {

                template_id = $('#ts_layout_id').find('#ts-template-id').val();
                template_name = $('#ts_layout_id').find('#ts-template-name').text();

                templateData = {
                    'post_id': $('#post_ID').val(),
                    'content': [],
                    'template_id': template_id,
                    'template_name': template_name
                };

            } else {

                template_id = $('#ts-template-id').val();
                template_name = $('#ts-template-name').text();

                if (location === 'header') {

                    templateData = {
                        'shootback_header': 1,
                        'content': [],
                        'template_id': template_id,
                        'template_name': template_name
                    };

                } else if (location === 'footer') {

                    templateData = {
                        'shootback_footer': 1,
                        'content': [],
                        'template_id': template_id,
                        'template_name': template_name
                    };
                }
            }

            // iterate over the content rows
            $.each(content, function(index, row) {
                var parsedRow = {};

                parsedRow.settings = layout.getRowSettings(row);
                parsedRow.columns = [];

                // select columns
                columns = $(row).find('>li:not(.row-editor, .edit-row-settings)');

                // iterate over the columns
                $.each(columns, function(index, column) {

                    var c = {};

                    c.size = layout.columnSize(column);
                    c.elements = [];
                    c.settingsColumn = layout.getColumnSettings(column);

                    elements = $(column).find('.elements>li');

                    // iterate over the column elements
                    $.each(elements, function(index, element) {
                        c.elements.push(layout.getElementData(element));
                    });

                    parsedRow.columns.push(c);

                });

                // add row to the header
                templateData.content.push(parsedRow);
            });

            return templateData;
        }
    };

    layout.init();

    $("#post").submit(function(event) {

        var success = false,
            d = {};

        d.data = JSON.stringify(layout.save('page'));
        d.mode = 'update';
        d['location'] = 'page';

        jQuery.ajax({
            data: d,
            url: ajaxurl + '?action=shootback_save_layout',
            async: false,
            type: "POST"
        }).done(function(data) {

            if ( data.status === 'ok' ) {
                success = true;
            } else {
                success = false;
                alert(data.message);
            }
        }).fail(function(data) {
            success = false;
        });

        if (!success) {
            jQuery("#ajax-loading").hide();
            jQuery("#publish").removeClass("button-primary-disabled");
            alert("Layout can't be updated");
            return false;
        } else {
            return true;
        }
    });

    // Increase column size
    $(document).on('click', '.layout_builder_row span.plus', function(event) {
        event.preventDefault();

        var element = $(this).parent().parent(),
            row = element.parent(),
            current_size = parseInt(element.attr("data-columns"), 10);

        current_size++;
        window.builderDataChanged = true;
        if (current_size <= 12 ) {
            element.find('.column-size').html(layout.columnSizeInfo(current_size));
            element.attr('class', 'columns' + current_size);
            element.attr("data-columns", current_size);
        } else {
            var n = noty({
                layout: 'bottomCenter',
                type: 'error',
                timeout: 4000,
                text: 'The the maximum value of column is 12'
            });
        }
    });

    // Decrease column size
    $(document).on('click', '.layout_builder_row span.minus', function(event) {
        event.preventDefault();

        var element = $(this).parent().parent(),
            current_size = parseInt(element.attr("data-columns"), 10);

        window.builderDataChanged = true;
        current_size--;

        if ( current_size >= 2 ) {
            element.find('.column-size').html(layout.columnSizeInfo(current_size));
            element.attr('class', 'columns' + current_size);
            element.attr("data-columns", current_size);
        } else {
            var n = noty({
                layout: 'bottomCenter',
                type: 'error',
                timeout: 4000,
                text: 'The minimum value of column is 2'
            });
        }
    });

    // Clone element
    $(document).on('click', '.layout_builder_row span.clone', function(event) {
        event.preventDefault();

        var element = $(this).parent();
        var element_html = $(this).parent().clone();
        window.builderDataChanged = true;
        jQuery(element).parent().append(element_html);

    });

    // Add element
    $(document).on('click', '.layout_builder_row span.add-element', function(event) {
        event.preventDefault();
        var column   = $(this).parent(),
            element  = $('#dragable-element-tpl').html(),
            elements = column.find('.elements');

        elements.append(element);
        elements.sortable({items : 'li', connectWith :'.elements'});
        window.builderDataChanged = true;
    });

    // ------ Rows section -------------------------------------------------------------

    // Inserting a row to the top
    $('.add-top-row').on('click', function(event) {
        event.preventDefault();
        var location    = "#section-" + $(this).attr('data-location'),
            rowSource   = $("#dragable-row-tpl").html(),
            template    = Handlebars.compile(rowSource),
            context     = {},
            rowTemplate = $(template(context));

        builderDataChanged = true;
        $(location).prepend(rowTemplate).sortable("refresh");
        $('.layout_builder_row').sortable(rowOptions);
    });

    // Inserting a row to the bottom
    $('.add-bottom-row').on('click', function(event) {
        event.preventDefault();
        var location    = "#section-" + $(this).attr('data-location'),
            rowSource   = $("#dragable-row-tpl").html(),
            template    = Handlebars.compile(rowSource),
            context     = {},
            rowTemplate = $(template(context));

        builderDataChanged = true;
        $(location).append(rowTemplate).sortable("refresh");
        $('.layout_builder_row').sortable(rowOptions);
    });

    // Publish th changes
    $('.publish-changes').on('click', function(event) {
        event.preventDefault();
        jQuery('#publish').trigger('click');
        window.builderDataChanged = false;

    });

    // Remove row
    $(document).on('click', '.remove-row', function(event) {
        event.preventDefault();
        if( ! layout.validateAction()) return;
        $(this).closest('ul.layout_builder_row').remove();
        builderDataChanged = true;
    });

    // ------ Columns section ----------------------------------------------------------

    // Show predefined column layouts
    $(document).on('click', '.predefined-columns', function(event) {
        event.preventDefault();
        $(this).next().toggle();
    });
    // Predefined column options
    $(document).on('click', '.add-column-settings li a', function(event) {
        event.preventDefault();

        builderDataChanged = true;
        var $this = $(this),
            row = $this.closest('ul.layout_builder_row'),
            column_layout = $this.attr('data-add-columns');
            column = $(column_layout).html();
            row.append(column);
            $('.elements').sortable({items : 'li', connectWith :'.elements', cancel: '.edit, .delete'});
            $('.add-column-settings').hide();
    });

    // Add column to the row
    $(document).on('click', '.add-column', function(event) {
        event.preventDefault();

        var $this = $(this),
            row = $this.closest('ul.layout_builder_row'),
            column = $('#dragable-column-tpl').html();
            row.append(column);
            $('.elements').sortable({items : 'li', connectWith :'.elements', cancel: '.edit, .delete'});
    });

    // Remove column
    $(document).on('click', '.layout_builder_row span.delete-column', function(event) {
        event.preventDefault();
        if( ! layout.validateAction()) return;
        $(this).closest('li[data-type="column"]').remove();
    });

    // Edit column
    $(document).on('click', 'li span.edit', function(event) {
        event.preventDefault();
        window.currentEditedElement = $(this).parent();
        jQuery('#ts-builder-elements-modal-preloader').show();
        jQuery('#ts-builder-elements-modal .modal-body').load(ajaxurl + '?action=edit_template_element&height=800&width=835&modal=true"',function(result){

            if ( jQuery( window.currentEditedElement ).attr( 'data-element-type' ) == 'text' ) {

                jQuery('#wp-ts_editor_id-wrap').find('.mce-i-fullscreen').parent('button').css('display', 'none');

                jQuery( '.tsz-text-editor-modal' ).css( 'display', 'block' );
                jQuery( 'body' ).addClass( 'tsz-modal-editor-open' );

            } else {

                jQuery('#ts-builder-elements-modal').modal({show:true});
                jQuery('#ts-builder-elements-modal-label').html('Builder elements');

                if(jQuery(window.currentEditedElement).attr('data-element-type') == 'map'){
                    setTimeout(function(){
                        initialize();
                    }, 500);
                }

                jQuery( '#ts-builder-elements-modal' ).css( 'opacity', 1 );
            }

            jQuery('#ts-builder-elements-modal-preloader').hide();
        });
    });

    $(document).on('click', 'li[data-value="map"]', function(){
        initialize();
    });

    // Remove element
    $(document).on('click', '.layout_builder_row span.delete', function(event) {
        event.preventDefault();
        if( ! layout.validateAction()) return;
        $(this).parent().remove();
        builderDataChanged = true;
    });

    // Edit columns settings
    $(document).on('click', '.edit-column', function(event) {
        event.preventDefault();
        // Act on the event
        window.currentEditedColumn = $(this).closest('li');
        window.currentColumnID = $(this).attr('id');
        window.currentSetId = new Date().getTime();

        jQuery('#ts-builder-elements-modal-preloader').show();
        jQuery('#ts-builder-elements-modal .modal-body').load(ajaxurl + '?action=edit_template_column&height=700&width=835&modal=true"',function(result){
            jQuery('#ts-builder-elements-modal').modal({show:true});
            jQuery('#ts-builder-elements-modal-label').html('Edit column settings');
            jQuery('#ts-builder-elements-modal-preloader').hide();
        });
    });

    // Edit Row settings
    $(document).on('click', '.edit-row-settings', function(event) {
        event.preventDefault();
        // Act on the event
        window.currentEditedRow = $(this).closest('ul');
        window.currentRowID = $(this).attr('id');
        window.currentSetId = new Date().getTime();

        jQuery('#ts-builder-elements-modal-preloader').show();
        jQuery('#ts-builder-elements-modal .modal-body').load(ajaxurl + '?action=edit_template_row&height=700&width=835&modal=true"',function(result){
            jQuery('#ts-builder-elements-modal').modal({show:true});
            jQuery('#ts-builder-elements-modal-label').html('Edit row settings');
            jQuery('#ts-builder-elements-modal-preloader').hide();
        });
    });

    // Save Column Settings
    $(document).on('click', '#save-column-settings', function(event) {
        event.preventDefault();
        // Act on the event
        var modalWindow = $('#ts-builder-elements-modal');
        window.currentEditedColumn.attr("data-name-id", modalWindow.find('#column-name-id').val());
        window.currentEditedColumn.attr("data-bg-color", modalWindow.find('#column-background-color').val());
        window.currentEditedColumn.attr("data-text-color", modalWindow.find('#column-text-color').val());
        window.currentEditedColumn.attr("data-mask-color", modalWindow.find('#column-mask-color').val());
        window.currentEditedColumn.attr("data-opacity", modalWindow.find('#column-opacity').val());
        window.currentEditedColumn.attr("data-bg-image", modalWindow.find('#column-bg-image').val());
        window.currentEditedColumn.attr("data-bg-video-mp", modalWindow.find('#column-bg-video-mp').val());
        window.currentEditedColumn.attr("data-bg-video-webm", modalWindow.find('#column-bg-video-webm').val());
        window.currentEditedColumn.attr("data-bg-position", modalWindow.find('#column-bg-position').val());
        window.currentEditedColumn.attr("data-bg-attachment", modalWindow.find('#column-bg-attachement').val());
        window.currentEditedColumn.attr("data-bg-repeat", modalWindow.find('#column-bg-repeat').val());
        window.currentEditedColumn.attr("data-bg-size", modalWindow.find('#column-bg-size').val());

        window.currentEditedColumn.attr("data-padding-top", modalWindow.find('#column-padding-top').val());
        window.currentEditedColumn.attr("data-padding-bottom", modalWindow.find('#column-padding-bottom').val());
        window.currentEditedColumn.attr("data-padding-left", modalWindow.find('#column-padding-left').val());
        window.currentEditedColumn.attr("data-padding-right", modalWindow.find('#column-padding-right').val());
        window.currentEditedColumn.attr("data-text-align", modalWindow.find('#text-align').val());
        window.currentEditedColumn.attr("data-mask", modalWindow.find('#column-mask').val());

        window.builderDataChanged = true;
        jQuery('#ts-builder-elements-modal button.close').trigger('click');
    });

    // Save Row Settings
    $(document).on('click', '#save-row-settings', function(event) {
        event.preventDefault();
        // Act on the event
        var modalWindow = $('#ts-builder-elements-modal');
        window.currentEditedRow.attr("data-name-id", modalWindow.find('#row-name-id').val());
        window.currentEditedRow.attr("data-bg-color", modalWindow.find('#row-background-color').val());
        window.currentEditedRow.attr("data-text-color", modalWindow.find('#row-text-color').val());
        window.currentEditedRow.attr("data-mask-color", modalWindow.find('#row-mask-color').val());
        window.currentEditedRow.attr("data-opacity", modalWindow.find('#row-opacity').val());
        window.currentEditedRow.attr("data-bg-image", modalWindow.find('#row-bg-image').val());
        window.currentEditedRow.attr("data-bg-video-mp", modalWindow.find('#row-bg-video-mp').val());
        window.currentEditedRow.attr("data-bg-video-webm", modalWindow.find('#row-bg-video-webm').val());
        window.currentEditedRow.attr("data-bg-position", modalWindow.find('#row-bg-position').val());
        window.currentEditedRow.attr("data-bg-attachment", modalWindow.find('#row-bg-attachement').val());
        window.currentEditedRow.attr("data-bg-repeat", modalWindow.find('#row-bg-repeat').val());
        window.currentEditedRow.attr("data-bg-size", modalWindow.find('#row-bg-size').val());

        window.currentEditedRow.attr("data-margin-top", modalWindow.find('#row-margin-top').val() );
        window.currentEditedRow.attr("data-margin-bottom", modalWindow.find('#row-margin-bottom').val());
        window.currentEditedRow.attr("data-padding-top", modalWindow.find('#row-padding-top').val());
        window.currentEditedRow.attr("data-padding-bottom", modalWindow.find('#row-padding-bottom').val());
        window.currentEditedRow.attr("data-expand-row", modalWindow.find('#expand-row').val());
        window.currentEditedRow.attr("data-special-effects", modalWindow.find('#special-effects').val());
        window.currentEditedRow.attr("data-text-align", modalWindow.find('#text-align').val());
        window.currentEditedRow.attr("data-fullscreen-row", modalWindow.find('#fullscreen-row').val());
        window.currentEditedRow.attr("data-mask", modalWindow.find('#row-mask').val());
        window.currentEditedRow.attr("data-shadow", modalWindow.find('#row-shadow').val());
        window.currentEditedRow.attr("data-vertical-align", modalWindow.find('#row-vertical-align').val());
        window.currentEditedRow.attr("data-scroll-down-button", modalWindow.find('#scroll-down-button').val());
        window.currentEditedRow.attr("data-parallax", modalWindow.find('#row-parallax').val());
        window.currentEditedRow.attr("data-custom-css", modalWindow.find('#row-custom-css').val());

        window.builderDataChanged = true;
        jQuery('#ts-builder-elements-modal button.close').trigger('click');
    });

    // ------ Layout section ----------------------------------------------------------

    // Create new layout
    $('#create-new-layout').on('click', function(event) {
        event.preventDefault();
        window.location.href = $(this).data('create-uri');
    });

    // Create Layout > Structure
    $('ul#layout-type label').on('click', function(event) {

        event.stopPropagation();
        $_this = $(this).parent();
        var layoutTypes = $_this.parent().find('li');

        $.each(layoutTypes, function(index, val) {
            var layout = $(val);
            if ( layout.hasClass('selected-layout') ) {
                layout.removeClass('selected-layout');
            }
        });

        if ( ! $_this.hasClass('selected-layout') ) {
            $_this.addClass('selected-layout');
        }
    });

    // Save template
    $(document).on('click', '#save-template', function(event) {
        event.preventDefault();
        layout.save();
    });

    // save header and footer
    $(document).on('click', '#save-header-footer', function(event) {
        event.preventDefault();

        var n,
            d = {},
            location = $(this).attr('data-location');

        content = layout.save(location);
        d.mode = 'update';
        d['location'] = location;
        d['data'] = JSON.stringify(content);

         jQuery.ajax({
            data: d,
            url: ajaxurl + '?action=shootback_save_layout',
            async: false,
            type: "POST"
        }).done(function(data) {
            if ( data.status === 'ok' ) {
                n = noty({
                    layout: 'bottomCenter',
                    type: 'success',
                    timeout: 4000,
                    text: 'Template saved'
                });
            } else {
                n = noty({
                    layout: 'bottomCenter',
                    type: 'error',
                    timeout: 4000,
                    text: data.message
                });
            }
        }).fail(function(data) {
            n = noty({
                layout: 'bottomCenter',
                type: 'error',
                timeout: 4000,
                text: "Error! Template can't be saved"
            });
        });
    });

    /**
     * Hide attached image manager for non gallery post formats
     */
    $(document).ready(function(){
        if( $('.post-format:checked').attr('value') == 'gallery' ){
            console.log($('.post-format:checked').attr('value'))
            jQuery('#ts-gallery-images').css('display', '');
        } else{
            jQuery('#ts-gallery-images').css('display', 'none');
        }
    });

    $('.post-format').click(function(event) {
        if( $(this).attr('value') == 'gallery' ){
            jQuery('#ts-gallery-images').css('display', '');
        } else{
            jQuery('#ts-gallery-images').css('display', 'none');
        }
    });

    /**
     * Hide video embed for non video post formats
     */
    $(document).ready(function(){
        if( $('.post-format:checked').attr('value') == 'video' ){
            jQuery('#video_embed').show();
        } else{
            jQuery('#video_embed').hide();
        }
    });
    $('.post-format').click(function(event) {
        if( $(this).attr('value') == 'video' ){
            jQuery('#video_embed').show();
        } else{
            jQuery('#video_embed').hide();
        }
    });

    /**
     * Hide audio embed for non audio post formats
     */
    $(document).ready(function(){
        if( $('.post-format:checked').attr('value') == 'audio' ){
            jQuery('#audio_embed').show();
        } else{
            jQuery('#audio_embed').hide();
        }
    });
    $('.post-format').click(function(event) {
        if( $(this).attr('value') == 'audio' ){
            jQuery('#audio_embed').show();
        } else{
            jQuery('#audio_embed').hide();
        }
    });

    // Create/Edit Templates
    $(document).on('click', '.ts-modal-confirm', function(event) {
        event.preventDefault();
        $(this).siblings('button[data-dismiss="modal"]').trigger('click');
        $('.layout_builder').html('');
    });

    $(document).on('click', '#new-template', function(event) {
        event.preventDefault();
        $('#ts-confirmation').modal();
    });

    // Save blank tempalte
    $(document).on('click', '#ts-save-blank-template-action', function(event) {

        event.preventDefault();

        var element = $(this);
        var closeModal = element.siblings('button').trigger("click");
        var template_id;
        var location = element.attr('data-location');
        var template_name = $('#ts-blank-template-name').val();

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'shootback_save_layout',
                'mode': 'blank_template',
                'template_name': template_name,
                'location': location
            }
        }).done(function(data) {

            var blankTemplateName = $('#ts-blank-template-name');

            if (data['status'] === 'ok') {
                $('#ts-template-id').val(data.template_id);
                $('#ts-template-name').text(blankTemplateName.val());
                $('.layout_builder').html('');
            } else {
                alert("Error");
            }

            blankTemplateName.val("");

        }).fail(function() {
            alert("Error");
        });

    });

    // Save as... tempalte
    $(document).on('click', '#ts-save-as-template', function(event) {
        event.preventDefault();
        $('#ts-save-template-modal').modal();
    });

    // Save as... tempalte action
    $(document).on('click', '#ts-save-as-template-action', function(event) {

        event.preventDefault();

        var element = $(this);
        var closeModal = element.siblings('button');
        var template_name = $('#ts-save-template-name').val();
        var location = element.attr('data-location');
        var l = layout.save(location);

        var data = {
                action: 'shootback_save_layout',
                mode: 'save_as',
                template_name: template_name,
                location: location,
                data: JSON.stringify(l['content'])
        };

        if (typeof l['post_id'] !== "undefined") {
            data['post_id'] = l['post_id'];
        }

        if (typeof l['shootback_header'] !== "undefined") {
            data['shootback_header'] = l['shootback_header'];
        }

        if (typeof l['shootback_footer'] !== "undefined") {
            data['shootback_footer'] = l['shootback_footer'];
        }

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: data
        }).done(function(data) {

            if (data.status === 'ok') {
                closeModal.trigger("click");
            } else {
                alert(data.message);
            }

        }).fail(function() {
            alert("Error");
        });
    });

    // Load template button
    $(document).on('click', '#ts-load-template-button', function(event) {

        event.preventDefault();

        var element = $(this);
        var location = element.attr('data-location');
        var defaultTemplate;

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            cache: false,
            data: {
                action: 'shootback_load_all_templates',
                location: location
            }
        }).done(function(data) {

            $("#ts-layout-list").html(data);
            $("#ts-load-template").modal();

        }).fail(function() {
            alert("Error");
        });
    });

    // Load template action
    $(document).on('click', '#ts-load-template-action', function(event) {

        event.preventDefault();

        var element = $(this),
            template_id = jQuery('#ts-layout-list input[type="radio"]:checked').val(),
            location = element.attr('data-location');

        if ( template_id == '' || typeof(template_id) == 'undefined' ) {
            alert('Please choose templete.');
            return;
        }

        element.siblings('button').trigger('click');

        $.ajax({
            url: ajaxurl,
            type: 'GET',
            dataType: 'json',
            data: { action: 'shootback_load_template', 'location': location, 'template_id': template_id }
        }).done(function(data) {

            $('#ts-template-id').val(data['template_id']);
            $('#ts-template-name').text(data['name']);
            $('.layout_builder').html(data['elements']);

            layout.init();

        }).fail(function() {
            alert("Error");
        });

    });

    // Remove template
    $(document).on('click', '.ts-remove-template', function(event) {

        event.preventDefault();

        if( ! layout.validateAction()) return;

        var element = $(this);
        var template_id = element.attr('data-template-id');
        var location = element.attr('data-location');

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'shootback_remove_template',
                location: location,
                template_id: template_id
            }
        }).done(function(data) {

            if (data['status'] === 'removed') {
                element.closest('tr').fadeOut('slow').remove();
            } else {
                alert(data.message);
            }

        }).fail(function() {
            alert("Error");
        });

    });

    jQuery('#publish').on('click', function() {
        window.builderDataChanged = false;
    });

    window.onbeforeunload = askUser ;

    window.builderDataChanged = false;

    function askUser(){
        if (window.builderDataChanged == true) {
            return "The changes you made will be loast if you navigate away from this page";
        }
    }
});

jQuery( document ).on( 'click', '.tsz-editor-modal-close, .ts-save-editor', function( e ) {
    e.preventDefault();

    jQuery( '.tsz-text-editor-modal' ).css( 'display', 'none' );

    jQuery( '.mce-inline-toolbar-grp' ).hide();

    jQuery( 'body' ).removeClass( 'tsz-modal-editor-open' );

    if ( jQuery( this ).hasClass( 'tsz-editor-modal-close' ) ) {

        tinymce.get( 'ts_editor_id' ).setContent( '' );
    }
});

jQuery(document).on('click', 'li#icon-text', function(event) {
    event.preventDefault();

    jQuery( '#ts-builder-elements-modal .close' ).trigger( 'click' );

    jQuery( '.tsz-text-editor-modal' ).css( 'display', 'block' );

    jQuery( 'body' ).addClass( 'tsz-modal-editor-open' );
});
jQuery('.tsz-text-editor-modal').find('#ts-toggle-layout-builder').remove();
