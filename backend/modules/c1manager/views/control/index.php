<?php


$this->title = t('1C API CONTROL');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
    <div class="table-responsive-md" style="width: 1100px;">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Url</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($apis as $api): ?>
                <tr>
                    <th scope="row"><?= $api->description ?></th>
                    <td><?= $api->url ?></td>
                    <td><a class="btn btn-primary"
                           href="<?= \yii\helpers\Url::to(['control/update', 'id' => $api->id]) ?>"><i
                                    class="fa fa-edit"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
