<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

		public function __construct(){
        parent::__construct();
        $this->load->model('Categories_model');
    }

    public function index($slug){
		$page = $this->Settings_model->getPageBySlug($slug);
		if($page == NULL){
			redirect(base_url() . '404');
		}else{
			$data['title'] = $page['title'] . ' - ' . $this->Settings_model->general()["app_name"];
			$data['css'] = 'page';
			$data['page'] = $page;
			$this->load->view('templates/header', $data);
			$this->load->view('templates/navbar');
			$this->load->view('page/page', $page);
			$this->load->view('templates/footer');
		}
	}
	
	public function package($slug){
		$package = $this->db->get_where('package', ['slug' => $slug])->row_array();
		$data['title'] = $package['title'] . ' - ' . $this->Settings_model->general()['app_name'];
		$data['css'] = 'promo';
		$this->db->join("products", "package_product.product=products.id");
		$this->db->where('package_product.package', $package['id']);
		$data['packdata'] = $this->db->get('package_product');
		$data['package'] = $package;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('page/package', $data);
		$this->load->view('templates/footerv2');
	}

	public function search(){
		$q = $_GET['q'];
		$ob = $_GET['ob'];
		$maxprice = $_GET['maxprice'];
		$minprice = $_GET['minprice'];
		$promo = $_GET['promo'];
		$condition = $_GET['condition'];
		if($ob != NULL){
			if($ob == "latest"){
				$data['titleHead'] = '|| Urutkan > Terbaru';
				$data['products'] = $this->Products_model->searchProducts($q,"");
			}else if($ob == "az"){
				$data['titleHead'] = '|| Urutkan > Abjad A-Z';
				$data['products'] = $this->Products_model->searchProducts($q,"az");
			}else if($ob == "za"){
				$data['titleHead'] = '|| Urutkan > Abjad Z-A';
				$data['products'] = $this->Products_model->searchProducts($q,"za");
			}else if($ob == "pmin"){
				$data['titleHead'] = '|| Urutkan > Harga Terendah';
				$data['products'] = $this->Products_model->searchProducts($q,"pricemax");
			}else if($ob == "pmax"){
				$data['titleHead'] = '|| Urutkan > Harga Tertinggi';
				$data['products'] = $this->Products_model->searchProducts($q,"pricemin");
			}
		}else if($minprice != NULL || $maxprice != NULL){
			if($minprice == ""){
				$minprice = "0";
				$data['titleHead'] = '|| Harga > ' . $minprice . ' - ' . $maxprice;
			}else if($maxprice == ""){
				$maxprice = "0";
				$data['titleHead'] = '|| Harga > ' . $minprice . " -->";
			}else if($maxprice < $minprice){
				$maxprice = "0";
				$data['titleHead'] = '|| Harga > ' . $minprice . " -->";
			}else{
                $data['titleHead'] = '|| Harga > ' . $minprice . ' - ' . $maxprice;
            }
			$data['products'] = $this->Products_model->searchProductsPrice($q, $minprice, $maxprice);
		}else if($promo != NULL && $promo == "true"){
			$data['titleHead'] = '|| Penawaran > Promo';
			$data['products'] = $this->Products_model->searchProducts($q,"promo");
		}else if($condition != NULL){
			if($condition == "1"){
				$data['titleHead'] = '|| Kondisi > Baru';
				$data['products'] = $this->Products_model->searchProducts($q,"1");
			}else if($condition == "2"){
				$data['titleHead'] = '|| Kondisi > Bekas';
				$data['products'] = $this->Products_model->searchProducts($q,"2");
			}
		}else{
			$data['titleHead'] = '';
			$data['products'] = $this->Products_model->searchProducts($q,"");
		}
		$data['title'] = 'Hasil pencarian : ' . $q;
		$data['css'] = 'products';
		$data['responsive'] = 'product-responsive';
		$data['q'] = $q;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('page/search', $data);
		$this->load->view('templates/footerv2');
	}

	public function news(){
		$data['title'] = 'Berita - ' . $this->Settings_model->general()['app_name'];
		$data['css'] = 'news';
		$data['news'] = $this->db->get('banner');
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('page/news', $data);
		$this->load->view('templates/footerv2');
	}


}
