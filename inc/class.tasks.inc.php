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

public function loadTasksByUser()
    {
        $sql = "SELECT
                    task.UserID, Name, taskID, Status
                FROM task
                LEFT JOIN lists
                USING (UserID)
                    WHERE task.UserID=(
                        SELECT user.UserID
                        FROM user
                        WHERE user.Username=:user
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
                $UID = $row['userID'];
                echo $this->formatTasks($row,   $order);
            }
            $stmt->closeCursor();
 
            // If there aren't any list items saved, no list ID is returned
            if(!isset($UID))
            {
                $sql = "SELECT userID
                        FROM lists
                        WHERE UserID = (
                            SELECT UserID
                            FROM user
                            WHERE Username=:user
                        )";
                if($stmt = $this->_db->prepare($sql))
                {
                    $stmt->bindParam(':user', $_SESSION['Username'], PDO::PARAM_STR);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    $UID = $row['UserID'];
                    $stmt->closeCursor();
                }
            }
        }
        else
        {
            echo "tttt<li> Something went wrong. ", $db->errorInfo, "</li>n";
        }
 
        return array($UID, $order);
    }
}
private function formatTasks($row, $order) {}
}
?>