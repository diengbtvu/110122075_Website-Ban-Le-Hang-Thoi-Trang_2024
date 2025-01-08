<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
    <div class="ui container grid">
        <div class="row">
            <div class="fifteen wide computer sixteen wide phone centered column">
                <div class="ui stacked segment">
                    <div class="ui blue ribbon icon label">
                        <i class="plus circle icon"></i> Thêm dữ liệu mới
                    </div>
                    <br><br>
                    <div class="ui five cards">
                        <!-- Thêm khách hàng -->
                        <div class="card">
                            <div class="content">
                                <div class="header">
                                    <i class="users icon"></i> Khách hàng
                                </div>
                                <div class="meta">
                                    Thêm khách hàng mới
                                </div>
                                <div class="description">
                                    Quản lý thông tin khách hàng như tên, email, số điện thoại...
                                </div>
                            </div>
                            <div class="ui bottom attached button" onclick="window.location.href='admin.php?act=insert_client'">
                                <i class="add icon"></i>
                                Thêm khách hàng
                            </div>
                        </div>

                        <!-- Thêm nhà cung cấp -->
                        <div class="card">
                            <div class="content">
                                <div class="header">
                                    <i class="building icon"></i> Nhà cung cấp
                                </div>
                                <div class="meta">
                                    Thêm nhà cung cấp mới
                                </div>
                                <div class="description">
                                    Quản lý thông tin nhà cung cấp sản phẩm và dịch vụ
                                </div>
                            </div>
                            <div class="ui bottom attached button" onclick="window.location.href='admin.php?act=insert_supplier'">
                                <i class="add icon"></i>
                                Thêm nhà cung cấp
                            </div>
                        </div>

                        <!-- Thêm hóa đơn -->
                        <div class="card">
                            <div class="content">
                                <div class="header">
                                    <i class="file alternate icon"></i> Hóa đơn
                                </div>
                                <div class="meta">
                                    Thêm hóa đơn mới
                                </div>
                                <div class="description">
                                    Tạo và quản lý hóa đơn cho các giao dịch
                                </div>
                            </div>
                            <div class="ui bottom attached button" onclick="window.location.href='admin.php?act=insert_invoice'">
                                <i class="add icon"></i>
                                Thêm hóa đơn
                            </div>
                        </div>

                        <!-- Thêm sản phẩm -->
                        <div class="card">
                            <div class="content">
                                <div class="header">
                                    <i class="box icon"></i> Sản phẩm
                                </div>
                                <div class="meta">
                                    Thêm sản phẩm mới
                                </div>
                                <div class="description">
                                    Quản lý thông tin sản phẩm, giá cả và tồn kho
                                </div>
                            </div>
                            <div class="ui bottom attached button" onclick="window.location.href='admin.php?act=insert_product'">
                                <i class="add icon"></i>
                                Thêm sản phẩm
                            </div>
                        </div>

                        <!-- Thêm danh mục -->
                        <div class="card">
                            <div class="content">
                                <div class="header">
                                    <i class="folder icon"></i> Danh mục
                                </div>
                                <div class="meta">
                                    Thêm danh mục mới
                                </div>
                                <div class="description">
                                    Phân loại và tổ chức sản phẩm theo danh mục
                                </div>
                            </div>
                            <div class="ui bottom attached button" onclick="window.location.href='admin.php?act=insert_catalog'">
                                <i class="add icon"></i>
                                Thêm danh mục
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.ui.cards {
    margin-top: 2em;
}

.ui.card {
    margin: 0.5em;
}

.ui.card .header {
    margin-bottom: 0.5em;
}

.ui.card .description {
    margin: 1em 0;
    min-height: 60px;
}

.ui.bottom.attached.button {
    background-color: #2185d0;
    color: white;
}

.ui.bottom.attached.button:hover {
    background-color: #1678c2;
}

.ui.ribbon.label {
    margin-bottom: 1em;
}
</style>

<script>
$(document).ready(function() {
    // Thêm hover effect cho cards
    $('.ui.card').hover(
        function() {
            $(this).transition('pulse');
        }
    );

    // Thêm ripple effect cho buttons
    $('.ui.bottom.attached.button').click(function() {
        $(this).transition('pulse');
    });
});
</script>

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