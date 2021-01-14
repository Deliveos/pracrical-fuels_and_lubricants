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
$employee = (new EmployeeService())->findById($id);
$header = (($id)?'Редактировать данные':'Добавить').' сотрудника';
require_once 'template/header.php';
?>
<section class="content-header">
  <h1><?=$header;?></h1>
  <ol class="breadcrumb">
    <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
    <li><a href="list-user.php">Сотрудники</a></li>
    <li class="active"><?=$header;?></li>
  </ol>
</section>
<div class="box-body">
  <form action="save-user.php" method="POST">
    <?php require_once '_formUser.php'; ?>
      <input type="hidden" name="role_id" value="3">
    <div class="form-group">
      <label>Должность</label>
      <select class="form-control" name="position_id">
        <?= Helper::printSelectOptions($employee->position_id, (new PositionService())->arrPosition());?>
      </select>
    </div>
    <div class="form-group">
      <label>Логин</label>
      <input type="text" class="form-control" name="login" required="required" value="<?=$user->login;?>">
    </div>
    <div class="form-group">
      <label>Пароль</label>
      <input type="password" class="form-control" name="password" required="required">
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