<?php

// if direct access
if (!defined('ABSPATH')) {
    exit;
}


# Shortcode for testimonial
if(!function_exists('rst_testimonial_pro_post_query')) {
    function rst_testimonial_pro_post_query($atts, $content = null)
    {

        $atts = shortcode_atts(
            array(
                'id' => "",
            ),
            $atts
        );

        global $post, $paged, $query;

        $postid = $atts['id'];

        $testimonial_cat_name = get_post_meta($postid, 'testimonial_cat_name', true);
        $rst_testimonial_themes = get_post_meta($postid, 'rst_testimonial_themes', true);
        $rst_testimonial_theme_style = get_post_meta($postid, 'rst_testimonial_theme_style', true);
        $rst_order_by_option = get_post_meta($postid, 'rst_order_by_option', true);

        /*-----Text Align--------*/
        $rst_testimonial_textalign = get_post_meta($postid, 'rst_testimonial_textalign', true);

        /*-----------Image----------*/
        $rst_img_show_hide = get_post_meta($postid, 'rst_img_show_hide', true);
        $rst_img_border_radius = get_post_meta($postid, 'rst_img_border_radius', true);
        $rst_imgborder_width_option = get_post_meta($postid, 'rst_imgborder_width_option', true);
        $rst_imgborder_color_option = get_post_meta($postid, 'rst_imgborder_color_option', true);

        /*-----------Name----------*/
        $rst_name_color_option = get_post_meta($postid, 'rst_name_color_option', true);
        $rst_name_fontsize_option = get_post_meta($postid, 'rst_name_fontsize_option', true);
        $rst_name_font_case = get_post_meta($postid, 'rst_name_font_case', true);
        $rst_name_font_style = get_post_meta($postid, 'rst_name_font_style', true);

        /*-----------Designation----------*/
        $rst_designation_show_hide = get_post_meta($postid, 'rst_designation_show_hide', true);
        $rst_desig_fontsize_option = get_post_meta($postid, 'rst_desig_fontsize_option', true);
        $rst_designation_color_option = get_post_meta($postid, 'rst_designation_color_option', true);
        $rst_designation_font_style = get_post_meta($postid, 'rst_designation_font_style', true);
        $rst_designation_case = get_post_meta($postid, 'rst_designation_case', true);

        /*-----------Company----------*/
        $rst_company_show_hide = get_post_meta($postid, 'rst_company_show_hide', true);
        $rst_company_url_color = get_post_meta($postid, 'rst_company_url_color', true);

        /*-----------Content----------*/
        $rst_content_show_hide = get_post_meta($postid, 'rst_content_show_hide', true);
        $rst_content_color = get_post_meta($postid, 'rst_content_color', true);
        $rst_content_fontsize_option = get_post_meta($postid, 'rst_content_fontsize_option', true);
        $rst_content_bg_color = get_post_meta($postid, 'rst_content_bg_color', true);
        $rst_content_padding = get_post_meta($postid, 'rst_content_padding', true);
        $rst_content_border_radius = get_post_meta($postid, 'rst_content_border_radius', true);

        /*-----------Rating----------*/
        $rst_show_rating_option = get_post_meta($postid, 'rst_show_rating_option', true);
        $rst_rating_color = get_post_meta($postid, 'rst_rating_color', true);
        $rst_rating_fontsize_option = get_post_meta($postid, 'rst_rating_fontsize_option', true);

        /*-----------Slider Navigation Button Style----------*/
        $rst_nav_text_color = get_post_meta($postid, 'nav_text_color', true);
        $rst_nav_bg_color = get_post_meta($postid, 'nav_bg_color', true);
        $rst_nav_text_color_hover = get_post_meta($postid, 'nav_text_color_hover', true);
        $rst_nav_bg_color_hover = get_post_meta($postid, 'nav_bg_color_hover', true);


        $navigation_align = get_post_meta($postid, 'navigation_align', true);
        $pagination = get_post_meta($postid, 'pagination', true);
        $pagination_bg_color = get_post_meta($postid, 'pagination_bg_color', true);
        $pagination_align = get_post_meta($postid, 'pagination_align', true);
        $dpstotoal_items = get_post_meta($postid, 'dpstotoal_items', true);

        /*-----------Slider Option----------*/
        $item_no = get_post_meta($postid, 'item_no', true);
        $loop = get_post_meta($postid, 'loop', true);
        $margin = get_post_meta($postid, 'margin', true);
        $navigation = get_post_meta($postid, 'navigation', true);
        $pagination = get_post_meta($postid, 'pagination', true);

        /*--------Slider Autoplay----------*/
        $autoplay = get_post_meta($postid, 'autoplay', true);
        $autoplay_speed = get_post_meta($postid, 'autoplay_speed', true);
        $stop_hover = get_post_meta($postid, 'stop_hover', true);
        $autoplaytimeout = get_post_meta($postid, 'autoplaytimeout', true);
        $itemsdesktop = get_post_meta($postid, 'itemsdesktop', true);
        $itemsdesktopsmall = get_post_meta($postid, 'itemsdesktopsmall', true);
        $itemsmobile = get_post_meta($postid, 'itemsmobile', true);

        $filter_menu_bg_color_active = get_post_meta($postid, 'filter_menu_bg_color_active', true);
        $filter_menu_font_color_hover = get_post_meta($postid, 'filter_menu_font_color_hover', true);
        $nav_text_color_hover = get_post_meta($postid, 'nav_text_color_hover', true);
        $nav_bg_color_hover = get_post_meta($postid, 'nav_bg_color_hover', true);
        $pagination_bg_color_active = get_post_meta($postid, 'pagination_bg_color_active', true);
        $navigation_style = get_post_meta($postid, 'navigation_style', true);
        $pagination_style = get_post_meta($postid, 'pagination_style', true);

        /*Item Settings*/
        $rst_item_bg_color = get_post_meta($postid, 'rst_item_bg_color', true);
        $rst_item_padding = get_post_meta($postid, 'rst_item_padding', true);
        $rst_show_item_bg_option = get_post_meta($postid, 'rst_show_item_bg_option', true);
        $rst_item_border_radius = get_post_meta($postid, 'rst_item_border_radius', true);
        $rst_item_border_color = get_post_meta($postid, 'rst_item_border_color', true);

        /*Dots*/

        $rst_dots = get_post_meta($postid, 'dots', true);
        $rst_dots_active_color = get_post_meta($postid, 'dots_bg_color', true);
        $rst_dots_inactive_color = get_post_meta($postid, 'dots_text_color', true);


        $args = array(
            'taxonomy' => 'rst_testimonial_category',
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => 1,
        );
        $cats = get_categories($args);
        if (!empty($testimonial_cat_name) && !empty($cats)) {
            $rstprocat = array();
            $num = count($testimonial_cat_name);
            for ($j = 0; $j < $num; $j++) {
                array_push($rstprocat, $testimonial_cat_name[$j]);
            }

            $args = array(
                'post_type' => 'rst_shortcode',
                'post_status' => 'publish',
                'posts_per_page' => $dpstotoal_items,
                'orderby' => $rst_order_by_option,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'rst_testimonial_category',
                        'field' => 'id',
                        'terms' => $rstprocat,
                    )
                )
            );
        } else {
            $args = array(
                'post_type' => 'rst_shortcode',
                'post_status' => 'publish',
                'posts_per_page' => $dpstotoal_items,
                'orderby' => $rst_order_by_option,
            );
        }

        $query = new WP_Query($args);
        ob_start();
        switch ($rst_testimonial_themes) {
            case '1':

                include(__DIR__ . '/templates/theme_1_slider/theme_1.php');

                break;

            case '2':

                include(__DIR__ . '/templates/theme_2_slider/theme_2.php');

                break;

            case '3':

                include(__DIR__ . '/templates/theme_3_grid/theme_3.php');

                break;


            case '4':

                include(__DIR__ . '/templates/theme_4_grid/theme_4.php');

                break;

            case '5':

                include(__DIR__ . '/templates/theme_5_grid/theme_5.php');

                break;

        }


        return ob_get_clean();


    }
}
add_shortcode('rstpro', 'rst_testimonial_pro_post_query');