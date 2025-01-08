<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header('Location: login.php');
    exit();
}
?>

<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
  <div class="ui container grid">
    <div class="row">
      <div class="fifteen wide computer sixteen wide phone centered column center-table">
        <div class="ui divider"></div>
        <div class="ui grid">
          <div class="sixteen wide computer sixteen wide phone centered column">
            <!-- BEGIN DATATABLE -->
            <div class="ui stacked segment">
              <div class="ui blue ribbon icon label">Insert Catalog Information</div>
              <br><br>
              <?php
            //   echo var_dump($result);
              ?>
              <script>
              function validateForm() {
                  var lastName = document.getElementsByName("last_name_c")[0].value;
                  var firstName = document.getElementsByName("first_name_c")[0].value;
                  var sex = document.getElementsByName("sex_c")[0].value;
                  var address = document.getElementsByName("address_c")[0].value;
                  var email = document.getElementsByName("email_c")[0].value;
                  var phone = document.getElementsByName("phone_c")[0].value;
                  var user = document.getElementsByName("user_c")[0].value;
                  var password = document.getElementsByName("password_c")[0].value;

                  if (lastName == "") {
                      alert("Vui lòng nhập họ!");
                      return false;
                  }
                  if (firstName == "") {
                      alert("Vui lòng nhập tên!");
                      return false;
                  }
                  if (sex == "0") {
                      alert("Vui lòng chọn giới tính!");
                      return false;
                  }
                  if (address == "") {
                      alert("Vui lòng nhập địa chỉ!");
                      return false;
                  }
                  if (email == "") {
                      alert("Vui lòng nhập email!");
                      return false;
                  }
                  if (phone == "") {
                      alert("Vui lòng nhập số điện thoại!");
                      return false;
                  }
                  if (user == "") {
                      alert("Vui lòng nhập tên đăng nhập!");
                      return false;
                  }
                  if (password == "") {
                      alert("Vui lòng nhập mật khẩu!");
                      return false;
                  }
                  return true;
              }
              </script>

              <form class="ui form" action="admin.php?act=insert_client" method="POST" onsubmit="return validateForm()">
                  <div class="two fields">
                      <div class="field">
                          <label>Họ</label>
                          <input type="text" name="last_name_c" placeholder="Nhập họ">
                      </div>
                      <div class="field">
                          <label>Tên</label>
                          <input type="text" name="first_name_c" placeholder="Nhập tên">
                      </div>
                  </div>

                  <div class="field">
                      <label>Giới tính</label>
                      <select name="sex_c" class="ui dropdown">
                          <option value="0">Chọn giới tính</option>
                          <option value="1">Nam</option>
                          <option value="2">Nữ</option>
                          <option value="3">Khác</option>
                      </select>
                  </div>

                  <div class="field">
                      <label>Địa chỉ</label>
                      <input type="text" name="address_c" placeholder="Nhập địa chỉ">
                  </div>

                  <div class="two fields">
                      <div class="field">
                          <label>Email</label>
                          <input type="email" name="email_c" placeholder="Nhập email">
                      </div>
                      <div class="field">
                          <label>Số điện thoại</label>
                          <input type="tel" name="phone_c" placeholder="Nhập số điện thoại">
                      </div>
                  </div>

                  <div class="two fields">
                      <div class="field">
                          <label>Tên đăng nhập</label>
                          <input type="text" name="user_c" placeholder="Nhập tên đăng nhập">
                      </div>
                      <div class="field">
                          <label>Mật khẩu</label>
                          <input type="password" name="password_c" placeholder="Nhập mật khẩu">
                      </div>
                  </div>

                  <div class="field">
                      <button type="submit" name="submit" class="ui primary button">
                          <i class="save icon"></i> Lưu thông tin
                      </button>
                      <a href="admin.php?act=client" class="ui button">
                          <i class="cancel icon"></i> Hủy
                      </a>
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

<script>
$(document).ready(function() {
    $('.ui.dropdown').dropdown();
});
</script>

<!-- END CONTENT -->
</div>
</body>
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