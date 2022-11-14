$(document).ready(function() { 
    $(document).on('click', '.dropdown-menu', function (e) {
      e.stopPropagation();
    });

    // make it as accordion for smaller screens
    if ($(window).width() < 992) {
	  	$('.dropdown-menu a').click(function(e){
	  		e.preventDefault();
	        if($(this).next('.submenu').length){
	        	$(this).next('.submenu').toggle();
	        }
	        $('.dropdown').on('hide.bs.dropdown', function () {
			   $(this).find('.submenu').hide();
			})
	  	});
	}
	$('#confirmDelete').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');

        //$(this).find('.modal-footer #confirm').data('form', form);
        $(this).find('.modal-footer #confirm').data('form',form);
  	});
   $('#confirmActive').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');

        //$(this).find('.modal-footer #confirm').data('form', form);
        $(this).find('.modal-footer #confirm').data('form',form);
  	});
	$('#confirmDelete').find('.modal-footer #confirm').on('click', function(){ 
        $(this).data('form').submit();
    }); 
    $('#confirmActive').find('.modal-footer #confirm').on('click', function(){
        $(this).data('form').submit();
    });  
});

window.addEventListener('load',function() {
  setTimeout($('#preloader').hide(), 1000);
}); 

$(document).on("input", ".number", function() {
  this.value = this.value.replace(/\D/g,'');
});
$('.only-text').keydown(function (e) {
    if (e.ctrlKey || e.altKey) {
        e.preventDefault();
    } else {
        var key = e.keyCode; 
        if (!((key == 8) ||(key == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
            e.preventDefault();
        }
    }
});