<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uitoolkit extends CI_Controller
{
	private $buttons_dir = APPPATH . 'buttons' . DIRECTORY_SEPARATOR;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{

		$this->load->library('session');

		$json_files = glob($this->buttons_dir  .  "*.json");

		$files = [];
		foreach ($json_files as $json_file) {
			$info = pathinfo($json_file);
			$info['path'] = $json_file;
			$info['b64_filename'] = base64_encode($info["filename"]);
			$info['content'] = json_decode(file_get_contents($json_file), true);

			$files[] = $info;
		}

		$this->load->view('layout', ['content' => $this->load->view('uitoolkit/index', [
			'files' => $files,
			'data' => ['active_page' => 'uitoolkit']
		], true),]);
	}


	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		if ($this->input->method() == 'post') {
			$data = $this->input->post();

			// Set validation rules
			$this->form_validation->set_rules('description', 'Descripción', 'required');

			// Mapeo de los nombres de los días en inglés a español
			$day_names = [
				'monday' => 'Lunes',
				'tuesday' => 'Martes',
				'wednesday' => 'Miércoles',
				'thursday' => 'Jueves',
				'friday' => 'Viernes',
				'saturday' => 'Sábado',
				'sunday' => 'Domingo'
			];

			// Dynamic day time validation
			foreach ($day_names as $day_in_english => $day_in_spanish) {
				if (isset($data[$day_in_english . '_enable']) && $data[$day_in_english . '_enable'] == 'on') {
					$this->form_validation->set_rules($day_in_english . '_from', 'Hora de inicio del ' . $day_in_spanish, 'required');
					$this->form_validation->set_rules($day_in_english . '_until', 'Hora de finalización del ' . $day_in_spanish, 'required');
				}
			}

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('layout', ['content' => $this->load->view('uitoolkit/create', ['data' => ['active_page' => 'uitoolkit']], true)]);
			} else {
				// Validation passed

				$jsonData = array(
					'description' => $data['description'],
					'enable' => isset($data['enable']),
					'schedules' => array(),
					'html_code' => htmlspecialchars(trim($data['html_code'])),
				);

				foreach ($day_names as $day_in_english => $day_in_spanish) {
					$jsonData['schedules'][$day_in_english] = array(
						'enable' => isset($data[$day_in_english . '_enable']),
						'from' => isset($data[$day_in_english . '_from']) ? $data[$day_in_english . '_from'] : null,
						'until' => isset($data[$day_in_english . '_until']) ? $data[$day_in_english . '_until'] : null,
					);
				}

				// Guardar el JSON
				$button_path = $this->buttons_dir;
				$json_name = $button_path . DIRECTORY_SEPARATOR . date('Ymd\THisv') . '.json';

				if (file_put_contents($json_name, json_encode($jsonData))) {
					$this->session->set_flashdata('success', 'Ui toolkit creado correctamente');
					redirect('uitoolkit');
				} else {
					$this->session->set_flashdata('error', 'No se pudo crear el botón');
					$this->load->view('layout', ['content' => $this->load->view('uitoolkit/create', ['data' => ['active_page' => 'uitoolkit']], true)]);
				}
			}
		} else {
			// Not a POST request
			$this->load->view('layout', ['content' => $this->load->view('uitoolkit/create', ['data' => ['active_page' => 'uitoolkit']], true)]);
		}
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
				'html_code' => htmlspecialchars(trim($data['html_code'])),
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
				$this->session->set_flashdata('success', 'UI Toolkit editado correctamente');
			} else {
				$this->session->set_flashdata('error', 'No se pudo editar el UI Toolkit');
			}

			// redirect to index
			redirect('uitoolkit');
		}

		$existingData['filename'] = $b64_filename;

		$this->load->view('layout', ['content' => $this->load->view('uitoolkit/edit', ['json' => $existingData, 'data' => ['active_page' => 'uitoolkit']], true)]);
	}

	public function delete($b64_filename = null)
	{
		$button_path = $this->buttons_dir;
		$json_name = $button_path . DIRECTORY_SEPARATOR . base64_decode($b64_filename) . '.json';

		// Comprueba si el archivo existe antes de intentar eliminarlo
		if (file_exists($json_name)) {
			unlink($json_name);
		}

		// redirigir al index después de eliminar
		redirect('uitoolkit');
	}


	public function deploy($b64_filename)
	{
		$js_url = site_url('uitoolkit/js/' . $b64_filename . '.js');

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

		$this->load->view('layout', ['content' => $this->load->view('uitoolkit/deploy', [
			'script' => htmlentities($script),
			'data' => ['active_page' => 'uitoolkit']
		], true)]);
	}

	public function Js($b64_filename)
	{
		$data = json_decode(file_get_contents($this->buttons_dir . DIRECTORY_SEPARATOR . base64_decode($b64_filename) . '.json'), true);

		// Obtén la fecha y hora actuales
		$now = new DateTime();
		$dayOfWeek = strtolower($now->format('l')); // Devuelve "monday", "tuesday", etc.
		$currentTime = $now->format('H:i');

		// Verifica si el botón debe estar activado
		$isActive = $data['enable'] &&
			$data['schedules'][$dayOfWeek]['enable'] &&
			($data['schedules'][$dayOfWeek]['from'] <= $currentTime || $data['schedules'][$dayOfWeek]['from'] === '') &&
			($currentTime <= $data['schedules'][$dayOfWeek]['until'] || $data['schedules'][$dayOfWeek]['until'] === '');

		// Si el botón no está activo, devuelve un script vacío
		if (!$isActive) {
			return $this->output
				->set_status_header(200)
				->set_content_type('application/javascript')
				->set_output('');
		}

		$html = htmlspecialchars_decode($data['html_code']);


		$script = <<<SCRIPT
        (function () {
            let div = document.createElement("div");
            div.innerHTML = `$html`;
            document.body.prepend(div);
        })();
    SCRIPT;

		return $this->output
			->set_status_header(200)
			->set_content_type('application/javascript')
			->set_output($script);
	}
}