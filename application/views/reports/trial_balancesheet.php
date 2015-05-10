<html>
<head>
	<title>Trial Balance Sheet</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>asset/css/trial_balance.css">
</head>
<body>
	<div class="container">
		<h2> Trial Balance Sheet</h2>
		<br>
<table>
	<tr>
		<td rowspan="2" style="max-width:10px;">ID</td>
		<td rowspan="2" style="min-width:150px;">Title</td>
		<td colspan="2">Unadjusted</td>
		<td colspan="2">Balances</td>
	</tr>	
	<tr>
		<td>Debit</td>
		<td>Credit</td>
		<td>Debit</td>
		<td>Credit</td>
	</tr>
	<?php
	$Balance_Total_Debit=0;
	$Balance_Total_Credit=0;
	 ?>
	<!-- Current Assets -->
	<tr>
		<td class="bold">1</td>
		<td class="text-left bold">Current Assets :</td>
	</tr>
		<?php
			$ledgers=$this->ledger_accounts_model->select(array('group_id'=>1));
			foreach ($ledgers as $key) {
				$debit=$this->accounting_record_items_model->sum('debit',array('group_id'=>1,'ledger_id'=>$key->id))->debit;
				$credit=$this->accounting_record_items_model->sum('credit',array('group_id'=>1,'ledger_id'=>$key->id))->credit;
			 ?>
				<tr>
					<td><?php echo $key->id; ?></td>
					<td class="text-left"><?php echo $key->title; ?></td>
					<td><?php echo number_format($debit,2); ?> $</td>
					<td><?php echo number_format($credit,2); ?> $</td>
					<?php 
					if($debit > $credit) { $balance = $debit - $credit;
						$Balance_Total_Debit= $Balance_Total_Debit + $balance; 
						echo "<td>".number_format($balance,2)." $</td>";
						echo "<td>-</td>";
					 } elseif($debit == $credit){
					 	echo "<td>-</td>";
					 	echo "<td>-</td>";
					 } else {
					 	$balance= $credit - $debit;
					 	$Balance_Total_Credit=$Balance_Total_Credit+$balance;
						echo "<td>-</td>";
					 	echo "<td>".number_format($balance,2)." $</td>";
					}
					?>
				</tr>
			<?php } ?>
	
	<!-- Fix Assets -->
	<tr>
		<td class="bold">2</td>
		<td class="text-left bold">Fix Assets :</td>
	</tr><?php 
			$ledgers=$this->ledger_accounts_model->select(array('group_id'=>2));
			foreach ($ledgers as $key) {
				$debit=$this->accounting_record_items_model->sum('debit',array('group_id'=>2,'ledger_id'=>$key->id))->debit;
				$credit=$this->accounting_record_items_model->sum('credit',array('group_id'=>2,'ledger_id'=>$key->id))->credit;
			 ?>
				<tr>
					<td><?php echo $key->id; ?></td>
					<td class="text-left"><?php echo $key->title; ?></td>
					<td><?php echo number_format($debit,2); ?> $</td>
					<td><?php echo number_format($credit,2); ?> $</td>
					<?php 
					if($debit > $credit) { $balance = $debit - $credit;
						$Balance_Total_Debit= $Balance_Total_Debit + $balance; 
						echo "<td>".number_format($balance,2)." $</td>";
						echo "<td>-</td>";
					 } elseif($debit == $credit){
					 	echo "<td>-</td>";
					 	echo "<td>-</td>";
					 } else {
					 	$balance= $credit - $debit;
					 	$Balance_Total_Credit=$Balance_Total_Credit+$balance;
						echo "<td>-</td>";
					 	echo "<td>".number_format($balance,2)." $</td>";
					}
					?>
				</tr>
			<?php }
		 ?>
	<!-- Current Liabilities -->
	<tr>
		<td class="bold">3</td>
		<td class="text-left bold">Current Liabilities :</td>
	</tr><?php 
			$ledgers=$this->ledger_accounts_model->select(array('group_id'=>3));
			foreach ($ledgers as $key) {
				$debit=$this->accounting_record_items_model->sum('debit',array('group_id'=>3,'ledger_id'=>$key->id))->debit;
				$credit=$this->accounting_record_items_model->sum('credit',array('group_id'=>3,'ledger_id'=>$key->id))->credit;
			 ?>
				<tr>
					<td><?php echo $key->id; ?></td>
					<td class="text-left"><?php echo $key->title; ?></td>
					<td><?php echo number_format($debit,2); ?> $</td>
					<td><?php echo number_format($credit,2); ?> $</td>
					<?php 
					if($debit > $credit) { $balance = $debit - $credit;
						$Balance_Total_Debit= $Balance_Total_Debit + $balance; 
						echo "<td>".number_format($balance,2)." $</td>";
						echo "<td>-</td>";
					 } elseif($debit == $credit){
					 	echo "<td>-</td>";
					 	echo "<td>-</td>";
					 } else { 
					 	$balance= $credit - $debit;
					 	$Balance_Total_Credit=$Balance_Total_Credit+$balance;
						echo "<td>-</td>";
					 	echo "<td>".number_format($balance,2)." $</td>";
					}
					?>
				</tr>
			<?php }
		 ?>
	<!-- Long Term Liabilities -->
	<tr>
		<td class="bold">4</td>
		<td class="text-left bold">Long Term Liabilities :</td>
	</tr><?php 
			$ledgers=$this->ledger_accounts_model->select(array('group_id'=>4));
			foreach ($ledgers as $key) {
				$debit=$this->accounting_record_items_model->sum('debit',array('group_id'=>4,'ledger_id'=>$key->id))->debit;
				$credit=$this->accounting_record_items_model->sum('credit',array('group_id'=>4,'ledger_id'=>$key->id))->credit;
			 ?>
				<tr>
					<td><?php echo $key->id; ?></td>
					<td class="text-left"><?php echo $key->title; ?></td>
					<td><?php echo number_format($debit,2); ?> $</td>
					<td><?php echo number_format($credit,2); ?> $</td>
					<?php 
					if($debit > $credit) { $balance = $debit - $credit;
						$Balance_Total_Debit= $Balance_Total_Debit + $balance; 
						echo "<td>".number_format($balance,2)." $</td>";
						echo "<td>-</td>";
					 } elseif($debit == $credit){
					 	echo "<td>-</td>";
					 	echo "<td>-</td>";
					 } else { 
					 	$balance= $credit - $debit;
					 	$Balance_Total_Credit=$Balance_Total_Credit+$balance;
						echo "<td>-</td>";
					 	echo "<td>".number_format($balance,2)." $</td>";
					}
					?>
				</tr>
			<?php }
		 ?>
	<!-- Owner's Equity -->
	<tr>
		<td class="bold">5</td>
		<td class="text-left bold">Owner's Equity :</td>
	</tr><?php 
			$ledgers=$this->ledger_accounts_model->select(array('group_id'=>5));
			foreach ($ledgers as $key) {
				$debit=$this->accounting_record_items_model->sum('debit',array('group_id'=>5,'ledger_id'=>$key->id))->debit;
				$credit=$this->accounting_record_items_model->sum('credit',array('group_id'=>5,'ledger_id'=>$key->id))->credit;
			 ?>
				<tr>
					<td><?php echo $key->id; ?></td>
					<td class="text-left"><?php echo $key->title; ?></td>
					<td><?php echo number_format($debit,2); ?> $</td>
					<td><?php echo number_format($credit,2); ?> $</td>
					<?php 
					if($debit > $credit) { $balance = $debit - $credit;
						$Balance_Total_Debit= $Balance_Total_Debit + $balance; 
						echo "<td>".number_format($balance,2)." $</td>";
						echo "<td>-</td>";
					 } elseif($debit == $credit){
					 	echo "<td>-</td>";
					 	echo "<td>-</td>";
					 } else { 
					 	$balance= $credit - $debit;
					 	$Balance_Total_Credit=$Balance_Total_Credit+$balance;
						echo "<td>-</td>";
					 	echo "<td>".number_format($balance,2)." $</td>";
					}
					?>
				</tr>
			<?php }
		 ?>
	<!-- Revenue -->
	<tr>
		<td class="bold">6</td>
		<td class="text-left bold">Revenue :</td>
	</tr><?php 
			$ledgers=$this->ledger_accounts_model->select(array('group_id'=>6));
			foreach ($ledgers as $key) {
				$debit=$this->accounting_record_items_model->sum('debit',array('group_id'=>6,'ledger_id'=>$key->id))->debit;
				$credit=$this->accounting_record_items_model->sum('credit',array('group_id'=>6,'ledger_id'=>$key->id))->credit;
			 ?>
				<tr>
					<td><?php echo $key->id; ?></td>
					<td class="text-left"><?php echo $key->title; ?></td>
					<td><?php echo number_format($debit,2); ?> $</td>
					<td><?php echo number_format($credit,2); ?> $</td>
					<?php 
					if($debit > $credit) { $balance = $debit - $credit;
						$Balance_Total_Debit= $Balance_Total_Debit + $balance; 
						echo "<td>".number_format($balance,2)." $</td>";
						echo "<td>-</td>";
					 } elseif($debit == $credit){
					 	echo "<td>-</td>";
					 	echo "<td>-</td>";
					 } else { 
					 	$balance= $credit - $debit;
					 	$Balance_Total_Credit=$Balance_Total_Credit+$balance;
						echo "<td>-</td>";
					 	echo "<td>".number_format($balance,2)." $</td>";
					}
					?>
				</tr>
			<?php }
		 ?>
	<!-- Expenses -->
	<tr>
		<td class="bold">7</td>
		<td class="text-left bold">Expenses :</td>
	</tr><?php 
			$ledgers=$this->ledger_accounts_model->select(array('group_id'=>7));
			foreach ($ledgers as $key) {
				$debit=$this->accounting_record_items_model->sum('debit',array('group_id'=>7,'ledger_id'=>$key->id))->debit;
				$credit=$this->accounting_record_items_model->sum('credit',array('group_id'=>7,'ledger_id'=>$key->id))->credit;
			 ?>
				<tr>
					<td><?php echo $key->id; ?></td>
					<td class="text-left"><?php echo $key->title; ?></td>
					<td><?php echo number_format($debit,2); ?> $</td>
					<td><?php echo number_format($credit,2); ?> $</td>
					<?php 
					if($debit > $credit) { $balance = $debit - $credit;
						$Balance_Total_Debit= $Balance_Total_Debit + $balance; 
						echo "<td>".number_format($balance,2)." $</td>";
						echo "<td>-</td>";
					 } elseif($debit == $credit){
					 	echo "<td>-</td>";
					 	echo "<td>-</td>";
					 } else { 
					 	$balance= $credit - $debit;
					 	$Balance_Total_Credit=$Balance_Total_Credit+$balance;
						echo "<td>-</td>";
					 	echo "<td>".number_format($balance,2)." $</td>";
					}
					?>
				</tr>
			<?php }
		 ?>
	<!-- Cost Accounts -->
	<tr>
		<td class="bold">8</td>
		<td class="text-left bold">Cost Accounts :</td>
	</tr><?php 
			$ledgers=$this->ledger_accounts_model->select(array('group_id'=>8));
			foreach ($ledgers as $key) {
				$debit=$this->accounting_record_items_model->sum('debit',array('group_id'=>8,'ledger_id'=>$key->id))->debit;
				$credit=$this->accounting_record_items_model->sum('credit',array('group_id'=>8,'ledger_id'=>$key->id))->credit;
			 ?>
				<tr>
					<td><?php echo $key->id; ?></td>
					<td class="text-left"><?php echo $key->title; ?></td>
					<td><?php echo number_format($debit,2); ?> $</td>
					<td><?php echo number_format($credit,2); ?> $</td>
					<?php 
					if($debit > $credit) { $balance = $debit - $credit;
						$Balance_Total_Debit= $Balance_Total_Debit + $balance; 
						echo "<td>".number_format($balance,2)." $</td>";
						echo "<td>-</td>";
					 } elseif($debit == $credit){
					 	echo "<td>-</td>";
					 	echo "<td>-</td>";
					 } else { 
					 	$balance= $credit - $debit;
					 	$Balance_Total_Credit=$Balance_Total_Credit+$balance;
						echo "<td>-</td>";
					 	echo "<td>".number_format($balance,2)." $</td>";
					}
					?>
				</tr>
			<?php }
		 ?>
	<!-- Disciplinary Accounts -->
	<tr>
		<td class="bold">9</td>
		<td class="text-left bold">Disciplinary Accounts :</td>
	</tr><?php 
			$ledgers=$this->ledger_accounts_model->select(array('group_id'=>9));
			foreach ($ledgers as $key) {
				$debit=$this->accounting_record_items_model->sum('debit',array('group_id'=>9,'ledger_id'=>$key->id))->debit;
				$credit=$this->accounting_record_items_model->sum('credit',array('group_id'=>9,'ledger_id'=>$key->id))->credit;
			 ?>
				<tr>
					<td><?php echo $key->id; ?></td>
					<td class="text-left"><?php echo $key->title; ?></td>
					<td><?php echo number_format($debit,2); ?> $</td>
					<td><?php echo number_format($credit,2); ?> $</td>
					<?php 
					if($debit > $credit) { $balance = $debit - $credit; 
						echo "<td>".number_format($balance,2)." $</td>";
						echo "<td>-</td>";
					 } elseif($debit == $credit){
					 	echo "<td>-</td>";
					 	echo "<td>-</td>";
					 } else { 
					 	$balance= $credit - $debit;
						echo "<td>-</td>";
					 	echo "<td>".number_format($balance,2)." $</td>";
					}
					?>
				</tr>
			<?php }
		 ?>
		 <tr>
		 	<td class="bold" colspan="2">Total Balance :</td>
		 	<?php
		 		$sum_debit=$this->accounting_record_items_model->sum('debit',array())->debit;
		 		$sum_credit=$this->accounting_record_items_model->sum('credit',array())->credit;
		 	 ?>
		 	<td class="bold"><?php echo number_format($sum_debit ,2) ?>$</td>
		 	<td class="bold"><?php echo number_format($sum_credit,2)  ?>$</td>
		 	<td class="bold"><?php echo number_format($Balance_Total_Debit,2); ?> $</td>
		 	<td class="bold"><?php echo number_format($Balance_Total_Credit,2); ?> $</td>
		 </tr>
</table>
</div>
</body>
</html>