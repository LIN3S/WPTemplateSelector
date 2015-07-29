# Template selector
> Adds a field to declare templates used by pages dynamically

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LIN3S/Distribution/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LIN3S/Distribution/?branch=master)
[![Total Downloads](https://poser.pugx.org/lin3s/lin3s-distribution/downloads)](https://packagist.org/packages/lin3s/lin3s-distribution)
&nbsp;&nbsp;&nbsp;&nbsp;
[![Latest Stable Version](https://poser.pugx.org/lin3s/lin3s-distribution/v/stable.svg)](https://packagist.org/packages/lin3s/lin3s-distribution)
[![Latest Unstable Version](https://poser.pugx.org/lin3s/lin3s-distribution/v/unstable.svg)](https://packagist.org/packages/lin3s/lin3s-distribution)

## Why?
[LIN3S][1]'s [WPRouting][2] is a very robust solution to manage the Wordpress routing system in a [Symfony][3] way.
However, it has a 
Adds a simple input to type the template you want to use for each page. Useful when working with wp-routing.

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
To declare the templates you want to use just add the following hook to your WordPress theme.

    add_filter('template_selector_available', 'addAvailableTemplates');
    
    function addAvailableTemplates($templates) {
        return array_merge($templates, [
            "template-slug" => 'Template name shown in admin',
            "another-template" => 'Another template'
        ]);
    }

## Licensing Options
[![License](https://poser.pugx.org/lin3s/lin3s-distribution/license.svg)](https://github.com/LIN3S/Distribution/blob/master/LICENSE)

[1]: http://lin3s.com
[2]: 
[3]: 
[4]: https://getcomposer.org/
