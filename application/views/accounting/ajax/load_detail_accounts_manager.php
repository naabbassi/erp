<?php
if ($this->uri->segment(3)!==false & $this->uri->segment(3) > 0) {
	$sub=$this->sub_accounts_model->select_row(array('id'=>$this->uri->segment(3)));
	$value=$sub->detail_kind;
	switch ($value) {
		case '0':
			echo "<div class='alert alert-info'>هیچ وردە هەژمارێک تومار نەکراوە.</div>";
			break;
		case '1':
			 $res=$this->independent_model->select(array('sub_id'=>$this->uri->segment(3)));
			foreach ($res as $key) { ?>
				  <button type="button" class="btn btn-success  btn-sm " ><?php echo $key->title ?> </button>
			<?php }
			break;
		case '2':
			$res=$this->customer_model->all();
			foreach ($res as $key) { ?>
				 <button type="button" class="btn btn-success  btn-sm " ><?php echo $key->invoice_title ?></button>
			<?php }
			break;
		case '3':
			$res=$this->revolving_model->all();
			foreach ($res as $key) { ?>
				<button type="button" class="btn btn-success  btn-sm " ><?php echo $key->title ?> </button>
			<?php }
			break;
		case '4':
			$res=$this->personnels_model->all();
			foreach ($res as $key) { ?>
				<button type="button" class="btn btn-success  btn-sm " ><?php echo $key->name.' '.$key->family ?> </button>
			<?php }
			break;
		case '5':
			$res=$this->owners_model->all();
			foreach ($res as $key) { ?>
				<button type="button" class="btn btn-success  btn-sm " ><?php echo $key->title ?> </button>				
			<?php }
			break;
		case '6':
			$res=$this->fix_assets_model->all();
			foreach ($res as $key) { ?>
				<button type="button" class="btn btn-success  btn-sm " ><?php echo $key->title ?> </button>				
			<?php }
			break;
		case '7':
			$res=$this->banks_model->all();
			foreach ($res as $key) { ?>
				<button type="button" class="btn btn-success  btn-sm " ><?php echo $key->title ?> </button>				
			<?php }
			break;
		case '8':
			$res=$this->general_model->all();
			foreach ($res as $key) { ?>
				<button type="button" class="btn btn-success  btn-sm "><?php echo $key->title ?> </button>				
			<?php }
			break;
		default:
			echo '';
			break;
	}
}
else
{
	echo "<strong class='text-info'>Select subsaidiary account</strong>";
}
?>