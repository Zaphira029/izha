<?php
session_start();
$conn = mysqli_connect("localhost","root","","stock_barang");


//tambah barang
if(isset($_POST['addnewbarang'])){
	$namabarang = $_POST['namabarang'];
	$deskripsi = $_POST['deskripsi'];
	$stock = $_POST['stock'];

	$addtotable = mysqli_query($conn, "insert into stock (namabarang, deskripsi, stock) values('$namabarang','$deskripsi','$stock')");

	if($addtotable){
		header('location:index.php');
	}else {
		echo 'Gagal';
		header('location:index.php');
	}
};



//tambah barang masuk
if(isset($_POST['barangmasuk'])){
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock where idbarang='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);

	$stocksekarang = $ambildatanya['stock'];
	$tambahstocksekarangdenganquentity = $stocksekarang+$qty;

	$addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values('$barangnya','$penerima','$qty')");
	$updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahstocksekarangdenganquentity' where idbarang='$barangnya'");
	if($addtomasuk&&$updatestockmasuk){
		header('location:masuk.php');
	}else {
		echo 'Gagal';
		header('location:masuk.php');
	}
}




//tambah barang keluar
if(isset($_POST['addbarangkeluar'])){
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock where idbarang='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);

	$stocksekarang = $ambildatanya['stock'];

	if($stocksekarang >= $qty){
		//jika barang cukup
		$tambahstocksekarangdenganquentity = $stocksekarang-$qty;

		$addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values('$barangnya','$penerima','$qty')");
		$updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahstocksekarangdenganquentity' where idbarang='$barangnya'");
		if($addtokeluar&&$updatestockmasuk){
			header('location:keluar.php');
		}else {
			echo 'Gagal';
			header('location:keluar.php');
		}
	}else {
		//jika barang tidak cukup
		echo '
		<script>
			alert("Stock Saat Ini Tidak Mencukupi");
			window.location.href="keluar.php";
		</script>
		';
	}

}


	
//update info barang
if(isset($_POST['updatebarang'])){
	$idb = $_POST['idb'];
	$namabarang = $_POST['namabarang'];
	$deskripsi = $_POST['deskripsi'];

	$update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang = '$idb'");
	if($update){
		header('location:index.php');
	}else {
		echo 'Gagal';
		header('location:index.php');
	}
}



//hapus barang
if(isset($_POST['hapusbarang'])){
	$idb = $_POST['idb'];

	$hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
	if($hapus){
		header('location:index.php');
	}else {
		echo 'Gagal';
		header('location:index.php');
	}
};


//ubah data barang masuk
if(isset($_POST['updatebarangmasuk'])){
	$idb = $_POST['idb'];
	$idm = $_POST['idm'];
	$deskripsi = $_POST['keterangan'];
	$qty = $_POST['qty'];

	$lihatstock = mysqli_query($conn, "select * from stock where idbarang = '$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['stock'];

	$qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
	$qtynya = mysqli_fetch_array($qtyskrg);
	$qtyskrg = $qtynya['qty'];

	if($qty>$qtyskrg){
		$selisih = $qty - $qtyskrg;
		$kurangin = $stockskrg + $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan ='$deskripsi' where idmasuk='$idm'");
			if($kurangistocknya&&$updatenya){
				header('location:masuk.php');
				}else {
					echo 'Gagal';
					header('location:masuk.php');
			}
	} else {
		$selisih = $qtyskrg-$qty;
		$kurangin = $stockskrg - $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");	
			if($kurangistocknya&&$updatenya){
				header('location:masuk.php');
				} else {
					echo 'Gagal';
					header('location:masuk.php');
			}
	}
}




//hapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
	$idb = $_POST['idb'];
	$qty = $_POST['kty'];
	$idm = $_POST['idm'];

	$getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$data = mysqli_fetch_array($getdatastock);
	$stok = $data['stock'];

	$selisih = $stok-$qty;

	$update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
	$hapusdata = mysqli_query($conn,"delete from masuk where idmasuk='$idm'");

	if($update&&$hapusdata){
		header('location:masuk.php');
	}else{
		header('location:masuk.php');
		} 
}


//ubah data barang keluar
if(isset($_POST['updatebarangkeluar'])){
	$idb = $_POST['idb'];
	$idk = $_POST['idk'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty']; //Qty baru inputan user

	//mengambil stock barang saat ini
	$lihatstock = mysqli_query($conn, "select * from stock where idbarang = '$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['stock'];

	//qty barang keluar saat ini
	$qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
	$qtynya = mysqli_fetch_array($qtyskrg);
	$qtyskrg = $qtynya['qty'];

	if($qty>$qtyskrg){
		$selisih = $qty - $qtyskrg;
		$kurangin = $stockskrg - $selisih;

		if($selisih <= $stockskrg){
			$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
			$updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima ='$penerima' where idkeluar='$idk'");
				if($kurangistocknya&&$updatenya){
					header('location:keluar.php');
					}else {
						echo 'Gagal';
						header('location:keluar.php');
			}
		} else {
			echo '
			<script>alert("Stock Tidak Mencukupi");
			window.location.href="keluar.php";
			</script>
			';
		}

		
	} else {
		$selisih = $qtyskrg-$qty;
		$kurangin = $stockskrg + $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");	
			if($kurangistocknya&&$updatenya){
				header('location:keluar.php');
				} else {
					echo 'Gagal';
					header('location:keluar.php');
			}
	}
}




//hapus barang keluar
if(isset($_POST['hapusbarangkeluar'])){
	$idb = $_POST['idb'];
	$qty = $_POST['kty'];
	$idk = $_POST['idk'];

	$getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$data = mysqli_fetch_array($getdatastock);
	$stok = $data['stock'];

	$selisih = $stok+$qty;

	$update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
	$hapusdata = mysqli_query($conn,"delete from keluar where idkeluar='$idk'");

	if($update&&$hapusdata){
		header('location:keluar.php');
	}else{
		header('location:keluar.php');
		} 
}


//tambah admin baru
if(isset($_POST['addadmin'])){
	$email = $_POST['email'];
	$password = $_POST['password'];

	$queryinsert = mysqli_query($conn, "insert into login (email, password) values ('$email','$password')");

	if($queryinsert){
		//jika berhasil
		header('location:admin.php');

	}else {
		//jika gagal
		header('location:admin.php');
	}
}




//edit admin
if(isset($_POST['updateadmin'])){
	$emailbaru = $_POST['email'];
	$passwordbaru = $_POST['passwordbaru'];
	$idnya = $_POST['id'];

	$queryupdate = mysqli_query($conn, "update login set email='$emailbaru', password='$passwordbaru' where iduser='$idnya'");

	if($queryupdate){
		header('location:admin.php');
	}else {
		header('location:admin.php');
	}
}



//hapus admin
if(isset($_POST['hapusadmin'])){
	$id = $_POST['id'];

	$querydelete = mysqli_query($conn, "delete from login where iduser='$id'");

	if($querydelete){
		header('location:admin.php');
	}else {
		header('location:admin.php');
	}
}


?>	