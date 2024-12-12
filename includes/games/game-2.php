<h1 class="my-3">Type the first letter of each blank.</h1>
	<input style="position:absolute;opacity:0" autocomplete="off" id="verseTyper">
	<div id="origin">
		<?php
		// Random Chunks
		$verseArray = explode(' ', $text);

		$maxrand = 4;
			
		if ($progress > 60 ){
			$maxrand = 2;
		}elseif($progress > 30 ){
			$maxrand = 3;
		}

		foreach ($verseArray as $word){
				if (rand(1, $maxrand) == 1){
					echo '<span class="hiddenword">'.$word.'</span> ';
				}else{
					echo '<span>'.$word.'</span> ';
				}
		}

		?>
	</div>
</div>
<style>
	<?php if ($progress > 20){ ?>
	.hiddenword{
		color:#fff!important;
		border-bottom: 3px solid black;
	}
	<?php }else{ ?>
	.hiddenword{
		color: #c1c1c1;
	}
	<?php } ?>
</style>
<script>

	wordArray = $('.hiddenword');

	$('#verseTyper').focus();

	$(document).click(function(e) {
		$('#verseTyper').focus();
	});
	
	i=0;

	$('#verseTyper').keypress(function(e){
		// Increment letter check if keypress matches current
		
		let keyPressed = String.fromCharCode( e.which );

		if (keyPressed.toLowerCase() == $(wordArray[i]).html().charAt(0).toLowerCase()){

			$(wordArray[i]).removeClass('hiddenword');

			i++;
			
		}
		// Check if completed
		if (i == wordArray.length){
			gameComplete();
		}

		$('#verseTyper').val('');
	});
</script>