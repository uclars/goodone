$('#get_quotation').live('click',function(e)
{
	var titlenum=0;
	var titlenum=($("input.item_title").length) + 1;
	var contentnum=($(".item_content").length) + 1;
	var title_id = "#contentsSet_"+titlenum;

	var quote_url = $("#quotationtitle").val();
	var quote_content = $("#quotationcontent").val();
	var quote_comment = $("#quotationcomment").val();

	//if nothing is wirtten, ignore the default value.
	if((quote_url == "Input URL") || (quote_url == "")){
		quote_url="";
	}
	if((quote_content == "Copy and Paste the Quotation") || (quote_content == "")){
		quote_content="";
	}
	else{
		quote_content=quote_content.replace(/[&"'<>]/g,function(m){return"&"+["amp","quot","#039","lt","gt"]["&\"'<>".indexOf(m)]+";"});
	}
	if((quote_comment == "Input your comment") || (quote_comment == "")){
		quote_comment="";
	}

	var ref1=$('<div id="contentsSet_'+titlenum+'" class="contentsBox"></div>').insertAfter($('.contentsBox:last'));
	var ref2=$(
			'<blockquote><p>'+quote_content+'</p>'
			+'<small><cite>'+quote_url+'</cite></small></blockquote>'
			+'<p>'+quote_comment+'</p>'
			+'<input type="hidden" class="item_title" name="data[Content][title]['+titlenum+']" id="title_'+titlenum+'" value="'+quote_url+'">'
			+'<input type="hidden" class="item_content" name="data[Content][content]['+titlenum+']" id="content_'+titlenum+'" value="'+quote_content+'">'
			+'<input type="hidden" class="item_comment" name="data[Content][comment]['+titlenum+']" id="comment_'+titlenum+'" value="'+quote_comment+'">'
			+ '<p class="delete">[remove]</p>'
	).prependTo($(title_id));


	//clear the text after clicking the button
	$("#quotationtitle").hide();
	$("#quotationtitle").val('Input URL');
	$("#quotationtitle").show();
	$("#quotationcontent").hide();
	$("#quotationcontent").val('Copy and Paste the Quotation');
	$("#quotationcontent").show();
	$("#quotationcomment").hide();
	$("#quotationcomment").val('Input your comment');
	$("#quotationcomment").show();

	e.preventDefault();
});


$('#get_heading').live('click',function(e)
{
	var titlenum=0;
	//var titlenum=($("input.contentstitle").length) + 1;
	var titlenum=($("input.item_title").length) + 1;
	var contentnum=($(".item_content").length) + 1;
	var title_id = "#contentsSet_"+titlenum;

	//var ref1=$('<div id="contentsSet_'+titlenum+'" class="contentsBox"></div>').insertBefore($('.inner'));
	var ref1=$('<div id="contentsSet_'+titlenum+'" class="contentsBox"></div>').insertAfter($('.contentsBox:last'));
	var ref2=$(
		'<input class="item_title" name="data[Content][title]" type="hidden" id="title_'+titlenum+'" value="__heading__">'
		+ '<input class="item_content" type="hidden" name="data[Content][content]" id="content_'+titlenum+'" value="__heading__">'
		+ '<input class="item_comment" type="hidden" name="data[Content][comment]" id="comment_'+titlenum+'" value="__heading__">'
		+ '<h2 id="heading_'+titlenum+'"></h2>'	
		+ '<p class="delete">[remove]</p>'
	//).prependTo($('.contentsBox:last'));
	).prependTo($(title_id));

        ref2.eq(0).attr("name","data[Content][title]["+titlenum+"]");
	//ref2.eq(1).attr("name","data[Content][content]["+titlenum+"]["+contentnum+"]");
	ref2.eq(1).attr("name","data[Content][content]["+titlenum+"]");
	ref2.eq(2).attr("name","data[Content][comment]["+titlenum+"]" );

	var headingid ="#heading_"+titlenum;
	var commentid ="#comment_"+titlenum;

	var heaing_content = $("#heading").val()
	$(headingid).text(heaing_content);
	$(commentid).val(heaing_content);

	//clear the text after clicking the button
	$("#heading").hide();
	$("#heading").val('Input heading words');
	$("#heading").show();

	e.preventDefault();
});


$('#get_textcomment').live('click',function(e)
{
	var titlenum=0;
	//var titlenum=($("input.contentstitle").length) + 1;
	var titlenum=($("input.item_title").length) + 1;
	var contentnum=($(".item_content").length) + 1;
	var title_id = "#contentsSet_"+titlenum;

	//var ref1=$('<div id="contentsSet_'+titlenum+'" class="contentsBox"></div>').insertBefore($('.inner'));
	var ref1=$('<div id="contentsSet_'+titlenum+'" class="contentsBox"></div>').insertAfter($('.contentsBox:last'));
	var ref2=$(
		'<input class="item_title" name="data[Content][title]" type="hidden" id="title_'+titlenum+'" value="__textcomment__">'
		+ '<input class="item_content" type="hidden" name="data[Content][content]" id="content_'+titlenum+'" value="__textcomment__">'
		+ '<input class="item_comment" type="hidden" name="data[Content][comment]" id="comment_'+titlenum+'" value="__textcomment__">'
		+ '<div id="textcomment_'+titlenum+'"></div>'	
		+ '<p class="delete">[remove]</p>'
	//).prependTo($('.contentsBox:last'));
	).prependTo($(title_id));

        ref2.eq(0).attr("name","data[Content][title]["+titlenum+"]");
	//ref2.eq(1).attr("name","data[Content][content]["+titlenum+"]["+contentnum+"]");
	ref2.eq(1).attr("name","data[Content][content]["+titlenum+"]");
	ref2.eq(2).attr("name","data[Content][comment]["+titlenum+"]" );

	var textcommentid ="#textcomment_"+titlenum;
	var commentid ="#comment_"+titlenum;

	var textcomment_content = $("#textcomment").val()
	$(textcommentid).text(textcomment_content);
	$(commentid).val(textcomment_content);

	//clear the text after clicking the button
	$("#textcomment").hide();
	$("#textcomment").val('Input comment');
	$("#textcomment").show();

	e.preventDefault();
});


$('#get_image').live('click',function(e)
{
	var titlenum=0;
	//var titlenum=($("input.contentstitle").length) + 1;
	var titlenum=($("input.item_title").length) + 1;
	var contentnum=($(".item_content").length) + 1;
	var title_id = "#contentsSet_"+titlenum;
	//IMAGE info from Topic_Controller
	var imageurl_content = $(this).attr("src");
	//imageurl_content = imageurl_content.replace("_s",""); //remove "_s" in order to show a big picture
	imageurl_content = imageurl_content.replace("_s","_m"); //replace image size S to M
	var imageinfo_org = $(this).attr("alt");
	var imageinfo = imageinfo_org.split("(__)");

	/// HTML tag for Flickr Search and Image Upload
	if(imageinfo[0] != "imageupload"){ //Flickr Search (alt value for flickr info)
		var imageownerid = imageinfo[0];
		var imageownername = imageinfo[2];
		var imagetitle = imageinfo[1];
		//var ref1=$('<div id="contentsSet_'+titlenum+'" class="contentsBox"></div>').insertBefore($('.inner'));
		var ref1=$('<div id="contentsSet_'+titlenum+'" class="contentsBox"></div>').insertAfter($('.contentsBox:last'));
		var ref2=$(
			'<input class="item_title" name="data[Content][title]" type="hidden" id="title_'+titlenum+'" value="__imageurl__">'
			+ '<input class="item_content" type="hidden" name="data[Content][content]" id="content_'+titlenum+'" value="__imageurl__">'
			+ '<input class="item_comment" type="hidden" name="data[Content][comment]" id="comment_'+titlenum+'" value="__imageurl__">'
			+ '<a target="_blank" href="'+imageownerid+'"><img src='+imageurl_content+' /></a>'
			+ '<p><a target="_blank" href="'+imageownerid+'">Photo "'+imagetitle+'" by '+imageownername+'</a></p>'
			+ '<p class="delete">[remove]</p>'
		).prependTo($(title_id));
	}
	else{ //Image Upload (no alt value)
		var ref1=$('<div id="contentsSet_'+titlenum+'" class="contentsBox"></div>').insertAfter($('.contentsBox:last'));
		var ref2=$(
			'<input class="item_title" name="data[Content][title]" type="hidden" id="title_'+titlenum+'" value="__imageurl__">'
			+ '<input class="item_content" type="hidden" name="data[Content][content]" id="content_'+titlenum+'" value="__imageurl__">'
			+ '<input class="item_comment" type="hidden" name="data[Content][comment]" id="comment_'+titlenum+'" value="__imageurl__">'
			+ '<img src='+imageurl_content+' />'
			+ '<p class="delete">[remove]</p>'
		).prependTo($(title_id));

		//clear input words
		var control = $("#file_id");
		control.replaceWith( control = control.clone( true ) );
	}

        ref2.eq(0).attr("name","data[Content][title]["+titlenum+"]");
	//ref2.eq(1).attr("name","data[Content][content]["+titlenum+"]["+contentnum+"]");
	ref2.eq(1).attr("name","data[Content][content]["+titlenum+"]");
	ref2.eq(2).attr("name","data[Content][comment]["+titlenum+"]" );

	var imageurlid ="#commenturl_"+titlenum;
	var imageid ="#comment_"+titlenum;
	var imageurl ="#content_"+titlenum;

	$(imageurlid).text(imageurl_content);
	$(imageid).val(imageurl_content);
	$(imageurl).val(imageinfo_org);

	//Clear the images
	$('#display_img').fadeOut(500, function() {
		$(this).html("").fadeIn(500);
	});

	e.preventDefault();
});

/// FLICKR Search /////
//number of images shown in one search
var numperpage=40;
$('#submitButton').live('click',function(e){
	//Clear the images
	$("#display_img").html("");
	// showing loading image
	$('#loadingimage').show();

	//get images from php
	$.post('/topics/image', {input_text: $('#imagetext').val(),number_perpage: numperpage,page: 1}, function(res){
		//hide the loading image when images are shown
		$('#loadingimage').hide();
		//show the images
		$("#display_img").html(res);
	});
});

$('#moreButton').live('click',function(e){
	var currentpage;
	var nextpage;

	$('.moreButton').hide();
	// showing loading image
	$('#loadingimage').show();
	//get the page to show
	currentpage = $('#display_img li').length;
	if(currentpage){
		nextpage = (currentpage/numperpage)+1
	}else{
		nextpage = 1;
	}

	//get the picture from PHP
	$.post('/topics/image', {input_text: $('#imagetext').val(),number_perpage: numperpage,page: nextpage}, function(res){
		//hide the loading image when images are shown
		$('#loadingimage').hide();

		//show the images
		$(res).appendTo("#display_img").hide().fadeIn(800);
	});
});


/// File Upload /////
function image_upload(){
	$("#display_img").html("");
	$('#loadingimage').show();
	$('#file_id').upload('/Topics/uploadImage', function(res) {
		//get the image url from response which is like "num of url|url+whole HTML"
		url=res.split("|");
		url_num = url[0];
		url_rest = url[1];

		if(url_num == "1"){
			image_url_tag = "<p style='color:red;'>"+url_rest+"</p>";
		}else if(url_num == "2"){
			image_url_tag = "<p style='color:red;'>"+url_rest+"</p>";
		}else{
			url_image = url_rest.substring(0, url_num);
			image_url_tag = "<img id='get_image' src='"+url_image+"' alt='imageupload(__)imageupload(__)imageupload' />";
		}

		$('#loadingimage').hide();
		$("#display_img").html(image_url_tag);
	});
}

$(function(){
	//default view of image is "image upload"
	$("#flickr_search").css("display", "none"); 

	//switch link image upload <-> flickr search
	$("#change_to_flickr").click(function(){
		$("#image_upload").toggle();
		$("#flickr_search").toggle();
	});
	$("#change_to_upload").click(function(){
		$("#image_upload").toggle();
		$("#flickr_search").toggle();
	});
});


//// YOUTUBE //////////
$(function(){
	$('#youtube').youtubin({
		swfWidth:560,
		swfHeight:340
	});
});
$('#get_youtube').live('click',function(e){
	//show the movie
	//$("<a href='http://www.youtube.com/watch?v=8e_wXc0m97w' rel='nofollow' id='youtube'>Check out this video</a>").appendTo("#display_youtube").hide().fadeIn(800);
	//$("#display_youtube").append('<a href="http://www.youtube.com/watch?v=8e_wXc0m97w" rel="nofollow" id="youtube">Check out this video</a>');
	$("#display_youtube").attr("src",$.jYoutube('http://www.youtube.com/watch?v=9YEEl52u8XE', 'big'));
	//$('#youtube').youtubin({
	//	swfWidth:320,
	//	swfHeight:240
	//});
	//$("<div><a href='http://www.youtube.com/watch?v=8e_wXc0m97w' rel='nofollow'>Check out this video</a></div>").appendTo("#display_youtube").hide().fadeIn(800);
});


$(function(){
	$(".contentsBox .delete").live('click',function(e){
		$(this).parents(".contentsBox").animate({width: 'hide', height: 'hide', opacity: 'hide'}, 'slow', function () {
			//disappear
			$(this).attr("style","display:none");
			//disable FORM attribute
			$(this).children(".item_title").attr("value","disabled");
			$(this).children(".item_content").attr("value","disabled");
			$(this).children(".item_comment").attr("value","disabled");

			contentnum=($(".contentsbody").length);
			$("#num").val(contentnum);
		});
	});
});


$('#copy').live('click',function(e)
{
	var clipContents = $("#coppy").val();
	if((clipContents != "Do not edit the sentense from the original. Just copy and past it.") && (clipContents != "")){
		//$(".contentsbody:first").val(clipContents)
		$(".contentsbody:last").val(clipContents)
		e.preventDefault();
	}
	else{
		e.preventDefault();
	}
});


$(function(){
	$(".contentsBox .submitinsideclass").live('click',function(e){
		var titlenum=0;
		var titlenum=($("input.item_title").length)+1;
		var contentnum=($(".item_content").length)+1;

		var cliptitle = $(this).parents(".contentsBox").children(".contentstitle").val();
		var clipbody = $(this).parents(".contentsBox").children(".contentsbody").val();
		if(clipbody == "Copy and past the sentence from the original article."){
			clipbody = "";
		}
		var clipcomment = $(this).parents(".contentsBox").children(".contentscomment").val();
		if(clipcomment == "Comment"){
			clipcomment = "";
		}
		var title_id = "#contentsSet_"+titlenum;


		var ref1=$('<div id="contentsSet_'+titlenum+'" class="contentsBox"></div>').insertAfter($('.contentsBox:last'));
		var ref2=$(
			'<blockquote><p>'+clipbody+'</p>'
			+'<small><cite>'+cliptitle+'</cite></small></blockquote>'
			+'<p>'+clipcomment+'</p>'
			+'<input type="hidden" class="item_title" name="data[Content][title]['+titlenum+']" id="title_'+titlenum+'" value="'+cliptitle+'">'
			//+'<input type="hidden" class="item_content" name="data[Content][content]['+titlenum+']['+contentnum+']" id="content_'+titlenum+'" value="'+clipbody+'">'
			+'<input type="hidden" class="item_content" name="data[Content][content]['+titlenum+']" id="content_'+titlenum+'" value="'+clipbody+'">'
			+'<input type="hidden" class="item_comment" name="data[Content][comment]['+titlenum+']" id="comment_'+titlenum+'" value="'+clipcomment+'">'
			+ '<p class="delete">[remove]</p>'
		).prependTo($(title_id));


		$('#contentsSet').hide('slow',function(){
			$('#contentsSet').remove();
		});

		//Remove Old iframe
		$('#con').attr("style","width:100%;height:0px;");
		$('#con').attr("style","width:100%;height:350px;");

		//clear the text after clicking the button
		$("#web_url_con").hide();
		$("#web_url_con").val('Input the target url');
		$("#web_url_con").show();

		e.preventDefault();
	});




/*
	//Image Upload
    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
alert("HH");
            $.each(data.result.files, function (index, file) {
console.log(index);
                $('<p/>').text(file.name).appendTo(document.body);
		data.submit();
            });
console.log(data.context);
        }
    });
*/




});

///auto save when div box is moved///
window.onload = function() {
	jQuery( '#sort-drop-area' ).sortable( {revert: true, opacity: 0.8, cursor: 'move', update: function() {
		revert: true

/*
		var topic_title = $("#url").val();
		var topic_category = $("#TopicRoundupCategory").val();
		var topic_desciption = $("#Roundup_Description").val();
		var elements = $(this).sortable("toArray")
		var title_array=[]; //array for title
		var content_array=[]; //array for content
		var comment_array=[]; //array for comment
		var element_array=[]; //array for all elements(title, content, comment)

		jQuery.each(elements, function(key, val) {
			if(key !== 0){
				var element_number_array = val.split("_");
				var element_number = element_number_array[1];

				var title_n = "#title_"+element_number;
				var content_n = "#content_"+element_number;
				var comment_n = "#comment_"+element_number;

				var title_value = $(title_n).val();
				var content_value = $(content_n).val();
				var comment_value = $(comment_n).val();

				title_array[key]={Content:{title: title_value}};
				content_array[key]={Content:{content: content_value}};
				comment_array[key]={Content:{comment: comment_value}};
			}
		});

	//	if(title_id==0){
			element_array=[username,title_id,title_array,content_array,comment_array,topic_title,topic_category,topic_desciption];

			var data = {request : element_array};
			$.ajax({
				type: "POST",
				url: "/Topics/savetodb",
				data: data,
				success: function(data, dataType)
				{
					//successのブロック内は、Ajax通信が成功した場合に呼び出される
					//PHPから返ってきたデータの表示
console.log(data);
				}
			});
	//	}
*/
	}});

	jQuery( '#dragArea' ).find('img,li').draggable( {
		connectToSortable: '#sort-drop-area',
		helper: 'clone',
		revert: 'invalid',
	} );
	jQuery( '#dragArea' ) . disableSelection();
}

