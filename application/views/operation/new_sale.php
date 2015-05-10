<html>
<head>
	<title>فرۆش</title>
</head>
<body>
<div class="container">
	<?php 
	$this->load->view('nav');
		?>
<div class="col-md-12" id="invoice_content">
  <!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="invoice_tab">
  <li class="active"><a href="#items" role="tab" data-toggle="tab">ناوەڕۆک</a></li>
  <li ><a href="#payment" role="tab" data-toggle="tab">پارە دان</a></li>
  <li ><a href="#details" role="tab" data-toggle="tab">وڕدەکاری</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content" >

<!-- Details Tab Content -->
  <div class="tab-pane" id="details">
  	<br>
    <div class="col-md-6"> 
     <?php echo form_open('operation/sale_invoice',array('class'=>'form-horizontal')) ?>
      <div class="form-group">
        <label  class="col-sm-4 control-label">موشتەری :</label>
        <div class="col-sm-8">
          <select class="form-control" name='customer_id'  required>
            <option></option>
          <?php $customer=$this->customer_model->all();
              foreach ($customer as $item) { 
              echo "<option value='$item->id'>$item->f_name"." $item->m_name"." $item->l_name</option>"  ;
              }
           ?></select>
      </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">سەردێر :</label>
        <div class="col-sm-8">
          <input type="text" class="form-control"  name="title" required>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">داشکاندن :</label>
        <div class="col-sm-8">
          <input type="text" class="form-control"  name="discount" required>
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
          &nbsp;&nbsp;&nbsp;<a href="#" id="details_prev" class="btn btn-danger "><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> بگەرێوە هەنگاوی ٢</a>
        </div>
      </div>
    <?php echo form_close(); ?>
    </div>
  </div>

  <!-- Payment Tab Content -->
  <div class="tab-pane" id="payment">
    <br>
    <div class="col-md-6"> 
     <?php echo form_open('operation/ajax_payment',array('class'=>'form-horizontal','id'=>'payment_form')) ?>
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
        <label  class="col-sm-4 control-label">بڕی پارە :</label>
        <div class="col-sm-8">
          <input type="number" class="form-control"  name="payment_amount" required>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">رێکەوت :</label>
        <div class="col-sm-8">
          <input type="date" class="form-control"  name="payment_date" data-date-format="YYYY-MM-DD" required>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">تێبینی :</label>
        <div class="col-sm-8">
          <textarea name="payment_description" class="form-control" rows="3"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-md-10">
          <button type="submit" class="btn btn-success">پاشەکەوت کردن <span class="glyphicon glyphicon-floppy-open" aria-hidden="true"></span></button>
          &nbsp;&nbsp;&nbsp;<a href="#" id="payment_prev" class="btn btn-danger "><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>بگەرێوە</a>
          &nbsp;&nbsp;&nbsp;<a href="#" id="payment_next" class="btn btn-info ">هەنگاوی ٣ <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
        </div>
      </div>
    <?php echo form_close(); ?>
    </div>
    <div class="col-md-5" id="payment_table">
      <?php $this->load->view('operation/payment_table'); ?>
    </div>
  </div>

<!-- Items Tab Content -->
  <div class="tab-pane active" id="items"><br>
  <div class="col-md-6" id="invoice_items_form" >
<form class="form-horizontal" id="new_item" action="operation/new_item" method="post">
    <div class="form-group">
        <label  class="col-sm-4 control-label">کۆگا :</label>
        <div class="col-sm-8">
          <select class="form-control" name='storage_id' required>
            <option></option>
          <?php $storage=$this->storage_model->all();
              foreach ($storage as $item) { 
              echo "<option value='$item->id'>$item->title</option>"  ;
              }
           ?></select>
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-4 control-label">گرۆپی کاڵاکان :</label>
        <div class="col-sm-8">
          <select class="form-control" name='cat_id' id="cat" required>
            <option></option>
          <?php $product=$this->cat_model->all();
              foreach ($product as $item) { 
              echo "<option value='$item->id'>$item->title</option>"  ;
              }
           ?></select>
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-4 control-label">یەکە :</label>
        <div class="col-sm-8" id="product_loader">
        <select class="form-control" required></select>
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-4 control-label">یەکە :</label>
        <div class="col-sm-8" id="unit_loader">
        <select class="form-control" required></select>
        </div>
    </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">هەژمار :</label>
    <div class="col-sm-8">
      <input type="number" class="form-control" name="quantity" id="quantity" placeholder="١،٢،٣ کارتۆن یان تەک" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-4 control-label">نرخی یەکە :</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="price" id="price" placeholder="نرخی یەکە" required>
    </div>
  </div>
   <div class="form-group">
    <label class="col-sm-4 control-label" >کۆی گشتی :</label>
    <div class="input-group col-sm-offset-4 col-sm-8">
      <input type="text" class="form-control" name="total" id="total" disabled>
      <div class="input-group-addon">$</div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-md-12">
      <button type="submit" class="btn btn-success ">زیاد بکە <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
      &nbsp;&nbsp;&nbsp;<a href="#" id="items_next" class="btn btn-danger ">هەنگاوی دووەم <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="#" id="refresh" class="btn btn-info ">وەرگرتنی ناوەڕۆک <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
    </div>
  </div>
</form>
</div>
  </div>
</div>
</div>
<br><br><br><br>
<div class="col-md-4"><?php if(isset($message)) echo $message; ?></div>
<div class="clearfix"></div><br>
<h3 class="text-center text-info">.: ناوەڕۆک :.</h3><hr>
<div class="col-md-12" id="items_table">
	<?php $this->load->view('operation/cart_items_table'); ?>
</div>


</div>
<script type="text/javascript">
	$(document).ready(function(){
    var base_url='<?php echo base_url(); ?>'+'index.php/';

     $('#quantity , #price').on('change',function(){
      var quantity =$('#quantity').val();
      var price =$('#price').val();
      $('#total').val((quantity * price));
     });
      $("body").on('change', '#cat' ,function(){
      $.ajax({
        url:base_url + 'operation/load_product/' + $(this).val(),
        success:function(data){
          $('#product_loader').html(data);
          $('#unit_loader').load(base_url + 'operation/load_units/0');
        },
        error:function(data){
          $('#product_loader').html(data);
        }
      });
      });
     $("body").on('change', '#product' ,function(){
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
    $('#new_item').on('submit',function(e) {
		action=$(this).attr("action");
		$.ajax({
		url:base_url + action,
		data:$(this).serialize(),
		type:'POST',
		success:function(data){
		$('#items_table').load(base_url + 'operation/items_table');
		},
		error:function(data){
		}
		});
		e.preventDefault(); 
    });

    $('#payment_form').on('submit',function(e) {
    action=$(this).attr("action");
    $.ajax({
    url: action,
    data:$(this).serialize(),
    type:'POST',
    success:function(data){
    $('#payment_table').load(base_url + 'operation/load_ajax_payment_table');
    },
    error:function(data){
    }
    });
    e.preventDefault(); 
    });

    $('#refresh').click(function(e){
    	$('#items_table').load(base_url + 'operation/items_table');
    	e.preventDefault();
    });
    $('#items_next').click(function(e) {
        $('#invoice_tab a[href="#payment"]').tab('show')
        e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
      });
    $('#payment_prev').click(function(e) {
        $('#invoice_tab a[href="#items"]').tab('show')
        e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
      });
    $('#payment_next').click(function(e) {
        $('#invoice_tab a[href="#details"]').tab('show')
        e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
      });
    $('#details_prev').click(function(e) {
        $('#invoice_tab a[href="#payment"]').tab('show')
        e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
      });
    $('body').on('click','#delete',function(e){
    	id=$(this).attr("href");
    	if (confirm('ئایا دڵنیای لە ڕەش کردنەوە ؟')) {
		$.ajax({
			url:base_url + 'operation/delete_table_item/'+id,
			data:$(this).serialize(),
			type:'POST',
			success:function(data){
				console.log(data);
				$('#items_table').load(base_url + 'operation/items_table');
			},
			error:function(data){
				console.log(data);
			}	
		}); 
	}
		e.preventDefault();
    });
     $('body').on('click','#payment_delete',function(e){
        if (confirm('ئایا دڵنیای لە ڕەش کردنەوە ؟')) {
      $.ajax({
        url:base_url + 'operation/ajax_payment_delete/',
        data:$(this).serialize(),
        type:'POST',
        success:function(data){
          console.log(data);
          $('#payment_table').load(base_url + 'operation/load_ajax_payment_table');
        },
        error:function(data){
          console.log(data);
        } 
      }); 
    }
    e.preventDefault();
    });
	});
</script>
</body>
</html>