<?php
//require_once 'secure.php';
// if (!Helper::can('admin') && !Helper::can('manager')) {
//   header('Location: 404.php');
//   exit();
// }
require_once "autoload.php";
$id = 0;
if (isset($_GET['id'])) {
  $id = Helper::clearInt($_GET['id']);
}
$refueller = (new RefuellerService())->findById($id);
$motor_depot_id = 0;
if (!$refueller->motor_depot_id === 0) {
  $motor_depot_id = $refueller->motor_depot_id;
} elseif (isset($_POST["motor_depot_id"])) {
  $motor_depot_id = Helper::clearInt($_POST["motor_depot_id"]);
} else {
  $motor_depot_id = 1;
}


$header = (($id)?'Редактировать данные':'Добавить').' заправщика';
require_once 'template/header.php';
?>
<section class="content-header">
  <h1><?=$header;?></h1>
  <ol class="breadcrumb">
    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="list-refueller.php">Заправщики</a></li>
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

  <form action="save-refueller.php" method="POST">
    <div class="form-group">
      <label>Номер гаража</label>
      <select class="form-control" name="garage_id">
        <?= Helper::printSelectOptions($refueller->garage_id, (new GarageService)->findByMotorDepotId($motor_depot_id)); ?>
      </select>
    </div>
    <?php require_once '_formUser.php'; ?>
    <input type="hidden" name="role_id" value="1">
    <input type="hidden" name="position_id" value="1">
    <input type="hidden" name="refueller_id" value="<?= $refueller->refueller_id ?>">
    <input type="hidden" name="motor_depot_id" value="<?= $motor_depot_id; ?>">
    <input type="hidden" name="employee_id" value="<?= $refueller->employee_id ? $refueller->employee_id : 0; ?>">
    <div class="form-group">
      <label>Заблокировать</label>
      <div class="radio">
        <label>
          <input type="radio" name="active" value="1" <?=($refueller->active)?'checked':'';?>> Нет
        </label> &nbsp;
        <label>
          <input type="radio" name="active" value="0" <?=(!$refueller->active)?'checked':'';?>> Да
        </label>
      </div>
    </div>
    <div class="form-group">
      <button type="submit" name="saveRefueller" class="btn btn-primary">Сохранить</button>
    </div>
  </form>
</div>
<?php require_once 'template/footer.php'; ?>