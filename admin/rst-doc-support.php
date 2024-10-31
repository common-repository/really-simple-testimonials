<?php

// if direct access
if (!defined('ABSPATH')) {
    exit;
}

//Add Submenu Page

if (!function_exists('rst_testimonials_custom_submenu_page')) {
    function rst_testimonials_custom_submenu_page()
    {
        add_submenu_page('edit.php?post_type=rst_testimonial', esc_attr__('Doc & Support', 'rst-testimonial'), esc_attr__('Doc & Support','rst-testimonial'), 'manage_options', 'rst-support', 'rst_testimonials_custom_shortcode_callback');
    }
}


if (!function_exists('rst_testimonials_custom_shortcode_callback')) {
    function rst_testimonials_custom_shortcode_callback()
    {

        ?>
        <div class="wrap about-wrap full-width-layout">
            <h1><?php esc_attr_e('Welcome to Really Simple Testimonial', 'rst-testimonial'); ?></h1>
            <p id="tp_testimonials_shortcode_para">
            <p class="about-tex">
                <?php esc_attr_e("Thanks for installing our plugin super testimonial. If you have any Question or need any
            helps, please don't hesitate to post it on", 'rst-testimonial'); ?>
                <a href="https://www.themeix.com" target="_blank">
                    <?php esc_attr_e("WordPress.org Support Forum", 'rst-testimonial'); ?></a>
                <?php esc_attr_e("or", 'rst-testimonial'); ?> <a
                        href="https://www.themeix.com"
                        target="_blank"><?php esc_attr_e("Themeix.com Support Forum", 'rst-testimonial'); ?></a>.
            </p>
            <div class="changelog point-releases">
                <h3><?php esc_attr_e("Submit a Review", 'rst-testimonial'); ?></h3>
                <p><?php esc_attr_e("We spend plenty of time to develop a plugin like this and give you freely to make your life easier. If
                you like this plugin, please", 'rst-testimonial'); ?><a style="color:red;"
                                                                        href="https://www.themeix.com"
                                                                        target="_blank"> <?php esc_attr_e("rate it 5 stars", 'rst-testimonial'); ?></a>.
                    <?php esc_attr_e("If you have any problems with the", 'rst-testimonial'); ?>
                    <?php esc_attr_e("plugin, please", 'rst-testimonial'); ?> <a href="https://www.themeix.com"
                                                                         target="_blank"><?php esc_attr_e("let us know", 'rst-testimonial'); ?> </a><?php esc_attr_e("before leaving a review.", 'rst-testimonial'); ?>
                </p>
            </div>
            </p>
            <div class="testimonials_btn_area">
                <a target="_blank" href="https://www.themeix.com"
                   class="testimonials_btn"><?php esc_attr_e("Upgrade", 'rst-testimonial'); ?>
                    Pro</a>
                <a target="_blank" href="https://www.themeix.com"
                   class="testimonials_btn"><?php esc_attr_e("Live Preview", 'rst-testimonial'); ?></a>
                <a target="_blank" href="https://www.themeix.com"
                   class="testimonials_btn"><?php esc_attr_e("Documentation", 'rst-testimonial'); ?></a>
                <a target="_blank" href="https://www.themeix.com"
                   class="testimonials_btn"><?php esc_attr_e("Support", 'rst-testimonial'); ?></a><br/>
            </div>
        </div>
        <?php
    }
}

# Add the submenu page

add_action('admin_menu', 'rst_testimonials_custom_submenu_page');
