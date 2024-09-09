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
    <div class="container">
        <div class="card border-light-subtle shadow-sm">
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
                  <div class="col-md-6 col-12">
                  <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span>
                  </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required>
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6 col-12">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6 col-12">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6 col-12">
                    <label for="no_telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon" id="no_telepon" required>
                    @error('no_telepon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6 col-12">
                    <label for="address_street" class="form-label">Alamat<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="address_street" id="address_street" required>
                    @error('address_street')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6 col-12">
                    <label for="province" class="form-label">Provinsi<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('province') is-invalid @enderror" name="province" id="province" required>
                    @error('province')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6 col-12">
                    <label for="city" class="form-label">City<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="city" required>
                    @error('city')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-md-6 col-12">
                    <label for="postal_code" class="form-label">Kode Pos<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" id="postal_code" required>
                    @error('postal_code')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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
