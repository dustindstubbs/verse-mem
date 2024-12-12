<h1 class="my-3">Tap each blank as you read.</h1>
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
	.hiddenword{
		color:#fff!important;
		border-bottom: 3px solid black;
	}
</style>
<script>

	wordArray = $('.hiddenword');
	
	i=0;

	$('.hiddenword').click(function(e) {
		$(event.target).removeClass('hiddenword');
		
		i++;

		if (i == wordArray.length){
			gameComplete();
		}
	});

</script>