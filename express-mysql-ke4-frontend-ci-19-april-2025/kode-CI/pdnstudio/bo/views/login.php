<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?=base_url('assets/img/favicon.ico')?>" type="image/x-icon"/>
    <title><?php echo isset($pdn_title) ? 'Login | '.$pdn_title : 'Login | Pudin Project'; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url('assets');?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url('assets');?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-4 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><?=$pdn_title;?></h1>
                                    </div>
                                    <!-- <form class="user"> -->
                                    <?php echo form_open($pdn_url, array('class'=>'user'));?>
                                        <div class="form-group">
                                            <?php echo form_input($email);?>
                                            <?=form_error('email','<small class="text-danger pl-3">','</small>');?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo form_input($password);?>
                                            <?=form_error('password','<small class="text-danger pl-3">','</small>');?>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url('assets');?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url('assets');?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url('assets');?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url('assets');?>/js/sb-admin-2.min.js"></script>
    <!-- Notify-->
    <script src="<?=base_url('assets');?>/vendor/notify/notify.min.js"></script>
    <script type="text/javascript">
        const flasDatas = "<?= $this->session->flashdata('success'); ?>";
        if (flasDatas) {
            $.notify(flasDatas, "success");
        }

        const flasDatae = "<?= $this->session->flashdata('error'); ?>";
        if (flasDatae) {
            $.notify(flasDatae, "error");
        }
    </script>
</body>

</html>