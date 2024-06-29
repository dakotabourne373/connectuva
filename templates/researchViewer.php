<!-- 
    Dakota Bourne - db2nb
    Matthew Reid - mrr7rn
 -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="description" content="More details page on connect uva">
  <meta name="author" content="Dakota and Matthew">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="uva, research, collaboration, professors">

  <link rel="icon" type="image/x-icon" href="/db2nb/TechForDummies/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= "{$this->url}/styles/main.css" ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


  <title>TechForDummies</title>
</head>

<body onload="loadResearch()">
  <?php include "templates/header.php" ?>

  <div class="container landing researchdisplay">
    <?php
    if (strlen($message) == 0) {
    } else {
      echo $message;
    }
    ?>
    <table class='table table-borderless table-bg' id='table'>
      <thead>
        <tr style='background-color: #f8f9fa;'>
          <th id='name'>Name: </th>
          <th>Department: CS</th>
          <th id='date'>Date: </th>
          <th id='openSpots'>Open Spots: </th>
          <th id='paid'>Paid: </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th rowspan='2'>Title:</th>
          <td colspan='2' rowspan='2' id='title'></td>
          <td colspan='2' rowspan='2' id='email'>Email: </td>
        </tr>
        <tr>
        </tr>
        <tr>
          <th rowspan='2'>Description:</th>
          <td colspan='2' rowspan='2' id='summary'></td>
          <td colspan='2'></td>
        </tr>
        <tr>
          <td colspan='2'>
            Save for Later: <button aria-label="bookmark" type="button" class="btn btn-outline-secondary" id="bookmark">
              <i class="bi"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <?php include "templates/footer.php" ?>
</body>
<script type="text/javascript">
  let url = "<?php echo $this->url; ?>" + "jsonout/";
  var userID = <?= $_SESSION['userID'] ?>;

  function loadResearch() {

    const params = new URLSearchParams(window.location.search);
    let id = params.get("id");

    $.get("<?= "{$this->url}api/isBookmarked" ?>" + `?id=${id}`, function(data, status) {
      data ? $("i.bi").addClass("bi-bookmark-star-fill") : $("i.bi").addClass("bi-bookmark-star");
    });

    var ajaxReq = new XMLHttpRequest();
    ajaxReq.open("GET", `${url}?id=${id}`, true);
    ajaxReq.responseType = "json";
    ajaxReq.send(null);

    ajaxReq.addEventListener("load", function(response) {
      let title = document.getElementById("title");
      let name = document.getElementById("name");
      let date = document.getElementById("date");
      let spots = document.getElementById("openSpots");
      let paid = document.getElementById("paid");
      let email = document.getElementById("email");
      let summary = document.getElementById("summary");

      let viewerObj = ajaxReq.response;

      if (viewerObj === null) {
        let table = document.getElementById("table");
        table.innerHTML = "";
        return;
      }

      if (viewerObj.uid == userID) {
        $("div.container").append($("<button id='delete' class='btn btn-danger'>DELETE Project</button>").click(function() {
          $.post("<?php echo $this->url; ?>api/deleteProject", {
            id: viewerObj.id
          });
          window.location = <?php echo $_SESSION["isFaculty"]; ?> ? "<?php echo $this->url; ?>research/" : "<?php echo $this->url; ?>proposals/";
        }));
      }

      let summ = viewerObj.summary;
      const regex = /((\S+\s){13})/g;
      summ = summ.replace(regex, '$1 <br>');

      title.textContent = viewerObj.title;
      name.textContent = name.textContent + viewerObj.name;
      date.textContent = date.textContent + viewerObj.dateCreated;
      spots.textContent = spots.textContent + viewerObj.openSpots;
      paid.textContent = paid.textContent + (viewerObj.paid ? "Yes" : "No");
      email.textContent = email.textContent + viewerObj.email;
      summary.textContent = summ;

      summ = summary.innerHTML;
      summ = summ.replace(/&lt;br&gt;/g, '<br>');
      summary.innerHTML = summ;

    });
  }

  $("#bookmark").click(function() {
    let svg = $(this).find("i");
    const params = new URLSearchParams(window.location.search);
    let id = params.get("id");

    if (svg.attr("class").includes("fill")) {
      let url = "<?php echo $this->url; ?>api/removeBookmark";
      $.post(url, {
        id: id
      });
      svg.removeClass("bi-bookmark-star-fill");
      svg.addClass("bi-bookmark-star");
    } else {
      let url = "<?php echo $this->url; ?>api/addBookmark";
      $.post(url, {
        id: id
      });
      svg.removeClass("bi-bookmark-star");
      svg.addClass("bi-bookmark-star-fill");

    }
  });
</script>

</html>