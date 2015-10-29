<div class="row">
	<div class="col-md-3"></div>
    <div class="col-md-6">
		<?=form_open('auths/forgot_password', ['id' => "pass_form", 'class' => "form-inline", 'role' => "form"]);?>
			<div class="form-group">
				<input type="email" name="email" class="form-control" id="" placeholder="Email address">
			</div>
			<button type="submit" class="btn btn-primary">Send</button>
			<a class="btn btn-default" href="<?=site_url('auths')?>">Cancel</a>
		</form>
	</div>
    <div class="col-md-3"></div>
</div>