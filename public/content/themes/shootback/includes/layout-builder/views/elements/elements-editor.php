<?php   include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
        $list_products_ul = ''; 
        $list_products_select = '';
        $cart_li = '';
        $cart_select = '';

        if( is_plugin_active( 'woocommerce/woocommerce.php' ) ){
            $list_products_ul = '<li data-ts-tab-element="ts-post-tab" class="icon-basket" data-value="list-products"><span>' . __('List products', 'shootback') . '</span></li>';
            $list_products_select = '<option value="list-products">' . __( "List products","shootback" ) . '</option>';
            $cart_li = '<li data-ts-tab-element="ts-content-tab" class="icon-basket" data-value="cart"><span>' . __('Shopping cart', 'shootback') . '</span></li>';
            $cart_select = '<option value="cart">' . __( "Shopping cart","shootback" ) . '</option>';
        }

        $touchsize_com = '<a href="http://touchsize.com/shootback-doc">' . __('here','shootback') . '</a>.';
        $icons_array = get_option('shootback_typography', array());
    
        $icons_li = '';
        $icons_options = '';
        $icons_array['icons'] = explode(',', $icons_array['icons']);

        foreach ($icons_array['icons'] as $value) {
            $icons_li .= '<li><i class="'. trim($value) .' clickable-element" data-option="'. trim($value) .'"></i></li>';
            $icons_options .= '<option value="'. trim($value) .'"></option>';
        }
?>
        <div class="builder">
            <table cellpadding="10">
                <tr>
                    <td>
                        <label for="ts-element-type"><?php _e('Select the element type', 'shootback'); ?>:</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        
                        <ul class="ts-tab-elements">
                            <li data-ts-tab="ts-all-tab">
                                <?php _e('All', 'shootback'); ?>
                            </li>
                            <li data-ts-tab="ts-post-tab">
                                <?php _e('Post listing', 'shootback'); ?>
                            </li>
                            <li data-ts-tab="ts-content-tab">
                                <?php _e('Content elements', 'shootback'); ?>
                            </li>
                            <li data-ts-tab="ts-media-tab">
                                <?php _e('Media elements', 'shootback'); ?>
                            </li>
                        </ul>
                           
                        <div class="builder-element-array">
                             <ul>
                                <li data-ts-tab-element="ts-content-tab" class="icon-logo" data-value="logo"><span><?php _e( 'Logo', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-social" data-value="social-buttons"><span><?php _e( 'Social buttons', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-search" data-value="searchbox"><span><?php _e( 'Search box', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-menu" data-value="menu"><span><?php _e( 'Menu', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-sidebar" data-value="sidebar"><span><?php _e( 'Sidebar', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-desktop" data-value="slider"><span><?php _e( 'Slider', 'shootback' ); ?></span></li>

                                <!-- Post listing -->
                                <li data-ts-tab-element="ts-post-tab" class="icon-view-mode" data-value="last-posts"><span><?php _e( 'List posts', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-post-tab" class="icon-movie" data-value="list-videos"><span><?php _e( 'List Videos', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-post-tab" class="icon-gallery" data-value="list-galleries"><span><?php _e( 'List galleries', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-post-tab" class="icon-briefcase" data-value="list-portfolios"><span><?php _e( 'List portfolios', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-post-tab" class="icon-text" data-value="events"><span><?php _e( 'List Events', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-post-tab" class="icon-window" data-value="latest-custom-posts"><span><?php _e( 'Latest custom posts', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-post-tab" class="icon-dollar" data-value="pricing-tables"><span><?php _e( 'Pricing tables', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-post-tab" class="icon-filter" data-value="filters"><span><?php _e( 'Filters', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-post-tab" class="icon-clipboard" data-value="accordion"><span><?php _e( 'Article accordion', 'shootback' ); ?></span></li>
                                <!-- end Post listing -->

                                <li data-ts-tab-element="ts-content-tab" class="icon-comments" data-value="testimonials"><span><?php _e( 'Testimonials', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-direction" data-value="callaction"><span><?php _e( 'Call to action', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-team" data-value="teams"><span><?php _e( 'Teams', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-money" data-value="advertising"><span><?php _e( 'Advertising', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-all-tab" class="icon-empty" data-value="empty"><span><?php _e( 'Empty', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-delimiter" data-value="delimiter"><span><?php _e( 'Delimiter', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-font" data-value="title"><span><?php _e( 'Title', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-media-tab" class="icon-video" data-value="video"><span><?php _e( 'Video', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-media-tab" class="icon-image" data-value="image"><span><?php _e( 'Image', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-resize-vertical" data-value="spacer"><span><?php _e( 'Spacer', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-button" data-value="buttons"><span><?php _e( 'Button', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-mail" data-value="contact-form"><span><?php _e( 'Contact form', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-featured-area" data-value="featured-area"><span><?php _e( 'Featured area', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-code" data-value="shortcodes"><span><?php _e( 'Shortcodes', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-text" data-value="text" id="icon-text"><span><?php _e( 'Text', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-media-tab" class="icon-coverflow" data-value="image-carousel"><span><?php _e( 'Image carousel', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-flag" data-value="icon"><span><?php _e( 'Icon', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-list" data-value="listed-features"><span><?php _e( 'Listed features', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-tick" data-value="features-block"><span><?php _e( 'Icon box', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-time" data-value="counters"><span><?php _e( 'Counter', 'shootback' ); ?></span></li>
                                <?php echo $list_products_ul; ?>
                                <li data-ts-tab-element="ts-content-tab" class="icon-clients" data-value="clients"><span><?php _e( 'Clients', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-facebook" data-value="facebook-block"><span><?php _e( 'Facebook Like Box', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-pin" data-value="map"><span><?php _e( 'Map', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-link-ext" data-value="banner"><span><?php _e( 'Banner', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-resize-full" data-value="toggle"><span><?php _e( 'Toggle', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-tabs" data-value="tab"><span><?php _e( 'Tabs', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-code" data-value="breadcrumbs"><span><?php _e( 'Breadcrumbs', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-ribbon" data-value="ribbon"><span><?php _e( 'Ribbon banner', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-parallel" data-value="timeline"><span><?php _e( 'Timeline features', 'shootback' ); ?></span></li>
                                <?php echo $cart_li; ?>
                                <li data-ts-tab-element="ts-media-tab" class="icon-coverflow" data-value="video-carousel"><span><?php _e( 'Post slide carousel', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-media-tab" class="icon-gallery" data-value="gallery"><span><?php _e( 'Gallery', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-megaphone" data-value="count-down"><span><?php _e( 'Counter down', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-ticket" data-value="powerlink"><span><?php _e( 'Powerlink', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-calendar" data-value="calendar"><span><?php _e( 'Calendar', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-attention" data-value="alert"><span><?php _e( 'Alert', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-pencil-alt" data-value="skills"><span><?php _e( 'Skills', 'shootback' ); ?></span></li>
                                <li data-ts-tab-element="ts-content-tab" class="icon-chart" data-value="chart"><span><?php _e( 'Chart', 'shootback' ); ?></span></li>
                            </ul>
                        </div>
                        <select name="ts-element-type" id="ts-element-type" class="hidden">
                            <option value="logo"><?php _e( 'Logo', 'shootback' ); ?></option>
                            <option value="social-buttons"><?php _e( 'Social buttons', 'shootback' ); ?></option>
                            <option value="searchbox"><?php _e( 'Search box', 'shootback' ); ?></option>
                            <option value="menu"><?php _e( 'Menu', 'shootback' ); ?></option>
                            <option value="sidebar"><?php _e( 'Sidebar', 'shootback' ); ?></option>
                            <option value="slider"><?php _e( 'Slider', 'shootback' ); ?></option>
                            <option value="list-portfolios"><?php _e( 'List Portfolios', 'shootback' ); ?></option>
                            <option value="testimonials"><?php _e( 'Testimonials', 'shootback' ); ?></option>
                            <option value="last-posts"><?php _e( 'List Posts', 'shootback' ); ?></option>
                            <option value="callaction"><?php _e( 'Call to action', 'shootback' ); ?></option>
                            <option value="teams"><?php _e( 'Teams', 'shootback' ); ?></option>
                            <option value="advertising"><?php _e( 'Advertising', 'shootback' ); ?></option>
                            <option value="empty"><?php _e( 'Empty', 'shootback' ); ?></option>
                            <option value="delimiter"><?php _e( 'Delimiter', 'shootback' ); ?></option>
                            <option value="title"><?php _e( 'Title', 'shootback' ); ?></option>
                            <option value="video"><?php _e( 'Video', 'shootback' ); ?></option>
                            <option value="image"><?php _e( 'Image', 'shootback' ); ?></option>
                            <option value="filters"><?php _e( 'Filters', 'shootback' ); ?></option>
                            <option value="spacer"><?php _e( 'Spacer', 'shootback' ); ?></option>
                            <option value="buttons"><?php _e( 'Button', 'shootback' ); ?></option>
                            <option value="contact-form"><?php _e( 'Contact form', 'shootback' ); ?></option>
                            <option value="featured-area"><?php _e( 'Featured area', 'shootback' ); ?></option>
                            <option value="shortcodes"><?php _e( 'Shortcodes', 'shootback' ); ?></option>
                            <option value="text"><?php _e( 'Text', 'shootback' ); ?></option>
                            <option value="image-carousel"><?php _e( 'Image carousel', 'shootback' ); ?></option>
                            <option value="icon"><?php _e( 'Icon', 'shootback' ); ?></option>
                            <option value="pricing-tables"><?php _e( 'Pricing tables', 'shootback' ); ?></option>
                            <option value="listed-features"><?php _e( 'Listed features', 'shootback' ); ?></option>
                            <option value="features-block"><?php _e( 'Icon box', 'shootback' ); ?></option>
                            <option value="counters"><?php _e( 'Counters', 'shootback' ); ?></option>
                            <option value="clients"><?php _e( 'Clients', 'shootback' ); ?></option>
                            <option value="facebook-block"><?php _e( 'Facebook Like Box', 'shootback' ); ?></option>
                            <option value="map"><?php _e( 'Map', 'shootback' ); ?></option>
                            <option value="banner"><?php _e( 'Banner', 'shootback' ); ?></option>
                            <option value="toggle"><?php _e( 'Toggle', 'shootback' ); ?></option>
                            <?php echo $list_products_select; ?>
                            <option value="tab"><?php _e( 'Tabs', 'shootback' ); ?></option>
                            <option value="list-videos"><?php _e( 'List Videos', 'shootback' ); ?></option>
                            <option value="breadcrumbs"><?php _e( 'Breadcrumbs', 'shootback' ); ?></option>
                            <option value="latest-custom-posts"><?php _e( 'Latest custom posts', 'shootback' ); ?></option>
                            <option value="ribbon"><?php _e( 'Ribbon banner', 'shootback' ); ?></option>
                            <option value="timeline"><?php _e( 'Timeline features', 'shootback' ); ?></option>
                            <?php echo $cart_select; ?>
                            <option value="video-carousel"><?php _e( 'Post slide carousel', 'shootback' ); ?></option>                            
                            <option value="count-down"><?php _e( 'Counter down', 'shootback' ); ?></option>                            
                            <option value="powerlink"><?php _e( 'Powerlink', 'shootback' ); ?></option>
                            <option value="calendar"><?php _e( 'Calendar', 'shootback' ); ?></option>                
                            <option value="events"><?php _e( 'Events', 'shootback' ); ?></option>                
                            <option value="alert"><?php _e( 'Alert', 'shootback' ); ?></option>                
                            <option value="skills"><?php _e( 'Skills', 'shootback' ); ?></option>                
                            <option value="accordion"><?php _e( 'Article accordion', 'shootback' ); ?></option>
                            <option value="chart"><?php _e( 'Chart', 'shootback' ); ?></option>              
                            <option value="list-galleries"><?php _e( 'List galleries', 'shootback' ); ?></option>              
                            <option value="gallery"><?php _e( 'List galleries', 'shootback' ); ?></option>              
                        </select>
                    </td>
                </tr>
            </table>
        </div>

        <div id="builder-elements">
            <div class="logo builder-element hidden">
                <h3 class="element-title"><?php _e('Logo element', 'shootback'); ?></h3>
                <p><?php _e( 'You can add your logo in', 'shootback' ); ?> <strong><a target="_blank" href="<?php echo admin_url( 'admin.php?page=shootback&tab=styles#ts-logo-type' ) ?>"><?php _e( 'Shootback -- Styles -- Logo type', 'shootback' ); ?></a></strong></p>
                <table cellpadding="10">
                    <tr>
                        <td width="70px">
                            <?php _e('Logo align', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="logo[align]" id="logo-align">
                                <option value="text-left"><?php _e('Left', 'shootback'); ?></option>
                                <option value="text-right"><?php _e('Right', 'shootback'); ?></option>
                                <option value="text-center"><?php _e('Center', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="social-buttons builder-element hidden">
                <h3 class="element-title"><?php _e('Social icons element','shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="social-buttons-admin-label"><?php _e('Admin label:','shootback'); ?></label>
                        </td>
                        <td>
                           <input type="text" id="social-buttons-admin-label" name="social-name" />
                        </td>
                    </tr>
                    <tr>
                        <td width="70px">
                            <?php _e('Text align', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="social[align]" id="social-align">
                                <option value="text-left"><?php _e('Left', 'shootback'); ?></option>
                                <option value="text-right"><?php _e('Right', 'shootback'); ?></option>
                                <option value="text-center"><?php _e('Center', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
                <p><?php _e( 'You can edit this option in', 'shootback' ); ?> <strong><a target="_blank" href="<?php echo admin_url( 'admin.php?page=shootback&tab=social' ) ?>"><?php _e( 'Shootback -- Social', 'shootback' ); ?></a></strong></p>
            </div>

            <div class="searchbox builder-element hidden">
                <h3 class="element-title"><?php _e('Searchbar element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td width="70px">
                            <?php _e('Align', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="searchbox-align" id="searchbox-align">
                                <option selected="selected" value="left"><?php _e('Left', 'shootback'); ?></option>
                                <option value="right"><?php _e('Right', 'shootback'); ?></option>
                                <option value="center"><?php _e('Center', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
         
                     
        <div class="clients builder-element hidden">
            <h3 class="element-title"><?php _e('Clients block', 'shootback'); ?></h3>
            <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="clients-admin-label"><?php _e('Admin label:','shootback'); ?></label>
                        </td>
                        <td>
                           <input type="text" id="clients-admin-label" name="clients-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="clients-row"><?php _e( 'Number of elements per row', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#clients-row" id="clients-row-selector">
                               <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                            </ul>
                            <select name="clients-row" id="clients-row">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                            </select>   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><?php _e( 'Enable carousel:', 'shootback' ); ?></label>
                        </td>
                        <td>
                            <input type="radio" name="clients-enable-carousel" id="clients-enable-carousel-y" value="y"/> 
                            <label for="clients-enable-carousel-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                            <input type="radio" name="clients-enable-carousel" id="clients-enable-carousel-n" value="n"  checked = "checked" />
                            <label for="clients-enable-carousel-n"><?php _e( 'No', 'shootback' ); ?></label>
                        </td>
                    </tr>
                </table>
                
                <ul id="clients_items">
                   
                </ul>
                   
                <input type="hidden" id="clients_content" value="" />
                <input type="button" class="button ts-multiple-add-button" data-element-name="clients" id="clients_add_item" value=" <?php _e('Add New Client', 'shootback'); ?>" />
                <?php
                    echo '<script id="clients_items_template" type="text/template">
                            <li id="list-item-id-{{item-id}}" class="clients_item ts-multiple-add-list-element">
                                <div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="clients-item-tab ts-multiple-item-tab">Item: {{slide-number}}</span></div>
                                <div class="hidden">
                                    <table>
                                        <tr>
                                          <td>' . __( "Clients image","shootback" ) . '</td>
                                          <td>
                                                <input type="text" name="clients-{{item-id}}[image]" id="clients-{{item-id}}-image" value="" data-role="media-url" />
                                                <input type="hidden" id="slide_media_id-{{item-id}}" name="clients_media_id-{{item-id}}" value=""  data-role="media-id" />
                                                <input type="button" id="uploader_{{item-id}}"  class="button button-primary" value="' . __( "Upload","shootback" ) . '" />
                                                <div id="image-preview-{{item-id}}"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="clients-{{item-id}}-title">' . __( "Enter your title here:","shootback" ) . '</label>
                                            </td>
                                            <td>
                                               <input data-builder-name="title" type="text" id="clients-{{item-id}}-title" name="clients-[{{item-id}}][title]" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="clients-{{item-id}}-url">' . __( "Enter your url here:","shootback" ) . '</label>
                                            </td>
                                            <td>
                                               <input data-builder-name="url" type="text" id="clients-{{item-id}}-url" name="clients-[{{item-id}}][url]" />
                                            </td>
                                        </tr>
                                    </table>

                                    <input type="hidden" data-builder-name="item_id" value="{{item-id}}" name="clients[{{item-id}}][id]" />
                                    <input type="button" class="button button-primary remove-item" value="' . __('Remove', 'shootback') . '" />
                                    <a href="#" data-item="clients_item" data-increment="clients_items" class="button button-primary ts-multiple-item-duplicate">'.__('Duplicate Item', 'shootback').'</a>
                                </div>
                            </li>
                        </script>';
               ?>
        </div> 


            <div class="features-block builder-element hidden">
    
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="features-block-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="features-block-admin-label" name="features-block-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="features-block-row"><?php _e( 'Number of elements per row', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#features-block-row" id="features-block-row-selector">
                               <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                            </ul>
                            <select name="features-block-row" id="features-block-row">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                            </select>   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="features-block-gutter"><?php _e( 'Remove gutter(space) between articles:', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="features-block-gutter" id="features-block-gutter">
                                <option value="no-gutter"><?php _e('Yes', 'shootback'); ?></option>
                                <option selected="selected" value="gutter"><?php _e('No', 'shootback'); ?></option>
                            </select>   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="features-block-style"><?php _e( 'Style', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="features-block-style" id="features-block-style">
                                <option value="style1"><?php _e('Iconbox with border', 'shootback') ?></option>
                                <option value="style2"><?php _e('Feature with view background', 'shootback') ?></option>
                            </select>   
                        </td>
                    </tr>
                </table>

                <h3 class="element-title"><?php _e('Feature blocks', 'shootback'); ?></h3>
                <p><?php _e('Please select your icon, add your title and content below.', 'shootback'); ?></p>
                <ul id="features-block_items">
                   
                </ul>
                   
                <input type="hidden" id="features-block_content" value="" />
                <input type="button" class="button ts-multiple-add-button" data-element-name="features-block" id="features-block_add_item" value=" <?php _e('Add New Item', 'shootback'); ?>" />
                <?php
                    echo '<script id="features-block_items_template" type="text/template">';
                    echo '<li id="list-item-id-{{item-id}}" class="features-block-item ts-multiple-add-list-element">
                            <div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="features-block-item-tab ts-multiple-item-tab">Item: {{slide-number}}</span></div>
                            <div class="hidden">
                       <label for="features-block-icon">Choose your icon:</label>
                        <div class="builder-element-icon-toggle">
                            <a href="#" class="red-ui-button builder-element-icon-trigger-btn" data-toggle="#features-block-icon-id-{{item-id}}-selector">'.__('Show icons', 'shootback').'</a>
                        </div> 
                        <ul id="features-block-icon-id-{{item-id}}-selector" data-selector="#features-block-{{item-id}}-icon" class="builder-icon-list ts-custom-selector">'
                            . $icons_li .
                        '</ul>
                        <select data-builder-name="icon" name="features-block[{{item-id}}][icon]" id="features-block-{{item-id}}-icon" class="hidden">'
                           . $icons_options .
                        '</select>  
                       <table>
                            <tr>
                               <td>
                                   <label for="features-block-title">Enter your title here:</label>
                               </td>
                               <td>
                                   <input data-builder-name="title" type="text" id="features-block-{{item-id}}-title" name="features-block[{{item-id}}][title]" />
                               </td>
                            </tr>
                            <tr>
                               <td>
                                   <label for="features-block-text">Write your text here:</label>
                               </td>
                               <td>
                                   <textarea data-builder-name="text" name="features-block-{{item-id}}[text]" id="features-block-{{item-id}}-text" cols="45" rows="5"></textarea>
                               </td>
                           </tr>
                           <tr>
                               <td>
                                   <label for="features-block-url">Enter your url here:</label>
                               </td>
                               <td>
                                   <input data-builder-name="url" type="text" id="features-block-{{item-id}}-url" name="features-block[{{item-id}}][url]" />
                               </td>
                           </tr>
                            <tr>
                              <td>
                                  <label for="features-block-border">Border/Background color:</label>
                              </td>
                              <td>
                                 <input data-builder-name="background" type="text" value="#777" id="features-block-{{item-id}}-background" class="colors-section-picker" name="features-block[{{item-id}}][background]" />
                                 <div class="colors-section-picker-div" id="features-block-{{item-id}}-background-picker"></div>
                              </td>
                            </tr> 
                           <tr>
                              <td>
                                  <label for="features-block-font">Icon color:</label>
                              </td>
                              <td>
                                 <input data-builder-name="font" type="text" value="#777" id="features-block-{{item-id}}-font" class="colors-section-picker" name="features-block[{{item-id}}][font]" />
                                 <div class="colors-section-picker-div" id="features-block-{{item-id}}-font-picker"></div>
                              </td>
                          </tr>
                       </table>
                       <input type="hidden" data-builder-name="item_id" value="{{item-id}}" name="features-block[{{item-id}}][id]" />
                       <input type="button" class="button button-primary remove-item" value="'.__('Remove', 'shootback').'" />
                       <a href="#" data-item="features-block_item" data-increment="features-block_items" class="button button-primary ts-multiple-item-duplicate">'.__('Duplicate Item', 'shootback').'</a>
                       </div>
                    </li>
                   ';
                    echo '</script>';
                ?>
            </div>        

            <div class="listed-features builder-element hidden">
                <h3 class="element-title"><?php _e('Listed features', 'shootback'); ?></h3>
                <table>
                    <tr>
                        <td>
                            <label for="listed-features-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="listed-features-admin-label" name="listed-features-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="listed-features-align"><?php _e( "Icon alignment:","shootback") ?></label>
                        </td>
                        <td>
                            <select name="listed-features-align" id="listed-features-align">
                                <option value="text-left"><?php _e( "Left","shootback") ?></option>
                                <option value="text-right"><?php _e( "Right","shootback") ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="listed-features-color-style"><?php _e("Add color for:","shootback") ?></label>
                        </td>
                        <td>
                            <select name="listed-features-color-style" id="listed-features-color-style">
                                <option value="border"><?php _e( "Border","shootback") ?></option>
                                <option value="background"><?php _e( "Background","shootback") ?></option>
                                <option value="none"><?php _e( "None","shootback") ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
               <p><?php _e('Please select your icon, add your title and content below.', 'shootback'); ?></p>
               <ul id="listed-features_items">
                   
               </ul>
               <input type="hidden" id="listed-features_content" value="" />
               <input type="button" class="button ts-multiple-add-button" data-element-name="listed-features" id="listed-features_add_item" value=" <?php _e('Add New Item', 'shootback'); ?>" />
               <?php
                    echo '<script id="listed-features_items_template" type="text/template">';
                    echo '<li id="list-item-id-{{item-id}}" class="listed-features-item ts-multiple-add-list-element">
                            <div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="listed-features-item-tab ts-multiple-item-tab">' . __('Item:', 'shootback') . ' {{slide-number}}</span></div>
                            <div class="hidden">
                        <label for="listed-features-icon">' . __('Choose your icon:', 'shootback') . '</label>
                        <div class="builder-element-icon-toggle">
                            <a href="#" class="red-ui-button builder-element-icon-trigger-btn" data-toggle="#listed-features-icon-id-{{item-id}}-selector">' . __('Show icons', 'shootback') . '</a>
                        </div> 
                        <ul id="listed-features-icon-id-{{item-id}}-selector" data-selector="#listed-features-{{item-id}}-icon" class="builder-icon-list ts-custom-selector">';
                            echo $icons_li;
                    echo '</ul>
                        <select data-builder-name="icon" name="listed-features[{{item-id}}][icon]" id="listed-features-{{item-id}}-icon" class="hidden">'; 
                            echo $icons_options;
                    echo '</select>
                        <table>
                            <tr>
                                <td>
                                    <label for="listed-features-{{item-id}}-title">' . __('Enter your title here:', 'shootback') . '</label>
                                </td>
                                <td>
                                    <input data-builder-name="title" type="text" id="listed-features-{{item-id}}-title" name="listed-features[{{item-id}}][title]" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="listed-features-{{item-id}}-url">' . __('Enter title url here:', 'shootback') . '</label>
                                </td>
                                <td>
                                    <input data-builder-name="url" type="text" id="listed-features-{{item-id}}-url" name="listed-features[{{item-id}}][url]" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="listed-features-text">' . __('Write your text here:', 'shootback') . '</label>
                                </td>
                                <td>
                                    <textarea data-builder-name="text" name="listed-features-{{item-id}}-text" id="listed-features-{{item-id}}-text" cols="45" rows="5"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="listed-features-{{item-id}}-iconcolor">' . __('Icon color:', 'shootback') . '</label>
                                </td>
                                <td>
                                    <input data-builder-name="iconcolor" type="text" value="#777" id="listed-features-{{item-id}}-iconcolor" class="colors-section-picker" name="listed-features-{{item-id}}-icon-color" />
                                    <div class="colors-section-picker-div" id="listed-features-{{item-id}}-icon-color-picker"></div>
                                </td>
                            </tr>
                            <tr class="ts-border-color">
                                <td>
                                    <label for="listed-features-{{item-id}}-bordercolor">' . __('Border color:', 'shootback') . '</label>
                                </td>
                                <td>
                                    <input data-builder-name="bordercolor" type="text" value="#777" id="listed-features-{{item-id}}-bordercolor" class="colors-section-picker" name="listed-features-{{item-id}}-border-color" />
                                    <div class="colors-section-picker-div" id="listed-features-{{item-id}}-border-color-picker"></div>
                                </td>
                            </tr>  
                            <tr class="ts-background-color">
                                <td>
                                    <label for="listed-features-{{item-id}}-background-color">' . __('Background color:', 'shootback') . '</label>
                                </td>
                                <td>
                                    <input data-builder-name="backgroundcolor" type="text" value="#777" id="listed-features-{{item-id}}-backgroundcolor" class="colors-section-picker" name="listed-features-{{item-id}}-background-color" />
                                    <div class="colors-section-picker-div" id="listed-features-{{item-id}}-background-color-picker"></div>
                                </td>
                            </tr>  
                        </table>
                        <input type="hidden" data-builder-name="item_id" value="{{item-id}}" name="listed-features[{{item-id}}][id]" />
                        <input type="button" class="button button-primary remove-item" value="'.__('Remove', 'shootback').'" />
                        <a href="#" data-item="listed-features-item" data-increment="listed-features_items" class="button button-primary ts-multiple-item-duplicate">' . __('Duplicate Item', 'shootback') . '</a></div>
                    </li>
                   ';
                    echo '</script>';
               ?>
            </div>
            
            <div class="icon builder-element hidden">
                <h3 class="element-title"><?php _e('Icon element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="icon-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="icon-admin-label" name="icon-admin-label" />
                        </td>
                    </tr>
                </table>
                <p><?php _e('Choose your icon from the library below:', 'shootback'); ?></p>
                <div class="builder-element-icon-toggle">
                    <a href="#" class="red-ui-button builder-element-icon-trigger-btn" data-toggle="#builder-element-icon-selector"><?php _e('Show icons','shootback') ?></a>
                </div>    
                <ul id="builder-element-icon-selector" data-selector="#builder-element-icon" class="builder-icon-list ts-custom-selector">
                    <?php  echo $icons_li; ?>
                </ul>
                <select name="builder-element-icon" id="builder-element-icon" class="hidden">
                    <?php echo $icons_options; ?> 
                </select>
                
                <h3><?php _e('Icon options', 'shootback'); ?></h3>               
                <table>
                    <tr>
                        <td>
                            <label for="builder-element-icon-size"><?php _e('Select your icon size', 'shootback'); ?></label>
                        </td>
                        <td>
                            <input type="text" id="builder-element-icon-size" name="builder-element-icon-size" />px
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="builder-element-icon-color"><?php _e('Select your icon color', 'shootback'); ?></label>
                        </td>
                        <td>
                            <input type="text" id="builder-element-icon-color" class="colors-section-picker" value="#000" name="builder-element-icon-color" />
                            <div class="colors-section-picker-div" id=""></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="builder-element-icon-align"><?php _e('Select your icon align', 'shootback'); ?></label>
                        </td>
                        <td>
                            <select name="builder-element-icon-align" id="builder-element-icon-align">
                               <option value="left"><?php _e('Left', 'shootback'); ?></option>
                               <option value="center"><?php _e('Center', 'shootback'); ?></option>
                               <option value="right"><?php _e('Right', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="menu builder-element hidden">
                <h3 class="element-title"><?php _e('Menu element', 'shootback'); ?></h3>
                <table cellpadding="10">
                     <tr>
                        <td>
                            <label for="menu-admin-label"><?php _e('Admin label:','shootback');?></label>
                        </td>
                        <td>
                           <input type="text" id="menu-admin-label" name="menu-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Choose your menu','shootback'); ?>
                        </td>
                        <td>
                            <?php 
                                $menus = wp_get_nav_menus();
                                if( isset($menus) && is_array($menus) && !empty($menus) ) : ?>
                                    <select name="menu-name" id="menu-name">
                                        <?php foreach($menus as $menu) : ?>
                                            <?php if( is_object($menu) ) : ?>
                                                <option value="<?php echo $menu->term_id; ?>"><?php echo $menu->name; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                <?php else : ?>
                                    <p><?php _e('No selected items', 'shootback'); ?></p>
                                <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="70px">
                            <?php _e('Menu style', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="menu-styles" id="menu-styles">
                                <option value="style1"><?php _e('Horizontal menu', 'shootback') ?></option>
                                <?php
                                    if(fields::get_options_value('shootback_general', 'enable_mega_menu') == 'N'){
                                        echo "<option value='style2'>" . __('Vertical menu', 'shootback') . "</option>";
                                    }else{
                                        echo '';
                                    }
                                ?>
                                <option value="style3"><?php _e('Menu with logo in the middle', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="70px">
                            <?php _e('Uppercase', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="menu-uppercase" id="menu-uppercase">
                                <option value="menu-uppercase"><?php _e('Yes', 'shootback') ?></option>
                                <option selected="selected" value="menu-no-uppercase"><?php _e('No', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="70px">
                            <?php _e('Menu custom colors', 'shootback'); ?>
                        </td>
                        <td>
                            <input type="radio" value="no" name="menu-custom" id="menu-custom" /> Default colors
                            <input type="radio" value="yes" name="menu-custom" id="menu-custom" /> Custom colors
                        </td>
                    </tr>
                    <tr class="menu-custom-colors hidden">
                        <td valign="top">
                            <?php _e('Color settings', 'shootback') ?>:
                        </td>
                        <td>
                            <div class="menu-element-color-options menu-element-bg-color">
                                <div class="color-option-title">Menu background color</div>
                                <input type="text" id="menu-element-bg-color" class="colors-section-picker" name="menu-element-bg-color" value="#DDDDDD" />
                                <div class="colors-section-picker-div" id="menu-element-bg-color-picker"></div>
                           </div>
                            <div class="menu-element-color-options menu-element-text-color">
                                <div class="color-option-title">Menu text color</div>
                                <input type="text" id="menu-element-text-color" class="colors-section-picker" name="menu-element-text-color" value="#FFFFFF" />
                                <div class="colors-section-picker-div" id="menu-element-text-color-picker"></div>
                           </div>
                            <div class="menu-element-color-options menu-element-bg-color-hover">
                                <div class="color-option-title">Menu background color on hover</div>
                                <input type="text" id="menu-element-bg-color-hover" class="colors-section-picker" name="menu-element-bg-color-hover" value="#DDDDDD" />
                                <div class="colors-section-picker-div" id="menu-element-bg-color-hover-picker"></div>
                           </div>
                            <div class="menu-element-color-options menu-element-text-color-hover">
                                <div class="color-option-title">Menu text color on hover</div>
                                <input type="text" id="menu-element-text-color-hover" class="colors-section-picker" name="menu-element-text-color-hover" value="#FFFFFF" />
                                <div class="colors-section-picker-div" id="menu-element-text-color-hover-picker"></div>
                           </div>
                            <div class="menu-element-color-options menu-element-submenu-bg-color">
                                <div class="color-option-title">Submenu background color</div>
                                <input type="text" id="menu-element-submenu-bg-color" class="colors-section-picker" name="menu-element-submenu-bg-color" value="#DDDDDD" />
                                <div class="colors-section-picker-div" id="menu-element-submenu-bg-color-picker"></div>
                           </div>
                            <div class="menu-element-color-options menu-element-submenu-text-color">
                                <div class="color-option-title">Submenu text color</div>
                                <input type="text" id="menu-element-submenu-text-color" class="colors-section-picker" name="menu-element-submenu-text-color" value="#FFFFFF" />
                                <div class="colors-section-picker-div" id="menu-element-submenu-text-color-picker"></div>
                           </div>
                            <div class="menu-element-color-options menu-element-submenu-bg-color-hover">
                                <div class="color-option-title">Submenu background color on hover</div>
                                <input type="text" id="menu-element-submenu-bg-color-hover" class="colors-section-picker" name="menu-element-submenu-bg-color-hover" value="#DDDDDD" />
                                <div class="colors-section-picker-div" id="menu-element-submenu-bg-color-hover-picker"></div>
                           </div>
                            <div class="menu-element-color-options menu-element-submenu-text-color-hover">
                                <div class="color-option-title">Submenu text color on hover</div>
                                <input type="text" id="menu-element-submenu-text-color-hover" class="colors-section-picker" name="menu-element-submenu-text-color-hover" value="#FFFFFF" />
                                <div class="colors-section-picker-div" id="menu-element-submenu-text-color-hover-picker"></div>
                           </div>
                        </td>
                    </tr>
                     <tr>
                        <td width="70px">
                            <?php _e('Menu text align', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="menu-text-align" id="menu-text-align">
                                <option value="menu-text-align-left"><?php _e('Left', 'shootback') ?></option>
                                <option value="menu-text-align-right"><?php _e('Right', 'shootback') ?></option>
                                <option value="menu-text-align-center"><?php _e('Center', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr> 
                    <tr>
                        <td width="70px">
                            <?php _e('Hide icons', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="menu-icons" id="menu-icons">
                                <option value="y"><?php _e('Yes', 'shootback') ?></option>
                                <option selected="selected" value="n"><?php _e('No', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="70px">
                            <?php _e('Hide description', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="menu-description" id="menu-description">
                                <option value="y"><?php _e('Yes', 'shootback') ?></option>
                                <option selected="selected" value="n"><?php _e('No', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
                <script>
                    jQuery(document).ready(function(){
                        if (jQuery('.colors-section-picker-div').length) {
                            jQuery('.colors-section-picker-div').hide();

                            // jQuery('.colors-section-picker-div').farbtastic(".colors-section-picker");

                            jQuery(".colors-section-picker").click(function(e){
                                e.stopPropagation();
                                jQuery(jQuery(this).next()).show();
                            });
                            
                            // jQuery('body').click(function() {
                            //  jQuery('.colors-section-picker-div').hide();
                            // });
                            var pickers = jQuery('.colors-section-picker-div');
                            setTimeout(function(){
                                jQuery.each(pickers, function( index, value ) {
                                    jQuery(this).farbtastic(jQuery(this).prev());
                                });
                            },100);
                            jQuery('body').click(function() {
                                jQuery(pickers).hide();
                            });
                        }
                    });
                    jQuery('input[name="menu-custom"]').change(function(){
                        if ( jQuery(this).val() == 'yes' ) {
                            jQuery('.menu-custom-colors').removeClass('hidden');
                        } else{
                            jQuery('.menu-custom-colors').addClass('hidden');
                        }
                    });
                    jQuery(document).ready(function(){
                        menu_colors_value = jQuery('#menu-custom').val();
                        jQuery('input[value="'+menu_colors_value+'"]').attr('checked','checked')
                    });
                </script>
            </div>
            
            <div class="sidebar builder-element hidden">
                <h3 class="element-title">Sidebar element</h3>
                <table cellpadding="10">
                     <tr>
                        <td>
                            <label for="sidebar-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="sidebar-admin-label" name="sidebar-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td width="70px">
                            <?php _e('Sidebars', 'shootback'); ?>
                        </td>
                        <td>
                            <?php
                                echo ts_sidebars_drop_down('','available-sidebars');
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="slider builder-element hidden">
                <h3 class="element-title">Slider element</h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="slider-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="slider-admin-label" name="slider-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="slider-name"><?php _e( 'Slider to display', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="slider-name" id="slider-name">
                            <?php 
                                echo '<option value="0">-- ' . __( 'Select slider', 'shootback' ) . ' --</option>';
                                $show_where_user_can_add_sliders = false;
                                $args = array(
                                    'post_type' => 'ts_slider',
                                    'posts_per_page' => -1,
                                    'post_status' =>'publish'
                                );
                                
                                $sliders = new WP_Query( $args );

                                if ($sliders->have_posts()) {
                                    while ( $sliders->have_posts() ) :
                                        $sliders->the_post();
                                        echo '<option value="' . get_the_ID() .'">' . get_the_title() . '</option>';
                                    endwhile;
                                } else {
                                    $show_where_user_can_add_sliders = true;
                                }

                                wp_reset_postdata();
                            ?>
                            </select>

                            <?php if ($show_where_user_can_add_sliders): ?>
                                <p><?php _e( 'Looks like you dont have any slider. You can create one', 'shootback' ); ?> <strong><a target="_blank" href="<?php echo admin_url( 'edit.php?post_type=ts_slider' ) ?>"><?php _e( 'here', 'shootback' ); ?></a></strong></p>
                            <?php endif ?>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="list-portfolios builder-element hidden">
                <h3 class="element-title"><?php _e('List portfolios element','shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="list-portfolios-admin-label"><?php _e('Admin label:','shootback'); ?></label>
                        </td>
                        <td>
                           <input type="text" id="list-portfolios-admin-label" name="list-portfolios-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <label for="list-portfolios-category"><?php _e( 'Category:', 'shootback' ); ?></label>
                        </td>
                        <td>
                            <?php 
                                $categories = get_categories(array( 'hide_empty' => 0, 'taxonomy' => 'portfolio_register_post_type', 'pad_counts' => true ));
                                if( isset($categories) && !is_wp_error($categories) && !empty($categories) ) : ?>
                                    <select class="ts-custom-select-input" data-placeholder="<?php _e('Select your category', 'shootback'); ?>" name="list-portfolios-category" id="list-portfolios-category" multiple>
                                        <option value="0"><?php _e('All', 'shootback') ?></option>
                                        <?php foreach ($categories as $index => $category): ?>
                                            <option value="<?php echo $category->slug ?>"><?php echo $category->cat_name ?></option>
                                        <?php endforeach ?>                                    
                                    </select>
                                <?php else : ?>
                                    <select class="ts-custom-select-input" data-placeholder="<?php _e('Select your category', 'shootback'); ?>" name="teams-category" id="teams-category" multiple>
                                    </select>
                                <?php endif; ?>
                            <div class="ts-option-description">
                                <?php _e('Choose the categories that you want to showcase articles from.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="list-portfolios-display-mode"><?php _e( 'How to display:', 'shootback' ); ?></label>
                        </td>
                        <td>
                            <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-portfolios-display-mode" id="list-portfolios-display-mode-selector">
                               <li><img class="image-radio-input clickable-element" data-option="grid" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_excerpt.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="list" src="<?php echo get_template_directory_uri().'/images/options/list_view_13.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="thumbnails" src="<?php echo get_template_directory_uri().'/images/options/thumb_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="big-post" src="<?php echo get_template_directory_uri().'/images/options/big_posts_12.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="super-post" src="<?php echo get_template_directory_uri().'/images/options/super_post_view.png'; ?>"></li>
                            </ul>
                            <select class="hidden" name="list-portfolios-display-mode" id="list-portfolios-display-mode">
                                <option value="grid"><?php _e( 'Grid', 'shootback' ); ?></option>
                                <option value="list"><?php _e( 'List', 'shootback' ); ?></option>
                                <option value="thumbnails"><?php _e( 'Thumbnails', 'shootback' ); ?></option>
                                <option value="big-post"><?php _e( 'Big post', 'shootback' ); ?></option>
                                <option value="super-post"><?php _e( 'Super Post', 'shootback' ); ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose your article view type. Depending on what type of article showcase layout you select you will get different options. You can read more about view types in our documentation files: ', 'shootback'); echo $touchsize_com; ?>
                            </div>
                        </td>
                    </tr>
                </table>

                <div id="list-portfolios-display-mode-options">
                    <!-- Grid options -->
                    <div class="list-portfolios-grid hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label><?php _e( 'Behavior:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-portfolios-grid-behavior" id="list-portfolios-grid-behavior-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="none" src="<?php echo get_template_directory_uri().'/images/options/behavior_none.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="carousel" src="<?php echo get_template_directory_uri().'/images/options/behavior_carousel.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="masonry" src="<?php echo get_template_directory_uri().'/images/options/behavior_masonry.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-portfolios-grid-behavior" id="list-portfolios-grid-behavior">
                                        <option value="none"><?php _e( 'Normal', 'shootback' ); ?></option>
                                        <option value="carousel"><?php _e( 'Carousel', 'shootback' ); ?></option>
                                        <option value="masonry"><?php _e( 'Masonry', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your posts behavior - you can have them just shown, or you can activate the carousel. If carousel is selected your articles will show up in a line with arrows for navigation. If masonry bahevior is selected - your articles will be arranged in to fit it. Be aware that activating the masonry option the crop settings for image sizes tab will be overwritten.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-grid-title"><?php _e( 'Title position', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-portfolios-grid-title" id="list-portfolios-grid-title-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="title-above-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_image.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="title-below-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_excerpt.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-portfolios-grid-title" id="list-portfolios-grid-title">
                                        <option value="title-above-image"><?php _e( 'Above image', 'shootback' ); ?></option>
                                        <option value="title-below-image"><?php _e( 'Above excerpt', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Select your title position for you grid posts. You can either have it above the image of above the excerpt. Note that sometimes title may change the position of the meta (date, categories, author) as well.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-grid-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="list-portfolios-grid-show-meta" id="list-portfolios-grid-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="list-portfolios-grid-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-portfolios-grid-show-meta" id="list-portfolios-grid-show-meta-n" value="n" />
                                    <label for="list-portfolios-grid-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-grid-el-per-row"><?php _e( 'Elements per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-portfolios-grid-el-per-row" id="list-portfolios-grid-el-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-portfolios-grid-el-per-row" id="list-portfolios-grid-el-per-row">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-grid-nr-of-posts"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-portfolios-grid-nr-of-posts" id="list-portfolios-grid-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-grid-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-portfolios-grid-order-by" id="list-portfolios-grid-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-grid-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-portfolios-grid-order-direction" id="list-portfolios-grid-order-direction">
                                        <option value="ASC"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="DESC" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-grid-special-effects"><?php _e( 'Special effects', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-portfolios-grid-special-effects" id="list-portfolios-grid-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- List options -->
                    <div class="list-portfolios-list hidden">

                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-portfolios-list-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="list-portfolios-list-show-meta" id="list-portfolios-list-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="list-portfolios-list-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-portfolios-list-show-meta" id="list-portfolios-list-show-meta-n" value="n" />
                                    <label for="list-portfolios-list-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-list-nr-of-posts"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-portfolios-list-nr-of-posts" id="list-portfolios-list-nr-of-posts" size="4"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e( 'Content split', 'shootback' ); ?>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-portfolios-list-image-split" id="list-portfolios-list-image-split-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1-3" src="<?php echo get_template_directory_uri().'/images/options/list_view_13.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="1-2" src="<?php echo get_template_directory_uri().'/images/options/list_view_12.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3-4" src="<?php echo get_template_directory_uri().'/images/options/list_view_34.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-portfolios-list-image-split" id="list-portfolios-list-image-split">
                                        <option value="1-3">1/3</option>
                                        <option value="1-2">1/2</option>
                                        <option value="3-4">3/4</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-list-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-portfolios-list-order-by" id="list-portfolios-list-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-list-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-portfolios-list-order-direction" id="list-portfolios-list-order-direction">
                                        <option value="ASC"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="DESC" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-list-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-portfolios-list-special-effects" id="list-portfolios-list-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>

                        </table>
                    </div>

                    <!-- Thumbnail options -->
                    <div class="list-portfolios-thumbnails hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-portfolios-thumbnail-title"><?php _e( 'Title position', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-portfolios-thumbnail-title" id="list-portfolios-thumbnail-title">
                                        <option value="over-image" selected="selected"><?php _e( 'Over image', 'shootback' ); ?></option>
                                        <option value="below-image"><?php _e( 'Below image', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><?php _e( 'Enable carousel', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="list-portfolios-thumbnail-enable-carousel" id="list-portfolios-thumbnail-enable-carousel-y" value="y" /> 
                                    <label for="list-portfolios-thumbnail-enable-carousel-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-portfolios-thumbnail-enable-carousel" id="list-portfolios-thumbnail-enable-carousel-n" value="n"  checked = "checked"  />
                                    <label for="list-portfolios-thumbnail-enable-carousel-n"><?php _e( 'No', 'shootback' ); ?></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-thumbnail-posts-per-row"><?php _e( 'Number of posts per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-portfolios-thumbnail-posts-per-row" id="list-portfolios-thumbnail-posts-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-portfolios-thumbnail-posts-per-row" id="list-portfolios-thumbnail-posts-per-row">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-thumbnail-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-portfolios-thumbnail-limit"  id="list-portfolios-thumbnail-limit" size="4"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-thumbnail-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-portfolios-thumbnail-order-by" id="list-portfolios-thumbnail-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-thumbnail-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-portfolios-thumbnail-order-direction" id="list-portfolios-thumbnail-order-direction">
                                        <option value="ASC"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="DESC" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-thumbnail-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-portfolios-thumbnail-special-effects" id="list-portfolios-thumbnail-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale' , 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-thumbnail-gutter"><?php _e( 'Remove gutter(space) between articles:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-portfolios-thumbnail-gutter" id="list-portfolios-thumbnail-gutter">
                                        <option value="n"><?php _e('No', 'shootback') ?></option>
                                        <option value="y"><?php _e('Yes', 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="list-portfolios-big-post hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-portfolios-big-post-title"><?php _e( 'Title position:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-portfolios-big-post-title" id="list-portfolios-big-post-title-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="title-above-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_image.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="title-below-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_excerpt.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-portfolios-big-post-title" id="list-portfolios-big-post-title">
                                        <option value="title-above-image"><?php _e( 'Above image', 'shootback' ); ?></option>
                                        <option value="title-below-image"><?php _e( 'Above excerpt', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-big-post-show-meta"><?php _e( 'Show meta:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="list-portfolios-big-post-show-meta" id="list-portfolios-big-post-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="list-portfolios-big-post-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-portfolios-big-post-show-meta" id="list-portfolios-big-post-show-meta-n" value="n" />
                                    <label for="list-portfolios-big-post-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-big-post-nr-of-posts"><?php _e( 'How many posts to extract:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-portfolios-big-post-nr-of-posts" id="list-portfolios-big-post-nr-of-posts" size="4"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e( 'Content split', 'shootback' ); ?>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-portfolios-big-post-image-split" id="list-portfolios-big-post-image-split-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1-3" src="<?php echo get_template_directory_uri().'/images/options/list_view_13.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="1-2" src="<?php echo get_template_directory_uri().'/images/options/list_view_12.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3-4" src="<?php echo get_template_directory_uri().'/images/options/list_view_34.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-portfolios-big-post-image-split" id="list-portfolios-big-post-image-split">
                                        <option value="1-3">1/3</option>
                                        <option value="1-2">1/2</option>
                                        <option value="3-4">3/4</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-big-post-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-portfolios-big-post-order-by" id="list-portfolios-big-post-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-big-post-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-portfolios-big-post-order-direction" id="list-portfolios-big-post-order-direction">
                                        <option value="ASC"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="DESC"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-big-post-show-related"><?php _e( 'Show related posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="list-portfolios-big-post-show-related" id="list-portfolios-big-post-show-related-y" value="y"/> 
                                    <label for="list-portfolios-big-post-show-related-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" checked = "checked" name="list-portfolios-big-post-show-related" id="list-portfolios-big-post-show-related-n" value="n" />
                                    <label for="list-portfolios-big-post-show-related-n"><?php _e( 'No', 'shootback' ); ?></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-big-post-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-portfolios-big-post-special-effects" id="list-portfolios-big-post-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="list-portfolios-super-post hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-portfolios-super-post-posts-per-row"><?php _e( 'Number of posts per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-portfolios-super-post-posts-per-row" id="list-portfolios-super-post-posts-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-portfolios-super-post-posts-per-row" id="list-portfolios-super-post-posts-per-row">
                                        <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-super-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-portfolios-super-post-limit"  id="list-portfolios-super-post-limit" size="4"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-super-post-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-portfolios-super-post-order-by" id="list-portfolios-super-post-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     <label for="list-portfolios-super-post-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-portfolios-super-post-order-direction" id="list-portfolios-super-post-order-direction">
                                        <option value="ASC"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="DESC"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-portfolios-super-post-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-portfolios-super-post-special-effects" id="list-portfolios-super-post-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                
                </div>
            </div>

            <div class="testimonials builder-element hidden">
                <h3 class="element-title"><?php _e('Testimonials element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="testimonials-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="testimonials-admin-label" name="testimonials-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="testimonials-row"><?php _e( 'Number of testimonials per row:', 'shootback' ); ?></label>
                        </td>
                        <td>
                            <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#testimonials-row" id="testimonials-row-selector">
                               <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                            </ul>
                            <select name="testimonials-row" id="testimonials-row">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                            </select>   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="testimonials-enable-carousel"><?php _e( 'Enable carousel', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="testimonials-enable-carousel" id="testimonials-enable-carousel">
                                <option value="N">No</option>
                                <option value="Y">Yes</option>
                            </select>   
                        </td>
                    </tr>
                </table>
                <ul id="testimonials_items">
                   
                </ul>
                   
                <input type="hidden" id="testimonials_content" value="" />
                <input type="button" class="button ts-multiple-add-button" data-element-name="testimonials" id="testimonials_add_item" value=" <?php _e('Add New Testimonial', 'shootback'); ?>" />
                <?php
                    echo '<script id="testimonials_items_template" type="text/template">';
                    echo '<li id="list-item-id-{{item-id}}" class="testimonials-item ts-multiple-add-list-element">
                            <div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="testimonials-item-tab ts-multiple-item-tab">Item: {{slide-number}}</span></div>
                            <div class="hidden">
                                <table>
                                    <tr>
                                        <td>' . __( "Testimonial image","shootback" ) .'</td>
                                        <td>
                                            <input type="text" name="testimonials-{{item-id}}-image" id="testimonials-{{item-id}}-image" value="" data-role="media-url" />
                                            <input type="hidden" id="slide_media_id-{{item-id}}" name="testimonials_media_id-{{item-id}}" value=""  data-role="media-id" />
                                            <input type="button" id="uploader_{{item-id}}" data-element-name="testimonials"  class="button button-primary" value="' . __( "Upload","shootback" ) . '" />
                                            <div id="image-preview-{{item-id}}"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="testimonials-{{item-id}}-text">' . __( "Write your text here:","shootback" ) . '</label>
                                        </td>
                                        <td>
                                            <textarea data-builder-name="text" name="testimonials[{{item-id}}][text]" id="testimonials-{{item-id}}-text" cols="45" rows="5"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="testimonials-{{item-id}}-name">' . __( "Enter your person name:","shootback" ) . '</label>
                                        </td>
                                        <td>
                                            <input data-builder-name="name" type="text" id="testimonials-{{item-id}}-name" name="testimonials[{{item-id}}][name]" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="testimonials-{{item-id}}-company">' . __( "Enter company name:","shootback" ) . '</label>
                                        </td>
                                        <td>
                                            <input data-builder-name="company" type="text" id="testimonials-{{item-id}}-company" name="testimonials[{{item-id}}][company]" />
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>
                                            <label for="testimonials-{{item-id}}-url">' . __( "Enter your url here:","shootback" ) . '</label>
                                        </td>
                                        <td>
                                            <input data-builder-name="url" type="text" id="testimonials-{{item-id}}-url" name="testimonials[{{item-id}}][url]" />
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" data-builder-name="item_id" value="{{item-id}}" name="testimonials[{{item-id}}][id]" />
                                <input type="button" class="button button-primary remove-item" value="' . __('Remove', 'shootback') . '" />
                                <a href="#" data-item="testimonials-item" data-element-name="testimonials" data-increment="testimonials-items" class="button button-primary ts-multiple-item-duplicate">' . __('Duplicate Item', 'shootback') . '</a>
                            </div>
                        </li>';
                    echo '</script>';
               ?>
              
            </div>

            <div class="last-posts builder-element hidden">
                <h3 class="element-title"><?php _e('List posts element','shootback');?></h3>
                <!-- Select category -->
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="last-posts-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="last-posts-admin-label" name="last-posts-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <label for="last-posts-category"><?php _e( 'Category', 'shootback' ); ?>:</label>
                        </td>
                        <td>                           
                            <select data-placeholder="<?php _e('Select your category', 'shootback'); ?>" class="ts-custom-select-input" name="last-posts-category" id="last-posts-category" multiple>
                                <?php $categories = get_categories(array( 'hide_empty' => 0, 'show_option_all' => '' )); ?>
                                <?php if ( isset($categories) && is_array($categories) && !empty($categories) ) : ?>
                                    <?php $i = 1; foreach ($categories as $index => $category): ?>
                                        <?php if( is_object($category) ) : ?>
                                            <?php if( $i === 1 ) echo '<option value="0">' . __('All', 'shootback') . '</option>'; ?>
                                            <option value="<?php echo $category->slug ?>"><?php echo $category->cat_name ?></option>
                                        <?php endif; $i++; ?>
                                    <?php endforeach ?>                                    
                                <?php endif ?>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose the categories that you want to showcase articles from.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><?php _e( 'Show only featured', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="last-posts-featured" id="last-posts-featured">
                                <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                <option value="n" selected="selected"><?php _e( 'No', 'shootback' ); ?></option>
                            </select>

                            <div class="ts-option-description">
                                <?php _e('You can display only featured posts', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="last-posts-exclude"><?php _e( 'Exclude post IDs', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="last-posts-exclude" id="last-posts-exclude" size="4"/>
                            <div class="ts-option-description">
                                <?php _e('Insert the IDs of the posts you want to exclude from showing.', 'shootback'); ?> (ex: <b>100,101,102,104</b>)
                            </div>
                        </td>
                    </tr>
                     <tr class="last-posts-exclude">
                        <td>
                            <label for="last-posts-exclude-first"><?php _e( 'Exclude number of first posts', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="last-posts-exclude-first" id="last-posts-exclude-first" size="4"/>
                            <div class="ts-option-description">
                                <?php _e('Insert the number of the posts you want to exclude from showing.', 'shootback'); ?> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="last-posts-display-mode"><?php _e( 'How to display', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#last-posts-display-mode" id="last-posts-display-mode-selector">
                               <li><img class="image-radio-input clickable-element" data-option="grid" src="<?php echo get_template_directory_uri().'/images/options/grid_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="list" src="<?php echo get_template_directory_uri().'/images/options/list_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="thumbnails" src="<?php echo get_template_directory_uri().'/images/options/thumb_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="big-post" src="<?php echo get_template_directory_uri().'/images/options/big_posts_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="super-post" src="<?php echo get_template_directory_uri().'/images/options/super_post_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="timeline" src="<?php echo get_template_directory_uri().'/images/options/timeline_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="mosaic" src="<?php echo get_template_directory_uri().'/images/options/mosaic_view.png'; ?>"></li>
                            </ul>
                            <select class="select_2" class="hidden" name="last-posts-display-mode" id="last-posts-display-mode">
                                <option value="grid"><?php _e( 'Grid', 'shootback' ); ?></option>
                                <option value="list"><?php _e( 'List', 'shootback' ); ?></option>
                                <option value="thumbnails"><?php _e( 'Thumbnails', 'shootback' ); ?></option>
                                <option value="big-post"><?php _e( 'Big post', 'shootback' ); ?></option>
                                <option value="super-post"><?php _e( 'Super Post', 'shootback' ); ?></option>
                                <option value="timeline"><?php _e( 'Timeline Post', 'shootback' ); ?></option>
                                <option value="mosaic"><?php _e( 'mosaic Post', 'shootback' ); ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose your article view type. Depending on what type of article showcase layout you select you will get different options. You can read more about view types in our documentation files: ', 'shootback'); echo $touchsize_com; ?>
                            </div>
                        </td>
                    </tr>
                </table>

                <div id="last-posts-display-mode-options">
                    <!-- Grid options -->
                    <div class="last-posts-grid hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label><?php _e( 'Behavior', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#last-posts-grid-behavior" id="last-posts-grid-behavior-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="none" src="<?php echo get_template_directory_uri().'/images/options/behavior_none.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="carousel" src="<?php echo get_template_directory_uri().'/images/options/behavior_carousel.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="masonry" src="<?php echo get_template_directory_uri().'/images/options/behavior_masonry.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="scroll" src="<?php echo get_template_directory_uri().'/images/options/behavior_scroll.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="tabbed" src="<?php echo get_template_directory_uri().'/images/options/behavior_tabs.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="last-posts-grid-behavior" id="last-posts-grid-behavior">
                                        <option value="none"><?php _e( 'Normal', 'shootback' ); ?></option>
                                        <option value="carousel"><?php _e( 'Carousel', 'shootback' ); ?></option>
                                        <option value="masonry"><?php _e( 'Masonry', 'shootback' ); ?></option>
                                        <option value="scroll"><?php _e( 'Scroll', 'shootback' ); ?></option>
                                        <option value="tabbed"><?php _e( 'Tabbed', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your posts behavior - you can have them just shown, or you can activate the carousel. If carousel is selected your articles will show up in a line with arrows for navigation. If masonry bahevior is selected - your articles will be arranged in to fit it. Be aware that activating the masonry option the crop settings for image sizes tab will be overwritten.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-grid-image"><?php _e( 'Show featured image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-grid-image" id="last-posts-grid-image">
                                        <option selected="selected" value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-grid-title"><?php _e( 'Title position', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#last-posts-grid-title" id="last-posts-grid-title-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="title-above-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_image.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="title-below-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_excerpt.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="last-posts-grid-title" id="last-posts-grid-title">
                                        <option value="title-above-image"><?php _e( 'Above image', 'shootback' ); ?></option>
                                        <option value="title-below-image" selected="selected"><?php _e( 'Above excerpt', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Select your title position for you grid posts. You can either have it above the image of above the excerpt. Note that sometimes title may change the position of the meta (date, categories, author) as well.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-grid-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="last-posts-grid-show-meta" id="last-posts-grid-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="last-posts-grid-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="last-posts-grid-show-meta" id="last-posts-grid-show-meta-n" value="n" />
                                    <label for="last-posts-grid-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-grid-el-per-row"><?php _e( 'Elements per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#last-posts-grid-el-per-row" id="last-posts-grid-el-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="last-posts-grid-el-per-row" id="last-posts-grid-el-per-row">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="last-posts-grid-nr-of-posts">
                                <td>
                                    <label for="last-posts-grid-nr-of-posts"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="last-posts-grid-nr-of-posts" id="last-posts-grid-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-grid-related"><?php _e( 'Show related posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-grid-related" id="last-posts-grid-related">
                                        <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option selected="selected" value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can set each of your big posts to show related articles below. A list with other articles will appear below.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-grid-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-grid-order-by" id="last-posts-grid-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-grid-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-grid-order-direction" id="last-posts-grid-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-grid-special-effects"><?php _e( 'Special effects', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-grid-special-effects" id="last-posts-grid-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="last-posts-grid-pagination">
                                <td>
                                    <label for="last-posts-grid-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-grid-pagination" id="last-posts-grid-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- List options -->
                    <div class="last-posts-list hidden">

                        <table cellpadding="10">
                           <!--  <tr>
                                <td>
                                    <label for="last-posts-list-title"><?php _e( 'Title:', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-list-title" id="last-posts-list-title">
                                        <option value="title-above-image"><?php _e( 'Above image', 'shootback' ); ?></option>
                                        <option value="title-below-image"><?php _e( 'Above excerpt', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr> -->
                            <tr>
                                <td>
                                    <label for="last-posts-list-image"><?php _e( 'Show featured image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-list-image" id="last-posts-list-image">
                                        <option selected="selected" value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-list-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="last-posts-list-show-meta" id="last-posts-list-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="last-posts-list-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input selected="selected" type="radio" name="last-posts-list-show-meta" id="last-posts-list-show-meta-n" value="n" />
                                    <label for="last-posts-list-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="last-posts-list-nr-of-posts">
                                <td>
                                    <label for="last-posts-list-nr-of-posts"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="last-posts-list-nr-of-posts" id="last-posts-list-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e( 'Content split', 'shootback' ); ?>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#last-posts-list-image-split" id="last-posts-list-image-split-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1-3" src="<?php echo get_template_directory_uri().'/images/options/list_view_13.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="1-2" src="<?php echo get_template_directory_uri().'/images/options/list_view_12.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3-4" src="<?php echo get_template_directory_uri().'/images/options/list_view_34.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="last-posts-list-image-split" id="last-posts-list-image-split">
                                        <option value="1-3">1/3</option>
                                        <option value="1-2">1/2</option>
                                        <option value="3-4">3/4</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your title/content split proportions. You can have them either 1/3, 1/2, 3/4 for your title and 2/3,1/2, 1/4 accordingly. Depending on the text and titles you use, select your split type.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-list-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-list-order-by" id="last-posts-list-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-list-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-list-order-direction" id="last-posts-list-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-list-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="last-posts-list-special-effects" id="last-posts-list-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-list-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-list-pagination" id="last-posts-list-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Thumbnail options -->
                    <div class="last-posts-thumbnails hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="last-posts-thumbnail-title"><?php _e( 'Title position', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-thumbnail-title" id="last-posts-thumbnail-title">
                                        <option value="over-image" selected="selected"><?php _e( 'Over image', 'shootback' ); ?></option>
                                        <option value="below-image"><?php _e( 'Below image', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><?php _e( 'Behavior', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#last-posts-thumbnails-behavior" id="last-posts-thumbnails-behavior-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="none" src="<?php echo get_template_directory_uri().'/images/options/behavior_none.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="carousel" src="<?php echo get_template_directory_uri().'/images/options/behavior_carousel.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="masonry" src="<?php echo get_template_directory_uri().'/images/options/behavior_masonry.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="scroll" src="<?php echo get_template_directory_uri().'/images/options/behavior_scroll.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="tabbed" src="<?php echo get_template_directory_uri().'/images/options/behavior_tabs.png'; ?>"></li>
                                    </ul>
                                    <select name="last-posts-thumbnails-behavior" id="last-posts-thumbnails-behavior">
                                        <option value="none"><?php _e( 'Normal', 'shootback' ); ?></option>
                                        <option value="carousel"><?php _e('Carousel', 'shootback') ?></option>
                                        <option value="masonry"><?php _e('Masonry', 'shootback') ?></option>
                                        <option value="scroll"><?php _e('Scroll', 'shootback') ?></option>
                                        <option value="tabbed"><?php _e('Tabbed', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your posts behavior - you can have them just shown, or you can activate the carousel. If carousel is selected your articles will show up in a line with arrows for navigation. If masonry bahevior is selected - your articles will be arranged in to fit it. Be aware that activating the masonry option the crop settings for image sizes tab will be overwritten.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-thumbnail-posts-per-row"><?php _e( 'Number of posts per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#last-posts-thumbnail-posts-per-row" id="last-posts-thumbnail-posts-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="last-posts-thumbnail-posts-per-row" id="last-posts-thumbnail-posts-per-row">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="last-posts-thumbnails-nr-of-posts">
                                <td>
                                    <label for="last-posts-thumbnail-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="last-posts-thumbnail-limit"  id="last-posts-thumbnail-limit" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    <label for="last-posts-thumbnail-show-meta"><?php _e( 'Show meta:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="last-posts-thumbnail-show-meta" id="last-posts-thumbnail-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="last-posts-thumbnail-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="last-posts-thumbnail-show-meta" id="last-posts-thumbnail-show-meta-n" value="n" />
                                    <label for="last-posts-thumbnail-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-thumbnail-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-thumbnail-order-by" id="last-posts-thumbnail-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-thumbnail-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-thumbnail-order-direction" id="last-posts-thumbnails-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-thumbnail-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="last-posts-thumbnail-special-effects" id="last-posts-thumbnail-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale' , 'shootback') ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-thumbnail-gutter"><?php _e( 'Remove gutter(space) between articles:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="last-posts-thumbnail-gutter" id="last-posts-thumbnail-gutter">
                                        <option value="n"><?php _e('No', 'shootback') ?></option>
                                        <option value="y"><?php _e('Yes', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Gutter is the space between your articles. You can remove the space and have your articles sticked one to another.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="last-posts-thumbnails-pagination">
                                <td>
                                    <label for="last-posts-thumbnails-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-thumbnails-pagination" id="last-posts-thumbnails-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="last-posts-big-post hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="last-posts-big-post-image"><?php _e( 'Show featured image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-big-post-image" id="last-posts-big-post-image">
                                        <option selected="selected" value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-big-post-carousel"><?php _e( 'Show carousel', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="last-posts-big-post-carousel" id="last-posts-big-post-carousel">
                                        <option value="y"><?php _e('Yes', 'shootback') ?></option>
                                        <option selected="selected" value="n"><?php _e('No', 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-big-post-excerpt"><?php _e( 'Show excerpt', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="last-posts-big-post-excerpt" id="last-posts-big-post-excerpt">
                                        <option selected="selected" value="y"><?php _e('Yes', 'shootback') ?></option>
                                        <option value="n"><?php _e('No', 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-big-post-title"><?php _e( 'Title position:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#last-posts-big-post-title" id="last-posts-big-post-title-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="title-above-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_image.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="title-below-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_excerpt.png'; ?>"></li>
                                    </ul>
                                    <select name="last-posts-big-post-title" id="last-posts-big-post-title">
                                        <option value="title-above-image"><?php _e( 'Above image', 'shootback' ); ?></option>
                                        <option selected="selected" value="title-below-image"><?php _e( 'Above excerpt', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Select your title position for you grid posts. You can either have it above the image of above the excerpt. Note that sometimes title may change the position of the meta (date, categories, author) as well.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-big-post-image-position"><?php _e( 'Image position:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="last-posts-big-post-image-position" id="last-posts-big-post-image-position">
                                        <option value="left"><?php _e( 'Left', 'shootback' ); ?></option>
                                        <option value="right"><?php _e( 'Right', 'shootback' ); ?></option>
                                        <option value="mosaic"><?php _e( 'Mosaic', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('The way you want the big posts to be shown', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-big-post-show-meta"><?php _e( 'Show meta:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="last-posts-big-post-show-meta" id="last-posts-big-post-show-meta-y" value="y" checked="checked" /> 
                                    <label for="last-posts-big-post-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="last-posts-big-post-show-meta" id="last-posts-big-post-show-meta-n" value="n"/>
                                    <label for="last-posts-big-post-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="last-posts-big-post-nr-of-posts">
                                <td>
                                    <label for="last-posts-big-post-nr-of-posts"><?php _e( 'How many posts to extract:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="text" value="" name="last-posts-big-post-nr-of-posts" id="last-posts-big-post-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e( 'Content split', 'shootback' ); ?>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#last-posts-big-post-image-split" id="last-posts-big-post-image-split-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1-3" src="<?php echo get_template_directory_uri().'/images/options/big_posts_13.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="1-2" src="<?php echo get_template_directory_uri().'/images/options/big_posts_12.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3-4" src="<?php echo get_template_directory_uri().'/images/options/big_posts_34.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="last-posts-big-post-image-split" id="last-posts-big-post-image-split">
                                        <option value="1-3">1/3</option>
                                        <option value="1-2">1/2</option>
                                        <option value="3-4">3/4</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your image/content split proportions. You can have them either 1/3, 1/2, 3/4 for your title and 2/3,1/2, 1/4 accordingly. Depending on the text and titles you use, select your split type.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-big-post-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-big-post-order-by" id="last-posts-big-post-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-big-post-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-big-post-order-direction" id="last-posts-big-post-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="desc"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-big-post-related"><?php _e( 'Show related posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-big-post-related" id="last-posts-big-post-related">
                                        <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option selected="selected" value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can set each of your big posts to show related articles below. A list with other articles will appear below.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-big-post-special-effects"><?php _e( 'Special effects', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-big-post-special-effects" id="last-posts-big-post-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="last-posts-big-post-pagination">
                                <td>
                                    <label for="last-posts-big-post-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-big-post-pagination" id="last-posts-big-post-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="last-posts-super-post hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="last-posts-super-post-posts-per-row"><?php _e( 'Number of posts per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#last-posts-super-post-posts-per-row" id="last-posts-super-post-posts-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="last-posts-super-post-posts-per-row" id="last-posts-super-post-posts-per-row">
                                        <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="last-posts-big-post-nr-of-posts">
                                <td>
                                    <label for="last-posts-super-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="last-posts-super-post-limit"  id="last-posts-super-post-limit" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-super-post-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-super-post-order-by" id="last-posts-super-post-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                     <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     <label for="last-posts-super-post-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-super-post-order-direction" id="last-posts-super-post-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="desc"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-super-post-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="last-posts-super-post-special-effects" id="last-posts-super-post-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-super-post-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-super-post-pagination" id="last-posts-super-post-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Timeline options -->
                    <div class="last-posts-timeline hidden">

                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="last-posts-timeline-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="last-posts-timeline-show-meta" id="last-posts-timeline-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="last-posts-timeline-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="last-posts-timeline-show-meta" id="last-posts-timeline-show-meta-n" value="n" />
                                    <label for="last-posts-timeline-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-timeline-image"><?php _e( 'Show image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-timeline-image" id="last-posts-timeline-image">
                                        <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Display image', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="last-posts-timeline-nr-of-posts">
                                <td>
                                    <label for="last-posts-timeline-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="last-posts-timeline-post-limit" id="last-posts-timeline-post-limit" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-timeline-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-timeline-order-by" id="last-posts-timeline-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-timeline-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-timeline-order-direction" id="last-posts-timeline-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-timeline-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-timeline-pagination" id="last-posts-timeline-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- mosaic options -->
                    <div class="last-posts-mosaic hidden">

                        <table cellpadding="10">
                            <tr class="last-posts-mosaic-layout">
                                <td>
                                    <label for="last-posts-mosaic-layout"><?php _e( 'Choose how to show the posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-mosaic-layout" id="last-posts-mosaic-layout" class="ts-mosaic-layout">
                                        <option value="rectangles"><?php _e( 'Rectangles', 'shootback' ); ?></option>
                                        <option value="square"><?php _e( 'Squares', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose how to show the posts', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="last-posts-mosaic-rows">
                                <td>
                                    <label for="last-posts-mosaic-rows"><?php _e( 'Change number of rows', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-mosaic-rows" id="last-posts-mosaic-rows" class="ts-mosaic-rows">
                                        <option value="2"><?php _e( '2', 'shootback' ); ?></option>
                                        <option value="3"><?php _e( '3', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Change number of rows', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="last-posts-mosaic-nr-of-posts">
                                <td>
                                    <label for="last-posts-mosaic-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <div class="ts-mosaic-post-limit-rows-2">
                                        <input class="ts-input-slider" type="text" name="last-posts-mosaic-post-limit-rows-2" id="last-posts-mosaic-post-limit-rows-2" value="6" disabled />
                                        <div id="last-posts-mosaic-post-limit-rows-2-slider"></div>
                                    </div>
                                    <div class="ts-mosaic-post-limit-rows-3">
                                        <input type="text" name="last-posts-mosaic-post-limit-rows-3" id="last-posts-mosaic-post-limit-rows-3" value="" disabled />
                                        <div id="last-posts-mosaic-post-limit-rows-3-slider"></div>
                                    </div>
                                    <div class="ts-mosaic-post-limit-squares">
                                        <input type="text" name="last-posts-mosaic-post-limit-rows-squares" id="last-posts-mosaic-post-limit-rows-squares" value="" disabled />
                                        <div id="last-posts-mosaic-post-limit-rows-squares-slider"></div>
                                    </div>

                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-mosaic-scroll"><?php _e( 'Add/remove scroll', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-mosaic-scroll" id="last-posts-mosaic-scroll">
                                        <option selected="selected" value="y"><?php _e( 'With scroll', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'Without scroll', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Add/remove scroll', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-mosaic-effects"><?php _e( 'Add effects to scroll', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-mosaic-effects" id="last-posts-mosaic-effects">
                                        <option value="default"><?php _e( 'Default', 'shootback' ); ?></option>
                                        <option value="fade"><?php _e( 'Fade in effect', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Change number of rows', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-mosaic-gutter"><?php _e( 'Add or Remove gutter between posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-mosaic-gutter" id="last-posts-mosaic-gutter">
                                        <option value="y"><?php _e( 'With gutter between posts', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No gutter', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Add or Remove gutter between posts', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-mosaic-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-mosaic-order-by" id="last-posts-mosaic-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="last-posts-mosaic-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-mosaic-order-direction" id="last-posts-mosaic-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="class-last-posts-mosaic-pagination">
                                <td>
                                    <label for="last-posts-mosaic-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="last-posts-mosaic-pagination" id="last-posts-mosaic-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                
                </div>
            </div>
      
            <div class="callaction builder-element hidden">
                <h3 class="element-title"><?php _e('Call to action element','shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="callaction-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="callaction-admin-label" name="callaction-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <label for="callaction-text"><?php _e( 'Call to action Text', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <textarea name="callaction-text" id="callaction-text" style="width:400px; height: 100px" ></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="callaction-link"><?php _e( 'Button Link', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" name="callaction-link" id="callaction-link" style="width:400px" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="callaction-button-text"><?php _e( 'Button Text', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" name="callaction-button-text" id="callaction-button-text" style="width:400px" />
                        </td>
                    </tr>
                </table>
            </div>

            <div class="teams builder-element hidden">
                <h3 class="element-title"><?php _e('Team members element', 'shootback'); ?></h3>
                <table cellpadding="10">
                            <tr>
                        <td>
                            <label for="teams-admin-label"><?php _e('Admin label:','shootback'); ?></label>
                        </td>
                        <td>
                           <input type="text" id="teams-admin-label" name="teams-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="teams-category"><?php _e( 'Category', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <?php $categories = get_categories(array( 'hide_empty' => 1, 'taxonomy' => 'teams', 'pad_counts' => true ));
                            if( isset($categories) && is_array($categories) && !empty($categories) ) : ?>
                                <select class="ts-custom-select-input" data-placeholder="<?php _e('Select your category', 'shootback'); ?>" name="teams-category" id="teams-category" multiple>
                                    <option value="0"><?php _e('All', 'shootback'); ?></option>
                                    <?php foreach ($categories as $index => $category): ?>
                                        <option value="<?php echo $category->slug ?>"><?php echo $category->cat_name ?><span>  (<?php echo $category->count; ?>)</span></option>
                                    <?php endforeach ?>                                    
                                </select>
                            <?php else : ?>
                                <select class="ts-custom-select-input" data-placeholder="<?php _e('Select your category', 'shootback'); ?>" name="teams-category" id="teams-category" multiple>
                                </select>
                            <?php endif ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="teams-elements-per-row"><?php _e( 'Number of elements per row', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#teams-elements-per-row" id="teams-elements-per-row-selector">
                               <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                            </ul>
                            <select class="hidden" name="teams-elements-per-row" id="teams-elements-per-row">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                            </select>   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="teams-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="teams-post-limit"  id="teams-post-limit" size="4"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="teams-remove-gutter"><?php _e( 'Remove gutter (space between articles)', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="teams-remove-gutter" id="teams-remove-gutter">
                                <option value="no"><?php _e('No', 'shootback'); ?></option>
                                <option value="yes"><?php _e('Yes', 'shootback'); ?></option>
                            </select>   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="teams-enable-carousel"><?php _e( 'Enable carousel', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="teams-enable-carousel" id="teams-enable-carousel">
                                <option value="no"><?php _e('No', 'shootback'); ?></option>
                                <option value="yes"><?php _e('Yes', 'shootback'); ?></option>
                            </select>   
                        </td>
                    </tr>
                </table>
            </div>

            <div class="pricing-tables builder-element hidden">
                <h3 class="element-title"><?php _e('Pricing tables element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="pricing-tables-admin-label"><?php _e('Admin label:', 'shootback'); ?></label>
                        </td>
                        <td>
                           <input type="text" id="pricing-tables-admin-label" name="pricing-tables-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Category:', 'shootback' ); ?>
                        </td>
                        <td>
                            <?php $categories = get_categories(array( 'hide_empty' => 0, 'taxonomy' => 'ts_pricing_table_categories', 'pad_counts' => true ));
                            if( isset($categories) && !is_wp_error($categories) && !empty($categories) ) : ?>
                                <select class="ts-custom-select-input" data-placeholder="<?php _e('Select your category', 'shootback'); ?>" name="pricing-tables-category" id="pricing-tables-category" multiple>   
                                    <option value="0"><?php _e('All', 'shootback') ?></option>
                                    <?php foreach ($categories as $index => $category): ?>
                                        <option value="<?php echo $category->slug ?>"><?php echo $category->cat_name ?></option>
                                    <?php endforeach ?>                                    
                                </select>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="pricing-tables-elements-per-row"><?php _e( 'Number of elements per row', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#pricing-tables-elements-per-row" id="teams-elements-per-row-selector">
                               <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                            </ul>
                            <select class="hidden" name="pricing-tables-elements-per-row" id="pricing-tables-elements-per-row">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                            </select>   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="pricing-tables-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="pricing-tables-post-limit"  id="pricing-tables-post-limit" size="4"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="pricing-tables-remove-gutter"><?php _e( 'Remove gutter (space between articles)', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="pricing-tables-remove-gutter" id="pricing-tables-remove-gutter">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>   
                        </td>
                    </tr>
                </table>
            </div>

            <div class="advertising builder-element hidden">
                <h3 class="element-title">Advertising element</h3>
                <!-- Advertising -->
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="advertising-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="advertising-admin-label" name="advertising-admin-label" />
                        </td>
                    </tr>
                </table>
                <p><?php _e( 'Insert here your code', 'shootback' ); ?>:</p>
                <textarea name="advertising" id="advertising" cols="60" rows="10"></textarea>
            </div>

            <div class="none builder-element hidden empty">
                <h3 class="element-title">Empty element</h3>
                <!-- None -->
                <p><?php _e( 'This is an empty element.', 'shootback' ); ?></p>
            </div>

            <div class="delimiter builder-element hidden">
                <h3 class="element-title">Delimiter element</h3>
                <!-- Delimiter -->
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="delimiter-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="delimiter-admin-label" name="delimiter-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="delimiter-type"><?php _e( 'Delimiter type', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="delimiter-type" id="delimiter-type">
                                <option value="dotsslash"><?php _e( 'Dotted', 'shootback' ); ?></option>
                                <option value="doubleline"><?php _e( 'Double line', 'shootback' ); ?></option>
                                <option value="lines"><?php _e( 'Lines', 'shootback' ); ?></option>
                                <option value="squares"><?php _e( 'Squares', 'shootback' ); ?></option>
                                <option value="line"><?php _e( 'Line', 'shootback' ); ?></option>
                                <option value="gradient"><?php _e( 'Gradient', 'shootback' ); ?></option>
                                <option value="iconed icon-close"><?php _e( 'Line with cross', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Delimiter color', 'shootback') ?>:
                        </td>
                        <td>
                           <input type="text" id="delimiter-color" class="colors-section-picker" name="delimiter-color" value="#FFFFFF"/>
                           <div class="colors-section-picker-div" id="delimiter-color-picker"></div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Title element -->
            <div class="title builder-element hidden">
                <h3 class="element-title">Title element</h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="title-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="title-admin-label" name="title-admin-label" />
                        </td>
                    </tr>
                </table>
                <p><?php _e('Add icon for title from the library below:', 'shootback'); ?></p>
                <div class="builder-element-icon-toggle">
                    <a href="#" class="red-ui-button builder-element-icon-trigger-btn" data-toggle="#builder-element-title-icon-selector"><?php _e('Show icons','shootback') ?></a>
                </div> 
                <ul id="builder-element-title-icon-selector" data-selector="#builder-element-title-icon" class="builder-icon-list ts-custom-selector">
                    <?php echo $icons_li; ?>
                </ul>
                <select name="builder-element-title-icon" id="builder-element-title-icon" class="hidden">
                    <?php echo $icons_options; ?>
                </select>
                <table cellpadding="10">
                    <tr>
                        <td><label for="title-title"><?php _e( 'Title', 'shootback' ); ?>:</label></td>
                        <td><input type="text" value="" name="title-title"  id="title-title" style="width:400px" /></td>
                    </tr>
                    <tr>
                        <td><label for="title-color"><?php _e( 'Title color', 'shootback' ); ?>:</label></td>
                        <td>
                            <input type="text" id="builder-element-title-color" class="colors-section-picker" value="<?php echo ts_get_color('general_text_color'); ?>" name="builder-element-title-color" />
                            <div class="colors-section-picker-div" id="builder-element-title-color"></div>
                        </td>
                    </tr> 
                    <tr>
                        <td><label for="title-subtitle"><?php _e( 'Subtitle', 'shootback' ); ?>:</label></td>
                        <td><input type="text" value="" name="title-subtitle"  id="title-subtitle" style="width:400px" /></td>
                    </tr>
                    <tr>
                        <td><label for="title-subtitle-color"><?php _e( 'Subtitle color', 'shootback' ); ?>:</label></td>
                        <td>
                            <input type="text" id="builder-element-title-subtitle-color" class="colors-section-picker" value="<?php echo ts_get_color('general_text_color'); ?>" name="builder-element-title-subtitle-color" />
                            <div class="colors-section-picker-div" id="builder-element-title-subtitle-color"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="title-size"><?php _e( 'Size', 'shootback' ); ?>:</label></td>
                        <td>
                            <select name="title-size" id="title-size">
                                <option value="h1"><?php _e( 'H1', 'shootback' ); ?></option>
                                <option value="h2"><?php _e( 'H2', 'shootback' ); ?></option>
                                <option value="h3"><?php _e( 'H3', 'shootback' ); ?></option>
                                <option value="h4"><?php _e( 'H4', 'shootback' ); ?></option>
                                <option value="h5"><?php _e( 'H5', 'shootback' ); ?></option>
                                <option value="h6"><?php _e( 'H6', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="title-style"><?php _e( 'Style', 'shootback' ); ?>:</label></td>
                        <td>
                            <select name="title-style" id="title-style">
                                <option value="simpleleft"><?php _e( 'Title aligned left', 'shootback' ); ?></option>
                                <option value="lineafter"><?php _e( 'Title aligned left with circle and line after', 'shootback' ); ?></option>
                                <option value="leftrect"><?php _e( 'Title aligned left with rectangular left', 'shootback' ); ?></option>
                                <option value="simplecenter"><?php _e( 'Title aligned center', 'shootback' ); ?></option>
                                <option value="linerect"><?php _e( 'Title aligned center with line and rectangular below', 'shootback' ); ?></option>
                                <option value="2lines"><?php _e( 'Title aligned center with 2 lines before and after', 'shootback' ); ?></option>
                                <option value="lineariconcenter"><?php _e( 'Title aligned center with linear icon after', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Video element -->
            <div class="video builder-element hidden">
                <h3 class="element-title"><?php _e('Video element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="video-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="video-admin-label" name="video-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="video-lightbox"><?php _e('Show as lightbox', 'shootback'); ?>:</label>
                        </td>
                        <td>
                           <select name="video-lightbox" id="video-lightbox">
                               <option value="y"><?php _e('Yes', 'shootback'); ?></option>
                               <option selected="selected" value="n"><?php _e('No', 'shootback'); ?></option>
                           </select>
                        </td>
                    </tr>
                    <tr class="ts-video-title">
                        <td>
                            <label for="video-title"><?php _e('Title', 'shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="video-title" name="video-title" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <textarea name="embed" id="video-embed" style="width:400px" rows="10"></textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Image element -->
            <div class="image builder-element hidden">
                <h3 class="element-title"><?php _e('Image element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="image-admin-label"><?php _e('Admin label:', 'shootback'); ?></label>
                        </td>
                        <td>
                           <input type="text" id="image-admin-label" name="image-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="image_url"><?php _e('Image URL:', 'shootback'); ?></label></td>
                        <td>
                            <input type="text" value="" name="image_url"  id="image_url" class="image_url" style="width:300px" />
                            <input type="button" class="button-primary" id="select_image" value="Upload" />
                            <input type="hidden" value="" id="image_media_id" />
                            <div id="image_preview"></div>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <?php _e('Image align:', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="image-align" id="image-align">
                               <option value="left">Left</option>
                               <option value="center">Center</option>
                               <option value="right">Right</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Forward image to url:', 'shootback'); ?>
                        </td>
                        <td>
                            <input type="text" name="forward-image-url" id="forward-image-url" style="width:250px" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Target:', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="image-target" id="image-target">
                                <option value="_blank"><?php _e('_blank', 'shootback'); ?></option>
                                <option value="_self"><?php _e('_self', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Enable lightbox:', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="image-lightbox" id="image-lightbox">
                                <option value="y"><?php _e('Yes', 'shootback'); ?></option>
                                <option value="n"><?php _e('No', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>                    
                    <tr>
                        <td>
                            <?php _e('Use retina image:', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="image-retina" id="image-retina">
                                <option value="y"><?php _e('Yes', 'shootback'); ?></option>
                                <option value="_self"><?php _e('No', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- List products element --> 

             <div class="list-products builder-element hidden">
                <h3 class="element-title">List products element</h3>
                <!-- Select category -->
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="list-products-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="list-products-admin-label" name="list-products-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <label for="list-products-category"><?php _e( 'Category', 'shootback' ); ?>:</label>
                        </td>
                        <td>                            
                            <select data-placeholder="<?php _e('Select your category', 'shootback'); ?>" class="ts-custom-select-input"  name="list-products-category" id="list-products-category" multiple>
                                <?php $categories = get_categories(array( 'hide_empty' => 0, 'show_option_all' => '','taxonomy'=>'product_cat' )); ?>
                                <?php if ($categories): ?>
                                    <option value="0">All</option>
                                    <?php foreach ($categories as $index => $category): ?>
                                        <option value="<?php echo $category->term_id ?>"><?php echo $category->cat_name ?></option>
                                    <?php endforeach ?>                                    
                                <?php endif ?>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose the categories that you want to showcase products from.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                </table>

                <div id="list-products-options">
                    <div class="list-products">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label><?php _e( 'Behavior', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-products-behavior" id="list-products-behavior-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="none" src="<?php echo get_template_directory_uri().'/images/options/behavior_none.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="carousel" src="<?php echo get_template_directory_uri().'/images/options/behavior_carousel.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="masonry" src="<?php echo get_template_directory_uri().'/images/options/behavior_masonry.png'; ?>"></li>
                                    </ul>
                                    <select name="list-products-behavior" id="list-products-behavior">
                                        <option value="none"><?php _e( 'Normal', 'shootback' ); ?></option>
                                        <option value="carousel"><?php _e( 'Carousel', 'shootback' ); ?></option>
                                        <option value="masonry"><?php _e( 'Masonry', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your product articles behavior - you can have them just shown, or you can activate the carousel. If carousel is selected your articles will show up in a line with arrows for navigation. If masonry bahevior is selected - your articles will be arranged in to fit it. Be aware that activating the masonry option the crop settings for image sizes tab will be overwritten.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-products-el-per-row"><?php _e( 'Elements per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-products-el-per-row" id="list-products-el-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-products-el-per-row" id="list-products-el-per-row">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your products will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-products-nr-of-posts"><?php _e( 'How many products to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-products-nr-of-posts" id="list-products-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-products-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-products-order-by" id="list-products-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments_count"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-products-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-products-order-direction" id="list-products-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-products-special-effects"><?php _e( 'Special effects', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-products-special-effects" id="list-products-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>        

            <!-- Filters element -->
            <div class="filters builder-element hidden">
                <h3 class="element-title"><?php _e('Filters element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="filters-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="filters-admin-label" name="filters-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="filters-post-type"><?php _e( 'Content type', 'shootback' ); ?>:</label></td>
                        <td valign="top">
                            <select name="filters-post-type" id="filters-post-type">
                                <option value="post"><?php _e( 'Posts', 'shootback' ); ?></option>
                                <option value="portfolio"><?php _e( 'Portfolio', 'shootback' ); ?></option>
                                <option value="video"><?php _e( 'Video', 'shootback' ); ?></option>
                                <option value="ts-gallery"><?php _e( 'Gallery', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="filters-posts-category"><?php _e( 'Categories', 'shootback' ); ?>:</label></td>
                        <td valign="top" class="filters-categories">
                            <div id="post-categories">
                               <select data-placeholder="<?php _e('Select your category', 'shootback'); ?>" class="ts-custom-select-input" name="filters-posts-category" id="filters-post-category" multiple>
                                    <?php $categories = get_categories(array( 'hide_empty' => 1, 'show_option_all' => '' )); ?>
                                    <?php if ( isset($categories) && is_array($categories) && !empty($categories) ) : ?>
                                        <?php $s = 1; foreach ($categories as $index => $category): ?>
                                            <?php if( is_object($category) ) : ?>
                                                <?php if( $s === 1 ) echo '<option value="0">' . __('All', 'shootback') . '</option>'; ?>
                                                <option value="<?php echo $category->slug ?>"><?php echo $category->cat_name ?></option>
                                            <?php endif; $s++; ?>
                                        <?php endforeach ?>                                 
                                    <?php endif ?>
                                </select>
                            </div>
                            <div id="portfolio-categories">
                                <select class="ts-custom-select-input" data-placeholder="<?php _e('Select your category', 'shootback'); ?>" name="filters-portfolio-category" id="filters-portfolio-category" multiple>
                                    <?php $categories = get_categories(array( 'hide_empty' => 1, 'taxonomy' => 'portfolio_register_post_type' )); ?>
                                    <?php if ( isset($categories) && is_array($categories) && !empty($categories) ): ?>
                                        <?php $j = 1; foreach ($categories as $index => $category): ?>
                                            <?php if( is_object($category) ) : ?>
                                                <?php if( $j === 1 ) echo '<option value="0">All</option>'; ?>
                                                <option value="<?php echo $category->slug ?>"><?php echo $category->cat_name ?></option>
                                            <?php endif; $j++; ?>
                                        <?php endforeach ?>                                    
                                    <?php endif ?>
                                </select>
                            </div>
                            <div id="ts-gallery-categories">
                                <select class="ts-custom-select-input" data-placeholder="<?php _e('Select your category', 'shootback'); ?>" name="filters-portfolios-category" id="filters-ts-gallery-category" multiple>
                                    <?php $categories = get_categories(array( 'hide_empty' => 1, 'taxonomy' => 'gallery_categories' )); ?>
                                    <?php if ( isset($categories) && is_array($categories) && !empty($categories) ): ?>
                                        <?php $j = 1; foreach ($categories as $index => $category): ?>
                                            <?php if( is_object($category) ) : ?>
                                                <?php if( $j === 1 ) echo '<option value="0">All</option>'; ?>
                                                <option value="<?php echo $category->slug ?>"><?php echo $category->cat_name ?></option>
                                            <?php endif; $j++; ?>
                                        <?php endforeach ?>                                    
                                    <?php endif ?>
                                </select>
                            </div>
                            <div id="video-categories">
                                <select class="ts-custom-select-input" data-placeholder="<?php _e('Select your category', 'shootback'); ?>" name="filters-video-category" id="filters-video-category" multiple>
                                    <?php $categories = get_categories(array( 'hide_empty' => 1, 'taxonomy' => 'videos_categories' )); ?>
                                    <?php if ( isset($categories) && is_array($categories) && !empty($categories) ): ?>
                                        <?php $j = 1; foreach ($categories as $index => $category): ?>
                                            <?php if( is_object($category) ) : ?>
                                                <?php if( $j === 1 ) echo '<option value="0">All</option>'; ?>
                                                <option value="<?php echo $category->slug ?>"><?php echo $category->cat_name ?></option>
                                            <?php endif; $j++; ?>
                                        <?php endforeach ?>                                    
                                    <?php endif ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filters-posts-limit"><?php _e( 'Nr. of posts from each category', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="filters-posts-limit"  id="filters-posts-limit" size="4"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filters-elements-per-row"><?php _e( 'Elements per row', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#filters-elements-per-row" id="filters-elements-per-row-selector">
                               <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                            </ul>
                            <select class="hidden" name="filters-elements-per-row" id="filters-elements-per-row">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3" selected="selected">3</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="filters-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="filters-order-by" id="filters-order-by">
                                <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <label for="filters-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="filters-order-direction" id="filters-order-direction">
                                <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                <option selected="selected" value="desc"><?php _e( 'DESC', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <label for="filters-special-effects"><?php _e( 'Special effect', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="filters-special-effects" id="filters-special-effects">
                                <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <label for="filters-gutter"><?php _e( 'Remove gutter(space) between articles:', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="filters-gutter" id="filters-gutter">
                                <option value="n"><?php _e('No', 'shootback') ?></option>
                                <option value="y"><?php _e('Yes', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="feature-blocks builder-element hidden">
                <h3 class="element-title"><?php _e('Feature blocks element', 'shootback'); ?></h3>
                <!-- Feature blocks -->
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="feature-blocks-per-row"><?php _e( 'Number of elements per row', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#feature-blocks-per-row" id="feature-blocks-per-row-selector">
                               <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                            </ul>
                            <select class="hidden" name="feature-blocks-per-row" id="feature-blocks-per-row">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                            </select>   
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="feature-blocks-style"><?php _e( 'Style', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="feature-blocks-style" id="feature-blocks-style">
                                <option value="style1"><?php _e('Feature blocks with background', 'shootback') ?></option>
                                <option value="style2"><?php _e('Feature blocks with border', 'shootback') ?></option>
                            </select>   
                        </td>
                    </tr>
                </table>
            </div>
                
            <div class="spacer builder-element hidden">
                <h3 class="element-title"><?php _e('Spacer element', 'shootback'); ?></h3>
                <table cellpadding="10">           
                    <tr>
                        <td>
                            <label for="spacer-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="spacer-admin-label" name="spacer-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Height', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" name="spacer-height" id="spacer-height" style="width:250px" value="20"/> px
                        </td>
                    </tr>
                </table>
            </div>

            <div class="facebook-block builder-element hidden">
                <h3 class="element-title">Facebook element</h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <?php _e( 'Link of your Facebook page (used in the URL).', 'shootback' ); ?>
                        </td>
                        <td>
                            <input type="text" name="facebook-url" id="facebook-url" style="width:250px" value=''/>
                            <div class="ts-option-description">
                                <?php _e('ex: ( http://facebook.com/touchsize )', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Color scheme', 'shootback' ); ?>:
                        </td>
                        <td>
                            <select name="facebook-background" id="facebook-background">
                                <option value="dark"><?php _e( 'Dark', 'shootback' ); ?></option>
                                <option value="light"><?php _e( 'Light', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="counters builder-element hidden">
                <h3 class="element-title"><?php _e('Counters element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="counters-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="counters-admin-label" name="counters-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Text', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" name="counters-text" id="counters-text" style="width:250px" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Count percent', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" name="counters-precents" id="counters-precents" style="width:250px" value="100"/> %
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Text color', 'shootback') ?>:
                        </td>
                        <td>
                            <input type="text" id="counters-text-color" class="colors-section-picker" value="#000" name="counters-text-color" />
                            <div class="colors-section-picker-div"></div>
                        </td>
                    </tr>   
                    <tr>
                        <td>
                            <?php _e('Display track bar', 'shootback') ?>:
                        </td>
                        <td>
                            <select name="counters-track-bar" id="counters-track-bar">
                                <option selected="selected" value="with-track-bar"><?php _e( 'With track bar', 'shootback' ); ?></option>
                                <option value="without-track-bar"><?php _e( 'Without track bar', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>     
                    <tr class="ts-counters-track-bar-color">
                        <td>
                            <?php _e('Track bar color', 'shootback') ?>:
                        </td>
                        <td>
                            <input type="text" id="counters-track-bar-color" class="colors-section-picker" value="#000" name="counters-track-bar-color" />
                            <div class="colors-section-picker-div"></div>
                        </td>
                    </tr>                   
                </table>
                <div class="ts-counters-icons">
                    <p><?php _e('Choose your icon from the library below:', 'shootback'); ?></p>
                    <div class="builder-element-icon-toggle">
                        <a href="#" class="red-ui-button builder-element-icon-trigger-btn" data-toggle="#counters-icon-selector"><?php _e('Show icons','shootback') ?></a>
                    </div>    
                    <ul id="counters-icon-selector" data-selector="#counters-icon" class="builder-icon-list ts-custom-selector">
                        <?php  echo $icons_li; ?>
                    </ul>
                    <select name="counters-icon" id="counters-icon" class="hidden">
                        <?php echo $icons_options; ?> 
                    </select>
                </div>
            </div>

            <div class="page builder-element hidden">
                <h3 class="element-title"><?php _e( 'Page element', 'shootback' ); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <?php _e( 'Search page', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" name="search-page" id="search-page" style="width:250px"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Criteria', 'shootback' ); ?>:
                        </td>
                        <td>
                            <select name="search-page-criteria" id="search-page-criteria">
                                <option value="title"><?php _e( 'Title', 'shootback' ); ?></option>
                                <option value="title-content"><?php _e( 'Title & Content', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Order by', 'shootback') ?>:
                        </td>
                        <td>
                            <select name="search-page-order-by" id="search-page-order-by">
                                <option value="id"><?php _e( 'ID', 'shootback' ); ?></option>
                                <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Direction', 'shootback') ?>:
                        </td>
                        <td>
                           <select name="search-page-direction" id="search-page-direction">
                                <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                <option value="desc"><?php _e( 'DESC', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="button" name="search-page-button" id="search-type-page" class="search-posts-buttons button-primary save-element" value="<?php _e( 'Search', 'shootback' ); ?>"/>
                        </td>
                    </tr>
                </table>

                <p><?php _e( 'Results', 'shootback' ); ?>Results</p>
                <table cellpadding="10" id="search-pages-results">
                </table>
            </div>

            <div class="post builder-element hidden">
                <h3 class="element-title"><?php _e( 'Post element', 'shootback' ); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <?php _e( 'Search post', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" name="search-post" id="search-post" style="width:250px"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Criteria', 'shootback' ); ?>:
                        </td>
                        <td>
                            <select name="search-post-criteria" id="search-post-criteria">
                                <option value="title"><?php _e( 'Title', 'shootback' ); ?></option>
                                <option value="title-content"><?php _e( 'Title & Content', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Order by', 'shootback' ); ?>:
                        </td>
                        <td>
                            <select name="search-post-order-by" id="search-post-order-by">
                                <option value="id"><?php _e( 'ID', 'shootback' ); ?></option>
                                <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Direction', 'shootback' ); ?>:
                        </td>
                        <td>
                            <select name="search-post-direction" id="search-post-direction">
                                <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                <option value="desc"><?php _e( 'DESC', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="button" name="search-post-button" id="search-type-post" class="search-posts-buttons button-primary save-element"value="<?php _e( 'Search', 'shootback' ); ?>"/>
                        </td>
                    </tr>
                </table>

                <p><?php _e( 'Results', 'shootback' ); ?></p>
                <table cellpadding="10" id="search-posts-results">
                </table>
            </div>

            <div class="buttons builder-element hidden">
                <h3 class="element-title"><?php _e('Button element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="buttons-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="buttons-admin-label" name="buttons-admin-label" />
                        </td>
                    </tr>
                </table>
                <p><?php _e('Choose your icon button from the library below:', 'shootback'); ?></p>
                <div class="builder-element-icon-toggle">
                    <a href="#" class="red-ui-button builder-element-icon-trigger-btn" data-toggle="#builder-element-button-icon-selector"><?php _e('Show icons','shootback') ?></a>
                </div>
                <ul id="builder-element-button-icon-selector" data-selector="#builder-element-button-icon" class="builder-icon-list ts-custom-selector">
                    <?php echo $icons_li; ?>
                </ul>
                <select name="builder-element-button-icon" id="builder-element-button-icon" class="hidden">
                    <?php echo $icons_options; ?>
                </select>
                <table cellpadding="10">
                    <tr>
                        <td width="70px">
                            <?php _e('Icon align', 'touchsize'); ?>
                        </td>
                        <td>
                            <select name="button-icon-align" id="button-icon-align">
                                <option selected="selected" value="left-of-text"><?php _e('Left of text', 'touchsize'); ?></option>
                                <option value="above-text"><?php _e('Above Text', 'touchsize'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td width="70px">
                            <?php _e('Button align', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="button[align]" id="button-align">
                                <option value="text-left"><?php _e('Left', 'shootback'); ?></option>
                                <option value="text-right"><?php _e('Right', 'shootback'); ?></option>
                                <option value="text-center"><?php _e('Center', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Text', 'shootback') ?>
                        </td>
                        <td>
                           <input type="text" id="button-text" name="button-text" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('URL', 'shootback') ?>:
                        </td>
                        <td>
                           <input type="text" id="button-url" name="button-url" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Target', 'shootback') ?>:
                        </td>
                        <td>
                            <select name="button-target" id="button-target">
                                <option value="_blank">_blank</option>
                                <option value="_self">_self</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Size', 'shootback') ?>:
                        </td>
                        <td>
                           <select name="button-size" id="button-size">
                               <option value="big"><?php _e('Big', 'shootback') ?></option>
                               <option value="medium" selected="selected"><?php _e('Medium', 'shootback') ?></option>
                               <option value="small"><?php _e('Small', 'shootback') ?></option>
                               <option value="xsmall"><?php _e('xSmall', 'shootback') ?></option>
                           </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Text color', 'shootback') ?>:
                        </td>
                        <td>
                           <input class="colors-section-picker" type="text" id="button-text-color" name="button-text-color" value="#FFFFFF"/>
                           <div class="colors-section-picker" id="ts-button-text-color-picker"></div>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <?php _e('Choose your mode to display:', 'shootback') ?>
                        </td>
                        <td>
                           <select name="button-mode-dispaly" id="button-mode-display">
                               <option value="border-button"><?php _e('Border button', 'shootback') ?></option>
                               <option value="background-button"><?php _e('Background button', 'shootback') ?></option>
                           </select>
                        </td>
                    </tr>
                    <tr class="button-background-color">
                        <td>
                            <?php _e('Background color', 'shootback') ?>:
                        </td>
                        <td>
                           <input class="colors-section-picker" type="text" id="button-background-color" name="button-background-color" value="#FFFFFF"/>
                           <div class="colors-section-picker-div" id="ts-button-background-color-picker"></div>
                        </td>
                    </tr>
                    <tr class="button-border-color">
                        <td>
                            <?php _e('Border color', 'shootback') ?>:
                        </td>
                        <td>
                           <input class="colors-section-picker" type="text" id="button-border-color" name="button-border-color" value="#FFFFFF"/>
                           <div class="colors-section-picker-div" id="ts-button-border-color-picker"></div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="contact-form builder-element hidden">
                <h3 class="element-title"><?php _e('Contact form element', 'shootback'); ?></h3>
                <em><?php _e('Enter yout email in Options -- Social', 'shootback') ?></em>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="contact-form-admin-label"><?php _e('Admin label:','shootback'); ?></label>
                        </td>
                        <td>
                           <input type="text" id="contact-form-admin-label" name="contact-form-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="contact-form-hide-icon" id="contact-form-hide-icon" /><label for="contact-form-hide-icon"> <?php _e('Hide email icon', 'shootback') ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" name="contact-form-hide-subject" id="contact-form-hide-subject" />
                            <label for="contact-form-hide-subject"> <?php _e('Hide Subject field', 'shootback') ?></label>
                        </td>
                    </tr>
                </table>
                <table cellpadding="10">
                     <ul id="contact-form_items">
                    
                     </ul>
                    
                 <input type="hidden" id="contact-form_content" value="" />
                 <input type="button" class="button ts-multiple-add-button" data-element-name="contact-form" id="contact-form_add_item" value=" <?php _e('Add New Field', 'shootback'); ?>" />
                <?php
                     echo '<script id="contact-form_items_template" type="text/template">';
                     echo '<li id="list-item-id-{{item-id}}" class="contact-form-item ts-multiple-add-list-element">
                            <div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="tab-item-contact-form ts-multiple-item-tab">Item: {{slide-number}}</span></div>
                            <div class="hidden">
                                <table>
                                    <tr>
                                        <td>
                                            <label for="contact-form-{{item-id}}-type">'.__('Choose your type field:', 'shootback').'</label>
                                        </td>
                                        <td>
                                            <select class="contact-form-type" data-builder-name="type" name="contact-form[{{item-id}}][type]" id="contact-form-{{item-id}}-type">
                                                <option value="select">'. __('Select', 'shootback').'</option>
                                                <option value="input">'. __('Input', 'shootback').'</option>
                                                <option value="textarea">'. __('Textarea', 'shootback').'</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="contact-form-{{item-id}}-require">'.__('Require field:', 'shootback').'</label>
                                        </td>
                                        <td>
                                            <select data-builder-name="require" name="contact-form[{{item-id}}][require]" id="contact-form-{{item-id}}-require">
                                                <option value="y">'. __('Yes', 'shootback').'</option>
                                                <option value="n">'. __('No', 'shootback').'</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                             <label for="contact-form-{{item-id}}-title">'.__('Title:', 'shootback').'</label>
                                        </td>
                                        <td>
                                             <input data-builder-name="title" type="text" id="contact-form-{{item-id}}-title" name="contact-form[{{item-id}}][title]" />
                                        </td>
                                    </tr>
                                    <tr class="contact-form-options">
                                        <td>
                                            <label for="contact-form-{{item-id}}-options">'. __('Write your options here in the following field(ex: option1/option2/options3/...):','shootback').'</label>
                                        </td>
                                        <td>
                                            <input data-builder-name="options" type="text" id="contact-form-{{item-id}}-options" name="contact-form[{{item-id}}][options]" />
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" data-builder-name="item_id" value="{{item-id}}" name="contact-form[{{item-id}}][id]" />
                                <input type="button" class="button button-primary remove-item" value="' . __('Remove', 'shootback') . '" />
                                <a href="#" data-item="contact-form-item" data-increment="contact-form-items" class="button button-primary ts-multiple-item-duplicate">'.__('Duplicate Item', 'shootback').'</a>
                            </div>
                         </li>';
                     echo '</script>';
                ?>
                </table>
            </div>

            <!-- featured area element -->
            <div class="featured-area builder-element hidden">
                <h3 class="element-title"><?php _e('Featured area element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="featured-area-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="featured-area-admin-label" name="featured-area-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><?php _e('Choose custum post type', 'shootback') ?></p>
                        </td>
                        <td>
                            <select name="featured-area-custom-post" id="featured-area-custom-post">
                                <option value="post"><?php _e('Post', 'shootback') ?></option>
                                <option value="video"><?php _e('Video', 'shootback') ?></option>
                                <option value="gallery"><?php _e('Gallery', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr class="featured-area-video" style="display:none">
                        <td>
                            <p><?php _e('Categories video', 'shootback') ?></p>
                        </td>
                        <td>
                            <select data-placeholder="<?php _e('Select your category', 'shootback'); ?>" class="ts-custom-select-input"  name="featured-area-categories-video" id="featured-area-categories-video" multiple>
                                <?php $categories = get_categories(array( 'hide_empty' => 0, 'taxonomy' => 'videos_categories' )); ?>
                                <?php if ( isset($categories) && is_array($categories) && $categories !== '' && !empty($categories) ): ?>
                                    <?php $i = 0; foreach ($categories as $index => $category): ?>
                                        <?php if( is_object($category) ) : ?>
                                            <?php if( $i == 0 ) echo '<option value="0">All</option>'; ?>
                                            <option value="<?php if( is_object($category) ) echo $category->term_id; ?>"><?php if( is_object($category) ) echo $category->cat_name; ?></option>
                                        <?php $i++; endif; ?>
                                    <?php endforeach ?>                                    
                                <?php endif ?>
                            </select>
                        </td>
                    </tr>
                    <tr class="featured-area-posts" style="display:none">
                        <td>
                            <p><?php _e('Categories posts', 'shootback') ?></p>
                        </td>
                        <td>
                            <select data-placeholder="<?php _e('Select your category', 'shootback'); ?>" class="ts-custom-select-input"  name="featured-area-categories-video" id="featured-area-categories-posts" multiple>
                                <?php 
                                $categories = get_categories(array( 'hide_empty' => 0 )); ?>
                                <?php if ( isset($categories) && is_array($categories) && $categories !== '' ): ?>
                                    <?php $i = 0; foreach ($categories as $index => $category): ?>
                                        <?php if( is_object($category) ) : ?>
                                            <?php if( $i == 0 ) echo '<option value="0">All</option>'; ?>
                                            <option value="<?php echo $category->term_id; ?>"><?php echo $category->cat_name; ?></option>
                                        <?php $i++; endif; ?>
                                    <?php endforeach ?>                                    
                                <?php endif ?>
                            </select>
                        </td>
                    </tr>
                    <tr class="featured-area-gallery" style="display:none">
                        <td>
                            <p><?php _e('Categories gallery', 'shootback') ?></p>
                        </td>
                        <td>
                            <select data-placeholder="<?php _e('Select your category', 'shootback'); ?>" class="ts-custom-select-input"  name="featured-area-categories-gallery" id="featured-area-categories-gallery" multiple>
                                <?php $categories = get_categories(array( 'hide_empty' => 0, 'taxonomy' => 'gallery_categories' )); ?>
                                <?php if ( isset($categories) && is_array($categories) && $categories !== '' && !empty($categories) ): ?>
                                    <?php $i = 0; foreach ($categories as $index => $category): ?>
                                        <?php if( is_object($category) ) : ?>
                                            <?php if( $i == 0 ) echo '<option value="0">All</option>'; ?>
                                            <option value="<?php if( is_object($category) ) echo $category->term_id; ?>"><?php if( is_object($category) ) echo $category->cat_name; ?></option>
                                        <?php $i++; endif; ?>
                                    <?php endforeach ?>                                    
                                <?php endif ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="featured-area-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="featured-area-order-by" id="featured-area-order-by">
                                <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option> 
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="featured-area-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="featured-area-order-direction" id="featured-area-order-direction">
                                <option value="ASC"><?php _e( 'ASC', 'shootback' ); ?></option>
                                <option value="DESC" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr class="featured-area-exclude">
                        <td>
                            <label for="featured-area-exclude-first"><?php _e( 'Exclude number of first posts', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="featured-area-exclude-first" id="featured-area-exclude-first" size="4"/>
                            <div class="ts-option-description">
                                <?php _e('Insert the number of the posts you want to exclude from showing.', 'shootback'); ?> 
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="shortcodes builder-element hidden">
                <h3 class="element-title"><?php _e('Shortcode element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="shortcodes-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="shortcodes-admin-label" name="shortcodes-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Remove paddings','shootback'); ?>
                        </td>
                        <td>
                            <select name="shortcodes-paddings" id="shortcodes-paddings">
                                <option value="y"><?php _e('Yes', 'shootback'); ?></option>
                                <option selected="selected" value="n"><?php _e('No', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="shortcodes" id="ts-shortcodes" cols="70" rows="10"></textarea>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="text builder-element hidden">
                <h3 class="element-title">Text element</h3>
            </div>

            <!-- Image carousel element -->
            <div class="image-carousel builder-element hidden">
                <h3 class="element-title"><?php _e('Image carousel element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="image-carousel-admin-label"><?php _e('Admin label','shootback'); ?>:</label>
                        </td>
                        <td>
                           <input type="text" id="image-carousel-admin-label" name="image-carousel-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="carousel-height"><?php _e( 'Maximum carousel height', 'shootback' ); ?>:</label>
                        </td>
                        <td><input type="text" id="carousel_height" name="carousel_height" value="400" />px</td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="image_url"><?php _e( 'Add your images', 'shootback' ); ?>:</label></td>
                        <td>

                            <div id="image-carousel">
                                <ul class="carousel_images">
                                    
                                </ul>
                                <script>
                                    jQuery(document).ready(function($){
                                        setTimeout(function(){
                                            //Show the added images
                                            var image_gallery_ids = jQuery('#carousel_image_gallery').val();
                                            var carousel_images = jQuery('#image-carousel ul.carousel_images');

                                            // Split each image
                                            image_gallery_ids = image_gallery_ids.split(',');

                                            jQuery(image_gallery_ids).each(function(index, value){
                                                image_url = value.split(/:(.*)/);
                                                var attachmentId = image_url[0];
                                                if( image_url != '' ){
                                                    image_url_path = image_url[1].split('.');
                                                    var imageFormat = image_url_path[image_url_path.length - 1];
                                                    var imageUrl = image_url_path.splice(0, image_url_path.length - 1).join('.');
                                                        carousel_images.append('\
                                                            <li class="image" data-attachment_id="' + attachmentId + '" data-attachment_url="' + imageUrl + '.' + imageFormat + '">\
                                                                <img src="' + imageUrl + '-<?php echo get_option( "thumbnail_size_w" ); ?>x<?php echo get_option( "thumbnail_size_h" ); ?>.' + imageFormat + '" />\
                                                                <ul class="actions">\
                                                                    <li><a href="#" class=" icon-close" title="<?php _e( 'Delete image', 'shootback' ); ?>"><?php //_e( 'Delete', 'shootback' ); ?></a></li>\
                                                                </ul>\
                                                            </li>');
                                                }
                                            });

                                        },200);
                                    });
                                </script>
                                <input type="hidden" id="carousel_image_gallery" name="carousel_image_gallery" value="" />
                            </div>
                            <p class="add_carousel_images hide-if-no-js">
                                <a href="#"><?php _e( 'Add gallery images', 'shootback' ); ?></a>
                            </p>
                            <script type="text/javascript">
                                jQuery(document).ready(function($){

                                    // Uploading files
                                    var image_frame;
                                    var $image_gallery_ids = $('#carousel_image_gallery');
                                    var $carousel_images = $('#image-carousel ul.carousel_images');

                                    jQuery('.add_carousel_images').on( 'click', 'a', function( event ) {

                                        var $el = $(this);
                                        var attachment_ids = $image_gallery_ids.val();

                                        event.preventDefault();

                                        // If the media frame already exists, reopen it.
                                        if ( image_frame ) {
                                            image_frame.open();
                                            return;
                                        }

                                        // Create the media frame.
                                        image_frame = wp.media.frames.downloadable_file = wp.media({
                                            // Set the title of the modal.
                                            title: '<?php _e( 'Add Images to Gallery', 'shootback' ); ?>',
                                            button: {
                                                text: '<?php _e( 'Add to gallery', 'shootback' ); ?>',
                                            },
                                            multiple: true
                                        });

                                        // When an image is selected, run a callback.
                                        image_frame.on( 'select', function() {
                                            
                                            var selection = image_frame.state().get('selection');

                                            selection.map( function( attachment ) {

                                                attachment = attachment.toJSON();
                                                if ( attachment.id ) {
                                                    attachment_ids = attachment_ids + attachment.id + ':' + attachment.url + ',';

                                                    $carousel_images.append('\
                                                        <li class="image" data-attachment_id="' + attachment.id + '" data-attachment_url="' + attachment.url + '">\
                                                            <img src="' + attachment.url + '" />\
                                                            <ul class="actions">\
                                                                <li><a href="#" class=" icon-close" title="<?php _e( 'Delete image', 'shootback' ); ?>"><?php //_e( 'Delete', 'shootback' ); ?></a></li>\
                                                            </ul>\
                                                        </li>');
                                                }

                                            } );

                                            $image_gallery_ids.val( attachment_ids );
                                        });

                                        // Finally, open the modal.
                                        image_frame.open();
                                    });

                                    // Image ordering
                                    $carousel_images.sortable({
                                        items: 'li.image',
                                        cursor: 'move',
                                        scrollSensitivity:40,
                                        forcePlaceholderSize: true,
                                        forceHelperSize: false,
                                        helper: 'clone',
                                        opacity: 0.65,
                                        placeholder: 'wc-metabox-sortable-placeholder',
                                        start:function(event,ui){
                                            ui.item.css('background-color','#f6f6f6');
                                        },
                                        stop:function(event,ui){
                                            ui.item.removeAttr('style');
                                        },
                                        update: function(event, ui) {
                                            var attachment_ids = '';

                                            $('#image-carousel ul li.image').css('cursor','default').each(function() {
                                                var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                                                attachment_url = jQuery(this).attr( 'data-attachment_url' );
                                                attachment_ids = attachment_ids + attachment_id + ':' + attachment_url + ',';
                                            });

                                            $image_gallery_ids.val( attachment_ids );
                                        }
                                    });

                                    // Remove images
                                    $('#image-carousel').on( 'click', 'a.icon-close', function() {

                                        $(this).closest('li.image').remove();

                                        var attachment_ids = '';

                                        $('#image-carousel ul li.image').css('cursor','default').each(function() {
                                            var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                                            var attachment_url = jQuery(this).attr( 'data-attachment_url' );
                                            attachment_ids = attachment_ids + attachment_id + ':' + attachment_url + ',';
                                        });

                                        $image_gallery_ids.val( attachment_ids );

                                        return false;
                                    } );
                                });
                            </script>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="map builder-element hidden">
                <style type="text/css">
                    html, body, #map-canvas {
                        width: 100%;
                        height: 360px;
                        margin: 0px;
                        padding: 0px
                    }
                    #panel {
                        z-index: 5;
                        background-color: #fff;
                        padding: 5px;
                    }
                </style>
                <script type="text/javascript">
                    jQuery(document).ready(function(){

                        var element = jQuery('#builder-elements > .map');
                        // Check which option is selected

                        // remove all active demo links
                        element.find('.map-style-option > a').removeClass('active');
                        setTimeout(function(){
                            var map_style = jQuery(element).find('#map-style option:selected').val();

                            if ( map_style == 'map-style-essence' ) {
                                jQuery('#map-style').next('.map-style-option').find('a[role="essence"]').addClass('active');
                            } else if( map_style == 'map-style-subtle-grayscale' ) {
                                jQuery('#map-style').next('.map-style-option').find('a[role="subtle-grayscale"]').addClass('active');
                            } else if( map_style == 'map-style-shades-of-grey' ) {
                                jQuery('#map-style').next('.map-style-option').find('a[role="shades-of-grey"]').addClass('active');
                            } else if( map_style == 'map-style-purple' ) {
                                jQuery('#map-style').next('.map-style-option').find('a[role="purple"]').addClass('active');
                            } else if( map_style == 'map-style-best-ski-pros' ) {
                                jQuery('#map-style').next('.map-style-option').find('a[role="best-ski-pros"]').addClass('active');
                            }
                        },100);

                        // Change demo link on change
                        jQuery('#map-style').change(function(event) {
                            var map_style = jQuery(this).find('option:selected').val();

                            if( jQuery('.map-style-option').find('a.active').length > 0 ) 
                                jQuery('.map-style-option').find('a.active').removeClass('active');

                            if ( map_style == 'map-style-essence' ) {
                                jQuery('#map-style').next('.map-style-option').find('a[role="essence"]').addClass('active');
                            } else if( map_style == 'map-style-subtle-grayscale' ) {
                                jQuery('#map-style').next('.map-style-option').find('a[role="subtle-grayscale"]').addClass('active');
                            } else if( map_style == 'map-style-shades-of-grey' ) {
                                jQuery('#map-style').next('.map-style-option').find('a[role="shades-of-grey"]').addClass('active');
                            } else if( map_style == 'map-style-purple' ) {
                                jQuery('#map-style').next('.map-style-option').find('a[role="purple"]').addClass('active');
                            } else if( map_style == 'map-style-best-ski-pros' ) {
                                jQuery('#map-style').next('.map-style-option').find('a[role="best-ski-pros"]').addClass('active');
                            }
                        }); 

                        // If label "Marker icon" option[Upload icon] is selected, show upload form
                        jQuery('#map-marker-icon').change(function(event) {
                            var map_icon = jQuery(this).find('option:selected').val();
                            
                            if( map_icon == 'map-marker-icon-upload' ) {
                                jQuery('.map-marker-img').removeClass('hidden');
                            } else {
                                jQuery('.map-marker-img').addClass('hidden');
                            }
                        }); 

                        setTimeout(function(){
                            var map_icon = jQuery(element).find('#map-marker-icon option:selected').val();

                            if( map_icon == 'map-marker-icon-upload' ) {
                                jQuery('.map-marker-img').removeClass('hidden');
                            } else {
                                jQuery('.map-marker-img').addClass('hidden');
                            }
                        },100);
                    });
                </script>
                <h3 class="element-title"><?php _e('Map element','shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="map-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="map-admin-label" name="map-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="panel">
                                <input id="map-address" type="text" placeholder="<?php _e('Enter your address','shootback'); ?>">
                                <input class="button button-primary" type="button" value="<?php _e('Find address','shootback') ?>" onclick="codeAddress()">
                            </div>
                        </td>
                        <td>
                            <div id="map-canvas"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-width"><?php _e('Width:','shootback'); ?></label>
                        </td>
                        <td>
                            <input type="text" id="map-width" name="map-width" value="100" />%
                            <div class="ts-option-description">
                                <?php _e('Enter the width in percent (for example: 100%)','shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-height"><?php _e('Height:','shootback'); ?></label>
                        </td>
                        <td>
                            <input type="text" id="map-height" name="map-height" value="300" />px
                            <div class="ts-option-description">
                                <?php _e('Enter the height in pixels (for example: 480px)','shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-latitude"><?php _e('Latitude:','shootback'); ?></label>
                        </td>
                        <td>
                            <input type="text" id="map-latitude" name="map-latitude" />
                            <div class="ts-option-description">
                                <?php _e('Latitude automatically generated from the address entered above','shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-longitude"><?php _e('Longitude:','shootback'); ?></label>
                        </td>
                        <td>
                            <input type="text" id="map-longitude" name="map-longitude" />
                            <div class="ts-option-description">
                                <?php _e('Longitude automatically generated from the address entered above','shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-type"><?php _e('Map type:','shootback'); ?></label>
                        </td>
                        <td>
                            <select name="map-type" id="map-type">
                                <option selected="selected" value="ROADMAP"><?php _e('Roadmap', 'shootback') ?></option>
                                <option value="SATELLITE"><?php _e('Satellite', 'shootback') ?></option>
                                <option value="HYBRID"><?php _e('Hybrid', 'shootback') ?></option>
                                <option value="TERRAIN"><?php _e('Terrain', 'shootback') ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('For details read the documentation from Google','shootback'); ?>
                                <a href="https://developers.google.com/maps/documentation/javascript/maptypes#MapTypes" target="_blank">
                                    <?php _e('read documentation','shootback'); ?>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-style"><?php _e('Map style:','shootback'); ?></label>
                        </td>
                        <td>
                            <select name="map-style" id="map-style">
                                <option selected="selected" value="default"><?php _e('Default', 'shootback') ?></option>
                                <option value="map-style-essence"><?php _e('Essence', 'shootback') ?></option>
                                <option value="map-style-subtle-grayscale"><?php _e('Subtle grayscale', 'shootback') ?></option>
                                <option value="map-style-shades-of-grey"><?php _e('Shades of grey', 'shootback') ?></option>
                                <option value="map-style-purple"><?php _e('Purple', 'shootback') ?></option>
                                <option value="map-style-best-ski-pros"><?php _e('Best ski pros', 'shootback') ?></option>
                            </select>
                            <div class="ts-option-description map-style-option">
                                <a class="active" role="essence" href="https://snazzymaps.com/style/61/blue-essence" target="_blank">
                                    <?php _e('View example for Essence','shootback'); ?>
                                </a>
                                <a role="subtle-grayscale" href="https://snazzymaps.com/style/15/subtle-grayscale" target="_blank">
                                    <?php _e('View example for Subtle grayscale','shootback'); ?>
                                </a>
                                <a role="shades-of-grey" href="https://snazzymaps.com/style/38/shades-of-grey" target="_blank">
                                    <?php _e('View example for Shades of grey','shootback'); ?>
                                </a>
                                <a role="purple" href="https://snazzymaps.com/style/1371/purple" target="_blank">
                                    <?php _e('View example for Purple','shootback'); ?>
                                </a>
                                <a role="best-ski-pros" href="https://snazzymaps.com/style/1370/best-ski-pros" target="_blank">
                                    <?php _e('View example for Best ski pros','shootback'); ?>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-zoom"><?php _e('Map zoom:','shootback'); ?></label>
                        </td>
                        <td>
                            <input type="text" id="map-zoom" name="map-zoom" value="11" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            <div>
                                <?php _e('Read more about ','shootback'); ?>
                                <a href="https://developers.google.com/maps/documentation/javascript/reference#MapTypeControlOptions" target="_blank">
                                    <?php _e('Google Map Controls','shootback'); ?>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-type-control"><?php _e('Map type control:','shootback'); ?></label>
                        </td>
                        <td>
                            <select name="map-type-control" id="map-type-control">
                                <option value="false"><?php _e('Disable', 'shootback') ?></option>
                                <option selected="selected" value="true"><?php _e('Enable', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-zoom-control"><?php _e('Map zoom control:','shootback'); ?></label>
                        </td>
                        <td>
                           <select name="map-zoom-control" id="map-zoom-control">
                                <option value="false"><?php _e('Disable', 'shootback') ?></option>
                                <option selected="selected" value="true"><?php _e('Enable', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-scale-control"><?php _e('Map scale control:','shootback'); ?></label>
                        </td>
                        <td>
                            <select name="map-scale-control" id="map-scale-control">
                                <option selected="selected" value="false"><?php _e('Disable', 'shootback') ?></option>
                                <option value="true"><?php _e('Enable', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-scroll-wheel"><?php _e('Map scroll wheel:','shootback'); ?></label>
                        </td>
                        <td>
                            <select name="map-scroll-wheel" id="map-scroll-wheel">
                                <option value="false"><?php _e('Disable', 'shootback') ?></option>
                                <option selected="selected" value="true"><?php _e('Enable', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-draggable-direction"><?php _e('Draggable directions:','shootback'); ?></label>
                        </td>
                        <td>
                            <select name="map-draggable-direction" id="map-draggable-direction">
                                <option value="false"><?php _e('Disable', 'shootback') ?></option>
                                <option selected="selected" value="true"><?php _e('Enable', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="map-marker-icon"><?php _e('Marker icon:','shootback'); ?></label>
                        </td>
                        <td>
                            <select name="map-marker-icon" id="map-marker-icon">
                                <option selected="selected" value="map-marker-icon-default"><?php _e('Use default', 'shootback') ?></option>
                                <option value="map-marker-icon-upload"><?php _e('Upload icon', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr class="hidden map-marker-img">
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            <input type="text" value="" name="map-marker-image-url"  id="map-marker-attachment" style="width:300px" />
                            <input type="button" class="button-primary" id="map-marker-select-image" value="<?php _e('Upload icon', 'shootback'); ?>" />
                            <input type="hidden" value="" class="image_media_id" id="map-marker-media-id" />
                            <div id="map-marker-image-preview"></div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="banner builder-element hidden">
                <h3 class="element-title"><?php _e('Banner element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="banner-admin-label"><?php _e('Admin label:','shootback'); ?></label>
                        </td>
                        <td>
                           <input type="text" id="banner-admin-label" name="banner-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"><label for="image-banner-url"><?php _e( 'Enter your image for banner box:', 'shootback' ); ?></label></td>
                        <td>
                            <input type="text" value="" name="image-banner-url"  id="image-banner-url" style="width:300px" />
                            <input type="button" class="button button-primary" id="select_banner_image" value="<?php _e('Upload', 'shootback'); ?>" />
                            <input type="hidden" value="" id="banner_image_media_id" />
                            <div id="banner-image-preview"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Enter height image', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" name="banner-height" id="banner-height" value=""/>px
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Enter your title', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" name="banner-title" id="banner-title" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Enter your subtitle', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" name="banner-subtitle" id="banner-subtitle" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Enter title button', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" name="banner-button-title" id="banner-button-title" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Enter your url for button', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" name="banner-button-url" id="banner-button-url" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Select your background color for button', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" id="banner-button-background" class="colors-section-picker" value="#F46964" name="banner-background-color" />
                            <div class="colors-section-picker-div" id="banner-button-background"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Select your color for text button', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" id="banner-button-text-color" class="colors-section-picker" value="#F46964" name="banner-button-text-color" />
                            <div class="colors-section-picker-div" id="banner-button-text-color"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Select your font color', 'shootback' ); ?>:
                        </td>
                        <td>
                            <input type="text" id="banner-font-color" class="colors-section-picker" value="#f1f1f1" name="banner-font-color" />
                            <div class="colors-section-picker-div" id="banner-font-color"></div>
                        </td>
                    </tr>
                    <tr>
                        <td width="70px">
                            <?php _e('Text align', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="banner-text-align" id="banner-text-align">
                                <option value="banner-text-align-left"><?php _e('Left', 'shootback') ?></option>
                                <option value="banner-text-align-right"><?php _e('Right', 'shootback') ?></option>
                                <option value="banner-text-align-center"><?php _e('Center', 'shootback') ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="toggle builder-element hidden">
                <h3 class="element-title"><?php _e('Toggle element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="toggle-admin-label"><?php _e('Admin label:','shootback'); ?></label>
                        </td>
                        <td>
                           <input type="text" id="toggle-admin-label" name="toggle-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Enter your title:', 'shootback' ); ?>
                        </td>
                        <td>
                            <input type="text" name="toggle-title" id="toggle-title" value=''/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Enter your description:', 'shootback' ); ?>
                        </td>
                        <td>
                            <textarea name="toggle-description" id="toggle-description" cols="45" rows="15"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'State (opened/closed):', 'shootback' ); ?>
                        </td>
                        <td>
                            <select name="toggle-state" id="toggle-state">
                                <option value="open"><?php _e( 'Open', 'shootback' ); ?></option>
                                <option value="closed"><?php _e( 'Closed', 'shootback' ); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

        <!-- tab element -->
            <div class="tab builder-element hidden">
                <h3 class="element-title"><?php _e('Tab element','shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <?php _e('Admin label:','shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="tab-admin-label" name="tab-admin-label" />
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <?php _e('Choose mode tab:','shootback'); ?>
                        </td>
                        <td>
                           <select id="tab-mode" name="tab-mode">
                               <option value="horizontal"><?php _e('Horizontal','shootback'); ?></option>
                               <option value="vertical"><?php _e('Vertical','shootback'); ?></option>
                           </select>
                        </td>
                    </tr>
                </table>
                <ul id="tab_items">
               
                </ul>
                   
                <input type="hidden" id="tab_content" value="" />
                <input type="button" class="button ts-multiple-add-button" data-element-name="tab" id="tab_add_item" value=" <?php _e('Add New Tab', 'shootback'); ?>" />
                  <?php
                    echo '<script id="tab_items_template" type="text/template">';
                    echo '<li id="list-item-id-{{item-id}}" class="tab-item ts-multiple-add-list-element">
                            <div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="tab-item-tab ts-multiple-item-tab">Item: {{slide-number}}</span></div>
                            <div class="hidden">
                                <table>
                                    <tr>
                                        <td>
                                            <label for="tab-{{item-id}}-title">Title:</label>
                                        </td>
                                        <td>
                                            <input data-builder-name="title" type="text" id="tab-{{item-id}}-title" name="tab[{{item-id}}][title]" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="tab-{{item-id}}-text">Write your text here:</label>
                                        </td>
                                        <td>
                                            <textarea data-builder-name="text" name="tab[{{item-id}}][text]" id="tab-{{item-id}}-text" cols="45" rows="5"></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" data-builder-name="item_id" value="{{item-id}}" name="testimonials[{{item-id}}][id]" />
                                <input type="button" class="button button-primary remove-item" value="' . __('Remove', 'shootback') . '" />
                                <a href="#" data-item="tab-item" data-increment="tab-items" class="button button-primary ts-multiple-item-duplicate">'.__('Duplicate Item', 'shootback').'</a>
                            </div>
                        </li>';
                    echo '</script>';
               ?>
            </div>
          
            <!-- List videos element -->

            <div class="list-videos builder-element hidden">
                <h3 class="element-title"><?php _e('List videos element', 'shootback'); ?></h3>
                <!-- Select category -->
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="list-videos-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="list-videos-admin-label" name="list-videos-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <label for="list-videos-category"><?php _e( 'Category', 'shootback' ); ?>:</label>
                        </td>
                        <td>                           
                            <select data-placeholder="<?php _e('Select your category', 'shootback'); ?>" class="ts-custom-select-input" name="list-videos-category" id="list-videos-category" multiple>
                                <?php $categories = get_categories(array( 'hide_empty' => 0, 'taxonomy' => 'videos_categories' )); ?>
                                <?php if ( isset($categories) && is_array($categories) && !empty($categories) ): ?>
                                    <?php $i = 0; foreach ($categories as $index => $category): ?>
                                        <?php if( is_object($category) ) : ?>
                                            <?php if( $i == 0 ) echo '<option value="0">All</option>'; ?>
                                            <option value="<?php if( is_object($category) ) echo $category->slug; ?>"><?php if( is_object($category) ) echo $category->cat_name; ?></option>
                                        <?php $i++; endif; ?>
                                    <?php endforeach ?>                                    
                                <?php endif ?>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose the categories that you want to showcase articles from.', 'shootback'); ?>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><?php _e( 'Show only featured', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="list-videos-featured" id="list-videos-featured">
                                <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                <option value="n" selected="selected"><?php _e( 'No', 'shootback' ); ?></option>
                            </select>

                            <div class="ts-option-description">
                                <?php _e('You can display only featured posts', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="list-videos-exclude"><?php _e( 'Exclude post IDs', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="list-videos-exclude" id="list-videos-exclude" size="4"/>
                            <div class="ts-option-description">
                                <?php _e('Insert the IDs of the posts you want to exclude from showing.', 'shootback'); ?> (ex: <b>100,101,102,104</b>)
                            </div>
                        </td>
                    </tr>
                     <tr class="list-videos-exclude">
                        <td>
                            <label for="list-videos-exclude-first"><?php _e( 'Exclude number of first posts', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="list-videos-exclude-first" id="list-videos-exclude-first" size="4"/>
                            <div class="ts-option-description">
                                <?php _e('Insert the number of the posts you want to exclude from showing.', 'shootback'); ?> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="list-videos-display-mode"><?php _e( 'How to display', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-videos-display-mode" id="list-videos-display-mode-selector">
                               <li><img class="image-radio-input clickable-element" data-option="grid" src="<?php echo get_template_directory_uri().'/images/options/grid_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="list" src="<?php echo get_template_directory_uri().'/images/options/list_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="thumbnails" src="<?php echo get_template_directory_uri().'/images/options/thumb_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="big-post" src="<?php echo get_template_directory_uri().'/images/options/big_posts_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="super-post" src="<?php echo get_template_directory_uri().'/images/options/super_post_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="timeline" src="<?php echo get_template_directory_uri().'/images/options/timeline_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="mosaic" src="<?php echo get_template_directory_uri().'/images/options/mosaic_view.png'; ?>"></li>
                            </ul>
                            <select class="select_2" class="hidden" name="list-videos-display-mode" id="list-videos-display-mode">
                                <option value="grid"><?php _e( 'Grid', 'shootback' ); ?></option>
                                <option value="list"><?php _e( 'List', 'shootback' ); ?></option>
                                <option value="thumbnails"><?php _e( 'Thumbnails', 'shootback' ); ?></option>
                                <option value="big-post"><?php _e( 'Big post', 'shootback' ); ?></option>
                                <option value="super-post"><?php _e( 'Super Post', 'shootback' ); ?></option>
                                <option value="timeline"><?php _e( 'Timeline Post', 'shootback' ); ?></option>
                                <option value="mosaic"><?php _e( 'mosaic Post', 'shootback' ); ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose your article view type. Depending on what type of article showcase layout you select you will get different options. You can read more about view types in our documentation files: ', 'shootback'); echo $touchsize_com; ?>
                            </div>
                        </td>
                    </tr>
                </table>

                <div id="list-videos-display-mode-options">
                    <!-- Grid options -->
                    <div class="list-videos-grid hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label><?php _e( 'Behavior', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-videos-grid-behavior" id="list-videos-grid-behavior-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="none" src="<?php echo get_template_directory_uri().'/images/options/behavior_none.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="carousel" src="<?php echo get_template_directory_uri().'/images/options/behavior_carousel.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="masonry" src="<?php echo get_template_directory_uri().'/images/options/behavior_masonry.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="scroll" src="<?php echo get_template_directory_uri().'/images/options/behavior_scroll.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="tabbed" src="<?php echo get_template_directory_uri().'/images/options/behavior_tabs.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-videos-grid-behavior" id="list-videos-grid-behavior">
                                        <option value="none"><?php _e( 'Normal', 'shootback' ); ?></option>
                                        <option value="carousel"><?php _e( 'Carousel', 'shootback' ); ?></option>
                                        <option value="masonry"><?php _e( 'Masonry', 'shootback' ); ?></option>
                                        <option value="scroll"><?php _e( 'Scroll', 'shootback' ); ?></option>
                                        <option value="tabbed"><?php _e( 'Tabbed', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your posts behavior - you can have them just shown, or you can activate the carousel. If carousel is selected your articles will show up in a line with arrows for navigation. If masonry bahevior is selected - your articles will be arranged in to fit it. Be aware that activating the masonry option the crop settings for image sizes tab will be overwritten.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-grid-image"><?php _e( 'Show featured image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-grid-image" id="list-videos-grid-image">
                                        <option selected="selected" value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-grid-title"><?php _e( 'Title position', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-videos-grid-title" id="list-videos-grid-title-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="title-above-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_image.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="title-below-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_excerpt.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-videos-grid-title" id="list-videos-grid-title">
                                        <option value="title-above-image"><?php _e( 'Above image', 'shootback' ); ?></option>
                                        <option value="title-below-image" selected="selected"><?php _e( 'Above excerpt', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Select your title position for you grid posts. You can either have it above the image of above the excerpt. Note that sometimes title may change the position of the meta (date, categories, author) as well.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-grid-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="list-videos-grid-show-meta" id="list-videos-grid-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="list-videos-grid-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-videos-grid-show-meta" id="list-videos-grid-show-meta-n" value="n" />
                                    <label for="list-videos-grid-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-grid-el-per-row"><?php _e( 'Elements per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-videos-grid-el-per-row" id="list-videos-grid-el-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-videos-grid-el-per-row" id="list-videos-grid-el-per-row">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-videos-grid-nr-of-posts">
                                <td>
                                    <label for="list-videos-grid-nr-of-posts"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-videos-grid-nr-of-posts" id="list-videos-grid-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-grid-related"><?php _e('Show related posts:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-videos-grid-related" id="list-videos-grid-related">
                                        <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option selected="selected" value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can set each of your grid to show related articles below. A list with other articles will appear below.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-grid-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-grid-order-by" id="list-videos-grid-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-grid-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-grid-order-direction" id="list-videos-grid-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-grid-special-effects"><?php _e( 'Special effects', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-grid-special-effects" id="list-videos-grid-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-videos-grid-pagination">
                                <td>
                                    <label for="list-videos-grid-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-grid-pagination" id="list-videos-grid-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- List options -->
                    <div class="list-videos-list hidden">

                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-videos-list-image"><?php _e( 'Show featured image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-list-image" id="list-videos-list-image">
                                        <option selected="selected" value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-list-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="list-videos-list-show-meta" id="list-videos-list-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="list-videos-list-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-videos-list-show-meta" id="list-videos-list-show-meta-n" value="n" />
                                    <label for="list-videos-list-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-videos-list-nr-of-posts">
                                <td>
                                    <label for="list-videos-list-nr-of-posts"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-videos-list-nr-of-posts" id="list-videos-list-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e( 'Content split', 'shootback' ); ?>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-videos-list-image-split" id="list-videos-list-image-split-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1-3" src="<?php echo get_template_directory_uri().'/images/options/list_view_13.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="1-2" src="<?php echo get_template_directory_uri().'/images/options/list_view_12.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3-4" src="<?php echo get_template_directory_uri().'/images/options/list_view_34.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-videos-list-image-split" id="list-videos-list-image-split">
                                        <option value="1-3">1/3</option>
                                        <option value="1-2">1/2</option>
                                        <option value="3-4">3/4</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your title/content split proportions. You can have them either 1/3, 1/2, 3/4 for your title and 2/3,1/2, 1/4 accordingly. Depending on the text and titles you use, select your split type.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-list-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-list-order-by" id="list-videos-list-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-list-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-list-order-direction" id="list-videos-list-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-list-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-videos-list-special-effects" id="list-videos-list-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-list-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-list-pagination" id="list-videos-list-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Thumbnail options -->
                    <div class="list-videos-thumbnails hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-videos-thumbnails-title"><?php _e( 'Title position', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-thumbnails-title" id="list-videos-thumbnails-title">
                                        <option value="over-image" selected="selected"><?php _e( 'Over image', 'shootback' ); ?></option>
                                        <option value="below-image"><?php _e( 'Below image', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><?php _e( 'Behavior', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-videos-thumbnails-behavior" id="list-videos-thumbnails-behavior-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="none" src="<?php echo get_template_directory_uri().'/images/options/behavior_none.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="carousel" src="<?php echo get_template_directory_uri().'/images/options/behavior_carousel.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="masonry" src="<?php echo get_template_directory_uri().'/images/options/behavior_masonry.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="scroll" src="<?php echo get_template_directory_uri().'/images/options/behavior_scroll.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="tabbed" src="<?php echo get_template_directory_uri().'/images/options/behavior_tabs.png'; ?>"></li>
                                    </ul>
                                    <select name="list-videos-thumbnails-behavior" id="list-videos-thumbnails-behavior">
                                        <option value="none"><?php _e( 'Normal', 'shootback' ); ?></option>
                                        <option value="carousel"><?php _e( 'Carousel', 'shootback' ); ?></option>
                                        <option value="masonry"><?php _e( 'Masonry', 'shootback' ); ?></option>
                                        <option value="scroll"><?php _e( 'Scroll', 'shootback' ); ?></option>
                                        <option value="tabbed"><?php _e( 'Tabbed', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your posts behavior - you can have them just shown, or you can activate the carousel. If carousel is selected your articles will show up in a line with arrows for navigation. If masonry bahevior is selected - your articles will be arranged in to fit it. Be aware that activating the masonry option the crop settings for image sizes tab will be overwritten.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-thumbnail-posts-per-row"><?php _e( 'Number of posts per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-videos-thumbnail-posts-per-row" id="list-videos-thumbnail-posts-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-videos-thumbnail-posts-per-row" id="list-videos-thumbnail-posts-per-row">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-videos-thumbnail-nr-of-posts">
                                <td>
                                    <label for="list-videos-thumbnail-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-videos-thumbnail-limit"  id="list-videos-thumbnail-limit" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    <label for="list-videos-thumbnail-show-meta"><?php _e( 'Show meta:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="list-videos-thumbnail-show-meta" id="list-videos-thumbnail-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="list-videos-thumbnail-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-videos-thumbnail-show-meta" id="list-videos-thumbnail-show-meta-n" value="n" />
                                    <label for="list-videos-thumbnail-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-thumbnail-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-thumbnail-order-by" id="list-videos-thumbnail-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-thumbnail-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-thumbnail-order-direction" id="list-videos-thumbnails-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-thumbnail-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-videos-thumbnail-special-effects" id="list-videos-thumbnail-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale' , 'shootback') ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-thumbnail-gutter"><?php _e( 'Remove gutter(space) between articles:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-videos-thumbnail-gutter" id="list-videos-thumbnail-gutter">
                                        <option value="n"><?php _e('No', 'shootback') ?></option>
                                        <option value="y"><?php _e('Yes', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Gutter is the space between your articles. You can remove the space and have your articles sticked one to another.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-videos-thumbnails-pagination">
                                <td>
                                    <label for="list-videos-thumbnails-pagination"><?php _e( 'Enable pagination:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-videos-thumbnails-pagination" id="list-videos-thumbnails-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="list-videos-big-post hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-videos-big-post-image"><?php _e( 'Show featured image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-big-post-image" id="list-videos-big-post-image">
                                        <option selected="selected" value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-big-post-carousel"><?php _e( 'Show carousel', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-videos-big-post-carousel" id="list-videos-big-post-carousel">
                                        <option value="y"><?php _e('Yes', 'shootback') ?></option>
                                        <option selected="selected" value="n"><?php _e('No', 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-big-post-excerpt"><?php _e( 'Show excerpt', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-videos-big-post-excerpt" id="list-videos-big-post-excerpt">
                                        <option selected="selected" value="y"><?php _e('Yes', 'shootback') ?></option>
                                        <option value="n"><?php _e('No', 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-big-post-title"><?php _e( 'Title position:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-videos-big-post-title" id="list-videos-big-post-title-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="title-above-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_image.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="title-below-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_excerpt.png'; ?>"></li>
                                    </ul>
                                    <select name="list-videos-big-post-title" id="list-videos-big-post-title">
                                        <option value="title-above-image"><?php _e( 'Above image', 'shootback' ); ?></option>
                                        <option value="title-below-image"><?php _e( 'Above excerpt', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Select your title position for you grid posts. You can either have it above the image of above the excerpt. Note that sometimes title may change the position of the meta (date, categories, author) as well.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-big-post-image-position"><?php _e( 'Image position:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-videos-big-post-image-position" id="list-videos-big-post-image-position">
                                        <option value="left"><?php _e( 'Left', 'shootback' ); ?></option>
                                        <option value="right"><?php _e( 'Right', 'shootback' ); ?></option>
                                        <option value="mosaic"><?php _e( 'Mosaic', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('The way you want to show your big post', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-big-post-show-meta"><?php _e( 'Show meta:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="list-videos-big-post-show-meta" id="list-videos-big-post-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="list-videos-big-post-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-videos-big-post-show-meta" id="list-videos-big-post-show-meta-n" value="n" />
                                    <label for="list-videos-big-post-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-videos-big-post-nr-of-posts">
                                <td>
                                    <label for="list-videos-big-post-nr-of-posts"><?php _e( 'How many posts to extract:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-videos-big-post-nr-of-posts" id="list-videos-big-post-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e( 'Content split', 'shootback' ); ?>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-videos-big-post-image-split" id="list-videos-big-post-image-split-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1-3" src="<?php echo get_template_directory_uri().'/images/options/big_posts_13.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="1-2" src="<?php echo get_template_directory_uri().'/images/options/big_posts_12.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3-4" src="<?php echo get_template_directory_uri().'/images/options/big_posts_34.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-videos-big-post-image-split" id="list-videos-big-post-image-split">
                                        <option value="1-3">1/3</option>
                                        <option value="1-2">1/2</option>
                                        <option value="3-4">3/4</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your image/content split proportions. You can have them either 1/3, 1/2, 3/4 for your title and 2/3,1/2, 1/4 accordingly. Depending on the text and titles you use, select your split type.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-big-post-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-big-post-order-by" id="list-videos-big-post-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-big-post-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-big-post-order-direction" id="list-videos-big-post-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="desc"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-big-post-related"><?php _e('Show related posts', 'shootback'); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-big-post-related" id="list-videos-big-post-related">
                                        <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option selected="selected" value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can set each of your grid to show related articles below. A list with other articles will appear below.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-big-post-special-effects"><?php _e( 'Special effects', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-big-post-special-effects" id="list-videos-big-post-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-videos-big-post-pagination">
                                <td>
                                    <label for="list-videos-big-post-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-big-post-pagination" id="list-videos-big-post-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="list-videos-super-post hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-videos-super-post-posts-per-row"><?php _e( 'Number of posts per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-videos-super-post-posts-per-row" id="list-videos-super-post-posts-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-videos-super-post-posts-per-row" id="list-videos-super-post-posts-per-row">
                                        <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-videos-super-post-nr-of-posts">
                                <td>
                                    <label for="list-videos-super-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-videos-super-post-limit"  id="list-videos-super-post-limit" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-super-post-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-super-post-order-by" id="list-videos-super-post-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                     <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     <label for="list-videos-super-post-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-super-post-order-direction" id="list-videos-super-post-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="desc"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-super-post-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-videos-super-post-special-effects" id="list-videos-super-post-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-super-post-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-super-post-pagination" id="list-videos-super-post-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Timeline options -->
                    <div class="list-videos-timeline hidden">

                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-videos-timeline-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="list-videos-timeline-show-meta" id="list-videos-timeline-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="list-videos-timeline-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-videos-timeline-show-meta" id="list-videos-timeline-show-meta-n" value="n" />
                                    <label for="list-videos-timeline-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-timeline-image"><?php _e( 'Show image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-timeline-image" id="list-videos-timeline-image">
                                        <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Display image', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-videos-timeline-nr-of-posts">
                                <td>
                                    <label for="list-videos-timeline-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-videos-timeline-post-limit" id="list-videos-timeline-post-limit" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-timeline-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-timeline-order-by" id="list-videos-timeline-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-timeline-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-timeline-order-direction" id="list-videos-timeline-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-timeline-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-timeline-pagination" id="list-videos-timeline-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- mosaic options -->
                    <div class="list-videos-mosaic hidden">

                        <table cellpadding="10">
                            <tr class="list-videos-mosaic-layout">
                                <td>
                                    <label for="list-videos-mosaic-layout"><?php _e( 'Choose how to show the posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-mosaic-layout" id="list-videos-mosaic-layout" class="ts-mosaic-layout">
                                        <option value="rectangles"><?php _e( 'Rectangles', 'shootback' ); ?></option>
                                        <option value="square"><?php _e( 'Squares', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose how to show the posts', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-videos-mosaic-rows">
                                <td>
                                    <label for="list-videos-mosaic-rows"><?php _e( 'Change number of rows', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-mosaic-rows" id="list-videos-mosaic-rows" class="ts-mosaic-rows">
                                        <option value="2"><?php _e( '2', 'shootback' ); ?></option>
                                        <option value="3"><?php _e( '3', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Change number of rows', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-videos-mosaic-nr-of-posts">
                                <td>
                                    <label for="list-videos-mosaic-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <div class="ts-mosaic-post-limit-rows-2">
                                        <input class="ts-input-slider" type="text" name="list-videos-mosaic-post-limit-rows-2" id="list-videos-mosaic-post-limit-rows-2" value="6" disabled />
                                        <div id="list-videos-mosaic-post-limit-rows-2-slider"></div>
                                    </div>
                                    <div class="ts-mosaic-post-limit-rows-3">
                                        <input type="text" name="list-videos-mosaic-post-limit-rows-3" id="list-videos-mosaic-post-limit-rows-3" value="" disabled />
                                        <div id="list-videos-mosaic-post-limit-rows-3-slider"></div>
                                    </div>
                                    <div class="ts-mosaic-post-limit-squares">
                                        <input type="text" name="list-videos-mosaic-post-limit-rows-squares" id="list-videos-mosaic-post-limit-rows-squares" value="" disabled />
                                        <div id="list-videos-mosaic-post-limit-rows-squares-slider"></div>
                                    </div>

                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-mosaic-scroll"><?php _e( 'Add/remove scroll', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-mosaic-scroll" id="list-videos-mosaic-scroll">
                                        <option value="y"><?php _e( 'With scroll', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'Without scroll', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Add/remove scroll', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-mosaic-effects"><?php _e( 'Add effects to scroll', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-mosaic-effects" id="list-videos-mosaic-effects">
                                        <option value="default"><?php _e( 'Default', 'shootback' ); ?></option>
                                        <option value="fade"><?php _e( 'Fade in effect', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Change number of rows', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-mosaic-gutter"><?php _e( 'Add or Remove gutter between posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-mosaic-gutter" id="list-videos-mosaic-gutter">
                                        <option value="y"><?php _e( 'With gutter between posts', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No gutter', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Add or Remove gutter between posts', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-mosaic-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-mosaic-order-by" id="list-videos-mosaic-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-videos-mosaic-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-mosaic-order-direction" id="list-videos-mosaic-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="class-list-videos-mosaic-pagination">
                                <td>
                                    <label for="list-videos-mosaic-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-videos-mosaic-pagination" id="list-videos-mosaic-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                
                </div>
            </div>

            <div class="cart builder-element hidden">
                <h3 class="element-title"><?php _e('Shopping cart', 'shootback'); ?></h3>
                <p><?php _e( 'Change the position of the shopping cart', 'shootback', 'shootback'); ?></p>
                <table cellpadding="10">
                    <tr>
                        <td width="70px">
                            <?php _e('Cart align', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="cart-align" id="cart-align">
                                <option value="left"><?php _e('Left', 'shootback'); ?></option>
                                <option value="right"><?php _e('Right', 'shootback'); ?></option>
                                <option value="center"><?php _e('Center', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="breadcrumbs builder-element hidden">
                <h3 class="element-title"><?php _e('Breadcrumbs element', 'shootback'); ?></h3>
                <p><?php _e( 'You can add breadcrumbs form to page', 'shootback' ); ?></p>
            </div>

        <!-- Latest custom post -->
            <div class="latest-custom-posts builder-element hidden">
                <h3 class="element-title"><?php _e('Latest custom post', 'shootback'); ?></h3>
                <p><?php _e( 'You can add latest custom post form to page', 'shootback' ); ?></p>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="latest-custom-posts-admin-label"><?php _e('Admin label','shootback'); ?>:</label>
                        </td>
                        <td>
                           <input type="text" id="latest-custom-posts-admin-label" name="latest-custom-posts-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td width="70px">
                            <label for="latest-custom-posts-type"><?php _e( 'Select post type', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <?php 
                                $args=array(
                                  'public'   => true,
                                  '_builtin' => false
                                );
                                $post_types = get_post_types($args, 'objects', 'or');
                                
                                $post_types_default = array('post', 'page', 'video', 'ts_teams', 'ts_slider', 'portfolio', 'ts_pricing_table', 'attachment', 'product', 'product_variation', 'shop_order', 'shop_order_refund', 'shop_coupon', 'shop_webhook');
                                $no_custom = false;
                                $registred_post_type = array();
                               
                                if( isset($post_types['post']) && !empty($post_types) ) : ?>
                                    <select data-placeholder="<?php _e('Select your custom post type', 'shootback'); ?>" class="ts-custom-select-input" multiple name="latest-custom-posts-type" id="latest-custom-posts-type">
                                        <?php foreach($post_types as $register_name => $post_type) : 
                                            if( !in_array($register_name, $post_types_default) ) : ?>
                                                <?php if( !in_array($register_name, $registred_post_type) ) : ?>
                                                    <?php if( $no_custom === false ) echo '<option value="0">' . __('All', 'shootback') . '</option>'; $no_custom = true; 
                                                       $registred_post_type[] = $register_name; 
                                                    ?>
                                                <?php endif; ?>
                                                <option value="<?php echo $register_name; ?>"><?php echo $post_type->labels->name; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php if( $no_custom === false ) echo '<option value="no-custom-posts">' . __('No new custom posts', 'shootback') . '</option>'; ?>
                                    </select>  
                                <?php endif; ?>
                            <div class="ts-option-description">
                                <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <?php   if( is_array($registred_post_type) && count($registred_post_type) > 0 ){
                                $exclude_taxonomies = array('post_tag', 'post_format');
                                foreach($registred_post_type as $name_post_type){
                                    $taxonomies = get_object_taxonomies($name_post_type);
                                    foreach($taxonomies as $taxonomy){
                                        if( !in_array($taxonomy, $exclude_taxonomies) ){
                                            $categories = get_categories(array( 'hide_empty' => 0, 'taxonomy' => $taxonomy ));
                                            echo '<tr id="ts-block-category-' . $name_post_type . '">
                                                    <td>' . __('Select category by custom post type ', 'shootback') . $name_post_type . '</td>
                                                        <td>';
                                            if( isset($categories) && is_array($categories) && !empty($categories) ){
                                                
                                                echo '<select data-placeholder="' . __('Select your category', 'shootback') . '" class="ts-custom-select-input" name="latest-custom-category-' . $name_post_type . '" multiple id="latest-custom-posts-category-' . $name_post_type . '">';
                                                $i = 0;
                                                    foreach($categories as $category){
                                                        if( $i == 0 ) echo '<option value="0">' . __('All', 'shootback') . '</option>';
                                                        echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                                                        $i++;
                                                    }

                                                echo '</select>
                                                     <script>
                                                        jQuery(document).ready(function(){
                                                           ts_select_all_general("#latest-custom-posts-category-' . $name_post_type . '"); 
                                                        });
                                                     </script>';
                                            }else{
                                                echo '<select data-placeholder="' . __('Select your category', 'shootback') . '" class="ts-custom-select-input" name="latest-custom-posts-type-no-categories" multiple id="latest-custom-posts-type-no-categories">
                                                       <option value="no-custom-posts">' . __('No categories', 'shootback') . '</option> 
                                                    </select>';
                                            }
                                            echo '</td></tr>';
                                        }
                                    } 
                                }
                            }   
                    ?>
                    <tr>
                        <td>
                            <label><?php _e( 'Show only featured', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="latest-custom-posts-featured" id="latest-custom-posts-featured">
                                <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                <option value="n" selected="selected"><?php _e( 'No', 'shootback' ); ?></option>
                            </select>

                            <div class="ts-option-description">
                                <?php _e('You can display only featured posts', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="latest-custom-posts-exclude"><?php _e( 'Exclude post IDs', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="latest-custom-posts-exclude" id="latest-custom-posts-exclude" size="4"/>
                            <div class="ts-option-description">
                                <?php _e('Insert the IDs of the posts you want to exclude from showing.', 'shootback'); ?> (ex: <b>100,101,102,104</b>)
                            </div>
                        </td>
                    </tr>
                     <tr class="latest-custom-posts-exclude">
                        <td>
                            <label for="latest-custom-posts-exclude-first"><?php _e( 'Exclude number of first posts', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="latest-custom-posts-exclude-first" id="latest-custom-posts-exclude-first" size="4"/>
                            <div class="ts-option-description">
                                <?php _e('Insert the number of the posts you want to exclude from showing.', 'shootback'); ?> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="latest-custom-posts-display-mode"><?php _e( 'How to display', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#latest-custom-posts-display-mode" id="latest-custom-posts-display-mode-selector">
                               <li><img class="image-radio-input clickable-element" data-option="grid" src="<?php echo get_template_directory_uri().'/images/options/grid_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="list" src="<?php echo get_template_directory_uri().'/images/options/list_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="thumbnails" src="<?php echo get_template_directory_uri().'/images/options/thumb_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="big-post" src="<?php echo get_template_directory_uri().'/images/options/big_posts_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="super-post" src="<?php echo get_template_directory_uri().'/images/options/super_post_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="timeline" src="<?php echo get_template_directory_uri().'/images/options/timeline_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="mosaic" src="<?php echo get_template_directory_uri().'/images/options/mosaic_view.png'; ?>"></li>
                            </ul>
                            <select class="select_2" class="hidden" name="latest-custom-posts-display-mode" id="latest-custom-posts-display-mode">
                                <option value="grid"><?php _e( 'Grid', 'shootback' ); ?></option>
                                <option value="list"><?php _e( 'List', 'shootback' ); ?></option>
                                <option value="thumbnails"><?php _e( 'Thumbnails', 'shootback' ); ?></option>
                                <option value="big-post"><?php _e( 'Big post', 'shootback' ); ?></option>
                                <option value="super-post"><?php _e( 'Super Post', 'shootback' ); ?></option>
                                <option value="timeline"><?php _e( 'Timeline Post', 'shootback' ); ?></option>
                                <option value="mosaic"><?php _e( 'mosaic Post', 'shootback' ); ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose your article view type. Depending on what type of article showcase layout you select you will get different options. You can read more about view types in our documentation files: ', 'shootback'); echo $touchsize_com; ?>
                            </div>
                        </td>
                    </tr>
                </table>

                <div id="latest-custom-posts-display-mode-options">
                    <!-- Grid options -->
                    <div class="latest-custom-posts-grid hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label><?php _e( 'Behavior', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#latest-custom-posts-grid-behavior" id="latest-custom-posts-grid-behavior-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="none" src="<?php echo get_template_directory_uri().'/images/options/behavior_none.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="carousel" src="<?php echo get_template_directory_uri().'/images/options/behavior_carousel.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="masonry" src="<?php echo get_template_directory_uri().'/images/options/behavior_masonry.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="scroll" src="<?php echo get_template_directory_uri().'/images/options/behavior_scroll.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="latest-custom-posts-grid-behavior" id="latest-custom-posts-grid-behavior">
                                        <option value="none"><?php _e( 'Normal', 'shootback' ); ?></option>
                                        <option value="carousel"><?php _e( 'Carousel', 'shootback' ); ?></option>
                                        <option value="masonry"><?php _e( 'Masonry', 'shootback' ); ?></option>
                                        <option value="scroll"><?php _e( 'Scroll', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your posts behavior - you can have them just shown, or you can activate the carousel. If carousel is selected your articles will show up in a line with arrows for navigation. If masonry bahevior is selected - your articles will be arranged in to fit it. Be aware that activating the masonry option the crop settings for image sizes tab will be overwritten.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-grid-image"><?php _e( 'Show featured image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-grid-image" id="latest-custom-posts-grid-image">
                                        <option selected="selected" value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-grid-title"><?php _e( 'Title position', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#latest-custom-posts-grid-title" id="latest-custom-posts-grid-title-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="title-above-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_image.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="title-below-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_excerpt.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="latest-custom-posts-grid-title" id="latest-custom-posts-grid-title">
                                        <option value="title-above-image"><?php _e( 'Above image', 'shootback' ); ?></option>
                                        <option value="title-below-image" selected="selected"><?php _e( 'Above excerpt', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Select your title position for you grid posts. You can either have it above the image of above the excerpt. Note that sometimes title may change the position of the meta (date, categories, author) as well.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-grid-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="latest-custom-posts-grid-show-meta" id="latest-custom-posts-grid-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="latest-custom-posts-grid-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="latest-custom-posts-grid-show-meta" id="latest-custom-posts-grid-show-meta-n" value="n" />
                                    <label for="latest-custom-posts-grid-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-grid-el-per-row"><?php _e( 'Elements per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#latest-custom-posts-grid-el-per-row" id="latest-custom-posts-grid-el-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="latest-custom-posts-grid-el-per-row" id="latest-custom-posts-grid-el-per-row">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="latest-custom-posts-grid-nr-of-posts">
                                <td>
                                    <label for="latest-custom-posts-grid-nr-of-posts"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="latest-custom-posts-grid-nr-of-posts" id="latest-custom-posts-grid-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-grid-related"><?php _e( 'Show related posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-grid-related" id="latest-custom-posts-grid-related">
                                        <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option selected="selected" value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can set each of your big posts to show related articles below. A list with other articles will appear below.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-grid-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-grid-order-by" id="latest-custom-posts-grid-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-grid-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-grid-order-direction" id="latest-custom-posts-grid-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-grid-special-effects"><?php _e( 'Special effects', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-grid-special-effects" id="latest-custom-posts-grid-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="latest-custom-posts-grid-pagination">
                                <td>
                                    <label for="latest-custom-posts-grid-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-grid-pagination" id="latest-custom-posts-grid-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- List options -->
                    <div class="latest-custom-posts-list hidden">

                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-list-image"><?php _e( 'Show featured image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-list-image" id="latest-custom-posts-list-image">
                                        <option selected="selected" value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-list-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="latest-custom-posts-list-show-meta" id="latest-custom-posts-list-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="latest-custom-posts-list-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="latest-custom-posts-list-show-meta" id="latest-custom-posts-list-show-meta-n" value="n" />
                                    <label for="latest-custom-posts-list-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="latest-custom-posts-list-nr-of-posts">
                                <td>
                                    <label for="latest-custom-posts-list-nr-of-posts"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="latest-custom-posts-list-nr-of-posts" id="latest-custom-posts-list-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e( 'Content split', 'shootback' ); ?>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#latest-custom-posts-list-image-split" id="latest-custom-posts-list-image-split-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1-3" src="<?php echo get_template_directory_uri().'/images/options/list_view_13.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="1-2" src="<?php echo get_template_directory_uri().'/images/options/list_view_12.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3-4" src="<?php echo get_template_directory_uri().'/images/options/list_view_34.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="latest-custom-posts-list-image-split" id="latest-custom-posts-list-image-split">
                                        <option value="1-3">1/3</option>
                                        <option value="1-2">1/2</option>
                                        <option value="3-4">3/4</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your title/content split proportions. You can have them either 1/3, 1/2, 3/4 for your title and 2/3,1/2, 1/4 accordingly. Depending on the text and titles you use, select your split type.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-list-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-list-order-by" id="latest-custom-posts-list-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-list-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-list-order-direction" id="latest-custom-posts-list-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-list-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-list-special-effects" id="latest-custom-posts-list-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-list-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-list-pagination" id="latest-custom-posts-list-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Thumbnail options -->
                    <div class="latest-custom-posts-thumbnails hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-thumbnail-title"><?php _e( 'Title position', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-thumbnail-title" id="latest-custom-posts-thumbnail-title">
                                        <option value="over-image" selected="selected"><?php _e( 'Over image', 'shootback' ); ?></option>
                                        <option value="below-image"><?php _e( 'Below image', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><?php _e( 'Behavior', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#latest-custom-posts-thumbnails-behavior" id="latest-custom-posts-thumbnails-behavior-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="none" src="<?php echo get_template_directory_uri().'/images/options/behavior_none.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="carousel" src="<?php echo get_template_directory_uri().'/images/options/behavior_carousel.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="masonry" src="<?php echo get_template_directory_uri().'/images/options/behavior_masonry.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="scroll" src="<?php echo get_template_directory_uri().'/images/options/behavior_scroll.png'; ?>"></li>
                                    </ul>
                                    <select name="latest-custom-posts-thumbnails-behavior" id="latest-custom-posts-thumbnails-behavior">
                                        <option value="none"><?php _e( 'Normal', 'shootback' ); ?></option>
                                        <option value="carousel"><?php _e( 'Carousel', 'shootback' ); ?></option>
                                        <option value="masonry"><?php _e( 'Masonry', 'shootback' ); ?></option>
                                        <option value="scroll"><?php _e( 'Scroll', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your posts behavior - you can have them just shown, or you can activate the carousel. If carousel is selected your articles will show up in a line with arrows for navigation. If masonry bahevior is selected - your articles will be arranged in to fit it. Be aware that activating the masonry option the crop settings for image sizes tab will be overwritten.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-thumbnail-posts-per-row"><?php _e( 'Number of posts per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#latest-custom-posts-thumbnail-posts-per-row" id="latest-custom-posts-thumbnail-posts-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="latest-custom-posts-thumbnail-posts-per-row" id="latest-custom-posts-thumbnail-posts-per-row">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="latest-custom-posts-thumbnails-nr-of-posts">
                                <td>
                                    <label for="latest-custom-posts-thumbnail-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="latest-custom-posts-thumbnail-limit"  id="latest-custom-posts-thumbnail-limit" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    <label for="latest-custom-posts-thumbnail-show-meta"><?php _e( 'Show meta:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="latest-custom-posts-thumbnail-show-meta" id="latest-custom-posts-thumbnail-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="latest-custom-posts-thumbnail-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="latest-custom-posts-thumbnail-show-meta" id="latest-custom-posts-thumbnail-show-meta-n" value="n" />
                                    <label for="latest-custom-posts-thumbnail-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-thumbnail-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-thumbnail-order-by" id="latest-custom-posts-thumbnail-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-thumbnail-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-thumbnail-order-direction" id="latest-custom-posts-thumbnails-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-thumbnail-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-thumbnail-special-effects" id="latest-custom-posts-thumbnail-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale' , 'shootback') ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-thumbnail-gutter"><?php _e( 'Remove gutter(space) between articles:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-thumbnail-gutter" id="latest-custom-posts-thumbnail-gutter">
                                        <option value="n"><?php _e('No', 'shootback') ?></option>
                                        <option value="y"><?php _e('Yes', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Gutter is the space between your articles. You can remove the space and have your articles sticked one to another.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="latest-custom-posts-thumbnails-pagination">
                                <td>
                                    <label for="latest-custom-posts-thumbnails-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-thumbnails-pagination" id="latest-custom-posts-thumbnails-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="latest-custom-posts-big-post hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-big-post-image"><?php _e( 'Show featured image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-big-post-image" id="latest-custom-posts-big-post-image">
                                        <option selected="selected" value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-big-post-carousel"><?php _e( 'Show carousel', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-big-post-carousel" id="latest-custom-posts-big-post-carousel">
                                        <option value="y"><?php _e('Yes', 'shootback') ?></option>
                                        <option selected="selected" value="n"><?php _e('No', 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-big-post-excerpt"><?php _e( 'Show excerpt', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-big-post-excerpt" id="latest-custom-posts-big-post-excerpt">
                                        <option selected="selected" value="y"><?php _e('Yes', 'shootback') ?></option>
                                        <option value="n"><?php _e('No', 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-big-post-title"><?php _e( 'Title position:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#latest-custom-posts-big-post-title" id="latest-custom-posts-big-post-title-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="title-above-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_image.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="title-below-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_excerpt.png'; ?>"></li>
                                    </ul>
                                    <select name="latest-custom-posts-big-post-title" id="latest-custom-posts-big-post-title">
                                        <option value="title-above-image"><?php _e( 'Above image', 'shootback' ); ?></option>
                                        <option selected="selected" value="title-below-image"><?php _e( 'Above excerpt', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Select your title position for you grid posts. You can either have it above the image of above the excerpt. Note that sometimes title may change the position of the meta (date, categories, author) as well.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-big-post-image-position"><?php _e( 'Image position:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-big-post-image-position" id="latest-custom-posts-big-post-image-position">
                                        <option value="left"><?php _e( 'Left', 'shootback' ); ?></option>
                                        <option value="right"><?php _e( 'Right', 'shootback' ); ?></option>
                                        <option value="mosaic"><?php _e( 'Mosaic', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('The way you want to showcase your big posts.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-big-post-show-meta"><?php _e( 'Show meta:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="latest-custom-posts-big-post-show-meta" id="latest-custom-posts-big-post-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="latest-custom-posts-big-post-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="latest-custom-posts-big-post-show-meta" id="latest-custom-posts-big-post-show-meta-n" value="n" />
                                    <label for="latest-custom-posts-big-post-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="latest-custom-posts-big-post-nr-of-posts">
                                <td>
                                    <label for="latest-custom-posts-big-post-nr-of-posts"><?php _e( 'How many posts to extract:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="text" value="" name="latest-custom-posts-big-post-nr-of-posts" id="latest-custom-posts-big-post-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e( 'Content split', 'shootback' ); ?>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#latest-custom-posts-big-post-image-split" id="latest-custom-posts-big-post-image-split-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1-3" src="<?php echo get_template_directory_uri().'/images/options/big_posts_13.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="1-2" src="<?php echo get_template_directory_uri().'/images/options/big_posts_12.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3-4" src="<?php echo get_template_directory_uri().'/images/options/big_posts_34.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="latest-custom-posts-big-post-image-split" id="latest-custom-posts-big-post-image-split">
                                        <option value="1-3">1/3</option>
                                        <option value="1-2">1/2</option>
                                        <option value="3-4">3/4</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your image/content split proportions. You can have them either 1/3, 1/2, 3/4 for your title and 2/3,1/2, 1/4 accordingly. Depending on the text and titles you use, select your split type.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-big-post-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-big-post-order-by" id="latest-custom-posts-big-post-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-big-post-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-big-post-order-direction" id="latest-custom-posts-big-post-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="desc"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-big-post-related"><?php _e( 'Show related posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-big-post-related" id="latest-custom-posts-big-post-related">
                                        <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option selected="selected" value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can set each of your big posts to show related articles below. A list with other articles will appear below.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-big-post-special-effects"><?php _e( 'Special effects', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-big-post-special-effects" id="latest-custom-posts-big-post-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="latest-custom-posts-big-post-pagination">
                                <td>
                                    <label for="latest-custom-posts-big-post-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-big-post-pagination" id="latest-custom-posts-big-post-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="latest-custom-posts-super-post hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-super-post-posts-per-row"><?php _e( 'Number of posts per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#latest-custom-posts-super-post-posts-per-row" id="latest-custom-posts-super-post-posts-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="latest-custom-posts-super-post-posts-per-row" id="latest-custom-posts-super-post-posts-per-row">
                                        <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="latest-custom-posts-big-post-nr-of-posts">
                                <td>
                                    <label for="latest-custom-posts-super-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="latest-custom-posts-super-post-limit"  id="latest-custom-posts-super-post-limit" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-super-post-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-super-post-order-by" id="latest-custom-posts-super-post-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                     <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     <label for="latest-custom-posts-super-post-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-super-post-order-direction" id="latest-custom-posts-super-post-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="desc"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-super-post-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-super-post-special-effects" id="latest-custom-posts-super-post-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-super-post-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-super-post-pagination" id="latest-custom-posts-super-post-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Timeline options -->
                    <div class="latest-custom-posts-timeline hidden">

                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-timeline-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="latest-custom-posts-timeline-show-meta" id="latest-custom-posts-timeline-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="latest-custom-posts-timeline-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="latest-custom-posts-timeline-show-meta" id="latest-custom-posts-timeline-show-meta-n" value="n" />
                                    <label for="latest-custom-posts-timeline-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-timeline-image"><?php _e( 'Show image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-timeline-image" id="latest-custom-posts-timeline-image">
                                        <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Display image', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="latest-custom-posts-timeline-nr-of-posts">
                                <td>
                                    <label for="latest-custom-posts-timeline-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="latest-custom-posts-timeline-post-limit" id="latest-custom-posts-timeline-post-limit" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-timeline-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-timeline-order-by" id="latest-custom-posts-timeline-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-timeline-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-timeline-order-direction" id="latest-custom-posts-timeline-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-timeline-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-timeline-pagination" id="latest-custom-posts-timeline-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- mosaic options -->
                    <div class="latest-custom-posts-mosaic hidden">

                        <table cellpadding="10">
                            <tr class="latest-custom-posts-mosaic-layout">
                                <td>
                                    <label for="latest-custom-posts-mosaic-layout"><?php _e( 'Choose how to show the posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-mosaic-layout" id="latest-custom-posts-mosaic-layout" class="ts-mosaic-layout">
                                        <option value="rectangles"><?php _e( 'Rectangles', 'shootback' ); ?></option>
                                        <option value="square"><?php _e( 'Squares', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose how to show the posts', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="latest-custom-posts-mosaic-rows">
                                <td>
                                    <label for="latest-custom-posts-mosaic-rows"><?php _e( 'Change number of rows', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-mosaic-rows" id="latest-custom-posts-mosaic-rows" class="ts-mosaic-rows">
                                        <option value="2"><?php _e( '2', 'shootback' ); ?></option>
                                        <option value="3"><?php _e( '3', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Change number of rows', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="latest-custom-posts-mosaic-nr-of-posts">
                                <td>
                                    <label for="latest-custom-posts-mosaic-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <div class="ts-mosaic-post-limit-rows-2">
                                        <input class="ts-input-slider" type="text" name="latest-custom-posts-mosaic-post-limit-rows-2" id="latest-custom-posts-mosaic-post-limit-rows-2" value="6" disabled />
                                        <div id="latest-custom-posts-mosaic-post-limit-rows-2-slider"></div>
                                    </div>
                                    <div class="ts-mosaic-post-limit-rows-3">
                                        <input type="text" name="latest-custom-posts-mosaic-post-limit-rows-3" id="latest-custom-posts-mosaic-post-limit-rows-3" value="" disabled />
                                        <div id="latest-custom-posts-mosaic-post-limit-rows-3-slider"></div>
                                    </div>
                                    <div class="ts-mosaic-post-limit-squares">
                                        <input type="text" name="latest-custom-posts-mosaic-post-limit-rows-squares" id="latest-custom-posts-mosaic-post-limit-rows-squares" value="" disabled />
                                        <div id="latest-custom-posts-mosaic-post-limit-rows-squares-slider"></div>
                                    </div>

                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-mosaic-scroll"><?php _e( 'Add/remove scroll', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-mosaic-scroll" id="latest-custom-posts-mosaic-scroll">
                                        <option value="y"><?php _e( 'With scroll', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'Without scroll', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Add/remove scroll', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-mosaic-effects"><?php _e( 'Add effects to scroll', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-mosaic-effects" id="latest-custom-posts-mosaic-effects">
                                        <option value="default"><?php _e( 'Default', 'shootback' ); ?></option>
                                        <option value="fade"><?php _e( 'Fade in effect', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Change number of rows', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-mosaic-gutter"><?php _e( 'Add or Remove gutter between posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-mosaic-gutter" id="latest-custom-posts-mosaic-gutter">
                                        <option value="y"><?php _e( 'With gutter between posts', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No gutter', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Add or Remove gutter between posts', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-mosaic-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-mosaic-order-by" id="latest-custom-posts-mosaic-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="latest-custom-posts-mosaic-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-mosaic-order-direction" id="latest-custom-posts-mosaic-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="class-latest-custom-posts-mosaic-pagination">
                                <td>
                                    <label for="latest-custom-posts-mosaic-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="latest-custom-posts-mosaic-pagination" id="latest-custom-posts-mosaic-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                
                </div>
            </div>
   
            <div class="timeline builder-element hidden">
                <h3 class="element-title"><?php _e('Timeline features', 'shootback'); ?></h3>
                <p><?php _e( 'You can add timeline features form to page', 'shootback' ); ?></p>
                <table>
                     <tr>
                        <td>
                            <?php _e('Admin label:', 'shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="timeline-admin-label" name="timeline-amin-label" />
                        </td>
                    </tr>
                </table>

                <ul id="timeline_items">
                    
                </ul>
                    
                <input type="hidden" id="timeline_content" value="" />
                <input type="button" class="button ts-multiple-add-button" data-element-name="timeline" id="timeline_add_item" value=" <?php _e('Add New Timeline', 'shootback'); ?>"/>
                <?php
                    echo '<script id="timeline_items_template" type="text/template">
                            <li id="list-item-id-{{item-id}}" class="timeline-item ts-multiple-add-list-element">
                                <div class="sortable-meta-element">
                                    <span class="tab-arrow icon-down"></span> <span class="timeline-item-tab ts-multiple-item-tab">' . __('Item:', 'shootback') . ' {{slide-number}}</span>
                                </div>
                                <div class="hidden">
                                    <table>
                                        <tr>
                                            <td>'
                                                . __('Title:', 'shootback') .
                                            '</td>
                                            <td>
                                               <input data-builder-name="title" type="text" id="timeline-{{item-id}}-title" name="timeline[{{item-id}}][title]" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                ' . __( "Write your text here:","shootback" ) . '
                                            </td>
                                            <td>
                                                <textarea data-builder-name="text" name="timeline[{{item-id}}][text]" id="timeline-{{item-id}}-text" cols="51" rows="5"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>' . __( "Add image","shootback" ) . '</td>
                                            <td>
                                                <input type="text" name="timeline-{{item-id}}-image" id="timeline-{{item-id}}-image" value="" data-role="media-url" />
                                                <input type="hidden" id="slide_media_id-{{item-id}}" name="timeline_media_id-{{item-id}}" value=""  data-role="media-id" />
                                                <input type="button" id="uploader_{{item-id}}"  class="button button-primary" value="' . __( "Upload","shootback" ) . '" />
                                                <div id="image-preview-{{item-id}}"></div> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>'
                                                . __( 'Align image', 'shootback' ) .
                                            '</td>
                                            <td>
                                                <select data-builder-name="align" name="timeline[{{item-id}}][align]" id="timeline-{{item-id}}-align">
                                                    <option value="left">' . __('Left', 'shootback') .'</option>
                                                    <option value="right">' . __('Right', 'shootback' ) . '</option>
                                                </select>
                                                <div class="ts-option-description">'
                                                    . __('Align image', 'shootback') .
                                                '</div>
                                            </td>
                                        </tr>
                                    </table>
                                    <input type="hidden" data-builder-name="item_id" value="{{item-id}}" name="timeline[{{item-id}}][id]" />
                                    <input type="button" class="button button-primary remove-item" value="' . __('Remove', 'shootback') . '" />
                                    <a href="#" data-builder-name="timeline" data-element-name="timeline" data-item="timeline-item" data-increment="timeline-items" class="button button-primary ts-multiple-item-duplicate">' . __('Duplicate Item', 'shootback') . '</a>
                                </div>
                            </li>
                        </script>';
                ?>
            </div>

            <div class="ribbon builder-element hidden">
                <h3 class="element-title"><?php _e('Ribbon banner', 'shootback'); ?></h3>
                <p><?php _e( 'You can add ribbon banner form to page', 'shootback' ); ?></p>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <?php _e('Admin label:', 'shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="ribbon-admin-label" name="ribbon-amin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Title:', 'shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="ribbon-title" name="ribbon-title" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Text:', 'shootback'); ?>
                        </td>
                        <td>
                           <textarea id="ribbon-text" style="width:400px; height: 100px" name="ribbon-text"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Text color', 'shootback') ?>:
                        </td>
                        <td>
                           <input class="colors-section-picker" type="text" id="ribbon-text-color" name="ribbon-text-color" value="#FFFFFF"/>
                           <div class="colors-section-picker-div" id="ts-ribbon-text-color-picker"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Background ribbon banner color', 'shootback') ?>:
                        </td>
                        <td>
                           <input class="colors-section-picker" type="text" id="ribbon-background-color" name="ribbon-background" value="#FFFFFF"/>
                           <div class="colors-section-picker-div" id="ts-ribbon-background-color-picker"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Ribbon banner align', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="ribbon-align" id="ribbon-align">
                                <option value="ribbon-left"><?php _e('Left', 'shootback'); ?></option>
                                <option value="ribbon-right"><?php _e('Right', 'shootback'); ?></option>
                                <option value="ribbon-center"><?php _e('Center', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
                <p><?php _e('Choose your icon button from the library below:', 'shootback'); ?></p>
                <div class="builder-element-icon-toggle">
                    <a href="#" class="red-ui-button builder-element-icon-trigger-btn" data-toggle="#builder-element-ribbon-icon-selector"><?php _e('Show icons','shootback') ?></a>
                </div>
                <ul id="builder-element-ribbon-icon-selector" data-selector="#builder-element-ribbon-icon" class="builder-icon-list ts-custom-selector">
                    <?php echo $icons_li; ?>
                </ul>
                <select name="builder-element-ribbon-icon" id="builder-element-ribbon-icon" class="hidden">
                    <?php echo $icons_options; ?>
                </select>
                <table cellpadding="10">
                    <tr>
                        <td width="70px">
                            <?php _e('Button align', 'shootback'); ?>
                        </td>
                        <td>
                            <select name="ribbon-button-align" id="ribbon-button-align">
                                <option value="text-left"><?php _e('Left', 'shootback'); ?></option>
                                <option value="text-right"><?php _e('Right', 'shootback'); ?></option>
                                <option selected="selected" value="text-center"><?php _e('Center', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Text button', 'shootback') ?>
                        </td>
                        <td>
                           <input type="text" id="ribbon-button-text" name="ribbon-button-text" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('URL button', 'shootback') ?>:
                        </td>
                        <td>
                           <input type="text" id="ribbon-button-url" name="ribbon-button-url" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Target button', 'shootback') ?>:
                        </td>
                        <td>
                            <select name="ribbon-button-target" id="ribbon-button-target">
                                <option value="_blank" selected="selected"><?php _e('_blank', 'shootback'); ?></option>
                                <option value="_self"><?php _e('_self', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Size button', 'shootback') ?>:
                        </td>
                        <td>
                           <select name="ribbon-button-size" id="ribbon-button-size">
                               <option value="big"><?php _e('Big', 'shootback') ?></option>
                               <option value="medium" selected="selected"><?php _e('Medium', 'shootback') ?></option>
                               <option value="small"><?php _e('Small', 'shootback') ?></option>
                               <option value="xsmall"><?php _e('xSmall', 'shootback') ?></option>
                           </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Choose your mode to display:', 'shootback') ?>
                        </td>
                        <td>
                           <select name="ribbon-button-mode-dispaly" id="ribbon-button-mode-display">
                               <option value="border-button"><?php _e('Border button', 'shootback') ?></option>
                               <option value="background-button"><?php _e('Background button', 'shootback') ?></option>
                           </select>
                        </td>
                    </tr>
                    <tr class="ribbon-button-background-color">
                        <td>
                            <?php _e('Background button color', 'shootback') ?>:
                        </td>
                        <td>
                           <input class="colors-section-picker" type="text" id="ribbon-button-background-color" name="ribbon-button-background-color" value="#FFFFFF"/>
                           <div class="colors-section-picker-div" id="ts-ribbon-button-background-color-picker"></div>
                        </td>
                    </tr>
                    <tr class="ribbon-button-border-color">
                        <td>
                            <?php _e('Border color button', 'shootback') ?>:
                        </td>
                        <td>
                           <input class="colors-section-picker" type="text" id="ribbon-button-border-color" name="ribbon-button-border-color" value="#FFFFFF"/>
                           <div class="colors-section-picker-div" id="ts-ribbon-button-border-color-picker"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Button text color', 'shootback') ?>:
                        </td>
                        <td>
                           <input class="colors-section-picker" type="text" id="ribbon-button-text-color" name="ribbon-button-text-color" value="#333333"/>
                           <div class="colors-section-picker-div" id="ts-ribbon-button-text-color-picker"></div>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"><?php _e('Image', 'shootback'); ?></td>
                        <td>
                            <input type="text" value="" name="ribbon-image-url"  id="ribbon-attachment" style="width:300px" />
                            <input type="button" class="button-primary" id="ribbon-select-image" value="<?php _e('Upload image', 'shootback'); ?>" />
                            <input type="hidden" value="" class="image_media_id" id="ribbon-media-id" />
                            <div id="ribbon-image-preview"></div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="video-carousel builder-element hidden">
                <h3 class="element-title"><?php _e('Video carousel element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <?php _e('Admin label:', 'shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="video-carousel-admin-label" name="video-carousel-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td><?php _e('Slider source', 'shootback'); ?></td>
                        <td>
                            <select name="video-carousel-source" id="video-carousel-source">
                                <option value="latest-posts"><?php _e('Latest posts', 'shootback'); ?></option>
                                <option value="latest-galleries"><?php _e('Latest galleries', 'shootback'); ?></option>
                                <option value="latest-videos"><?php _e('Latest videos', 'shootback'); ?></option>
                                <option value="custom-slides"><?php _e('Custom slides', 'shootback'); ?></option>
                                <option value="latest-featured-posts"><?php _e('Latest featured posts', 'shootback'); ?></option>
                                <option value="latest-featured-galleries"><?php _e('Latest featured galleries', 'shootback'); ?></option>
                                <option value="latest-featured-videos"><?php _e('Latest featured videos', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="ts-video-carousel-custom"> 
                    <ul id="video-carousel_items">
                       
                    </ul>
                       
                    <input type="hidden" id="video-carousel_content" value="" />
                    <input type="button" class="button ts-multiple-add-button" data-element-name="video-carousel" id="video-carousel_add_item" value=" <?php _e('Add New Video Carousel', 'shootback'); ?>" />
                    <?php
                        echo '<script id="video-carousel_items_template" type="text/template">';
                        echo '<li id="list-item-id-{{item-id}}" class="video-carousel_item ts-multiple-add-list-element">
                                <div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="video-carousel-item-tab ts-multiple-item-tab">' . __('Item:', 'shootback') . ' {{slide-number}}</span></div>
                                <div class="hidden">
                                    <table>
                                        <tr>
                                            <td>
                                                ' . __('Enter your title here:', 'shootback') . '
                                            </td>
                                            <td>
                                               <input data-builder-name="title" type="text" id="video-carousel-{{item-id}}-title" name="video-carousel-[{{item-id}}][title]" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                ' . __('Enter your description here:', 'shootback') . '
                                            </td>
                                            <td>
                                                <textarea data-builder-name="text" id="video-carousel-{{item-id}}-text" name="video-carousel-[{{item-id}}][text] cols="45"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                ' . __('Enter your video url here:', 'shootback') . '
                                            </td>
                                            <td>
                                               <input data-builder-name="embed" type="text" id="video-carousel-{{item-id}}-embed" name="video-carousel-[{{item-id}}][embed]" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                ' . __('Enter your title url here:', 'shootback') . '
                                            </td>
                                            <td>
                                               <input data-builder-name="url" type="text" id="video-carousel-{{item-id}}-url" name="video-carousel-[{{item-id}}][url]" />
                                            </td>
                                        </tr>
                                    </table>
                                   <input type="hidden" data-builder-name="item_id" value="{{item-id}}" name="video-carousel[{{item-id}}][id]" />
                                   <input type="button" class="button button-primary remove-item" value="' . __('Remove', 'shootback') . '" />
                                   <a href="#" data-item="video-carousel_item" data-increment="video-carousel_items" class="button button-primary ts-multiple-item-duplicate">' . __('Duplicate Item', 'shootback') . '</a>
                                </div>
                            </li>';
                        echo '</script>';
                    ?>
                </div>
            </div>

            <!-- counter down -->

            <div class="count-down builder-element hidden">
                <h3 class="element-title"><?php _e('Counter down', 'shootback'); ?></h3>
                <p><?php _e( 'You can add counter down form to page', 'shootback' ); ?></p>
                <table>
                     <tr>
                        <td>
                            <?php _e('Admin label', 'shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="count-down-admin-label" name="count-down-amin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Style', 'shootback'); ?>
                        </td>
                        <td>
                           <select name="count-down-style" id="count-down-style">
                               <option value="small" selected="selected"><?php _e('Small', 'shootback'); ?></option>
                               <option value="big"><?php _e('Big', 'shootback'); ?></option>
                           </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Title', 'shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="count-down-title" name="count-down-title" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Date: (yyyy/mm/dd)', 'shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="count-down-date" name="count-down-date" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Time: (hh:mm)', 'shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="count-down-hours" name="count-down-hours" />
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Powerlink element -->
            <div class="powerlink builder-element hidden">
                <h3 class="element-title"><?php _e('Powerlink element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <?php _e('Admin label:', 'shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="powerlink-admin-label" name="powerlink-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Image URL:', 'shootback'); ?>
                        </td>
                        <td>
                           <input type="text" value="" name="image-powerlink-url"  id="image-powerlink-url" style="width:300px" />
                            <input type="button" class="button button-primary" id="select_powerlink_image" value="<?php _e('Upload', 'shootback'); ?>" />
                            <input type="hidden" value="" id="powerlink_image_media_id" />
                            <div id="powerlink-image-preview"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Title', 'shootback'); ?>
                        </td>
                        <td>
                            <input type="text" name="powerlink-title" id="powerlink-title" style="width:250px" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Button text', 'shootback'); ?>
                        </td>
                        <td>
                            <input type="text" name="powerlink-button-text" id="powerlink-button-text" style="width:250px" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Button url', 'shootback'); ?>
                        </td>
                        <td>
                            <input type="text" name="powerlink-button-url" id="powerlink-button-url" style="width:250px" value=""/>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- element event -->
            <div class="calendar builder-element hidden">
                <h3 class="element-title"><?php _e('Calendar element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <?php _e('Admin label','shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="calendar-admin-label" name="calendar-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Calendar cell size','shootback'); ?>
                        </td>
                        <td>
                           <select name="calendar-size" id="calendar-size">
                               <option value="big"><?php _e('Big', 'shootback'); ?></option>
                               <option value="small"><?php _e('Small', 'shootback'); ?></option>
                           </select>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="events builder-element hidden">
                <h3 class="element-title"><?php _e('Events element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <?php _e('Admin label','shootback');?>
                        </td>
                        <td>
                           <input type="text" id="events-admin-label" name="events-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <?php _e( 'Category', 'shootback' ); ?>
                        </td>
                        <td>                           
                            <select data-placeholder="<?php _e('Select your category', 'shootback'); ?>" class="ts-custom-select-input" name="events-category" id="events-category" multiple>
                                <?php $categories = get_categories(array( 'hide_empty' => 0, 'taxonomy' => 'event_categories' )); ?>
                                <?php if ( isset($categories) && is_array($categories) && !empty($categories) ): ?>
                                    <?php $i = 0; foreach ($categories as $index => $category): ?>
                                        <?php if( is_object($category) ) : ?>
                                            <?php if( $i == 0 ) echo '<option value="0">' . __('All', 'shootback') . '</option>'; ?>
                                            <option value="<?php if( is_object($category) ) echo $category->slug; ?>"><?php if( is_object($category) ) echo $category->cat_name; ?></option>
                                        <?php $i++; endif; ?>
                                    <?php endforeach ?>                                    
                                <?php endif ?>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose the categories that you want to showcase articles from.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Exclude post IDs', 'shootback' ); ?>
                        </td>
                        <td>
                            <input type="text" value="" name="events-exclude" id="events-exclude" size="4"/>
                            <div class="ts-option-description">
                                <?php _e('Insert the IDs of the posts you want to exclude from showing.', 'shootback'); ?> (ex: <b>100,101,102,104</b>)
                            </div>
                        </td>
                    </tr>
                    <tr class="events-exclude">
                        <td>
                            <label for="events-exclude-first"><?php _e( 'Exclude number of first posts', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="events-exclude-first" id="events-exclude-first" size="4"/>
                            <div class="ts-option-description">
                                <?php _e('Insert the number of the posts you want to exclude from showing.', 'shootback'); ?> 
                            </div>
                        </td>
                    </tr>
                    <tr class="events-nr-of-posts">
                        <td>
                            <?php _e( 'How many posts to extract:', 'shootback' ); ?>
                        </td>
                        <td>
                            <input type="text" value="" name="events-nr-of-posts" id="events-nr-of-posts" size="4"/>
                            <div class="ts-option-description">
                                <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Order by', 'shootback' ); ?>
                        </td>
                        <td>
                            <select name="events-order-by" id="events-order-by">
                                <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                <option value="start-date"><?php _e( 'Start date', 'shootback' ); ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Order direction', 'shootback' ); ?>
                        </td>
                        <td>
                            <select name="events-order-direction" id="events-order-direction">
                                <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                <option selected="selected" value="desc"><?php _e( 'DESC', 'shootback' ); ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Special effects', 'shootback' ); ?>
                        </td>
                        <td>
                            <select name="events-special-effects" id="events-special-effects">
                                <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Enable pagination', 'shootback' ); ?>
                        </td>
                        <td>
                            <select name="events-pagination" id="events-pagination">
                                <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('You can add pagination.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                </table>   
            </div>

            <div class="alert builder-element hidden">
                <h3 class="element-title"><?php _e('Alert element', 'shootback'); ?></h3>

                <p><?php _e('Choose your icon from the library below:', 'shootback'); ?></p>
                <div class="builder-element-icon-toggle">
                    <a href="#" class="red-ui-button builder-element-icon-trigger-btn" data-toggle="#alert-icon-selector"><?php _e('Show icons','shootback') ?></a>
                </div>    
                <ul id="alert-icon-selector" data-selector="#alert-icon" class="builder-icon-list ts-custom-selector">
                    <?php  echo $icons_li; ?>
                </ul>
                <select name="alert-icon" id="alert-icon" class="hidden">
                    <?php echo $icons_options; ?> 
                </select>

                <table cellpadding="10">
                    <tr>
                        <td>
                           <?php _e('Admin label','shootback');?>
                        </td>
                        <td>
                           <input type="text" id="alert-admin-label" name="alert-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Title','shootback');?>
                        </td>
                        <td>
                           <input type="text" id="alert-title" name="alert-title" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <?php _e('Text', 'shootback'); ?>
                        </td>
                        <td>
                            <textarea cols="50" rows="10" name="alert-text" id="alert-text"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Background color', 'shootback') ?>:
                        </td>
                        <td>
                            <input type="text" id="alert-background-color" class="colors-section-picker" value="#000" name="alert-background-color" />
                            <div class="colors-section-picker-div"></div>
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <?php _e('Text color', 'shootback') ?>:
                        </td>
                        <td>
                            <input type="text" id="alert-text-color" class="colors-section-picker" value="#000" name="alert-text-color" />
                            <div class="colors-section-picker-div"></div>
                        </td>
                    </tr>  
                </table>
            </div>

            <div class="skills builder-element hidden">
                <h3 class="element-title"><?php _e('Skills element', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                           <?php _e('Admin label','shootback');?>
                        </td>
                        <td>
                           <input type="text" id="skills-admin-label" name="skills-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <?php _e('Show:','shootback');?>
                        </td>
                        <td>
                            <select name="skills-display-mode" id="skills-display-mode">
                                <option value="horizontal"><?php _e('Horizontal skills', 'shootback'); ?></option>
                                <option value="vertical"><?php _e('Vertical skills', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>
                <ul id="skills_items">
                
                </ul>
                    
                <input type="hidden" id="skills_content" value="" />
                <input type="button" class="button ts-multiple-add-button" data-element-name="skills" id="skills_add_item" value=" <?php _e('Add New Horizontal skills', 'shootback'); ?>" />
                <?php
                     echo '<script id="skills_items_template" type="text/template">';
                     echo '<li id="list-item-id-{{item-id}}" class="tab-item ts-multiple-add-list-element">
                            <div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="tab-item-tab ts-multiple-item-tab">' . __('Horizontal skills', 'shootback') . ': {{slide-number}}</span></div>
                            <div class="hidden">
                                 <table>
                                    <tr>
                                        <td>
                                            ' . __('Title', 'shootback') . '
                                        </td>
                                         <td>
                                            <input data-builder-name="title" type="text" id="skills-{{item-id}}-title" name="skills[{{item-id}}][title]" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="skills-{{item-id}}-percentage">' . __('Percentage', 'shootback') . '</label>
                                        </td>
                                        <td>
                                            <input data-builder-name="percentage" type="text" id="skills-{{item-id}}-percentage" name="skills[{{item-id}}][percentage]"  />
                                            <div id="skills-{{item-id}}-percentage-slider"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            ' . __('Color', 'shootback') . '
                                        </td>
                                        <td>
                                            <input data-builder-name="color" type="text" value="#777" id="skills-{{item-id}}-color" class="colors-section-picker" name="skills[{{item-id}}][color]" />
                                            <div class="colors-section-picker-div" id="skills-{{item-id}}-color-picker"></div>
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" data-builder-name="item_id" value="{{item-id}}" name="skills[{{item-id}}][id]" />
                                <input type="button" class="button button-primary remove-item" value="' . __('Remove', 'shootback') . '" />
                                <a href="#" data-item="skills-item" data-increment="skills-items" class="button button-primary ts-multiple-item-duplicate">'.__('Duplicate horizontal skill', 'shootback').'</a>
                            </div>
                         </li>';
                     echo '</script>';
                ?>
            </div>

            <div class="accordion builder-element hidden">
                <h3 class="element-title"><?php _e('Article accordion element', 'shootback'); ?></h3>
                
                <table cellpadding="10">
                    <tr>
                        <td>
                            <?php _e('Admin label:','shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="accordion-admin-label" name="accordion-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('Select post type','shootback'); ?>
                        </td>
                        <td>
                            <select name="accordion-posts-type" id="accordion-posts-type">
                                <option value="event"><?php _e('Events', 'shootback'); ?></option>
                                <option value="video"><?php _e('Video', 'shootback'); ?></option>
                                <option value="post"><?php _e('Posts', 'shootback'); ?></option>
                                <option value="ts-gallery"><?php _e('Gallery', 'shootback'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <?php
                    $accordion_post_types = array('event', 'video', 'post', 'ts_teams', 'ts-gallery');
                    $acc_exclude_taxonomies = array('post_tag', 'post_format');

                    foreach($accordion_post_types as $acc_post_type) : 
                        if( $acc_post_type !== 'post' ){
                            $acc_taxonomies = get_object_taxonomies($acc_post_type);
                            foreach($acc_taxonomies as $acc_taxonomy){
                                if( !in_array($acc_taxonomy, $acc_exclude_taxonomies) ){
                                    $taxonomy = $acc_taxonomy;
                                }
                            }
                        }?>
                    
                        <tr class="ts-accordion-category-<?php echo $acc_post_type ?> ts-accordion-category">
                            <td valign="top">
                                <?php echo  _e('Category', 'shootback' ) . ' ' . $post_types[$acc_post_type]->labels->name; ?>
                            </td>
                            <td>                           
                                <select data-placeholder="<?php _e('Select your category', 'shootback'); ?>" class="ts-custom-select-input" name="accordion-<?php echo $acc_post_type ?>-category" id="accordion-<?php echo $acc_post_type ?>-category" multiple>
                                    <?php if( $acc_post_type !== 'post' ) $categories = get_categories(array( 'hide_empty' => 0, 'taxonomy' => $taxonomy )); else $categories = get_categories(array( 'hide_empty' => 0, 'taxonomy' => 'category', 'type' => 'post')); ?>
                                    <?php if ( isset($categories) && is_array($categories) && !empty($categories) ): ?>
                                        <?php $i = 0; foreach ($categories as $index => $category): ?>
                                            <?php if( is_object($category) ) : ?>
                                                <?php if( $i == 0 ) echo '<option value="0">' . __('All', 'shootback') . '</option>'; ?>
                                                <option value="<?php if( is_object($category) ) echo $category->slug; ?>"><?php if( is_object($category) ) echo $category->cat_name; ?></option>
                                            <?php $i++; endif; ?>
                                        <?php endforeach ?>                                    
                                    <?php endif ?>
                                </select>
                            </td>
                        </tr>
                        <script>
                        jQuery(document).ready(function(){
                            ts_select_all_general('#accordion-<?php echo $acc_post_type ?>-category');
                        });
                        </script>
                    <?php endforeach; ?>
                    <tr class="ts-accordion-featured">
                        <td>
                            <label><?php _e( 'Show only featured', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="accordion-featured" id="accordion-featured">
                                <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                <option value="n" selected="selected"><?php _e( 'No', 'shootback' ); ?></option>
                            </select>

                            <div class="ts-option-description">
                                <?php _e('You can display only featured posts', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e('How many posts to extract','shootback'); ?>
                        </td>
                        <td>
                           <input type="text" id="accordion-nr-of-posts" name="accordion-nr-of-posts" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Order by', 'shootback' ); ?>
                        </td>
                        <td>
                            <select name="accordion-order-by" id="accordion-order-by">
                                <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Order direction', 'shootback' ); ?>
                        </td>
                        <td>
                            <select name="accordion-order-direction" id="accordion-order-direction">
                                <option value="ASC"><?php _e( 'ASC', 'shootback' ); ?></option>
                                <option value="DESC" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="chart builder-element hidden">
                <h3 class="element-title"><?php _e('Chart element', 'shootback'); ?></h3>
                <?php if ( fields::get_options_value('shootback_optimization', 'include_chart') == 'y' ) : ?>
                    <table cellpadding="10">
                        <tr>
                            <td>
                                <?php _e('Admin label:','shootback'); ?>
                            </td>
                            <td>
                               <input type="text" id="chart-admin-label" name="chart-admin-label" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php _e('Select mode to display chart','shootback'); ?>
                            </td>
                            <td>
                               <select name="chart-mode" id="chart-mode">
                                   <option value="line"><?php _e('Line chart', 'shootback'); ?></option>
                                   <option value="pie"><?php _e('Pie chart', 'shootback'); ?></option>
                               </select>
                            </td>
                        </tr>
                    </table>
                    <!-- Line chart options -->
                    <div class="chart-line-options">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <?php _e('Labels in format "label1,label2,label3,..."', 'shootback') ?>
                                </td>
                                 <td>
                                    <input type="text" id="chart-label" name="chart-label" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Title', 'shootback'); ?>
                                </td>
                                 <td>
                                    <input value="" type="text" id="chart-title" name="chart-title" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Show lines across the chart', 'shootback'); ?>
                                </td>
                                <td>
                                    <select id="chart-scaleShowGridLines" name="chart-scaleShowGridLines">
                                        <option selected="selected" value="true"><?php _e('Yes', 'shootback'); ?></option>
                                        <option value="false"><?php _e('No', 'shootback'); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Colour of the grid lines', 'shootback'); ?>
                                </td>
                                <td>
                                    <input type="text" value="#f7f7f7" id="chart-scaleGridLineColor" class="colors-section-picker" name="chart-scaleGridLineColor" />
                                    <div class="colors-section-picker-div"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Width of the grid lines (INTEGER)', 'shootback'); ?>
                                </td>
                                <td>
                                    <input type="text" id="chart-scaleGridLineWidth" value="1" name="chart-scaleGridLineWidth" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Show horizontal lines (except X axis)', 'shootback'); ?>
                                </td>
                                <td>
                                    <select id="chart-scaleShowHorizontalLines" name="chart-scaleShowHorizontalLines">
                                        <option selected="selected" value="true"><?php _e('Yes', 'shootback'); ?></option>
                                        <option value="false"><?php _e('No', 'shootback'); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Show vertical lines (except Y axis)', 'shootback'); ?>
                                </td>
                                <td>
                                    <select id="chart-scaleShowVerticalLines" name="chart-scaleShowVerticalLines">
                                        <option selected="selected" value="true"><?php _e('Yes', 'shootback'); ?></option>
                                        <option value="false"><?php _e('No', 'shootback'); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('The line is curved between points', 'shootback'); ?>
                                </td>
                                <td>
                                    <select id="chart-bezierCurve" name="chart-bezierCurve">
                                        <option selected="selected" value="true"><?php _e('Yes', 'shootback'); ?></option>
                                        <option value="false"><?php _e('No', 'shootback'); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Tension of the bezier curve between points (0.1 - 1)', 'shootback'); ?>
                                </td>
                                <td>
                                    <input type="text" value="0.4" id="chart-bezierCurveTension" name="chart-bezierCurveTension" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Show a dot for each point', 'shootback'); ?>
                                </td>
                                <td>
                                    <select id="chart-pointDot" name="chart-pointDot">
                                        <option selected="selected" value="true"><?php _e('Yes', 'shootback'); ?></option>
                                        <option value="false"><?php _e('No', 'shootback'); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Radius of each point dot in pixels (INTEGER)', 'shootback'); ?>
                                </td>
                                <td>
                                    <input type="text" id="chart-pointDotRadius" value="4" name="chart-pointDotRadius" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Pixel width of point dot stroke (INTEGER)', 'shootback'); ?>
                                </td>
                                <td>
                                    <input type="text" id="chart-pointDotStrokeWidth" value="1" name="chart-pointDotStrokeWidth" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Amount extra to add to the radius to cater for hit detection outside the drawn point (INTEGER)', 'shootback', 'shootback'); ?>
                                </td>
                                <td>
                                    <input type="text" id="chart-pointHitDetectionRadius" value="20" name="chart-pointHitDetectionRadius" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Show a stroke for datasets', 'shootback'); ?>
                                </td>
                                <td>
                                    <select id="chart-datasetStroke" name="chart-datasetStroke">
                                        <option selected="selected" value="true"><?php _e('Yes', 'shootback'); ?></option>
                                        <option value="false"><?php _e('No', 'shootback'); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Pixel width of dataset stroke (INTEGER)', 'shootback'); ?>
                                </td>
                                <td>
                                    <input type="text" id="chart-datasetStrokeWidth" value="2" name="chart-datasetStrokeWidth" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Fill the dataset with a colour', 'shootback'); ?>
                                </td>
                                <td>
                                    <select id="chart-datasetFill" name="chart-datasetFill">
                                        <option selected="selected" value="true"><?php _e('Yes', 'shootback'); ?></option>
                                        <option value="false"><?php _e('No', 'shootback'); ?></option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <ul id="chart_line_items">
                        
                        </ul>
                            
                        <input type="hidden" id="chart_line_content" value="" />
                        <input type="button" class="button ts-multiple-add-button" data-element-name="chart_line" id="chart_line_add_item" value=" <?php _e('Add New Line', 'shootback'); ?>" />
                        <?php
                            echo '<script id="chart_line_items_template" type="text/template">';
                            echo '<li id="list-item-id-{{item-id}}" class="tab-item ts-multiple-add-list-element">
                                    <div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="tab-item-tab ts-multiple-item-tab">' . __('Line', 'shootback') . ': {{slide-number}}</span></div>
                                    <div class="hidden">
                                        <table>
                                            <tr>
                                                <td>
                                                    ' . __('Title', 'shootback') . '
                                                </td>
                                                 <td>
                                                    <input data-option-name="title" value="" type="text" id="chart_line-{{item-id}}-title" name="chart_line[{{item-id}}][title]" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ' . __('Fill color', 'shootback') . '
                                                </td>
                                                <td>
                                                    <input data-option-name="fillColor" type="text" value="#ffffff" id="chart_line-{{item-id}}-fillColor" name="chart_line[{{item-id}}][fillColor]" class="colors-section-picker" />
                                                    <div class="colors-section-picker-div"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ' . __('Stroke color', 'shootback') . '
                                                </td>
                                                <td>
                                                    <input data-option-name="strokeColor" type="text" value="#ffffff" id="chart_line-{{item-id}}-strokeColor" name="chart_line[{{item-id}}][strokeColor]" class="colors-section-picker" />
                                                    <div class="colors-section-picker-div"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ' . __('Point color', 'shootback') . '
                                                </td>
                                                <td>
                                                    <input data-option-name="pointColor" type="text" value="#ffffff" id="chart_line-{{item-id}}-pointColor" name="chart_line[{{item-id}}][pointColor]" class="colors-section-picker" />
                                                    <div class="colors-section-picker-div"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ' . __('Point stroke color', 'shootback') . '
                                                </td>
                                                <td>
                                                    <input data-option-name="pointStrokeColor" type="text" value="#ffffff" id="chart_line-{{item-id}}-pointStrokeColor" name="chart_line[{{item-id}}][pointStrokeColor]" class="colors-section-picker" />
                                                    <div class="colors-section-picker-div"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ' . __('Point highlight fill', 'shootback') . '
                                                </td>
                                                <td>
                                                    <input data-option-name="pointHighlightFill" type="text" value="#777" id="chart_line-{{item-id}}-pointHighlightFill" name="chart_line[{{item-id}}][pointHighlightFill]" class="colors-section-picker" />
                                                    <div class="colors-section-picker-div"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ' . __('Point highlight stroke', 'shootback') . '
                                                </td>
                                                <td>
                                                    <input data-option-name="pointHighlightStroke" type="text" value="#ffffff" id="chart_line-{{item-id}}-pointHighlightStroke" name="chart_line[{{item-id}}][pointHighlightStroke]" class="colors-section-picker" />
                                                    <div class="colors-section-picker-div"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ' . __('Data in format 25,35,45,...', 'shootback') . '
                                                </td>
                                                <td>
                                                    <input data-option-name="data" type="text" value="" id="chart_line-{{item-id}}-data" name="chart_line[{{item-id}}][data]" class="colors-section-picker" />
                                                </td>
                                            </tr>
                                        </table>
                                        <input type="hidden" data-option-name="item_id" value="{{item-id}}" name="chart_line[{{item-id}}][id]" />
                                        <input type="button" class="button button-primary remove-item" value="' . __('Remove', 'shootback') . '" />
                                        <a href="#" data-item="chart_line-item" data-increment="chart_line-items" class="button button-primary ts-multiple-item-duplicate">'.__('Duplicate line', 'shootback').'</a>
                                    </div>
                                 </li>';
                            echo '</script>';
                        ?>
                    </div>
                    <!-- Pie chart options -->
                    <div class="chart-pie-options">
                        <table>
                            <tr>
                                <td>
                                    <?php _e('Show a stroke on each segment', 'shootback'); ?>
                                </td>
                                <td>
                                    <select id="chart-segmentShowStroke" name="chart-segmentShowStroke">
                                        <option selected="selected" value="true"><?php _e('Yes', 'shootback'); ?></option>
                                        <option value="false"><?php _e('No', 'shootback'); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('The colour of each segment stroke', 'shootback'); ?>
                                </td>
                                <td>
                                    <input type="text" value="#777" id="chart-segmentStrokeColor" class="colors-section-picker" name="chart-segmentStrokeColor" />
                                    <div class="colors-section-picker-div"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('The width of each segment stroke (INTEGER)', 'shootback'); ?>
                                </td>
                                <td>
                                    <input type="text" value="2" id="chart-segmentStrokeWidth" name="chart-segmentStrokeWidth" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('The percentage of the chart that we cut out of the middle (INTEGER)', 'shootback'); ?>
                                </td>
                                <td>
                                    <input type="text" value="0" id="chart-percentageInnerCutout" name="chart-percentageInnerCutout" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Amount of animation steps (INTEGER)', 'shootback'); ?>
                                </td>
                                <td>
                                    <input type="text" value="100" id="chart-animationSteps" name="chart-animationSteps" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Animate the rotation of the Doughnut', 'shootback'); ?>
                                </td>
                                <td>
                                    <select id="chart-animateRotate" name="chart-animateRotate">
                                        <option selected="selected" value="true"><?php _e('Yes', 'shootback'); ?></option>
                                        <option value="false"><?php _e('No', 'shootback'); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e('Animate scaling the Doughnut from the centre', 'shootback'); ?>
                                </td>
                                <td>
                                    <select id="chart-animateScale" name="chart-animateScale">
                                        <option value="true"><?php _e('Yes', 'shootback'); ?></option>
                                        <option selected="selected" value="false"><?php _e('No', 'shootback'); ?></option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <ul id="chart_pie_items">
                                        
                        </ul>
                            
                        <input type="hidden" id="chart_pie_content" value="" />
                        <input type="button" class="button ts-multiple-add-button" data-element-name="chart_pie" id="chart_pie_add_item" value=" <?php _e('Add New Pie', 'shootback'); ?>" />
                        <?php
                            echo '<script id="chart_pie_items_template" type="text/template">';
                            echo '<li id="list-item-id-{{item-id}}" class="tab-item ts-multiple-add-list-element">
                                    <div class="sortable-meta-element"><span class="tab-arrow icon-down"></span> <span class="tab-item-tab ts-multiple-item-tab">' . __('Pie', 'shootback') . ': {{slide-number}}</span></div>
                                    <div class="hidden">
                                        <table>
                                            <tr>
                                                <td>
                                                    ' . __('Label', 'shootback') . '
                                                </td>
                                                <td>
                                                    <input data-option-name="title" type="text" value="" id="chart_pie-{{item-id}}-title" name="chart_pie[{{item-id}}][title]" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ' . __('Value (INTEGER)', 'shootback') . '
                                                </td>
                                                <td>
                                                    <input data-option-name="value" type="text" value="" id="chart_pie-{{item-id}}-value" name="chart_pie[{{item-id}}][value]" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ' . __('Color section', 'shootback') . '
                                                </td>
                                                <td>
                                                    <input data-option-name="color" type="text" value="#777" id="chart_pie-{{item-id}}-color" class="colors-section-picker" name="chart_pie[{{item-id}}][color]" />
                                                    <div class="colors-section-picker-div"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ' . __('Hover color', 'shootback') . '
                                                </td>
                                                <td>
                                                    <input data-option-name="highlight" type="text" value="#777" id="chart_pie-{{item-id}}-highlight" class="colors-section-picker" name="chart_pie[{{item-id}}][highlight]" />
                                                    <div class="colors-section-picker-div"></div>
                                                </td>
                                            </tr>
                                        </table>
                                        <input type="hidden" data-option-name="item_id" value="{{item-id}}" name="chart_pie[{{item-id}}][id]" />
                                        <input type="button" class="button button-primary remove-item" value="' . __('Remove', 'shootback') . '" />
                                        <a href="#" data-item="chart_pie-item" data-increment="chart_pie-items" class="button button-primary ts-multiple-item-duplicate">'.__('Duplicate pie', 'shootback').'</a>
                                    </div>
                                 </li>';
                            echo '</script>';
                        ?>
                    </div>
                <?php else : ?>
                    <p><?php _e( 'You most enable this option in', 'shootback' ); ?> <strong><a target="_blank" href="<?php echo admin_url( 'admin.php?page=shootback&tab=optimization' ) ?>"><?php _e( 'Shootback -- Optimization', 'shootback' ); ?></a></strong></p>
                <?php endif; ?>
            </div>

            <div class="list-galleries builder-element hidden">
                <h3 class="element-title"><?php _e('List posts element','shootback');?></h3>
                <!-- Select category -->
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="list-galleries-admin-label"><?php _e('Admin label','shootback');?>:</label>
                        </td>
                        <td>
                           <input type="text" id="list-galleries-admin-label" name="list-galleries-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <label for="list-galleries-category"><?php _e( 'Category', 'shootback' ); ?>:</label>
                        </td>
                        <td>                           
                            <select data-placeholder="<?php _e('Select your category', 'shootback'); ?>" class="ts-custom-select-input" name="list-galleries-category" id="list-galleries-category" multiple>
                                <?php $categories = get_categories(array( 'hide_empty' => 0, 'show_option_all' => '', 'taxonomy' => 'gallery_categories' )); ?>
                                <?php if ( isset($categories) && is_array($categories) && !empty($categories) ) : ?>
                                    <?php $i = 1; foreach ($categories as $index => $category): ?>
                                        <?php if( is_object($category) ) : ?>
                                            <?php if( $i === 1 ) echo '<option value="0">' . __('All', 'shootback') . '</option>'; ?>
                                            <option value="<?php echo $category->slug ?>"><?php echo $category->cat_name ?></option>
                                        <?php endif; $i++; ?>
                                    <?php endforeach ?>                                    
                                <?php endif ?>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose the categories that you want to showcase articles from.', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label><?php _e( 'Show only featured', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="list-galleries-featured" id="list-galleries-featured">
                                <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                <option value="n" selected="selected"><?php _e( 'No', 'shootback' ); ?></option>
                            </select>

                            <div class="ts-option-description">
                                <?php _e('You can display only featured posts', 'shootback'); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="list-galleries-exclude"><?php _e( 'Exclude post IDs', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="list-galleries-exclude" id="list-galleries-exclude" size="4"/>
                            <div class="ts-option-description">
                                <?php _e('Insert the IDs of the posts you want to exclude from showing.', 'shootback'); ?> (ex: <b>100,101,102,104</b>)
                            </div>
                        </td>
                    </tr>
                     <tr class="list-galleries-exclude">
                        <td>
                            <label for="list-galleries-exclude-first"><?php _e( 'Exclude number of first posts', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <input type="text" value="" name="list-galleries-exclude-first" id="list-galleries-exclude-first" size="4"/>
                            <div class="ts-option-description">
                                <?php _e('Insert the number of the posts you want to exclude from showing.', 'shootback'); ?> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="list-galleries-display-mode"><?php _e( 'How to display', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-galleries-display-mode" id="list-galleries-display-mode-selector">
                               <li><img class="image-radio-input clickable-element" data-option="grid" src="<?php echo get_template_directory_uri().'/images/options/grid_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="list" src="<?php echo get_template_directory_uri().'/images/options/list_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="thumbnails" src="<?php echo get_template_directory_uri().'/images/options/thumb_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="big-post" src="<?php echo get_template_directory_uri().'/images/options/big_posts_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="super-post" src="<?php echo get_template_directory_uri().'/images/options/super_post_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="timeline" src="<?php echo get_template_directory_uri().'/images/options/timeline_view.png'; ?>"></li>
                               <li><img class="image-radio-input clickable-element" data-option="mosaic" src="<?php echo get_template_directory_uri().'/images/options/mosaic_view.png'; ?>"></li>
                            </ul>
                            <select class="select_2" class="hidden" name="list-galleries-display-mode" id="list-galleries-display-mode">
                                <option value="grid"><?php _e( 'Grid', 'shootback' ); ?></option>
                                <option value="list"><?php _e( 'List', 'shootback' ); ?></option>
                                <option value="thumbnails"><?php _e( 'Thumbnails', 'shootback' ); ?></option>
                                <option value="big-post"><?php _e( 'Big post', 'shootback' ); ?></option>
                                <option value="super-post"><?php _e( 'Super Post', 'shootback' ); ?></option>
                                <option value="timeline"><?php _e( 'Timeline Post', 'shootback' ); ?></option>
                                <option value="mosaic"><?php _e( 'mosaic Post', 'shootback' ); ?></option>
                            </select>
                            <div class="ts-option-description">
                                <?php _e('Choose your article view type. Depending on what type of article showcase layout you select you will get different options. You can read more about view types in our documentation files: ', 'shootback'); echo $touchsize_com; ?>
                            </div>
                        </td>
                    </tr>
                </table>

                <div id="list-galleries-display-mode-options">
                    <!-- Grid options -->
                    <div class="list-galleries-grid hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label><?php _e( 'Behavior', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-galleries-grid-behavior" id="list-galleries-grid-behavior-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="none" src="<?php echo get_template_directory_uri().'/images/options/behavior_none.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="carousel" src="<?php echo get_template_directory_uri().'/images/options/behavior_carousel.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="masonry" src="<?php echo get_template_directory_uri().'/images/options/behavior_masonry.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="scroll" src="<?php echo get_template_directory_uri().'/images/options/behavior_scroll.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="tabbed" src="<?php echo get_template_directory_uri().'/images/options/behavior_tabs.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-galleries-grid-behavior" id="list-galleries-grid-behavior">
                                        <option value="none"><?php _e( 'Normal', 'shootback' ); ?></option>
                                        <option value="carousel"><?php _e( 'Carousel', 'shootback' ); ?></option>
                                        <option value="masonry"><?php _e( 'Masonry', 'shootback' ); ?></option>
                                        <option value="scroll"><?php _e( 'Scroll', 'shootback' ); ?></option>
                                        <option value="tabbed"><?php _e( 'Tabbed', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your posts behavior - you can have them just shown, or you can activate the carousel. If carousel is selected your articles will show up in a line with arrows for navigation. If masonry bahevior is selected - your articles will be arranged in to fit it. Be aware that activating the masonry option the crop settings for image sizes tab will be overwritten.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-grid-image"><?php _e( 'Show featured image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-grid-image" id="list-galleries-grid-image">
                                        <option selected="selected" value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-grid-title"><?php _e( 'Title position', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-galleries-grid-title" id="list-galleries-grid-title-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="title-above-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_image.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="title-below-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_excerpt.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-galleries-grid-title" id="list-galleries-grid-title">
                                        <option value="title-above-image"><?php _e( 'Above image', 'shootback' ); ?></option>
                                        <option value="title-below-image" selected="selected"><?php _e( 'Above excerpt', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Select your title position for you grid posts. You can either have it above the image of above the excerpt. Note that sometimes title may change the position of the meta (date, categories, author) as well.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-grid-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="list-galleries-grid-show-meta" id="list-galleries-grid-show-meta-y" value="y" /> 
                                    <label for="list-galleries-grid-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" checked = "checked" name="list-galleries-grid-show-meta" id="list-galleries-grid-show-meta-n" value="n" />
                                    <label for="list-galleries-grid-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-grid-el-per-row"><?php _e( 'Elements per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-galleries-grid-el-per-row" id="list-galleries-grid-el-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-galleries-grid-el-per-row" id="list-galleries-grid-el-per-row">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-galleries-grid-nr-of-posts">
                                <td>
                                    <label for="list-galleries-grid-nr-of-posts"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-galleries-grid-nr-of-posts" id="list-galleries-grid-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-grid-related"><?php _e( 'Show related posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-grid-related" id="list-galleries-grid-related">
                                        <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option selected="selected" value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can set each of your big posts to show related articles below. A list with other articles will appear below.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-grid-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-grid-order-by" id="list-galleries-grid-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-grid-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-grid-order-direction" id="list-galleries-grid-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-grid-special-effects"><?php _e( 'Special effects', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-grid-special-effects" id="list-galleries-grid-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-galleries-grid-pagination">
                                <td>
                                    <label for="list-galleries-grid-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-grid-pagination" id="list-galleries-grid-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- List options -->
                    <div class="list-galleries-list hidden">

                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-galleries-list-image"><?php _e( 'Show featured image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-list-image" id="list-galleries-list-image">
                                        <option selected="selected" value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-list-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="list-galleries-list-show-meta" id="list-galleries-list-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="list-galleries-list-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-galleries-list-show-meta" id="list-galleries-list-show-meta-n" value="n" />
                                    <label for="list-galleries-list-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-galleries-list-nr-of-posts">
                                <td>
                                    <label for="list-galleries-list-nr-of-posts"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-galleries-list-nr-of-posts" id="list-galleries-list-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e( 'Content split', 'shootback' ); ?>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-galleries-list-image-split" id="list-galleries-list-image-split-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1-3" src="<?php echo get_template_directory_uri().'/images/options/list_view_13.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="1-2" src="<?php echo get_template_directory_uri().'/images/options/list_view_12.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3-4" src="<?php echo get_template_directory_uri().'/images/options/list_view_34.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-galleries-list-image-split" id="list-galleries-list-image-split">
                                        <option value="1-3">1/3</option>
                                        <option value="1-2">1/2</option>
                                        <option value="3-4">3/4</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your title/content split proportions. You can have them either 1/3, 1/2, 3/4 for your title and 2/3,1/2, 1/4 accordingly. Depending on the text and titles you use, select your split type.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-list-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-list-order-by" id="list-galleries-list-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-list-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-list-order-direction" id="list-galleries-list-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-list-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-galleries-list-special-effects" id="list-galleries-list-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-list-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-list-pagination" id="list-galleries-list-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Thumbnail options -->
                    <div class="list-galleries-thumbnails hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-galleries-thumbnail-title"><?php _e( 'Title position', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-thumbnail-title" id="list-galleries-thumbnail-title">
                                        <option value="over-image" selected="selected"><?php _e( 'Over image', 'shootback' ); ?></option>
                                        <option value="below-image"><?php _e( 'Below image', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><?php _e( 'Behavior', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-galleries-thumbnails-behavior" id="list-galleries-thumbnails-behavior-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="none" src="<?php echo get_template_directory_uri().'/images/options/behavior_none.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="carousel" src="<?php echo get_template_directory_uri().'/images/options/behavior_carousel.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="masonry" src="<?php echo get_template_directory_uri().'/images/options/behavior_masonry.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="scroll" src="<?php echo get_template_directory_uri().'/images/options/behavior_scroll.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="tabbed" src="<?php echo get_template_directory_uri().'/images/options/behavior_tabs.png'; ?>"></li>
                                    </ul>
                                    <select name="list-galleries-thumbnails-behavior" id="list-galleries-thumbnails-behavior">
                                        <option value="none"><?php _e( 'Normal', 'shootback' ); ?></option>
                                        <option value="carousel"><?php _e('Carousel', 'shootback') ?></option>
                                        <option value="masonry"><?php _e('Masonry', 'shootback') ?></option>
                                        <option value="scroll"><?php _e('Scroll', 'shootback') ?></option>
                                        <option value="tabbed"><?php _e( 'Tabbed', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your posts behavior - you can have them just shown, or you can activate the carousel. If carousel is selected your articles will show up in a line with arrows for navigation. If masonry bahevior is selected - your articles will be arranged in to fit it. Be aware that activating the masonry option the crop settings for image sizes tab will be overwritten.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-thumbnail-posts-per-row"><?php _e( 'Number of posts per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-galleries-thumbnail-posts-per-row" id="list-galleries-thumbnail-posts-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="4" src="<?php echo get_template_directory_uri().'/images/options/per_row_4.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="6" src="<?php echo get_template_directory_uri().'/images/options/per_row_6.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-galleries-thumbnail-posts-per-row" id="list-galleries-thumbnail-posts-per-row">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3" selected="selected">3</option>
                                        <option value="4">4</option>
                                        <option value="6">6</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-galleries-thumbnails-nr-of-posts">
                                <td>
                                    <label for="list-galleries-thumbnail-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-galleries-thumbnail-limit"  id="list-galleries-thumbnail-limit" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    <label for="list-galleries-thumbnail-show-meta"><?php _e( 'Show meta:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="list-galleries-thumbnail-show-meta" id="list-galleries-thumbnail-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="list-galleries-thumbnail-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-galleries-thumbnail-show-meta" id="list-galleries-thumbnail-show-meta-n" value="n" />
                                    <label for="list-galleries-thumbnail-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-thumbnail-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-thumbnail-order-by" id="list-galleries-thumbnail-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-thumbnail-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-thumbnail-order-direction" id="list-galleries-thumbnails-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-thumbnail-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-galleries-thumbnail-special-effects" id="list-galleries-thumbnail-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale' , 'shootback') ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-thumbnail-gutter"><?php _e( 'Remove gutter(space) between articles:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-galleries-thumbnail-gutter" id="list-galleries-thumbnail-gutter">
                                        <option value="n"><?php _e('No', 'shootback') ?></option>
                                        <option value="y"><?php _e('Yes', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Gutter is the space between your articles. You can remove the space and have your articles sticked one to another.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-galleries-thumbnails-pagination">
                                <td>
                                    <label for="list-galleries-thumbnails-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-thumbnails-pagination" id="list-galleries-thumbnails-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="list-galleries-big-post hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-galleries-big-post-image"><?php _e( 'Show featured image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-big-post-image" id="list-galleries-big-post-image">
                                        <option selected="selected" value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-big-post-carousel"><?php _e( 'Show carousel', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-galleries-big-post-carousel" id="list-galleries-big-post-carousel">
                                        <option value="y"><?php _e('Yes', 'shootback') ?></option>
                                        <option selected="selected" value="n"><?php _e('No', 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-big-post-excerpt"><?php _e( 'Show excerpt', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-galleries-big-post-excerpt" id="list-galleries-big-post-excerpt">
                                        <option selected="selected" value="y"><?php _e('Yes', 'shootback') ?></option>
                                        <option value="n"><?php _e('No', 'shootback') ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-big-post-title"><?php _e( 'Title position:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-galleries-big-post-title" id="list-galleries-big-post-title-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="title-above-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_image.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="title-below-image" src="<?php echo get_template_directory_uri().'/images/options/grid_view_title_excerpt.png'; ?>"></li>
                                    </ul>
                                    <select name="list-galleries-big-post-title" id="list-galleries-big-post-title">
                                        <option value="title-above-image"><?php _e( 'Above image', 'shootback' ); ?></option>
                                        <option selected="selected" value="title-below-image"><?php _e( 'Above excerpt', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Select your title position for you grid posts. You can either have it above the image of above the excerpt. Note that sometimes title may change the position of the meta (date, categories, author) as well.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-big-post-image-position"><?php _e( 'Image position:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-galleries-big-post-image-position" id="list-galleries-big-post-image-position">
                                        <option value="left"><?php _e( 'Left', 'shootback' ); ?></option>
                                        <option value="right"><?php _e( 'Right', 'shootback' ); ?></option>
                                        <option value="mosaic"><?php _e( 'Mosaic', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('The way you want the big posts to be shown', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-big-post-show-meta"><?php _e( 'Show meta:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="list-galleries-big-post-show-meta" id="list-galleries-big-post-show-meta-y" value="y" checked = "checked" /> 
                                    <label for="list-galleries-big-post-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-galleries-big-post-show-meta" id="list-galleries-big-post-show-meta-n" value="n"/>
                                    <label for="list-galleries-big-post-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-galleries-big-post-nr-of-posts">
                                <td>
                                    <label for="list-galleries-big-post-nr-of-posts"><?php _e( 'How many posts to extract:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-galleries-big-post-nr-of-posts" id="list-galleries-big-post-nr-of-posts" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php _e( 'Content split', 'shootback' ); ?>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-galleries-big-post-image-split" id="list-galleries-big-post-image-split-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1-3" src="<?php echo get_template_directory_uri().'/images/options/big_posts_13.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="1-2" src="<?php echo get_template_directory_uri().'/images/options/big_posts_12.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3-4" src="<?php echo get_template_directory_uri().'/images/options/big_posts_34.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-galleries-big-post-image-split" id="list-galleries-big-post-image-split">
                                        <option value="1-3">1/3</option>
                                        <option value="1-2">1/2</option>
                                        <option value="3-4">3/4</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your image/content split proportions. You can have them either 1/3, 1/2, 3/4 for your title and 2/3,1/2, 1/4 accordingly. Depending on the text and titles you use, select your split type.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-big-post-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-big-post-order-by" id="list-galleries-big-post-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-big-post-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-big-post-order-direction" id="list-galleries-big-post-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="desc"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-big-post-related"><?php _e( 'Show related posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-big-post-related" id="list-galleries-big-post-related">
                                        <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option selected="selected" value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can set each of your big posts to show related articles below. A list with other articles will appear below.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-big-post-special-effects"><?php _e( 'Special effects', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-big-post-special-effects" id="list-galleries-big-post-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-galleries-big-post-pagination">
                                <td>
                                    <label for="list-galleries-big-post-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-big-post-pagination" id="list-galleries-big-post-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="list-galleries-super-post hidden">
                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-galleries-super-post-posts-per-row"><?php _e( 'Number of posts per row', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <ul class="imageRadioMetaUl perRow-3 ts-custom-selector" data-selector="#list-galleries-super-post-posts-per-row" id="list-galleries-super-post-posts-per-row-selector">
                                       <li><img class="image-radio-input clickable-element" data-option="1" src="<?php echo get_template_directory_uri().'/images/options/per_row_1.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="2" src="<?php echo get_template_directory_uri().'/images/options/per_row_2.png'; ?>"></li>
                                       <li><img class="image-radio-input clickable-element" data-option="3" src="<?php echo get_template_directory_uri().'/images/options/per_row_3.png'; ?>"></li>
                                    </ul>
                                    <select class="hidden" name="list-galleries-super-post-posts-per-row" id="list-galleries-super-post-posts-per-row">
                                        <option value="1" selected="selected">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles will be shown columns. Choose how mane columns do you want to use per line. Note that for mobile devices you will get only ONE element per row for better usability.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-galleries-big-post-nr-of-posts">
                                <td>
                                    <label for="list-galleries-super-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-galleries-super-post-limit"  id="list-galleries-super-post-limit" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-super-post-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-super-post-order-by" id="list-galleries-super-post-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>
                                     <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     <label for="list-galleries-super-post-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-super-post-order-direction" id="list-galleries-super-post-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option selected="selected" value="desc"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-super-post-special-effects"><?php _e( 'Special effects:', 'shootback' ); ?></label>
                                </td>
                                <td>
                                    <select name="list-galleries-super-post-special-effects" id="list-galleries-super-post-special-effects">
                                        <option value="none"><?php _e('No effect', 'shootback') ?></option>
                                        <option value="opacited"><?php _e('Fade in', 'shootback') ?></option>
                                        <option value="rotate-in"><?php _e('Rotate in', 'shootback') ?></option>
                                        <option value="3dflip"><?php _e('3d flip', 'shootback') ?></option>
                                        <option value="scaler"><?php _e('Scale', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('Your articles can have effects. Effects usually appear when you scroll down the page and they get into your viewport. You can check more details on how they work in our documentation files.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-super-post-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-super-post-pagination" id="list-galleries-super-post-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Timeline options -->
                    <div class="list-galleries-timeline hidden">

                        <table cellpadding="10">
                            <tr>
                                <td>
                                    <label for="list-galleries-timeline-show-meta"><?php _e( 'Show meta', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="radio" name="list-galleries-timeline-show-meta" id="list-galleries-timeline-show-meta-y" value="y"  checked = "checked"  /> 
                                    <label for="list-galleries-timeline-show-meta-y"><?php _e( 'Yes', 'shootback' ); ?></label>
                                    <input type="radio" name="list-galleries-timeline-show-meta" id="list-galleries-timeline-show-meta-n" value="n" />
                                    <label for="list-galleries-timeline-show-meta-n"><?php _e( 'No', 'shootback' ); ?></label>
                                    <div class="ts-option-description">
                                        <?php _e('You can choose to show or to hide your meta details for your articles. Meta values include date, author, categories and other article details.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-timeline-image"><?php _e( 'Show image', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-timeline-image" id="list-galleries-timeline-image">
                                        <option value="y"><?php _e( 'Yes', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Display image', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-galleries-timeline-nr-of-posts">
                                <td>
                                    <label for="list-galleries-timeline-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <input type="text" value="" name="list-galleries-timeline-post-limit" id="list-galleries-timeline-post-limit" size="4"/>
                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-timeline-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-timeline-order-by" id="list-galleries-timeline-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-timeline-order-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-timeline-order-direction" id="list-galleries-timeline-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-timeline-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-timeline-pagination" id="list-galleries-timeline-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- mosaic options -->
                    <div class="list-galleries-mosaic hidden">

                        <table cellpadding="10">
                            <tr class="list-galleries-mosaic-layout">
                                <td>
                                    <label for="list-galleries-mosaic-layout"><?php _e( 'Choose how to show the posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-mosaic-layout" id="list-galleries-mosaic-layout" class="ts-mosaic-layout">
                                        <option value="rectangles"><?php _e( 'Rectangles', 'shootback' ); ?></option>
                                        <option value="square"><?php _e( 'Squares', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose how to show the posts', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-galleries-mosaic-rows">
                                <td>
                                    <label for="list-galleries-mosaic-rows"><?php _e( 'Change number of rows', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-mosaic-rows" id="list-galleries-mosaic-rows" class="ts-mosaic-rows">
                                        <option value="2"><?php _e( '2', 'shootback' ); ?></option>
                                        <option value="3"><?php _e( '3', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Change number of rows', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="list-galleries-mosaic-nr-of-posts">
                                <td>
                                    <label for="list-galleries-mosaic-post-limit"><?php _e( 'How many posts to extract', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <div class="ts-mosaic-post-limit-rows-2">
                                        <input class="ts-input-slider" type="text" name="list-galleries-mosaic-post-limit-rows-2" id="list-galleries-mosaic-post-limit-rows-2" value="6" disabled />
                                        <div id="list-galleries-mosaic-post-limit-rows-2-slider"></div>
                                    </div>
                                    <div class="ts-mosaic-post-limit-rows-3">
                                        <input type="text" name="list-galleries-mosaic-post-limit-rows-3" id="list-galleries-mosaic-post-limit-rows-3" value="" disabled />
                                        <div id="list-galleries-mosaic-post-limit-rows-3-slider"></div>
                                    </div>
                                    <div class="ts-mosaic-post-limit-squares">
                                        <input type="text" name="list-galleries-mosaic-post-limit-rows-squares" id="list-galleries-mosaic-post-limit-rows-squares" value="" disabled />
                                        <div id="list-galleries-mosaic-post-limit-rows-squares-slider"></div>
                                    </div>

                                    <div class="ts-option-description">
                                        <?php _e('You can limit the number of posts that you want to show. You can set any number, and the system will automatically extract number of posts that you set here.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-mosaic-scroll"><?php _e( 'Add/remove scroll', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-mosaic-scroll" id="list-galleries-mosaic-scroll">
                                        <option value="y"><?php _e( 'With scroll', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'Without scroll', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Add/remove scroll', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-mosaic-effects"><?php _e( 'Add effects to scroll', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-mosaic-effects" id="list-galleries-mosaic-effects">
                                        <option value="default"><?php _e( 'Default', 'shootback' ); ?></option>
                                        <option value="fade"><?php _e( 'Fade in effect', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Change number of rows', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-mosaic-gutter"><?php _e( 'Add or Remove gutter between posts', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-mosaic-gutter" id="list-galleries-mosaic-gutter">
                                        <option value="y"><?php _e( 'With gutter between posts', 'shootback' ); ?></option>
                                        <option value="n"><?php _e( 'No gutter', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Add or Remove gutter between posts', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-mosaic-order-by"><?php _e( 'Order by', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-mosaic-order-by" id="list-galleries-mosaic-order-by">
                                        <option value="date"><?php _e( 'Date', 'shootback' ); ?></option>
                                        <option value="comments"><?php _e( 'Comments', 'shootback' ); ?></option>
                                        <option value="views"><?php _e( 'Views', 'shootback' ); ?></option>
                                        <option value="likes"><?php _e( 'Likes', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order criteria. You can sort your articles either by date by the number or comments.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="list-galleries-mosaic-direction"><?php _e( 'Order direction', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-mosaic-order-direction" id="list-galleries-mosaic-order-direction">
                                        <option value="asc"><?php _e( 'ASC', 'shootback' ); ?></option>
                                        <option value="desc" selected="selected"><?php _e( 'DESC', 'shootback' ); ?></option>
                                    </select>

                                    <div class="ts-option-description">
                                        <?php _e('Choose your order direction. You can sort your articles in an ascending or a descending way.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="class-list-galleries-mosaic-pagination">
                                <td>
                                    <label for="list-galleries-mosaic-pagination"><?php _e( 'Enable pagination', 'shootback' ); ?>:</label>
                                </td>
                                <td>
                                    <select name="list-galleries-mosaic-pagination" id="list-galleries-mosaic-pagination">
                                        <option selected="selected" value="n"><?php _e('None', 'shootback') ?></option>
                                        <option value="y"><?php _e('Enable pagination', 'shootback') ?></option>
                                        <option value="load-more"><?php _e('Load more', 'shootback') ?></option>
                                        <option value="infinite"><?php _e('Infinite scrolling', 'shootback') ?></option>
                                    </select>
                                    <div class="ts-option-description">
                                        <?php _e('You can add pagination.', 'shootback'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                
                </div>
            </div>

            <!-- Image carousel element -->
            <div class="gallery builder-element hidden">
                <h3 class="element-title"><?php _e('Gallery', 'shootback'); ?></h3>
                <table cellpadding="10">
                    <tr>
                        <td>
                            <label for="gallery-admin-label"><?php _e('Admin label','shootback'); ?>:</label>
                        </td>
                        <td>
                           <input type="text" id="gallery-admin-label" name="gallery-admin-label" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="gallery-type"><?php _e( 'Gallery type', 'shootback' ); ?>:</label>
                        </td>
                        <td>
                            <select name="gallery-type" id="gallery-type">
                                <option value="horizontal"><?php _e('Gallery Horizontal', 'touchsize'); ?></option>
                                <option value="horizontal-scroll"><?php _e('Gallery Horizontal Scroll', 'touchsize'); ?></option>
                                <option value="justified"><?php _e('Gallery Justified', 'touchsize'); ?></option>
                                <option value="thumbnails-below"><?php _e('Gallery Thumbnails Below', 'touchsize'); ?></option>
                                <option value="vertical-slider"><?php _e('Gallery Vertical Slider', 'touchsize'); ?></option>
                                <option value="masonry-layout"><?php _e('Gallery Masonry Layout', 'touchsize'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <label for="image_url"><?php _e( 'Add your images', 'shootback' ); ?>:</label></td>
                        </td>
                        <td>

                            <div class="inside">
                                <div id="post_images_container">
                                    <ul class="product_images gallery_images">
                                        
                                    </ul>
                                    <script>
                                        jQuery(document).ready(function($){
                                            setTimeout(function(){
                                                //Show the added images
                                                var image_gallery_ids = jQuery('#gallery_image_gallery').val();
                                                var gallery_images = jQuery('#post_images_container ul.gallery_images');

                                                // Split each image
                                                image_gallery_ids = image_gallery_ids.split(',');

                                                jQuery(image_gallery_ids).each(function(index, value){
                                                    image_url = value.split(/:(.*)/);
                                                    if( image_url != '' ){
                                                        image_url_path = image_url[1].split('.');

                                                        var imageFormat = image_url_path[image_url_path.length - 1];
                                                        var imageUrl = image_url_path.splice(0, image_url_path.length - 1).join('.');
                                                        gallery_images.append('\
                                                            <li class="image" data-attachment_id="' + imageUrl + '" data-attachment_url="' + imageUrl + '.' + imageFormat + '">\
                                                                <img src="' + imageUrl + '-<?php echo get_option( "thumbnail_size_w" ); ?>x<?php echo get_option( "thumbnail_size_h" ); ?>.' + imageFormat + '" />\
                                                                <ul class="actions">\
                                                                    <li><a href="#" class=" icon-close" title="<?php _e( 'Delete image', 'shootback' ); ?>"><?php //_e( 'Delete', 'shootback' ); ?></a></li>\
                                                                </ul>\
                                                            </li>');
                                                    }
                                                });

                                            },200);
                                        });
                                    </script>
                                    <input type="hidden" id="gallery_image_gallery" name="gallery_image_gallery" value="" />
                                </div>
                            </div>
                            <p class="add_gallery_images hide-if-no-js">
                                <a href="#"><?php _e( 'Add gallery images', 'shootback' ); ?></a>
                            </p>
                            <script type="text/javascript">
                                jQuery(document).ready(function($){

                                    // Uploading files
                                    var image_frame;
                                    var $image_gallery_ids = $('#gallery_image_gallery');
                                    var $gallery_images = $('#post_images_container ul.gallery_images');

                                    jQuery('.add_gallery_images').on( 'click', 'a', function( event ) {

                                        var $el = $(this);
                                        var attachment_ids = $image_gallery_ids.val();

                                        event.preventDefault();

                                        // If the media frame already exists, reopen it.
                                        if ( image_frame ) {
                                            image_frame.open();
                                            return;
                                        }

                                        // Create the media frame.
                                        image_frame = wp.media.frames.downloadable_file = wp.media({
                                            // Set the title of the modal.
                                            title: '<?php _e( 'Add Images to Gallery', 'shootback' ); ?>',
                                            button: {
                                                text: '<?php _e( 'Add to gallery', 'shootback' ); ?>',
                                            },
                                            multiple: true
                                        });

                                        // When an image is selected, run a callback.
                                        image_frame.on( 'select', function() {
                                            
                                            var selection = image_frame.state().get('selection');

                                            selection.map( function( attachment ) {

                                                attachment = attachment.toJSON();
                                                if ( attachment.id ) {
                                                    attachment_ids = attachment_ids + attachment.id + ':' + attachment.url + ',';

                                                    $gallery_images.append('\
                                                        <li class="image" data-attachment_id="' + attachment.id + '" data-attachment_url="' + attachment.url + '">\
                                                            <img src="' + attachment.url + '" />\
                                                            <ul class="actions">\
                                                                <li><a href="#" class=" icon-close" title="<?php _e( 'Delete image', 'shootback' ); ?>"><?php //_e( 'Delete', 'shootback' ); ?></a></li>\
                                                            </ul>\
                                                        </li>');
                                                }

                                            } );

                                            $image_gallery_ids.val( attachment_ids );
                                        });

                                        // Finally, open the modal.
                                        image_frame.open();
                                    });

                                    // Image ordering
                                    $gallery_images.sortable({
                                        items: 'li.image',
                                        cursor: 'move',
                                        scrollSensitivity:40,
                                        forcePlaceholderSize: true,
                                        forceHelperSize: false,
                                        helper: 'clone',
                                        opacity: 0.65,
                                        placeholder: 'wc-metabox-sortable-placeholder',
                                        start:function(event,ui){
                                            ui.item.css('background-color','#f6f6f6');
                                        },
                                        stop:function(event,ui){
                                            ui.item.removeAttr('style');
                                        },
                                        update: function(event, ui) {
                                            var attachment_ids = '';

                                            $('#post_images_container ul li.image').css('cursor','default').each(function() {
                                                var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                                                attachment_url = jQuery(this).attr( 'data-attachment_url' );
                                                attachment_ids = attachment_ids + attachment_id + ':' + attachment_url + ',';
                                            });

                                            $image_gallery_ids.val( attachment_ids );
                                        }
                                    });

                                    // Remove images
                                    $('#post_images_container').on( 'click', 'a.icon-close', function() {

                                        $(this).closest('li.image').remove();

                                        var attachment_ids = '';

                                        $('#post_images_container ul li.image').css('cursor','default').each(function() {
                                            var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                                            var attachment_url = jQuery(this).attr( 'data-attachment_url' );
                                            attachment_ids = attachment_ids + attachment_id + ':' + attachment_url + ',';
                                        });

                                        $image_gallery_ids.val( attachment_ids );

                                        return false;
                                    } );
                                });
                            </script>
                        </td>
                    </tr>
                </table>
            </div>

            <input type="button" class="button-primary save-element" value="<?php _e('Save changes', 'shootback'); ?>" id="builder-save"/>

        </div>
        <script src="<?php echo get_template_directory_uri() . '/admin/js/builder-elements.js?ver='.time(); ?>"></script>
<script>
jQuery(document).ready(function(){

    jQuery('select.ts-custom-select-input').on('click',function(){

        if(jQuery(this).val() == 0){

            jQuery(this).find('option[value="0"]').remove();
            jQuery(this).find('option').attr("selected","selected");
            jQuery(this).trigger("change");
            jQuery(this).append('<option value="0">All</option>');
           
        }else{
            if( jQuery(this).val() != null && jQuery(this).val().indexOf('0') >= 0){
                jQuery(this).find('option[value="0"]').remove();
                jQuery(this).find('option').attr("selected","selected");
                jQuery(this).trigger("change");
                jQuery(this).append('<option value="0">All</option>');
            }
        }
    });

    function custom_selectors(selector, targetselect){
        selector_option = jQuery(selector).attr('data-option');
        jQuery(selector).parent().parent().find('.selected').removeClass('selected');
        jQuery(targetselect).find('option[selected="selected"]').removeAttr('selected');
        jQuery(targetselect).find('option[value="' + selector_option + '"]').attr('selected','selected');
        jQuery(selector).parent().addClass('selected');
    }
    function custom_selectors_run(){
        jQuery('.ts-custom-selector').each(function(){
            the_selector = jQuery(this).attr('data-selector');
            the_selector_value = jQuery(the_selector + ' option[selected="selected"]').attr('value');
            selected_class = jQuery(this).find('[data-option="' + the_selector_value + '"]').attr('data-option');
            jQuery(this).find('[data-option="' + selected_class + '"]').parent().addClass('selected');

            var firstchild = jQuery(this).children('li:first'),
                bool = false;

              if(jQuery(this).children().hasClass('selected') == false){
                firstchild.addClass('selected');
                bool = true;

                if(bool == true){
                    jQuery(the_selector + ' li .clickable-element:first-child').trigger('click');
                }

            }else{
              return true;
            }
        });
    }
    
    function custom_selectors_toggle_run(){
        jQuery('.builder-element-icon-toggle').each(function(){
            var selectedOptionVal = jQuery(this).next().next().find('option:selected').attr('value');
            if( jQuery(this).find('i.' + selectedOptionVal).length == 0 ){
                jQuery(this).find('.builder-element-icon-trigger-btn').append("<i class='" + selectedOptionVal + "'></i>"); //add to button the selected icon
            }
        });
    }

    jQuery(document).ready(function(){
        custom_selectors_toggle_run();
    });

    jQuery('.ts-custom-selector').each(function(){
        var data_select = jQuery(this).attr('data-selector');
        jQuery(data_select).addClass('hidden');
    });

    function restartColorPickers(){
      var pickers = jQuery('.colors-section-picker-div');
      jQuery.each(pickers, function( index, value ) {
        jQuery(this).farbtastic(jQuery(this).prev());
      });
    }
    setTimeout(function(){
        custom_selectors_run();
    },200);

    jQuery('.ts-custom-select-input').each(function(){
        var select_placeholder = jQuery(this).attr('data-placeholder');
        jQuery(this).css({'width':'380px'}).select2({
            placeholder : select_placeholder,
            allowClear: true
        });
    });

    //function for display or hidden the categories in builder element featured area       
    function ts_display_categories(){

        var costum_post = jQuery('#featured-area-custom-post').val();
        
        jQuery('#featured-area-custom-post').change(function(){
        
            if( jQuery(this).val() == 'video' ){
                jQuery('.select2-choices li:not(.select2-search-field)').remove();
                jQuery('.featured-area-gallery').css('display','none').find('option').removeAttr('selected');
                jQuery('.featured-area-posts').css('display','none').find('option').removeAttr('selected');
                jQuery('.featured-area-video').css('display','');
            }else if( jQuery(this).val() == 'gallery' ){
                jQuery('.select2-choices li:not(.select2-search-field)').remove();
                jQuery('.featured-area-posts').css('display','none').find('option').removeAttr('selected');
                jQuery('.featured-area-video').css('display','none').find('option').removeAttr('selected');
                jQuery('.featured-area-gallery').css('display','');
            }else if( jQuery(this).val() == 'post' ){
                jQuery('.select2-choices li:not(.select2-search-field)').remove();
                jQuery('.featured-area-posts').css('display','');
                jQuery('.featured-area-video').css('display','none').find('option').removeAttr('selected');
                jQuery('.featured-area-gallery').css('display','none').find('option').removeAttr('selected');
            }
        });

        if( costum_post == 'video' ){
            jQuery('.featured-area-video').css('display','');
        }else if( costum_post == 'gallery' ){
            jQuery('.featured-area-gallery').css('display','');
        }else if( costum_post == 'post' ){
            jQuery('.featured-area-posts').css('display','');
        }
    }
    ts_display_categories();

    // show-display option number rows depending of layout option(square/hide number rows - rectangles/show number rows)
    function ts_last_post_mosaic_rows_layout(name_element){

        var value_select = jQuery('#' + name_element + '-mosaic-layout').val();
        if( value_select == 'square' ){
            jQuery('.' + name_element + '-mosaic-rows').css('display', 'none');
        }else{
            jQuery('.' + name_element + '-mosaic-rows').css('display', '');
        }

        jQuery('#' + name_element + '-mosaic-layout').change(function(){
            if( jQuery(this).val() == 'square' ){
                jQuery('.' + name_element + '-mosaic-rows').css('display', 'none');
            }else{
                jQuery('.' + name_element + '-mosaic-rows').css('display', '');
            }
        });
    }
    ts_last_post_mosaic_rows_layout('last-posts');
    ts_last_post_mosaic_rows_layout('list-videos');
    ts_last_post_mosaic_rows_layout('latest-custom-posts');
    ts_last_post_mosaic_rows_layout('list-galleries');

    function ts_repopulate_element(element_name, items_array){

        list_items = jQuery.parseJSON(jQuery('#' + element_name + '_content').val());

        if (list_items != '') {
            name_blocks_template = jQuery('#' + element_name + '_items_template').html();

            var json_to_array = '';
            
            jQuery(list_items).each(function(index, value){
    
                li_content = '';
                var li_appended = false;

                if ( value != '' ) {

                    var elemId = '';
                    for(var i in value){

                        if( i == 'id' ){
                            var elemId = value[i];
                            if (li_appended == false) {
                                li_content = name_blocks_template.replace(/{{item-id}}/g, elemId);
                                jQuery('#' + element_name + '_items').append(li_content);
                            }
                            li_appended = true;
                        }

                        if( i == 'icon' ){
                            var elemIcon = value[i]; 
                        }

                        if( i == 'title' ){

                            var title = value[i].replace(/--quote--/g, '"');
                            jQuery('#' + element_name + '_items li:last-child').find('.ts-multiple-item-tab').html('Item: ' + title);
                           
                            if( elemIcon ){
                                jQuery('#' + element_name + '-' + elemId + '-icon').find('option[value="' + elemIcon + '"]').attr('selected','selected');
                            }
                        }

                        if( i == 'name' ){
                            var name = value[i];
                            jQuery('#' + element_name + '_items li:last').find('.ts-multiple-item-tab').html('Item: ' + name);
                        }

                        if( i == 'image' ){
                            var img = jQuery("<img>").attr('src', value[i]).attr('style', 'width:400px');
                            jQuery('#image-preview-' + elemId).html(img);

                        }

                        if( i == 'percentage' && element_name == 'skills' ) ts_slider_pips(0, 100, 1, value[i], 'skills-' + elemId + '-percentage-slider', 'skills-' + elemId + '-percentage');

                        jQuery('#' + element_name + '-' + elemId + '-' + i).val(value[i].replace(/--quote--/g, '"').replace(/<br \/>/g, '\n'));

                        if( elemIcon ){

                            custom_selectors_toggle_run();
                            jQuery('div.' + element_name + '.builder-element .builder-icon-list').each(function(){

                                this_id = '#' + jQuery(this).attr('id') + ' li i';

                                jQuery('div.' + element_name + '.builder-element .builder-icon-list li i').click(function(){
                                    targetselect = jQuery(this).parent().parent().attr('data-selector');
                                    custom_selectors(jQuery(this), targetselect);
                                });

                            });
                        }

                    }

                    ts_upload_files('#uploader_' + elemId, '#slide_media_id-' + elemId, '#' + element_name + '-' + elemId + '-image', 'Insert image', '#image-preview-' + elemId, 'image');

                    if(element_name == 'listed-features'){
                        ts_listed_features_style_color();
                    }
                    
                    ts_contact_form_type_options();

                }
                restartColorPickers();
            });
        };

        var name_block_items = jQuery('#' + element_name + '_items > li').length;

        jQuery('#' + element_name + '_items').sortable();
    }
    ts_repopulate_element('features-block', new Array('id','icon','title','text','url','background','font'));
    ts_repopulate_element('listed-features', new Array('id','icon','title','text','iconcolor','bordercolor','backgroundcolor','url'));
    ts_repopulate_element('clients', new Array('id','image','title','url'));
    ts_repopulate_element('testimonials', new Array('id','image','name','text','company','url'));
    ts_repopulate_element('tab', new Array('id','title','text'));
    ts_repopulate_element('contact-form', new Array('id','title','type','require','options'));
    ts_repopulate_element('timeline', new Array('id','title','text','align','image'));
    ts_repopulate_element('video-carousel', new Array('id','title','text','url','embed'));
    ts_repopulate_element('skills', new Array('id','title','percentage','color'));

    //show/hide the option 'Background color' end 'Border color' in element 'Button'&'ribbon banner' depending of option 'Choose your mode to display:'
    function ts_buttons_display_mode(element_name){
        var option_display_mode = jQuery('#' + element_name + '-mode-display');
        jQuery(option_display_mode).change(function(){
            if( jQuery(this).val() === 'background-button' ){
                jQuery('.' + element_name + '-border-color').css('display', 'none');
                jQuery('.' + element_name + '-background-color').css('display', '');
            }else{
                jQuery('.' + element_name + '-background-color').css('display', 'none');
                jQuery('.' + element_name + '-border-color').css('display', '');
            }
        });

        if( jQuery(option_display_mode).val() === 'background-button' ){
            jQuery('.' + element_name + '-border-color').css('display', 'none');
            jQuery('.' + element_name + '-background-color').css('display', '');
        }else{
            jQuery('.' + element_name + '-background-color').css('display', 'none');
            jQuery('.' + element_name + '-border-color').css('display', '');
        }
    }
    ts_buttons_display_mode('button');
    ts_buttons_display_mode('ribbon-button');

    ts_contact_form_type_options();

    ts_upload_files('#select_banner_image', '#banner_image_media_id', '#image-banner-url', 'Insert banner', '#banner-image-preview', 'image');
    ts_upload_files('#select_image', '#image_media_id', '#image_url', 'Insert image', '#image_preview', 'image');
    ts_upload_files('#ribbon-select-image', '#ribbon-media-id', '#ribbon-attachment', 'Choose image', '#ribbon-image-preview','image');
    ts_upload_files('#select_powerlink_image', '#powerlink_image_media_id', '#image-powerlink-url', 'Insert banner', '#powerlink-image-preview', 'image');
    ts_upload_files('#map-marker-select-image', '#map-marker-media-id', '#map-marker-attachment', 'Choose image', '#map-marker-image-preview','image');
    ts_repopulate_element('chart_line', new Array('id','title','fillColor','strokeColor','pointColor','pointStrokeColor','pointHighlightFill','pointHighlightStroke','data'));
    ts_repopulate_element('chart_pie', new Array('id','title','value','color','highlight'));

    //show select category by custom post type in element latest custom posts
    function ts_latest_custom_post_category(){
        jQuery('#latest-custom-posts-type').change(function(){
            var arrayValues = jQuery(this).val();
            jQuery(this).find('option').each(function(){
                jQuery('#ts-block-category-' + jQuery(this).attr('value')).addClass('hidden');
            });
            for(key in arrayValues){
                jQuery('#ts-block-category-' + arrayValues[key]).removeClass('hidden');
            }
        });

        jQuery('#latest-custom-posts-type option').each(function(){
            jQuery('#ts-block-category-' + jQuery(this).attr('value')).addClass('hidden');
        });

        var arrayValues = jQuery('#latest-custom-posts-type').val();
        for(key in arrayValues){
            jQuery('#ts-block-category-' + arrayValues[key]).removeClass('hidden');
        }
    }
    ts_latest_custom_post_category();

    jQuery('#chart-mode').change(function(){
        if( jQuery(this).val() == 'pie' ){
            jQuery('.chart-line-options').css('display', 'none');
            jQuery('.chart-pie-options').css('display', '');
        }else{
            jQuery('.chart-line-options').css('display', '');
            jQuery('.chart-pie-options').css('display', 'none');
        }
    });
    if( jQuery('#chart-mode').val() == 'pie' ){
        jQuery('.chart-line-options').css('display', 'none');
        jQuery('.chart-pie-options').css('display', '');
    }else{
        jQuery('.chart-line-options').css('display', '');
        jQuery('.chart-pie-options').css('display', 'none');
    }

    jQuery('#counters-track-bar').change(function(){
        if( jQuery(this).val() == 'with-track-bar' ){
            jQuery('.ts-counters-track-bar-color').css('display', '');
            jQuery('.ts-counters-icons').css('display', 'none');
        }else{
            jQuery('.ts-counters-track-bar-color').css('display', 'none');
            jQuery('.ts-counters-icons').css('display', '');
        }
    });
    
    if( jQuery('#counters-track-bar').val() == 'with-track-bar' ){
        jQuery('.ts-counters-track-bar-color').css('display', '');
        jQuery('.ts-counters-icons').css('display', 'none');
    }else{
        jQuery('.ts-counters-track-bar-color').css('display', 'none');
        jQuery('.ts-counters-icons').css('display', '');
    }

    jQuery("#video-carousel-source").change(function(){
        if( jQuery(this).val() == "custom-slides" ){
            jQuery(".ts-video-carousel-custom").css("display", "");
        }else{
            jQuery(".ts-video-carousel-custom").css("display", "none");
        }
    });

    if( jQuery("#video-carousel-source").val() == "custom-slides" ){
        jQuery(".ts-video-carousel-custom").css("display", "");
    }else{
        jQuery(".ts-video-carousel-custom").css("display", "none");
    }

    jQuery('#video-lightbox').change(function(){
        if( jQuery(this).val() == 'n' ){
            jQuery('.ts-video-title').css('display', 'none');
        }else{
            jQuery('.ts-video-title').css('display', '');
        }
    });

    if( jQuery('#video-lightbox').val() == 'n' ){
        jQuery('.ts-video-title').css('display', 'none');
    }else{
        jQuery('.ts-video-title').css('display', '');
    }

    jQuery('#filters-post-type').change(function(){
        var customPost = jQuery(this).val();
        jQuery(this).find('option').each(function(){
            jQuery('#' + jQuery(this).val() + '-categories').addClass('hidden');
            jQuery('#' + jQuery(this).val() + '-categories').find('li.select2-search-choice').remove();
            jQuery('#' + jQuery(this).val() + '-categories').find('option').removeAttr('selected');
        });
        jQuery('#' + customPost + '-categories').removeClass('hidden');
    });

    var customPost = jQuery('#filters-post-type').val();
    jQuery('#filters-post-type option').each(function(){
        var notSelected = jQuery(this).val();
        if( customPost !== notSelected ){
            jQuery('#' + notSelected + '-categories').addClass('hidden');
        }else{
            jQuery('#' + notSelected + '-categories').removeClass('hidden');
        }
    });

    function ts_accordion_category(){
        jQuery('#accordion-posts-type').change(function(){
            var customPost = jQuery(this).val();
            jQuery('.ts-accordion-category').each(function(){
                jQuery(this).addClass('hidden');
            });
            jQuery('.ts-accordion-category option').removeAttr('selected');
            jQuery('.ts-custom-select-input li.select2-search-choice').remove();
            jQuery('.ts-accordion-category-' + customPost).removeClass('hidden');
        });

        jQuery('.ts-accordion-category').addClass('hidden');

        var customPost = jQuery('#accordion-posts-type').val();
        jQuery('.ts-accordion-category-' + customPost).removeClass('hidden');

    }
    ts_accordion_category();

    
    function ts_mosaic_post_limit(){
        jQuery('.ts-mosaic-layout').change(function(){
            if( jQuery(this).val() == 'rectangles' ){

                jQuery(this).closest('table').find('.ts-mosaic-post-limit-squares').css('display', 'none');

                if( jQuery(this).closest('table').find('.ts-mosaic-rows').val() == '2' ){
                    jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-2').css('display', '');
                    jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-3').css('display', 'none');
                }else{
                    jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-3').css('display', '');
                    jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-2').css('display', 'none');
                }
            }else{
                jQuery(this).closest('table').find('.ts-mosaic-post-limit-squares').css('display', '');
                jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-3').css('display', 'none');
                jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-2').css('display', 'none');
            }
        });
        
        jQuery('.ts-mosaic-layout').each(function(){
            if( jQuery(this).val() == 'rectangles' ){

                jQuery(this).closest('table').find('.ts-mosaic-post-limit-squares').css('display', 'none');

                if( jQuery(this).closest('table').find('.ts-mosaic-rows').val() == '2' ){
                    jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-2').css('display', '');
                    jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-3').css('display', 'none');
                }else{
                    jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-3').css('display', '');
                    jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-2').css('display', 'none');
                }
            }else{
                jQuery(this).closest('table').find('.ts-mosaic-post-limit-squares').css('display', '');
                jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-3').css('display', 'none');
                jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-2').css('display', 'none');
            }
        });

        jQuery('.ts-mosaic-rows').change(function(){
            jQuery(this).closest('table').find('.ts-mosaic-post-limit-squares').css('display', 'none');

            if( jQuery(this).val() == '2' ){
                jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-2').css('display', '');
                jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-3').css('display', 'none');
            }else{
                jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-3').css('display', '');
                jQuery(this).closest('table').find('.ts-mosaic-post-limit-rows-2').css('display', 'none');
            }
        });
        
    }
    ts_mosaic_post_limit();

    ts_slider_pips(6, 102, 6, jQuery('#last-posts-mosaic-post-limit-rows-2').val(), 'last-posts-mosaic-post-limit-rows-2-slider', 'last-posts-mosaic-post-limit-rows-2');
    ts_slider_pips(9, 99, 9, jQuery('#last-posts-mosaic-post-limit-rows-3').val(), 'last-posts-mosaic-post-limit-rows-3-slider', 'last-posts-mosaic-post-limit-rows-3');
    ts_slider_pips(5, 100, 5, jQuery('#last-posts-mosaic-post-limit-rows-squares').val(), 'last-posts-mosaic-post-limit-rows-squares-slider', 'last-posts-mosaic-post-limit-rows-squares');

    ts_slider_pips(6, 102, 6, jQuery('#list-videos-mosaic-post-limit-rows-2').val(), 'list-videos-mosaic-post-limit-rows-2-slider', 'list-videos-mosaic-post-limit-rows-2');
    ts_slider_pips(9, 99, 9, jQuery('#list-videos-mosaic-post-limit-rows-3').val(), 'list-videos-mosaic-post-limit-rows-3-slider', 'list-videos-mosaic-post-limit-rows-3');
    ts_slider_pips(5, 100, 5, jQuery('#list-videos-mosaic-post-limit-rows-squares').val(), 'list-videos-mosaic-post-limit-rows-squares-slider', 'list-videos-mosaic-post-limit-rows-squares');

    ts_slider_pips(6, 102, 6, jQuery('#latest-custom-posts-mosaic-post-limit-rows-2').val(), 'latest-custom-posts-mosaic-post-limit-rows-2-slider', 'latest-custom-posts-mosaic-post-limit-rows-2');
    ts_slider_pips(9, 99, 9, jQuery('#latest-custom-posts-mosaic-post-limit-rows-3').val(), 'latest-custom-posts-mosaic-post-limit-rows-3-slider', 'latest-custom-posts-mosaic-post-limit-rows-3');
    ts_slider_pips(5, 100, 5, jQuery('#latest-custom-posts-mosaic-post-limit-rows-squares').val(), 'latest-custom-posts-mosaic-post-limit-rows-squares-slider', 'latest-custom-posts-mosaic-post-limit-rows-squares');

    ts_slider_pips(6, 102, 6, jQuery('#list-galleries-mosaic-post-limit-rows-2').val(), 'list-galleries-mosaic-post-limit-rows-2-slider', 'list-galleries-mosaic-post-limit-rows-2');
    ts_slider_pips(9, 99, 9, jQuery('#list-galleries-mosaic-post-limit-rows-3').val(), 'list-galleries-mosaic-post-limit-rows-3-slider', 'list-galleries-mosaic-post-limit-rows-3');
    ts_slider_pips(5, 100, 5, jQuery('#list-galleries-mosaic-post-limit-rows-squares').val(), 'list-galleries-mosaic-post-limit-rows-squares-slider', 'list-galleries-mosaic-post-limit-rows-squares');
    

});
</script>