<?php foreach($notifications as $notification){ ?>
	<a href="#" class="dropdown-item notification_items"><?= getNotificationIcon($notification->notification_type).' '.$notification->notification; ?>.<br><span class="notification_time">About <?= getSince($notification->created); ?> ago.</span></a>
<?php } ?>

<?php if($count > 10){ ?>
	<a href="#" class="dropdown-item text-center pb-2"><small>See all <b>(<?= $count - 10; ?>)</b> unread <?= (($count - 10) > 1 ? 'notifications' : 'notification'); ?></small></a>
<?php }elseif($count == 0){ ?>
	<span class="dropdown-item text-center border-bottom border-light">
		<!--img src="<?= base_url('assets/img/good_job.gif'); ?>" width="100%"-->
		<i class="far fa-thumbs-up fa-3x my-3"></i>
		<br>
		<p class="lead text-info">All caught up. Good Job!</p>
	</span>
	<a href="#" class="dropdown-item text-center pb-2"><small>See all Notifications</small></a>
<?php }else{ ?>
	<a href="#" class="dropdown-item text-center pb-2"><small>See all Notifications</small></a>
<?php } ?>