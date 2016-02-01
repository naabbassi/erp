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
<?php echo form_open_multipart('file/new_user',array('class' => 'form-horizontal')); ?>

  <div class="form-group">
    <label class="col-sm-4 control-label">نێو :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="f_name" placeholder="نێوی یەکەم" required>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">نێو باب:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="m_name" placeholder="نێوی دووەم" required>
    </div>
  </div>
    <div class="form-group">
    <label class="col-sm-4 control-label">نێو باپیر:</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="l_name" placeholder="نێوی سێیەم" required>
    </div>
  </div>
   <div class="form-group">
    <label  class="col-sm-4 control-label">ژمارە تلفون	 : </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="phone"  placeholder="ژمارە تلفون  " required>
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-4 control-label">شوێن : </label>
    <div class="col-sm-8">
      <textarea name="address" class="form-control" rows="3"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">ئیمەیل </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="email" placeholder="ئیمەیل"  required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">کەفیل </label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="suporter" placeholder="کەفیل"  required>
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
<?php if(isset($message)) echo "<div class='alert alert-info'>".$message."</div>"; ?>
</div>
<div class="clearfix"></div><br>
<div class="col-md-12">
<table class="table table-hover table-striped" id="table">
<thead>
  <th>#</th>
  <th>نێوی بەکارهێنەر</th>
  <th>نێوی بەکارهێنەر</th>
  <th>شوێن</th>
  <th>کەفیل</th>
  <th>کارگێری</th>
</thead>
<?php
  $no=1;
  $res=$this->user_model->all();
  foreach ($res as $key) {
   ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $key->f_name.' '.$key->m_name.' '.$key->l_name; ?></td>
      <td><?php echo $key->username; ?></td>
      <td><?php echo $key->phone; ?></td>
      <td><?php echo $key->address; ?></td>
      <td><?php echo $key->email; ?></td>
      <td><a href="<?php echo $key->id; ?>" id="edit">گوڕانکاری</a> | <a href="<?php echo $key->id; ?>" id="delete">ڕەش کردنەوە</a></td>
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
      url:base_url + 'define/delete_customer/' + delete_id ,
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
      url:base_url + 'define/edit_customer/' + edit_bank_id ,
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
