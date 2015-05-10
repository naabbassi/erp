<html>
<head>
	<title>Define General Items</title>
</head>
<body>
	<?php 
	$this->load->view('nav');
		?>
		<hr><br>
		<div class="col-md-12">
			<div class="col-md-6" id="form">
				<?php echo form_open('accounts/new_independent',array('class' => 'form-horizontal')); ?>
				<div class="form-group">
				    <label for="inputEmail3" class="col-sm-3 control-label">ژێر هەژمارەکان : </label>
				    <div class="col-sm-9">
				      <select class="form-control" name="sub_id">
				      	<?php
				      		$sub_accounts=$this->sub_accounts_model->select(array('detail_kind'=>'1'));
				      		foreach ($sub_accounts as $key) {
				      			echo "<option value='$key->id'>$key->title</option>";
				      		}
				      	 ?>
				      </select>
				    </div>
				</div>
				 <div class="form-group">
				    <label for="inputEmail3" class="col-sm-3 control-label">سەردێری هەژماری سەربەخۆ : </label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" name="title" id="title" placeholder="سەردێری هەژماری سەربەخۆ" required>
				    </div>
				</div>
				  <div class="form-group">
				    <div class="col-sm-offset-3 col-sm-9">
				      <button type="submit" class="btn btn-success" id="form_submit">زیاد بکە</button>
				    </div>
				  </div>
				<?php echo form_close(); ?><br>
				<div id="notify">
					<?php
						echo $this->session->flashdata('new_independent');
						echo $this->session->flashdata('update_independent');
						echo $this->session->flashdata('delete_independent');
					 ?>
				</div>
			</div>
			<div class="col-md-6">
			 	<table class="table table-hover table-striped" id="table">
		 		<thead>
		 			<th>#</th>
		 			<th>ژێر هەژمار</th>
		 			<th>هەژماری سەربەخۆ</th>
		 			<th>کارگێری</th>
		 		</thead>
		 		<?php
		 		$res=$this->independent_model->all();
		 		$no=1;
		 		foreach ($res as $key) {
		 			$sub=$this->sub_accounts_model->findbyid($key->sub_id);
		 		 ?>
		 			<tr>
		 				<td><?php echo $no; ?></td>
		 				<td><?php echo $sub->title; ?></td>
		 				<td><?php echo $key->title; ?></td>
		 				<td>
		 					<a href="<?php echo $key->id; ?>" value="<?php echo $key->title; ?>" id="edit">گورانکاری</a> &nbsp;&nbsp;&nbsp;
		 					<a href="<?php echo $key->id; ?>" id="delete">رەش کردنەوە</a>
		 				</td>
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

    $('#table').on('click','#delete',function(e) {
      var object = $(this);
    if (confirm('ئایا دڵنیای لە ڕەش کردنەوە ؟')) {
      delete_id = $(this).attr('href');
    $.ajax({
      url:base_url + 'accounts/delete_general/' + delete_id ,
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
      url:base_url + 'accounts/edit_independent/' + edit_id ,
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