<?php
require_once 'secure.php';
require_once "autoload.php";
$met = 1;
if (isset($_POST['met'])) {
  $met = Helper::clearInt($_POST['met']);
}
$res = 0;
if (isset($_POST["start"]) && isset($_POST["end"])) {
  $start = Helper::clearString($_POST["start"]);
  $end = Helper::clearString($_POST["end"]);
  $billPositionService = new BillPositionService();
  if(isset($_POST["garage_id"])) {
    $garage_id = Helper::clearInt($_POST["garage_id"]);
    $res = $billPositionService->findAllOfRangeByGarageId($start, $end, $garage_id);
  } elseif (isset($_POST["user_id"])) {
    $user_id = Helper::clearInt($_POST["user_id"]);
    $res = $billPositionService->findAllOfRangeByDriver($start, $end, $user_id);
  } else {
    $res = $billPositionService->findAllOfRange($start, $end);
  }
}

$header = 'Поиск';
require_once 'template/header.php';
?>
<section class="content-header">
  <h1><?=$header;?></h1>
  <ol class="breadcrumb">
    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
  </ol>
</section>
<div class="box-body">
  <form method="POST">
  <label>Метод поиска</label>
      <select onchange="this.form.submit()" class="form-control" name="met">
        <option value="1" <?= $met === 1 ? 'selected' : '' ?>>Поиск количества ГСМ за определенный период</option>
        <option value="2" <?= $met === 2 ? 'selected' : '' ?>>Поиск количества ГСМ за определенный период определенного гаража</option>
        <option value="3" <?= $met === 3 ? 'selected' : '' ?>>Поиск количества ГСМ за определенный период для определенного водителя</option>
      </select>
  </form>
</div>

<? if ($met === 2): 
  $motor_depot_id = 1;
  if(isset($_POST["motor_depot_id"])) {
    $motor_depot_id= Helper::clearInt($_POST["motor_depot_id"]);
  }
  ?>
<div class="box-body">
  <form method="post">
    <div class="form-group">
      <label>Автобаза</label>
      <select class="form-control" onchange="this.form.submit()" name="motor_depot_id">
        <?= Helper::printSelectOptions($motor_depot_id, (new MotorDepotService())->arrMotorDepot()); ?>
      </select>
    </div>
    <input type="hidden" name="met" value="<?= $met; ?>">
  </form>
</div>
<? endif; ?>

<div class="box-body">
  <form action="index.php" method="POST">
    <? if ($met === 2): ?>
      <div class="form-group">
      <label>Номер гаража</label>
      <select class="form-control" name="garage_id">
        <?= Helper::printSelectOptions(Helper::clearInt($_POST["garage_id"]), (new GarageService)->findByMotorDepotId($motor_depot_id)); ?>
      </select>
    </div>
    <? endif; ?>

    <input type="hidden" name="met" value="<?= $met; ?>">

    <div class="form-group">
      <label>Начало периода</label>
      <input type="date" class="form-control" name="start" value="<?= Helper::clearString($_POST["start"]);?>">
    </div>
    <div class="form-group">
      <label>Конец периода</label>
      <input type="date" class="form-control" name="end" value="<?=Helper::clearString($_POST["end"]);?>">
    </div>

    <? if ($met === 3): ?>
    <div class="form-group">
      <label>Водитель</label>
      <select class="form-control" name="user_id">
        <?= Helper::printSelectOptions(Helper::clearInt($_POST["user_id"]), (new DriverService)->arrDriver()); ?>
      </select>
    </div>
    <? endif; ?>
    <div class="form-group">
      <button type="submit" name="search" class="btn btn-primary">Поиск</button>
    </div>
  </form>
</div>

<? if ($res) : ?>
  <div class="box-body">
    <?php
    if ($res) { ?>
    <table id="example2" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Название</th>
          <th>Количество</th>
          <th>Единица измерения</th>
        </tr>
      </thead>
      <tbody>
      <?php
      foreach ($res as $a) {
      echo '<tr>';
      echo '<td>'.$a->name.'</td>';
      echo '<td>'.$a->cnt.'</td>';
      echo '<td>'.$a->unit.'</td>';
      echo '</tr>';
      }
      ?>
      </tbody>
    </table>
    <?php } ?>
  </div>
<? endif; ?>

<?php require_once 'template/footer.php'; ?>