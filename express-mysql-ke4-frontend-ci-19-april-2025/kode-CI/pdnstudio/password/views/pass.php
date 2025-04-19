<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed'); ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo isset($pdn_title) ? $pdn_title	: 'Administrator | Pudin Project'; ?></h1>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <?= form_open(base_url($pdn_url), 'class="form-horizontal mt-4" role="form"'); ?>
                                    <div class="tile-body">
                                    <div class="form-group row">
                                            <label class="control-label col-md-3">Password Baru</label>
                                            <div class="col-md-8">
                                                <?php echo form_input($password1);?>
                                                <?=form_error('password1','<small class="text-danger pl-3">','</small>');?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-3">Ulangi Password Baru</label>
                                            <div class="col-md-8">
                                                <?php echo form_input($repassword);?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tile-footer">
                                        <div class="row ">
                                            <div class="col-md-12 text-right mt-5">
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?= form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
					