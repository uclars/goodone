<?php
class RelatedtopicsShell extends AppShell{
	//var $uses = array('Topic','Followingtopics','Relatedtopic');
	var $uses = array('Topic','Tag','TagsTopic');

//////////////////////// ABSTRUCT  //////////////////////////////////
/////////////////////////////////////////////////////////////////////
// 1. get all topics
// 2. get users who follow each topic
// 3. get the other topics which each user follows
// 4. count the number of users who follow the same other topics
////////////////////////////////////////////////////////////////////

	function main(){
		$topics_array = array(); //list of all topics
		//get list of all topics
		//may need to separete the task because when topic is large enosh, array cloud have the cache problem
		$topics_array = $this->Topic->find('all',array('fields'=>array('id'), 'conditions'=>array('Topic.deleted'=>0)));

		foreach($topics_array as $topiclist){
			$topics_users_array = array(); //list of topics and users
			$sql = "SELECT topic_id,count(*) AS q FROM tags_topics WHERE tag_id IN (select tag_id from tags_topics where topic_id=".$topiclist['Topic']['id'].") AND topic_id!=".$topiclist['Topic']['id']." GROUP BY topic_id ORDER BY q desc";

			//get related topic id for each topic
                        $topic_temp_array = $this->TagsTopic->query($sql);

debug($topic_temp_array);

		}























/*
		$topics_array = array(); //list of all topics

		//get list of all topics
		//may need to separete the task because when topic is large enosh, array cloud have the cache problem
		$topics_array = $this->Topic->find('all',array('fields'=>array('id'), 'conditions'=>array('Topic.deleted'=>0, 'Topic.id <>'=>"1")));
		///for topic 1
                $related_topic_array = array('Relatedtopic'=>array(
                                        'id'=>1,
                                        'topic_id'=>1,
                                        'first'=>$this->_getRandomTopic(),
                                        'second'=>$this->_getRandomTopic(),
                                        'third'=>$this->_getRandomTopic(),
                                        'forth'=>$this->_getRandomTopic(),
                                        'fifth'=>$this->_getRandomTopic(),
                                        'sixth'=>$this->_getRandomTopic(),
                                        'seventh'=>$this->_getRandomTopic(),
                                        'eighth'=>$this->_getRandomTopic(),
                                        'ninth'=>$this->_getRandomTopic(),
                                        'tenth'=>$this->_getRandomTopic()
                                )
                  );

                  $this->Relatedtopic->create();
                  $this->Relatedtopic->save($related_topic_array);

		///for topics other than 1
		foreach($topics_array as $topiclist){
			$topics_users_array = array(); //list of topics and users
			$sql = "SELECT followingtopicid,userid FROM followingtopics WHERE followingtopicid=".$topiclist['Topic']['id']." AND deleted=0 GROUP BY userid";

			//get users for each topic
			$user_temp_array = $this->Followingtopics->query($sql);

			$users_array = array(); //list of users for each topic
			foreach($user_temp_array as $listuser_array){
				if(!empty($listuser_array)){
					$listuser = $listuser_array['followingtopics']['userid'];
					if(!empty($listuser)){
						//get topic ids form users who follow this topic
						$get_following_topic_sql ="SELECT followingtopicid FROM followingtopics WHERE userid=".$listuser." AND deleted=0 AND followingtopicid<>1 AND followingtopicid<>".$topiclist['Topic']['id']." GROUP BY followingtopicid";
						$user_following_topic_array = $this->Followingtopics->query($get_following_topic_sql);
						foreach($user_following_topic_array as $following_topic){
							$other_topicid = $following_topic['followingtopics']['followingtopicid'];
							//plus 1 if other user also follow the same topic
							if(!empty($topics_users_array[$other_topicid])){
								$topics_users_array[$other_topicid] = $topics_users_array[$other_topicid] + 1;
							}
							else{
								$topics_users_array[$other_topicid] = 1;
							}
						}
					}
				}
				else{
					$listuser = "";
				}
			}

			arsort($topics_users_array);
			$ranking_array=array_keys($topics_users_array);

			///insert related topics from 1 to 10 into the related_topics table
			$ranking_id = "";
			///get id if there is already record on the table
			$ranking_id_query = "SELECT id FROM relatedtopics WHERE topicid=".$topiclist['Topic']['id'];
			$ranking_id_array = $this->Relatedtopic->query($ranking_id_query);

			if(!empty($ranking_id_array)){$ranking_id=$ranking_id_array[0]['relatedtopics']['id'];}
			if(!empty($ranking_array[0])){$first=$ranking_array[0];}else{$first=$this->_getRandomTopic();}
			if(!empty($ranking_array[1])){$second=$ranking_array[1];}else{$second=$this->_getRandomTopic();}
			if(!empty($ranking_array[2])){$third=$ranking_array[2];}else{$third=$this->_getRandomTopic();}
			if(!empty($ranking_array[3])){$forth=$ranking_array[3];}else{$forth=$this->_getRandomTopic();}
			if(!empty($ranking_array[4])){$fifth=$ranking_array[4];}else{$fifth=$this->_getRandomTopic();}
			if(!empty($ranking_array[5])){$sixth=$ranking_array[5];}else{$sixth=$this->_getRandomTopic();}
			if(!empty($ranking_array[6])){$seveth=$ranking_array[6];}else{$seventh=$this->_getRandomTopic();}
			if(!empty($ranking_array[7])){$eighth=$ranking_array[7];}else{$eighth=$this->_getRandomTopic();}
			if(!empty($ranking_array[8])){$ninth=$ranking_array[8];}else{$ninth=$this->_getRandomTopic();}
			if(!empty($ranking_array[9])){$tenth=$ranking_array[9];}else{$tenth=$this->_getRandomTopic();}

			$related_topic_array = array('Relatedtopic'=>array(
					'id'=>$ranking_id,
					'topicid'=>(int)$topiclist['Topic']['id'],
*/
/*
					'first'=>$first,
					'second'=>$second,
					'third'=>$third,
					'forth'=>$forth,
					'fifth'=>$fifth,
					'sixth'=>$sixth,
					'seventh'=>$seventh,
					'eighth'=>$eighth,
					'ninth'=>$ninth,
					'tenth'=>$tenth
*/
/*
					'first'=>2,
					'second'=>6,
					'third'=>7,
					'forth'=>8,
					'fifth'=>3,
					'sixth'=>11,
					'seventh'=>9,
					'eighth'=>5,
					'ninth'=>17,
					'tenth'=>18
					
				)
			);

			$this->Relatedtopic->create();
			$this->Relatedtopic->save($related_topic_array);
		}
*/


/*
ob_start();  
var_dump($topics_users_array);  
$result =ob_get_contents();  
ob_end_clean();  
$filepath ="/var/tmp/test";
$fp = fopen($filepath, "w");
@fwrite($fp, $result);
fclose($fp);
*/

	}

	function _getRandomTopic(){
//		return 2;
	}
}
?>
