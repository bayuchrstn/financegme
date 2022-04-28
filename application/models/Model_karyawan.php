<?php
class Model_karyawan extends CI_Model {

   	function __construct()
    {
        parent:: __construct();
    }

    function data($filter_like=array())
	{
		$this->regional->set_filter();
		$this->db->where('status_karyawan', 'aktif');
		$this->db->select('people.*');
		$this->db->select('departemen.name as departemen_name');
		$this->db->select('jabatan.name as jabatan_name');
		$this->db->join('master departemen', 'departemen.code = people.departemen AND departemen.category=\'departement\' ', 'left');
		$this->db->join('master jabatan', 'jabatan.code = people.jabatan AND jabatan.category=\'jabatan\' ', 'left');

		if (count($filter_like)>0) {
			$this->db->like($filter_like);
		}

		$data = $this->db->get('people')->result_array();
		return $data;
	}

	function detail($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('people')->row_array();
		return $data;
	}

	function detail_ext($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('people_ext')->row_array();
		return $data;
	}

	function get_ext($ext_type='pendidikan', $person_id)
	{
		$this->db->order_by('sort', 'asc');
		$this->db->where('person_id', $person_id);
		$this->db->where('type', $ext_type);
		$data = $this->db->get('people_ext')->result_array();
		// pre($this->db->last_query());
		return $data;
	}

    function select_option($mode='customer')
	{
		$arr = array();
		switch ($mode) {

			case 'agama' :
                $data = $this->master->arr('agama');
                if(!empty($data)):
                    foreach($data as $row=>$val):
                        $arr[$row] = $val;
                    endforeach;
                endif;
			break;

        	case 'jenis_kelamin' :
                $data = $this->master->arr('jenis_kelamin');
                if(!empty($data)):
                    foreach($data as $row=>$val):
                        $arr[$row] = $val;
                    endforeach;
                endif;
			break;
        	case 'golongan_darah' :
                $data = $this->master->arr('golongan_darah');
                if(!empty($data)):
                    foreach($data as $row=>$val):
                        $arr[$row] = $val;
                    endforeach;
                endif;
			break;
        	case 'status_pernikahan' :
                $data = $this->master->arr('status_pernikahan');
                if(!empty($data)):
                    foreach($data as $row=>$val):
                        $arr[$row] = $val;
                    endforeach;
                endif;
			break;
        	case 'jabatan' :
                $data = $this->master->arr('jabatan');
                if(!empty($data)):
                    foreach($data as $row=>$val):
                        $arr[$row] = $val;
                    endforeach;
                endif;
			break;

        	case 'departemen' :
                $data = $this->master->arr('departement');
                if(!empty($data)):
                    foreach($data as $row=>$val):
                        $arr[$row] = $val;
                    endforeach;
                endif;
			break;
        	case 'level' :
                $data = $this->db->get('usergroup')->result_array();
                if(!empty($data)):
                    foreach($data as $row):
                        $arr[$row['code']] = $row['name'];
                    endforeach;
                endif;
			break;
        	case 'status_karyawan' :
                $arr['aktif'] = 'Aktif';
                $arr['non_aktif'] = 'Non Aktif';
			break;

			case 'regional' :
				$data = $this->regional->arr_regional_nik();
				if(!empty($data)):
                    foreach($data as $code=>$label):
                        $arr[$code] = $label;
                    endforeach;
                endif;
			break;

			//pre customer
			default:
				$data = $this->master->arr('pendidikan');
				if(!empty($data)):
					foreach($data as $row=>$val):
						$arr[$row] = $val;
					endforeach;
				endif;
			break;
		}

		return($arr);
	}

	function build_select_option()
	{
		$arr = array();
		$arr['pendidikan'] = $this->select_option('pendidikan');
		$arr['agama'] = $this->select_option('agama');
		$arr['jenis_kelamin'] = $this->select_option('jenis_kelamin');
		$arr['golongan_darah'] = $this->select_option('golongan_darah');
		$arr['status_pernikahan'] = $this->select_option('status_pernikahan');
		$arr['departemen'] = $this->select_option('departemen');
		$arr['jabatan'] = $this->select_option('jabatan');
		$arr['status_karyawan'] = $this->select_option('status_karyawan');
		$arr['level'] = $this->select_option('level');
		$arr['regional'] = $this->select_option('regional');
		return $arr;
	}

	function new_timeline($person_id, $category, $date)
	{
		$data = array(
				'person_id'	=> $person_id,
				'category'	=> $category,
				'status'	=> '1',
				'date'		=> $date,
			);
		$this->db->insert('people_timeline', $data);
	}

	function create_account()
	{
		$data = array(
			'username'			=> $this->input->post('username'),
			'password'			=> $this->input->post('password'),
			'name'				=> $this->input->post('name'),
			'level'				=> $this->input->post('usergroup'),
			'active'			=> '1',
			'email'				=> $this->input->post('email'),
			'regional'			=> $this->input->post('regional'),
		);
		$this->db->insert('users', $data);
	}

	function get_ulang_tahun($regional='')
	{
		$tanggal = date('Y-m-d');
		// $query = 'SELECT `gmd_people`.*, CONCAT(IF(DATE_FORMAT(\''.$tanggal.'\',\'%m\')=12 AND DATE_FORMAT(tanggal_lahir,\'%m\')<>12, DATE_FORMAT(\''.$tanggal.'\',\'%Y\')+1, DATE_FORMAT(\''.$tanggal.'\',\'%Y\')),\'-\', DATE_FORMAT(tanggal_lahir,\'%m-%d\')) AS `tanggal_ultah` FROM gmd_people WHERE (DATE_FORMAT(tanggal_lahir, \'%m\') = DATE_FORMAT(\''.$tanggal.'\',\'%m\') OR DATEDIFF(CONCAT(IF(DATE_FORMAT(\''.$tanggal.'\',\'%m\')=12, DATE_FORMAT(\''.$tanggal.'\',\'%Y\')+1, DATE_FORMAT(\''.$tanggal.'\',\'%Y\')),\'-\', DATE_FORMAT(tanggal_lahir,\'%m-%d\')), \''.$tanggal.'\') BETWEEN 0 AND 10) AND (status_karyawan = \'aktif\' OR status_karyawan = \'training\') AND IF(\''.$regional.'\' = \'\', 1=1 , regional=\''.$regional.'\') ORDER BY CONCAT(IF(DATE_FORMAT(\''.$tanggal.'\',\'%m\')=12 AND DATE_FORMAT(tanggal_lahir,\'%m\')<>12, DATE_FORMAT(\''.$tanggal.'\',\'%Y\')+1, DATE_FORMAT(\''.$tanggal.'\',\'%Y\')),\'-\', DATE_FORMAT(tanggal_lahir,\'%m-%d\')) ASC';
		$query = 'SELECT `gmd_people`.*,(DATE_FORMAT(\''.$tanggal.'\',\'%Y\') - IF(DATE_FORMAT(tanggal_lahir,\'%m\') = 1, DATE_FORMAT(tanggal_lahir,\'%Y\')-1, DATE_FORMAT(tanggal_lahir,\'%Y\'))) AS `ultah_ke`, DATE_FORMAT(tanggal_lahir,\'%d %M\') AS `tanggal_ultah` FROM gmd_people WHERE (DATE_FORMAT(tanggal_lahir, \'%m\') = DATE_FORMAT(\''.$tanggal.'\',\'%m\') OR DATEDIFF(CONCAT(IF(DATE_FORMAT(\''.$tanggal.'\',\'%m\')=12, DATE_FORMAT(\''.$tanggal.'\',\'%Y\')+1, DATE_FORMAT(\''.$tanggal.'\',\'%Y\')),\'-\', DATE_FORMAT(tanggal_lahir,\'%m-%d\')), \''.$tanggal.'\') BETWEEN 0 AND 10) AND (status_karyawan = \'aktif\' OR status_karyawan = \'training\') AND IF(\''.$regional.'\' = \'\', 1=1 , regional=\''.$regional.'\') ORDER BY CONCAT(IF(DATE_FORMAT(\''.$tanggal.'\',\'%m\')=12 AND DATE_FORMAT(tanggal_lahir,\'%m\')<>12, DATE_FORMAT(\''.$tanggal.'\',\'%Y\')+1, DATE_FORMAT(\''.$tanggal.'\',\'%Y\')),\'-\', DATE_FORMAT(tanggal_lahir,\'%m-%d\')) ASC';

		$query = $this->db->query($query);
		// $query = $this->db->get();
		return $query->result_array();
	}
}
