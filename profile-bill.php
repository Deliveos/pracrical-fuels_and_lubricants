<?php
require_once 'secure.php';
if (isset($_GET['id'])) {
$id = Helper::clearInt($_GET['id']);
} else {
header('Location: 404.php');
}

$bill = (new BillService())->findById($id);
$bill_positions = (new BillPositionService())->findByBillId($id);
$header = 'Ведомость №'.$bill->bill_num;
require_once 'template/header.php';
?>
<div class="row">
  <div class="col-xs-12">
  <div class="box">
      <section class="content-header">
        <h1>Ведомость №<?= $bill->bill_num; ?></h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="list-bill.php">Список ведомостей</a></li>
          <li class="active">Ведомость №<?= $bill->bill_num; ?></li>
        </ol>
      </section>
      <div class="box-body">
        <a class="btn btn-success" href="add-bill.php?id=<?=$id;?>">Изменить</a>
      </div>
      
      <div class="box-body">
      <table class="table table-bordered table-hover">
          <tr>  	
            <th>Номер ведомости</th>
            <td><?= $bill->bill_num;?></td>
          </tr>
          <tr>  	
            <th>Заправщик</th>
            <td><?= $bill->fio;?></td>
          </tr>
          <tr>  	
            <th>Дата</th>
            <td><?= $bill->date;?></td>
          </tr>
          <tr>  	
            <th>Автобаза</th>
            <td><?= $bill->motor_depot;?></td>
          </tr>
          <tr>  	
            <th>Номер гаража</th>
            <td><?= $bill->garage_num;?></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="box">
      <section class="content-header">
        <h1>Позиции ведомости</h1>
      </section>
      <div class="box-body">
        <?php
        if ($bill_positions) { ?>
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Водитель</th>
              <th>Гос.номер авто</th>
              <th>Номер путевого листа</th>
              <th>ГСМ</th>
              <th>Количество</th>
            </tr>
          </thead>
          <tbody>
          <?php
          foreach ($bill_positions as $bill_position) {
            echo '<tr>';
            echo '<td>'.$bill_position->fio.'</td>';
            echo '<td>'.$bill_position->state_num.'</td>';
            echo '<td>'.$bill_position->waybill_num.'</td>';
            echo '<td>'.$bill_position->fal.'</td>';
            echo '<td>'.$bill_position->count.'</td>';
            echo '</tr>';
          }
          ?>
          </tbody>
        </table>
        <?php } else {
        echo 'Ни одной позиции не найдено';
        } ?>
      </div>
    </div>
  </div>
</div>
<?php
require_once 'template/footer.php';
?>