<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/logins/login-4/assets/css/login-4.css">
    <title>Login</title>
</head>
<style>
    @media (max-width: 767.98px) {
    .image {
        display: none !important;
    }

    .section-login {
        margin-top: 75px;
    }
}
</style>
<body>
<section class="p-3 p-md-4 p-xl-5 section-login">
    <div class="container d-flex justify-content-center align-items-center">
      <div class="card border-light-subtle shadow-sm w-75">
        <div class="row g-0">
          <div class="image col-12 col-md-6">
            <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="./images/shopinglogin.jpg" alt="">
          </div>
          <div class="col-12 col-md-6">
            <div class="card-body p-3 p-md-4 p-xl-5">
              <div class="row">
                <div class="col-12">
                  <div class="mb-5">
                    <h3>Lullaby Closet</h3>
                  </div>
                </div>
              </div>
              <form action="" method="POST">
                @csrf
                <div class="row gy-3 gy-md-4 overflow-hidden">
                  <div class="col-12">
                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                  </div>
                  <div class="col-12">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button class="btn btn-md btn-success" type="submit">Login</button>
                    </div>
                    <div class="d-grid mt-3">
                        <a href="auth/redirect" class="btn btn-md btn-warning">Sign in with Google</a>
                      </div>
                  </div>
                  @error('password')
                    <div class="text-danger text-center">{{ $message }}</div>
                  @enderror
                  @if(session()->has('error'))
                  <div class="text-danger text-center mt-3">{{ session('error') }}</div>
                  @endif
                </div>
              </form>
              <div class="row">
                <div class="col-12">
                  <hr class="mt-5 mb-4 border-secondary-subtle">
                  <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-start">
                    <a href="/register" class="link-secondary">Create new account</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
</body>
</html>
