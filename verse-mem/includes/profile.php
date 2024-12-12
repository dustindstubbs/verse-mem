<?php include("parts/header.php")?>

<h1>Profile</h1>
<p class="text-medium">View your progress in various areas.</p>

<div class="row">
    <div class="col-6 col-sm-4">
        <div class="bg-primary-light my-2 p-3 rounded">
            <img src="<?php echo get_avatar_url(get_current_user_id()) ?>" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong><?php echo get_user_meta( get_current_user_id())['nickname'][0] ?></strong>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="bg-primary-light my-2 p-3 rounded">
            <p>Current Streak</p>
            <p>11 <span class="text-medium">days</span></p>
        </div>
    </div>
    <div class="col-6">
        <div class="bg-primary-light my-2 p-3 rounded">
            <p>Highest Streak</p>
            <p>32 <span class="text-medium">days</span></p>
        </div>
    </div>
    <div class="col-6">
        <div class="bg-primary-light my-2 p-3 rounded">
            <p>Memorized</p>
            <p>4 <span class="text-medium">verses</span></p>
        </div>
    </div>
    <div class="col-6">
        <div class="bg-primary-light my-2 p-3 rounded">
            <p>Longest Verse</p>
            <p>56 <span class="text-medium">words</span></p>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="deleteModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="px-3 pt-3 d-flex flex-row-reverse">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="px-4 py-3 modal-body">
        <p>Are you sure you want to clear ALL verse data in your account? All progress will be lost.</p>
      </div>
      <div class="px-4 pb-4 d-flex justify-content-between">
        <button class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-danger" onclick="deleteVerse()">Clear</button>
      </div>
    </div>
  </div>
</div>

<button type="button" class="my-4 btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Clear Verses</button>

<?php include("parts/footer.php")?>