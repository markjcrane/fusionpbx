<?php

	//application details
		$apps[$x]['name'] = "Database Transactions";
		$apps[$x]['uuid'] = "de47783c-1caa-4b3e-9b51-ad6c9e69215c";
		$apps[$x]['category'] = "";
		$apps[$x]['subcategory'] = "";
		$apps[$x]['version'] = "1.0";
		$apps[$x]['license'] = "Mozilla Public License 1.1";
		$apps[$x]['url'] = "http://www.fusionpbx.com";
		$apps[$x]['description']['en-us'] = "Track database transactions";
		$apps[$x]['description']['ar-eg'] = "";
		$apps[$x]['description']['de-at'] = "Datenbank Transaktionen verfolgen";
		$apps[$x]['description']['de-ch'] = "";
		$apps[$x]['description']['de-de'] = "Datenbank Transaktionen verfolgen";
		$apps[$x]['description']['es-cl'] = "";
		$apps[$x]['description']['es-mx'] = "";
		$apps[$x]['description']['fr-ca'] = "";
		$apps[$x]['description']['fr-fr'] = "";
		$apps[$x]['description']['he-il'] = "";
		$apps[$x]['description']['it-it'] = "";
		$apps[$x]['description']['nl-nl'] = "";
		$apps[$x]['description']['pl-pl'] = "";
		$apps[$x]['description']['pt-br'] = "";
		$apps[$x]['description']['pt-pt'] = "";
		$apps[$x]['description']['ro-ro'] = "";
		$apps[$x]['description']['ru-ru'] = "";
		$apps[$x]['description']['sv-se'] = "";
		$apps[$x]['description']['uk-ua'] = "";


	//permission details
		$y=0;
		$apps[$x]['permissions'][$y]['name'] = "database_transaction_view";
		$apps[$x]['permissions'][$y]['groups'][] = "superadmin";
		//$apps[$x]['permissions'][$y]['groups'][] = "user";
		//$apps[$x]['permissions'][$y]['groups'][] = "admin";
		$y++;
		$apps[$x]['permissions'][$y]['name'] = "database_transaction_add";
		$apps[$x]['permissions'][$y]['groups'][] = "superadmin";
		//$apps[$x]['permissions'][$y]['groups'][] = "admin";
		$y++;
		$apps[$x]['permissions'][$y]['name'] = "database_transaction_edit";
		$apps[$x]['permissions'][$y]['groups'][] = "superadmin";
		//$apps[$x]['permissions'][$y]['groups'][] = "admin";
		//$apps[$x]['permissions'][$y]['groups'][] = "user";
		$y++;
		$apps[$x]['permissions'][$y]['name'] = "database_transaction_delete";
		//$apps[$x]['permissions'][$y]['groups'][] = "superadmin";
		//$apps[$x]['permissions'][$y]['groups'][] = "admin";
		$y++;

	//schema details
		$y=0;
		$apps[$x]['db'][$y]['table']['name'] = "v_database_transactions";
		$apps[$x]['db'][$y]['table']['parent'] = "";
		$z=0;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "domain_uuid";
		$apps[$x]['db'][$y]['fields'][$z]['type']['pgsql'] = "uuid";
		$apps[$x]['db'][$y]['fields'][$z]['type']['sqlite'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['type']['mysql'] = "char(36)";
		$apps[$x]['db'][$y]['fields'][$z]['key']['type'] = "foreign";
		$apps[$x]['db'][$y]['fields'][$z]['key']['reference']['table'] = "v_domains";
		$apps[$x]['db'][$y]['fields'][$z]['key']['reference']['field'] = "domain_uuid";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "database_transaction_uuid";
		$apps[$x]['db'][$y]['fields'][$z]['type']['pgsql'] = "uuid";
		$apps[$x]['db'][$y]['fields'][$z]['type']['sqlite'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['type']['mysql'] = "char(36)";
		$apps[$x]['db'][$y]['fields'][$z]['key']['type'] = "primary";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "user_uuid";
		$apps[$x]['db'][$y]['fields'][$z]['type']['pgsql'] = "uuid";
		$apps[$x]['db'][$y]['fields'][$z]['type']['sqlite'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['type']['mysql'] = "char(36)";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "User transaction.";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "app_name";
		$apps[$x]['db'][$y]['fields'][$z]['type'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "Application name.";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "app_uuid";
		$apps[$x]['db'][$y]['fields'][$z]['type']['pgsql'] = "uuid";
		$apps[$x]['db'][$y]['fields'][$z]['type']['sqlite'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['type']['mysql'] = "char(36)";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "Application ID";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "transaction_code";
		$apps[$x]['db'][$y]['fields'][$z]['type'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "Transaction code.";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "transaction_address";
		$apps[$x]['db'][$y]['fields'][$z]['type'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "IP address of the user.";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "transaction_type";
		$apps[$x]['db'][$y]['fields'][$z]['type'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "Type: insert, update, delete, select";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "transaction_date";
		$apps[$x]['db'][$y]['fields'][$z]['type'] = "timestamp";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "Transaction date.";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "transaction_old";
		$apps[$x]['db'][$y]['fields'][$z]['type']['pgsql'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['type']['sqlite'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['type']['mysql'] = "longtext";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "Before the transaction.";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "transaction_new";
		$apps[$x]['db'][$y]['fields'][$z]['type']['pgsql'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['type']['sqlite'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['type']['mysql'] = "longtext";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "After the transaction.";
		$z++;
		$apps[$x]['db'][$y]['fields'][$z]['name'] = "transaction_result";
		$apps[$x]['db'][$y]['fields'][$z]['type']['pgsql'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['type']['sqlite'] = "text";
		$apps[$x]['db'][$y]['fields'][$z]['type']['mysql'] = "longtext";
		$apps[$x]['db'][$y]['fields'][$z]['description']['en-us'] = "Result of the transaction.";

?>
