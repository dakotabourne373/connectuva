<!-- 
    Dakota Bourne - db2nb
    Matthew Reid - mrr7rn
 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="About Page for connect uva">
    <meta name="author" content="Dakota and Matthew">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="uva, research, collaboration, professors">

    <link rel="icon" type="image/x-icon" href="/db2nb/connectuva/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?="{$this->url}/styles/main.css"?>">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <title>ConnectUVA</title>
</head>

<body class="bg">
    <?php include "templates/header.php"?>

    <div class="container landing">
<!-- Login form -->
<div class="row justify-content-center">
                <div class="col-4">
                <?php
                    if (!empty($error_msg)) {
                        echo "<div class='alert alert-danger'>$error_msg</div>";
                    }
                ?>
                <form action="<?="{$this->url}login/"?>" method="post" onsubmit="return validation();">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"/>
                        <div id="ehelp" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"/>
                        <div id="pwhelp" class="form-text"></div>
                    </div>
                    <div class="text-center">                
                        <button type="submit" id="submit" class="btn btn-primary" disabled>Log in </button>
                    </div>
                </form>
                <div class="text-center">
                    <a href="<?="{$this->url}signup/"?>" style="text-align:center;">Don't have an account? Sign up here</a>
                </div>
                </div>          
            </div>
    </div>
    
    <?php include "templates/footer.php"?>
    <script type="text/javascript">
        function validation() {
            if($("#email").val().length > 16 && $("#password").val().length > 7){
                return true;
            }
            alert("UVA Email and 8 character password required");
            return false;
        }
    </script>
    <script type="text/javascript" src="<?="{$this->url}js/passwordCheck.js"?>"></script>
    <script type="text/javascript" src="<?="{$this->url}js/emailCheck.js"?>"></script>

</body>

</html>