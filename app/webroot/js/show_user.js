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
		$(confirm_link).hide().fadeIn('slow').insertBefore($(this).closest(".span2"));
	});

	$("#delete_confirm").live('click',function(e){
		var title_id;
		var title_id_source;

		/// Get topic id from href attribute
		title_id_source = $(this).parent().parent(".row").find("a").attr("href");
		title_id = title_id_source.split(":");

		var data = {title_id: title_id[1]};

		/// POST topic id and check the delete flag on the database *Topic/deletetopic
		$.ajax({
			type: "POST",
			url: "/Topics/deletetopic",
			data: data,
			success: function(data)
			{
				console.log(data);
			}
		});

		/// reload the page
		$(this).parents("#topic_box").animate({width: 'hide', height: 'hide', opacity: 'hide'}, 'slow', function () {
			//disappear
			$(this).children(".span2").attr("style","display:none");
			$(this).children(".span6").attr("style","display:none");
		});
	});

	$("#delete_cancel").live('click',function(e){
		$(this).parents("#confirm_link").hide();
	});
});


