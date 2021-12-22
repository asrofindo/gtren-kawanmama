     $(document).ready(function () {
    var startTable = "table";
    var $tabs = $("#" + startTable);
    $("tbody.connectedSortable")
        .sortable({
        connectWith: ".connectedSortable",
        items: "> tr:not(:first)",
        appendTo: $tabs,
        helper: "clone",
        cursor: "move",
        zIndex: 999990,
        start: function (event, ui) {
            //alert("start1");
            var start_pos = ui.item.index();
            ui.item.data('start_pos', start_pos);
        }
    });

});