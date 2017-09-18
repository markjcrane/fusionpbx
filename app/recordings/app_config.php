<?php

	//application details
		$apps[$x]['name'] = "Recordings";
		$apps[$x]['uuid'] = "83913217-c7a2-9e90-925d-a866eb40b60e";
		$apps[$x]['category'] = "Switch";;
		$apps[$x]['subcategory'] = "";
		$apps[$x]['version'] = "";
		$apps[$x]['license'] = "Mozilla Public License 1.1";
		$apps[$x]['url'] = "http://www.fusionpbx.com";
		$apps[$x]['description']['en-us'] = "Manager recordings primarily used with an IVR.";
		$apps[$x]['description']['es-cl'] = "Administrador de grabaciones, utilizadas primordialmente con un IVR";
		$apps[$x]['description']['es-mx'] = "";
		$apps[$x]['description']['de-de'] = "";
		$apps[$x]['description']['de-ch'] = "";
		$apps[$x]['description']['de-at'] = "";
		$apps[$x]['description']['fr-fr'] = "Gestion des enregistrements principalement utilisés dans les IVR";
		$apps[$x]['description']['fr-ca'] = "";
		$apps[$x]['description']['fr-ch'] = "";
                $apps[$x]['description']['it-it'] = "";
		$apps[$x]['description']['pt-pt'] = "Gestor de gravações utilizadas principalmente com um IVR.";
		$apps[$x]['description']['pt-br'] = "";

	//destination details
		$y = 0;
		$apps[$x]['destinations'][$y]['type'] = "sql";
		$apps[$x]['destinations'][$y]['label'] = "recordings";
		$apps[$x]['destinations'][$y]['name'] = "recordings";
		$apps[$x]['destinations'][$y]['sql'] = "select recording_uuid as uuid, recording_name as name, recording_filename as destination, recording_description as description from v_recordings";
		$apps[$x]['destinations'][$y]['where'] = "where domain_uuid = '\${domain_uuid}' ";
		$apps[$x]['destinations'][$y]['order_by'] = "recording_name asc";
		$apps[$x]['destinations'][$y]['field']['uuid'] = "recording_uuid";
		$apps[$x]['destinations'][$y]['field']['name'] = "recording_name";
		$apps[$x]['destinations'][$y]['field']['destination'] = "recording_filename";
		$apps[$x]['destinations'][$y]['field']['description'] = "recording_description";
		$apps[$x]['destinations'][$y]['select_value']['dialplan'] = "lua:streamfile.lua \${destination}";
		$apps[$x]['destinations'][$y]['select_value']['ivr'] = "menu-exec-app:lua streamfile.lua \${destination}";
		$apps[$x]['destinations'][$y]['select_label'] = "\${name}";

	//permission details
		$apps[$x]['permissions'][0]['name'] = "recording_view";
		$apps[$x]['permissions'][0]['menu']['uuid'] = "e4290fd2-3ccc-a758-1714-660d38453104";
		$apps[$x]['permissions'][0]['groups'][] = "admin";
		$apps[$x]['permissions'][0]['groups'][] = "superadmin";

		$apps[$x]['permissions'][1]['name'] = "recording_add";
		$apps[$x]['permissions'][1]['groups'][] = "admin";
		$apps[$x]['permissions'][1]['groups'][] = "superadmin";

		$apps[$x]['permissions'][2]['name'] = "recording_edit";
		$apps[$x]['permissions'][2]['groups'][] = "admin";
		$apps[$x]['permissions'][2]['groups'][] = "superadmin";

		$apps[$x]['permissions'][3]['name'] = "recording_delete";
		$apps[$x]['permissions'][3]['groups'][] = "admin";
		$apps[$x]['permissions'][3]['groups'][] = "superadmin";

		$apps[$x]['permissions'][4]['name'] = "recording_upload";
		$apps[$x]['permissions'][4]['groups'][] = "admin";
		$apps[$x]['permissions'][4]['groups'][] = "superadmin";

		$apps[$x]['permissions'][5]['name'] = "recording_play";
		$apps[$x]['permissions'][5]['groups'][] = "user";
		$apps[$x]['permissions'][5]['groups'][] = "admin";
		$apps[$x]['permissions'][5]['groups'][] = "superadmin";

		$apps[$x]['permissions'][6]['name'] = "recording_download";
		$apps[$x]['permissions'][6]['groups'][] = "user";
		$apps[$x]['permissions'][6]['groups'][] = "admin";
		$apps[$x]['permissions'][6]['groups'][] = "superadmin";

	//default settings
		$y = 0;
		$apps[$x]['default_settings'][$y]['default_setting_uuid'] = 'a780b88f-188b-4d73-a1df-f93a114ca16d';
		$apps[$x]['default_settings'][$y]['default_setting_category'] = 'recordings';
		$apps[$x]['default_settings'][$y]['default_setting_subcategory'] = 'storage_type';
		$apps[$x]['default_settings'][$y]['default_setting_name'] = 'text';
		$apps[$x]['default_settings'][$y]['default_setting_value'] = 'base64';
		$apps[$x]['default_settings'][$y]['default_setting_enabled'] = 'false';
		$apps[$x]['default_settings'][$y]['default_setting_description'] = '';
		$y++;

	//schema details
		$y = 0; //table array index
		$z = 0; //field array index
		$apps[$x]['db'][$y]['table'] = "v_recordings";
		$apps[$x]['db'][$y]['fields'][$z]['name']['text'] = "id";
		$apps[$x]['db'][$y]['fields'][$z]['name']['deprecated'] = "recording_id";
		$apps[$x]['db'][$y]['fields'][$z]['type']['pgsql'] = "serial";
		$apps[$x]['db'][$y]['fields'][$z]['type']['sqlite'] = "integer";
		$apps[$x]['db'][$y]['fields'][$z]['type']['mysql'] = "INT NOT NULL AUTO_INCREMENT";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "";
		$apps[$x]['db'][$y]['fields'][$z]['deprecated'] = "true";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "recording_uuid";
		$apps[$x]['db'][$y]['fields'][$z]['type']['pgsql'] = "uuid";
		$apps[$x]['db'][$y]['fields'][$z]['type']['sqlite'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['type']['mysql'] = "char(36)";
		$apps[$x]['db'][$y]['fields'][$z]['key']['type'] = "primary";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "domain_uuid";
		$apps[$x]['db'][$y]['fields'][$z]['type']['pgsql'] = "uuid";
		$apps[$x]['db'][$y]['fields'][$z]['type']['sqlite'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['type']['mysql'] = "char(36)";
		$apps[$x]['db'][$y]['fields'][$z]['key']['type'] = "foreign";
		$apps[$x]['db'][$y]['fields'][$z]['key']['reference']['table'] = "v_domains";
		$apps[$x]['db'][$y]['fields'][$z]['key']['reference']['field'] = "domain_uuid";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "v_id";
		$apps[$x]['db'][$y]['fields'][$z]['type'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "";
		$apps[$x]['db'][$y]['fields'][$z]['deprecated'] = "true";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name']['text'] = "recording_filename";
		$apps[$x]['db'][$y]['fields'][$z]['name']['deprecated'] = "filename";
		$apps[$x]['db'][$y]['fields'][$z]['type'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name']['text'] = "recording_name";
		$apps[$x]['db'][$y]['fields'][$z]['name']['deprecated'] = "recordingname";
		$apps[$x]['db'][$y]['fields'][$z]['type'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name']['text'] = "recording_description";
		$apps[$x]['db'][$y]['fields'][$z]['name']['deprecated'] = "descr";
		$apps[$x]['db'][$y]['fields'][$z]['type'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "recording_base64";
		$apps[$x]['db'][$y]['fields'][$z]['type'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "Recording file encoded in base64.";
		$z++;

?>
