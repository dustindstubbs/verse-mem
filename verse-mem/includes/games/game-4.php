<h1 class="my-3">Tap the bubbles in order.</h1>

<div class="words">
  <div class="destination"></div>
  	<div class="origin">
		<?php
		// Random Chunks
		$verseArray = explode(' ', $text);
		$chunkArray = array();
		$blanksVerse = array();
		$chunksDifficulty = 3;

		if ($progress > 70 ){
			$chunksDifficulty = 2;
		}

		$verseArray = array_chunk($verseArray, $chunksDifficulty);

		foreach ($verseArray as $chunk) {
			$chunk = implode(' ', $chunk);
			array_push($chunkArray, $chunk);
		}

		foreach ($chunkArray as $word){
			
				$word = '<div class="holder btn btn-light"><button class="word">'.$word.'</button></div>';
				array_push($blanksVerse, $word);
		}

		shuffle($blanksVerse);

 		echo implode(' ', $blanksVerse);

		?>
    </div>
</div>

<style>
	.words {
	display: flex;
	flex-direction: column;
	border-radius: 1rem;
	max-width: 100%;
	}

	.destination {
	display: flex;
	flex-flow: row wrap;
	align-items: flex-start;
	align-content: flex-start;
	margin: 0 0 2rem;
	min-height: 60px;
	}

	.origin {
	display: flex;
	flex-flow: row wrap;
	justify-content: center;
	align-items: flex-start;
	margin: 0 auto;
	}

	.holder {
	display: flex;
	flex-direction: column;
	justify-content: flex-start;
	margin: 0 0.125rem 0.25rem;
	border-radius: 0.5rem;
	box-sizing: content-box;
	padding-bottom: 0.125rem;
	transition: 0.25s ease;
	}
	.holder:empty {
	background: #eee;
	}

	.word {
	all: unset;
	box-sizing: border-box;
	padding: 0.2rem;
	border-radius: 0.5rem;
	cursor: pointer;
	font-weight: 700;
	-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
			user-select: none;
	}

	@media only screen and (min-width: 600px) {
		.word{
			padding: 0.5rem;
		}
	}

	.word:active, .word:focus {
	transition: 0.25s ease;
	transform: scale(1.05, 1.05) translateY(-0.25rem);
	}
</style>

<script>
	const passage = '<?php echo $text ?>';
	const destination = document.querySelector(".destination"); // holder where selected words go
	const origin = document.querySelector(".origin"); // holder where words initially start
	const words = origin.querySelectorAll(".word"); // nodeList of all the words in the origin

	let isAnimating = false; // bool to prevent competing animations (clicking a word before the previous word has finished moving)

	// FLIP technique animation (First Last Invert Play)
	const flip = (word, settings) => {
		// calculate the difference in position between where the word started and where it ended (First - Last = Invert)
		const invert = {
			x: settings.first.left - settings.last.left,
			y: settings.first.top - settings.last.top
		};

		// do the animation (Play) from the original (Invert) position to the final current position
		let animation = word.animate(
			[
				{ transform: `scale(1,1) translate(${invert.x}px, ${invert.y}px)` },
				{ transform: `scale(1,1) translate(0, 0)` }
			],
			{
				duration: 300,
				easing: "ease"
			}
		);

		// signify that animation has completed
		animation.onfinish = () => (isAnimating = false);
	};

	// move the word from the origin to the destination
	const move = (word) => {
		const id = Math.random(); // random number used to link the word to its holder (used in the putback function)
		const holder = word.closest(".holder"); // the selected word's holder element
		let rect = word.getBoundingClientRect(); // selected word's DOM rect
		let first, last; // holders for the initial and final (First and Last) positions of the element

		isAnimating = true; //signify an animation has started (or is about to)

		// give both the holder and the word a data-id (used in the putback function) (using data-id and not a var because you can query for a data-attribute)
		holder.dataset.id = id;
		word.dataset.id = id;

		// set the holder to the heighth width of the word (so it stays visible when empty)
		holder.style.height = `${word.offsetHeight}px`;
		holder.style.width = `${word.offsetWidth}px`;

		// assign the initial top/left px values of the word -> move the word to the destination -> recaculate the the word's DOM rect in new position -> assign the final top/left values
		first = { top: rect.top, left: rect.left };
		destination.insertAdjacentElement("beforeend", word);
		rect = word.getBoundingClientRect();
		last = { top: rect.top, left: rect.left };

		// send word, and its caculated vales to the flip funciton
		flip(word, { first, last });
	};

	const putback = (word) => {
		const id = word.dataset.id; // get the ID of the current word
		const holder = origin.querySelector(`[data-id="${id}"]`); // query for the holder w/ the matching ID
		const siblings = [...destination.querySelectorAll(".word")].filter(
			(sib) => sib !== word
		); // find the other word elements in the destination so we can animate them when the selected word is put back

		let rect = word.getBoundingClientRect(); // selected word's DOM rect
		let first, last; // holders for the initial and final (First and Last) positions of the element

		isAnimating = true; //signify an animation has started (or is about to)

		first = { top: rect.top, left: rect.left }; // assign the initial top/left px values

		// get the initial top/left px values for each sibling
		siblings.forEach((sib) => {
			let rect = sib.getBoundingClientRect();
			// I am assigning this value as a property of the element object because trying to keep a
			// variable linked to this element inside a loop that we can use later in a different loop
			// would be a real big pain. Best practice is not to modify objects/classes you don't own,
			// so to be safe and avoid overwriting an existing property value (ele.first or ele.last)
			// I am prefixing the property name with __
			sib.__first = { top: rect.top, left: rect.left };
		});

		holder.insertAdjacentElement("beforeend", word); //move the word from the destination back to its original holder

		rect = word.getBoundingClientRect(); // selected word's new DOM rect
		last = { top: rect.top, left: rect.left }; // assign the final top/left px values

		// get the final top/left px values for each sibling
		siblings.forEach((sib) => {
			let rect = sib.getBoundingClientRect();
			sib.__last = { top: rect.top, left: rect.left };
		});

		flip(word, { first, last }); // animate the word

		siblings.forEach((sib) => flip(sib, { first: sib.__first, last: sib.__last })); // animate the siblings

		// clean up the junk we added during the move function()
		holder.style.height = "";
		holder.style.width = "";
		holder.removeAttribute("data-id");
		word.removeAttribute("data-id");
	};

	// add a conditional eventListener to each word
	words.forEach((word) => {
		const event = () => {
			if (isAnimating) return; // if we already have an animation playing, don't let the user start a new one
			word.closest(".holder") ? move(word) : putback(word); // decide if we should use the move() or putback() functions based on the word's current location
			if (destination.innerHTML.replace(/(<([^>]+)>)/gi, "").replace(/\s/g, '') == passage.replace(/\s/g, '')){
				gameComplete();
			}
		};

		word.addEventListener("click", event);
	});
</script>