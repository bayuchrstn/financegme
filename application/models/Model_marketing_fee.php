<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_marketing_fee extends CI_Model {

	function customer_this_year($id_am)
    {
        $month = date('m');
        $year = date('Y');
        $this->db->select('customer.customer_name, customer.ppn, DATE_FORMAT({PRE}customer.tanggal_billing, \'%d\') as tanggal_billing,  DATE_FORMAT({PRE}customer.tanggal_billing, \'%m\') as bulan_billing, DATE_FORMAT({PRE}customer.tanggal_billing, \'%Y\') as tahun_billing, users.name, product.name as product_name, product.price, customer_product.product_value, customer_product.product_price, customer_product.satuan_bandwidth')
            ->join('users', 'users.id = customer.id_am')
            ->join('customer_product', 'customer_product.customer_id = customer.id')
            ->join('product', 'product.id = customer_product.product_id_new','left');
        $this->db->where('customer.id_am', $id_am)
            ->where('customer.status','customer')
            ->where('customer.status_active','1')
            ->where('customer_product.product_price !=', '1')
            ->group_start()
                ->where('customer.billing_year', $year)
                ->or_where('DATE_FORMAT({PRE}customer.tanggal_billing, \'%Y\') = ', $year)
            ->group_end();
        $this->db->order_by('customer.tanggal_billing', 'asc');
        $query = $this->db->get('customer');
        $data = $query->result_array();

        // $new_customer = $this->new_customer_target_by_id_am($id_am);
        $new_customer = array();

        if (count($new_customer) > 0) {
            // array_push($data, $new_customer);
        }

        return $data;
    }

    function customer_last_year($id_am, $triwulan=1)
    {
        $month = (($triwulan-1)*3) + 1;
        $year = date('Y');
        $this->db->select('customer.customer_name, customer.ppn, DATE_FORMAT({PRE}customer.tanggal_billing, \'%d\') as tanggal_billing,  DATE_FORMAT({PRE}customer.tanggal_billing, \'%m\') as bulan_billing, DATE_FORMAT({PRE}customer.tanggal_billing, \'%Y\') as tahun_billing, users.name, product.name as product_name, product.price, customer_product.product_value, customer_product.product_price, customer_product.satuan_bandwidth')
            ->join('users', 'users.id = customer.id_am')
            ->join('customer_product', 'customer_product.customer_id = customer.id')
            ->join('product', 'product.id = customer_product.product_id_new','left');
        $this->db->where('customer.id_am', $id_am)
            ->where('customer.status','customer')
            ->where('customer.status_active','1')
            ->where('customer_product.product_price !=', '1')
            ->where('customer.tanggal_billing BETWEEN \''.($year-1).'-'.$month.'-02'.'\' AND \''.($year-1).'-12-31\' ');
        $this->db->order_by('customer.tanggal_billing', 'asc');
        $query = $this->db->get('customer');
        $data = $query->result_array();

        return $data;
    }

}

/* End of file Model_marketing_fee.php */
/* Location: ./application/models/Model_marketing_fee.php */