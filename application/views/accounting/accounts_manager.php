<html>
<head>
	<title>هەژمارەکان</title>
	<style type="text/css">
	.btn{
		margin-top:5px;
	}
	</style>
</head>
<body>
	<div class="container">
		<?php $this->load->view('nav'); ?>
		<div id="notification"></div>
		<hr>

		<div class="row">
			<div class="col-md-3" id="group_div">
				<h4 class="text-primary">گرۆپی هەژمارەکان :</h4>
				<hr>
				<?php
				$res=$this->group_accounts_model->all();
				foreach ($res as $key) { ?>
					<div class="btn-group">
				  <button type="button" class="btn btn-primary dropdown-toggle btn-sm  " data-toggle="dropdown"><?php echo $key->title ?> <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu">
				    <li><a href="<?php echo $key->id ?>" id="group_select">هەلبژێرە</a></li>
				    <li class="divider"></li>
				    <li><a href="<?php echo $key->id ?>" id="add_ledger">زیاد کردنی هەژماری سەرەکی</a></li>

				  </ul>
				</div>
				<?php }
				 ?>
			</div>
			<div class="col-md-3" id="ledger_div">
				<h4 class="text-success">هەژمارە سەرەکێکان :</h4>
				<hr>
				<div id="ledger_loader"></div>
			</div>
			<div class="col-md-3" id="sub_div">
				<h4 class="text-danger">ژێر هەژمارەکان :</h4>
				<hr>
				<div id="sub_loader"></div>
			</div>
			<div class="col-md-3" class="detail_div">
				<h4 class="text-warning">هەژمارە وردەکان :</h4>
				<hr>
				<div id="detail_loader"></div>
			</div>
		</div>


		<!-- New Ledger Modal -->
		<div class="modal fade" id="new_ledger_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 class="modal-title" id="myModalLabel">زیاد کردنی هەژماری سەرەکی</h4>
		      </div>
		      <div class="modal-body">
			       <form class="form-horizontal" role="form" id="new_ledger">
			       		<div class="form-group">
						<label class="col-sm-4 control-label">نێوی هەژمار :</label>
						  <div class="col-sm-8">
						    <input type="text" class="form-control" name="title" id="title" >
						  </div>
						</div>

						<div class="form-group">
						<label class="col-sm-4 control-label">سروشتی هەژمار :</label>
						  <div class="col-sm-8">
							<select class="form-control" name="nature">
								<option value="1">Debit and Credit</option>
								<option value="2">Without Credit Balance</option>
								<option value="3">Without Debit Balance</option>
								<option value="4">Just Debit</option>
								<option value="5">Just Credit</option>
							</select>
						  </div>
						</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <input type="submit" class="btn btn-primary" value="Add New Ledger">
			       </form>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Ledger Edit -->
		<div class="modal fade" id="edit_ledger_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 class="modal-title" id="myModalLabel">گورانکاری هەژماری سەرەکی</h4>
		      </div>
		      <div class="modal-body" >
		      	   <form class="form-horizontal" role="form" id="update_ledger">
		      	   </form>
		    </div>
		  </div>
		</div>
		</div>
		<!-- sub Edit -->
		<div class="modal fade" id="edit_sub_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 class="modal-title" id="myModalLabel">گەرانکاری ژێر هەژمار</h4>
		      </div>
		      <div class="modal-body" >
		      	   <form class="form-horizontal" role="form" id="update_sub">
		      	   </form>
		    </div>
		  </div>
		</div>
		</div>
		<!-- New Sub Modal -->
		<div class="modal fade" id="new_sub_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 class="modal-title" id="myModalLabel">زیادکردی ژێر هەژمار</h4>
		      </div>
		      <div class="modal-body">
			       <form class="form-horizontal" role="form" id="add_new_sub">
			       		<div class="form-group">
						<label class="col-sm-4 control-label">نێوی ژێر هەژمار :</label>
						  <div class="col-sm-8">
						    <input type="text" class="form-control" name="title" id="title">
						  </div>
						</div>
						<div class="form-group">
						<label class="col-sm-4 control-label">Detail Type :</label>
						  <div class="col-sm-8">
							<select class="form-control" name="detail_kind">
								<option value="0">None</option>
								<option value="1">Independent List</option>
								<option value="2">Customers</option>
								<option value="3">Revolving Funds</option>
								<option value="4">Employes</option>
								<option value="5">Owners</option>
								<option value="6">Equipments</option>
								<option value="7">Bank Accounts</option>
								<option value="8">General List</option>
							</select>
						  </div>
						</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <input type="submit" class="btn btn-primary" value="Add New Ledger">
			       </form>
		      </div>
		    </div>
		  </div>
		</div>

	</div>
	<script type="text/javascript">
	$(document).ready(function(){
		var base_url='<?php echo base_url(); ?>'+'index.php/';
		var selected_group_id = 0 ;
		var new_ledger_parent_id = 0;
		var new_sub_parent_id = 0;
		var ledger_edit_id = 0;
		var sub_edit_id = 0;
		/* Group Select */
		$('#group_div').on('click','#group_select',function(e){
			selected_group_id = $(this).attr('href');
		 $.ajax({
		      url:base_url + 'accounting/ajax_ledger_load_manager/' + selected_group_id,
		      type:'POST',
		      success:function(data){
			      $('#ledger_loader').html(data);
			      $('#sub_loader').html('');
			      $('#detail_loader').html('');
		      },
		      error:function(data){
				  $('#ledger_loader').html(data);
				  $('#sub_loader').html('');
				  $('#detail_loader').html('');
		      }
		      });
		      e.preventDefault();
		}); 

		/* Ledger Select */
		$('#ledger_div').on('click','#ledger_select',function(e){
			selected_ledger_id = $(this).attr('href');
		 $.ajax({
		      url:base_url + 'accounting/ajax_sub_load_manager/' + selected_ledger_id,
		      type:'POST',
		      success:function(data){
			      $('#sub_loader').html(data);
			      $('#detail_loader').html('');
		      },
		      error:function(data){
				  $('#sub_loader').html(data);
				  $('#detail_loader').html('');
		      }
		      });
		      e.preventDefault();
		});

		/* Sub Select */
		$('#sub_div').on('click','#sub_select',function(e){
			selected_sub_id = $(this).attr('href');
		 $.ajax({
		      url:base_url + 'accounting/ajax_detail_load_manager/' + selected_sub_id,
		      type:'POST',
		      success:function(data){
			      $('#detail_loader').html(data);
		      },
		      error:function(data){
				  $('#detail_loader').html(data);
		      }
		      });
		      e.preventDefault();
		});
		/* Add Ledger */
		$('#group_div').on('click','#add_ledger',function(e){
			new_ledger_parent_id =$(this).attr('href');
			$('#new_ledger_modal').modal("show");
			e.preventDefault();
		});
		$('#new_ledger').on('submit',function(e){
			console.log('true');
			$.ajax({
		      url:base_url + 'accounting/new_ledger_account/' + new_ledger_parent_id,
		      data:$(this).serialize(),
		      type:'POST',
		      success:function(data){
			      $('#new_ledger_modal').modal("hide");
			      $('#add_new_ledger #title').val("");
			      $('#notification').html(data).show().fadeOut(10000);
			      $('#ledger_loader').load(base_url + 'accounting/ajax_ledger_load_manager/' + new_ledger_parent_id);
		      },
		      error:function(data){
				  $('#new_ledger_modal').modal("hide");
				  $('#notification').html(data).show().fadeOut(10000);
		      }
		      });
		      e.preventDefault();
		});
		/* Add Sub */
		$('#ledger_div').on('click','#add_sub',function(e){
			new_sub_parent_id = $(this).attr('href');
			$('#new_sub_modal').modal("show");
			e.preventDefault();
		});
		$('#add_new_sub').on('submit',function(e){
			console.log('true');
			$.ajax({
		      url:base_url + 'accounting/new_sub_account/' + new_sub_parent_id,
		      data:$(this).serialize(),
		      type:'POST',
		      success:function(data){
			      $('#new_sub_modal').modal("hide");
			      $('#add_new_sub #title').val("");
			      $('#notification').html(data).show().fadeOut(10000);
			      $('#sub_loader').load(base_url + 'accounting/ajax_sub_load_manager/' + new_sub_parent_id);
			      new_sub_parent_id = 0;
		      },
		      error:function(data){
		      	  $('#new_sub_modal').modal("hide");
				  $('#notification').html(data).show().fadeOut(10000);
				  new_sub_parent_id = 0;
		      }
		      });
		      e.preventDefault();
		});

		/* Delete Ledger */
		$('#ledger_loader').on('click','#delete_ledger',function(e){
			var delete_id=$(this).attr('href');
			if (confirm('Are You Sure To Delete This Ledger Account ?')){
			$.ajax({
		      url:base_url + 'accounting/delete_ledger_account/' + delete_id,
		      data:$(this).serialize(),
		      type:'POST',
		      success:function(data){
			      $('#ledger_loader').html('');
			      $('#sub_loader').html('');
			      $('#detail_loader').html('');
			      $('#notification').html(data).show().fadeOut(10000);
		      },
		      error:function(data){
				  $('#notification').html(data).show().fadeOut(10000);
		      }
		      });
		}
		      e.preventDefault();
		});

		/* Delete Sub Accounts */
		$('#sub_loader').on('click','#sub_delete',function(e){
			var delete_id=$(this).attr('href');
			if (confirm('Are You Sure To Delete This sub Account ?')){
			$.ajax({
		      url:base_url + 'accounting/delete_sub_account/' + delete_id,
		      data:$(this).serialize(),
		      type:'POST',
		      success:function(data){
			      $('#sub_loader').html('');
			      $('#detail_loader').html('');
			      $('#notification').html(data).show().fadeOut(10000);
		      },
		      error:function(data){
				  $('#notification').html(data).show().fadeOut(10000);
		      }
		      });
		}
		      e.preventDefault();
		});
		/* Edit Ledger */
		$('#ledger_loader').on('click','#edit_ledger',function(e){
			ledger_edit_id=$(this).attr('href');
			$('#update_ledger').load(base_url + 'accounting/edit_ledger_manager/' + ledger_edit_id);
			$('#edit_ledger_modal').modal("show");
			e.preventDefault();
		});
		/* Update Ledger */
		$('#update_ledger').on('submit',function(e){
			console.log(ledger_edit_id);
		    $.ajax({
		      url:base_url + 'accounting/update_ledger_manager/' + ledger_edit_id,
		      data:$(this).serialize(),
		      type:'POST',
		      success:function(data){
			      $('#edit_ledger_modal').modal("hide");
			      $('#notification').html(data).show().fadeOut(10000);
			      ledger_edit_id = 0;
		      },
		      error:function(data){
		      	  $('#edit_ledger_modal').modal("hide");
				  $('#notification').html(data).show().fadeOut(10000);
				  ledger_edit_id = 0;
		      }
		      });
		    e.preventDefault();
		});
		/* Edit Sub */
		$('#sub_loader').on('click','#edit_sub',function(e){
			sub_edit_id=$(this).attr('href');
			$('#update_sub').load(base_url + 'accounting/edit_sub_manager/' + sub_edit_id);
			$('#edit_sub_modal').modal("show");
			e.preventDefault();
		});
		/* Update Sub */
		$('#update_sub').on('submit',function(e){
			console.log(sub_edit_id);
		    $.ajax({
		      url:base_url + 'accounting/update_sub_manager/' + sub_edit_id,
		      data:$(this).serialize(),
		      type:'POST',
		      success:function(data){
			      $('#edit_sub_modal').modal("hide");
			      $('#notification').html(data).show().fadeOut(10000);
			      sub_edit_id = 0;
		      },
		      error:function(data){
		      	  $('#edit_sub_modal').modal("hide");
				  $('#notification').html(data).show().fadeOut(10000);
				 subr_edit_id = 0;
		      }
		      });
		    e.preventDefault();
		});
	});

	</script>
</body>
</html>