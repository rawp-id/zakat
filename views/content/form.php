<!-- Form -->
<div class="container mt-5">
    <h3>Form</h3>
    <!-- <hr> -->
    <div class="card text-center mt-4 shadow-white" data-bs-theme="dark" style="border-radius: 30px;">
        <div class="card-body mt-2 mb-4">
            <h5 class="card-title">Form</h5>
            <hr>
            <?= $msg ?>
            <div class="container">
                <form action="" method="post" class="needs-validation" novalidate>
                    <div class="text-start">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" name="" id="" class="form-control round" name="nama" required placeholder="Inputkan nama">
                            <div class="invalid-feedback">
                                Silahkan isikan nama.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jumlah</label>
                            <input type="number" name="" id="" class="form-control round" name="jumlah" required placeholder="Inputkan jumlah">
                            <div class="invalid-feedback">
                                Silahkan isikan jumlah.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Alamat</label>
                            <textarea name="" id="" class="form-control round" name="alamat" required placeholder="Inputkan alamat"></textarea>
                            <div class="invalid-feedback">
                                Silahkan isikan alamat.
                            </div>
                        </div>
                        <div class="mb-4" id="dynamicForm">
                            <label class="form-label">Rincian</label>
                            <!-- <div class="input-group mb-3 inputField" style="border-radius: 20px;">
                                        <span class="input-group-text" id="basic-addon1">Tambahkan Rincian</span>
                                        <button class="btn btn-success addInputButton" type="button"
                                            style="border-radius: 20px;"><i class="bi bi-plus-circle"></i></button>
                                    </div> -->
                            <div class="row g-2 mb-3 align-items-center">
                                <div class="col-auto">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 15px;">Tambahkan Rincian</span>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-light addInputButton" type="button" style="border-radius: 20px;"><i class="bi bi-plus-circle"></i></button>
                                </div>
                            </div>
                            <div id="inputContainer">
                                <!-- <div class="input-group mb-3 inputField">
                                    <span class="input-group-text">@</span>
                                    <input type="text" class="form-control" placeholder="Rincian...">
                                    <button class="btn btn-light deleteButton" type="button"><i class="bi bi-trash3"></i></button>
                                </div> -->
                            </div>
                        </div>
                        <div class="mb-3" id="dynamicForm2">
                            <label for="" class="form-label">Keterangan</label>
                            <div class="row g-2 mb-3 align-items-center">
                                <div class="col-auto">
                                    <span class="input-group-text" id="basic-addon1" style="border-radius: 15px;">Tambahkan Keterangan</span>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-light addInputButton2" type="button" style="border-radius: 20px;"><i class="bi bi-plus-circle"></i></button>
                                </div>
                            </div>
                            <div id="inputContainer2">
                                <!-- <div class="input-group mb-3 inputField">
                                <textarea name="" id="" class="form-control" placeholder="Inputkan keterangan"></textarea>
                                <button class="btn btn-light deleteButton" type="button"><i class="bi bi-trash3"></i></button>
                            </div> -->
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-light mt-3" style="width: 250px; border-radius: 20px;">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>