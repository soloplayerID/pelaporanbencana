SELECT lomaterial.erp_code, table_stockin.destination, lomaterial.material_code as material_code, lomaterial.material_name, lomaterial.material_name,
 IF(table_stockin.TotalIn IS NULL,'0',table_stockin.TotalIn) AS TotalIn, IF(table_stockout.TotalOut IS NULL,'0',table_stockout.TotalOut) AS TotalOut,
 lomaterial.material_name, (IF(table_stockin.TotalIn IS NULL,'0',table_stockin.TotalIn) - IF(table_stockout.TotalOut IS NULL,'0',table_stockout.TotalOut)) AS Stock,
 table_dr.qty as ReqQty, syunit.UnitName FROM lomaterial LEFT JOIN (SELECT tr_dn_inbound.destination, tr_material_inbound.material_code, lomaterial.material_name,
 SUM(tr_material_inbound.qty) as TotalIn FROM tr_dn_inbound INNER JOIN tr_material_inbound ON tr_dn_inbound.dni_number = tr_material_inbound.dn_number INNER JOIN
 lomaterial ON lomaterial.material_code=tr_material_inbound.material_code WHERE tr_material_inbound.is_canibal=0 AND tr_material_inbound.material_code='200056'
 GROUP BY tr_dn_inbound.destination, tr_material_inbound.material_code, lomaterial.material_name) table_stockin ON lomaterial.material_code=table_stockin.material_code
 LEFT JOIN (SELECT tr_dn_outbound.origin, tr_material_outbound.material_code, lomaterial.material_name, SUM(tr_material_outbound.qty) as TotalOut FROM tr_dn_outbound
 INNER JOIN tr_material_outbound ON tr_dn_outbound.dno_number = tr_material_outbound.dno_number INNER JOIN lomaterial ON
 lomaterial.material_code = tr_material_outbound.material_code WHERE tr_material_outbound.material_code='200056' GROUP BY tr_dn_outbound.origin,
 tr_material_outbound.material_code, lomaterial.material_name) table_stockout ON table_stockout.material_code = table_stockin.material_code AND
 table_stockout.origin = table_stockin.destination LEFT JOIN (SELECT b.material_code, c.origin, SUM(b.qty) as qty FROM lomaterial a LEFT JOIN tr_material_delivery_request b
 ON a.material_code=b.material_code LEFT JOIN tr_delivery_request c ON b.dr_number=c.dr_number LEFT JOIN tr_dn_outbound d ON c.dr_number=d.dr_number WHERE d.dr_number
 IS NULL AND b.material_code='200056' GROUP BY b.material_code) table_dr ON table_stockin.material_code=table_dr.material_code AND table_dr.origin = table_stockin.destination
 LEFT JOIN syunit ON syunit.UnitId=lomaterial.UnitId WHERE table_stockin.destination='SUB' AND lomaterial.material_code='200056' ORDER BY lomaterial.material_code
