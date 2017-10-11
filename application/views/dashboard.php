							<div class="row">
								<div class="col-md-12">
                                    <!-- BEGIN PROFILE SIDEBAR -->
									<div class="profile-sidebar">
										<!-- PORTLET MAIN -->
										<div class="portlet light profile-sidebar-portlet bordered">
											<!-- SIDEBAR USERPIC -->
											<div class="profile-userpic">
												<?php
													if(!empty($profil->foto)){
														if(file_exists('media/img/profile/'.$profil->foto)){
															echo '<img src="'.base_url().'media/img/profile/'.$profil->foto .'" class="img-responsive" alt="" />';
														}else{
															echo '<img src="'.base_url().'media/img/profile/profile_user.jpg" class="img-responsive" alt="" />';
														}
													}else{
														echo '<img src="'.base_url().'media/img/profile/profile_user.jpg" class="img-responsive" alt="" />';
													}
												?>
											</div>
											<!-- END SIDEBAR USERPIC -->
											<!-- SIDEBAR USER TITLE -->
											<div class="profile-usertitle">
												<div class="profile-usertitle-name"><?php echo ucwords(strtoupper($profil->nama));?></div>
												<div class="profile-usertitle-job"><?php echo ucwords(strtoupper($profil->nip));?></div>
											</div>
											<!-- END SIDEBAR USER TITLE -->
										</div>
										<!-- END PORTLET MAIN -->
										<!-- PORTLET MAIN -->
										<div class="portlet light bordered">
											<div>
												<h4 class="profile-desc-title">INFORMASI DIKLAT</h4>
												<?php
													if($profil->id_kategori == '00001'){
														$diklat = 'DIKLAT GELAR';
														
														if($profil->id_lokasi == '00001'){
															$program = 'DALAM NEGERI';
														}else if($profil->id_lokasi == '00002'){
															$program = 'OVERSEAS';
														}else if($profil->id_lokasi == '00003'){
															$program = 'LINKAGE';
														}else{
															$program = 'UNKNOWN';
														}
														
														$this->db->where("id_master = '$profil->id_jurusan' AND flag='2'");
														$j = $this->db->get('ts_jurusan')->row();
														
														$jurusan = $j->description;
														
														$this->db->where("id_master = '$profil->id_univ' AND flag='2'");
														$u = $this->db->get('ts_universitas')->row();
														
														$universitas = $u->description;
														
														echo "
															<table class=\"table profile-desc\">
																<tr>
																	<td><strong>DIKLAT:</strong><br />$profil->seleksi</td>
																</tr>
																<tr>
																	<td><strong>PRODI:</strong><br />$jurusan</td>
																</tr>
																<tr>
																	<td><strong>UNIVERSITAS:</strong><br />$universitas</td>
																</tr>
																<tr>
																	<td><strong>PROGRAM:</strong><br />$program</td>
																</tr>
															</table>
														";
													}else{
														echo "
															<table class=\"table profile-desc\">
																<tr>
																	<td><strong>DIKLAT:</strong><br />$profil->seleksi</td>
																</tr>
																<tr>
																	<td><strong>PROGRAM:</strong><br />$profil->program</td>
																</tr>
															</table>
														";
													}
												?>
											</div>
										</div>
										<!-- END PORTLET MAIN -->
									</div>
									<!-- END OFF PROFILE SIDEBAR -->
                                    <!-- BEGIN PROFILE CONTENT -->
									<div class="profile-content">
										<div class="row">
											<div class="col-md-12">
												<div class="portlet light bordered">
													<h4 class="profile-desc-title">SELAMAT DATANDG DI ALUMNI SURVEY PHRD IV<br />PUSBINDIKLATREN - BAPPENAS</h4>
													<p><strong>Pengantar</strong><br >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> <hr />
													
													<div class="caption">
														<i class="icon-list font-red-sunglo"></i>
														<span class="caption-subject font-red-sunglo bold uppercase">DAFTAR KUESIONER</span>
													</div>
													<table class="table uppercase">
														<thead>
															<tr>
																<th>KUESIONER</th>
																<th>WAKTU PENGISIAN</th>
																<th>STATUS</th>
																<th>AKSI</th>
															</tr>
														</thead>
														<tbody>
														<?php foreach($kuesioner->result() AS $k){ ?>
															<tr>
																<td><?php echo $k->nama ?></td>
																<td><?php echo tgl_indo($k->date_start) .' S/D '. tgl_indo($k->date_end); ?></td>
																<td>
																	<?php
																		$date = date('Y-m-d');
																		if($date >= $k->date_start AND $date <= $k->date_end){
																			echo '<span class="label label-sm label-success"> Available </span>';
																			$isi = TRUE;
																		}else{
																			echo '<span class="label label-sm label-danger"> Unavailable </span>';
																			$isi = FALSE;
																		}
																	?>
																</td>
																<td>
																	<?php
																		if($isi){echo anchor('kuesioner/isi-kuesioner/tracer','Isi Kuesioner','class="btn btn-warning btn-sm"');}
																	?>
																</td>
															</tr>
														<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<!-- END OFF PROFILE CONTENT -->
								</div>
							</div>
