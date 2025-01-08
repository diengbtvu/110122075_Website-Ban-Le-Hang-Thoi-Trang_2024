<?php
// Kiểm tra quyền truy cập
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header('Location: login.php');
    exit();
}

// Hàm lấy giới tính
function getGenderLabel($gender) {
    $genderMap = [
        1 => ['label' => 'Nam', 'color' => 'blue'],
        2 => ['label' => 'Nữ', 'color' => 'pink'],
        3 => ['label' => 'Khác', 'color' => 'grey']
    ];
    
    return $genderMap[$gender] ?? ['label' => 'Không xác định', 'color' => 'black'];
}

// Hàm tạo nút hành động
function generateClientActions($clientId) {
    return sprintf('
        <div class="ui tiny buttons">
            <a href="admin.php?act=updateform_client&id=%d" 
               class="ui blue button">
               <i class="edit icon"></i> Cập nhật
            </a>
            <button onclick="confirmDelete(%d)" 
                    class="ui red button">
                    <i class="trash icon"></i> Xóa
            </button>
        </div>
    ', $clientId, $clientId);
}
?>

<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
    <div class="ui container grid">
        <div class="row">
            <div class="fifteen wide computer sixteen wide phone centered column">
                <div class="ui stacked segment">
                    <div class="ui blue ribbon icon label">
                        <i class="users icon"></i> Quản lý khách hàng
                    </div>
                    
                    <!-- Nút thêm mới -->
                    <div class="ui right aligned segment">
                        <a href="admin.php?act=insert_client" class="ui primary button">
                            <i class="plus icon"></i> Thêm khách hàng mới
                        </a>
                    </div>

                    <!-- Bảng khách hàng -->
                    <table id="clientTable" class="ui celled table responsive nowrap unstackable">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID</th>
                                <th>Họ và tên</th>
                                <th>Giới tính</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($kq) && count($kq) > 0): ?>
                                <?php foreach($kq as $i => $client): ?>
                                    <?php $gender = getGenderLabel($client['sex']); ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= htmlspecialchars($client['id']) ?></td>
                                        <td>
                                            <?= htmlspecialchars($client['lname'] . ' ' . $client['fname']) ?>
                                        </td>
                                        <td>
                                            <div class="ui <?= $gender['color'] ?> label">
                                                <?= $gender['label'] ?>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($client['address']) ?></td>
                                        <td>
                                            <a href="mailto:<?= htmlspecialchars($client['email']) ?>">
                                                <?= htmlspecialchars($client['email']) ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="tel:<?= htmlspecialchars($client['phone']) ?>">
                                                <?= htmlspecialchars($client['phone']) ?>
                                            </a>
                                        </td>
                                        <td><?= generateClientActions($client['id']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="center aligned">Không có dữ liệu</td>
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
function confirmDelete(clientId) {
    if (confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')) {
        window.location.href = 'admin.php?act=delete_client&id=' + clientId;
    }
}

$(document).ready(function() {
    // Khởi tạo DataTable với cấu hình tiếng Việt
    const table = $('#clientTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Vietnamese.json'
        },
        responsive: true,
        pageLength: 10,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: '<i class="download icon"></i> Xuất dữ liệu',
                buttons: ['copy', 'excel', 'pdf', 'print']
            }
        ]
    });

    // Khởi tạo tooltips
    $('.ui.button').popup();
});
</script>
</body>
</html>