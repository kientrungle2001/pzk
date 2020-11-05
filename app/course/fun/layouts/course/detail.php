<?php $item = $data->getItem(); ?>
<section id="course_detail" class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Library</a></li>
      <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-4">
      <img src="<?php echo pzk_or(@$item['img'], 'http://placehold.it/640x480'); ?>" class="img-fluid" />
    </div>
    <div class="col-md-8">
      <h2 class="lead"><?php echo html_escape($item['title']) ?></h2>
      <div class="content">
        <?php echo $item['content'] ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <h2 class="lead">Nội dung khóa học</h2>
      <div>
        <dl>
          <dt>Phần 1: Tìm hiểu về ngành bán hàng</dt>
          <dd>5 video - 0 bài tập
            <ul>
              <li>
                Bài 1: Tổng quan về người bán hàng</li>
              <li>
                Bài 2: Kỹ thuật cần thiết người bán hàng cần trang bị</li>
              <li>
                Bài 3: Chỉ số đo lường cho người bán hàng thành công (Phần 1)
              </li>
              <li>
                Bài 4: Chỉ số đo lường cho người bán hàng thành công (Phần 2)
              </li>
            </ul>
          </dd>
          <dt>Phần 2: Tìm hiểu về thị trường và mô hình bán hàng</dt>
          <dd>2 video - 0 bài tập
            <ul>
              <li>
                Bài 5: Mô hình và kênh bán hàng hiện nay</li>
              <li>
                Bài 6: Bán hàng chủ động và bán hàng bị động</li>
            </ul>
          </dd>

          <dt>Phần 3: 10 Bước để bán hàng thành công</dt>
          <dd>8 video - 0 bài tập
            <ul>
              <li>
                Bài 7: Bước 1 Tìm kiếm khách hàng</li>
              <li>
                Bài 8: Bước 2 Thấu hiểu tâm lý và hành vi khách hàng</li>
              <li>
                Bài 9: Bước 3 Kết nối gặp gỡ khách hàng và Bước 4 Xác định nhu cầu</li>
              <li>
                Bài 10: Bước 5 Giới thiệu sản phẩm và Bước 6 Lắng nghe phản hồi
              </li>
              <li>
                Bài 11: Bước 7 Thuyết phục và Bước 8 Chốt đơn
              </li>
              <li>
                Bài 12: Bước 9 Cung ứng sản phẩm
              </li>
              <li>
                Bài 13: Bước 10 Chăm sóc khách hàng
              </li>
              <li>
                Bài 14: Kết thúc khóa học</li>
            </ul>
          </dd>
        </dl>
      </div>
    </div>
  </div>
</section>