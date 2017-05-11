<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller { //class Login mengextend CI controler
  function __construct() //fungsi konstruktor
  {
    parent::__construct();
    $this->load->library('fpdf');
		$this->load->library('Bcrypt');//memasukan library Bcrypt
		$this->load->model('Cetak_model'); //memanggil model Cetak_model
		$this->load->model('Login_model'); //memanggil model Login_model
  }

	public function index() method index untuk mensetting user untuk login duludan kemudian diarlihakan ke home
	{
		$data['main_view']     = 'login/home';
		$this->load->view('sekolah', $data);
	}

	public function proses_login() //disini terdapat controler login 
	$this->form_validation->set_rules('user_name', 'user_name', 'required');//validasi username yang dibutuhkan
	$this->form_validation->set_rules('password', 'password', 'required');//validasi pasword yang dibutuhkan
	$user_name = $this->input->post('user_name');
    	$password = $this->input->post('password');
    	$where = array(
    			'user_name' => $user_name,
            		'status' => 1
			);
    $data_user = $this->Login_model->get_login($where);// menggambil $data_user, cek ke db 
    $p = $this->bcrypt->hash_password($password);    
		if ($this->form_validation->run() == FALSE)
      {
        echo '[
					{
						"errors":"form_kosong",
						"user_name":"'.$this->input->post('user_name').'",
						"password":"'.$this->input->post('password').'"
					}
					]';
      }
		else
      {
        if(!$data_user) 
          {
						echo '[
						{
							"errors":"user_tidak_ada",
							"user_name":"'.$this->input->post('user_name').'",
							"password":"'.$this->input->post('password').'"
						}
						]';
          }
        else
          {
						if ($this->bcrypt->check_password($password, $data_user['password']))
							{
								$this->session->set_userdata( array(
								'user_id' => $data_user['user_id']
								));
								$data_update = array(
									'last_login' => date('Y-m-d H:i:s')
								);
								$where = array(
								'user_id' => $data_user['user_id']
								);      
								$this->Login_model->update_last_login($data_update, $where);
								echo '[{"errors":"valid"}]';
							}
						else
							{
								echo '[{"errors":"miss_match"}]';
							}  
          }
      }
	}	
    
  public function logout(){ //method logout untuk menghancurkan sesion dan redirect ke base_url();
		$this->session->sess_destroy();
		return redirect(''.base_url().''); 
	}
  
}
