<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
    <div class="ui container grid">
        <div class="row">
            <div class="fifteen wide computer sixteen wide phone centered column center-table">
                <div class="ui divider"></div>
                <div class="ui grid">
                    <div class="sixteen wide computer sixteen wide phone centered column">
                        <!-- BEGIN DATATABLE -->
                        <div class="ui stacked segment">
                            <div class="ui blue ribbon icon label">Thống kê doanh thu theo tháng</div>
                            <br><br>
                            <div class="ui info message">
                                <i class="info circle icon"></i>
                                Chỉ hiển thị các đơn hàng đã hoàn thành (không bao gồm đơn hủy và đơn chờ xử lý)
                            </div>
                            <table id="statisticTable" class="ui celled table responsive nowrap unstackable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tháng</th>
                                        <th>Số lượng hóa đơn</th>
                                        <th>Số lượng sản phẩm</th>
                                        <th>Doanh thu (VNĐ)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_invoices = 0;
                                    $total_products = 0;
                                    $total_profits = 0;

                                    for ($month = 1; $month <= 12; $month++) {
                                        $invoice_count = count_invoice_month($month);
                                        $profit = sum_invoice_month($month);
                                        $product_count = 0;

                                        // Tính tổng số lượng sản phẩm trong tháng
                                        $invoices = getall_invoice_month($month);
                                        foreach ($invoices as $invoice) {
                                            if ($invoice['status'] != 'Cancel' && $invoice['status'] != 'Pending') {
                                                $cart_items = getall_cart_month($invoice['id']);
                                                foreach ($cart_items as $item) {
                                                    $product_count += $item['quantity'];
                                                }
                                            }
                                        }

                                        // Cộng dồn vào tổng
                                        $total_invoices += $invoice_count;
                                        $total_products += $product_count;
                                        $total_profits += $profit;

                                        echo '<tr>';
                                        // Thêm data-sort để sắp xếp theo số
                                        echo '<td data-sort="' . $month . '">Tháng ' . $month . '</td>';
                                        echo '<td>' . ($invoice_count > 0 ? number_format($invoice_count) : '-') . '</td>';
                                        echo '<td>' . ($product_count > 0 ? number_format($product_count) : '-') . '</td>';
                                        echo '<td>' . ($profit > 0 ? number_format($profit) : '-') . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tổng cộng</th>
                                        <th><?php echo number_format($total_invoices); ?></th>
                                        <th><?php echo number_format($total_products); ?></th>
                                        <th><?php echo number_format($total_profits); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- END DATATABLE -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->

</div>
</body>

<!-- inject:js -->
<script src="vendors/jquery/jquery.min.js"></script>
<script src="vendors/fomantic-ui/semantic.min.js"></script>
<script src="js/main.js"></script>
<!-- endinject -->

<!-- datatables:js -->
<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables.net/datatables.net-se/js/dataTables.semanticui.min.js"></script>
<script src="vendors/datatables.net/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="vendors/datatables.net/datatables.net-responsive-se/js/responsive.semanticui.min.js"></script>
<!-- endinject -->

<script>
$(document).ready(function() {
    $('#statisticTable').DataTable({
        responsive: true,
        pageLength: 12, // Hiển thị 12 tháng trên một trang
        lengthChange: false, // Không cho phép thay đổi số dòng hiển thị
        searching: false, // Tắt tìm kiếm
        info: false, // Tắt thông tin phân trang
        paging: false, // Tắt phân trang
        order: [[0, 'asc']], // Sắp xếp theo tháng tăng dần
        columnDefs: [
            {
                targets: 0,
                type: 'num' // Xử lý cột tháng như số
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/vi.json'
        }
    });
});
</script>

</html>