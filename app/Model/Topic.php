<?php
class Topic extends AppModel {
	public $name = 'Topic';
	public $actsAs = array('Containable');
	public $hasMany = array('Title','Content','Comment');
	public $belongsTo = array(
		'Mastercategory' => array(
			'className' => 'Mastercategory',
			'foreignKey' => 'category',
			'fields' => 'Mastercategory.name, Mastercategory.url',
			'conditions' => '',
			'order' => '',
			'type' => 'INNER'
		)
	);

	public $hasAndBelongsToMany = array(
		'Tag' =>
			array(
				'className'		=> 'Tag',
				'joinTable'		=> 'tags_topics',
				'foreignKey'		=> 'topic_id',
				'associationForeignKey'	=> 'tag_id',
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

	
//var $useTable = false; 
	//The Associations below have been created with all possible keys, those that are not needed can be removed
/*
        var $belongsTo = array(
                'Content' => array(
                        'className' => 'Content',
                        'foreignKey' => 'articleid',
                        'conditions' => '',
                        'fields' => '',
                        'order' => ''
                )
        );
*/
}
