   <?php 
   		$res=$this->sub_accounts_model->select_row(array('id'=>$this->uri->segment(3)));
    ?>
<div class="form-group">
						<label class="col-sm-4 control-label">Subsidiary Title :</label>
						  <div class="col-sm-8">
						    <input type="text" class="form-control" name="title" value="<?php echo $res->title; ?>">
						  </div>
						</div>

						<div class="form-group">
						<label class="col-sm-4 control-label">Detail Type :</label>
						  <div class="col-sm-8">
							<select class="form-control" name="detail_kind">
								<option value="0" <?php if($res->detail_kind == 0) echo "selected"; ?> >None</option>
								<option value="1" <?php if($res->detail_kind == 1) echo "selected"; ?> >Independent List</option>
								<option value="2" <?php if($res->detail_kind == 2) echo "selected"; ?> >Customers</option>
								<option value="3" <?php if($res->detail_kind == 3) echo "selected"; ?> >Revolving Funds</option>
								<option value="4" <?php if($res->detail_kind == 4) echo "selected"; ?> >Employes</option>
								<option value="5" <?php if($res->detail_kind == 5) echo "selected"; ?> >Owners</option>
								<option value="6" <?php if($res->detail_kind == 6) echo "selected"; ?> >Equipments</option>
								<option value="7" <?php if($res->detail_kind == 7) echo "selected"; ?> >Bank Accounts</option>
								<option value="8" <?php if($res->detail_kind == 8) echo "selected"; ?> >General List</option>
							</select>
						  </div>
						</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <input type="submit" class="btn btn-primary" value="Save">
		      </div>