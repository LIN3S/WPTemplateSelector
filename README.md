# Template selector
> Adds a field to declare templates used by pages dynamically

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LIN3S/WPTemplateSelector/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LIN3S/WPTemplateSelector/?branch=master)
[![Total Downloads](https://poser.pugx.org/lin3s/template-selector/downloads)](https://packagist.org/packages/lin3s/template-selector)
&nbsp;&nbsp;&nbsp;&nbsp;
[![Latest Stable Version](https://poser.pugx.org/lin3s/template-selector/v/stable.svg)](https://packagist.org/packages/lin3s/template-selector)
[![Latest Unstable Version](https://poser.pugx.org/lin3s/template-selector/v/unstable.svg)](https://packagist.org/packages/lin3s/template-selector)

## Why?
[LIN3S][1]'s [WPRouting][2] is a very robust solution to manage the Wordpress routing system in a [Symfony][3] way.
We came up with this solution in our way to a MVC architecture because many PHP files where scattered in our template
root directory with dummy unstructured code.

This way, we are now able to match routes used by Wordpress with the actions from our Controllers, letting us to keep
a simpler a more intuitive theme folder structure for new coming developers.

We faced some issues when we started using WP-Routing plugin, creating a php file in theme's root folder had no sense
just to add an annotation. Therefore, we came up with this alternative to avoid using annotations to declare new page templates.

With this plugin you can now use a hook to add your custom page templates, and a selector will be added in your page
editor to select the one you need.

## Installation
The recommended and the most suitable way to install is through [Composer][4]. Be sure that the tool is installed
in your system and copy the following piece of code inside your `composer.json`:
```
{
    "type": "composer",
    "url": "http://wpackagist.org"
},
"require": {
    "wpackagist-plugin/template-selector": "~1.0"
}
```

## Usage
To declare the templates just add the following hook to your WordPress theme.

    add_filter('template_selector_available', [$this, 'templates']);
    
    public function templates($templates) {
        return array_merge($templates, [
            "template-slug"    => 'Template name shown in admin',
            "another-template" => 'Another template'
        ]);
    }

## Licensing Options
[![License](https://poser.pugx.org/lin3s/template-selector/license.svg)](https://github.com/LIN3S/WPTemplateSelector/blob/master/LICENSE)

[1]: http://lin3s.com
[2]: https://github.com/LIN3S/WPRouting
[3]: https://symfony.com/
[4]: https://getcomposer.org/
