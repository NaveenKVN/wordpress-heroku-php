<?php

/* List view template below */
###########

// Get the options

global $article_options;

// Get the split columns
$splits = LayoutCompilator::get_splits(@$article_options['image-split']);

$image_split   = $splits['split1'];
$content_split = $splits['split2'];

if ($article_options['image-split'] = '1-3') {
	$image_split = 'col-lg-5 col-md-5 col-sm-12';
	$content_split = 'col-lg-7 col-md-7 col-sm-12';
}

// Get the featured image
$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

$meta = (isset($article_options['show-meta']) && ($article_options['show-meta'] === 'y' || $article_options['show-meta'] === 'n')) ? $article_options['show-meta'] : 'n';
$social_sharing = get_option('shootback_styles', array('sharing_overlay' => 'N'));
$post_type = get_post_type(get_the_ID());

$show_image = (isset($article_options['show-image']) && ($article_options['show-image'] == 'y' || $article_options['show-image'] == 'n')) ? $article_options['show-image'] : 'y';
if( $show_image == 'y' && has_post_thumbnail(get_the_ID()) ){
	$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
	$img_url = ts_resize('bigpost', $src);

	$bool = fields::get_options_value('shootback_general', 'enable_imagesloaded');

	if ( $src ) {
		$featimage = '<img ' . ts_imagesloaded($bool, $img_url) . ' alt="' . esc_attr(get_the_title()) . '" />';
	}
}

$style_hover = get_option( 'shootback_styles' );
$hover_effect = (isset(	$style_hover['style_hover'] ) && ($style_hover['style_hover'] == 'style1' || $style_hover['style_hover'] == 'style2')) ? $style_hover['style_hover'] : 'style1';

$article_date =  get_the_date();

// Get the categories of the article
$taxonomies = get_object_taxonomies(get_post_type(get_the_ID()));
$exclude_taxonomies = array('post_tag', 'post_format');
$topics = array();
$article_categories = '';

$select_by_category = (isset($article_options['behavior']) && $article_options['behavior'] == 'tabbed') ? 'tabbed' : '';
$attribute_by_category = 'style="display:none;" data-category="';

foreach($taxonomies as $taxonomy){
	if( isset($taxonomy) && !in_array($taxonomy, $exclude_taxonomies) ){
		$topics = wp_get_post_terms(get_the_ID() , $taxonomy);
		$i_terms = 1;

		foreach ($topics as $term) {
			if( $i_terms == count($topics) ) {
				$comma = '';
				$dividing_category = '';
			}else{
				$comma = '<li>&nbsp;/&nbsp;</li>';
				$dividing_category = '\\';
			}  
			$article_categories .= '<li>' . '<a href="' . get_term_link($term->slug, $taxonomy) . '" title="' . __('View all articles from: ', 'shootback') . $term->name . '" ' . '>' . $term->name . '</a></li>'.$comma.'';

			if( $select_by_category == 'tabbed' ){
				$attribute_by_category .= $term->term_id . $dividing_category;
			}

			$i_terms++;
		}
	}
}
$attribute_by_category .= '"';

// Get the tags of the article

$article_tags = get_the_tag_list('<li>', '</li>');

// Get related posts

if ( isset($article_options['related-posts']) && $article_options['related-posts'] === 'y' ) {
	$related_posts = LayoutCompilator::get_related_posts( get_the_ID(), get_the_tags());
} else {
	$related_posts = '';
}

// Add article specific classes

$article_classes = ($article_options['image-split']) ? ' article-split-'.$article_options['image-split'] . ' ' : '';

if ( $meta === 'y' ) {
	$article_classes .= ' article-meta-shown ';
} else{
	$article_classes .= ' article-meta-hidden ';
}
if ( isset($article_options['display-title']) ) {
	$article_classes .= ' ' . $article_options['display-title'] . ' ';
}

// Get post rating
$rating_final = ts_get_rating($post->ID);

// Check post is sticky
$post_is_sticky = '';
$post_is_sticky_div = '';
if( is_sticky(get_the_ID()) ){
	$post_is_sticky = ' data-sticky="is-sticky" ';
	$post_is_sticky_div = '<div class="is-sticky-div">'.__('is sticky','shootback').'</div>';
}

?>
<div class="col-lg-12">
	<article <?php echo $post_is_sticky; ?> data-featured-image="<?php if( !isset($featimage)) echo 'no-image'; ?>" <?php echo post_class( $article_classes ); echo ' entry'; ?> >	
		<?php if( isset($featimage) ) : ?>
			<header>
				<div class="image-holder">
					<?php if( isset($rating_final) ) : ?>
						<div class="post-rating-circular">
							<div class="circular-content">
								<div class="counted-score"><?php echo ts_var_sanitize($rating_final); ?>/10</div>
							</div>
						</div>
					<?php endif; ?>
					<?php echo ts_var_sanitize($featimage); ?>
					<?php
						if ( ts_overlay_effect_is_enabled() ) {
							echo '<div class="' . ts_overlay_effect_type() . '"></div>';
						}
					?>
					
					<?php tsHoverStyle(get_the_ID()); ?>

					<?php if( get_post_type($post->ID) == 'video' || get_post_format($post->ID) == 'video' ): ?>
						<div class="view-video-play">
							<i class="icon-play"></i>
						</div>
					<?php endif; ?>
				</div>
			</header>
		<?php endif; ?>
		<section>
			<div class="row">
				<div class="<?php echo $image_split; ?>">
					<div class="sidebar">
						<?php if( $meta === 'y' ) : ?>
							<div class="entry-meta">
								<ul class="entry-category">
									<?php echo ts_var_sanitize($article_categories); ?>
								</ul>
							</div>
						<?php endif; ?>
						<h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h4>
						<?php if( $meta === 'y' ) : ?>
							<div class="entry-meta">
								<ul class="entry-meta-date">
									<li class="meta-date"><?php echo get_post_time('j'); ?></li>
									<li class="meta-month"><?php echo get_post_time('M'); ?></li>
								</ul>
								<?php touchsize_likes($post->ID, '<div class="entry-meta-likes">', '</div>'); ?>
							</div>
						<?php endif; ?>
						<?php if( $meta === 'y' && has_tag() ) : ?>
							<div class="entry-tags">
								<span><?php _e('tagged in:','shootback') ?></span>
								<?php the_tags('',', '); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="<?php if( $meta === 'y' ) echo $content_split; else echo 'col-lg-12 col-md-12 col-sm-12'; ?>">
					<div class="entry-content">
						<p class="entry-excerpt">
							<?php ts_excerpt('list_excerpt', get_the_ID(), 'show-subtitle'); ?>
						</p>
						<a href="<?php the_permalink(); ?>" class="article-view-more btn small"> <?php _e('details', 'shootback'); ?></a>
					</div>
				</div>
			</div>
		</section>
		<?php echo $post_is_sticky_div; ?>
	</article>
</div>
