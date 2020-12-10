<form method="POST" action="<?php echo $action ?>">
  <input type="hidden" name="_method" id="_method" value="<?php echo $method ?>" />

  <div>
    <p>User Name:</p>
    <p><input type="text" name="user[name]" id="user_name" value="<?php echo h($user->name) ?>" /></p>
  </div>

  <div>
    <p>Remarks:</p>
    <p><textarea name="user[remarks]" id="user_remarks" rows="4" cols="37"><?php echo h($user->remarks) ?></textarea></p>
  </div>

  <div>
    <p>
      <?php echo link_to('Cancel', 'users'), "\n" ?>
      <input type="submit" value="Save" />
    </p>
  </div>

</form>
