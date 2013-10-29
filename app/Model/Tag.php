<?php
class Tag extends AppModel
{
	public $name = 'Tag';
	public $hasAndBelongsToMany = array(
		'Movie' =>
			array(
				'className'		=> 'Topic',
				'joinTable'		=> 'tags_topics',
				'foreignKey'		=> 'tag_id',
				'associationForeignKey'	=> 'topic_id',
				'unique'		=> false,
				'conditions'		=> '',
				'fields'		=> '',
				'order'			=> '',
				'limit'			=> '',
				'offset'		=> '',
				'finderQuery'		=> '',
				'deleteQuery'		=> '',
				'insertQuery'		=> '',
				'with'			=> 'TagTopics'
			)
	);
}
?>
