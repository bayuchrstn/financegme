
<?php
$data = '<table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse;" class="tabel_report">';
$data .= '<tr>
	<td colspan="3"><strong>Invoice ' . date('M Y') . ' belum terbit</strong></td>
	</tr>';

$no = 0;
$now = date('Y-m-d');
$bulan = substr($now, 5, 2);
$tahun = substr($now, 0, 4);
// $this->db->select("a.*, 
// date_format(a.date_invoice, '" . date('Y') . "-" . date('m') . "-%d') as date_invoicenya, 
// date_format(a.date_due, '" . date('Y') . "-" . date('m') . "-%d') as date_duenya,
// IF(a.ppn = 1, ((a.bandwith + a.colocation + a.instalasi + a.perangkat + a.lain2) * 0.1),0) as ppn,
// COUNT(b.id) AS jml", false);
// //$this->db->where('a.branch',$this->cek_id_regional($this->session->userdata('scope_area')));
// //$this->db->where('a.date_invoice <=', ''.date('Y').'-'.date('m').'-'.date('t').'');
// $this->db->where('b.date_invoice <', '' . date('Y') . '-' . date('m') . '-01');
// $this->db->where('a.billing_cycle <=', '3');
// $this->db->where('a.status_service', '0');
// //$this->db->where("(a.billing_cycle = '1' OR (a.billing_cycle = '0' AND DATE_FORMAT(a.date_invoice, '%m%Y') = '".date('m').date('Y')."'))", NULL, FALSE);
// $this->db->from('finance_customer_service2 AS a');
// $this->db->join('finance_invoice_customer b', "a.service_id = b.service_id 
// AND '" . date('m') . "' = DATE_FORMAT(b.date_invoice, '%m') 
// AND '" . date('Y') . "' = DATE_FORMAT(b.date_invoice, '%Y') 
// AND '0' = b.manual", 'left');
// $this->db->join('finance_invoice_customer_detail c', "b.id = c.no_invoice 
// AND '" . date('m') . "' = DATE_FORMAT(c.date_invoice, '%m') 
// AND '" . date('Y') . "' = DATE_FORMAT(c.date_invoice, '%Y')", 'left');
// $this->db->order_by('a.service_id', 'desc');
// $this->db->group_by('a.service_id');
// $this->db->having('jml', '0');
$q = $this->db->query("SELECT
*
FROM
`gmd_finance_customer_service2` b
WHERE NOT EXISTS
(SELECT
  a.id_site AS service_id
FROM
  `gmd_finance_invoice_customer_detail` a
WHERE b.`service_id` = a.`id_site` AND $bulan = DATE_FORMAT(a.date_invoice, '%m')
	AND $tahun = DATE_FORMAT(a.date_invoice, '%Y')
	)
AND b.`billing_cycle` <= 3
AND b.`status_service` = 0");
if ($q->num_rows() > 0) {
	foreach ($q->result_array() as $r) {
		$no++;
		$data .= '<tr>
			<td align="right">' . $no . '.</td>
			<td>' . $r['service_id'] . '</td>
			<td>' . $r['nama'] . '</td>
			</tr>';
	}
}
$data .= '</table>';
echo $data;
?>
