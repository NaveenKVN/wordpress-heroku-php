<?php get_header(); ?>
<section id="main">
	<?php
		$breadcrumbs = get_option('shootback_single_post', array('breadcrumbs' => 'y'));
		if( $breadcrumbs['breadcrumbs'] === 'y' ) :
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

				$singlePostOptions = get_post_meta($post->ID, 'post_settings', true);
				$subtitle = (isset($singlePostOptions['subtitle']) && $singlePostOptions['subtitle'] !== '') ? esc_attr($singlePostOptions['subtitle']) : NULL;

				$generalSingle = get_option('shootback_single_post');
				$hideAuthorBox = !fields::logic($post->ID, 'post_settings', 'hide_author_box') && $generalSingle['display_author_box'] == 'n' ? 'y' : 'n';
				
				if (LayoutCompilator::sidebar_exists()) {
					
					$options = LayoutCompilator::get_sidebar_options();

					extract(LayoutCompilator::build_sidebar($options));

				} else {
					$content_class = 'col-lg-12';
				}

				$rating_items = get_post_meta($post->ID, 'ts_post_rating', TRUE);
				$rating_final = ts_get_rating($post->ID);

				$display_featured_img = ( ts_display_featured_image() && has_post_thumbnail( get_the_ID() ) ) ? 'has-featured-img':'hidden-featured-img';
				?>
				<div class="<?php echo ts_var_sanitize($display_featured_img); ?>">
					<div class="header container">
						<?php if ( ts_display_featured_image() && has_post_thumbnail( get_the_ID() ) ) : ?>
							<div class="featured-image">
								<?php if( isset($rating_final) ) : ?>
									<div class="post-rating-circular">
										<div class="circular-content">
											<span class="title"><?php _e("Rating","shootback"); ?></span>
											<div class="counted-score"><?php echo ts_var_sanitize($rating_final); ?></div>
											<div class="limit">10</div>
										</div>
									</div>
								<?php endif; ?>
								<?php
									if ( get_post_format( get_the_ID() ) === false ) {
										if ( ts_display_featured_image() && has_post_thumbnail( get_the_ID() ) ) {
											
											$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
											$img_url = ts_resize('single', $src);

											echo '<img itemprop="image" itemprop="thumbnailUrl" src="' . esc_url($img_url) . '" alt="' . esc_attr(get_the_title()) . '" >';

											if (ts_lightbox_enabled()) {
												echo '<a class="zoom-in-icon" href="' . esc_url($src) . '" rel="fancybox[' . get_the_ID() . ']"><i class="icon-search"></i></a>';
											}

											if ( ts_overlay_effect_is_enabled() ) {
												echo '<div class="' . ts_overlay_effect_type() . '"></div>';
											}
										}

						            } elseif( get_post_format( get_the_ID() ) === 'gallery' ) {

										echo red_get_post_img_slideshow( get_the_ID() );

						            } elseif ( get_post_format( get_the_ID() ) === 'video' ) {

						            	echo '<div class="embedded_videos">';
						            	echo apply_filters('the_content', get_post_meta(get_the_ID(), 'video_embed', TRUE));
						            	echo '</div>';

						            } elseif ( get_post_format(get_the_ID()) === 'audio' ) {

						            	$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
						            	$img_url = ts_resize('single', $src);
						            	echo '<div class="relative ">';
						            	echo '<img itemprop="image" itemprop="thumbnailUrl" src="' . esc_url($img_url) . '" alt="' . esc_attr(get_the_title()) . '" >';

						            	echo '<a class="zoom-in-icon" href="' . esc_url($src) . '" rel="fancybox[' . get_the_ID() . ']"><i class="icon-search"></i></a>';
						            	
						            	if ( ts_overlay_effect_is_enabled() ) {
						            		echo '<div class="' . ts_overlay_effect_type() . '"></div>';
						            	}
						            	echo '</div>';
						            	echo '<div class="embedded_audio">';
						            	echo apply_filters('the_content', get_post_meta(get_the_ID(), 'audio_embed', TRUE));
						            	echo '</div>';

						            }
								?>
							</div>
						<?php endif; ?>
					</div>
					<div class="container singular-container">
						<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
							<aside class="single-meta-sidebar">
								<div class="inner-aside">
									<div class="entry-meta">
										<ul class="post-meta">
											<li class="post-meta-author">
												<a class="author-avatar" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
													<?php echo get_avatar(get_the_author_meta( 'ID' ), 140); ?>
												</a>
												<a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
													<?php echo get_the_author(); ?>
												</a>
											</li>
											<?php touchsize_likes($post->ID, '<li class="post-likes">', '</li>'); ?>
										</ul>
										<ul class="post-meta entry-meta-date">
											<li class="meta-date"><?php echo get_post_time('j'); ?></li>
											<li class="meta-month"><?php echo get_post_time('M'); ?></li>
										</ul>
										<ul class="post-meta">
											<li class="post-views">
												<i class="icon-views"></i> <?php ts_get_views($post->ID); ?>
											</li>
											<?php if (get_the_category_list()): ?>
												<li class="post-meta-categories">
													<?php echo get_the_category_list(' / '); ?>
												</li>
											<?php endif; ?>
											<?php edit_post_link( __( 'Edit', 'shootback' ), '<li class="post-meta-edit"><span class="edit-link">', '</span></li>' ); ?>
										</ul>
										<?php if( has_tag() ) : ?>
											<?php if (ts_single_display_tags()): ?>
												<span class="tagged"><?php _e("tagged in:","shootback"); ?></span>
												<?php the_tags('<ul itemprop="keywords" class="tags-container"><li>','</li><li>','</li></ul>'); ?>
											<?php endif ?>
										<?php endif; ?>
									</div>
								</div>
							</aside>
						<?php endif ?>
						<section class="single-content">
							<div class="col-md-12">
								<div class="row">
									<div class="inner-single-content">
										<?php
											if (LayoutCompilator::sidebar_exists()) {
												if (LayoutCompilator::is_left_sidebar('single')) {
													echo ts_var_sanitize($sidebar_content);
												}
											}
										?>
										<div id="primary" class="<?php echo ts_var_sanitize($content_class); ?>">
											<div id="content" role="main">
												<div class="post-header-title">
													<div class="entry-header-content">
														<div class="entry-title">
															<h1 class="post-title"><?php the_title(); ?></h1>
														</div>
													</div>
												</div>
												<div class="section">
													<div class="inner-section">
														<?php if( isset($subtitle) ) : ?>
															<div class="entry-subtitle">
																<?php echo ts_var_sanitize($subtitle); ?>
															</div>
														<?php endif; ?>
														<div class="post-content">
															<?php the_content(); ?>
															<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'shootback' ) . '</span>', 'after' => '</div>' ) ); ?>
														</div>
													</div>
												</div>
												<div class="footer">
													<div class="inner-footer">
														<?php if( isset($rating_items) && is_array($rating_items) && !empty($rating_items) ) : ?>
															<div class="row">
																<div class="col-md-12">
																	<div class="post-rating">
																		<ul class="rating-items">
																		<?php 
																		$final_score = ''; $i = 0;
																		foreach($rating_items as $rating) : $final_score += $rating['rating_score']; $i++; ?>
																			<li>
																				<h4 class="rating-title"><?php echo sanitize_text_field($rating['rating_title']); ?></h4>
																				<span class="rating-score"><i class="note"><?php echo absint($rating['rating_score']) ?></i>&frasl;<i class="limit">10</i></span>
																				<div class="rating-bar">
																					<span class="bar-progress" data-bar-size="<?php echo absint($rating['rating_score']) * 10 ?>"></span>
																				</div>
																			</li>
																		<?php endforeach; ?>
																		</ul>
																		<div class="text-right">
																			<div class="counted-score">
																				<span><?php _e('Final Score', 'shootback'); ?></span><strong class="score"><?php echo round($final_score / $i, 1); ?>/10</strong>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php endif; ?>
														<div class="row">
															<div class="col-md-12">
																<?php if( $hideAuthorBox == 'y' ) : ?>
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
														<div class="row">
															<div class="col-md-12">
																<?php if(ts_single_social_sharing()): ?>
																	<?php get_template_part('social-sharing'); ?>
																<?php endif; ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php
											if (LayoutCompilator::sidebar_exists()) {
												if (LayoutCompilator::is_right_sidebar('single')) {
													echo ts_var_sanitize($sidebar_content);
												}
											}
										?>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</section>
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
	<?php 

			endwhile;
		endif;
	?>
</section>
<?php get_footer(); ?>