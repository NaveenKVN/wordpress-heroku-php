<?php 

$src = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

$img_url = ts_resize('grid', $src);
$noimg_url = get_template_directory_uri() . '/images/noimage.jpg';
$bool = fields::get_options_value('shootback_general', 'enable_imagesloaded');

if ( $src ) {
	$featimage = '<img ' . ts_imagesloaded($bool, $img_url) . ' alt="' . esc_attr(get_the_title()) . '" />';
} else {
	$featimage = '<img ' .  ts_imagesloaded($bool, $noimg_url). ' alt="' . esc_attr(get_the_title()) . '" />';
}

$post_meta = get_post_meta(get_the_ID(), 'event', true);

$repeat = (isset($post_meta['event-enable-repeat']) && ($post_meta['event-enable-repeat'] == 'n' || $post_meta['event-enable-repeat'] == 'y')) ? $post_meta['event-enable-repeat'] : 'n';

$free_paid = '';
$price = '';

if( isset($post_meta['free-paid']) ){
	if( $post_meta['free-paid'] == 'free' ){
		$free_paid = __('Free', 'shootback');
	}else{
		if( isset($post_meta['ticket-url']) && !empty($post_meta['ticket-url']) ){
			$free_paid = '<a href="' . esc_url($post_meta['ticket-url']) . '">' . __('BUY', 'shootback') . '</a>';
		}
		$price = (isset($post_meta['price'])) ? $post_meta['price'] : '';
	}
}
$day = '';
$month = '';
$day_meta = get_post_meta(get_the_ID(), 'day', true);
if( isset($day_meta) && (int)$day_meta !== 0 ){
	$month = date("M", $day_meta);
	$day = date("j", $day_meta);
}

?>
<article>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
			<figure>
				<figcaption class="pull-left text-center">
					<ul class="metadate">
						<li class="date-add">
							<span class="month"><?php echo ts_var_sanitize($month, 'esc_attr'); ?></span>
							<span class="day"><?php echo ts_var_sanitize($day, 'esc_attr') ?></span>
						</li>
						<li class="type"><i><?php echo ts_var_sanitize($free_paid, 'esc_attr'); ?></i></li>
						<?php if( $repeat == 'y' ) : ?>
							<li class="status"><i class="icon-recursive"></i></li>
						<?php endif; ?>
					</ul>
				</figcaption>
				<div class="image-holder">
					<?php echo ts_var_sanitize($featimage); ?>
					
					<?php tsHoverStyle(get_the_ID()); ?>
				</div>
			</figure>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-7 col-lg-8">
			<section>
				<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<ul class="entry-meta">
					<li role="time"><i class="icon-time"></i><?php echo isset($post_meta['start-time'], $post_meta['end-time']) ? $post_meta['start-time'] . ' - ' . $post_meta['end-time'] : '' ?></li>
					<li role="location"><i class="icon-pin"></i><?php echo isset($post_meta['venue']) ? $post_meta['venue'] : ''; ?></li>
				</ul>
				<div class="entry-excerpt">
					<?php ts_excerpt('bigpost_excerpt', get_the_ID(), 'show-excerpt'); ?>
				</div>
			</section>
		</div>
	</div>
</article>