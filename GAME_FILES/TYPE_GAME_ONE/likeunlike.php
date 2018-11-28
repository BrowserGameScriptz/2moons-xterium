<?php

define('MODE', 'INGAME');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';


$postid        = HTTP::_GP('postid', 0); //comment id
$type          = HTTP::_GP('type ', 1); // 0 = unlike && 1 = like

$sql = "SELECT * FROM %%COMMENTSHOF%% WHERE id = :postid;";
$Comment	= database::get()->selectSingle($sql, array(
	':postid'	=> $postid
));

if(empty($Comment)){
	continue;
}else{

	$LikedQueue		= explode(';', $Comment['likeinfo']);
	$LikeArray		= array();
	$NewQueue		= array();
	
	if(!empty($Comment['likeinfo'])){
		foreach($LikedQueue as $Like)
		{
			$temp = explode(',', $Like);
			$LikeArray[] 		= array($temp[0], $temp[1]);
		}

		foreach($LikeArray as $Like)
		{
			$isLiking		= 1;
			if($Like[0] != $USER['id'])
				$NewQueue[]	= $Like[0].','.$Like[1];
			if($Like[0] == $USER['id'])
				$isLiking = 0;
		}
		
		if($isLiking == 1)	
			$NewQueue[]	= $USER['id'].','.$USER['username'];
		
	}else{
		$isLiking		= 1;
		$NewQueue[]	= $USER['id'].','.$USER['username'];
	}
	
	$sql = "UPDATE %%COMMENTSHOF%% SET likeCount = likeCount + :likeCount, likeinfo = :likeinfo WHERE id = :postid;";
	database::get()->update($sql, array(
		':postid'	=> $postid,
		':likeCount'=> $isLiking == 0 ? -1 : 1,
		':likeinfo'	=> !empty($NewQueue) ? implode(';', $NewQueue) : '',
		
	));  
}	

// count numbers of like and unlike in post
$sql = "SELECT * FROM %%COMMENTSHOF%% WHERE id = :postid;";
$Comment	= database::get()->selectSingle($sql, array(
	':postid'	=> $postid
));

$totalLikes = $Comment['likeCount'];
$totalUnlikes = $Comment['likeCount'];

// initalizing array
$return_arr = array("likes"=>$totalLikes,"unlikes"=>$totalUnlikes,"type"=>$isLiking);

echo json_encode($return_arr);
?>