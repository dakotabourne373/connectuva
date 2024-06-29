function loadProjects(url, faculty) {
    $.get(url + `?faculty=${faculty}`, function (data, status) {
        if (data.length === 0) {
            $("div.container").append($("<div class='alert alert-danger'>Hmmm, we couldn't find any projects at this time. Try refreshing the page!</div>"));
            return;
        }
        var table = $("<table></table>");
        table.addClass("table table-bg scrollable-table");

        let row = $("<tr></tr>");
        row.append($("<th></th>").text("Date"));
        row.append($("<th></th>").text("Title"));
        row.append($("<th></th>").text("Summary"));
        row.append($("<th></th>").text("Paid"));
        table.append($("<thead></thead>").append(row));

        var tbody = $("<tbody></tbody>");
        data.map(item => {
            console.log(item);
            let row = $("<tr></tr>");
            row.click(function () {
                let row = $(this);
                window.location = `${rowURL}researchViewer/?id=${row.prop("id")}`;
            });
            row.hover(function () {
                $(this).css("background-color", "#cbcccd");
            }, function () {
                $(this).css("background-color", "#ebeced");
            });
            row.css("cursor", "pointer");
            row.prop("id", item.id);

            let icon = $("<i></i>");
            icon.addClass("bi");
            item.paid ? icon.addClass("bi-check2") : icon.addClass("bi-x");

            row.append($("<td></td>").text(item.dateCreated));
            row.append($("<td></td>").text(item.title));
            row.append($("<td></td>").text(item.summary.substring(0, 120) + "..."));
            row.append($("<td></td>").append(icon));

            tbody.append(row);
        });
        table.append(tbody);
        $("div.container").append(table);
    });
}