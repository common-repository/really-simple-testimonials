<?php


// if direct access
if (!defined('ABSPATH')) {
    exit;
}

//create custom post type

if (!function_exists('rst_testimonial_init')) {
    function rst_testimonial_init()
    {
        register_post_type('rst_testimonial', array(
            'labels' => array(
                'name' => esc_attr__('Testimonials', 'rst-testimonial'),
                'singular_name' => esc_attr__('Testimonial', 'rst-testimonial'),
                'add_new' => esc_attr__('Add New', 'rst-testimonial'),
                'add_new_item' => esc_attr__('Add New Testimonial', 'rst-testimonial'),
                'edit_item' => esc_attr__('Edit Testimonial', 'rst-testimonial'),
                'new_item' => esc_attr__('New Testimonial', 'rst-testimonial'),
                'view_item' => esc_attr__('View Testimonial', 'rst-testimonial'),
                'search_items' => esc_attr__('Search Testimonials', 'rst-testimonial'),
                'not_found' => esc_attr__('No Testimonials found', 'rst-testimonial'),
                'not_found_in_trash' => esc_attr__('No Testimonials found in Trash', 'rst-testimonial'),
                'parent_item_colon' => esc_attr__('Parent Testimonial:', 'rst-testimonial'),
                'menu_name' => esc_attr__('Testimonials', 'rst-testimonial'),
            ),
            'hierarchical' => false,
            'description' => esc_attr__('Testimonial', 'rst-testimonial'),
            'supports' => array('title', 'editor', 'thumbnail'),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-format-quote',
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post'
        ));
    }
}


add_action('init', 'rst_testimonial_init');


// create custom taxonomy

if (!function_exists('rst_create_testimonial_taxonomies')) {
    function rst_create_testimonial_taxonomies()
    {
        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => esc_attr_x('Testimonial Categories', 'taxonomy general name', 'rst-testimonial'),
            'singular_name' => esc_attr_x('Testimonial Category', 'taxonomy singular name', 'rst-testimonial'),
            'search_items' => esc_attr__('Search Testimonial Categories', 'rst-testimonial'),
            'all_items' => esc_attr__('All Testimonial Categories', 'rst-testimonial'),
            'parent_item' => esc_attr__('Parent Testimonial Category', 'rst-testimonial'),
            'parent_item_colon' => esc_attr__('Parent Testimonial Category:', 'rst-testimonial'),
            'edit_item' => esc_attr__('Edit Testimonial Category', 'rst-testimonial'),
            'update_item' => esc_attr__('Update Testimonial Category', 'rst-testimonial'),
            'add_new_item' => esc_attr__('Add New Testimonial Category', 'rst-testimonial'),
            'new_item_name' => esc_attr__('New Testimonial Category Name', 'rst-testimonial'),
            'menu_name' => esc_attr__('Categories', 'rst-testimonial'),
        );

        register_taxonomy('rst_testimonial_category', array('rst_testimonial'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'rst_testimonial-category'),
        ));

    }
}


add_action('init', 'rst_create_testimonial_taxonomies', 0);


/*----------------------------------------------------------------------
		Columns Declaration Function
	----------------------------------------------------------------------*/

if (!function_exists('rst_testimonial_columns')) {

    function rst_testimonial_columns($columns)
    {

        $order = 'asc';

        if (isset($_GET['order']) && $_GET['order'] == 'asc') {
            $order = 'desc';
        }

        unset($columns['date']);

        return array_merge($columns,
            array(
                "title" => esc_attr__('Name', 'rst-testimonial'),
                "thumbnail" => esc_attr__('Image', 'rst-testimonial'),
                "description" => esc_attr__('Testimonial Description', 'rst-testimonial'),
                "clientratings" => esc_attr__('Rating', 'rst-testimonial'),
                "position" => esc_attr__('Position', 'rst-testimonial'),
                "rstcategories" => esc_attr__('Categories', 'rst-testimonial'),
                "date" => esc_attr__('Date', 'rst-testimonial'),
            )
        );
    }
}
/*----------------------------------------------------------------------
    testimonial Value Function
----------------------------------------------------------------------*/
if (!function_exists('rst_testimonial_columns_display')) {

    function rst_testimonial_columns_display($rst_columns, $post_id)
    {
        global $post;
        $width = (int)80;
        $height = (int)80;
        if ('thumbnail' == $rst_columns) {
            if (has_post_thumbnail($post_id)) {
                $thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
                $thumb = wp_get_attachment_image($thumbnail_id, array($width, $height), true);
                echo wp_kses_post($thumb);
            } else {
                echo esc_attr__('None', 'rst-testimonial');
            }
        }
        if ('position' == $rst_columns) {
            echo esc_attr(get_post_meta($post_id, 'position', true));
        }
        if ('description' == $rst_columns) {
            echo esc_attr(get_post_meta($post_id, 'testimonial_text', true));
        }
        if ('clientratings' == $rst_columns) {
            $rst_author_rating = esc_attr(get_post_meta($post_id, 'company_rating_target', true));
            if (!empty($rst_author_rating)) {

                $rst_ratting = plugin_dir_url(__FILE__) . 'templates/icons/rating.svg';
                $rst_ratting_blank = plugin_dir_url(__FILE__) . 'templates/icons/rating-0.svg';
                $rst_ratting_half = plugin_dir_url(__FILE__) . 'templates/icons/ratting-50.svg';

                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $rst_author_rating) {
                        ?>
                        <img style="height: 21px; width: 21px;" src="<?php echo esc_attr($rst_ratting); ?>"
                             alt="rating">
                        <?php

                    } else if ($i == $rst_author_rating + 0.5) {
                        ?>
                        <img style="height: 21px; width: 21px;" src="<?php echo esc_attr($rst_ratting_half); ?>"
                             alt="rating">
                        <?php
                    } else {
                        ?>
                        <img style="height: 21px; width: 21px;" src="<?php echo esc_attr($rst_ratting_blank); ?>"
                             alt="rating">
                        <?php
                    } ?>

                    <?php
                }
            }

        }
        if ('rstcategories' == $rst_columns) {
            $terms = get_the_terms($post_id, 'rst_testimonial_category');
            $count = count(array($terms));
            if ($terms) {
                $i = 0;
                foreach ($terms as $term) {
                    if ($i + 1 != $count) {
                        echo esc_attr(", ");
                    }
                    echo '<a href="' . admin_url('edit.php?post_type=rst_shortcode&rst_testimonial_category=' . esc_attr($term->slug)) . '">' . esc_attr($term->name) . '</a>';
                    $i++;
                }
            }
        }
    }

}
/*----------------------------------------------------------------------
    Add manage_tmls_posts_columns Filter
----------------------------------------------------------------------*/
add_filter("manage_rst_testimonial_posts_columns", "rst_testimonial_columns");

/*----------------------------------------------------------------------
    Add manage_rst_testimonial_posts_custom_column Action
----------------------------------------------------------------------*/
add_action("manage_rst_testimonial_posts_custom_column", "rst_testimonial_columns_display", 10, 2);


//remove content editor from custom post type

if (!function_exists('rst_remove_editor_from_post_type')) {
    function rst_remove_editor_from_post_type()
    {
        remove_post_type_support('rst_testimonial', 'editor');
        remove_post_type_support('rst_testimonial', 'title');
    }
}

add_action('init', 'rst_remove_editor_from_post_type');


//remove row actions from custom post type
if (!function_exists('rst_remove_row_actions')) {
    function rst_remove_row_actions($actions)
    {
        if (get_post_type() === 'rst_testimonial') {
            unset($actions['view']);
        }
        return $actions;
    }
}


add_filter('post_row_actions', 'rst_remove_row_actions', 10, 1);


// create custom meta box
if (!function_exists('rst_testimonial_meta_box')) {
    function rst_testimonial_meta_box()
    {
        add_meta_box(
            'custom_meta_box', // $id
            esc_attr__('Testimonial Information ', 'rst-testimonial'), // $title
            'rst_testimonials_inner_custom_box', // $callback
            'rst_testimonial', // $page
            'normal', // $context
            'high'); // $priority
    }
}
add_action('add_meta_boxes', 'rst_testimonial_meta_box');

if (!function_exists('rst_testimonials_inner_custom_box')) {
    function rst_testimonials_inner_custom_box($post)
    {

        // nonce field with action
        wp_nonce_field('rst_testimonial_inner_custom_box', 'rst_testimonial_inner_custom_box_nonce');

        ?>

        <!-- Name -->
        <p><label for="title"><strong><?php esc_attr_e('Name:', 'rst-testimonial'); ?></strong></label></p>

        <input type="text" name="post_title" id="title" class="regular-text code"
               value="<?php echo esc_attr(get_post_meta($post->ID, 'name', true)); ?>"/>

        <hr class="horizontalRuler"/>

        <!-- Position -->
        <p><label for="position_input"><strong><?php esc_attr_e('Position:', 'rst-testimonial'); ?></strong></label></p>

        <input type="text" name="position_input" id="position_input" class="regular-text code"
               value="<?php echo esc_attr(get_post_meta($post->ID, 'position', true)); ?>"/>

        <hr class="horizontalRuler"/>

        <!-- Company Name -->
        <p><label for="company_input"><strong><?php esc_attr_e('Company Name:', 'rst-testimonial'); ?></strong></label></p>

        <input type="text" name="company_input" id="company_input" class="regular-text code"
               value="<?php echo esc_attr(get_post_meta($post->ID, 'company', true)); ?>"/>

        <hr class="horizontalRuler"/>

        <!-- Company Website -->
        <p><label for="company_website_input"><strong><?php esc_attr_e('Company URL:', 'rst-testimonial'); ?></strong></label>
        </p>

        <input type="text" name="company_website_input" id="company_website_input" class="regular-text code"
               value="<?php echo esc_url(get_post_meta($post->ID, 'company_website', true)); ?>"/>

        <p><span class="description"><?php esc_attr_e('Example: (www.example.com)', 'rst-testimonial'); ?></span></p>

        <hr class="horizontalRuler"/>

        <!-- Company Link Target -->
        <p>
            <label for="company_link_target_list"><strong><?php esc_attr_e('Link Target:', 'rst-testimonial'); ?></strong></label>
        </p>

        <select id="company_link_target_list" name="company_link_target_list">
            <option value="_blank" <?php if (get_post_meta($post->ID, 'company_link_target', true) == '_blank') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('blank', 'rst-testimonial'); ?></option>
            <option value="_self" <?php if (get_post_meta($post->ID, 'company_link_target', true) == '_self') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('self', 'rst-testimonial'); ?></option>
        </select>

        <hr class="horizontalRuler"/>
        <!-- Rating -->

        <p><label for="company_rating_target_list"><strong><?php esc_attr_e('Rating:', 'rst-testimonial'); ?></strong></label>
        </p>

        <select id="company_rating_target_list" name="company_rating_target_list">
            <option value="5" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '5') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('5 Star', 'rst-testimonial'); ?></option>
            <option value="4.5" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '4.5') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('4.5 Star', 'rst-testimonial'); ?></option>
            <option value="4" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '4') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('4 Star', 'rst-testimonial'); ?></option>
            <option value="3.5" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '3.5') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('3.5 Star', 'rst-testimonial'); ?></option>
            <option value="3" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '3') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('3 Star', 'rst-testimonial'); ?></option>
            <option value="2" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '2') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('2 Star', 'rst-testimonial'); ?></option>
            <option value="1" <?php if (get_post_meta($post->ID, 'company_rating_target', true) == '1') {
                echo esc_attr('selected');
            } ?> ><?php esc_attr_e('1 Star', 'rst-testimonial'); ?></option>
        </select>

        <hr class="horizontalRuler"/>

        <!-- Testimonial Text -->

        <p>
            <label for="testimonial_text_input"><strong><?php esc_attr_e('Testimonial Text:', 'rst-testimonial'); ?></strong></label>
        </p>

        <textarea type="text" name="testimonial_text_input" id="testimonial_text_input" class="regular-text code"
                  rows="5"
                  cols="100"><?php echo esc_attr(get_post_meta($post->ID, 'testimonial_text', true)); ?></textarea>


        <?php
    }

}
/*===============================================
    Save testimonial Options Meta Box Function
=================================================*/

//check if the nonce is set and verify it with action

if (!function_exists('rst_testimonials_save_meta_box')) {

    function rst_testimonials_save_meta_box($post_id)
    {
        //check nonce field  and verify it
        if (!isset($_POST['rst_testimonial_inner_custom_box_nonce']) || !wp_verify_nonce($_POST['rst_testimonial_inner_custom_box_nonce'], 'rst_testimonial_inner_custom_box')) {
            return;
        } else {

            if (isset($_POST['post_title'])) {
                $name = sanitize_text_field($_POST['post_title']);
                update_post_meta($post_id, 'name', $name);
            }

            if (isset($_POST['position_input'])) {
                $position = sanitize_text_field($_POST['position_input']);
                update_post_meta($post_id, 'position', $position);
            }

            if (isset($_POST['company_input'])) {
                $company = sanitize_text_field($_POST['company_input']);
                update_post_meta($post_id, 'company', $company);
            }

            if (isset($_POST['company_website_input'])) {
                $company_website = esc_url_raw($_POST['company_website_input']);
                update_post_meta($post_id, 'company_website', $company_website);
            }

            if (isset($_POST['company_link_target_list'])) {
                $company_link_target = sanitize_text_field($_POST['company_link_target_list']);
                update_post_meta($post_id, 'company_link_target', $company_link_target);
            }

            if (isset($_POST['company_rating_target_list'])) {
                $company_rating_target = sanitize_text_field($_POST['company_rating_target_list']);
                update_post_meta($post_id, 'company_rating_target', $company_rating_target);
            }

            if (isset($_POST['testimonial_text_input'])) {
                $testimonial_text = sanitize_text_field($_POST['testimonial_text_input']);
                update_post_meta($post_id, 'testimonial_text', $testimonial_text);
            }
        }

    }

}
/*----------------------------------------------------------------------
    Save testimonial Options Meta Box Action
----------------------------------------------------------------------*/
add_action('save_post', 'rst_testimonials_save_meta_box');


//Add repeatable fields to testimonial post type

add_action('admin_init', 'rst_single_repeater_meta_boxes');

if (!function_exists('rst_single_repeater_meta_boxes')) {
    function rst_single_repeater_meta_boxes()
    {
        add_meta_box('single-repeater-data',
            esc_attr__('Social Links' , 'rst-testimonial'),
            'rst_single_repeatable_meta_box_callback',
            'rst_testimonial',
            'normal',
            'low');
    }
}


if (!function_exists('rst_single_repeatable_meta_box_callback')) {
    function rst_single_repeatable_meta_box_callback($post)
    {

        $rst_single_repeater_group = get_post_meta($post->ID, 'single_repeater_group', true);
        wp_nonce_field('rst_testimonial_repeaterBox', 'rst_testimonial_repeaterBox_nonce');
        ?>

        <table id="repeatable-fieldset-one" width="100%">
            <tbody>
            <?php
            if ($rst_single_repeater_group) :
                foreach ($rst_single_repeater_group as $field) {
                    ?>
                    <tr>
                        <td>
                            <input type="text" class="rst_repeat_field" name="title[]"
                                   value="<?php if ($field['title'] != '') echo esc_attr($field['title']); ?>"
                                   placeholder="Heading" readonly/>
                        </td>
                        <td><input type="text" class="rst_repeat_field" name="tdesc[]"
                                   value="<?php if ($field['tdesc'] != '') echo esc_url($field['tdesc']); ?>"
                                   placeholder="Link"/></td>
                        <td><a class="button remove-row" href="javascript:void(0);">Remove</a></td>
                    </tr>
                    <?php
                }
            else :
                ?>
                <tr>
                    <td>
                        <select name="title[]" class="rst_repeat_field" id="title[]">
                            <option value=""><?php esc_attr_e('--Select--','rst-testimonial') ?></option>
                            <option value="facebook"><?php esc_attr_e('Facebook','rst-testimonial') ?></option>
                            <option value="twitter"><?php esc_attr_e('Twitter','rst-testimonial') ?></option>
                            <option value="linkedin"><?php esc_attr_e('Linkedin','rst-testimonial') ?></option>
                            <option value="instagram"><?php esc_attr_e('Instagram','rst-testimonial') ?></option>
                        </select>
                    </td>

                    <td><input type="text" class="rst_repeat_field" name="tdesc[]" value="" placeholder="Link"/></td>
                    <td><a class="button  cmb-remove-row-button button-disabled" href="javascript:void(0);">Remove</a>
                    </td>
                </tr>
            <?php endif; ?>
            <tr class="empty-row custom-repeater-text" style="display: none">
                <td>
                    <select name="title[]" class="rst_repeat_field">
                        <option value=""><?php esc_attr_e('--Select--','rst-testimonial') ?></option>
                        <option value="facebook"><?php esc_attr_e('Facebook','rst-testimonial') ?></option>
                        <option value="twitter"><?php esc_attr_e('Twitter','rst-testimonial') ?></option>
                        <option value="linkedin"><?php esc_attr_e('Linkedin','rst-testimonial') ?></option>
                        <option value="instagram"><?php esc_attr_e('Instagram','rst-testimonial') ?></option>
                    </select>
                </td>
                <td><input type="text" class="rst_repeat_field" name="tdesc[]" value="" placeholder="Link"/></td>
                <td><a class="button remove-row" href="javascript:void(0);"><?php esc_attr_e('Remove','rst-testimonial') ?></a></td>
            </tr>

            </tbody>
        </table>
        <p><a id="add-row" class="button" href="#"><?php esc_attr_e('Add another','rst-testimonial') ?></a></p>
        <?php
    }
}
// Save Repeater field values.
add_action('save_post', 'rst_single_repeatable_meta_box_save');


if (!function_exists('rst_single_repeatable_meta_box_save')) {
    function rst_single_repeatable_meta_box_save($post_id)
    {
        if (!isset($_POST['rst_testimonial_repeaterBox_nonce']) || !wp_verify_nonce($_POST['rst_testimonial_repeaterBox_nonce'], 'rst_testimonial_repeaterBox')) {
            return;
        }


        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $old = get_post_meta($post_id, 'single_repeater_group', true);

        $new = array();

        if (isset($_POST['title'])) {
            //sanitize a array
            $titles = array_map('sanitize_text_field', $_POST['title']);
        }

        if (isset($_POST['tdesc'])) {
            //sanitize a array
            $tdescs = array_map('sanitize_text_field', $_POST['tdesc']);
        }


        $count = count($titles);
        for ($i = 0; $i < $count; $i++) {
            if ($titles[$i] != '') {
                $new[$i]['title'] = stripslashes(strip_tags($titles[$i]));
                $new[$i]['tdesc'] = stripslashes($tdescs[$i]);
            }
        }

        if (!empty($new) && $new != $old) {
            update_post_meta($post_id, 'single_repeater_group', $new);
        } elseif (empty($new) && $old) {
            delete_post_meta($post_id, 'single_repeater_group', $old);
        }

    }
}