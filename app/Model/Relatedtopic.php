<?php
class Relatedtopic extends AppModel {
	public $name = 'Relatedtopic';

	public function update_newrelatedtopics($topicid,$new_topci_array,$isnew){
		if(empty($isnew)){
			$update_query = "update relatedtopics set first=".$new_topci_array[0]." ,modified=now() where topicid=".$topicid.";";
			$this->query($update_query);
		}else{
			//if there are no record on the table yet, insret new ranking
			$insert_query = "insert into relatedtopics values('','".$topicid."','".$new_topci_array[0]."','".$new_topci_array[1]."','".$new_topci_array[2]."','".$new_topci_array[3]."','".$new_topci_array[4]."','".$new_topci_array[5]."','".$new_topci_array[6]."','".$new_topci_array[7]."','".$new_topci_array[8]."','".$new_topci_array[9]."','','');";
			$this->query($insert_query);
echo $insert_query;
		}
	}
}
?>
