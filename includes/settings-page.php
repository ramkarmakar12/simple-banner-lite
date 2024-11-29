<?php

function ab_create_settings_page() {
    add_submenu_page(
    'simple-banner-lite',          // Parent slug.
    'Simple Banner Lite Settings', // Page title for the submenu.
    'Settings',                    // Submenu title.
    'manage_options',              // Capability required.
    'simple-banner-lite-settings', // Slug for the submenu URL.
    'ab_render_settings_page'      // Callback function to render the submenu page.
);
}
add_action('admin_menu', 'ab_create_settings_page');

function ab_render_settings_page() {
    if ($_POST['ab_save_settings']) {
        update_option('ab_banner_text', sanitize_text_field($_POST['ab_banner_text']));
        update_option('ab_banner_link', esc_url_raw($_POST['ab_banner_link']));
        echo '<div class="updated"><p>Settings saved!</p></div>';
    }

    $banner_text = get_option('ab_banner_text', 'Welcome to our website!');
    $banner_link = get_option('ab_banner_link', '#');

    ?>
    <div class="wrap">
        <h1>Simple Banner Lite Settings</h1>
        <form method="post">
            <label for="ab_banner_text">Banner Text:</label>
            <input type="text" name="ab_banner_text" id="ab_banner_text" value="<?php echo esc_attr($banner_text); ?>" style="width:100%; margin-bottom: 15px;"/>
            <label for="ab_banner_link">Button Link:</label>
            <input type="url" name="ab_banner_link" id="ab_banner_link" value="<?php echo esc_attr($banner_link); ?>" style="width:100%; margin-bottom: 15px;"/>
            <input type="submit" name="ab_save_settings" class="button button-primary" value="Save Settings">
        </form>
    </div>
    <?php
}
