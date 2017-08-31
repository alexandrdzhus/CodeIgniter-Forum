<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><?= $header?></h4>
</div>
<div class="modal-error"></div>
<div class="modal-body">
    <form method="post" id="user_form">

        <input type="hidden" name="user_id" id="user_id" value="<?= isset($user['user_id']) ? $user['user_id'] : null ?>"/>

        <label for="firstname">Edit First name</label>
        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First name" value="<?= isset($user['firstname']) ? $user['firstname'] : null ?>" >
        <br />
        <label for="lastname">Edit Last name</label>
        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last name" value="<?= isset($user['lastname']) ? $user['lastname'] : null ?>" >
        <br />
        <label for="lastname">Edit Last name</label>
        <? $sex = isset($sex) ? $sex : '';
        $sexArr = [
            'm'  => 'Male',
            'f' => 'Female'
        ]; ?>
        <select name="sex" id="sex" class="form-control">
            <? foreach ($sexArr as $key => $value) : ?>
                <option value="<?= $key ?>" <?= ($sex == $key) ? 'selected' : ''; ?> > <?= $value?> </option>
            <? endforeach; ?>
        </select>

        <br />
        <label for="year_of_birth">Edit Year of birth</label>
        <input type="text" name="year_of_birth" id="year_of_birth" class="form-control" placeholder="Year of birth" value="<?= isset($user['year_of_birth']) ? $user['year_of_birth'] : null ?>" >
        <br />



    </form>
</div>
<div class="modal-footer">

    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="button" name="action" id="action" class="btn btn-primary"><?= $button?></button>
</div>
