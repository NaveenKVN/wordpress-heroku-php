<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

global $article_options;

$classes = array();
if( isset($article_options['elements-per-row']) ){

   array_push($classes, LayoutCompilator::get_column_class($article_options['elements-per-row']));

}else{
    // Extra post classes
    if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
        $classes[] = 'first';
    if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
        $classes[] = 'last';
    if( $woocommerce_loop['columns'] == 3 ){
        $classes[] = 'col-lg-4';
    } elseif( $woocommerce_loop['columns'] == 4 ){
        $classes[] = 'col-lg-3';
    } elseif( $woocommerce_loop['columns'] == 2 ){
        $classes[] = 'col-lg-6';
    } elseif( $woocommerce_loop['columns'] == 5 ){
        $classes[] = 'col-lg-4';
    } elseif( $woocommerce_loop['columns'] == 6 ){
        $classes[] = 'col-lg-2';
    } else{
        $classes[] = 'col-lg-3';
    }
}
$ts_image_is_masonry = false;
if ( isset($article_options['behavior']) && $article_options['behavior'] == 'masonry' ) {
    array_push($classes, 'masonry-element');
    $ts_image_is_masonry = true;
}

$size = 'product_grid';
$meta = get_option('shootback_single_post', array('post_meta'=> 'Y'));
?>

<div <?php post_class( $classes ); ?> data-post-id="<?php echo (int)$post->ID; ?>" >
    <article>
        <?php if ( $product->is_on_sale() ) : ?>
            <?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale', 'shootback' ) . '</span><span class="onsale-after"></span>', $post, $product ); ?>
        <?php endif; ?>
        <header>
            <div class="featimg">
                <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
                <?php
                    if (has_post_thumbnail($post->ID)) {


                        $src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

                        $img_url = ts_resize('grid', $src, $ts_image_is_masonry);

                        $noimg_url = get_template_directory_uri() . '/images/noimage.jpg';
                        $bool = fields::get_options_value('shootback_general', 'enable_imagesloaded');

                        if ( $src ) {
                            $featimage = '<img ' . ts_imagesloaded($bool, $img_url) . ' alt="' . esc_attr(get_the_title()) . '" />';
                        } else {
                            $featimage = '<img ' .  ts_imagesloaded($bool, $noimg_url). ' alt="' . esc_attr(get_the_title()) . '" />';
                        }
                    ?>
                        <a href="<?php echo get_permalink($post->ID);  ?>">
                            <?php echo $featimage; ?>
                        </a>
                    <?php
                    }
                ?>
            </div>
        </header>
        <section>
            <div class="entry-section text-center">
                <div class="entry-title">
                    <h3>
                        <a href="<?php echo get_permalink($post->ID);  ?>" title="<?php _e('Permalink to', 'shootback'); ?> <?php echo $post->post_title; ?>" rel="bookmark"><?php echo esc_attr($post->post_title); ?></a>
                    </h3>
                    <?php do_action( 'woocommerce_after_shop_loop_item_rating' ); ?>
                </div>
            </div>
            <div class="entry-footer">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6">
                        <div class="entry-categories">
                            <ul>
                                <?php
                                    $product_categories = wp_get_post_terms(get_the_ID(), 'product_cat' );
                                    foreach ($product_categories as $category) {
                                        $categ = get_category($category);
                                        echo '<li>' . '<a href="' . get_category_link($category) . '">' . $category->name .  '</a>' . '</li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-6 col-xs-6 text-right">
                        <div class="grid-shop-options">
                            <div class="price-options">
                                <?php
                                    do_action( 'woocommerce_after_shop_loop_item_title' );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="grid-shop-button text-center">
            <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
        </div>
    </article>
</div>