<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_fee extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('model_customer','customer');
		$this->load->model('model_marketing_fee','marketing_fee');
		$this->css_include = '';
		$this->js_include = '';
		$this->js_inject = '';
	}

	function index()
	{
		$data = array();
		// $this->js_inject .= $this->load->view('marketing_fee/js_table', $data, TRUE);
		$this->js_inject .= $this->load->view('marketing_fee/js', $data, TRUE);
		// $this->js_inject .= $this->load->view('marketing_fee/valid', $data, TRUE);
		$this->js_include .= $this->ui->js_include('mask_money');
		$this->js_include .= $this->ui->js_include('jquery_ui');

		// $data['update_view'] = $this->load->view('item_detail/update', $data, TRUE);
		// $data['insert_view'] = $this->load->view('item_detail/insert', $data, TRUE);
		$data['search_view'] = $this->load->view('marketing_fee/search', $data, TRUE);

		$konten = $this->load->view('marketing_fee/index', $data, TRUE);
		$this->admin_view($konten);
	}

	function detail($output_type='echo')
	{
		$data = array();
		$user_id = $this->input->post('id') ? $this->input->post('id') : my_id();
		$am_name = $this->db->select('name')->where('id', $user_id)->get('users')->row()->name;

		// set total target
		$default_mrk_target = 12000000; //12 juta
		$month = date('m');
		$triwulan = $this->input->post('triwulan') ? $this->input->post('triwulan') : ceil($month/3);

		$total_target = 0;
		for ($i = 0; $i < (3*$triwulan); $i++) {
			$total_target = $total_target + (($i+1) * $default_mrk_target );
		}
		// end set total target

		//list customer target this year
		$data_pelanggan = array();
		$sum_customer_bulanan = array();
		$start_bulan = ($triwulan*3) + 1;
		$sum_customer_bulanan['list'] = array(
			array('subtotal'	=> 0),
			array('subtotal'	=> 0),
			array('subtotal'	=> 0)
		);
		$sum_customer_bulanan['total'] = 0;
		$pendapatan = 0;
		$data = $this->marketing_fee->customer_this_year($user_id);
		if (count($data) > 0) {
			foreach ($data as $row) {
				// hitung tanpa ppn
				$price = $row['ppn']=='0' ? $row['product_price'] : ($row['product_price'] * 100/110 ) ;

				// cari prorate bulan pertama
				$billing = $row['tahun_billing'].'-'.$row['bulan_billing'].'-'.$row['tanggal_billing'];
				$last_date = date('t', strtotime($billing));
				$prorate = ( ($last_date-$row['tanggal_billing']) + 1 ) / $last_date * $price;

				//total nilai penjualan prorate + biaya bulan selanjutnya sampai bulan sebelum sekarang
				$total_price = floor($prorate) + ($price * ( $month-$row['bulan_billing']-1 ) );

				//array bulanan
				$list_pembayaran = array();
				$list_pembayaran[0] = array(
					'bulan'	=> intval($row['bulan_billing']),
					'bayar'	=> (floor($prorate))
				);
				$jumlah_billing = intval($month) - intval($row['bulan_billing']);

				for ($i = 1; $i < $jumlah_billing; $i++) {
					$list_pembayaran[$i] = array(
						'bulan'	=> intval($row['bulan_billing'])+$i,
						'bayar'	=> intval($price)
					); 
				}

				//total pendapatan
				foreach ($list_pembayaran as $value) {
					if ($value['bulan'] <= ($triwulan*3)) {
						$pendapatan = $pendapatan + $value['bayar'];
					}
				}

				//array triwulan
				$list_triwulan = array();
				$x=0;
				foreach ($list_pembayaran as $value) {
					if ($value['bulan'] > (($triwulan-1)*3) && $value['bulan'] <= ($triwulan*3) ) {
						$list_triwulan[$x] = array(
							'bulan'	=> $value['bulan'],
							'bayar'	=> intval($value['bayar'])
						);
						$x++;
					}
				}

				//hitung total triwulan buat mf
				$total_triwulan = 0;
				if (count($list_triwulan)>0) {
					foreach ($list_triwulan as $value) {
						$total_triwulan = $total_triwulan + $value['bayar'];
					}
				}

				$data_pelanggan[] = array(
					'nama'	=> $row['customer_name'],
					'layanan'	=> $row['product_name'].' - '.$row['product_value'].' '.$row['satuan_bandwidth'],
					'billing'	=> $billing,
					'harga'	=> intval($price),
					// 'jumlah_billing'	=> $jumlah_billing,
					'list_bulanan'	=> $list_pembayaran,
					'total_pendapatan'	=> ($total_price),
					'list_triwulan'	=> $list_triwulan,
					'total_triwulan'	=> $total_triwulan
				);
			}

			//sum bulanan pelanggan
			foreach ($data_pelanggan as $value) {
				foreach ($value['list_triwulan'] as $row_triwulan) {
					$j = ($row_triwulan['bulan']-1) - (($triwulan-1)*3);
					$sum_customer_bulanan['list'][$j]['subtotal'] += $row_triwulan['bayar'];
					$sum_customer_bulanan['total'] += $row_triwulan['bayar'];
				}
			}
			// end sum bulanan pelanggan
		}
		// end list customer target this year

		//list customer last yeat
		$extra_total = 0;
		$data_pelanggan_last_year = array();
		//extra total
		$arr_extra_total['list'] = array(
			array('subtotal'	=> 0),
			array('subtotal'	=> 0),
			array('subtotal'	=> 0)
		);
		$arr_extra_total['total'] = 0;
		$mf_last_year = $this->marketing_fee->customer_last_year($user_id, $triwulan);
		if (count($mf_last_year) > 0) {
			foreach ($mf_last_year as $row) {
				$price = $row['ppn']=='0' ? $row['product_price'] : ($row['product_price'] * 100/110 ) ;
				
				// cari prorate bulan terakhir
				$billing = $row['tahun_billing'].'-'.$row['bulan_billing'].'-'.$row['tanggal_billing'];
				$last_billing = date('Y-m-d', strtotime('-1 day',strtotime($billing) ));

				$limit_date_billing = date('t', strtotime($last_billing));
				$last_date_billing = date('d', strtotime($last_billing));
				$last_month_billing = date('m', strtotime($last_billing));

				$start = (($triwulan-1)*3)+1;
				$end = $triwulan*3;

				$prorate = $last_date_billing / $limit_date_billing * $price;

				//bonus extra triwulan
				$extra_triwulan = array();
				$selisih_bulan = intval($last_month_billing) - (($triwulan-1)*3);
				if ($selisih_bulan > 3) :
					for ($i = 0; $i < 3; $i++) {
						$extra_triwulan[] = array(
							'bulan'	=> (($triwulan-1)*3) + ($i+1),
							'bayar'	=> intval($price)
						);
					}
				else:
					$x = 0;
					for ($i = 0; $i < ($selisih_bulan-1); $i++) {
						$extra_triwulan[] = array(
							'bulan'	=> (($triwulan-1)*3) + ($i+1),
							'bayar'	=> intval($price)
						);
						$x=$i;
					}

					if ($selisih_bulan > 1) {
						$extra_triwulan[$x+1] = array(
							'bulan'	=> $extra_triwulan[$x]['bulan']+1,
							'bayar'	=> floor($prorate)
						);
					} else {
						$extra_triwulan[$x] = array(
							'bulan'	=> (($triwulan-1)*3) + 1,
							'bayar'	=> floor($prorate)
						);
					}
					// $extra_triwulan[] = array(
					// 	'bulan'	=> intval($extra_triwulan[$x]['bulan'])+1,
					// 	'harga'	=> $prorate
					// );
				endif;

				$data_pelanggan_last_year[] = array(
					'nama'	=> $row['customer_name'],
					'layanan'	=> $row['product_name'].' - '.$row['product_value'].' '.$row['satuan_bandwidth'],
					'billing'	=> $billing,
					'last_billing'	=> $last_billing,
					'harga'	=> intval($price),
					'total_pendapatan'	=> 0,
					'extra_triwulan'	=> $extra_triwulan
				);

				$extra_total = $extra_total + $price;
			}

			foreach ($data_pelanggan_last_year as $value) {
				$j = 0;
				foreach ($value['extra_triwulan'] as $row_triwulan) {
					$arr_extra_total['list'][$j]['subtotal'] += $row_triwulan['bayar'];
					$arr_extra_total['total'] += $row_triwulan['bayar'];
					$j++;
				}
			}
		}
		// end list customer last year

		// pendapatan triwulan
		$pendapatan_triwulan = array();
		for ($j = 0; $j < 3; $j++) {
			$pendapatan_triwulan['subtotal'][$j] = $sum_customer_bulanan['list'][$j]['subtotal'] + $arr_extra_total['list'][$j]['subtotal'];
		}
		$pendapatan_triwulan['total'] = $sum_customer_bulanan['total'] + $arr_extra_total['total'];
		// end pendapatan triwulan

		$data = array(
			'nama'	=> $am_name,
			'triwulan'	=> intval($triwulan),
			'target_triwulan'	=> $total_target,
			'pencapaian_total'		=> $pendapatan
		);
		$data['pelanggan_berjalan'] = array(
			'detail'	=> $data_pelanggan,
			'subtotal'	=> $sum_customer_bulanan	
		);
		$data['pelanggan_tahun_lalu'] = array(
			'detail'	=> $data_pelanggan_last_year,
			'subtotal'	=> $arr_extra_total
		);
		$data['pendapatan_triwulan'] = $pendapatan_triwulan;

		// persentase mf
		$persen_mf = 100-(25*$triwulan);

		$mf = $pendapatan >= $total_target ? (2/100) * ($data['pendapatan_triwulan']['total']) : (2/100) * ($persen_mf/100) * ($data['pendapatan_triwulan']['total']);
		$mf = floor($mf);


		$data['mf'] = array(
			'persen'	=> $pendapatan >= $total_target ? 100 : $persen_mf,
			'mf_diterima'	=> $mf
		);

		if ($output_type=='json') {
			echo json_encode($data);
		} else {
			$html = $this->load->view('marketing_fee/detail', $data, TRUE);
			echo $html;
		}
	}

}

/* End of file Marketing_fee.php */
/* Location: ./application/controllers/Marketing_fee.php */