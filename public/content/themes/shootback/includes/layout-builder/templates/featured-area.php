<?php

/* Featured area template below */
###########

// Get the options

global $article_options, $posts_query;

$generalOptions = get_option('esquise_general');

$custom_post = (isset($article_options['custom-post']) && ($article_options['custom-post'] == 'post' || $article_options['custom-post'] == 'video' || $article_options['custom-post'] == 'gallery')) ? $article_options['custom-post'] : 'post';
$style = 'posts-right-of-main-image';

$store_image_featured = array();
$date_posts = array();
$store_image_thumbnail = array();
$post_number = 0;
$videos = array();
$single_id = array();
$the_permalink = array();

while ( $posts_query->have_posts() ) { $posts_query->the_post();

	if( $custom_post == 'video' ){
		$videos[$post_number] = get_post_meta($post->ID, 'video', true);
	}

	$total_posts = $posts_query->post_count;
	$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

	$noimg_url = get_template_directory_uri() . '/images/noimage.jpg';
	$bool = fields::get_options_value('shootback_general', 'enable_imagesloaded');

	if ( $src ) {
		$img_url_featured = ts_resize('featarea', $src);
		$featimage_featured = '<img ' . ts_imagesloaded($bool, $img_url_featured) . ' alt="' . esc_attr(get_the_title()) . '" />';
		$img_url_thumbnail = aq_resize($src, 90, 90, true, true);
		$featimage_thumbnail = '<img ' . ts_imagesloaded($bool, $img_url_thumbnail) . ' alt="' . esc_attr(get_the_title()) . '" />';
	} else {
		$featimage_featured = '<img ' .  ts_imagesloaded($bool, $noimg_url). ' alt="' . esc_attr(get_the_title()) . '" />';
		$featimage_thumbnail = '<img ' .  ts_imagesloaded($bool, $noimg_url). ' alt="' . esc_attr(get_the_title()) . '" />';
	}

	// Get the categories of the article
	if ( get_post_type(get_the_ID()) === 'portfolio' ) {
		$category_tax = 'portfolio_categories';
	}elseif(get_post_type(get_the_ID()) === 'ts-gallery'){
		$category_tax = 'gallery_categories';
	}elseif(get_post_type(get_the_ID()) === 'video'){
		$category_tax = 'videos_categories';
	}else{
		$category_tax = 'category';
	}

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

	$article_date =  get_the_date();

	$store_image_featured[$post_number] = $featimage_featured;
	$store_image_thumbnail[$post_number]['id'] = $post->ID;
	$store_image_thumbnail[$post_number]['image'] = $featimage_thumbnail;
	$store_image_thumbnail[$post_number]['date'] = $article_date;
	$store_image_thumbnail[$post_number]['title'] = $post->post_title;
	$the_permalink[$post_number] = get_permalink();
	$single_id[$post_number] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
	$store_post_type[$post_number] = $post->post_type;
	$post_number++;
}

if( $custom_post == 'post' || $custom_post == 'gallery' ){

?>
	<div class="col-lg-12 ts-featured-area <?php echo $style; ?>">
		<div class="inner-area-container col-md-12">
			<div class="row">
				<div class="col-sm-12 col-md-9">
					<div class="tab-content">
						<?php foreach($store_image_featured as $key=>$url_img_featured) : ?>
							<div class="tab-pane <?php if( $key == 0 ) echo 'active' ?>" id="<?php echo $single_id[$key]; ?>">
								<div class="featured-area-image">
									<div class="image-holder">
										<a href="<?php echo ts_var_sanitize($the_permalink[$key], 'esc_url'); ?>">
											<?php echo ts_var_sanitize($url_img_featured); ?>
											<?php
												if ( ts_overlay_effect_is_enabled() ) {
													echo '<div class="' . ts_overlay_effect_type() . '"></div>';
												}
											?>
										</a>
									</div>
								</div>
								<div class="featured-area-content">
									<div class="entry-content">
										<h3 class="entry-title">
											<a href="<?php echo ts_var_sanitize($the_permalink[$key], 'esc_url'); ?>">
												<?php echo ts_var_sanitize($store_image_thumbnail[$key]['title']); ?>
											</a>
										</h3>
										<span class="entry-meta">
											<?php echo ts_var_sanitize($article_date); ?>
											<?php _e(' by ','shootback'); ?>
											<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
										</span>
										<?php touchsize_likes($store_image_thumbnail[$key]['id'], '<div class="entry-meta-likes">', '</div>'); ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="col-sm-12 col-md-3 featured-area-tabs">
					<ul class="nav nav-tabs row" role="tablist">
					<?php foreach($store_image_thumbnail as $key=>$url_img_thumbnail) : ?>
						<li class="tab-item col-lg-3 col-md-3 col-sm-3 <?php if( $key == 0 ) echo 'active '; ?>">
							<a href="#<?php echo ts_var_sanitize($single_id[$key]); ?>" role="tab" data-toggle="tab">
								<?php echo ts_var_sanitize($url_img_thumbnail['image']); ?>
								<?php
									if ( ts_overlay_effect_is_enabled() ) {
										echo '<div class="' . ts_overlay_effect_type() . '"></div>';
									}
								?>
								<div class="entry-content">
									<h3 class="entry-title">
										<?php echo ts_var_sanitize($url_img_thumbnail['title'], 'esc_attr'); ?>
									</h3>
									<div class="entry-meta-date"><?php echo ts_var_sanitize($url_img_thumbnail['date'], 'esc_attr'); ?></div>
								</div>
							</a>
						</li>
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
<?php } else if( $custom_post == 'video' ){ ?>

	<div class="col-lg-12 ts-featured-area <?php echo $style; ?>">
		<div class="row">
			<div class="col-sm-12 col-md-10">
				<div class="row">
					<div class="tab-content">
						<?php if( isset($videos) && is_array($videos) && !empty($videos) ) : ?>
							<?php foreach($videos as $key=>$video) : ?>

								<?php $url_video = (isset($video['extern_url']) && !empty( $video['extern_url'])) ? esc_url($video['extern_url']) : NULL; ?>

								<?php if( isset($url_video) ) : ?>
									<div class="tab-pane <?php if( $key == 0 ) echo 'active'; ?>" id="<?php echo ts_var_sanitize($single_id[$key], 'esc_attr'); ?>">
										<div class="featured-area-video">
											<?php echo apply_filters('the_content',$url_video); ?>
										</div>
									</div>
								<?php endif; ?>

								<?php $your_url = (isset($video['your_url']) && !empty( $video['your_url'])) ? esc_url($video['your_url']) : NULL; ?>

								<?php if( isset($your_url) ) : ?>
									<div class="tab-pane <?php if( $key == 0 ) echo 'active'; ?>" id="<?php echo ts_var_sanitize($single_id[$key], 'esc_attr'); ?>">
										<div class="featured-area-video">
										<?php
										$atts = array(
											'src'      => $your_url,
											'poster'   => '',
											'loop'     => '',
											'autoplay' => '',
											'preload'  => 'metadata',
											'height'   => 640,
											'width'    => 1380,
										);
										 echo wp_video_shortcode($atts); ?>
										 </div>
									</div>
								<?php endif; ?>
								<?php if( !isset($video['your_url']) && empty( $video['your_url']) && !isset($video['extern_url']) && empty( $video['extern_url']) ) : ?>
									<div class="tab-pane <?php if( $key == 0 ) echo 'active'; ?>" id="<?php echo ts_var_sanitize($single_id[$key], 'esc_attr'); ?>">
										<div class="featured-area-video">
											<a href="<?php echo ts_var_sanitize($the_permalink[$key], 'esc_attr'); ?>">
												<?php echo ts_var_sanitize($store_image_featured[$key]); ?>
												<?php
													if ( ts_overlay_effect_is_enabled() ) {
														echo '<div class="' . ts_overlay_effect_type() . '"></div>';
													}
												?>
											</a>
										</div>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-2 featured-area-tabs">
				<ul class="nav nav-tabs row" role="tablist">
				<?php foreach($store_image_thumbnail as $key=>$url_img_thumbnail) : ?>
					<li class="tab-item col-lg-3 col-md-3 col-sm-3 <?php if( $key == 0 ) echo 'active '; ?>">
						<a href="#<?php echo ts_var_sanitize($single_id[$key]); ?>" role="tab" data-toggle="tab">
							<?php echo ts_var_sanitize($url_img_thumbnail['image']); ?>
							<?php
								if ( ts_overlay_effect_is_enabled() ) {
									echo '<div class="' . ts_overlay_effect_type() . '"></div>';
								}
							?>
							<div class="entry-content">
								<h3 class="entry-title">
									<a href="<?php echo ts_var_sanitize($the_permalink[$key], 'esc_url'); ?>">
										<?php echo ts_var_sanitize($url_img_thumbnail['title'], 'esc_attr'); ?>
									</a>
								</h3>
								<div class="entry-meta-date"><?php echo ts_var_sanitize($url_img_thumbnail['date'], 'esc_attr'); ?></div>
							</div>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>

<?php } else { ?>

<?php } ?>