<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
    <div class="ui container grid">
        <div class="row">
            <div class="fifteen wide computer sixteen wide phone centered column">
                <div class="ui stacked segment">
                    <div class="ui blue ribbon icon label">
                        <i class="file alternate icon"></i> Quản lý hóa đơn
                    </div>
                    
                    <div class="ui grid">
                        <div class="eight wide column">
                            <div class="ui statistics mini">
                                <div class="statistic">
                                    <div class="value">
                                        <i class="clock icon"></i> <?php echo count(array_filter($kq, function($i) { return $i['status'] == 'Pending'; })); ?>
                                    </div>
                                    <div class="label">Đang xử lý</div>
                                </div>
                                <div class="statistic">
                                    <div class="value">
                                        <i class="check icon"></i> <?php echo count(array_filter($kq, function($i) { return $i['status'] == 'Delivered'; })); ?>
                                    </div>
                                    <div class="label">Đã giao</div>
                                </div>
                                <div class="statistic">
                                    <div class="value">
                                        <i class="times icon"></i> <?php echo count(array_filter($kq, function($i) { return $i['status'] == 'Cancel'; })); ?>
                                    </div>
                                    <div class="label">Đã hủy</div>
                                </div>
                            </div>
                        </div>
                        <div class="eight wide column right aligned">
                            <div class="ui icon input">
                                <input type="text" id="searchInput" placeholder="Tìm kiếm hóa đơn...">
                                <i class="search icon"></i>
                            </div>
                        </div>
                    </div>

                    <table class="ui celled table">
                        <thead>
                            <tr>
                                <th class="center aligned">#</th>
                                <th>Mã ĐH</th>
                                <th>Khách hàng</th>
                                <th>Thông tin liên hệ</th>
                                <th class="right aligned">Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Nhân viên XL</th>
                                <th>Ngày đặt</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($kq) && (count($kq) > 0)) {
                                $i = 1;
                                foreach ($kq as $invoice) {
                                    echo '<tr>';
                                    echo '<td class="center aligned">'.$i++.'</td>';
                                    echo '<td><strong>#'.$invoice['id'].'</strong></td>';
                                    echo '<td>
                                            <h4 class="ui header">
                                                '.$invoice['fname'].' '.$invoice['lname'].'
                                            </h4>
                                          </td>';
                                    echo '<td>
                                            <i class="phone icon"></i> '.$invoice['phone'].'<br>
                                            <i class="map marker alternate icon"></i> '.$invoice['address'].'
                                          </td>';
                                    echo '<td class="right aligned">'.number_format($invoice['total_prices']).' đ</td>';
                                    
                                    // Status
                                    echo '<td>';
                                    switch($invoice['status']) {
                                        case 'Pending':
                                            echo '<div class="ui yellow label">
                                                    <i class="clock icon"></i> Đang xử lý
                                                  </div>';
                                            break;
                                        case 'Delivered':
                                            echo '<div class="ui green label">
                                                    <i class="check icon"></i> Đã giao
                                                  </div>';
                                            break;
                                        case 'Cancel':
                                            echo '<div class="ui red label">
                                                    <i class="times icon"></i> Đã hủy
                                                  </div>';
                                            break;
                                    }
                                    echo '</td>';
                                    
                                    // Employee
                                    echo '<td>';
                                    $found = false;
                                    foreach($user as $us) {
                                        if($us['id'] == $invoice['employee_pr']) {
                                            echo '<div class="ui label">
                                                    <i class="user icon"></i>
                                                    '.$us['name_us'].'
                                                  </div>';
                                            $found = true;
                                            break;
                                        }
                                    }
                                    if(!$found) echo '<div class="ui basic label">Chưa phân công</div>';
                                    echo '</td>';
                                    
                                    // Date
                                    echo '<td>'.date('d/m/Y', strtotime($invoice['due_date'])).'</td>';
                                    
                                    // Actions
                                    echo '<td class="center aligned">';
                                    echo '<div class="ui icon buttons">';
                                    echo '<a class="ui blue button" href="../web_user/fashionApp.php?act=print_invoice_admin&iddh='.$invoice['id'].'" title="Xem chi tiết">
                                            <i class="eye icon"></i>
                                          </a>';
                                    
                                    if($invoice['status'] == 'Pending') {
                                        echo '<button class="ui green button update-status" data-id="'.$invoice['id'].'" data-status="Delivered" title="Đánh dấu đã giao">
                                                <i class="check icon"></i>
                                              </button>';
                                        echo '<button class="ui red button update-status" data-id="'.$invoice['id'].'" data-status="Cancel" title="Hủy đơn hàng">
                                                <i class="times icon"></i>
                                              </button>';
                                    }
                                    
                                    echo '</div></td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.ui.statistics {
    margin-bottom: 2em;
}

.ui.table td {
    padding: 0.7em !important;
}

.ui.header {
    margin: 0 !important;
}

.ui.label {
    margin: 0.2em !important;
}

.search.icon {
    pointer-events: none;
}

.ui.buttons .button {
    margin: 0 !important;
}
</style>

<script>
$(document).ready(function() {
    // Tìm kiếm
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    
    // Cập nhật trạng thái
    $(".update-status").click(function(e) {
        e.preventDefault();
        var button = $(this);
        var id = button.data('id');
        var status = button.data('status');
        var row = button.closest('tr');
        
        if(confirm('Bạn có chắc muốn ' + (status == 'Delivered' ? 'đánh dấu đã giao' : 'hủy') + ' đơn hàng #' + id + '?')) {
            // Disable button while processing
            button.addClass('loading disabled');
            
            $.ajax({
                url: 'admin.php?act=update_invoice_status',
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function(response) {
                    if(response.status === 'success') {
                        // Cập nhật UI ngay lập tức
                        var statusCell = row.find('td:nth-child(6)');
                        if(status === 'Delivered') {
                            statusCell.html('<div class="ui green label"><i class="check icon"></i> Đã giao</div>');
                        } else if(status === 'Cancel') {
                            statusCell.html('<div class="ui red label"><i class="times icon"></i> Đã hủy</div>');
                        }
                        
                        // Ẩn các nút cập nhật
                        button.closest('.ui.buttons').fadeOut();
                        
                        alert('Cập nhật trạng thái thành công!');
                        window.location.reload();
                    } else {
                        button.removeClass('loading disabled');
                        alert('Lỗi: ' + (response.message || 'Không thể cập nhật trạng thái'));
                    }
                },
                error: function(xhr, status, error) {
                    button.removeClass('loading disabled');
                    console.error('Response:', xhr.responseText);
                    alert('Có lỗi xảy ra, vui lòng thử lại sau');
                }
            });
        }
    });
});</script>

<!-- inject:js -->
<script src=" vendors/jquery/jquery.min.js">
</script>
<script src="vendors/fomantic-ui/semantic.min.js"></script>
<script src="js/main.js"></script>
<!-- endinject -->
<!-- datatables:js -->
<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables.net/datatables.net-se/js/dataTables.semanticui.min.js"></script>
<script src="vendors/datatables.net/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="vendors/datatables.net/datatables.net-responsive-se/js/responsive.semanticui.min.js"></script>
<script src="vendors/datatables.net/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatables.net/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="vendors/datatables.net/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendors/datatables.net/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendors/datatables.net/datatables.net-buttons-se/js/buttons.semanticui.min.js"></script>
<script src="vendors/jszip/jszip.min.js"></script>
<script src="vendors/pdfmake/pdfmake.min.js"></script>
<script src="vendors/pdfmake/vfs_fonts.js"></script>
<!-- endinject -->

</html>