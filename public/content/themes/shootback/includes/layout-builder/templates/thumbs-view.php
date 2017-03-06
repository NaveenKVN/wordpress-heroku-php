<?php

/* Thumbnail view template below */

// Get the options

global $article_options, $filter_class, $taxonomy_name;

// Get the featured image
$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

$post_per_page = (isset($article_options['elements-per-row']) && (int)$article_options['elements-per-row'] !== 0) ? (int)$article_options['elements-per-row'] : '2';
$scroll = (isset($article_options['behavior']) && $article_options['behavior'] === 'scroll') ? $article_options['behavior'] : '';

$meta = (isset($article_options['meta-thumbnail']) && ($article_options['meta-thumbnail'] === 'y' || $article_options['meta-thumbnail'] === 'n')) ? $article_options['meta-thumbnail'] : 'n';

$edit_post_simple_user = (isset($article_options['edit']) && $article_options['edit'] === true) ? true : NULL;

$title_position = (isset($article_options['display-title']) && ($article_options['display-title'] == 'over-image' || $article_options['display-title'] == 'below-image')) ? $article_options['display-title'] : 'over-image';

$post_count = isset($article_options['j']) ? $article_options['j'] : '';
$i = isset($article_options['i']) ? $article_options['i'] : '';

$social_sharing = get_option('shootback_styles', array('sharing_overlay' => 'N'));

$ts_image_is_masonry = false;
if ( isset($article_options['behavior']) && $article_options['behavior'] == 'masonry' ) {
    $ts_image_is_masonry = true;
}

$img_url = ts_resize('thumbnails', $src, $ts_image_is_masonry);
$noimg_url = get_template_directory_uri() . '/images/noimage.jpg';
$bool = fields::get_options_value('shootback_general', 'enable_imagesloaded');

if ( $src ) {
	$featimage = '<img ' . ts_imagesloaded($bool, $img_url) . ' alt="' . esc_attr(get_the_title()) . '" />';
} else {
	$featimage = '<img ' .  ts_imagesloaded($bool, $noimg_url). ' alt="' . esc_attr(get_the_title()) . '" />';
}


$style_hover = get_option( 'shootback_styles' );
$hover_effect = (isset(	$style_hover['style_hover'] ) && ($style_hover['style_hover'] == 'style1' || $style_hover['style_hover'] == 'style2')) ? $style_hover['style_hover'] : 'style1';

// Get the categories of the article
$post_type = get_post_type(get_the_ID());
$taxonomies = get_object_taxonomies(get_post_type(get_the_ID()));
$exclude_taxonomies = array('post_tag', 'post_format');
$topics = array();
$article_categories = '';

$select_by_category = (isset($article_options['behavior']) && $article_options['behavior'] == 'tabbed') ? 'tabbed' : '';
$attribute_by_category = 'style="display:none;" data-category="';

foreach($taxonomies as $taxonomy){
	if( isset($taxonomy) && !in_array($taxonomy, $exclude_taxonomies) ){
		$topics = wp_get_post_terms( get_the_ID() , $taxonomy );
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

// Get article columns by elements per row
$columns_class = LayoutCompilator::get_column_class($article_options['elements-per-row']);

if( @$filter_class === 'yes' ){
	$filter_categs = array();
	foreach (get_the_terms(get_the_ID(), $taxonomy_name) as $categ) {
		$filter_categs[] = 'ts-category-' . $categ->term_id;
	}
} else{
	$filter_categs = array();
}
$posts_inside = '';
if( ( $i % $post_per_page ) === 1 && $scroll === 'scroll' ){
	$posts_inside = ' posts-inside-'.$post_per_page . ' posts-total-' .$post_per_page;
}
if( ($i % $post_per_page) === 1 && ( $post_count - $i ) < $post_per_page && ( $post_count % $post_per_page ) !== 0 ){
	$class = $post_count % $post_per_page;
	$posts_inside = ' posts-inside-'.$class . ' posts-total-' .$post_per_page;
}

// Check post is sticky
$post_is_sticky = '';
$post_is_sticky_div = '';
if( is_sticky(get_the_ID()) ){
	$post_is_sticky = ' data-sticky="is-sticky" ';
	$post_is_sticky_div = '<div class="is-sticky-div">'.__('is sticky','shootback').'</div>';
}

?>
<?php if( ( $i % $post_per_page ) === 1  && $scroll == 'scroll' ) echo '<div class="scroll-container'. $posts_inside .'">'; ?>
<?php if($post_per_page === 1) echo '<div class="scroll-container'. $posts_inside .'">'; ?>
	<div <?php if( $select_by_category == 'tabbed' ) echo ts_var_sanitize($attribute_by_category); ?> class="item <?php if( $select_by_category == 'tabbed' ) echo 'ts-tabbed-category '; echo $columns_class . ' ' . esc_attr(implode(" ", $filter_categs)); ?>">
		<article <?php echo $post_is_sticky; ?> data-title-position="<?php echo strip_tags($title_position); ?>" <?php echo post_class(); ?> >
			<div class="image-holder">
				<?php if ($meta === 'y' && $title_position == 'below-image') : ?>
		 			<div class="entry-meta">
		 				<ul class="entry-meta-date">
		 					<li class="meta-date"><?php echo get_post_time('j'); ?></li>
		 					<li class="meta-month"><?php echo get_post_time('M'); ?></li>
		 				</ul>
		 			</div>
				<?php endif; ?>
				<a href="<?php the_permalink(); ?>">
					<?php echo ts_var_sanitize($featimage); ?>
					<?php
						if ( ts_overlay_effect_is_enabled() ) {
							echo '<div class="' . ts_overlay_effect_type() . '"></div>';
						}
					?>
				</a>
				<?php if( get_post_type($post->ID) == 'video' || get_post_format($post->ID) == 'video' ): ?>
					<a class="view-video-play" href="<?php the_permalink(); ?>">
						<i class="icon-play"></i>
					</a>
				<?php endif; ?>

				<?php
					if ( $title_position == 'below-image' ) {
						tsHoverStyle(get_the_ID());
					}
				?>
				<?php tsHoverStyle(get_the_ID()); ?>
			</div>
			<section class="entry-content text-center">
				<?php if ($meta === 'y' && $title_position == 'over-image') : ?>
					<ul class="entry-category">
						<?php echo ts_var_sanitize($article_categories); ?>
					</ul>
				<?php endif; ?>
				<div class="entry-title">
					<a href="<?php the_permalink(); ?>"><h3 class="title"><?php the_title(); ?></h3></a>
				</div>
				<?php if( $meta === 'y' && $title_position === 'below-image' ) : ?>
					<ul class="entry-category">
						<?php echo ts_var_sanitize($article_categories); ?>
					</ul>
				<?php endif; ?>
			</section>
			<?php if( isset($edit_post_simple_user) && $edit_post_simple_user === true ) : ?>
				<a class="edit-post-link" href="<?php echo site_url('/edit-post'); ?>?id=<?php echo the_ID(); ?>"><?php _e('Edit', 'shootback'); ?></a>
			<?php endif; ?>
			<?php echo $post_is_sticky_div; ?>
		</article>
	</div>
<?php
	if( ( $i % $post_per_page ) == 0  && $scroll == 'scroll' || ( $i % $post_per_page ) !== 0  && $scroll == 'scroll' && $i === $post_count) echo '</div>';
	
	if( isset($article_options['i']) ) $article_options['i']++;
	
?>
