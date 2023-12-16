<?php

	session_start();

?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CarShair: Find or Share a Car</title>
	<link href="/output.css" rel="stylesheet">
	<script src="/scripts/app.js"></script>
	<script type="module" defer src="https://cdn.what3words.com/javascript-components@4.1.0/dist/what3words/what3words.esm.js"></script>
	<script nomodule defer src="https://cdn.what3words.com/javascript-components@4.1.0/dist/what3words/what3words.js"></script> 
</head>
<body>
	<nav class="bg-primary-500">
	<div class="mx-auto max-w-full px-2 sm:px-2 lg:px-4">
		<div class="relative flex h-24 items-center justify-between">
		<div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
			<!-- Mobile menu button-->
			<button type="button" id="mobile-menu-btn" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 bg-secondary-500" aria-controls="mobile-menu" aria-expanded="false">
			<span class="absolute -inset-0.5"></span>
			<span class="sr-only">Open main menu</span>
			<!--
				Icon when menu is closed.
			-->
			<svg class="menu-icon block h-6 w-6 text-primary-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
			</svg>
			<!--
				Icon when menu is open.
			-->
			<svg class="menu-icon hidden h-6 w-6 text-primary-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
			</svg>
			</button>
		</div>
		<div class="flex flex-1 items-center justify-center">
			<!--
				Logo
			-->		
			<div class="md:absolute md:inset-y-2 md:left-0 flex items-center justify-center bg-secondary-500 rounded-full h-20 w-20">
				<div class="flex flex-shrink-0 items-center">
				<svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 320 512" class="pb-0.5 fill-tertiary-300">><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V256.9L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6h29.7c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V352H152z"/></svg>
				</div>
				<div class="flex flex-shrink-0 items-center">
				<svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512" class="fill-primary-500"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 117.4L109.1 192H402.9l-26.1-74.6C372.3 104.6 360.2 96 346.6 96H165.4c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32H346.6c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2V400v48c0 17.7-14.3 32-32 32H448c-17.7 0-32-14.3-32-32V400H96v48c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V400 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>			
				</div>
				<div class="flex flex-shrink-0 items-center">
				<svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 320 512" class="pb-0.5 fill-tertiary-300">><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V256.9L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6h29.7c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V352H152z"/></svg>
				</div>
			</div>
			<div class="hidden sm:ml-6 sm:block flex items-center">
			<div class="flex justify-center items-center space-x-4">
				<a href="/index.php" class="bg-secondary-500 text-primary-900 rounded-md px-3 py-2 text-lg font-medium" aria-current="page">Home</a>
				<a href="/php/search.php" class="text-secondary-500 hover:bg-secondary-100 hover:text-primary-500 rounded-md px-3 py-2 text-lg font-medium">Search</a>
				<a href="#" class="text-secondary-500 hover:bg-secondary-100 hover:text-primary-500 rounded-md px-3 py-2 text-lg font-medium">My Bookings</a>
				<a href="/php/add-vehicle.php" class="text-secondary-500 hover:bg-secondary-100 hover:text-primary-500 rounded-md px-3 py-2 text-lg font-medium">My Vehicles</a>
			</div>
			</div>
		</div>
		<div class="absolute inset-y-0 right-0 flex justify-between items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
			<!-- Profile dropdown -->
			<div id="profile_dropdown" class="relative ml-3">
			<div>
				<button type="button" class="bg-secondary-500 relative flex w-10 h-10 justify-center items-center rounded-full text-sm" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
				<span class="absolute -inset-1.5"></span>
				<span class="sr-only">Open user menu</span>
				<svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 640 512" class="fill-primary-500"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
				</button>
			</div>

			<!--
				Dropdown menu, show/hide based on menu state.
			-->
			<div id="profile-menu" class="absolute bg-secondary-500 top-[60px] -right-[16px] z-10 mt-2 w-50 origin-top-right rounded-bl-md pt-1 pb-3 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" >
				<!-- Login -->
				<?php
					if (isset($_SESSION['u_id'])) {
						echo '<div class="relative ml-4">
							<a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
							<a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
							<form action="/includes/logout.inc.php" method="POST" class="">
							<button class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2" type="submit" name="submit">Sign out</button>
							</form>
						</div>';
					} else {
						echo '<div class="relative ml-4">
						<form action="/includes/login.inc.php" method="POST" class="flex flex-col">
							<div class="flex-col items-center">
							<input class="shadow appearance-none border rounded-full py-1 px-2 mr-4 mb-1 mt-2 text-gray-700 leading-6 focus:outline-none focus:shadow-outline" id="username" type="text" name="uid" placeholder="Username or e-mail">
							<input class="shadow appearance-none border rounded-full py-1 px-2 mr-4 mb-2 mt-1 text-gray-700 leading-6 focus:outline-none focus:shadow-outline self-end" id="password" type="password" name="pwd" placeholder="******************">
							</div>
							<div>
								<button class="bg-primary-500 hover:bg-primary-200 text-white font-bold py-2 w-20 rounded-full focus:outline-none focus:shadow-outline" type="submit" name="submit">
									Login
								</button>
								<a href="/php/signup.php" class="hover:text-primary-200 hover:underline text-primary-500 font-bold ml-4 mb-2 py-2 w-20 rounded focus:outline-none focus:shadow-outline cursor-pointer">
									Sign Up
								</a>
							</div>
						</form>
					</div>';
					}
				?>
			</div>
			</div>
		</div>
		</div>
	</div>

	<!-- Mobile menu, show/hide based on menu state. -->
	<div class="sm:hidden hidden" id="mobile-menu">
		<div class="space-y-1 px-2 pb-3 pt-2">
		<a href="/php/search.php" class="bg-secondary-500 text-primary-900 block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Home</a>
		<a href="/php/search.php" class="text-secondary-500 hover:bg-secondary-100 hover:text-primary-500 block rounded-md px-3 py-2 text-base font-medium">Search</a>
		<a href="#" class="text-secondary-500 hover:bg-secondary-100 hover:text-primary-500 block rounded-md px-3 py-2 text-base font-medium">My Bookings</a>
		<a href="/php/add-vehicle.php" class="text-secondary-500 hover:bg-secondary-100 hover:text-primary-500 block rounded-md px-3 py-2 text-base font-medium">My Vehicles</a>
		</div>
	</div>
	</nav>