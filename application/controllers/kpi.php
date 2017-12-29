<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kpi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("model");
	}

	public function index()
	{
		$kilosEmbalados =$this->model->kilosEmbalados();
		$kilosCerrados =$this->model->KilosEstimadosCerrados();
		$meta = $this->model->meta();
		$data['kilosPorOrdenCerradas'] =$this->model->unionEmbaldosCerrados($kilosEmbalados,$kilosCerrados);
		$data['kilosPorOrdenAbiertas'] =$this->model->KilosEstimadosAbiertos();
		$data['totalElegidos'] =$this->model->totalElegidos();
		$data['meta'] = $meta;
		$this->load->view('index',$data);
	}

	public function estimadosCerrados(){
		$kilosEstimados =$this->model->KilosEstimadosCerrados();
		echo json_encode($kilosEstimados);
	}

	public function estimadosAbiertos(){
		$kilosEstimados =$this->model->KilosEstimadosAbiertos();
	}

	public function CajasPorVariedad(){
		$result =  $this->model->CajasPorVariedad();
		echo json_encode($result);
		// var_dump($result);
	}

	public function unionEmbaldosCerrados(){
		$kilosEmbalados =$this->model->kilosEmbalados();
		$kilosCerrados =$this->model->KilosEstimadosCerrados();

		$result = $this->model->unionEmbaldosCerrados($kilosEmbalados,$kilosCerrados);
		echo json_encode($result);
	}

	public function embalada(){
		$result = $this->model->kilosEmbalados();
		echo json_encode($result);
	}
}
