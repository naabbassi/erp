<html>
<head>
	<title>Accounts Report</title>
</head>
<body>
<div class="container">
	<?php
		$this->load->view('nav');
	?>
  <div class="tab-pane active" id="items">
  	<form role="form" class="form-horizontal" id="form" action="accounts_report_prepare" method="post">
  		<div class="col-md-7">
			  <div class="form-group">
			    <label class="col-sm-4 control-label">Accounts Group</label>
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
			    <label for="inputPassword3" class="col-sm-4 control-label">Ledger Accounts</label>
			    <div class="col-sm-8">
				    <select name="ledger_id" class="form-control" id="ledger_accounts" required>
				    	<option></option>
				    </select>
				</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">Subsaidiary Accounts</label>
			    <div class="col-sm-8">
				    <select name="sub_id" class="form-control" id="sub_accounts" >
				    	<option ></option>
				    </select>
				</div>
			  </div>
			  <div class="form-group">
			    <label  class="col-sm-4 control-label">Detailed Accounts</label>
			    <div class="col-sm-8" id="detail_accounts">

				</div>
			  </div>
		</div>
		<div class="clearfix"></div><br>
	        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
        	<button type="submit" class="btn btn-primary">Get Report</button>
        </div>
      </div>
	</form>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var base_url='<?php echo base_url(); ?>'+'index.php/';

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
        url:base_url + 'reports/load_details/' + $(this).val(),
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
