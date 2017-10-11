						<div class="page-content">
							<div class="page-bar">
								<h3 class="page-title"> Progres PHRD IV</h3>
							</div>
							<div class="margin-top-20"></div>
							<div class="row">
								<div class="col-md-12">
									<div class="portlet light bordered">
										<div class="portlet-title">
											<div class="caption font-green-sharp">
												<span class="caption-subject bold uppercase">UPDATe PASSWORD</span>
											</div>
										</div>
										<div class="portlet-body form">
											<?php echo form_open('auth/save_password','class="form-horizontal" role="form"');?>
											<form class="form-horizontal" role="form">
												<div class="form-body">
													<div class="form-group<?php if (form_error('data[old_password]')!="") echo " has-error"; ?>">
														<label class="col-md-3 control-label">Password Lama <span class="spare">:</span></label>
														<div class="col-md-9">
															<input type="text" name="data[old_password]" class="form-control"/>
															<?php echo form_error('data[old_password]'); ?>
														</div>
													</div>
													<div class="form-group<?php if (form_error('data[new_password]')!="") echo " has-error"; ?>">
														<label class="col-md-3 control-label">Password Baru <span class="spare">:</span></label>
														<div class="col-md-9">
															<input type="text" name="data[new_password]" class="form-control"/>
															<?php echo form_error('data[new_password]'); ?>
														</div>
													</div>
													<div class="form-group<?php if (form_error('data[re_password]')!="") echo " has-error"; ?>">
														<label class="col-md-3 control-label">Ulangi Password Baru <span class="spare">:</span></label>
														<div class="col-md-9">
															<input type="text" name="data[re_password]" class="form-control"/>
															<?php echo form_error('data[re_password]'); ?>
														</div>
													</div>
													<div class="form-actions fluid">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
																<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i> Update</button>
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
