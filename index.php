
<?php 
    
    session_start(); 
    if(!isset($_SESSION['username'])){
        $_SESSION['username'] = $_POST['username'];

    }
    if (!isset($_SESSION['username']) && !isset($_POST['username'])){
        header('Location: login.html');
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
    echo "<p>Username: ".$_SESSION['username']."</p>";
    date_default_timezone_set("America/Toronto");
    
    if(isset($_POST['textdata'])){
        $date = date("h:i");
        $date = date("h:i");
        $message = "<p><span style='color:rgba(232, 232, 232, 1);'>[".$date."]</span> &lt".$_SESSION['username']."&#62 ".$_POST['textdata']."</p></div>";
        file_put_contents(__DIR__."/data.txt",$message."\n", FILE_APPEND);
        $_POST['textdata'] = null;
    }
    if(isset($_GET['logout'])){
        session_destroy();
        header('Location: login.html');
        exit();
    }
?>

<h1>chat irc pog.</h1> 
<form method="post">
<input type="text" name="textdata">
</form>
                                                      
<button id="btn" onclick="endSession()">End Session</button>


<div id="chatbox"> 
   <?php
      //  $contents = file_get_contents("data.txt");
      //  echo $contents;
    ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
<script> 
    function load(){
        $.ajax({
            url: "data.txt",
            cache: false,
            success: function(result){
                $("#chatbox").html(result);
            }
        })
    }
    setInterval(load,1000);

    function endSession(){
        if (confirm('Are you sure you want to end session?')){
            window.location = 'index.php?logout=true';
        }
    }

</script>

</body>
</html>
