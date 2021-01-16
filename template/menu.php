<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li
        <?=($_SERVER['PHP_SELF']=='/index.php')?'class="active"' : '';?>>
        <a href="index.php"><i class="fa fa-calendar"></i><span>Главная</span></a>
      </li>
      <li class="header">Люди</li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-manager.php')?'class="active"':'';?>>
          <a href="/list-manager.php"><i class="fa fa-users"></i><span>Менеджеры</span></a>
        </li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-refueller.php')?'class="active"':'';?>>
          <a href="list-refueller.php"><i class="fa fa-users"></i><span>Заправщики</span></a>
        </li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-driver.php')?'class="active"':'';?>>
          <a href="list-driver.php"><i class="fa fa-users"></i><span>Водители</span></a>
        </li>
      <li class="header">Ведомости</li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-bill.php')?'class="active"':'';?>>
          <a href="list-bill.php"><i class="fa fa-table"></i><span>Ведомости</span></a>
        </li>
      <li class="header">ГСМ</li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-fal.php')?'class="active"':'';?>>
          <a href="list-fal.php"><i class="fa fa-book"></i><span>ГСМ</span></a>
        </li>
      <li class="header">Транспорт</li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-car.php')?'class="active"':'';?>>
          <a href="list-car.php"><i class="fa fa-car"></i><span>Транспорт</span></a>
        </li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-car-model.php')?'class="active"':'';?>>
          <a href="list-car-model.php"><i class="fa fa-car"></i><span>Модели транспорта</span></a>
        </li>
    </ul>
  </section>
</aside>