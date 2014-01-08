//////  Users/show_users  ////////////
// delete a topoic
$(function(){
	$("#topic_delete").live('click',function(e){
		$(this).parents("#topic_box").animate({width: 'hide', height: 'hide', opacity: 'hide'}, 'slow', function () {
			//disappear
			$(this).children("#topic_delete").attr("style","display:none");
			//$(this).children(".span6").attr("style","display:none");

			//display confirm link
			var confirm_link = "<div class='span8' style='text-align:center; margin-bottom:10px;'>" 
					   +"<div id='areyousure' style='color:#f63; font-weight:bold; margin-top:10px; text-align:center;'> Are you sure to delete this topic?</div>"
 					   +"<p class='delete_confirm'>[delete]</p> "
					   +" <p class='delete_cancel'>[cancel]</p>"
			                   +"</div>";
			$(this).children(".span2").before(confirm_link); //add new div to show confirm link
			//$(this).show("slide",{direction: 'right'});
			$(this).show('slow');
		});
	});
});

