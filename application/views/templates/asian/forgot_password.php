<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo $this->lang->line('splash_description');?>">
<meta name="author" content="">
<title><?php echo $this->lang->line('splash_title');?></title>
<!-- Bootstrap core CSS -->
<link href="/resources/css/bootstrap.min.css" rel="stylesheet">
<link href="/resources/css/stylesheet.css" rel="stylesheet" type="text/css">
<link href="/splash_resources/css/landing.css" rel="stylesheet" type="text/css">
<link href="/resources/css/stylesheet-reponsive.css" rel="stylesheet" type="text/css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>    
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>   
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>   
    <![endif]-->
</head>
<body id="landing-page-2" class="rose-bg">
<div class="toolbar">
  <div class="content-box">
    <section class="container">
      <div class="row"> </div>
      <div class="box">
        <div class="row">
          <div class="messageload">
            <div class="content-box-border">
              <h1><?php echo lang('forgot_password_heading');?></h1>
              <div id="chat-box"></div>
              <div>
                <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>
                <div id="infoMessage"><?php echo $message;?></div>
                <?php echo form_open("auth/forgot_password");?>
                <p>
                  <label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label>
                  <br />
                  <?php echo form_input($email);?> </p>
                <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'));?></p>
                <?php echo form_close();?> </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End .container -->
  </div>
</div>
