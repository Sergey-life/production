<?php $this->load->view('layouts/meta') ?>
<?php $this->load->view('layouts/header') ?>
<?php $this->load->view('layouts/sidebar') ?>

<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="ml-3">
            <h1><?php echo lang('create_user_heading');?></h1>
            <p><?php echo lang('create_user_subheading');?></p>
        </div>
        <!-- Content Header (Page header) -->
        <div class="row ml-3">
        <div id="infoMessage"><?php echo $message;?></div>

        <?php echo form_open("auth/create_user");?>

              <p>
                    <?php echo lang('create_user_fname_label', 'first_name');?> <br />
                    <?php echo form_input($first_name);?>
              </p>

              <p>
                    <?php echo lang('create_user_lname_label', 'last_name');?> <br />
                    <?php echo form_input($last_name);?>
              </p>

              <?php
              if($identity_column!=='email') {
                  echo '<p>';
                  echo lang('create_user_identity_label', 'identity');
                  echo '<br />';
                  echo form_error('identity');
                  echo form_input($identity);
                  echo '</p>';
              }
              ?>

              <p>
                    <?php echo lang('create_user_company_label', 'company');?> <br />
                    <?php echo form_input($company);?>
              </p>

              <p>
                    <?php echo lang('create_user_email_label', 'email');?> <br />
                    <?php echo form_input($email);?>
              </p>

              <p>
                    <?php echo lang('create_user_phone_label', 'phone');?> <br />
                    <?php echo form_input($phone);?>
              </p>

              <p>
                    <?php echo lang('create_user_password_label', 'password');?> <br />
                    <?php echo form_input($password);?>
              </p>

              <p>
                    <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
                    <?php echo form_input($password_confirm);?>
              </p>


              <p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>


        <?php echo form_close();?>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer') ?>
<?php $this->load->view('layouts/js') ?>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url('assets/template/') ?>dist/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
</body>
</html>