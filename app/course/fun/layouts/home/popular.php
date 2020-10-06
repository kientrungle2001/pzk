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
          <div class="p-sm-5 p-3 bg-warning">
            <div class="media">
              <img class="mr-3 rounded-circle" src="http://placehold.it/192x192" alt="Generic placeholder image">
              <div class="media-body">
                <h5 class="mt-0 mb-1">Expand your career opportunities with Python</h5>
                <p class="text-justify small">
                  Whether you work in machine learning or finance, or are pursuing a career in web development or data science, Python is one of the most important skills you can learn. Python's simple syntax is especially suited for desktop, web, and business applications. Python's design philosophy emphasizes readability and usability. Python was developed upon the premise that there should be only one way (and preferably one obvious way) to do things, a philosophy that has resulted in a strict level of code standardization. The core programming language is quite small and the standard library is also large. In fact, Python's large library is one of its greatest benefits, providing a variety of different tools for programmers suited for many different tasks.
                </p>
              </div>
            </div>
          </div>

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