<?php get_header(); ?>
<?php if( get_post_type() !== 'video' ): ?>
<section id="main">
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

$portfolio_items = get_post_meta(get_the_ID(), 'ts_portfolio', TRUE);
$portfolio_details = get_post_meta(get_the_ID(), 'ts_portfolio_details', TRUE);

?>
<div id="primary" class="<?php echo ts_var_sanitize($content_class) ?>">
	<div id="content" role="main">	
		<?php 
			$breadcrumbs = get_option('shootback_single_post', array('breadcrumbs' => 'y')); 
			if( $breadcrumbs['breadcrumbs'] === 'y' ) echo ts_breadcrumbs();
		?>	
		<div class="row">
			<div class="col-lg-12">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<div class="row">
							<div class="col-lg-12">
								<div class="flexslider featured-image portfolio-featured" data-animation="fade">
									<ul class="slides">
									<?php
										foreach ($portfolio_items as $item) {
											if ( $item['item_type'] === 'i' ) {
												
												$src = $item['item_url'];
												$img_url = ts_resize('single', $src);

												echo '<li><img src="'. $img_url .'" alt="' . esc_attr($item['description']) . '" />';

												if ( ts_lightbox_enabled() ) {
													echo '<a class="zoom-in-icon" href="' . esc_url($item['item_url']) . '" rel="fancybox[' . get_the_ID() . ']"><i class="icon-search"></i></a>';
												}

												if ( ts_overlay_effect_is_enabled() ) {
													echo '<div class="' . ts_overlay_effect_type() . '"></div>';
												}

												echo '</li>';

											} elseif ( $item['item_type'] === 'v' ) {
												echo '<div class="embedded_videos">' . apply_filters('the_content', $item['embed']) . '</div>';
											}
										}
									?>
									</ul>
								</div>
							</div>
						</div>
					</header><!-- .entry-header -->

					<section>
						<div class="row">
							<div class="col-md-3 col-lg-3">
								<div class="post-meta">
								<?php if (ts_single_display_meta()): ?>
									<ul>
										<li class="date">
											<span><?php _e('Date','shootback') ?></span>
											<div><?php the_date(); ?></div>
										</li>
										<li class="client">
											<span><?php _e('Client','shootback') ?></span>
											<div><?php echo esc_attr($portfolio_details['client']); ?></div>
										</li>
										<li class="category">
											<span><?php _e('Services','shootback') ?></span>
											<div><?php echo esc_attr($portfolio_details['services']); ?></div>
										</li>
										<li class="url">
											<span><?php _e('URL','shootback') ?></span>
											<div><a href="<?php echo esc_url($portfolio_details['project_url']); ?>" target="_blank"><?php echo esc_attr($portfolio_details['project_url']); ?></a></div>
										</li>
									</ul>
								<?php endif; ?>
								</div>
							</div>
							<div class="col-md-9 col-lg-9">
								<div class="post-content">
									<h2 class="page-title"><?php the_title(); ?></h2>
									<?php the_content(); ?>
									<?php edit_post_link( __( 'Edit', 'shootback' ), '<span class="edit-link">', '</span>' ); ?>
									<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'shootback' ) . '</span>', 'after' => '</div>' ) ); ?>
								</div><!-- .entry-content -->
							</div>
						</div>
					</section>


					<footer class="post-author-box">
						<div class="row">
							<div class="col-lg-12">
								<?php 
								if(ts_single_social_sharing()):
									get_template_part('social-sharing');
								endif;
								?>
							</div>
						</div>

						<?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
						<div id="author-info">
							<div id="author-avatar">
								<?php echo get_avatar(get_the_author_meta( 'ID' ), 50); ?>
							</div><!-- #author-avatar -->
							<div id="author-description">
								<h2><?php printf( __( 'About %s', 'shootback' ), get_the_author() ); ?></h2>
								<?php the_author_meta( 'description' ); ?>
								<div id="author-link">
									<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
										<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'shootback' ), get_the_author() ); ?>
									</a>
								</div><!-- #author-link	-->
							</div><!-- #author-description -->
						</div><!-- #author-info -->
						<?php endif; ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->
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
</section>

<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>