<html>
<head>
	<title>Define Accounts</title>
</head>
<body>
<?php 
$this->load->view('nav');
?>
<div class="container">
	<div id="notification"></div>
	<h4 class="text-info">Define Ledger Accounts</h4>
	<hr>
	<form class="form-inline" role="form" action="accounting/define_ledger_account" id="ledger_form">
		    <div class="form-group">
		      &nbsp;&nbsp;&nbsp;&nbsp;<label>Select Group :</label>
		   	  <select name="group_id" class="small form-control">
		   	  	<option value="0"></option>
		   	  	<?php 
		   	  		$res=$this->group_accounts_model->all();
		   	  		foreach ($res as $item) {
		   	  			echo "<option value='".$item->id."'>".$item->title."</option>";
		   	  		}
		   	  	?>
		   	  </select>
			</div>
			<div class="form-group">
				&nbsp;&nbsp;&nbsp;&nbsp;<label>Ledger Title :</label>
				<input type="text" name="title" class="form-control">
			</div>
			<div class="form-group">
				&nbsp;&nbsp;&nbsp;&nbsp;<label>Ledger Account Nature :</label>
				<select class="form-control" name="nature">
					<option value="1">Debit and Credit</option>
					<option value="2">Without Credit Balance</option>
					<option value="3">Without Debit Balance</option>
					<option value="4">Just Debit</option>
					<option value="5">Just Credit</option>
				</select>
			</div>
			&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-sm">Add New Ledger</button>
	</form>
	<hr>
	<br>
	<h4 class="text-danger">Define Subsaidiary Accounts</h4>
	<hr>
		<form class="form-inline" role="form" action="accounting/define_sub_account" id="sub_form">
		    <div class="form-group">
		      &nbsp;&nbsp;&nbsp;&nbsp;<label>Select Group :</label>
		   	  <select name="group_id" class="small form-control" id="group_accounts">
		   	  	<option value="0"></option>
		   	  	<?php 
		   	  		$res=$this->group_accounts_model->all();
		   	  		foreach ($res as $item) {
		   	  			echo "<option value='".$item->id."'>".$item->title."</option>";
		   	  		}
		   	  	?>
		   	  </select>
			</div>
			<div class="form-group">
		      &nbsp;&nbsp;&nbsp;&nbsp;<label>Select Ledger :</label>
		   	  <select name="ledger_id" class="small form-control" id="ledger_load">
		   	  	<option value="0">Select Accounts Group </option>
		   	  </select>
			</div>
			<div class="form-group">
				&nbsp;&nbsp;&nbsp;&nbsp;<label>Subsaidiary Title :</label>
				<input type="text" name="title" class="form-control">
			</div><br><br>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Detailed account kind</h3>
				</div>
				<div class="panel-body">
					<div class="radio"><label> None
					    <input type="radio" name="detail_kind"  value="0" checked>
					</label></div>&nbsp;&nbsp;
					<div class="radio"><label> Independent List
					    <input type="radio" name="detail_kind"  value="1" >
					</label></div>&nbsp;&nbsp;
					<div class="radio"><label> Customers
					    <input type="radio" name="detail_kind"  value="2" >
					</label></div>&nbsp;&nbsp;
					<div class="radio"><label> Revolving Fund
					    <input type="radio" name="detail_kind"  value="3" >
					</label></div>&nbsp;&nbsp;
					<div class="radio"><label> Employes
					    <input type="radio" name="detail_kind"  value="4" >
					</label></div>&nbsp;&nbsp;
					<div class="radio"><label> Owners
					    <input type="radio" name="detail_kind"  value="5" >
					</label></div>&nbsp;&nbsp;
					<div class="radio"><label> Equipments
					    <input type="radio" name="detail_kind"  value="6" >
					</label></div>&nbsp;&nbsp;
					<div class="radio"><label> Bank Accounts
					    <input type="radio" name="detail_kind"  value="7" >
					</label></div>&nbsp;&nbsp;
					<div class="radio"><label> General
					    <input type="radio" name="detail_kind"  value="8" >
					</label></div>
			</div></div>
			&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-sm">Add New Subsaidiary Account</button>
	</form><br>
	<hr>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    var base_url='<?php echo base_url(); ?>'+'index.php/';

    /* Submit cost search form */

   $('#ledger_form').on('submit',function(e) {
      $('#ledger_form button').addClass('disabled');
      $('#ledger_form button').text('Proccessing ...');
      $.ajax({
      url:base_url + $(this).attr("action"),
      data:$(this).serialize(),
      type:'POST',
      success:function(data){
	      $('#ledger_form button').removeClass('disabled');
	      $('#ledger_form button').text('Add New Ledger');
	      $('#ledger_form input[type=text]').val('');
	      $('#notification').html(data);
      },
      error:function(data){
          $('#ledger_form button').removeClass('disabled');
          $('#ledger_form button').text('Add New Ledger');
          $('#notification').html(data);
      }
      });
      e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });

    $("#group_accounts").on('change',function(){
      $.ajax({
        url:base_url + 'accounting/ajax_ledger_load/' + $(this).val(),
        success:function(data){
          $('#ledger_load').html(data);
        },
        error:function(data){
          $('#ledger_load').html(data);
        }
      });
     });
    $('#sub_form').on('submit',function(e) {
      $('#sub_form button').addClass('disabled');
      $('#sub_form button').text('Proccessing ...');
      $.ajax({
      url:base_url + $(this).attr("action"),
      data:$(this).serialize(),
      type:'POST',
      success:function(data){
	      $('#sub_form button').removeClass('disabled');
	      $('#sub_form button').text('Add New Ledger');
	      $('#sub_form input[type=text]').val('');
	      $('#notification').html(data);
      },
      error:function(data){
          $('#ledger_form button').removeClass('disabled');
          $('#ledger_form button').text('Add New Ledger');
          $('#notification').html(data);
      }
      });
      e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
    });
  });
</script>
</body>
</html>