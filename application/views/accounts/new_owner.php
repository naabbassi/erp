<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>موشتەرێکان</title>
</head>
<body>
<div class="container">
  <?php 
  $this->load->view('nav');
  ?>
<div class="col-md-6" id="form">
<?php echo form_open_multipart('accounts/new_stock_holder',array('class' => 'form-horizontal')); ?>

  <div class="form-group">
    <label class="col-sm-4 control-label">سەردێر :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="title"  required>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">نێو:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="name"  required>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">پاش ناو:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="family"  required>
    </div>
  </div>
   <div class="form-group">
    <label  class="col-sm-4 control-label">ژمارە تلفون : </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="phone"  required>
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-4 control-label">رادەی بەشداربون : </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="equity_percent"   required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">شوێن </label>
    <div class="col-sm-8">
      <textarea name="address" class="form-control" rows="4"></textarea>
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
      echo $this->session->flashdata('new_owner');
      echo $this->session->flashdata('update_owner');
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
  $res=$this->owners_model->all();
  foreach ($res as $key) {
   ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $key->title; ?></td>
      <td><?php echo $key->name; ?></td>
      <td><?php echo $key->family; ?></td>
      <td><?php echo $key->phone; ?></td>
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
      url:base_url + 'accounts/delete_stock_holder/' + delete_id ,
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
      url:base_url + 'accounts/edit_stock_holder/' + edit_id,
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