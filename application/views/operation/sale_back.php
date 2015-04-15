<html>
<head>
	<title>گەرانەوە لە فرۆش</title>
</head>
<body>
<div class="container">
	<?php 
	$this->load->view('nav');
		?>
    <h3 class="text-center text-info">گەرانەوەی فروش</h3><hr>
<div class="col-md-7" id="invoice_content">
    <div class="col-md-12"> 

     <?php echo form_open('operation/sale_back_save',array('class'=>'form-horizontal','id'=>'sales')) ?>
      <div class="form-group">
        <label  class="col-sm-4 control-label">موشتەری :</label>
        <div class="col-sm-8">
          <select class="form-control" name='customer_id' id='customer'  required>
            <option></option>
          <?php $customer=$this->customer_model->all();
              foreach ($customer as $item) { 
              echo "<option value='$item->id'>$item->f_name"." $item->m_name"." $item->l_name</option>"  ;
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
        <label  class="col-sm-4 control-label">کاڵا :</label>
        <div class="col-sm-8" id="invoice_products">
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">یەکە :</label>
        <div class="col-sm-8" id="unit_loader">
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">هەژمار :</label>
        <div class="col-sm-8">
          <input type="number" class="form-control"  name="title" required>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">رێکەوت :</label>
        <div class="col-sm-8">
          <input type="date" class="form-control"  data-date-format="YYYY-MM-DD"  name="date_time" required>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">تێبینی:</label>
        <div class="col-sm-8">
          <textarea class="form-control" name="description" rows="5"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-md-10">
          <button type="submit" class="btn btn-success">پاشەکەوت کردن <span class="glyphicon glyphicon-floppy-open" aria-hidden="true"></span></button>
         
        </div>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>
<div class="col-md-5"><?php if(isset($message)) echo $message; ?></div>
<div class="clearfix"></div>
<hr><h3 class="text-center text-warning">ریزی گەرانەوە لە فروشەکان</h3><hr>
<div class="col-md-12">
  <table class="table">
    <thead>
      <th>فاکتور</th>
      <th>موشتەری</th>
      <th>رێکەوت</th>
    </thead>
    <?php
    $sale_back=$this->sale_back_model->all();
    foreach ($sale_back as $item) { ?>
      <tr>
        <td><?php echo $item->sale_id; ?></td>
        <td><?php echo $item->product_id; ?></td>
        <td><?php echo $item->date_time; ?></td>

      </tr>
    <?php } ?>
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
          $('#invoice_products').html('');
          $('#unit_loader').html('');
        },
        error:function(data){
          $('#invoice').html(data);
          $('#invoice_products').html('');
          $('#unit_loader').html('');
        }
      });
      });
     $("body").on('change', '#invoice_list' ,function(){
      $.ajax({
        url:base_url + 'operation/load_invoice_products/' + $(this).val(),
        success:function(data){
          $('#invoice_products').html(data);
          $('#unit_loader').html('');
        },
        error:function(data){
          $('#invoice_products').html(data);
          $('#unit_loader').html('');
        }
      });
      });
     $("body").on('change', '#product_id' ,function(){
      $.ajax({
        url:base_url + 'operation/load_units/' + $(this).val(),
        success:function(data){
          $('#unit_loader').html(data);
        },
        error:function(data){
          $('#unit_loader').html(data);
        }
      });
      });
	});
</script>
</body>
</html>