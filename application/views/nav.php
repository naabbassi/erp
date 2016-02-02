<style type="text/css">
  .profile-image{
    max-width:34px !important;
    position:absolute;
    left:130px;
    top:8px;
  }
</style>
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
                  <li><?= anchor('define/cat',' گرۆپی کاڵاکان') ?></a></li>
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
                  <li><?= anchor('operation/purchase_list','ریزی فاکتۆرەکانی کڕینی') ?></a></li>
                  <li class="divider"></li>
                  <li><?= anchor('operation/sale','فرۆشی کاڵا') ?></a></li>
                  <li><?= anchor('operation/sale_list','ریزی فاکتۆرەکانی فرۆش') ?></a></li>
                  <li><?= anchor('operation/sale_back','گەڕانەوە لە فرۆش') ?></a></li>
                   <li class="divider"></li>
                  <li><?= anchor('operation/payment','وەرگرتنی پارە') ?></a></li>
                  <li><?= anchor('operation/purchase_payment','دانی پارە') ?></a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">هەژمارەکان<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><?= anchor('accounts/general','هەژمارە گشتیەکان') ?></a></li>
                  <li><?= anchor('accounts/independent','هەژمارە سەربەخۆکان') ?></a></li>
                  <li><?= anchor('accounts/fix_assets','دارایی ثبتەکان') ?></a></li>
                  <li><?= anchor('accounts/stock_holders','خاوەن پشکەکان') ?></a></li>
                </ul>
              </li>
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">ژمێریاری<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><?= anchor('accounting/accounts_manager','هەژمارەکان') ?></a></li>
                   <li class="divider"></li>
                  <li><?= anchor('accounting/new_record','تومارکردنی بەڵگە') ?></a></li>
                   <li class="divider"></li>
                  <li><?= anchor('accounting/records_list','ریزی بەڵگەکانی ژمێریاری') ?></a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">راپورت <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><?= anchor('reports/trial_balancesheet','Trial Balancesheet') ?></a></li>
                  <li class="divider"></li>
                  <li><?= anchor('reports/accounts_report','Accounts Report') ?></li>
                  <li class="divider"></li>
                  <li><?= anchor('reports/products_report','راپورتی کالاکان') ?></li>
                  <li class="divider"></li>
                  <li><?= anchor('reports/inventory_report','Storage Inventory') ?></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-left col-sm-1"></ul>
            <ul class="nav navbar-nav navbar-left">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php $user=$this->user_model->findbyfield('user_id',$_SESSION['user_id']);  ?><?php echo $user->f_name.' '.$user->m_name; ?> <img src="<?php echo base_url().'asset/img/users/'.$user->image_file; ?>" class="profile-image img-circle"> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><?= anchor('logout', 'بینینی پروفایل');?> </li>
                  <li><?= anchor('logout', 'دەرچون');?></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
      <div class="clearfix"></div><br><br><br><br>
      <script src="<?php echo base_url(); ?>asset/js/jquery-1.11.1.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/bootstrap.js"></script>
