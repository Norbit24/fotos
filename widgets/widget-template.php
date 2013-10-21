<?php

// Any Post Widget
class BA_Template_Widget extends WP_Widget {

    
    function BA_Template_Widget() {
        $widget_ops = array('classname' => 'ba-superwidget', 'description' => 'Shows social icons' );
        $this->WP_Widget('BA_Template_Widget', 'SW - Template Widget', $widget_ops);
    }
 
    
    function form($instance) {
        $defaults = array(
            'title' => '',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = esc_attr($instance['title']);

        ?> 

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title</label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <?php
    }
 
    
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
 
    
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
 
        echo $before_widget;
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

        if (!empty($title))
            echo $before_title . $title . $after_title;

       
        printf('<div class="ba-template-widget-wrap"><div class="ba-superwidget-pad">');


        printf('</div></div>');
 
        echo $after_widget;
    }
 
}