<main class="d-flex w-100">
  <div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

          <div class="text-center mt-4">
            <h1 class="h2 text-white">Welcome back!</h1>
            <p class="lead text-white">
            Apa kabar di hari <?= hari_indo(DATE('l')) ?> ini? sehat selalu, semangat terus yaa..
            </p>
          </div>

          <?php $this->load->helper('form'); ?>
            <div class="row m-4">
              <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissible">', ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
              </div>
            </div>
            <?php
            $this->load->helper('form');
            $error = $this->session->flashdata('error');
            if ($error) {
            ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <?php echo $error; ?>
              </div>
            <?php }
            $success = $this->session->flashdata('success');
            if ($success) {
            ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <?php echo $success; ?>
              </div>
            <?php } ?>

          <div class="card">
            <div class="card-body">
              <div class="m-sm-3">
                <form action="<?php echo base_url(); ?>loginMe" method="post">
                  <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input class="form-control form-control-lg" type="text" name="username" placeholder="Masukkan Username disini" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control form-control-lg" type="password" name="password" placeholder="Masukkan password disini" />
                  </div>
                  <div class="d-grid gap-2 mt-3">
                    <button type="sibmit" class="btn btn-lg btn-primary">Sign in</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="text-center mb-3 text-white">
            Lupa pasword? <a href="<?php base_url(); ?>login/forgotpassword">reset disini</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>