<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="../assets/js/color-modes.js"></script> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">  
    <title>Login Failure</title> 
    <link href="<?php echo base_url('bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet"> 
    <div class="alert alert-danger text-center" role="alert">
        <h4 class="alert-heading">Ah!</h4>
        <p>Login Failed, Please cross-check your login credentials.</p> 
        <?php if (setting('Auth.allowMagicLinkLogins')): ?>
            <p class="text-center">
                <?= lang('Auth.forgotPassword') ?> <a href="<?= url_to('magic-link') ?>">
                    <?= lang('Auth.useMagicLink') ?>
                </a>
            </p>
        <?php endif ?>
    
        <?php if (setting('Auth.allowRegistration')): ?>
            <p class="text-center">
                <?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>">
                    <?= lang('Auth.register') ?>
                </a>
            </p>
        <?php endif ?>
    </div> 
    </main>
    <script src="<?php echo base_url('bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?php echo base_url('sidebar/sidebars.js') ?>"></script>
    </body>

</html>