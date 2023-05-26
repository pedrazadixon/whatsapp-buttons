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
		], true),]);
	}

	public function create()
	{
		$this->load->view('layout', ['content' => $this->load->view('buttons/create', null, true)]);
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
