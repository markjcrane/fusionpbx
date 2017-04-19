<?php
/*
	FusionPBX
	Version: MPL 1.1

	The contents of this file are subject to the Mozilla Public License Version
	1.1 (the "License"); you may not use this file except in compliance with
	the License. You may obtain a copy of the License at
	http://www.mozilla.org/MPL/

	Software distributed under the License is distributed on an "AS IS" basis,
	WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
	for the specific language governing rights and limitations under the
	License.

	The Original Code is FusionPBX

	The Initial Developer of the Original Code is
	Mark J Crane <markjcrane@fusionpbx.com>
	Portions created by the Initial Developer are Copyright (C) 2016
	the Initial Developer. All Rights Reserved.

	Contributor(s):
	Mark J Crane <markjcrane@fusionpbx.com>
*/

//includes
	require_once "root.php";
	require_once "resources/require.php";

//check permissions
	require_once "resources/check_auth.php";
	if (permission_exists('sip_profile_domain_delete')) {
		//access granted
	}
	else {
		echo "access denied";
		exit;
	}

//add multi-lingual support
	$language = new text;
	$text = $language->get();

	$sip_profile_uuid=@$_GET['sip_profile_uuid'];
	$sip_profile_domain_uuid=@$_GET['id'];

//delete the data
	if (is_uuid($sip_profile_uuid) && is_uuid($sip_profile_domain_uuid)) {
		//delete sip_profile_domain
			$sql = "delete from v_sip_profile_domains ";
			$sql .= "where sip_profile_uuid = '$sip_profile_uuid' and sip_profile_domain_uuid = '$sip_profile_domain_uuid' ";
			$prep_statement = $db->prepare(check_sql($sql));
			$prep_statement->execute();
			unset($sql);
			unset($prep_statement);
	}

//redirect the user
	if (is_uuid($sip_profile_uuid)) {
		$_SESSION['message'] = $text['message-delete'];
		header('Location: sip_profile_edit.php?id='.$sip_profile_uuid);
	}

?>
