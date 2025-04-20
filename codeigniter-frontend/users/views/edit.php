					<div class="card shadow mb-4">
                        <div class="card-body">
                        	<div class="text-center mb-5">
                        		<h4><?=$pdn_title;?></h4>
                        	</div>
                        	</hr>
                        	<?= form_open_multipart(base_url($pdn_uform), 'class="form-horizontal" role="form"'); 
                        		echo form_hidden('id', base64_encode($edit_data->id_users));
                        	?>
								<div class="tile-body">
									<div class="form-group row">
										<label class="control-label col-md-3">Nama</label>
										<div class="col-md-8">
											<?php echo form_input($nama);?>
											<?=form_error('nama','<small class="text-danger pl-3">','</small>');?>
										</div>
									</div>
									<div class="form-group row">
										<label class="control-label col-md-3">Email</label>
										<div class="col-md-8">
											<?php echo form_input($email);?>
											<?=form_error('email','<small class="text-danger pl-3">','</small>');?>
										</div>
									</div>
									<div class="form-group row">
										<label class="control-label col-md-3">Level</label>
										<div class="col-md-8">
											<select class="form-control" id="pDn_Select1" name="level">
												<option value="Guest"> -- <?=$edit_data->users_level;?> --</option>
												<option value="Guest">Guest</option>
												<option value="Admin">Admin</option>
											</select>
										</div>
									</div>
								</div>
								<div class="tile-footer">
									<div class="row ">
										<div class="col-md-12 text-right mt-5">
											<a class="btn btn-secondary" href="<?=base_url($pdn_url);?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Kembali</a>
											<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><?=$pdn_page;?></button>
										</div>
									</div>
								</div>
							<?= form_close();?>
                        </div>
                    </div>