<!-- 
    Dakota Bourne - db2nb
    Matthew Reid - mrr7rn
 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="The page for faculty research on connect uva">
    <meta name="author" content="Dakota and Matthew">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="uva, research, collaboration, professors">

    <link rel="icon" type="image/x-icon" href="/db2nb/connectuva/favicon.ico">
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
        Welcome to the Faculty Research page of the University of Virginia! 
        Here you can find out about faculty research from a variety of fields and disciplines at the University of Virginia.<br>

        <div>
            <form action="<?="{$this->url}newResearch/"?>" method="post">
            <?php $button = ($_SESSION["isFaculty"]==1) ? "<button type='submit' class='btn' id='submit' style='font-size: 30px; padding-left:0px; padding-bottom:0px;'><i class='bi bi-plus-square-fill'>
            Create a New Project.</i></button>" : "<br>";
                echo $button;
                ?>
                <input type="hidden" name="showFields" value="1"/>
                </form>
        </div>
    </div>

    <?php include "templates/footer.php"?>
</body>
    <script src="<?="{$this->url}js/loadProjects.js"?>"></script>
    <script type="text/javascript">
        var rowURL = "<?php echo $this->url; ?>";

        $(document).ready(function() {
            let url = "<?php echo $this->url;?>api/researchList";
            loadProjects(url, 1);
        });
    </script>

</html>