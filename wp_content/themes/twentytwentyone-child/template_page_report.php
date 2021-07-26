<?php
/**
 * Template Name: Xac nhan trung tuyen
 * use postmeta `danhsachtrungtuyen`
 */

get_header();
?>
<section class="section">
  <div class="container py-3">
    <form action="" method="post" name="tim_kiem">
      <input type="text" name="cmnd_cccd" value="<?php echo $_POST?  $_POST["cmnd_cccd"] : ''; ?>" placeholder="Nhập CMND hoặc CCCD" />
      <input type="text" name="otp"  value="<?php echo $_POST? $_POST["otp"] : ''; ?>" placeholder="Nhập mã OTP" />
      <input type="submit" name="submit" value="Kiểm  tra" />
    </form>
  </div>
  <hr />
  <?php
if(isset($_POST["submit"]))
{
 $q = array(
    'post_type'  => 'danhsachtrungtuyen',
    'meta_query' =>  array(
      'relation' => 'AND',
        array(
        "key" => "cmnd_cccd",
        "value" => $_POST["cmnd_cccd"]
      ),
        array(
        "key" => "otp",
        "value" => $_POST["otp"]
      )
    )
  );
 ?>
  <!-- <pre> 
    <?php var_dump($q); ?>
  </pre> -->
 <?php
 $query = new WP_Query($q);
  if ( $query->have_posts() ) :
    while ( $query->have_posts() ) : $query->the_post(); ?>
      <div style="margin: '0 auto'; width: '400px'"> 
        <h5> Thông tin sinh viên trúng tuyển </h5>
        <?php the_content(); ?>
        <?php $id = get_the_id();?>
        Data ID: <?php echo $id;?>
        <hr>
        <ul>
          <li> Họ Tên: 
            <?php echo get_post_meta( $id, "ho_ten", true);?>
          </li>
          <li> CMND/CCCD: 
            <?php echo get_post_meta( $id, "cmnd_cccd", true);?>
          </li>
          <li> OTP: 
            <?php echo get_post_meta( $id, "otp", true);?>
          </li>
        </ul>
      </div>
    <?php endwhile; wp_reset_postdata(); ?>
  <?php else : ?>
    <p> Không tìm thấy kết quả </p>
  <?php endif; ?>
<?php
} 
?>
</section>