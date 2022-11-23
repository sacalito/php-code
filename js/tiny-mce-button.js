/*
(function() {
     tinymce.create('tinymce.plugins.php_code', {
          init : function(ed, url) {
               ed.addButton( 'php_code_button', {
                    title: 'PHP Code',
                         type: 'menubutton',
                         image: url + '/wp-content/plugins/php-code/images/logo.png',
                         menu: [
                              {
                              text: 'Include',
                              value: '[php-code include=""]',
                              onclick: function() { ed.selection.setContent(this.value());}
                              },
                         ]
               });
          },
     });
     tinymce.PluginManager.add( 'php_code_buttons', tinymce.plugins.php_code );
})();
*/

(function() {
     tinymce.create('tinymce.plugins.php_code', {
          init : function(ed, url) {
               ed.addButton( 'php_code_button', {
                    title: 'PHP Code Insert',
                         text: ' Insert',
                         image: url + '/wp-content/plugins/php-code/images/logo.png',
                         value: '[php-code include=""]',
                         onclick: function() { ed.selection.setContent(this.value());}         
               });
               
               
          },
     });
     tinymce.PluginManager.add( 'php_code_buttons', tinymce.plugins.php_code );
})();

