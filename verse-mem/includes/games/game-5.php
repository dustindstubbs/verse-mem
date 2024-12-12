<h1 class="my-3">Type the first letter of each word.</h1>
	<input style="position:absolute;opacity:0" autocomplete="off" id="verseTyper">
	<div id="origin">
		<?php
		// Random Chunks
		$verseArray = explode(' ', $text);

		foreach ($verseArray as $word){
				echo '<span class="hiddenword">'.$word.'</span> ';
		}

		?>
	</div>
</div>
<style>
	<?php if ($progress > 60){ ?>
	.hiddenword{
		display:none!important;
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