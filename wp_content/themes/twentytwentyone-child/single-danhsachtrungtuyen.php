<?php

get_header();
$q = [
	'post_type'  => 'danhsachtrungtuyen',
];
var_dump($q);
$query = new WP_Query($q);
if ( $query->have_posts() ) : ?>
<?php while ( $query->have_posts() ) : $query->the_post(); ?>
<div style="margin: '0 auto'; width: '400px'"> 
	<h5> Thông tin sinh viên trúng tuyển </h5>
	<?php the_content(); ?>
	<?php $meta_key = 'post_id'; $id = get_the_id();?>
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
<?php endif; ?>