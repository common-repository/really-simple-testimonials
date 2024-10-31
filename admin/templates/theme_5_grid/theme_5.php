<?php

if (!defined('ABSPATH')) {
    exit;
}

if ($rst_testimonial_themes == '5') {

    wp_enqueue_style('rst_theme_5_style_1', plugin_dir_url(__FILE__) . 'css/rst_style_5.css', array(), time(), 'all');

    $args = array(
        'post_type' => 'rst_testimonial',
        'post_status' => 'publish',
        'posts_per_page' => $dpstotoal_items,
        'orderby' => $rst_order_by_option,
    );

    $rst_query_theme_5 = new WP_Query($args);


    if ($rst_query_theme_5->have_posts()) {
        ?>

        <style type="text/css">

            .rst_<?php echo esc_attr( $postid );?> .rst_testimonial_item {
            <?php if ($rst_show_item_bg_option == 1) { ?> background-color: <?php echo esc_attr($rst_item_bg_color); ?> !important;
                padding: <?php echo esc_attr($rst_item_padding); ?>px !important;

            <?php } ?>
            }

            .rst_<?php echo esc_attr( $postid );?> .rst-item {
                border-color: <?php echo esc_attr($rst_item_border_color); ?> !important;
                border-radius: <?php echo esc_attr($rst_item_border_radius); ?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_content {
                display: <?php if($rst_content_show_hide == 2) echo esc_attr('none');?> !important;
                color: <?php echo esc_attr($rst_content_color); ?> !important;
                font-size: <?php echo esc_attr($rst_content_fontsize_option); ?>px !important;
                background-color: <?php echo esc_attr($rst_content_bg_color); ?> !important;
                padding: <?php echo esc_attr($rst_content_padding); ?>px !important;
                text-align: <?php echo esc_attr($rst_testimonial_textalign); ?> !important;
                border-radius: <?php echo esc_attr($rst_content_border_radius); ?> !important;
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_content_svg {
                display: <?php if($rst_content_show_hide == 2) echo esc_attr('none');?> !important;
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
                font-size: <?php echo esc_attr($rst_desig_fontsize_option); ?>px !important;
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
            }

            .rst_<?php echo esc_attr( $postid );?> .rst_rating svg {
                display: <?php if($rst_show_rating_option == 2) echo esc_attr('none');?> !important;
                fill: <?php echo esc_attr($rst_rating_color); ?> !important;
                width: <?php echo esc_attr($rst_rating_fontsize_option); ?>px !important;
                height: <?php echo esc_attr($rst_rating_fontsize_option); ?>px !important;
            }

        </style>

        <div class="rst_box_container_thm_5 rst_<?php echo esc_attr($postid); ?>">
            <div class="rst-container">
                <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-6">
                    <?php
                    while ($rst_query_theme_5->have_posts()) {
                        $rst_query_theme_5->the_post();

                        $rst_content = substr(get_post_meta(get_the_ID(), 'testimonial_text', true), 0, 200);
                        $rst_author_position = get_post_meta(get_the_ID(), 'position', true);
                        $rst_author_name = get_the_title();
                        $rst_author_rating = get_post_meta(get_the_ID(), 'company_rating_target', true);
                        $rst_author_image = wp_get_attachment_image_src(get_post_thumbnail_id());
                        $rst_author_company_name = get_post_meta(get_the_ID(), 'company', true);
                        $rst_author_company_url = get_post_meta(get_the_ID(), 'company_website', true);
                        $rst_post_create_date = get_the_date('l F j, Y', get_the_ID());

                        $rst_social_link = get_post_meta(get_the_ID(), 'single_repeater_group', true);


                        ?>
                        <div class="rst-item p-6 bg-gray-50 rounded-md rst_testimonial_item">
                            <div class="rst-description">
                                <p class="font-normal  text-base rst_content">
                                    <?php if (!empty($rst_content)) {
                                        echo esc_attr($rst_content);
                                    } ?>
                                </p>
                            </div>
                            <div class="rst-author-box flex gap-4 mt-6">
                                <div class="flex-col">
                                    <?php if (!empty($rst_author_image)) { ?>
                                        <div class="rst-images min-w-62">
                                            <img class="rst-images h-15 w-15 rounded-full rst_author_image"
                                                 src="<?php echo esc_url($rst_author_image[0]); ?>"
                                                 alt="images">
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="flex-col rst-details">
                                    <h5 class="rst-author-name text-xl font-bold text-coolGray-900 rst_author_name">
                                        <?php if (!empty($rst_author_name)) echo esc_attr($rst_author_name); ?>
                                    </h5>

                                    <h6 class="rst-author-title text-base text-coolGray-600  opacity-60 rst_author_desi_section" >
                                        <span class="rst_author_position"><?php if (!empty($rst_author_position)) echo esc_attr($rst_author_position); ?></span>
                                        <span class="rst_author_position_separator"><?php if ($rst_designation_show_hide == 1 && $rst_company_show_hide == 1) echo esc_attr('-'); ?></span>
                                        <span class="rst_author_company_name"><a target="_blank"
                                                                                 href="<?php if(!empty($rst_author_company_url)) echo esc_url($rst_author_company_url); ?>"><?php if (!empty($rst_author_company_name)) echo esc_attr($rst_author_company_name); ?></a></span>
                                    </h6>
                                    <div class="rst-author-rating rst_rating">
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
                                                              fill="<?php echo $rst_rating_color; ?>"/>
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


                                    <div class="rst-social-link mt-3 rst_author_social_link">
                                        <?php

                                        if (!empty($rst_social_link)) {
                                            foreach ($rst_social_link as $item) {

                                                if ($item['title'] == 'facebook') {
                                                    ?>
                                                    <!--facebook-->
                                                    <div class="flex-col !inline-block mr-1">
                                                        <a href="<?php echo esc_url($item['tdesc']); ?>" target="_blank"
                                                           tabindex="0">
                                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M14.4 0H0.6C0.268125 0 0 0.268125 0 0.6V14.4C0 14.7319 0.268125 15 0.6 15H14.4C14.7319 15 15 14.7319 15 14.4V0.6C15 0.268125 14.7319 0 14.4 0ZM12.6675 4.37813H11.4694C10.53 4.37813 10.3481 4.82437 10.3481 5.48062V6.92625H12.5906L12.2981 9.18937H10.3481V15H8.01V9.19125H6.05438V6.92625H8.01V5.2575C8.01 3.32062 9.19313 2.265 10.9219 2.265C11.7506 2.265 12.4613 2.32688 12.6694 2.355V4.37813H12.6675Z"
                                                                      fill="#395185"></path>
                                                            </svg>
                                                        </a>
                                                    </div>

                                                    <?php
                                                } elseif ($item['title'] == 'twitter') {
                                                    ?>
                                                    <!--twitter-->
                                                    <div class="flex-col !inline-block mr-1">
                                                        <a href="<?php echo esc_url($item['tdesc']); ?>" target="_blank"
                                                           tabindex="0">
                                                            <svg width="19" height="15" viewBox="0 0 19 15" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M18.4575 1.77567C17.7783 2.07682 17.0485 2.28036 16.2825 2.37193C17.0644 1.90328 17.6648 1.16116 17.9475 0.276934C17.2042 0.718028 16.3909 1.02881 15.5429 1.19584C14.8521 0.459922 13.868 0 12.7788 0C10.6875 0 8.99195 1.69549 8.99195 3.78666C8.99195 4.0835 9.02548 4.37247 9.09001 4.64969C5.94287 4.49172 3.15262 2.9842 1.28488 0.693164C0.958995 1.25244 0.772257 1.90299 0.772257 2.59688C0.772257 3.91067 1.44084 5.06967 2.45686 5.74878C1.85551 5.72994 1.2674 5.56753 0.741615 5.27508C0.741399 5.29095 0.741399 5.30681 0.741399 5.32274C0.741399 7.15746 2.04669 8.68798 3.77895 9.03586C3.22132 9.18752 2.63641 9.20971 2.06889 9.10075C2.55073 10.6052 3.94925 11.6999 5.60624 11.7306C4.31025 12.7462 2.67741 13.3516 0.903334 13.3516C0.597632 13.3516 0.296257 13.3336 0 13.2987C1.67581 14.3731 3.66626 15 5.80473 15C12.77 15 16.5788 9.22981 16.5788 4.22582C16.5788 4.06158 16.5752 3.89827 16.5679 3.7359C17.3092 3.19998 17.9491 2.53618 18.4575 1.77567Z"
                                                                      fill="#55ACEE"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php
                                                } elseif ($item['title'] == 'instagram') {
                                                    ?>
                                                    <!--Instragram-->
                                                    <div class="flex-col mr-1 !inline-block">
                                                        <a href="<?php echo esc_url($item['tdesc']); ?>" target="_blank"
                                                           tabindex="0">
                                                            <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M7.95242 3.53593C8.50313 3.53593 9.02025 3.63667 9.5038 3.83815C9.98734 4.03962 10.4104 4.32169 10.7731 4.68435C11.1358 5.04701 11.4178 5.47011 11.6193 5.95366C11.8208 6.43721 11.9215 6.95433 11.9215 7.50504C11.9215 8.05574 11.8208 8.56615 11.6193 9.03627C11.4178 9.50638 11.1358 9.92948 10.7731 10.3056C10.4104 10.6817 9.98734 10.9637 9.5038 11.1518C9.02025 11.3398 8.50313 11.4473 7.95242 11.4741C7.40172 11.501 6.88459 11.3936 6.40104 11.1518C5.9175 10.91 5.50111 10.6279 5.15188 10.3056C4.80266 9.98321 4.52059 9.56011 4.30568 9.03627C4.09077 8.51242 3.98331 8.00201 3.98331 7.50504C3.98331 7.00806 4.09077 6.49093 4.30568 5.95366C4.52059 5.41639 4.80266 4.99328 5.15188 4.68435C5.50111 4.37542 5.9175 4.09335 6.40104 3.83815C6.88459 3.58294 7.40172 3.4822 7.95242 3.53593ZM7.95242 10.0638C8.30165 10.0638 8.63073 9.99664 8.93966 9.86232C9.24859 9.72801 9.52395 9.54668 9.76572 9.31833C10.0075 9.08999 10.1888 8.81464 10.3097 8.49228C10.4306 8.16991 10.4978 7.84083 10.5112 7.50504C10.5246 7.16924 10.4575 6.83345 10.3097 6.49765C10.162 6.16185 9.98063 5.8865 9.76572 5.67159C9.55081 5.45668 9.27546 5.27535 8.93966 5.1276C8.60387 4.97985 8.27479 4.91269 7.95242 4.92612C7.63006 4.93956 7.30098 5.00672 6.96518 5.1276C6.62939 5.24849 6.35403 5.42982 6.13912 5.67159C5.92421 5.91336 5.74288 6.18872 5.59513 6.49765C5.44738 6.80658 5.38023 7.14238 5.39366 7.50504C5.40709 7.8677 5.47425 8.19678 5.59513 8.49228C5.71602 8.78778 5.89735 9.06313 6.13912 9.31833C6.3809 9.57354 6.65625 9.75487 6.96518 9.86232C7.27411 9.96978 7.60319 10.0369 7.95242 10.0638ZM15.3668 3.73741C15.4877 6.24916 15.4877 8.76091 15.3668 11.2727C15.3399 11.7562 15.2258 12.2129 15.0243 12.6427C14.8228 13.0725 14.5609 13.4486 14.2385 13.771C13.9162 14.0934 13.5333 14.362 13.0901 14.5769C12.6468 14.7918 12.1902 14.906 11.7201 14.9194C11.0888 14.9463 10.4642 14.9664 9.84631 14.9799C9.22845 14.9933 8.59715 15 7.95242 15C7.30769 15 6.68311 14.9933 6.07868 14.9799C5.47425 14.9664 4.84295 14.9463 4.18479 14.9194C3.70125 14.8925 3.24456 14.7784 2.81475 14.5769C2.38493 14.3754 2.00884 14.1068 1.68647 13.771C1.36411 13.4352 1.09547 13.0591 0.880561 12.6427C0.665652 12.2263 0.551481 11.7696 0.538049 11.2727C0.430595 8.76091 0.430595 6.24916 0.538049 3.73741C0.564913 3.25386 0.679084 2.79718 0.880561 2.36736C1.08204 1.93754 1.35068 1.55473 1.68647 1.21894C2.02227 0.883143 2.39836 0.621222 2.81475 0.433177C3.23113 0.245131 3.68781 0.13096 4.18479 0.0906649C6.69655 -0.0302216 9.2083 -0.0302216 11.7201 0.0906649C12.2036 0.117529 12.6603 0.231699 13.0901 0.433177C13.5199 0.634654 13.9027 0.896575 14.2385 1.21894C14.5743 1.5413 14.8362 1.92411 15.0243 2.36736C15.2123 2.81061 15.3265 3.26729 15.3668 3.73741ZM13.9565 11.1921C14.0773 8.73405 14.0773 6.26931 13.9565 3.79785C13.943 3.50235 13.8691 3.22028 13.7348 2.95165C13.6005 2.68301 13.4326 2.44124 13.2311 2.22633C13.0297 2.01142 12.7879 1.8368 12.5058 1.70248C12.2237 1.56817 11.9417 1.49429 11.6596 1.48086C11.0417 1.454 10.4239 1.43385 9.80601 1.42042C9.18815 1.40698 8.57029 1.40027 7.95242 1.40027C7.33456 1.40027 6.71669 1.40698 6.09883 1.42042C5.48096 1.43385 4.8631 1.454 4.24524 1.48086C3.94974 1.49429 3.66767 1.56817 3.39903 1.70248C3.13039 1.8368 2.89534 2.01142 2.69386 2.22633C2.49238 2.44124 2.31777 2.68301 2.17002 2.95165C2.02227 3.22028 1.94839 3.50235 1.94839 3.79785C1.82751 6.26931 1.82751 8.74077 1.94839 11.2122C1.96182 11.5077 2.0357 11.7898 2.17002 12.0584C2.30434 12.3271 2.47895 12.5621 2.69386 12.7636C2.90877 12.9651 3.14383 13.1397 3.39903 13.2874C3.65423 13.4352 3.9363 13.5091 4.24524 13.5091C6.71669 13.63 9.18815 13.63 11.6596 13.5091C11.9551 13.4956 12.2372 13.4218 12.5058 13.2874C12.7744 13.1531 13.0162 12.9785 13.2311 12.7636C13.446 12.5487 13.6139 12.3069 13.7348 12.0383C13.8557 11.7696 13.9296 11.4876 13.9565 11.1921ZM11.9215 2.64943C12.1633 2.64943 12.3715 2.73674 12.5461 2.91135C12.7207 3.08596 12.808 3.29416 12.808 3.53593C12.808 3.7777 12.7207 3.9859 12.5461 4.16051C12.3715 4.33512 12.1633 4.42243 11.9215 4.42243C11.6798 4.42243 11.4716 4.33512 11.2969 4.16051C11.1223 3.9859 11.035 3.7777 11.035 3.53593C11.035 3.29416 11.1223 3.08596 11.2969 2.91135C11.4716 2.73674 11.6798 2.64943 11.9215 2.64943Z"
                                                                      fill="url(#paint0_linear_41_53)"></path>
                                                                <defs>
                                                                    <linearGradient id="paint0_linear_41_53"
                                                                                    x1="0.457458"
                                                                                    y1="7.5"
                                                                                    x2="15.4575" y2="7.5"
                                                                                    gradientUnits="userSpaceOnUse">
                                                                        <stop stop-color="#C84E89"></stop>
                                                                        <stop offset="1" stop-color="#F15F79"></stop>
                                                                    </linearGradient>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php
                                                } elseif ($item['title'] == 'linkedin') {
                                                    ?>
                                                    <!--Linkdedin-->
                                                    <div class="flex-col !inline-block">
                                                        <a href="<?php echo esc_url($item['tdesc']); ?>" target="_blank"
                                                           tabindex="0">
                                                            <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M13.2382 12.7809H11.0156V9.30027C11.0156 8.47029 11.0008 7.40183 9.8597 7.40183C8.70212 7.40183 8.52499 8.30617 8.52499 9.23986V12.7807H6.30253V5.6231H8.43611V6.60127H8.46599C8.67951 6.23617 8.98806 5.93582 9.35877 5.73221C9.72949 5.5286 10.1485 5.42935 10.5711 5.44504C12.8238 5.44504 13.2391 6.92675 13.2391 8.85437L13.2382 12.7809ZM3.79472 4.64476C3.0824 4.64488 2.50484 4.0675 2.50472 3.35517C2.50461 2.64285 3.08193 2.06529 3.79425 2.06517C4.50658 2.065 5.08414 2.64238 5.08425 3.3547C5.08432 3.69678 4.94849 4.02486 4.70666 4.26679C4.46483 4.50873 4.1368 4.64468 3.79472 4.64476ZM4.90601 12.781H2.68115V5.6231H4.90595V12.7809L4.90601 12.781ZM14.3462 0.00109171H1.56435C0.960251 -0.00570516 0.464841 0.47822 0.457458 1.08232V13.9175C0.464607 14.5218 0.959958 15.0062 1.56429 14.9999H14.3462C14.9518 15.0074 15.4491 14.523 15.4575 13.9175V1.08133C15.4488 0.476052 14.9515 -0.00781453 14.3462 9.56187e-05"
                                                                      fill="#0A66C2"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            <?php }
                                        } ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>

            </div>
        </div>

        <?php
    }

}