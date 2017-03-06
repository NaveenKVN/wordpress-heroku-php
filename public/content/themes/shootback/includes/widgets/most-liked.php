<?php
    class widget_most_liked extends WP_Widget {

        function widget_most_liked() {
            $widget_ops = array( 'classname' => 'widget_most_liked' , 'description' => __( " Get posts that have the most likes." , 'shootback' ) );
            parent::__construct( 'widget_touchsize_most_liked' , __( "Most liked posts" , 'shootback' ) , $widget_ops );
        }

        function widget( $args , $instance ) {

            /* prints the widget*/
            extract($args, EXTR_SKIP);

            $by_time = (isset($instance['by_time']) && ($instance['by_time'] === 't' || $instance['by_time'] === 'm' || $instance['by_time'] === 'w')) ? $instance['by_time'] : 't';
            
            if( isset( $instance['title'] ) ){
                $title = $instance['title'];
            }else{
                $title = '';
            }

			if( isset( $instance['nr_posts'] ) && is_numeric($instance['nr_posts']) ){
                $nr_posts = $instance['nr_posts'];
            }else{
                $nr_posts = 5;
            }
			
						
			if(isset($instance['customPost']) ){
				$custompost		= $instance['customPost'];
			}else{
				$custompost		= array();
			}
			
			
			if(isset($instance['taxonomy']) ){
				$taxonomy		= $instance['taxonomy'];
			}else{
				$taxonomy		= array();
			}
			
			if(isset($instance['taxonomies']) ){
				$taxonomies		= $instance['taxonomies'];
			}else{
				$taxonomies		= array();
			}

			$number = (isset($instance['number']) && ($instance['number'] == 'y' || $instance['number'] == 'n')) ? $instance['number'] : 'y';		
			$image = (isset($instance['image']) && ($instance['image'] == 'y' || $instance['image'] == 'n')) ? $instance['image'] : 'y';
			$date = (isset($instance['date']) && ($instance['date'] == 'y' || $instance['date'] == 'n')) ? $instance['date'] : 'n';
			$likes   = (isset($instance['likes']) && ($instance['likes'] == 'y' || $instance['likes'] == 'n')) ? $instance['likes'] : 'y';
			$views   = (isset($instance['views']) && ($instance['views'] == 'y' || $instance['views'] == 'n')) ? $instance['views'] : 'n';
			$comments = (isset($instance['comments']) && ($instance['comments'] == 'y' || $instance['comments'] == 'n')) ? $instance['comments'] : 'y';
			$columns 	= (isset($instance['columns']) && ($instance['columns'] === '1' || $instance['columns'] === '2')) ? $instance['columns'] : '1';
			
            echo ts_var_sanitize($before_widget);
		?>
			
			
		<?php
            if( !empty($title) ){
				echo ts_var_sanitize($before_title . $title . $after_title);
			}	
		
            $args = array(
				'post_type' => $custompost,
				'posts_per_page' =>$nr_posts,
				
			);

			/*iterate through each taxonomy, and if the value equals to -1, then remove that calue from array to not influence the query*/			
			foreach ($taxonomies as $key => $value) {
				if( (int)$value === -1 ){
					unset($taxonomies[$key]);
				}
			}
			
			if(sizeof($taxonomies)){
				$args['tax_query'] = array(
					array(
						'taxonomy' => $taxonomy[0],
						'field'    => 'slug',
						'terms'    => $taxonomies
					)
				);
			}
			$args['meta_key'] = '_touchsize_likes';
			$args['orderby']  = 'meta_value_num';
			$args['order']    = 'DESC';
			
			if( $by_time === 'w' ) $args['w'] = date('W');
			if( $by_time === 'm' ) $args['monthnum'] = date('m');
			$class_columns = ($columns === '1') ? '' : ($columns === '2') ? 'col-lg-6 col-md-6 col-sm-12' : 'col-lg-12 col-md-12 col-sm-12';

			$recent = new WP_Query( $args );
			$count = 0;

            if( is_array($recent->posts) && !empty($recent->posts) ){
                ?>
                <ul class="widget-items row <?php echo ' widget-columns-' . $columns; if( $image == 'y' ) echo ' widget-has-image'; ?>"><?php
                foreach($recent->posts as $post)  {
                	$count++;
                	
					if( get_post_thumbnail_id($post->ID) ){
								$post_img = wp_get_attachment_image(get_post_thumbnail_id($post->ID) , 'grid' , '');
								$cnt_a1 = ' href="' . get_permalink($post->ID) . '"';
								$cnt_a2 = ' href="' . get_permalink($post->ID) . '#comments"';
								$cnt_a3 = ' class="entry-img" href="' . get_permalink($post->ID) . '"';
								
							}else{
								$post_img = '<img src="' . get_template_directory_uri() . '/images/no-image.png" alt="" />';
								$cnt_a1 = ' href="' . get_permalink($post->ID) . '"';
								$cnt_a2 = ' href="' . get_permalink($post->ID) . '#comments"';
								$cnt_a3 = ' class="entry-img" href="' . get_permalink($post->ID) . '"';
							}
							
							$article_date =  get_the_date('', $post->ID);

					?>
                    <li class="<?php echo $class_columns; ?>">
						<article class="row<?php if( $number == 'y' ) echo ' widget-has-number'; ?>">
							<?php if( $image == 'y' ) : ?>			
								<div class="col-lg-12 col-md-12 col-sm-12">
	                                <a <?php echo ts_var_sanitize($cnt_a3); ?>><?php echo ts_var_sanitize($post_img); ?></a>
	                            </div>
	                        <?php endif; ?>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                            	<?php if( $number == 'y' ) : ?>
                            		<span class="count-item"><?php echo ts_var_sanitize($count); ?></span>
                            	<?php endif; ?>
                            	<div class="entry-content">
	                                <h4 class="title">
	                                	<a <?php echo ts_var_sanitize($cnt_a1); ?>>
											<?php echo ts_var_sanitize($post->post_title); ?>
										</a>
									</h4>
									<div class="widget-meta">
										<ul class="list-inline">
											<?php if( $date == 'y' ) : ?>
												<li class="meta-date">
													<span><?php echo esc_attr($article_date) ?></span>
												</li>
											<?php endif; ?>
											<?php if( $comments == 'y' ) : ?>
												<li class="red-comments">
												    <a <?php echo ts_var_sanitize($cnt_a2); ?>>
												        <i class="icon-comments"></i>
												        <span class="comments-count">
												            <?php echo ts_var_sanitize($post->comment_count) . ' '; ?> 
												        </span>
												    </a>
												</li>
											<?php endif; ?>
											<?php if( $likes == 'y' ) : ?>
												<?php touchsize_likes($post->ID, '<li class="meta-likes">', '</li>'); ?>
											<?php endif; ?>
											<?php if( $views == 'y' ) : ?>
												<li class="meta-views">
												    <i class="icon-views"></i> <?php ts_get_views($post->ID, true); ?>
												</li>
											<?php endif; ?>
										</ul>
									</div>
                            	</div>
                            </div>
						</article>
                    </li>
        <?php

                }
                ?></ul><?php
            }
            
            wp_reset_query();
            echo ts_var_sanitize($after_widget);
		}
		
		
        function update( $new_instance, $old_instance) {

            /*save the widget*/
            $instance = $old_instance;
// 			print_r($old_instance);
			
            $instance['title']	  = strip_tags( $new_instance['title'] );
			$instance['nr_posts'] = strip_tags( $new_instance['nr_posts'] );
			$instance['by_time']  = strip_tags( $new_instance['by_time'] );
			$instance['columns'] = strip_tags($new_instance['columns']);
			$instance['image']    = (isset($new_instance['image']) && ($new_instance['image'] == 'y' || $new_instance['image'] == 'n')) ? $new_instance['image'] : 'y';
			$instance['number']   = (isset($new_instance['number']) && ($new_instance['number'] == 'y' || $new_instance['number'] == 'n')) ? $new_instance['number'] : 'n';
			$instance['date']   = (isset($new_instance['date']) && ($new_instance['date'] == 'y' || $new_instance['date'] == 'n')) ? $new_instance['date'] : 'n';
			$instance['likes']   = (isset($new_instance['likes']) && ($new_instance['likes'] == 'y' || $new_instance['likes'] == 'n')) ? $new_instance['likes'] : 'y';
			$instance['views']   = (isset($new_instance['views']) && ($new_instance['views'] == 'y' || $new_instance['views'] == 'n')) ? $new_instance['views'] : 'n';
			$instance['comments']   = (isset($new_instance['comments']) && ($new_instance['comments'] == 'y' || $new_instance['comments'] == 'n')) ? $new_instance['comments'] : 'y';
			
			
			$instance['customPost'] = array();
			foreach($new_instance['customPost'] as $cust_post){
				if($cust_post != ''){
					$instance['customPost'][] = $cust_post;
				}	
			}
			
			$instance['taxonomy'] = array(); 
			foreach($new_instance['taxonomy'] as $taxonomy){
				if($taxonomy != ''){
					$instance['taxonomy'][] = $taxonomy;
				}else{
					$instance['taxonomy'][] = '';
				}
			}
			
			$instance['taxonomies'] = array(); 
			foreach($new_instance['taxonomies'] as $taxonomies){
				if($taxonomies != ''){
					$instance['taxonomies'][] = $taxonomies;
				}else{
					$instance['taxonomies'][] = '';
				}
			}

			return $instance;
        }

        function form($instance) {

            /* widget form in backend */
            $instance   = wp_parse_args( (array) $instance, array( 'title' => '', 'by_time' =>'', 'nr_posts' => '',  'customPost' => array(),'taxonomy' => array(), 'taxonomies' => array(), 'image' => 'y', 'number' => 'n', 'date' => 'n', 'likes' => 'y', 'views' => 'n', 'comments' => 'y', 'columns' => '' ) );
            $title      = strip_tags( $instance['title'] );
			$nr_posts   = strip_tags( $instance['nr_posts'] );
			$by_time    = strip_tags( $instance['by_time'] );
			
			$custompost = (isset($instance['customPost'])) ? $instance['customPost'] : array();
			$taxonomy   = (isset($instance['taxonomy'])) ? $instance['taxonomy'] : array();
			$taxonomies = (isset($instance['taxonomies'])) ? $instance['taxonomies'] : array();		
			$number = (isset($instance['number']) && ($instance['number'] == 'y' || $instance['number'] == 'n')) ? $instance['number'] : 'n';		
			$image = (isset($instance['image']) && ($instance['image'] == 'y' || $instance['image'] == 'n')) ? $instance['image'] : 'y';		
			$date = (isset($instance['date']) && ($instance['date'] == 'y' || $instance['date'] == 'n')) ? $instance['date'] : 'n';		
			$likes = (isset($instance['likes']) && ($instance['likes'] == 'y' || $instance['likes'] == 'n')) ? $instance['likes'] : 'y';		
			$views = (isset($instance['views']) && ($instance['views'] == 'y' || $instance['views'] == 'n')) ? $instance['views'] : 'n';		
			$comments = (isset($instance['comments']) && ($instance['comments'] == 'y' || $instance['comments'] == 'n')) ? $instance['comments'] : 'y';		
			$columns    = (isset($instance['columns']) && ($instance['columns'] === '1' || $instance['columns'] === '2')) ? $instance['columns'] : '1';

			$args = array('exclude_from_search' => false);
			$post_types = array('video', 'post', 'ts-gallery');
			
    ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','shootback') ?>:
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Show image','shootback') ?>:
                	<select name="<?php echo $this->get_field_name('image'); ?>">
                		<option <?php selected($image, 'y', true); ?> value="y"><?php _e('Yes', 'shootback'); ?></option>
                		<option <?php selected($image, 'n', true); ?> value="n"><?php _e('No', 'shootback'); ?></option>
                	</select>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Show numbers','shootback') ?>:
                	<select name="<?php echo $this->get_field_name('number'); ?>">
                		<option <?php selected($number, 'y', true); ?> value="y"><?php _e('Yes', 'shootback'); ?></option>
                		<option <?php selected($number, 'n', true); ?> value="n"><?php _e('No', 'shootback'); ?></option>
                	</select>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('date'); ?>"><?php _e('Show date','shootback') ?>:
                	<select name="<?php echo $this->get_field_name('date'); ?>">
                		<option <?php selected($date, 'y', true); ?> value="y"><?php _e('Yes', 'shootback'); ?></option>
                		<option <?php selected($date, 'n', true); ?> value="n"><?php _e('No', 'shootback'); ?></option>
                	</select>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('likes'); ?>"><?php _e('Show likes','shootback') ?>:
                	<select name="<?php echo $this->get_field_name('likes'); ?>">
                		<option <?php selected($likes, 'y', true); ?> value="y"><?php _e('Yes', 'shootback'); ?></option>
                		<option <?php selected($likes, 'n', true); ?> value="n"><?php _e('No', 'shootback'); ?></option>
                	</select>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('views'); ?>"><?php _e('Show views','shootback') ?>:
                	<select name="<?php echo $this->get_field_name('views'); ?>">
                		<option <?php selected($views, 'y', true); ?> value="y"><?php _e('Yes', 'shootback'); ?></option>
                		<option <?php selected($views, 'n', true); ?> value="n"><?php _e('No', 'shootback'); ?></option>
                	</select>
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('comments'); ?>"><?php _e('Show comments','shootback') ?>:
                	<select name="<?php echo $this->get_field_name('comments'); ?>">
                		<option <?php selected($comments, 'y', true); ?> value="y"><?php _e('Yes', 'shootback'); ?></option>
                		<option <?php selected($comments, 'n', true); ?> value="n"><?php _e('No', 'shootback'); ?></option>
                	</select>
                </label>
            </p>
			
			<div class="c_post">
			<?php if(sizeof($custompost)){ $counter = 0;
					foreach($custompost as $c_p){ ?>
			<div>
				<p>
					<label ><?php _e('Select post type','shootback') ?>: 
						<a href="javascript:void(0)" onclick="jQuery(this).parent().parent().parent().remove();" style="float:right"><?php _e("remove",'shootback'); ?></a>
						<select class="widefat post_type" onchange="get_taxonomy(jQuery(this))" name="<?php echo $this->get_field_name( 'customPost'  ); ?>[]" >
							<option value=''><?php _e('Select item','shootback'); ?></option>	
							<?php foreach($post_types as $custom_post) { ?>
								<option value='<?php echo $custom_post; ?>' <?php if($c_p == $custom_post ){ echo 'selected="selected"'; } ?> ><?php if( $custom_post == 'ts-gallery' ) echo 'gallery'; else echo $custom_post; ?></option>	
							<?php } ?>		 
						</select>
						
					</label>
				</p>
				<?php 
					$custom_posts_taxonomies = array(
							'post' => array('category' => __('Category', 'shootback'), 
											'post_tag' => __('Post tag', 'shootback') ,
										),
							
							'video' => array('videos_categories' => __('Video category','shootback'), 
											 'post_tag' => __('Video tag', 'shootback') ,
										),
							'ts-gallery' => array('gallery_categories' => __('Gallery category','shootback'), 
											 'post_tag' => __('Gallery tag', 'shootback') ,
										),
						);
					
					if(isset($custom_posts_taxonomies[$c_p])){ ?>
					<div class="taxonomy"> 
					<?php 
						if($c_p == 'page'){ ?>	
						<p style="display:none"> 
							<label ><?php _e('Select post taxonomy','shootback') ?>: 
								<select class="widefat" style="display:none" name="<?php  echo $this->get_field_name('taxonomy'); ?>[]" >
									<option value="__"><?php _e('Select taxonomy','shootback') ?></option>
								</select>
							</label>	
						</p>
							
					<?php }else{ ?>		
						<p> 
							<label ><?php _e('Select post taxonomy','shootback') ?>: 
								<select class="widefat " name="<?php  echo $this->get_field_name( 'taxonomy'  ); ?>[]" onchange="javascript:get_terms(jQuery(this))">
									<option value="__"><?php _e('Select taxonomy','shootback') ?></option>
									<?php  
										if(isset($custom_posts_taxonomies[$c_p])){
											foreach ($custom_posts_taxonomies[$c_p] as $key => $value) { ?>
											<option value="<?php echo $key ?>" <?php if ( isset($taxonomy[$counter]) && $key == $taxonomy[$counter]){echo 'selected="selected" '; } ?> ><?php echo $value ?></option>
									<?php			
											}
										}
									?>
									
								</select>	
							</label>
						</p>	
					<?php		
						
						}	
					
					?>
						
					</div>
				<?php } ?>
				<div class="taxonomies">
					<?php
						if( count($taxonomy) > 0 && isset($taxonomy[$counter])  && $taxonomy[$counter] != '__' && $taxonomy[$counter] != -1 ){
							$terms = get_terms($taxonomy[$counter] , array( 'hide_empty' => false ));
						?>
						<p> 
							<label ><?php _e('Select post terms','shootback') ?>: 
								<select class="widefat multiple-select" name="<?php  echo $this->get_field_name( 'taxonomies'  ); ?>[]" multiple>
									<?php foreach($terms as $term) { ?>
										<option value="<?php echo $term->slug; ?>" <?php if(isset($taxonomies[$counter]) && in_array($term->slug, $taxonomies) ) { echo 'selected="selected"'; }?> > <?php echo $term->name; ?> </option>
									<?php } ?>
								</select>
							</label>
						</p>
					<?php }else{ ?>
						<input class="hidden" name="<?php echo $this -> get_field_name( 'taxonomies' ); ?>[]" value="-1">
					<?php } ?>
				</div>
			</div>
			<?php 
					$counter++;
				} /*EOF foreach*/
			
			}else{ ?>
				<div>
					<p>
						<label ><?php _e("Select post type",'shootback') ?>:
							<a href="javascript:void(0)" onclick="jQuery(this).parent().parent().parent().remove();" style="float:right"><?php _e("remove",'shootback'); ?></a>
							<select class="widefat post_type" onchange="get_taxonomy(jQuery(this))" name="<?php echo $this->get_field_name( "customPost"  ); ?>[]" >
								<option value=''  ><?php _e("Select item",'shootback'); ?></option>
							<?php foreach($post_types as $custom_post) {  
							
							?>
								<option value="<?php echo $custom_post; ?>"  ><?php echo $custom_post; ?></option>	
							<?php 
								 /*EOF if*/
							} /*EOF foreach*/ ?>
							</select>
							
						</label>
					</p>
					<div class="taxonomy">
					</div>
					<div class="taxonomies">
					</div>
				</div>
			<?php } /*EOF if*/ ?>
			</div>
			
			<p>
                <label for="<?php echo $this->get_field_id('nr_posts'); ?>"><?php _e( 'Number of posts' , 'shootback' ); ?></label>:
                <input class="widefat digit" id="<?php echo $this->get_field_id('nr_posts'); ?>" name="<?php echo $this->get_field_name('nr_posts'); ?>" type="text" value="<?php echo esc_attr( $nr_posts ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_name('by_time'); ?>"><?php _e( 'Period' , 'shootback' ); ?></label>:
                <select name="<?php echo $this->get_field_name('by_time'); ?>">
                	<option value="t" <?php selected($by_time, 't'); ?>><?php _e( 'All time' , 'shootback' ); ?></option>
                	<option value="m" <?php selected($by_time, 'm'); ?>><?php _e( 'Last month' , 'shootback' ); ?></option>
                	<option value="w" <?php selected($by_time, 'w'); ?>><?php _e( 'Last week' , 'shootback' ); ?></option>
                </select>
            </p>
			 <p>
                <label for="<?php echo $this->get_field_name('columns'); ?>"><?php _e( 'Columns:' , 'shootback' ); ?></label>
                <select name="<?php echo $this->get_field_name('columns'); ?>">
                	<option value="1" <?php selected($columns, '1'); ?>><?php _e( '1 column' , 'shootback' ); ?></option>
                	<option value="2" <?php selected($columns, '2'); ?>><?php _e( '2 columns' , 'shootback' ); ?></option>
                </select>
            </p>	
			<script type="text/javascript">
				function fix__i__( obj ){
					var n = jQuery( obj ).parents( '.widget' ).find( 'input.multi_number' ).val();
					if( n.length && n!='' && n.length > 0 ){
						jQuery( obj ).parents( '.widget-content' ).find( 'select, input, textarea' ).each( function( index, element ) {
							var id = jQuery( element ).attr( 'id' );
							var name = jQuery( element ).attr( 'name' );
							if( id && id.length && id.length > 0 ){
								jQuery( element ).attr( 'id' , id.replace( '__i__' , n ) );
							}
							if( name && name.length && name.length > 0 ){
								jQuery( element ).attr( 'name' , name.replace( '__i__' , n ) );
							}
						});
					}
				}

				function get_taxonomy( obj ) { 
						var  this_widget = '<?php  echo $this->get_field_name( 'taxonomy'  ); ?>[]';
						jQuery.ajax({
							url: ajaxurl,
							data: '&action=get_taxonomies&custom_post_type='+obj.val()+'&this_widget='+this_widget,
							type: 'POST',
							cache: false,
							success: function (data) { 
								obj.parent().parent().parent().find('div.taxonomy').html(data);
								obj.parent().parent().parent().find('div.taxonomies').html('<input class="hidden" name="<?php echo $this -> get_field_name( 'taxonomies' ); ?>[]" value="-1">');
								fix__i__( obj );
							},
							error: function (xhr) {

							}
						});
				}

				function get_terms( obj ) {
					var this_widget = '<?php echo $this -> get_field_name( 'taxonomies' ); ?>[]';
					jQuery.ajax({
							url: ajaxurl,
							data: '&action=get_terms&taxonomy='+obj.val()+'&this_widget='+this_widget,
							type: 'POST',
							cache: false,
							success: function (data) { 
								obj.parent().parent().parent().parent().find('div.taxonomies').html(data);
								fix__i__( obj );
							},
							error: function (xhr) {
								
							}
						});
				}
			</script>
    <?php
        }
		
		function get_terms(){
			if( isset( $_POST[ 'taxonomy'] ) && isset( $_POST[ 'this_widget' ] ) && $_POST[ 'taxonomy' ] != '__' && $_POST[ 'taxonomy' ] != -1 ){
				$terms = get_terms( $_POST[ 'taxonomy' ] , array( 'hide_empty' => false ) );
				?>
				<p> 
					<label ><?php _e('Select post terms','shootback') ?>: 
						<select class="widefat multiple-select" name="<?php  echo $_POST[ 'this_widget' ]; ?>" multiple>
							<?php foreach( $terms as $term ) { ?>
								<option value="<?php echo $term->slug; ?>" > <?php echo $term->name; ?> </option>
							<?php } ?>
						</select>
					</label>
				</p>
			<?php
			}else{
			?>
				<input class="hidden" name="<?php echo $_POST[ 'this_widget' ]; ?>" value="-1">
		<?php
			}
			die();
		}

		function get_taxonomies(){

			if( isset($_POST['custom_post_type']) && $_POST['custom_post_type'] !== '' ){

				$custom_posts_taxonomies = array(
					'post' => array('category' => __('Category','shootback'), 
									'post_tag' => __('Post tag','shootback') ,
								),
					
					'video' => array('videos_categories' => __('Video Category','shootback'), 
									 'video_tag' => __('Video tag','shootback') ,
								),

					'ts-gallery' => array('gallery_categories' => __('Gallery category','shootback'), 
									 'post_tag' => __('Gallery tag', 'shootback') ,
								),
				);
				
				if( $_POST['custom_post_type'] !== 'page' && isset($custom_posts_taxonomies[$_POST['custom_post_type']]) ){ ?> 
					<p> 
						<label ><?php _e('Select post taxonomy','shootback') ?>: 
							<select class="widefat " name="<?php  echo $_POST['this_widget']; ?>" onchange="javascript:get_terms(jQuery(this));">
								<option value="__"><?php _e('Select taxonomy','shootback') ?></option>
								<?php  
									if(isset($custom_posts_taxonomies[$_POST['custom_post_type']])){
										foreach ($custom_posts_taxonomies[$_POST['custom_post_type']] as $key => $value) { ?>
											<option value="<?php echo $key ?>"><?php echo $value ?></option>
<?php											
										}
									}
								?>
							</select>	
						</label>
					</p>
			<?php	
				}
			}
			die();		
		}
		
    }
	function register_most_liked_widget() {
	    register_widget( 'widget_most_liked' );
	}
	add_action( 'widgets_init', 'register_most_liked_widget' );

?>