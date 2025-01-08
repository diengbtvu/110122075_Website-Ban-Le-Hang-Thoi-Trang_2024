<script>
function validateForm() {
  var name = document.getElementsByName("supplier_name")[0].value;
  var bank = document.getElementsByName("supplier_bank")[0].value;
  var address = document.getElementsByName("supplier_address")[0].value;
  var tax_code = document.getElementsByName("supplier_tax")[0].value;

  if (name == "") {
    alert("Please fill out supplier name!");
    return false;
  }
  if (bank == "") {
    alert("Please fill out bank account!");
    return false;
  }
  if (address == "") {
    alert("Please fill out address!");
    return false;
  }
  if (tax_code == "") {
    alert("Please fill out tax code!!");
    return false;
  }
  return true;
}
</script>

<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
    <div class="ui container grid">
        <div class="row">
            <div class="fifteen wide computer sixteen wide phone centered column">
                <div class="ui stacked segment">
                    <div class="ui blue ribbon icon label">
                        <i class="building icon"></i> Thêm nhà cung cấp mới
                    </div>
                    <br><br>
                    <form class="ui form" action="admin.php?act=insert_supplier" method="POST">
                        <div class="field">
                            <label><i class="user icon"></i> Tên nhà cung cấp</label>
                            <input type="text" name="supplier_name" placeholder="Nhập tên nhà cung cấp">
                        </div>
                        <div class="field">
                            <label><i class="map marker alternate icon"></i> Địa chỉ</label>
                            <input type="text" name="supplier_address" placeholder="Nhập địa chỉ nhà cung cấp">
                        </div>
                        <div class="field">
                            <label><i class="credit card icon"></i> Tài khoản ngân hàng</label>
                            <input type="text" name="supplier_bank" placeholder="Nhập số tài khoản ngân hàng">
                        </div>
                        <div class="field">
                            <label><i class="id card icon"></i> Mã số thuế</label>
                            <input type="text" name="supplier_tax" placeholder="Nhập mã số thuế">
                        </div>
                        <button class="ui primary button" type="submit" name="submit">
                            <i class="save icon"></i> Lưu nhà cung cấp
                        </button>
                        <button class="ui button" type="reset">
                            <i class="undo icon"></i> Làm mới
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.ui.form .field > label {
    font-weight: bold;
    margin-bottom: 0.5em;
}

.ui.form input[type="text"] {
    margin-bottom: 1em;
}

.ui.button {
    margin-top: 1em;
}

.ui.ribbon.label {
    margin-bottom: 2em;
}
</style>

<script>
$(document).ready(function() {
    $('.ui.form').form({
        fields: {
            supplier_name: {
                identifier: 'supplier_name',
                rules: [{
                    type: 'empty',
                    prompt: 'Vui lòng nhập tên nhà cung cấp'
                }]
            },
            supplier_address: {
                identifier: 'supplier_address',
                rules: [{
                    type: 'empty',
                    prompt: 'Vui lòng nhập địa chỉ'
                }]
            },
            supplier_bank: {
                identifier: 'supplier_bank',
                rules: [{
                    type: 'empty',
                    prompt: 'Vui lòng nhập số tài khoản ngân hàng'
                }]
            },
            supplier_tax: {
                identifier: 'supplier_tax',
                rules: [{
                    type: 'empty',
                    prompt: 'Vui lòng nhập mã số thuế'
                }]
            }
        },
        inline: true,
        on: 'blur'
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