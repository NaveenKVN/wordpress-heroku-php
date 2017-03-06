<?php
get_header();

/* Team single page */

$teams = get_post_meta($post->ID, 'ts_member', TRUE);

$description = (isset($teams['about_member'])) ? apply_filters('the_content', $teams['about_member']) : '';
$title       = (isset($teams['title'])) ? esc_attr($teams['title']) : '';
$facebook    = (isset($teams['facebook'])) ? esc_url($teams['facebook']) : '';
$twitter     = (isset($teams['twitter'])) ? esc_url($teams['twitter']) : '';
$linkedin    = (isset($teams['linkedin'])) ? esc_url($teams['linkedin']) : '';
$gplus       = (isset($teams['gplus'])) ? esc_url($teams['gplus']) : '';

$categories  = get_the_terms($post->ID, 'teams');
$term_ids    = wp_get_post_terms($post->ID, 'teams', array('fields' => 'ids'));

if( is_array($term_ids) && !empty($term_ids) ){
	$args = array(
		'post_type'    => 'ts_teams',
		'post__not_in' => array($post->ID),
		'tax_query'    => array(
	        array( 
	            'taxonomy' => 'teams',
	            'field'    => 'id',
	            'terms'    => $term_ids
	        )
	    ),
		'posts_per_page' => 3
	);
	$query = new WP_Query($args);
	$options = array();
	$options['elements-per-row'] = 3;
	if( $query->have_posts() ){
		$related_teams = LayoutCompilator::teams_element($options, $query);
	}
}

$author_id = (isset($teams['team-user']) && absint($teams['team-user']) > 0) ? absint($teams['team-user']) : '';

if( $author_id !== '' ){
	$args = array(
		'author' => $author_id,
	);
	$query_author = new WP_Query($args);

	$options_author = array();
	$options_author['display-title'] = 'title-below';
	$options_author['display-mode'] = 'thumbnails';
	$options_author['elements-per-row'] = 4;
	$options_author['meta-thumbnail'] = 'y';

	if( $query_author->have_posts() ){
		$related_teams_author = LayoutCompilator::last_posts_element($options_author, $query_author);
	}
}

?>
<div id="primary" class="ts-team-single">
	<div id="content" role="main">		
		<div class="container team-general">
			<div class="row">
				<div class="col-sm-3 col-md-3">
					<div class="member-thumb">
						<?php the_post_thumbnail(); ?>
					</div>
				</div>
				<div class="col-sm-9 col-md-9">
					<div class="member-content">
						<div class="member-name">
							<h3 class="title"><?php the_title(); ?></h3>
							<ul class="category">
							<?php if( is_array($categories) ) : ?>
								<?php $i = 1; foreach($categories as $key=>$category) : ?>
									<?php
										// Get the URL of this category
										$category_link = get_term_link( $category->term_id, 'teams');
									?>
									<?php if( $i < count($categories) ) : ?>
										<li><?php echo esc_attr($category->name); ?></li>
									<?php else : ?>
										<li><?php echo esc_attr($category->name); ?></li>
									<?php endif; ?>
								<?php $i++; endforeach; ?>
							<?php endif; ?>
							</ul>
						</div>
						<span class="position"><?php echo esc_attr($teams['position']); ?></span>
						<p class="author-short-description"><?php echo ts_var_sanitize($description); ?></p>
						<hr>
						<div class="social-icons">
							<ul>
								<?php if ( ! empty( $facebook ) ) : ?>
									<li><a class="icon-facebook" href="<?php echo ts_var_sanitize($facebook); ?>"></a></li>
								<?php endif; ?>
								<?php if ( ! empty( $twitter ) ) : ?>
									<li><a class="icon-twitter" href="<?php echo ts_var_sanitize($twitter); ?>"></a></li>
								<?php endif; ?>
								<?php if ( ! empty( $linkedin ) ) : ?>
									<li><a class="icon-linkedin" href="<?php echo ts_var_sanitize($linkedin); ?>"></a></li>
								<?php endif; ?>
								<?php if ( ! empty( $gplus ) ) : ?>
									<li><a class="icon-gplus" href="<?php echo ts_var_sanitize($gplus); ?>"></a></li>
								<?php endif; ?>
							</ul>
						</div>
						<br><br>
						<div class="post-content">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid related-members">
			<div class="container">
				<div class="row">
					<?php if( isset($related_teams_author) ): ?>
						<div class="col-lg-12">
							<h3><?php _e('Author articles', 'shootback'); ?></h3>
						</div>
						<?php echo balanceTags($related_teams_author); ?>
					<?php endif; ?>
					<div class="col-lg-12">
						<h3><?php _e('Related members', 'shootback'); ?></h3>
					</div>
					<?php if( isset($related_teams) ) echo balanceTags($related_teams); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>