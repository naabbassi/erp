<meta charset="utf-8">
	<link href="<?php echo base_url(); ?>asset/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>asset/css/bootstrap_rtl.css" rel="stylesheet">
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">فایل <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><?= anchor('file/center', 'ناساندنی بنکەکان');?></li>
                  <li class="divider"></li>
                  <li><?= anchor('file/customers','ناساندنی موشتەرێکان'); ?></li>
                  <li class="divider"></li>
                  <li><?= anchor('logout','دەرچۆن')?></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">بەرهەم <span class="caret"></a>
                 <ul class="dropdown-menu" role="menu">
                  <li><?= anchor('products/product','ناساندنی بەرهەمەکان') ?></a></li>
                  <li><?= anchor('products/unit','ناساندنی یەکەکان') ?></a></li>
                  <li class="divider"></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">کارگێری<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><?= anchor('operation/purchase','کڕین') ?></a></li>
                   <li class="divider"></li>
                  <li><?= anchor('operation/sale','فرۆش') ?></a></li>
                   <li class="divider"></li>
                  <li><?= anchor('operation/payment','وەرگرتنی پارە') ?></a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">ڕاپۆرت<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><?= anchor('reports/invoice_list','لیستی فاکتۆرەکان') ?></a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
      <div class="clearfix"></div><br><br><br><br>
      <script src="<?php echo base_url(); ?>asset/js/jquery-1.11.1.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/bootstrap.js"></script>