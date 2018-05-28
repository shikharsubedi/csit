var formValidator,
	selectedTab = 0,
	tabs;

$(document).ready(function(){
	
	if(window.location.hash) {
 		var winHash = window.location.hash,
			hash = winHash.substr(1,winHash.length),
			index = $('.tabs > div').index($('#tabs-'+hash));
		if(index != -1)	
			selectedTab = index;
	}
	
	window.onhashchange = function(){
		var hash = window.location.hash;
		if(hash == '' || hash == '#')
			return false;
		else{
			hash = hash.substr(1,hash.length);
			var index = $('.tabs > div').index($('#tabs-'+hash));
			tabs.tabs('select',index);
		}
			
	}

	tabs = $('div.tabs').tabs({	selected	:	selectedTab,
								select		:	function(e,ui){
													var hash = $(ui.tab).attr('href').split('-')[1];
													window.location.hash = hash;
												}
							});
	//new showLocalTime("cur_time", "server-php", 0, "short");
	formValidator = $('form').validate();
	
	
	//the flash data
	
	setTimeout(function(){
		//$('.flashdata').fadeOut("slow");
		$('.flashdata').animate({opacity:0,height:0,'margin-bottom':0,'padding':0},1000);
	},2000);
	/**/
	
	//the form helpers
	$('form :input').focus(function(){
		$(this).closest('tr[valign="top"]').children().css({'background': '#fafafa'});
	});
	
	$('form :input').blur(function(){
		$(this).closest('tr[valign="top"]').children().css({'background': 'none'});
	});
	
	$('.form-table tr[valign="top"]').hover(function(){
												$(this).children('th, td').css({background: '#fafafa'});
											},
											function(){
												if($(this).find('input[type=text]').is(':focus'))
													return;
												else
													$(this).children('th, td').css({background: 'none'});
											});
	/*$('.form-table tr[valign="top"]').click(function(){
		$(this).find('input, select').focus();
	});
	*/
	
	$('#sidebar .sideNav li a').hover(function(){
											$(this).children('span').animate({'padding-left':'15px'},300);
										},
										function(){
											if(!$(this).hasClass('active'))
												$(this).children('span').animate({'padding-left':'0px'},300);
										});
	
	$('#sidebar .sideNav li:last a:first').not('.active').css({'border-bottom': '1px solid #CCC'});
	//fix the active sidebar menu
	var activeSidenav = $('#sidebar .sideNav li a.active');
	var nextMenu;
	
	var parent = activeSidenav.parent('li');
	
	if(parent.children('ul.sub').length > 0){
		nextMenu = parent.children('ul.sub').children('li:first').children('a:first');
	}else{
		nextMenu = parent.next('li').children('a:first')
	}	
	
	nextMenu.css({'border-top':'none'});
	
	$('#sidebar .sideNav li a.active').parent('li').children('ul.sub').show();
	/**************************************************/
	
	//always focus on the first form element
	var firstelem = $('form input:first').focus(),
		fvalue = firstelem.val();
	firstelem.val(fvalue);
		
	
});

function doLoading(field)
{
	field.css({'position':'relative'});
	$('<div class="loading"></div>').appendTo(field);
	
}

function unload(field)
{
	field.find('div.loading').hide().remove();
}