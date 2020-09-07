# Wordpress-Snippets

This repository contains useful snippets and tricks for WordPress and Woocommerce development

- [Get theme directory](#get-theme-directory)
- [Add svg support to theme](#add-svg-support-to-theme)

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

## Add svg support to theme
```php
/**
 * Add svg MIME support
 */
function medura_mime_types($mime_types) {
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    return $mime_types;
}
add_filter('upload_mimes', 'medura_mime_types', 1, 1);
```