<?php
    include_once 'Common/header.php';
    $pageTitle = "Maintenance";
    include_once 'common/sidebar.php';
?>

</head>

<body>

<img class="mainlogo" src="images/coffeecup.gif"/>

<div class="taskarrows">
<h1><?php echo $pageTitle; ?></h1>
<a id="arrow" class="aleft" href="personal.php"></a>
<a id="arrow" class="aright" href="project.php"></a>
</div>

<div class="main">

<a id="task" class="button" href="linkTo.php"></a>
<a id="taskdue" class="button" href="linkTo.php"></a>
<a id="taskOverDue" class="button" href="linkTo.php"></a>
<form action="welcome.php" method="post">

<div class="login">

Log-in: <input type="text" name="fname"/></br></br>

Password: <input type="text" name="age"/></br></br>
<input type="submit"/>
</div>

</form>
</div>
</div>
</body>


</html>