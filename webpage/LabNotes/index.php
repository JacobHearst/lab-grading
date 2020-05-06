<?php
if (!isset($_GET['labId'])) {
  echo 'No LabId provided';
  // If the labId isn't set, we can't do anything
  die();
} else {
  $labId = (int) $_GET['labId'];
}

include '../database.php';

// Are we creating or modifying a note?
if (isset($_POST['note'])) {
  $query = '';
  $params = array();

  if (isset($_POST['noteId']) && is_numeric($_POST['noteId'])) {
    // Updating note
    $query = 'UPDATE Notes SET Note=? WHERE id=?';
    $params = array($_POST['note'], $_POST['noteId']);
  } else {
    // Creating new note
    $query = 'INSERT INTO Notes (LabId, CreatedBy, Note) VALUES (?, ?, ?)';
    $createdBy = 1;
    $params = array($labId, 1, $_POST['note']);
  }

  execQuery($query, $params);
}

$selectQuery = 'SELECT * FROM Notes WHERE LabId=?';
$notes = execQuery($selectQuery, array($labId))->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Lab Notes</title>
  <link rel="stylesheet" type="text/css" href="LabNotes/style_labNotes.css">
</head>

<body>

  <div id="header-wrapper">
    <div id="header" class="container">
      <div id="logo">
        <h1><a>Lab Grading Tool</a></h1>
      </div>
      <div id="menu">
        <ul>
          <li><a href="../index.html" title="">Homepage</a></li>
          <li><a href="./Search/" title="">Lab Search</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="wrapper">
    <br>
    <div id="LabNotes" class="container">
      <h2>Add/Edit Lab Notes:</h2>
      <form method="POST" id="add-note-form">
        <label>Editing note:</label>
        <input id="note-id" class="inline-block" name="noteId" type="text" readonly/>
        <textarea id="note-textarea" class="block" name="note" maxlength=100 rows=4 cols=25 required></textarea>
        <button type=button onclick="resetNoteId()">Clear note ID</button>
        <input type="submit" value="Submit" />
      </form>
      <div id="notes-list-wrapper">
        <h3>Current notes</h3>
        <ul id="current-notes">
          <?php
          foreach ($notes as $note) { ?>
            <li>
              <p class="note-list-item"><?= $note['Note'] ?></p>
              <button onclick="editNote(<?= $note['Id'] ?>, '<?= $note['Note'] ?>')">Edit</button>
            </li>
          <?php } ?>
        </ul>
      </div>

      <script src="LabNotes/main.js"></script>
    </div>
  </div>
  <div id="footer">
    <div class="container">
    </div>
  </div>
</body>

</html>
