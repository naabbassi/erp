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
                  <li><?= anchor('file/backup', 'وەرگرتنی فایل پشتیوان');?></li>
                  <li class="divider"></li>
                  <li><?= anchor('file/restore','گڕانەوە لە رێگەی فایلی پشتیوان'); ?></li>
                  <li class="divider"></li>
                  <li><?= anchor('file/user','بە کار هێنەران'); ?></li>
                  <li class="divider"></li>
                  <li><?= anchor('logout','دەرچۆن')?></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">ناساندن <span class="caret"></a>
                 <ul class="dropdown-menu" role="menu">
                  <li><?= anchor('define/storage',' کۆگا') ?></a></li>
                  <li class="divider"></li>
                  <li><?= anchor('define/product',' کاڵاکان') ?></a></li>
                  <li><?= anchor('define/unit',' یەکەی کاڵاکان') ?></a></li>
                  <li class="divider"></li>
                  <li><?= anchor('define/customer',' موشتەری') ?></a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">کارگێری<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><?= anchor('operation/purchase','کڕینی کاڵا') ?></a></li>
                   <li class="divider"></li>
                  <li><?= anchor('operation/sale','فرۆشی کاڵا') ?></a></li>
                   <li class="divider"></li>
                  <li><?= anchor('operation/payment','وەرگرتنی پارە') ?></a></li>
                </ul>
              </li>
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">ژمێریاری<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><?= anchor('operation/purchase','هەژمارەکان') ?></a></li>
                   <li class="divider"></li>
                  <li><?= anchor('operation/sale','پاشکەوت کردنی بەڵگە') ?></a></li>
                   <li class="divider"></li>
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