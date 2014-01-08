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
				echo "<div class='row' id='topic_box'>";
					echo "<div class='span2'>";
						echo $this->Html->image($tlists['Mastercategory']['url']);
						echo "<a href='#' id='topic_delete' class='confirm-delete'>[remove]</a>";
					echo "</div>";
					echo "<div class='span6'>";
						echo "<div style='font-weight:bold; font-size:125%;'>".$this->Html->link($tlists['Topic']['name'], array('controller'=>'Topics', 'action'=>'create', 'topicid'=>$tlists['Topic']['id']))."</div>";
						echo $tlists['Topic']['description'];
					echo "</div>";
					echo "<div class='span8' style='border-bottom: 2px solid #ddd; margin-bottom:10px;'></div>";
?>


<div id="myModal" class="modal hide">
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Delete</h3>
    </div>
    <div class="modal-body">
        <p>You are about to delete.</p>
        <p>Do you want to proceed?</p>
    </div>
    <div class="modal-footer">
      <a href="#" id="btnYes" class="btn danger">Yes</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>
    </div>
</div>


<?php
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
