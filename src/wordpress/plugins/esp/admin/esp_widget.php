<?php


// Creating the widget
class esp_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(

// Base ID of your widget
            'esp_widget',

// Widget name will appear in UI
            __('Namirial ESP', 'esp_widget_domain'),

// Widget description
            array('description' => __('Esp Button for ', 'esp_widget_domain'),)
        );
    }

// Creating widget front-end

    public function widget($args, $instance)
    {
//        $title = apply filters('widget_title', $instance['title']);
        $client = new esp_client();
        global $wp;
        if(strpos(home_url( $wp->request ), $client->getFinal()) !== false) {
            if(isset($_GET['sessionid']) &&isset($_GET['sessionkey']) ) {
                $userJwt = $client->getUser($_GET['sessionid'], $_GET['sessionkey']);
                foreach ($userJwt as $key=>$value){
//                    echo __($key . $value);
                     echo __('<label for="'. $key .'">'. $key .'</label>
            <input class="widefat" id="'. $key .'"
                   name="'. $key .'" type="text"
                   value="'. $value .'"/>');
                }
            } else {
                echo __('There was an error');
            }
        } else {
            $authnKey = $client->getKey();
            $loginUrl = $client->getLoginUrl($authnKey);
            echo __('<a href="' . $loginUrl . '" class="wp-block-button__link" style="color: white; background-color: #0066cc">Login with SPID</a>', 'wpb_widget_domain');
        }


// before and after widget arguments are defined by themes
//        echo $args['before_widget'];
//        if (!empty($title))
//            echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output

//        echo __('Hello, World!', 'wpb_widget_domain');

//        echo $args['after_widget'];
    }

// Widget Backend
    public function form($instance)
    {

        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Namirial ESP', 'wpb_widget_domain');
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

// Class wpb_widget ends here
}

function esp_load_widget()
{
    register_widget('esp_widget');
}

add_action('widgets_init', 'esp_load_widget');