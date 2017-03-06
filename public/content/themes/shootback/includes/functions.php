<?php
if ( ! function_exists( 'touchsize_comment' ) ) :

function touchsize_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'shootback' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'shootback' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <?php
                        $avatar_size = 68;
                        if ( '0' != $comment->comment_parent )
                            $avatar_size = 39;

                        echo get_avatar( $comment, $avatar_size );

                        /* translators: 1: comment author, 2: date and time */
                        printf( __( '%1$s on %2$s <span class="says">said:</span>', 'shootback' ),
                            sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                            sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                esc_url( get_comment_link( $comment->comment_ID ) ),
                                get_comment_time( 'c' ),
                                /* translators: 1: date, 2: time */
                                sprintf( __( '%1$s at %2$s', 'shootback' ), get_comment_date(), get_comment_time() )
                            )
                        );
                    ?>

                    <?php edit_comment_link( __( 'Edit', 'shootback' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- .comment-author .vcard -->

                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'shootback' ); ?></em>
                    <br />
                <?php endif; ?>

            </footer>

            <div class="comment-content"><?php comment_text(); ?></div>

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'shootback' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->

    <?php
            break;
    endswitch;
}
endif; // ends check for touchsize_comment()


if ( ! function_exists( 'touchsize_posted_on' ) ) :

function touchsize_posted_on() {
    printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'shootback' ),
        esc_url( get_permalink() ),
        esc_attr( get_the_time() ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( __( 'View all posts by %s', 'shootback' ), get_the_author() ) ),
        get_the_author()
    );
}
endif; // ends check for touchsize_posted_on()


function ts_layout_wrapper($elements)
{

    echo '<script id="dragable-row-tpl" type="text/x-handlebars-template">
        <ul class="layout_builder_row">
            <li class="row-editor">
                <ul class="row-editor-options">
                    <li>
                        <a href="#" class="add-column">' . __( '+', 'shootback' ) . '</a>
                        <a href="#" class="predefined-columns"><img src="'.get_template_directory_uri().'/images/options/columns_layout.png" alt=""></a>
                        <ul class="add-column-settings">
                            <li>
                               <a href="#" data-add-columns="#dragable-column-tpl"><img src="'.get_template_directory_uri().'/images/options/columns_layout_column.png" alt=""></a>
                           </li>
                           <li>
                               <a href="#" data-add-columns="#dragable-column-tpl-half"><img src="'.get_template_directory_uri().'/images/options/columns_layout_halfs.png" alt=""></a>
                           </li>
                           <li>
                               <a href="#" data-add-columns="#dragable-column-tpl-thirds"><img src="'.get_template_directory_uri().'/images/options/columns_layout_thirds.png" alt=""></a>
                           </li>
                           <li>
                               <a href="#" data-add-columns="#dragable-column-tpl-four-halfs"><img src="'.get_template_directory_uri().'/images/options/columns_layout_one_four.png" alt=""></a>
                           </li>
                           <li>
                               <a href="#" data-add-columns="#dragable-column-tpl-one_three"><img src="'.get_template_directory_uri().'/images/options/columns_layout_one_three.png" alt=""></a>
                           </li>
                           <li>
                               <a href="#" data-add-columns="#dragable-column-tpl-four-half-four"><img src="'.get_template_directory_uri().'/images/options/columns_layout_four_half_four.png" alt=""></a>
                           </li>
                        </ul>
                    </li>
                    <li><a href="#" class="remove-row">' . __( 'delete', 'shootback' ) . '</a></li>
                    <li><a href="#" class="move">' . __( 'move', 'shootback' ) . '</a></li>
                </ul>
            </li>
            <li class="edit-row-settings" >
                <a href="#" class="edit-row" id="{{row-id}}">'.__('Edit', 'shootback').'</a>
            </li>
        </ul>
    </script>';

    echo '<script id="dragable-element-tpl" type="text/x-handlebars-template">
            <li data-element-type="empty">
                <i class="element-icon icon-empty"></i>
                <span class="element-name">'.__('Empty', 'shootback').'</span>
                <span class="edit icon-edit" data-tooltip="'.__('Edit this element', 'shootback').'">'.__('Edit', 'shootback').'</span>
                <span class="delete icon-delete" data-tooltip="'.__('Remove this element', 'shootback').'"></span>
                <span class="clone icon-beaker" data-tooltip="'.__('Clone this element', 'shootback').'"></span>
            </li>
        </script>';
    // Template for adding a 12 column
    echo '<script id="dragable-column-tpl" type="text/x-handlebars-template">
        <li data-columns="12" data-type="column" class="columns12">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">12/12</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
    </script>';
    // Template for splitting the content in 2 halfs
    echo '<script id="dragable-column-tpl-half" type="text/x-handlebars-template">
        <li data-columns="6" data-type="column" class="columns6">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/2</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
        <li data-columns="6" data-type="column" class="columns6">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/2</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
    </script>';
    // Template for splitting the content in 3 halfs
    echo '<script id="dragable-column-tpl-thirds" type="text/x-handlebars-template">
        <li data-columns="4" data-type="column" class="columns4">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/4</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
        <li data-columns="4" data-type="column" class="columns4">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/4</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
        <li data-columns="4" data-type="column" class="columns4">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/4</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
    </script>';
    // Template for splitting the content in one to three
    echo '<script id="dragable-column-tpl-one_three" type="text/x-handlebars-template">
        <li data-columns="4" data-type="column" class="columns4">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/3</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
        <li data-columns="8" data-type="column" class="columns8">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">2/3</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
    </script>';
    // Template for splitting the content in one fourth to one half and one fourth
    echo '<script id="dragable-column-tpl-four-half-four" type="text/x-handlebars-template">
        <li data-columns="3" data-type="column" class="columns3">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/4</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
        <li data-columns="6" data-type="column" class="columns6">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/2</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
        <li data-columns="3" data-type="column" class="columns3">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/4</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
    </script>';
    // Template for splitting the content in four columns
    echo '<script id="dragable-column-tpl-four-halfs" type="text/x-handlebars-template">
        <li data-columns="3" data-type="column" class="columns3">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/3</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
        <li data-columns="3" data-type="column" class="columns3">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/3</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
        <li data-columns="3" data-type="column" class="columns3">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/3</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
        <li data-columns="3" data-type="column" class="columns3">
            <div class="column-header">
                <span class="minus icon-left" data-tooltip="'.__('Reduce column size', 'shootback').'"></span>
                <span class="column-size" data-tooltip="'.__('The size of the column within container', 'shootback').'">1/3</span>
                <span class="plus icon-right" data-tooltip="' . __('Add column size', 'shootback') . '"></span>
                <span class="delete-column icon-delete" data-tooltip="'.__('Remove this column', 'shootback').'"></span>
                <span class="drag-column icon-drag" data-tooltip="'.__('Drag this column', 'shootback').'"></span>
                <span class="edit-column icon-edit" data-tooltip="'.__('Edit this column', 'shootback').'"></span>
            </div>

            <ul class="elements">
            </ul>
            <span class="add-element">'.__('Add element', 'shootback').'</span>
        </li>
    </script>';


    echo '<div class="builder-section-container">
        <!-- Edit Content Strucutre -->
        <div style="clear: both"></div>
        <a href="#" data-location="content" class="app red-ui-button add-top-row">' . __( 'Add row to the top', 'shootback' ) . '</a><br/><br/>
        <div class="layout_builder" id="section-content">';

    echo $elements;

    echo '</div>
        <div style="clear: both"></div>
        <br>
        <a href="#" data-location="content" class="app red-ui-button add-bottom-row">'. __( 'Add row to the bottom', 'shootback' ) . '</a>
        <a href="#" data-location="content" class="app red-ui-button publish-changes" style="float: right;font">'. __( 'Publish', 'shootback' ) . '</a>
        <div style="clear: both"></div>
    </div>';
}

/**
 * Extrat information from page options
 */

//=============== Style options  ===========================
//=============== General Tab ==============================

if ( ! function_exists('ts_preloader')) {

    function ts_preloader()
    {
        $option = get_option('shootback_general', array('enable_preloader' => 'N'));

        if ( $option['enable_preloader'] === 'Y' || $option['enable_preloader'] === 'FP' && is_front_page() ) {
            return true;
        } else {
            return false;
        }

    }
}


if ( ! function_exists('ts_display_featured_image')) {

    function ts_display_featured_image()
    {
        global $post;
        $option = get_option('shootback_general', array('featured_image_in_post' => 'Y'));

        if ( !is_page() && $option['featured_image_in_post'] === 'Y' && !fields::logic($post->ID, 'post_settings', 'hide_featimg') || is_page() && !fields::logic($post->ID, 'page_settings', 'hide_featimg')) {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists('ts_lightbox_enabled')) {

    function ts_lightbox_enabled()
    {
        $option = get_option('shootback_general', array('enable_lightbox' => 'Y'));

        if ($option['enable_lightbox'] === 'Y') {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists('ts_comment_system')) {

    function ts_comment_system()
    {
        $option = get_option('shootback_general', array('comment_system' => 'default'));

        if ( in_array($option['comment_system'], array('default', 'facebook')) ) {
            return $option['comment_system'];
        } else {
            return 'default';
        }
    }
}

if ( ! function_exists('ts_facebook_app_ID')) {

    function ts_facebook_app_ID()
    {
        $option = get_option('shootback_general', array('facebook_id' => ''));

        return $option['facebook_id'];
    }
}

// Enable or disable WP Admin Bar
$option = get_option('shootback_general', array('show_wp_admin_bar' => 'Y'));

if ($option['show_wp_admin_bar'] === 'N') {
    add_filter('show_admin_bar', '__return_false');
}

if ( ! function_exists('ts_enable_sticky_menu')) {

    function ts_enable_sticky_menu()
    {
        $option = get_option('shootback_general', array('enable_sticky_menu' => 'Y'));

        if ( $option['enable_sticky_menu'] === "Y" ) {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists('ts_get_sticky_menu_style')) {

    function ts_get_sticky_menu_style()
    {
        $option = get_option('shootback_general', array('sticky_menu_bg_color' => '', 'sticky_menu_text_color' => ''));
        $description = (isset($option['show_description']) && ($option['show_description'] == 'y' || $option['show_description'] == 'n')) ? $option['show_description'] : 'y';
        $icons = (isset($option['show_icons']) && ($option['show_icons'] == 'y' || $option['show_icons'] == 'n')) ? $option['show_icons'] : 'y';
        $style_description = ($description == 'n') ? '.ts-sticky-menu .mega-menu-item-description{display: none;}': '';
        $style_icons = ($icons == 'n') ? '.ts-sticky-menu ul li a i{display: none;}' : '';

        if ( $option['sticky_menu_text_color'] !== "#FFFFFF" || $option['sticky_menu_bg_color'] !== "#444444" ) {
            $content = '
            .ts-sticky-menu{
                background-color: ' . $option['sticky_menu_bg_color'] . ';
            }
            .ts-sticky-menu .sf-menu li ul{
                background-color: ' . $option['sticky_menu_bg_color'] . ';
            }
            .ts-sticky-menu .container .sf-menu li a, .ts-sticky-menu .container .sf-menu li, .ts-sticky-menu .sf-menu{
                color:'. $option['sticky_menu_text_color'] . ';' .
            '}
            .ts-sticky-menu .container .sf-menu li.current-menu-item > a{
                color: '. ts_get_color('primary_color') .';
            }';
            return $content . $style_description . $style_icons;
        } else {
            return '';
        }
    }
}

if ( ! function_exists('ts_tracking_code')) {

    function ts_tracking_code()
    {
        $option = get_option('shootback_general', array('tracking_code' => ''));

        return $option['tracking_code'];
    }
}

//=============== Styles Tab ==============================

if ( ! function_exists('ts_boxed_layout')) {

    function ts_boxed_layout()
    {
        $option = get_option('shootback_styles', array('boxed_layout' => 'N'));

        if ($option['boxed_layout'] === 'N') {
            return false;
        } else {
            return true;
        }
    }
}

if ( ! function_exists('ts_get_color')) {

    function ts_get_color($val)
    {
        $option = get_option('shootback_colors', array($val => '#EB593C'));

        return $option[$val];
    }
}

if ( ! function_exists('ts_custom_background')) {

    function ts_custom_background()
    {
        $bg = get_option('shootback_styles');

        if ($bg) {
            switch ($bg['theme_custom_bg']) {
                case 'N':
                    $css = '';
                    break;

                case 'pattern':
                    $css = "background: url(" . get_template_directory_uri() . '/images/patterns/' . esc_attr($bg['theme_bg_pattern']) .");\n";
                    break;

                case 'image':
                    $css = "background: url(" . esc_url($bg['bg_image']) .") no-repeat top center;\n";
                    break;

                case 'color':
                    $css = "background-color: " . esc_attr($bg['theme_bg_color']) .";\n";
                    break;

                default:
                    $css = '';
                    break;
            }

            if ($css !== '') {
                return "body {\n" . $css . "\n}";
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
}

if ( ! function_exists('ts_custom_favicon')) {

    function ts_custom_favicon()
    {
        $option = get_option('shootback_styles', array('favicon' => ''));

        if ( $option['favicon'] == '' ) {
            return '<link rel="shortcut icon" href="'. get_template_directory_uri() . '/favicon.png" />';
        } else {
            return '<link rel="shortcut icon" href="'.esc_url($option['favicon']).'" />';
        }
    }
}

if ( ! function_exists('ts_overlay_effect_is_enabled')) {

    function ts_overlay_effect_is_enabled()
    {
        $option = get_option('shootback_styles', array('overlay_effect_for_images' => 'N'));

        if ($option['overlay_effect_for_images'] === 'Y') {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists('ts_overlay_effect_type')) {

    function ts_overlay_effect_type()
    {
        $option = get_option('shootback_styles', array('overlay_effect_type' => 'dots'));

        if ($option['overlay_effect_type'] === 'dots') {
            return 'dotted';
        } else {
            return 'stripes';
        }
    }
}


if ( ! function_exists('ts_get_logo')) {

    function ts_get_logo()
    {
        $option = get_option('shootback_styles', array('logo' => array(
                                                                    'type' => 'image',
                                                                    'retina_logo' =>'N',
                                                                    'retina_width' =>'0',
                                                                    'retina_height' =>'0'
                                                                )
                                                )
        );

        $retina_style = '';

        if ( $option['logo']['type'] === 'image' ){

            if ( trim($option['logo']['image_url']) !== '' ) {

                if ( $option['logo']['retina_logo'] === 'Y' ) {

                    $option['logo']['retina_width'] = (int)$option['logo']['retina_width'];
                    $option['logo']['retina_height'] = (int)$option['logo']['retina_height'];

                    if( $option['logo']['retina_width'] > 0 && $option['logo']['retina_height'] > 0 ) {
                        $option['logo']['retina_width'] = ceil($option['logo']['retina_width']/2);
                        $option['logo']['retina_height'] = ceil($option['logo']['retina_height']/2);

                        $retina_style = 'style="width: ' . $option['logo']['retina_width'] . 'px; ' . $option['logo']['retina_height'] . 'px;"';
                    } else {
                        $retina_style = '';
                    }
                }

                return '<img src="'.esc_url($option['logo']['image_url']).'" alt="'.get_bloginfo('name').'" ' . $retina_style . '/>';
            } else {

                if ($option['logo']['retina_logo'] === 'Y' ) {
                    $retina_style = 'style="width: ' . $option['logo']['retina_width']/2 . 'px; height: auto;"';
                } else {
                    $retina_style = '';
                }

                return '<img src="' . get_template_directory_uri() . '/images/logo.png" alt="' . get_bloginfo('name') . '" ' . $retina_style . '/>';
            }
        } else if($option['logo']['type'] === 'google'){
            $textLogo = (isset($option['logo']['text']) && !empty($option['logo']['text'])) ? esc_attr($option['logo']['text']) : get_bloginfo('name');
            return $textLogo;
        } else {
            return get_bloginfo('name');
        }
    }
}

if ( ! function_exists('ts_get_custom_fonts_css')) {
    add_filter( 'wp_image_editors', 'change_graphic_lib' );

    function change_graphic_lib($array) {
      return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
    }

    function ts_get_custom_fonts_css()
    {

        $options = get_option('shootback_typography');
        $optionsStyleLogo = get_option('shootback_styles');
        $optionsStyleLogo = (isset($optionsStyleLogo['logo'])) ? $optionsStyleLogo['logo'] : '';
        $options['logo'] = $optionsStyleLogo;
        $returnStyle = array('style' => '', 'links' => '');
        $arrayFonts = array();
        $protocol = is_ssl() ? 'https' : 'http';

        if( isset($options) && !empty($options) && is_array($options) ){
            foreach($options as $elementName => $option){

                $elementName = ($elementName == 'menu') ? '.ts-behold-menu, .ts-behold-menu .main-menu > .menu-item-has-children > a:after, .main-menu li' : $elementName;
                $elementName = ($elementName == 'logo') ? '.logo' : $elementName;

                $fontSize = (isset($option['font_size']) && is_numeric($option['font_size'])) ? 'font-size: ' . $option['font_size'] . 'px;' : '';
                $fontWeight = (isset($option['font_weight']) && ($option['font_weight'] == '400' || $option['font_weight'] == '700')) ? 'font-weight: ' . $option['font_weight'] . ';' : '';
                $fontStyle = (isset($option['font_style']) && ($option['font_style'] == 'normal' || $option['font_style'] == 'italic')) ? 'font-style: ' . $option['font_style'] . ';' : '';
                $fontName = (isset($option['font_name']) && !empty($option['font_name'])) ? $option['font_name'] : '';

                if( isset($option['type']) && $option['type'] == 'google' ){
                    if( isset($option['font_name']) && $option['font_name'] !== '0' ){
                        $font_family_name = str_replace('+', ' ', $fontName);
                        $returnStyle['style'] .= $elementName . '{' .
                                                          $fontSize .
                                                          "font-family: '" . $font_family_name . "';" .
                                                          $fontWeight .
                                                          $fontStyle .
                                                        '}';

                        if( !in_array($fontName, $arrayFonts) && $fontName !== 'Open+Sans' ){

                             $subsets = (isset($option['font_subsets']) && !empty($option['font_subsets'])) ? '&amp;subset=' . implode(',', $option['font_subsets']) : '&amp;subset=latin';
                             $fontName = str_replace(' ', '%20', $fontName);
                            $returnStyle['links'] .= '<link rel="stylesheet" href="' . $protocol . '://fonts.googleapis.com/css?family='. $fontName . ':400,400italic,700' . $subsets . '" type="text/css" media="all" />' . "\n";

                            $arrayFonts[] = $fontName;
                        }

                    }
                }else if( isset($option['type']) && $option['type'] == 'custom_font' ){

                    $fontFamily = (isset($option['font_family'])) ? "font-family: '" . $option['font_family'] . "';" : '';
                    $fileEot = (isset($option['font_eot'])) ? $option['font_eot'] : '';
                    $fileWoff = (isset($option['font_woff']) && !empty($option['font_woff'])) ? "url('" . $option['font_woff'] . "') format('woff')," : '';
                    $fileTtf = (isset($option['font_ttf']) && !empty($option['font_ttf'])) ? "url('" . $option['font_ttf'] . "') format('truetype')" : '';
                    $fileSvg = (isset($option['font_svg']) && !empty($option['font_svg'])) ? "url('" . $option['font_svg'] . "#" . $option['font_family'] . "') format('svg');" : ';';
                    $fileTtf = ($fileSvg == ';') ? $fileTtf : $fileTtf . ',';

                    if( !in_array($option['font_family'], $arrayFonts) ){
                        $returnStyle['style'] .= "@font-face{
                                            " . $fontFamily . "
                                            src: url('" . $fileEot . "');
                                            src: url('" . $fileEot . "?#iefix') format('embedded-opentype'),
                                                 " . $fileWoff . "
                                                 " . $fileTtf . "
                                                 " . $fileSvg . "
                                        }" . $elementName . "{
                                                                " . $fontFamily . "
                                                                " . $fontWeight . "
                                                                " . $fontStyle . "
                                                                " . $fontSize . "
                                                            }";
                        $arrayFonts[] = $fontName;
                    }else{
                        $returnStyle['style'] .= $elementName . "{
                                                           " . $fontFamily . "
                                                           " . $fontWeight . "
                                                           " . $fontStyle . "
                                                           " . $fontSize . "
                                                        }";
                    }

                }else if( isset($option['type']) && $option['type'] == 'image' ){

                }else{
                    $fontName = (isset($option['standard_font'])) ? $option['standard_font'] : 'Open+Sans';

                    if( !in_array($fontName, $arrayFonts) && $fontName !== 'Open+Sans' ){
                        $returnStyle['links'] .= '<link rel="stylesheet" href="' . $protocol . '://fonts.googleapis.com/css?family='. $fontName . ':400,400italic,700&amp;subset=latin" type="text/css" media="all" />' . "\n";
                        $arrayFonts[] = $fontName;
                    }
                    $font_family_name = str_replace('+', ' ', $fontName);
                    $returnStyle['style'] .= $elementName . '{' .
                                                                $fontSize .
                                                                "font-family: '" . $font_family_name . "';" .
                                                                $fontWeight .
                                                                $fontStyle .
                                                            '}';
                }
            }
        }

        return $returnStyle;
    }
}

function tsAddTypographyElement($specificId = '', $arrayValues, $elementName, $options = array()){


    $values = get_option($arrayValues);

    $values = (isset($values[$elementName]) && !empty($values[$elementName])) ? $values[$elementName] : '';

    $defaultOptions = array(
        'type' => array(
            'std'          => __('Standard fonts', 'shootback'),
            'google'       => __('Google fonts', 'shootback'),
            'custom_font' => __('Custom font', 'shootback')
        ),
        'font_weight'  => '',
        'font_size'    => '',
        'font_style'   => '',
        'text'         => '',
        'font_subsets' => ''
    );

    if( empty($options) ) $options = $defaultOptions;

    $type = (isset($values['type'])) ? $values['type'] : '';
    $fontName = (isset($values['font_name'])) ? esc_attr($values['font_name']) : '';
    $fontWeight = (isset($values["font_weight"])) ? $values["font_weight"] : '400';
    $fontStyle = (isset($values["font_style"])) ? $values["font_style"] : 'normal';
    $demoText = (isset($values['text']) && !empty($values['text'])) ? sanitize_text_field($values['text']) : 'Shootback';
    $fontFamily = (isset($values['font_family'])) ? $values['font_family'] : '';
    $fontSize = (isset($values['font_size'])) ? $values['font_size'] : '';
    $fontSubsets = (isset($values['font_subsets']) && is_array($values['font_subsets'])) ? $values['font_subsets'] : array('latin');
    $fontDefault = (isset($values['standard_font'])) ? $values['standard_font'] : 'Open+Sans';
    $imageUrl = (isset($values['image_url'])) ? esc_url($values['image_url']) : '';
    $retinaLogo = (isset($values['retina_logo']) && ($values['retina_logo'] == 'Y' || $values['retina_logo'] == 'N')) ? $values['retina_logo'] : 'Y';
    $retinaHeight = (isset($values['retina_height'])) ? esc_attr($values['retina_height']) : '';
    $retinaWidth = (isset($values['retina_width'])) ? esc_attr($values['retina_width']) : '';

    $subsetFormating = array();
    foreach ($fontSubsets as $subset) {
        $subsetFormating[] = "'". esc_attr($subset)."'";
    }
    $fontSubsets = implode(', ', $subsetFormating);

?>
    <div id="ts-typography-<?php echo $elementName ?>">
        <p><?php _e('Select type font', 'shootback'); ?></p>
        <select name="<?php echo $arrayValues; ?>[<?php echo $elementName ?>][type]" class="ts-type-font">
            <?php foreach($options['type'] as $optionValue => $textUser) : ?>
                <option <?php selected($type, $optionValue, true); ?> value="<?php echo $optionValue; ?>"><?php echo $textUser; ?></option>
            <?php endforeach; ?>
        </select>
        <?php if( isset($options['type']['google']) ) : ?>
            <div class="ts-google-fonts">
                <?php _e( 'Select font', 'shootback' ); ?>
                <script>
                    jQuery(document).ready(function($) {
                        ts_google_fonts(jQuery, {
                            font_name: '<?php echo esc_attr($fontName)?>',
                            selected_subsets: [<?php echo $fontSubsets; ?>],
                            allfonts: $("#fontchanger-<?php echo $elementName ?>"),
                            prefix: '<?php echo $elementName ?>',
                            subsetsTypes: $('.<?php echo $elementName ?>-subset-types'),
                            section: '<?php echo $arrayValues; ?>'
                        });
                    });
                </script>
                <select name="<?php echo $arrayValues; ?>[<?php echo $elementName ?>][font_name]" id="fontchanger-<?php echo $elementName ?>" class="ts-font-name">
                    <option value="0"><?php _e( 'No font selected', 'shootback' ); ?></option>
                </select>

                <?php if( isset($options['font_subsets']) ) : ?>
                    <p><?php _e( 'Available subsets:', 'shootback' ); ?></p>
                    <div class="<?php echo $elementName ?>-subset-types"></div>
                <?php endif; ?>

                <?php if( isset($options['font_style']) ) : ?>
                    <p><?php  _e('Font style', 'shootback'); ?></p>
                    <select name="<?php echo $arrayValues; ?>[<?php echo $elementName; ?>][font_style]" id="ts-<?php echo $elementName ?>-font-style">
                        <option value="normal" <?php selected($fontStyle, 'normal', true)?>><?php _e('Normal', 'shootback'); ?></option>
                        <option value="italic" <?php selected($fontStyle, 'italic', true) ?>><?php _e('Italic', 'shootback'); ?></option>
                    </select>
                <?php endif; ?>

                <?php if( isset($options['text']) ) : ?>
                    <p><?php _e('Logo text', 'shootback'); ?></p>
                    <textarea name="<?php echo $arrayValues; ?>[<?php echo $elementName; ?>][text]" id="<?php echo $elementName; ?>-demo" >
                        <?php echo $demoText ?>
                    </textarea>
                    <input type="button" name="ts-<?php echo $elementName; ?>-preview" id="ts-<?php echo $elementName; ?>-preview" class="button-primary" value="Preview"/><br />
                    <div class="<?php echo $elementName; ?>-output"></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="ts-font-options-parent" style="display: none">
            <div class="ts-font-options">

                <?php if( isset($options['font_weight']) ) : ?>
                    <div class="ts-font-weight">
                        <p><?php  _e('Font weight', 'shootback'); ?></p>
                        <select name="<?php echo $arrayValues; ?>[<?php echo $elementName; ?>][font_weight]" id="ts-<?php echo $elementName ?>-font-weight">
                            <option value="400" <?php selected($fontWeight, '400', true)?>><?php _e('Normal', 'shootback'); ?></option>
                            <option value="700" <?php selected($fontWeight, '700', true) ?>><?php _e('Bold', 'shootback'); ?></option>
                        </select>
                    </div>
                <?php endif; ?>

                <?php if( isset($options['font_size']) ) : ?>
                    <p><?php _e('Font size', 'shootback'); ?>:</p>
                    <input type="text" name="<?php echo $arrayValues; ?>[<?php echo $elementName; ?>][font_size]" value="<?php echo $fontSize; ?>" id="ts-<?php echo $elementName; ?>-font-size" />
                    <div class="ts-option-description">
                        <?php _e('This will affect the most of the website. Write your number (!integer) in PIXELS.', 'shootback'); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>

        <?php if( isset($options['type']['custom_font']) ) : $uploadCustomFonts = ''; ?>
            <div class="ts-custom-font">
                <?php foreach(array('eot', 'svg', 'ttf', 'woff') as $format) : ?>
                    <p><?php echo __('Upload file ', 'shootback') . '"' . $format . '"'; ?></p>
                    <input type="text" name="<?php echo $arrayValues; ?>[<?php echo $elementName ?>][font_<?php echo $format ?>]" value="<?php echo $values['font_' . $format]; ?>" id="atachment-<?php echo $elementName ?>-<?php echo $format ?>"/>
                    <input type="hidden" value="" id="file-<?php echo $elementName ?>-<?php echo $format; ?>"/>
                    <input type="button" class="button-primary" id="upload-<?php echo $elementName ?>-<?php echo $format ?>" value="<?php _e('Upload', 'shootback') ?>">
                    <?php $uploadCustomFonts .= 'ts_upload_files("#upload-' . $elementName . '-' . $format . '", "#file-' . $elementName . '-' . $format . '", "#atachment-' . $elementName . '-' . $format . '", "Upload file ' . $format . '");'; ?>
                <?php endforeach; ?>
                <p><?php _e('Enter font-family(stylesheet.css):', 'shootback'); ?></p>
                <input type="text" name="<?php echo $arrayValues; ?>[<?php echo $elementName ?>][font_family]" value="<?php echo $fontFamily; ?>" />
            </div>
        <?php endif; ?>

        <?php if( isset($options['type']['image']) ) : ?>
            <div class="ts-logo-image">
                <p><?php _e( 'Please select your logo', 'shootback' ); ?></p>
                <input type="text" name="<?php echo $arrayValues; ?>[<?php echo $elementName ?>][image_url]" value="<?php echo $imageUrl; ?>" id="atachment-<?php echo $elementName ?>"/>
                <input type="hidden" value="" class="image_media_id" id="file-<?php echo $elementName ?>" />
                <input type="button" class="button-primary" id="upload-<?php echo $elementName ?>" value="<?php _e('Upload image', 'shootback') ?>">

                <p><?php _e('Enable retina logo', 'shootback') ?></p>
                <select name="<?php echo $arrayValues; ?>[<?php echo $elementName; ?>][retina_logo]">
                    <option value="Y" <?php selected($retinaLogo, 'Y', true) ?>><?php _e('Yes', 'shootback'); ?></option>
                    <option value="N" <?php selected($retinaLogo, 'N', true) ?>><?php _e('No', 'shootback'); ?></option>
                </select>
                <input type="hidden" id="shootback_logo_retina_width" name="<?php echo $arrayValues; ?>[<?php echo $elementName; ?>][retina_width]" value="<?php echo $retinaWidth ?>"/>
                <input type="hidden" id="shootback_logo_retina_height" name="<?php echo $arrayValues; ?>[<?php echo $elementName; ?>][retina_height]" value="<?php echo $retinaHeight ?>"/>
                <?php $uploadImageLogo = 'ts_upload_files("#upload-' . $elementName . '", "#file-' . $elementName . '", "#atachment-' . $elementName . '");'; ?>
                <script>
                    jQuery(document).ready(function() {
                        <?php echo $uploadImageLogo; ?>
                    });
                </script>
            </div>
        <?php endif; ?>

        <?php if( isset($options['type']['std']) ) : ?>
            <input type="hidden" value="<?php echo $fontDefault; ?>" name="<?php echo $arrayValues; ?>[<?php echo $elementName ?>][standard_font]">
        <?php endif; ?>

        <script>
        jQuery(document).ready(function(){
            jQuery('.ts-type-font').change(function(){
                var fontOption = jQuery(this).parent('div').find('.ts-font-options-parent').html();
                if( jQuery(this).val() == 'google' ){
                    jQuery(this).parent('div').find('.ts-google-fonts').css('display', '');
                    jQuery(this).parent('div').find('.ts-google-fonts').find('.ts-font-options').remove();
                    jQuery(this).parent('div').find('.ts-google-fonts').find('.ts-font-name').after(fontOption);
                    jQuery(this).parent('div').find('.ts-custom-font').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-custom-font').find('.ts-font-options').remove();
                    jQuery(this).parent('div').find('.ts-logo-image').css('display', 'none');
                }else if( jQuery(this).val() == 'custom_font' ){
                    jQuery(this).parent('div').find('.ts-google-fonts').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-custom-font').find('.ts-font-options').remove();
                    jQuery(this).parent('div').find('.ts-custom-font').css('display', '').prepend(fontOption);
                    jQuery(this).parent('div').find('.ts-google-fonts').find('.ts-font-options').remove();
                    jQuery(this).parent('div').find('.ts-logo-image').css('display', 'none');
                }else if( jQuery(this).val() == 'image' ){
                    jQuery(this).parent('div').find('.ts-google-fonts').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-custom-font').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-logo-image').css('display', '');
                }else{
                    jQuery(this).parent('div').find('.ts-google-fonts').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-custom-font').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-font-options-parent').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-logo-image').css('display', 'none');
                }
            });
            jQuery('.ts-type-font').each(function(){
                var fontOption = jQuery(this).parent('div').find('.ts-font-options-parent').html();
                if( jQuery(this).val() == 'google' ){
                    jQuery(this).parent('div').find('.ts-google-fonts').css('display', '');
                    jQuery(this).parent('div').find('.ts-google-fonts').find('.ts-font-options').remove();
                    jQuery(this).parent('div').find('.ts-custom-font').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-google-fonts').find('.ts-font-name').after(fontOption);
                    jQuery(this).parent('div').find('.ts-logo-image').css('display', 'none');
                }else if( jQuery(this).val() == 'custom_font' ){
                    jQuery(this).parent('div').find('.ts-google-fonts').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-custom-font').find('.ts-font-options').remove();
                    jQuery(this).parent('div').find('.ts-custom-font').css('display', '').prepend(fontOption);
                    jQuery(this).parent('div').find('.ts-logo-image').css('display', 'none');
                }else if( jQuery(this).val() == 'image' ){
                    jQuery(this).parent('div').find('.ts-google-fonts').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-custom-font').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-logo-image').css('display', '');
                }else{
                    jQuery(this).parent('div').find('.ts-google-fonts').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-custom-font').css('display', 'none');
                    jQuery(this).parent('div').find('.ts-logo-image').css('display', 'none');
                }
            });

            <?php if( isset($options['type']['custom_font']) ) : ?>
                <?php echo $uploadCustomFonts; ?>
            <?php endif; ?>

            jQuery('#ts_submit_button').click(function(){
                jQuery('.ts-font-options-parent').each(function(){
                    jQuery(this).remove();
                });
            });
        });
        </script>

        <?php $tsIcons = 'icon-noicon,icon-image,icon-comments,icon-delete,icon-rss,icon-drag,icon-down,icon-up,icon-layout,icon-import,icon-play,icon-desktop,icon-social,icon-empty,icon-filter,icon-money,icon-flickr,icon-pinterest,icon-user,icon-video,icon-close,icon-link,icon-views,icon-quote,icon-pencil,icon-page,icon-post,icon-category,icon-time,icon-left,icon-right,icon-palette,icon-code,icon-sidebar,icon-vimeo,icon-lastfm,icon-logo,icon-heart,icon-list,icon-attention,icon-menu,icon-delimiter,icon-image-size,icon-settings,icon-share,icon-resize-vertical,icon-text,icon-movie,icon-dribbble,icon-yahoo,icon-facebook,icon-twitter,icon-tumblr,icon-gplus,icon-skype,icon-linkedin,icon-tick,icon-edit,icon-font,icon-home,icon-button,icon-wordpress,icon-music,icon-mail,icon-lock,icon-search,icon-github,icon-basket,icon-star,icon-link-ext,icon-award,icon-signal,icon-target,icon-attach,icon-download,icon-upload,icon-mic,icon-calendar,icon-phone,icon-headphones,icon-flag,icon-credit-card,icon-save,icon-megaphone,icon-key,icon-euro,icon-pound,icon-dollar,icon-rupee,icon-yen,icon-rouble,icon-try,icon-won,icon-bitcoin,icon-anchor,icon-support,icon-blocks,icon-block,icon-graduate,icon-shield,icon-window,icon-coverflow,icon-flight,icon-brush,icon-resize-full,icon-news,icon-pin,icon-params,icon-beaker,icon-delivery,icon-bell,icon-help,icon-laptop,icon-tablet,icon-mobile,icon-thumb,icon-briefcase,icon-direction,icon-ticket,icon-chart,icon-book,icon-print,icon-on,icon-off,icon-featured-area,icon-team,icon-login,icon-clients,icon-tabs,icon-tags,icon-gauge,icon-bag, icon-key,icon-glasses,icon-ok-full,icon-restart,icon-recursive,icon-shuffle,icon-ribbon,icon-lamp,icon-flash,icon-leaf,icon-chart-pie-outline,icon-puzzle,icon-fullscreen,icon-downscreen,icon-zoom-in,icon-zoom-out,icon-pencil-alt,icon-down-dir,icon-left-dir,icon-right-dir,icon-up-dir,icon-circle-outline,icon-circle-full,icon-dot-circled,icon-threedots,icon-colon,icon-down-micro,icon-cancel,icon-medal,icon-square-outline,icon-rhomb,icon-rhomb-outline'; ?>

        <div class="hidden"><input name="shootback_typography[icons]" type="hidden" value="<?php echo $tsIcons; ?>"></div>
    </div>
<?php
}


//================== Styles Tab =======================================================

if ( ! function_exists('ts_resize')) {

    function ts_resize($post_type, $image, $masonry = false) {

        $image_sizes = get_option('shootback_image_sizes');
        $options = array();

        switch ($post_type) {

            case 'grid':
                $options =  $image_sizes['grid'];
                break;

            case 'thumbnails':
                $options =  $image_sizes['thumbnails'];
                break;

            case 'bigpost':
                $options =  $image_sizes['bigpost'];
                break;

            case 'superpost':
                $options =  $image_sizes['superpost'];
                break;

            case 'single':
                $options =  $image_sizes['single'];
                break;

            case 'portfolio':
                $options =  $image_sizes['portfolio'];
                break;

            case 'featarea':
                $options =  $image_sizes['featarea'];
                break;

            case 'slider':
                $options =  $image_sizes['slider'];
                break;

            case 'carousel':
                $options =  $image_sizes['carousel'];
                break;

            case 'timeline':
                $options =  $image_sizes['timeline'];
                break;

            case 'features':
                $options =  array(
                    'width' => '100',
                    'height' => '100',
                    'mode' => 'crop'
                );

                break;

            default:
                return $image;
                break;
        }
        if( $masonry === false ){
            $crop = ($options['mode'] === 'crop') ? true : false;
            $options['height'] == 9999;
        } else{
            $crop = false;
        }
        $img_url = aq_resize( $image, $options['width'], $options['height'], $crop, true);

        return $img_url;
    }
}

//================== Single post Tab ==================================================

if ( ! function_exists('ts_single_related_posts')) {

    function ts_single_related_posts() {
        $single = get_option('shootback_single_post', array('related_posts' => 'Y'));

        if ($single['related_posts'] === 'Y') {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists('ts_single_social_sharing')) {

    function ts_single_social_sharing() {
        $single = get_option('shootback_single_post', array('social_sharing' => 'Y'));

        if ($single['social_sharing'] === 'Y') {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists('ts_single_display_meta')) {

    function ts_single_display_meta() {
        $single = get_option('shootback_single_post', array('post_meta' => 'Y'));

        if ($single['post_meta'] === 'Y') {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists('ts_single_display_tags')) {

    function ts_single_display_tags() {
        $single = get_option('shootback_single_post', array('post_tags' => 'Y'));

        if ($single['post_tags'] === 'Y') {
            return true;
        } else {
            return false;
        }
    }
}

//================== Page Tab ==================================================

if ( ! function_exists('ts_page_social_sharing')) {

    function ts_page_social_sharing() {
        $single = get_option('shootback_page', array('social_sharing' => 'Y'));

        if ($single['social_sharing'] === 'Y') {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists('ts_page_display_meta')) {

    function ts_page_display_meta() {
        $single = get_option('shootback_page', array('post_meta' => 'Y'));

        if ($single['post_meta'] === 'Y') {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists('hex2rgb')) {

    function hex2rgb($hex, $p) {
       $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       //$rgb = array($r, $g, $b);
       $rgb = 'rgba(' . $r.','. $g.','. $b.', '.$p . ')';

       //return implode(",", $rgb); // returns the rgb values separated by commas
       return $rgb; // returns an array with the rgb values
    }
}

if ( ! function_exists( 'tsz_get_alert' ) ) {

    function tsz_get_alert()
    {
        $red_area = get_option( 'shootback_red_area', array() );

        if ( isset( $red_area['alert']['id'], $red_area['alert']['message'] ) ) {

            if ( $red_area['alert']['id'] !== 0 && ! empty( $red_area['alert']['message'] ) ) {

                if ( is_array( $red_area['hidden_alerts'] ) ) {

                    if ( ! in_array( $red_area['alert']['id'], $red_area['hidden_alerts'] ) ) {

                        echo
                            '<div class="updated">
                                <p>' .
                                    $red_area['alert']['message'] .
                                    ' | <a href="#" class="ts-remove-alert" data-token="' . wp_create_nonce( 'remove-shootback-alert' ) . '" data-alets-id="' . $red_area['alert']['id'] . '">' . esc_html__('Hide', 'shootback') . '</a>
                                </p>
                            </div><br/>';
                    }
                }
            }
        }

        // Get alert if theme has updates.
        $updates = get_site_transient( 'update_themes' );
        $current = wp_get_theme();

        if ( isset( $updates->response[ strtolower( $current->Name ) ] ) && version_compare( $current->Version, $updates->response[ strtolower( $current->Name ) ]['new_version'], '<' ) ) {

            echo
                '<div class="updated">
                    <h3>' . __('Attention', 'shootback') . '!</h3>
                    <p>' . __( '<b>You are using an old version of the theme. To ensure maximum compatibility and bugs fixed please keep the theme up to date.</b> <br>Do not forget that changes done directly in the theme files will be lost, use only Custom CSS areas and child themes if you wish to make changes.', 'shootback' ) .
                        '<br><br><a href="' . network_admin_url( 'update-core.php' ) . '" class="button button-primary">' . __( 'Update now', 'shootback' ) . '</a>
                    </p>
                </div><br><br>';
        }

        $update_options = get_option( 'shootback_theme_update' );

        if  (
                ( empty( $update_options['update_options']['user_name'] ) || empty( $update_options['update_options']['key_api'] ) ) &&
                ( ! isset( $red_area['hidden_alerts'] ) || ! is_array( $red_area['hidden_alerts'] ) || ! in_array( 'empty-envato-info', $red_area['hidden_alerts'], true ) )
            )
        {
            echo
                '<div class="updated">
                    <p>' .
                        esc_html__( 'Insert api key and username.', 'shootback' ) .
                        '<a href="' . admin_url( 'themes.php?page=shootback&tab=theme_update' ) . '">' .
                            esc_html__( 'Set', 'shootback' ) .
                        '</a>' .
                        ' | '.
                        '<a href="#" class="ts-remove-alert" data-token="' . wp_create_nonce( 'remove-shootback-alert' ) . '" data-alets-id="empty-envato-info">' .
                            esc_html__( 'Hide', 'shootback' ) .
                        '</a>
                    </p>
                </div><br/>';
        }
    }
}
add_action( 'admin_notices', 'tsz_get_alert' );

$update_options = get_option( 'shootback_theme_update' );

if ( isset( $update_options['update_options'] ) ) {

    load_template( trailingslashit( get_template_directory() ) . 'includes/envato-wp-theme-updater.php' );

    new Envato_WP_Theme_Updater( $update_options['update_options']['user_name'], $update_options['update_options']['key_api'], 'upcode' );
}

if ( ! function_exists('ts_update_redarea')) {
    function ts_update_redarea() {
        $option = get_option('shootback_red_area', array());

        if (isset($option['time'])) {

            $current_time = time();

            if ( ($current_time - (int)$option['time']) >= 3600 ) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
}

if ( ! function_exists('theme_styles_rewrite')) {
    function theme_styles_rewrite() {
        // Get thene background color
        $theme = wp_get_theme();
        $nameTheme = (isset($theme) && is_object($theme)) ? $theme->name : '';
        $versionTheme = (isset($theme) && is_object($theme)) ? $theme->version : '';
        ?>
        <style type="text/css">
            /*************** Theme:  <?php echo $nameTheme; ?> *************/
            /*************** Theme Version:  <?php echo $versionTheme; ?> ************/
            /*
            --------------------------------------------------------------------------------
                1. GENERAL COLOR
            --------------------------------------------------------------------------------
            */
            body{
                color: <?php echo ts_get_color('general_text_color'); ?>;
            }
            .event-list-cal-excerpt{
                color: <?php echo ts_get_color('general_text_color'); ?>;
            }
            #event-list-cal a{
                color: <?php echo ts_get_color('general_text_color'); ?>;
            }
            .woocommerce #content div.product form.cart .variations label,
            .woocommerce div.product form.cart .variations label,
            .woocommerce-page #content div.product form.cart .variations label,
            .woocommerce-page div.product form.cart .variations label{
                color: <?php echo ts_get_color('general_text_color'); ?>;
            }
            #searchform input[type="submit"]{
                color: <?php echo ts_get_color('general_text_color'); ?>;
            }

            /*
            --------------------------------------------------------------------------------
                2. LINK COLOR
            --------------------------------------------------------------------------------
            */
            a{
                color: <?php echo ts_get_color('link_color'); ?>;
            }
            a:hover, a:focus{
                color: <?php echo ts_get_color('link_color_hover'); ?>;
            }
            .post-navigator ul li a:hover div{
                color: <?php echo ts_get_color('link_color_hover'); ?>;
            }
            .post-navigator ul li a div{
                color: <?php echo ts_get_color('link_color'); ?>;
            }
            .post-navigator ul li a:hover div{
                color: <?php echo ts_get_color('link_color_hover'); ?>;
            }

            /*
            --------------------------------------------------------------------------------
                3. PRIMARY COLOR
            --------------------------------------------------------------------------------
            */
            .joyslider .entry-category a,
            .single-ts-gallery .single_gallery4 .inner-gallery-container .bx-wrapper .bx-controls-direction a:before,
            .ts-vertical-gallery .inner-gallery-container .bx-wrapper .bx-controls-direction a:before{
                background: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .trigger-caption .button-trigger-cap{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .joyslider .entry-category a:hover{
                background: <?php echo ts_get_color('primary_color_hover'); ?>;
                color: <?php echo ts_get_color('primary_text_color_hover'); ?>;
            }
            .ts-post-nav > a:hover .inner-content{
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .view-video-play{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .rocky-effect .entry-overlay .view-more{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .joyslider .slide-preview:hover{
                border-top-color: <?php echo ts_get_color('primary_color'); ?>;;
            }
            .carousel-wrapper ul.carousel-nav > li, .carousel-wrapper ul.carousel-nav > li .hidden_btn{
                background: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-video-fancybox{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-video-fancybox:hover{
                color: <?php echo ts_get_color('primary_text_color_hover'); ?>;
                background-color: <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            .btn.article-view-more:hover {
                color: <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            .ts-pricing-view article.featured .featured_emblem{
                background: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-pricing-view article > header .entry-title .title,
            .ts-pricing-view article > footer > a{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-pricing-view article > footer > a:hover{
                color: <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            .woocommerce span.onsale-after,
            .woocommerce-page span.onsale-after{
                border-bottom: 10px solid <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            .single-ts-gallery .entry-meta .entry-category > li > a:hover{
                color: <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            .ts-big-countdown li i {
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .product_meta{
                border-bottom-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .search #main .archive-title{
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .single-event .event-meta > li.delimiter,
            .single-event .event-meta > li.repeat{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .event-list-cal-single{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-powerlink header .content .title:before, .ts-powerlink header .content .title:after{
                background: <?php echo ts_get_color('primary_color'); ?>;
            }
            .mosaic-view article .ts-sep-wrap,
            .ts-thumbnail-view .ts-sep-wrap{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .flickr_badge_image:hover a img{
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .post-slider .post-slider-list .entry-title h4 i{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .bx-wrapper .slider-caption .title a{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .bx-wrapper .slider-caption .title a:hover{
                color: <?php echo ts_get_color('primary_text_color_hover'); ?>;
                background-color: <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            .teams article .ts-sep-wrap{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            body.shootback .wp-playlist-light .wp-playlist-playing,
            body.shootback .mejs-controls .mejs-time-rail .mejs-time-current{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .post-meta ul li i{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .woocommerce #content div.product p.price,
            .woocommerce #content div.product span.price,
            .woocommerce div.product p.price,
            .woocommerce div.product span.price,
            .woocommerce-page #content div.product p.price,
            .woocommerce-page #content div.product span.price,
            .woocommerce-page div.product p.price,
            .woocommerce-page div.product span.price,
            .woocommerce .woocommerce-message,
            .woocommerce-page .woocommerce-message {
                color: <?php echo ts_get_color('primary_color') ?>;
            }
            .woocommerce span.onsale,
            .woocommerce-page span.onsale,
            .woocommerce #content div.product .woocommerce-tabs ul.tabs li{
                background: <?php echo ts_get_color('primary_color') ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a:after,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:after,
            .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a:after,
            .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a:after{
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .woocommerce #content .woocommerce-result-count{
                color: <?php echo ts_get_color('primary_color'); ?>;
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
            .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
            .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
            .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .woocommerce .widget_layered_nav_filters ul li a,
            .woocommerce-page .widget_layered_nav_filters ul li a{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .woocommerce #content .quantity .minus:hover,
            .woocommerce .quantity .minus:hover,
            .woocommerce-page #content .quantity .minus:hover,
            .woocommerce-page .quantity .minus:hover,
            .woocommerce #content .quantity .plus:hover,
            .woocommerce .quantity .plus:hover,
            .woocommerce-page #content .quantity .plus:hover,
            .woocommerce-page .quantity .plus:hover{
                background-color: <?php echo ts_get_color('primary_color_hover'); ?>;
                color: <?php echo ts_get_color('primary_text_color_hover'); ?>;
            }
            .woocommerce #content input.button.alt,
            .woocommerce #respond input#submit.alt,
            .woocommerce a.button.alt,
            .woocommerce button.button.alt,
            .woocommerce input.button.alt,
            .woocommerce-page #content input.button.alt,
            .woocommerce-page #respond input#submit.alt,
            .woocommerce-page a.button.alt,
            .woocommerce-page button.button.alt,
            .woocommerce-page input.button.alt{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .woocommerce #content input.button.alt:hover,
            .woocommerce #respond input#submit.alt:hover,
            .woocommerce a.button.alt:hover,
            .woocommerce button.button.alt:hover,
            .woocommerce input.button.alt:hover,
            .woocommerce-page #content input.button.alt:hover,
            .woocommerce-page #respond input#submit.alt:hover,
            .woocommerce-page a.button.alt:hover,
            .woocommerce-page button.button.alt:hover,
            .woocommerce-page input.button.alt:hover{
                background: <?php echo ts_get_color('primary_color_hover'); ?> !important;
                color: <?php echo ts_get_color('primary_text_color_hover'); ?> !important;
            }
            .woocommerce .woocommerce-info,
            .woocommerce-page .woocommerce-info,
            .woocommerce .woocommerce-message,
            .woocommerce-page .woocommerce-message{
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .woocommerce .woocommerce-error,
            .woocommerce-page .woocommerce-error{
                border-color: #a80023;
            }
            .woocommerce .woocommerce-error:before,
            .woocommerce-page .woocommerce-error:before{
                color: #a80023;
            }
            .woocommerce .woocommerce-info:before,
            .woocommerce-page .woocommerce-info:before,
            .woocommerce .woocommerce-message:before,
            .woocommerce-page .woocommerce-message:before{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .product-view .overlay-effect .entry-overlay > a:not(.entry-view-more){
                color: <?php echo ts_get_color('primary_text_color'); ?>;
                background-color: <?php echo ts_get_color('primary_color') ?>
            }
            .product-view .overlay-effect .entry-overlay > a:not(.entry-view-more):hover{
                color: <?php echo ts_get_color('primary_text_color_hover'); ?> !important;
                background-color: <?php echo ts_get_color('primary_color_hover'); ?> !important;
            }
            .block-title-lineariconcenter .block-title-container i[class^="icon"]{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-clients-view div[data-tooltip]:hover:before {
                background-color: <?php echo hex2rgb(ts_get_color('primary_color'), '0.8'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-clients-view div[data-tooltip]:hover:after {
                border-top-color: <?php echo hex2rgb(ts_get_color('primary_color'), '0.8'); ?>;
            }
            .ts-mega-menu .main-menu .ts_is_mega_div .title:after,
            .ts-mobile-menu .main-menu .ts_is_mega_div .title:after{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-header-menu .main-menu .current-menu-item > a,
            .ts-header-menu .main-menu .current-menu-parent > a,
            .ts-header-menu .main-menu .current-menu-ancestor > a,
            .ts-mobile-menu .main-menu .current-menu-item > a,
            .ts-mobile-menu .main-menu .current-menu-parent > a,
            .ts-mobile-menu .main-menu .current-menu-ancestor  > a,
            .ts-sticky-menu .main-menu .current-menu-item > a,
            .ts-sticky-menu .main-menu .current-menu-parent > a,
            .ts-sticky-menu .main-menu .current-menu-ancestor  > a{
                color: <?php echo ts_get_color('primary_color'); ?> !important;
            }
            .ts-header-menu .menu-item-has-children .sub-menu li .ts_taxonomy_views a.view-more{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-header-menu .menu-item-has-children .sub-menu li .ts_taxonomy_views a.view-more:hover{
                color: <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            .ts-big-posts .ts-sep-wrap:after{
                background-color: <?php echo hex2rgb(ts_get_color('primary_color'),0.5); ?>;
            }
            .tags-container a.tag, .tags-container a[rel="tag"]{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-thumbnail-view .thumb-post-categories a,
            .ts-grid-view .grid-post-categories a,
            .ts-big-posts .big-post-categories a,
            .ts-super-posts .ts-super-posts-categories a{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-thumbnail-view .thumb-post-categories a:hover,
            .ts-grid-view .grid-post-categories a:hover,
            .ts-big-posts .big-post-categories a:hover,
            .ts-super-posts .ts-super-posts-categories a:hover{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            #searchbox input[type="text"]:focus{
                border-bottom-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            #searchbox input.searchbutton:hover + i.icon-search{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .search-no-results .searchpage,
            .search .attention{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .video-single-resize:hover b{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            #commentform .form-submit input[type="submit"]{
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .widget-title:after {
                background: <?php echo ts_get_color('primary_color'); ?>;
            }
            .callactionr a.continue,
            .commentlist > li .comment .comment-reply-link{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .block-title-lineafter .block-title-container .the-title:after{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-grid-view .entry-meta a, .ts-big-posts .big-post-meta a{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-list-view .readmore{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-super-posts .title-holder{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-thumbnail-view .item-hover span, .ts-grid-view .item-hover span{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-grid-view .readmore:hover{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-filters li.active a{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-filters li.active:after{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-filters li a:not(.active):hover{
                color: <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            .post-navigator ul li a{
                border-top-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .post-navigator ul li a:hover{
                border-top-color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            #commentform .form-submit input[type="submit"]{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .listed-two-view .item-hover, .ts-big-posts .item-hover{
                background-color: <?php echo hex2rgb(ts_get_color('primary_color'), '0.8') ?>;
            }
            .block-title-linerect .block-title-container:before{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .teams article:hover .image-holder img{
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .delimiter.iconed:before{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .block-title-leftrect .block-title-container:before{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            a.tag:hover, a[rel="tag"]:hover{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            input.contact-form-submit,
            #nprogress .bar {
                background: <?php echo ts_get_color('primary_color'); ?>;
            }
            #nprogress .spinner-icon {
                border-top-color: <?php echo ts_get_color('primary_color'); ?>;
                border-left-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .post-slider .post-slider-list .entry-category ul li a, .post-slider .main-entry .entry-category a{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .post-slider .main-entry .entry-content .entry-title:hover{
                border-right-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-pagination ul .page-numbers{
                background: #f7f7f7;
                color: #343434;
            }
            .ts-pagination ul .page-numbers.current{
                background: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .slyscrollbar .handle{
                background: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-grid-view article .entry-footer .btn-play-video:hover > i{
                background: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .btn:hover,
            .btn:active,
            .btn:focus{
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .btn.active{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .views-read-more{
                background: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?> !important;
            }
            .mCS-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{
                background: <?php echo ts_get_color('primary_color'); ?>;
            }
            .mCS-dark.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar:hover,
            .mCS-dark.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{
                background: <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            .ts-powerlink header .content .title{
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .nav-tabs .tab-item.active > a:before,
            .nav-tabs .tab-item.active > a:hover:before,
            .nav-tabs .tab-item.active > a:focus:before{
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-tags-container > a:after,
            .ts-tags-container a.tag:hover,
            article .default-effect .overlay-effect .view-more > span:before,
            article .default-effect .overlay-effect .view-more > span:after{
                background: <?php echo ts_get_color('primary_color'); ?>;
            }
            article[data-sticky="is-sticky"] .is-sticky-div{
                color: <?php echo ts_get_color('primary_text_color'); ?>;
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            #ts-timeline .timeline-entry:before,
            .ts-grid-view article .entry-footer .btn-grid-more:hover > i{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-video-carousel .nav-arrow .nav-icon{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .mosaic-view article .ts-sep-wrap:after,
            .ts-thumbnail-view .ts-sep-wrap:before,
            .ts-thumbnail-view .ts-sep-wrap:after{
                background: <?php echo ts_get_color('primary_color'); ?>;
            }
            .post-content .event-meta-details li i{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .post-author-box + .delimiter i{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-get-calendar.ts-next:hover, .ts-get-calendar.ts-prev:hover{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-event-title a{
                background: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-small-countdown .time-remaining li > span{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .main-menu > .current-menu-ancestor:after,
            .main-menu > .current_page_item:after{
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-grid-view article a,
            .ts-thumbnail-view article a,
            .ts-big-posts article a,
            .ts-list-view article a,
            .ts-super-posts article a,
            .product-view article a,
            .ts-timeline a,
            .ts-article-accordion .inner-content a{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-grid-view article a:hover,
            .ts-thumbnail-view article a:hover,
            .ts-big-posts article a:hover,
            .ts-big-posts article .title a:hover,
            .ts-list-view article a:hover,
            .ts-super-posts article a:hover,
            .product-view article a:hover,
            .ts-timeline a:hover,
            .ts-article-accordion .inner-content a:hover {
                color: <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            .product-view article .grid-shop-button .button.add_to_cart_button{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .product-view article .grid-shop-button .button.add_to_cart_button:hover{
                background-color: <?php echo ts_get_color('primary_color_hover'); ?>;
                color: <?php echo ts_get_color('primary_text_color_hover'); ?>;
            }
            .ts-super-posts .entry-meta .entry-meta-likes{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-timeline section .entry-meta:before{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                border-color: #fff;
            }
            .ts-lima-effect .lima-details .more-details{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-powerlink header .content .button{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-iconbox-bordered figure figcaption .btn,
            .ts-iconbox-background figure figcaption .btn{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-iconbox-bordered figure figcaption .btn:hover,
            .ts-iconbox-background figure figcaption .btn:hover{
                background-color: <?php echo ts_get_color('primary_color_hover'); ?>;
                color: <?php echo ts_get_color('primary_text_color_hover'); ?>;
            }
            .ts-article-accordion .panel-heading .entry-icon{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .teams article .image-holder .team-box-square:before,
            .teams article .image-holder .team-box-square:after,
            .teams article .image-holder .team-box-square2:before,
            .teams article .image-holder .team-box-square2:after{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .teams article h4 a:hover{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .single .post-rating .rating-items li .rating-title:before{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .single_style2 .post-categories li a,
            .single_style3 .post-categories li a,
            .single_style5 .post-categories li a,
            .single_style6 .post-categories li a{
                background-color: <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_text_color'); ?>;
            }
            .ts-pagination-more{
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .ts-pagination-more:before, .ts-pagination-more:after, .ts-pagination-more span:before, .ts-pagination-more span:after{
                background: <?php echo ts_get_color('primary_color'); ?>;
            }
            .testimonials .entry-section .inner-section .author-name a:hover{
                color: <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            .nav-fillslide a.prev .icon-wrap, .nav-fillslide a.next .icon-wrap{
                border-color: <?php echo ts_get_color('primary_color'); ?>;
                color: #555;
            }
            .nav-fillslide h3 {
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            #searchbox .hidden-form-search i.icon-search:hover{
                color: <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            #searchbox .hidden-form-search .search-close{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            #searchbox .hidden-form-search .search-close:hover{
                color: <?php echo ts_get_color('primary_color_hover'); ?>;
            }
            .ts-select-by-category li.active a{
                border-top: 2px solid <?php echo ts_get_color('primary_color'); ?>;
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            #mc4wp_email:active,
            #mc4wp_email:focus{
                border-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .mc4wp-form input[type="submit"]{
                color: <?php echo ts_get_color('primary_text_color'); ?>;
                background-color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .mc4wp-form input[type="submit"]:hover{
                background-color: <?php echo ts_get_color('primary_color_hover'); ?>;
                color: <?php echo ts_get_color('primary_text_color_hover'); ?>;
            }
            .post-tags .tags-container a[rel="tag"]{
                color: <?php echo ts_get_color('primary_color'); ?>;
            }
            .post-tags .tags-container a[rel="tag"]:hover{
                color: <?php echo ts_get_color('primary_color_hover'); ?>;
            }

            /*
            --------------------------------------------------------------------------------
                4. SECONDARY COLOR
            --------------------------------------------------------------------------------
            */
            .post-edit-link{
                color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .post-edit-link:hover{
                color: <?php echo ts_get_color('secondary_color_hover'); ?>;
                border-color: <?php echo ts_get_color('secondary_color_hover'); ?>;
            }
            .ts-big-countdown .time-remaining > li > div{
                color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .single-event .event-time{
                color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .event-list-cal th {
                background-color: <?php echo ts_get_color('secondary_color'); ?>;
                color: <?php echo ts_get_color('secondary_text_color'); ?>;
                border-color: <?php echo ts_get_color('secondary_color_hover'); ?>;
                text-shadow: 1px 1px 0 <?php echo ts_get_color('secondary_color_hover'); ?>;
            }
            .event-list-cal td.today .event-list-cal-day{
                background-color: <?php echo ts_get_color('secondary_color'); ?>;
                color: <?php echo ts_get_color('secondary_text_color'); ?>;
                text-shadow: 1px 1px 0px <?php echo ts_get_color('secondary_color_hover'); ?>;
            }
            .widget_list_events .widget-meta .date-event .day{
                color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .ts-thumbnail-view article:hover .ts-sep-wrap{
                color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .bx-wrapper .slider-caption .sub{
                background-color: <?php echo ts_get_color('secondary_color'); ?>;
                color: <?php echo ts_get_color('secondary_text_color'); ?>;
            }
            .ts-bxslider .controls-direction span a{
                background-color: <?php echo ts_get_color('secondary_color'); ?>;
                color: <?php echo ts_get_color('secondary_text_color'); ?>;
            }
            .bx-wrapper .bx-pager.bx-default-pager a.active{
                background-color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .teams article .article-title{
                color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .ts-team-single .member-content .member-name .category > li{
                background-color: <?php echo ts_get_color('secondary_color'); ?>;
                color: <?php echo ts_get_color('secondary_text_color'); ?>;
            }
            .single-portfolio .page-title{
                color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .woocommerce #content .quantity .minus,
            .woocommerce .quantity .minus,
            .woocommerce-page #content .quantity .minus,
            .woocommerce-page .quantity .minus,
            .woocommerce #content .quantity .plus,
            .woocommerce .quantity .plus,
            .woocommerce-page #content .quantity .plus,
            .woocommerce-page .quantity .plus{
                background-color: <?php echo ts_get_color('secondary_color'); ?>;
                color: <?php echo ts_get_color('secondary_text_color'); ?>;
            }
            .woocommerce #content input.button,
            .woocommerce #respond input#submit,
            .woocommerce a.button,
            .woocommerce button.button,
            .woocommerce input.button,
            .woocommerce-page #content input.button,
            .woocommerce-page #respond input#submit,
            .woocommerce-page a.button,
            .woocommerce-page button.button,
            .woocommerce-page input.button,
            .woocommerce .woocommerce-error .button,
            .woocommerce .woocommerce-info .button,
            .woocommerce .woocommerce-message .button,
            .woocommerce-page .woocommerce-error .button,
            .woocommerce-page .woocommerce-info .button,
            .woocommerce-page .woocommerce-message .button{
                background: transparent;
                color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .woocommerce #content input.button:hover,
            .woocommerce #respond input#submit:hover,
            .woocommerce a.button:hover,
            .woocommerce button.button:hover,
            .woocommerce input.button:hover,
            .woocommerce-page #content input.button:hover,
            .woocommerce-page #respond input#submit:hover,
            .woocommerce-page a.button:hover,
            .woocommerce-page button.button:hover,
            .woocommerce-page input.button:hover{
                background: transparent;
                color: <?php echo ts_get_color('secondary_color_hover'); ?>;
            }
            .woocommerce .product-view a.button:after,
            .woocommerce .product-view button.button:after,
            .woocommerce .product-view input.button:after{
                background-color: <?php echo ts_get_color('secondary_color'); ?>
            }
            .woocommerce .product-view a.button:hover:after,
            .woocommerce .product-view button.button:hover:after,
            .woocommerce .product-view input.button:hover:after{
                background-color: <?php echo ts_get_color('secondary_color_hover'); ?>
            }
            .product-view .overlay-effect .entry-overlay > a{
                color: <?php echo ts_get_color('secondary_text_color'); ?>;
                background-color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .product-view .overlay-effect .entry-overlay > a:hover{
                color: <?php echo ts_get_color('secondary_text_color_hover'); ?>;
                background-color: <?php echo ts_get_color('secondary_color_hover'); ?>;
            }
            .tags-container a.tag:hover, .tags-container a[rel="tag"]:hover{
                background-color: <?php echo ts_get_color('secondary_color'); ?>;
                color: <?php echo ts_get_color('secondary_text_color_hover'); ?>;
            }
            .callactionr a.continue:hover{
                background-color: <?php echo ts_get_color('secondary_color'); ?>;
                color: <?php echo ts_get_color('secondary_text_color'); ?>;
            }
            .ts-grid-view .item-hover{
                background-color: <?php echo hex2rgb(ts_get_color('secondary_color'), '0.8') ?>;
            }
            .teams article:hover .article-title{
                border-color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .ts-pagination ul .page-numbers:hover{
                background: <?php echo ts_get_color('secondary_color'); ?>;
                color: <?php echo ts_get_color('secondary_text_color'); ?>;
            }
            .touchsize-likes .touchsize-likes-count:before,
            .post-meta .post-meta-likes span.touchsize-likes-count:before{
                color: #ca1913;
            }
            .touchsize-likes.active .touchsize-likes-count:before,
            .post-meta .post-meta-likes .touchsize-likes.active span.touchsize-likes-count:before{
                color: #b80000;
            }
            .purchase-btn{
                color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .purchase-btn:hover{
                background: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .ts-powerlink header .content .button:hover{
                background-color: <?php echo ts_get_color('secondary_color_hover'); ?>;
                color: <?php echo ts_get_color('secondary_text_color_hover'); ?>;
            }
            .ts-timeline .timeline-view-more i, .ts-pagination-more:hover > i{
                color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .ts-small-countdown .time-remaining li > i{
                color: <?php echo ts_get_color('secondary_color'); ?>;
            }
            .ts-events-calendar tr td.calendar-day-head{
                background: <?php echo ts_get_color('secondary_color'); ?>;
                color: <?php echo ts_get_color('secondary_text_color'); ?>;
            }

            /*
            --------------------------------------------------------------------------------
                5. META COLOR
            --------------------------------------------------------------------------------
            */
            .product-view article .entry-categories a,
            .ts-post-nav .post-nav-content .content-wrapper >  span{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .ts-pricing-view article > header .entry-box .pricing-price > .period,
            .ts-pricing-view article > header .entry-box .pricing-price > .currency{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .btn.article-view-more {
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .mega-menu-item-description{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .archive-title span,
            .archive-desc p,
            footer .related .related-list .related-content .ts-view-entry-meta-date,
            .ts-timeline-view .entry-meta .post-date-add,
            .ts-grid-view article .ts-view-entry-meta-date,
            .ts-bigpost-view article .ts-view-entry-meta-date,
            .ts-list-view article .ts-view-entry-meta-date,
            .ts-list-view .entry-meta-likes a{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .ts-big-countdown .time-remaining > li > span,
            article .entry-category,
            article .entry-category > li > a{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .single-event .event-meta > li span.meta{
                color: <?php echo ts_get_color('meta_color'); ?>;
                font-size: 13px;
            }
            .widget_list_events .widget-meta .date-event .month{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .post-title-meta,
            .post-details-title,
            .post-title-meta .post-categories a,
            .post-title-meta .touchsize-likes,
            .post-title-meta .post-title-meta-categories > i,
            .post-tagged-icon > i{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .teams article .article-position{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .ts-team-single .member-content .position{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .testimonials .inner-header .header-icon,
            .testimonials .inner-footer .footer-icon,
            .testimonials .entry-section .inner-section .author-position{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .post-title-meta, .ts-big-posts .big-post-meta > ul > li, .ts-grid-view .entry-meta > li, .views-delimiter{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .single .page-subtitle{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .search-results .searchcount{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            article.type-post .page-title .touchsize-likes .touchsize-likes-count{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .ts-cool-share label > span,
            .ts-cool-share ul li .how-many{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .time-remaining li span{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .ts-grid-view article .entry-category,
            .ts-big-posts article .entry-category,
            .ts-thumbnail-view article[data-title-position="below-image"] .entry-category,
            .ts-thumbnail-view article[data-title-position="below-image"] .entry-date,
            .ts-big-posts .entry-meta ul li{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .ts-thumbnail-view article[data-title-position="over-image"]:hover .meta-dates .entry-date{
                color: <?php echo ts_get_color('meta_color'); ?>;
                text-shadow: none;
            }
            .ts-thumbnail-view article[data-title-position="over-image"]:hover .meta-dates .entry-date span:before,
            .ts-thumbnail-view article[data-title-position="over-image"]:hover .meta-dates .entry-date span:after{
                background-color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .entry-meta{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .ts-timeline section .entry-author,
            .ts-timeline section .entry-meta ul .meta-month,
            .ts-list-view .entry-meta-date{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .ts-featured-area .featured-area-content .entry-content .entry-meta,
            .ts-featured-area.posts-right-of-main-image .featured-area-content .entry-content .entry-meta-likes,
            .ts-featured-area .featured-area-tabs .entry-meta-date,
            .ts_taxonomy_views .ts-date{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .ts-article-accordion .entry-meta-date{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .teams article .article-excerpt{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .single .entry-meta .post-meta,
            .single .touchsize-likes .touchsize-likes-count,
            .single .post-meta-categories > a{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .nav-fillslide div span {
                color: <?php echo ts_get_color('meta_color'); ?>;
                border-color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .nav-fillslide p{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .widget_most_viewed .count-item,
            .widget_most_liked .count-item{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .ts-video-carousel .slides .carousel-meta li{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .single-ts-gallery .inner-gallery-container .overlay-effect .entry-overlay .entry-controls > li > a,
            .ts-gallery-element .overlay-effect .entry-overlay .entry-controls > li > a{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .single-ts-gallery .single_gallery1 .entry-controls > li > a,
            .ts-gallery-element .entry-controls > li > a{
                border-color: <?php echo ts_get_color('meta_color'); ?>;
            }
            article .entry-category > li > a,
            .single-ts-gallery .entry-category > li > a{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .protected-post-form .lead{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }
            .single-ts-gallery .inner-gallery-container .overlay-effect .entry-overlay .social-sharing > li > a,
            .ts-gallery-element .overlay-effect .entry-overlay .social-sharing > li > a{
                color: <?php echo ts_get_color('meta_color'); ?>;
            }

            /*
            --------------------------------------------------------------------------------
                6. VIEWS COLOR
            --------------------------------------------------------------------------------
            */
            .ts-grid-view article,
            .ts-list-view article,
            .ts-big-posts article,
            .mosaic-view article,
            .ts-thumbnail-view article[data-title-position="below-image"],
            .ts-thumbnail-view article[data-title-position="over-image"],
            .ts-timeline article,
            .product-view article section,
            .ts-thumbnail-view article[data-title-position="over-image"]:hover .entry-content {
                background-color: <?php echo ts_get_color('view_background_color'); ?>;
            }
            .ts-banner-box{
                border-color: <?php echo ts_get_color('view_background_color'); ?>;
            }
            .ts-tab-container .tab-content > .tab-pane{
                background-color: <?php echo ts_get_color('view_background_color'); ?>;
            }
            .tweet-entry{
                background: <?php echo ts_get_color('view_background_color'); ?>;
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .ts-grid-view article .entry-title a,
            .ts-thumbnail-view article .entry-title a,
            .ts-big-posts article .title a,
            .ts-list-view article .entry-title a,
            .product-view article .entry-title a,
            .ts-timeline .entry-title a{
                color: <?php echo ts_get_color('view_link_color'); ?>;
            }
            .ts-grid-view .entry-meta-date > li.meta-date,
            .ts-big-posts .entry-meta ul li.meta-date,
            .ts-list-view .entry-meta ul li.meta-date{
                color: <?php echo ts_get_color('view_link_color'); ?>;
            }
            .post-tags .tags-container a[rel="tag"]:hover{
                background-color: transparent;
            }
            .ts-grid-view article .entry-title a:hover,
            .ts-big-posts article .entry-title .title a:hover,
            .ts-list-view article .entry-title a:hover,
            .product-view article .entry-title a:hover,
            .ts-timeline .entry-title a:hover{
                color: <?php echo ts_get_color('view_link_color_hover'); ?>;
            }
            .ts-thumbnail-view article[data-title-position="over-image"]:hover .entry-title .title,
            .ts-thumbnail-view article[data-title-position="over-image"]:hover .entry-category > li,
            .ts-thumbnail-view article[data-title-position="over-image"]:hover .entry-category > li > a{
                color: <?php echo ts_get_color('view_link_color'); ?>;
                text-shadow: none;
            }
            .ts-featured-area .featured-area-content .btn{
                background-color: <?php echo ts_get_color('view_background_color'); ?>;
            }
            .single .post-meta-author .author-name,
            .single .entry-meta .entry-meta-date .meta-date,
            .single span.tagged,
            .single-ts-gallery .single_gallery1 a.collapse-side > i{
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .single .single-content .inner-single-content,
            .single-post .single-meta-sidebar .inner-aside{
                background-color: <?php echo ts_get_color('view_background_color'); ?>;
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .ts-article-accordion article section,
            .ts-article-accordion article section .entry-title{
                background-color: <?php echo ts_get_color('view_background_color'); ?>;
            }
            .ts-article-accordion article section .entry-title .title a{
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .ts-article-accordion .panel-heading{
                background-color: <?php echo ts_get_color('view_background_color'); ?>;
            }
            .teams article{
                background-color: <?php echo ts_get_color('view_background_color'); ?>;
            }
            .teams article h4 a,
            .single .entry-title .post-title{
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .post-author-box > .author-title{
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .single-product .woocommerce-tabs .panel{
                background-color: <?php echo ts_get_color('view_background_color'); ?>;
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .woocommerce div.product .woocommerce-tabs ul.tabs li a{
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .ts-big-posts .entry-excerpt:before {
                background: -moz-linear-gradient(top,  <?php echo hex2rgb(ts_get_color('view_background_color'), '0'); ?> 0%, <?php echo hex2rgb(ts_get_color('view_background_color'), '0.85'); ?> 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo hex2rgb(ts_get_color('view_background_color'), '0'); ?>), color-stop(100%,<?php echo hex2rgb(ts_get_color('view_background_color'), '0.85'); ?>)); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  <?php echo hex2rgb(ts_get_color('view_background_color'), '0'); ?> 0%,<?php echo hex2rgb(ts_get_color('view_background_color'), '0.85'); ?> 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  <?php echo hex2rgb(ts_get_color('view_background_color'), '0'); ?> 0%,<?php echo hex2rgb(ts_get_color('view_background_color'), '0.85'); ?> 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  <?php echo hex2rgb(ts_get_color('view_background_color'), '0'); ?> 0%,<?php echo hex2rgb(ts_get_color('view_background_color'), '0.85'); ?> 100%); /* IE10+ */
                background: linear-gradient(top bottom,  <?php echo hex2rgb(ts_get_color('view_background_color'), '0'); ?> 0%,<?php echo hex2rgb(ts_get_color('view_background_color'), '0.85'); ?> 100%); /* W3C */
            }
            .single-ts-gallery .inner-gallery-container .overlay-effect[data-trigger-caption="with-caption"].shown .entry-overlay:after,
            .ts-gallery-element .overlay-effect[data-trigger-caption="with-caption"].shown .entry-overlay:after{
                background: -moz-linear-gradient(top,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0'); ?> 0%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0.5'); ?> 10%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0.95'); ?> 25%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'1'); ?> 100%);
                background: -webkit-gradient(linear, left top, left bottom,
                    color-stop(0%,<?php echo hex2rgb(ts_get_color('view_background_color'),'0'); ?>),
                    color-stop(10%,<?php echo hex2rgb(ts_get_color('view_background_color'),'0.5'); ?>),
                    color-stop(25%,<?php echo hex2rgb(ts_get_color('view_background_color'),'1'); ?>),
                    color-stop(100%,<?php echo hex2rgb(ts_get_color('view_background_color'),'1'); ?>));
                background: -webkit-linear-gradient(top,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0'); ?> 0%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0.5'); ?> 10%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0.95'); ?> 25%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'1'); ?> 100%);
                background: -o-linear-gradient(top,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0'); ?> 0%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0.5'); ?> 10%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0.95'); ?> 25%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'1'); ?> 100%);
                background: -ms-linear-gradient(top,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0'); ?> 0%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0.5'); ?> 10%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0.95'); ?> 25%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'1'); ?> 100%);
                background: linear-gradient(to bottom,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0'); ?> 0%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0.5'); ?> 10%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'0.95'); ?> 25%,
                    <?php echo hex2rgb(ts_get_color('view_background_color'),'1'); ?> 100%);
            }
            .ts-pricing-view article{
                background-color: <?php echo ts_get_color('view_background_color'); ?>;
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .single-ts-gallery .inner-gallery-container .overlay-effect .entry-overlay,
            .ts-gallery-element .overlay-effect .entry-overlay{
                background-color: <?php echo hex2rgb(ts_get_color('view_background_color'),'0.85'); ?>;
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .single-ts-gallery .single_gallery1 .post-header-title,
            .single-ts-gallery .single_gallery6 .post-header-title{
                background-color: <?php echo ts_get_color('view_background_color'); ?>;
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .teams article .image-holder{
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .teams article .image-holder:before{
                background-color: <?php echo hex2rgb(ts_get_color('view_background_color'),'0.8'); ?>;
            }
            .ts-featured-area .inner-area-container{
                background-color: <?php echo ts_get_color('view_background_color'); ?>;
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .ts-featured-area .featured-area-tabs .entry-title{
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }
            .single-ts-gallery .overlay-effect .entry-controls > li.share-box .share-link.shown,
            .ts-gallery-element .overlay-effect .entry-controls > li.share-box .share-link.shown {
                background: <?php echo ts_get_color('view_background_color'); ?>;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
                color: <?php echo ts_get_color('view_text_color'); ?>;
            }

            .entry-excerpt{
                color: <?php echo ts_get_color('excerpt_color'); ?>;
            }

            /*
            --------------------------------------------------------------------------------
                7. MENU COLOR
            --------------------------------------------------------------------------------
            */
            .ts-header-menu .main-menu li a:hover,
            .ts-sticky-menu .main-menu li a:hover,
            .ts-mobile-menu .main-menu li a:hover,
            .ts-behold-menu > li > a:hover {
                color: <?php echo ts_get_color('submenu_text_color_hover'); ?>;
            }
            .ts-header-menu .main-menu > .menu-item-has-children ul li > a:before,
            .ts-sticky-menu .main-menu > .menu-item-has-children ul li > a:before,
            .ts-mega-menu .menu-item-has-children .ts_is_mega_div .ts_is_mega > li > a:before,
            .ts-mobile-menu .main-menu > .menu-item-has-children ul li > a:before,
            .ts-mobile-menu .menu-item-type-taxonomy.menu-item-has-children .ts_is_mega_div > .sub-menu li a:before{
                background-color: <?php echo hex2rgb(ts_get_color('submenu_bg_color_hover'),'0.3'); ?>;
            }
            .ts-header-menu .main-menu > .menu-item-has-children ul li > a:after,
            .ts-sticky-menu .main-menu > .menu-item-has-children ul li > a:after,
            .ts-mega-menu .menu-item-has-children .ts_is_mega_div .ts_is_mega > li > a:after,
            .ts-mobile-menu .main-menu > .menu-item-has-children ul li > a:after,
            .ts-mobile-menu .menu-item-type-taxonomy.menu-item-has-children .ts_is_mega_div > .sub-menu li a:after{
                background-color: <?php echo ts_get_color('submenu_bg_color_hover'); ?>;
            }
            .ts-header-menu .main-menu li > a,
            .ts-sticky-menu .main-menu li > a,
            .ts-mobile-menu .main-menu li > a,
            .ts-behold-menu li > a,
            .ts-mobile-menu .menu-item-type-taxonomy.menu-item-has-children .ts_is_mega_div > .sub-menu li a,
            .ts-standard-menu .main-menu li ul .menu-item-has-children:after,
            .ts-sticky-menu .main-menu li ul .menu-item-has-children:after {
                color: <?php echo ts_get_color('submenu_text_color'); ?>;
            }
            .ts-header-menu .sub-menu:not(.ts_is_mega),
            .ts-sticky-menu .sub-menu:not(.ts_is_mega),
            .ts-mega-menu .menu-item-type-taxonomy .sub-menu,
            .ts-mobile-menu .sub-menu,
            .ts-mega-menu .is_mega .ts_is_mega_div:after {
                background-color: <?php echo ts_get_color('submenu_bg_color'); ?>;
            }
            .ts-mega-menu .main-menu .ts_is_mega_div .title{
                color: <?php echo ts_get_color('submenu_text_color'); ?>;
            }
            .sub-menu li a:hover{
                color: <?php echo ts_get_color('submenu_text_color_hover'); ?>;
            }

            <?php $typography = ts_get_custom_fonts_css(); echo $typography["style"]; ?>
            <?php echo ts_custom_background(); ?>
            <?php echo ts_get_sticky_menu_style() ?>

            /* --- Custom CSS Below ----  */
            <?php echo ts_get_custom_css() ?>
        </style>
        <?php
    }
}

if ( ! function_exists('ts_get_custom_css')) {
    function ts_get_custom_css() {
        $option = get_option('shootback_css', array('css' => ''));
        return $option['css'];
    }
}

/* register sidebars */
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => __( 'Main Sidebar', 'shootback' ),
        'id' => 'main',
        'before_widget' => '<aside id="%1$s" class="widget ts_widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></aside>',
        'before_title'  => '<h6 class="widget-title ts_sidebar_title">',
        'after_title'   => '</h6><div class="widget-delimiter"></div>'
    ));

}

function ts_imagesloaded($bool, $img_url){
    if( $bool == 'Y' ){
        $src = 'class="lazy" data-original="'. esc_url($img_url) .'"';
    }else{
        $src = 'src="'. esc_url($img_url) .'"';
    }

    return $src;
}

function menuCallback(){
    wp_page_menu(array(
        'menu_class'  => 'ts-behold-menu main-menu ',
        'include'     => '',
        'exclude'     => '',
        'echo'        => true,
        'link_before' => '',
        'link_after'  => ''
    ));
}

function extended_upload_mimes ( $mime_types =array() ) {
    $mime_types['svg'] = 'image/svg+xml';
    $mime_types['woff'] = 'image/x-woff';
    $mime_types['ttf'] = 'image/x-font-ttf';
    $mime_types['eot'] = 'image/vnd.ms-fontobject';
    $mime_types['mp4'] = 'webm/mp4';
    $mime_types['webm'] = 'webm/webm';

    unset( $mime_types['exe'] );

    return $mime_types;
}
add_filter('upload_mimes', 'extended_upload_mimes');


// Check if mega menu option is enabled and add mega menu support
$ts_is_mega_menu_option = get_option('shootback_general');
if( !isset($ts_is_mega_menu_option['enable_mega_menu'] ) ){
    $ts_is_mega_menu_option['enable_mega_menu'] = 'N';
}

if( $ts_is_mega_menu_option['enable_mega_menu'] == 'Y' ) {

    add_theme_support( 'ts_is_mega_menu' );

}

function ts_set_post_views($postID) {
    $count_key = 'ts_article_views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function ts_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty($post_id) ) {
        global $post;
        $post_id = $post->ID;
    }
    ts_set_post_views($post_id);
}
add_action( 'wp_head', 'ts_track_post_views');

function ts_get_views($postID, $show = true){

    $count = get_post_meta($postID, 'ts_article_views', true);
    if( $count == '' ){
        ts_set_post_views($postID);
        $count = 0;
    }
    if( $show == true ){
        echo (int)$count;
    }else{
        return $count;
    }
}

//get icon format by post format
function ts_get_icon_format($post_id){

    $post_format = get_post_format( $post_id );

    if( isset($post_format) ){

        if( $post_format == 'video' ){
            echo '<i class="icon-video"></i>';
        }else if( $post_format == 'gallery' ){
            echo '<i class="icon-gallery"></i>';
        }else{
            echo '<i class="icon-page"></i>';
        }

    }else{
        echo '<i class="icon-page"></i>';
     }
}

// ADD NEW COLUMN ts_pricing_table
function ts_add_custom_true($columns) {

    $postType = get_post_type(get_the_ID());

    if( $postType == 'video' || $postType == 'ts-gallery' || $postType == 'post' || $postType == 'event' ){
        $columns['featured_article'] = 'Featured';
    }

    return $columns;
}
add_filter('manage_posts_columns', 'ts_add_custom_true', 10, 1);

// show the colums featured
function ts_columns_content_featured($columnName, $post_ID) {

    $postType = get_post_type($post_ID);

    if( $postType == 'video' || $postType == 'ts-gallery' || $postType == 'post' || $postType == 'event' && $columnName == 'featured_article' ){

        $meta_values = get_post_meta($post_ID, 'featured', true);
        $selected = $meta_values == 'yes' ? 'checked' : '';

        echo '<input type="checkbox"'. $selected .' name="featured_article" class="featured" value="'. $post_ID .'">';
        echo '<input type="hidden" value="updateFeatures" />';

    }
}
add_action('manage_posts_custom_column', 'ts_columns_content_featured', 10, 2);

//get the pagination in single item
function ts_get_pagination_next_previous(){

    $enable_pagination = get_option('shootback_single_post', array('post_pagination' => 'Y'));
    if( isset($enable_pagination) && is_array($enable_pagination) && !empty($enable_pagination) && isset($enable_pagination['post_pagination']) && $enable_pagination['post_pagination'] == 'Y' ){

        $next_post = get_next_post();
        $prev_post = get_previous_post();

        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="ts-post-nav">
                        <?php if( !empty($prev_post) ) :  ?>
                            <a class="prev" href="<?php echo get_permalink( $prev_post->ID, false ); ?>">
                                <div class="inner-content">
                                    <span class="icon-wrapper"><span class="icon"><i class="icon-left"></i></span></span>
                                    <?php
                                        $src = wp_get_attachment_url( get_post_thumbnail_id( $prev_post->ID ) );
                                        $class_no_image = '';
                                        if( !$src ){
                                            $class_no_image = 'no-image';
                                        }
                                    ?>
                                    <div class="post-nav-content <?php echo $class_no_image ?>">
                                        <div class="image-wrapper">
                                            <?php
                                                if ( $src ) {
                                                    $featimage = '<img src="'.aq_resize( $src, 80, 80, true, true).'" alt="' . esc_attr(get_the_title()) . '" />';
                                                } else {
                                                    $featimage = '';
                                                }
                                                echo $featimage;
                                            ?>
                                        </div>
                                        <div class="content-wrapper">
                                            <span><?php _e('Previous Post','shootback') ?></span>
                                            <h3 class="title"><?php echo $prev_post->post_title; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endif ?>
                        <?php if( !empty($next_post) ) : ?>
                            <a class="next" href="<?php echo get_permalink( $next_post->ID, false ); ?>">
                                <div class="inner-content">
                                    <span class="icon-wrapper"><span class="icon"><i class="icon-right"></i></span></span>
                                    <?php
                                        $src = wp_get_attachment_url( get_post_thumbnail_id( $next_post->ID ) );
                                        $class_no_image = '';
                                        if( !$src ){
                                            $class_no_image = 'no-image';
                                        }
                                    ?>
                                    <div class="post-nav-content <?php echo $class_no_image ?>">
                                        <div class="image-wrapper">
                                            <?php
                                                if ( $src ) {
                                                    $featimage = '<img src="'.aq_resize( $src, 80, 80, true, true).'" alt="' . esc_attr(get_the_title()) . '" />';
                                                } else {
                                                    $featimage = '';
                                                }
                                                echo $featimage;
                                            ?>
                                        </div>
                                        <div class="content-wrapper">
                                            <span><?php _e('Next Post','shootback') ?></span>
                                            <h3 class="title"><?php echo $next_post->post_title; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
        </div>
<?php
    }//end if(verify enable_pagination )
}//end function ts_get_pagination_next_previous()

// get related post by author
function ts_get_related_posts_author($author_id, $post_id){

    $related_posts = '';
    $single_options = get_option('shootback_single_post');

    if( isset($single_options) && is_array($single_options) && isset($single_options['related_posts']) && $single_options['related_posts'] == 'Y' ){
        if( isset($post_id) && (int)$post_id !== 0 ){
            $post_type = get_post_type($post_id);
        }
        if( isset($post_type) ){

            $options = array();

            $options['special-effects'] = '';
            $options['display-mode'] = $single_options['related_posts_type'];
            $options['elements-per-row'] = $single_options['related_posts_nr_of_columns'];
            $options['order-direction'] = 'desc';
            $options['order-by'] = 'date';

            if ( $options['display-mode'] === 'grid' ) {
                $options['display-title'] = 'title-below-image';
                $options['show-meta'] = 'y';
                $options['enable-carousel'] = 'n';
            }
            if ( $options['display-mode'] === 'thumbnails' ) {
                $options['meta-thumbnail'] = 'y';
            }

            $args['author'] = $author_id;
            $args['posts_per_page'] = (int)$single_options['number_of_related_posts'];
            $args['orderby '] = 'date';
            $args['order '] = 'DESC';
            $args['post_type'] = $post_type;

            $query = new WP_Query( $args );

            if ( $query->have_posts() ) {
                echo $related_posts . LayoutCompilator::last_posts_element( $options, $query );
            } else {
                echo '';
            }

        }
    }else{
        return FALSE;
    }
}

function ts_breadcrumbs(){

    global $post;

    if ( is_front_page() ) {
        return;
    }

    if ( is_category() || is_single() || is_page() ) {

        $breadcrumbs =  '<div class="ts-breadcrumbs-content">
                            <a href="' . home_url() . '">' . __('Home', 'shootback') . '</a>';

        if (is_category() || is_single() ) {

            $breadcrumbs .= ' <i class="icon-right"></i> ';

            $post_type = $post->post_type;

            if( $post_type === 'post' ){
                $categoryies = get_the_category($post->ID);
            }else{
                $taxonomies = get_object_taxonomies($post_type);
                $categoryies = wp_get_post_terms($post->ID, $taxonomies);

                $taxonomy_link = '';
            }

            foreach ($categoryies as $category){

                if( isset($category->taxonomy) && $category->taxonomy === 'post_tag' ) break;

                if( is_category() ){
                    $breadcrumbs .= $category->name;
                    break;
                }
                if( $post_type !== 'post' ){
                    foreach($taxonomies as $name_taxonomy){
                        $error_string = get_term_link($category->term_id, $name_taxonomy);
                        if( !is_wp_error($error_string) ){
                            $taxonomy_link = get_term_link($category->term_id, $name_taxonomy);
                        }
                    }
                }

                if( $post_type === 'post' && is_single() ){
                    $breadcrumbs .= '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
                }else{
                    if( !empty($taxonomy_link) ) $breadcrumbs .= '<a href="' . $taxonomy_link . '">' . $category->name . '</a>';
                    else $breadcrumbs .= $category->name;
                }
                $breadcrumbs .= ' <i class="icon-right"></i> ';
                break;
            }
            if (is_single()) {
                $breadcrumbs .= get_the_title($post->ID);
            }
            $breadcrumbs .= '</div>';

            return $breadcrumbs;

        } elseif (is_page()) {

            if($post->post_parent){
                $anc = get_post_ancestors($post->ID);
                $anc_link = get_page_link($post->post_parent);

                foreach ($anc as $ancestor) {
                    $breadcrumbs .= " <i class='icon-right'></i> <a href=" . $anc_link . ">" . get_the_title($ancestor) . "</a> <i class='icon-right'></i> ";
                }

                $breadcrumbs .= get_the_title($post->ID);
                $breadcrumbs .= '</div>';
                return $breadcrumbs;

            } else {
                $breadcrumbs .= ' <i class="icon-right"></i> ' . get_the_title($post->ID);
                $breadcrumbs .= '</div>';
                return $breadcrumbs;
            }
        }
    }elseif( is_tag() ){
        $breadcrumbs = '<div class="ts-breadcrumbs"><a href="' . home_url() . '">' . __('Home', 'shootback') . '</a> > ' . single_tag_title('', false) . '</div>';
        return $breadcrumbs;
    }elseif( is_day() ){
        $breadcrumbs = '<div class="ts-breadcrumbs"><a href="' . home_url() . '">' . __('Home', 'shootback') . '</a> > ' . __('Archive: ', 'shootback') . get_the_date('F jS, Y') . '</div>';
        return $breadcrumbs;
    }elseif( is_month() ){
        $breadcrumbs = '<div class="ts-breadcrumbs"><a href="' . home_url() . '">' . __('Home', 'shootback') . '</a> > ' . __('Archive: ', 'shootback') . get_the_date('F, Y') . '</div>';
        return $breadcrumbs;
    }elseif( is_year() ){
        $breadcrumbs = '<div class="ts-breadcrumbs"><a href="' . home_url() . '">' . __('Home', 'shootback') . '</a> > ' . __('Archive: ', 'shootback') . get_the_date('Y') . '</div>';
        return $breadcrumbs;
    }elseif( is_author() ){
        $breadcrumbs = '<div class="ts-breadcrumbs"><a href="' . home_url() . '">' . __('Home', 'shootback') . '</a> > ' . __("Author's archive: ", 'shootback') . get_the_author() . '</div>';
        return $breadcrumbs;
    }elseif( isset($_GET['paged']) && !empty($_GET['paged']) ){
        $breadcrumbs = '<div class="ts-breadcrumbs"><a href="' . home_url() . '">' . __('Home', 'shootback') . '</a> > ' . __("Blogarchive: ", 'shootback') . '</div>';
        return $breadcrumbs;
    }elseif( is_search() ){
        $breadcrumbs = '<div class="ts-breadcrumbs"><a href="' . home_url() . '">' . __('Home', 'shootback') . '</a> > ' . __("Search results: ", 'shootback') . '</div>';
        return $breadcrumbs;
    }

}

function ts_base_64($string, $encode_decode){
    if($encode_decode === 'encode' && isset($string) && !empty($string)){
        return base64_encode(serialize($string));
    }else if( $encode_decode === 'decode' && isset($string) && !empty($string) ){
        return @unserialize(base64_decode($string));
    }else return '';
}

function ts_get_comment_count($post_id) {
    if (fields::get_options_value('shootback_general', 'comment_system') == 'facebook' ) {
        return '<fb:comments-count href="' . get_permalink($post_id) .'"></fb:comments-count>';
    } else{
        return get_comments_number($post_id);
    }
}

function ts_draw_calendar_callback($month_layout = NULL, $year_layout = NULL, $size_layout = NULL, $nonce_layout = NULL){

    if( isset($_POST['nonce']) && !wp_verify_nonce($_POST['nonce'], 'security') ){
        return;
    }

    if( isset($nonce_layout) && !wp_verify_nonce($nonce_layout, 'security') ){
        return;
    }

    if(isset($_POST['tsYear'], $_POST['tsMonth'])){
        $month = (int)$_POST['tsMonth'];
        if( strlen($month) == 1 ) $month = '0' . $month;
        $year = (int)$_POST['tsYear'];
        $class_size = (isset($_POST['size']) && ($_POST['size'] == 'ts-big-calendar' || $_POST['size'] == 'ts-small-calendar')) ? $_POST['size'] : 'ts-big-calendar';
    }

    if( isset($month_layout, $year_layout, $size_layout) ){
        $month = $month_layout;
        $year = $year_layout;
        $class_size = $size_layout;
    }

    $month_prev = ($month == 1) ? 12 : $month - 1;
    $month_next = ($month == 12) ? 1 : $month + 1;
    $year_next = ($month == 12) ? $year + 1 : $year;
    $year_prev = ($month == 1) ? $year - 1 : $year;
    if( strlen($month_prev) == 1 ) $month_prev = '0' . $month_prev;
    if( strlen($month_next) == 1 ) $month_next = '0' . $month_next;
    $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));

    $calendar = '<h3 class="ts-calendar-title">'. date('F', mktime(0, 0, 0, $month, 10)) . '<span> ' . $year . '</span>' . '</h3>';
    $calendar .= '<a class="ts-get-calendar ts-prev" data-month="' . $month_prev . '" data-year="' . $year_prev . '" href="#">' . __('Prev month', 'shootback') . '</a><a class="ts-get-calendar ts-next" data-month="' . $month_next . '" data-year="' . $year_next . '" href="#">' . __('Next month', 'shootback') . '</a>';
    $calendar .= '<table cellpadding="0" cellspacing="0" class="ts-events-calendar ' . $class_size . '">';

    $headings = array(__('Sunday', 'shootback'), __('Monday', 'shootback'), __('Tuesday', 'shootback'), __('Wednesday', 'shootback'), __('Thursday', 'shootback'), __('Friday', 'shootback'), __('Saturday', 'shootback'));

    $calendar .= '<tr class="calendar-row"><td class="calendar-day-head">' . implode('</td><td class="calendar-day-head">', $headings) . '</td></tr>';

    $events = array();
    $args = array(
                'post_type'      => 'event',
                'posts_per_page' => -1,
            );

    $query = new WP_Query( $args );

    if( $query->have_posts() ){
        while ( $query->have_posts() ) { $query->the_post();

            $day = get_post_meta(get_the_ID(), 'day', true);
            $day = (isset($day) && (int)$day !== 0) ? date('Y-m-d', (int)$day) : NULL;

            if( isset($day) ){

                $permalink = get_permalink(get_the_ID());
                $title     = get_the_title(get_the_ID());
                $excerpt   = get_the_excerpt();

                $post_meta = get_post_meta(get_the_ID(), 'event', true);
                $start_end = (isset($post_meta['start-time'], $post_meta['end-time'])) ? $post_meta['start-time'] . ' - ' . $post_meta['end-time'] : '';
                $repeat    = (isset($post_meta['event-enable-repeat']) && ($post_meta['event-enable-repeat'] == 'y' || $post_meta['event-enable-repeat'] == 'n')) ? $post_meta['event-enable-repeat'] : '';
                $repeat_in = (isset($post_meta['event-repeat']) && ($post_meta['event-repeat'] == '1' || $post_meta['event-repeat'] == '2' || $post_meta['event-repeat'] == '3') ) ? $post_meta['event-repeat'] : '';
                $end_day   = (isset($post_meta['event-end']) &&  (int)strtotime($post_meta['event-end']) !== 0) ? $post_meta['event-end'] : '';

                $date_start = date_create($day);
                $date_end   = date_create($end_day);
                $event_days = date_diff($date_start, $date_end);
                $event_days = $event_days->days + 1;
                $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));

                if ( $post_meta['event-enable-repeat'] == 'n' ) {
                    for ($i = 0; $i < 3; $i++) {
                        for ($k = 0; $k < $event_days; $k++){
                            if( isset($events[date('Y-m-d', strtotime($day) + ($k * 86400))]) ){
                                if( !in_array( array('title' => $title, 'permalink' => $permalink, 'excerpt' => $excerpt, 'start-end' => $start_end, 'repeat' => $repeat, 'repeat_in' => $repeat_in, 'event-end' => $end_day), $events[date('Y-m-d', strtotime($day) + ($k*86400))] ) ){

                                    array_push($events[date('Y-m-d', strtotime($day) + ($k*86400))], array(
                                        'title'     => $title,
                                        'permalink' => $permalink,
                                        'excerpt'   => $excerpt,
                                        'start-end' => $start_end,
                                        'repeat'    => $repeat,
                                        'repeat_in' => $repeat_in,
                                        'event-end' => $end_day
                                    ));
                                }
                            }else{
                                $events[date('Y-m-d', strtotime($day) + ($k*86400) )] = array(array(
                                    'title'     => $title,
                                    'permalink' => $permalink,
                                    'excerpt'   => $excerpt,
                                    'start-end' => $start_end,
                                    'repeat'    => $repeat,
                                    'repeat_in' => $repeat_in,
                                    'event-end' => $end_day
                                ));
                            }
                        }
                    }
                }
                if ( $post_meta['event-enable-repeat'] == 'y' && $post_meta['event-repeat'] == '1' ) {
                    for ($i=0; $i < 500; $i++) {
                        if( isset($events[date('Y-m-d', strtotime($day) + 86400 * 7 * $i)]) ){
                            if( !in_array(array('title' => $title, 'permalink' => $permalink, 'excerpt' => $excerpt, 'start-end' => $start_end, 'repeat' => $repeat, 'repeat_in' => $repeat_in, 'event-end' => $end_day), $events[date('Y-m-d', strtotime($day) + 86400 * 7 * $i)]) ){
                                array_push($events[date('Y-m-d', strtotime($day) + 86400 * 7 * $i)], array(
                                    'title'     => $title,
                                    'permalink' => $permalink,
                                    'excerpt'   => $excerpt,
                                    'start-end' => $start_end,
                                    'repeat'    => $repeat,
                                    'repeat_in' => $repeat_in,
                                    'event-end' => $end_day
                                ));
                            }
                        }else{
                            $events[date('Y-m-d', strtotime($day) + 86400 * 7 * $i)] = array(array(
                                'title'     => $title,
                                'permalink' => $permalink,
                                'excerpt'   => $excerpt,
                                'start-end' => $start_end,
                                'repeat'    => $repeat,
                                'repeat_in' => $repeat_in,
                                'event-end' => $end_day
                            ));
                        }
                        for ($k=1; $k < $event_days; $k++) {
                            if( isset($events[date('Y-m-d', strtotime($day) + (86400 * 7)* $i + ($k*86400) )]) ){
                                if( !in_array( array('title' => $title, 'permalink' => $permalink, 'excerpt' => $excerpt, 'start-end' => $start_end, 'repeat' => $repeat, 'repeat_in' => $repeat_in, 'event-end' => $end_day), $events[date('Y-m-d', strtotime($day) + (86400 * 7)* $i + ($k*86400) )]) ){
                                    array_push($events[date('Y-m-d', strtotime($day) + (86400 * 7)* $i + ($k*86400) )], array(
                                        'title'     => $title,
                                        'permalink' => $permalink,
                                        'excerpt'   => $excerpt,
                                        'start-end' => $start_end,
                                        'repeat'    => $repeat,
                                        'repeat_in' => $repeat_in,
                                        'event-end' => $end_day
                                    ));
                                }
                            }else{
                                $events[date('Y-m-d', strtotime($day) + (86400 * 7)* $i + ($k*86400) )] = array(array(
                                    'title'     => $title,
                                    'permalink' => $permalink,
                                    'excerpt'   => $excerpt,
                                    'start-end' => $start_end,
                                    'repeat'    => $repeat,
                                    'repeat_in' => $repeat_in,
                                    'event-end' => $end_day
                                ));
                            }
                        }
                    }
                }
                if ( $post_meta['event-enable-repeat'] == 'y' && $post_meta['event-repeat'] == '2' ) {
                    for ($i=0; $i < 500; $i++) {
                        if( isset($events[date('Y-m-d', strtotime("+".$i." month",strtotime($day)))]) ){
                            if( !in_array( array('title' => $title, 'permalink' => $permalink, 'excerpt' => $excerpt, 'start-end' => $start_end, 'repeat' => $repeat, 'repeat_in' => $repeat_in, 'event-end' => $end_day), $events[date('Y-m-d', strtotime("+".$i." month",strtotime($day)))]) ){
                                array_push($events[date('Y-m-d', strtotime("+".$i." month",strtotime($day)))], array(
                                    'title'     => $title,
                                    'permalink' => $permalink,
                                    'excerpt'   => $excerpt,
                                    'start-end' => $start_end,
                                    'repeat'    => $repeat,
                                    'repeat_in' => $repeat_in,
                                    'event-end' => $end_day
                                ));
                            }
                        }else{
                            $events[date('Y-m-d', strtotime("+".$i." month",strtotime($day)))] = array(array(
                                'title'     => $title,
                                'permalink' => $permalink,
                                'excerpt'   => $excerpt,
                                'start-end' => $start_end,
                                'repeat'    => $repeat,
                                'repeat_in' => $repeat_in,
                                'event-end' => $end_day
                            ));
                        }
                        for ($k=1; $k < $event_days; $k++) {
                            $current_date = date('Y-m-d', strtotime("+".$i." month",strtotime($day)));
                            if( isset($events[date('Y-m-d', strtotime("+".$k." days",strtotime($current_date )))]) ){
                                if( !in_array( array('title' => $title, 'permalink' => $permalink, 'excerpt' => $excerpt, 'start-end' => $start_end, 'repeat' => $repeat, 'repeat_in' => $repeat_in, 'event-end' => $end_day), $events[date('Y-m-d', strtotime("+".$k." days",strtotime($current_date )))]) ){
                                    array_push($events[date('Y-m-d', strtotime("+".$k." days",strtotime($current_date )))], array(
                                        'title'     => $title,
                                        'permalink' => $permalink,
                                        'excerpt'   => $excerpt,
                                        'start-end' => $start_end,
                                        'repeat'    => $repeat,
                                        'repeat_in' => $repeat_in,
                                        'event-end' => $end_day
                                    ));
                                }
                            }else{
                                $events[date('Y-m-d', strtotime("+".$k." days",strtotime($current_date )))] = array(array(
                                    'title'     => $title,
                                    'permalink' => $permalink,
                                    'excerpt'   => $excerpt,
                                    'start-end' => $start_end,
                                    'repeat'    => $repeat,
                                    'repeat_in' => $repeat_in,
                                    'event-end' => $end_day
                                ));
                            }
                        }
                    }
                }
                if ( $post_meta['event-enable-repeat'] == 'y' && $post_meta['event-repeat'] == '3' ) {
                    for ($i=0; $i < 500; $i++) {
                        if( isset($events[date('Y-m-d', strtotime("+".$i." year",strtotime($day)))]) ){
                            if( !in_array( array('title' => $title, 'permalink' => $permalink, 'excerpt' => $excerpt, 'start-end' => $start_end, 'repeat' => $repeat, 'repeat_in' => $repeat_in, 'event-end' => $end_day), $events[date('Y-m-d', strtotime("+".$i." year",strtotime($day)))]) ){
                                array_push($events[date('Y-m-d', strtotime("+".$i." year",strtotime($day)))], array(
                                    'title'     => $title,
                                    'permalink' => $permalink,
                                    'excerpt'   => $excerpt,
                                    'start-end' => $start_end,
                                    'repeat'    => $repeat,
                                    'repeat_in' => $repeat_in,
                                    'event-end' => $end_day
                                ));
                            }
                        }else{
                            $events[date('Y-m-d', strtotime("+".$i." year",strtotime($day)))] = array(array(
                                'title'     => $title,
                                'permalink' => $permalink,
                                'excerpt'   => $excerpt,
                                'start-end' => $start_end,
                                'repeat'    => $repeat,
                                'repeat_in' => $repeat_in,
                                'event-end' => $end_day
                            ));
                        }
                        for ($k=1; $k < $event_days; $k++) {
                            $current_date = date('Y-m-d', strtotime("+".$i." year",strtotime($day)));
                            if( isset($events[date('Y-m-d', strtotime("+".$k." days",strtotime($current_date )))]) ){
                                if( !in_array( array('title' => $title, 'permalink' => $permalink, 'excerpt' => $excerpt, 'start-end' => $start_end, 'repeat' => $repeat, 'repeat_in' => $repeat_in, 'event-end' => $end_day), $events[date('Y-m-d', strtotime("+".$k." days",strtotime($current_date )))]) ){
                                    array_push($events[date('Y-m-d', strtotime("+".$k." days",strtotime($current_date )))], array(
                                        'title'     => $title,
                                        'permalink' => $permalink,
                                        'excerpt'   => $excerpt,
                                        'start-end' => $start_end,
                                        'repeat'    => $repeat,
                                        'repeat_in' => $repeat_in,
                                        'event-end' => $end_day
                                    ));
                                }
                            }else{
                                $events[date('Y-m-d', strtotime("+".$k." days",strtotime($current_date )))] = array(array(
                                    'title'     => $title,
                                    'permalink' => $permalink,
                                    'excerpt'   => $excerpt,
                                    'start-end' => $start_end,
                                    'repeat'    => $repeat,
                                    'repeat_in' => $repeat_in,
                                    'event-end' => $end_day
                                ));
                            }
                        }
                    }
                }

                if( $repeat == 'y' && $repeat_in == '1' ){
                    $day_next = strtotime($day);

                    for($i = 0; $i < $event_days; $i++){
                        $start_day = date('Y-m-d', $day_next + (86400 * $i));

                        if( isset($events[$start_day]) ){
                            if( in_array(array('title' => $title, 'permalink' => $permalink, 'excerpt' => $excerpt, 'start-end' => $start_end, 'repeat' => $repeat, 'repeat_in' => $repeat_in, 'event-end' => $end_day), $events[$start_day]) ){

                                array_push($events[$start_day], array(
                                    'title'     => $title,
                                    'permalink' => $permalink,
                                    'excerpt'   => $excerpt,
                                    'start-end' => $start_end,
                                    'repeat'    => $repeat,
                                    'repeat_in' => $repeat_in,
                                    'event-end' => $end_day
                                    )
                                );
                            }

                        }else{
                            $events[$start_day] = array(array(
                                'title'     => $title,
                                'permalink' => $permalink,
                                'excerpt'   => $excerpt,
                                'start-end' => $start_end,
                                'repeat'    => $repeat,
                                'repeat_in' => $repeat_in,
                                'event-end' => $end_day
                                )
                            );
                        }
                    }
                }
            }
        }
    }

    $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    $calendar .= '<tr class="ts-calendar-row">';

    for($x = 0; $x < $running_day; $x++):
        $calendar .= '<td class="ts-calendar-day-np">&nbsp;</td>';
        $days_in_this_week++;
    endfor;

    for($list_day = 1; $list_day <= $days_in_month; $list_day++) :
        $calendar .= '<td class="ts-calendar-day">';

            $calendar .= '<div class="ts-day-number">' . $list_day . '</div>';
            if ( strlen($list_day) == 1 ) $list_day = '0'.$list_day;
            $event_day = $year . '-' . $month . '-' . $list_day;

            if(isset($events[$event_day])) {
                foreach($events[$event_day] as $event) {
                    $calendar .= '<div class="ts-event-title"><a href="'.$event['permalink'].'">' . $event['title'] . '</a>';
                    $calendar .= '<div class="ts-event-details-hover"><div class="ts-event-time">'.$event['start-end'].'</div>';
                    $calendar .= '<div class="ts-event-excerpt">'.$event['excerpt'].'</div></div></div>';
                    if ( $event['repeat'] == 'y' && $event['repeat_in'] == '1' ) {
                        $events[date('Y-m-d', strtotime($event_day) + 86400 * 7)] = array($event);
                    }
                    if ( $event['repeat'] == 'y' && $event['repeat_in'] == '2' ) {
                        $events[date('Y-m-d', strtotime($event_day) + 86400 * $days_in_month)] = array($event);
                    }
                    if ( $event['repeat'] == 'y' && $event['repeat_in'] == '3' ) {
                        $events[date('Y-m-d', strtotime($event_day) + 86400 * date("z", mktime(0,0,0,12,31,$year)) + 1)] = array($event);
                    }
                }
            }
            else {
                $calendar .= str_repeat('', 2);
            }
        $calendar.= '</td>';
        if($running_day == 6):
            $calendar.= '</tr>';
            if(($day_counter + 1) != $days_in_month):
                $calendar.= '<tr class="calendar-row">';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++; $running_day++; $day_counter++;
    endfor;

    if($days_in_this_week < 8):
        for($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar.= '<td class="calendar-day-np">&nbsp;</td>';
        endfor;
    endif;

    $calendar.= '</tr>';

    $calendar.= '</table>';

    $calendar = str_replace('</td>','</td>'."\n",$calendar);
    $calendar = str_replace('</tr>','</tr>'."\n",$calendar);

    if(isset($_POST['tsYear'], $_POST['tsMonth'])){
        echo $calendar;
    }else{
        return $calendar;
    }

    die();
}
add_action( 'wp_ajax_ts_draw_calendar', 'ts_draw_calendar_callback' );
add_action( 'wp_ajax_nopriv_ts_draw_calendar', 'ts_draw_calendar_callback' );

function ts_attachment_field_url( $form_fields, $post ) {

    $form_fields['ts-image-url'] = array(
        'label' => 'Image url',
        'input' => 'text',
        'value' => get_post_meta($post->ID, 'ts-image-url', true),
        'helps' => '',
    );

    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'ts_attachment_field_url', 10, 2 );

function ts_attachment_field_url_save( $post, $attachment ) {
    if( isset( $attachment['ts-image-url'] ) )
        update_post_meta($post['ID'], 'ts-image-url', $attachment['ts-image-url']);
    return $post;
}

add_filter('attachment_fields_to_save', 'ts_attachment_field_url_save', 10, 2);

add_filter( 'wp_title', 'filter_wp_title' );
/**
 * Filters the page title appropriately depending on the current page
 *
 * This function is attached to the 'wp_title' fiilter hook.
 *
 * @uses    get_bloginfo()
 * @uses    is_home()
 * @uses    is_front_page()
 */
function filter_wp_title( $title ) {
    global $page, $paged;

    if ( is_feed() )
        return $title;

    $site_description = get_bloginfo( 'description' );

    $filtered_title = (is_singular() && !is_front_page()) ? $title . ' | ' . get_bloginfo( 'name' ) : '';
    $filtered_title .= (!empty($site_description) && (is_home() || is_front_page())) ? get_bloginfo( 'name' ) . ' | ' . $site_description : ' ';
    $filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', 'shootback' ), max( $paged, $page ) ) : '';

    return $filtered_title;
}

function ts_get_rating($post_id){

    if( is_numeric($post_id) ){
        $rating_items = get_post_meta($post_id, 'ts_post_rating', TRUE);
        if( isset($rating_items) && is_array($rating_items) && !empty($rating_items) ){
            $total = '';
            foreach($rating_items as $rating){
                $total += $rating['rating_score'];
            }
            if( $total > 0 ){
                $round = intval($total) / count($rating_items);
                $result = round($round, 1);

                if( is_int($round) ){
                    if( $round == 10 ) return $result;
                    else return $result . '.0';
                }else{
                    return $result;
                }
            }else{
                return;
            }
        }
    }else{
        return;
    }

}

function ts_var_sanitize($content, $method = 'true'){

    switch ($method) {

        case 'sanitize_title':
            return sanitize_title($content);
            break;

        case 'sanitize_text':
            return sanitize_text_field($content);
            break;

        case 'sanitize_html_class':
            return sanitize_html_class($content);
            break;

        case 'balanceTags':
            return balanceTags($content, true);
            break;

        case 'esc_attr':
            return esc_attr($content, true);
            break;

        case 'esc_url':
            return esc_url($content);
            break;

        case 'esc_js':
            return esc_js($content);
            break;

        case 'true':
            return $content;
            break;

        case 'esc_url_raw':
            return esc_url_raw($content);
            break;

        case 'absint':
            return absint($content);
            break;

        case 'esc_textarea':
            return esc_url_raw($content);
            break;
    }

}

function ts_excerpt($optionLength, $postId, $showSubtitle = 'show-subtitle'){

    if( is_string($optionLength) && !is_numeric($optionLength) ){
        $ln = fields::get_options_value('shootback_general', $optionLength);
    }else{
        $ln = absint($optionLength);
    }

    $subtitle = get_post_meta($postId, 'post_settings', true);
    $subtitle = (isset($subtitle['subtitle']) && $subtitle['subtitle'] !== '' && is_string($subtitle['subtitle'])) ? esc_attr($subtitle['subtitle']) : '';

    if( $showSubtitle == 'show-subtitle' && isset($subtitle) && !empty($subtitle) ){

        if( !empty($subtitle) && strlen(strip_tags(strip_shortcodes($subtitle))) > intval($ln) ){
            echo mb_substr(strip_tags(strip_shortcodes($subtitle)), 0, intval($ln)) . '...';
        }else{
            echo strip_tags(strip_shortcodes($subtitle));
        }

    }else{
        $postExcerpt = get_post_field('post_excerpt', $postId);
        $postContent = get_post_field('post_content', $postId);

        if (!empty($postExcerpt)) {
            if (strlen(strip_tags(strip_shortcodes($postExcerpt))) > intval($ln)) {
                echo mb_substr(strip_tags(strip_shortcodes($postExcerpt)), 0, intval($ln)) . '...';
            } else {
                echo strip_tags(strip_shortcodes($postExcerpt));
            }
        } else {
            if (strlen(strip_tags(strip_shortcodes($postContent))) > intval($ln)) {
                echo mb_substr(strip_tags(strip_shortcodes($postContent)), 0, intval($ln)) . '...';
            } else {
                echo strip_tags(strip_shortcodes($postContent));
            }
        }
    }
}

function tsHoverStyle($postId){
    $styles = get_option('shootback_styles');
    $hoverEffect = (isset($styles['style_hover']) && ($styles['style_hover'] == 'style1' || $styles['style_hover'] == 'style2')) ? $styles['style_hover'] : 'style1';
    $sharingOverlay = (isset($styles['sharing_overlay']) && ($styles['sharing_overlay'] == 'Y' || $styles['sharing_overlay'] == 'N')) ? $styles['sharing_overlay'] : 'Y';

    if( $hoverEffect == 'style2' ) : ?>
        <div class="sierra-effect">
            <a href="<?php echo esc_url(get_permalink($postId)); ?>">
                <span><?php _e('Read more', 'shootback'); ?></span>
            </a>
        </div>
    <?php endif; // style 1 ?>
    <?php if( $hoverEffect == 'style1' ) : ?>
        <div class="rocky-effect">
            <div class="entry-overlay">
                <a class="view-more" href="<?php echo esc_url(get_permalink($postId)); ?>">
                    &rarr;
                    <span><?php _e('read more', 'shootback'); ?></span>
                </a>
                <?php if ( $sharingOverlay === 'Y' ) : ?>
                    <ul class="sharing-options">
                        <li data-social="facebook" data-post-id="<?php echo $postId; ?>">
                            <a class="icon-facebook" target="_blank" data-tooltip="<?php _e('share on facebook', 'shootback'); ?>" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink($postId)); ?>"></a>
                        </li>
                        <li data-social="twitter" data-post-id="<?php echo $postId; ?>">
                            <a class="icon-twitter" target="_blank" data-tooltip="<?php _e('share on twitter','shootback'); ?>" href="http://twitter.com/home?status=<?php echo urlencode(esc_attr(get_the_title($postId))); ?>+<?php echo esc_url(get_permalink($postId)); ?>"></a>
                        </li>
                        <li data-social="gplus" data-post-id="<?php echo $postId; ?>">
                            <a class="icon-gplus" target="_blank" data-tooltip="<?php _e('share on g-plus','shootback'); ?>" href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink($postId)); ?>"></a>
                        </li>
                        <li data-social="pinterest" data-post-id="<?php echo $postId; ?>">
                            <a class="icon-pinterest" target="_blank" data-tooltip="<?php _e('share on pinterest','shootback'); ?>" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink($postId)); ?>&amp;media=<?php if(function_exists('the_post_thumbnail')) echo wp_get_attachment_url(get_post_thumbnail_id($postId)); ?>&amp;description=<?php echo urlencode(esc_attr(get_the_title($postId))); ?>" ></a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php
} // end function tsHoverStyle

function tsPasswordPost() {
    global $post;
    $formPassword = '<div class="row">
                        <div class="col-xs-12 col-md-6 col-md-offset-3">
                            <form class="protected-post-form text-center" action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">
                                <p class="lead protected-message">' . __('Enter the password below, to view this protected post', 'shootback') . '</p>
                                <div class="form-group">
                                    <input type="password" name="post_password" class="form-control" id="ts-password-post" placeholder="' . __( 'Enter password', 'shootback' ) . '">
                                </div>
                                <input class="btn medium" type="submit" name="Submit" value="' . __('Submit', 'shootback') . '" />
                            </form>
                        </div>
                    </div>';

    return $formPassword;
}
add_filter('the_password_form', 'tsPasswordPost');


function ts_disable_redirect_canonical( $redirect_url )
{
    if ( is_paged() && is_singular() ) $redirect_url = false; return $redirect_url;
}
add_filter('redirect_canonical','ts_disable_redirect_canonical');

// Add button socials to single product.
function ts_add_social_single_product()
{ ?>
    <div class="product-sharing-options">
        <span class="post-meta-share">
            <?php get_template_part('social-sharing'); ?>
        </span>
    </div>
    <?php
}

add_action( 'woocommerce_single_product_summary', 'ts_add_social_single_product', 100 );

function ts_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => ' &#47; ',
            'wrap_before' => '<div class="container"><nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</div></nav>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}
add_filter( 'woocommerce_breadcrumb_defaults', 'ts_woocommerce_breadcrumbs' );
?>