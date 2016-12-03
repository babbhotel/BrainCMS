<?php
	$sql = $dbh->prepare("SELECT id,users_now,caption,owner FROM rooms WHERE users_now > 0 ORDER BY users_now DESC LIMIT 5");
	$sql->execute();
	while ($on = $sql->fetch())
	{
	?>
	<a  style="text-decoration: none;color: #000;">
		<img  src="/system/content/theme/brain/style/images/icons/habbo_online_anim.gif" align="right"> 
		<?php
			if ($on['users_now'] == 0)
			{
				$onlineUsers = '<img style="padding-right: 10px;" src="/system/content/theme/brain/style/images/icons/room_icon_1.gif" align="left">';
			}
			else if ($on['users_now'] > 29)
			{
				$onlineUsers = '<img style="padding-right: 10px;" src="/system/content/theme/brain/style/images/icons/room_icon_5.gif" align="left">';
			}
			else if ($on['users_now'] > 19)
			{
				$onlineUsers = '<img style="padding-right: 10px;" src="/system/content/theme/brain/style/images/icons/room_icon_4.gif" align="left">';
			}
			else if ($on['users_now'] > 9)
			{
				$onlineUsers = '<img style="padding-right: 10px;" src="/system/content/theme/brain/style/images/icons/room_icon_3.gif" align="left">';
			}
			else if ($on['users_now'] > 0)
			{
				$onlineUsers = '<img style="padding-right: 10px;" src="/system/content/theme/brain/style/images/icons/room_icon_2.gif" align="left">';
			}
			echo $onlineUsers;
			$getMembers = $dbh->prepare("SELECT username FROM users WHERE id = :owner");
			$getMembers->bindParam(':owner', $on['owner']);
			$getMembers->execute();
			$getMemberss = $getMembers->fetch();
			
			
			
		?>
		<div class="users_now">
		</div>
		<div class="caption">
		<b><?php echo filter($on['caption']); ?>.</b>                    </div>
		<div class="owner">
			Momenteel in de kamer<b><?php echo filter($on['users_now']); ?></b> gebruikers.<br>
			Kamer eigenaar: <a href="/home/<?= filter($getMemberss['username']) ?>"><b><?php echo filter($getMemberss['username']); ?></a></b>
		</div>
		<hr>
	</a>
	<?php
	}
?>