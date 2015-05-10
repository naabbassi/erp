<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>پارە دان</title>
</head>
<body>
<div class="container">
  <?php 
  $this->load->view('nav');
  ?>
<div class="col-md-6" id="form">
<?php echo form_open('operation/new_payment',array('class' => 'form-horizontal')); ?>
  <div class="form-group">
      <label  class="col-sm-4 control-label">موشتەری :</label>
      <div class="col-sm-8">
        <select class="form-control" name='customer_id' id='customer' required>
          <option></option>
        <?php $customer=$this->customer_model->all();
            foreach ($customer as $item) { 
            echo "<option value='$item->id'>$item->f_name $item->m_name</option>"  ;
            }
         ?></select>
      </div>
  </div>
  <div class="form-group">
        <label  class="col-sm-4 control-label">فاکتور :</label>
        <div class="col-sm-8" id="invoice">
      </div>
      </div>
  <div class="form-group">
    <label  class="col-sm-4 control-label">شێواز :</label>
    <div class="col-sm-8">
      <select name="payment_type" class="form-control" required>
        <option value="نەقد - دەستی">نەقد - دەستی</option>
        <option value="نەقد - دەستی">نەقد - بانک</option>
        <option value="نەقد - چەک">نەقد - چەک</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">بڕی پارە :</label>
    <div class="col-sm-8">
      <input class="form-control" type="text" name="payment_amount" placeholder="بری پارە" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">رێکەوت :</label>
    <div class="col-sm-8">
      <input class="form-control" type="date" name="payment_date"  required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">تێبینی :</label>
    <div class="col-sm-8">
      <textarea name="payment_description" class="form-control" rows="4"></textarea>
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
<?php 
  echo $this->session->flashdata('update_payment');
  echo $this->session->flashdata('new_payment');
 ?>
</div>
<div class="clearfix"></div><br>
<div class="col-md-12">
<hr>
<table class="table table-hover table-striped" id="table">
<thead>
  <th>#</th>
  <th>ژمارە فروش</th>
  <th>موشتەری</th>
  <th>رێکەوت</th>
  <th>بری پارە</th>
  <th>کارگێری</th>
</thead>
<?php 
  $no=1;
  $res=$this->payment_model->all();
  foreach ($res as $key) {
    $customer=$this->customer_model->findbyid($key->customer_id);
   ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $key->sale_id; ?></td>
      <?php echo "<td> $customer->f_name $customer->m_name $customer->l_name</td>"; ?>
      <td><?php echo $key->date_time; ?></td>
      <td><?php echo number_format($key->amount,2); ?></td>
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

  $("body").on('change', '#customer' ,function(){
      $.ajax({
        url:base_url + 'operation/load_invoice_list/' + $(this).val(),
        success:function(data){
          $('#invoice').html(data);
        },
        error:function(data){
          $('#invoice').html(data);
        }
      });
      });

    $('#table').on('click','#delete',function(e) {
      var object = $(this);
    if (confirm('ئایا دڵنیای لە ڕەش کردنەوە ؟')) {
      delete_id = $(this).attr('href');
    $.ajax({
      url:base_url + 'operation/delete_payment/' + delete_id ,
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
      url:base_url + 'operation/edit_payment/' + edit_id ,
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