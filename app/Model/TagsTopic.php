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
		$tagdata = array();
		$tagdata['topic_id'] = $topic_id;
		$tagdata['tag_id'] = $d_tag;
		$tagdata['deleted'] = 1;

		$this->create();
		$this->save($tagdata);
	}
}
?>
