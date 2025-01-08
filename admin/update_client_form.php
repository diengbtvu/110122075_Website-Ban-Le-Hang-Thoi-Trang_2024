<script>
function validateForm() {
    var lname = document.getElementsByName("last_name_c")[0].value;
    var fname = document.getElementsByName("first_name_c")[0].value;
    var sex = document.getElementsByName("sex_c")[0].value;
    var address = document.getElementsByName("address_c")[0].value;
    var email = document.getElementsByName("email_c")[0].value;
    var phone = document.getElementsByName("phone_c")[0].value;
    var user = document.getElementsByName("user_c")[0].value;
    var password = document.getElementsByName("password_c")[0].value;
    var ban = document.getElementsByName("ban_c")[0].value;

    if (lname == "") {
        alert("Please fill out last name!");
        return false;
    }
    if (fname == "") {
        alert("Please fill out first name!");
        return false;
    }
    if (sex == 0) {
        alert("Please fill out sex!");
        return false;
    }
    if (address == "") {
        alert("Please fill out address!");
        return false;
    }
    if (email == "") {
        alert("Please fill out email!");
        return false;
    }

    // Check if the email has a valid format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address!");
        return false;
    }

    if (phone == "") {
        alert("Please fill out phone!");
        return false;
    }
    if (user == "") {
        alert("Please fill out user!");
        return false;
    }
    if (password == "") {
        alert("Please fill out password!!");
        return false;
    }
    if (ban == "") {
        alert("Please fill out ban!!");
        return false;
    }
    if (ban != "0" && ban != "1") {
        alert("Please enter ban true format!!");
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
                            <div class="ui blue ribbon icon label">Cập nhật thông tin khách hàng</div>
                            <br><br>
                            <?php
            //   echo var_dump($result);
              ?>
                            <form action="admin.php?act=updateform_client" method="POST" class="ui form" onsubmit="return validateForm()">
                                <div class="field">
                                    <label>Họ <span style="color: red">*</span></label>
                                    <input type="text" name="last_name_c" value="<?=$result[0]['lname']?>" placeholder="Nhập họ">
                                </div>
                                
                                <div class="field">
                                    <label>Tên <span style="color: red">*</span></label>
                                    <input type="text" name="first_name_c" value="<?=$result[0]['fname']?>" placeholder="Nhập tên">
                                </div>
                                
                                <div class="field">
                                    <label>Giới tính <span style="color: red">*</span></label>
                                    <select name="sex_c" class="ui dropdown">
                                        <option value="0">Chọn giới tính</option>
                                        <option value="1" <?=$result[0]['sex']=='1'?'selected':''?>>Nam</option>
                                        <option value="2" <?=$result[0]['sex']=='2'?'selected':''?>>Nữ</option>
                                        <option value="3" <?=$result[0]['sex']=='3'?'selected':''?>>Khác</option>
                                    </select>
                                </div>
                                
                                <div class="field">
                                    <label>Địa chỉ <span style="color: red">*</span></label>
                                    <input type="text" name="address_c" value="<?=$result[0]['address']?>" placeholder="Nhập địa chỉ">
                                </div>
                                
                                <div class="field">
                                    <label>Email <span style="color: red">*</span></label>
                                    <input type="email" name="email_c" value="<?=$result[0]['email']?>" placeholder="Nhập email">
                                </div>
                                
                                <div class="field">
                                    <label>Số điện thoại <span style="color: red">*</span></label>
                                    <input type="text" name="phone_c" value="<?=$result[0]['phone']?>" placeholder="Nhập số điện thoại">
                                </div>
                                
                                <div class="field">
                                    <label>Tài khoản <span style="color: red">*</span></label>
                                    <input type="text" name="user_c" value="<?=$result[0]['user']?>" readonly>
                                </div>
                                
                                <div class="field">
                                    <label>Mật khẩu <span style="color: red">*</span></label>
                                    <input type="password" name="password_c" value="<?=$result[0]['password']?>" placeholder="Nhập mật khẩu">
                                </div>
                                
                                <div class="field">
                                    <label>Trạng thái tài khoản <span style="color: red">*</span></label>
                                    <select name="ban_c" class="ui dropdown">
                                        <option value="0" <?=$result[0]['ban']==='0' || $result[0]['ban']===0 ?'selected':''?>>Hoạt động</option>
                                        <option value="1" <?=$result[0]['ban']==='1' || $result[0]['ban']===1 ?'selected':''?>>Bị khóa</option>
                                    </select>
                                </div>

                                <input type="hidden" name="id" value="<?=$result[0]['id']?>">
                                <button type="submit" name="submit" class="ui primary button">
                                    <i class="save icon"></i> Cập nhật
                                </button>
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
function validateForm() {
    var fields = {
        'last_name_c': 'họ',
        'first_name_c': 'tên',
        'sex_c': 'giới tính',
        'address_c': 'địa chỉ',
        'email_c': 'email',
        'phone_c': 'số điện thoại',
        'password_c': 'mật khẩu'
    };

    // Kiểm tra các trường bắt buộc
    for (var field in fields) {
        var value = document.getElementsByName(field)[0].value.trim();
        if (value === "" || (field === 'sex_c' && value === "0")) {
            alert("Vui lòng nhập " + fields[field] + "!");
            return false;
        }
    }

    // Kiểm tra email
    var email = document.getElementsByName("email_c")[0].value;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Vui lòng nhập email hợp lệ!");
        return false;
    }

    // Kiểm tra số điện thoại
    var phone = document.getElementsByName("phone_c")[0].value;
    var phoneRegex = /^[0-9]{10,11}$/;
    if (!phoneRegex.test(phone)) {
        alert("Số điện thoại phải có 10-11 chữ số!");
        return false;
    }

    return true;
}

$(document).ready(function() {
    $('.ui.dropdown').dropdown();
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

<script>
$(document).ready(function() {

    $(document).ready(function() {
        $('#example').DataTable();
    });
    table.buttons().container().appendTo(
        $('div.eight.column:eq(0)', table.table().container())
    );
});
</script>

</html>