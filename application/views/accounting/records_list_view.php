<html>
<head>
  <title>ریزی بەڵگەکانی ژمێریاری</title>
</head>
<body>
<div class="container">
    <?php $this->load->view('nav'); ?>
    <h3 class="text-center text-primary">ریزی بەڵگەکانی ژمێریاری</h3>
    <hr>
  <table class="table table-bordered table-hover table-striped">
  <thead>
    <th class="text-center"><small>ژمارە</small></th>
    <th class="text-center">سەردێر</th>
    <th class="text-center">رێکەوت</th>
    <th class="text-center">بەکارهێنەر</th>
    <th class="text-center">قەرزدار</th>
    <th class="text-center">قەرزدەری</th>
    <th class="text-center">کارگێری</th>
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
    $user=$this->user_model->select_row(array('user_id'=>$key->user_id));
    echo "<td class='text-center'>$user->f_name $user->m_name</td>";
    echo "<td class='text-center info'>".number_format($total_debit->debit,2)." $</td>";
    echo "<td class='text-center success'>".number_format($total_credit->credit,2)." $</td>"; 
    echo "<td class='text-center'>".anchor_popup('reports/accounting_record_report/'.$key->id,'کردنەوە',$atts).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.anchor('accounting/record_edit/'.$key->id,'گورانکاری',$atts)."</td>";
    echo "<tr>";
    $no++;
    $debit=$debit + $total_debit->debit;
    $credit=$credit + $total_credit->credit;
   }
  ?>
  <tr>
    <td colspan="4" class="text-center text-danger danger">کۆ :</td>
    <td class="text-info text-center info"><?php echo number_format($debit,2); ?> $</td>
    <td class="text-success text-center success"><?php echo number_format($credit,2); ?> $</td>
  </tr>
  </thead>
  </table>
</div>
</body>
</html>