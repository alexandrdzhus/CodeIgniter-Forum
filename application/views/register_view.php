<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                       echo form_open('register', 'class="form-horizontal"');
                       //form-helper: open base url/register and add class...
                    ?>
                        <legend>Register</legend>


                        <div class="form-group <?php echo (form_error('username') == null) ? '' : 'has-error'  ?>">
                            <label for="username" class="col-md-2">Name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Name" value="<?php echo set_value('username'); ?>">
                                <?php echo form_error('username'); ?>
                            </div>
                        </div>    
                        <div class="form-group <?php echo (form_error('email') == null) ? '' : 'has-error'  ?>">
                            <label for="email" class="col-md-2">E-mail</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" value="<?php echo set_value('email'); ?>">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo (form_error('password') == null) ? '' : 'has-error'  ?>">
                            <label for="password" class="col-md-2">Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>
                        <div class="form-group <?php echo (form_error('passconf') == null) ? '' : 'has-error'  ?>">
                            <label for="passconf" class="col-md-2">Repeat Password</label>
                            <div class="col-md-8">                            
                                <input type="password" class="form-control" name="passconf" id="passconf" placeholder="Repeat Password" value="<?php echo set_value('passconf'); ?>">
                                <?php echo form_error('passconf'); ?>
                            </div>
                        </div>
                        <center>
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <?php echo form_submit('daftar', "Register", 'class="btn btn-primary"')
                                // type="submit" name="daftar" value="Register" class="..."
                            ?>

                        </center>
                        <span style="color: red;">*All fields are required</span>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
