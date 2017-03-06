<?php

get_header();

global $wp_query;

if ( have_posts() ) {
	if (LayoutCompilator::sidebar_exists()) {
		
		$options = LayoutCompilator::get_sidebar_options();

		extract(LayoutCompilator::build_sidebar($options));

	} else {
		$content_class = 'col-lg-12';
	}
	while ( have_posts() ) : the_post();

	// Get the categories of the article
	if ( get_post_type( get_the_ID() ) == 'portfolio' ) {
		$category_tax = 'portfolio_categories';
	}elseif ( get_post_type( get_the_ID() ) == 'video' ) {
		$category_tax = 'videos_categories';
	} else{
		$category_tax = 'category';
	}

	$topics = wp_get_post_terms(get_the_ID() , $category_tax);
	
	$article_categories = '';
	if( isset($topics[0]) && !is_wp_error($topics) ){
		foreach($topics as $term) {
			$article_categories .= '<li>' .
										'<a href="' . esc_attr(get_term_link($term->name, $category_tax)) . '" title="' . __('View all articles from: ', 'shootback') . $term->name . '" ' . '>'
											. $term->name .
										'</a>
									</li>';
		}
	}

	$article_date =  get_the_date();

	$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

	$noimg_url = get_template_directory_uri() . '/images/noimage.jpg';
	$bool = fields::get_options_value('shootback_general', 'enable_imagesloaded');

	if ( $src ) {
		$img = ts_resize('single', $src);
		$featimage = '<img ' . ts_imagesloaded($bool, $img) . ' alt="' . esc_attr(get_the_title()) . '" />';
	} else {
		$featimage = '<img ' .  ts_imagesloaded($bool, $noimg_url). ' alt="' . esc_attr(get_the_title()) . '" />';
	}
	$poster_url = '';
	if ( ts_display_featured_image() && has_post_thumbnail( get_the_ID() ) ) {
		
		$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
		$poster_url = ts_resize('single', $src);
	}

	$video_meta = get_post_meta($post->ID, 'video', true);
	$video = '';
	if(isset($video_meta) && isset($video_meta['extern_url']) && !empty($video_meta['extern_url'])){
		$video = apply_filters('the_content',$video_meta['extern_url']);
	}else if(isset($video_meta) && isset($video_meta['your_url']) && !empty($video_meta['your_url'])){

		$atts = array(
			'src'      => esc_url($video_meta['your_url']),
			'poster'   => $poster_url,
			'loop'     => '',
			'autoplay' => '',
			'preload'  => 'metadata',
			'height'   => 580,
			'width'    => 1340,
		);
		$video = wp_video_shortcode($atts); 
	}else{
		$video = '';
	}
	$single_options = get_option('shootback_single_post', array('resize_video' => 'big', 'show_more' => 'y'));
	if ( isset($_COOKIE['ts_single_video_resize_type']) ) {
		// Rewrite from cookie if exists
		$single_options['resize_video'] = $_COOKIE['ts_single_video_resize_type'];
	}
	
	?>

<!-- Ad area 1 -->
<?php if( fields::get_options_value('shootback_theme_advertising','ad_area_1') != '' ): ?>
<div class="container text-center ts-advertising-container">
	<?php echo fields::get_options_value('shootback_theme_advertising','ad_area_1'); ?>
</div>
<?php endif; ?>
<!-- // End of Ad Area 1 -->

<?php
	$breadcrumbs = get_option('shootback_single_post', array('breadcrumbs' => 'y'));
	if( $breadcrumbs['breadcrumbs'] === 'y' ):
?>
	<div class="ts-breadcrumbs breadcrumbs-single-video">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<?php  echo ts_breadcrumbs(); ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<section id="main">

	<div class="container singular-container">
		<div class="row">
			<?php
				if (LayoutCompilator::sidebar_exists()) {
					$options = LayoutCompilator::get_sidebar_options();

					extract(LayoutCompilator::build_sidebar($options));

					if (LayoutCompilator::is_left_sidebar()) {
						echo ts_var_sanitize($sidebar_content);
					}
				} else {
					$content_class = 'col-lg-12';
				}
			?>
			<div id="primary" class="<?php echo ts_var_sanitize($content_class); ?>">
				<div id="content" role="main">
					<article <?php post_class(''); ?>>	
						<div class="entry-header-content text-center">
							<div class="entry-title">
								<h1 class="post-title"><?php the_title(); ?></h1>
							</div>

							<?php if( isset($subtitle) ) : ?>
								<div class="entry-subtitle">
									<?php echo ts_var_sanitize($subtitle); ?>
								</div>
							<?php endif; ?>

							<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
								<div class="entry-meta">
									<ul class="post-meta list-inline">
										<li class="post-meta-author">
											<a class="author-avatar" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
												<?php echo get_avatar(get_the_author_meta( 'ID' ), 40); ?>
											</a>
											<span><?php _e('by','shootback'); ?></span>
											<a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
												<?php echo get_the_author(); ?>
											</a>
										</li>
										<li class="post-meta-date updated" datetime="<?php get_the_date('Y-m-j', get_the_ID()); ?>">
											<?php the_date(); ?>
										</li>
										<?php touchsize_likes($post->ID, '<li class="post-likes">', '</li>'); ?>
										<?php if (get_the_category_list()): ?>
											<li class="post-meta-categories">
												<span><?php _e('in ','shootback'); ?></span>
												<?php echo get_the_category_list(); ?>
											</li>
										<?php endif; ?>
										<?php edit_post_link( __( 'Edit', 'shootback' ), '<li class="post-meta-edit"><span class="edit-link">', '</span></li>' ); ?>
									</ul>
								</div>
							<?php endif ?>
						</div>
						<header class="post-header">
							<div class="row">
								<div class="featured-image video-featured-image">
									<div class="container">
										<div class="embedded_videos">
											<?php if( !empty($video) ) : ?>
												<div id="videoframe" class="video-frame">
													<div id="post-video">
														<?php echo ts_var_sanitize($video); ?>
													</div>	
												</div>
											<?php else : ?>
												<?php echo ts_var_sanitize($featimage); ?>
											<?php endif; ?>	
										</div>
									</div>
								</div>
							</div>
						</header>
						<div class="post-content ">
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									<div class="video-post-content">
										<?php the_content(); ?>
									</div>
									<div class="video-post-sharing">
										<?php if(ts_single_social_sharing()): ?>
											<?php get_template_part('social-sharing'); ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</article>
				</div>

				<?php
				endwhile;
				?>
			</div>
			<?php
				if (LayoutCompilator::sidebar_exists()) {
					if (LayoutCompilator::is_right_sidebar('single')) {
						echo ts_var_sanitize($sidebar_content);
					}
				}
			?>
		</div>
	</div>
	
	<?php if (!fields::logic($post->ID, 'post_settings', 'hide_related')): ?>
		<div class="ts-related-video-container row">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<h4 class="related-title"><?php _e('Related posts', 'shootback'); ?></h4>
					</div>
					<?php echo LayoutCompilator::get_single_related_posts(get_the_ID()); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<!-- Ad area 2 -->
	<?php if( fields::get_options_value('shootback_theme_advertising','ad_area_2') != '' ): ?>
	<div class="container text-center ts-advertising-container">
		<?php echo fields::get_options_value('shootback_theme_advertising','ad_area_2'); ?>
	</div>
	<?php endif; ?>
	<!-- // End of Ad Area 2 -->

	<div class="container single-video-comments">
		<div class="row content-block">
			<div class="col-lg-12">
				<?php comments_template( '', true ); ?>
			</div>
		</div>
	</div>
</section>
<?php
	ts_get_pagination_next_previous();
?>
	<?php } ?>
<?php get_footer(); ?>