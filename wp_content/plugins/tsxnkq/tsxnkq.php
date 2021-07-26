<?php
/**
 * @package tuyen_sinh
 */
/*
Plugin Name: Xac nhan ket qua
*/

function tsxnkq_register_post_type() {
  $labels = array( 
    'name' => __( 'Danh sách sinh viên trúng tuyển' , 'tsxnkq' ),
    'singular_name' => __( 'Sinh viên' , 'tsxnkq' ),
    'add_new' => __( 'Thêm mới' , 'tsxnkq' ),
    'add_new_item' => __( 'Thêm mới' , 'tsxnkq' ),
    'edit_item' => __( 'sửa đổi' , 'tsxnkq' ),
    'new_item' => __( 'Thêm' , 'tsxnkq' ),
    'view_item' => __( 'Xem' , 'tsxnkq' ),
    'search_items' => __( 'Tìm kiếm' , 'tsxnkq' ),
    'not_found' =>  __( 'Không tìm thấy kết quả' , 'tsxnkq' ),
    'not_found_in_trash' => __( 'Không tìm thấy trong mục đã xóa' , 'tsxnkq' ),

  );

  $args = array(

      'labels' => $labels,
      'has_archive' => true,
      'public' => true,
      'hierarchical' => false,
      'supports' => array(
          'custom-fields', 
      ),
      'show_in_menu' => true,
      'can_export' => true,
      'menu_position' => 3,
      'rewrite'   => array( 'slug' => 'danh-sach-trung-tuyen' ),
      'show_in_rest' => true
    //   'show_in_menu' => 'edit.php?post_type=entertainment'
  );
  register_post_type('danhsachtrungtuyen', $args); 
}

add_action( 'init', 'tsxnkq_register_post_type' );


// Add the custom columns to the book post type:
add_filter( 'manage_danhsachtrungtuyen_posts_columns', 'set_custom_edit_danhsachtrungtuyen_columns' );
function set_custom_edit_danhsachtrungtuyen_columns($columns) {
    unset( $columns['title'] ); 
    $columns['ho_ten'] = __( 'Họ và tên', 'tsxnkq' );
    $columns['cmnd_cccd'] = __( 'CMND/CCCD', 'tsxnkq' );
    $columns['otp'] = __( 'OTP', 'tsxnkq' );

    return $columns;
}

function get_custom_field_value($pid, $key, $default_value = "-") {
    // return "---";
    $v = get_post_meta($pid ,$key, true);
    return ( is_string( $v ) ) ? $v : _e( $default_value, 'tsxnkq' );
}
// Add the data to the custom columns for the book post type:
add_action( 'manage_danhsachtrungtuyen_posts_custom_column' , 'custom_danhsachtrungtuyen_column', 10, 2 );
function custom_danhsachtrungtuyen_column( $column, $post_id ) {
    switch ( $column ) {
        case 'ho_ten' :
            echo get_custom_field_value( $post_id , 'ho_ten');
            break;
        case 'cmnd_cccd' :
            echo get_custom_field_value($post_id , 'cmnd_cccd');
            break;
        case 'otp' :
            echo get_custom_field_value($post_id , 'otp' , '' ); 
            break;

    }
}


// add_action('admin_menu', 'my_admin_menu'); 
// function my_admin_menu() { 
//     add_submenu_page('edit.php?post_type=entertainment', 'Genre', 'Genre', 'manage_options', 'edit-tags.php?taxonomy=genre&post_type=entertainment'); 
// }