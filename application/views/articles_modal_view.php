<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><?= $header?></h4>
</div>
<div class="modal-error"></div>
<div class="modal-body">
    <form method="post" id="user_form">
        <input type="hidden" name="article_id" id="article_id" value="<?= isset($article['article_id']) ? $article['article_id'] : null ?>"/>
        <input type="hidden" name="date" value="<?php echo date('Y-m-d')?>">
        <input type="hidden" name="time" value="<?php echo date('H:i:s')?>">

        <label for="title">Enter Title</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="<?= isset($article['title']) ? $article['title'] : null ?>" >
         <br />
        <label for="text">Enter Text</label>
        <textarea  name="text" id="text" cols="30" rows="10" class="form-control" placeholder="Text"  ><?= isset($article['text']) ? $article['text'] : null ?></textarea>
         <br />
    </form>
</div>
<div class="modal-footer">

    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="button" name="action" id="action" class="btn btn-primary"><?= $button?></button>
</div>
