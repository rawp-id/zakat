<!-- Table -->
<div class="container mt-5">
    <h3>Table</h3>
    <div class="card text-center mt-4 shadow-white" data-bs-theme="dark" style="border-radius: 30px;">
        <div class="card-body mt-2 mb-3">
            <h5 class="card-title">Table</h5>
            <hr>
            <div class="container">
                <div class="table-responsive">
                    <table id="example" class="table table-striped bg-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Rincian</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data['data'] as $datas) :
                            ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $datas['nama'] ?></td>
                                    <td><?= $datas['jumlah'] ?></td>
                                    <td><?= $datas['alamat'] ?></td>
                                    <td><?= $datas['rincian'] ?></td>
                                    <td><?= $datas['keterangan'] ?></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>