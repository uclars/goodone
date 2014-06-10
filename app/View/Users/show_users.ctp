<?php
$me_array = $this->Session->read('Auth.User');
$me = $me_array['id'];

/// topics user created ///
echo "<div class='row'>";
	echo "<div class='col-sm-8 col-lg-8'>";
		echo "<div style='font-weight:bold; font-size:150%; margin-bottom:20px;'>Topics you created:</div>";
		if(empty($topic_list)){
			echo "<span style='margin-left:10px;'>No Topics Yet</span>";
		}
		else{
			foreach($topic_list as $tlists){
				echo "<div class='row'>";
					echo "<div class='col-md-2 col-sm-3 text-center'>";
						if(!empty($topic['Topic']['topic_image'])){ //If there is a image for the topic, show it, otherwise show the category image
							echo $this->Html->image($topic['Topic']['topic_image'], array('width'=>'96px'));
						}else{
							echo $this->Html->image($tlists['Mastercategory']['url'],array('width'=>'60'));
						}
						echo "<p id='show_topic' class='show_topic'>".$this->Html->link('[show topic]', array('controller'=>'Topics', 'action'=>'show_topic', 'topicid'=>$tlists['Topic']['id']),array('target'=>'_blank'))."</p>";
						echo "<p id='topic_delete' class='topic_delete'>[delete topic]</p>";
					echo "</div>";
					echo "<div class='col-md-10 col-sm-9'>";
						echo "<div style='font-weight:bold; font-size:125%; margin-top:10px; margin-bottom:5px;' >".$this->Html->link($tlists['Topic']['name'], array('controller'=>'Topics', 'action'=>'create', 'topicid'=>$tlists['Topic']['id']),array('style'=>'color:#f7376b;'))."</div>";
						echo $tlists['Topic']['description'];
					echo "</div>";
					echo "<div class='span8' style='border-bottom: 2px solid #ddd;'></div>";
				echo "</div>";
			}
		}

	echo "</div>";

/// profile ///
	echo "<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right'>";
		echo "<div class='panel panel-default'>";
			echo "<div class='panel-body'>";
				echo "<div style='text-align:center;'>";
		echo "<div style='font-weight:bold; font-size:150%;'>Profile:</div>";
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
		echo "</div>";
	echo "</div>";
echo "</div>";
?>
