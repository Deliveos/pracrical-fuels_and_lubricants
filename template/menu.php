<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li
        <?=($_SERVER['PHP_SELF']=='/index.php')?'class="active"' : '';?>>
        <a href="index.php"><i class="fa fa-calendar"></i><span>Главная</span></a>
      </li>
      <li class="header">Люди</li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-user.php')?'class="active"':'';?>>
          <a href="/list-user.php"><i class="fa fa-users"></i><span>Менеджеры</span></a>
        </li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-employee.php')?'class="active"':'';?>>
          <a href="list-employee.php"><i class="fa fa-users"></i><span>Сотрудники</span></a>
        </li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-driver.php')?'class="active"':'';?>>
          <a href="list-driver.php"><i class="fa fa-users"></i><span>Водители</span></a>
        </li>
        <li class="header">Ведомости</li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-teacher.php')?'class="active"':'';?>>
          <a href="list-teacher.php"><i class="fa fa-table"></i><span>Ведомости</span></a>
        </li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-teacher.php')?'class="active"':'';?>>
          <a href="list-teacher.php"><i class="fa fa-book"></i><span>ГСМ</span></a>
        </li>
        <li class="header">Транспорт</li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-teacher.php')?'class="active"':'';?>>
          <a href="list-teacher.php"><i class="fa fa-car"></i><span>Транспорт</span></a>
        </li>
        <li 
          <?=($_SERVER['PHP_SELF']=='/list-teacher.php')?'class="active"':'';?>>
          <a href="list-teacher.php"><i class="fa fa-car"></i><span>Марки автомобилей</span></a>
        </li>
    </ul>
  </section>
</aside>