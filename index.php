<?php 
include 'ligar_db.php';

check_login();

if (isset($_GET['chat'])) {
	$chat = htmlspecialchars(mysqli_real_escape_string($link, $_GET['chat']));

	if ($chat == "psicologo") {
		$bot = "Psychologist";
		$img = "psicologo.jpg";
		$prompt = "I want you to act as a psychologist, therapist, mental health helper and provide me with insights on how to cope with anxiety during uncertain times/ pandemic situation.";
	} elseif ($chat == "programmer") {
		$bot = "Programmer";
		$img = "programmer.jpg";
	} elseif ($chat == "jarvis") {
		$bot = "Jarvis";
		$img = "jarvis.png";
	} elseif ($chat == "buddy") {
		$bot = "Buddy";
		$img = "buddy.jpg";
	} 
} else {
	$bot = "Jarvis";
	$img = "jarvis.png";
}
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" href="style.css"> -->
	<title><?php echo $bot; ?> - Your personal friend and assistant :)</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="fontawesome/css/all.min.css">

	<script type="text/javascript" src="fontawesome/js/all.min.js"></script>

	<style>
		*{
			box-sizing:border-box;
		}
		body{
			background-color:#abd9e9;
			font-family: 'Roboto', sans-serif;

		}
		#container{
			width:750px;
			height:100vh; /* 800px */
			background:#eff3f7;
			margin:0 auto;
			font-size:0;
			border-radius:5px;
			overflow:hidden;
		}
		aside{
			width:260px;
			height:800px;
			background-color:#3b3e49;
			display:inline-block;
			font-size:15px;
			vertical-align:top;
		}
		main{
			/* width:490px; */
			width: 100%;
			height:100vh; /* 800px */
			display:inline-block;
			font-size:15px;
			vertical-align:top;
		}

		aside header{
			padding:30px 20px;
		}
		aside input{
			width:100%;
			height:50px;
			line-height:50px;
			padding:0 50px 0 20px;
			background-color:#5e616a;
			border:none;
			border-radius:3px;
			color:#fff;
			background-image:url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_search.png);
			background-repeat:no-repeat;
			background-position:170px;
			background-size:40px;
		}
		aside input::placeholder{
			color:#fff;
		}
		aside ul{
			padding-left:0;
			margin:0;
			list-style-type:none;
			overflow-y:scroll;
			height:690px;
		}
		aside li{
			padding:10px 0;
		}
		aside li:hover{
			background-color:#5e616a;
		}
		h2,h3{
			margin:0;
		}
		aside li img{
			border-radius:50%;
			margin-left:20px;
			margin-right:8px;
		}
		aside li div{
			display:inline-block;
			vertical-align:top;
			margin-top:12px;
		}
		aside li h2{
			font-size:14px;
			color:#fff;
			font-weight:normal;
			margin-bottom:5px;
		}
		aside li h3{
			font-size:12px;
			color:#7e818a;
			font-weight:normal;
		}

		.status{
			width:8px;
			height:8px;
			border-radius:50%;
			display:inline-block;
			margin-right:7px;
		}
		.green{
			background-color:#58b666;
		}
		.orange{
			background-color:#ff725d;
		}
		.blue{
			background-color:#6fbced;
			margin-right:0;
			margin-left:7px;
		}

		main header{
			height:110px;
			padding:30px 20px 30px 40px;
		}
		main header > *{
			display:inline-block;
			vertical-align:top;
		}
		main header img:first-child{
			border-radius:50%;
		}
		main header img:last-child{
			width:24px;
			margin-top:8px;
		}
		main header div{
			margin-left:10px;
			margin-right:145px;
		}
		main header h2{
			font-size:16px;
			margin-bottom:5px;
		}
		main header h3{
			font-size:14px;
			font-weight:normal;
			color:#7e818a;
		}

		#chat{
			padding-left:0;
			margin:0;
			list-style-type:none;
			overflow-y:scroll;
			height:60vh; /* 535px */
			border-top:2px solid #fff;
			border-bottom:2px solid #fff;
		}
		#chat li{
			padding:10px 30px;
		}
		#chat h2,#chat h3{
			display:inline-block;
			font-size:13px;
			font-weight:normal;
		}
		#chat h3{
			color:#bbb;
		}
		#chat .entete{
			margin-bottom:5px;
		}
		#chat .message{
			padding:20px;
			color:#fff;
			line-height:25px;
			max-width:90%;
			display:inline-block;
			text-align:left;
			border-radius:5px;
		}
		#chat .me{
			text-align:right;
		}
		#chat .you .message{
			background-color:#58b666;
		}
		#chat .me .message{
			background-color:#6fbced;
		}
		#chat .triangle{
			width: 0;
			height: 0;
			border-style: solid;
			border-width: 0 10px 10px 10px;
		}
		#chat .you .triangle{
			border-color: transparent transparent #58b666 transparent;
			margin-left:15px;
		}
		#chat .me .triangle{
			border-color: transparent transparent #6fbced transparent;
			margin-left:375px;
		}

		main footer{
			height:155px;
			padding:20px 30px 10px 20px;
		}
		main footer textarea{
			resize:none;
			border:none;
			display:block;
			width:100%;
			height:80px;
			border-radius:3px;
			padding:20px;
			font-size:13px;
			margin-bottom:13px;
		}
		main footer textarea::placeholder{
			color:#ddd;
		}
		main footer img{
			height:30px;
			cursor:pointer;
		}
		main footer a{
			text-decoration:none;
			text-transform:uppercase;
			font-weight:bold;
			color:#6fbced;
			vertical-align:top;
			margin-left:333px;
			margin-top:5px;
			display:inline-block;
		}
	</style>
</head>

<body>

	<div style="    background-color: rgba(30, 40, 51, 0.6);
    color: white;
    padding: 0.5%; position: fixed;
    left: 0.5%;
    top: 0.5%; z-index: 2; border-radius: 6%;">
    <a href="home.php" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Home</a>
  </div>
	<div id="container">
		<main>
			<header>
				
				<img src="<?php echo $img; ?>" alt="" style="width: 9%; height: 120%; ">
				<div>
					<h2>Chat with <?php echo $bot; ?> Assistant</h2>
					<h3>Online</h3>
				</div>
				<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_star.png" alt="">
			</header>
			<ul id="chat">
				<!--
				<li class="you">
					<div class="entete">
						<span class="status green"></span>
						<h2>Vincent</h2>
						<h3>10:12AM, Today</h3>
					</div>
					<div class="triangle"></div>
					<div class="message">
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
					</div>
				</li>
				<li class="me">
					<div class="entete">
						<h3>10:12AM, Today</h3>
						<h2>Vincent</h2>
						<span class="status blue"></span>
					</div>
					<div class="triangle"></div>
					<div class="message">
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
					</div>
				</li>

			-->
		</ul>
		<footer>
			<textarea placeholder="Type your message" id="message"></textarea>
			<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_picture.png" alt="" style="display: none;">
			<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_file.png" alt="" style="display: none;">
			<button class="btn btn-primary btn-lg" href="#" id="send" style="width: 100%;
			margin: 0; font-family: 'Roboto', sans-serif;"><i class="fa-solid fa-paper-plane"></i> or press Enter</button>
		</footer>
	</main>
</div>
<script
src="https://code.jquery.com/jquery-3.7.0.min.js"
integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
crossorigin="anonymous"></script>
<script>
	$(document).ready(function() {
		setTimeout(function() {
			scrollToBottom();
		}, 50);

			var lastMessageId = 0; // Initialize the lastMessageId  : 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

			loadMessages();

			// Periodically update messages every 5 seconds (adjust the interval as needed)
			setInterval(function() {
				loadNewMessages();
			}, 3000);

			$('#send').on('click', function() {
				sendMessage();
			});

			$('#message').on('keypress', function(e) {
				if(e.which == 13) {
					sendMessage();
					return false;
				}
			});

			function loadMessages() {
				$.ajax({
					url: 'load_messages.php',
					type: 'GET',
					dataType: 'json', // Specify the expected data type as JSON
					success: function(messages) {
						for (var i = 0; i < messages.length; i++) {
							var message = messages[i];

							var roleClass = message.sender === 'Gabriel Brandão' ? 'me' : 'you';
							var triangleMargin = message.sender === 'Gabriel Brandão' ? 'margin-left:375px;' : 'margin-left:15px;';
							var messageColor = message.status === 'blue' ? '#6fbced' : '#58b666';

							var html = `<li class="${roleClass}">
							<div class="entete">
							<span class="status ${message.status}"></span>
							<h2>${message.sender}</h2>
							<h3>${message.timestamp}</h3>
							</div>
							<div class="triangle" style="${triangleMargin}"></div>
							<div class="message" style="background-color: ${messageColor};">
							${message.content}
							</div>
							</li>`;

							$("#chat").append(html);

							// Update the lastMessageId
							lastMessageId = message.id;
						}
					}
				});
			}

			function loadNewMessages() {
				$.ajax({
					url: 'load_new_messages.php',
					type: 'GET',
					dataType: 'json',
					success: function (messages) {
						var lastMessage = $('#chat li:last .message').text().trim();

						for (var i = 0; i < messages.length; i++) {
							var message = messages[i];

                // Check if the content of the message is equal to the last message content
							if (message.content.trim() !== lastMessage) {
								var html = `<li class="you">
								<div class="entete">
								<span class="status ${message.status}"></span>
								<h2>Jarvis Assistant</h2>
								<h3>${message.timestamp}</h3>
								</div>
								<div class="triangle" style="margin-left:15px;"></div>
								<div class="message" style="background-color: #58b666;">
								${message.content}
								</div>
								</li>`;

								$("#chat").append(html);
								scrollToBottom();
							}
						}

            // Scroll to the bottom of the chat
						
					}
				});
			}




			function appendMessage(message) {
				var roleClass = message.role === 0 ? 'me' : 'you';
				var triangleMargin = message.role === 0 ? 'margin-left:375px;' : 'margin-left:15px;';
				var messageColor = message.role === 0 ? '#6fbced' : '#58b666';

				var html = `<li class="${roleClass}">
				<div class="entete">
				<span class="status ${message.status}"></span>
				<h2>${message.sender}</h2>
				<h3>${message.timestamp}</h3>
				</div>
				<div class="triangle" style="${triangleMargin}"></div>
				<div class="message" style="background-color: ${messageColor};">
				${message.content}
				</div>
				</li>`;

				$("#chat").append(html);
			}

			function sendMessage() {
				$("#send").html('<i class="fa-solid fa-gear fa-spin"></i>');
				
				
				var message = $('#message').val().replace(/(<([^>]+)>)/ig, "").trim();

				if (message != '') {
					$.ajax({
						url: 'enviar_mensagem.php',
						type: 'POST',
						data: {
							message: message
						},
						success: function() {
							var messageData = {
								sender: 'Gabriel Brandão',
								content: message,
								timestamp: '10:12AM, Today',
								role: 0
							};
							appendMessage(messageData);
							$('#message').val('');

							// Scroll to the bottom of the chat
							scrollToBottom();
							$("#send").html('<i class="fa-solid fa-paper-plane"></i> or press Enter');
						}
					});
				}
			}

			function scrollToBottom() {
				var chatContainer = document.getElementById("chat");
				chatContainer.scrollTop = chatContainer.scrollHeight;
			}
		});
	</script>

</body>
</html>