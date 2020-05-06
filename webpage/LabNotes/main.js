const noteIdField = document.getElementById('note-id');
const newNoteLabel = 'New note';

if (!noteIdField.value) {
  noteIdField.value = newNoteLabel
}

function resetNoteId() {
  noteIdField.value = newNoteLabel;
}

function setNoteId(id) {
  noteIdField.value = id
}

function editNote(id, note) {
    document.getElementById('note-textarea').value = note;
    setNoteId(id)
}
