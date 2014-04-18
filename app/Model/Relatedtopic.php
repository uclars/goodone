<?php
class Relatedtopic extends AppModel {
	public $name = 'Relatedtopic';

	public function update_newrelatedtopics($topicid,$new_topci_array,$isnew){

echo "J ".$isnew." <BR>";

		if(empty($isnew)){
			//if there are a record, update new ranking
			$update_query = "update relatedtopics set first=".$new_topci_array[0]." ,modified=now() where topicid=".$topicid.";";
			$this->query($update_query);
		}else{
			//if there are no record on the table yet, insret new ranking
			$now=date("Y-m-d H:i:s");
			$insert_query = "insert into relatedtopics values('','".$topicid."','".$new_topci_array[0]."','".$new_topci_array[1]."','".$new_topci_array[2]."','".$new_topci_array[3]."','".$new_topci_array[4]."','".$new_topci_array[5]."','".$new_topci_array[6]."','".$new_topci_array[7]."','".$new_topci_array[8]."','".$new_topci_array[9]."','".$now."','".$now."');";
			$this->query($insert_query);
		}
	}
}
?>
