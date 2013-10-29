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
}
?>
