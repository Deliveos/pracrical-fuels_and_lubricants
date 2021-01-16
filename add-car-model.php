<?php
require_once 'secure.php';
require_once "autoload.php";
$id = 0;
if (isset($_GET['id'])) {
$id = Helper::clearInt($_GET['id']);
}
$car_model = (new CarModelService())->findById($id);
$header = (($id)?'Редактировать':'Добавить').' модель транспорта';
require_once 'template/header.php';
?>
<section class="content-header">
  <h1><?=$header;?></h1>
  <ol class="breadcrumb">
    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="list-car.php">Модели транспорта</a></li>
    <li class="active"><?=$header;?></li>
  </ol>
</section>
<div class="box-body">
  <form action="save-car-model.php" method="POST">
    <div class="form-group">
      <label>Название модели</label>
      <input type="text" class="form-control" name="name" required="required" value="<?= $car_model->name;?>">
    </div>
      <input type="hidden" name="car_model_id" value="<?= $id; ?>">
    <div class="form-group">
      <button type="submit" name="saveCarModel" class="btn btn-primary">Сохранить</button>
    </div>
  </form>
</div>
<?php require_once 'template/footer.php'; ?>