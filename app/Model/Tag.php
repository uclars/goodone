<?php
class Tag extends AppModel
{
	public $name = 'Tag';
	public $hasAndBelongsToMany = array(
//		'Movie' =>
		'Topic' =>
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
				'with'			=> 'TagsTopic'
			)
	);

//http://blog.syuhari.jp/archives/172
	public function findTag($tagname){
		return $this->find('all', array(
			'conditions' => array('Tag.name' => $tagname),
			'contain' => array(
				'Tag.name'
			)
		));
	}
}
?>
