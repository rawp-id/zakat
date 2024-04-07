<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zakat</title>
    <link rel="icon" type="image/png" href="/views/img/zakat (1).png">

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

        /* .shadow-dark {
            box-shadow: 0 1px 3px 1px rgba(151, 151, 151, 0.5), 0 0px 20px 1px rgba(0, 0, 0, 0.61);
        } */

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
            <a class="navbar-brand" href="#">Data Zakat</a>
            <div class="d-flex">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link desktop" href="/"><i class="bi bi-box-arrow-in-right"></i> Kembali</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- running text -->
    <div class="news-marquee">
        <div class="news-content">
            <span class="news-item">Zakat V2.0</span>
            <span class="news-item">Selamat Menunaikan Ibadah Puasa 1445 H</span>
            <span class="news-item">Dalam keheningan bulan suci, warna-warni doa dan kesyukuran melukis hati.</span>
            <span class="news-item">Ramadhan, lukisan indah di palet cinta dan kedamaian.</span>
        </div>
    </div>

    <!-- main content -->
    <div class="container-fluid">

        <!-- Table -->
        <div class="container mt-5">
            <h3>Masjid Darul Muttaqin</h3>
            <div class="card text-center mt-4 shadow-white" data-bs-theme="dark" style="border-radius: 30px;">
                <div class="card-body mt-2 mb-3">
                    <!-- <h5 class="card-title">Table</h5>
                    <hr> -->
                    <div class="container mt-3">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped bg-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Rincian</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // echo json_encode($data);
                                    $i = 1;
                                    foreach ($data['data'] as $datas) :
                                        // if ($datas['code'] == "dm") :
                                    ?>
                                            <tr>
                                                <th scope="row"><?= $datas['tanggal'] ?></th>
                                                <td><?= $datas['nama'] ?></td>
                                                <td><?= $datas['jumlah'] ?></td>
                                                <td><?= $datas['alamat'] ?></td>
                                                <td><?= $datas['rincian'] != "-" ? implode(",", json_decode($datas['rincian'])) : "-" ?></td>
                                                <td><?= $datas['keterangan'] != "-" ? implode(",", json_decode($datas['keterangan'])) : "-" ?></td>
                                                <td class="<?= $datas['status'] === 1 ? "text-success" : "text-danger" ?>"><?= $datas['keterangan'] === "1" ? "Sah" : "Tidak Sah" ?></td>
                                            </tr>
                                    <?php
                                            $i++;
                                        // endif;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <!-- footer -->
        <footer class="py-3 navbar-desktop bg-dark border-top border-body" data-bs-theme="dark">
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