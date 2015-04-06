<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>گرۆپی کاڵاکان</title>
</head>
<body>
<div class="container">
  <?php 
  $this->load->view('nav');
  ?>
<div class="col-md-6" id="form">
<?php echo form_open('define/new_cat',array('class' => 'form-horizontal')); ?>
  <div class="form-group">
    <label class="col-sm-4 control-label">سەردێری گرۆپ :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="title" placeholder="نێوی گرۆپ" required>
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
<table class="table table-hover table-striped" id="table">
<thead>
  <th>#</th>
  <th>نێوی گرۆپ</th>
  <th>کارگێری</th>
</thead>
<?php 
  $no=1;
  $res=$this->cat_model->all();
  foreach ($res as $key) {
   ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $key->title; ?></td>
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
      url:base_url + 'define/delete_cat/' + delete_id ,
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
      url:base_url + 'define/edit_cat/' + edit_bank_id ,
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