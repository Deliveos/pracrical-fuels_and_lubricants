<?php
require_once 'secure.php';
require_once "autoload.php";
$bill_id = 0;
$bill_position_id = 0;
if (isset($_GET['bill_id'])) {
$bill_id = Helper::clearInt($_GET['bill_id']);
}
if (isset($_GET['bill_position_id'])) {
  $bill_position_id = Helper::clearInt($_GET['bill_position_id']);
}
$bill_position = (new BillPositionService())->findById($bill_position_id);
$header = (($id)?'Редактировать':'Добавить').' позицию ведомости';
require_once 'template/header.php';
?>
<section class="content-header">
  <h1><?=$header;?></h1>
</section>
<div class="box-body">
  <form action="save-bill-position.php" method="POST">
    <div class="form-group">
      <label>Номер путевого листа</label>
      <input type="text" class="form-control" name="waybill_num" required="required" value="<?= $bill_position->waybill_num;?>">
    </div>
    <div class="form-group">
      <label>Водитель</label>
      <select class="form-control" name="user_id">
        <?= Helper::printSelectOptions($bill_position->user_id, (new DriverService)->arrDriver()); ?>
      </select>
    </div>
    <div class="form-group">
      <label>Транспорт</label>
      <select class="form-control" name="car_id">
        <?= Helper::printSelectOptions($bill_position->car_id, (new CarService)->arrCar()); ?>
      </select>
    </div>
    <div class="form-group">
      <label>ГСМ</label>
      <select class="form-control" name="fal_id">
        <?= Helper::printSelectOptions($bill_position->fai_id, (new FaLService)->arrFaL()); ?>
      </select>
    </div>
    <div class="form-group">
      <label>Количество ГСМ</label>
      <input type="text" class="form-control" name="count" required="required" value="<?= $bill_position->count;?>">
    </div>
    <input type="hidden" name="bill_position_id" value="<?= $bill_position_id; ?>">
    <input type="hidden" name="bill_id" value="<?= $bill_id; ?>">
    <div class="form-group">
      <button type="submit" name="saveBillPosition" class="btn btn-primary">Сохранить</button>
    </div>
  </form>
</div>
<?php require_once 'template/footer.php'; ?>