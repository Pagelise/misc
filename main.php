<?php
    if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])
        && $_SESSION['LoggedIn']==1):

  include_once 'maintenance.php';

else:
  include_once 'login.php';               

endif; ?>