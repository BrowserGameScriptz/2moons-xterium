<?php

/**
 *  2Moons
 *  Copyright (C) 2012 Jan
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
 * @author Jan <info@2moons.cc>
 * @copyright 2006 Perberos <ugamela@perberos.com.ar> (UGamela)
 * @copyright 2008 Chlorel (XNova)
 * @copyright 2012 Jan <info@2moons.cc> (2Moons)
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 2.0.$Revision: 2242 $ (2012-11-31)
 * @info $Id$
 * @link http://2moons.cc/
 */


class ShowChangemailPage extends AbstractLoginPage
{
	public static $requireModule = 0;

	function __construct() 
	{
		parent::__construct();
		$this->setWindow('light');
	}
	
	function disposablecheck($email) { $blacklist = array( "0815.ru0clickemail.com", "0wnd.net", "0wnd.org", "10minutemail.com", "20minutemail.com", "2prong.com", "3d-painting.com", "4warding.com", "4warding.net", "4warding.org", "9ox.net", "a-bc.net", "amilegit.com", "anonbox.net", "anonymbox.com", "antichef.com", "antichef.net", "antispam.de", "baxomale.ht.cx", "beefmilk.com", "binkmail.com", "bio-muesli.net", "bobmail.info", "bodhi.lawlita.com", "bofthew.com", "brefmail.com", "bsnow.net", "bugmenot.com", "bumpymail.com", "casualdx.com", "chogmail.com", "cool.fr.nf", "correo.blogos.net", "cosmorph.com", "courriel.fr.nf", "courrieltemporaire.com", "curryworld.de", "cust.in", "dacoolest.com", "dandikmail.com", "deadaddress.com", "despam.it", "devnullmail.com", "dfgh.net", "digitalsanctuary.com", "discardmail.com", "discardmail.de", "disposableaddress.com", "disposemail.com", "dispostable.com", "dm.w3internet.co.uk example.com", "dodgeit.com", "dodgit.com", "dodgit.org", "dontreg.com", "dontsendmespam.de", "dump-email.info", "dumpyemail.com", "e4ward.com", "email60.com", "emailias.com", "emailinfive.com", "emailmiser.com", "emailtemporario.com.br", "emailwarden.com", "ephemail.net", "explodemail.com", "fakeinbox.com", "fakeinformation.com", "fastacura.com", "filzmail.com", "fizmail.com", "frapmail.com", "garliclife.com", "get1mail.com", "getonemail.com", "getonemail.net", "girlsundertheinfluence.com", "gishpuppy.com", "great-host.in", "gsrv.co.uk", "guerillamail.biz", "guerillamail.com", "guerillamail.net", "guerillamail.org", "guerrillamail.com", "guerrillamailblock.com", "haltospam.com", "hotpop.com", "ieatspam.eu", "ieatspam.info", "ihateyoualot.info", "imails.info", "inboxclean.com", "inboxclean.org", "incognitomail.com", "incognitomail.net", "ipoo.org", "irish2me.com", "jetable.com", "jetable.fr.nf", "jetable.net", "jetable.org", "junk1e.com", "kaspop.com", "kulturbetrieb.info", "kurzepost.de", "lifebyfood.com", "link2mail.net", "litedrop.com", "lookugly.com", "lopl.co.cc", "lr78.com", "maboard.com", "mail.by", "mail.mezimages.net", "mail4trash.com", "mailbidon.com", "mailcatch.com", "maileater.com", "mailexpire.com", "mailin8r.com", "mailinator.com", "mailinator.net", "mailinator2.com", "mailincubator.com", "mailme.lv", "mailnator.com", "mailnull.com", "mailzilla.org", "mbx.cc", "mega.zik.dj", "meltmail.com", "mierdamail.com", "mintemail.com", "moncourrier.fr.nf", "monemail.fr.nf", "monmail.fr.nf", "mt2009.com", "mx0.wwwnew.eu", "mycleaninbox.net", "mytrashmail.com", "neverbox.com", "nobulk.com", "noclickemail.com", "nogmailspam.info", "nomail.xl.cx", "nomail2me.com", "no-spam.ws", "nospam.ze.tc", "nospam4.us", "nospamfor.us", "nowmymail.com", "objectmail.com", "obobbo.com", "onewaymail.com", "ordinaryamerican.net", "owlpic.com", "pookmail.com", "proxymail.eu", "punkass.com", "putthisinyourspamdatabase.com", "quickinbox.com", "rcpt.at", "recode.me", "recursor.net", "regbypass.comsafe-mail.net", "safetymail.info", "sandelf.de", "saynotospams.com", "selfdestructingmail.com", "sendspamhere.com", "shiftmail.com", "****mail.me", "skeefmail.com", "slopsbox.com", "smellfear.com", "snakemail.com", "sneakemail.com", "sofort-mail.de", "sogetthis.com", "soodonims.com", "spam.la", "spamavert.com", "spambob.net", "spambob.org", "spambog.com", "spambog.de", "spambog.ru", "spambox.info", "spambox.us", "spamcannon.com", "spamcannon.net", "spamcero.com", "spamcorptastic.com", "spamcowboy.com", "spamcowboy.net", "spamcowboy.org", "spamday.com", "spamex.com", "spamfree24.com", "spamfree24.de", "spamfree24.eu", "spamfree24.info", "spamfree24.net", "spamfree24.org", "spamgourmet.com", "spamgourmet.net", "spamgourmet.org", "spamherelots.com", "spamhereplease.com", "spamhole.com", "spamify.com", "spaminator.de", "spamkill.info", "spaml.com", "spaml.de", "spammotel.com", "spamobox.com", "spamspot.com", "spamthis.co.uk", "spamthisplease.com", "speed.1s.fr", "suremail.info", "tempalias.com", "tempemail.biz", "tempemail.com", "tempe-mail.com", "tempemail.net", "tempinbox.co.uk", "tempinbox.com", "tempomail.fr", "temporaryemail.net", "temporaryinbox.com", "thankyou2010.com", "thisisnotmyrealemail.com", "throwawayemailaddress.com", "tilien.com", "tmailinator.com", "tradermail.info", "trash2009.com", "trash-amil.com", "trashmail.at", "trash-mail.at", "trashmail.com", "trash-mail.com", "trash-mail.de", "trashmail.me", "trashmail.net", "trashymail.com", "trashymail.net", "tyldd.com", "uggsrock.com", "wegwerfmail.de", "wegwerfmail.net", "wegwerfmail.org", "wh4f.org", "whyspam.me", "willselfdestruct.com", "winemaven.info", "wronghead.com", "wuzupmail.net", "xoxy.net", "yogamaven.com", "yopmail.com", "yopmail.fr", "yopmail.net", "yuurok.com", "zippymail.info", "jnxjn.com", "trashmailer.com", "klzlk.com", "trbvn.com", "trbvo.com" ); 
	$email_split = explode('@', $email); 
	$email_domain = $email_split[1]; 
	if (in_array($email_domain, $blacklist)) 
	{ //Return 1, disposable email detected 
	return 1; } else { 
	//Return 0, no match found 
	return 0; } }
	
	function show() 
	{
		global $LNG;

		$session = session::load();
		if(!$session->isValidSession())
		{
			$session->delete();			
			$this->assign(array(
			));
		
			$this->display('page.lobby.notlogged.tpl');
		}else{
		
			$this->assign(array(
			));
		
			$this->display('page.lobby.changemail.tpl');
		}

	}
	
	function send() 
	{
		global $LNG;
		
		$session = session::load();
		if(!$session->isValidSession())
		{
			$session->delete();			
			$this->assign(array(
			));
			$this->display('page.lobby.notlogged.tpl');
		}else{
		
			$email			= HTTP::_GP('email_1', '');
			$newemail		= HTTP::_GP('email_2', '');
			$Positive 			= 0;
			$sql	= "SELECT * FROM %%USERS%% WHERE id = :userId;";
			$AccountInf	= database::get()->selectSingle($sql, array(
				':userId'	=> $session->userId
			)); 
			
			$errors = $LNG['lobby_23'];
			
			if (!empty($newemail) && $email == $AccountInf['email'] && $newemail != $email)
			{
				if(!PlayerUtil::isMailValid($newemail)) {
					$Positive	 = 0;
					$errors	= $LNG['registerErrorMailInvalid'];
				}
				elseif ($this->disposablecheck($newemail) == 1) { 
					$Positive	 = 0;
					$errors	= $LNG['registerErrorMailInvalid'];
				}
				else
				{
					$sql = "SELECT
							(SELECT COUNT(*) FROM %%USERS%% WHERE (email = :email OR email_2 = :email)) +
							(SELECT COUNT(*) FROM %%USERS_VALID%% WHERE email = :email)
							as count";
					$Count = database::get()->selectSingle($sql, array(
						':email'	=> $newemail
					), 'count');

					if (!empty($Count)) {
						$Positive	 = 0;
						$errors = sprintf($LNG['op_change_mail_exist'], $newemail);
					} else {
						$Positive	 = 1;
						$sql	= "UPDATE %%USERS%% SET email = :email, email_2 = :email, setmail = :time WHERE id = :userID;";
						database::get()->update($sql, array(
							':email'	=> $newemail,
							':time'		=> (TIMESTAMP + 604800),
							':userID'	=> $AccountInf['id']
						));
					}
				}
			}
			
			$this->assign(array(
			'Positive'		=> $Positive == 0 ? $errors : $LNG['lobby_24'],
			));
		
			$this->display('page.lobby.passchanged.tpl');
		}
	}
}