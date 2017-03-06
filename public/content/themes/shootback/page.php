<?php
get_header();
global $wp_query;

$breadcrumbs = get_post_meta($post->ID, 'ts_header_and_footer', true);
	
if( isset($breadcrumbs['breadcrumbs']) && $breadcrumbs['breadcrumbs'] === 0 && !is_front_page() ) :
?>	
	<div class="ts-breadcrumbs breadcrumbs-single-post container">
		<?php
			echo ts_breadcrumbs();
		?>
	</div>
<?php endif; ?>
<?php
if ( have_posts() ) :
	if ( LayoutCompilator::builder_is_enabled() ):
		LayoutCompilator::run();
	else:
		$page_options = get_option('shootback_page');
		
		if ( LayoutCompilator::sidebar_exists() && !LayoutCompilator::builder_is_enabled()) {
			
			$options = LayoutCompilator::get_sidebar_options();
			extract(LayoutCompilator::build_sidebar($options));

		} else {
			$content_class = 'col-lg-12';
		}
?>

<section id="main">
<div class="container no-pad">
	<?php
		if ( LayoutCompilator::is_left_sidebar() && !LayoutCompilator::builder_is_enabled() ) {
			echo ts_var_sanitize($sidebar_content);
		}
	?>
	<div id="" class="<?php echo ts_var_sanitize($content_class) ?>">
		<div id="content" role="main">	
			<div class="row">
				<div class="col-lg-12">
					<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<div class="row">
								<div class="col-lg-12">
									<?php if ( !fields::logic($post->ID, 'page_settings', 'hide_title') ): ?>
										<h1 class="page-title"><?php the_title(); ?></h1>
									<?php endif; ?>
									<?php if ( ts_single_display_meta() && !fields::logic($post->ID, 'page_settings', 'hide_meta') ): ?>
										<ul class="post-title-meta">
											<li><?php _e( 'by', 'shootback' ); ?> <a href="#"><?php the_author(); ?></a></li>
											<li>
												<?php the_date(); ?>
											</li>
											<li>
											<?php
												if (fields::get_options_value('shootback_general', 'comment_system') === 'facebook' ) {
												    echo ts_get_comment_count(get_the_ID()) . __(' comments', 'shootback');
												}else{
													comments_number( '0 ' . __('comments', 'shootback'), '1 ' . __('comment', 'shootback'), '% ' . __('comments', 'shootback') );
												} 
											?>
											</li>
											<li><?php edit_post_link( __( 'Edit', 'shootback' ), '<span class="edit-link">', '</span>' ); ?></li>
										</ul>
									<?php endif ?>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<?php if ( !fields::logic($post->ID, 'page_settings', 'hide_featimg') ): ?>
									<div class="featured-image">
										<?php
											$post_thumbnail = get_post_thumbnail_id( get_the_ID() );
											$src = wp_get_attachment_url( $post_thumbnail ,'full'); //get img URL
											$img_url = aq_resize( $src, '1140', '9999', false, true); //crop img
											
											if ($img_url && has_post_thumbnail( get_the_ID() ) ): ?>
											<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" >

											<?php if ( ts_lightbox_enabled() ) {
												echo '<a class="zoom-in-icon" href="' . esc_url($src) . '" rel="fancybox[' . get_the_ID() . ']"><i class="icon-search"></i></a>';
											} ?>

											<?php if ( ts_overlay_effect_is_enabled() ): ?>
												<div class="<?php echo ts_overlay_effect_type() ?>"></div>
											<?php endif; endif; ?>
									</div>
									<?php endif; ?>
								</div>
							</div>
						</header><!-- .entry-header -->

						<div class="post-content">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'shootback' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content -->
						<?php if (!fields::logic($post->ID, 'page_settings', 'hide_author_box')): ?>
							<div class="post-author-box">
					            <a href="<?php echo get_author_posts_url($post->post_author) ?>"><?php echo get_avatar(get_the_author_meta( 'ID' ), 120) ?></a>
					            <h5 class="author-title" itemprop="reviewer"><?php the_author_link(); ?></h5>
					            <div class="author-box-info"><?php the_author_meta('description'); ?>
					                <?php
					                 if(strlen(get_the_author_meta('user_url'))!=''){?>
					                    <span><?php _e('Website:', 'shootback'); ?> <a href="<?php the_author_meta('user_url');?>"><?php the_author_meta('user_url');?></a></span>
					                <?php } ?>
					            </div>                                 
					        </div>
						<?php endif ?>
						<?php if ( !fields::logic($post->ID, 'page_settings', 'hide_social_sharing') ): ?>
							<div class="row">
								<div class="col-lg-12">
									<?php 
									if ( ts_page_social_sharing() ):
										get_template_part('social-sharing');
									endif;
									?>
								</div>
							</div>
						<?php endif; ?>
					</article><!-- #post-<?php the_ID(); ?> -->
					<div class="row content-block">
						<div class="col-lg-12">
							<?php comments_template( '', true ); ?>
						</div>
					</div>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
		</div>
	</div>
<?php
endif;
endif;

if ( LayoutCompilator::sidebar_exists() && !LayoutCompilator::builder_is_enabled() ) {
	if (LayoutCompilator::is_right_sidebar()) {
		if(isset($sidebar_content)) echo ts_var_sanitize($sidebar_content);
	}
}
if ( !LayoutCompilator::builder_is_enabled() ):
?>
</div>
</section>

<?php endif;

get_footer(); ?>
