<?php
$items = _db()->selectAll()->from('categories')->whereStatus(1)->orderBy('ordering asc')->result();
?>
<section id="popular">
  <div class="group-tabs">
    <ul class="nav nav-tabs" role="tablist">
      <?php
      $first = true;
      foreach ($items as $item) : ?>
        <li class="nav-item<?php echo ($first) ? ' active' : ''; ?>" role="presentation">
          <a class="nav-link<?php echo ($first) ? ' active' : ''; ?>" href="#course-category-<?php echo $item['id'] ?>" role="tab" data-toggle="tab"><?php echo $item['name'] ?></a>
        </li>
      <?php
        $first = false;
      endforeach; ?>
    </ul>
    <div class="tab-content py-3 px-3 px-sm-0">
      <?php
      $first = true;
      foreach ($items as $item) : ?>
        <div class="tab-pane fade<?php echo $first ? ' show active' : '' ?>" role="tabpanel" id="course-category-<?php echo $item['id'] ?>">
          <?php echo $item['content'] ?>

          <div class="p-3">
            <div class="row">
              <div class="col-md-3">
                <div class="card">
                  <img class="card-img-top" src="http://placehold.it/128x96" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="/Course/detail" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card">
                  <img class="card-img-top" src="http://placehold.it/128x96" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="/Course/detail" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card">
                  <img class="card-img-top" src="http://placehold.it/128x96" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="/Course/detail" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card">
                  <img class="card-img-top" src="http://placehold.it/128x96" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="/Course/detail" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
        $first = false;
      endforeach ?>
    </div>
  </div>
</section>