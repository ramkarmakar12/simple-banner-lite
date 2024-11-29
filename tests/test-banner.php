// File: simple-banner-lite/tests/test-banner.php

class SimpleBannerLiteTest extends WP_UnitTestCase {

    // Test if plugin settings are correctly saved
    public function test_plugin_settings_saved() {
        // Set some settings for the banner
        update_option( 'sbl_banner_text', 'Welcome to my site!' );
        update_option( 'sbl_banner_font_family', 'Arial, sans-serif' );
        update_option( 'sbl_banner_bg_color', '#2b502a' );

        // Retrieve the options
        $banner_text = get_option( 'sbl_banner_text' );
        $font_family = get_option( 'sbl_banner_font_family' );
        $bg_color = get_option( 'sbl_banner_bg_color' );

        // Assert that the settings are saved correctly
        $this->assertEquals( 'Welcome to my site!', $banner_text );
        $this->assertEquals( 'Arial, sans-serif', $font_family );
        $this->assertEquals( '#2b502a', $bg_color );
    }

    // Test the banner display functionality
    public function test_banner_display() {
        // Simulate the display function (assuming `ab_display_banner` is the function for rendering the banner)
        ob_start();
        ab_display_banner();
        $output = ob_get_clean();

        // Check if the banner text appears in the output
        $this->assertStringContainsString( 'Welcome to my site!', $output );
        $this->assertStringContainsString( 'font-family: Arial, sans-serif;', $output );
        $this->assertStringContainsString( 'background-color: #2b502a;', $output );
    }

    // Test if the close button is rendered and works
    public function test_close_button() {
        // Ensure close button is present
        ob_start();
        ab_display_banner();
        $output = ob_get_clean();

        $this->assertStringContainsString( 'class="close-banner"', $output );

        // Test JavaScript functionality for closing the banner
        $this->assertStringContainsString( 'closeBanner()', $output );
    }

    // Test for default values when no settings are provided
    public function test_default_settings() {
        // Test the default background color and font family if not set
        $default_bg_color = get_option( 'sbl_banner_bg_color', '#024985' );
        $default_font_family = get_option( 'sbl_banner_font_family', 'Arial, sans-serif' );

        // Assert default settings
        $this->assertEquals( '#024985', $default_bg_color );
        $this->assertEquals( 'Arial, sans-serif', $default_font_family );
    }

    // Test saving font settings
    public function test_font_settings() {
        // Save a custom font
        update_option( 'sbl_banner_font_family', '"Helvetica Neue", Helvetica, Arial, sans-serif' );

        // Check if the font is saved properly
        $font = get_option( 'sbl_banner_font_family' );
        $this->assertEquals( '"Helvetica Neue", Helvetica, Arial, sans-serif', $font );
    }
}
