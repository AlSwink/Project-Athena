<div class="row">
   <div class="col-6">
      <h4><?= $sub_menu['name']; ?></h4>
      <small class="text-light"><?= $sub_menu['description']; ?></small>
   </div>
   <div class="col">
       <button type="button" class="close" aria-label="Close" data-toggle="collapse" data-target="#megamenu">
         <span aria-hidden="true">&times;</span>
      </button>
   </div>
</div>
<hr class="border border-info">
<?php
  if($sub_menu['submenu']){ ?>
    <div class="row">
       <?php $this->load->view('dashboard/sub_menu_items',$sub_menu); ?>
    </div>
<?php } ?>