<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Move Millenium :: ERP System</title>

<style type="text/css">
    @font-face {
        font-family: droid;
        src: url(<?php echo base_url(); ?>asset/fonts/droidnaskh-regular.ttf);
    }
    *{
      font-family: 'droid' !important;
    }
    body {
      background:url('<?php echo base_url(); ?>asset/img/login-bg.jpg') no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;  
    }

    .login-card {
      padding: 40px;
      width: 274px;
      background-color: #F7F7F7;
      margin: 80px auto 10px;
      border-radius: 7px;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      overflow: hidden;
    }

    .login-card h1,h3 {
      font-weight: 100;
      text-align: center;
      font-size:1.9em;
      color:rgba(0,0,0,0.7);
    }
    .login-card h3{
    	font-size:1.5em;
    	color:rgba(28,101,174,1);
    	font-weight:normal;
    }
    .login-card input[type=submit] {
      width: 100%;
      display: block;
      margin-bottom: 10px;
      position: relative;
      border-radius:2px;
    }

    .login-card input[type=text], input[type=password] {
      height: 44px;
      font-size: 16px;
      width: 100%;
      outline:none;
      margin-bottom: 10px;
      -webkit-appearance: none;
      border-radius:4px;
      background: #fff;
      border: 1px solid #d9d9d9;
      border-top: 1px solid #c0c0c0;
      /* border-radius: 2px; */
      padding: 0 8px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      transition:all 0.6s;
    }
    .login-card input[type=text]:focus, input[type=password]:focus
    {
      border: 1px solid #92797a;
    }

    .login {
      text-align: center;
      font-size: 17px;
      height: 36px;
      padding: 0 8px;
    /* border-radius: 3px; */
    /* -webkit-user-select: none;
      user-select: none; */
    }

    .login-submit {
      /* border: 1px solid #3079ed; */
      border: 0px;
      color: #fff;
      text-shadow: 0 1px rgba(0,0,0,0.1); 
      background-color: #4d90fe;
      transition:all 0.5s;
      /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
    }

    .login-submit:hover {
      /* border: 1px solid #2f5bb7; */
      border: 0px;
      text-shadow: 0 1px rgba(0,0,0,0.3);
      background-color: #357ae8;
      /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
    }

    .login-card a {
      text-decoration: none;
      color: #666;
      font-weight: 400;
      text-align: center;
      display: inline-block;
      transition: all ease 0.5s;
    }

    .login-card a:hover {
      opacity: 1;
    }

    .login-help {
      width: 100%;
      text-align: center;
      font-size: 12px;
    }
    .login-help a{
      color:#000;
      font-size:12px;
    }
    	.errors{
    		font-size:14px;
        color:tomato;
    	}
	</style>
</head>
<body>

<div class="login-card">
  <h1>Move Millennium</h1>
  <h3>ERP System</h3>
	<?php echo form_open('login'); ?>
		<p><input type="text" name="username" placeholder="نێوی بەکارهێنەر  " value="<?php echo $this->input->post('username'); ?>"></p>
		<p><input type="password" name="password" placeholder="وشەی تێپەر بۆن"></p>
		<p><input type="submit" value="تێپەربۆن" class="login login-submit" ></p>
	<?php echo form_close(); ?> 
	  <div class="login-help">
    <a href="#">رێنوێنی</a> • <a href="#">سەبارەت بە ئێمە</a>
    <?= sha1('secret') ?>
  </div>
	<div class="errors">
    <br>
		<?php if (isset($session)) { echo $session;  } ?>
    <?php if (isset($login)) { echo $login;  } ?>
    <?php if (isset($logout)) { echo $logout;  } ?> 
	</div>
</div>

</body>
</html>