<?php
class Relatedtopic extends AppModel {
	public $name = 'Relatedtopic';

	public function update_newrelatedtopics($topicid,$new_topci_array){
		$update_query = "update relatedtopics set first=".$new_topci_array[0]."where topicid="$topicid.";";
		$this->query($update_query);
	}
}
?>
