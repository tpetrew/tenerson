<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Refresh" content="600" />
	<link rel="stylesheet" type="text/css" href="assets/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tenerson | Home</title>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Satisfy&display=swap" rel="stylesheet">
	<script ENGINE="text/javascript" src="https://code.jquery.com/jquery-1.11.2.js "></script>
	<link rel="shortcut icon" href="assets/images/iPhone 11 Pro/24/basic/more-vertical.svg" type="image/x-icon">
</head>
<body onload="getusersPage()">

<div class="wrapper">
	<div class="phone-layout">

		<div id="message"></div>

		<div id="delete-person__wrapper" style="display: none;">
				<div id="delete-person__wrapper__phone" style="display: none;">
					<div id="delete-person" style="display: none;">
						<div id="delete_person_id" class="delete-person__button"></div>
						<div class="delete-person__button" style="color: #333333; border-top: 1px solid #DEEBEF;" onmousedown="deletePerson_hide()">Отмена</div>
					</div>
				</div>
		</div>

		<div id="new-person__wrapper" style="display: none;">
				<div id="new-person__wrapper__phone" style="display: none;">
					<div id="new-person" style="display: none;">
						<div class="h1">
							<span>Add new person</span>
							<div class="close-btn" onmousedown="newPerson_hide()">x</div>
						</div>
						<div class="delete-person__button">

							<form id="newperson">
								<input type="text" name="name" placeholder="Nickname" style="color: #AAAAAA;"/><br>
								<input style="color: #FF1058;" class="submit-button" type="submit" name="send" placeholder="Add">
							</form>

						</div>
					</div>
				</div>
			</div>

		<div class="logo">Tenerson</div>
		<div class="profiles-circle__wrapper">

			<!-- 1 -->
			<div class="circle__profile" onmousedown="newPerson()" style="cursor: pointer;">
				<div class="circle">+</div>
				<div class="circle-under__name" style="color: #FF1058">New</div>
			</div>

			<div class="profiles-circle__wrapper-new"></div>
		</div>

		<div class="after-profiles__line"></div>

		<div class="posts-layout"></div>


	</div>
</div>

<script type="text/javascript" src="assets/app.js"></script>

</body>
</html>
