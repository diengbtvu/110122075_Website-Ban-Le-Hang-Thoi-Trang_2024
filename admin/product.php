<?php
if (!defined('HOST')) {
    exit('Không được phép truy cập trực tiếp');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
</head>

<body>
<?php include "nav.php"; ?>

<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
    <div class="ui container grid">
        <div class="row">
            <div class="fifteen wide computer sixteen wide phone centered column">
                <div class="ui divider"></div>
                <div class="ui grid">
                    <div class="sixteen wide computer sixteen wide phone centered column">
                        <!-- BEGIN DATATABLE -->
                        <div class="ui stacked segment">
                            <div class="ui blue ribbon icon label">Quản lý sản phẩm</div>
                            <br><br>
                            <table id="example" class="ui celled table responsive nowrap unstackable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Kích thước</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Hình ảnh</th>
                                        <th>Danh mục</th>
                                        <th>Nhân viên</th>
                                        <th>Ngày nhập</th>
                                        <th>Nhà cung cấp</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($kq as $item) {
                                        echo '<tr>
                                            <td>' . $i . '</td>
                                            <td>' . $item['product_name'] . '</td>
                                            <td>' . $item['size'] . '</td>
                                            <td>' . number_format($item['product_prices']) . ' VNĐ</td>
                                            <td>' . $item['quantity'] . '</td>
                                            <td><img src="../uploads/' . $item['product_img'] . '" width="100px"></td>
                                            <td>' . $item['catalog_id'] . '</td>
                                            <td>' . $item['employee_entry'] . '</td>
                                            <td>' . $item['entry_date'] . '</td>
                                            <td>' . $item['sup_id'] . '</td>
                                            <td>
                                                <a href="admin.php?act=updateform_product&id=' . $item['id_product'] . '" class="ui blue button">
                                                    <i class="edit icon"></i> Sửa
                                                </a>
                                                <a onclick="return confirm(\'Bạn có chắc muốn xóa không?\')" href="admin.php?act=del_product&id=' . $item['id_product'] . '" class="ui red button">
                                                    <i class="trash icon"></i> Xóa
                                                </a>
                                            </td>
                                        </tr>';
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="ui grid">
                                <div class="sixteen wide computer sixteen wide phone centered column">
                                    <a href="admin.php?act=insert_product" class="ui green button">
                                        <i class="plus icon"></i> Thêm sản phẩm mới
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- END DATATABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTables Script -->
<script>
$(document).ready(function() {
    $('#example').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Vietnamese.json'
        }
    });
});
</script>

</body>
</html>