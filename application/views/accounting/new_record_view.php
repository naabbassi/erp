<html>
<head>
	<title>تومار کردنی بەڵگەی ژمێریاری</title>
</head>
<body>
<div class="container">
	<?php
		$this->load->view('nav');
	?>
	<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="record_tab">
  <li class="active"><a href="#items" role="tab" data-toggle="tab">زیاد کردن</a></li>
  <li><a href="#record" role="tab" data-toggle="tab">وردە کاری</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="items">
  	<form role="form" class="form-horizontal" id="record_item_form" action="accounting/submit_record_items">
  		<div class="col-md-12">
  		<div class="col-md-6">
			  <div class="form-group">
			    <label class="col-sm-4 control-label">گروپی هەژمار :</label>
			    <div class="col-sm-8">
				    <select name="group_id" class="form-control" id="group_accounts" required>
				    	<option></option>
				    	<?php
				    	$res=$this->group_accounts_model->all();
				    	foreach ($res as $key) {
				    		echo "<option value='".$key->id."'>".$key->title."</option>";
				    	}
				    	?>
				    </select>
				</div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-4 control-label">هەژماری سەرەکی :</label>
			    <div class="col-sm-8">
				    <select name="ledger_id" class="form-control" id="ledger_accounts" required>
				    	<option></option>
				    </select>
				</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">ژێر هەژمارە :</label>
			    <div class="col-sm-8">
				    <select name="sub_id" class="form-control" id="sub_accounts" required>
				    	<option ></option>
				    </select>
				</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">هەژماری ورد :</label>
			    <div class="col-sm-8" id="detail_accounts">

				</div>
			  </div>
		</div>
		<div class="col-md-6">
			  <div class="form-group">
				  	<label class="col-sm-3 control-label">سەردێر :</label>
			  	<div class="col-sm-9">
				  	<input class="form-control" name="title" type="text">
			  	</div>
			  </div>
			  <div class="form-group">
				  	<label class="col-sm-3 control-label">بەروار :</label>
			  	<div class="col-sm-9">
				  	<input class="form-control" name="item_date" type="date" required>
			  	</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-3 control-label">قەرزدار</label>
			    <div class="col-sm-9">
				    <div class="input-group">
				      <input class="form-control" type="text" id="debit" name="debit" placeholder="Debit Amount" required>
				      <div class="input-group-addon">دینار</div>
					</div>
				</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-3 control-label">قەرز دێر</label>
			    <div class="col-sm-9">
				    <div class="input-group">
				      <input class="form-control" type="text" id="credit" name="credit" placeholder="Credit Amount" required>
				      <div class="input-group-addon">دینار</div>
					</div>
				</div>
			  </div>
		</div><div class="clearfix"></div><br>
	        <div class="form-group">
        <div class="col-sm-offset-1 col-sm-5">
          <button type="submit" id="cost_form_submit" class="btn btn-primary">زیاد بکە</button>&nbsp;&nbsp;
          <a href="#" class="btn btn-success" id="next">برو هەنگاوی دووەم</a>&nbsp;&nbsp;
          <a href="#" class="btn btn-info" id="refresh">وەرگرتن</a>
        </div>
      </div>
	  </div>
	</form>
	<div class="col-md-12" id="table_loader"></div>
  </div>
  <div class="tab-pane" id="record">
  	<?php echo form_open('accounting/submit_record',array('class'=>'form-horizontal','id'=>'record_form')); ?>
	  	<div class="col-md-6">
			<div class="form-group">
				<label class="col-sm-3 control-label">سەردێر :</label>
				<div class="col-sm-9">
					<input class="form-control" name="title" type="text" placeholder="Title for Accounting Document" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">بەروار :</label>
				<div class="col-sm-9">
					<input class="form-control" name="record_date" type="date" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">شرۆڤە :</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="description"></textarea>
				</div>
			</div>
			 <div class="col-sm-offset-3 col-sm-5">
	          <button type="submit"  class="btn btn-primary">پاشکەوت کردن</button>
	        </div>
  		<?php echo form_close() ?>
		</div>
		<div class="col-md-6" id="notification"></div>
  </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var base_url='<?php echo base_url(); ?>'+'index.php/';

	$("#table_loader").on('click','#delete_items',function(e){
		$('#table_loader').load(base_url+ 'accounting/delete_record_items');
		e.preventDefault();
	});
	$("#table_loader").on('click','#delete_item',function(e){
		$('#table_loader').load(base_url+ 'accounting/delete_record_item/'+ $(this).attr('href'));
		e.preventDefault();
	});
	$("#debit").on('change',function(e){
		$('#credit').val('0');
		e.preventDefault();
	});
	$("#credit").on('change',function(e){
		$('#debit').val('0');
		e.preventDefault();
	});
	$('#next').click(function(e) {
        $('#record_tab a[href="#record"]').tab('show')
        e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });
	$('#refresh').click(function(e) {
		$('#table_loader').load(base_url+ 'accounting/load_items_table');
		e.preventDefault();
	});
	$("#group_accounts").on('change',function(){
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

	$("#ledger_accounts").on('change',function(){
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
	$("#sub_accounts").on('change',function(){
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

	$('#record_item_form').on('submit',function(e) {
      $('#record_item_form button').addClass('disabled');
      $('#record_item_form button').text('Proccessing ...');
      $.ajax({
      url:base_url + $(this).attr("action"),
      data:$(this).serialize(),
      type:'POST',
      success:function(data){
	      console.log(data);
	      $('#record_item_form button').removeClass('disabled');
	      $('#record_item_form button').text('Add Item To Record');
	      $('#record_item_form input[type=text],#record_item_form input[type=date]').val('');

	      $('#table_loader').html(data);
      },
      error:function(data){
          console.log(data);
          $('#record_item_form button').removeClass('disabled');
          $('#record_item_form button').text('Add Item To Record');
          $('#table_loader').html(data);
      }
      });
      e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });
    $('#record_form').on('submit',function(e) {
      $('#record_form button').addClass('disabled');
      $('#record_form button').text('ناردن ...');
      $.ajax({
      url:$(this).attr("action"),
      data:$(this).serialize(),
      type:'POST',
      success:function(data){
	      console.log(data);
	      $('#record_form button').removeClass('disabled');
	      $('#record_form button').text('پاشکەوت کردن');
	      $('#record_form input[type=text],#record_form textarea,#record_form input[type=date]').val('');
	      $('#notification').html(data);
      },
      error:function(data){
          console.log(data);
          $('#record_form button').removeClass('disabled');
          $('#record_form button').text('پاشکەوت کردن');
          $('#notification').html(data);
      }
      });
      e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });
});
</script>
</body>
</html>
