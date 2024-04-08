<!-- Table -->
<div class="container mt-5">
    <h3>Verifikasi Zakat</h3>
    <div class="card text-center mt-4 shadow-white" data-bs-theme="dark" style="border-radius: 30px;">
        <div class="card-body mt-2 mb-3">
            <h5 class="card-title">Table</h5>
            <hr>
            <?php
            if ($msg != null) :
            ?>
                <div class="alert <?= ($msg->status === true ? "alert-success" : "alert-danger") ?>" role="alert" style="border-radius: 25px;">
                    <div class="spinner-border mb-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <br>
                    <?= $msg->message ?>
                </div>
            <?php
                header("Refresh:2");
                ob_end_flush();
            endif;
            ?>
            <div class="container">
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
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data['data'] as $datas) :
                                if ($datas['status'] === 0 && $datas['code'] === $_SESSION['kode_ms']) :
                            ?>
                                    <tr>
                                        <th scope="row"><?= $datas['tanggal'] ?></th>
                                        <td><?= $datas['nama'] ?></td>
                                        <td><?= $datas['jumlah'] ?></td>
                                        <td><?= $datas['alamat'] ?></td>
                                        <td><?= $datas['rincian'] != "-" ? implode(",", json_decode($datas['rincian'])) : "-" ?></td>
                                        <td><?= $datas['keterangan'] != "-" ? implode(",", json_decode($datas['keterangan'])) : "-" ?></td>
                                        <td class="<?= $datas['status'] === 1 ? "text-success" : "text-danger" ?>"><?= $datas['keterangan'] === "1" ? "Sah" : "Tidak Sah" ?></td>
                                        <td>
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#zakat<?= $datas['id'] ?>" style="font-size: x-large;">
                                                <i class="bi bi-check2-square"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete<?= $datas['id'] ?>" style="font-size: x-large;">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal verif -->
                                    <div class="modal fade" id="zakat<?= $datas['id'] ?>" data-bs-theme="dark" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Verifikasi Zakat</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Nama : <?= $datas['nama'] ?></p>
                                                    <p>Jumlah : <?= $datas['jumlah'] ?></p>
                                                    <p>Alamat : <?= $datas['alamat'] ?></p>
                                                    <p>Rincian : <?= $datas['rincian'] != "-" ? implode(",", json_decode($datas['rincian'])) : "-" ?></p>
                                                    <p>Keterangan : <?= $datas['keterangan'] != "-" ? implode(",", json_decode($datas['keterangan'])) : "-" ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="post">
                                                        <h5>Cek Apakah Data Sudah Benar?</h5>
                                                        <input type="text" name="id" value="<?= $datas['id'] ?>" hidden>
                                                        <button type="submit" name="submit" class="btn btn-light round">Verifikasi</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal delete -->
                                    <div class="modal fade" id="delete<?= $datas['id'] ?>" data-bs-theme="dark" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Data Zakat</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Nama : <?= $datas['nama'] ?></p>
                                                    <p>Jumlah : <?= $datas['jumlah'] ?></p>
                                                    <p>Alamat : <?= $datas['alamat'] ?></p>
                                                    <p>Rincian : <?= $datas['rincian'] != "-" ? implode(",", json_decode($datas['rincian'])) : "-" ?></p>
                                                    <p>Keterangan : <?= $datas['keterangan'] != "-" ? implode(",", json_decode($datas['keterangan'])) : "-" ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="post">
                                                        <h5>Cek Apakah Data Sudah Benar?</h5>
                                                        <input type="text" name="id" value="<?= $datas['id'] ?>" hidden>
                                                        <button type="submit" name="delete" class="btn btn-danger round">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    $i++;
                                endif;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirm() {
        Swal.fire({
            title: "Do you want to save the changes?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't save`
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire("Saved!", "", "success");
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    }
</script>