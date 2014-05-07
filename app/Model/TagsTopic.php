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

                $tagdata = array();
		if(!empty($isTagTopic[0]['TagsTopic']['id'])){
			///when there is no value for this tag and topic combination, no id(=insert new record into DB)
			$tagstopic_id=$isTagTopic[0]['TagsTopic']['id'];
                	$tagdata['id'] = $tagstopic_id;
		}
                $tagdata['topic_id'] = $topicid;
                $tagdata['tag_id'] = $newtagid;

                $this->create();
                $this->save($tagdata);
        }

	function markDelete($topic_id,$d_tag){
		$delte_query = "Update tags_topics Set deleted=1 Where topic_id=".$topic_id." AND tag_id=".$d_tag.";";
		$this->query($delte_query);
	}

	public function get_newrelatedtopics($topic_id){
		$new_rank=$new_rank_tmp=array();

		$relatedtopics_query="SELECT topic_id,count(*) AS rank FROM tags_topics WHERE tag_id IN (select tag_id from tags_topics where topic_id=".$topic_id.") AND topic_id!=".$topic_id." GROUP BY topic_id ORDER BY rank desc";
		$new_rank_tmp = $this->query($relatedtopics_query);

		for($i=0;$i<10;$i++){
			if(empty($new_rank_tmp[$i]['tags_topics']['topic_id'])){
				$new_rank[]="";
			}else{
				$new_rank[]=$new_rank_tmp[$i]['tags_topics']['topic_id'];
			}
		}

		return $new_rank;
	}
}
?>
