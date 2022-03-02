<?php

/**
 * soundboutiques theme functionalities
 *
 * @package soundboutiques
 */
// Constants
define('SOUNDBOUTIQUES_THEME_URI', get_template_directory_uri());
define('SOUNDBOUTIQUES_THEME_VERSION', '1.0.0');
// Add post formats
$support_formats = array('image', 'gallery', 'aside', 'link', 'video', 'audio');
add_theme_support('post-formats', $support_formats);
// Add custom header
add_theme_support('custom-header');
// Add custom background
add_theme_support('custom-background');
// Add theme post thumbnails
add_theme_support('post-thumbnails');
// Main header menu
function soundboutiques_register_nav_menu()
{
    register_nav_menu('primary', 'Header Navigation Menu');
}
add_action('after_setup_theme', 'soundboutiques_register_nav_menu');
// Footer menu 1
function soundboutiques_register_foot_menu_one()
{
    register_nav_menu('foot_one', 'Footer Menu 1');
}
add_action('after_setup_theme', 'soundboutiques_register_foot_menu_one');
// Footer menu 2
function soundboutiques_register_foot_menu_two()
{
    register_nav_menu('foot_two', 'Footer Menu 2');
}
add_action('after_setup_theme', 'soundboutiques_register_foot_menu_two');
// Activate HTML5 features
add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
require 'inc/soundboutiques-enqueue-scripts.php';
require 'mega-menu.php';
require 'inc/soundboutiques-functions.php';
require 'inc/soundboutiques-template-functions.php';
require 'inc/soundboutiques-template-hooks.php';
require 'inc/woocommerce-helpers/woocommerce-helpers.php';
require 'inc/sidebars.php';
require 'inc/post-meta.php';
// Hide admin bar in the frontend
add_filter('show_admin_bar', '__return_false', PHP_INT_MAX);
// Support WC
function soundboutiques_wc_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'soundboutiques_wc_support');
// Add custom class to menus
function add_additional_class_on_li($classes, $item, $args)
{
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
//Exclude pages from WordPress Search
if (!is_admin()) {
    function exclude_wp_pages_from_search($query)
    {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
        return $query;
    }
    // add_filter('pre_get_posts','exclude_wp_pages_from_search');
}
/*
Add custom mp3 uploader in the wc product form
*/
function add_custom_meta_boxes()
{
    add_meta_box(
        'wp_custom_attachment',
        'Custom Attachment',
        'wp_custom_attachment',
        'product',
        'side'
    );
}
add_action('add_meta_boxes', 'add_custom_meta_boxes');
function wp_custom_attachment()
{
    global $post;
    $file_link = get_post_meta($post->ID, 'wp_custom_attachment', true);
    wp_nonce_field('wp_upload_track_for_player', 'wp_custom_attachment_nonce');
    if ($file_link) {
        $html = '<a href="' . $file_link . '" class="track-link-tag" style="margin-bottom: 10px;">View file</a><br>';
        $html .= '<a href="#" id="wp_custom_attachment_button" class="upload-player-track button" style="margin-right: 10px;">Upload track</a>';
        $html .= '<a href="#" class="remove-player-track button">Remove track</a>';
        $html .= '<input class="hidden_track_upload_input" type="hidden" name="wp_custom_attachment" value="' . $file_link . '">';
    } else {
        $html = '<a href="' . $file_link . '" style="display: none;" class="track-link-tag">View file</a>';
        $html .= '<a href="#" id="wp_custom_attachment_button" class="upload-player-track button" style="margin-right: 10px;">Upload track</a>';
        $html .= '<a href="#" class="remove-player-track button" style="display: none;">Remove track</a>';
        $html .= '<input class="hidden_track_upload_input" type="hidden" name="wp_custom_attachment" value="">';
    }
    echo $html;
}
function save_custom_meta_data_form_track_upload($id)
{
    if (isset($_POST['wp_custom_attachment_nonce']) && !wp_verify_nonce($_POST['wp_custom_attachment_nonce'], 'wp_upload_track_for_player')) {
        return $id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $id;
    }
    if (isset($_POST['post_type']) && 'product' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $id)) {
            return $id;
        }
    } else {
        if (!current_user_can('edit_page', $id)) {
            return $id;
        }
    }
    if (isset($_POST['wp_custom_attachment'])) {
        $uploaded_track_src = $_POST['wp_custom_attachment'];
        update_post_meta($id, 'wp_custom_attachment', $uploaded_track_src);
    }
}
add_action('save_post', 'save_custom_meta_data_form_track_upload');
/*
Add slider image metabox in product page
*/
function add_slider_image_upload_metabox()
{
    // Define the custom attachment for pages
    add_meta_box(
        'soundboutiques_add_slider_image',
        'Slider image',
        'soundboutiques_add_slider_image',
        'product',
        'side'
    );
}
// end add_custom_meta_boxes
add_action('add_meta_boxes', 'add_slider_image_upload_metabox');
function soundboutiques_add_slider_image()
{
    global $post;
    $slider_image_link = get_post_meta($post->ID, 'soundboutiques_add_slider_image', true);
    wp_nonce_field('upload_slider_image', 'slider_image_nonce');
    $html = '<p class="description">';
    $html .= 'Upload custom slider image here.';
    $html .= '</p>';
    if ($slider_image_link) {
        $html .= '<img class="slider-image-tag" src="' . $slider_image_link . '" alt="The slider image of this product" style="max-width: 100%;"/>';
        $html .= '<a href="#" id="soundboutiques_add_slider_image_button" class="upload-slider-image button" style="margin-right: 10px;">Upload image</a>';
        $html .= '<a href="#" class="remove-slider-image button">Remove image</a>';
        $html .= '<input class="hidden_upload_input" type="hidden" name="soundboutiques_add_slider_image" value="' . $slider_image_link . '">';
    } else {
        $html .= '<img class="slider-image-tag" src="#" alt="The slider image of this product" style="max-width: 100%; display: none;"/>';
        $html .= '<a href="#" id="soundboutiques_add_slider_image_button" class="upload-slider-image button" style="margin-right: 10px;">Upload image</a>';
        $html .= '<a href="#" class="remove-slider-image button" style="display: none;">Remove image</a>';
        $html .= '<input class="hidden_upload_input" type="hidden" name="soundboutiques_add_slider_image" value="">';
    }
    echo $html;
}
function add_custom_slider_image_save($id)
{
    if (isset($_POST['slider_image_nonce']) && !wp_verify_nonce($_POST['slider_image_nonce'], 'upload_slider_image')) {
        return $id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $id;
    }
    if (isset($_POST['post_type']) && 'product' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $id)) {
            return $id;
        }
    } else {
        if (!current_user_can('edit_page', $id)) {
            return $id;
        }
    }
    if (isset($_POST['soundboutiques_add_slider_image'])) {
        $uploaded_image_src = $_POST['soundboutiques_add_slider_image'];
        update_post_meta($id, 'soundboutiques_add_slider_image', $uploaded_image_src);
    }
}
add_action('save_post', 'add_custom_slider_image_save');
/*
Add waveform image metabox in product page
*/
function add_product_waveform_image_upload_metabox()
{
    // Define the custom attachment for pages
    add_meta_box(
        'soundboutiques_add_waveform_image',
        'Single page waveform image',
        'soundboutiques_add_waveform_image',
        'product',
        'side'
    );
}
// end add_custom_meta_boxes
add_action('add_meta_boxes', 'add_product_waveform_image_upload_metabox');
function soundboutiques_add_waveform_image()
{
    global $post;
    $waveform_image_link = get_post_meta($post->ID, 'soundboutiques_add_waveform_image', true);
    wp_nonce_field('upload_waveform_image', 'product_waveform_image_nonce');
    $html = '<p class="description">';
    $html .= 'Upload waveform image here.';
    $html .= '</p>';
    if ($waveform_image_link) {
        $html .= '<img class="waveform-image-tag" src="' . $waveform_image_link . '" alt="The waveform image of this product" style="max-width: 100%;"/>';
        $html .= '<a href="#" id="soundboutiques_add_waveform_image_button" class="upload-waveform-image button" style="margin-right: 10px;">Upload image</a>';
        $html .= '<a href="#" class="remove-waveform-image button">Remove image</a>';
        $html .= '<input class="hidden_waveform_upload_input" type="hidden" name="soundboutiques_add_waveform_image" value="' . $waveform_image_link . '">';
    } else {
        $html .= '<img class="waveform-image-tag" src="#" alt="The waveform image of this product" style="max-width: 100%; display: none;"/>';
        $html .= '<a href="#" id="soundboutiques_add_waveform_image_button" class="upload-waveform-image button" style="margin-right: 10px;">Upload image</a>';
        $html .= '<a href="#" class="remove-waveform-image button" style="display: none;">Remove image</a>';
        $html .= '<input class="hidden_waveform_upload_input" type="hidden" name="soundboutiques_add_waveform_image" value="">';
    }
    echo $html;
}
function product_waveform_image_save($id)
{
    if (isset($_POST['product_waveform_image_nonce']) && !wp_verify_nonce($_POST['product_waveform_image_nonce'], 'upload_waveform_image')) {
        return $id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $id;
    }
    if (isset($_POST['post_type']) && 'product' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $id)) {
            return $id;
        }
    } else {
        if (!current_user_can('edit_page', $id)) {
            return $id;
        }
    }
    if (isset($_POST['soundboutiques_add_waveform_image'])) {
        $uploaded_image_src = $_POST['soundboutiques_add_waveform_image'];
        update_post_meta($id, 'soundboutiques_add_waveform_image', $uploaded_image_src);
    }
}
add_action('save_post', 'product_waveform_image_save');
/*
Add Youtube embed code metabox in product page
*/
function add_youtube_embed_metabox_in_product_upload()
{
    // Define the custom attachment for pages
    add_meta_box(
        'soundboutiques_add_yt_embed',
        'Add Youtube embed code',
        'soundboutiques_add_yt_embed',
        'product',
        'normal'
    );
} // end add_custom_meta_boxes
add_action('add_meta_boxes', 'add_youtube_embed_metabox_in_product_upload');
function soundboutiques_add_yt_embed()
{
    global $post;
    $yt_embed_code = get_post_meta($post->ID, 'soundboutiques_yt_embed_code', true);
    wp_nonce_field('yt_embed_code_add', 'yt_embed_code_add_nonce');
    $html = '<p class="description">';
    $html .= 'Add Youtube video embed code here.';
    $html .= '</p>';
    if ($yt_embed_code) {
        $html .= '<textarea class="widefat" name="soundboutiques_yt_embed_code">' . $yt_embed_code . '</textarea>';
    } else {
        $html .= '<textarea class="widefat" name="soundboutiques_yt_embed_code"></textarea>';
    }
    echo $html;
}
function add_youtube_embed_metabox_value_to_db($id)
{
    if (isset($_POST['yt_embed_code_add_nonce']) && !wp_verify_nonce($_POST['yt_embed_code_add_nonce'], 'yt_embed_code_add')) {
        return $id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $id;
    }
    if (isset($_POST['post_type']) && 'product' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $id)) {
            return $id;
        }
    } else {
        if (!current_user_can('edit_page', $id)) {
            return $id;
        }
    }
    if (isset($_POST['soundboutiques_yt_embed_code'])) {
        $yt_embed_code_meta_field = $_POST['soundboutiques_yt_embed_code'];
        update_post_meta($id, 'soundboutiques_yt_embed_code', $yt_embed_code_meta_field);
    }
}
add_action('save_post', 'add_youtube_embed_metabox_value_to_db');
/*
Add assets and config for admin metabox and form setup
*/
// Enqueue the thickbox custom script JS
function soundboutiques_load_thickbox_scripts($hook)
{
    if ($GLOBALS['pagenow'] == 'post.php') {
        if (!did_action('wp_enqueue_media')) {
            wp_enqueue_media();
        }
        wp_register_script('soundboutiques-custom-metabox', get_stylesheet_directory_uri() . '/assets/js/custom-uploader.js', array('jquery'));
        wp_enqueue_script('soundboutiques-custom-metabox');
    }
}
add_action('admin_enqueue_scripts', 'soundboutiques_load_thickbox_scripts', 10, 1);
// Add form attr for uploadability
function update_edit_form()
{
    echo ' enctype="multipart/form-data"';
}
add_action('post_edit_form_tag', 'update_edit_form');
// Theme settings page
function custom_settings_page()
{
?>
    <div class="wrap">
        <h1>Custom settings
        </h1>
        <form method="post" action="options.php">
            <?php
            settings_fields("section");
            do_settings_sections("custom-settings");
            submit_button(); ?>
        </form>
    </div>
<?php
}
function add_theme_menu_item()
{
    add_menu_page("Custom settings", "Custom settings", "manage_options", "custom-settings", "custom_settings_page", null, 99);
}
add_action("admin_menu", "add_theme_menu_item");
function display_slider_element()
{
?>
    <input type="text" name="slider_product_ids" id="slider_product_ids" class="regular-text" value="<?php echo get_option('slider_product_ids'); ?>" />
    <p class="description" id="tagline-description">Add product IDs to show up in the banner slider like so: 32, 92, 99
    </p>
<?php
}
function display_banner_element()
{
?>
    <input type="checkbox" name="show_banner" value="1" <?php checked(1, get_option('show_banner'), true); ?> />
<?php
}
function display_template_page_settings_video_url()
{
?>
    <input type="text" name="templates_page_video_url" id="templates_page_video_url" class="regular-text" value="<?php echo get_option('templates_page_video_url'); ?>" placeholder="paste the video ID only, not full URL" />
    <p class="description" id="tagline-description">Add Templates page video link. Paste only the video ID from the URL, not full URL. The string after 'v=PASTE_THIS_PART_ONLY'
    </p>
<?php
}
function display_template_page_settings_bg_image()
{
?>
    <input type="text" name="templates_page_video_background_image_url" id="templates_page_video_background_image_url" class="regular-text" value="<?php echo get_option('templates_page_video_background_image_url'); ?>" placeholder="paste the image URL" />
    <p class="description" id="tagline-description">Add Templates page background image link. Upload the image from 'Media' menu and paste the link here.
    </p>
<?php
}
function display_template_page_banner_title()
{
?>
    <input type="text" name="templates_page_banner_title" id="templates_page_banner_title" class="regular-text" value="<?php echo get_option('templates_page_banner_title'); ?>" placeholder="Template page banner title" />
    <p class="description" id="tagline-description">Add Templates page banner title here.
    </p>
<?php
}
function display_template_page_banner_subtitle()
{
?>
    <input type="text" name="templates_page_banner_subtitle" id="templates_page_banner_subtitle" class="regular-text" value="<?php echo get_option('templates_page_banner_subtitle'); ?>" placeholder="Template page banner subtitle" />
    <p class="description" id="tagline-description">Add Templates page banner subtitle here.
    </p>
<?php
}
function display_footer_about_us_text()
{
?>
    <textarea name="footer_about_us_text" id="footer_about_us_text" rows="8" cols="80" placeholder="Footer about us text">
  <?php echo get_option('footer_about_us_text'); ?>
</textarea>
    <p class="description" id="tagline-description">Add site footer About us text here.
    </p>
<?php
}
function display_theme_settings_fields()
{
    add_settings_section("section", "All Settings", null, "custom-settings");
    add_settings_field("slider_product_ids", "Slider product IDs", "display_slider_element", "custom-settings", "section");
    add_settings_field("show_banner", "Do you want the banner in home page?", "display_banner_element", "custom-settings", "section");
    add_settings_field("templates_page_video_url", "Add templates page video URL here", "display_template_page_settings_video_url", "custom-settings", "section");
    add_settings_field("templates_page_video_background_image_url", "Add templates page video background image URL here", "display_template_page_settings_bg_image", "custom-settings", "section");
    add_settings_field("templates_page_banner_title", "Add templates page banner title", "display_template_page_banner_title", "custom-settings", "section");
    add_settings_field("templates_page_banner_subtitle", "Add templates page banner subtitle", "display_template_page_banner_subtitle", "custom-settings", "section");
    add_settings_field("footer_about_us_text", "Add site footer about us text", "display_footer_about_us_text", "custom-settings", "section");
    register_setting("section", "slider_product_ids");
    register_setting("section", "show_banner");
    register_setting("section", "templates_page_video_url");
    register_setting("section", "templates_page_video_background_image_url");
    register_setting("section", "templates_page_banner_title");
    register_setting("section", "templates_page_banner_subtitle");
    register_setting("section", "footer_about_us_text");
}
add_action("admin_init", "display_theme_settings_fields");
// Attach to the default query and load the searched content to specific template
add_action('pre_get_posts', 'advanced_search_query_from_home');
function advanced_search_query_from_home($query)
{
    if (isset($_REQUEST['search-from-home']) && $_REQUEST['search-from-home'] == 'home-banner-form' && !is_admin() && $query->is_search && $query->is_main_query()) {
        $product_category = $_GET['soundboutiques-product-cat'] != '' ? $_GET['soundboutiques-product-cat'] : '';
        $product_genre = $_GET['soundboutiques-product-attr-genre'] != '' ? $_GET['soundboutiques-product-attr-genre'] : '';
        $query->set('post_type', 'product');
        $query->set('posts_per_page', 16);
        $query->set('product_cat', $product_category);
        $query->set('pa_genre', $product_genre);
    }
}
// Attach to the default query and load the searched content to specific template
add_action('pre_get_posts', 'advanced_search_query_from_archive_page');
function advanced_search_query_from_archive_page($query)
{
    if (isset($_REQUEST['search-from-product-archive']) && $_REQUEST['search-from-product-archive'] == 'product-archive-searchform' && !is_admin() && $query->is_search && $query->is_main_query()) {
        $product_category = $_GET['soundboutiques-product-cat'] != '' ? $_GET['soundboutiques-product-cat'] : '';
        $product_genre = $_GET['soundboutiques-product-attr-genre'] != '' ? $_GET['soundboutiques-product-attr-genre'] : '';
        $query->set('post_type', 'product');
        $query->set('posts_per_page', 16);
        $query->set('product_cat', $product_category);
        $query->set('pa_genre', $product_genre);
    }
}
// add_action('template_include', 'advanced_search_template');
function advanced_search_template($template)
{
    if (isset($_REQUEST['search-from-home']) && $_REQUEST['search-from-home'] == 'home-banner-form' && is_search()) {
        $home_search_template = locate_template('woocommerce/archive-product.php');
        if (!empty($home_search_template)) {
            $template = $home_search_template;
        }
    }
    return $template;
}
/*
* Dokan custom fields
*/
// YOUTUBE EMBED CODE
// Add video embed code
add_action('dokan_new_product_after_product_tags', 'dokan_add_video_embed_code', 10);
function dokan_add_video_embed_code()
{ ?>
    <div class="dokan-form-group">
        <input type="text" class="form-control" name="soundboutiques_yt_embed_code" placeholder="<?php esc_attr_e('Youtube video embed code', 'dokan-lite'); ?>">
    </div>
<?php
}
// Save YT embed code
add_action('dokan_new_product_added', 'save_add_product_meta', 10, 2);
add_action('dokan_product_updated', 'save_add_product_meta', 10, 2);
function save_add_product_meta($product_id, $postdata)
{
    if (!dokan_is_user_seller(get_current_user_id())) {
        return;
    }
    if (!empty($postdata['soundboutiques_yt_embed_code'])) {
        update_post_meta($product_id, 'soundboutiques_yt_embed_code', $postdata['soundboutiques_yt_embed_code']);
    }
}
// SHow value on edit page
add_action('dokan_product_edit_after_product_tags', 'show_on_edit_page', 99, 2);
function show_on_edit_page($post, $post_id)
{
    $soundboutiques_yt_embed_code = get_post_meta($post_id, 'soundboutiques_yt_embed_code', true); ?>
    <div class="dokan-form-group">
        <input type="hidden" name="soundboutiques_yt_embed_code" id="dokan-edit-product-id" value="<?php echo esc_attr($post_id); ?>" />
        <label for="soundboutiques_yt_embed_code" class="form-label">
            <?php esc_html_e('Product Code', 'dokan-lite'); ?>
        </label>
        <?php dokan_post_input_box($post_id, 'soundboutiques_yt_embed_code', array('placeholder' => __('product code', 'dokan-lite'), 'value' => $soundboutiques_yt_embed_code)); ?>
        <div class="dokan-product-title-alert dokan-hide">
            <?php esc_html_e('Please enter product code!', 'dokan-lite'); ?>
        </div>
    </div>
    <?php
}
// showing on single product page
add_action('woocommerce_single_product_summary', 'show_product_code', 13);
function show_product_code()
{
    global $product;
    if (empty($product)) {
        return;
    }
    $soundboutiques_yt_embed_code = get_post_meta($product->get_id(), 'soundboutiques_yt_embed_code', true);
    if (!empty($soundboutiques_yt_embed_code)) {
    ?>
        <span class="details">
            <?php echo esc_attr__('Product Code:', 'dokan-lite'); ?>
            <strong>
                <?php echo esc_attr($soundboutiques_yt_embed_code); ?>
            </strong>
        </span>
    <?php
    }
}
/*
* Add slider image
*/
add_action('dokan_new_product_added', 'save_add_product_meta_img', 10, 2);
add_action('dokan_product_updated', 'save_add_product_meta_img', 10, 2);
function save_add_product_meta_img($product_id, $postdata)
{
    if (!dokan_is_user_seller(get_current_user_id())) {
        return;
    }
    if (!empty($postdata['title'])) {
        update_post_meta($product_id, 'title', $postdata['title']);
    }
    if (!empty($postdata['subtitle'])) {
        update_post_meta($product_id, 'subtitle', $postdata['subtitle']);
    }
    if (!empty($postdata['subdescription'])) {
        update_post_meta($product_id, 'subdescription', $postdata['subdescription']);
    }
    if (!empty($postdata['vidimg'])) {
        update_post_meta($product_id, 'vidimg', $postdata['vidimg']);
    }
}
/*
* Showing field data on product edit page
*/
add_action('dokan_product_edit_after_product_tags', 'show_on_edit_page_hello', 99, 8);
function show_on_edit_page_hello($post, $post_id)
{
    $subtitle         = get_post_meta($post_id, 'subtitle', true);
    $title         = get_post_meta($post_id, 'title', true);
    $subdesc        = get_post_meta($post_id, 'subdescription', true);
    $vidimg = get_post_meta($post_id, 'vidimg', true); ?>
    <div class="dokan-form-group">
        <h6 class="auto">Ajoutez du contenu pour mettre en valeur cette oeuvre !
        </h6>
        <input type="hidden" name="title" id="dokan-edit-product-id" value="<?php echo esc_attr($post_id); ?>" />
        <label for="new_field" class="form-label">
            <?php esc_html_e('Autre Titre', 'dokan-lite'); ?>
        </label>
        <?php dokan_post_input_box($post_id, 'title', array('placeholder' => __('product code', 'dokan-lite'), 'value' => $title)); ?>
        <p class="help-block">50 caractères maximum (conseillé)
        </p>
    </div>
    <div class="dokan-form-group">
        <input type="hidden" name="subtitle" id="dokan-edit-product-id" value="<?php echo esc_attr($post_id); ?>" />
        <label for="subtitle" class="form-label">
            <?php esc_html_e('Sous titre', 'dokan-lite'); ?>
        </label>
        <?php dokan_post_input_box($post_id, 'subtitle', array('placeholder' => __('product code', 'dokan-lite'), 'value' => $subtitle)); ?>
        <p class="help-block">80 caractères maximum (conseillé)
        </p>
    </div>
    <div class="dokan-form-group">
        <label for="subdescription" class="form-label">Paragraphe d'introduction
        </label>
        <div class="dokan-rich-text-wrap">
            <?php dokan_post_input_box($post_id, 'subdescription', array('placeholder' => 'ajouter une description', 'value' => $subdesc), 'textarea'); ?>
        </div>
    </div>
    <div class="dokan-feat-image-upload">
        <?php
        $wrap_class        = ' dokan-hide';
        $instruction_class = '';
        $feat_image_id     = 0;
        if (!empty($vidimg)) {
            $wrap_class        = '';
            $instruction_class = ' dokan-hide';
            $imaid = attachment_url_to_postid($vidimg);
        } ?>
        <div class="instruction-inside<?php echo esc_attr($instruction_class); ?>">
            <input type="hidden" name="vidimg" class="dokan-feat-image-id" value="<?php echo esc_attr($vidimg); ?>">
            <i class="fa fa-cloud-upload">
            </i>
            <a href="#" class="dokan-feat-image-btn btn btn-sm">
                <?php esc_html_e('Upload a product cover image', 'dokan-lite'); ?>
            </a>
        </div>
        <div class="image-wrap<?php echo esc_attr($wrap_class); ?>">
            <a class="close dokan-remove-feat-image">&times;
            </a>
            <?php if (!empty($vidimg)) { ?>
                <img src="<?php echo esc_url(wp_get_attachment_url($vidimg)); ?>" alt="">
            <?php } else { ?>
                <img height="" width="" src="" alt="">
            <?php } ?>
        </div>
    </div>
<?php
}
