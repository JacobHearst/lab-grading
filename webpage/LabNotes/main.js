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
