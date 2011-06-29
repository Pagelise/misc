<?php

class Tasks
{
    /**
     * The database object
     *
     * @var object
     */
    private $_db;
 
    /**
     * Checks for a database object and creates one if none is found
     *
     * @param object $db
     * @return void
     */
    public function __construct($db=NULL)
    {
        if(is_object($db))
        {
            $this->_db = $db;
        }
        else
        {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }
}

public function createTask() {


}




public function loadTasksByUser()
    {
        $sql = "SELECT
                    task.UserID, Name
                FROM task
                LEFT JOIN lists
                USING (taskID)
                    WHERE task.UserID=(
                        SELECT users.UserID
                        FROM users
                        WHERE users.Username=:user
                    )
                )
                ORDER BY Priority";
        if($stmt = $this->_db->prepare($sql))
        {
            $stmt->bindParam(':user', $_SESSION['Username'], PDO::PARAM_STR);
            $stmt->execute();
            $order = 0;
            while($row = $stmt->fetch())
            {
                $LID = $row['taskID'];
                $URL = $row['taskURL'];
                echo $this->formatTasks($row,   $order);
            }
            $stmt->closeCursor();
 
            // If there aren't any list items saved, no list ID is returned
            if(!isset($LID))
            {
                $sql = "SELECT taskID, ListURL
                        FROM lists
                        WHERE UserID = (
                            SELECT UserID
                            FROM users
                            WHERE Username=:user
                        )";
                if($stmt = $this->_db->prepare($sql))
                {
                    $stmt->bindParam(':user', $_SESSION['Username'], PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $LID = $row['taskID'];
                    $URL = $row['taskURL'];
                    $stmt->closeCursor();
                }
            }
        }
        else
        {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
 
        return array($LID, $URL, $order);
    }
}

public function loadListItemsByListId()
    {
        $sql = "SELECT Name
                FROM task
                WHERE taskID=(
                    SELECT taskID
                    FROM task
                    WHERE taskURL=:task
                )
                ORDER BY Priority";
        if($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':task', $_GET['task'], PDO::PARAM_STR);
            $stmt->execute();
            $order = 1;
            while($row = $stmt->fetch())
            {
                echo $this->formatTasks($row, $order);
                  $order;
            }
            $stmt->closeCursor();
        } else {
            echo "<li> Something went wrong. ", $db->error, "</li>";
        }
    }
}


    private function formatTasks($row, $order)
    {
        $c = $this->getStatus($row['Status']);
        if($row['Date_NextDue']==CURRENT_TIMESTAMP)
        {
            $d = '<img class="crossout" src="/assets/images/crossout.png" '
                . 'style="width: 100%; display: block;"/>';
        }
        else
        {
            $d = NULL;
        }
 
        // If not logged in, manually append the <span> tag to each item
        if(!isset($_SESSION['LoggedIn'])||$_SESSION['LoggedIn']!=1)
        {
            $ss = "<span>";
            $se = "</span>";
        }
        else
        {
            $ss = NULL;
            $se = NULL;
        }
 
        return "tttt<li id="$row[taskID]" rel="$order" "
            . "class="$c" color="$row[Status]">$ss"
            . htmlentities(strip_tags($row['Name'])).$d
            . "$se</li>n";
    }
 
    /**
     * Returns the CSS class that determines color for the list item
     *
     * @param int $color    the color code of an item
     * @return string       the corresponding CSS class for the color code
     */
    private function getStatus($status)
    {
        switch($status)
        {
            case 1:
                return 'due';
            case 2:
                return 'overdue;
            default:
                return 'colorGreen';
        }
    }
}
 
?>