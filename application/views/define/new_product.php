<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>کاڵاکان</title>
</head>
<body>
<div class="container">
  <?php 
  $this->load->view('nav');
  ?>
<div class="col-md-6" id="form">
<?php echo form_open('define/new_product',array('class' => 'form-horizontal')); ?>
  <div class="form-group">
        <label  class="col-sm-4 control-label">گرۆپ :</label>
        <div class="col-sm-8">
          <select class="form-control" name='cat_id' id='cat_id' required>
            <option></option>
          <?php $cats=$this->cat_model->all();
              foreach ($cats as $item) { 
              echo "<option value='$item->id'>$item->title</option>"  ;
              }
           ?></select>
        </div>
      </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">نێوی کاڵا :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="title" placeholder="نێوی کاڵا" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">یەکەی ریپورت :</label>
    <div class="col-sm-8">
      <input class="form-control" type="number" name="unit_scale" placeholder="قیاسی یەکەی" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">نێوی یەکە :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="unit_name" placeholder="قیاسی یەکەی" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">نێوی یەکەی ورد :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="component_name" placeholder="یەکەی ورد" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">نرخ :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="price" placeholder="نرخ" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-4">
      <button class="btn btn-success" type="submit">پاشکەوت کردن</button>
    </div>
  </div>
<?php echo form_close (); ?>
</div>
<div class="col-md-6" id="notify">
<?php if(isset($message)) echo "<div class='alert alert-info'>".$message."</div>"; ?>
</div>
<div class="clearfix"></div><br>
<div class="col-md-12">
<hr>
<table class="table table-hover table-striped" id="table">
<thead>
  <th>#</th>
  <th>گرۆپ</th>
  <th>نێوی بەرهەم</th>
  <th>قیاسی یەکە</th>
  <th>نرخ</th>
  <th>کارگێری</th>
</thead>
<?php 
  $no=1;
  $res=$this->product_model->all();
  foreach ($res as $key) {
    $cat=$this->cat_model->findbyid($key->cat_id);
   ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $cat->title; ?></td>
      <td><?php echo $key->title; ?></td>
      <td><?php echo $key->unit_scale; ?></td>
      <td><?php echo $key->price; ?></td>
      <td><a href="<?php echo $key->id; ?>" id="edit">گوڕانکاری</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $key->id; ?>" id="delete">ڕەش کردنەوە</a></td>
    </tr>
  <?php
  $no++;
   }
?>
</table>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){

	var base_url='<?php echo base_url(); ?>'+'index.php/';
    $('#table').on('click','#delete',function(e) {
      var object = $(this);
    if (confirm('ئایا دڵنیای لە ڕەش کردنەوە ؟')) {
      delete_id = $(this).attr('href');
    $.ajax({
      url:base_url + 'define/delete_product/' + delete_id ,
      type:'POST',
    success:function(data){
      console.log(data);
      $('#notify').html(data).show();
      var td=object.parent();
      var tr=td.parent();
      tr.fadeOut(2000).remove();
      },
    error:function(data){
      console.log(data);
      $('#notify').html(data).show().fadeOut(5000);
      }
    }); }
    e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });
  /* Edit Bank Account */
$('#table').on('click','#edit',function(e) {
      edit_id = $(this).attr('href');
    $.ajax({
      url:base_url + 'define/edit_product/' + edit_id ,
      type:'POST',
    success:function(data){
      $('#form').html(data);
      },
    error:function(data){
      $('#notify').html(data).show().fadeOut(5000);
      }
    }); 
    e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });
});
</script>
</body>
</html>