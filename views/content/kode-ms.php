<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zakat</title>
    <link rel="icon" type="image/png" href="/views/img/moon.png">

    <!-- Bootstrap Jtable CSS CDN -->
    <!-- <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js" /> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>
        @media (min-width: 992px) {
            .desktop {
                display: block;
            }

            .mobile {
                display: none;
            }
        }

        @media (max-width: 991px) {
            .desktop {
                display: none;
            }

            .mobile {
                display: block;
            }
        }

        .news-marquee {
            overflow: hidden;
            background-color: rgba(113, 117, 120, 0.105);
            white-space: nowrap;
            box-sizing: border-box;
            position: sticky;
            top: 56px;
            height: 40px;
            line-height: 40px;
            z-index: 1020;
        }

        .news-content {
            display: flex;
            /* position: absolute; */
            white-space: nowrap;
            animation: scrollNews 50s linear infinite;
        }

        .news-item {
            display: inline-block;
            margin-right: 150px;
        }

        @keyframes scrollNews {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-100%);
            }
        }

        ::-webkit-scrollbar {
            width: 12px;
        }

        * {
            scrollbar-width: thin;
        }

        .shadow-white {
            box-shadow: 1px 1px 1px 0 rgba(255, 255, 255, 0.389), 0 0px 30px 0 rgba(4, 4, 4, 0.648);
        }

        .shadow-dark {
            box-shadow: 1px 1px 1px 0 rgba(0, 0, 0, 0.389), 0 0px 30px 0 rgba(4, 4, 4, 0.648);
        }

        .line {
            flex-grow: 1;
            height: 1px;
            background-color: #5a5a5a;
            /* Ganti warna sesuai tema */
        }

        .round {
            border-radius: 20px;
        }
    </style>
</head>

<body style="color: white; background-color: rgb(28, 32, 35);">

    <!-- navbar top -->
    <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">Kode Masjid</a>
        </div>
    </nav>

    <!-- main content -->
    <div class="container-fluid">

        <!-- Register -->
        <div class="container mt-5">
            <!-- <h3>Register</h3> -->
            <div class="row">
                <div class="col-md-2 col-lg-4"></div>
                <div class="col-12 col-md-8 col-lg-4">
                    <div class="card text-center mt-4 shadow-white" data-bs-theme="dark" style="border-radius: 30px;">
                        <div class="card-body mt-2 mb-3">
                            <h5 class="card-title">Kode Masjid</h5>
                            <hr>
                            <?php
                            if ($msg != null) :
                            ?>
                                <div class="alert <?= ($msg->status === true ? "alert-success" : "alert-danger") ?>" role="alert" style="border-radius: 25px;">
                                    <div class="spinner-border mb-2" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <br>
                                    <?= $msg->message ?>,
                                    <br>
                                    Tunggu Redirect Dashboard
                                </div>
                            <?php
                                header("Refresh:3; url=/dashboard");
                                ob_end_flush();
                            endif;
                            ?>
                            <div class="container-fluid">
                                <form method="post">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="kode" placeholder="Kode" aria-label="Recipient's username" aria-describedby="button-addon2" value="<?= $kode ?>">
                                        <button class="btn btn-outline-light" type="submit" name="cek" id="button-addon2"><i class="bi bi-search"></i> Cek</button>
                                    </div>
                                    <?php
                                    if ($masjidData != null && $masjidData != "empty") {
                                    ?>
                                        <div class="card" style="border-radius: 30px;">
                                            <h4 class="mt-3 text-success">Data Ditemukan</h4>
                                            <strong class="mb-3">Masjid <?= $masjidData['nama'] ?></strong>
                                        </div>
                                    <?php
                                    } elseif ($masjidData != "empty") {
                                    ?>
                                        <div class="card" style="border-radius: 30px;">
                                            <h4 class="mt-3 mb-3 text-danger">Data Tidak Ditemukan</h4>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-11 col-sm-8 col-md-6 col-lg-8 mx-auto">
                                            <button type="submit" name="submit" class="btn btn-light mt-4 mb-3 w-100" style="border-radius: 20px;">Simpan</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <p style="font-size: small">Masukan kode masjid untuk bisa mengakses data masjid. Lalu klik cek untuk konfirmasi bahwa masjid tersebut terdaftar. Dan setelah data ditemukan silahkan untuk menyimpan data tersebut.</p>
                                    <!-- <p style="font-size: small">Informasi ini akan disimpan dengan aman sesuai <a href="https://policies.google.com/" style="text-decoration: none; color: white;"><b>Ketentuan Layanan &
                                                Kebijakan
                                                Privasi</b></a></p> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-lg-4"></div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <!-- footer -->
        <footer class="py-3 navbar-desktop bg-dark border-top border-body" data-bs-theme="dark">
            <!-- <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            </ul> -->
            <!-- <p class="text-center text-muted">App V2.0</p> -->
            <p class="text-center text-muted">© 2024 RAWP | App v2.0</p>
        </footer>



        <!-- jtable js cdn -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <!-- <script type="text/javascript"
                    src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script> -->
        <script type="text/javascript" src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
        <!-- <script type="text/javascript" src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script> -->

        <script>
            new DataTable('#example');
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('dynamicForm');
                const inputContainer = document.getElementById('inputContainer');

                function addInputField() {
                    const newInputGroup = document.createElement('div');
                    newInputGroup.classList.add('input-group', 'mb-3', 'inputField');
                    newInputGroup.innerHTML = `
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" placeholder="Rincian...">
                    <button class="btn btn-light deleteButton" type="button"><i class="bi bi-trash3"></i></button>
                `;
                    inputContainer.appendChild(newInputGroup);
                    updateDeleteButtons();
                }

                function updateDeleteButtons() {
                    document.querySelectorAll('.deleteButton').forEach(button => {
                        button.onclick = function() {
                            this.parentElement.remove();
                        }
                    });
                }

                updateDeleteButtons();
                document.querySelector('.addInputButton').addEventListener('click', addInputField);
            });
        </script>

        <!-- Chart Js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Chart js -->
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <!-- Bootstrap Js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>