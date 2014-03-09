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

	function updateNewTagTopic($topicid, $newtagid){
		$isTagTopic=$this->find('all',array(
			'conditions' => array('TagsTopic.topic_id' => $topicid, 'TagsTopic.tag_id' => $newtagid),
			'contain' => array(
				'TagsTopic.id'
			)
                ));

debug($isTagTopic);
exit;


		$tagstopic_id=$isTagTopic[0]['TagsTopic']['id'];
                $tagdata = array();
                $tagdata['id'] = $tagstopic_id;
                $tagdata['topic_id'] = $topicid;
                $tagdata['tag_id'] = $newtagid;

                $this->create();
                $this->save($tagdata);
        }

	function markDelete($topic_id,$d_tag){
		$delte_query = "Update tags_topics Set deleted=1 Where topic_id=".$topic_id." AND tag_id=".$d_tag.";";
		$this->query($delte_query);
	}
}
?>
