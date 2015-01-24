$(document).ready( function () 
{
    var t = $('#grid-content');
    
    t.masonry({
        itemSelector:        '.masonry',
        isResizable:        true,
        columnWidth: 204
    })
    
    t.sortable({
        distance: 0,
        handle: '.divgripper',
        items: '.post',
        placeholder: 'card-sortable-placeholder masonry',
        tolerance: 'pointer',
        
        start:  function(event, ui) {            
                 //console.log(ui); 
            ui.item.addClass('dragging').removeClass('masonry');
            if ( ui.item.hasClass('bigun') ) {
                 ui.placeholder.addClass('bigun');
                 }
                   ui.item.parent().masonry('reload')
                },
        change: function(event, ui) {
                   ui.item.parent().masonry('reload');
                },
        stop:   function(event, ui) { 
                   ui.item.removeClass('dragging').addClass('masonry');
                   ui.item.parent().masonry('reload');
        },
        update: function(event, ui) {
            $('#loading-animation').show(); // Show the animate loading gif while waiting

            opts = {
                url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
                type: 'POST',
                async: true,
                cache: false,
                dataType: 'json',
                data:{
                    action: 'item_sort', // Tell WordPress how to handle this ajax request
                    order: t.sortable('toArray').toString() // Passes ID's of list items in  1,3,2 format
                },
                success: function(response) {
                    $('#loading-animation').hide(); // Hide the loading animation
                    return; 
                },
                error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
                    alert(e);
                    // alert('There was an error saving the updates');
                    $('#loading-animation').hide(); // Hide the loading animation
                    return; 
                }
            };
            $.ajax(opts);
        }
   });
})