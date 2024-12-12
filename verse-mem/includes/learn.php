<?php include("parts/header.php"); ?>
<script src="/wp-content/plugins/verse-mem/assets/js.cookie.min.js"></script>
<script>
Cookies.set('score', 0);
Cookies.set('progress', null);
</script>
<?php
$verses = get_user_meta( get_current_user_id(), 'mem_verse' );

// Sort verses by last practiced
$verseKeys = array_keys($verses);
$bycolumn = array_column($verses, 'score');

array_multisort($bycolumn, SORT_ASC, $verses, $verseKeys);

$verses = array_combine($verseKeys, $verses);
?>
<h1>Learn</h1>

	<div class="row">
		<div class="mb-3 col col-lg-6">
			<div class="input-group">
				<input id="inputVerse" type="text" class="form-control" placeholder="Type a verse to add it..." aria-label="verse" onkeydown="if(event.keyCode == 13){addVerse($('#inputVerse').val())}" {>
				<div class="input-group-append">
					<button style="border-top-left-radius: 0;border-bottom-left-radius: 0;" class="btn btn-primary" type="button" onclick="addVerse($('#inputVerse').val())">Add Verse</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Verse Loop -->
	<div class="row" id="verseList">
		<?php
		foreach($verses as $key => $verse) if ( $verse['completed'] == false ){
			?>
			<div class="col-12 col-sm-6 col-xl-3 d-flex align-items-stretch">
				<div class="rounded my-3 p-3 flex-column d-flex gap-2 w-100" style="background:#f8f9fd">
					<div class="d-flex flex-row justify-content-between">
						<div class="d-flex mb-3 text-primary rounded align-items-center justify-content-center" style="width:50px; height:50px; background:#e8ebff;">
							<?php echo VerseMem::progressIcon($verse['score'],$verse['difficulty']);?>
						</div>
						
						<div class="d-flex dropup">
							<a href="#" class="p-2 text-medium h-100" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
								<svg class="d-flex" width="20px" height="20px" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m16.5 11.995c0-1.242 1.008-2.25 2.25-2.25s2.25 1.008 2.25 2.25-1.008 2.25-2.25 2.25-2.25-1.008-2.25-2.25zm-6.75 0c0-1.242 1.008-2.25 2.25-2.25s2.25 1.008 2.25 2.25-1.008 2.25-2.25 2.25-2.25-1.008-2.25-2.25zm-6.75 0c0-1.242 1.008-2.25 2.25-2.25s2.25 1.008 2.25 2.25-1.008 2.25-2.25 2.25-2.25-1.008-2.25-2.25z"/></svg>
							</a>
							<ul class="dropdown-menu" style="min-width:10px" aria-labelledby="dropdownMenuButton1">
								<li><a class="mx-3 text-danger" data-bs-toggle="modal" style="text-decoration:none;cursor:pointer;" data-bs-target="#deletemodal<?php echo $key ?>">Remove</a></li>
							</ul>
						</div>

					</div>
					<a class="text-dark text-decoration-none" href="/game?v=<?php echo $key ?>"><?php echo $verse['title']?></a>
					<a class="mb-3 text-medium text-decoration-none" href="/game?v=<?php echo $key ?>"><?php echo VerseMem::trunc($verse['text'], 15)?></a>
					

					<div class="d-flex flex-row mt-auto">
						<div style="height:10px" class="w-100 d-flex progress align-self-center border-bottom border-light">
							<div id="gameProgress" class="progress-bar-striped bg-primary" role="progressbar" style="width: <?php echo $verse['score']/$verse['difficulty']*100 ?>%" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<a class="text-decoration-none" href="/game?v=<?php echo $key ?>">
							<div class="d-flex ms-3 p-2 text-primary" style=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-miterlimit="2" stroke-linejoin="round" height="20px" width="20px" fill-rule="evenodd" clip-rule="evenodd"><path fill="currentcolor" d="m14.523 18.787s4.501-4.505 6.255-6.26c.146-.146.219-.338.219-.53s-.073-.383-.219-.53c-1.753-1.754-6.255-6.258-6.255-6.258-.144-.145-.334-.217-.524-.217-.193 0-.385.074-.532.221-.293.292-.295.766-.004 1.056l4.978 4.978h-14.692c-.414 0-.75.336-.75.75s.336.75.75.75h14.692l-4.979 4.979c-.289.289-.286.762.006 1.054.148.148.341.222.533.222.19 0 .378-.072.522-.215z"></path></svg></div>
						</a>
					</div>
				</div>
			</div>
			
			<div class="modal" tabindex="-1" id="deletemodal<?php echo $key ?>">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
					<div class="px-3 pt-3 d-flex flex-row-reverse">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="px-4 py-3 modal-body">
						<p>Are you sure you want to remove <?php echo $verse['title']?> from your account? All verse progress will be lost.</p>
					</div>
					<div class="px-4 pb-4 d-flex justify-content-between">
						<button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
						<button class="btn btn-danger" data-bs-dismiss="modal" onclick="deleteVerse('<?php echo $key ?>')">Remove</button>
					</div>
					</div>
				</div>
			</div>
			
			<?php
		}
		?>
	</div>

	<!-- Verse length confirm -->
	<div class="modal" tabindex="-1" id="lengthModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<div class="px-3 pt-3 d-flex flex-row-reverse">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="$( '#inputVerse' ).val('')"></button>
			</div>
			<div class="px-4 py-3 modal-body">
				<p>Learning passages under 500 characters is recommended. Continue with long passage anyways?</p>
			</div>
			<div class="px-4 pb-4 d-flex justify-content-between">
				<button class="btn btn-light" data-bs-dismiss="modal" onclick="$( '#inputVerse' ).val('')">Cancel</button>
				<button class="btn btn-primary" data-bs-dismiss="modal" onclick="addVerse($('#inputVerse').val(), true)">Yes</button>
			</div>
			</div>
		</div>
	</div>

	<!-- Custom string confirm -->
	<div class="modal" tabindex="-1" id="customModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<div class="px-3 pt-3 d-flex flex-row-reverse">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="$( '#inputVerse' ).val('')"></button>
			</div>
			<div class="px-4 py-3 modal-body">
				<input id="customTitle" type="text" class="mb-3 form-control" placeholder="Type a custom title..." aria-label="title" onkeydown="if(event.keyCode == 13){addVerse($('#inputVerse').val(), true, $('#customTitle').val())}">
				<p>Confirm the use of custom text with this title?</p>
			</div>
			<div class="px-4 pb-4 d-flex justify-content-between">
				<button class="btn btn-light" data-bs-dismiss="modal" onclick="$( '#inputVerse' ).val('')">Cancel</button>
				<button class="btn btn-primary" data-bs-dismiss="modal" onclick="addVerse($('#inputVerse').val(), true, $('#customTitle').val())">Yes</button>
			</div>
			</div>
		</div>
	</div>


<?php include("parts/footer.php")?>