<?php
/*
Plugin Name: Simple Banner Lite
Description: Adds a customizable announcement banner to your WordPress website.
Version: 1.4
Author: Remo
*/

if (!defined('ABSPATH')) exit; // Prevent direct access

// Enqueue Styles and Scripts
function ab_enqueue_assets() {
    wp_enqueue_style('ab-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script('ab-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', 'ab_enqueue_assets');

// Display the Banner
function ab_display_banner() {
    $options = get_option('announcement_banner_options', []);

    $position = isset($options['position']) ? $options['position'] : 'top';
    $background_color = isset($options['background_color']) ? $options['background_color'] : '#ffeb3b';
    $text_color = isset($options['text_color']) ? $options['text_color'] : '#333';
    $font_family = isset($options['font_family']) ? $options['font_family'] : 'Arial, sans-serif';
    $font_size = isset($options['font_size']) ? $options['font_size'] : '16px';
    $button_color = isset($options['button_color']) ? $options['button_color'] : '#333';
    $button_text_color = isset($options['button_text_color']) ? $options['button_text_color'] : '#fff';
    $button_text = isset($options['button_text']) ? $options['button_text'] : 'Learn More';
    $entry_effect = isset($options['entry_effect']) ? $options['entry_effect'] : 'fade-in';
    $banner_text = isset($options['text']) ? $options['text'] : 'Welcome to our website!';
    $banner_link = isset($options['link']) ? $options['link'] : '#';

    echo '<div class="announcement-banner ' . esc_attr($position) . ' ' . esc_attr($entry_effect) . '" 
            style="background-color: ' . esc_attr($background_color) . '; color: ' . esc_attr($text_color) . '; font-family: ' . esc_attr($font_family) . '; font-size: ' . esc_attr($font_size) . ';">
            <span class="close-banner" onclick="closeBanner()">×</span>
            <p>' . esc_html($banner_text) . '</p>
            <a href="' . esc_url($banner_link) . '" 
                class="banner-button" 
                style="background-color: ' . esc_attr($button_color) . '; color: ' . esc_attr($button_text_color) . ';">
                ' . esc_html($button_text) . '
            </a>
          </div>';
}
add_action('wp_footer', 'ab_display_banner');

// Create Settings Page
function ab_create_settings_page() {
       add_menu_page(
        'Simple Banner Lite Settings',  // Page title
        'Simple Banner Lite',           // Menu title
        'manage_options',               // Capability
        'simple-banner-lite',           // Slug
        'ab_render_settings_page'  // Callback function
    );
}
add_action('admin_menu', 'ab_create_settings_page');

// Render Settings Page
function ab_render_settings_page() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ab_save_settings'])) {
        $options = [
            'position' => sanitize_text_field($_POST['ab_banner_position']),
            'background_color' => sanitize_hex_color($_POST['ab_banner_background_color']),
            'text_color' => sanitize_hex_color($_POST['ab_banner_text_color']),
            'font_family' => sanitize_text_field($_POST['ab_banner_font_family']),
            'font_size' => sanitize_text_field($_POST['ab_banner_font_size']),
            'button_color' => sanitize_hex_color($_POST['ab_banner_button_color']),
            'button_text_color' => sanitize_hex_color($_POST['ab_banner_button_text_color']),
            'button_text' => sanitize_text_field($_POST['ab_banner_button_text']),
            'entry_effect' => sanitize_text_field($_POST['ab_banner_entry_effect']),
            'text' => sanitize_text_field($_POST['ab_banner_text']),
            'link' => esc_url_raw($_POST['ab_banner_link']),
        ];
        update_option('announcement_banner_options', $options);
        echo '<div class="updated"><p>Settings saved!</p></div>';
    }

    $options = get_option('announcement_banner_options', []);
    $position = isset($options['position']) ? $options['position'] : 'top';
    $background_color = isset($options['background_color']) ? $options['background_color'] : '#ffeb3b';
    $text_color = isset($options['text_color']) ? $options['text_color'] : '#333';
    $font_family = isset($options['font_family']) ? $options['font_family'] : 'Arial, sans-serif';
    $font_size = isset($options['font_size']) ? $options['font_size'] : '16px';
    $button_color = isset($options['button_color']) ? $options['button_color'] : '#333';
    $button_text_color = isset($options['button_text_color']) ? $options['button_text_color'] : '#fff';
    $button_text = isset($options['button_text']) ? $options['button_text'] : 'Learn More';
    $entry_effect = isset($options['entry_effect']) ? $options['entry_effect'] : 'fade-in';
    $banner_text = isset($options['text']) ? $options['text'] : '';
    $banner_link = isset($options['link']) ? $options['link'] : '';

    ?>
    <div class="wrap">
        <h1>Simple Banner Lite Settings</h1>
        <form method="post">
            <label for="ab_banner_position">Position:</label>
            <select name="ab_banner_position" id="ab_banner_position">
                <option value="top" <?php selected($position, 'top'); ?>>Top</option>
                <option value="bottom" <?php selected($position, 'bottom'); ?>>Bottom</option>
            </select>
            <br><br>
            <label for="ab_banner_background_color">Background Color:</label>
            <input type="color" name="ab_banner_background_color" id="ab_banner_background_color" value="<?php echo esc_attr($background_color); ?>">
            <br><br>
            <label for="ab_banner_text_color">Text Color:</label>
            <input type="color" name="ab_banner_text_color" id="ab_banner_text_color" value="<?php echo esc_attr($text_color); ?>">
            <br><br>
<label for="ab_banner_font_family">Font Family:</label>
<select name="ab_banner_font_family" id="ab_banner_font_family">
    <?php
    $popular_fonts = [
        'Arial, sans-serif' => 'Arial',
        '"Helvetica Neue", Helvetica, Arial, sans-serif' => 'Helvetica Neue',
        '"Times New Roman", Times, serif' => 'Times New Roman',
        '"Courier New", Courier, monospace' => 'Courier New',
        'Verdana, Geneva, sans-serif' => 'Verdana',
        'Tahoma, Geneva, sans-serif' => 'Tahoma',
        '"Trebuchet MS", Helvetica, sans-serif' => 'Trebuchet MS',
        'Georgia, serif' => 'Georgia',
        '"Comic Sans MS", cursive, sans-serif' => 'Comic Sans MS',
        '"Lucida Sans Unicode", "Lucida Grande", sans-serif' => 'Lucida Sans Unicode',
        '"Palatino Linotype", "Book Antiqua", Palatino, serif' => 'Palatino Linotype',
        '"Gill Sans", "Gill Sans MT", Calibri, sans-serif' => 'Gill Sans',
        '"Roboto", sans-serif' => 'Roboto',
        '"Open Sans", sans-serif' => 'Open Sans',
        '"Lato", sans-serif' => 'Lato',
        '"Montserrat", sans-serif' => 'Montserrat',
    ];

    foreach ($popular_fonts as $value => $name) {
        echo '<option value="' . esc_attr($value) . '" ' . selected($font_family, $value, false) . '>' . esc_html($name) . '</option>';
    }
    ?>
</select>

            <br><br>
            <label for="ab_banner_font_size">Font Size:</label>
            <input type="text" name="ab_banner_font_size" id="ab_banner_font_size" value="<?php echo esc_attr($font_size); ?>" placeholder="e.g., 16px">
            <br><br>
            <label for="ab_banner_button_color">Button Background Color:</label>
            <input type="color" name="ab_banner_button_color" id="ab_banner_button_color" value="<?php echo esc_attr($button_color); ?>">
            <br><br>
            <label for="ab_banner_button_text_color">Button Text Color:</label>
            <input type="color" name="ab_banner_button_text_color" id="ab_banner_button_text_color" value="<?php echo esc_attr($button_text_color); ?>">
            <br><br>
            <label for="ab_banner_button_text">Button Text:</label>
            <input type="text" name="ab_banner_button_text" id="ab_banner_button_text" value="<?php echo esc_attr($button_text); ?>">
            <br><br>
            <label for="ab_banner_entry_effect">Entry Effect:</label>
            <select name="ab_banner_entry_effect" id="ab_banner_entry_effect">
                <option value="fade-in" <?php selected($entry_effect, 'fade-in'); ?>>Fade In</option>
                <option value="slide-in" <?php selected($entry_effect, 'slide-in'); ?>>Slide In</option>
            </select>
            <br><br>
            <label for="ab_banner_text">Banner Text:</label>
            <input type="text" name="ab_banner_text" id="ab_banner_text" value="<?php echo esc_attr($banner_text); ?>" style="width:100%; margin-bottom: 15px;" />
            <label for="ab_banner_link">Button Link:</label>
            <input type="url" name="ab_banner_link" id="ab_banner_link" value="<?php echo esc_attr($banner_link); ?>" style="width:100%; margin-bottom: 15px;" />
            <br><br>
            <input type="submit" name="ab_save_settings" class="button button-primary" value="Save Settings">
        </form>
    </div>
    <?php
}
