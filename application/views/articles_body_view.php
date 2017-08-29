<div class="col-md-3">
    <?php $this->view('per_page_view'); ?>
</div>
<div class="col-md-6">
    <?php echo $this->pagination->create_links(); ?>
</div>
<div class="col-md-3">
        <input class="searchXtable" type="text" name = "keyword" placeholder="Search" value="<?= (!empty($keyword)) ? $keyword : '' ;?>"/>
</div>
<div class="col-md-12">
<?php foreach ($content as $item): ?><br>
    <p><?= $item->title; ?></p>
    <p><?= $item->text; ?></p>
    <p><?= $item->date; ?></p>
    <p><?= $item->time; ?></p>
    <p><?= $item->id; ?></p>

    <?php if ( $this->aauth_library->is_admin(true) || $this->aauth->CI->session->userdata('id') == $item->author_id ) : ?>
        <button class="btn btn-danger pull-right btn-del" data-article-id="<?= $item->id; ?>" > Delete </button>
        <button class="btn btn-info pull-right btn-update" data-article-id="<?= $item->id; ?>" > Edit </button>
        <br>
    <?php endif; ?>
    <hr>
<?php endforeach;?>
</div>