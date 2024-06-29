<?php
// Dakota Bourne - db2nb
// Matthew Reid - mrr7rn

class Controller {
    private $db;
    private $url = "/connectuva/";
    // private $url = "/db2nb/connectuva/";

    public function __construct() {
        $this->db = new Database();
    }

    public function isLoggedIn(){
        if(!isset($_SESSION["email"])){
            // $url .= "index.html";
            header("Location: {$this->url}index/");
            exit();
        }
    }

    public function run($command, ...$params) {
        switch($command) {
            case "login":
                $this->login();
                break;
            case "signup":
                $this->signup();
                break;
            case "research":
                $this->isLoggedIn();
                $this->projects(1);
                break;
            case "angular":
                $this->isLoggedIn();
                include_once("angular/index.html");
                break;
            case "api":
                if($params[0] == "getProfileAng") {
                    $this->getProfileAng();
                    break;
                }
                $this->isLoggedIn();
                $this->api(...$params);
                break;
            case "proposals":
                $this->isLoggedIn();
                $this->projects(0);
                break;
            case "researchViewer":
                $this->isLoggedIn();
                $this->projectViewer();
                break;
            case "jsonout":
                $this->isLoggedIn();
                $this->jsonViewer();
                break;
            case "newResearch":
                $this->isLoggedIn();
                $this->newResearch();
                break;
            case "profile":
                $this->isLoggedIn();
                $this->profile();
                break;
            case "myProposals":
                $this->isLoggedIn();
                $this->myProposals();
                break;
            case "savedProposals":
                $this->isLoggedIn();
                $this->savedProposals();
                break;
            case "logout":
                $this->logout();
            case "index":
            default:
                $this->index();
                break;
        }
            
    }

    private function index(){
        include "templates/about.php";
    }
    private function projects($faculty){
        if($faculty === 1){
            include "templates/research.php";
        }else{
            include "templates/proposals.php";
        }
    }
    private function projectViewer(){
        $data = $this->db->query("select * from research where id = ?;", "i", $_GET["id"]);
        $item = [];
        $user = [];
        $message = "";
        if ($data === false) {
        // did not work
        $message = "<div class='alert alert-danger'>Error: could not find the given research item</div>";
        } else {
            // worked
            if (count($data)==0) {
                $message = "<div class='alert alert-danger'>Error: could not find the given research item</div>";
            }else{
                $item = $data[0];
                $data = $this->db->query("select * from users where id = ?", "i", $item["userID"]);
                
                if($data !== false){
                    if(isset($data[0])){
                        $user = $data[0];
                    }
                }
            }
        }

        include "templates/researchViewer.php";
    }

    private function api(...$params) {
        switch($params[0]) {
            case "delProfile":
                $this->delProfile();
                break;
            case "editProfile":
                $this->editProfile();
                break;
            case "getProfile":
                $this->getProfile();
                break;
            case "details":
                $this->jsonViewer();
                break;
            case "researchList":
                $this->researchList();
                break;
            case "myProposalList":
                $this->myList();
                break;
            case "myBookmarkList":
                $this->mySaved();
                break;
            case "isBookmarked":
                $this->isBookmarked();
                break;
            case "deleteProject":
                $this->deleteProject();
                break;
            case "addBookmark":
                $this->addBookmark();
                break;
            case "removeBookmark":
                $this->removeBookmark();
                break;
            default:
                $this->index();
                break;
        }
    }

    private function delProfile() {
        $request = file_get_contents("php://input");
        $post = json_decode($request, true);
        if(!isset($_SESSION["userID"]))
            echo "Nice Try Dummy...";
        if(isset($post["delete"])){
            $stmt = $this->db->query("delete from userbookmarks where uid = ?", "i", $_SESSION["userID"]);
            $data = $this->db->query("delete from research where userID = ?", "i", $_SESSION["userID"]);
            if($data !== false){
                $stmt = $this->db->query("delete from users where id = ?", "i", $_SESSION["userID"]);
                if($data !== false){
                    header("Location: {$this->url}logout/");
                    return;
                }
            }
        }
    }
    
    private function getProfile() {
        $request = file_get_contents("php://input");
        $stuff = json_decode($request, true);
        $data = [];
        if(!isset($_SESSION["userID"]))
            echo "Nice Try Dummy...";
        // if(true/*isset($stuff["id"])*/){
            $ret = $this->db->query("select * from users where id = ?", "i", $_SESSION["userID"]);

            if($ret != false && count($ret) != 0){
                $data["name"] = $ret[0]["name"];
                $data["email"] = $ret[0]["email"];
            }
        // }

        header("Content-Type: application/json");
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    private function getProfileAng() {
        $request = file_get_contents("php://input");
        $stuff = json_decode($request, true);
        $data = [];
        if(isset($stuff["id"])){
            $ret = $this->db->query("select * from users where id = ?", "i", $stuff["id"]);

            if($ret != false && count($ret) != 0){
                $data["name"] = $ret[0]["name"];
                $data["email"] = $ret[0]["email"];
            }
        }

        header("Content-Type: application/json");
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    private function editProfile() {
        $request = file_get_contents("php://input");
        $data = json_decode($request, true);
        if(!isset($_SESSION["userID"]))
            echo "Nice Try Dummy...";
        if(isset($data["name"])){
            $res = $this->db->query("update users set name = ? where id = ?", "si", $data["name"], $_SESSION["userID"]);
        }
    }

    private function deleteProject() {
        if(isset($_POST["id"])) {
            $res = $this->db->query("delete from userbookmarks where bid = ?", "i", $_POST["id"]);
            $res = $this->db->query("delete from research where id = ?", "i", $_POST["id"]);
        }
    }

    private function addBookmark() {
        if(isset($_POST["id"])){
            $res = $this->db->query("insert into userbookmarks (uid, bid) values (?, ?);", "ii", $_SESSION["userID"], $_POST["id"]);
        }
    }

    private function removeBookmark() {
        if(isset($_POST["id"])){
            $res = $this->db->query("delete from userbookmarks where uid = ? and bid = ?;", "ii", $_SESSION["userID"], $_POST["id"]);
        }
    }

    private function isBookmarked() {
        $item = $this->db->query("select * from userbookmarks where uid = ? and bid = ?;", "ii", $_SESSION["userID"], $_GET["id"]);
        $data = false;
        if($item != false || count($item) != 0){
            $data = true;
        }

        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    private function mySaved() {
        $listNums = $this->db->query("select * from userbookmarks where uid = ?;", "i", $_SESSION["userID"]);
        $data = [];
        $message = "";

        if($listNums === false){
            $message = "<div class='alert alert-danger'>Error: could not grab project list</div>";
        } else {
            if(count($listNums) == 0) {
                $message = "<div class='alert alert-danger'>Error: could not grab project list</div>";
            } else {
                // $data = $list;
                foreach($listNums as $item){
                    $received = $this->db->query("select * from research where id = ? order by dateCreated asc;", "i", $item["bid"]);
                    if($received !== false && count($received) !== 0){
                        $data[] = $received[0];
                    }
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    private function myList() {
        $list = $this->db->query("select * from research where userID = ? order by dateCreated asc;", "i", $_SESSION["userID"]);
        $data = [];
        $message = "";

        if($list === false){
            $message = "<div class='alert alert-danger'>Error: could not grab project list</div>";
        } else {
            if(count($list) == 0) {
                $message = "<div class='alert alert-danger'>Error: could not grab project list</div>";
            } else {
                $data = $list;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    private function researchList() {
        $list = $this->db->query("select * from research where isFaculty = ? order by dateCreated asc;", "i", $_GET["faculty"]);
        $data = [];
        $message = "";
        
        if($list === false) {
            $message = "<div class='alert alert-danger'>Error: could not grab research list</div>";
        } else {
            if (count($list)==0) {
                $message = "<div class='alert alert-danger'>Error: could not grab research list</div>";
            }else{
                $data = $list;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    private function jsonViewer(){
        $data = $this->db->query("select * from research where id = ?;", "i", $_GET["id"]);
        $item = [];
        $user = [];
        $message = "";
        if ($data === false) {
        // did not work
        $message = "<div class='alert alert-danger'>Error: could not find the given research item</div>";
        } else {
            // worked
            if (count($data)==0) {
                $message = "<div class='alert alert-danger'>Error: could not find the given research item</div>";
            }else{
                $item = $data[0];
                $data = $this->db->query("select * from users where id = ?", "i", $item["userID"]);
                
                if($data !== false){
                    if(isset($data[0])){
                        $user = $data[0];
                    }
                }
            }
        }
        $item["name"] = $user["name"];
        $item["uid"] = $user["id"];
        $item["email"] = $user["email"];
        
        header('Content-Type: application/json');
        echo json_encode($item, JSON_PRETTY_PRINT);
    }

    private function newResearch(){
        if(isset($_POST["title"])){
            if($_SESSION["isFaculty"] == 1){
                $radio = $_POST["paidRadioOptions"] == "option1" ? 1 : 0;
                $pay = "$" . strval($_POST["pay"]);
                $data = $this->db->query("insert into research (title, summary, paid, pay, openSpots, userID, isFaculty) values (?, ?, ?, ?, ?, ?, ?)",
                    "ssisiii", $_POST["title"], $_POST["summary"], $radio, $pay, $_POST["openSpots"], $_SESSION["userID"], $_SESSION["isFaculty"]);
                if($data === false){
                    $error_msg = "error creating new project";
                }else{
                    header("Location: {$this->url}researchViewer/?id={$this->db->insert_id()}");
                    exit();
                }
            }else{
                $zero = 0;
                $data = $this->db->query("insert into research (title, summary, openSpots, userID, isFaculty) values (?, ?, ?, ?, ?)",
                    "ssiii", $_POST["title"], $_POST["summary"], $zero, $_SESSION["userID"], $_SESSION["isFaculty"]);
                if($data === false){
                    $error_msg = "error creating new project";
                }else{
                    header("Location: {$this->url}researchViewer/?id={$this->db->insert_id()}");
                    return;
                }
            }
        }
        
        if(!isset($_POST["showFields"])){
            header("Location: {$this->url}index/");
            return;
        }
        include "templates/newResearch.php";
    }
    private function profile(){
        include "templates/angular/index.php";
    }
    private function myProposals(){
        include "templates/myProposals.php";
    }
    private function savedProposals(){
        include "templates/savedProposals.php";
    }

    private function logout(){
        session_destroy();
        session_start();
    }

    private function login(){
        if(isset($_SESSION["email"])){
            header("Location: {$this->url}index/");
            return;
        }
        $error_msg = "";
        if (isset($_POST["email"])) { /// validate the email coming in
            $data = $this->db->query("select * from users where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else {         
                if (!empty($data)) { 
                    // user was found!
                    
                    // validate the user's password
                    if (password_verify($_POST["password"], $data[0]["password"])) {
                        // Save user information into the session to use later
                        $_SESSION["name"] = $data[0]["name"];
                        $_SESSION["email"] = $data[0]["email"];
                        $_SESSION["isFaculty"] = $data[0]["isFaculty"];
                        $_SESSION["userID"] = $data[0]["id"];

                        header("Location: {$this->url}index/");
                        return;
                    } else {
                        // User was found but entered an invalid password
                        $error_msg = "Invalid Password";
                    }
                }else{
                    $error_msg = "You are not currently signed up. Click on the sign up button below";
                }
            }
        }
        include "templates/login.php";
    }

    private function signup(){
        if(isset($_SESSION["email"])){
            header("Location: {$this->url}index/");
            return;
        }
        $error_msg = "";
        if (isset($_POST["email"])) { /// validate the email coming in
            $data = $this->db->query("select * from users where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else {         
                if (!empty($data)) {
                    // user was found!
                    $error_msg = "User already exists!";
                } else {
                    // user was not found, create an account
                    // NEVER store passwords into the database, use a secure hash instead:
                    $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $insert = $this->db->query("insert into users (name, email, password) values (?, ?, ?);", "sss", $_POST["name"], $_POST["email"], $hash);
                    if ($insert === false) {
                        $error_msg = "Error creating new user";
                    }else{
                    // Save user information into the session to use later
                    $_SESSION["name"] = $_POST["name"];
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["isFaculty"] = 0;
                    $_SESSION["userID"] = $this->db->insert_id();

                    header("Location: {$this->url}index/");
                    return;
                    }
                } 
            }
        }  
        include "templates/signup.php";
    }
}
?>