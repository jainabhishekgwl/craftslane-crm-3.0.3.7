<?php
namespace Opencart\Admin\Model\Extension\Opencart\Report;

static $registry = null;





    // Error Handler

function error_handler_download($errno, $errstr, $errfile, $errline) {

	global $registry;

	

	switch ($errno) {

		case E_NOTICE:

		case E_USER_NOTICE:

			$errors = "Notice";

			break;

		case E_WARNING:

		case E_USER_WARNING:

			$errors = "Warning";

			break;

		case E_ERROR:

		case E_USER_ERROR:

			$errors = "Fatal Error";

			break;

		default:

			$errors = "Unknown";

			break;

	}

	

	$config = $registry->get('config');

	$url = $registry->get('url');

	$request = $registry->get('request');

	$session = $registry->get('session');

	$log = $registry->get('log');

	

	if ($config->get('config_error_log')) {

		$log->write('PHP ' . $errors . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);

	}



	if (($errors=='Warning') || ($errors=='Unknown')) {

		return true;

	}



	$dir = version_compare(VERSION,'3.0','>=') ? 'extension' : 'tool';

	if (($errors != "Fatal Error") && isset($request->get['route']) && ($request->get['route']!="$dir/export_import/download"))  {

		if ($config->get('config_error_display')) {

			echo '<b>' . $errors . '</b>: ' . $errstr . ' in <b>' . $errfile . '</b> on line <b>' . $errline . '</b>';

		}

	} else {

		$session->data['export_import_error'] = array( 'errstr'=>$errstr, 'errno'=>$errno, 'errfile'=>$errfile, 'errline'=>$errline );

		$token = version_compare(VERSION,'3.0','>=') ? $request->get['user_token'] : $request->get['token'];

		$link = $url->link( "$dir/export_import", version_compare(VERSION,'3.0','>=') ? 'user_token='.$token : 'token='.$token, true );

		header('Status: ' . 302);

		header('Location: ' . str_replace(array('&amp;', "\n", "\r"), array('&', '', ''), $link));

		exit();

	}



	return true;

}





function fatal_error_shutdown_handler_for_export_import()

{

	$last_error = error_get_last();

	if ($last_error['type'] === E_ERROR) {

		// fatal error

		error_handler_download(E_ERROR, $last_error['message'], $last_error['file'], $last_error['line']);

	}

}

class Sale extends \Opencart\System\Engine\Model {
	public function getTotalSales(array $data = []): float {
		$sql = "SELECT SUM(`total`) AS `total` FROM `" . DB_PREFIX . "order` WHERE `order_status_id` > '0'";

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(`date_added`) = DATE('" . $this->db->escape((string)$data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);

		return (float)$query->row['total'];
	}

	public function getTotalOrdersByCountry(): array {
		$query = $this->db->query("SELECT COUNT(*) AS total, SUM(o.`total`) AS amount, c.`iso_code_2` FROM `" . DB_PREFIX . "order` o LEFT JOIN `" . DB_PREFIX . "country` c ON (o.`payment_country_id` = c.`country_id`) WHERE o.`order_status_id` > '0' GROUP BY o.`payment_country_id`");

		return $query->rows;
	}

	public function getTotalOrdersByDay(): array {
		$implode = [];

		foreach ($this->config->get('config_complete_status') as $order_status_id) {
			$implode[] = "'" . (int)$order_status_id . "'";
		}

		$order_data = [];

		for ($i = 0; $i < 24; $i++) {
			$order_data[$i] = [
				'hour'  => $i,
				'total' => 0
			];
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, HOUR(`date_added`) AS hour FROM `" . DB_PREFIX . "order` WHERE `order_status_id` IN(" . implode(",", $implode) . ") AND DATE(`date_added`) = DATE(NOW()) GROUP BY HOUR(`date_added`) ORDER BY `date_added` ASC");

		foreach ($query->rows as $result) {
			$order_data[$result['hour']] = [
				'hour'  => $result['hour'],
				'total' => $result['total']
			];
		}

		return $order_data;
	}

	public function getTotalOrdersByWeek(): array {
		$implode = [];

		foreach ($this->config->get('config_complete_status') as $order_status_id) {
			$implode[] = "'" . (int)$order_status_id . "'";
		}

		$order_data = [];

		$date_start = strtotime('-' . date('w') . ' days');

		for ($i = 0; $i < 7; $i++) {
			$date = date('Y-m-d', $date_start + ($i * 86400));

			$order_data[date('w', strtotime($date))] = [
				'day'   => date('D', strtotime($date)),
				'total' => 0
			];
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, `date_added` FROM `" . DB_PREFIX . "order` WHERE `order_status_id` IN(" . implode(",", $implode) . ") AND DATE(`date_added`) >= DATE('" . $this->db->escape(date('Y-m-d', $date_start)) . "') GROUP BY DAYNAME(`date_added`)");

		foreach ($query->rows as $result) {
			$order_data[date('w', strtotime($result['date_added']))] = [
				'day'   => date('D', strtotime($result['date_added'])),
				'total' => $result['total']
			];
		}

		return $order_data;
	}

	public function getTotalOrdersByMonth(): array {
		$implode = [];

		foreach ($this->config->get('config_complete_status') as $order_status_id) {
			$implode[] = "'" . (int)$order_status_id . "'";
		}

		$order_data = [];

		for ($i = 1; $i <= date('t'); $i++) {
			$date = date('Y') . '-' . date('m') . '-' . $i;

			$order_data[date('j', strtotime($date))] = [
				'day'   => date('d', strtotime($date)),
				'total' => 0
			];
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, `date_added` FROM `" . DB_PREFIX . "order` WHERE `order_status_id` IN(" . implode(",", $implode) . ") AND DATE(`date_added`) >= '" . $this->db->escape(date('Y') . '-' . date('m') . '-1') . "' GROUP BY DATE(`date_added`)");

		foreach ($query->rows as $result) {
			$order_data[date('j', strtotime($result['date_added']))] = [
				'day'   => date('d', strtotime($result['date_added'])),
				'total' => $result['total']
			];
		}

		return $order_data;
	}

	public function getTotalOrdersByYear(): array {
		$implode = [];

		foreach ($this->config->get('config_complete_status') as $order_status_id) {
			$implode[] = "'" . (int)$order_status_id . "'";
		}

		$order_data = [];

		for ($i = 1; $i <= 12; $i++) {
			$order_data[$i] = [
				'month' => date('M', mktime(0, 0, 0, $i)),
				'total' => 0
			];
		}

		$query = $this->db->query("SELECT COUNT(*) AS total, `date_added` FROM `" . DB_PREFIX . "order` WHERE `order_status_id` IN(" . implode(",", $implode) . ") AND YEAR(`date_added`) = YEAR(NOW()) GROUP BY MONTH(`date_added`)");

		foreach ($query->rows as $result) {
			$order_data[date('n', strtotime($result['date_added']))] = [
				'month' => date('M', strtotime($result['date_added'])),
				'total' => $result['total']
			];
		}

		return $order_data;
	}

	public function getOrders(array $data = []): array {
		$sql = "SELECT MIN(o.`date_added`) AS date_start, MAX(o.`date_added`) AS date_end, COUNT(*) AS orders, SUM((SELECT SUM(op.`quantity`) FROM `" . DB_PREFIX . "order_product` op WHERE op.`order_id` = o.`order_id` GROUP BY op.`order_id`)) AS products, SUM((SELECT SUM(ot.`value`) FROM `" . DB_PREFIX . "order_total` ot WHERE ot.`order_id` = o.`order_id` AND ot.`code` = 'tax' GROUP BY ot.`order_id`)) AS tax, SUM(o.`total`) AS `total` FROM `" . DB_PREFIX . "order` o";

		if (!empty($data['filter_order_status_id'])) {
			$sql .= " WHERE o.`order_status_id` = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " WHERE o.`order_status_id` > '0'";
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.`date_added`) >= '" . $this->db->escape((string)$data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.`date_added`) <= '" . $this->db->escape((string)$data['filter_date_end']) . "'";
		}

		if (!empty($data['filter_group'])) {
			$group = $data['filter_group'];
		} else {
			$group = 'week';
		}

		switch($group) {
			case 'day';
				$sql .= " GROUP BY YEAR(o.`date_added`), MONTH(o.`date_added`), DAY(o.`date_added`)";
				break;
			default:
			case 'week':
				$sql .= " GROUP BY YEAR(o.`date_added`), WEEK(o.`date_added`)";
				break;
			case 'month':
				$sql .= " GROUP BY YEAR(o.`date_added`), MONTH(o.`date_added`)";
				break;
			case 'year':
				$sql .= " GROUP BY YEAR(o.`date_added`)";
				break;
		}

		$sql .= " ORDER BY o.`date_added` DESC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalOrders(array $data = []): int {
		if (!empty($data['filter_group'])) {
			$group = $data['filter_group'];
		} else {
			$group = 'week';
		}

		switch($group) {
			case 'day';
				$sql = "SELECT COUNT(DISTINCT YEAR(`date_added`), MONTH(`date_added`), DAY(`date_added`)) AS `total` FROM `" . DB_PREFIX . "order`";
				break;
			default:
			case 'week':
				$sql = "SELECT COUNT(DISTINCT YEAR(`date_added`), WEEK(`date_added`)) AS `total` FROM `" . DB_PREFIX . "order`";
				break;
			case 'month':
				$sql = "SELECT COUNT(DISTINCT YEAR(`date_added`), MONTH(`date_added`)) AS `total` FROM `" . DB_PREFIX . "order`";
				break;
			case 'year':
				$sql = "SELECT COUNT(DISTINCT YEAR(`date_added`)) AS `total` FROM `" . DB_PREFIX . "order`";
				break;
		}

		if (!empty($data['filter_order_status_id'])) {
			$sql .= " WHERE `order_status_id` = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " WHERE `order_status_id` > '0'";
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(`date_added`) >= '" . $this->db->escape((string)$data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(`date_added`) <= '" . $this->db->escape((string)$data['filter_date_end']) . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTaxes(array $data = []): array {
		$sql = "SELECT MIN(o.`date_added`) AS date_start, MAX(o.`date_added`) AS date_end, ot.`title`, SUM(ot.`value`) AS total, COUNT(o.`order_id`) AS `orders` FROM `" . DB_PREFIX . "order` o LEFT JOIN `" . DB_PREFIX . "order_total` ot ON (ot.`order_id` = o.`order_id`) WHERE ot.`code` = 'tax'";

		if (!empty($data['filter_order_status_id'])) {
			$sql .= " AND o.`order_status_id` = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " AND o.`order_status_id` > '0'";
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.`date_added`) >= '" . $this->db->escape((string)$data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.`date_added`) <= '" . $this->db->escape((string)$data['filter_date_end']) . "'";
		}

		if (!empty($data['filter_group'])) {
			$group = $data['filter_group'];
		} else {
			$group = 'week';
		}

		switch($group) {
			case 'day';
				$sql .= " GROUP BY YEAR(o.`date_added`), MONTH(o.`date_added`), DAY(o.`date_added`), ot.`title`";
				break;
			default:
			case 'week':
				$sql .= " GROUP BY YEAR(o.`date_added`), WEEK(o.`date_added`), ot.`title`";
				break;
			case 'month':
				$sql .= " GROUP BY YEAR(o.`date_added`), MONTH(o.`date_added`), ot.`title`";
				break;
			case 'year':
				$sql .= " GROUP BY YEAR(o.`date_added`), ot.`title`";
				break;
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalTaxes(array $data = []): int {
		if (!empty($data['filter_group'])) {
			$group = $data['filter_group'];
		} else {
			$group = 'week';
		}

		switch($group) {
			case 'day';
				$sql = "SELECT COUNT(DISTINCT YEAR(o.`date_added`), MONTH(o.`date_added`), DAY(o.`date_added`), ot.`title`) AS `total` FROM `" . DB_PREFIX . "order` o";
				break;
			default:
			case 'week':
				$sql = "SELECT COUNT(DISTINCT YEAR(o.`date_added`), WEEK(o.`date_added`), ot.`title`) AS `total` FROM `" . DB_PREFIX . "order` o";
				break;
			case 'month':
				$sql = "SELECT COUNT(DISTINCT YEAR(o.`date_added`), MONTH(o.`date_added`), ot.`title`) AS `total` FROM `" . DB_PREFIX . "order` o";
				break;
			case 'year':
				$sql = "SELECT COUNT(DISTINCT YEAR(o.`date_added`), ot.`title`) AS `total` FROM `" . DB_PREFIX . "order` o";
				break;
		}

		$sql .= " LEFT JOIN `" . DB_PREFIX . "order_total` ot ON (o.`order_id` = ot.`order_id`) WHERE ot.`code` = 'tax'";

		if (!empty($data['filter_order_status_id'])) {
			$sql .= " AND o.`order_status_id` = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " AND o.`order_status_id` > '0'";
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.`date_added`) >= '" . $this->db->escape((string)$data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.`date_added`) <= '" . $this->db->escape((string)$data['filter_date_end']) . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getShipping(array $data = []): array {
		$sql = "SELECT MIN(o.`date_added`) AS date_start, MAX(o.`date_added`) AS date_end, ot.`title`, SUM(ot.`value`) AS total, COUNT(o.`order_id`) AS orders FROM `" . DB_PREFIX . "order` o LEFT JOIN `" . DB_PREFIX . "order_total` ot ON (o.`order_id` = ot.`order_id`) WHERE ot.`code` = 'shipping'";

		if (!empty($data['filter_order_status_id'])) {
			$sql .= " AND o.`order_status_id` = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " AND o.`order_status_id` > '0'";
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.`date_added`) >= '" . $this->db->escape((string)$data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.`date_added`) <= '" . $this->db->escape((string)$data['filter_date_end']) . "'";
		}

		if (!empty($data['filter_group'])) {
			$group = $data['filter_group'];
		} else {
			$group = 'week';
		}

		switch($group) {
			case 'day';
				$sql .= " GROUP BY YEAR(o.`date_added`), MONTH(o.`date_added`), DAY(o.`date_added`), ot.`title`";
				break;
			default:
			case 'week':
				$sql .= " GROUP BY YEAR(o.`date_added`), WEEK(o.`date_added`), ot.`title`";
				break;
			case 'month':
				$sql .= " GROUP BY YEAR(o.`date_added`), MONTH(o.`date_added`), ot.`title`";
				break;
			case 'year':
				$sql .= " GROUP BY YEAR(o.`date_added`), ot.`title`";
				break;
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalShipping(array $data = []): int {
		if (!empty($data['filter_group'])) {
			$group = $data['filter_group'];
		} else {
			$group = 'week';
		}

		switch($group) {
			case 'day';
				$sql = "SELECT COUNT(DISTINCT YEAR(o.`date_added`), MONTH(o.`date_added`), DAY(o.`date_added`), ot.`title`) AS `total` FROM `" . DB_PREFIX . "order` o";
				break;
			default:
			case 'week':
				$sql = "SELECT COUNT(DISTINCT YEAR(o.`date_added`), WEEK(o.`date_added`), ot.`title`) AS `total` FROM `" . DB_PREFIX . "order` o";
				break;
			case 'month':
				$sql = "SELECT COUNT(DISTINCT YEAR(o.`date_added`), MONTH(o.`date_added`), ot.`title`) AS `total` FROM `" . DB_PREFIX . "order` o";
				break;
			case 'year':
				$sql = "SELECT COUNT(DISTINCT YEAR(o.`date_added`), ot.`title`) AS `total` FROM `" . DB_PREFIX . "order` o";
				break;
		}

		$sql .= " LEFT JOIN `" . DB_PREFIX . "order_total` ot ON (o.`order_id` = ot.`order_id`) WHERE ot.`code` = 'shipping'";

		if (!empty($data['filter_order_status_id'])) {
			$sql .= " AND `order_status_id` = '" . (int)$data['filter_order_status_id'] . "'";
		} else {
			$sql .= " AND `order_status_id` > '0'";
		}

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.`date_added`) >= '" . $this->db->escape((string)$data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.`date_added`) <= '" . $this->db->escape((string)$data['filter_date_end']) . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
        
        public function download($filter_data,$file_name,$file_title,$download){

            // we use our own error handler

           

		global $registry;

		$registry = $this->registry;

		set_error_handler('error_handler_download',E_ALL);

		register_shutdown_function('fatal_error_shutdown_handler_for_export_import');



		// Use the PHPExcel package from https://github.com/PHPOffice/PHPExcel

		$cwd = getcwd();

		$dir = (strcmp(VERSION,'3.0.0.0')>=0) ? 'library/export_import' : 'PHPExcel';

		chdir( DIR_SYSTEM.$dir );

		require_once( 'Classes/PHPExcel.php' );

		PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_ExportImportValueBinder() );

		chdir( $cwd );



		try {

			// set appropriate timeout limit

			set_time_limit( 1800 );



			// create a new workbook

			$workbook = new PHPExcel();



			// set some default styles

			$workbook->getDefaultStyle()->getFont()->setName('Arial');

			$workbook->getDefaultStyle()->getFont()->setSize(10);

			//$workbook->getDefaultStyle()->getAlignment()->setIndent(0.5);

			$workbook->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

			$workbook->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

			$workbook->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);



			// pre-define some commonly used styles

			$box_format = array(

                            'fill' => array(

                                    'type'      => PHPExcel_Style_Fill::FILL_SOLID,

                                    'color'     => array( 'rgb' => 'F0F0F0')

                            ),

                            /*

                            'alignment' => array(

                                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,

                                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,

                                    'wrap'       => false,

                                    'indent'     => 0

                            )

                            */

			);

			$text_format = array(

                            'numberformat' => array(

                                    'code' => PHPExcel_Style_NumberFormat::FORMAT_TEXT

                            ),

                            /*

                            'alignment' => array(

                                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,

                                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,

                                    'wrap'       => false,

                                    'indent'     => 0

                            )

                            */

			);

			$price_format = array(

                            'numberformat' => array(

                                    'code' => '######0.00'

                            ),

                            'alignment' => array(

                                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,

                                    /*

                                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,

                                    'wrap'       => false,

                                    'indent'     => 0

                                    */

                            )

			);

			$weight_format = array(

                            'numberformat' => array(

                                    'code' => '##0.00'

                            ),

                            'alignment' => array(

                                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,

                                    /*

                                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,

                                    'wrap'       => false,

                                    'indent'     => 0

                                    */

                            )

			);

			

			// create the worksheets

			$worksheet_index = 0;

                        $filename = $file_name.'_'.$datetime = date('Y-m-d').'.xlsx';

                        // creating the Categories worksheet

                        $workbook->setActiveSheetIndex($worksheet_index++);

                        $worksheet = $workbook->getActiveSheet();

                        $worksheet->setTitle( $file_title );

                        if($download == 'order_report'){

                        $this->getOrdersData( $worksheet, $box_format, $text_format,$filter_data);

                        }else if($download == 'tax_report'){

                             $this->getTaxData( $worksheet, $box_format, $text_format,$filter_data);

                            

                        }else if($download == 'purchased_report'){

                             $this->getPurchasedData( $worksheet, $box_format, $text_format,$filter_data);

                            

                        }

                       

                        $worksheet->freezePaneByColumnAndRow( 1, 2 );

                        

                        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

			header('Content-Disposition: attachment;filename="'.$filename.'"');

			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($workbook, 'Excel2007');

			$objWriter->setPreCalculateFormulas(false);

			$objWriter->save('php://output');



			// Clear the spreadsheet caches

			$this->clearSpreadsheetCache();

			exit;

                        

                        

        }

        catch(Exception $e){

            $errstr = $e->getMessage();

                $errline = $e->getLine();

                $errfile = $e->getFile();

                $errno = $e->getCode();

                $this->session->data['export_import_error'] = array( 'errstr'=>$errstr, 'errno'=>$errno, 'errfile'=>$errfile, 'errline'=>$errline );

                if ($this->config->get('config_error_log')) {

                        $this->log->write('PHP ' . get_class($e) . ':  ' . $errstr . ' in ' . $errfile . ' on line ' . $errline);

                }

                return;

        }

    }
}
