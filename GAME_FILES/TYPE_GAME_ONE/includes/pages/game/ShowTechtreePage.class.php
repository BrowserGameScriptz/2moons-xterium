<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan Kröpke
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package 2Moons
 * @author Jan Kröpke <info@2moons.cc>
 * @copyright 2012 Jan Kröpke <info@2moons.cc>
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.7.2 (2013-03-18)
 * @info $Id$
 * @link http://2moons.cc/
 */


class ShowTechtreePage extends AbstractGamePage
{
    public static $requireModule = MODULE_TECHTREE;

    function __construct()
    {
        parent::__construct();
    }

    function show()
    {
        global $resource, $requeriments, $reslist, $USER, $PLANET;
		
		$fleetId = array(210,212,202,203,204,205,229,209,206,207,208,217,215,213,211,220,224,219,223,225,226,214,216,230,227,228,222,218,221);
		$defenceId = array(401,402,403,420,405,404,406,416,421,417,418,412,410,413,422,419,414,415,407,408,409,411,502,503);
		
		
		$buildId = array_merge(array(0), $reslist['build']);
		$techId = array_merge(array(100), $reslist['tech']);
		$fleetId = array_merge(array(200), $fleetId);
		$defenseId = array_merge(array(400), $defenceId);
		$officerId = array_merge(array(600), $reslist['officier']);
        
		
		
		$techTreeListBuild = array();
		$techTreeListTech = array();
		$techTreeListFleet = array();
		$techTreeListDefense = array();
		$techTreeListOfficer = array();

        foreach($buildId as $elementId)
        {
			if($elementId == 7)
				continue;
				
            if(!isset($resource[$elementId]))
            {
                $techTreeListBuild[$elementId]	= $elementId;
            }
            else
            {
                $requirementsList	= array();
                if(isset($requeriments[$elementId]))
                {
                    foreach($requeriments[$elementId] as $requireID => $RedCount)
                    {
                        $requirementsList[$requireID]	= array(
                            'count' => $RedCount,
                            'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
                        );
                    }
                }

                $techTreeListBuild[$elementId]	= $requirementsList;
            }
        }
		
		foreach($techId as $elementId)
        {
            if(!isset($resource[$elementId]))
            {
                $techTreeListTech[$elementId]	= $elementId;
            }
            else
            {
                $requirementsList	= array();
                if(isset($requeriments[$elementId]))
                {
                    foreach($requeriments[$elementId] as $requireID => $RedCount)
                    {
                        $requirementsList[$requireID]	= array(
                            'count' => $RedCount,
                            'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
                        );
                    }
                }

                $techTreeListTech[$elementId]	= $requirementsList;
            }
        }
		
		foreach($fleetId as $elementId)
        {
            if(!isset($resource[$elementId]))
            {
                $techTreeListFleet[$elementId]	= $elementId;
            }
            else
            {
                $requirementsList	= array();
                if(isset($requeriments[$elementId]))
                {
                    foreach($requeriments[$elementId] as $requireID => $RedCount)
                    {
                        $requirementsList[$requireID]	= array(
                            'count' => $RedCount,
                            'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
                        );
                    }
                }

                $techTreeListFleet[$elementId]	= $requirementsList;
            }
        }
		
		foreach($defenseId as $elementId)
        {
            if(!isset($resource[$elementId]))
            {
                $techTreeListDefense[$elementId]	= $elementId;
            }
            else
            {
                $requirementsList	= array();
                if(isset($requeriments[$elementId]))
                {
                    foreach($requeriments[$elementId] as $requireID => $RedCount)
                    {
                        $requirementsList[$requireID]	= array(
                            'count' => $RedCount,
                            'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
                        );
                    }
                }

                $techTreeListDefense[$elementId]	= $requirementsList;
            }
        }
		
		foreach($officerId as $elementId)
        {
            if(!isset($resource[$elementId]))
            {
                $techTreeListOfficer[$elementId]	= $elementId;
            }
            else
            {
                $requirementsList	= array();
                if(isset($requeriments[$elementId]))
                {
                    foreach($requeriments[$elementId] as $requireID => $RedCount)
                    {
                        $requirementsList[$requireID]	= array(
                            'count' => $RedCount,
                            'own'   => isset($PLANET[$resource[$requireID]]) ? $PLANET[$resource[$requireID]] : $USER[$resource[$requireID]]
                        );
                    }
                }

                $techTreeListOfficer[$elementId]	= $requirementsList;
            }
        }
		
        $this->assign(array(
            'techTreeListBuild'		=> $techTreeListBuild,
            'techTreeListTech'		=> $techTreeListTech,
            'techTreeListFleet'		=> $techTreeListFleet,
            'techTreeListDefense'	=> $techTreeListDefense,
            'techTreeListOfficer'	=> $techTreeListOfficer,
        ));
		$this->tplObj->loadscript('techtree.js');
        $this->display('page.techTree.default.tpl');
    }
}
