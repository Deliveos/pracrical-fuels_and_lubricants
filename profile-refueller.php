<?php
require_once 'secure.php';
if (isset($_GET['id'])) {
$id = Helper::clearInt($_GET['id']);
} else {
header('Location: 404.php');
}
$header = 'Профиль заправщика';
$refueller = (new RefuellerService())->findById($id);
require_once 'template/header.php';
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <section class="content-header">
        <h1>Профиль заправщика</h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="list-employee.php">Заправщики</a></li>
          <li class="active">Профиль</li>
        </ol>
      </section>
      <div class="box-body">
        <a class="btn btn-success" href="add-employee.php?id=<?=$id;?>">Изменить</a>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-hover">
          <?php require_once '_profile.php';?>
          <tr>
            <th>Должность</th>
            <td><?= $refueller->position;?></td>
          </tr>
          <tr>
            <th>Автобаза</th>
            <td><?= $refueller->motor_depot;?></td>
          </tr>
          <tr>
            <th>Номер гаража</th>
            <td><?= $refueller->garage;?></td>
          </tr>
          <tr>
            <th>Действующий сотрудник</th>
            <td><?=($refueller->active) ? 'Да' : 'Нет';?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<?php
require_once 'template/footer.php';
?>