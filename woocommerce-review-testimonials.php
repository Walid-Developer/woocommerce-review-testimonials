<?php
/*
Plugin Name: WooCommerce Review Testimonials
Description: This plugin display WooCommerce product reviews as testimonials.
Version: 1.0
Author: WalidDeveloper.com
Email: hi@WalidDeveloper.com
[woocommerce_testimonials product_id="{product ID} " count="5"]

*/

// Enqueue stylesheet and JavaScript
function wprt_enqueue_scripts() {
    wp_enqueue_style('wprt-styles', plugins_url('style.css', __FILE__));
    wp_enqueue_script('wprt-slider', plugins_url('slider.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'wprt_enqueue_scripts');

// ... (rest of the code remains the same)

// Define the shortcode callback
function wprt_display_testimonials($atts) {
    $atts = shortcode_atts(array(
        'product_id' => '',
        'count' => 5,
    ), $atts);

    $reviews = get_comments(array(
        'post_id' => $atts['product_id'],
		'meta_key' => $atts['rating'], 
        'number' => $atts['count'],
        'status' => 'approve',
    ));

    $output = '<div class="wprt-testimonials">';
    foreach ($reviews as $review) {
        $output .= '<div class="wprt-testimonial">';
        $output .= '<p class="wprt-review-content">' . $review->comment_content . '</p>';
		$output .= '<p class="wprt-review-rating">' . $review->comment_rating . 'Rating: 5/5</p>';
        $output .= '<p class="wprt-review-author">' . $review->comment_author . ' --</p>';
        $output .= '</div>';
    }
    $output .= '</div>';

    return $output;
}
add_shortcode('woocommerce_testimonials', 'wprt_display_testimonials');
