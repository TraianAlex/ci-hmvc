 <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

        <div id="register_form_error" class="alert alert-error"><!-- Dynamic --></div>
        <?=form_open(isset($user) ? 'auths/edit/'.$user->id : 'auths/register', ['id' => "register_form", 'class' => "form-horizontal"]);?>
        
            <h3 class="text-right"><?php isset($user) ? print'Edit profile' : print'Register'?></h3>

            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <?=form_input(['type' => 'email', 'name' => 'email', 'value' => isset($user->email) ? $user->email : set_value('email'), 'class' => "form-control"]);?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" <?php isset($user->email) ? print'id="disabled" disabled' : ''?>>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" name="confirm_password" class="form-control"<?php isset($user->email) ? print'id="disabled" disabled' : ''?>>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="<?php isset($user) ? print'Save' : print'Register'?>" class="btn btn-primary">
                    <a class="btn btn-default" href="<?php isset($user) ? print site_url('auths/user/'.$user->id) : print site_url('auths')?>">Cancel</a>
                </div>
            </div>
        </form>
        </div>
        <div class="col-md-3"></div>
</div>

<script type="text/javascript">
    $(function() {
        $("#register_form_error").hide();
        
        $("#register_form").submit(function(evt) {
            evt.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();

            $.post(url, postData, function(o){
                if(o.result == 1){
                    window.location.href = '<?=base_url('auths/user')?>';
                }else{
                    $("#register_form_error").show();
                    var output = '<ul>';
                    for(var key in o.error){
                        var value = o.error[key];
                        output += '<li>' + value + '</li>';
                    }
                    output += '</ul>';
                    $("#register_form_error").html(output);
                }
            }, 'json');
        });
    });
</script>