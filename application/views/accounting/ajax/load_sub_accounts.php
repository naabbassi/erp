<?php
	if ($this->uri->segment(3)!==false & $this->uri->segment(3) > 0) {
		$res=$this->sub_accounts_model->select(array('ledger_id'=>$this->uri->segment(3))); ?>
				<option></option>
			<?php foreach ($res as $key) { ?>
				<option value="<?php echo $key->id ?>"><?php echo $key->title ?></option>
    <?php }	} else
	{
		echo "<option value='0'>Select Ledger Account</option>";
	}
?>