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