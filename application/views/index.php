<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?= base_url() . 'assets/css/style.css'; ?>">
	<link rel="stylesheet" href="<?= base_url() . 'assets/css/bootstrap.min.css'; ?>">
	<link rel="stylesheet" href="<?= base_url() . 'assets/css/owl.carousel.min.css'; ?>">
	<link rel="stylesheet" href="<?= base_url() . 'assets/css/owl.theme.default.min.css'; ?>">

	<title><?= $judul_halaman ?> | Simple Vending Machine</title>
</head>

<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-info">
		<div class="container">
			<a class="navbar-brand" href="index.php"><i class="bi bi-newspaper" style="font-size: larger;"></i></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<?php if ($this->session->login) : ?>
							<a href="<?= base_url('admin'); ?>" class="btn btn-outline-light text-black"><i class="bi bi-box-arrow-in-right"></i> Dashboard</a>
						<?php else : ?>
							<a href="<?= base_url('auth'); ?>" class="btn btn-outline-light text-black"><i class="bi bi-box-arrow-in-right"></i> Login</a>
						<?php endif ?>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Navbar -->

	<!-- Content -->
	<div class="container mt-4">
		<h1>Silahkan Pilih Minuman !</h1>
		<div class="card mb-5"></div>

		<div class="owl-carousel owl-theme mb-5" id="owl-carousel">
			<?php foreach ($data_minuman as $minuman) : ?>
				<?php if ($minuman->stok > 0) : ?>
					<div class="item w-50 d-flex flex-column justify-content-center align-items-center border border-dark">
						<img src="<?= base_url(''); ?>assets/img/drink.png" alt="" style="margin: 10px; width: 100px; height: 100px;">
						<h5><?= $minuman->nama ?></h5>
						<h6>Kode : <?= $minuman->kode_barang ?></h6>
						<p>Rp <?= number_format($minuman->harga, 2, ",", ".") ?></p>
					</div>
				<?php endif ?>
			<?php endforeach ?>
		</div>

		<div class="owl-carousel owl-theme mb-5" id="owl-carousel2">
			<?php foreach ($data_makanan as $makanan) : ?>
				<?php if ($makanan->stok > 0) : ?>
					<div class="item w-50 d-flex flex-column justify-content-center align-items-center border border-dark">
					<img src="<?= base_url(''); ?>assets/img/food.png" alt="" style="margin: 10px; width: 100px; height: 100px;">
						<h5><?= $makanan->nama ?></h5>
						<h6>Kode : <?= $makanan->kode_barang ?></h6>
						<p>Rp <?= number_format($makanan->harga, 2, ",", ".") ?></p>
					</div>
				<?php endif ?>
			<?php endforeach ?>
		</div>

		<div class="card mt-5"></div>

	</div>
	<!-- Content -->

	<!-- Bayar -->
	<div class="container mt-4">
		<div class="mb-2">
			<label for="exampleInputEmail1" class="form-label" style="margin-right: 10px;">Uang Pecahan : </label>
			<input class="form-check-input" type="radio" name="pecahan" value="5000" id="lima" required>
			<label class="form-check-label" style="margin-right: 10px;" for="lima">
				Rp 5.000
			</label>
			<input class="form-check-input" type="radio" name="pecahan" value="10000" id="sepuluh" required>
			<label class="form-check-label" style="margin-right: 10px;" for="sepuluh">
				Rp 10.000
			</label>
			<input class="form-check-input" type="radio" name="pecahan" value="20000" id="duapuluh" required>
			<label class="form-check-label" for="duapuluh">
				Rp 20.000
			</label>
		</div>
		<div class="mb-2">
			<label for="kode" class="form-label col-3">Kode Item : <input type="text" class="form-control mt-2" name="kode" id="kode" aria-describedby="text" required autofocus>
			</label>
		</div>
		<div class="mb-2">
			<label for="bayar" class="form-label col-3">Masukkan Uang : <input type="number" class="form-control mt-2" name="bayar" id="bayar" aria-describedby="text" required>
			</label>
		</div>
		<button type="submit" class="btn btn-primary" onclick="bayar()">Bayar</button>
	</div>
	<!-- Bayar -->

	<!-- Footer -->
	<footer class="text-black text-center text-lg-start pt-5 mt-5">
		<div class="text-center" style="background-color: #4FC0D0;">
			Copyright &copy; 2023 Ven-Mach
		</div>
	</footer>
	<!-- Footer -->

	<!-- Script -->

	<script src="<?= base_url() . 'assets/js/bootstrap.bundle.min.js'; ?>"></script>
	<script src="<?= base_url() . 'assets/js/jquery-3.7.1.min.js'; ?>"></script>
	<script src="<?= base_url() . 'assets/js/owl.carousel.min.js'; ?>"></script>
	<script>
		$('#owl-carousel').owlCarousel({
			stagePadding: 50,
			loop: true,
			margin: 10,
			nav: false,
			dots: false,
			autoplay: true,
			autoplayTimeout: 1500,
			autoplayHoverPause: true,
		});

		$('#owl-carousel2').owlCarousel({
			stagePadding: 50,
			loop: true,
			margin: 10,
			autoplay: true,
			nav: false,
			dots: false,
			autoplayTimeout: 1500,
			autoplayHoverPause: true,
			rtl: true,
		});

		$(function() {
			$('#bayar').attr('disabled', 'disabled');
			$('#bayar').attr('type', 'text');
			$('#bayar').attr('value', 'Pilih Uang Pecahan Terlebih Dahulu !');

			$('input[name="pecahan"]').on("click", function() {
				let uang_pecahan = $('input[name="pecahan"]:checked').val();
				$('#bayar').removeAttr('disabled');
				$('#bayar').attr('type', 'number');
				$('#bayar').attr('min', uang_pecahan);
				$('#bayar').attr('step', uang_pecahan);
				$('#bayar').val(uang_pecahan);
			});
		});

		function bayar() {
			let uang_pecahan = $('input[name="pecahan"]:checked').val();
			let kode = $('#kode').val();
			let uang = $('#bayar').val();

			let status = 0;
			if (kode == '') {
				alert('Isi Terlebih Dahulu Item Yang Akan Dipilih !');
				status += 1;
			}

			let nilai_pecahan = $('#bayar').attr('step');
			if (uang % nilai_pecahan != 0) {
				alert('Uang bukan kelipatan dari minimal pecahan !');
				status += 1;
			}

			uang_pecahan = parseInt(uang_pecahan);
			uang = parseInt(uang);
			if (uang < uang_pecahan) {
				alert('Uang Kurang dari minimal pecahan !');
				status += 1;
			}

			if (status == 0) {
				$.ajax({
					type: "post",
					url: "<?= base_url('home/bayar') ?>",
					data: {
						uang_pecahan: uang_pecahan,
						kode: kode,
						uang: uang,
					},
					dataType: "json",
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					success: function(data) {
						alert(data.pesan + data.kembalian);
						setTimeout(function() {
							location.reload();
						}, 500);
					},
					error: function(data) {
						alert('Data Yang Dimasukkan Salah !');
						location.reload();
					}
				});
			} else {
				location.reload();
			}
		};
	</script>
</body>

</html>
