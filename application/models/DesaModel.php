<?php

class DesaModel extends CI_Model {

    public function getAllDesa() {
        $this->db->select('id', 'name', 'district_id');
        $query = $this->db->get('villages');
        return $query->result_array();
    }

    public function getDesaById($id) {
        $this->db->select('id', 'name', 'district_id');
        $this->db->where('id', $id);
        $query = $this->db->get('villages');
        return $query->row_array();
    }

    public function createDesa($data) {
        $this->db->insert('villages', $data);
        return $this->db->insert_id();
    }

    public function updateDesa($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('villages', $data);
        return $this->db->affected_rows();
    }

    public function deleteDesa($id) {
        $this->db->where('id', $id);
        $this->db->delete('villages');
        return $this->db->affected_rows();
    }
}
