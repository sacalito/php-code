# php-code
Wordpress Plugin inspired from https://github.com/wp-plugins/insert-php-code-snippet

if you code in PHP and you hate to make the initial setup just use WP as the CMS for your project and include your PHP files inside each page

there is a tinymce button to add very quickly pages

USAGE: insert in any page WP Shortcode [php-code include=""]

the plugin has 2 basic settings

1. Document root: which is by defualt the webpage root taken from ($_SERVER['DOCUMENT_ROOT'], but you can change it afterwards
2. Include path: folder where all your php files are, by default the folder is "includes/"

the plugin will make an "include_once" on the file given in the short code, 

the page given in the shortcode must not contain extension since the plugin automatically adds the .php extension

Example: 

if you have a folder called includes and a file inside that folder called api.php use [php-code include="api"]

same goes for sub folders so: includes/functions/somefunc.php would be [php-code include="includes/functions/somefunc"]

this is a very basic plugin if you do not like it you do not need to use it



