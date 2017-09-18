<?php

	//application details
		$apps[$x]['name'] = "Outbound Routes";
		$apps[$x]['uuid'] = "8c914ec3-9fc0-8ab5-4cda-6c9288bdc9a3";
		$apps[$x]['category'] = "Switch";
		$apps[$x]['subcategory'] = "";
		$apps[$x]['version'] = "";
		$apps[$x]['license'] = "Mozilla Public License 1.1";
		$apps[$x]['url'] = "http://www.fusionpbx.com";
		$apps[$x]['description']['en-us'] = "Outbound dialplans have one or more conditions that are matched to attributes of a call. When a call matches the conditions the call is then routed to the gateway.";
		$apps[$x]['description']['es-cl'] = "Los planes de marcado de salida tienen una o más condiciones que deben cumplirse.  Cuando las condiciones se cumplen, las llamada es dirigida con la pasarela seleccionada.";
		$apps[$x]['description']['es-mx'] = "Los planes de marcado de salida tienen una o más condiciones que deben cumplirse.  Cuando las condiciones se cumplen, las llamada es dirigida con la pasarela seleccionada.";
		$apps[$x]['description']['de-de'] = "";
		$apps[$x]['description']['de-ch'] = "";
		$apps[$x]['description']['de-at'] = "";
		$apps[$x]['description']['fr-fr'] = "Les routes sortantes acheminent un appel en fonction d'une ou plusieurs conditions. Quand les conditions sont remplies, l'appel est dirigés vers la passerelle correspondante.";
		$apps[$x]['description']['fr-ca'] = "Les routes sortantes ont une ou plus conditions qui devent répondre.  Quand les conditions son tout répondres, l'appel est dirigers vers la passarelle séléctioné.";
		$apps[$x]['description']['fr-ch'] = "";
                $apps[$x]['description']['it-it'] = "";
		$apps[$x]['description']['pt-pt'] = "Dialplans de saída tem uma ou mais condições que são compatíveis com os atributos de uma chamada. Quando uma chamada coincide com as condições da chamada é então encaminhado para o gateway.";
		$apps[$x]['description']['pt-br'] = "";

	//permission details
		$apps[$x]['permissions'][0]['name'] = "outbound_route_view";
		$apps[$x]['permissions'][0]['menu']['uuid'] = "17e14094-1d57-1106-db2a-a787d34015e9";
		$apps[$x]['permissions'][0]['groups'][] = "superadmin";

		$apps[$x]['permissions'][1]['name'] = "outbound_route_add";
		$apps[$x]['permissions'][1]['groups'][] = "superadmin";

		$apps[$x]['permissions'][2]['name'] = "outbound_route_edit";
		$apps[$x]['permissions'][2]['groups'][] = "superadmin";

		$apps[$x]['permissions'][3]['name'] = "outbound_route_delete";
		$apps[$x]['permissions'][3]['groups'][] = "superadmin";

		$apps[$x]['permissions'][4]['name'] = "outbound_route_copy";
		$apps[$x]['permissions'][4]['groups'][] = "superadmin";

		$apps[$x]['permissions'][5]['name'] = "outbound_route_any_gateway";
		$apps[$x]['permissions'][5]['groups'][] = "superadmin";
		$apps[$x]['permissions'][5]['description'] = "Add outbound routes for any gateways on any domain.";

		$apps[$x]['permissions'][6]['name'] = "outbound_route_toll_allow_lua";

?>
