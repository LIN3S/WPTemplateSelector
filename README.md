Template selector
=================

Adds a simple input to type the template you want to use for each page. Useful when working with wp-routing.

Usage
-----

To declare the templates you want to use just add the following hook to your WordPress theme.

    add_filter('template_selector_available', 'addAvailableTemplates');
    
    function addAvailableTemplates($templates) {
        return array_merge($templates, [
            "template-slug" => 'Template name shown in admin',
            "another-template" => 'Another template'
        ]);
    }
    