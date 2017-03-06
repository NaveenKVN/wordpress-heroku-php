<?php
global $article_options;

$galleryType = 	(isset($article_options['gallery-type']) && 
					(
						$article_options['gallery-type'] == 'horizontal-scroll' || 
						$article_options['gallery-type'] == 'horizontal' ||
						$article_options['gallery-type'] == 'justified' ||
						$article_options['gallery-type'] == 'thumbnails-below' ||
						$article_options['gallery-type'] == 'vertical-slider' ||
						$article_options['gallery-type'] == 'masonry-layout'
					)
				) ? $article_options['gallery-type'] : 'horizontal';

if ( $galleryType == 'horizontal' ) $galleryTypeClass = 'ts-horizontal-gallery';
elseif( $galleryType == 'justified' ) $galleryTypeClass = 'ts-justified-gallery';
elseif( $galleryType == 'thumbnails-below' ) $galleryTypeClass = 'ts-thumbnails-gallery';
elseif( $galleryType == 'vertical-slider' ) $galleryTypeClass = 'ts-vertical-gallery';
elseif( $galleryType == 'masonry-layout' ) $galleryTypeClass = 'ts-masonry-gallery';
elseif( $galleryType == 'horizontal-scroll' ) $galleryTypeClass = 'ts-horizontal-scroll-gallery';
else $galleryTypeClass = 'ts-horizontal-gallery';


$images = (isset($article_options['images']) && !empty($article_options['images']) && is_string($article_options['images'])) ? explode(',', $article_options['images']) : '';

$storagePosts = array();
if( is_array($images) && !empty($images) ){

	foreach($images as $image){

		$image = (!empty($image)) ? explode(':', $image, 2) : '';
		if( is_array($image) && count($image) == 2  ){
			$queryAttachment = get_post($image[0]);
			if( $queryAttachment !== NULL ){
				$storagePosts[] = $queryAttachment; 	
			}
		}
	}
}

$singleOptions = get_option('shootback_single_post');
$heightDesktop = (isset($singleOptions['gallery-' . $galleryType]['height-desktop']) && is_numeric($singleOptions['gallery-' . $galleryType]['height-desktop'])) ? absint($singleOptions['gallery-' . $galleryType]['height-desktop']) : 500;
$heightMobile = (isset($singleOptions['gallery-' . $galleryType]['height-mobile']) && is_numeric($singleOptions['gallery-' . $galleryType]['height-mobile'])) ? absint($singleOptions['gallery-' . $galleryType]['height-mobile']) : 300;
$image_size_gallery = (wp_is_mobile()) ? $heightMobile : $heightDesktop;

$styleOptions = get_option('shootback_styles');
$hover = (isset($styleOptions['hover_gallery']) && ($styleOptions['hover_gallery'] == 'open-on-click' || $styleOptions['hover_gallery'] == 'slide-from-bottom')) ? $styleOptions['hover_gallery'] : 'open-on-click';

$caption_option = ($hover == 'open-on-click') ? 'with-caption' : 'without-caption';

?>
	<div class="col-md-12">
		<div class="ts-gallery-element <?php echo $galleryTypeClass; ?>">
			<div class="inner-gallery-container">
<?php 
if( $galleryType == 'horizontal' && !empty($storagePosts) ) : ?>
	<div id="ts-main-gallery">
		<?php 
		$i = 1;
		foreach($storagePosts as $image) : 
			$full_img_url = wp_get_attachment_url($image->ID);
			$img_url = aq_resize($full_img_url, 9999, $image_size_gallery, false, true);
			$img_cnfg = getimagesize($img_url); // get width [0] and height [1]
			$altText = get_post_meta($image->ID, '_wp_attachment_image_alt', true);
			$descriptionImage = $image->post_excerpt;
			$titleImage = $image->post_title;
			$captionImage = $image->post_content;
			$urlImage = get_post_meta($image->ID, 'ts-image-url', true);

			$lazy_class = 'class="ts-lazyloaded"';
			$lazy_active = 'src="'.esc_url($img_url).'"';

			if ( $i > 5 ) {
				$lazy_class = 'class="lazy"';
				$lazy_active = 'data-original="'.esc_url($img_url).'"';
			}
		?>
			<div class="gallery-cell item-gallery" style="width: <?php echo $img_cnfg[0]; ?>px;height: <?php echo $image_size_gallery; ?>px;">
				<figure>
					<img <?php echo $lazy_class; ?> width="<?php echo $img_cnfg[0]; ?>" height="<?php echo $img_cnfg[1]; ?>" <?php echo $lazy_active; ?> alt="<?php echo esc_attr($altText); ?>" style="max-height: <?php echo $img_cnfg[1];?>px">
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
		endforeach;
		?>

	</div>

<?php elseif( $galleryType == 'horizontal-scroll' && !empty($storagePosts) ) : $i = 1; ?>
	<?php foreach($storagePosts as $image) : 
		$full_img_url = wp_get_attachment_url($image->ID);
		$img_url = aq_resize($full_img_url, 9999, $image_size_gallery, false, true);
		$img_cnfg = getimagesize($img_url); // get width [0] and height [1]
		$alt_text = get_post_meta($image->ID, '_wp_attachment_image_alt', true);

		$descriptionImage = $image->post_excerpt;
		$titleImage = $image->post_title;
		$captionImage = $image->post_content;
		$urlImage = get_post_meta($image->ID, 'ts-image-url', true);
		$urlImage = (isset($urlImage)) ? esc_url($urlImage) : '';

		$lazy_class = 'class="ts-lazyloaded"';
		$lazy_active = 'src="'.esc_url($img_url).'"';

		if ( $i > 5 ) {
			$lazy_class = 'class="lazy"';
			$lazy_active = 'data-original="'.esc_url($img_url).'"';
		}
	?>
		<div class="item item-gallery" style="max-height: <?php echo $image_size_gallery; ?>px;">
			<figure style="width: <?php echo $img_cnfg[0]; ?>px;height: <?php echo $image_size_gallery; ?>px;">
				<img <?php echo $lazy_class; ?> width="<?php echo $img_cnfg[0]; ?>" height="<?php echo $img_cnfg[1]; ?>" <?php echo $lazy_active; ?> alt="<?php echo esc_attr($alt_text); ?>">
			</figure>
			<div class="overlay-effect" data-trigger-caption="<?php echo $caption_option; ?>">
				<div class="entry-overlay">
					<a href="<?php echo $urlImage; ?>" target="_blank">
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
	<?php $i++; endforeach; ?>

<?php elseif( $galleryType == 'justified' && !empty($storagePosts) ) : ?>
	<?php foreach($storagePosts as $image) : 
			$full_img_url = wp_get_attachment_url($image->ID);
			$img_url = aq_resize($full_img_url, 9999, $image_size_gallery, false, true);
			$img_cnfg = getimagesize($img_url); // get width [0] and height [1]
			$alt_text = get_post_meta($image->ID, '_wp_attachment_image_alt', true);

			$descriptionImage = $image->post_excerpt;
			$titleImage = $image->post_title;
			$captionImage = $image->post_content;
			$urlImage = get_post_meta($image->ID, 'ts-image-url', true);
			$urlImage = (isset($urlImage)) ? esc_url($urlImage) : '';
		?>
		<div class="item item-gallery">
			<figure>
				<img class="lazy" width="<?php echo $img_cnfg[0]; ?>" height="<?php echo $img_cnfg[1]; ?>" data-original="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($alt_text); ?>">
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
	<?php endforeach; ?>

<?php elseif( $galleryType == 'thumbnails-below' && !empty($storagePosts) ) : ?>
	<div class="fotorama" data-nav="thumbs" data-width="100%" data-height="<?php echo $image_size_gallery; ?>" data-keyboard="true" data-allowfullscreen="true" data-fit="cover">
		<?php foreach($storagePosts as $image) : 
			$full_img_url = wp_get_attachment_url($image->ID);
			$img_url = aq_resize($full_img_url, 9999, $image_size_gallery, false, true);
			$alt_text = get_post_meta($image->ID, '_wp_attachment_image_alt', true);

			$descriptionImage = $image->post_excerpt;
			$titleImage = $image->post_title;
			$captionImage = $image->post_content;
			$urlImage = get_post_meta($image->ID, 'ts-image-url', true);
			$urlImage = (isset($urlImage)) ? esc_url($urlImage) : '';
		?>
			<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($alt_text); ?>">
		<?php endforeach; ?>
	</div>

<?php elseif( $galleryType == 'vertical-slider' && !empty($storagePosts) ) : ?>
	<ul class="vertical-layout" style="height: <?php echo $image_size_gallery; ?>px;">
		<?php foreach($storagePosts as $image) : 
			$full_img_url = wp_get_attachment_url($image->ID);
			$img_url = aq_resize($full_img_url, 1130, $image_size_gallery, true, true);
			$alt_text = get_post_meta($image->ID, '_wp_attachment_image_alt', true);

			$descriptionImage = $image->post_excerpt;
			$titleImage = $image->post_title;
			$captionImage = $image->post_content;
			$urlImage = get_post_meta($image->ID, 'ts-image-url', true);
			$urlImage = (isset($urlImage)) ? esc_url($urlImage) : '';
		?>
			<li class="item item-gallery">
				<figure>
					<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($alt_text); ?>">
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
						</ul>
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
			foreach($storagePosts as $image) : 
				$full_img_url = wp_get_attachment_url($image->ID);
				$img_url = aq_resize($full_img_url, 280, 180, true, true);
				$alt_text = get_post_meta($image->ID, '_wp_attachment_image_alt', true);
		?>
				<a data-slide-index="<?php echo $index; ?>" href=""><img src="<?php echo esc_url($img_url); ?>" /></a>
		<?php 
			$index++;
			endforeach;
		?>
	</div>

<?php elseif( $galleryType == 'masonry-layout' && !empty($storagePosts) ) : ?>
	<?php foreach($storagePosts as $image) : 
		$full_img_url = wp_get_attachment_url($image->ID);
		$img_url = aq_resize($full_img_url, 9999, $image_size_gallery, false, true);
		$alt_text = get_post_meta($image->ID, '_wp_attachment_image_alt', true);

		$descriptionImage = $image->post_excerpt;
		$titleImage = $image->post_title;
		$captionImage = $image->post_content;
		$urlImage = get_post_meta($image->ID, 'ts-image-url', true);
		$urlImage = (isset($urlImage)) ? esc_url($urlImage) : '';
	?>
		<div class="item item-gallery">
			<figure>
				<img class="lazy" data-original="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($alt_text); ?>">
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
	<?php endforeach; ?>

<?php endif; ?>
		
		</div><!-- end inner gallery container -->
	</div><!-- end gallery element -->
</div>