<?php
require_once 'secure.php';
require_once "autoload.php";
$size = 20;
if (isset($_GET['page'])) {
  $page = Helper::clearInt($_GET['page']);
} else {
  $page = 1;
}
$falService = new FaLService();
$count = $falService->count();
$fals = $falService->findAll($page*$size-$size, $size);
$header = 'Список ГСМ';
require_once 'template/header.php';
?>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <section class="content-header">
        <h1>Список ГСМ</h1>
        <ol class="breadcrumb">
          <li><a href="/index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li class="active">Список ГСМ</li>
        </ol>
      </section>
      <div class="box-body">
        <a class="btn btn-success" href="add-fal.php">Добавить ГСМ</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?php
        if ($fals) { ?>
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Название</th>
              <th>Единица измерения</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ($fals as $fal) {
          echo '<tr>';
          echo '<td>'.$fal->name.'</td>';
          echo '<td>'.$fal->unit.'</td>';
          echo '<td><a href="add-fal.php?id='.$fal->fal_id.'"><i class="fa fa-pencil"></i></a></td>';
          echo '<td><a href="delete-fal.php?id='.$fal->fal_id.'"><i class="fa fa-trash"></i></a></td>';
          echo '</tr>';
          }
          ?>
          </tbody>
        </table>
        <?php } else {
        echo 'Ни одного материала не найдено';
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