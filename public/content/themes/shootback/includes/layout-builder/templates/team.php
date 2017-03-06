<?php

/* Team view template below */
###########

// Get the options

global $article_options;

$meta = get_post_meta( get_the_ID(), 'ts_member', true);

$position = (trim(@$meta['position']) !== '') ?
					'<i class="author-position">'.esc_attr($meta['position']).'</i>' : '';

// $position = @$meta['position'];
$about_member = (isset($meta['about_member'])) ? esc_attr($meta['about_member']) : '';

$facebook = ( isset($meta['facebook']) ) ? trim((string)$meta['facebook']) : '';
$twitter  = ( isset($meta['twitter'] ) ) ? trim((string)$meta['twitter']) : '';
$gplus    = ( isset($meta['gplus']) ) ? trim((string)$meta['twitter']) : '';
$linkedin = ( isset($meta['linkedin']) ) ? trim((string)$meta['linkedin']) : '';

if ( $facebook != '' ) {
	$facebook = '<li class=""><a href="'.esc_url($facebook).'" class="icon-facebook"> </a></li>';
}

if ( $twitter != '' ) {
	$twitter = '<li class=""><a href="'.esc_url($twitter).'" class="icon-twitter"> </a></li>';
}

if ( $linkedin != '' ) {
	$linkedin = '<li class=""><a href="'.esc_url($linkedin).'" class="icon-linkedin"> </a></li>';
}

if ( $gplus != '' ) {
	$gplus = '<li class=""><a href="'.esc_url($gplus).'" class="icon-gplus"> </a></li>';
}

// $author_img = get_the_post_thumbnail( get_the_ID(), 'team' );
// Get the featured image
$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

$ts_image_is_masonry = false;
if ( isset($article_options['behavior']) && $article_options['behavior'] == 'masonry' ) {
    $ts_image_is_masonry = true;
}

$img_url = aq_resize( $src, 400, 400, false, true);

$noimg_url = get_template_directory_uri() . '/images/noimage.jpg';
$bool = fields::get_options_value('shootback_general', 'enable_imagesloaded');

if ( $src ) {
	$featimage = '<img ' . ts_imagesloaded($bool, $img_url) . ' alt="' . esc_attr(get_the_title()) . '" />';
} else {
	$featimage = '<img ' .  ts_imagesloaded($bool, $noimg_url). ' alt="' . esc_attr(get_the_title()) . '" />';
}

// Get article columns by elements per row
$columns_class = LayoutCompilator::get_column_class($article_options['elements-per-row']);


?>
<div class="<?php echo $columns_class; ?>">
	<article>
		<header>
			<div class="image-holder">
				<a href="<?php the_permalink(); ?>">
					<?php echo ts_var_sanitize($featimage); ?>
				</a>
				<div class="inner-content">
					<p class="article-excerpt">
						<?php echo ts_var_sanitize($about_member); ?>
					</p>
					<div class="article-social">
						<div class="social-icons">
							<ul class="">
							<?php echo ts_var_sanitize($facebook . $twitter . $linkedin . $gplus); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="article-title">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			</div>
			<div class="article-position">
			<?php echo ts_var_sanitize($position); ?>
			</div>
		</header>
	</article>
</div>