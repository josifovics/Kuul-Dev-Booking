var last_page = $('ul.pagination #last').attr('data-last');
$('#products').infinitescroll({

    navSelector  : "#next",            
                   // selector for the paged navigation (it will be hidden)
    nextSelector : "a#next:last",    
                   // selector for the NEXT link (to page 2)
    itemSelector : "#products",          
                   // selector for all items you'll retrieve

    loadingImg   : "http://cdn.jsdelivr.net/jquery.infinitescroll/2.0b2/ajax-loader.gif",
    maxPage         : last_page,
donetext     : 'No more advertisements' ,
  });

