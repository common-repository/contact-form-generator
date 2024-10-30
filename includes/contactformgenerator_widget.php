<?php
// no direct access!
defined('ABSPATH') or die("No direct access");

global $wpcfg_token;
global $wpcfg_field_index;
global $wpcfg_section_width;
global $wpcfg_section_id;
global $wpcfg_heading_text_font_effect;

class contactformgenerator_widget extends WP_Widget {

  // Constructor //
  function __construct() {
    $widget_ops = array(
      'classname' => 'contactformgenerator_widget',
      'description' => 'Add Contact Form Generator widget.'
    ); // Widget Settings
    $control_ops = array('id_base' => 'contactformgenerator_widget'); // Widget Control Settings
    // $this->WP_Widget('contactformgenerator_widget', 'Contact Form Generator', $widget_ops, $control_ops); // Create the widget
    WP_Widget::__construct('contactformgenerator_widget', 'Contact Form Generator', $widget_ops, $control_ops); // Create the widget
  }

  // Extract Args
  function widget($args, $instance) {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    // Before widget
    echo $before_widget;
    // Title of widget
    if ($title) {
      echo $before_title . $title . $after_title;
    }
    // the widget content
    global $wpcfg_token;
    global $wpcfg_field_index;
    global $wpcfg_section_width;
    global $wpcfg_section_id;
    global $wpcfg_heading_text_font_effect;
    if($wpcfg_token == '') {
	    $wpcfg_token = bin2hex(random_bytes(32));
		  $_SESSION['contactformgenerator_token'] = $wpcfg_token;
    }
	
    wpcfg_enqueue_front_scripts($instance['form_id']);
    echo $cfg_rendered_content = wpcfg_render_html($instance['form_id']);
    
    
    // After widget
    echo $after_widget;
  }

  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['title'] = $new_instance['title'];
    $instance['form_id'] = $new_instance['form_id'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $defaults = array(
      'title' => '',
      'form_id' => 0
    );
    $instance = wp_parse_args((array)$instance, $defaults);
    global $wpdb; ?>
  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
           name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>"/>
    <label for="<?php echo $this->get_field_id('form_id'); ?>">Select a form:</label>
    <select name="<?php echo $this->get_field_name('form_id'); ?>'" id="<?php echo $this->get_field_id('form_id'); ?>"
            style="width:225px;text-align:center;">
      <option style="text-align:center" value="0">- Select a Form -</option>
      <?php
      $ids_contactformgenerator = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "cfg_forms order by `id` DESC", 0);
      foreach ($ids_contactformgenerator as $arr_contactformgenerator) {
        ?>
        <option value="<?php echo $arr_contactformgenerator->id; ?>" <?php if ($arr_contactformgenerator->id == $instance['form_id']) {
          echo "SELECTED";
        } ?>><?php echo $arr_contactformgenerator->name; ?></option>
        <?php }?>
    </select>
  <?php
  }
}

function contactformgenerator_register_widget() {
  return register_widget("contactformgenerator_widget");
}
add_action( 'widgets_init', 'contactformgenerator_register_widget' );
?>