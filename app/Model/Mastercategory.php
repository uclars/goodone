<?php
class Mastercategory extends AppModel {
	public $name = 'Mastercategory';
	public $hasMany = array('Topic');
}
