<li>
  <?php echo timeAgoInWords($member["days_ago"]) ?>
  <a href="http://ubbt.thenewwaynetwork.com/index.php?option=com_myblog&amp;blogger=<?php echo $member["username"] ?>&amp;Itemid=1"><?php echo $member["name"] ?></a>
  &lt;<?php echo emailLink($member["email"]) ?>&gt;
  &mdash; 
  <?php echo $member["title"] ?>  
</li>
