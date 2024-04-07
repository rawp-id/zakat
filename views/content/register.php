<!-- Register -->
<div class="container mt-5">
    <!-- <h3>Register</h3> -->
    <div class="row">
        <div class="col-md-2 col-lg-4"></div>
        <div class="col-12 col-md-8 col-lg-4">
            <div class="card text-center mt-4 shadow-white" data-bs-theme="dark" style="border-radius: 30px;">
                <div class="card-body mt-2 mb-3">
                    <h5 class="card-title">Sign Up</h5>
                    <hr>
                    <?php
                    if ($msg != null) :
                    ?>
                        <div class="alert <?= ($msg->status === true ? "alert-success" : "alert-danger") ?>" role="alert" style="border-radius: 25px;">
                            <?= $msg->message ?>
                        </div>
                    <?php
                    endif;
                    ?>
                    <div class="container-fluid">
                        <form method="post" class="needs-validation" novalidate>
                            <div class="container text-start">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control round" name="nama" id="nama" required>
                                    <div class="invalid-feedback">
                                        Silahkan isikan nama.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" class="form-control round" name="email" id="email" required>
                                    <div class="invalid-feedback">
                                        Silahkan isikan email.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control round" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" required>
                                    <div class="invalid-feedback">
                                        Min 8 Huruf, Huruf Besar, Angka, Symbol.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Re-Password</label>
                                    <input type="password" class="form-control round" name="repassword" id="repassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" required>
                                    <div class="invalid-feedback">
                                        Password tidak sama.
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submitBtn" class="btn btn-light mt-3 mb-3 w-75" style="border-radius: 20px;">Register</button>
                            <!-- <div class="row">
                                <div class="col-11 col-sm-8 col-md-6 col-lg-8 mx-auto">
                                    <button type="submit" name="submit" class="btn btn-light mt-3 mb-3 w-100" style="border-radius: 20px;">Register</button>
                                </div>
                            </div> -->
                        </form>
                        <div class="container mt-3 d-flex align-items-center">
                            <div class="line"></div>
                            <p class="mx-2 mb-0">Or</p>
                            <div class="line"></div>
                        </div>
                        <div class="row">
                            <div class="col-11 col-sm-8 col-md-6 col-lg-8 mx-auto">
                                <a href="/maintenance" type="submit" class="btn btn-light mt-3 mb-3 w-100" style="border-radius: 20px;">
                                    <img src="/views/img/search.png" alt="google" style="width: 10%;">
                                </a>
                            </div>
                        </div>
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
                let passwordValue = '';

                form.querySelectorAll('input').forEach(input => {
                    input.classList.remove('is-invalid', 'is-valid'); // Reset state

                    // Validate password field
                    if (input.id === 'password') {
                        const passwordRequirements = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/;
                        if (!passwordRequirements.test(input.value)) {
                            showCustomInvalidFeedback(input, 'Min 8 characters, Upper case, Lower case, Number, Symbol.');
                            formIsValid = false;
                        } else {
                            showCustomValidFeedback(input);
                            passwordValue = input.value; // Store password value for comparison with repassword
                        }
                    }

                    // Validate repassword field for matching
                    if (input.id === 'repassword') {
                        if (input.value !== passwordValue) {
                            showCustomInvalidFeedback(input, 'Passwords do not match.');
                            formIsValid = false;
                        } else {
                            showCustomValidFeedback(input);
                        }
                    }

                    // Check for invalid characters
                    const invalidCharacters = /['"]/;
                    if (invalidCharacters.test(input.value)) {
                        showCustomInvalidFeedback(input, 'Input cannot contain the characters \' or "');
                        formIsValid = false;
                    } else if (input.value.trim() === '') {
                        showCustomInvalidFeedback(input, `${input.previousElementSibling.textContent} cannot be empty`);
                        formIsValid = false;
                    } else if (input.id !== 'password' && input.id !== 'repassword') {
                        showCustomValidFeedback(input); // Mark as valid for other inputs if there are no other issues
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