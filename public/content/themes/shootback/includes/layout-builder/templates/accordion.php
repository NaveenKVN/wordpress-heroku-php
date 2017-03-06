<?php
global $article_options;

$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
$img_url = ts_resize('grid', $src, false);

$noimg_url = get_template_directory_uri() . '/images/noimage.jpg';
$bool = fields::get_options_value('shootback_general', 'enable_imagesloaded');

if ( $src ) {
	$featimage = '<img ' . ts_imagesloaded($bool, $img_url) . ' alt="' . esc_attr(get_the_title()) . '" />';
} else {
	$featimage = '<img ' .  ts_imagesloaded($bool, $noimg_url). ' alt="' . esc_attr(get_the_title()) . '" />';
}

$article_date = get_the_date();

$collapse_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
$social_sharing = get_option('shootback_styles', array('sharing_overlay' => 'N'));
$i = $article_options['i'];
$accordion_id = $article_options['accordion_id'];

$subtitle = get_post_meta(get_the_ID(), 'post_settings', true);
$subtitle = (isset($subtitle['subtitle']) && $subtitle['subtitle'] !== '' && is_string($subtitle['subtitle'])) ? esc_attr($subtitle['subtitle']) : NULL;

// Get post rating
$rating_final = ts_get_rating($post->ID);

?>
<div class="panel panel-default" role="tab">
	<div class="text-center panel-heading<?php if( $i == 1 ) echo ' hidden'; ?>" role="tab" id="ts-<?php echo ts_var_sanitize($collapse_id); ?>">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#<?php echo ts_var_sanitize($accordion_id); ?>" href="#<?php echo ts_var_sanitize($collapse_id); ?>" aria-expanded="true" aria-controls="<?php echo ts_var_sanitize($collapse_id); ?>"><?php the_title(); ?></a>
		</h4>
		<div class="entry-meta-date">
			<?php echo ts_var_sanitize($article_date); ?>
		</div>
	</div>
	<div id="<?php echo ts_var_sanitize($collapse_id); ?>" class="panel-collapse collapse<?php if( $i == 1 ) echo ' in' ?>" role="tabpanel" aria-labelledby="ts-<?php echo ts_var_sanitize($collapse_id); ?>">
		<div class="inner-content">
			<article>
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
					</div>
				</header>
				<section class="text-center">
					<div class="entry-title">
						<h3 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="entry-meta-date">
							<?php echo ts_var_sanitize($article_date); ?>
						</div>
					</div>
					<div class="entry-excerpt">
						<?php ts_excerpt(70, get_the_ID(), 'show-subtitle'); ?>
					</div>
					<a class="article-view-more btn small" href="<?php the_permalink(); ?>">
						<?php if( $post_type == 'video' ) _e('Play','shootback'); else _e('Read more','shootback'); ?>
						<i>&rarr;</i>
					</a>
				</section>
			</article>
		</div>
	</div>
</div>