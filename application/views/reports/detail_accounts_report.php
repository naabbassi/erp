<html>
<head>
	<meta charset="utf-8">
	<title>Detail Accounts Report</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>asset/css/trial_balance.css">
	<style type="text/css">
		*{
			font-size:14px !important;
		}
		table tr td,p{
			line-height:22px;
		}
		.left{
			text-align:left;
			padding-left:15px;
		}
		.blue{
			color:#8b4d28;
		}
	</style>
</head>
<body>
<div class="container">
	<div style="position:absolute; left:15px;text-align:left;top:15px;">
		<?php
			$group=$this->group_accounts_model->findbyid($this->input->post('group_id'));
			$ledger=$this->ledger_accounts_model->findbyid($this->input->post('ledger_id'));
			$sub=$this->sub_accounts_model->findbyid($this->input->post('sub_id'));
		 ?>
		<p>گروپی هەژمار : <?php echo $group->title.' ('.$this->input->post('group_id').')';  ?></p>
		<p>هەژماری سەرەکی : <?php echo $ledger->title.' ('.$this->input->post('ledger_id').')'; ?></p>
		<p>ژێر هەژمار : <?php echo $sub->title.' ('.$this->input->post('sub_id').')'; ?></p>
		<p>Detail Account : <?php echo $this->details->get_title($sub->id,$this->input->post('detail_id')).' ('.$this->input->post('detail_id').')';  ?></p>
		<p><?php echo date("y-m-d"); ?></p>
	</div>
	<img src="<?php echo base_url().'asset/img/logo.png' ?>" style="position:absolute;left:350px;">
		<br><br><br><br><br><br><br><br>
	<table>
		<tr>
			<td class="bold">Record ID</td>
			<td class="bold">Item ID</td>
			<td class="bold">Describtion</td>
			<td class="bold">Debit</td>
			<td class="bold">Credit</td>
			<td class="bold" style="min-width:80px;">Item Date</td>
		</tr>
		<?php
		$items=$this->accounting_record_items_model->select(array('group_id'=>$this->input->post('group_id'),'ledger_id'=>$this->input->post('ledger_id'),'sub_id'=>$this->input->post('sub_id'),'detail_id'=>$this->input->post('detail_id')));
		$debit=0;
		$credit=0;
		foreach ($items as $key) {
			$debit=$debit + $key->debit;
			$credit=$credit + $key->credit;
			$sub=$this->sub_accounts_model->findbyid($key->sub_id);
		 ?>
			<tr>
				<td class="bold"><?php echo $key->record_id ?></td>
				<td><?php echo $key->id ?></td>
				<td class="left">
					<p><?php echo $key->title ?></p>
				</td>
				<td><?php echo number_format($key->debit,2); ?>$</td>
				<td><?php echo number_format($key->credit,2); ?>$</td>
				<td><?php echo $key->item_date; ?></td>
			</tr>
		<?php }
		 ?>
		 <tr>
		 	<td class="bold" colspan="3">Balance :</td>
		 	<td class="bold"><?php echo number_format($debit,2); ?>$</td>
		 	<td class="bold"><?php echo number_format($credit,2); ?>$</td>
		 	
		 </tr>
	</table>
</div>
</body>
</html>