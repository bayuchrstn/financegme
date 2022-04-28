<?php
class Export_data
{
    function __construct() {
        $this->CI =& get_instance();
    }

    function excel($params=array())
	{
		require_once("php-export-data-master/php-export-data.class.php");
		$excel = new ExportDataExcel('browser');
		$excel->filename = $params['filename'];

		$excel->initialize();
		// $row = array(0, 'judul', 'judul', 'judul', 'judul', 'judul');
		$row = $params['header'];
		$excel->addRow($row);


		foreach($params['data'] as $dt):
			// $row = array($i, 'as', 'as', 'as', 'as', 'as');
			$excel->addRow($dt);
		endforeach;

		$excel->finalize();
	}
}
