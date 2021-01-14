<?php
//require_once 'secure.php';
require_once "autoload.php";
$size = 20;
if (isset($_GET['page'])) {
  $page = Helper::clearInt($_GET['page']);
} else {
  $page = 1;
}
$driverService = new DriverService();
$count = $driverService->count();
$drivers = $driverService->findAll($page*$size-$size, $size);
$header = 'Список сотрудников';
require_once 'template/header.php';
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <section class="content-header">
        <h1>Список сотрудников</h1>
        <ol class="breadcrumb">
          <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li class="active">Список сотрудников</li>
        </ol>
      </section>
      <div class="box-body">
        <a class="btn btn-success" href="add-driver.php">Добавить сотрудника</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php
        if ($drivers) { ?>
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Ф.И.О</th>
              <th>Дата рождения</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ($drivers as $driver) {
            echo '<tr>';
            echo '<td><a href="profile-driver.php?id='.$driver->user_id.'">'.$driver->fio.'</a> '
            . '<a href="add-driver.php?id='.$driver->user_id.'"><i class="fa fa-pencil"></i></a></td>';
            echo '<td>'.$driver->birthday.'</td>';
            echo '<td><a href="delete-driver.php?id='.$driver->user_id.'"><i class="fa fa-trash"></i></a></td>';
            echo '</tr>';
          }
          ?>
          </tbody>
        </table>
        <?php } else {
        echo 'Ни одного пользователя не найдено';
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