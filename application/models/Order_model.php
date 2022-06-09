<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    public function getOrders($number,$offset){
        $this->db->order_by('id', 'desc');
        return $this->db->get('invoice',$number,$offset);
    }

    public function getOrderByInvoice($id){
        return $this->db->get_where('transaction', ['id_invoice' => $id]);
    }

    public function getDataInvoice($id){
        return $this->db->get_where('invoice', ['invoice_code' => $id])->row_array();
    }

}