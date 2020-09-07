# Wordpress-Snippets

This repository contains useful snippets and tricks for WordPress and Woocommerce development

- [Get theme directory](#get-theme-directory)

## Get theme directory

```php
/**
 * Get template directory uri
 */
function medura_directory() {
    $themeuri = get_template_directory_uri();
    return $themeuri;
}
```