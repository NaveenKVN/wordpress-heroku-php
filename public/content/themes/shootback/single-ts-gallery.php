<?php get_header(); ?>
<section id="main">
	<?php
		$generalSingle = get_option('shootback_single_post');
		$galleryOptions = get_post_meta(get_the_ID(), 'post_settings', true);
		
		$hideAuthorBox = !fields::logic($post->ID, 'post_settings', 'hide_author_box') && $generalSingle['display_author_box'] == 'n' ? 'y' : 'n';

		if( $generalSingle['breadcrumbs'] === 'y' ) :
	?>
		<div class="ts-breadcrumbs breadcrumbs-single-post container">
			<?php
				echo ts_breadcrumbs();
			?>
		</div>
	<?php endif; ?>
<?php 
global $wp_query;

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
	if (LayoutCompilator::sidebar_exists()) {
		
		$options = LayoutCompilator::get_sidebar_options();

		extract(LayoutCompilator::build_sidebar($options));

	} else {
		$content_class = 'col-lg-12';
	}

	if ( metadata_exists('post', get_the_ID(), '_post_image_gallery') ){

	    $product_image_gallery = get_post_meta(get_the_ID(), '_post_image_gallery', true);

	    $img_id_array = array_filter(explode( ',', $product_image_gallery ));

	    foreach ($img_id_array as $value) {
	        $attachments[$value] = $value;                
	    }
	}

	$topics = wp_get_post_terms(get_the_ID() , 'gallery_categories');

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
		$article_categories .= '<li>' . '<a href="' . get_term_link($key, 'gallery_categories') . '" title="' . __('View all articles from: ', 'shootback') . $term . '" ' . '>' . $term.'</a></li>'.$comma.'';
		$i++;
	}

	$gallery_type_class = '';

	$generalOptions = get_option('shootback_general');
	$styleOptions = get_option('shootback_styles');

	$hover = (isset($styleOptions['hover_gallery']) && ($styleOptions['hover_gallery'] == 'open-on-click' || $styleOptions['hover_gallery'] == 'slide-from-bottom')) ? $styleOptions['hover_gallery'] : 'open-on-click';
	
	$gallery_type = (isset($galleryOptions['single_layout']) && $galleryOptions['single_layout'] !== '') ? esc_attr($galleryOptions['single_layout']) : 'gallery-horizontal';

	$galleryTitlePosition = (isset($galleryOptions['gallery_title_position']) && ($galleryOptions['gallery_title_position'] == 'above' || $galleryOptions['gallery_title_position'] == 'below') && $gallery_type !== 'gallery-horizontal' && $gallery_type !== 'gallery-horizontal-scroll' ) ? $galleryOptions['gallery_title_position'] : 'below';
	
	if ( $gallery_type == 'gallery-horizontal' ) $gallery_type_class = ' single_gallery1 ';
	elseif( $gallery_type == 'gallery-justified' ) $gallery_type_class = ' single_gallery2 ';
	elseif( $gallery_type == 'gallery-thumbnails-below' ) $gallery_type_class = ' single_gallery3 ';
	elseif( $gallery_type == 'gallery-vertical-slider' ) $gallery_type_class = ' single_gallery4 ';
	elseif( $gallery_type == 'gallery-masonry-layout' ) $gallery_type_class = ' single_gallery5 ';
	elseif( $gallery_type == 'gallery-horizontal-scroll' ) $gallery_type_class = ' single_gallery6 ';
	else $gallery_type_class = 'single_gallery1';

	if (post_password_required()) {
		$gallery_type_class = '';
	}

	$heightDesktop = (isset($generalSingle[$gallery_type]['height-desktop']) && is_numeric($generalSingle[$gallery_type]['height-desktop'])) ? absint($generalSingle[$gallery_type]['height-desktop']) : 500;
	$heightMobile = (isset($generalSingle[$gallery_type]['height-mobile']) && is_numeric($generalSingle[$gallery_type]['height-mobile'])) ? absint($generalSingle[$gallery_type]['height-mobile']) : 300;

	$image_size_gallery = (wp_is_mobile()) ? $heightMobile : $heightDesktop;

	$subtitle = get_post_meta($post->ID, 'post_settings', true);
	$subtitle = (isset($subtitle['subtitle']) && $subtitle['subtitle'] !== '') ? $subtitle['subtitle'] : NULL;

	$featuredImageGeneralOptions = (isset($generalOptions['featured_image_in_post']) && ($generalOptions['featured_image_in_post'] == 'Y' || $generalOptions['featured_image_in_post'] == 'N')) ? $generalOptions['featured_image_in_post'] : 'Y'; 
	$display_featured_img = ($featuredImageGeneralOptions == 'Y' && has_post_thumbnail(get_the_ID())) ? 'has-featured-img' : 'hidden-featured-img';

	$caption_option = ($hover == 'open-on-click') ? 'with-caption' : 'without-caption';

?>
<div class="gallery-type <?php echo ts_var_sanitize($display_featured_img . $gallery_type_class); ?>">

	<?php if( $galleryTitlePosition == 'above' ) : ?>
		<div class="post-header-title">
			<div class="entry-header-content text-center">
				<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
					<div class="entry-meta">
						<ul class="list-inline post-meta">
						<?php if (get_the_category_list()): ?>
							<li class="post-meta-categories">
								<?php echo get_the_category_list(); ?>
							</li>
						<?php endif; ?>
						</ul>
					</div>
				<?php endif; ?>
				<div class="entry-title">
					<h1 class="post-title"><?php the_title(); ?></h1>
				</div>

				<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
					<div class="entry-meta">
						<div class="entry-date text-right">
							<ul class="entry-meta-date">
								<li class="meta-date"><?php echo get_post_time('j'); ?></li>
								<li class="meta-month"><?php echo get_post_time('M'); ?></li>
							</ul>
						</div>
						<?php touchsize_likes($post->ID, '<div class="entry-likes"><ul class="post-likes"><li>', '</li></ul></div>'); ?>
						<div class="entry-categories text-left">
							<ul class="entry-category">
								<?php echo ts_var_sanitize($article_categories); ?>
							</ul>
						</div>
					</div>
				<?php endif ?>
				<?php edit_post_link( __( 'Edit', 'shootback' ), '<div class="post-meta-edit"><span class="edit-link">', '</span></div>' ); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if( !post_password_required() && isset($attachments) && count($attachments) > 0 ) : ?>
		<div class="header">
			<?php if($gallery_type == 'gallery-horizontal') : ?>
				<div class="row">
					<div class="container-fluid">
						<div class="inner-gallery-container">
							<div id="ts-main-gallery">
								<?php 
									$i = 1;
									foreach($attachments as $att_id => $attachment) : 
										$full_img_url = wp_get_attachment_url($att_id);
										$img_url = aq_resize($full_img_url, 9999, $image_size_gallery, false, true);
										$img_cnfg = getimagesize($img_url); // get width [0] and height [1]
										$alt_text = get_post_meta($att_id, '_wp_attachment_image_alt', true);

										$attachmentQuery = get_post($att_id);
										$descriptionImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_excerpt : '';
										$titleImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_title : '';
										$captionImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_content : '';
										$urlImage = get_post_meta($att_id, 'ts-image-url', true);
										$urlImage = (isset($urlImage)) ? $urlImage : '';

										$lazy_class = 'class="ts-lazyloaded"';
										$lazy_active = 'src="'.esc_url($img_url).'"';

										if ( $i > 5 ) {
											$lazy_class = 'class="lazy"';
											$lazy_active = 'data-original="'.esc_url($img_url).'"';
										}
									?>
									<?php if ( $i == 1 ) : ?>
										<div class="post-header-title">
											<div class="entry-header-content text-center">
												<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
													<div class="entry-meta">
														<div class="entry-date text-right">
															<ul class="entry-meta-date">
																<li class="meta-date"><?php echo get_post_time('j'); ?></li>
																<li class="meta-month"><?php echo get_post_time('M'); ?></li>
															</ul>
														</div>
														<?php touchsize_likes($post->ID, '<div class="entry-likes"><ul class="post-likes"><li>', '</li></ul></div>'); ?>
														<div class="entry-categories text-left">
															<ul class="entry-category">
																<?php echo ts_var_sanitize($article_categories); ?>
															</ul>
														</div>
													</div>
												<?php endif ?>
												<?php edit_post_link( __( 'Edit', 'shootback' ), '<div class="post-meta-edit"><span class="edit-link">', '</span></div>' ); ?>
												<div class="entry-title">
													<h1 class="post-title"><?php echo esc_attr(get_the_title()); ?></h1>
												</div>
												<div class="entry-excerpt mCustomScrollbar">
													<p><?php echo esc_attr($subtitle); ?></p>
												</div>
											</div>
										</div>
									<?php endif; ?>
									<div class="gallery-cell item-gallery" style="width: <?php echo absint($img_cnfg[0]); ?>px;height: <?php echo absint($image_size_gallery); ?>px;">
										<figure>
											<img <?php echo $lazy_class; ?> width="<?php echo absint($img_cnfg[0]); ?>" height="<?php echo absint($img_cnfg[1]); ?>" <?php echo $lazy_active; ?> alt="<?php echo esc_attr($alt_text); ?>">
										</figure>
										<div class="overlay-effect" data-trigger-caption="<?php echo $caption_option; ?>">
											<div class="entry-overlay">
												<a href="<?php echo esc_url($urlImage); ?>" target="_blank">
													<h3 class="title"><?php echo esc_attr($titleImage); ?></h3>
												</a>
												<div class="entry-excerpt">
													<p><?php echo esc_attr($captionImage); ?></p>
												</div>
												<ul class="entry-controls">
													<li>
														<a href="<?php echo esc_url($full_img_url); ?>" title="<?php echo esc_attr($titleImage); ?>" rel="fancybox[]" class="zoom-in">
															<i class="icon-search"></i>
														</a>
													</li>
													<li>
														<a href="<?php echo esc_url($urlImage); ?>" title="<?php _e('External link','shootback'); ?>" target="_blank" class="link-in">
															<i class="icon-link-ext"></i>
														</a>
													</li>
													<li class="share-box">
														<a href="#" class="share-link">
															<i class="icon-share"></i>
														</a>
														<ul class="social-sharing share-menu">
															<li class="share-item">
																<a class="facebook" title="<?php _e('Share on facebook','shootback'); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($full_img_url); ?>"><i class="icon-facebook"></i></a>
															</li>
															<li class="share-item">
																<a class="icon-twitter" title="<?php _e('Share on twitter','shootback'); ?>" target="_blank" href="http://twitter.com/home?status=<?php echo urlencode($titleImage); ?>+<?php echo esc_url($full_img_url); ?>"></a>
															</li>
															<li class="share-item">
																<a class="icon-pinterest" title="<?php _e('Share on pinterest','shootback'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php esc_url($urlImage); ?>&amp;media=<?php echo esc_url($full_img_url) ?>&amp;description=<?php echo esc_attr($captionImage) ?>" ></a>
															</li>
														</ul>
													</li>
												</ul>
											</div>
										</div>
										<?php if ($caption_option == 'with-caption'): ?>
											<div class="trigger-caption">
												<a href="#" class="button-trigger-cap"><i class="icon-left-arrow"></i></a>
											</div>
										<?php endif ?>
									</div>
								<?php
									$i++;
									endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			<?php elseif($gallery_type == 'gallery-horizontal-scroll'): ?>
				<div class="row">
					<div class="container-fluid">
						<div class="inner-gallery-container">
							<?php 
							$i = 1;
							foreach($attachments as $att_id => $attachment) : 
								$full_img_url = wp_get_attachment_url($att_id);
								$img_url = aq_resize($full_img_url, 9999, $image_size_gallery, false, true);
								$img_cnfg = getimagesize($img_url); // get width [0] and height [1]
								$alt_text = get_post_meta($att_id, '_wp_attachment_image_alt', true);

								$attachmentQuery = get_post($att_id);
								$descriptionImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_excerpt : '';
								$titleImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_title : '';
								$captionImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_content : '';
								$urlImage = get_post_meta($att_id, 'ts-image-url', true);
								$urlImage = (isset($urlImage)) ? $urlImage : '';

								$lazy_class = 'class="ts-lazyloaded"';
								$lazy_active = 'src="'.esc_url($img_url).'"';

								if ( $i > 5 ) {
									$lazy_class = 'class="lazy"';
									$lazy_active = 'data-original="'.esc_url($img_url).'"';
								}
							?>
							<?php if ( $i == 1 ) : ?>
								<div class="item item-gallery post-header-title" style="height: <?php echo $image_size_gallery; ?>px">
									<div class="entry-header-content text-center">
										<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
											<div class="entry-meta">
												<div class="entry-date text-right">
													<ul class="entry-meta-date">
														<li class="meta-date"><?php echo get_post_time('j'); ?></li>
														<li class="meta-month"><?php echo get_post_time('M'); ?></li>
													</ul>
												</div>
												<?php touchsize_likes($post->ID, '<div class="entry-likes"><ul class="post-likes"><li>', '</li></ul></div>'); ?>
												<div class="entry-categories text-left">
													<ul class="entry-category">
														<?php echo ts_var_sanitize($article_categories); ?>
													</ul>
												</div>
											</div>
										<?php endif ?>
										<?php edit_post_link( __( 'Edit', 'shootback' ), '<div class="post-meta-edit"><span class="edit-link">', '</span></div>' ); ?>
										<div class="entry-title">
											<h1 class="post-title"><?php echo esc_attr(get_the_title()); ?></h1>
										</div>
										<div class="entry-excerpt mCustomScrollbar">
											<p><?php echo esc_attr($subtitle); ?></p>
										</div>
									</div>
								</div>
							<?php endif; ?>
								<div class="item item-gallery" style="max-height: <?php echo $image_size_gallery; ?>px;">
									<figure style="width: <?php echo absint($img_cnfg[0]); ?>px;height: <?php echo absint($image_size_gallery); ?>px;">
										<img <?php echo $lazy_class; ?> width="<?php echo absint($img_cnfg[0]); ?>" height="<?php echo absint($img_cnfg[1]); ?>" <?php echo $lazy_active; ?> alt="<?php echo esc_attr($alt_text); ?>">
									</figure>
									<div class="overlay-effect" data-trigger-caption="<?php echo esc_attr($caption_option); ?>">
										<div class="entry-overlay">
											<a href="<?php echo esc_url($urlImage); ?>" target="_blank">
												<h3 class="title"><?php echo esc_attr($titleImage); ?></h3>
											</a>
											<div class="entry-excerpt">
												<p><?php echo esc_attr($captionImage); ?></p>
											</div>
											<ul class="entry-controls">
												<li>
													<a href="<?php echo esc_url($full_img_url); ?>" title="<?php echo esc_attr($titleImage); ?>" rel="fancybox[]" class="zoom-in">
														<i class="icon-search"></i>
													</a>
												</li>
												<li>
													<a href="<?php echo esc_url($urlImage); ?>" title="<?php _e('External link','shootback'); ?>" target="_blank" class="link-in">
														<i class="icon-link-ext"></i>
													</a>
												</li>
												<li class="share-box">
													<a href="#" class="share-link">
														<i class="icon-share"></i>
													</a>
													<ul class="social-sharing share-menu">
														<li class="share-item">
															<a class="facebook" title="<?php _e('Share on facebook','shootback'); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($full_img_url); ?>"><i class="icon-facebook"></i></a>
														</li>
														<li class="share-item">
															<a class="icon-twitter" title="<?php _e('Share on twitter','shootback'); ?>" target="_blank" href="http://twitter.com/home?status=<?php echo urlencode($titleImage); ?>+<?php echo esc_url($full_img_url); ?>"></a>
														</li>
														<li class="share-item">
															<a class="icon-pinterest" title="<?php _e('Share on pinterest','shootback'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php esc_url($urlImage); ?>&amp;media=<?php echo esc_url($full_img_url) ?>&amp;description=<?php echo esc_attr($captionImage) ?>" ></a>
														</li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
									<?php if ($caption_option == 'with-caption'): ?>
										<div class="trigger-caption">
											<a href="#" class="button-trigger-cap"><i class="icon-left-arrow"></i></a>
										</div>
									<?php endif ?>
								</div>
							<?php 
							$i++;
							endforeach; ?>
						</div>
					</div>
				</div>
			<?php elseif($gallery_type == 'gallery-justified'): ?>
				<div class="row">
					<div class="container">
						<div class="inner-gallery-container">
							<?php foreach($attachments as $att_id => $attachment) : 
								$full_img_url = wp_get_attachment_url($att_id);
								$img_url = aq_resize($full_img_url, 9999, $image_size_gallery, false, true);
								$img_cnfg = getimagesize($img_url); // get width [0] and height [1]
								$alt_text = get_post_meta($att_id, '_wp_attachment_image_alt', true);

								$attachmentQuery = get_post($att_id);
								$descriptionImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_excerpt : '';
								$titleImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_title : '';
								$captionImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_content : '';
								$urlImage = get_post_meta($att_id, 'ts-image-url', true);
								$urlImage = (isset($urlImage)) ? esc_url($urlImage) : '';
							?>
								<div class="item item-gallery">
									<figure>
										<img class="lazy" width="<?php echo absint($img_cnfg[0]); ?>" height="<?php echo absint($img_cnfg[1]); ?>" data-original="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($alt_text); ?>">
									</figure>
									<div class="overlay-effect" data-trigger-caption="<?php echo esc_attr($caption_option); ?>">
										<div class="entry-overlay">
											<a href="<?php echo esc_url($urlImage); ?>" target="_blank">
												<h3 class="title"><?php echo esc_attr($titleImage); ?></h3>
											</a>
											<div class="entry-excerpt">
												<p><?php echo esc_attr($captionImage); ?></p>
											</div>
											<ul class="entry-controls">
												<li>
													<a href="<?php echo esc_url($full_img_url); ?>" title="<?php echo esc_attr($titleImage); ?>" rel="fancybox[]" class="zoom-in">
														<i class="icon-search"></i>
													</a>
												</li>
												<li>
													<a href="<?php echo esc_url($urlImage); ?>" title="<?php _e('External link','shootback'); ?>" target="_blank" class="link-in">
														<i class="icon-link-ext"></i>
													</a>
												</li>
												<li class="share-box">
													<a href="#" class="share-link">
														<i class="icon-share"></i>
													</a>
													<ul class="social-sharing share-menu">
														<li class="share-item">
															<a class="facebook" title="<?php _e('Share on facebook','shootback'); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($full_img_url); ?>"><i class="icon-facebook"></i></a>
														</li>
														<li class="share-item">
															<a class="icon-twitter" title="<?php _e('Share on twitter','shootback'); ?>" target="_blank" href="http://twitter.com/home?status=<?php echo urlencode($titleImage); ?>+<?php echo esc_url($full_img_url); ?>"></a>
														</li>
														<li class="share-item">
															<a class="icon-pinterest" title="<?php _e('Share on pinterest','shootback'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php esc_url($urlImage); ?>&amp;media=<?php echo esc_url($full_img_url) ?>&amp;description=<?php echo esc_attr($captionImage) ?>" ></a>
														</li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
									<?php if ($caption_option == 'with-caption'): ?>
										<div class="trigger-caption">
											<a href="#" class="button-trigger-cap"><i class="icon-left-arrow"></i></a>
										</div>
									<?php endif ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php elseif($gallery_type == 'gallery-thumbnails-below'): ?>
				<div class="row">
					<div class="container">
						<div class="inner-gallery-container">
							<div class="row">
								<div class="col-lg-12">
									<div class="fotorama" data-nav="thumbs" data-width="100%" data-height="<?php echo $image_size_gallery; ?>" data-keyboard="true" data-allowfullscreen="true" data-fit="cover">
										<?php foreach($attachments as $att_id => $attachment) : 
											$full_img_url = wp_get_attachment_url($att_id);
											$img_url = aq_resize($full_img_url, 9999, $image_size_gallery, false, true);
											$alt_text = get_post_meta($att_id, '_wp_attachment_image_alt', true);

											$attachmentQuery = get_post($att_id);
											$descriptionImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_excerpt : '';
											$titleImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_title : '';
											$captionImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_content : '';
											$urlImage = get_post_meta($att_id, 'ts-image-url', true);
											$urlImage = (isset($urlImage)) ? esc_url($urlImage) : '';
										?>
											<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($alt_text); ?>">
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php elseif($gallery_type == 'gallery-vertical-slider'): ?>
				<div class="row">
					<div class="container">
						<div class="inner-gallery-container" style="height: <?php echo $image_size_gallery; ?>px;">
							<ul class="ts-gallery-vertical" style="height: <?php echo $image_size_gallery; ?>px;">
								<?php foreach($attachments as $att_id => $attachment) : 
									$full_img_url = wp_get_attachment_url($att_id);
									$img_url = aq_resize($full_img_url, 1130, $image_size_gallery, true, true);
									$alt_text = get_post_meta($att_id, '_wp_attachment_image_alt', true);

									$attachmentQuery = get_post($att_id);
									$descriptionImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_excerpt : '';
									$titleImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_title : '';
									$captionImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_content : '';
									$urlImage = get_post_meta($att_id, 'ts-image-url', true);
									$urlImage = (isset($urlImage)) ? esc_url($urlImage) : '';
								?>
									<li class="item item-gallery">
										<figure>
											<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($alt_text); ?>">
										</figure>
										<div class="overlay-effect" data-trigger-caption="<?php echo esc_attr($caption_option); ?>">
											<div class="entry-overlay">
												<a href="<?php echo esc_url($urlImage); ?>" target="_blank">
													<h3 class="title"><?php echo esc_attr($titleImage); ?></h3>
												</a>
												<div class="entry-excerpt">
													<p><?php echo esc_attr($captionImage); ?></p>
												</div>
												<ul class="entry-controls">
													<li>
														<a href="<?php echo esc_url($full_img_url); ?>" title="<?php echo esc_attr($titleImage); ?>" rel="fancybox[]" class="zoom-in">
															<i class="icon-search"></i>
														</a>
													</li>
													<li>
														<a href="<?php echo esc_url($urlImage); ?>" title="<?php _e('External link','shootback'); ?>" target="_blank" class="link-in">
															<i class="icon-link-ext"></i>
														</a>
													</li>
													<li class="share-box">
														<a href="#" class="share-link">
															<i class="icon-share"></i>
														</a>
														<ul class="social-sharing share-menu">
															<li class="share-item">
																<a class="facebook" title="<?php _e('Share on facebook','shootback'); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($full_img_url); ?>"><i class="icon-facebook"></i></a>
															</li>
															<li class="share-item">
																<a class="icon-twitter" title="<?php _e('Share on twitter','shootback'); ?>" target="_blank" href="http://twitter.com/home?status=<?php echo urlencode($titleImage); ?>+<?php echo esc_url($full_img_url); ?>"></a>
															</li>
															<li class="share-item">
																<a class="icon-pinterest" title="<?php _e('Share on pinterest','shootback'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php esc_url($urlImage); ?>&amp;media=<?php echo esc_url($full_img_url) ?>&amp;description=<?php echo esc_attr($captionImage) ?>" ></a>
															</li>
														</ul>
													</li>
												</ul>
											</div>
										</div>
										<?php if ($caption_option == 'with-caption'): ?>
											<div class="trigger-caption">
												<a href="#" class="button-trigger-cap"><i class="icon-left-arrow"></i></a>
											</div>
										<?php endif ?>
									</li>
								<?php endforeach; ?>
							</ul>
							<div id="ts-gallery-pager" class="mCustomScrollbar" style="height: <?php echo $image_size_gallery; ?>px ">
								<?php 
									$index = 0;
									foreach($attachments as $att_id => $attachment) : 
										$full_img_url = wp_get_attachment_url($att_id);
										$img_url = aq_resize($full_img_url, 280, 180, true, true);
										$alt_text = get_post_meta($att_id, '_wp_attachment_image_alt', true);
								?>
										<a data-slide-index="<?php echo $index; ?>" href=""><img src="<?php echo esc_url($img_url); ?>" /></a>
								<?php 
									$index++;
									endforeach;
								?>
							</div>
						</div>
					</div>
				</div>
			<?php elseif($gallery_type == 'gallery-masonry-layout'): ?>
				<div class="row">
					<div class="container">
						<div class="inner-gallery-container">
							<?php foreach($attachments as $att_id => $attachment) : 
								$full_img_url = wp_get_attachment_url($att_id);
								$img_url = aq_resize($full_img_url, $image_size_gallery, 9999, false, true);
								$alt_text = get_post_meta($att_id, '_wp_attachment_image_alt', true);

								$attachmentQuery = get_post($att_id);
								$descriptionImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_excerpt : '';
								$titleImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_title : '';
								$captionImage = (isset($attachmentQuery) && is_object($attachmentQuery)) ? $attachmentQuery->post_content : '';
								$urlImage = get_post_meta($att_id, 'ts-image-url', true);
								$urlImage = (isset($urlImage)) ? esc_url($urlImage) : '';
							?>
								<div class="item item-gallery">
									<figure>
										<img class="lazy" data-original="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($alt_text); ?>">
									</figure>
									<div class="overlay-effect" data-trigger-caption="<?php echo esc_attr($caption_option); ?>">
										<div class="entry-overlay">
											<a href="<?php echo esc_url($urlImage); ?>" target="_blank">
												<h3 class="title"><?php echo esc_attr($titleImage); ?></h3>
											</a>
											<div class="entry-excerpt">
												<p><?php echo esc_attr($captionImage); ?></p>
											</div>
											<ul class="entry-controls">
												<li>
													<a href="<?php echo esc_url($full_img_url); ?>" title="<?php echo esc_attr($titleImage); ?>" rel="fancybox[]" class="zoom-in">
														<i class="icon-search"></i>
													</a>
												</li>
												<li>
													<a href="<?php echo esc_url($urlImage); ?>" title="<?php _e('External link','shootback'); ?>" target="_blank" class="link-in">
														<i class="icon-link-ext"></i>
													</a>
												</li>
												<li class="share-box">
													<a href="#" class="share-link">
														<i class="icon-share"></i>
													</a>
													<ul class="social-sharing share-menu">
														<li class="share-item">
															<a class="facebook" title="<?php _e('Share on facebook','shootback'); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($full_img_url); ?>"><i class="icon-facebook"></i></a>
														</li>
														<li class="share-item">
															<a class="icon-twitter" title="<?php _e('Share on twitter','shootback'); ?>" target="_blank" href="http://twitter.com/home?status=<?php echo urlencode($titleImage); ?>+<?php echo esc_url($full_img_url); ?>"></a>
														</li>
														<li class="share-item">
															<a class="icon-pinterest" title="<?php _e('Share on pinterest','shootback'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php esc_url($urlImage); ?>&amp;media=<?php echo esc_url($full_img_url) ?>&amp;description=<?php echo esc_attr($captionImage) ?>" ></a>
														</li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
									<?php if ($caption_option == 'with-caption'): ?>
										<div class="trigger-caption">
											<a href="#" class="button-trigger-cap"><i class="icon-left-arrow"></i></a>
										</div>
									<?php endif ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php else: ?>
				<div class="post-fotorama-gallery">
					<div class="row">
						<div class="col-lg-12">
							<div class="fotorama" data-nav="thumbs" data-width="100%" data-keyboard="true" data-allowfullscreen="true" data-fit="cover">
								<?php foreach($attachments as $att_id => $attachment) : 
									$full_img_url = wp_get_attachment_url($att_id);
									$alt_text = get_post_meta($att_id, '_wp_attachment_image_alt', true); ?>
									<img src="<?php echo esc_url($full_img_url); ?>" alt="<?php echo esc_attr($alt_text); ?>">
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<?php if ( $featuredImageGeneralOptions == 'Y' && has_post_thumbnail(get_the_ID()) && !isset($attachments) ) : ?>
			<div class="featured-image">
				<?php 
					$src = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
					$img_url = ts_resize('single', $src);

					echo '<img itemprop="image" itemprop="thumbnailUrl" src="' . esc_url($img_url) . '" alt="' . esc_attr(get_the_title()) . '" >';

					if (ts_lightbox_enabled()) {
						echo '<a class="zoom-in-icon" href="' . esc_url($src) . '" rel="fancybox[' . get_the_ID() . ']"><i class="icon-search"></i></a>';
					}

					if ( ts_overlay_effect_is_enabled() ) {
						echo '<div class="' . ts_overlay_effect_type() . '"></div>';
					} 
				?>
			</div>
		</div>
	<?php endif; ?>
	<div class="container singular-container">
		<div class="row">
			<?php
				if (LayoutCompilator::sidebar_exists()) {
					if (LayoutCompilator::is_left_sidebar('single')) {
						echo '<div class="left-sidebar">';
							echo ts_var_sanitize($sidebar_content);
						echo '</div>';
					}
				}
			?>
			<div id="primary" class="<?php echo $content_class; ?>">
				<div id="content" role="main">
					<article>
						<div class="section">
							<div class="inner-section">
								<div class="row">
									<div class="col-md-12">
										<?php if( $gallery_type != 'gallery-horizontal' && $gallery_type != 'gallery-horizontal-scroll' ) : ?>
											<?php if( $galleryTitlePosition == 'below' ) : ?>
												<div class="post-header-title">
													<div class="entry-header-content text-center">
														<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
															<div class="entry-meta">
																<ul class="list-inline post-meta">
																<?php if (get_the_category_list()): ?>
																	<li class="post-meta-categories">
																		<?php echo get_the_category_list(); ?>
																	</li>
																<?php endif; ?>
																</ul>
															</div>
														<?php endif; ?>
														<div class="entry-title">
															<h1 class="post-title"><?php echo esc_attr(get_the_title()); ?></h1>
														</div>

														<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
															<div class="entry-meta">
																<div class="entry-date text-right">
																	<ul class="entry-meta-date">
																		<li class="meta-date"><?php echo get_post_time('j'); ?></li>
																		<li class="meta-month"><?php echo get_post_time('M'); ?></li>
																	</ul>
																</div>
																<?php touchsize_likes($post->ID, '<div class="entry-likes"><ul class="post-likes"><li>', '</li></ul></div>'); ?>
																<div class="entry-categories text-left">
																	<ul class="entry-category">
																		<?php echo ts_var_sanitize($article_categories); ?>
																	</ul>
																</div>
															</div>
														<?php endif ?>
														<?php edit_post_link( __( 'Edit', 'shootback' ), '<div class="post-meta-edit"><span class="edit-link">', '</span></div>' ); ?>
													</div>
												</div>
											<?php endif; ?>
										<?php endif; ?>
										<?php if( isset($subtitle) && !post_password_required() ) : ?>
											<div class="entry-subtitle">
												<?php echo esc_attr($subtitle); ?>
											</div>
										<?php endif; ?>
										<?php if (post_password_required()): ?>
											<div class="post-header-title">
												<div class="entry-header-content text-center">
													<div class="entry-icon">
														<i class="icon-lock"></i>
													</div>
													<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
														<div class="entry-meta">
															<ul class="list-inline post-meta">
															<?php if (get_the_category_list()): ?>
																<li class="post-meta-categories">
																	<?php echo get_the_category_list(); ?>
																</li>
															<?php endif; ?>
															</ul>
														</div>
													<?php endif; ?>
													<div class="entry-title">
														<h1 class="post-title"><?php the_title(); ?></h1>
													</div>

													<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
														<div class="entry-meta">
															<div class="entry-date text-right">
																<ul class="entry-meta-date">
																	<li class="meta-date"><?php echo get_post_time('j'); ?></li>
																	<li class="meta-month"><?php echo get_post_time('M'); ?></li>
																</ul>
															</div>
															<?php touchsize_likes($post->ID, '<div class="entry-likes"><ul class="post-likes"><li>', '</li></ul></div>'); ?>
															<div class="entry-categories text-left">
																<ul class="entry-category">
																	<?php echo ts_var_sanitize($article_categories); ?>
																</ul>
															</div>
														</div>
													<?php endif ?>
													<?php edit_post_link( __( 'Edit', 'shootback' ), '<div class="post-meta-edit"><span class="edit-link">', '</span></div>' ); ?>
												</div>
											</div>
										<?php endif; ?>
										<div class="post-content">
											<?php the_content(); ?>
											<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'shootback' ) . '</span>', 'after' => '</div>' ) ); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="footer">
							<div class="inner-footer">
								<div class="row">
									<div class="col-md-12">
										<?php if ($hideAuthorBox == 'y') : ?>
											<div class="post-author-box">
									            <a href="<?php echo get_author_posts_url($post->post_author) ?>"><?php echo get_avatar(get_the_author_meta( 'ID' ), 120); ?></a>
									            <h5 class="author-title"><?php the_author_link(); ?></h5>
									            <div class="author-box-info"><?php the_author_meta('description'); ?>
									                <?php
									                 if(strlen(get_the_author_meta('user_url'))!=''){?>
									                    <span><?php _e('Website:', 'shootback'); ?> <a href="<?php the_author_meta('user_url');?>"><?php the_author_meta('user_url');?></a></span>
									                <?php } ?>
									            </div>
									        </div>
										<?php endif ?>
									</div>
								</div>

								<?php $tags_columns = (has_tag()) ? 'col-md-6' : 'col-md-12'; ?>
								<div class="row">
									<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
										<?php if( has_tag() ) : ?>
											<div class="article-tags">
												<div class="<?php echo $tags_columns; ?>">
													<div class="row">
														<div class="col-sm-12 col-md-12">
															<div class="post-tagged-icon">
																<i class="icon-tags"></i>
															</div>
															<div class="post-details">
																<h6 class="post-details-title"><?php _e('Tags','shootback'); ?></h6>
																<div class="post-tags">
																	<?php if (ts_single_display_tags()): ?>
																		<?php the_tags('<ul itemprop="keywords" class="tags-container"><li>','</li><li>','</li></ul>'); ?>
																	<?php endif ?>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php endif; ?>
									<?php endif; ?>
									<div class="<?php echo $tags_columns; ?>">
										<?php if(ts_single_social_sharing()): ?>
											<?php get_template_part('social-sharing'); ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</article>
				</div>
			</div>
			<?php
				if (LayoutCompilator::sidebar_exists()) {
					if (LayoutCompilator::is_right_sidebar('single')) {
						echo '<div class="right-sidebar">';
							echo ts_var_sanitize($sidebar_content);
						echo '</div>';
					}
				}
			?>
		</div>
	</div>
	<?php ts_get_pagination_next_previous(); ?>
	<div class="post-related">
		<div class="container">
			<?php if (!fields::logic($post->ID, 'post_settings', 'hide_related')): ?>
				<div class="row">
					<div class="col-md-12 text-center">
						<h4 class="related-title"><?php _e('Related posts', 'shootback'); ?></h4>
					</div>
					<?php echo LayoutCompilator::get_single_related_posts(get_the_ID()); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<!-- Ad area 2 -->
	<?php if( fields::get_options_value('shootback_theme_advertising','ad_area_2') != '' ): ?>
		<div class="container text-center ts-advertising-container">
			<?php echo fields::get_options_value('shootback_theme_advertising','ad_area_2'); ?>
		</div>
	<?php endif; ?>
	<!-- // End of Ad Area 2 -->
	<div class="post-comments">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="post-comments">
						<?php comments_template( '', true ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php  endwhile; 
endif; //end if have_posts ?>
</section>
<?php get_footer(); ?>