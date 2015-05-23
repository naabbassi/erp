<?php
	if ($this->uri->segment(3)) {
		$record=$this->accounting_record_model->findbyid($this->uri->segment(3));
	}
 ?>
<html>
<head>
	<title>گورانکاری بەڵگەی ژمێریاری</title>
</head>
<body>
<div class="container" id="container">
	<?php 
	$this->load->view('nav');
		?>
		<h3 class="text-center text-info">گورانکاری بەڵگەی ژمێریاری</h3>
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
     <?php echo form_open('accounting/update_record_details/'.$record->id,array('class'=>'form-horizontal','id'=>'record_details')) ?>
      <div class="form-group">
        <label  class="col-sm-4 control-label">سەردێر :</label>
        <div class="col-sm-8">
          <input type="text" class="form-control"  name="title" value="<?php echo $record->title ?>" required>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">رێکەوت :</label>
        <div class="col-sm-8">
          <input type="date" class="form-control"  data-date-format="YYYY-MM-DD"  name="record_date" value="<?php echo $record->record_date ?>" required>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">تێبینی:</label>
        <div class="col-sm-8">
          <textarea class="form-control" name="description" rows="5"><?php echo $record->description ?></textarea>
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
  <a href="<?php echo $record->id ?>" id="new_item" class="btn btn-primary" >زیادکردن <span class="glyphicon glyphicon-plus" aria-hidden="true" ></span></a>
  <div class="col-sm" id="item_notify"></div>
  <br><br>
  <table class="table table-bordered table-hover table-striped" id="table">
  <thead>
    <th class="text-center">No</th>
    <th class="text-center">شروڤە</th>
    <th class="text-center">گروپ</th>
    <th class="text-center">هەژمار سەرەکی</th>
    <th class="text-center">ژێر هەژمار</th>
    <th class="text-center">وردە هەژمار</th>
    <th class="text-center">Debit</th>
    <th class="text-center">Credit</th>
  </thead>
  <?php
  $no = 1;
  $debit = 0;
  $credit = 0;
  $record_items=$this->accounting_record_items_model->select(array('record_id'=>$record->id));
  foreach ($record_items as $key) {
    $group=$this->group_accounts_model->findbyid($key->group_id);
    $ledger=$this->ledger_accounts_model->findbyid($key->ledger_id);
    $sub=$this->sub_accounts_model->findbyid($key->sub_id);
    echo "<tr>";
    echo "<td class='text-center'>".$key->id."</td>";
    echo "<td class='text-center'>".$key->title."</td>";
    echo "<td class='text-center'>".$group->title."</td>";
    echo "<td class='text-center'>".$ledger->title."</td>";
    echo "<td class='text-center'>".$sub->title."</td>";
    echo "<td class='text-center'>". $this->details->get_title($key->sub_id,$key->detail_id)."</td>";
    echo "<td class='text-center text-primary'>".number_format($key->debit,2)." $</td>";
    echo "<td class='text-center text-success'>".number_format($key->credit,2)." $</td>";
    echo "<td class='text-center text-success'><a href=$key->id id='delete_item'><span class='glyphicon glyphicon-remove'></span></a> | <a href='$key->id' id='edit_item'><span class='glyphicon glyphicon-edit'></span></a></td>";
    echo "<tr>";
    $no++;
    $debit=$debit + $key->debit;
    $credit=$credit + $key->credit;
   }
  ?>
  <tr>
    <td colspan="6" class="text-center text-danger danger">کۆ  :</td>
    <td class="text-info text-center info"><?php echo number_format($debit,2); ?> $</td>
    <td class="text-success text-center success"><?php echo number_format($credit,2); ?> $</td>
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

		<!-- New Modal -->
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
   $('#record_details').on('submit',function(e) {
   	  
   	  $('#record_details button').addClass('disabled');
      $('#record_details button').text('ناردن ...');
      $.ajax({
      url:$(this).attr("action"),
      data:$(this).serialize(),
      type:'POST',
      success:function(data){
	      console.log(data);
	      $('#record_details button').removeClass('disabled');
          $('#record_details button').text('پاشەکەوت کردن');
	      $('#detail_notify').html(data).show().fadeOut(5000);
      },
      error:function(data){
          console.log(data);
          $('#record_details button').removeClass('disabled');
          $('#record_details button').text('پاشەکەوت کردن');
          $('#detail_notify').html(data).show().fadeOut(5000);
      }
      });
      e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });
   //submit item edit form
    $('body').on('submit','#edit_record_item_form',function(e) {
   	  
   	  $('#edit_record_item_form button').addClass('disabled');
      $('#edit_record_item_form button').text('ناردن ...');
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
          $('#edit_record_item_form button').removeClass('disabled');
          $('#edit_record_item_form button').removeClass('btn-danger');
      	  $('#edit_record_item_form button').text('ئەنجامەکە سەرکەوتو نەبۆ');
      }
      });
      e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });
// insert new item
$('body').on('submit','#new_record_item_form',function(e) {
      
      $('#new_record_item_form button').addClass('disabled');
      $('#new_record_item_form button').text('ناردن ...');
      $.ajax({
      url:$(this).attr("action"),
      data:$(this).serialize(),
      type:'POST',
      success:function(data){
        console.log(data);
        $('#item_notify').html(data).show().fadeOut(5000);
          $('#new_modal').modal("hide");
      },
      error:function(data){
          $('#new_modal').modal("hide");
          $('#new_record_item_form button').removeClass('disabled');
          $('#new_record_item_form button').removeClass('btn-danger');
          $('#new_record_item_form button').text('ئەنجامەکە سەرکەوتو نەبۆ');
      }
      });
      e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });
$('#items').on('click','#new_item',function(e){
			edit_id=$(this).attr('href');
			$('#new_content').load(base_url + 'accounting/new_record_item/' + edit_id );
			$('#new_modal').modal("show");
			e.preventDefault();
  });  

   $('#table').on('click','#edit_item',function(e){
			edit_id=$(this).attr('href');
			$('#update_sub').load(base_url + 'accounting/edit_record_details/' + edit_id);
			$('#edit_modal').modal("show");
			e.preventDefault();
  });
  $("#edit_modal").on('change', '#cat' ,function(){
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
  $("#edit_modal").on('change', '#product' ,function(){
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
  $("#new_modal").on('change', '#cat' ,function(){
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
  $("#new_modal").on('change', '#product' ,function(){
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
    $("#update_sub").on('change','#group_accounts',function(){
      $.ajax({
        url:base_url + 'accounting/ajax_ledger_load/' + $(this).val(),
        success:function(data){
          $('#ledger_accounts').html(data);
          $('#sub_accounts').html('');
          $('#detail_accounts').html('');
        },
        error:function(data){
          $('#ledger_accounts').html(data);
        }
      });
     });

  $("#update_sub").on('change','#ledger_accounts',function(){
      $.ajax({
        url:base_url + 'accounting/ajax_sub_load/' + $(this).val(),
        success:function(data){
          $('#sub_accounts').html(data);
          $('#detail_accounts').html('');
        },
        error:function(data){
          $('#sub_accounts').html(data);
        }
      });
     });
  $("#update_sub").on('change',"#sub_accounts",function(){
      $.ajax({
        url:base_url + 'accounting/ajax_detail_load/' + $(this).val(),
        success:function(data){
          $('#detail_accounts').html(data);
        },
        error:function(data){
          $('#detail_accounts').html(data);
        }
      });
     });

   $("#new_content").on('change','#group_accounts',function(){
      $.ajax({
        url:base_url + 'accounting/ajax_ledger_load/' + $(this).val(),
        success:function(data){
          $('#ledger_accounts').html(data);
          $('#sub_accounts').html('');
          $('#detail_accounts').html('');
        },
        error:function(data){
          $('#ledger_accounts').html(data);
        }
      });
     });

  $("#new_content").on('change','#ledger_accounts',function(){
      $.ajax({
        url:base_url + 'accounting/ajax_sub_load/' + $(this).val(),
        success:function(data){
          $('#sub_accounts').html(data);
          $('#detail_accounts').html('');
        },
        error:function(data){
          $('#sub_accounts').html(data);
        }
      });
     });
  $("#new_content").on('change',"#sub_accounts",function(){
      $.ajax({
        url:base_url + 'accounting/ajax_detail_load/' + $(this).val(),
        success:function(data){
          $('#detail_accounts').html(data);
        },
        error:function(data){
          $('#detail_accounts').html(data);
        }
      });
     });
   });
</script>
</body>
</html>