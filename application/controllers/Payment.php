<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Categories_model');
        $this->load->model('Payment_model');
        $this->load->model('Settings_model');
        $this->load->library('cart');
    }

    public function index(){
        $data['title'] = 'Pembayaran - ' . $this->Settings_model->general()["app_name"];
        $data['css'] = 'payment';
        $data['setting'] = $this->Settings_model->getSetting();
        $data['provinces'] = $this->Payment_model->getProvinces();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('page/payment', $data);
        $this->load->view('templates/footer');
    }

    public function getLocation(){
        $id = $this->input->post('id');
        $getLocation = $this->Payment_model->getCity($id);
        $list = "<option></option>";
        foreach($getLocation as $d){
            $list .= "<option value='".$d['city_id']."'>".$d['type'].' '.$d['city_name']."";
        }
        echo json_encode($list);
    }

    public function getService(){
        $jne = $this->Payment_model->getService("jne");
        $pos = $this->Payment_model->getService("pos");
        $tiki = $this->Payment_model->getService("tiki");
        $sicepat = $this->Payment_model->getService("sicepat");
        $jnt = $this->Payment_model->getService("jnt");
        $sap = $this->Payment_model->getService("sap");
        $ninja = $this->Payment_model->getService("ninja");
        $lion = $this->Payment_model->getService("lion");
        $anteraja = $this->Payment_model->getService("anteraja");
        /* JIKA DIAKTIFKAN MAKA WAKTU LOAD LAYANAN SAAT CHECKOUT LEBIH LAMA
        $rpx = $this->Payment_model->getService("rpx");
        $pandu = $this->Payment_model->getService("pandu");
        $wahana = $this->Payment_model->getService("wahana");
        $pahala = $this->Payment_model->getService("pahala");
        $jet = $this->Payment_model->getService("jet");
        $dse = $this->Payment_model->getService("dse");
        $slis = $this->Payment_model->getService("slis");
        $first = $this->Payment_model->getService("first");
        $ncs = $this->Payment_model->getService("ncs");
        $star = $this->Payment_model->getService("star");
        $idl = $this->Payment_model->getService("idl");
        $rex = $this->Payment_model->getService("rex");
        $ide = $this->Payment_model->getService("ide");
        $sentral = $this->Payment_model->getService("sentral");
        */
        $destination = $this->input->post('destination');
        $db = $this->db->get_where('cost_delivery', ['destination' => $destination])->row_array();
        $cod = $this->db->get_where('cod', ['regency_id' => $destination])->row_array();
        $list = "<option></option>";
        $cost = "";
        if($db){
            $list .= '<option value="'.$db['price'].'-antar-antar">Diantar oleh Penjual</option>';
        }
        if($cod){
            $list .= '<option value="0-cod-cod">COD (Cash of Delivery)</option>';
        }
        if(count($jne) > 0){
            foreach($jne as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-jne">'."JNE"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($pos) > 0){
            foreach($pos as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-pos">'."POS"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($tiki) > 0){
            foreach($tiki as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-tiki">'."TIKI"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($sicepat) > 0){
            foreach($sicepat as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-sicepat">'."SICEPAT"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($jnt) > 0){
            foreach($jnt as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-jnt">'."JNT"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($sap) > 0){
            foreach($sap as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-sap">'."SAP"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($ninja) > 0){
            foreach($ninja as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-ninja">'."NINJA"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($lion) > 0){
            foreach($lion as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-lion">'."LION"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($anteraja) > 0){
            foreach($anteraja as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-anteraja">'."ANTERAJA"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        /* JIKA DIAKTIFKAN MAKA WAKTU LOAD LAYANAN SAAT CHECKOUT LEBIH LAMA
        if(count($rpx) > 0){
            foreach($rpx as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-rpx">'."RPX"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($pandu) > 0){
            foreach($pandu as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-pandu">'."PANDU"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($wahana) > 0){
            foreach($wahana as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-wahana">'."WAHANA"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($pahala) > 0){
            foreach($pahala as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-pahala">'."PAHALA"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($jet) > 0){
            foreach($jet as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-jet">'."JET"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($dse) > 0){
            foreach($dse as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-dse">'."DSE"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($slis) > 0){
            foreach($slis as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-slis">'."SLIS"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($first) > 0){
            foreach($first as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-first">'."FIRST"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($ncs) > 0){
            foreach($ncs as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-ncs">'."NCS"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($star) > 0){
            foreach($star as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-star">'."STAR"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($idl) > 0){
            foreach($idl as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-idl">'."IDL"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($rex) > 0){
            foreach($rex as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-rex">'."REX"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($ide) > 0){
            foreach($ide as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-ide">'."IDE"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($sentral) > 0){
            foreach($sentral as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-sentral">'."SENTRAL"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        */
        echo json_encode($list);
    }

    public function getLocationOngkir(){
        $id = $this->input->post('id');
        $db = $this->db->get_where('cost_delivery', ['destination' => $id])->row_array();
        $list = 0;
        if($db){
            $list += $db['price'];
        }else{
            $get = $this->db->get('settings')->row_array();
            $list += $get['default_ongkir'];
        }
        echo json_encode($list);
    }

    public function succesfully(){
        if($this->cart->total() == ""){
            redirect(base_url());
        }
        $data = $this->Payment_model->succesfully();
        $nowa = $this->Settings_model->general()["whatsappv2"]; 
        $namatoko = $this->Settings_model->general()["app_name"]; 
        $list = '';
        $nom = 1;
        foreach($this->cart->contents() as $c){
            $list .= '*' . $nom . '. ' . $c['name'] . '*%0A';
            $list .= 'Jumlah: ' . $c['qty'] . '%0A';
            $list .= 'Harga (@): Rp' . number_format($c['price'],0,",",".") . '%0A';
            $list .= 'Harga Total: Rp' . number_format($c['subtotal'],0,",",".") . '%0A';
            if($c['ket'] == ""){
                $list .= 'Keterangan: -'. '%0A%0A';
            }else{
                $list .= 'Keterangan: ' . $c['ket'] . '%0A%0A';
            }
            $nom++;
        }
        $list .= 'Subtotal: *Rp' . number_format($this->cart->total(),0,",",".") . '*%0A';
        if($this->db->get("settings")->row_array()['ongkir'] != 0){
            if($data['courier'] == "antar"){
                $ongkirnya = "Diantar Penjual";
            }else if($data['courier'] == "cod"){
                $ongkirnya = "COD";
            }else{
                $ongkirnya = strtoupper($data['courier']) . ' ' . strtoupper($data['courier_service']);
            }
            $list .= 'Ongkir (' . $ongkirnya . '): *Rp' . number_format($data['ongkir'],0,",",".") . '*%0A';
        }else{
            $list .= 'Ongkir: *Rp' . number_format($data['ongkir'],0,",",".") . '*%0A';
        }
        $totalall = intval($this->cart->total()) + intval($data['ongkir']);
        $list .= 'Total: *Rp' . number_format($totalall,0,",",".") . '*%0A';
        $list .= '-----------------------%0A';
        $list .= '*Nama:*%0A';
        $list .= $data['name'] . ' (' . $data['telp'] . ')%0A%0A';
        $list .= '*Alamat:*%0A';
        $list .= $data['address'] . '%0A%0A';
        $this->cart->destroy();
        redirect("https://wa.me/".$nowa."?text=Halo ".$namatoko."! Saya mau order : %0A%0A " . $list);
    }

}
