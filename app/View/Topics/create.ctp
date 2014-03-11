<?php
//Get topic Title,Description,Category which stays in frist item in the array
if(!empty($editing_contents)){
	$topicitems = array_shift($editing_contents);
	$tid = $topicitems[0];
	$ttitle = $topicitems[1];
	$tcategory = $topicitems[2];
	$tdescription = $topicitems[3];
	$tuserid = $topicitems[4];
	$tcheck = $topicitems[5];
	$ttag_array = array();
	$ttag_array = $topicitems[6];
}
?>
<!--<section id="forms">-->
<div class='row'>
        <div class='span12'>
                <?php echo $this->Form->create('Topic', array('name'=>'topictitle')); ?>
                <?php
                        if(empty($ttitle)){
				echo $this->form->input('Clipping_Title',array("name"=>"hiddentitle", "id"=>"url","class"=>"inputtitle","value"=>"Web Clipping Title"));
                        }else{
                                echo $this->form->input('Clipping_Title',array("name"=>"hiddentitle", "id"=>"url","class"=>"inputtitle","value"=>$ttitle));
                        }
		?>
	</div>
	<div class='span4'>
		<?php
			if(empty($tcategory)){
				$tcategory = 5;
			}

			echo $this->Form->input('Clipping_Category', array(
				'type' => 'select',
				'name' => 'hiddencategory',
				'options' => array(
					1 => 'life',
					2 => 'business',
					3 => 'politics',
					4 => 'IT',
					5 => 'trivia',
					6 => 'entertainment',
					7 => 'sports'),
				'default' => $tcategory)
			);?>
	</div>
	<div class='span8'>
		<?php
			if(empty($tdescription)){
				$tdescription = "";
			}

			echo $this->form->input('Clipping_Description',array(
				'type' => 'textarea',
				'name' => 'hiddendescription',
				'value' => $tdescription,
				'escape' => false)
			);
		?>
	</div>
	<div class='span4'>
	<?php
		//show user id input only if the user is admin
		if($admin_num == 0){
			echo $this->form->hidden('hiddenuserid',array("name"=>"hiddenuserid","value"=>$userid));
		}else{
			if(!empty($tuserid)){
				echo $this->form->input('User_Id',array("name"=>"hiddenuserid", "id"=>"userid","class"=>"inputtitle","value"=>$tuserid));
			}else{
				echo $this->form->input('User_Id',array("name"=>"hiddenuserid", "id"=>"userid","class"=>"inputtitle","value"=>$userid));
                        }
		}
	?>
	</div>
	<div class='span8'>
	<?php
		//show tag input only if the user is admin
		if($admin_num != 0){
			if(!empty($ttag_array)){
				$tags="";
				$tags = implode(",",$ttag_array);
				echo $this->form->input('Clipping_Tags',array("name"=>"hiddentags", "id"=>"tags","class"=>"inputtitle","value"=>$tags));
			}else{
				echo $this->form->input('Clipping_Tags',array("name"=>"hiddentags", "id"=>"tags","class"=>"inputtitle","value"=>""));
			}
		}
	?>
	</div>
	<div class='12'>
		<?php
		$checkoption = null;
		if(!empty($tcheck)){
			if($tcheck != 0){
				$checkoption = "checked=\"1\"";
			}
		}
		?>
		<input type='checkbox' name='hiddencheck' <?php echo $checkoption; ?>>Contents is checked
	</div>
	<?php echo $this->Form->end(); ?>
</div>

<?php echo "<hr size='5' color='#333333' noshade style='margin:0 0 10px'>";?>
<h3 id="tabs"></h3>
<ul class="nav nav-tabs">
	<li class="active"><a href="#A" data-toggle="tab" disabled>&nbsp;Add Items&nbsp;&nbsp;</a></li>
	<li><a href="#B" data-toggle="tab">&nbsp;&nbsp;Heading&nbsp;&nbsp;&nbsp;</a></li>
	<li><a href="#C" data-toggle="tab">Quotation</a></li>
	<li><a href="#D" data-toggle="tab">&nbsp;&nbsp;&nbsp;&nbsp;Text&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
	<li><a href="#E" data-toggle="tab">&nbsp;&nbsp;&nbsp;&nbsp;Image&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
	<li><a href="#F" data-toggle="tab">&nbsp;&nbsp;&nbsp;&nbsp;Youtube&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
</ul>
<div class="tabbable">
	<div class="tab-content">
		<div class="tab-pane active" id="A">
			<div id="explain">
				<img src='/img/basic/explain.png' />
			</div>
		</div>
               <div class="tab-pane" id="B">
                        <div class="contents form">
                                <fieldset>
                                        <div class="input text"><input name="data[heading]" id="heading" value="Input heading words" type="text"></div>
					<button class="submitinsideclass" id="get_heading" name="get_heading" type="submit">heading</button>
				</fieldset>
                        </div>
                </div>
		<div class="tab-pane" id="C">
			<div class="contents form">
				<fieldset>
					<div class="input text">
						<input name="data[quotation]" id="quotationtitle" value="Input URL" type="text">
					</div>
					<textarea name="data[quotation]" id="quotationcontent" rows="5" cols="20">Copy and Paste the Quotation</textarea>
					<textarea name="data[quotation]" id="quotationcomment" rows="5" cols="20">Input your comment</textarea>
					<button class="submitinsideclass" id="get_quotation" name="get_quotation" type="submit">quotation</button>
				</fieldset>
			</div>
		</div>
                <div class="tab-pane" id="D">
                        <div class="contents form">
                                <fieldset>
                                        <textarea name="data[textcomment]" id="textcomment" rows="5" cols="20">Input comment</textarea>
					<button class="submitinsideclass" id="get_textcomment" name="get_heading" type="submit">Input Text</button>                                </fieldset>
                        </div>
                </div>
		<div class="tab-pane" id="E">
			<div class="row">
				<div class="span12" id="image_upload">
					<input type="file" name="uploadedfile" id="file_id" onchange="image_upload();">
					<div style="font-size:smaller;">jpeg, gif, png images. less than 500KB.</div>
					<div id="change_to_flickr" style="margin-top:60px;"><p class="click_link">[flickr search]</p></div> 
				</div>
				<div class="span12" id="flickr_search">
					<!--<form action="/Topics/create/topicid:136" id="TopicCreateForm" onsubmit="event.returnValue = false; return false;" method="post" accept-charset="utf-8">-->
					<form id="TopicCreateForm" onsubmit="event.returnValue = false; return false;" method="post" accept-charset="utf-8">
						<div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
						<div class="input text"><label for="imagetext"></label><input name="data[Topic]" id="imagetext" value="key word" type="text"></div>
						<div class="submit"><input id="submitButton" class="submitinsideclass" type="submit" value="SEARCH on flickr"></div>
					</form>
					<div id="change_to_upload"><p class="click_link">[image upload]</p></div>
				</div>
				<div class="span12" id="display">
					<ul id="display_img">
					</ul>
					<div id="loadingimage" style="display:none; text-align:center;">
						<img src="/img/basic/loading.gif" width="16px" height="16px/">
					</div>
				</div>
			</div>
                </div>
		<div class="tab-pane" id="F">
			<div class="contents form">
				<fieldset>
					<div class="input text"><input name="youtube_input" id="youtube_input" value="Input youtube url" type="text"></div>
					<button class="submitinsideclass" id="get_youtubethumnail" name="get_youtubethumnail" type="submit">get movie</button>
				</fieldset>
				<img id="get_youtube" style="display:none;" />
				<div id="youtube_loadingimage" style="display:none; text-align:center;">
					<img src="/img/basic/loading.gif" width="16px" height="16px/">
				</div>
			</div>
		</div>
	</div>

</div> <!-- /tabbable -->

<div class="actions">
	<fieldset>
		<?php echo $this->Form->create('Topic', array('name'=>'createsub', 'onsubmit'=>'false')); ?>
		<input type="hidden" name="Topic_Title" id="Topic_Title">
		<input type="hidden" name="Topic_Category" id="Topic_Category">
		<input type="hidden" name="Topic_Description" id="Topic_Description">
		<input type="hidden" name="Topic_Userid" id="Topic_Userid">
		<input type="hidden" name="Topic_Tag" id="Topic_Tag">
		<input type="hidden" name="Topic_Check" id="Topic_Check">
		<input type="hidden" name="Topic_Publish" id="Topic_Publish">
		<input type="hidden" name="data[num]" id="num">
		<?php echo "<hr size='5' color='#333333' noshade style='margin:0 0 10px'>";?>
		<Div id="dropArea">
			<ul id="sort-drop-area">
		<Div class="contentsBox" style="display:none"></Div>
<?php
/// For Editing Contents
if(!empty($editing_contents)){
	$h=0;
	
	foreach($editing_contents as $econtents){
		$h++;
		echo "<div id='contentsSet_".$h."' class='contentsBox'>";
			echo "<input class='item_title' name='data[Content][title][$h]' type='hidden' id='title_$h' value='".h($econtents[0])."'>";
			echo "<input class='item_content' name='data[Content][content][$h]' type='hidden' id='content_$h' value='".h($econtents[1])."'>";
			echo "<input class='item_comment' name='data[Content][comment][$h]' type='hidden' id='comment_$h' value='".h($econtents[2])."'>";
			
			if($econtents[0] == "__heading__"){
				//// HEADING ///
				echo "<h2 id='heading_$h'>".h($econtents[2])."</h2>";
			}
			elseif($econtents[0] == "__textcomment__"){
				/// COMMENT ///
				echo "<div id='textcomment_$h'>".h($econtents[2])."</div>";
			}
			elseif($econtents[0] == "__imageurl__"){
				/// IMAGE ///
				$im_url = explode("(__)",h($econtents[1]));
				if($im_url[0] != "imageupload"){ //if image is from upload, the image info disapper
					echo "<a target='_blank' href='".h($im_url[0])."'><img src='".h($econtents[2])."' /></a>";
					echo "<p><a target='_blank' href='".h($im_url[0])."'>Photo \"".h($im_url[1])."\" by ".h($im_url[2])."</a></p>";
				}
				else{
					echo "<img src='".h($econtents[2])."' />";
				}
			}
			elseif($econtents[0] == "__youtubeurl__"){
				/// YOUTUBE ///
				$youtube_url = explode("(__)",h($econtents[1]));
				echo "<a href='".h($youtube_url[0])."' rel='nofollow' id='youtube".$h."' class='youtubin'>Check out this video</a>";
				echo "<p><a target='_blank' href='".h($youtube_url[0])."'>".h($youtube_url[1])."</a></p>";
				echo "<script type='text/javascript'>";
					echo "$('a.youtubin').youtubin({";
						echo "swfWidth:320,";
						echo "swfHeight:240";
					echo "});";
				echo "</script>";
			}
			elseif($econtents[0] == "disabled"){
				/// DISABLE ///
			}
			else{
				/// Web Cliping ///
				echo "<blockquote>";
				echo "<p>".h($econtents[1])."</p>";
				echo "<small><cite title='".h($econtents[0])."'><a href='".h($econtents[0])."' target='_'>".h($econtents[0])."</a></cite></small>";
				echo "</blockquote>";
				echo "<p>".h($econtents[2])."</p>";
			}

			echo "<p class='delete'>[remove]</p>";
		echo "</div>";
	}
}
?>
	</Div></ui><!--end of DropArea -->
	</fieldset>
</div>
<div id="working" class="working" style="display:none;">........................</div>
<?php
//submit button
$auth = $this->Session->read('Auth.User');
if(!empty($auth)){
	if($admin_num == 0){
		echo "<button type='submit' class='submitclass' onclick='createsubmit(1);'>Save</button>";
		echo "&nbsp;&nbsp;";
		echo "<button type='submit' class='submitclass' onclick='createsubmit(0);'>Publish</button>";
			echo "&nbsp;&nbsp;";
			echo "<button type='submit' class='submitclass' onclick='viewthepage(".$tid.");'>View</button>";
	}else{

		if($userid==$tuserid){
			echo "<button type='submit' class='submitclass' onclick='createsubmit(1);'>Save</button>";
			echo "&nbsp;&nbsp;";
			echo "<button type='submit' class='submitclass' onclick='createsubmit(0);'>Publish</button>";
			echo "&nbsp;&nbsp;";
			echo "<button type='submit' class='submitclass' onclick='createsubmit(2);'>Update</button>";
			echo "&nbsp;&nbsp;";
			echo "<button type='submit' class='submitclass' onclick='viewthepage(".$tid.");'>View</button>";
		}else{
			echo "<button type='submit' class='submitclass' onclick='createsubmit(2);'>Update</button>";
		}
	}
	echo "</form>"; 
}else{
	echo "<button class='submitdisableclass' disabled>Facebook login needed to save</button>";
}
?>
<!--</section>-->


<SCRIPT language="JavaScript">
function createsubmit(submitnum){
	var ti=document.topictitle.hiddentitle.value;
	var hc=document.topictitle.hiddencategory.value;
	var hd=document.topictitle.hiddendescription.value;
	var hu=document.topictitle.hiddenuserid.value;
	var ht=document.topictitle.hiddentags.value;
	var hk=document.topictitle.hiddencheck.checked;


	document.createsub.Topic_Title.value = ti;
	document.createsub.Topic_Category.value = hc;
	document.createsub.Topic_Description.value = hd;
	document.createsub.Topic_Userid.value = hu;
	document.createsub.Topic_Tag.value = ht;
	document.createsub.Topic_Publish.value = submitnum;
	document.createsub.Topic_Check.value = hk;
}
function viewthepage(topicid){
	var viewurl;
	viewurl = "http://0-0b.com/Topics/show_topic/topicid:"+topicid;
	window.open( viewurl , "" ); 
}
</SCRIPT>
