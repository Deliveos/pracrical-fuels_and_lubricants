<?php
//require_once 'secure.php';
require_once "autoload.php";
$size = 20;
if (isset($_GET['page'])) {
  $page = Helper::clearInt($_GET['page']);
} else {
  $page = 1;
}
$carModelService = new CarModelService();
$count = $carModelService->count();
$car_models = $carModelService->findAll($page*$size-$size, $size);
$header = 'Список моделей транспорта';
require_once 'template/header.php';
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <section class="content-header">
        <h1>Список моделей транспорта</h1>
        <ol class="breadcrumb">
          <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li class="active">Список моделей транспорта</li>
        </ol>
      </section>
      <div class="box-body">
        <a class="btn btn-success" href="add-car-model.php">Добавить модель транспорта</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php
        if ($car_models) { ?>
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Модель</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ($car_models as $car_model) {
          echo '<tr>';
          echo '<td>'.$car_model->name.'</td>';
          echo '<td><a href="add-car-model.php?id='.$car_model->car_model_id.'"><i class="fa fa-pencil"></i></a></td>';
          echo '<td><a href="delete-car-model.php?id='.$car_model->car_model_id.'"><i class="fa fa-trash"></i></a></td>';
          echo '</tr>';
          }
          ?>
          </tbody>
        </table>
        <?php } else {
        echo 'Ни одной модели не найдено';
        } ?>
      </div>
      <div class="box-body">
        <?php Helper::paginator($count, $page, $size); ?>
      </div>
    <!-- /.box-body -->
    </div>
  </div>
</div>
<?php
require_once 'template/footer.php';
?>