<?php get_header(); ?>
<?php if( get_post_type() !== 'video' ): ?>
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
<div class="container singular-container">
<?php endif ?>
<?php

global $wp_query;

if ( have_posts() ) :
	while ( have_posts() ) : the_post();
	if (LayoutCompilator::sidebar_exists()) {
		
		$options = LayoutCompilator::get_sidebar_options();

		extract(LayoutCompilator::build_sidebar($options));

		if (LayoutCompilator::is_left_sidebar()) {
			echo ts_var_sanitize($sidebar_content);
		}
	} else {
		$content_class = 'col-lg-12';
	}
	$topics = wp_get_post_terms( get_the_ID() , 'event_categories' );

	$terms = array();
	if( !empty( $topics ) ){
	    foreach ( $topics as $topic ) {
	        $term = get_category( $topic->slug );
	        array_push( $terms, $topic->slug );
	    }
	}
	$article_categories = '';
	foreach ($terms as $key => $term) {
		$article_categories .= '<li>' . '<a href="' . esc_attr(get_term_link($term, 'event_categories')) . '" title="' . __('View all articles from: ', 'shootback') . $term . '" ' . '>' . $term.'</a></li>';;
	}

	$ts_event_meta = get_post_meta($post->ID, 'event', true);
	$ts_event_day = get_post_meta($post->ID, 'day', true);
	$ts_event_day = (isset($ts_event_day) && abs($ts_event_day) !== 0) ? abs($ts_event_day) : NULL;
	// Get the start day
	if ( isset($ts_event_day) ) {
		$ts_event_start_day = date('d M Y', $ts_event_day);
	} else{
		$ts_event_start_day = __('Date not set', 'shootback');
	}
	// Get the event end day
	if ( isset($ts_event_meta['event-end']) ) {
		$ts_event_end_day = date('d M Y', strtotime($ts_event_meta['event-end']));
	} else{
		$ts_event_end_day = __('End day not set', 'shootback');
	}
	// Get the start time
	if ( isset($ts_event_meta['start-time']) ) {
		$ts_event_start_time = esc_attr($ts_event_meta['start-time']);
	} else{
		$ts_event_start_time = __('Time not set', 'shootback');
	}
	// Get the end time
	if ( isset($ts_event_meta['end-time']) ) {
		$ts_event_end_time = esc_attr($ts_event_meta['end-time']);
	} else{
		$ts_event_end_time = __('Time not set', 'shootback');
	}
	// Get the event days
	if ( isset($ts_event_meta['event-days']) ) {
		$ts_event_end_days = esc_attr($ts_event_meta['event-days']);
	} else{
		$ts_event_end_days = __('Days not set not set', 'shootback');
	}
	// Get the event repeat
	if ( isset($ts_event_meta['event-enable-repeat']) ) {
		$ts_event_repeat = esc_attr($ts_event_meta['event-enable-repeat']);
	} else{
		$ts_event_repeat = __('Repeat not set', 'shootback');
	}
	// Get the event tematic
	if ( isset($ts_event_meta['theme']) ) {
		$ts_event_tematic = esc_attr($ts_event_meta['theme']);
	} else{
		$ts_event_tematic = __('Tematic not set', 'shootback');
	}
	// Get the event person
	if ( isset($ts_event_meta['person']) ) {
		$ts_event_person = esc_attr($ts_event_meta['person']);
	} else{
		$ts_event_person = __('Person not set', 'shootback');
	}
	// Get the event map
	if ( isset($ts_event_meta['map']) ) {
		$ts_event_map = $ts_event_meta['map'];
	} else{
		$ts_event_map = __('Person not set', 'shootback');
	}
	// Get the event venue
	if ( isset($ts_event_meta['venue']) ) {
		$ts_event_venue = esc_attr($ts_event_meta['venue']);
	} else{
		$ts_event_venue = __('Venue not set', 'shootback');
	}
	
?>
		<div itemscope itemtype="http://data-vocabulary.org/Event" id="primary" class="<?php echo ts_var_sanitize($content_class) ?>">
			<div id="content" role="main">		
				<div class="row">
					<div class="col-lg-12">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="post-header">
								<div class="row">
									<div class="col-md-12">
										<div class="event-map">
											<?php echo ts_var_sanitize($ts_event_map); ?>
										</div>
									</div>
								</div>
								<div class="row">
									<?php if ( !fields::logic($post->ID, 'post_settings', 'hide_title') ): ?>
										<div class="col-sm-12 col-md-8 col-lg-8">
											<h3 class="page-title"><?php the_title(); ?>
											<?php edit_post_link( __( 'Edit', 'shootback' )); ?>
											</h3>
										</div>
										<div class="col-sm-12 col-md-4 col-lg-4">
											<div class="event-time">
												<i class="icon-time"></i>
												<span  itemprop="startDate" datetime="<?php echo ts_var_sanitize($ts_event_start_time) ?>"><?php echo ts_var_sanitize($ts_event_start_time) ?></span>
												-
												<span itemprop="endDate" datetime="<?php echo $ts_event_end_time ?>"><?php echo ts_var_sanitize($ts_event_end_time) ?></span>
											</div>
										</div>
									<?php endif ?>
									<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
										<div class="col-md-12 col-lg-12">
											<ul class="event-meta">
												<li class="event-start-date">
													<span class="meta"><?php _e('start date','shootback'); ?></span>
													<span role="start-date"><?php echo ts_var_sanitize($ts_event_start_day); ?></span>
												</li>
												<li class="event-end-date">
													<span class="meta"><?php _e('end date','shootback'); ?></span>
													<span role="end-date"><?php echo ts_var_sanitize($ts_event_end_day); ?></span>
												</li>
												<li class="event-venue">
													<span class="meta"><?php _e('venue','shootback'); ?></span>
													<span itemprop="location" role="venue"><?php echo ts_var_sanitize($ts_event_venue); ?></span>
												</li>
												<?php if ($ts_event_repeat !== 1): ?>	
												<li class="repeat">
													<span role="repeat"><i class="icon-recursive"></i></span>
												</li>
												<?php endif ?>
											</ul>
										</div>
									<?php endif ?>
								</div>
							</header><!-- .post-header -->
							
							<div class="post-content">
								<?php the_content(); ?>
								<!-- Start the rest of the event meta -->
								<ul itemprop="tickets" itemscope itemtype="http://data-vocabulary.org/Offer" class="event-meta-details">
									<?php if (isset($ts_event_meta['person']) && trim($ts_event_meta['person']) != ''): ?>
										<li><span><?php echo __('Host:','shootback'); ?></span> <?php echo esc_attr($ts_event_meta['person']); ?></li>
									<?php endif ?>
									<?php if (isset($ts_event_meta['price']) && trim($ts_event_meta['price']) != ''): ?>
										<li><span><?php echo __('Price:','shootback'); ?></span itemprop="price"> <?php echo esc_attr($ts_event_meta['price']); ?></li>
									<?php endif ?>
									<?php if (isset($ts_event_meta['ticket-url']) && trim($ts_event_meta['ticket-url']) != ''): ?>
										<li><span><?php echo __('Tickets:','shootback'); ?></span> <?php echo '<a  itemprop="offerurl" href="'.esc_url($ts_event_meta['ticket-url']).'" target="_blank">' . esc_url($ts_event_meta['ticket-url']).'</a>'; ?></li>
									<?php endif ?>
								</ul>
								<!-- End of event meta -->

								<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'shootback' ) . '</span>', 'after' => '</div>' ) ); ?>
							</div><!-- .post-content -->
							
							<footer class="post-footer">
								<?php if (!fields::logic($post->ID, 'post_settings', 'hide_author_box')): ?>
									<div class="post-author-box">
							            <a href="<?php echo get_author_posts_url($post->post_author) ?>"><?php  echo get_avatar(get_the_author_meta( 'ID' ), 120); ?></a>
							            <h5 class="author-title"><?php the_author_link(); ?></h5>
							            <div class="author-box-info"><?php the_author_meta('description'); ?>
							                <?php
							                 if(strlen(get_the_author_meta('user_url'))!=''){?>
							                    <span><?php _e('Website:', 'shootback'); ?> <a href="<?php the_author_meta('user_url');?>"><?php the_author_meta('user_url');?></a></span>
							                <?php } ?>
							            </div>
							        </div>
								<?php endif ?>
								<?php $tags_columns = (has_tag()) ? 'col-lg-6' : 'col-lg-12'; ?>
								<div class="row">
									<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'post_settings', 'hide_meta') ): ?>
										<?php if( has_tag() ) : ?>
											<div class="<?php echo $tags_columns; ?>">
												<div class="row">
													<div class="col-sm-12 col-md-12">
														<div class="post-tagged-icon">
															<i class="icon-tags"></i>
														</div>
														<div class="post-details">
															<h6 class="post-details-title"><?php _e('Tagged in','shootback'); ?></h6>
															<div class="post-tags">
																<?php if (ts_single_display_tags()): ?>
																	<?php the_tags('<ul class="tags-container"><li>','</li><li>','</li></ul>'); ?>
																<?php endif ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php endif; ?>
									<?php endif; ?>
									<div class="<?php echo $tags_columns; ?>">
										<?php 
											if(ts_single_social_sharing()): get_template_part('social-sharing');
										?>
										<?php endif; ?>
									</div>
								</div>
								<?php if (!fields::logic($post->ID, 'post_settings', 'hide_related')): ?>
									<div class="row">
										<div class="col-lg-12">
											<h4 class="related-title"><?php _e('Related events', 'shootback'); ?></h4>
										</div>
										<?php echo LayoutCompilator::get_single_related_posts(get_the_ID()); ?>
									</div>
								<?php endif; ?>
							</footer>
						</article><!-- #post-<?php the_ID(); ?> -->
						
						<!-- Ad area 2 -->
						<?php if( fields::get_options_value('shootback_theme_advertising','ad_area_2') != '' ): ?>
						<div class="container text-center ts-advertising-container">
							<?php echo fields::get_options_value('shootback_theme_advertising','ad_area_2'); ?>
						</div>
						<?php endif; ?>
						<!-- // End of Ad Area 2 -->

						<div class="row content-block">
							<div class="col-lg-12">
								<?php comments_template( '', true ); ?>
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
} ?>

</div>
<?php ts_get_pagination_next_previous(); ?>
</section>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>