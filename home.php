<?php
    include_once 'Common/header.php';
    $pageTitle = "Home";
    include_once 'common/sidebar.php';
?>

</head>

<body>

<img class="mainlogo" src="images/coffeecup.gif"/>


<div class="taskarrows">
<h1><?php echo $pageTitle; ?></h1></div>

        <div id="main">
            <noscript>This site just doesn't work, period, without JavaScript</noscript>
<?php
if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])):                 
 
    include_once 'inc/class.tasks.inc.php';
    $tasks = new Tasks($db);
    $tasks->loadTasksByUser();
 
</div>
</body>


</html>