//////  Users/show_users  ////////////
// delete a topoic
$(function(){
	$("#topic_delete").live('click',function(e){
			//disappear the delete topic link
			$(this, ".span2").attr("style","display:none");

			//display confirm link
			var confirm_link = "<div id='confirm_link' class='span8' style='text-align:center; margin-bottom:10px;'>" 
						+"<div id='areyousure' style='color:#f63; font-weight:bold; margin-top:10px; text-align:center;'> Are you sure to delete this topic?</div>"
 						+"<p id='delete_confirm' class='delete_confirm'>&nbsp&nbspdelete&nbsp&nbsp</p> "
						+" <p id='delete_cancel' class='delete_cancel'>&nbsp&nbspcancel&nbsp&nbsp</p>"
			                   +"</div>";
			//$(this).parent(".span2").before(confirm_link); //add new div to show confirm link
			//$(confirm_link).hide().insertBefore(".span2",this).fadeIn(10000); //add new div to show confirm link
			 $(this).parent(".span2").hide().before(confirm_link).fadeIn('slow');  

/*
		$(this).parents("#topic_box").animate({width: 'hide', height: 'hide', opacity: 'hide'}, 'slow', function () {
			//disappear the delete topic link
			$(".span2, #topic_delete",this).attr("style","display:none");
			$(this).children(".span2").attr("style","margin-bottom:13px");
			$(this).children(".span2").show();
			//$(this).children(".span6").attr("style","display:none");

			//display confirm link
			var confirm_link = "<div id='confirm_link' class='span8' style='text-align:center; margin-bottom:10px;'>" 
						+"<div id='areyousure' style='color:#f63; font-weight:bold; margin-top:10px; text-align:center;'> Are you sure to delete this topic?</div>"
 						+"<p id='delete_confirm' class='delete_confirm'>&nbsp&nbspdelete&nbsp&nbsp</p> "
						+" <p id='delete_cancel' class='delete_cancel'>&nbsp&nbspcancel&nbsp&nbsp</p>"
			                   +"</div>";
			$(this).children(".span2").before(confirm_link); //add new div to show confirm link
			//$(this).show("slide",{direction: 'right'});
			$(this).show('slow');
		});
*/
	});

	$("#delete_confirm").live('click',function(e){
		var title_id;
title_id=147;
		var element_array=[]; //array for all elements(title, content, comment)
		element_array=[title_id];

		var data = {request : element_array};

		$.ajax({
			type: "POST",
			url: "/Topics/deletetopic",
			data: data,
			success: function(data, dataType)
			{
alert("DELETE");
			}
		});
	});

	$("#delete_cancel").live('click',function(e){
		$(this).parents("#confirm_link").hide();
	});
});


