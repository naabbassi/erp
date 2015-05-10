<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>دارایی ثابت</title>
</head>
<body>
<div class="container">
  <?php 
  $this->load->view('nav');
  ?>
<div class="col-md-6" id="form">
<?php echo form_open_multipart('accounts/new_fix_asset',array('class' => 'form-horizontal')); ?>

  <div class="form-group">
    <label class="col-sm-4 control-label">سەردێر :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="title"  required>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">شوێنی بە کار هێنان:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="position"  required>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">بەرپرس:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="responsible"  required>
    </div>
  </div>
   <div class="form-group">
    <label  class="col-sm-4 control-label">بەرواری کڕین : </label>
    <div class="col-sm-8">
      <input class="form-control" type="date" name="purchase_date"  required>
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-4 control-label">جوری استهلاک : </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="depreciation_method"   required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">نرخی کڕین </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="asset_purchase_price"  required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">تەمەنی کەرەستە </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="asset_life"   required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">استهلاک کۆبووە </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="accumulated_depreciation"   required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">تێبینی </label>
    <div class="col-sm-8">
      <textarea name="description" class="form-control" rows="4"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button type="submit" class="btn btn-success col-sm-4">پاشکەوت کردن </button>
    </div>
  </div >
<?php echo form_close (); ?>
</div>
<div class="col-md-6" id="notify">
<?php 
      echo $this->session->flashdata('new_asset');
      echo $this->session->flashdata('update_asset');
 ?>
</div>
<div class="clearfix"></div><br>
<div class="col-md-12">
<table class="table table-hover table-striped" id="table">
<thead>
  <th>#</th>
  <th>سەردێر</th>
  <th>شوێن</th>
  <th>بەرپرس</th>
  <th>بەرواری کڕین</th>
  <th>کارگێری</th>
</thead>
<?php 
  $no=1;
  $res=$this->fix_assets_model->all();
  foreach ($res as $key) {
   ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $key->title; ?></td>
      <td><?php echo $key->position; ?></td>
      <td><?php echo $key->responsible; ?></td>
      <td><?php echo $key->purchase_date; ?></td>
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
      url:base_url + 'accounts/delete_fix_asset/' + delete_id ,
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
      edit_bank_id = $(this).attr('href');
    $.ajax({
      url:base_url + 'accounts/edit_fix_asset/' + edit_bank_id ,
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