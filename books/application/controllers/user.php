<?php
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}

	// method untuk tambah data user
	public function insert(){

		// baca data dari form insert user
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];
		$idrole = $_POST['idrole'];

		// panggil method insertUser() di model 'user_model' untuk menjalankan query insert
		$this->user_model->insertUser($username, $password, $fullname, $idrole);

		// arahkan ke method 'user' di kontroller user'
		redirect('dashboard/user');
	}

	// method hapus data user
	public function delete($id){
		$this->user_model->delUser($id);
		// arahkan ke method 'users' di kontroller 'dashboard'
		redirect('dashboard/user');
	}

	// method edit data user
	 public function edit($id){

    	$data['roles'] = $this->user_model->getRole();
    	
        $data['view_user'] = $this->user_model->getUserProfile($id);

        $data['fullname'] = $_SESSION['fullname'];

        if (empty($data['view_user'])){
            show_404();
        }

        $data['username'] = $data['view_user']['username'];
        $data['fullname'] = $data['view_user']['fullname'];
        $data['password'] = $data['view_user']['password'];
        $data['idrole'] = $data['view_user']['idrole'];

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/editUser', $data);
        $this->load->view('dashboard/footer');
    }

	// method update data user
	public function update(){
		// baca data dari form update kategori
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];
		$idrole = $_POST['idrole'];

		// panggil method updateBook() di model 'book_model' untuk menjalankan query update
		$this->user_model->updateUser($username, $password, $fullname, $idrole);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/user');
	}
}