<?php
class TagsTopic extends AppModel
{
	public $name = 'TagsTopic';
 
	public $belongsTo = array(
		'Movie' => array(
			'className' => 'Topic',
			'foreignKey' => 'topic_id',
		),
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
		),
	);

	function markDelete($topic_id,$d_tag){
		$delte_query = "Update tags_topics Set 'deleted'=1 Where 'topic_id'=".$topic_id." AND 'tag_id'=".$d_tag.";"
		$this->query($delte_query);
	}
}
?>
