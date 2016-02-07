</div>
<?php wp_footer(); ?>
<script type="text/javascript">
jQuery(document).ready(function(){

   
   var colwidth = 204;



 var realcolwidth=colwidth-6.5;
	 
	 
	 var masonwidth=0;
	
    	
	var windowWidth=parseInt(jQuery(window).width());
	
	var originalwidth = 546;
	var cpwidth = 546;
	var cp2width = 362+10;
	var cp3width = 506;
	var cp4width = 770+10;
	var cp5width = 974+10;
	var cp6width = 1178+10;
	var cp7width = 1382+10;
	
	var fullwidthactive = false;
	
	if(jQuery("#current").length != 0) {
  		switch(true)
			{
			  case jQuery("#current").hasClass('currentpost_col2'):
			  originalwidth=cp2width;
			  break;
			  
			  case jQuery("#current").hasClass('currentpost_col3'):
			  originalwidth=cp3width;
			  break;
			  
			  case jQuery("#current").hasClass('currentpost_col4'):
			  originalwidth=cp4width;
			  break;
			  
			  case jQuery("#current").hasClass('currentpost_col5'):
			  originalwidth=cp5width;
			  break;
			  
			  case jQuery("#current").hasClass('currentpost_col6'):
			  originalwidth=cp6width;
			  break;
			  
			  case jQuery("#current").hasClass('currentpost_col7'):
			  originalwidth=cp7width;
			  break;
			  
			  case jQuery("#current").hasClass('currentpost_colfull'):
			//  originalwidth=jQuery("#grid-content").width();
			  fullwidthactive = true;
				//alert();
			  break;
			  
			default:
			  
			}
	}
	
    //	alert(windowWidth);
	//alert(windowWidth);
	if (windowWidth<=1450){
	 colwidth = 175;
	// if((!(jQuery.browser.mobile))||(windowWidth>500)){
	 // jQuery("#grid-content div.post:not(#current)").css("width","151px");
	/*
 }
	 else{
		 jQuery("#grid-content div.post:").css("width","100%");
	 }
*/
	 if (jQuery.browser.mozilla) {
	 	
   		jQuery("#grid-content div.post:not(#current)").css({"width":"155px"});
   		jQuery("#grid-content div.post:not(#current,.bottombrick)").addClass("borderff");
	 	if(jQuery("#current").length == 0) {
   		jQuery("#grid-content").css({"margin-left":"-2px"});
   		}
  	 }
	 jQuery("#grid-content div.currentpost").css("width","479px");
	 jQuery("#grid-content div.currentpost_col2").css("width","275px");
	 jQuery("#grid-content div.currentpost_col3").css("width","479px");
	 jQuery("#grid-content div.currentpost_col4").css("width","654px");
	 jQuery("#grid-content div.currentpost_col5").css("width","829px");
	 jQuery("#grid-content div.currentpost_col6").css("width","974px");
	 jQuery("#grid-content div.currentpost_col7").css("width","1139px");
	 
	 realcolwidth=colwidth-7.25;
	 
	 jQuery(".last_column").css("width","46%");
	 
						 if(jQuery(".slideshow_content").length>0){
						 	var oldwidth=jQuery('.slideshow_content').width();
						 	var newwidth=jQuery('.slideshow_content').width()-100;
						 	var widthratio = newwidth/oldwidth;
						 	
						 	var oldheight = jQuery('.slideshow_content').height();
						 	var newheight = oldheight*widthratio;
						 	
						 	
							jQuery('.slideshow_content,.slideshow_container').css({"width":newwidth,"height":newheight});
							//alert();
						//	jQuery(".slideshow_slide_image a img").css({"width":currentdiv_width-50});
							
							//alert(jQuery(".slideshow_slide_image a img").height());
						 	//jQuery('.current_content div:first').css("height",jQuery(".slideshow_content").height()-50);
						 }
	}
	
	
	else{
		 if (jQuery.browser.mozilla) {
	 	
	 	if(jQuery("#current").length == 0) {
   		jQuery("#grid-content").css({"margin-left":"-3px"});
   		}
   		else{
   		var currentwidth = parseInt(jQuery("#current").css("width"))+2;
   		jQuery("#current").css({"width":currentwidth+"px"});
   		}
   		
   		jQuery("#grid-content div.post:not(#current)").css({"width":"182px"});
   		jQuery("#grid-content div.post:not(#current,.bottombrick)").addClass("borderfflarge");
   		
  	 }
  	 	jQuery(".one_half").css("width","40%");
  	 	jQuery(".last_column").css("width","50%");
	
	}
	
	
	
 jQuery(".img_link").each(function(){
	 	jQuery(this).find("img").attr("src",jQuery(this).attr("rel"));
	 	//jQuery(this).find("img").css("width","143px");
	 });
	 
	 
	var gridWidth = jQuery('#grid-content').width();
	var numCols = Math.floor(gridWidth/colwidth);
	var resultingGridWidth=numCols*realcolwidth;
	//alert(colwidth);
	jQuery("#grid-content div.currentpost_colfull").css("width",resultingGridWidth+"px");
	 
	var currentheight=parseInt(jQuery('.activemason').height());
	var heightdiff=0;
	//alert(resultingGridWidth);
	
	
	if(jQuery(".current_content img").length != 0) {
		
		var parentwidth=parseInt(jQuery('.current_content').css('width'));
		var thiswidth;
		var thisheight;
		
		
		jQuery('.current_content img').each(function(){
			
				thiswidth=parseInt(jQuery(this).attr('width'));
				thisheight=parseInt(jQuery(this).attr('height'));
			if (thiswidth>(parentwidth-42)){
				//alert(thiswidth+" is thiswidth and parentwidth is "+parentwidth)
			    jQuery(this).removeAttr('height');
			    jQuery(this).removeAttr('width');
			    
			    var resizeAmount = parentwidth-42;
				//var widthrat=resizeAmount/thiswidth;
				var originaldiff = originalwidth-thiswidth;
				
				//alert(originaldiff);
				if ((windowWidth<=1450)&&(fullwidthactive==false)&&(originaldiff<42)&&(!(jQuery(this).parent().hasClass('aligncenter')))&&(!(jQuery(this).hasClass('aligncenter')))){
					jQuery(this).attr('width',thiswidth-originaldiff-42);
				}
				else if((windowWidth<=1450)&&(fullwidthactive==false)&&(!(jQuery(this).parent().hasClass('aligncenter')))&&(!(jQuery(this).hasClass('aligncenter')))){
					jQuery(this).attr('width',thiswidth-originaldiff);
					
					//jQuery('.content').css("width",thiswidth-originaldiff-100);
				}
				else if((windowWidth<=1450) &&(!(jQuery(this).parent().hasClass('aligncenter')))&&(!(jQuery(this).hasClass('aligncenter')))){
				jQuery(this).attr('width',resultingGridWidth-100);
				/*alert(originaldiff);*/
				
				
				}
				else{	
			    	jQuery(this).attr('width',parentwidth);
			    }
			    
			    
				var heightrat=parseInt(jQuery(this).attr('width'))/thiswidth;
			    var thisheightdiffrat=heightrat*thisheight; 
				
				jQuery(this).attr('height',thisheightdiffrat);
			}
		});
	}



jQuery('.current_content object,.current_content embed').each(function(){
	
	var parentwidth=parseInt(jQuery('.current_content').css('width'));
	var thiswidth=parseInt(jQuery(this).attr('width'));
	
	if(thiswidth>parentwidth){
	var widthrat=parentwidth/thiswidth;
		
        jQuery(this).removeAttr('width');
        jQuery(this).attr('width','100%');
    
	}
	
	//alert(heightdiff);

});


	//currentheight=currentheight-39;
//if(parseInt(jQuery('.current_content').css('height'))!=currentheight){
//jQuery('#current').css('height',currentheight-heightdiff-20-129+'px');
//}


	 
	 
	 
    	
    	var t = $('#grid-content');
if($(window).width()>500){ 
/*
    t.masonry({
        itemSelector:        '.masonry',
        isResizable:        true,
        columnWidth: colwidth,
        isFitWidth: true
    });
*/
// add layout event, triggered after container has been sized
var _postLayout = Masonry.prototype._postLayout;
Masonry.prototype._postLayout = function() {
  _postLayout.apply( this, arguments );
  this.emitEvent( 'layout', [ this ] );
};

    var msnry = new Masonry( '#grid-content', {
        itemSelector:        '.masonry',
        isResizable:        true,
        columnWidth: ".grid-sizer",//colwidth,
        isFitWidth: true,
        // gutter: 4,
        transitionDuration: 0,
        isInitLayout: false    
    } );
//     msnry.on( 'layoutComplete', onLayout );
	function onLayout() {
		jQuery("#topmenu-right").css({"margin-left":jQuery('#grid-content').width()-180+"px","visibility":"visible"});

		
	}
    msnry.on( 'layout', onLayout );
	

	$('#grid-content').imagesLoaded().progress( function() {
		msnry.layout();
	});
 }


<?php if ( is_user_logged_in() ) { ?>
	 
	 
	 
	var t = $('#grid-content');
	 
   function getSortOrder() { var children = document.getElementById('grid-content').childNodes; var sort = ""; for(x in children){ sort = sort + children[x].id + ","; } return sort; }
    
    
    
    t.sortable({
        forcePlaceholderSize: true,
        handle: '.img_link',
        items: '.post,.page',
        placeholder: 'card-sortable-placeholder masonry',
        tolerance: 'pointer',
        
        start:  function(event, ui) {            
                 //console.log(ui); 
            ui.item.addClass('dragging').removeClass('masonry');
            if ( ui.item.hasClass('bigun') ) {
                 ui.placeholder.addClass('bigun');
                 }
                 	msnry.reloadItems();
                 	msnry.layout();
                   // ui.item.parent().masonry('reload')
                },
        change: function(event, ui) {
        			msnry.reloadItems();
        			msnry.layout();
                   // ui.item.parent().masonry('reload');
                },
        stop:   function(event, ui) { 
        			
                   ui.item.removeClass('dragging').addClass('masonry');
                   msnry.reloadItems();
                   msnry.layout();
                   // ui.item.parent().masonry('reload');
        },
       
        update: function(event, ui) {
            jQuery('#loading-animation').show(); // Show the animate loading gif while waiting
			
            opts = {
                url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data:{
                    action: 'item_sort', // Tell WordPress how to handle this ajax request
                    order: t.sortable('toArray').toString(), // Passes ID's of list items in  1,3,2 format
                    pageid: <?php 
	                    if (is_home()) {echo 1;}
	                    else if (is_category()){
		                    echo lang_object_id(get_query_var('cat'),"category","nl");
		                }else{
		                    echo lang_object_id(get_the_ID(),"post","nl");
			            } ?>,
                    getid: <?php if(isset($_GET['id'])){echo lang_object_id($_GET['id'],"post","nl");}else{echo 0;} ?>
                },
                success: function(response) {
                    $('#loading-animation').hide(); // Hide the loading animation
                   console.log(t.sortable('toArray').toString());
                    return; 
                },
                error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
                    //alert(e);
                     alert('There was an error saving the updates');
                    $('#loading-animation').hide(); // Hide the loading animation
                    return; 
                }
            };
            $.ajax(opts);
        }
   });
	 
	 var masonwidth=0;
	

    	if (jQuery(".currentpost_colfull")[0]){
   			var secondtop = jQuery("#grid-content div.post:nth-child(2)").css("top");
    		jQuery("#grid-content div.post,#grid-content div.page").each(function(){
		    	if(jQuery(this).css("top")==secondtop){
		    		var thispad = parseInt(jQuery(this).css("padding-left"))+parseInt(jQuery(this).css("padding-right"));
		    		var thiswidth = parseInt(jQuery(this).css("width"))+thispad;
		    		masonwidth=masonwidth+thiswidth-4;
		    	}
    		});
    		// jQuery(".currentpost_colfull").css("width",masonwidth+"px");
   			
		}
		else{
    		jQuery("#grid-content div.post,#grid-content div.page").each(function(){
		    	if(jQuery(this).css("top")=="0px"){
		    		var thispad = parseInt(jQuery(this).css("padding-left"))+parseInt(jQuery(this).css("padding-right"));
		    		var thiswidth = parseInt(jQuery(this).css("width"))+thispad;
		    		masonwidth=masonwidth+thiswidth;
		    	}
    		});
    
    	}
    	<? } ?>
  });
</script>



</body>
</html>