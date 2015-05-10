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
    <div class="col-md-12" id="form"> 

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
          <input type="number" class="form-control"  name="quantity" required>
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
<div class="col-md-5" id="notify"><?php if(isset($message)) echo $message; ?></div>
<div class="clearfix"></div>
<hr><h3 class="text-center text-warning">ریزی گەرانەوە لە فروشەکان</h3><hr>
<div class="col-md-12">
  <table class="table" id="table">
    <thead>
      <th>فاکتور</th>
      <th>موشتەری</th>
      <th>کالا</th>
      <th>هەژمار</th>
      <th>یەکە</th>
      <th>رێکەوت</th>
      <th>کارگێری</th>
    </thead>
    <?php
    $sale_back=$this->sale_back_model->all();
    foreach ($sale_back as $item) { 
      $sale=$this->sale_model->findbyid($item->sale_id);
      $customer=$this->customer_model->findbyid($sale->customer_id);
      $product=$this->product_model->findbyid($item->product_id);
      $unit=$this->unit_model->select_row(array('id'=>$item->unit_id,'product_id'=>$item->product_id));
      ?>
      <tr>
        <?php echo "<td>$sale->id - $sale->date_time</td>"; ?>
        <?php echo "<td>$customer->f_name $customer->m_name $customer->l_name</td>"; ?>
        <td><?php echo $product->title; ?></td>
        <td><?php echo $item->quantity; ?></td>
        <td><?php echo $unit->title; ?></td>
        <td><?php echo $item->date_time; ?></td>
         <td><a href="<?php echo $item->id; ?>" id="edit">گوڕانکاری</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $item->id; ?>" id="delete">ڕەش کردنەوە</a></td>
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
     $('#table').on('click','#delete',function(e) {
      var object = $(this);
    if (confirm('ئایا دڵنیای لە ڕەش کردنەوە ؟')) {
      delete_id = $(this).attr('href');
    $.ajax({
      url:base_url + 'operation/delete_sale_back/' + delete_id ,
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
      url:base_url + 'operation/edit_sale_back/' + edit_id ,
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