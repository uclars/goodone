<?php

/**
 * PostComment Model
 * 
 * @author Lubo? Remplik <lubos@lubos.me>
 * @link http://lubos.me
 * @copyright (c) 2011 Lubo? Remplik
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 *
 */
class PostComment extends AppModel {
	public $actsAs = array(
		'Containable'
	);
	var $belongsTo = array('Post'=> array('counterCache' => true));
}
