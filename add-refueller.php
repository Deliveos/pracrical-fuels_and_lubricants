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
  <form action="save-refueller.php" method="POST">
    <?php require_once '_formUser.php'; ?>
      <input type="hidden" name="role_id" value="1">
    <div class="form-group">
      <label>Автобаза</label>
      <select class="form-control" name="motor_depot_id">
        <?= Helper::printSelectOptions($refueller->motor_depot_id, (new MotorDepotService())->arrMotorDepot());?>
      </select>
    </div>
    <div class="form-group">
      <label>Номер гаража</label>
      <input type="number" min="0" class="form-control" name="garage_num" value="<?= (new GarageService)->findByNumAndMotorDepot($refueller->garage_id, $refueller->motor_depot_id);?>">
    </div>
    <div class="form-group">
      <label>Заблокировать</label>
      <div class="radio">
        <label>
          <input type="radio" name="active" value="1" <?=($user->active)?'checked':'';?>> Нет
        </label> &nbsp;
        <label>
          <input type="radio" name="active" value="0" <?=(!$user->active)?'checked':'';?>> Да
        </label>
      </div>
    </div>
    <div class="form-group">
      <button type="submit" name="saveTeacher" class="btn btn-primary">Сохранить</button>
    </div>
  </form>
</div>
<?php require_once 'template/footer.php'; ?>