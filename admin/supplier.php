<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
  <div class="ui container grid">
    <div class="row">
      <div class="fifteen wide computer sixteen wide phone centered column center-table">
        <div class="ui divider"></div>
        <div class="ui grid">
          <div class="sixteen wide computer sixteen wide phone centered column">
            <!-- BEGIN DATATABLE -->
            <div class="ui stacked segment">
              <div class="ui blue ribbon icon label"><i class="shipping fast icon"></i>Thông tin nhà cung cấp</div>
              <a href="admin.php?act=insert_supplier" class="ui right floated primary button">
                <i class="plus icon"></i>Thêm nhà cung cấp
              </a>
              <br><br>
              <table id="supplierTable" class="ui celled table responsive nowrap unstackable" style="width:100%">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Tên nhà cung cấp</th>
                    <th>Địa chỉ</th>
                    <th>Tài khoản ngân hàng</th>
                    <th>Mã số thuế</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                if(isset($kq) && (count($kq) > 0)){
                  $i = 1;
                  foreach ($kq as $supplier) {
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.$supplier['sup_id'].'</td>';
                    echo '<td>'.$supplier['sup_name'].'</td>';
                    echo '<td>'.$supplier['sup_address'].'</td>';
                    echo '<td>'.$supplier['sup_bank'].'</td>';
                    echo '<td>'.$supplier['sup_tax_code'].'</td>';
                    echo '<td>
                          <div class="ui tiny icon buttons">
                            <a href="admin.php?act=updateform_supplier&id='.$supplier['sup_id'].'" 
                               class="ui blue button" title="Cập nhật">
                              <i class="edit icon"></i>
                            </a>
                            <a href="admin.php?act=del_supplier&id='.$supplier['sup_id'].'" 
                               class="ui red button" 
                               onclick="return confirm(\'Bạn có chắc chắn muốn xóa nhà cung cấp này?\');"
                               title="Xóa">
                              <i class="trash icon"></i>
                            </a>
                          </div>
                          </td>';
                    echo '</tr>';
                    $i++;
                  }
                }
                ?>
                </tbody>
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
    $('#supplierTable').DataTable({
        responsive: true,
        pageLength: 10,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/vi.json'
        },
        columnDefs: [
            {
                targets: [0, 1], // STT và ID
                searchable: false,
                width: '50px'
            },
            {
                targets: -1, // Cột cuối (thao tác)
                searchable: false,
                orderable: false,
                width: '100px'
            }
        ]
    });
});
</script>

</html>