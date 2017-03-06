		<footer id="footer" role="contentinfo" data-role="footer" data-fullscreen="true">
			<?php echo LayoutCompilator::build_footer(); ?>
		</footer>
	</div>
<?php 	$shootback_general = get_option('shootback_general');
		if( isset($shootback_general['enable_facebook_box']) && $shootback_general['enable_facebook_box'] == 'Y' ){
?>		
			<div class="ts-fb-modal modal fade" id="fbpageModal" tabindex="-1" role="dialog" aria-labelledby="fbpageModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">'. __('Close','shootback') . '</span></button>
							<h4 class="modal-title" id="fbpageModalLabel"><?php _e('Like our facebook page','shootback')?></h4>
						</div>
						<div class="modal-body">
							<div class="fb-page" data-href="https://facebook.com/<?php echo strip_tags($shootback_general['facebook_name']); ?>" data-width="500" data-height="350" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true">
								<div class="fb-xfbml-parse-ignore">
									<blockquote cite="https://www.facebook.com/<?php echo strip_tags($shootback_general['facebook_name']); ?>">
										<a href="https://www.facebook.com/<?php echo strip_tags($shootback_general['facebook_name']); ?>">Facebook</a>
									</blockquote>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Close','shootback'); ?></button>
						</div>
					</div>
				</div>
			</div>
<?php } ?>


	<div id="fb-root"></div>
	<script type="text/javascript">
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

<?php 
$scroll_to_top = get_option( 'shootback_styles' );
$scroll_to_top = (isset($scroll_to_top['scroll_to_top']) && ($scroll_to_top['scroll_to_top'] == 'y' || $scroll_to_top['scroll_to_top'] == 'n')) ? $scroll_to_top['scroll_to_top'] : 'y';
$rightClick = get_option('shootback_general');
$rightClick = (isset($rightClick['right_click']) && ($rightClick['right_click'] == 'y' || $rightClick['right_click'] == 'n')) ? $rightClick['right_click'] : 'n';
?>

<?php if( $scroll_to_top == 'y' ) : ?>
	<button id="ts-back-to-top"><i class="icon-up"></i><span><?php _e('Back to top', 'shootback'); ?></span></button>
<?php endif; ?>

<?php if( $rightClick == 'y' ) : ?>
	<script>
		jQuery(document).ready(function(){
			jQuery(document).on('contextmenu', function(e){
				return false;
			});
		});
	</script>
<?php endif; ?>

<?php echo ts_tracking_code(); ?>
<?php wp_footer(); ?>
</body>
</html>
