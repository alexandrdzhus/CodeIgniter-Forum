<div class="container" style="margin-top: 100px">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                        echo form_open('login', 'class="form-horizontal"');  
                    ?>
                    <legend>Login</legend>
                       <div class="form-group <?php echo (form_error('email') == null) ? '' : 'has-error'  ?>">
                            <label for="email" class="col-md-2 control-label">E-mail</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="<?php echo set_value('email'); ?>">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo (form_error('password') == null) ? '' : 'has-error'  ?>">
                            <label for="password" class="col-md-2 control-label">Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                        <center>
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="login" id="login">Login</button>
                        </center>
                        <span style="color: red;">*All fields are required</span>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>