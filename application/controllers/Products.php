<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Categories_model');
		$this->load->model('Products_model');
	}

	public function index(){
		$ob = $_GET['ob'];
		$maxprice = $_GET['maxprice'];
		$minprice = $_GET['minprice'];
		$promo = $_GET['promo'];
		$condition = $_GET['condition'];
		if($ob != NULL){
			if($ob == "latest"){
				$data['titleHead'] = 'Urutkan > Terbaru';
				$data['products'] = $this->Products_model->getAllProducts("");
			}else if($ob == "az"){
				$data['titleHead'] = 'Urutkan > Abjad A-Z';
				$data['products'] = $this->Products_model->getAllProducts("az");
			}else if($ob == "za"){
				$data['titleHead'] = 'Urutkan > Abjad Z-A';
				$data['products'] = $this->Products_model->getAllProducts("za");
			}else if($ob == "pmin"){
				$data['titleHead'] = 'Urutkan > Harga Terendah';
				$data['products'] = $this->Products_model->getAllProducts("pricemax");
			}else if($ob == "pmax"){
				$data['titleHead'] = 'Urutkan > Harga Tertinggi';
				$data['products'] = $this->Products_model->getAllProducts("pricemin");
			}
		}else if($minprice != NULL || $maxprice != NULL){
			if($minprice == ""){
				$minprice = "0";
				$data['titleHead'] = 'Harga > ' . $minprice . ' - ' . $maxprice;
			}else if($maxprice == ""){
				$maxprice = "0";
				$data['titleHead'] = 'Harga > ' . $minprice . " -->";
			}else if($maxprice < $minprice){
				$maxprice = "0";
				$data['titleHead'] = 'Harga > ' . $minprice . " -->";
			}else{
                $data['titleHead'] = 'Harga > ' . $minprice . ' - ' . $maxprice;
            }
			$data['products'] = $this->Products_model->getAllProductsPrice($minprice, $maxprice);
		}else if($promo != NULL && $promo == "true"){
			$data['titleHead'] = 'Penawaran > Promo';
			$data['products'] = $this->Products_model->getAllProducts("promo");
		}else if($condition != NULL){
			if($condition == "1"){
				$data['titleHead'] = 'Kondisi > Baru';
				$data['products'] = $this->Products_model->getAllProducts("1");
			}else if($condition == "2"){
				$data['titleHead'] = 'Kondisi > Bekas';
				$data['products'] = $this->Products_model->getAllProducts("2");
			}
		}else{
			$data['titleHead'] = '';
			$data['products'] = $this->Products_model->getAllProducts("");
		}
		$data['title'] = 'Semua Produk - ' . $this->Settings_model->general()["app_name"];
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('page/products', $data);
		$this->load->view('templates/footer');
	}

	public function detail_product($slug){
		$getProduct = $this->Products_model->getProductBySlug($slug);
		if($getProduct == NULL){
			redirect(base_url() . '404');
		}else{
			$this->Products_model->updateViewer($slug);
			$data['title'] = $getProduct['title'] . ' - ' . $this->Settings_model->general()["app_name"];
			$data['css'] = 'detail';
			$data['responsive'] = '';
			$data['product'] = $getProduct;
			$data['img'] = $this->Products_model->getImgProductBySlug($slug);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('page/detail', $data);
			$this->load->view('templates/footerv2');
		}
	}

}
