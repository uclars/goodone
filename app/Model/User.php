<?php
class User extends AppModel
{
	public $name = 'User';
	public $belongsTo = array(
		'Masteravators' => array(
			'className' => 'Masteravators',
			'foreignKey' => 'avatornum',
			'conditions' => '',
			'fields' => 'Masteravators.name, Masteravators.url24, Masteravators.url32, Masteravators.url48, Masteravators.url64, Masteravators.url96, Masteravators.url128, Masteravators.url192',
			'order' => '',
			'type' => 'INNER'
		)
	);
}
?>
