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
 * @author Jon Torrado <jontorrado@gmail.com>
 */
class TemplateSelector
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        add_filter('theme_page_templates', [$this, 'filterThemePageTemplates'], 20, 3);
    }

    /**
     * Filters the selectable templates.
     *
     * @return mixed
     */
    public function filterThemePageTemplates()
    {
        return apply_filters('template_selector_available', []);
    }
}
