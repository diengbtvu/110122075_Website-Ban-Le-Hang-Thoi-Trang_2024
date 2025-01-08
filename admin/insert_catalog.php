<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header('Location: login.php');
    exit();
}
?>

<script>
function validateForm() {
  var name = document.getElementById("name_catalog").value;
  var pr = document.getElementsByName("prioritize_catalog")[0].value;
  var dis = document.getElementsByName("display_catalog")[0].value;

  if (name == "") {
    alert("Vui lòng nhập tên danh mục!");
    return false;
  }
  if (pr!="1" && pr!="0") {
    alert("Vui lòng nhập đúng giá trị ưu tiên (0 hoặc 1)!");
    return false;
  }

  if (dis!="1" && dis!="0") {
    alert("Vui lòng nhập đúng giá trị hiển thị (0 hoặc 1)!");
    return false;
  }
  return true;
}
</script>

<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
  <div class="ui container grid">
    <div class="row">
      <div class="fifteen wide computer sixteen wide phone centered column center-table">
        <div class="ui divider"></div>
        <div class="ui grid">
          <div class="sixteen wide computer sixteen wide phone centered column">
            <!-- BEGIN DATATABLE -->
            <div class="ui stacked segment">
              <div class="ui blue ribbon icon label">Tạo mới danh mục sản phẩm</div>
              <br><br>
              <form action="admin.php?act=insert_catalog" method="POST" onsubmit="return validateForm()">
                <div class="ui form">
                    <div class="field">
                        <label>Tên danh mục</label>
                        <input type="text" id="name_catalog" name="name_catalog" placeholder="Nhập tên danh mục">
                    </div>
                    
                    <div class="field">
                        <label>Ưu tiên (1: Có, 0: Không)</label>
                        <input type="text" name="prioritize_catalog" placeholder="Nhập 1 hoặc 0">
                    </div>
                    
                    <div class="field">
                        <label>Hiển thị (1: Có, 0: Không)</label>
                        <input type="text" name="display_catalog" placeholder="Nhập 1 hoặc 0">
                    </div>
                    
                    <div class="field">
                        <input type="submit" name="submit" value="Thêm danh mục" class="ui primary button">
                        <a href="admin.php?act=catalog" class="ui button">Quay lại</a>
                    </div>
                </div>
              </form>
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
<script src="vendors/jquery/jquery.min.js">
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