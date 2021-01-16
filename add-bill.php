<?php
require_once 'secure.php';
require_once "autoload.php";
$id = 0;
if (isset($_GET['id'])) {
$id = Helper::clearInt($_GET['id']);
}
$motor_depot_id = 0;
if (!$refueller->motor_depot_id === 0) {
  $motor_depot_id = $refueller->motor_depot_id;
} elseif (isset($_POST["motor_depot_id"])) {
  $motor_depot_id = Helper::clearInt($_POST["motor_depot_id"]);
} else {
  $motor_depot_id = 1;
}

$bill = (new BillService())->findById($id);
$bill_positions = (new BillPositionService)->findByBillId($id);
$header = (($id)?'Редактировать':'Добавить').' ведомость';
require_once 'template/header.php';
?>
<section class="content-header">
  <h1><?=$header;?></h1>
  <ol class="breadcrumb">
    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="list-car.php">Ведомости</a></li>
    <li class="active"><?=$header;?></li>
  </ol>
</section>
<div class="box-body">
<form method="post">
    <div class="form-group">
      <label>Автобаза</label>
      <select class="form-control" onchange="this.form.submit()" name="motor_depot_id">
        <?= Helper::printSelectOptions($motor_depot_id, (new MotorDepotService())->arrMotorDepot()); ?>
      </select>
    </div>
  </form>

  <form action="save-bill.php" method="POST">
    <div class="form-group">
      <label>Номер гаража</label>
      <select class="form-control" name="garage_id">
        <?= Helper::printSelectOptions($bill->garage_id, (new GarageService)->findByMotorDepotId($motor_depot_id)); ?>
      </select>
    </div>
    <div class="form-group">
      <label>Заправщик</label>
      <select class="form-control" name="car_model_id">
        <?= Helper::printSelectOptions($bill->refueller_id, (new RefuellerService)->findByMotorDepotId($motor_depot_id)); ?>
      </select>
    </div>
    <div class="form-group">
      <label>Номер ведомости</label>
      <input type="text" class="form-control" name="bill_num" value="<?= $car->state_num;?>">
    </div>
    <div class="form-group">
      <label>Дата</label>
      <input type="date" class="form-control" name="birthday" value="<?=$user->birthday;?>">
    </div>
    <input type="hidden" name="bill_id" value="<?= $id; ?>">
    <input type="hidden" name="motor_depot_id" value="<?= $motor_depot_id; ?>">
    <div class="box-body">
        <?php
        if ($bill_positions) { ?>
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Водитель</th>
              <th>Гос.номер авто</th>
              <th>Номер путевого листа</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ($bill_positions as $bill_position) {
            echo '<tr>';
            echo '<td>'.$bill_position->fio.'</td>';
            echo '<td>'.$bill_position->state_num.'</td>';
            echo '<td>'.$bill_position->waybill_num.'</td>';
            echo '<td><a href="add-bill-position.php?id='.$bill->bill_id.'"><i class="fa fa-pencil"></i></a></td>';
            echo '<td><a href="delete-bill-position.php?id='.$bill->bill_id.'"><i class="fa fa-trash"></i></a></td>';
            echo '</tr>';
          }
          ?>
          </tbody>
        </table>
        <?php } else {
        echo 'Ни одной позиции не найдено';
        } ?>
      </div>
    <div class="form-group">
      <button type="submit" name="addPosition" class="btn btn-primary">Добавить позицию</button>
    </div>
    <div class="form-group">
      <button type="submit" name="saveBill" class="btn btn-primary">Сохранить</button>
    </div>
    
  </form>
</div>
<?php require_once 'template/footer.php'; ?>