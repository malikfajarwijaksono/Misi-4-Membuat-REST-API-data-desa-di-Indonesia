<?php

class DesaController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('DesaModel');
        $this->load->library('Indonesia');
    }

    public function index() {
        $data['desa'] = $this->DesaModel->getAllDesa();
        $this->load->view('desa_list', $data);
    }

    public function show($id) {
        $desa = $this->DesaModel->getDesaById($id);
        if (!$desa) {
            show_404();
            return;
        }

        $data['desa'] = $desa;
        $this->load->view('desa_detail', $data);
    }

    public function create() {
        $this->form_validation->set_rules('name', 'Nama Desa', 'required');
        $this->form_validation->set_rules('district_id', 'ID Kecamatan', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('desa_create');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'district_id' => $this->input->post('district_id'),
            ];

            $id = $this->DesaModel->createDesa($data);
            redirect('/api/desa/' . $id);
        }
    }

    public function update($id) {
        $desa = $this->DesaModel->getDesaById($id);
        if (!$desa) {
            show_404();
            return;
        }

        $this->form_validation->set_rules('name', 'Nama Desa', 'required');
        $this->form_validation->set_rules('district_id', 'ID Kecamatan', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $data['desa'] = $desa;
            $this->load->view('desa_update', $data);
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'district_id' => $this->input->post('district_id'),
            ];

            $this->DesaModel->updateDesa($id, $data);
            redirect('/api/desa/' . $id);
        }
    }

    public function delete($id) {
        $this->DesaModel->deleteDesa($id);
        redirect('/api/desa');
    }
}