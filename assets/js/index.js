// JavaScript Document
$('#hodLink').click(function(e) {
    $('#hodContainer, #hodDiv').fadeIn().css('z-index','1');
});
$('#hodContainer').click(function(e) {
    $('#hodContainer, #hodDiv').fadeOut();
});

$('#secLink').click(function(e) {
    $('#secContainer, #secDiv').fadeIn().css('z-index','1');
});
$('#secContainer').click(function(e) {
    $('#secContainer, #secDiv').fadeOut();
});