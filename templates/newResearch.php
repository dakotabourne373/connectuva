<!-- 
    Dakota Bourne - db2nb
    Matthew Reid - mrr7rn
 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="Create a new Research project on connect uva">
    <meta name="author" content="Dakota and Matthew">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="uva, research, collaboration, professors">

    <link rel="icon" type="image/x-icon" href="/db2nb/connectuva/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?="{$this->url}/styles/main.css"?>">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


    <title>ConnectUVA</title>
</head>

<body>
    <?php include "templates/header.php"?>

    <div class="landing container">
        <h2>Create a new research project!</h2>
        <?php
                    if (!empty($error_msg)) {
                        echo "<div class='alert alert-danger'>$error_msg</div>";
                    }
                ?>
        <form action="<?="{$this->url}newResearch/"?>" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="<?=$_SESSION["email"]?>" value="<?=$_SESSION["email"]?>"
                        readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Name</label>
                    <input type="text" class="form-control" id="inputPassword4" name="name" placeholder="<?=$_SESSION["name"]?>"  value="<?=$_SESSION["name"]?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputTitle">Title</label>
                    <input type="text" class="form-control" id="inputTitle" name="title" maxlength="40" required>
                </div>
                <?php
                $fields = "<div class='form-group col-md-1'>
                    <fieldset>
                        <legend class='col-form-label pt-0' required>Paid?</legend>
                        <div class='form-check form-check-inline'>
                            <input class='form-check-input' type='radio' name='paidRadioOptions' id='paid'
                                value='option1'>
                            <label class='form-check-label' for='paid'>Yes</label>
                        </div>
                        <div class='form-check form-check-inline'>
                            <input class='form-check-input' type='radio' name='paidRadioOptions' id='unpaid'
                                value='option2'>
                            <label class='form-check-label' for='unpaid'>No</label>
                        </div>
                    </fieldset>
                </div>
                <div class='form-group col-md-2'>
                    <label for='payment'>How Much? (per hour)</label>
                    <input type='number' class='form-control' id='payment' name='pay' step='0.01' min='7.25' readonly required>
                </div>
                <div class='form-group col-md-2'>
                    <label for='inputZip'>Spots Available</label>
                    <input type='number' class='form-control' id='inputZip' name='openSpots' min='1' required>
                </div>";
                if($_POST["showFields"] == "1"){
                    echo $fields;
                }
                ?>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Summary</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="summary" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create New Project</button>
        </form>
    </div>

    <?php include "templates/footer.php"?>

    <!-- https://stackoverflow.com/questions/58605299/how-to-enable-text-input-after-clicking-a-corresponding-radio-button-under-boots -->
    <script>
        var radios = document.querySelectorAll('[name=paidRadioOptions]');
        Array.from(radios).forEach(function (r) {
            r.addEventListener('click', function () {
                var priceEl = document.getElementById('payment');
                if (this.id == 'paid')
                    priceEl.removeAttribute('readonly');
                else {
                    priceEl.setAttribute('readonly', 'readonly');
                    priceEl.value = "";
                }
            });
        });
        // $('[name=paidRadioOptions]').click(function() {

        // })
    </script>
</body>

</html>