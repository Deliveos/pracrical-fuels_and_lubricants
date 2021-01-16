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
$fal = (new FaLService())->findById($id);
$header = (($id)?'Редактировать':'Добавить').' ГСМ';
require_once 'template/header.php';
?>
<section class="content-header">
  <h1><?=$header;?></h1>
  <ol class="breadcrumb">
    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="list-fal.php">ГСМ</a></li>
    <li class="active"><?=$header;?></li>
  </ol>
</section>
<div class="box-body">
  <form action="save-fal.php" method="POST">
    <div class="form-group">
      <label>Название топлива</label>
      <input type="text" class="form-control" name="name" required="required" value="<?= $fal->name;?>">
    </div>
    <div class="form-group">
      <label>Единица измерения</label>
      <select class="form-control" name="unit_id">
        <?= Helper::printSelectOptions($car->unit_id, (new UnitService)->arrUnit()); ?>
      </select>
    </div>
      <input type="hidden" name="fal_id" value="<?= $id; ?>">
    <div class="form-group">
      <button type="submit" name="saveFaL" class="btn btn-primary">Сохранить</button>
    </div>
  </form>
</div>
<?php require_once 'template/footer.php'; ?>