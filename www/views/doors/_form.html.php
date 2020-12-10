<form method="POST" action="<?php echo $action ?>">
  <input type="hidden" name="_method" id="_method" value="<?php echo $method ?>" />

  <div>
    <p>door Title:</p>
    <p><input type="text" name="door[title]" id="door_title" value="<?php echo h($door->title) ?>" /></p>
  </div>

  <div>
    <p>Author:</p>
    <p>
      <select name="door[author_id]" id="door_author_id">
        <option id="0"></option>
<?php
    // foreach ($authors as $author) {
    //     echo option_tag($author->id, $author->name, $door->author_id), "\n";
    // }
?>
      </select>
  </div>

  <div>
    <p>Publication Year:</p>
    <p><input type="text" name="door[year]" id="door_year" value="<?php echo $door->year ?>" /></p>
  </div>

  <div>
    <p>
      <?php echo link_to('Cancel', 'doors'), "\n" ?>
      <input type="submit" value="Save" />
    </p>
  </div>

</form>
