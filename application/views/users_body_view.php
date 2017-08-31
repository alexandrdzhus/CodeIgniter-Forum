<div class="col-md-6">
    <?php $this->view('per_page_view'); ?>
</div>
<div class="col-md-6">
    <?php echo $this->pagination->create_links(); ?>
</div>

<table class="table table-bordered">
    <tr>
        <td>ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Sex</td>
        <td>Year of Birth</td>
        <td>Edit Profile</td>
    </tr>
    <?php foreach ($content as $item): ?><br>
    <tr>
        <td><?= $item->id; ?></td>
        <td><?= $item->firstname; ?></td>
        <td><?= $item->lastname; ?></td>
        <td><?= $item->sex; ?></td>
        <td><?= $item->year_of_birth; ?></td>
        <td>
            <button class="btn btn-danger btn-del" data-user-id="<?= $item->id; ?>" > Delete </button>
            <button class="btn btn-info btn-update" data-user-id="<?= $item->id; ?>" > Edit </button>
        </td>
    </tr>
    <?php endforeach;?>

</table>
