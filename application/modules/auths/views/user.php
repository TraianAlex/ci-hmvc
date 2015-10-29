<div class="container">
	<div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        	<?php if($user):?>
        		Email: <?=$user->email;
        	endif; ?>
        	<?=anchor('auths/edit/'.$user->id, 'Edit', 'class="btn btn-primary btn-lg"');?>
                <?=anchor('auths/change_password/'.$user->id, 'Change password', 'class="btn btn-primary btn-lg"');?>
        	<?=anchor('auths/delete_account', 'Delete account', 'class="btn btn-primary btn-lg"');?>
                <a class="btn btn-default" href="<?=site_url('auths')?>">Cancel</a>
        </div>
        <div class="col-md-3"></div>
	</div>
</div>