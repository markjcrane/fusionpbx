<configuration name="lcr.conf" description="LCR Configuration">
  <settings>
    <param name="odbc-dsn" value="fusionpbx:fusionpbx:c4rl0s3l4rt1st4"/>
    <param name="limit_type" value="db"/>
  </settings>
  <profiles>
    <profile name="default">
      <param name="custom_sql" value="
SELECT 
       l.digits AS lcr_digits,
       c.carrier_name AS lcr_carrier_name,
       c.priority AS lcr_carrier_priority,
       l.rate as lcr_rate_field,
       l.rate as lcr_rate,
       l.connect_rate as lcr_second_rate,
       cg.prefix AS lcr_gw_prefix, 
       cg.suffix AS lcr_gw_suffix,
       cg.priority AS lcr_carrier_gateway_priority,
       l.lead_strip AS lcr_lead_strip, 
       l.trail_strip AS lcr_trail_strip,
       l.prefix AS lcr_prefix, 
       l.suffix AS lcr_suffix, 
       cg.codec AS lcr_codec,
       (SELECT rate FROM v_lcr INNER JOIN v_billings on v_billings.lcr_profile = v_lcr.lcr_profile WHERE v_lcr.carrier_uuid IS NULL AND v_lcr.lcr_direction = 'outbound' AND v_lcr.digits::bigint  IN (${lcr_query_expanded_digits}) AND v_billings.type_value='${accountcode}' ORDER BY digits DESC, rate ASC LIMIT 1) AS lcr_user_rate,
       (SELECT connect_rate FROM v_lcr INNER JOIN v_billings on v_billings.lcr_profile = v_lcr.lcr_profile WHERE v_lcr.carrier_uuid IS NULL AND v_lcr.lcr_direction = 'outbound' AND v_lcr.digits::bigint  IN (${lcr_query_expanded_digits}) AND v_billings.type_value='${accountcode}' ORDER BY digits DESC, rate ASC LIMIT 1) AS lcr_user_second_rate,
       'carriers' AS lcr_limit_realm, 
       c.carrier_name AS lcr_limit_id, 
       c.carrier_channels AS lcr_limit_max,
       a.type_value as nibble_account,
       l.connect_increment as lcr_first_increment,
       l.talk_increment as lcr_second_increment,
       (SELECT connect_increment FROM v_lcr WHERE carrier_uuid IS NULL AND digits::bigint IN (${lcr_query_expanded_digits}) ORDER BY digits DESC, rate ASC limit 1) AS lcr_user_first_increment,
       (SELECT talk_increment FROM v_lcr WHERE carrier_uuid IS NULL AND digits::bigint IN (${lcr_query_expanded_digits}) ORDER BY digits DESC, rate ASC limit 1) AS lcr_user_second_increment,
       (SELECT CASE WHEN credit_type='postpaid' THEN credit ELSE -0.01 END FROM v_billings WHERE type_value='${accountcode}') as nobal_amt,
       (SELECT CASE WHEN credit_type='postpaid' THEN credit ELSE -0.01 END FROM v_billings WHERE type_value='${accountcode}') as lowbal_amt,
        '${for_fax}' as fax
  FROM v_lcr l
    JOIN v_carriers c ON l.carrier_uuid=c.carrier_uuid
    JOIN v_carrier_gateways cg ON c.carrier_uuid=cg.carrier_uuid
    JOIN v_billings a ON a.type_value='${accountcode}'
  WHERE c.enabled = 'true' 
    AND cg.enabled = 'true'
    AND l.enabled = 'true' 
    AND l.lcr_direction = 'outbound'
    AND NOW() >= l.date_start
    AND NOW() < l.date_end
    AND l.digits = (SELECT MAX(digits) AS max FROM v_lcr lll WHERE lll.enabled='true' AND lll.digits::bigint IN (${lcr_query_expanded_digits}) AND lll.lcr_direction = 'outbound' AND lll.carrier_uuid = c.carrier_uuid)
  ORDER BY c.priority ASC, lcr_rate_field ASC, l.digits DESC,  l.date_start DESC, cg.priority ASC;
      "/>
    <param name="export_fields" value="nibble_account,nibble_rate,lcr_first_increment,lcr_second_increment,lcr_user_first_increment,lcr_user_second_increment,nobal_amt,lowbal_amt,lcr_user_rate,lcr_user_second_rate,lcr_rate,lcr_second_rate,lcr_carrier_priority,lcr_carrier_gateway_priority"/>
    </profile>

    <profile name="nobill">
      <param name="custom_sql" value="
SELECT 
       l.digits AS lcr_digits,
       c.carrier_name AS lcr_carrier_name,
       c.priority AS lcr_carrier_priority,
       l.rate as lcr_rate_field,
       l.rate as lcr_rate,
       l.connect_rate as lcr_second_rate,
       cg.prefix AS lcr_gw_prefix, 
       cg.suffix AS lcr_gw_suffix,
       cg.priority AS lcr_carrier_gateway_priority,
       l.lead_strip AS lcr_lead_strip,
       l.trail_strip AS lcr_trail_strip,
       l.prefix AS lcr_prefix,
       l.suffix AS lcr_suffix,
       cg.codec AS lcr_codec,
       0 AS lcr_user_rate,
       'carriers' AS lcr_limit_realm,
       c.carrier_name AS lcr_limit_id,
       c.carrier_channels AS lcr_limit_max,
       0 AS nibble_rate,
       l.connect_increment as lcr_first_increment,
       l.talk_increment as lcr_second_increment,
       (SELECT connect_increment FROM v_lcr WHERE carrier_uuid IS NULL AND digits::bigint IN (${lcr_query_expanded_digits}) ORDER BY digits DESC, rate ASC limit 1) AS lcr_user_first_increment,
       (SELECT talk_increment FROM v_lcr WHERE carrier_uuid IS NULL AND digits::bigint IN (${lcr_query_expanded_digits}) ORDER BY digits DESC, rate ASC limit 1) AS lcr_user_second_increment
  FROM v_lcr l
    JOIN v_carriers c ON l.carrier_uuid=c.carrier_uuid
    JOIN v_carrier_gateways cg ON c.carrier_uuid=cg.carrier_uuid
  WHERE c.enabled = 'true' 
    AND cg.enabled = 'true'
    AND l.enabled = 'true' 
    AND l.lcr_direction = 'outbound'
    AND NOW() >= l.date_start
    AND NOW() < l.date_end
    AND l.digits = (SELECT MAX(digits) AS max FROM v_lcr lll WHERE lll.enabled='true' AND lll.digits::bigint IN (${lcr_query_expanded_digits}) AND lll.lcr_direction = 'outbound' AND lll.carrier_uuid = c.carrier_uuid)
  ORDER BY c.priority ASC, lcr_rate_field ASC, l.digits DESC,  l.date_start DESC, cg.priority ASC;
      "/>
    <param name="export_fields" value="nibble_account,nibble_rate,lcr_first_increment,lcr_second_increment,nobal_amt,lowbal_amt,lcr_rate,lcr_second_rate,lcr_carrier_priority,lcr_carrier_gateway_priority"/>
    </profile>

    <profile name="default-diversion">
      <param name="custom_sql" value="
SELECT 
       l.digits AS lcr_digits,
       c.carrier_name AS lcr_carrier_name,
       c.priority AS lcr_carrier_priority,
       l.rate as lcr_rate_field,
       l.rate as lcr_rate,
       l.connect_rate as lcr_second_rate,
       cg.prefix AS lcr_gw_prefix, 
       cg.suffix AS lcr_gw_suffix,
       cg.priority AS lcr_carrier_gateway_priority,
       l.lead_strip AS lcr_lead_strip, 
       l.trail_strip AS lcr_trail_strip,
       l.prefix AS lcr_prefix, 
       l.suffix AS lcr_suffix, 
       cg.codec AS lcr_codec,
       (SELECT rate FROM v_lcr INNER JOIN v_billings on v_billings.lcr_profile = v_lcr.lcr_profile WHERE v_lcr.carrier_uuid IS NULL AND v_lcr.lcr_direction = 'outbound' AND v_lcr.digits::bigint  IN (${lcr_query_expanded_digits}) AND v_billings.type_value='${accountcode}' ORDER BY digits DESC, rate ASC LIMIT 1) AS lcr_user_rate,
       (SELECT connect_rate FROM v_lcr INNER JOIN v_billings on v_billings.lcr_profile = v_lcr.lcr_profile WHERE v_lcr.carrier_uuid IS NULL AND v_lcr.lcr_direction = 'outbound' AND v_lcr.digits::bigint  IN (${lcr_query_expanded_digits}) AND v_billings.type_value='${accountcode}' ORDER BY digits DESC, rate ASC LIMIT 1) AS lcr_user_second_rate,
       'carriers' AS lcr_limit_realm, 
       c.carrier_name AS lcr_limit_id, 
       c.carrier_channels AS lcr_limit_max,
       a.type_value as nibble_account,
       l.connect_increment as lcr_first_increment,
       l.talk_increment as lcr_second_increment,
       (SELECT connect_increment FROM v_lcr WHERE carrier_uuid IS NULL AND digits::bigint IN (${lcr_query_expanded_digits}) ORDER BY digits DESC, rate ASC limit 1) AS lcr_user_first_increment,
       (SELECT talk_increment FROM v_lcr WHERE carrier_uuid IS NULL AND digits::bigint IN (${lcr_query_expanded_digits}) ORDER BY digits DESC, rate ASC limit 1) AS lcr_user_second_increment,
       (SELECT CASE WHEN credit_type='postpaid' THEN credit ELSE -0.01 END FROM v_billings WHERE type_value='${accountcode}') as nobal_amt,
       (SELECT CASE WHEN credit_type='postpaid' THEN credit ELSE -0.01 END FROM v_billings WHERE type_value='${accountcode}') as lowbal_amt,
        '${for_fax}' as fax,
	concat('<sip:',diversion_number,'>;reason=unconditional;privacy=off;screen=no') as sip_h_Diversion
  FROM v_lcr l
    JOIN v_carriers c ON l.carrier_uuid=c.carrier_uuid
    JOIN v_carrier_gateways cg ON c.carrier_uuid=cg.carrier_uuid
    JOIN v_billings a ON a.type_value='${accountcode}'
    JOIN v_diversions d ON d.carrier_uuid = c.carrier_uuid
  WHERE c.enabled = 'true' 
    AND cg.enabled = 'true'
    AND l.enabled = 'true' 
    AND l.lcr_direction = 'outbound'
    AND d.enabled = 'true'
    AND d.diversion_type = 'outbound'
    AND d.domain_uuid='${domain_uuid}'
    AND NOW() >= l.date_start
    AND NOW() < l.date_end
    AND l.digits = (SELECT MAX(digits) AS max FROM v_lcr lll WHERE lll.enabled='true' AND lll.digits::bigint IN (${lcr_query_expanded_digits}) AND lll.lcr_direction = 'outbound' AND lll.carrier_uuid = c.carrier_uuid)
  ORDER BY c.priority ASC, lcr_rate_field ASC, l.digits DESC,  l.date_start DESC, cg.priority ASC;
      "/>
    <param name="export_fields" value="nibble_account,nibble_rate,lcr_first_increment,lcr_second_increment,lcr_user_first_increment,lcr_user_second_increment,nobal_amt,lowbal_amt,lcr_user_rate,lcr_user_second_rate,lcr_rate,lcr_second_rate,lcr_carrier_priority,lcr_carrier_gateway_priority,sip_h_Diversion"/>
    </profile>

    <profile name="nobill-diversion">
      <param name="custom_sql" value="
SELECT 
       l.digits AS lcr_digits,
       c.carrier_name AS lcr_carrier_name,
       c.priority AS lcr_carrier_priority,
       l.rate as lcr_rate_field,
       l.rate as lcr_rate,
       l.connect_rate as lcr_second_rate,
       cg.prefix AS lcr_gw_prefix, 
       cg.suffix AS lcr_gw_suffix,
       cg.priority AS lcr_carrier_gateway_priority,
       l.lead_strip AS lcr_lead_strip,
       l.trail_strip AS lcr_trail_strip,
       l.prefix AS lcr_prefix,
       l.suffix AS lcr_suffix,
       cg.codec AS lcr_codec,
       0 AS lcr_user_rate,
       'carriers' AS lcr_limit_realm,
       c.carrier_name AS lcr_limit_id,
       c.carrier_channels AS lcr_limit_max,
       0 AS nibble_rate,
       l.connect_increment as lcr_first_increment,
       l.talk_increment as lcr_second_increment,
       (SELECT connect_increment FROM v_lcr WHERE carrier_uuid IS NULL AND digits::bigint IN (${lcr_query_expanded_digits}) ORDER BY digits DESC, rate ASC limit 1) AS lcr_user_first_increment,
       (SELECT talk_increment FROM v_lcr WHERE carrier_uuid IS NULL AND digits::bigint IN (${lcr_query_expanded_digits}) ORDER BY digits DESC, rate ASC limit 1) AS lcr_user_second_increment,
	concat('<sip:',diversion_number,'>;reason=unconditional;privacy=off;screen=no') as sip_h_Diversion
  FROM v_lcr l
    JOIN v_carriers c ON l.carrier_uuid=c.carrier_uuid
    JOIN v_carrier_gateways cg ON c.carrier_uuid=cg.carrier_uuid
    JOIN v_diversions d ON d.carrier_uuid = c.carrier_uuid
  WHERE c.enabled = 'true' 
    AND cg.enabled = 'true'
    AND l.enabled = 'true' 
    AND l.lcr_direction = 'outbound'
    AND d.enabled = 'true'
    AND d.diversion_type = 'outbound'
    AND d.domain_uuid='${domain_uuid}'
    AND NOW() >= l.date_start
    AND NOW() < l.date_end
    AND l.digits = (SELECT MAX(digits) AS max FROM v_lcr lll WHERE lll.enabled='true' AND lll.digits::bigint IN (${lcr_query_expanded_digits}) AND lll.lcr_direction = 'outbound' AND lll.carrier_uuid = c.carrier_uuid)
  ORDER BY c.priority ASC, lcr_rate_field ASC, l.digits DESC,  l.date_start DESC, cg.priority ASC;
      "/>
    <param name="export_fields" value="nibble_account,nibble_rate,lcr_first_increment,lcr_second_increment,nobal_amt,lowbal_amt,lcr_rate,lcr_second_rate,lcr_carrier_priority,lcr_carrier_gateway_priority,sip_h_Diversion"/>
    </profile>

  </profiles>
</configuration>
