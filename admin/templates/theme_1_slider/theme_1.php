<?php

if (!defined('ABSPATH')) {
    exit;
}

if ($rst_testimonial_themes == '1') {

    wp_enqueue_script('rst_theme_1_script_1', plugin_dir_url(__FILE__) . '../common/js/slick.min.js', array('jquery'), time(), true);

    wp_enqueue_style('rst_theme_1_style_1', plugin_dir_url(__FILE__) . '../common/css/slick.css', array(), time(), 'all');
    wp_enqueue_style('rst_theme_1_style_2', plugin_dir_url(__FILE__) . 'assets/css/rst-style-1.css', array(), time(), 'all');

    $args = array(
        'post_type' => 'rst_testimonial',
        'post_status' => 'publish',
        'posts_per_page' => $dpstotoal_items,
        'orderby' => $rst_order_by_option,
    );

    $rst_query_theme_1 = new WP_Query($args);

    if ($rst_query_theme_1->have_posts()) {
        ?>

            <script type="text/javascript">
                (function ($) {
                    jQuery(document).ready(function () {
                        $('.rst_thumb_<?php echo esc_attr($postid); ?>').slick({
                            slidesToShow: 5,
                            slidesToScroll: 1,
                            asNavFor: '.rst_nav_box_<?php echo esc_attr($postid); ?>',
                            dots: false,
                            speed: <?php echo esc_attr($autoplay_speed);?>,
                            arrows: true,
                            prevArrow: $('.rst_prev_<?php echo esc_attr($postid); ?>'),
                            nextArrow: $('.rst_next_<?php echo esc_attr($postid); ?>'),
                            autoplay: <?php echo esc_attr($autoplay); ?>,
                            centerMode: true,
                            infinite: true,
                            focusOnSelect: true,
                            centerPadding: '0px',
                        });

                        $('.rst_nav_box_<?php echo esc_attr($postid); ?>').slick({
                            slidesToShow: 1,
                            arrows: false,
                            dots: false,
                            infinite: true,
                            slidesToScroll: 1,
                            /*fade: true,*/
                            cssEase: 'linear',
                            dots: false,
                            asNavFor: '.rst_thumb_<?php echo esc_attr($postid); ?>'
                        });
                    });
                })(jQuery);
            </script>

        <style type="text/css">

            <?php if($navigation == 'false'){?>
            .rst_<?php echo esc_attr( $postid );?> .rst-arrows {
                display: none !important;
            }
            <?php
            }

            if ($navigation == 'true'){ ?>
            .rst_<?php echo esc_attr( $postid );?> .rst-prev {
                background-color: <?php echo esc_attr($rst_nav_bg_color); ?> !important;

            }

            .rst_<?php echo esc_attr( $postid );?> .rst-prev:hover {
                background-color: <?php echo esc_attr($rst_nav_bg_color_hover); ?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst-next {
                background-color: <?php echo esc_attr($rst_nav_bg_color);?> !important;

            }

            .rst_<?php echo esc_attr( $postid );?> .rst-next:hover {
                background-color: <?php echo esc_attr($rst_nav_bg_color_hover);?> !important;
            }

            <?php

            }
            ?>


            .rst_<?php echo esc_attr( $postid );?> .rst_slider_item_thm_1 {
                border-width: 1px;
                --tw-border-opacity: 1;
                <?php if ($rst_show_item_bg_option == 1) { ?>
                    border-color: <?php echo esc_attr($rst_item_border_color); ?>!important;
                <?php } else {?>
                    border-color: rgba(229, 231, 235, var(--tw-border-opacity));
                <?php }?>
                border-radius: 10px;
                padding: 40px;
                position: relative;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_content {
                display: <?php if($rst_content_show_hide == 2) echo esc_attr('none');?> !important;
                color: <?php echo esc_attr($rst_content_color); ?> !important;
                font-size: <?php echo esc_attr($rst_content_fontsize_option); ?>px !important;
                background-color: <?php echo esc_attr($rst_content_bg_color); ?> !important;
                padding: <?php echo esc_attr($rst_content_padding); ?>px !important;
                text-align: <?php echo esc_attr($rst_testimonial_textalign); ?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_author_name {
                color: <?php echo esc_attr($rst_name_color_option); ?> !important;
                font-size: <?php echo esc_attr($rst_name_fontsize_option); ?>px !important;
                text-transform: <?php echo esc_attr($rst_name_font_case); ?> !important;
                font-style: <?php echo esc_attr($rst_name_font_style); ?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_author_position {
                display: <?php if($rst_designation_show_hide == 2) echo esc_attr('none');?> !important;
                color: <?php echo esc_attr($rst_designation_color_option); ?> !important;
                font-size: <?php echo esc_attr($rst_desig_fontsize_option); ?>px !important;
                text-transform: <?php echo esc_attr($rst_designation_case); ?> !important;
                font-style: <?php echo esc_attr($rst_designation_font_style); ?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_author_company_name a {
                display: <?php if($rst_company_show_hide == 2) echo esc_attr('none');?> !important;
                color: <?php echo esc_attr($rst_company_url_color); ?> !important;
                text-decoration: none !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_author_position_separator {
                display: <?php if($rst_company_show_hide == 2) echo esc_attr('none');?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_author_image {
                display: <?php if($rst_img_show_hide == 2) echo esc_attr('none');?> !important;
                border-radius: <?php echo esc_attr($rst_img_border_radius); ?> !important;
                border-width: <?php echo esc_attr($rst_imgborder_width_option); ?>px !important;
                border-color: <?php echo esc_attr($rst_imgborder_color_option); ?> !important;
                cursor: pointer;
                margin-top: 8px !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_rating svg {
                display: <?php if($rst_show_rating_option == 2) echo esc_attr('none');?> !important;
                fill: <?php echo esc_attr($rst_rating_color); ?> !important;
                width: <?php echo esc_attr($rst_rating_fontsize_option); ?>px !important;
                height: <?php echo esc_attr($rst_rating_fontsize_option); ?>px !important;
            }

        </style>

        <div class="rst_container_thm_1 rst_<?php echo esc_attr($postid); ?>">
            <div class="rst_box_1 rst_item">
                <div class="rst_slider_item_thm_1">
                    <div class="rst_slider_thumbs_thm_1">
                        <div class="rst_thumbs_position_thm_1">
                            <div class="rst_thumb_thm_1 rst_thumb_<?php echo esc_attr($postid); ?>">
                                <?php
                                while ($rst_query_theme_1->have_posts()) {
                                    $rst_query_theme_1->the_post();

                                    $rst_content = get_post_meta(get_the_ID(), 'testimonial_text', true);
                                    $rst_author_position = get_post_meta(get_the_ID(), 'position', true);
                                    $rst_author_company_name = get_post_meta(get_the_ID(), 'company', true);
                                    $rst_author_company_url = get_post_meta(get_the_ID(), 'company_website', true);

                                    $rst_author_name = get_the_title();
                                    $rst_author_rating = get_post_meta(get_the_ID(), 'company_rating_target', true);

                                    $rst_author_image = wp_get_attachment_image(get_post_thumbnail_id(), array('80', '80'), false, array('class' => 'rst_thumbnail_style'));
                                    $rst_author_image2 = wp_get_attachment_image_src(get_post_thumbnail_id(), array(80, 80));


                                    ?>

                                    <div class="rst_thumb_item_thm_1">
                                        <div class="rst-avtar-images rst-transition-all  rst-relative rst-rounded-full rst-inline-block">
                                            <?php if(!empty($rst_author_image2)){ ?>
                                            <img class=" rst-h-10 rst-w-10 rst-rounded-full  rst-border-2 rst-border-white rst_author_image"
                                                 src="<?php echo esc_url($rst_author_image2[0]); ?>" alt="testimonial"/>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <?php
                                }
                                ?>

                            </div>
                            <div class="rst-arrows">
                                <button class="rst-prev rst_prev_<?php echo esc_attr($postid); ?>">
                                        <span class="rst_thm_1_flex">
                                           <svg width="12" height="21" viewBox="0 0 12 21" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                              <path d="M11.9813 3.11569L4.83845 10.2585L11.9813 17.4014L10.5527 20.2585L0.552734 10.2585L10.5527 0.258545L11.9813 3.11569Z" fill="<?php echo esc_attr($rst_nav_text_color); ?>"/>
                                           </svg>
                                        </span>
                                </button>
                                <button class="rst-next rst_next_<?php echo esc_attr($postid); ?>">
                                            <span class="rst_thm_1_flex">
                                               <svg width="12" height="21" viewBox="0 0 12 21" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                  <path d="M0.0191822 3.11569L7.16204 10.2585L0.0191822 17.4014L1.44775 20.2585L11.4478 10.2585L1.44775 0.258545L0.0191822 3.11569Z" fill="<?php echo esc_attr($rst_nav_text_color); ?>"/>
                                               </svg>
                                            </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="rst-nav-box rst_nav_box_<?php echo esc_attr($postid); ?>">
                        <?php
                        while ($rst_query_theme_1->have_posts()) {
                            $rst_query_theme_1->the_post();

                            $rst_content = get_post_meta(get_the_ID(), 'testimonial_text', true);
                            $rst_author_position = get_post_meta(get_the_ID(), 'position', true);
                            $rst_author_company_name = get_post_meta(get_the_ID(), 'company', true);
                            $rst_author_company_url = get_post_meta(get_the_ID(), 'company_website', true);

                            $rst_author_name = get_the_title();
                            $rst_author_rating = get_post_meta(get_the_ID(), 'company_rating_target', true);


                            ?>

                            <div class="slider-item rst-text-center">
                                <h4 class="author-name rst-text-xl rst-font-bold rst-text-coolGray-900 rst_author_name">
                                    <?php if (!empty($rst_author_name)) echo esc_attr($rst_author_name); ?>
                                </h4>
                                <div class="author-rating rst-flex rst-justify-center rst_rating">
                                    <?php if (!empty($rst_author_rating)) {
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rst_author_rating) {
                                                ?>
                                                <svg width="<?php echo esc_attr($rst_rating_fontsize_option); ?>"
                                                     height="<?php echo esc_attr($rst_rating_fontsize_option); ?>"
                                                     viewBox="0 0 17 15"
                                                     fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.6408 5.28193L10.9319 4.59758L8.82693 0.330127C8.76943 0.213287 8.67485 0.118702 8.55801 0.0612089C8.26498 -0.0834504 7.9089 0.037099 7.76238 0.330127L5.6574 4.59758L0.948558 5.28193C0.818736 5.30047 0.700041 5.36167 0.609165 5.45441C0.499301 5.56733 0.438762 5.71924 0.440848 5.87678C0.442935 6.03431 0.507477 6.18457 0.620293 6.29454L4.02721 9.61614L3.22231 14.3064C3.20343 14.4156 3.2155 14.5278 3.25716 14.6304C3.29881 14.733 3.36838 14.8218 3.45797 14.8869C3.54756 14.952 3.65359 14.9906 3.76404 14.9985C3.87448 15.0064 3.98493 14.9831 4.08284 14.9314L8.29466 12.717L12.5065 14.9314C12.6215 14.9926 12.755 15.013 12.883 14.9908C13.2057 14.9352 13.4226 14.6291 13.367 14.3064L12.5621 9.61614L15.969 6.29454C16.0617 6.20367 16.123 6.08497 16.1415 5.95515C16.1916 5.63059 15.9653 5.33015 15.6408 5.28193Z"
                                                          fill="<?php echo esc_attr($rst_rating_color); ?>"/>
                                                </svg>
                                                <?php

                                            } else if ($i == $rst_author_rating + 0.5) {
                                                ?>
                                                <svg width="<?php echo esc_attr($rst_rating_fontsize_option); ?>"
                                                     height="<?php echo esc_attr($rst_rating_fontsize_option); ?>"
                                                     viewBox="0 0 16 15"
                                                     fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.83227 14.0813C2.80658 14.1913 2.80612 14.3057 2.83092 14.4159C2.85573 14.5261 2.90515 14.6293 2.9755 14.7177C3.04584 14.806 3.13527 14.8773 3.2371 14.9262C3.33892 14.9751 3.4505 15.0004 3.56345 15C3.71159 15 3.85641 14.9562 3.97966 14.874L8.06301 12.1518L12.1464 14.874C12.2741 14.9588 12.4247 15.0025 12.578 14.9991C12.7313 14.9958 12.8799 14.9455 13.0038 14.8552C13.1277 14.7649 13.221 14.6388 13.2711 14.4938C13.3212 14.3489 13.3257 14.1921 13.284 14.0446L11.9124 9.24506L15.314 6.18387C15.423 6.08577 15.5008 5.95788 15.5378 5.81603C15.5749 5.67419 15.5695 5.52459 15.5224 5.38575C15.4754 5.24691 15.3886 5.12491 15.2729 5.03485C15.1573 4.94478 15.0177 4.8906 14.8716 4.87899L10.5963 4.53853L8.74619 0.443182C8.68727 0.311279 8.59144 0.199247 8.47025 0.120607C8.34907 0.0419668 8.20772 7.94014e-05 8.06325 1.12773e-07C7.91879 -7.91759e-05 7.77739 0.041653 7.65612 0.12016C7.53485 0.198667 7.43889 0.310594 7.37983 0.442432L5.52976 4.53853L1.25443 4.87824C1.11079 4.88962 0.973461 4.94215 0.858885 5.02953C0.744309 5.11691 0.657334 5.23545 0.608363 5.37097C0.559393 5.50649 0.550503 5.65324 0.582755 5.79368C0.615007 5.93412 0.687036 6.06229 0.790226 6.16287L3.95041 9.24281L2.83227 14.0813ZM8.06301 2.57297L9.59436 5.96339L13.0148 6.23486L10.5618 8.44264L10.561 8.44414L10.2138 8.75611L10.342 9.20382V9.20607L11.2817 12.4945L8.06301 10.349V2.57297Z"
                                                          fill="<?php echo esc_attr($rst_rating_color); ?>"/>
                                                </svg>

                                                <?php
                                            } else {
                                                ?>
                                                <svg width="<?php echo esc_attr($rst_rating_fontsize_option); ?>"
                                                     height="<?php echo esc_attr($rst_rating_fontsize_option); ?>"
                                                     viewBox="0 0 16 15"
                                                     fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.94853 9.24157L2.83125 14.0796C2.79665 14.2261 2.80704 14.3797 2.86105 14.5202C2.91506 14.6607 3.01019 14.7816 3.13402 14.8672C3.25784 14.9528 3.4046 14.9991 3.55512 15C3.70565 15.0009 3.85295 14.9564 3.97778 14.8722L8.06074 12.1503L12.1437 14.8722C12.2714 14.957 12.4221 15.0007 12.5753 14.9973C12.7286 14.994 12.8772 14.9438 13.0011 14.8534C13.125 14.7631 13.2182 14.637 13.2683 14.4921C13.3184 14.3472 13.3229 14.1904 13.2812 14.0429L11.9098 9.24382L15.3111 6.18291C15.42 6.08482 15.4978 5.95695 15.5349 5.81512C15.5719 5.67328 15.5666 5.5237 15.5195 5.38487C15.4724 5.24604 15.3857 5.12406 15.27 5.034C15.1543 4.94394 15.0148 4.88976 14.8687 4.87816L10.5938 4.53773L8.74386 0.442765C8.68487 0.310907 8.58899 0.198939 8.46777 0.120372C8.34656 0.041806 8.20519 0 8.06074 0C7.91629 0 7.77493 0.041806 7.65371 0.120372C7.5325 0.198939 7.43661 0.310907 7.37762 0.442765L5.52773 4.53773L1.2528 4.87741C1.10917 4.88879 0.971859 4.94131 0.857293 5.02868C0.742728 5.11605 0.655761 5.23458 0.606795 5.37009C0.55783 5.50559 0.54894 5.65234 0.581189 5.79276C0.613438 5.93319 0.685461 6.06135 0.788641 6.16191L3.94853 9.24157ZM6.08787 5.9977C6.22172 5.98715 6.35026 5.94079 6.46003 5.86348C6.56979 5.78617 6.65674 5.68075 6.71175 5.55828L8.06074 2.57311L9.40973 5.55828C9.46474 5.68075 9.55169 5.78617 9.66146 5.86348C9.77122 5.94079 9.89977 5.98715 10.0336 5.9977L13.012 6.2339L10.5593 8.44148C10.3463 8.63344 10.2616 8.92888 10.3396 9.20483L11.2791 12.4929L8.47766 10.6251C8.3547 10.5425 8.20996 10.4985 8.06187 10.4985C7.91378 10.4985 7.76903 10.5425 7.64607 10.6251L4.71863 12.5769L5.50598 9.16809C5.53485 9.04271 5.53098 8.91202 5.49473 8.78858C5.45849 8.66513 5.39109 8.55309 5.29902 8.46322L3.02096 6.24215L6.08787 5.9977Z"
                                                          fill="<?php echo esc_attr($rst_rating_color); ?>"/>
                                                </svg>
                                                <?php
                                            } ?>

                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <p class="slider-text rst-mt-4 rst-text-coolGray-600 rst_content">
                                    <?php if (!empty($rst_content)) {
                                        echo esc_attr($rst_content);
                                    } ?>
                                </p>

                            </div>


                            <?php
                        }
                        ?>
                    </div>

                </div>

            </div>
        </div>


        <?php
    }
}
