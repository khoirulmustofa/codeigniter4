<?= $this->extend('_layout/auth') ?>

<?= $this->section('style_1') ?>
<style>
    .bg-holder {
        position: absolute;
        width: 100%;
        min-height: 100%;
        top: 0;
        left: 0;
        background-size: cover;
        background-position: center;
        overflow: hidden;
        will-change: transform, opacity, filter;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        background-repeat: no-repeat;
        z-index: 0;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row vh-100 g-0">
    <div class="col-lg-6 position-relative d-none d-lg-block">
        <div class="bg-holder" style="background-image: url(assets/img/bg_login.png)"></div>
    </div>
    <div class="col-lg-6">
        <div class="row d-flex justify-content-center h-100 g-0 px-4 px-sm-0">
            <div class="col col-sm-6 col-lg-7 col-xl-6">
                <a class="mb-2" href="#">
                    <div class="d-flex justify-content-center fw-bolder fs-3 d-inline-block">
                        <img src="assets/img/logo_school.png" alt="phoenix" class="img-fluid" />
                    </div>
                </a>
                <div class="text-center mb-7">
                    <h3 class="text-body-highlight">Sign In</h3>
                    <p class="text-body-tertiary">Get access to your account</p>
                </div>
                <a class="btn btn-outline-danger w-100"><i class="fab fa-google"></i> Goggle Account</a>
                <div class="position-relative">
                    <hr class="bg-body-secondary" />
                    <div class="divider-content-center text-center">or use email</div>
                </div>
                <form method="post" id="form_login">
                    <div class="mb-3 text-start">
                        <label class="form-label" for="email">Username <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                            <input type="text" value="admin@admin.com" name="email" class="form-control" placeholder="Email..." autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                            <input type="password" value="http://localhost:8080/" name="password" class="form-control" placeholder="Password .." autocomplete="off">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-7">
                        <div class="form-check mb-0">
                            <input class="form-check-input" id="basic-checkbox" type="checkbox" /><label class="form-check-label mb-0" for="basic-checkbox">Remember me</label>
                        </div>
                        <a class="fs-9 fw-semibold" href="#">Forgot Password?</a>

                    </div>
                    <button type="submit" class="btn btn-success w-100 mb-3">Sign In</button>
                </form>
                <div class="text-center">
                    <a class="fs-9 fw-bold" href="#">Create an account</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script_1') ?>
<script>
    $(document).ready(function() {
        $('#form_login').submit(function(e) {
            e.preventDefault(); // Prevent form submission
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="<?= csrf_token() ?>"]').attr('content')
                }
            });
            // Serialize form data
            var formData = $(this).serialize();

            // AJAX POST request
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('login_action') ?>",
                data: formData,
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    $('meta[name="<?= csrf_token() ?>"]').attr('content', response.data.token);
                    // Handle successful response
                    console.log(response);


                    if (response.success) {
                        alert_success(response.message);
                        window.location.replace("<?php echo base_url('dashboard') ?>");
                    } else {
                        alert_warning(response.message);
                    }

                    // You can do further processing here
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>