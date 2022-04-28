<?php
class Model_product extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function all($category)
    {
        $this->db->order_by('sort', 'asc');
        $this->db->where('category', $category);
        return $this->db->get('product')->result_array();
    }

    function show_by_category($category)
    {
        $this->db->where('category', $category);
        return $this->db->get('product')->result_array();
    }

    function arr_product()
    {
        $arr = array();
        $current = $this->all();
        if(!empty($current)):
            foreach($current as $row):
                $arr[$row['code']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

    function detail($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('product')->row_array();
    }

    function get_product_category()
    {
		$where = "(regional='' OR regional='".session_scope_regional()."' OR regional is null)";
        $this->db->where($where);
        return $this->db->get('product_category')->result_array();
    }

    function arr_product_category()
    {
        $arr = array();
        $category = $this->get_product_category();
        if(!empty($category)):
            foreach($category as $row):
                $arr[$row['code']] = $row['name'];
            endforeach;
        endif;
        return $arr;
    }

	function insert($param=array())
	{
		if($this->input->post('code')):
		    $data['code'] = htmlspecialchars($this->input->post('code'));
		elseif(isset($param['code'])):
		    $data['code'] = htmlspecialchars($param['code']);
		else:
		    $data['code'] = code_generator();
		endif;

		if($this->input->post('name')):
		    $data['name'] = htmlspecialchars($this->input->post('name'));
		elseif(isset($param['name'])):
		    $data['name'] = htmlspecialchars($param['name']);
		else:
		    $data['name'] = '';
		endif;

		if($this->input->post('category')):
		    $data['category'] = htmlspecialchars($this->input->post('category'));
		elseif(isset($param['category'])):
		    $data['category'] = htmlspecialchars($param['category']);
		else:
		    $data['category'] = '';
		endif;

		if($this->input->post('note')):
		    $data['note'] = htmlspecialchars($this->input->post('note'));
		elseif(isset($param['note'])):
		    $data['note'] = htmlspecialchars($param['note']);
		else:
		    $data['note'] = '';
		endif;

		if($this->input->post('flag_delete')):
		    $data['flag_delete'] = htmlspecialchars($this->input->post('flag_delete'));
		elseif(isset($param['flag_delete'])):
		    $data['flag_delete'] = htmlspecialchars($param['flag_delete']);
		else:
		    $data['flag_delete'] = '0';
		endif;

		if($this->input->post('regional')):
		    $data['regional'] = htmlspecialchars($this->input->post('regional'));
		elseif(isset($param['regional'])):
		    $data['regional'] = htmlspecialchars($param['regional']);
		else:
		    $data['regional'] = session_scope_regional();
		endif;

		if($this->input->post('flag_fixprice')):
		    $data['flag_fixprice'] = htmlspecialchars($this->input->post('flag_fixprice'));
		elseif(isset($param['flag_fixprice'])):
		    $data['flag_fixprice'] = htmlspecialchars($param['flag_fixprice']);
		else:
		    $data['flag_fixprice'] = 'N';
		endif;

		if($this->input->post('flag_internet_service')):
		    $data['flag_internet_service'] = htmlspecialchars($this->input->post('flag_internet_service'));
		elseif(isset($param['flag_internet_service'])):
		    $data['flag_internet_service'] = htmlspecialchars($param['flag_internet_service']);
		else:
		    $data['flag_internet_service'] = 'Y';
		endif;

		if($this->input->post('price')):
		    $data['price'] = paranoid($this->input->post('price'));
		elseif(isset($param['price'])):
		    $data['price'] = paranoid($param['price']);
		else:
		    $data['price'] = '';
		endif;

		if($this->input->post('value')):
		    $data['value'] = paranoid($this->input->post('value'));
		elseif(isset($param['value'])):
		    $data['value'] = paranoid($param['value']);
		else:
		    $data['value'] = '';
		endif;

		if($this->input->post('satuan_bandwidth')):
		    $data['satuan_bandwidth'] = $this->input->post('satuan_bandwidth');
		elseif(isset($param['satuan_bandwidth'])):
		    $data['satuan_bandwidth'] = $param['satuan_bandwidth'];
		else:
		    $data['satuan_bandwidth'] = '';
		endif;

		$insert = $this->db->insert('product', $data);
		$arr['status'] = $insert;
		$arr['last_id'] = $this->db->insert_id();
		return $arr;
	}



    function update($param=array())
    {
        $data = array();

        if($this->input->post('name')):
            $data['name'] = $this->input->post('name');
        elseif(isset($param['name'])):
            $data['name'] = $param['name'];
        endif;

        if($this->input->post('category')):
            $data['category'] = $this->input->post('category');
        elseif(isset($param['category'])):
            $data['category'] = $param['category'];
        endif;

        if($this->input->post('note')):
            $data['note'] = $this->input->post('note');
        elseif(isset($param['note'])):
            $data['note'] = $param['note'];
		else:
			$data['note'] = '';
        endif;

        if($this->input->post('flag_delete')):
            $data['flag_delete'] = $this->input->post('flag_delete');
        elseif(isset($param['flag_delete'])):
            $data['flag_delete'] = $param['flag_delete'];
        endif;

        if($this->input->post('regional')):
            $data['regional'] = $this->input->post('regional');
        elseif(isset($param['regional'])):
            $data['regional'] = $param['regional'];
        endif;

        if($this->input->post('flag_fixprice')):
            $data['flag_fixprice'] = $this->input->post('flag_fixprice');
        elseif(isset($param['flag_fixprice'])):
            $data['flag_fixprice'] = $param['flag_fixprice'];
        endif;

		if($this->input->post('flag_internet_service')):
		    $data['flag_internet_service'] = htmlspecialchars($this->input->post('flag_internet_service'));
		elseif(isset($param['flag_internet_service'])):
		    $data['flag_internet_service'] = htmlspecialchars($param['flag_internet_service']);
		else:
		    $data['flag_internet_service'] = 'Y';
		endif;

		if($this->input->post('price')):
		    $data['price'] = paranoid($this->input->post('price'));
		elseif(isset($param['price'])):
		    $data['price'] = paranoid($param['price']);
		else:
		    $data['price'] = '';
		endif;

		if($this->input->post('value')):
		    $data['value'] = $this->input->post('value');
		elseif(isset($param['value'])):
		    $data['value'] = $param['value'];
		else:
		    $data['value'] = '';
		endif;

		if($this->input->post('satuan_bandwidth')):
		    $data['satuan_bandwidth'] = $this->input->post('satuan_bandwidth');
		elseif(isset($param['satuan_bandwidth'])):
		    $data['satuan_bandwidth'] = $param['satuan_bandwidth'];
		else:
		    $data['satuan_bandwidth'] = '';
		endif;

        if(!empty($data)):
            if($this->input->post('id')):
                $this->db->where('id', $this->input->post('id'));
            elseif(isset($param['id'])):
                $this->db->where('id', $param['id']);
            endif;
            $insert = $this->db->update('product', $data);
        endif;
    }

    function arr_product_picker()
    {
        $arr = array();
        $product_category = $this->get_product_category();
        if(!empty($product_category)):
            foreach($product_category as $row):
                $pl = $this->show_by_category($row['code']);
                $arr[] = array(
                    'category_code'     => $row['code'],
                    'category_name'     => $row['name'],
                    'multiple'       => $row['note'],
                    'product_lists'     => $pl
                );
            endforeach;
        endif;
        return $arr;
    }

}
