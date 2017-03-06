<?php

/* Grid view template below */
###########

// Get the options

global $article_options;

if ( isset($article_options['behavior']) && $article_options['behavior'] == 'scroll' ) {
	$scroll = 'scroll';
} elseif ( isset($article_options['behavior']) && $article_options['behavior'] == 'masonry' ) {
	$scroll = 'masonry';
} elseif ( isset($article_options['behavior']) && $article_options['behavior'] == 'carousel' ) {
	$scroll = 'carousel';
} else{
	$scroll = 'normal';
}

$post_count = $article_options['j'];
$post_per_page = (isset($article_options['elements-per-row']) && (int)$article_options['elements-per-row'] !== 0) ? (int)$article_options['elements-per-row'] : '2';
$meta = (isset($article_options['show-meta']) && ($article_options['show-meta'] === 'y' || $article_options['show-meta'] === 'n')) ? $article_options['show-meta'] : 'n';

$post_type = get_post_type(get_the_ID());
$related = (isset($article_options['related-posts']) && ($article_options['related-posts'] === 'y' || $article_options['related-posts'] === 'n')) ? $article_options['related-posts'] : 'n';

$i = $article_options['i'];
$posts_inside = '';

$ts_image_is_masonry = false;
if ( isset($article_options['behavior']) && $article_options['behavior'] === 'masonry' ) {
    $ts_image_is_masonry = true;
}

$show_image = (isset($article_options['show-image']) && ($article_options['show-image'] == 'y' || $article_options['show-image'] == 'n')) ? $article_options['show-image'] : 'y';
if( $show_image == 'y' && has_post_thumbnail(get_the_ID()) ){
	$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
	$img_url = ts_resize('grid', $src, $ts_image_is_masonry);

	$bool = fields::get_options_value('shootback_general', 'enable_imagesloaded');

	if ( $src ) {
		$featimage = '<img ' . ts_imagesloaded($bool, $img_url) . ' alt="' . esc_attr(get_the_title()) . '" />';
	}
}

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

// Get related posts
$related_posts = ($related === 'y') ? LayoutCompilator::get_related_posts(get_the_ID(), get_the_tags()) : '';

// Get article columns by elements per row
$columns_class = LayoutCompilator::get_column_class($article_options['elements-per-row']);

// Add article specific classes

$article_classes = ($meta === 'y') ? ' article-meta-shown ' : ' article-meta-hidden ';

if ( isset($article_options['display-title']) ) {
	$article_classes .= ' ' . $article_options['display-title'] . ' ';
}
if ( isset($article_options['behavior']) && $article_options['behavior'] == 'masonry' ) {
	$article_classes .= ' masonry-element ';
}
$posts_inside = '';

if( ( $i % $post_per_page ) == 1 && $scroll === 'scroll' ){
	$posts_inside = ' posts-inside-' . $post_per_page . ' posts-total-' . $post_per_page;
}
if( ($i % $post_per_page) == 1 && ( $post_count - $i ) < $post_per_page && ( $post_count % $post_per_page ) !== 0 ){
	$class = $post_count % $post_per_page;
	$posts_inside = ' posts-inside-' . $class . ' posts-total-' . $post_per_page;
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
<?php if( ( $i % $post_per_page ) === 1  && $scroll === 'scroll' ) echo '<div class="scroll-container' . $posts_inside . '">'; ?>
<?php if($post_per_page == 1  && $scroll === 'scroll' ) echo '<div class="scroll-container' . $posts_inside .'">'; ?>
	<div <?php if( $select_by_category == 'tabbed' ) echo ts_var_sanitize($attribute_by_category); ?> class="<?php echo $columns_class; if( $select_by_category == 'tabbed' ) echo ' ts-tabbed-category' ?> item">
		<article <?php echo $post_is_sticky; ?> <?php echo post_class( $article_classes ); ?>>
			<header>
				<?php if ( isset($article_options['display-title']) && $article_options['display-title'] == 'title-above-image' ): ?>
					<?php if ($article_options['show-meta'] === 'y') : ?>
						<ul class="entry-category">
							<?php echo ts_var_sanitize($article_categories); ?>
						</ul>
					<?php endif; ?>
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></h3>
					<?php if ($article_options['show-meta'] === 'y') : ?>
			 			<div class="entry-meta">
			 				<ul class="entry-meta-date">
			 					<li class="meta-date"><?php echo get_post_time('j'); ?></li>
			 					<li class="meta-month"><?php echo get_post_time('M'); ?></li>
			 				</ul>
			 			</div>
					<?php endif; ?>
				<?php endif; ?>
				<?php if( isset($featimage) ) : ?>
					<div class="image-holder">
						<?php if( isset($rating_final) ) : ?>
							<div class="post-rating-circular">
								<div class="circular-content">
									<div class="counted-score"><?php echo ts_var_sanitize($rating_final, 'esc_attr'); ?>/10</div>
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
				<?php endif; ?>
			</header>
			<section>
				<?php if ( @$article_options['display-title'] == 'title-below-image' ): ?>
					<?php if ($article_options['show-meta'] === 'y') : ?>
						<ul class="entry-category">
							<?php echo ts_var_sanitize($article_categories); ?>
						</ul>
					<?php endif; ?>
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></h3>
					<?php if ($article_options['show-meta'] === 'y') : ?>
			 			<div class="entry-meta">
			 				<ul class="entry-meta-date">
			 					<li class="meta-date"><?php echo get_post_time('j'); ?></li>
			 					<li class="meta-month"><?php echo get_post_time('M'); ?></li>
			 				</ul>
			 			</div>
					<?php endif; ?>
				<?php endif; ?>
				<div class="entry-excerpt">
					<?php ts_excerpt('grid_excerpt', get_the_ID(), 'show-subtitle'); ?>
				</div>
				<div class="grid-more">
					<a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">&rarr;</a>
				</div>
			</section>
			<?php echo $post_is_sticky_div; ?>
		</article>
		<?php if( $related === 'y' ) echo ts_var_sanitize($related_posts); ?>
	</div>
<?php
if( ( $i % $post_per_page ) == 0  && $scroll == 'scroll' || ( $i % $post_per_page ) !== 0  && $scroll == 'scroll' && $i === $post_count) echo '</div>';

$article_options['i']++;
?>