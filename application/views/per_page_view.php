<h4>
    <?php
    $per_page = isset($per_page) ? $per_page : '';

    $pageArray = [
        1, 2, 3, 4, 5, 10, 15, 20
    ];
    ?>
    <select name="count_row" id="count_row">
        <? foreach ($pageArray as $value): ?>
            <option value="<?= $value ?>" <?= ($per_page == $value) ? 'selected' : ''; ?> > <?= $value?>  </option>
        <? endforeach; ?>
    </select>

    <?php
    $sort = isset($sort) ? $sort : '';
    $sortArray = [
            'ASC'  => 'с начала',
            'DESC' => 'с новых'
    ];
    ?>
    <select name="sortXtable" id="sortXtable">
        <? foreach ($sortArray as $key => $value) : ?>
        <option value="<?= $key ?>" <?= ($sort == $key) ? 'selected' : ''; ?> > <?= $value?>  </option>
        <? endforeach; ?>
    </select>
</h4>