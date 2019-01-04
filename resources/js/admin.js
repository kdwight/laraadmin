//delete button
$(".confirmDelete").on("submit", function () {
    return confirm("Do you want to delete this item?");
});

//turns static table into datatable
$("#table").DataTable();

//turns datatable into sortable datatable
$("#tablecontents").sortable({
    items: "tr",
    cursor: 'move',
    opacity: 0.6,
    update: function () {
        sendOrderToServer();
    }
});