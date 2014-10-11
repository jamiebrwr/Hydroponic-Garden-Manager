<?php
/**
 * Template Name: Lock Screen
 *
 * The blog page template displays the "blog-style" template on a sub-page.
 *
 * @package WooFramework
 * @subpackage Template
 */
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>Bracket Responsive Bootstrap3 Admin</title>

  <link href="<?php echo get_template_directory_uri(); ?>/css/style.default.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
<div class="lockedpanel">
        <div class="locked">
            <i class="fa fa-lock"></i>
        </div>
        <div class="loginuser">
            <img src="images/photos/loggeduser.png" alt="" />
        </div>
        <div class="logged">
            <h4>John Doe</h4>
            <small class="text-muted">username@domain.com</small>
        </div>
        <form method="post" action="index.html">
            <input type="password" class="form-control" placeholder="Enter your password" />
            <button class="btn btn-success btn-block">Unlock</button>
        </form>
    </div><!-- lockedpanel -->
  
</section>


<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.sparkline.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookies.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/toggles.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/retina.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/chosen.jquery.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script>
<script>
    jQuery(document).ready(function(){
        
        // Chosen Select
        jQuery(".chosen-select").chosen({
            'width':'100%',
            'white-space':'nowrap',
            disable_search: true
        });
        
    });
</script>

</body>
</html>
