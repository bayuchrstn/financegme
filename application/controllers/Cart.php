	<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Cart extends MY_Controller {

		function __construct()
		{
			parent::__construct();
			check_login();
			$this->lang->load('cart');
		}

		public function index()
		{
			pre($this->cart->contents());
		}

	

		function insert()
		{
			$arr = array();
			if($this->input->post('cart_id') && $this->input->post('cart_qty') && $this->input->post('cart_price') && $this->input->post('cart_name')):
				// cekpost();
				$data = array(
					'id'      => $this->input->post('cart_id'),
					'qty'     => $this->input->post('cart_qty'),
					'price'   => $this->input->post('cart_price'),
					'name'    => $this->input->post('cart_name'),
				);

				if($this->input->post('options')):
					foreach($this->input->post('options') as $key=>$val):
						$data['options'][$key] = $val;
					endforeach;
				endif;
				$this->cart->product_name_rules = '[:print:]';
				$this->cart->insert($data);
				$arr['status'] = 'success';
				$arr['msg'] = 'data berhasil disimpan';
			else:
				$arr['status'] = 'failed';
				$arr['msg'] = 'data gagal disimpan';
			endif;
			echo json_encode($arr);
		}

		function multiple_insert()
		{
			$data = array();
			$cart_id = $this->input->post('cart_id');
			$cart_qty = $this->input->post('cart_qty');
			$cart_price = $this->input->post('cart_price');
			$cart_name = $this->input->post('cart_name');
			$cart_options = $this->input->post('options');
			// $cart_id = $this->input->post('cart_id');

			$urut = 0;
			foreach($cart_id as $key):
				$data[] = array(
						'id'		=> $cart_id[$urut],
						'qty'		=> $cart_qty[$urut],
						'price'		=> $cart_price[$urut],
						'name'		=> $cart_name[$urut],
						'options'	=> array(
							'item'		=> $cart_options['item'][$urut],
							'item_id'	=> $cart_options['item_id'][$urut],
							'discount'	=> $cart_options['discount'][$urut],
							'tax'		=> $cart_options['tax'][$urut],
							'cost_price'=> $cart_options['cost_price'][$urut],
							'packet'	=> $cart_options['packet'][$urut],
						),
					);
				$urut++;
			endforeach;
			$this->cart->product_name_rules = '[:print:]';
			$this->cart->insert($data);
		}

		function update()
		{
			// cekpost();
			$data = array();
			foreach($_POST as $key=>$val):
				if($key=='price' || $key=='qty'):
					$data[$key] = paranoid($val);
				else:
					$data[$key] = $val;
				endif;
			endforeach;
			// pre($data);
			$this->cart->update($data);
		}

		function delete($rowid)
		{
			$arr = array();
			$data['rowid'] = $rowid;
			$data['qty'] = '0';
			$this->cart->update($data);
			$arr['status'] = 'failed';
			$arr['msg'] = 'data gagal disimpan';
		}

		function destroy()
		{
			$this->cart->destroy();
			redirect(base_url().'cart');
		}

	}
