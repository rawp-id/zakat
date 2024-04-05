<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .shadow-dark {
            box-shadow: 1px 1px 1px 0 rgba(0, 0, 0, 0.389), 0 0px 30px 0 rgba(4, 4, 4, 0.648);
        }

        .shadow-white {
            box-shadow: 1px 1px 1px 0 rgba(255, 255, 255, 0.389), 0 0px 30px 0 rgba(4, 4, 4, 0.648);
        }
    </style>
</head>

<body style="background-color: rgb(28, 32, 35); color: white;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-12">
                <div class="container text-center">
                    <h4 class="mt-5"><strong>RAWP</strong></h4>
                </div>
                <div class="card mt-4 shadow-white border" style="border-radius: 20px;" data-bs-theme="dark">
                    <div class="card-body mt-4 mb-4">
                        <div class="container">
                            <h5 class="card-title">Verifikasi Alamat Email</h5>
                            <hr>
                            <h5><strong>Hai!</strong></h5>
                            <p class="card-text">Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda.
                            </p>
                            <div class="text-center">
                                <a href="http://127.0.0.1:8000/verifikasi?email=<?=$email?>&&code=<?=$verificationCode?>" class="btn btn-light mb-3 mt-2" style="border-radius: 20px; width: 150px;">Verifikasi Email</a>
                            </div>
                            <p>Jika Anda tidak membuat akun, tidak diperlukan tindakan lebih lanjut.</p>
                            <p>Salam,<br>RAWP</p>
                            <hr>
                            <p>Jika Anda kesulitan mengklik tombol "Verifikasi Email", salin dan tempel URL di
                                bawah ini ke browser web Anda:
                                <a href="http://127.0.0.1:8000/verifikasi?email=<?=$email?>&&code=<?=$verificationCode?>">http://127.0.0.1:8000/verifikasi?email=<?=$email?>&&code=<?=$verificationCode?></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="container text-center mt-5">
                    <p style="color: rgb(131, 131, 131);">© 2024 RAWP. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>