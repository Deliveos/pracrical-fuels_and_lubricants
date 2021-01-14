<?php
if (isset($_GET["id"])) {
  $userService = new UserService();
  $id = Helper::clearInt($_GET["id"]);
  $user = $userService->findById($id);
}
?>
<div class="form-group">
<label>Фамилия</label>
<input type="text" class="form-control" name="surename" required="required" value="<?= $user->surename;?>">
</div>
<div class="form-group">
<label>Имя</label>
<input type="text" class="form-control" name="name" required="required" value="<?= $user->name;?>">
</div>
<div class="form-group">
<label>Отчество</label>
<input type="text" class="form-control" name="patronymic" value="<?= $user->patronymic;?>">
</div>
<div class="form-group">
<label>Дата рождения</label>
<input type="date" class="form-control"
name="birthday" value="<?=$user->birthday;?>">
</div>
<input type="hidden" name="user_id" value="<?=$id;?>"/>