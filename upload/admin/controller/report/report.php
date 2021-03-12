<?php
namespace Opencart\Admin\Controller\Report;
class Report extends \Opencart\System\Engine\Controller {
	public function index(): void {
		$this->load->language('report/report');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = [];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('report/report', 'user_token=' . $this->session->data['user_token'])
		];

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->request->get['code'])) {
			$data['code'] = $this->request->get['code'];
		} else {
			$data['code'] = '';
		}

		// Reports
		$data['reports'] = [];
                
                if (isset($this->request->get['filter_date_start'])) {
			$filter_date_start = $this->request->get['filter_date_start'];
		} else {
			$filter_date_start = '';
		}

		if (isset($this->request->get['filter_date_end'])) {
			$filter_date_end = $this->request->get['filter_date_end'];
		} else {
			$filter_date_end = '';
		}

		if (isset($this->request->get['filter_order_status_id'])) {
			$filter_order_status_id = (int)$this->request->get['filter_order_status_id'];
		} else {
			$filter_order_status_id = 0;
		}
                
                if (isset($this->request->get['download'])) {
			$download = (int)$this->request->get['download'];
		} else {
			$download = 0;
		}

		$this->load->model('setting/extension');

		// Get a list of installed modules
		$results = $this->model_setting_extension->getExtensionsByType('report');
		
		// Add all the modules which have multiple settings for each module
		foreach ($results as $result) {
			if ($this->config->get('report_' . $result['code'] . '_status') && $this->user->hasPermission('access', 'extension/' . $result['extension'] . '/report/' . $result['code'])) {
				$this->load->language('extension/' . $result['extension'] . '/report/' . $result['code'], $result['code']);
				
				$data['reports'][] = [
					'text'       => $this->language->get($result['code'] . '_heading_title'),
					'code'       => $result['code'],
					'sort_order' => $this->config->get('report_' . $result['code'] . '_sort_order'),
					'href'       => $this->url->link('extension/' . $result['extension'] . '/report/' . $result['code'] . '|report', 'user_token=' . $this->session->data['user_token'].'&filter_date_start='.$filter_date_start.'&filter_date_end='.$filter_date_end.'&filter_order_status_id='.$filter_order_status_id.'&download='.$download)
				];
			}
		}
		
		$sort_order = [];

		foreach ($data['reports'] as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $data['reports']);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
    		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('report/report', $data));
	}
}
