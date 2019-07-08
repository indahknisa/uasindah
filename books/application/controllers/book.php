<?php
class Book extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
	}




	// method untuk tambah data buku
	public function insert(){

		// target direktori fileupload
		$target_dir = "c:/xampp/htdocs/books/assets/images/";
		
		// baca nama file upload
		$filename = $_FILES["imgcover"]["name"];

		// menggabungkan target dir dengan nama file
		$target_file = $target_dir . basename($filename);

		// proses upload
		move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file);

		// baca data dari form insert buku
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->book_model->insertBook($judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

	//method untuk view data buku
	public function view($id){
	$data['view_book'] = $this->book_model->showBook($id);


		//ambil session fullname untuk ditampilkan ke header
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

        // tampilkan hasil pencarian di view 'dashboard/edit'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/view', $data);
        $this->load->view('dashboard/footer');
    }
	// method untuk edit data buku berdasarkan id
	public function edit($id){
		//meminta data buku
		$data['view_book'] = $this->book_model->showBook($id);

		//meminta kategori
		$data['kategori'] = $this->book_model->getKategori();

		//ambil session fullname untuk ditampilkan ke header
		$data['fullname'] = $_SESSION['fullname'];

		if (empty($data['view_book'])){
			show_404();
                }
                $data['idbuku'] = $data['view_book']['idbuku'];
                $data['judul'] = $data['view_book']['judul'];
                $data['pengarang'] = $data['view_book']['pengarang'];
                $data['penerbit'] = $data['view_book']['penerbit'];
                $data['idkategori'] = $data['view_book']['idkategori'];
                $data['imgfile'] = $data['view_book']['imgfile'];
                $data['sinopsis'] = $data['view_book']['sinopsis'];
                $data['thnterbit'] = $data['view_book']['thnterbit'];

        // tampilkan hasil pencarian di view 'dashboard/edit'
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/edit', $data);
        $this->load->view('dashboard/footer');
}
	// method untuk update data buku berdasarkan id
	public function update(){

		// target direktori fileupload
		$target_dir = "c:/xampp/htdocs/books/assets/images/";
		
		// baca nama file upload
		$filename = $_FILES["imgcover"]["name"];

		// menggabungkan target dir dengan nama file
		$target_file = $target_dir . basename($filename);

		// proses upload
		move_uploaded_file($_FILES["imgcover"]["tmp_name"], $target_file);

		// baca data dari form update buku
		$idbuku = $_POST['idbuku'];
		$judul = $_POST['judul'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$sinopsis = $_POST['sinopsis'];
		$thnterbit = $_POST['thnterbit'];
		$idkategori = $_POST['idkategori'];

		// panggil method updateBook() di model 'book_model' untuk menjalankan query update
		$this->book_model->updateBook($idbuku, $judul, $pengarang, $penerbit, $thnterbit, $sinopsis, $idkategori, $filename);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
	}

		// method hapus data buku berdasarkan id
	public function delete($id){
		$this->book_model->delBook($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('dashboard/books');
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
		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/books', $data);
        $this->load->view('dashboard/footer');
	}


	//KATEGORI
	//method untuk tambah kategori
	public function insertKategori(){
		//baca data dari form inset kategori
		$kategoriBaru = $_POST['kategori'];

		//panggil method inserKategori() di model 'book_model' untuk menjalankan query insert
		$this->book_model->insertKategori($kategoriBaru);

		//arahkan ke method 'kategori' dikontroler 'dashboard'
		redirect('dashboard/kategori');
	}

	//method edit data kategori
	public function editKategori($id){
		//meminta kategori
		$data['view_kategori'] = $this->book_model->getKategori($id);

		//ambil session fullname untuk ditampilkan ke header
		$data['fullname'] = $_SESSION['fullname'];

		if (empty($data['view_kategori'])){
			show_404();
                }
                $data['idkategori'] = $data['view_kategori']['idkategori'];
                $data['kategori'] = $data['view_kategori']['kategori'];

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/editkategori', $data);
        $this->load->view('dashboard/footer');
	}

	// mtehod update kategori
	public function updateKategori(){
		//baca data dari form inset kategori
		$idkategori = $_POST['idkategori'];
		$kategoriBaru = $_POST['kategori'];

		//panggil method updateKategori() di model 'book_model' untuk menjalankan query update
		$this->book_model->updateKategori($idkategori, $kategoriBaru);

		//arahkan ke method 'kategori' dikontroler 'dashboard'
		redirect('dashboard/kategori');
	}

	// method hapus data kategori berdasarkan id
	public function deleteKategori($idkategori){
		$this->book_model->delKategori($idkategori);
		// arahkan ke method 'kategori' di kontroller 'dashboard'
		redirect('dashboard/kategori');
	}

}
?>