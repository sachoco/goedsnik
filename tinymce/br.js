(function() {
    tinymce.PluginManager.add('br_button', function( editor, url ) {
        editor.addButton( 'br_button', {
            text: 'LineBreak',
            icon: false,
            onclick: function() {
                editor.insertContent('<br class="none" />\n');
            }
        });
    });
})();