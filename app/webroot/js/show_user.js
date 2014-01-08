//////  Users/show_users  ////////////
// delete a topoic
$(function(){
	$("#topic_delete").live('click',function(e){
		$(this).parents("#topic_box").animate({width: 'hide', height: 'hide', opacity: 'hide'}, 'slow', function () {
			//disappear
			$(this).children(".span2").attr("style","display:none");
			$(this).children(".span6").attr("style","display:none");

			//display confirm link
			var confirm_link = "<div class='span8'> Are you sure to delete this topic? <p class='delete_confirm'>[delete]"
			                   +"</p></div>";
			$(this).children(".span6").after(confirm_link); //add new div to show confirm link
			//$(this).show("slide",{direction: 'right'});
			$(this).show('slow');
		});
	});
});

