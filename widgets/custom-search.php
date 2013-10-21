<?php

// Social Widget
class Fotos_Custom_Search extends WP_Widget {

    function Fotos_Custom_Search() {
        $widget_ops = array('classname' => 'fotos-custom-search', 'description' => __('Custom search widget with background image support.','fotos'));
        $this->WP_Widget('Fotos_Custom_Search', 'Fotos - Custom Search', $widget_ops);
    }


    function form($instance) {

        $defaults = array(
            'fotos_search_bg' 		=> '',
            'fotos_search_btn'		=> ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $image = esc_attr($instance['fotos_search_bg']);
        $searchbtn = esc_attr($instance['fotos_search_btn']);

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('fotos_search_bg'); ?>">Image</label>
            <input class="widefat" id="<?php echo $this->get_field_id('fotos_search_bg'); ?>" name="<?php echo $this->get_field_name('fotos_search_bg'); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('fotos_search_btn'); ?>">Search Button</label>
            <input class="widefat" id="<?php echo $this->get_field_id('fotos_search_btn'); ?>" name="<?php echo $this->get_field_name('fotos_search_btn'); ?>" type="text" value="<?php echo esc_attr($searchbtn); ?>" />
        </p>
        <?php
    }


    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['fotos_search_bg'] = strip_tags($new_instance['fotos_search_bg']);
        $instance['fotos_search_btn'] = strip_tags($new_instance['fotos_search_btn']);
        return $instance;
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);

        echo $before_widget;

        $getimage = $instance['fotos_search_bg'];
        $getsearchbtn = $instance['fotos_search_btn'];

        $bgimage = $getimage ? sprintf('style="background:url(\'%s\') no-repeat;"',$getimage) : false;

        if (!empty($title))
            echo $before_title . $title . $after_title;

        printf('<div class="fotos-custom-search-widget" %s>',$bgimage);

        	?>
				<form action="/" method="get" class="fotos-custom-search-form">
				    <fieldset>
				        <input type="text" name="s" id="search" placeholder="search" value="<?php the_search_query(); ?>" />
				        <input type="image" alt="Search" src="<?php echo $getsearchbtn;?>" />
				    </fieldset>
				</form>
        	<?php

        printf('</div>');

        echo $after_widget;
    }

}