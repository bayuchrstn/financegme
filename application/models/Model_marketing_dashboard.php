<?php
class Model_marketing_dashboard extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

	function table_summary_problem()
	{
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-'.$month.'-01');
		$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		$msg = '<table class="table table-xxs text-nowrap table-hover table-striped text-size-mini table-bordered">
		<thead><tr class="text-bold">
		<th width="1">NO</th>
		<th>MARKETING</th>
		<th>JAN</th>
		<th>FEB</th>
		<th>MAR</th>
		<th>APR</th>
		<th>MEI</th>
		<th>JUN</th>
		<th>JUL</th>
		<th>AGU</th>
		<th>SEP</th>
		<th>OKT</th>
		<th>NOV</th>
		<th>DES</th>
		</tr></thead><tbody>';
		
		$bl_01 = 0;
		$bl_02 = 0;
		$bl_03 = 0;
		$bl_04 = 0;
		$bl_05 = 0;
		$bl_06 = 0;
		$bl_07 = 0;
		$bl_08 = 0;
		$bl_09 = 0;
		$bl_10 = 0;
		$bl_11 = 0;
		$bl_12 = 0;
		$q = $this->db->query("SELECT
		  sls.name, (
			SUM(
			  IF(
				sls.tanggal_billing >= '".$year."-01-01'
				AND sls.tanggal_billing <= '".$year."-12-31'
				AND sls.tipe = 1, sls.sales, 0
			  )
			) - SUM(
			  IF(
				sls.nonaktif_date >= '".$year."-01-01'
				AND sls.nonaktif_date <= '".$year."-12-31'
				AND sls.tipe = 0, sls.loss, 0
			  )
			)
		  ) AS bln_12, (
			SUM(
			  IF(
				sls.tanggal_billing >= '".$year."-01-01'
				AND sls.tanggal_billing <= '".$year."-11-31'
				AND sls.tipe = 1, sls.sales, 0
			  )
			) - SUM(
			  IF(
				sls.nonaktif_date >= '".$year."-01-01'
				AND sls.nonaktif_date <= '".$year."-11-31'
				AND sls.tipe = 0, sls.loss, 0
			  )
			)
		  ) AS bln_11, (
			SUM(
			  IF(
				sls.tanggal_billing >= '".$year."-01-01'
				AND sls.tanggal_billing <= '".$year."-10-31'
				AND sls.tipe = 1, sls.sales, 0
			  )
			) - SUM(
			  IF(
				sls.nonaktif_date >= '".$year."-01-01'
				AND sls.nonaktif_date <= '".$year."-10-31'
				AND sls.tipe = 0, sls.loss, 0
			  )
			)
		  ) AS bln_10, (
			SUM(
			  IF(
				sls.tanggal_billing >= '".$year."-01-01'
				AND sls.tanggal_billing <= '".$year."-09-31'
				AND sls.tipe = 1, sls.sales, 0
			  )
			) - SUM(
			  IF(
				sls.nonaktif_date >= '".$year."-01-01'
				AND sls.nonaktif_date <= '".$year."-09-31'
				AND sls.tipe = 0, sls.loss, 0
			  )
			)
		  ) AS bln_09, (
			SUM(
			  IF(
				sls.tanggal_billing >= '".$year."-01-01'
				AND sls.tanggal_billing <= '".$year."-08-31'
				AND sls.tipe = 1, sls.sales, 0
			  )
			) - SUM(
			  IF(
				sls.nonaktif_date >= '".$year."-01-01'
				AND sls.nonaktif_date <= '".$year."-08-31'
				AND sls.tipe = 0, sls.loss, 0
			  )
			)
		  ) AS bln_08, (
			SUM(
			  IF(
				sls.tanggal_billing >= '".$year."-01-01'
				AND sls.tanggal_billing <= '".$year."-07-31'
				AND sls.tipe = 1, sls.sales, 0
			  )
			) - SUM(
			  IF(
				sls.nonaktif_date >= '".$year."-01-01'
				AND sls.nonaktif_date <= '".$year."-07-31'
				AND sls.tipe = 0, sls.loss, 0
			  )
			)
		  ) AS bln_07, (
			SUM(
			  IF(
				sls.tanggal_billing >= '".$year."-01-01'
				AND sls.tanggal_billing <= '".$year."-06-31'
				AND sls.tipe = 1, sls.sales, 0
			  )
			) - SUM(
			  IF(
				sls.nonaktif_date >= '".$year."-01-01'
				AND sls.nonaktif_date <= '".$year."-06-31'
				AND sls.tipe = 0, sls.loss, 0
			  )
			)
		  ) AS bln_06, (
			SUM(
			  IF(
				sls.tanggal_billing >= '".$year."-01-01'
				AND sls.tanggal_billing <= '".$year."-05-31'
				AND sls.tipe = 1, sls.sales, 0
			  )
			) - SUM(
			  IF(
				sls.nonaktif_date >= '".$year."-01-01'
				AND sls.nonaktif_date <= '".$year."-05-31'
				AND sls.tipe = 0, sls.loss, 0
			  )
			)
		  ) AS bln_05, (
			SUM(
			  IF(
				sls.tanggal_billing >= '".$year."-01-01'
				AND sls.tanggal_billing <= '".$year."-04-31'
				AND sls.tipe = 1, sls.sales, 0
			  )
			) - SUM(
			  IF(
				sls.nonaktif_date >= '".$year."-01-01'
				AND sls.nonaktif_date <= '".$year."-04-31'
				AND sls.tipe = 0, sls.loss, 0
			  )
			)
		  ) AS bln_04, (
			SUM(
			  IF(
				sls.tanggal_billing >= '".$year."-01-01'
				AND sls.tanggal_billing <= '".$year."-03-31'
				AND sls.tipe = 1, sls.sales, 0
			  )
			) - SUM(
			  IF(
				sls.nonaktif_date >= '".$year."-01-01'
				AND sls.nonaktif_date <= '".$year."-03-31'
				AND sls.tipe = 0, sls.loss, 0
			  )
			)
		  ) AS bln_03, (
			SUM(
			  IF(
				sls.tanggal_billing >= '".$year."-01-01'
				AND sls.tanggal_billing <= '".$year."-02-31'
				AND sls.tipe = 1, sls.sales, 0
			  )
			) - SUM(
			  IF(
				sls.nonaktif_date >= '".$year."-01-01'
				AND sls.nonaktif_date <= '".$year."-02-31'
				AND sls.tipe = 0, sls.loss, 0
			  )
			)
		  ) AS bln_02, (
			SUM(
			  IF(
				sls.tanggal_billing >= '".$year."-01-01'
				AND sls.tanggal_billing <= '".$year."-01-31'
				AND sls.tipe = 1, sls.sales, 0
			  )
			) - SUM(
			  IF(
				sls.nonaktif_date >= '".$year."-01-01'
				AND sls.nonaktif_date <= '".$year."-01-31'
				AND sls.tipe = 0, sls.loss, 0
			  )
			)
		  ) AS bln_01
		FROM
		  (SELECT
			a.id, c.name, COALESCE(
			  DATE_FORMAT(a.tanggal_billing, '%Y-%m-%d'), '0000-00-00'
			) AS tanggal_billing, COALESCE(
			  a.nonaktif_date, DATE_ADD(
				DATE_FORMAT(NOW(), '%Y-12-31'), INTERVAL 1 YEAR
			  )
			) AS nonaktif_date, IF(
			  a.ppn = 1, (
				b.product_price - ROUND(b.product_price / 1.1)
			  ), b.product_price
			) AS sales, 0 AS loss, 1 AS tipe
		  FROM
			gmd_customer a
			LEFT JOIN gmd_customer_product b
			  ON a.id = b.customer_id
			LEFT JOIN gmd_users c
			  ON a.id_user = c.id
		  WHERE (
			  a.tanggal_billing BETWEEN '".$year."-01-01 00:00:00'
			  AND '".$year."-12-31 23:59:59'
			)
			AND a.area = '".$this->session->userdata('scope_area')."'
		  UNION
		  ALL
		  SELECT
			a.id, c.name, COALESCE(
			  DATE_FORMAT(a.tanggal_billing, '%Y-%m-%d'), '0000-00-00'
			) AS tanggal_billing, COALESCE(a.nonaktif_date, '0000-00-00') AS nonaktif_date, 0 AS sales, IF(
			  a.ppn = 1, (
				b.product_price - ROUND(b.product_price / 1.1)
			  ), b.product_price
			) AS loss, 0 AS tipe
		  FROM
			gmd_customer a
			LEFT JOIN gmd_customer_product b
			  ON a.id = b.customer_id
			LEFT JOIN gmd_users c
			  ON a.id_user = c.id
		  WHERE (
			  a.tanggal_billing BETWEEN '".$year."-01-01 00:00:00'
			  AND '".$year."-12-31 23:59:59'
			)
			AND (
			  a.nonaktif_date BETWEEN '".$year."-01-01'
			  AND '".$year."-12-31'
			)
			AND a.area = '".$this->session->userdata('scope_area')."') AS sls
		GROUP BY sls.name
		ORDER BY sls.name ASC");
		if($q->num_rows() > 0){
			$n = 0;
			foreach($q->result_array() as $r){
				$n++;
				$bln_01 = (date('Y-m-01') < $year."-01-01")?0:$r['bln_01'];
				$bln_02 = (date('Y-m-01') < $year."-02-01")?0:$r['bln_02'];
				$bln_03 = (date('Y-m-01') < $year."-03-01")?0:$r['bln_03'];
				$bln_04 = (date('Y-m-01') < $year."-04-01")?0:$r['bln_04'];
				$bln_05 = (date('Y-m-01') < $year."-05-01")?0:$r['bln_05'];
				$bln_06 = (date('Y-m-01') < $year."-06-01")?0:$r['bln_06'];
				$bln_07 = (date('Y-m-01') < $year."-07-01")?0:$r['bln_07'];
				$bln_08 = (date('Y-m-01') < $year."-08-01")?0:$r['bln_08'];
				$bln_09 = (date('Y-m-01') < $year."-09-01")?0:$r['bln_09'];
				$bln_10 = (date('Y-m-01') < $year."-10-01")?0:$r['bln_10'];
				$bln_11 = (date('Y-m-01') < $year."-11-01")?0:$r['bln_11'];
				$bln_12 = (date('Y-m-01') < $year."-12-01")?0:$r['bln_12'];
				
				$msg .= '<tr><td align="center">'.$n.'</td>
				<td>'.$r['name'].'</td>
				<td class="text-right">'.number_format($bln_01,0).'</td>
				<td class="text-right">'.number_format($bln_02,0).'</td>
				<td class="text-right">'.number_format($bln_03,0).'</td>
				<td class="text-right">'.number_format($bln_04,0).'</td>
				<td class="text-right">'.number_format($bln_05,0).'</td>
				<td class="text-right">'.number_format($bln_06,0).'</td>
				<td class="text-right">'.number_format($bln_07,0).'</td>
				<td class="text-right">'.number_format($bln_08,0).'</td>
				<td class="text-right">'.number_format($bln_09,0).'</td>
				<td class="text-right">'.number_format($bln_10,0).'</td>
				<td class="text-right">'.number_format($bln_11,0).'</td>
				<td class="text-right">'.number_format($bln_12,0).'</td>
				</tr>';
				$bl_01 += $bln_01;
				$bl_02 += $bln_02;
				$bl_03 += $bln_03;
				$bl_04 += $bln_04;
				$bl_05 += $bln_05;
				$bl_06 += $bln_06;
				$bl_07 += $bln_07;
				$bl_08 += $bln_08;
				$bl_09 += $bln_09;
				$bl_10 += $bln_10;
				$bl_11 += $bln_11;
				$bl_12 += $bln_12;
			}
		}
		$q->free_result();
		
				$msg .= '<tr class="text-black"><td class="text-right" colspan="2">Total</td>
				<td class="text-right">'.number_format($bl_01,0).'</td>
				<td class="text-right">'.number_format($bl_02,0).'</td>
				<td class="text-right">'.number_format($bl_03,0).'</td>
				<td class="text-right">'.number_format($bl_04,0).'</td>
				<td class="text-right">'.number_format($bl_05,0).'</td>
				<td class="text-right">'.number_format($bl_06,0).'</td>
				<td class="text-right">'.number_format($bl_07,0).'</td>
				<td class="text-right">'.number_format($bl_08,0).'</td>
				<td class="text-right">'.number_format($bl_09,0).'</td>
				<td class="text-right">'.number_format($bl_10,0).'</td>
				<td class="text-right">'.number_format($bl_11,0).'</td>
				<td class="text-right">'.number_format($bl_12,0).'</td>
				</tr>';
		
		$msg  .= '</tbody></table>';
		echo $msg;
	}

	function sales_this_month()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-'.$month.'-01');
		$tanggal_akhir = date(''.$year.'-'.$month.'-t');
		
		$data = array();
			$q = $this->db->query("SELECT
			  sls.*,COUNT(sls.id) AS qty, SUM(IF(sls.loss = 0,1,0)) AS qty_sales, SUM(IF(sls.sales = 0,1,0)) AS qty_loss, SUM(sls.sales) AS sales, SUM(sls.loss) AS loss
			FROM
			  (SELECT
				a.id, c.name, a.ppn, if(a.ppn = 1, (b.product_price - round( b.product_price/ 1.1)), b.product_price) AS sales, 0 AS loss
			  FROM
				gmd_customer a
				LEFT JOIN gmd_customer_product b
				  ON a.id = b.customer_id
				LEFT JOIN gmd_users c
				  ON a.id_user = c.id
			  WHERE (
				  a.tanggal_billing BETWEEN '".$tanggal_awal." 00:00:00'
				  AND '".$tanggal_akhir." 23:59:59'
				)
				AND a.area = '".$this->session->userdata('scope_area')."'
			  UNION
			  ALL
			  SELECT
				a.id, c.name, a.ppn, 0 AS sales, if(a.ppn = 1, (b.product_price - round( b.product_price/ 1.1)), b.product_price) AS loss
			  FROM
				gmd_customer a
				LEFT JOIN gmd_customer_product b
				  ON a.id = b.customer_id
				LEFT JOIN gmd_users c
				  ON a.id_user = c.id
			  WHERE (
				  a.nonaktif_date BETWEEN '".$tanggal_awal."'
				  AND '".$tanggal_akhir."'
				)
				AND a.area = '".$this->session->userdata('scope_area')."') AS sls
			GROUP BY sls.name
			ORDER BY sls.name ASC");
			if($q->num_rows() > 0){
				foreach($q->result_array() as $k => $r){
					$data[$k]['nama'] = ucwords(strtolower($r['name']));
					$data[$k]['qty'] = $r['qty'];
					$data[$k]['nominal1'] =  $r['sales'];
					$data[$k]['nominal2'] =  $r['loss'];
				}
			}
			$q->free_result();
		
		echo json_encode($data);
	}

	function sales_of_the_year()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$bulan = array(
			'01' => ucwords('jan'),
			'02' => ucwords('feb'),
			'03' => ucwords('mar'),
			'04' => ucwords('apr'),
			'05' => ucwords('mey'),
			'06' => ucwords('jun'),
			'07' => ucwords('jul'),
			'08' => ucwords('aug'),
			'09' => ucwords('sep'),
			'10' => ucwords('oct'),
			'11' => ucwords('nov'),
			'12' => ucwords('dec'),
			);
		$data = array();
		foreach($bulan as $k => $v){
			$tanggal_awal = date(''.$year.'-'.$k.'-01');
			$tanggal_akhir = date(''.$year.'-'.$k.'-t');
			
			  
			$q = $this->db->query("SELECT
			  SUM(sls.sales) AS sales, SUM(sls.loss) AS loss
			FROM
			  (SELECT
				a.id, c.name, a.ppn, if(a.ppn = 1, (b.product_price - round( b.product_price/ 1.1)), b.product_price) AS sales, 0 AS loss
			  FROM
				gmd_customer a
				LEFT JOIN gmd_customer_product b
				  ON a.id = b.customer_id
				LEFT JOIN gmd_users c
				  ON a.id_user = c.id
			  WHERE (
				  a.tanggal_billing BETWEEN '".$tanggal_awal." 00:00:00'
				  AND '".$tanggal_akhir." 23:59:59'
				)
				AND a.area = '".$this->session->userdata('scope_area')."'
			  UNION
			  ALL
			  SELECT
				a.id, c.name, a.ppn, 0 AS sales, if(a.ppn = 1, (b.product_price - round( b.product_price/ 1.1)), b.product_price) AS loss
			  FROM
				gmd_customer a
				LEFT JOIN gmd_customer_product b
				  ON a.id = b.customer_id
				LEFT JOIN gmd_users c
				  ON a.id_user = c.id
			  WHERE (
				  a.nonaktif_date BETWEEN '".$tanggal_awal."'
				  AND '".$tanggal_akhir."'
				)
				AND a.area = '".$this->session->userdata('scope_area')."') AS sls");
			if($q->num_rows() > 0 && $tanggal_awal <= date('Y-m-d')){
				foreach($q->result_array() as $r){
					$data[$k]['nama'] = $v;
					$data[$k]['nilai'] =  $r['sales'];
					$data[$k]['nilai2'] =  $r['loss'];
				}
			}else{
					$data[$k]['nama'] = $v;
					$data[$k]['nilai'] =  0;
					$data[$k]['nilai2'] =  0;
			}
			$q->free_result();
		}
		
		echo json_encode($data);
	}

	function sales_by_month()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$bulan = array(
			'01' => ucwords('jan'),
			'02' => ucwords('feb'),
			'03' => ucwords('mar'),
			'04' => ucwords('apr'),
			'05' => ucwords('mey'),
			'06' => ucwords('jun'),
			'07' => ucwords('jul'),
			'08' => ucwords('aug'),
			'09' => ucwords('sep'),
			'10' => ucwords('oct'),
			'11' => ucwords('nov'),
			'12' => ucwords('dec'),
			);
		$data = array();
		foreach($bulan as $k => $v){
			$tanggal_awal = date(''.$year.'-01-01');
			//$tanggal_awal =  date("Y-01-01", strtotime($tanggal_awal));
			$tanggal_akhir = date(''.$year.'-'.$k.'-t');
			
			  
			$q = $this->db->query("SELECT
			  SUM(sls.sales) AS sales, SUM(sls.loss) AS loss
			FROM
			  (SELECT
				a.id, c.name, a.ppn, if(a.ppn = 1, (b.product_price - round( b.product_price/ 1.1)), b.product_price) AS sales, 0 AS loss
			  FROM
				gmd_customer a
				LEFT JOIN gmd_customer_product b
				  ON a.id = b.customer_id
				LEFT JOIN gmd_users c
				  ON a.id_user = c.id
			  WHERE (
				  a.tanggal_billing BETWEEN '".$tanggal_awal." 00:00:00'
				  AND '".$tanggal_akhir." 23:59:59'
				)
				AND a.area = '".$this->session->userdata('scope_area')."'
			  UNION
			  ALL
			  SELECT
				a.id, c.name, a.ppn, 0 AS sales, if(a.ppn = 1, (b.product_price - round( b.product_price/ 1.1)), b.product_price) AS loss
			  FROM
				gmd_customer a
				LEFT JOIN gmd_customer_product b
				  ON a.id = b.customer_id
				LEFT JOIN gmd_users c
				  ON a.id_user = c.id
			  WHERE (
				  a.tanggal_billing BETWEEN '".$tanggal_awal." 00:00:00'
				  AND '".$tanggal_akhir." 23:59:59'
				)
				AND (
				  a.nonaktif_date BETWEEN '".$tanggal_awal."'
				  AND '".$tanggal_akhir."'
				)
				AND a.area = '".$this->session->userdata('scope_area')."') AS sls");
			if($q->num_rows() > 0 && $tanggal_akhir <= date('Y-m-t')){
				foreach($q->result_array() as $r){
					$data[$k]['nama'] = $v;
					$data[$k]['nilai'] =  $r['sales'] - $r['loss'];
				}
			}else{
					$data[$k]['nama'] = $v;
					$data[$k]['nilai'] =  0;
			}
			$q->free_result();
		}
		
		echo json_encode($data);
	}

	function sales_by_mkt()
	{
		set_time_limit(0);
		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		
		$tanggal_awal = date(''.$year.'-01-01');
		$tanggal_akhir = date(''.$year.'-12-t');
		
		$data = array();
			$q = $this->db->query("SELECT
			  sls.*,COUNT(sls.id) AS qty, SUM(IF(sls.loss = 0,1,0)) AS qty_sales, SUM(IF(sls.sales = 0,1,0)) AS qty_loss, SUM(sls.sales) AS sales, SUM(sls.loss) AS loss
			FROM
			  (SELECT
				a.id, c.name, a.ppn, if(a.ppn = 1, (b.product_price - round( b.product_price/ 1.1)), b.product_price) AS sales, 0 AS loss
			  FROM
				gmd_customer a
				LEFT JOIN gmd_customer_product b
				  ON a.id = b.customer_id
				LEFT JOIN gmd_users c
				  ON a.id_user = c.id
			  WHERE (
				  a.tanggal_billing BETWEEN '".$tanggal_awal." 00:00:00'
				  AND '".$tanggal_akhir." 23:59:59'
				)
				AND a.area = '".$this->session->userdata('scope_area')."'
			  UNION
			  ALL
			  SELECT
				a.id, c.name, a.ppn, 0 AS sales, if(a.ppn = 1, (b.product_price - round( b.product_price/ 1.1)), b.product_price) AS loss
			  FROM
				gmd_customer a
				LEFT JOIN gmd_customer_product b
				  ON a.id = b.customer_id
				LEFT JOIN gmd_users c
				  ON a.id_user = c.id
			  WHERE (
				  a.tanggal_billing BETWEEN '".$tanggal_awal." 00:00:00'
				  AND '".$tanggal_akhir." 23:59:59'
				)
				AND (
				  a.nonaktif_date BETWEEN '".$tanggal_awal."'
				  AND '".$tanggal_akhir."'
				)
				AND a.area = '".$this->session->userdata('scope_area')."') AS sls
			GROUP BY sls.name
			ORDER BY sls.name ASC");
			if($q->num_rows() > 0){
				foreach($q->result_array() as $k => $r){
					$data[$k]['nama'] = ucwords(strtolower($r['name']));
					$data[$k]['qty'] = $r['qty'];
					$data[$k]['nominal1'] =  $r['sales'];
					$data[$k]['nominal2'] =  $r['loss'];
				}
			}
			$q->free_result();
		
		echo json_encode($data);
	}

}
