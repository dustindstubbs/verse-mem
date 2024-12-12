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
$bycolumn = array_column($verses, 'last_practice');

array_multisort($bycolumn, SORT_ASC, $verses, $verseKeys);

$verses = array_combine($verseKeys, $verses);

?>

<h1>Practice</h1>
<p class="text-medium">Maintain your memorization by keeping your verses well practiced after completion.</p>
	<!-- Verse Loop -->
	<div class="row" id="verseList">
		<?php
		foreach($verses as $key => $verse) if ( $verse['completed'] == true ){
			// Figure out days unpracticed
            $practiced = new DateTime($verse['last_practice']);
            $later = new DateTime(date("Ymd"));
            $unPracticed = $later->diff($practiced)->format("%a");
            ?>
			<div class="col-12 col-sm-6 col-xl-3 d-flex align-items-stretch">
				<div class="rounded my-3 p-3 flex-column d-flex gap-2 w-100 <?php echo ($unPracticed < 6) ? 'bg-primary-light' : 'bg-warning-light' ?>">
					<div class="d-flex flex-row justify-content-between">
						<div class="d-flex mb-3 <?php echo ($unPracticed < 6) ? 'text-primary bg-primary-pastel' : 'text-warning bg-warning-pastel' ?> rounded align-items-center justify-content-center" style="width:50px; height:50px;">
							<?php echo VerseMem::practiceIcon($unPracticed);?>
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
					

					<div class="d-flex flex-row mt-auto">
						<div style="height:10px" class="me-2 w-100 d-flex progress align-self-center border-bottom border-light">
							<div id="gameProgress" class="progress-bar-striped <?php echo ($unPracticed < 6) ? 'bg-primary' : 'bg-warning' ?>" role="progressbar" style="width: <?php echo ($unPracticed < 14) ? 100 : 0 ?>%" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
                        <div style="height:10px" class="me-2 w-100 d-flex progress align-self-center border-bottom border-light">
							<div id="gameProgress" class="progress-bar-striped <?php echo ($unPracticed < 6) ? 'bg-primary' : 'bg-warning' ?>" role="progressbar" style="width: <?php echo ($unPracticed < 10) ? 100 : 0 ?>%" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
                        <div style="height:10px" class="me-2 w-100 d-flex progress align-self-center border-bottom border-light">
							<div id="gameProgress" class="progress-bar-striped bg-primary" role="progressbar" style="width: <?php echo ($unPracticed < 6) ? 100 : 0 ?>%" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<a class="text-decoration-none" href="/game?v=<?php echo $key ?>">
							<div class="d-flex ms-3 p-2 <?php echo ($unPracticed < 6) ? 'text-primary' : 'text-warning' ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-miterlimit="2" stroke-linejoin="round" height="20px" width="20px" fill-rule="evenodd" clip-rule="evenodd"><path fill="currentcolor" d="m14.523 18.787s4.501-4.505 6.255-6.26c.146-.146.219-.338.219-.53s-.073-.383-.219-.53c-1.753-1.754-6.255-6.258-6.255-6.258-.144-.145-.334-.217-.524-.217-.193 0-.385.074-.532.221-.293.292-.295.766-.004 1.056l4.978 4.978h-14.692c-.414 0-.75.336-.75.75s.336.75.75.75h14.692l-4.979 4.979c-.289.289-.286.762.006 1.054.148.148.341.222.533.222.19 0 .378-.072.522-.215z"></path></svg></div>
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
						<button class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
						<button class="btn btn-danger" data-bs-dismiss="modal" onclick="deleteVerse('<?php echo $key ?>')">Remove</button>
					</div>
					</div>
				</div>
			</div>

            <?php
		}
		?>
	</div>


<?php include("parts/footer.php")?>