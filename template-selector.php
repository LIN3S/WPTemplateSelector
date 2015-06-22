<?php
/*
Plugin Name: Template selector
Plugin URI: http://lin3s.com
Description: Adds a field to declare templates used by pages dynamically
Author: Gorka Laucirica
Version: 0.1
Author URI: http://lin3s.com/
*/

new TemplateSelector();

class TemplateSelector
{
    const META_STRING = '_wp_routing_template';
    const TRANSLATION_DOMAIN = 'wp_routing';

    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'addMetabox'));
        add_action('save_post', array($this, 'saveSelectedTemplate'));
    }

    public function addMetabox()
    {
        add_meta_box('wp_routing_template',
            __('Template selector', self::TRANSLATION_DOMAIN),
            array($this, 'renderTemplateSelector'),
            'page',
            'side'
        );
    }

    public function renderTemplateSelector()
    {
        global $post;

        $templates = apply_filters('template_selector_available', array(
            "default" => "Default"
        ));
        // Add a nonce field so we can check for it later.
        wp_nonce_field(self::META_STRING, self::META_STRING . '_nonce');

        $current = get_post_meta($post->ID, '_wp_page_template', true);

        echo '<p><label for="' . self::META_STRING . '">';
        _e('Select template to be used', self::TRANSLATION_DOMAIN);
        echo '</label></p>';
        echo '<select id="' . self::META_STRING . '" name="' . self::META_STRING . '">';
        foreach ($templates as $slug => $name) {
            echo '<option value="'. $slug .'" ' . ($current == $slug ? 'selected' : '') . '>' . $name . '</option>';
        }
        echo '<select>';
    }

    public function saveSelectedTemplate($post_id)
    {
        // Check if our nonce is set.
        if (!isset($_POST[self::META_STRING . '_nonce']) ||
            !wp_verify_nonce($_POST[self::META_STRING . '_nonce'], self::META_STRING) ||
            (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
            !isset($_POST[self::META_STRING])
        ) {
            return;
        }

        // Update the meta field in the database.
        update_post_meta($post_id, '_wp_page_template', sanitize_text_field($_POST[self::META_STRING]));
    }
}
