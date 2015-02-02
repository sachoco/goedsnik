jQuery(document).ready(function(){

		//location.href = ".currentpost"; 

	var currentindex = jQuery('.currentpost').index();
	var elecount = jQuery(".post").size();

jQuery('select').change(function ()
{
    jQuery(this).closest('form').submit();
});


resizeHandler();

jQuery(window).scroll(function () {
  var scrollY = jQuery(window).scrollTop();
  if (scrollY > 120){
  	jQuery(".navwrap").addClass("navfixed");
  	jQuery("#page_content").css("padding-top","60px");
  }
  else{
  	jQuery(".navwrap").removeClass("navfixed");
  	jQuery("#page_content").css("padding-top","0px");
  }
});

jQuery(window).resize(resizeHandler);

jQuery("#grid-content").css("visibility","visible");
});


function resizeHandler(){
	var windowwidth = jQuery(window).width();
	
	if((windowwidth<1450)&&(windowwidth>500)){
		//jQuery("#grid-content div.post").css({"width":"142px","padding": "12px 9px 20px 9px"});
		var inc=0;
		jQuery(".wp-post-image").each(function(){
			if(inc>1){
			jQuery(this).parent().parent(".post").css({"width":"142px","padding": "12px 9px 20px 9px"});
			var thiswidth = jQuery(this).width();
			var thisheight = jQuery(this).height();
			var thisratio = thiswidth/thisheight;
			jQuery(this).css({"width":"142px","height":142/thisratio});
			jQuery("body").css({"font-size":"11px","line-height":"13px"});
			inc++;
			}
		});
		
	}
	else if(windowwidth<=500){
			var inc=0;
		jQuery(".wp-post-image").each(function(){
			if(inc>1){
			jQuery(this).parent().parent(".post").css({"width":"100%","padding": "12px 9px 20px 9px"});
			var thiswidth = jQuery(this).width();
			var thisheight = jQuery(this).height();
			var thisratio = thiswidth/thisheight;
			jQuery(this).css({"width":"100%","height":142/thisratio});
			jQuery("body").css({"font-size":"11px","line-height":"13px"});
			inc++;
			}
		});
	}	
}

