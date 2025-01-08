<script>
function validateForm() {
    var idee = document.getElementById("idee").value;
    var email = document.getElementsByName("email")[0].value;
    var fname = document.getElementsByName("fname")[0].value;
    var lname = document.getElementsByName("lname")[0].value;
    var address = document.getElementsByName("address")[0].value;

    if (idee == 0) {
        alert("Vui lòng chọn nhân viên!");
        return false;
    }

    if (email == "") {
        alert("Vui lòng nhập email khách hàng!");
        return false;
    }

    // Check if the email has a valid format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Vui lòng nhập đúng định dạng email!");
        return false;
    }

    if (fname == "") {
        alert("Vui lòng nhập tên!");
        return false;
    }

    if (lname == "") {
        alert("Vui lòng nhập họ!");
        return false;
    }

    if (address == "") {
        alert("Vui lòng nhập địa chỉ khách hàng!");
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
                            <div class="ui blue ribbon icon label">Cập nhật thông tin hoá đơn</div>
                            <br><br>
                            <?php
              // echo var_dump($result);
              ?>
                            <label>Mã hóa đơn<span style="color: red"> *</span></label>
                            <input class="banban" type="text" name="id_invoice" value="<?=$result[0]['invoice_id']?>"
                                placeholder="Mã hóa đơn" readonly>
                            <form action="admin.php?act=updateform_invoice" method="POST" enctype="multipart/form-data"
                                onsubmit="return validateForm()">
                                <label>Tên <span style="color: red"> *</span></label>
                                <input type="text" name="fname" value="<?=$result[0]['fname']?>"
                                    placeholder="Tên"></input>
                                <label>Họ <span style="color: red"> *</span></label>
                                <input type="text" name="lname" value="<?=$result[0]['lname']?>"
                                    placeholder="Họ"></input>
                                <label>SDT <span style="color: red"> *</span></label>
                                <input type="text" name="phone" value="<?=$result[0]['phone']?>"
                                    placeholder="Số điện thoại khách hàng"></input>
                                <label>Email <span style="color: red"> *</span></label>
                                <input type="text" name="email" value="<?=$result[0]['email']?>"
                                    placeholder="Email khách hàng"></input>
                                <label>Địa chỉ <span style="color: red"> *</span></label>
                                <input type="text" name="address" value="<?=$result[0]['address']?>"
                                    placeholder="Địa chỉ khách hàng"></input>
                                <label>Trạng thái<span style="color: red"> *</span></label>
                                <select name="status" id="">
                                    <?php
                        if($result[0]['status']=="Pending")
                        {
                            echo '<option value="Pending" selected>Đang xử lý</option>';
                            echo '<option value="Cancel" >Huỷ đơn</option>';
                            echo '<option value="Delivered" >Đã giao</option>';
                        } 
                        elseif($result[0]['status']=="Cancel")
                        {
                            echo '<option value="Cancel" selected>Huỷ đơn</option>';
                            echo '<option value="Pending">Đang xử lý</option>';
                            echo '<option value="Delivered">Đã giao</option>';
                        }
                        elseif($result[0]['status']=="Delivered")
                        {
                            echo '<option value="Delivered"  selected>Đã giao</option>';
                            echo '<option value="Pending">Đang xử lý</option>';
                            echo '<option value="Cancel">Huỷ đơn</option>';
                        } 
                        ?>
                                    </select style="display: none;">
                                    <label style="display: none;">Nhân viên <span style="color: red"> *</span></label>
                                    <select name="idee" id="idee" required style="display: none;">
                                        <?php
                                    if(isset($dmee))
                                    {
                                    foreach($dmee as $us)
                                    {
                                        if($us['user']==$_SESSION['name'])
                                        {
                                            echo '<option value="'.$us['id'].'" selected>'.$us['name_us'].'</option>';
                                        }
                                    }
                                    }
                        ?>
                                </select>
                                <br>
                                <input type="hidden" name="id" value="<?=$result[0]['id']?>">
                                <input type="submit" name="submit" value="Cập nhật"></input>
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
<script src="vendors/jquery/jquery.min.js"></script>
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
// $(document).ready(function() {

//   $(document).ready(function() {
//     $('#example').DataTable();
//   });
//   table.buttons().container().appendTo(
//     $('div.eight.column:eq(0)', table.table().container())
//   );
// });
</script>

</html>