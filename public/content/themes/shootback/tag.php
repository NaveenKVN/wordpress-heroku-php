<?php

get_header();
global $wp_query;

$options = get_option('shootback_layout');


$title = '<b>' . single_tag_title('', false) . '<span>&nbsp;' . count($posts) . '</span>' . '</b>';

$sidebar_options = $options['tags_layout']['sidebar'];
$view_type = $options['tags_layout']['display-mode'];
$view_options = $options['tags_layout'][$view_type];
$view_options['display-mode'] = $view_type;

extract(layoutCompilator::build_sidebar( $sidebar_options ));

$content = layoutCompilator::last_posts_element($view_options, $wp_query);

$classContent = (isset($sidebar_options['size']) && $sidebar_options['size'] == '1-3') ? 'col-lg-8 col-md-8 col-sm-12' : 'col-lg-9
 col-md-9 col-sm-12';

if ( isset($sidebar_options['position']) && $sidebar_options['position'] === 'left' ) {
	$content = $sidebar_content . '<div class="' . $classContent . '">' . $content . '</div>';
} else if ( isset($sidebar_options['position']) && $sidebar_options['position'] === 'right' ) {
	$content = '<div class="' . $classContent . '">' . $content . '</div>' . $sidebar_content;
}
?>

<section id="main" class="row">
	<div class="container">
		<?php 
			$breadcrumbs = get_option('shootback_single_post', array('breadcrumbs' => 'y')); 
			if( $breadcrumbs['breadcrumbs'] === 'y' ) echo ts_breadcrumbs();
		?>
		<h3 class="archive-title">
			<?php echo strip_tags($title, '<span><b>'); ?>
		</h3>
		<div class="row">
			<?php echo ts_var_sanitize($content); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>