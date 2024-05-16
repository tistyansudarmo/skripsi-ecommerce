<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <title>Register</title>
</head>
<body>
  <section class="p-3 p-md-4 p-xl-5 mt-5">
    <div class="container">  <div class="card border-light-subtle shadow-sm">
        <div class="row g-0">
          <div class="col-12">
            <div class="card-body p-3 p-md-4 p-xl-5">
              <div class="row">
                <div class="col-12">
                  <div class="mb-5">
                    <h3>Registration</h3>
                  </div>
                </div>
              </div>
              <form action="" method="POST">
                @csrf
                <div class="row gy-3 gy-md-4">
                  <div class="col-md-6 col-12">  <label for="full_name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="full_name" id="full_name" required>
                  </div>
                  <div class="col-md-6 col-12">
                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="username" id="username" required>
                  </div>
                  <div class="col-md-6 col-12">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" id="password" required>
                  </div>
                  <div class="col-md-6 col-12">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" id="email" required>
                  </div>
                  <div class="col-md-6 col-12">
                    <label for="no_telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" name="no_telepon" id="no_telepon" required>
                  </div>
                  <div class="col-md-6 col-12">
                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="alamat" id="alamat" required>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button class="btn bsb-btn-xl btn-success" type="submit">Submit</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
