<?php
require_once("DB.php");

function handleErrors($error) {
    echo "An error occurred while trying to run your query.<br>\n";
    echo "Error message: " . $error->getMessage() . "<br>\n";
    echo "A more detailed error description: " . $error->getDebugInfo() . "<br>\n";
}

PEAR::setErrorHandling(PEAR_ERROR_CALLBACK, 'handleErrors');

$db = DB::Connect("mysql://root@localhost/ubbt") or die("Sorry");
$db->setFetchMode(DB_FETCHMODE_ASSOC);        


function peopleWithEntriesDaysAgo($newer, $older = 0) {
  global $db;
  
  $sql = "SELECT u.id, u.name, title, c.created, 
                TO_DAYS(NOW()) - TO_DAYS(c.created) days_ago
          FROM jos_users u 
          LEFT JOIN jos_content c ON c.created_by = u.id 
          INNER JOIN (
            SELECT created_by, MAX(created) created 
            FROM jos_content 
            WHERE sectionid = 9
            GROUP BY created_by
          ) as x ON x.created_by = c.created_by and x.created = c.created 
          WHERE sectionid = 9
          AND TO_DAYS(NOW()) - TO_DAYS(c.created) BETWEEN ! AND !
          GROUP BY u.id 
          ORDER BY days_ago";
  $sql = "SELECT u.*, c.title, TO_DAYS(created) days_ago 
          FROM jos_users u 
          INNER JOIN jos_content c ON c.created_by = u.id
          WHERE c.sectionid = 9 
          AND TO_DAYS(NOW()) - TO_DAYS(created) BETWEEN ! AND !
          GROUP BY u.id
          ORDER BY created";
  return $db->getAll($sql, array($older, $newer));
}

function peopleWithoutEntries() {
  global $db;
  
  $sql = "SELECT u.*, '' title, -1 days_ago 
          FROM jos_users u 
          INNER JOIN jos_content c ON c.created_by = u.id
          WHERE c.id IS NULL
          ORDER BY name";
  return $db->getAll($sql);
}

function plural($num, $base, $addAnS = "s") {
  return $num . " " . $base . (($num == 1) ? "" : $addAnS);
}