<?php

/*
 * Plugin Name: Template selector
 * Plugin URI: http://lin3s.com
 * Description: Adds a field to declare templates used by pages dynamically.
 * Author: LIN3S
 * Version: 1.0
 * Author URI: http://lin3s.com/
 */

new TemplateSelector();

/**
 * Plugin template selector class.
 *
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class TemplateSelector
{
    const META_STRING = '_wp_routing_template';
    const TRANSLATION_DOMAIN = 'wp_routing';

    /**
     * Constructor.
     */
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'addMetabox']);
        add_action('save_post', [$this, 'saveSelectedTemplate']);
    }

    /**
     * Adds the metabox calling the Wordpress' internal "add_meta_box" method.
     */
    public function addMetabox()
    {
        add_meta_box(
            'wp_routing_template',
            __('Template selector', self::TRANSLATION_DOMAIN),
            [$this, 'renderTemplateSelector'],
            'page',
            'side'
        );
    }

    /**
     * Renders the template selector. Also, added
     * a nonce field so to check it later.
     */
    public function renderTemplateSelector()
    {
        global $post;

        $templates = apply_filters('template_selector_available', ['default' => 'Default']);
        wp_nonce_field(self::META_STRING, self::META_STRING . '_nonce');

        $current = get_post_meta($post->ID, '_wp_page_template', true);

        echo '<p><label for="' . self::META_STRING . '">';
        _e('Select template to be used', self::TRANSLATION_DOMAIN);
        echo '</label></p>';
        echo '<select id="' . self::META_STRING . '" name="' . self::META_STRING . '">';
        foreach ($templates as $slug => $name) {
            echo '<option value="' . $slug . '" ' . ($current == $slug ? 'selected' : '') . '>' . $name . '</option>';
        }
        echo '<select>';
    }

    /**
     * Saves the selected template of post id given.
     *
     * This method also checks if the nonce is set and
     * updated the meta field in the database.
     *
     * @param int $postId The post id
     */
    public function saveSelectedTemplate($postId)
    {
        if (!isset($_POST[self::META_STRING . '_nonce']) ||
            !wp_verify_nonce($_POST[self::META_STRING . '_nonce'], self::META_STRING) ||
            (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
            !isset($_POST[self::META_STRING])
        ) {
            return;
        }

        update_post_meta($postId, '_wp_page_template', sanitize_text_field($_POST[self::META_STRING]));
    }
}
