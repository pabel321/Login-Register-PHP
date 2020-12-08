<?php
include 'inc/header.php';
include 'lib/User.php';
$user=new User();
?>

<?php
$loginmsg=Session::get("loginmsg");
if (isset($loginmsg)) {
	echo $loginmsg;
}
?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>User list<span class="pull-right"><strong>Welcome!</strong>
				<?php
				$name=Session::get("name");
				if (isset($name)) {
					echo $name;
				}
				?>
			</span></h2>
		</div>
		<div class="panel-body">
			<table class="table table-striped">
				<th width="20%">Serial</th>
				<th width="20%">Name</th>
				<th width="20%">Username</th>
				<th width="20%">Email Address</th>
				<th width="20%">Action</th>
				<tr>
					<td>1</td>
					<td>Pabel Rana</td>
					<td>pabelrn</td>
					<td>pabelrana95@gmail.com</td>
					<td><a class="btn btn-primary" href="profile.php?id=1">View</a></td>
				</tr>
				<tr>
					<td>2</td>
					<td>Imrul Kayes</td>
					<td>ikayes</td>
					<td>ikayes95@gmail.com</td>
					<td><a class="btn btn-primary" href="profile.php?id=2">View</a></td>
				</tr>
				<tr>
					<td>3</td>
					<td>Sagor Mallick</td>
					<td>smallick</td>
					<td>smallick95@gmail.com</td>
					<td><a class="btn btn-primary" href="profile.php?id=3">View</a></td>
				</tr>
			</table>
		</div>
	</div>

	<?php
include 'inc/footer.php';
?>