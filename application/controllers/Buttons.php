<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buttons extends CI_Controller
{
	private $buttons_dir = APPPATH . 'buttons' . DIRECTORY_SEPARATOR;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$data['active_page'] = 'buttons';
		$json_files = glob($this->buttons_dir  .  "*.json");

		$files = [];
		foreach ($json_files as $json_file) {
			$info = pathinfo($json_file);
			$info['path'] = $json_file;
			$info['b64_filename'] = base64_encode($info["filename"]);
			$files[] = $info;
		}

		$this->load->view('layout', ['content' => $this->load->view('buttons/index', [
			'files' => $files,
			'data' => $data
		], true),]);
	}


	public function create()
	{
		$this->load->helper('form');
		
		$this->load->library('session');

		if ($this->input->method() == 'post') {
			$data = $this->input->post();

			// Reestructura los datos del formulario en la estructura que deseas para tu archivo JSON.
			$jsonData = array(
				'description' => $data['description'],
				'enable' => isset($data['enable']),
				'schedules' => array(
					'monday' => array(
						'enable' => isset($data['monday_enable']),
						'from' => $data['monday_from'],
						'until' => $data['monday_until']
					),
					'tuesday' => array(
						'enable' => isset($data['tuesday_enable']),
						'from' => $data['tuesday_from'],
						'until' => $data['tuesday_until']
					),
					'wednesday' => array(
						'enable' => isset($data['wednesday_enable']),
						'from' => $data['wednesday_from'],
						'until' => $data['wednesday_until']
					),
					'thursday' => array(
						'enable' => isset($data['thursday_enable']),
						'from' => $data['thursday_from'],
						'until' => $data['thursday_until']
					),
					'friday' => array(
						'enable' => isset($data['friday_enable']),
						'from' => $data['friday_from'],
						'until' => $data['friday_until']
					),
					'saturday' => array(
						'enable' => isset($data['saturday_enable']),
						'from' => $data['saturday_from'],
						'until' => $data['saturday_until']
					),
					'sunday' => array(
						'enable' => isset($data['sunday_enable']),
						'from' => $data['sunday_from'],
						'until' => $data['sunday_until']
					)
				)
			);

			$button_path = $this->buttons_dir;
			$json_name = $button_path . DIRECTORY_SEPARATOR . date('Ymd\THisv') . '.json';

			if (file_put_contents($json_name, json_encode($jsonData))) {
				$this->session->set_flashdata('success', 'Button created successfully');
			} else {
				$this->session->set_flashdata('error', 'Error while creating the button');
			}

			// redirect to index
			redirect('buttons');
		}


		$this->load->view('layout', ['content' => $this->load->view('buttons/create', null, true)]);
	}

	public function edit($b64_filename = null)
	{
		$this->load->helper('form');
		$this->load->library('session');

		$button_path = $this->buttons_dir;
		$json_name = $button_path . DIRECTORY_SEPARATOR . base64_decode($b64_filename) . '.json';

		// Carga los datos existentes si el archivo existe
		$existingData = file_exists($json_name) ? json_decode(file_get_contents($json_name), true) : [];

		if ($this->input->method() == 'post') {
			$data = $this->input->post();

			// Reestructura los datos del formulario en la estructura que deseas para tu archivo JSON.
			$jsonData = array(
				'description' => $data['description'],
				'enable' => isset($data['enable']),
				'schedules' => array(
					'monday' => array(
						'enable' => isset($data['monday_enable']),
						'from' => $data['monday_from'],
						'until' => $data['monday_until']
					),
					'tuesday' => array(
						'enable' => isset($data['tuesday_enable']),
						'from' => $data['tuesday_from'],
						'until' => $data['tuesday_until']
					),
					'wednesday' => array(
						'enable' => isset($data['wednesday_enable']),
						'from' => $data['wednesday_from'],
						'until' => $data['wednesday_until']
					),
					'thursday' => array(
						'enable' => isset($data['thursday_enable']),
						'from' => $data['thursday_from'],
						'until' => $data['thursday_until']
					),
					'friday' => array(
						'enable' => isset($data['friday_enable']),
						'from' => $data['friday_from'],
						'until' => $data['friday_until']
					),
					'saturday' => array(
						'enable' => isset($data['saturday_enable']),
						'from' => $data['saturday_from'],
						'until' => $data['saturday_until']
					),
					'sunday' => array(
						'enable' => isset($data['sunday_enable']),
						'from' => $data['sunday_from'],
						'until' => $data['sunday_until']
					)
				)
			);


			if (file_put_contents($json_name, json_encode($jsonData))) {
				$this->session->set_flashdata('success', 'Button edited successfully');
			} else {
				$this->session->set_flashdata('error', 'Error while editing the button');
			}
		}
		$existingData['filename'] = $b64_filename;


		$this->load->view('layout', ['content' => $this->load->view('buttons/edit', $existingData, true)]);
	}

	public function delete($b64_filename = null)
	{
		$button_path = $this->buttons_dir;
		$json_name = $button_path . DIRECTORY_SEPARATOR . base64_decode($b64_filename) . '.json';
		$css_name = $button_path . DIRECTORY_SEPARATOR . base64_decode($b64_filename) . '.css';

		// Comprueba si el archivo existe antes de intentar eliminarlo
		if (file_exists($json_name)) {
			unlink($json_name);
		}

		// Aquí asumo que también quieres eliminar el archivo .css correspondiente
		if (file_exists($css_name)) {
			unlink($css_name);
		}

		// redirigir al index después de eliminar
		redirect('buttons');
	}


	public function deploy($b64_filename)
	{
		$js_url = site_url('buttons/js/' . $b64_filename . '.js');

		$script = <<<SCRIPT
		<script>
		  (function () {
		    let script = document.createElement('script');
		    let id = (Math.random() + 1).toString(36).substring(7);
		    script.src = '{$js_url}?v=' + id;
		    script.async = true;
		    document.body.appendChild(script);
		  })();
		</script>
		SCRIPT;

		$this->load->view('layout', ['content' => $this->load->view('buttons/deploy', [
			'script' => htmlentities($script),
		], true)]);
	}

	public function Js($b64_filename)
	{
		$css_url = site_url('buttons/css/' . $b64_filename . '.css');

		$script = <<<SCRIPT
		(function () {
			let div = document.createElement("div");
			div.setAttribute('id', 'whatsapp-buttons-container');
			div.style.position = 'fixed';
			div.style.bottom = 0;
			div.style.right = 0;
			div.style.zIndex = 999;
			let shadow = div.attachShadow({ mode: "open" });
		
			let link = document.createElement('link');
			link.setAttribute('rel', 'stylesheet');
			let id = (Math.random() + 1).toString(36).substring(7);
			link.setAttribute('href', '{$css_url}?v=' + id);
			shadow.appendChild(link);
		
			let button = document.createElement('div');
			button.classList.add('btn');
			// button.textContent = 'button';
			shadow.appendChild(button);
		
			document.body.prepend(div);
		})();
		SCRIPT;

		return $this->output
			->set_status_header(200)
			->set_content_type('application/javascript')
			->set_output($script);
	}
	public function Css($b64_filename)
	{
		$filename = base64_decode($b64_filename);

		$css_string = file_get_contents($this->buttons_dir . $filename . ".css");

		return $this->output
			->set_status_header(200)
			->set_content_type('text/css')
			->set_output($css_string);
	}
}
