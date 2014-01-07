<?php
$me_array = $this->Session->read('Auth.User');
$me = $me_array['id'];

/// topics user created ///
echo "<div class='row'>";
	echo "<div class='span8'>";
		echo "<div style='font-weight:bold; font-size:150%; margin-bottom:20px;'>Topics you created:</div>";
		if(empty($topic_list)){
			echo "<span style='margin-left:10px;'>no roundups yet</span>";
		}
		else{
			foreach($topic_list as $tlists){
				echo "<div class='row'>";
					echo "<div class='span2'>";
						echo $this->Html->image($tlists['Mastercategory']['url']);
						echo "<p id='topic_delete' class='topic_delete'>[remove]</p>";
					echo "</div>";
					echo "<div class='span6'>";
						echo "<div style='font-weight:bold; font-size:125%;'>".$this->Html->link($tlists['Topic']['name'], array('controller'=>'Topics', 'action'=>'create', 'topicid'=>$tlists['Topic']['id']))."</div>";
						echo $tlists['Topic']['description'];
					echo "</div>";
					echo "<div class='span8' style='border-bottom: 2px solid #ddd; margin-bottom:10px;'></div>";
				echo "</div>";
			}
		}

	echo "</div>";

/// profile ///
	echo "<div class='span4'>";
		echo "<div style='font-weight:bold; font-size:150%; margin-bottom:20px;'>Profile:</div>";
		echo "<div class='row'>";
			echo "<div class='span1'>";
				echo $this->HTML->image($target_user['Masteravators']['url48']);
			echo "</div>";
			echo "<div class='span3'>";
				echo "<div>".$target_user['User']['username']."</div>";
				echo "<div id='profileedit'>["."edit"."]</div>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
echo "</div>";
?>
<SCRIPT language="JavaScript">
$(function(){
//$('#topic_delete').live('click',function(e){
      $("#topic_delete").live('click',function(e){
alert("YYY");
//              $(this).parents("row").animate({width: 'hide', height: 'hide', opacity: 'hide'}, 'slow', function () {
                        //disappear
//                      $(this).attr("style","display:none");
                        //disable FORM attribute
                        //$(this).children(".item_title").attr("value","disabled");
                        //$(this).children(".item_content").attr("value","disabled");
                        //$(this).children(".item_comment").attr("value","disabled");

                        //contentnum=($(".contentsbody").length);
                        //$("#num").val(contentnum);
//}             );
       });
});
</SCRIPT>
