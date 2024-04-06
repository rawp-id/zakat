<!-- Form -->
<div class="container mt-5">
    <h3>Form Zakat</h3>
    <!-- <hr> -->
    <div class="card text-center mt-4 shadow-white" data-bs-theme="dark" style="border-radius: 30px;">
        <div class="card-body mt-2 mb-4">
            <h5 class="card-title">Form</h5>
            <hr>
            <?php
            if ($msg != null) :
            ?>
                <div class="alert <?= ($msg->success === true ? "alert-success" : "alert-danger") ?>" role="alert" style="border-radius: 25px;">
                    <div class="spinner-border mb-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <br>
                    <?= $msg->message ?>
                </div>
            <?php
                header("Refresh:4");
                ob_end_flush();
            endif;
            ?>
            <div class="container">
                <form method="post" class="needs-validation" novalidate>
                    <div class="text-start">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" name="nama" id="name" class="form-control round" required placeholder="Inputkan nama">
                            <div class="invalid-feedback">
                                Silahkan isikan nama.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control round" required placeholder="Inputkan jumlah">
                            <div class="invalid-feedback">
                                Silahkan isikan jumlah.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control round" required placeholder="Inputkan alamat"></textarea>
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
                    <button type="submit" name="submit" class="btn btn-light mt-3" style="width: 250px; border-radius: 20px;">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('dynamicForm');
        const inputContainer = document.getElementById('inputContainer');

        function addInputField() {
            const newInputGroup = document.createElement('div');
            newInputGroup.classList.add('input-group', 'mb-3', 'inputField');
            newInputGroup.innerHTML = `
<span class="input-group-text">@</span>
<input type="text" class="form-control" name="rincian[]" id="keterangan[]" required placeholder="Rincian...">
<button class="btn btn-light deleteButton" type="button"><i class="bi bi-trash3"></i></button>
<div class="invalid-feedback">
    Silahkan isikan rincian, jika tidak ada rincian hapus inputannya
</div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('dynamicForm2');
        const inputContainer = document.getElementById('inputContainer2');

        function addInputField() {
            const newInputGroup = document.createElement('div');
            newInputGroup.classList.add('input-group', 'mb-3', 'inputField2');
            newInputGroup.innerHTML = `
<textarea name="keterangan[]" id="keterangan[]" class="form-control" required placeholder="keterangan..."></textarea>
<button class="btn btn-light deleteButton2" type="button"><i class="bi bi-trash3"></i></button>
<div class="invalid-feedback">
    Silahkan isikan keterangan, jika tidak ada keterangan hapus inputannya
</div>
`;
            inputContainer.appendChild(newInputGroup);
            updateDeleteButtons();
        }

        function updateDeleteButtons() {
            document.querySelectorAll('.deleteButton2').forEach(button => {
                button.onclick = function() {
                    this.parentElement.remove();
                }
            });
        }

        updateDeleteButtons();
        document.querySelector('.addInputButton2').addEventListener('click', addInputField);
    });
</script>