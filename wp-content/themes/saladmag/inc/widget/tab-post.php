<?php
add_action('widgets_init', 'tab_post_register_widgets');
function tab_post_register_widgets() {
        register_widget('tab_post_posts_widget');
}
class tab_post_posts_widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/

    function __construct() {
        $widget_ops = array(
            'classname' => 'clearfix',
            'description' => __('Display post in tab by select category', 'jelly_text_main')
        );
        parent::__construct('tab-post-widget', __('jellywp: Tab post Widget', 'jelly_text_main'), $widget_ops);
    }

/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/

    function widget($args, $instance) {

        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        if (!$number = absint($instance['number'])){$number = 5;}
        if (!$cats = $instance["cats"]){$cats = '';}
		if (isset($instance['number_offset'])==''){$number_offset = 0;}else{$number_offset = absint($instance['number_offset']);}
		
        echo $before_widget;

        if (!empty($title)) {
            echo $before_title;
            echo $instance["title"];
            echo $after_title;
        }
        ?>        
        <div  id="tabs" class="widget_container">
		 <!--tabs-nav -->
            <ul class="tabs">

            <?php
            if (!empty($cats)) {

                foreach ($cats as $cat_id) {

                    echo '<li class=""><a class="title" href="#category_' . $cat_id . '">' . get_the_category_by_ID($cat_id) . '</a></li>';
                }
			}else {
                echo '<li class=""><a class="title" href="#">';
				_e('No post' ,'jelly_text_main');
				echo '</a></li>';
			}
            ?>

        </ul>
        <!-- end tabs-nav -->
         <div class="tab-container">

            <?php
            if (!empty($cats)) {
                foreach ($cats as $cat_id) {
                    $jellywp_args = array(
                        'showposts' => $number,
                        'category__in' => $cat_id,
						'ignore_sticky_posts' => 1,
						'offset' => $number_offset
                    );

                    $jellywp_widget = null;
                    $jellywp_widget = new WP_Query($jellywp_args);
                    ?>

                    <div id="category_<?php echo $cat_id; ?>" class="tab-content">
                   
                   <ul class="feature-post-list">
                     <?php
                        while ($jellywp_widget->have_posts()) {
                            $jellywp_widget->the_post();
							$post_id = get_the_ID();
							//get all post categories
            			$categories = get_the_category(get_the_ID());
                            ?>
                         
                         <li class="tab-content-class">
<a  href="<?php the_permalink(); ?>" class="feature-image-link" title="<?php the_title_attribute(); ?>">              
<?php if ( has_post_thumbnail()) {the_post_thumbnail('small-feature');}
else{echo '<img class="no_feature_img" src="'.get_template_directory_uri().'/img/feature_img/small-feature.jpg'.'">';} ?>
</a>
  <div class="item-details">
   <h3 class="feature-post-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>
<?php echo jellywp_post_meta(get_the_ID()); ?>
   <?php  if(of_get_option('disable_post_category') !=1){
					if ($categories) {
						echo '<span class="meta-category-small">';
						foreach( $categories as $tag) {
							$tag_link = get_category_link($tag->term_id);
							$titleColor = categorys_title_color($tag->term_id, "category", false);
						 echo '<a class="post-category-color" style="background-color:'.$titleColor.'" href="'.$tag_link.'">'.$tag->name.'</a>';					
						}
						echo "</span>";
						}
			 }?>
<?php echo total_score_post_front(get_the_ID());?>
   </div>
   <div class="clearfix"></div>
   </li>
                         
                            <?php
                        }
                        wp_reset_query();
                        ?>
                    </ul>
                    
                   </div> 
                    <?php
                    wp_reset_query();
                    }}
                	?>
                   

            </div>
            </div>

            <?php
            echo $after_widget;
        }

/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/

        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['cats'] = $new_instance['cats'];
            $instance['number'] = absint($new_instance['number']);
			$instance['number_offset'] = absint($new_instance['number_offset']);
          
            return $instance;
        }

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/

        function form($instance) {
            $title = isset($instance['title']) ? esc_attr($instance['title']) : 'Recent Posts';
            $number = isset($instance['number']) ? absint($instance['number']) : 5;
			$number_offset = isset($instance['number_offset']) ? absint($instance['number_offset']) : 0;
            ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','jelly_text_main'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

            <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'jelly_text_main'); ?></label>
                <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
 <p><label for="<?php echo $this->get_field_id('number_offset'); ?>"><?php _e('Offset posts:', 'jelly_text_main'); ?></label>
            <input id="<?php echo $this->get_field_id('number_offset'); ?>" name="<?php echo $this->get_field_name('number_offset'); ?>" type="text" value="<?php echo $number_offset; ?>" size="3" /></p> 

            <p>
                <label for="<?php echo $this->get_field_id('cats'); ?>"><?php _e('Select categories to include in the recent posts list:', 'jelly_text_main'); ?> 

                    <?php
                    $categories = get_categories('hide_empty=0');
                    echo "<br/>";
                    foreach ($categories as $cat) {
                        $option = '<input type="checkbox" id="' . $this->get_field_id('cats') . '[]" name="' . $this->get_field_name('cats') . '[]"';
                        if (isset($instance['cats'])) {
                            foreach ($instance['cats'] as $cats) {
                                if ($cats == $cat->term_id) {
                                    $option = $option . ' checked="checked"';
                                }
                            }
                        }
                        $option .= ' value="' . $cat->term_id . '" />';
                        $option .= '&nbsp;';
                        $option .= $cat->cat_name;
                        $option .= '<br />';
                        echo $option;
                    }
                    ?>
                </label>
            </p>

            <?php
        }

    }
?>
