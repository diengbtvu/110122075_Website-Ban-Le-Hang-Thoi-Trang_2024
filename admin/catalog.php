<?php
// Kiểm tra quyền truy cập
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header('Location: login.php');
    exit();
}

// Hàm hiển thị trạng thái hiển thị
function getDisplayStatus($status) {
    return $status ? 'Hiển thị' : 'Ẩn';
}

// Hàm tạo nút hành động
function generateActionButtons($catalogId) {
    return sprintf('
        <div class="ui tiny buttons">
            <a href="admin.php?act=updateform_catalog&id=%d" 
               class="ui blue button">
               <i class="edit icon"></i> Cập nhật
            </a>
            <a href="admin.php?act=del_catalog&id=%d" 
               class="ui red button delete-btn" 
               data-id="%d">
               <i class="trash icon"></i> Xoá
            </a>
        </div>
    ', $catalogId, $catalogId, $catalogId);
}
?>

<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
    <div class="ui container grid">
        <div class="row">
            <div class="fifteen wide computer sixteen wide phone centered column">
                <div class="ui stacked segment">
                    <div class="ui blue ribbon icon label">
                        <i class="list icon"></i> Quản lý danh mục sản phẩm
                    </div>
                    
                    <!-- Nút thêm mới -->
                    <div class="ui right aligned segment">
                        <a href="admin.php?act=insert_catalog&id=1" class="ui primary button">
                            <i class="plus icon"></i> Thêm danh mục mới
                        </a>
                    </div>

                    <!-- Bảng danh mục -->
                    <table id="catalogTable" class="ui celled table responsive nowrap unstackable">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Thứ tự ưu tiên</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($kq) && count($kq) > 0): ?>
                                <?php foreach($kq as $i => $catalog): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= htmlspecialchars($catalog['id_catalog_k']) ?></td>
                                        <td><?= htmlspecialchars($catalog['catalog_name']) ?></td>
                                        <td><?= htmlspecialchars($catalog['prioritize']) ?></td>
                                        <td>
                                            <div class="ui <?= $catalog['display_ctl'] ? 'green' : 'red' ?> label">
                                                <?= getDisplayStatus($catalog['display_ctl']) ?>
                                            </div>
                                        </td>
                                        <td><?= generateActionButtons($catalog['id_catalog_k']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="center aligned">Không có dữ liệu</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="vendors/jquery/jquery.min.js"></script>
<script src="vendors/fomantic-ui/semantic.min.js"></script>
<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables.net/datatables.net-se/js/dataTables.semanticui.min.js"></script>
<script src="vendors/datatables.net/datatables.net-responsive/js/dataTables.responsive.min.js"></script>

<script>
$(document).ready(function() {
    // Khởi tạo DataTable với cấu hình tiếng Việt
    const table = $('#catalogTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Vietnamese.json'
        },
        responsive: true,
        pageLength: 10,
        dom: 'Bfrtip',
        buttons: ['copy', 'excel', 'pdf', 'print']
    });

    // Xử lý xác nhận xóa
    $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        const catalogId = $(this).data('id');
        
        if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
            window.location.href = `admin.php?act=del_catalog&id=${catalogId}`;
        }
    });
});
</script>
</body>
</html>