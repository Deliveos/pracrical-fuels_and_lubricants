<?php
//require_once 'secure.php';
require_once "autoload.php";
$size = 20;
if (isset($_GET['page'])) {
  $page = Helper::clearInt($_GET['page']);
} else {
  $page = 1;
}
$carService = new CarService();
$count = $carService->count();
$cars = $carService->findAll($page*$size-$size, $size);
$header = 'Список транспорта';
require_once 'template/header.php';
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <section class="content-header">
        <h1>Список транспорта</h1>
        <ol class="breadcrumb">
          <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li class="active">Список транспорта</li>
        </ol>
      </section>
      <div class="box-body">
        <a class="btn btn-success" href="add-car.php">Добавить транспорт</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php
        if ($cars) { ?>
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Гос.номер</th>
              <th>Модель</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ($cars as $car) {
          echo '<tr>';
          echo '<td>'.$car->state_num.'</td>';
          echo '<td>'.$car->model.'</td>';
          echo '<td><a href="add-car.php?id='.$car->car_id.'"><i class="fa fa-pencil"></i></a></td>';
          echo '<td><a href="delete-car.php?id='.$car->car_id.'"><i class="fa fa-trash"></i></a></td>';
          echo '</tr>';
          }
          ?>
          </tbody>
        </table>
        <?php } else {
        echo 'Ни одного автомобиля не найдено';
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