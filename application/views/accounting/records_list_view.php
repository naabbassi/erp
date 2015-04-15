<html>
<head>
  <title>Accounting Records List</title>
</head>
<body>
<div class="container">
    <?php $this->load->view('nav'); ?>
    <h3 class="text-center text-primary">Accounting Records List</h3>
    <hr>
  <table class="table table-bordered table-hover table-striped">
  <thead>
    <th class="text-center"><small>Record ID</small></th>
    <th class="text-center">Record Title</th>
    <th class="text-center">Date</th>
    <th class="text-center">User</th>
    <th class="text-center">Debit</th>
    <th class="text-center">Credit</th>
    <th class="text-center">Operation</th>
  </thead>
  <?php
  $no = 1;
  $debit = 0;
  $credit = 0;
  $atts = array(
                    'width'      => '1000',
                    'height'     => '650',
                    'scrollbars' => 'no',
                    'directories'=>  '0',
                    'status'     => 'no',
                    'resizable'  => 'yes',
                    'screenx'    => '0',
                    'screeny'    => '0'
                  );
  $res=$this->accounting_record_model->all();
  foreach ($res as $key) {
    echo "<tr>";
    echo "<td class='text-center'>".$key->id."</td>";
    echo "<td class='text-center'>".$key->title."</td>";
    echo "<td class='text-center'>".$key->record_date."</td>";
    $total_debit=$this->accounting_record_items_model->sum('debit',array('record_id'=>$key->id));
    $total_credit=$this->accounting_record_items_model->sum('credit',array('record_id'=>$key->id));
    $user=$this->user_model->findbyid($key->reg_user);
    echo "<td class='text-center'>".$user->username."</td>";
    echo "<td class='text-center info'>".number_format($total_debit->debit,2)." $</td>";
    echo "<td class='text-center success'>".number_format($total_credit->credit,2)." $</td>"; 
    echo "<td class='text-center'>".anchor_popup('reports/accounting_record_report/'.$key->id,'Show',$atts).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.anchor_popup('accouning/record_edit/'.$key->id,'Edit',$atts)."</td>";
    echo "<tr>";
    $no++;
    $debit=$debit + $total_debit->debit;
    $credit=$credit + $total_credit->credit;
   }
  ?>
  <tr>
    <td colspan="4" class="text-right text-danger danger">Balance :</td>
    <td class="text-info text-center info"><?php echo number_format($debit,2); ?> $</td>
    <td class="text-success text-center success"><?php echo number_format($credit,2); ?> $</td>
  </tr>
  </thead>
  </table>
</div>
</body>
</html>