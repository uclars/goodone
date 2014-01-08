//////  Users/show_users  ////////////
// delete a topoic
/*
$(function(){
	$("#topic_delete").live('click',function(e){
		$(this).parents("#topic_box").animate({width: 'hide', height: 'hide', opacity: 'hide'}, 'slow', function () {
			//disappear
			$(this).children(".span2").attr("style","display:none");
			$(this).children(".span6").attr("style","display:none");

			//display confirm link
			var confirm_link = "<div class='span8'> <p class='delete_confirm'>[delete confirm]"
			                   +"</p></div>";
			$(this).children(".span6").after(confirm_link); //add new div to show confirm link
			$(this).show();
		});
	});
});
*/


$('#myModal').on('show', function() {
	var id = $(this).data('id'),
		removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
	e.preventDefault();

	var id = $(this).data('id');
	$('#myModal').data('id', id).modal('show');
});

$('#btnYes').click(function() {
	// handle deletion here
  	var id = $('#myModal').data('id');
  	$('[data-id='+id+']').remove();
  	$('#myModal').modal('hide');
});
