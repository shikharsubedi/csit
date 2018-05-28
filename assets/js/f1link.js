/* f1 link */
function f1_loadPages()
{
	$.get(base_url+'content/ajax/getPagesEditor',null,function(data,status,xhr){
		$('.page-list').html(data);
	});
}
CKEDITOR.on( 'dialogDefinition', function( ev )
	{
		
		// Take the dialog name and its definition from the event
		// data.
		var dialogName = ev.data.name;
		var dialogDefinition = ev.data.definition;

		// Check if the definition is from the dialog we're
		// interested on (the "Link" dialog).
		if ( dialogName == 'link' )
		{
			// Get a reference to the "Link Info" tab.
			var infoTab = dialogDefinition.getContents( 'info' );

			
		infoTab.elements.push({
          type: 'vbox',
          id: 'drupalOptions',
          children: [{
            type: 'select',
            id: 'f1_path',
            label: 'Select the page you want to link to',
            required: true,
			items: [["Loading Pages..",""]],
            onLoad: function() {
            	this.getInputElement().addClass('page-list');
              	//initAutocomplete(this.getInputElement().$,);
				
				f1_loadPages();
            },
            setup: function(data) {
            },
            validate: function() {
              var dialog = this.getDialog();
			  
              if (dialog.getValueOf('info', 'linkType') != 'ipage') {
                return true;
              }
              return true;
            }
          }]
        });
	// Remove the "Link Type" combo and the "Browser
	// Server" button from the "info" tab.
	//infoTab.remove( 'linkType' );
	//infoTab.remove( 'browse' );

	var types = infoTab.get( 'linkType' );
	//console.log(types);
	
	types.items.push(['Internal Page','ipage']);
	
	types.onChange = CKEDITOR.tools.override(types.onChange, function(original){
		return function() {
		original.call(this);
		var dialog = this.getDialog();
		
		var element = dialog.getContentElement('info', 'drupalOptions').getElement().getParent().getParent();
		
		
		if (this.getValue() == 'ipage') {
		  element.show();
		  
		  if (CKEDITOR.config.linkShowTargetTab) {
			dialog.showPage('target');
		  }
		  var uploadTab = dialog.definition.getContents('upload');
		  if (uploadTab && !uploadTab.hidden) {
			dialog.hidePage('upload');
		  }
		}
		else {
		  element.hide();
		}/**/
	  };
	});
	
	types.commit = function(data) {
		
		
          data.type = this.getValue();//console.log(data.type);
		  var dialog = this.getDialog();
		  //console.log(dialog.getValueOf('info', 'f1_path'));
          if (data.type == 'ipage') {
            data.type = 'url';
            
            dialog.setValueOf('info', 'protocol', '');
			
			var page_id = dialog.getValueOf('info', 'f1_path');
			var url_value = '[internal_link id='+page_id+']';
            dialog.setValueOf('info', 'url', url_value);
          }/**/
        };

		}
	});	