(function() {
    tinymce.PluginManager.add('missilethreat', function( editor, url ) {
        editor.addButton( 'tableOfContents', {
            text: tinyMCE_object.button_name,
            icon: false,
            onclick: function() {
                editor.windowManager.open( {
                    title: tinyMCE_object.button_title,
                    body: [
                        {
                            type   : 'textbox',
                            name   : 'tableOfContentsSidebar',
                            label  : 'Sidebar',
                            tooltip: 'Contents of the sidebar',
                            placeholder: 'Contents of the sidebar goes here',
                            multiline: true,
                            minWidth: 700,
                            minHeight: 200
                        },
                        {
                            type   : 'textbox',
                            name   : 'tableOfContentsMain',
                            label  : 'Main Content',
                            tooltip: 'Main contents of the post',
                            placeholder: 'Main contents of the post',
                            multiline: true,
                            minWidth: 700,
                            minHeight: 200
                        },

                    ],
                    onsubmit: function( e ) {
                        editor.insertContent( '[tocSidebar]'+e.data.tableOfContentsSidebar+'[/tocSidebar]\n[tocMain]'+e.data.tableOfContentsMain+'[/tocMain]');
                    }
                });
            },
        });
        editor.addButton( 'definition', {
            text: 'Definition',
            icon: false,
            onclick: function() {
                editor.windowManager.open( {
                    title: 'Definition/Jargon:',
                    width: 400,
                    height: 100,
                    body: [
                        {
                            type: 'textbox',
                            multiline: false,
                            name: 'term',
                            label: 'Term',
                            placeholder: 'This is the term'
                        },
                        {
                            type: 'textbox',
                            multiline: false,
                            name: 'definition',
                            label: 'Definition',
                            placeholder: 'This is the definition'
                        }
                    ],
                    onsubmit: function( e ) {
                        editor.insertContent( "[define definition='"+e.data.definition+"']"+e.data.term+"[/define]");
                    }
                })
            }
        })
    });

})();
