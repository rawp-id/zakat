<!-- Login -->
<div class="container mt-5">
    <!-- <h3>Login</h3> -->
    <div class="row">
        <div class="col-md-2 col-lg-4"></div>
        <div class="col-12 col-md-8 col-lg-4">
            <div class="card text-center mt-4 shadow-white" data-bs-theme="dark" style="border-radius: 30px;">
                <div class="card-body mt-2 mb-3">
                    <h5 class="card-title">Welcome to Apps</h5>
                    <hr>
                    <?php
                    // echo $msg;
                    if ($msg != null) :
                    ?>
                        <div class="alert <?= ($msg->status === true ? "alert-success" : "alert-danger") ?>" role="alert" style="border-radius: 25px;">
                            <!-- <div class="spinner-border mb-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div> -->
                            <!-- <br> -->
                            <?= $msg->message ?>
                        </div>
                    <?php
                    // header("Refresh:4");
                    // ob_end_flush();
                    endif;
                    ?>
                    <div class="container-fluid">
                        <form method="post" class="needs-validation" novalidate>
                            <div class="container text-start">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" class="form-control round" name="email" id="email" value="<?= $email ?>" required>
                                    <div class="invalid-feedback">
                                        Email tidak boleh kosong.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control round" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" required>
                                    <div class="invalid-feedback">
                                        Password tidak Boleh Kosong.
                                    </div>
                                </div>
                                <!-- <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Ingat saya</label>
                                </div> -->
                            </div>
                            <button type="submit" name="submitBtn" class="btn btn-light mt-3 mb-3 w-75" style="border-radius: 20px;">Login</button>
                            <!-- <div class="row">
                                <div class="col-11 col-sm-8 col-md-6 col-lg-8 mx-auto">
                                    <button type="submit" name="submit" class="btn btn-light mt-3 mb-3 w-100" style="border-radius: 20px;">Login</button>
                                </div>
                            </div> -->
                        </form>
                        <div class="mb-1">
                            <a href="/maintenance" style="text-decoration: none; color: white; font-size: small;"><b>Lupa
                                    Password?</b></a>
                        </div>
                        <div class="container mt-3 d-flex align-items-center">
                            <div class="line"></div>
                            <p class="mx-2 mb-0">Or</p>
                            <div class="line"></div>
                        </div>
                        <div class="row">
                            <div class="col-11 col-sm-8 col-md-6 col-lg-8 mx-auto">
                                <a href="/maintenance" class="btn btn-light mt-3 mb-3 w-100" style="border-radius: 20px;">
                                    <img src="/views/img/search.png" alt="google" style="width: 10%;">
                                </a>
                            </div>
                        </div>
                        <p class="text-center mt-2" style="font-size: small;">Tidak punya akun? <a href="/register" style="text-decoration: none; color: white;"><b>Sign
                                    Up</b></a></p>
                        <hr>
                        <p style="font-size: small">Informasi ini akan disimpan dengan aman sesuai <a href="https://policies.google.com/" style="text-decoration: none; color: white;"><b>Ketentuan Layanan &
                                    Kebijakan
                                    Privasi</b></a></p>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-lg-4"></div>
    </div>
</div>

<script>
    (() => {
        'use strict';

        const forms = document.querySelectorAll('.needs-validation');

        const showCustomInvalidFeedback = (input, message) => {
            const feedbackElement = input.nextElementSibling;
            feedbackElement.textContent = message;
            feedbackElement.style.display = 'block';
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
        };

        const showCustomValidFeedback = (input) => {
            const feedbackElement = input.nextElementSibling;
            feedbackElement.style.display = 'none'; // Sembunyikan pesan jika ada
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        };

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                let formIsValid = true;

                form.querySelectorAll('input').forEach(input => {
                    input.classList.remove('is-invalid', 'is-valid'); // Reset state

                    // Custom validation for password
                    if (input.id === 'password') {
                        const passwordRequirements = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/;
                        if (!passwordRequirements.test(input.value)) {
                            showCustomInvalidFeedback(input, 'Min 8 Huruf, Huruf Besar, Angka, Symbol.');
                            formIsValid = false;
                        } else {
                            showCustomValidFeedback(input); // Tandai sebagai valid
                        }
                    }

                    const invalidCharacters = /['"]/;
                    if (invalidCharacters.test(input.value)) {
                        showCustomInvalidFeedback(input, 'Input tidak boleh mengandung karakter \' atau "');
                        formIsValid = false;
                    } else if (input.value.trim() === '') {
                        showCustomInvalidFeedback(input, `${input.previousElementSibling.textContent} tidak boleh kosong`);
                        formIsValid = false;
                    } else if (input.id !== 'password') {
                        showCustomValidFeedback(input); // Untuk input lain, tandai sebagai valid jika tidak ada masalah lain
                    }
                });

                if (!formIsValid) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                }
            }, false);
        });
    })();
</script>