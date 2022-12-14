(function() {
     tinymce.create('tinymce.plugins.php_code', {
          init : function(ed, url) {
               ed.addButton( 'php_code_button', {
                    title: 'PHP Code Insert',
                         text: 'Sacalito´s Code Insert',
                         image: url + '/wp-content/plugins/sacalito-php-code/images/logo.png',
                         value: '[php-code include=""]',
                         onclick: function() { ed.selection.setContent(this.value());}         
               });
               
               
          },
     });
     tinymce.PluginManager.add( 'php_code_buttons', tinymce.plugins.php_code );
})();

