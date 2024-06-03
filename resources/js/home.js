// resources/js/home.js

$(document).ready(function () {
    loadAlbums();

    $("#create-album-form").on("submit", function (e) {
        e.preventDefault();
        const albumName = $("#album-name").val();
        $.post("/albums", { name: albumName }, function (data) {
            loadAlbums();
        });
    });

    function loadAlbums() {
        $.get("/albums", function (data) {
            $("#albums").empty();
            data.forEach((album) => {
                $("#albums").append(`
                    <div class="album" data-id="${album.id}">
                        <h3>${album.name}</h3>
                        <button class="edit-album">Edit</button>
                        <button class="delete-album">Delete</button>
                        <div class="pictures">
                            ${album.pictures
                                .map((picture) => `<div>${picture.name}</div>`)
                                .join("")}
                        </div>
                    </div>
                `);
            });

            $(".edit-album").on("click", function () {
                const albumId = $(this).parent().data("id");
                const newName = prompt("New album name:");
                $.ajax({
                    url: `/albums/${albumId}`,
                    type: "PUT",
                    data: { name: newName },
                    success: function (data) {
                        loadAlbums();
                    },
                });
            });

            $(".delete-album").on("click", function () {
                const albumId = $(this).parent().data("id");
                if (confirm("Delete album and all pictures?")) {
                    $.ajax({
                        url: `/albums/${albumId}`,
                        type: "DELETE",
                        data: { action: "delete" },
                        success: function (data) {
                            loadAlbums();
                        },
                    });
                } else {
                    const newAlbumId = prompt(
                        "Enter the ID of the album to move pictures to:"
                    );
                    $.ajax({
                        url: `/albums/${albumId}`,
                        type: "DELETE",
                        data: { action: "move", new_album_id: newAlbumId },
                        success: function (data) {
                            loadAlbums();
                        },
                    });
                }
            });
        });
    }
});
