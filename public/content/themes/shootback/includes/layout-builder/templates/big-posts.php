<?php

/* Big posts template below */
###########

// Get the options

global $article_options;

// Get the split columns
$splits = LayoutCompilator::get_splits(@$article_options['image-split']);

$image_split   = $splits['split1'];
$content_split = $splits['split2'];

$meta = (isset($article_options['show-meta']) && ($article_options['show-meta'] === 'y' || $article_options['show-meta'] === 'n')) ? $article_options['show-meta'] : 'n';
$social_sharing = get_option('shootback_styles', array('sharing_overlay' => 'N'));

$post_type = get_post_type(get_the_ID());
$related = (isset($article_options['related-posts']) && ($article_options['related-posts'] === 'y' || $article_options['related-posts'] === 'n')) ? $article_options['related-posts'] : 'n';

if (isset($article_options['image-position'])) $image_position = $article_options['image-position'];
else $image_position = 'left';
$show_excerpt = (isset($article_options['excerpt']) && ($article_options['excerpt'] == 'y' || $article_options['excerpt'] == 'n')) ? $article_options['excerpt'] : 'y';

// Get the featured image
$show_image = (isset($article_options['show-image']) && ($article_options['show-image'] == 'y' || $article_options['show-image'] == 'n')) ? $article_options['show-image'] : 'y';
$content_split = ($show_image == 'n' || !has_post_thumbnail($post->ID) ) ? 'col-lg-12 col-md-12 col-sm-12 col-xs-12 no-image' : $content_split;

if( $show_image == 'y' && has_post_thumbnail(get_the_ID()) ){
	$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
	$img_url = ts_resize('bigpost', $src);

	$bool = fields::get_options_value('shootback_general', 'enable_imagesloaded');

	if ( $src ) {
		$featimage = '<img ' . ts_imagesloaded($bool, $img_url) . ' alt="' . esc_attr(get_the_title()) . '" />';
	}
}

$style_hover = get_option( 'shootback_styles' );
$hover_effect = (isset($style_hover['style_hover'] ) && ($style_hover['style_hover'] == 'style1' || $style_hover['style_hover'] == 'style2')) ? $style_hover['style_hover'] : 'style1';

// Get the categories of the article
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

// Get related posts
$related_posts = ($related === 'y') ? LayoutCompilator::get_related_posts( get_the_ID(), get_the_tags()) : '';

// Add article specific classes
$article_classes = ($meta === 'y') ? ' article-meta-shown ' : ' article-meta-hidden ';

if ( $article_options['image-split'] ) {
	$article_classes .= ' article-split-'.$article_options['image-split'] . ' ';
}
if ( $related == 'y' ) {
	$article_classes .= ' article-related-shown ';
}

if ( $article_options['display-title'] ) {
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
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<article <?php echo $post_is_sticky; ?> data-position="<?php echo strip_tags($image_position); ?>" <?php echo post_class( $article_classes );?> >
		<?php if ( @$article_options['display-title'] == 'title-above-image' ): ?>
			<div class="entry-title">
				<?php if ($article_options['show-meta'] === 'y') : ?>
					<div class="row">
						<div class="col-sm-3 col-xs-6 text-left">
							<div class="entry-meta">
								<ul class="entry-meta-date">
									<li class="meta-date"><?php echo get_post_time('j'); ?></li>
									<li class="meta-month"><?php echo get_post_time('M'); ?></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-9 col-xs-6 text-right">
							<ul class="entry-category">
								<?php echo ts_var_sanitize($article_categories); ?>
							</ul>
						</div>
					</div>
				<?php endif; ?>
				<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></h3>
			</div>
		<?php endif; ?>
		<div class="row">
			<?php if ( $image_position == 'left' || $image_position == 'mosaic' ): ?>
				<?php if ( isset($featimage) ) : ?>
					<header class="<?php echo $image_split; ?>">
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
							<?php if( get_post_type($post->ID) == 'video' || get_post_format($post->ID) == 'video' ): ?>
								<div class="view-video-play">
									<i class="icon-play"></i>
								</div>
							<?php endif; ?>

							<?php tsHoverStyle(get_the_ID()); ?>

						</div>
					</header>
				<?php endif; ?>
				<section class="<?php echo $content_split; ?>">
					<div class="entry-section text-center">
						<?php if ( @$article_options['display-title'] == 'title-below-image' ): ?>
							<?php if ($article_options['show-meta'] === 'y') : ?>
								<div class="row">
									<div class="col-sm-3 col-xs-6 text-left">
										<div class="entry-meta">
											<ul class="entry-meta-date">
												<li class="meta-date"><?php echo get_post_time('j'); ?></li>
												<li class="meta-month"><?php echo get_post_time('M'); ?></li>
											</ul>
										</div>
									</div>
									<div class="col-sm-9 col-xs-6 text-right">
										<ul class="entry-category">
											<?php echo ts_var_sanitize($article_categories); ?>
										</ul>
									</div>
								</div>
							<?php endif; ?>
							<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></h3>
						<?php endif; ?>
						<?php if( $show_excerpt == 'y' ) : ?>
							<div class="entry-excerpt excerpt">
								<?php ts_excerpt('bigpost_excerpt', get_the_ID(), 'show-subtitle'); ?>
							</div>
						<?php endif; ?>
						<a class="article-view-more btn small" href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
							<?php _e('details','shootback');?>
						</a>
					</div>
				</section>
			<?php elseif ($image_position == 'right'): ?>
				<section class="<?php echo $content_split; ?>">
					<div class="entry-section text-center">
						<?php if ( @$article_options['display-title'] == 'title-below-image' ): ?>
							<?php if ($article_options['show-meta'] === 'y') : ?>
								<div class="row">
									<div class="col-sm-3 col-xs-6 text-left">
										<div class="entry-meta">
											<ul class="entry-meta-date">
												<li class="meta-date"><?php echo get_post_time('j'); ?></li>
												<li class="meta-month"><?php echo get_post_time('M'); ?></li>
											</ul>
										</div>
									</div>
									<div class="col-sm-9 col-xs-6 text-right">
										<ul class="entry-category">
											<?php echo ts_var_sanitize($article_categories); ?>
										</ul>
									</div>
								</div>
							<?php endif; ?>
							<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></h3>
						<?php endif; ?>
						<div class="entry-excerpt excerpt">
							<?php ts_excerpt('bigpost_excerpt', get_the_ID(), 'show-excerpt'); ?>
						</div>
						<a class="article-view-more btn small" href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
							<?php _e('details','shootback');?>
						</a>
					</div>
				</section>
				<?php if ( isset($featimage) ) : ?>
					<header class="<?php echo $image_split; ?>">
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
							<?php if( get_post_type($post->ID) == 'video' || get_post_format($post->ID) == 'video' ): ?>
								<div class="view-video-play">
									<i class="icon-play"></i>
								</div>
							<?php endif; ?>

							<?php tsHoverStyle(get_the_ID()); ?>
							
						</div>
					</header>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php echo $post_is_sticky_div; ?>
		<?php echo ts_var_sanitize($related_posts); ?>
	</article>
</div>
<?php $article_options['i']++; ?>