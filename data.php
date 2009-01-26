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

function streakForPerson($person_id) {
  global $db;
  
  $sql = "SELECT distinct(TO_DAYS(NOW()) - TO_DAYS(created))
          FROM jos_content WHERE sectionid = 9 AND created_by = ?
          ORDER BY created DESC";
  $post_days = $db->getCol($sql, 0, array($person_id));
  
  $streak = 0;
  foreach ($post_days as $days) {
    if ($days > ($streak + 1) * 7) { break; }
    if ($days > $streak * 7 && $days <= ($streak + 1) * 7) { $streak++; }
  }
  return $streak;
}

function peopleWithEntriesDaysAgo($newer, $older = 0) {
  global $db;
  
  $sql = "SELECT u.id, u.username, u.email, u.name, title, c.created, 
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

function timeAgoInWords($days) {
  switch($days) {
    case 0:
      return "today"; break;
    case 1:
      return "yesterday"; break;
    case 2:
    case 3:
    case 4:
    case 5:
    case 6:
      return $days . " days ago"; break;
    case 7:
      return "a week ago"; break;
    default:
      if ($days < 30) {
        if ($days > 7 and $days < 14) {
          return "over a week ago";
        }
        else {
          return ceil($days / 7) . " weeks ago";
        }
      }
      else {
        return ceil($days / 30) . " months ago";
      }
  }
}

function emailLink($email) {
  $email_ob = "";
  for($i=0,$c=substr($email, $i, 1); $c=substr($email, $i++, 1); ) {
    $email_ob .= "&#x" . dechex(ord($c)) . ";";
  }
  return "<a href='mailto:$email_ob'>$email_ob</a>";
}