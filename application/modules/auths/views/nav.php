<div class="container">
	<div class="row">
		<div class="right">
			<?php if(is_numeric($this->session->userdata('id')) && $this->session->userdata('logged_in') == true):?>
			  <?=anchor("auths/user", "User profile", 'class="btn btn-primary btn-lg"');?>
			  <?=anchor("auths/log_out", "Log out", 'class="btn btn-primary btn-lg"');?> 
			<?php else:?>
			<?=anchor("", "Home", ['class' => "btn btn-primary btn-lg", 'data-toggle' => "modal", 'data-target' => "auths/#myModal"]);?> 
			<?=anchor("auths/register", "Register", 'class="btn btn-primary btn-lg"');?> 
			<?=anchor("auths/forgot_password", "Forgot password", 'class="btn btn-primary btn-lg"');?>
			<?php endif;?>
			<?=$this->session->flashdata('m')?>
		</div>
	</div>
</div>