<?php
 
class DataLogger
{
	private $data	= array();

	function __construct() {
		$this->data['player']	= Session::load()->userId;
		$this->data['uni']		= Universe::getEmulated();
	}
	
	function save() {
		$data = serialize(array($this->data['old'], $this->data['new']));
		$uni = (empty($this->data['universe']) ? $this->data['uni'] : $this->data['universe']);
		
		$sql = "INSERT INTO %%QUERIESLOG%% SET userId = :userId, queryType = :queryType, queryComplete = :queryComplete;";
		database::get()->insert($sql, array(
			':userId'			=> $this->data['player'],
			':queryType'		=> $this->data['player'],
			':queryComplete'	=> $data,
		));
	}
}