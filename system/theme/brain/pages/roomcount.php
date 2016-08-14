<?php
	$sql = DB::Query("SELECT id,users_now,caption,owner FROM rooms WHERE users_now > 0 ORDER BY users_now DESC LIMIT 5");
	while($on = $sql->fetch_assoc())
	{
	?>
	<a  style="text-decoration: none;color: #000;">
		<img  src="/system/theme/brain/style/images/icons/habbo_online_anim.gif" align="right"> 
		<?php
			if ($on['users_now'] == 0)
			{
				$onlineUsers = '<img style="padding-right: 10px;" src="/system/theme/brain/style/images/icons/room_icon_1.gif" align="left">';
			}
			else if ($on['users_now'] > 29)
			{
				$onlineUsers = '<img style="padding-right: 10px;" src="/system/theme/brain/style/images/icons/room_icon_5.gif" align="left">';
			}
			else if ($on['users_now'] > 19)
			{
				$onlineUsers = '<img style="padding-right: 10px;" src="/system/theme/brain/style/images/icons/room_icon_4.gif" align="left">';
			}
			else if ($on['users_now'] > 9)
			{
				$onlineUsers = '<img style="padding-right: 10px;" src="/system/theme/brain/style/images/icons/room_icon_3.gif" align="left">';
			}
			else if ($on['users_now'] > 0)
			{
				$onlineUsers = '<img style="padding-right: 10px;" src="/system/theme/brain/style/images/icons/room_icon_2.gif" align="left">';
			}
			echo $onlineUsers;
			$getMembers = DB::Query("SELECT username FROM users WHERE id = '" . DB::Escape($on['owner']) . "'");
			$member = mysqli_fetch_assoc($getMembers);
		?>
		<div class="users_now">
		</div>
		<div class="caption">
		<b><?php echo filter($on['caption']); ?>.</b>                    </div>
		<div class="owner">
			Momenteel in de kamer<b><?php echo $on['users_now']; ?></b> gebruikers.<br>
			Kamer eigenaar: <a href="/home/<?= filter($member['username']) ?>"><b><?php echo filter($member['username']); ?></a></b>
		</div>
		<hr>
	</a>
	<?php
	}
?>