<?php
class book_operator extends CI_Controller {

	public function __construct(){
		parent::__construct();

		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}

	        public function view($id)
        {
                $data['view_book'] = $this->book_model->showBook($id);

                $data['fullname'] = $_SESSION['fullname'];

                if (empty($data['view_book'])){
                show_404();
                }

                $data['idbuku'] = $data['view_book']['idbuku'];
                $data['judul'] = $data['view_book']['judul'];
                $data['pengarang'] = $data['view_book']['pengarang'];
                $data['penerbit'] = $data['view_book']['penerbit'];
                $data['idkategori'] = $data['view_book']['idkategori'];
                $data['img'] = $data['view_book']['imgfile'];
                $data['sinopsis'] = $data['view_book']['sinopsis'];
                $data['thnterbit'] = $data['view_book']['thnterbit'];

                $this->load->view('dashboard/header_operator', $data);
                $this->load->view('dashboard/view', $data);
                $this->load->view('dashboard/footer');
        }

	// method untuk mencari data buku berdasarkan 'key'
	public function findbooks(){
		
		// baca key dari form cari data
		$key = $_POST['key'];

		// ambil session fullname untuk ditampilkan ke header
		$data['fullname'] = $_SESSION['fullname'];

		// panggil method findBook() dari model book_model untuk menjalankan query cari data
		$data['book'] = $this->book_model->findBook($key);

		// tampilkan hasil pencarian di view 'dashboard/books'
		$this->load->view('dashboard/header_operator', $data);
        $this->load->view('dashboard/books_operator', $data);
        $this->load->view('dashboard/footer');
	}

}
?>