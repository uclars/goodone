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
			+'<input type="hidden" class="item_content" name="data[Content][content]['+titlenum+']['+contentnum+']" id="content_'+titlenum+'" value="'+quote_content+'">'
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


$(function(){
	$(".contentsBox .delete").live('click',function(e){
		$(this).parents(".contentsBox").animate({width: 'hide', height: 'hide', opacity: 'hide'}, 'slow', function () {
			$(this).attr("style","display:none");
			$(this).children(".item_title").attr("value","disabled");
			$(this).children(".item_content").attr("value","disabled");
			$(this).children(".item_comment").attr("value","disabled");


			contentnum=($(".contentsbody").length);
			$("#num").val(contentnum);
		});
	});
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
			+'<input type="hidden" class="item_content" name="data[Content][content]['+titlenum+']['+contentnum+']" id="content_'+titlenum+'" value="'+clipbody+'">'
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

});

///auto save when div box is moved///
window.onload = function() {
	jQuery( '#sort-drop-area' ) . sortable( {revert: true, opacity: 0.8, cursor: 'move', update: function() {
		revert: true
	}});

	jQuery( '#dragArea' ).find('img,li').draggable( {
		connectToSortable: '#sort-drop-area',
		helper: 'clone',
		revert: 'invalid',
	} );
	jQuery( '#dragArea' ) . disableSelection();
}
