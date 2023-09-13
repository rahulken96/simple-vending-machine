<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?= base_url() . 'assets/css/bootstrap.min.css'; ?>">

	<title><?= $judul_halaman ?> | Simple Vending Machine</title>
</head>

<body>
  <!-- Start Pages -->
  <div class="account-pages my-5 pt-sm-5">
    <div class="container">

      <!-- Form -->
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card overflow-hidden">
            <div class="bg-soft" style="background-color: rgba(13,202,240);">
              <div class="row">
                <div class="col-7">
                  <div class="text-primary p-4">
                    <h5 class="text-black">Selamat Datang !</h5>
                    <p class="text-black">Silahkan Masuk ^_^</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body pt-0">

              <div class="p-2">
                <form action="<?= base_url('auth/login') ?>" class="form-horizontal" method="post">

                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Masukkan username" name="username" required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group auth-pass-inputgroup">
                      <input type="password" class="form-control" placeholder="Masukkan password" name="password" aria-label="Password" aria-describedby="password-addon" required>
                    </div>
                  </div>

                  <div class="d-flex flex-wrap gap-2">
                    <a href="<?= base_url(); ?>" class="btn btn-outline-danger waves-effect">Kembali</a>
                    <button type="submit" class="btn btn-info waves-effect waves-light" name="submit">
                      Submit
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="mt-5 text-center">

            <div>
                <script>
                  document.write(new Date().getFullYear())
                </script> &copy; Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
              </p>
            </div>
          </div>

        </div>
      </div>
      <!-- Form -->

    </div>
  </div>
  <!-- end account-pages -->
</body>

</html>
