//////  Users/show_users  ////////////
// delete a topoic
$(function(){
	$("#topic_delete").live('click',function(e){
		$(this).parents("#topic_box").animate({width: 'hide', height: 'hide', opacity: 'hide'}, 'slow', function () {
			//disappear the delete topic link
			$(".span2, #topic_delete",this).attr("style","display:none");
			$(this).children(".span2").attr("style","margin-bottom:13px");
			$(this).children(".span2").show();
			//$(this).children(".span6").attr("style","display:none");

			//display confirm link
			var confirm_link = "<div class='span8' style='text-align:center; margin-bottom:10px;'>" 
						+"<div id='areyousure' style='color:#f63; font-weight:bold; margin-top:10px; text-align:center;'> Are you sure to delete this topic?</div>"
 						+"<p id='delete_confirm' class='delete_confirm'>&nbspdelete&nbsp</p> "
						+" <p id='delete_cancel' class='delete_cancel'>&nbspcancel&nbsp</p>"
			                   +"</div>";
			$(this).children(".span2").before(confirm_link); //add new div to show confirm link
			//$(this).show("slide",{direction: 'right'});
			$(this).show('slow');
		});
	});

	$("#delete_confirm").live('click',function(e){
alert("DELETE");
	});

	$("#delete_cancel").live('click',function(e){
alert("CANCEL");
	});
});


