<?php
//require_once 'secure.php';
require_once "autoload.php";
$size = 20;
if (isset($_GET['page'])) {
  $page = Helper::clearInt($_GET['page']);
} else {
  $page = 1;
}
$userService = new UserService();
$count = $userService->count();
$users = $userService->findAll($page*$size-$size, $size);
print_r($user);
$header = 'Список пользователей';
require_once 'template/header.php';
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <section class="content-header">
        <h1>Список пользователей</h1>
        <ol class="breadcrumb">
          <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li class="active">Список пользователей</li>
        </ol>
      </section>
      <div class="box-body">
        <a class="btn btn-success" href="add-user.php">Добавить пользователя</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php
        if ($users) { ?>
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Ф.И.О</th>
              <th>Дата рождения</th>
              <th>Должность</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ($users as $user) {
          echo '<tr>';
          echo '<td><a href="profile-user.php?id='.$user->user_id.'">'.$user->fio.'</a> '
          . '<a href="add-user.php?id='.$user->user_id.'"><i class="fa fa-pencil"></i></a></td>';
          echo '<td>'.$user->birthday.'</td>';
          echo '<td>'.$user->position.'</td>';
          echo '</tr>';
          }
          ?>
          </tbody>
        </table>
        <?php } else {
        echo 'Ни одного пользователя не найдено';
        } ?>
      </div>
      <div class="box-body">
        <?php Helper::paginator($count, $page, $size); ?>
      </div>
    <!-- /.box-body -->
    </div>
  </div>
</div>
<?php
require_once 'template/footer.php';
?>