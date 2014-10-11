<?php
/**
 * Template Name: Signin
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
  
    
  
<?php get_footer(); ?>
<div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> Liquid Dirt <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h5><strong>Welcome to Liquid Dirt online Hydroponic Garden!</strong></h5>
                    <ul>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Hydroponic Garden Management</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Social Community</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Retina Ready</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Access from Anywhere</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> and much more...</li>
                    </ul>
                    <div class="mb20"></div>
                    <strong>Not a member? <a href="signup.html">Sign Up</a></strong>
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5">
            
            	<?php
            	$args = array(
				        'echo'           => true,
				        //'redirect'       => site_url( $_SERVER['REQUEST_URI'] ),
				        'redirect'       => site_url( '/dashboard/ ' ), 
				        'form_id'        => 'loginform',
				        'label_username' => __( 'Username' ),
				        'label_password' => __( 'Password' ),
				        'label_remember' => __( 'Remember Me' ),
				        'label_log_in'   => __( 'Log In' ),
				        'id_username'    => 'user_login',
				        'id_password'    => 'user_pass',
				        'id_remember'    => 'rememberme',
				        'id_submit'      => 'wp-submit',
				        'remember'       => true,
				        'value_username' => NULL,
				        'value_remember' => false
				);
				wp_login_form( $args ); ?>
                
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; <?php echo date('Y'); ?>. All Rights Reserved. Liquid Dirt
            </div>
            <div class="pull-right">
                Created By: <a href="http://jamiebrewer.com/" target="_blank">Jamie Brewer</a>
            </div>
        </div>
        
    </div><!-- signin -->