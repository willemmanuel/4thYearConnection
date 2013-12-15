$('tr.head').nextUntil('tr.head').hide(); 
$(function() {
    $('tr.head').click(function() {      
        $(this).nextUntil('tr.head').toggle();
    });
});