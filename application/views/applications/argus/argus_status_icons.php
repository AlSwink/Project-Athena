<i class="fas fa-clipboard-list fa-xs <?= (in_array('started',$stage) ? 'text-success' : 'text-muted' ); ?>" title="Start"></i>
<i class="fas fa-boxes fa-xs <?= (in_array('verification',$stage) ? 'text-success' : 'text-muted' ); ?>" title="Verification"></i>
<i class="fas fa-pallet fa-xs <?= (in_array('verified',$stage) ? 'text-success' : 'text-muted' ); ?>" title="QA Verify"></i>
<i class="fas fa-truck-loading fa-xs <?= (in_array('loaded',$stage) ? 'text-success' : 'text-muted' ); ?>" title="Load"></i>
<i class="fas fa-clipboard-check fa-xs <?= (in_array('signed',$stage) ? 'text-success' : 'text-muted' ); ?>" title="Sign"></i>
<i class="fas fa-truck fa-xs <?= (in_array('released',$stage) ? 'text-success' : 'text-muted' ); ?>" title="Release"></i>