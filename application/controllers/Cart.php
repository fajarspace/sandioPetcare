<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Categories_model');
        $this->load->model('Products_model');
        $this->load->library('cart');
    }

    public function index(){
        $data['title'] = 'Keranjang - ' . $this->Settings_model->general()["app_name"];
        $data['css'] = 'cart';
        $data['responsive'] = '';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('page/cart');
        $this->load->view('templates/footerv2');
    }

    public function add_to_cart(){
        $id = $this->input->post('id');
        $setting = $this->db->get('settings')->row_array();
        $result = $this->db->get_where('products', ['id' => $id])->row_array();
        if($setting['promo'] == 1){
            if($result['promo_price'] == 0){
                $price = $result['price'];
            }else{
                $price = $result['promo_price'];
            }
        }else{
            $price = $result['price'];
        }
        $data = array(
            'id' => $id,
            'name' => $result['title'],
            'price' => $price,
            'qty' => $this->input->post('qty'),
            'img' => $result['img'],
            'slug' => $result['slug'],
            'weight' => $result['weight'],
            'ket' => ''
        );
        $this->cart->insert($data);
    }

    public function get_item(){
        $rowid = $this->input->post('rowid');
        echo json_encode($this->cart->get_item($rowid));
    }

    public function add_ket(){
        $rowid = $this->input->post('rowid');
        $ket = $this->input->post('ket');
        $data = [
            'rowid' => $rowid,
            'ket' => $ket,
        ];
        $this->cart->update($data);
    }

    public function delete($id){
        $data = [
            'rowid' => $id,
            'qty' => 0
        ];
        $this->cart->update($data);
        redirect(base_url() . 'cart');
    }

    public function delete_cart(){
        $this->cart->destroy();
        redirect(base_url() . 'cart');
    }

}
