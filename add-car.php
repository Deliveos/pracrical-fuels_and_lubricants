<?php
require_once 'secure.php';
// if (!Helper::can('admin') && !Helper::can('manager')) {
//   header('Location: 404.php');
//   exit();
// }
require_once "autoload.php";
$id = 0;
if (isset($_GET['id'])) {
$id = Helper::clearInt($_GET['id']);
}
$car = (new CarService())->findById($id);
$header = (($id)?'Редактировать':'Добавить').' транспорт';
require_once 'template/header.php';
?>
<section class="content-header">
  <h1><?=$header;?></h1>
  <ol class="breadcrumb">
    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="list-car.php">Транспорт</a></li>
    <li class="active"><?=$header;?></li>
  </ol>
</section>
<div class="box-body">
  <form action="save-car.php" method="POST">
    <div class="form-group">
      <label>Гос.номер</label>
      <input type="text" class="form-control" name="state_num" required="required" value="<?= $car->state_num;?>">
    </div>
    <div class="form-group">
      <label>Модель</label>
      <select class="form-control" name="car_model_id">
        <?= Helper::printSelectOptions($car->car_model_id, (new CarModelService)->arrCarModel()); ?>
      </select>
    </div>
    <input type="hidden" name="car_id" value="<?= $id; ?>">
    <div class="form-group">
      <button type="submit" name="saveCar" class="btn btn-primary">Сохранить</button>
    </div>
  </form>
</div>
<?php require_once 'template/footer.php'; ?>