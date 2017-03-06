<?php

/* Thumbnail view template below */
###########

// Get the options

global $article_options;

// Get style for the feature blocks

if( isset($article_options['style']) ){
	$style = $article_options['style'];
}

if( isset($article_options['elements-per-row']) ){
	$elements_per_row = $article_options['elements-per-row'];
}

if( isset($article_options['features-block']) && $article_options['features-block'] != '[]' && $article_options['features-block'] != '' ){
	$arr = json_decode(stripslashes($article_options['features-block']));
	
	foreach($arr as $ts_option){
		
		// Get the number of features per row

		$columns_class = LayoutCompilator::get_column_class($elements_per_row);
		if ( $style == 'style1' ) {
			$style1_color = ' color:'.str_replace('--quote--', '"', $ts_option->font).'; ';
			$style1_border = ' border-color: '.str_replace('--quote--', '"', $ts_option->background).'; ';
		}elseif ( $style == 'style2' ) {
			$style2_bgcolor = ' background-color:'. str_replace('--quote--', '"', $ts_option->background). '; ';
			$style2_color = ' color:'. str_replace('--quote--', '"', $ts_option->font) . '; ';
		}else{
			$style1_color = "";
			$style1_border = "";
			$style2_color = "";
			$style2_bgcolor = "";
		}

		// Add article specific classes
	?>
		<div class="<?php echo $columns_class; ?>">
			<figure style="<?php echo $style1_border.$style2_bgcolor; ?>" >
				<header>
					<div class="image-container" style="<?php echo $style1_color.$style2_color; ?>">
						<i class="<?php echo str_replace('--quote--', '"', $ts_option->icon); ?>"></i>
					</div>
					<?php if( $style == 'style2' ): ?>
						<div class="entry-title">
							<h4 class="title"><?php echo str_replace('--quote--', '"', $ts_option->title);  ?></h4>
						</div>
					<?php endif; ?>
				</header>
				<figcaption>
					<?php if( $style == 'style1' ): ?>
						<div class="entry-title">
							<h4 class="title"><?php echo str_replace('--quote--', '"', $ts_option->title);  ?></h4>
						</div>
					<?php endif; ?>
					<div class="entry-excerpt">
						<?php echo apply_filters('the_content', str_replace('--quote--', '"', $ts_option->text)); ?>
					</div>
					<?php if( !empty($ts_option->url) ) : ?>
					<div class="readmore">
						<a class="btn btn-sm" href="<?php echo str_replace('--quote--', '"', $ts_option->url); ?>" >
							<span><?php _e('details', 'shootback'); ?></span>
						</a>
					</div>
					<?php endif ?>
				</figcaption>
			</figure>
		</div>
<?php
	} 
}
?>