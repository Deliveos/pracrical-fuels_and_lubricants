<?php
$user = (new UserService())->findById($id);
if ($user) { ?>
<tr>
  <th>Ф.И.О.</th>
  <td><?=$user->surename . " " . $user->name . " " . $user->patronymic;?></td>
</tr>
<tr>
  <th>Дата рождения</th>
  <td><?=date("d.m.Y", strtotime($user->birthday));?></td>
</tr>

<?php } ?>