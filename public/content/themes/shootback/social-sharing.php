<?php 
$all_social = array('facebook', 'twitter', 'gplus', 'linkedin', 'tumblr', 'pinterest');
$facebook_count = 0;
$twitter_count = 0;
$gplus_count = 0;
$linkedin_count = 0;
$tumblr_count = 0;
$pinterest_count = 0;

foreach($all_social as $social){
	$count_social = get_post_meta(get_the_ID(), 'ts-social-' . $social, true);
	if(isset($count_social) && (int)$count_social !== 0 && $social == 'facebook') $facebook_count = (int)$count_social;
	if(isset($count_social) && (int)$count_social !== 0 && $social == 'twitter') $twitter_count = (int)$count_social;
	if(isset($count_social) && (int)$count_social !== 0 && $social == 'gplus') $gplus_count = (int)$count_social;
	if(isset($count_social) && (int)$count_social !== 0 && $social == 'linkedin') $linkedin_count = (int)$count_social;
	if(isset($count_social) && (int)$count_social !== 0 && $social == 'tumblr') $tumblr_count = (int)$count_social;
	if(isset($count_social) && (int)$count_social !== 0 && $social == 'pinterest') $pinterest_count = (int)$count_social;
}
$count_total = $facebook_count + $twitter_count + $gplus_count + $linkedin_count + $tumblr_count + $pinterest_count;

?>
<div class="post-social-sharing">
	<div class="ts-cool-share">
		<label for="share-options count"><span class="counted"><?php echo absint($count_total); ?></span><span class="sub"><?php _e("shares","shootback"); ?></span></label>
		<ul class="share-options">
		    <li class="share-menu-item shown" data-social="facebook" data-post-id="<?php echo get_the_ID(); ?>">
		        <a class="icon-facebook" target="_blank" data-tooltip="<?php _e('share on facebook','shootback'); ?>" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(get_the_ID()); ?>"></a>
		        <span class="how-many"><?php echo absint($facebook_count); ?></span>
		    </li>
		    <li class="share-menu-item shown" data-social="twitter" data-post-id="<?php echo get_the_ID(); ?>">
		        <a class="icon-twitter" target="_blank" data-tooltip="<?php _e('share on twitter','shootback'); ?>" href="http://twitter.com/home?status=<?php echo urlencode(get_the_title()); ?>+<?php echo get_permalink(get_the_ID()); ?>"></a>
		        <span class="how-many"><?php echo absint($twitter_count); ?></span>
		    </li>
		    <li class="share-menu-item shown" data-social="gplus" data-post-id="<?php echo get_the_ID(); ?>">
		        <a class="icon-gplus" target="_blank" data-tooltip="<?php _e('share on google+','shootback'); ?>" href="https://plus.google.com/share?url=<?php echo get_permalink(get_the_ID()); ?>"></a>
		        <span class="how-many"><?php echo absint($gplus_count); ?></span>
		    </li>
		    <li class="share-menu-item hidden" data-social="linkedin" data-post-id="<?php echo get_the_ID(); ?>">
		        <a class="icon-linkedin" target="_blank" data-tooltip="<?php _e('share on linkedin','shootback'); ?>" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(get_the_ID()); ?>&title=<?php echo urlencode(get_the_title()); ?>"></a>
		        <span class="how-many"><?php echo absint($linkedin_count); ?></span>
		    </li>
		    <li class="share-menu-item hidden" data-social="tumblr" data-post-id="<?php echo get_the_ID(); ?>">
		        <a class="icon-tumblr" target="_blank" data-tooltip="<?php _e('share on tumblr','shootback'); ?>" href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink(get_the_ID())); ?>&name=<?php echo ts_var_sanitize($post->post_title); ?>&description=<?php echo ts_var_sanitize($post->post_excerpt); ?>"></a>
		        <span class="how-many"><?php echo absint($tumblr_count); ?></span>
		    </li>
		    <li class="share-menu-item hidden" data-social="pinterest" data-post-id="<?php echo get_the_ID(); ?>">
		        <a class="icon-pinterest" target="_blank" data-tooltip="<?php _e('share on pinterest','shootback'); ?>" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php if(function_exists('the_post_thumbnail')) echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>&amp;description=<?php echo urlencode(get_the_title()); ?>" ></a>
		        <span class="how-many"><?php echo absint($pinterest_count); ?></span>
		    </li>
			<li class="show-more">
				<a href="#" class="icon-threedots" data-toggle="share-menu-item" data-tooltip="<?php _e('show more','shootback'); ?>"></a>
			</li>
		</ul>
	</div>
</div>