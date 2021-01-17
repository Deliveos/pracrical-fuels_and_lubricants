<?php
require_once 'secure.php';
require_once "autoload.php";
$size = 20;
if (isset($_GET['page'])) {
  $page = Helper::clearInt($_GET['page']);
} else {
  $page = 1;
}
$billService = new BillService();
$count = $billService->count();
$bills = $billService->findAll($page*$size-$size, $size);
$header = 'Список ведомостей';
require_once 'template/header.php';
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <section class="content-header">
        <h1>Список ведомостей</h1>
        <ol class="breadcrumb">
          <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li class="active">Список ведомостей</li>
        </ol>
      </section>
      <div class="box-body">
        <a class="btn btn-success" href="add-bill.php">Добавить ведомость</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php
        if ($bills) { ?>
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Номер ведомости</th>
              <th>Заправщик</th>
              <th>Дата</th>
              <th>Автобаза</th>
              <th>Номер гаража</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ($bills as $bill) {
            echo '<tr>';
            echo '<td><a href="profile-bill.php?id='.$bill->bill_id.'">'.$bill->bill_num.'</a></td>';
            echo '<td>'.$bill->fio.'</td>';
            echo '<td>'.$bill->date.'</td>';
            echo '<td>'.$bill->motor_depot.'</td>';
            echo '<td>'.$bill->garage_num.'</td>';
            echo '<td><a href="add-bill.php?id='.$bill->bill_id.'"><i class="fa fa-pencil"></i></a></td>';
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