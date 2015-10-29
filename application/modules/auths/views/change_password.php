 <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

        <div id="register_form_error" class="alert alert-error"><!-- Dynamic --></div>
        <?=form_open('auths/change_password/'.$this->session->userdata('id'), ['id' => "register_form", 'class' => "form-horizontal"]);?>
        
            <h3 class="text-right">Change password</h3>

            <div class="form-group">
                <label class="col-sm-2 control-label">Old Password</label>
                <div class="col-sm-10">
                    <?=form_input(['type' => 'password', 'name' => 'old_password', 'class' => "form-control"]);?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">New Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" name="confirm_password" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Save" class="btn btn-primary">
                    <a class="btn btn-default" href="<?=site_url('auths/user/'.$this->session->userdata('id'))?>">Cancel</a>
                </div>
            </div>
        </form>
        </div>
        <div class="col-md-3"></div>
</div>
