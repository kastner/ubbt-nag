<?php

require('data.php');
$last_week = peopleOnTeamWithEntriesBeforeXDays(CURRENT_TEAM, 7);
$slackers = peopleOnTeamWithEntriesAfterXDays(CURRENT_TEAM, 7);
$alumni = peopleNotOnTeamWithEntries(CURRENT_TEAM);
$spotlight = $last_week[rand(0, count($last_week)-1)];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <title>UBBT Journal Requirement</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.5.3/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
  <link rel="stylesheet" href="reset.css" type="text/css" charset="utf-8"/>
  <link rel="stylesheet" href="style.css" type="text/css" charset="utf-8"/>
</head>
<body id="nag">
  <div id="page">
    <h1><img src="images/ubbt-journal-reqs.png" alt="Ubbt Journal Requirment"/></h1>
    <p class="about">Every UBBT participant is required to make a weekly journal entry on the UBBT web site. Find someone who is falling behind, and help them by sending a friendly email.</p>
    
    <div id="member-groupings">
      <div id="on-target">
        <h3 class="information-heading">
          <img src="images/green-check.png" alt="Green Check"/>
          <?php echo plural(count($last_week), "Member", "s") ?> 
          on target &ndash; an entry in the past week 
          <span>[ <a href="#on-target">show</a> ]</span>
        </h3>
        
        <ul class="member-collection">
          <?php foreach ($last_week as $member): ?>
          <?php include "_member_post_info.php"; ?>
          <?php endforeach ?>
        </ul>
      </div>

      <div id="falling-behind">
        <h3 class="information-heading">
          <img src="images/red-x.png" alt="Red X"/>
          <?php echo plural(count($slackers), "Member", "s") ?> 
          falling behind
          <span>[ <a href="#falling-behind">show</a> ]</span>
        </h3>
        
        <ul class="member-collection">
          <?php foreach ($slackers as $member): ?>
          <?php include "_member_post_info.php"; ?>
          <?php endforeach ?>
        </ul>
      </div>

      <div id="alumni">
        <h3 class="information-heading">
          <img src="images/yellow-bang.png" alt="Yellow Exclamation"/>
          <?php echo plural(count($alumni), "Alumni member", "s") ?> 
          are journaling
          <span>[ <a href="#alumni">show</a> ]</span>
        </h3>
        
        <ul class="member-collection">
          <?php foreach ($alumni as $member): ?>
          <?php include "_member_post_info.php"; ?>
          <?php endforeach ?>
        </ul>
      </div>
    </div> <!-- #member-groupings -->
    
    <div id="spotlight">
      <h3 class="information-heading"><img src="images/yellow-star.png" alt="Yellow Star"/> Spotlight</h3>
      <div>
        <a href="http://ubbt.thenewwaynetwork.com/index.php?option=com_myblog&amp;blogger=<?php echo $spotlight["username"] ?>&amp;Itemid=1"><?php echo $spotlight["name"] ?></a><br/>
        Current Streak: <?php echo plural(streakForPerson($spotlight["id"]), "week") ?>
      </div>
    </div>
  </div>
  
  <script type="text/javascript" charset="utf-8">
    $(function() {
      $(".member-collection").hide();
      
      $("#member-groupings h3.information-heading").click(function() {
        $this = $(this).find("a");
        var div = $this.parents("div").children(".member-collection");
        div.toggle();
        if ($this.html() == "hide") {
          $this.html("show");
          document.location.hash = '#none';
          return false;
        }
        else {
          $this.html("hide");
        }
      });
      
      // $("#member-groupings h3").click(function(event) {
      //   event.preventDefault();
      //   $(this).find("a").click();
      // });
      
      if (document.location.hash) {
        $(document.location.hash).find("h3.information-heading a").click();
      }
    });
  </script>
</body>
</html>