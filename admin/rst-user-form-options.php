<?php

// if direct access
if (!defined('ABSPATH')) {
    exit;
}

// Saving Selected fields data in option table
add_action('admin_init', 'rst_save_user_form_options');

function rst_save_user_form_options(){


    if (isset($_POST['rst_save_btn'])) {

        if(!isset($_POST['rst_user_form_nonce']) || !wp_verify_nonce($_POST['rst_user_form_nonce'], 'rst_user_form_action')) {
            return;
        } else {

            if (isset($_POST['rstoptions'])) {
                update_option('rst_user_fields', array_map('sanitize_text_field', $_POST['rstoptions']));
            }


            if (isset($_POST['rst_user_title'])) {
                update_option('rst_user_title', sanitize_text_field($_POST['rst_user_title']));
            }

            if (isset($_POST['rst_user_name'])) {
                update_option('rst_user_name', sanitize_text_field($_POST['rst_user_name']));
            }

            if (isset($_POST['rst_user_designation'])) {
                update_option('rst_user_designation', sanitize_text_field($_POST['rst_user_designation']));
            }

            if (isset($_POST['rst_user_company_name'])) {
                update_option('rst_user_company_name', sanitize_text_field($_POST['rst_user_company_name']));
            }


            if (isset($_POST['rst_user_company_url'])) {
                update_option('rst_user_company_url', sanitize_text_field($_POST['rst_user_company_url']));
            }

            if (isset($_POST['rst_user_rating'])) {
                update_option('rst_user_rating', sanitize_text_field($_POST['rst_user_rating']));
            }

            if (isset($_POST['rst_user_testi_text'])) {
                update_option('rst_user_testi_text', sanitize_text_field($_POST['rst_user_testi_text']));
            }

            if (isset($_POST['rst_user_categories'])) {
                update_option('rst_user_categories', sanitize_text_field($_POST['rst_user_categories']));
            }


            if (isset($_POST['rst_user_logo_img'])) {
                update_option('rst_user_logo_img', sanitize_text_field($_POST['rst_user_logo_img']));
            }

            if (isset($_POST['rst_user_calculate'])) {
                update_option('rst_user_calculate', sanitize_text_field($_POST['rst_user_calculate']));
            }

            if (isset($_POST['rst_post_status'])) {
                update_option('rst_post_status', sanitize_text_field($_POST['rst_post_status']));
            }

            if (isset($_POST['rst_user_submit_btn_text'])) {
                update_option('rst_user_submit_btn_text', sanitize_text_field($_POST['rst_user_submit_btn_text']));
            }

            if (isset($_POST['rst_save_success_text'])) {
                update_option('rst_save_success_text', sanitize_text_field($_POST['rst_save_success_text']));
            }

            if (isset($_POST['rst_save_error_text'])) {
                update_option('rst_save_error_text', sanitize_text_field($_POST['rst_save_error_text']));
            }

            if (isset($_POST['rst_file_mishmatch_text'])) {
                update_option('rst_file_mishmatch_text', sanitize_text_field($_POST['rst_file_mishmatch_text']));
            }

            if (isset($_POST['rst_calc_error_text'])) {
                update_option('rst_calc_error_text', sanitize_text_field($_POST['rst_calc_error_text']));
            }
        }

    }

}




// Check whether a field is selected or not
function rst_isOptionChecked($value)
{
    $options = get_option('rst_user_fields');
    if (isset($options) && !empty($options) && is_array($options) && in_array($value, $options)) {
        echo esc_attr(" checked ");
    }
}

// Retrive custom fields name
function rst_user_fields_name($field, $default)
{
    $field_name = get_option($field);
    if (isset($field_name) && !empty($field_name)) {
        echo esc_attr($field_name);
    } else {
        echo esc_attr($default);
    }
}

// Retrive custom success and error messages
function rst_user_retrive_messages($field, $default)
{
    $field_name = get_option($field);
    if (isset($field_name) && !empty($field_name)) {
        return $field_name;
    } else {
        return $default;
    }
}


// Add Submenu Page Front end form options
function rst_register_testimonial_user_options()
{
    add_submenu_page('edit.php?post_type=rst_testimonial', esc_attr__('User Form', 'rst-testimonial'), sprintf('<span style="color:#ddd;">%s</span>', esc_attr__('Frontend Submission', 'rst-testimonial')), 'manage_options', 'rst-user-form-options', 'rst_testimonial_user_options_page_layouts');
}

add_action('admin_menu', 'rst_register_testimonial_user_options');


// Callback function for admin_menu hook
function rst_testimonial_user_options_page_layouts()
{
    $rst_post_status = get_option('rst_post_status');

    ?>
    <div class="wrap">
        <h1><?php esc_attr_e('Testimonial Submission Form :', 'rst-testimonial'); ?></h1>
        <p><?php esc_attr_e('From the list below select and give the name of the field you want to show as input fields to the front end
            users to submit testimonials.', 'rst-testimonial') ?></p>
        <p>
        <p><?php esc_attr_e('To display a form with fields selected here, just copy and paste this', 'rst-testimonial') ?> <input
                    onClick="this.select(); execCommand('copy');" type="text" name="" readonly
                    value="[rst_frontend_form]"> <?php esc_attr_e('shortcode in a page or post. User will then see a form in frontend to
            submit their testimonial in that page or post.', 'rst-testimonial') ?></p>
        </p>

        <h3 style="color:red;"><?php esc_attr_e('Available Only Premium Version:', 'rst-testimonial'); ?></h3>
        <form method="post" action="">
            <?php wp_nonce_field('rst_user_form_action', 'rst_user_form_nonce'); ?>

            <table>
                <tr>
                    <td>
                        <input type="checkbox" id="rst_user_title" name="rstoptions[]"
                               value="Title" <?php rst_isOptionChecked('Title'); ?>>
                        <label for="rst_user_title"><?php esc_attr_e('Title', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_title"
                               value="<?php rst_user_fields_name('rst_user_title', 'We love to hear from our customers'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" id="rst_user_name" name="rstoptions[]"
                               value="Name" <?php rst_isOptionChecked('Name'); ?>>
                        <label for="rst_user_name"><?php esc_attr_e('Name', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_name"
                               value="<?php rst_user_fields_name('rst_user_name', 'Name'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_designation" type="checkbox" name="rstoptions[]"
                               value="Designation" <?php rst_isOptionChecked('Designation'); ?>>
                        <label for="rst_user_designation"><?php esc_attr_e('Designation', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_designation"
                               value="<?php rst_user_fields_name('rst_user_designation', 'Designation'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_company_name" type="checkbox" name="rstoptions[]"
                               value="Company Name" <?php rst_isOptionChecked('Company Name'); ?>>
                        <label for="rst_user_company_name"><?php esc_attr_e('Company Name', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_company_name"
                               value="<?php rst_user_fields_name('rst_user_company_name', 'Company Name'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_company_url" type="checkbox" name="rstoptions[]"
                               value="Company URL" <?php rst_isOptionChecked('Company URL'); ?>>
                        <label for="rst_user_company_url"><?php esc_attr_e('Company URL', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_company_url"
                               value="<?php rst_user_fields_name('rst_user_company_url', 'Company URL'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_rating" type="checkbox" name="rstoptions[]"
                               value="Rating" <?php rst_isOptionChecked('Rating'); ?>>
                        <label for="rst_user_rating"><?php esc_attr_e('Rating', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_rating"
                               value="<?php rst_user_fields_name('rst_user_rating', 'Rating'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_testi_text" type="checkbox" name="rstoptions[]"
                               value="Testimonial Message" <?php rst_isOptionChecked('Testimonial Message'); ?>>
                        <label for="rst_user_testi_text"><?php esc_attr_e('Testimonial Message', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_testi_text"
                               value="<?php rst_user_fields_name('rst_user_testi_text', 'Testimonial Message'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_categories" type="checkbox" name="rstoptions[]"
                               value="Categories" <?php rst_isOptionChecked('Categories'); ?>>
                        <label for="rst_user_categories"><?php esc_attr_e('Categories', 'rst-testimonial'); ?></label>
                    </td>
                    <td><input type="text" name="rst_user_categories"
                               value="<?php rst_user_fields_name('rst_user_categories', 'Categories'); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_logo_img" type="checkbox" name="rstoptions[]"
                               value="User's Image/Logo" <?php rst_isOptionChecked("User's Image/Logo"); ?>>
                        <label for="rst_user_logo_img"><?php esc_attr_e('User\'s Image/Logo', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_logo_img"
                               value="<?php rst_user_fields_name('rst_user_logo_img', "User's Image/Logo"); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="rst_user_calculate" type="checkbox" name="rstoptions[]"
                               value="Calculate" <?php rst_isOptionChecked("Calculate"); ?>>
                        <label for="rst_user_calculate"><?php esc_attr_e('User\'s Captcha', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="rst_user_calculate"
                               value="<?php rst_user_fields_name('rst_user_calculate', "Calculate"); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_post_status"><?php esc_attr_e('Select post status', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <select id="rst_post_status" name="rst_post_status">
                            <option value="draft" <?php if (isset($rst_post_status) && $rst_post_status == 'draft') echo esc_attr('selected');?>>
                                <?php esc_attr_e('Draft', 'rst-testimonial')  ?>
                            </option>
                            <option value="pending" <?php if (isset($rst_post_status) && $rst_post_status == 'pending') echo esc_attr('selected'); ?>>
                                <?php esc_attr_e('Pending', 'rst-testimonial')  ?>
                            </option>
                            <option value="publish" <?php if (isset($rst_post_status) && $rst_post_status == 'publish') echo esc_attr('selected'); ?>>
                                <?php esc_attr_e('Publish', 'rst-testimonial')  ?>
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_user_submit_btn_text"><?php esc_attr_e('Submit button text', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <input id="rst_user_submit_btn_text" type="text" name="rst_user_submit_btn_text"
                               value="<?php rst_user_fields_name('rst_user_submit_btn_text', "Submit Testimonial"); ?>">
                    </td>
                </tr>
            </table>
            <h3> <?php esc_attr_e('Testimonial Error and success messages for public users', 'rst-testimonial'); ?></h3>
            <table>
                <tr>
                    <td>
                        <label for="rst_save_success_text"><?php esc_attr_e('Data saved success message', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <textarea id="rst_save_success_text" rows="4" cols="50"
                                  name="rst_save_success_text"><?php echo esc_attr(rst_user_retrive_messages('rst_save_success_text', __('Thank you for your valuable comments. Stay with us.', 'rst-testimonial'))); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_save_error_text"><?php esc_attr_e('Data saved error message', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <textarea id="rst_save_error_text" rows="4" cols="50"
                                  name="rst_save_error_text"><?php echo esc_attr(rst_user_retrive_messages('rst_save_error_text', __('Please fill-up all the info again.','rst-testimonial'))); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_file_mishmatch_text"><?php esc_attr_e('File type mishmatch message', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <textarea id="rst_file_mishmatch_text" rows="4" cols="50"
                                  name="rst_file_mishmatch_text"><?php echo esc_attr(rst_user_retrive_messages('rst_file_mishmatch_text', __('Only jpg, png and jpeg is accepted. Please try again.', 'rst-testimonial'))); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="rst_calc_error_text"><?php esc_attr_e('Calculation error message', 'rst-testimonial'); ?></label>
                    </td>
                    <td>
                        <textarea id="rst_calc_error_text" rows="4" cols="50"
                                  name="rst_calc_error_text"><?php echo esc_attr(rst_user_retrive_messages('rst_calc_error_text', __('Calculation is incorrect. Please try again.', 'rst-testimonial'))); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="button button-primary" name="rst_save_btn" value="Save Changes">
                    </td>
                </tr>
            </table>
        </form>
    </div>
<?php }


function rst_frontend_form_callback()
{
    ob_start();
    include (__DIR__ . '/rst-frontend-form.php');
    return ob_get_clean();
}

add_shortcode('rst_frontend_form', 'rst_frontend_form_callback');