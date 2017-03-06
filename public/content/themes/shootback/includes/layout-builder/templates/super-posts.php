<?php

/* Super posts view template below */
###########

// Get the options

global $article_options;

// Get the featured image
$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

$img_url = ts_resize('superpost', $src);
$noimg_url = get_template_directory_uri() . '/images/noimage.jpg';
$bool = fields::get_options_value('shootback_general', 'enable_imagesloaded');

if ( $src ) {
	$featimage = '<img ' . ts_imagesloaded($bool, $img_url) . ' alt="' . esc_attr(get_the_title()) . '" />';
} else {
	$featimage = '<img ' .  ts_imagesloaded($bool, $noimg_url). ' alt="' . esc_attr(get_the_title()) . '" />';
}

$article_date =  get_the_date();

// Get the categories of the article
$post_type = get_post_type(get_the_ID());
$category_tax = ($post_type == 'portfolio' ? 'portfolio_categories' : ($post_type == 'video' ? 'videos_categories' : ($post_type == 'ts-gallery' ? 'gallery_categories' : ($post_type == 'event' ? 'event_categories' : 'category'))));

$topics = wp_get_post_terms( get_the_ID() , $category_tax );

$terms = array();
if( !empty( $topics ) ){
    foreach ( $topics as $topic ) {
        $term = get_category( $topic->slug );
        $terms[$topic->slug] = $topic->name;
    }
}
$article_categories = '';
$i = 1;
foreach ($terms as $key => $term) {
	if( $i === count($terms) ) $comma = ''; 
	else $comma = '<li>&nbsp;/&nbsp;</li>'; 
	$article_categories .= '<li>' . '<a href="' . get_term_link($key, $category_tax) . '" title="' . __('View all articles from: ', 'shootback') . $term . '" ' . '>' . $term.'</a></li>'.$comma.'';
	$i++;
}

// Get article columns by elements per row
$columns_class = LayoutCompilator::get_column_class($article_options['elements-per-row']);

// Check post is sticky
$post_is_sticky = '';
$post_is_sticky_div = '';
if( is_sticky(get_the_ID()) ){
	$post_is_sticky = ' data-sticky="is-sticky" ';
	$post_is_sticky_div = '<div class="is-sticky-div">'.__('is sticky','shootback').'</div>';
}

?>
<div class="<?php echo $columns_class; ?>">
	<article <?php echo $post_is_sticky; ?> <?php echo post_class(); ?> >
		<header>
			<div class="image-holder">
				<a href="<?php the_permalink(); ?>">
					<?php echo $featimage; ?>
					<?php
						if ( ts_overlay_effect_is_enabled() ) {
							echo '<div class="' . ts_overlay_effect_type() . '"></div>';
						}
					?>
				</a>
			</div>
		</header>
		<section>
			<div class="entry-meta">
				<ul class="entry-meta-date">
					<li class="meta-date"><?php echo get_post_time('j'); ?></li>
					<li class="meta-month"><?php echo get_post_time('M'); ?></li>
				</ul>
				<?php touchsize_likes($post->ID, '<div class="entry-meta-likes">', '</div>'); ?>
			</div>
			<div class="entry-content">
				<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<p class="entry-excerpt">
					<?php ts_excerpt('timeline_excerpt', get_the_ID(), 'show-subtitle'); ?>
				</p>
				<a href="<?php the_permalink(); ?>" class="button article-view-more"> <?php _e('Read more', 'shootback'); ?> &rarr;</a>
			</div>
		</section>
		<?php echo $post_is_sticky_div; ?>
	</article>
</div>