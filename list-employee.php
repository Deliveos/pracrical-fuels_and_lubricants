<?php
//require_once 'secure.php';
require_once "autoload.php";
$size = 20;
if (isset($_GET['page'])) {
  $page = Helper::clearInt($_GET['page']);
} else {
  $page = 1;
}
$employeeService = new EmployeeService();
$count = $employeeService->count();
$staff = $employeeService->findAll($page*$size-$size, $size);
$header = 'Список сотрудников';
require_once 'template/header.php';
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <section class="content-header">
        <h1>Список сотрудников</h1>
        <ol class="breadcrumb">
          <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li class="active">Список сотрудников</li>
        </ol>
      </section>
      <div class="box-body">
        <a class="btn btn-success" href="add-employee.php">Добавить сотрудника</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php
        if ($staff) { ?>
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
          foreach ($staff as $employee) {
          echo '<tr>';
          echo '<td><a href="profile-employee.php?id='.$employee->user_id.'">'.$employee->fio.'</a> '
          . '<a href="add-employee.php?id='.$employee->user_id.'"><i class="fa fa-pencil"></i></a></td>';
          echo '<td>'.$employee->birthday.'</td>';
          echo '<td>'.$employee->position.'</td>';
          echo '<td><a href="delete-employee.php?id='.$employee->user_id.'"><i class="fa fa-trash"></i></a></td>';
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