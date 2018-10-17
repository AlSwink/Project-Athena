<i class="fas fa-clipboard-list fa-xs <?= ($stage >= 2 ? 'text-success' : 'text-muted' ); ?>" title="Start"></i>
<i class="fas fa-boxes fa-xs <?= ($stage >= 3 ? 'text-success' : 'text-muted' ); ?>" title="Verification"></i>
<i class="fas fa-pallet fa-xs <?= ($stage >= 4 ? 'text-success' : 'text-muted' ); ?>" title="QA Verify"></i>
<i class="fas fa-truck-loading fa-xs <?= ($stage >= 5 ? 'text-success' : 'text-muted' ); ?>" title="Load"></i>
<i class="fas fa-clipboard-check fa-xs <?= ($stage >= 6 ? 'text-success' : 'text-muted' ); ?>" title="Sign"></i>
<i class="fas fa-truck fa-xs <?= ($stage >= 7 ? 'text-success' : 'text-muted' ); ?>" title="Release"></i>