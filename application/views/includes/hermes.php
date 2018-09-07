<div class="chatbox_wrapper d-print-none rounded d-none bg-light border border-warning">
	<div class="container-fluid mt-2">
		<div class="row border-bottom border-secondary pb-2">
			<div class="col">
				<i class="fas fa-comments text-warning"></i> KNT-IT Live Support <span class="float-right"><a href="#" class="close_chat">Close <i class="fas fa-sign-out-alt"></i></a></span>
			</div>
		</div>
		<div class="row bg-success text-light">
			<div class="col">
				<small><i class="fas fa-user"></i> 1 Helpdesk is currently online</small>
			</div>
		</div>
		<div class="row chat_display">
			<div class="col chat_msg_wrapper px-0">
				<div class="chat_msg border-bottom border-secondary pl-1" style="background-color: #63cddd;font-size: 13px">
					Good Day <?= $this->session->userdata('user_info')['fname'].' '.$this->session->userdata('user_info')['lname'];?>,<br>
					I'm <b>Athena</b>! How can I help you today?
					<br>
					<span class="msg_info text-light" style="font-size: 8px;">
						<i>System Generated Message</i>
					</span>
				</div>
			</div>
		</div>
		<div class="row chat_control w-100">
			<div class="col-9 p-0">
				<textarea rows="2" class="client_input rounded-0 form-control w-100"></textarea>
			</div>
			<div class="col-3 pt-0 px-0">
				<button type="button" class="btn rounded-0 btn-sm btn-info w-100 h-50 chat_send">Send <i class="fas fa-envelope"></i> </button>
				<button type="button" class="btn rounded-0 close_chat btn-sm btn-secondary w-100 h-50">End Chat <i class="fas fa-sign-out-alt"></i></button>
			</div>
		</div>
	</div>
</div>