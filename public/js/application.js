$('.volunteer-check-all').click(function(event) {  //on click 
    if(this.checked) { // check select status
        $('.volunteer-check').each(function() { //loop through each checkbox
            $(this).parent().addClass('checked');  //select all checkboxes with class "checkbox1"  
            $(this).prop( "checked", true );             
        });
    }else{
        $('.volunteer-check').each(function() { //loop through each checkbox
            $(this).parent().removeClass('checked'); //deselect all checkboxes with class "checkbox1"       
            $(this).prop( "checked", false );                 
        });         
    }
}); 

$('.volunteer-check').click(function(event) {  //on click 
      if(this.checked) { // check select status
    }else{
      $('.volunteer-check-all').parent().removeClass('checked');
    }
});

$('.program-check-all').click(function(event) {  //on click 
    if(this.checked) { // check select status
        $('.program-check').each(function() { //loop through each checkbox
            $(this).parent().addClass('checked');  //select all checkboxes with class "checkbox1"  
            $(this).prop( "checked", true );             
        });
    }else{
        $('.program-check').each(function() { //loop through each checkbox
            $(this).parent().removeClass('checked'); //deselect all checkboxes with class "checkbox1"       
            $(this).prop( "checked", false );                 
        });         
    }
}); 

$('.program-check').click(function(event) {  //on click 
      if(this.checked) { // check select status
    }else{
      $('.program-check-all').parent().removeClass('checked');
    }
});

$('li').each(function(){
    if(window.location.href.indexOf($(this).find('a:first').attr('href'))>-1)
    {
    $(this).addClass('active').siblings().removeClass('active');
    }
});

// if #javascript-ajax-button exists
if ($('#autofill').length !== 0) {
  
  function autofill(event) {
        var min_length = 0; // min caracters to display the autocomplete
        var keyword = $('#autofill').val();
        // send an ajax-request to this URL: current-server.com/songs/ajaxGetStats
        // "url" is defined in views/_templates/footer.php
        if (keyword.length >= min_length) {
          $.ajax(
            {
			url: url + "/volunteers/suggestVolunteers",
			type: 'POST',
			data: {keyword:keyword, event:event},
			success:function(data){
                if ($('#autofill').val() != ""){
                  $('#autofill_results').show();
				  $('#autofill_results').html(data);
                }else{
                  $('#autofill_results').hide();
                }
			}
		})

        };
    };
}