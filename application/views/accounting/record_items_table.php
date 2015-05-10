<?php
if (isset($_SESSION['record_items'])) { ?>
  <a href="dsfv" id="delete_items" class="text-info">رەشکردنەوەی گشتی</a>
  <table class="table table-bordered table-hover table-striped">
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
  foreach ($_SESSION["record_items"] as $key) {
    $group=$this->group_accounts_model->findbyid($key['group_id']);
    $ledger=$this->ledger_accounts_model->findbyid($key['ledger_id']);
    $sub=$this->sub_accounts_model->findbyid($key['sub_id']);
  	echo "<tr>";
  	echo "<td class='text-center'>".$no."</td>";
  	echo "<td class='text-center'>".$key['title']."</td>";
  	echo "<td class='text-center'>".$group->title."</td>";
  	echo "<td class='text-center'>".$ledger->title."</td>";
  	echo "<td class='text-center'>".$sub->title."</td>";
  	echo "<td class='text-center'>". $this->details->get_title($key['sub_id'],$key['detail_id'])."</td>";
  	echo "<td class='text-center text-primary'>".number_format($key['debit'],2)." $</td>";
    echo "<td class='text-center text-success'>".number_format($key['credit'],2)." $</td>";
    echo "<td class='text-center text-success'><a href='$key[id]' id='delete_item'>X</a></td>";
  	echo "<tr>";
  	$no++;
  	$debit=$debit + $key['debit'];
  	$credit=$credit + $key['credit'];
   }
  ?>
  <tr>
    <td colspan="6" class="text-right text-danger danger">Balance :</td>
    <td class="text-info text-center info"><?php echo number_format($debit,2); ?> $</td>
    <td class="text-success text-center success"><?php echo number_format($credit,2); ?> $</td>
  </tr>
  </thead>
  </table>
	<?php }else{ ?>
	<div class="alert alert-info">No items have been added</div>
	<?php }
?>