<h1 class="my-3">Type the verse<?php echo ($progress > 80) ? '' : ' as it appears' ?>.</h1>
	<input style="position:absolute;opacity:0" autocomplete="off" id="verseTyper">
	<div id="origin">
		<?php
		// Random Chunks
		$verseArray = str_split($text);

		foreach ($verseArray as $letter){
				echo '<span class="hiddenword">'.$letter.'</span>';
		}

		?>
	</div>
</div>
<style>
	<?php if ($progress > 85){ ?>
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

	console.log($(wordArray[i]).html().toLowerCase());

	$('#verseTyper').keypress(function(e){
		// Increment letter check if keypress matches current
		
		let keyPressed = String.fromCharCode( e.which );

		if (keyPressed.toLowerCase() == $(wordArray[i]).html().toLowerCase()){

			$(wordArray[i]).removeClass('hiddenword');

			i++;

			// Move forward if space, weird hyphen, comma, period or colon
			if ($(wordArray[i]).html() == ' ') {
				$(wordArray[i]).removeClass('hiddenword');
				i++;
			}else if($(wordArray[i]).html() == ':') {
				$(wordArray[i]).removeClass('hiddenword');
				i++;
			}else if($(wordArray[i]).html() == ',') {
				$(wordArray[i]).removeClass('hiddenword');
				i++;
				if($(wordArray[i]).html() == ' ') {
					$(wordArray[i]).removeClass('hiddenword');
					i++;
				}
			}else if($(wordArray[i]).html() == '.') {
				$(wordArray[i]).removeClass('hiddenword');
				i++;
				if($(wordArray[i]).html() == ' ') {
					$(wordArray[i]).removeClass('hiddenword');
					i++;
				}
			}
			
		}
		// Check if completed
		if (i == wordArray.length){
			gameComplete();
		}

		$('#verseTyper').val('');
	});
</script>