 <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
      Log in
</button>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Log in</h4>
      </div>
      <div class="modal-body">
            <?=form_open('auths', ['class' => "form-horizontal"]);?>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <?=form_input(['name'=>'email', 'id'=>'email', 'class'=>'form-control', 'placeholder' => 'email']); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <?=form_password(['name'=>'password', 'id'=>'password', 'class'=>'form-control', 'placeholder' => 'password']); ?>
                </div>
            </div>
             <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?=form_submit('submit', 'Log in', 'class="btn btn-primary"'); ?>
                    or <?=anchor("auths/register", "Register", 'class="btn btn-default"');?>
                </div>
            </div>
            <?=form_close();?>
            <div class="col-sm-offset-2 col-sm-10">
                <?=anchor("auths/forgot_password", "Forgot password");?>
            </div>
            <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
</script>