<?php
	get_header(); 
	session_start();
	if (!isset($_SESSION['rand'])) {
		$_SESSION['rand'] = 0;
	}
?>
<script src="/wp-content/plugins/verse-mem/assets/js.cookie.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
let gamecompleted = false;
if (Cookies.get('progress')=='up'){
	playDing();
}else if(Cookies.get('progress')=='down'){
	playBad();
}
</script>
<script>let adminURL = '<?php echo admin_url('admin-ajax.php'); ?>';</script>
<?php
$verses = get_user_meta( get_current_user_id(), 'mem_verse' );
$disabled = true;
?>
<style>#lc-header{display:none!important}#lc-footer{display:none!important}</style>
<?php
		$v = $_GET["v"]; 
		$verses = get_user_meta( get_current_user_id(), 'mem_verse' );
		$verse = $verses[$v];
		$text = $verse['text'].' '.str_replace("–","-",str_replace("’","'",$verse['title']));

		$progress = $verse['score']/$verse['difficulty']*100;

		$gamemin = 1;
		$gamemax = 3;

		// Set available games based on difficulty
		if ($progress > 70){
			$gamemin = 2;
			$gamemax = 6;
		}elseif ($progress > 30){
			$gamemin = 1;
			$gamemax = 4;
		}

		$selectGame = rand($gamemin,$gamemax);

		do {
			$selectGame = rand($gamemin,$gamemax);
		  } while ($selectGame == $_SESSION['rand']);

		$_SESSION['rand'] = $selectGame;

	?>

<div class="container">
	<div class="fixed-top bg-white border-bottom border-light">
		<div class="container px-3 d-flex flex-row align-items-center gap-4 ">
			<a class="text-decoration-none text-light h1 mb-1 font-weight-bold" style="cursor:pointer" href="/<?php echo ($verse['completed'] == true) ? 'practice' : 'learn' ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentcolor" d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/></svg></a>
			<div class="w-100 progress my-3 my-sm-4 border-bottom border-light">
				<div id="gameProgress" class="progress-bar-striped bg-secondary" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
		</div>
	</div>
	
	<div class="container game-cont" style="max-width:800px;">

		<div id="gameBoard" class="game-board">
			<?php include("games/game-".$selectGame.".php")?>
		</div>

	</div>

	<div class="border-top border-light bg-white fixed-bottom">
		<div class="container">
			<div class="my-4">
				<button onclick="removeScore();" class="btn btn-ouline-success">Skip</button>
				<button id="buttonNext" onClick="makeScore(<?php echo $v ?>,<?php echo ($verse['completed'] == true) ? '\'practice\'' : '\'learn\'' ?>);" class="<?php echo ($disabled == true) ? 'disabled' : '' ?> btn display-3 py-2 px-5 float-end text-white btn-secondary">Next</button>
			</div>
		</div>
	</div>

	<style>
		.game-board{
			font-size: 20px;
		}
		@media only screen and (min-width: 600px) {
			.game-board{
				font-size:30px;
			}
		}
		.game-board{
			cursor: default;
		}

		.game-cont{
			margin-top:70px;margin-bottom:120px
		}

		@media only screen and (min-width: 600px) {
			.game-cont{
				margin-top:120px;margin-bottom:120px
			}
		}

	</style>

	<script>
		$(document).keydown(function(){
			if(event.keyCode == 13){
				if ( gamecompleted == true ){
					makeScore(<?php echo $v ?>,<?php echo ($verse['completed'] == true) ? '\'practice\'' : '\'learn\'' ?>);
				}
			}
		});

		let scorePercentage = Cookies.get('score')*10;
    	$("#gameProgress").attr("style", `width:${scorePercentage}%`);
	</script>



	</div>
</div>
<?php include("parts/footer.php")?>