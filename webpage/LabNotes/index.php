<?php
if (!isset($_GET['labId'])) {
    echo 'No LabId provided';
    // If the labId isn't set, we can't do anything
    die();
} else {
    $labId = (int)$_GET['labId'];
}

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

    include '../database.php';
    execQuery($query, $params);
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Lab Notes</title>
        <link rel="stylesheet" type="text/css" href="LabNotes/style_labNotes.css">
	</head>

	<body>
		<h1>Lab Grading Tool</h1>
		<h2>Programmed by: Agile Experience Group 4</h2>
		<h4><a href="../">Return to main page.</a></h4>
		
		<br>
		<hr>
		
        <h2>Add/Edit Lab Notes:</h2>
        <form method="POST" id="add-note-form">
            <label class="inline-block">Editing note:</label>
            <!-- TODO: Update this field when a user clicks a button to edit a note -->
            <input id="note-id" class="inline-block" name="noteId" type="text" disabled/>
            <textarea class="block" name="note" rows=16 cols=32></textarea>
            <button type=button onclick="resetNoteId()">Clear note ID</button>
            <input type="submit" value="Submit"/>
        </form>
        <ul id="current-notes">
            <!-- Current notes go here. Doesn't need to be a list, that's just what I thought would work best-->
        </ul>

        <script src="LabNotes/main.js"></script>
	</body>
</html>
