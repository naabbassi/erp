<?php
	if ($this->uri->segment(3)) {
		$sale=$this->sale_model->findbyid($this->uri->segment(3));
	}
 ?>
<html>
<head>
	<title>گورانکاری فرۆش</title>
</head>
<body>
<div class="container" id="container">
	<?php 
	$this->load->view('nav');
		?>
		<h3 class="text-center text-info">گورانکاری فاکتوری فروش</h3>
<div class="col-md-12">
  <!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="invoice_tab">
  <li class="active"><a href="#items" role="tab" data-toggle="tab">ناوەڕۆک</a></li>
  <li ><a href="#details" role="tab" data-toggle="tab">وڕدەکاری</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content" >

<!-- Details Tab Content -->
  <div class="tab-pane" id="details">
  	<br>
    <div class="col-md-6 disable"> 
     <?php echo form_open('operation/update_sale_detail/'.$sale->id,array('class'=>'form-horizontal','id'=>'sale_detail')) ?>
      <div class="form-group">
        <label  class="col-sm-4 control-label">موشتەری :</label>
        <div class="col-sm-8">
          <select class="form-control" name='customer_id'  required>
            <option></option>
          <?php $customer=$this->customer_model->all();
              foreach ($customer as $item) { 
              	if ($item->id == $sale->customer_id) {$selected="selected";}else{$selected="";}
              echo "<option value='$item->id' $selected>$item->f_name"." $item->m_name"." $item->l_name</option>"  ;
              }
           ?></select>
      </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">سەردێر :</label>
        <div class="col-sm-8">
          <input type="text" class="form-control"  name="title" value="<?php echo $sale->title ?>" required>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">داشکاندن :</label>
        <div class="col-sm-8">
          <input type="text" class="form-control"  name="discount" value="<?php echo $sale->discount ?>" required>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">رێکەوت :</label>
        <div class="col-sm-8">
          <input type="date" class="form-control"  data-date-format="YYYY-MM-DD"  name="date_time" value="<?php echo $sale->date_time ?>" required>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">تێبینی:</label>
        <div class="col-sm-8">
          <textarea class="form-control" name="description" rows="5"><?php echo $sale->description ?></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-md-10">
          <button type="submit" class="btn btn-success">پاشەکەوت کردن <span class="glyphicon glyphicon-floppy-open" aria-hidden="true"></span></button>
        </div>
      </div>
    <?php echo form_close(); ?>
    </div>
    <div class="col-md-5" id="detail_notify"></div>
  </div>

<!-- Items Tab Content -->
  <div class="tab-pane active" id="items"><br>
  <div class="col-md-12" id="invoice_items_form" >
  <a href="<?php echo $sale->id ?>" id="new_item" class="btn btn-primary" >زیادکردن <span class="glyphicon glyphicon-plus" aria-hidden="true" ></span></a>
  <div class="col-md-5" id="item_notify"></div>
  <br><br>
  <table class="table table-striped table-condensed table-hover" id="table">
	<thead>
		<th>#</th>
		<th>کۆگا</th>
		<th>بەرهەم</th>
		<th>هەژمار</th>
		<th>یەکە</th>
		<th>نرخ</th>
		<th>نرخی گشتی</th>
		<th>کارگێری  <a href="<?php echo $sale->id ?>" id="new" class="btn btn-danger" >نوێ کردنەوە <span class="glyphicon glyphicon-refresh" aria-hidden="true" ></span></a></th>
	</thead>

		<?php $no=1;
		$total=0;
		$sale_items=$this->sale_details_model->select(array('sale_id'=>$sale->id));
				foreach ($sale_items as $items) {
					echo "<tr>";
					$storage=$this->storage_model->findbyid($items->storage_id);
					$product=$this->product_model->findbyid($items->product_id);
					$unit=$this->unit_model->findbyid($items->unit_id);
					$sub_total=$items->quantity * $items->price;
					echo "<td class='text-info'>$no</td>";
					echo "<td class='text-primary'>$storage->title</td>";
					echo "<td class='text-primary'>$product->title</td>";
					echo "<td class='text-warning'>$items->quantity</td>";
					echo "<td class='text-info'>$unit->title</td>";
					echo "<td class='text-danger'>$items->price $</td>";
					echo "<td class='text-success'>$sub_total $</td>";
					echo "<td><a href='$items->id' id='delete'>ڕەش کردنەوە</a> | <a href='$items->id' id='edit_item'>گورانکاری</a>";
					echo "</tr>";
					$no++;
					$total=$total+$sub_total;
				}
		 ?>
	</tr>
	<tr class="success">
		<td colspan="5" class="text-center">کوی گشتی :</td>
		<td><?php echo number_format($total); ?> $</td>
		<td class="text-info"><?php echo $this->cart->total(); ?> $</td>
	</tr>
</table>
</div>
</div>
</div>
</div>
<!-- sub Edit -->
		<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">داخستن</span></button>
		        <h4 class="modal-title text-center" id="myModalLabel">گورانکاری ناوەروک</h4>
		      </div>
		      <div class="modal-body" id="update_sub">
		    </div>
		  </div>
		</div>
		</div>

		<!-- sub Edit -->
		<div class="modal fade" id="new_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">داخستن</span></button>
		        <h4 class="modal-title text-center" id="myModalLabel">زیاد کردنی ئاتێمی نوێ	</h4>
		      </div>
		      <div class="modal-body" id="new_content">
		    </div>
		  </div>
		</div>
		</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
  	 base_url='<?= base_url(); ?>'+'index.php/';
   $('#sale_detail').on('submit',function(e) {
   	  
   	  $('#sale_detail button').addClass('disabled');
      $('#sale_detail button').text('ناردن ...');
      $.ajax({
      url:$(this).attr("action"),
      data:$(this).serialize(),
      type:'POST',
      success:function(data){
	      console.log(data);
	      $('#sale_detail button').removeClass('disabled');
          $('#sale_detail button').text('پاشەکەوت کردن');
	      $('#detail_notify').html(data).show().fadeOut(5000);
      },
      error:function(data){
          console.log(data);
          $('#sale_detail button').removeClass('disabled');
          $('#sale_detail button').text('پاشەکەوت کردن');
          $('#detail_notify').html(data).show().fadeOut(5000);
      }
      });
      e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });
   //submit item edit form
    $('body').on('submit','#update_sale_item',function(e) {
   	  
   	  $('#update_sale_item button').addClass('disabled');
      $('#update_sale_item button').text('ناردن ...');
      $.ajax({
      url:$(this).attr("action"),
      data:$(this).serialize(),
      type:'POST',
      success:function(data){
      	console.log(data);
	      $('#item_notify').html(data).show().fadeOut(5000);
          $('#edit_modal').modal("hide");
      },
      error:function(data){
          $('#edit_modal').modal("hide");
          $('#update_sale_item button').removeClass('disabled');
          $('#update_sale_item button').removeClass('btn-danger');
      	  $('#update_sale_item button').text('ئەنجامەکە سەرکەوتو نەبۆ');
      }
      });
      e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });

$('#items').on('click','#new_item',function(e){
			sub_edit_id=$(this).attr('href');
			$('#new_content').load(base_url + 'operation/new_sale_detail/' + sub_edit_id);
			$('#new_modal').modal("show");
			e.preventDefault();
  });  

   $('#table').on('click','#edit_item',function(e){
			edit_id=$(this).attr('href');
			$('#update_sub').load(base_url + 'operation/edit_sale_detail/' + edit_id);
			$('#edit_modal').modal("show");
			e.preventDefault();
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

    $('#table').on('click','#delete',function(e) {
      var object = $(this);
    if (confirm('ئایا دڵنیای لە ڕەش کردنەوە ؟')) {
      delete_id = $(this).attr('href');
    $.ajax({
      url:base_url + 'operation/delete_sale_item/' + delete_id ,
      type:'POST',
    success:function(data){
      console.log(data);
      $('#item_notify').html(data).show();
      var td=object.parent();
      var tr=td.parent();
      tr.fadeOut(2000).remove();
      },
    error:function(data){
      console.log(data);
      $('#item_notify').html(data).show().fadeOut(5000);
      }
    }); }
    e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });
   });
</script>
</body>
</html>