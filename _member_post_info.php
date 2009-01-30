<li>
  <img class="avatar" src="http://ubbt.thenewwaynetwork.com/images/comprofiler/tn<?php echo $member[avatar] ?>"/>
  <div class="info">
    <a href="http://ubbt.thenewwaynetwork.com/index.php?option=com_myblog&amp;blogger=<?php echo $member["username"] ?>&amp;Itemid=1"><?php echo $member["name"] ?></a> 
    <?php if (is_numeric($member["cb_team"])): ?>
      (Team <?php echo $member["cb_team"] ?>)
    <?php endif ?>
    <br/>

    <?php echo emailLink($member["email"]) ?><br/>

    wrote <?php echo timeAgoInWords($member["days_ago"]) ?><br/>

    <em><?php echo $member["title"] ?></em>
  </div>
</li>
