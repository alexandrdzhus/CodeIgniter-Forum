<div class="content">
    <table width="100%">
        <tr class="section">
            <td>
                <div class="col-md-10">
                    <button type="button" id="send" class="btn btn-primary">Add post</button>
                </div>
                <div class="col-md-2">
                    <button type="button" id='refresh' class="btn btn-info"><span class="glyphicon glyphicon-refresh"></span></button>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="col-md-2">

                </div>
                <div id="articles_body" data-url="/articles/pagination/" class="col-md-8">
                     <?php $this->view('articles_body_view'); ?>
                </div>
            </td>
        </tr>
    </table>
</div>