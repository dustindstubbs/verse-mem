<!-- Desktop menu -->
<div class="d-none d-md-flex flex-column flex-shrink-0 p-3 vh-100" style="width: 280px;background:#f8f9fd">
  <a href="/learn" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    <span class="fs-4">Verse Mem</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="/learn" class="learn-hover nav-link py-3 my-2 <?php echo ($wp->request == 'learn') ? 'link-primary bg-primary-pastel' : 'text-dark'; ?>" aria-current="page">
      <svg xmlns="http://www.w3.org/2000/svg" class="mb-1 me-2" width="20" height="20" viewBox="0 0 24 24"><path fill="currentcolor" d="M20 12.875v5.068c0 2.754-5.789 4.057-9 4.057-3.052 0-9-1.392-9-4.057v-6.294l9 4.863 9-3.637zm-8.083-10.875l-12.917 5.75 12 6.5 11-4.417v7.167h2v-8.25l-12.083-6.75zm13.083 20h-4c.578-1 1-2.5 1-4h2c0 1.516.391 2.859 1 4z"/></svg>
        Learn
      </a>
    </li>
    <li>
      <a href="/practice" class="practice-hover nav-link py-3 my-2 <?php echo ($wp->request == 'practice') ? 'link-warning bg-warning-pastel' : 'text-dark'; ?>">
      <svg xmlns="http://www.w3.org/2000/svg" class="mb-1 me-2" width="20" height="20" viewBox="0 0 445 445" fill="none"><path d="M159.103 249.966C151.292 242.155 151.292 229.492 159.103 221.682L222.035 158.749C229.846 150.939 242.509 150.939 250.319 158.749L286.382 194.811C294.192 202.622 294.192 215.285 286.382 223.096L223.449 286.028C215.639 293.839 202.976 293.839 195.165 286.028L159.103 249.966Z" fill="currentcolor"/><path d="M271.886 48.7939C264.076 40.9834 264.076 28.3201 271.886 20.5096L286.205 6.19072C294.016 -1.61977 306.679 -1.61977 314.489 6.19072L330.399 22.1006C338.21 29.9111 350.873 29.9111 358.683 22.1006L373.002 7.78171C380.813 -0.0287748 393.476 -0.0287748 401.287 7.78171L437.349 43.8442C445.16 51.6546 445.16 64.3179 437.349 72.1284L423.03 86.4473C415.22 94.2578 415.22 106.921 423.03 114.732L438.587 130.288C446.397 138.098 446.397 150.762 438.587 158.572L424.268 172.891C416.457 180.702 403.794 180.702 395.983 172.891L271.886 48.7939Z" fill="currentcolor"/><path d="M49.5011 271.886C41.6906 264.076 29.0273 264.076 21.2168 271.886L6.72109 286.382C-1.0894 294.192 -1.0894 306.856 6.72109 314.666L22.5285 330.473C30.3389 338.284 30.3389 350.947 22.5285 358.758L8.03276 373.253C0.222274 381.064 0.222274 393.727 8.03276 401.538L43.9459 437.451C51.7564 445.261 64.4197 445.261 72.2302 437.451L86.7259 422.955C94.5364 415.145 107.2 415.145 115.01 422.955L130.465 438.41C138.275 446.22 150.939 446.22 158.749 438.41L173.245 423.914C181.055 416.104 181.055 403.44 173.245 395.63L49.5011 271.886Z" fill="currentcolor"/><path d="M41.0158 240.773C33.2053 232.963 33.2053 220.3 41.0158 212.489L55.865 197.64C63.6755 189.829 76.3388 189.829 84.1493 197.64L248.198 361.689C256.009 369.499 256.009 382.162 248.198 389.973L233.349 404.822C225.538 412.633 212.875 412.633 205.065 404.822L41.0158 240.773Z" fill="currentcolor"/><path d="M197.993 83.7957C190.183 75.9852 190.183 63.3219 197.993 55.5114L212.843 40.6622C220.653 32.8517 233.316 32.8517 241.127 40.6622L405.176 204.711C412.986 212.521 412.986 225.185 405.176 232.995L390.327 247.844C382.516 255.655 369.853 255.655 362.042 247.844L197.993 83.7957Z" fill="currentcolor"/></svg>
        Practice
      </a>
    </li>
    <li>
      <a href="/lineups" class="lineups-hover nav-link py-3 my-2 <?php echo ($wp->request == 'lineups') ? 'link-danger bg-danger-pastel' : 'text-dark'; ?>">
      <svg xmlns="http://www.w3.org/2000/svg" class="mb-1 me-2" width="20" height="20" viewBox="0 0 20 24" fill="none"><path d="M20 13H18V9H20V13ZM20 8H18V4H20V8ZM20 14H18V18H20V14ZM20 19H18V23H20V19ZM3.495 4H17V24H3C1.344 24 0 22.657 0 21V3C0 1.343 1.344 0 3 0H20V2H3.495C2.119 2 2.119 4 3.495 4Z" fill="currentcolor"/></svg>
        Lineups
      </a>
    </li>
  </ul>
  <ul class="nav nav-pills flex-column mt-auto">
    <li>
      <a href="/about" class="nav-link py-3 <?php echo ($wp->request == 'about') ? 'bg-primary-pastel' : 'link-dark'; ?>">
      <svg class="mb-1 me-2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentcolor" d="M12 1c-6.338 0-12 4.226-12 10.007 0 2.05.739 4.063 2.047 5.625.055 1.83-1.023 4.456-1.993 6.368 2.602-.47 6.301-1.508 7.978-2.536 9.236 2.247 15.968-3.405 15.968-9.457 0-5.812-5.701-10.007-12-10.007zm1 15h-2v-6h2v6zm-1-7.75c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z"/></svg>
        About
      </a>
    </li>
  </ul>
  <hr>
  <div class="dropdown">
    <a href="#" class="d-flex align-items-center rounded <?php echo ($wp->request == 'profile' || $wp->request == 'options') ? 'bg-primary-pastel' : 'link-dark'; ?> text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="<?php echo get_avatar_url(get_current_user_id()) ?>" alt="" width="32" height="32" class="rounded-circle me-2">
      <strong><?php echo get_user_meta( get_current_user_id())['nickname'][0] ?></strong>
    </a>
    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser2">
      <li><a class="dropdown-item" href="/profile">Profile</a></li>
      <li><a class="dropdown-item" href="/options">Options</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="<?php echo wp_logout_url() ?>">Sign out</a></li>
    </ul>
  </div>
</div>

  <!-- Mobile menu -->
<div class="bg-white d-flex d-md-none fixed-bottom flex-row p-2 px-4 justify-content-between border-top">
  <a class="learn-hover rounded p-2 <?php echo ($wp->request == 'learn') ? 'link-primary bg-primary-pastel' : 'text-dark'; ?>" href="/learn"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="currentcolor" d="M20 12.875v5.068c0 2.754-5.789 4.057-9 4.057-3.052 0-9-1.392-9-4.057v-6.294l9 4.863 9-3.637zm-8.083-10.875l-12.917 5.75 12 6.5 11-4.417v7.167h2v-8.25l-12.083-6.75zm13.083 20h-4c.578-1 1-2.5 1-4h2c0 1.516.391 2.859 1 4z"/></svg></a>
  <a class="practice-hover rounded p-2 <?php echo ($wp->request == 'practice') ? 'link-warning bg-warning-pastel' : 'text-dark'; ?>" href="/practice"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 445 445" fill="none"><path d="M159.103 249.966C151.292 242.155 151.292 229.492 159.103 221.682L222.035 158.749C229.846 150.939 242.509 150.939 250.319 158.749L286.382 194.811C294.192 202.622 294.192 215.285 286.382 223.096L223.449 286.028C215.639 293.839 202.976 293.839 195.165 286.028L159.103 249.966Z" fill="currentcolor"/><path d="M271.886 48.7939C264.076 40.9834 264.076 28.3201 271.886 20.5096L286.205 6.19072C294.016 -1.61977 306.679 -1.61977 314.489 6.19072L330.399 22.1006C338.21 29.9111 350.873 29.9111 358.683 22.1006L373.002 7.78171C380.813 -0.0287748 393.476 -0.0287748 401.287 7.78171L437.349 43.8442C445.16 51.6546 445.16 64.3179 437.349 72.1284L423.03 86.4473C415.22 94.2578 415.22 106.921 423.03 114.732L438.587 130.288C446.397 138.098 446.397 150.762 438.587 158.572L424.268 172.891C416.457 180.702 403.794 180.702 395.983 172.891L271.886 48.7939Z" fill="currentcolor"/><path d="M49.5011 271.886C41.6906 264.076 29.0273 264.076 21.2168 271.886L6.72109 286.382C-1.0894 294.192 -1.0894 306.856 6.72109 314.666L22.5285 330.473C30.3389 338.284 30.3389 350.947 22.5285 358.758L8.03276 373.253C0.222274 381.064 0.222274 393.727 8.03276 401.538L43.9459 437.451C51.7564 445.261 64.4197 445.261 72.2302 437.451L86.7259 422.955C94.5364 415.145 107.2 415.145 115.01 422.955L130.465 438.41C138.275 446.22 150.939 446.22 158.749 438.41L173.245 423.914C181.055 416.104 181.055 403.44 173.245 395.63L49.5011 271.886Z" fill="currentcolor"/><path d="M41.0158 240.773C33.2053 232.963 33.2053 220.3 41.0158 212.489L55.865 197.64C63.6755 189.829 76.3388 189.829 84.1493 197.64L248.198 361.689C256.009 369.499 256.009 382.162 248.198 389.973L233.349 404.822C225.538 412.633 212.875 412.633 205.065 404.822L41.0158 240.773Z" fill="currentcolor"/><path d="M197.993 83.7957C190.183 75.9852 190.183 63.3219 197.993 55.5114L212.843 40.6622C220.653 32.8517 233.316 32.8517 241.127 40.6622L405.176 204.711C412.986 212.521 412.986 225.185 405.176 232.995L390.327 247.844C382.516 255.655 369.853 255.655 362.042 247.844L197.993 83.7957Z" fill="currentcolor"/></svg></a>
  <a class="lineups-hover rounded p-2 <?php echo ($wp->request == 'lineups') ? 'link-danger bg-danger-pastel' : 'text-dark'; ?>" href="/lineups"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 20 24" fill="none"><path d="M20 13H18V9H20V13ZM20 8H18V4H20V8ZM20 14H18V18H20V14ZM20 19H18V23H20V19ZM3.495 4H17V24H3C1.344 24 0 22.657 0 21V3C0 1.343 1.344 0 3 0H20V2H3.495C2.119 2 2.119 4 3.495 4Z" fill="currentcolor"/></svg></a>
  <div class="dropdown rounded p-2 <?php echo ($wp->request == 'about' || $wp->request == 'profile' || $wp->request == 'options') ? 'bg-primary-pastel' : ''; ?>">
    <a href="#" class="text-decoration-none <?php echo ($wp->request == 'profile' || $wp->request == 'options') ? 'link-primary' : 'text-dark'; ?>" id="dropdownUserMobile" data-bs-toggle="dropdown" aria-expanded="false">
      <svg class="d-flex" width="30" height="30" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m16.5 11.995c0-1.242 1.008-2.25 2.25-2.25s2.25 1.008 2.25 2.25-1.008 2.25-2.25 2.25-2.25-1.008-2.25-2.25zm-6.75 0c0-1.242 1.008-2.25 2.25-2.25s2.25 1.008 2.25 2.25-1.008 2.25-2.25 2.25-2.25-1.008-2.25-2.25zm-6.75 0c0-1.242 1.008-2.25 2.25-2.25s2.25 1.008 2.25 2.25-1.008 2.25-2.25 2.25-2.25-1.008-2.25-2.25z"/></svg>
    </a>
    <ul class="dropdown-menu mb-3" aria-labelledby="dropdownUserMobile">
      <li><a class="dropdown-item py-3 px-4" href="/about">About</a></li>  
      <li><a class="dropdown-item py-3 px-4" href="/profile">Profile</a></li>
      <li><a class="dropdown-item py-3 px-4" href="/options">Options</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item py-3 px-4" href="<?php echo wp_logout_url() ?>">Sign out</a></li>
    </ul>
  </div>
</div>