<?php
get_header();

?>
<div class="row">
	<div class="container">
		<div class="post-author-box">
		    <a href="<?php echo get_author_posts_url($post->post_author) ?>"><?php echo get_avatar(get_the_author_meta( 'ID' ), 120); ?></a>
		    <h5 class="author-title" itemprop="reviewer"><?php the_author_link(); ?></h5>
		    <div class="author-box-info"><?php the_author_meta('description'); ?>
		        <?php
		         if(strlen(get_the_author_meta('user_url')) != '' ){?>
		            <span><?php _e('Website:', 'shootback'); ?> <a href="<?php the_author_meta('user_url');?>"><?php the_author_meta('user_url');?></a></span>
		        <?php } ?>
		    </div>                                 
		</div>
	</div>
</div>
<?php
	$title = __( 'All posts by ', 'shootback' ) . '<b><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a>' . '</b>';

$options = get_option('shootback_layout');
$sidebar_options = $options['author_layout']['sidebar'];
$view_type = $options['author_layout']['display-mode'];
$view_options = $options['author_layout'][$view_type];
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
		<h3 class="archive-title author-title">
			<?php echo strip_tags($title, '<b><a>'); ?>
		</h3>
		<div class="row">
			<?php echo ts_var_sanitize($content); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>