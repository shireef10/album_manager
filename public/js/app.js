function showDeleteModal(albumId, albumName, pictureCount) {
    $("#deleteModal").modal("show");
    $("#albumName").text(albumName);
    $("#deleteAlbumForm").attr("action", "/albums/" + albumId);
    $("#movePicturesForm").attr("action", "/albums/" + albumId + "/move");
    if (pictureCount >= 0) {
        $("#deleteOptions").show();
    } else {
        $("#deleteOptions").hide();
    }
}

function submitDeleteForm() {
    $("#deleteAlbumForm").submit();
}

function submitMoveForm() {
    $("#movePicturesForm").submit();
}

function openImage(src) {
    $("#fullScreenImage").attr("src", src);
    $("#imageModal").modal("show");
}
