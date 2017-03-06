<?php
global $article_options;

// Get article columns by elements per row
$columns_class = (isset($article_options['elements-per-row']) && $article_options['elements-per-row'] !== '' && (int)$article_options['elements-per-row'] !== 0) ? LayoutCompilator::get_column_class((int)$article_options['elements-per-row']) : '';

// Get the featured image
$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

$img_url = ts_resize('timeline', $src);

$noimg_url = get_template_directory_uri() . '/images/noimage.jpg';
$bool = fields::get_options_value('shootback_general', 'enable_imagesloaded');
$social_sharing = get_option('shootback_styles', array('sharing_overlay' => 'N'));

if ( $src ) {
	$featimage = '<img ' . ts_imagesloaded($bool, $img_url) . ' alt="' . esc_attr(get_the_title()) . '" />';
} else {
	$featimage = '<img ' .  ts_imagesloaded($bool, $noimg_url). ' alt="' . esc_attr(get_the_title()) . '" />';
}

$style_hover = get_option('shootback_styles');
$hover_effect = (isset(	$style_hover['style_hover'] ) && ($style_hover['style_hover'] == 'style1' || $style_hover['style_hover'] == 'style2')) ? $style_hover['style_hover'] : 'style1';

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

// Get post rating
$rating_final = ts_get_rating($post->ID);

?>
<div class="ts-timeline buffer-left">
 	<article>
 		<?php if( isset($article_options['image']) && $article_options['image'] == 'y' ) : ?>
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
 			<?php if($article_options['show-meta'] === 'y') : ?>
	 			<div class="entry-meta">
	 				<ul class="entry-meta-date">
	 					<li class="meta-date"><?php echo get_post_time('j'); ?></li>
	 					<li class="meta-month"><?php echo get_post_time('M'); ?></li>
	 				</ul>
	 			</div>
	 		<?php endif; ?>
 			<div class="entry-content">
	 			<?php if($article_options['show-meta'] === 'y') : ?>
 					<ul class="entry-category">
 						<?php echo ts_var_sanitize($article_categories); ?>
 					</ul>
		 		<?php endif; ?>
	 			<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	 			<p class="entry-excerpt">
	 				<?php ts_excerpt('timeline_excerpt', get_the_ID(), 'show-subtitle'); ?>
	 			</p>
	 			<a href="<?php the_permalink(); ?>" class="article-view-more btn small"> <?php _e('details', 'shootback'); ?></a>
 			</div>
 		</section>
 	</article>
</div>