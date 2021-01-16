<?php
//require_once 'secure.php';
require_once "autoload.php";
$size = 20;
if (isset($_GET['page'])) {
  $page = Helper::clearInt($_GET['page']);
} else {
  $page = 1;
}
$refuellerService = new RefuellerService();
$count = $refuellerService->count();
$refuellers = $refuellerService->findAll($page*$size-$size, $size);
$header = 'Список заправщиков';
require_once 'template/header.php';
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <section class="content-header">
        <h1>Список заправщиков</h1>
        <ol class="breadcrumb">
          <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li class="active">Список заправщиков</li>
        </ol>
      </section>
      <div class="box-body">
        <a class="btn btn-success" href="add-refueller.php">Добавить заправщика</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php
        if ($refuellers) { ?>
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Ф.И.О</th>
              <th>Дата рождения</th>
              <th>Автобаза</th>
              <th>Номер гаража</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ($refuellers as $refueller) {
          echo '<tr>';
          echo '<td><a href="profile-refueller.php?id='.$refueller->user_id.'">'.$refueller->fio.'</a> '
          . '<a href="add-refueller.php?id='.$refueller->user_id.'"><i class="fa fa-pencil"></i></a></td>';
          echo '<td>'.$refueller->birthday.'</td>';
          echo '<td>'.$refueller->motor_depot.'</td>';
          echo '<td>'.$refueller->garage.'</td>';
          echo '<td><a href="delete-refueller.php?id='.$refueller->user_id.'"><i class="fa fa-trash"></i></a></td>';
          echo '</tr>';
          }
          ?>
          </tbody>
        </table>
        <?php } else {
        echo 'Ни одного заправщика не найдено';
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