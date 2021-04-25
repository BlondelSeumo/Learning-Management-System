function getFileName(value, placeholder) {
    if (value) {
        const startIndex = (value.indexOf('\\') >= 0 ? value.lastIndexOf('\\') : value.lastIndexOf('/'));
        let filename = value.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }
        $(placeholder).attr('placeholder', '');
        $(placeholder).attr('placeholder', filename);
    }
}

function nameChange(value) {

    getFileName(value, '#placeholderFileOneName');
    $('#submitBtn').attr('disabled', false);
}
function DeleteTheme(id) {
    $('#delete_item_id').val(id);
    $('#deleteItemModal').modal('show');
}
