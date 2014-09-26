<?php

/*
 * Iconic One Customizer - visit Themonic.com
 *
 * @since Iconic One 1.0
 *
 */
function themonic_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'themonic_customize_register' );

/*
 * Loads Theme Customizer preview changes asynchronously.
 *
 * @since Iconic One 1.0
 */
function themonic_customize_preview_js() {
	wp_enqueue_script( 'themonic-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130527', true );
}
add_action( 'customize_preview_init', 'themonic_customize_preview_js' );

// Themonic customizer begins
function themonic_theme_customizer( $wp_customize ) {
	$wp_customize->add_section( 'themonic_logo_section' , array(
		'title'       => __( 'Logo', 'themonic' ),
		'priority'    => 30,
		'description' => 'Upload a logo to replace the default site name and description in the header',
	) );
	$wp_customize->add_setting( 'themonic_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themonic_logo', array(
	    'label'    => __( 'Logo', 'themonic' ),
    	'section'  => 'themonic_logo_section',
    	'settings' => 'themonic_logo',
	) ) );

	//	Footer text area
	class Themonic_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() {
	?>
	<label>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<textarea rows="4" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	</label>
	<?php
		} 
	} # end class def

	$wp_customize->add_section('content' , array(
		'priority'    => 200,
	));
	$wp_customize->add_setting('textarea_copy', array('default' => 'Copyright 2013',));
	$wp_customize->add_control(new Themonic_Textarea_Control($wp_customize, 'textarea_copy', array(
		'label' => 'Footer Copyright',
		'section' => 'content',
		'settings' => 'textarea_copy',
	)));
	$wp_customize->add_section('content' , array(
		'title' => __('Footer','themonic'),
		'priority'    => 300,
	));
	$wp_customize->add_setting('custom_text_right', array('default' => 'Custom Text Right',));
	$wp_customize->add_control(new Themonic_Textarea_Control($wp_customize, 'custom_text_right', array(
		'label' => 'Custom Footer Text Right',
		'section' => 'content',
		'settings' => 'custom_text_right',
	)));

	/* Social media */

	$wp_customize->add_section('sl_content', array(
		'priority'	  => 400,
	));
	$wp_customize->add_setting('iconic_one_social_activate');
	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'iconic_one_social_activate', array(
		'type' => 'checkbox',
		'label' => 'Show social buttons',
		'section' => 'sl_content',
		'settings' => 'iconic_one_social_activate',
	)));

	$wp_customize->add_section('sl_content' , array(
		'priority'    => 500,
	));
	$wp_customize->add_setting('twitter_url', array('default' => '',));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'twitter_url', array(
		'label' => 'Twitter URL',
		'section' => 'sl_content',
		'settings' => 'twitter_url',
	)));

	$wp_customize->add_section('sl_content' , array(
		'priority'    => 600,
	));
	$wp_customize->add_setting('facebook_url', array('default' => '',));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'facebook_url', array(
		'label' => 'Facebook URL',
		'section' => 'sl_content',
		'settings' => 'facebook_url',
	)));

	$wp_customize->add_section('sl_content' , array(
		'priority'    => 700,
	));
	$wp_customize->add_setting('plus_url', array('default' => '',));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'plus_url', array(
		'label' => 'Google Plus URL',
		'section' => 'sl_content',
		'settings' => 'plus_url',
	)));

	/* Customizations by Geoff */
	// LinkedIn
	$wp_customize->add_section('sl_content' , array(
		'priority'	  => 800,
	));
	$wp_customize->add_setting('linkedin_url', array('default' => '',));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'linkedin_url', array(
		'label' => 'LinkedIn URL',
		'section' => 'sl_content',
		'settings' => 'linkedin_url',
	)));

	// YouTube
	$wp_customize->add_section('sl_content' , array(
		'priority'	  => 900,
	));
	$wp_customize->add_setting('yt_url', array('default' => '',));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'yt_url', array(
		'label' => 'YouTube URL',
		'section' => 'sl_content',
		'settings' => 'yt_url',
	)));

	// Stumbleupon
	$wp_customize->add_section('sl_content' , array(
		'priority'    => 1000,
	));
	$wp_customize->add_setting('su_url', array('default' => '',));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'su_url', array(
		'label' => 'StumbleUpon URL',
		'section' => 'sl_content',
		'settings' => 'su_url',
	)));

	// Flickr
	$wp_customize->add_section('sl_content' , array(
		'priority'    => 1100,
	));
	$wp_customize->add_setting('flickr_url', array('default' => '',));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'flickr_url', array(
		'label' => 'Flickr URL',
		'section' => 'sl_content',
		'settings' => 'flickr_url',
	)));

	// Reddit
	$wp_customize->add_section('sl_content' , array(
		'priority'	  => 1200,
	));
	$wp_customize->add_setting('reddit_url', array('default' => '',));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'reddit_url', array(
		'label' => 'Reddit URL',
		'section' => 'sl_content',
		'settings' => 'reddit_url',
	)));

	// RSS URL
	$wp_customize->add_section('sl_content' , array(
		'priority'	  => 1300,
	));
	$wp_customize->add_setting('rss_url', array('default' => '',));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'rss_url', array(
		'label' => 'RSS URL',
		'section' => 'sl_content',
		'settings' => 'rss_url',
	)));


	$wp_customize->add_section('sl_content' , array(
		'title' => __('Social','themonic'),
		'priority'    => 40,
	));

}
add_action('customize_register', 'themonic_theme_customizer');
