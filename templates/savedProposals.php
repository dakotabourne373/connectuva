<!-- 
    Dakota Bourne - db2nb
    Matthew Reid - mrr7rn
 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="Your bookmarked proposals/research on connect uva">
    <meta name="author" content="Dakota and Matthew">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="uva, research, collaboration, professors">

    <link rel="icon" type="image/x-icon" href="/db2nb/connectuva/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?="{$this->url}/styles/main.css"?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


    <title>ConnectUVA</title>
</head>

<body>
    <?php include "templates/header.php"?>

    <div class="container landing">
        Here is the page where you can find all of your bookmarked projects!
        Want to save a project to look at later? Go ahead and hit the star on the details page,
        and all of those projects will show up here!<br>

        <br>
    </div>

    <?php include "templates/footer.php"?>
</body>

    <script type="text/javascript">
        let url = "<?=$this->url?>api/myBookmarkList";
        var rowURL = "<?php echo $this->url; ?>";

        $.get(url, function (data, status) {
            if(data.length === 0){
                $("div.container").append($("<div class='alert alert-danger'>It doesn't seem like you have any projects bookmarked!</div>"));
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
    </script>

</html>