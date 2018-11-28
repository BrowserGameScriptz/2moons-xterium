<?php

class ShowComPage extends AbstractGamePage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
	}

	function show()
	{
		global $USER, $PLANET, $LNG;
		
		$act = HTTP::_GP('act', '');
		switch($act){
			case 'i' :
				//increase 
				$type = HTTP::_GP('type','');
				if(!empty($type) && ($type == 'attack' || $type == 'shield' || $type=='cargo' || $type == 'speed') && $USER['user_remain_points'] > 0){
					//type ok 
						$varianta = "user_".$type."_bonus";
						//$GLOBALS['DATABASE']->query("Update ".USERS." set `".$varianta."` = `".$varianta."` + 1, `user_remain_points` = `user_remain_points` -1 where `id` = ".$USER['id']." ;"); 
						echo json_encode(array('success' => true));
						die();
				}
				echo json_encode(array('success' => false));
				die();
			break;
			case 'unequip':
				//unequip an item
				$item_id = HTTP::_GP('item',0);
				$position_id = HTTP::_GP('position',0);
				if(!empty($item_id) && ($position_id>=1 && $position_id<=7)){
					UnEquip($item_id,$position_id);
					echo json_encode(array('success' => true));
					die();
				}else{
				echo json_encode(array('success' => false));
					die();
				}
				
			break;
		}
		$All_Slots = array();
		for($i=1;$i<8;$i++){
			if(!empty($USER['user_slot_inv_'.$i]))
				$All_Slots[$i] = ItemDetail($USER['user_slot_inv_'.$i]);
			else
				$All_Slots[$i] = array();
		}
		$this->tplObj->assign_vars(array(
			'slots' => $slots,
			'user_details' => $USER,
			'needed_xp' => $USER['user_level']*70+10,
			'all_slots' => $All_Slots,
			//'inv_items' => $All_Inventory_Items,
		));
		$this->display('page.commanderpage.default.tpl');
	}
}
?>