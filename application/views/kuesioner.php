										<div class="row">
											<div class="col-md-12">
												<div class="portlet light bordered">
												<?php if($kuesioner){ 
													echo $kuesioner->nama;
												
												?>
													
												
												<?php } else {
													echo $this->session->flashdata('err_message');
												} ?>
												
												<table class="table table-ligt table-striped table-bordered">
													<thead>
														<tr>
															<th rowspan="2">No.</th>
															<th rowspan="2">Pertanyaan</th>
															<th colspan="5">Tingkat Kepuasan</th>
														</tr>
														<tr>
															<th>SP</th>
															<th>P</th>
															<th>BB</th>
															<th>TP</th>
															<th>STP</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach($quesioner->result() AS $q){?>
														<tr>
															<?php
															if(@$q->hide_dom == 'TRUE' && $datadiri->prog == 'Dalam Negeri'){
															
															}else{
																if($q->type == "title"){
																	echo '<td><b>'.$q->order.'</b></td>';
																}else{
																	echo '<td>'.$q->order.'</td>';
																}
															
																if($q->type == "title"){
																	echo '<td colspan="6"><b>'.$q->soal.'</b><input type="hidden" name="soal['.$q->id_soal.']"</td>';
																}else if($q->type == "essay"){
																	echo '<td colspan="6">'.$q->soal.'</td>';
																}else{
																	echo '<td>'.$q->soal.'</td>';
																}
																
																if($q->type == "kepuasan"){
																	if(@$q->jawaban == 1){
																		$checked = array('checked','disabled','disabled','disabled','disabled');
																	}elseif(@$q->jawaban == 2){
																		$checked = array('disabled','checked','disabled','disabled','disabled');
																	}elseif(@$q->jawaban == 3){
																		$checked = array('disabled','disabled','checked','disabled','disabled');
																	}elseif(@$q->jawaban == 4){
																		$checked = array('disabled','disabled','disabled','checked','disabled');
																	}elseif(@$q->jawaban == 5){
																		$checked = array('disabled','disabled','disabled','disabled','checked');
																	}else{
																		$checked = array('','','','','');
																	}
																	echo '<td align="center">
																			<input type="radio" value="1" name="soal['.$q->id_soal.']" required '.$checked[0].'>
																		</td>';
																	echo '<td align="center">
																			<input type="radio" value="2" name="soal['.$q->id_soal.']" required '.$checked[1].'>
																		</td>';
																	echo '<td align="center">
																			<input type="radio" value="3" name="soal['.$q->id_soal.']" required '.$checked[2].'>
																		</td>';
																	echo '<td align="center">
																			<input type="radio" value="4" name="soal['.$q->id_soal.']" required '.$checked[3].'>
																		</td>';
																	echo '<td align="center">
																			<input type="radio" value="5" name="soal['.$q->id_soal.']" required '.$checked[4].'>
																		</td>';
																}elseif($q->type == "truefalse"){
																	if(@$q->jawaban == 'Ya'){
																		$checked = array('checked','disabled');
																	}elseif(@$q->jawaban == 'Tidak'){
																		$checked = array('disabled','checked');
																	}else{
																		$checked = array('','');
																	}
																	echo '<td align="center" colspan="5">
																			<input type="radio" value="Ya" name="soal['.$q->id_soal.']" required '.$checked[0].'> YA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																			<input type="radio" value="Tidak" name="soal['.$q->id_soal.']" required '.$checked[1].'> TIDAK
																		</td>';
																}elseif($q->type == "radio"){
																	$a = explode('|',$q->ket_jawaban);
																	echo '<td colspan="5">';
																	foreach ($a AS $b => $v){
																		if(@$q->jawaban != ""){
																			if($q->jawaban == $v){ $c = 'checked';}else{$c='disabled';};
																		} else{
																			$c = '';
																		}
																		echo '<input type="radio" value="'. $v .'" name="soal['.$q->id_soal.']" required '.$c.'> '. $v .'<br />';
																	}
																	echo'</td>';
																}elseif($q->type == "essay"){
																	echo '</tr><tr>
																		<td></td>
																		<td colspan="6"><textarea name="soal[' .$q->id_soal .']" class="form-control" rows="5" required>'. @$q->jawaban .'</textarea></td>';
																}elseif($q->type == "text"){
																	echo '</tr><tr>
																		<td></td>
																		<td colspan="6"><input type="text" name="soal[' .$q->id_soal .']" class="form-control"  required value="'. @$q->jawaban .'"></td>';
																}
															}
															?>
														</tr>
														<?php }?>
													</tbody>
												</table>
												</div>
											</div>
										</div>
