<table class="table table-sm table-condensed table-bordered text-center">
	<thead class="table-info">
		<tr>
			<th>Process</th>
			<th>Standard Met</th>
			<th>Comments</th>
		</tr>
	</thead>
	<tbody>		
	<?php 
		if(count($questions)){
		foreach($questions as $question){ ?>
		<tr class="table-<?= converIcontoColor($question->standard); ?>">
			<td style="width:45%"><?= $question->process; ?></td>
			<td class="text-center">
				<?php if($question->status != 'completed'){ ?>
				<div class="btn-group" role="group">
				  <button type="button" class="btn btn-success standard_select ok" data-value="ok" title="Met Standards"><i class="fas fa-check"></i></button>
				  <button type="button" class="btn btn-danger standard_select bad" data-value="bad" title="Did not meet Standards"><i class="fas fa-times"></i></button>
				  <button type="button" class="btn btn-default standard_select na" data-value="na" title="Not Applicable"><i class="fas fa-ban"></i></button>
				</div>
				<?php }else{ ?>
					<i class="fas fa-<?= $question->standard; ?> fa-3x"></i>
				<?php } ?>
				<input type="hidden" name="question_id[]" value="<?= $question->pa_id; ?>">
				<input type="hidden" name="standard[]" value="">
			</td>
			<td class="comments" style="width:40%">
				<?php if($question->status == 'completed'){ ?>
				<?= $question->comments; ?>
				<?php }else{ ?>
				<input type="text" class="form-control form-control-sm table-form-control" name="comments[]" >
				<?php } ?>
			</td>
			<input type="hidden" id="doc_assgn_num" value="<?= $question->doc_number; ?>"/>
			<input type="hidden" id="doc_assgn_name" value="<?= $question->doc_name; ?>"/>
			<input type="hidden" id="doc_res_st" value="<?= strtoupper($question->status); ?>"/>
			<input type="hidden" id="doc_assgn_emp" value="<?= $question->e_fname.' '.$question->e_lname; ?>"/>
			<input type="hidden" id="doc_assgn_on" value="<?= humanDate($question->assigned_on); ?>"/>
			<input type="hidden" id="doc_comp_on" value="<?= humanDate($question->completed_on); ?>"/>
			<input type="hidden" id="doc_assgn_dept" value="<?= $question->department; ?>"/>
		</tr>
	<?php }}else{ ?>
		<tr class="table-warning">
			<td colspan="3" class="text-center">
				<h5 class="mt-2">Assignment Number does not exist</h5>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>