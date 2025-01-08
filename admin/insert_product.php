<div class="right floated thirteen wide computer sixteen wide phone column" id="content">
  <div class="ui container grid">
    <div class="row">
      <div class="fifteen wide computer sixteen wide phone centered column center-table">
        <div class="ui divider"></div>
        <div class="ui grid">
          <div class="sixteen wide computer sixteen wide phone centered column">
            <!-- BEGIN DATATABLE -->
            <div class="ui stacked segment">
              <div class="ui blue ribbon icon label">Thêm sản phẩm mới</div>
              <br><br>
              <form action="admin.php?act=insert_product" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <label>Tên</label>
                <input type="text" name="name_product" placeholder="Tên sản phẩm" required></input>
                <label>Giá cũ</label>
                <input type="number" name="oldprices_product" placeholder="Vui lòng nhập giá cũ" min="0" required></input>
                <label>Giá cuối</label>
                <input type="number" name="prices_product" placeholder="Nhập giá cuối cùng" min="0" required></input>
                <label>Số lượng</label>
                <input type="number" name="quantity_product" placeholder="Vui lòng nhập số lượng" min="0" required></input>
                <label>Hiển thị</label>
                <input type="text" name="view_product" placeholder="1 hiện 2 ẩn" value="1" required></input>
                <label>Đặc biệt</label>
                <input type="text" name="special_product" placeholder="1 hiện 2 ẩn" value="0" required></input>
                <label>Mô tả</label>
                <input type="text" name="description_product" placeholder="Vui lòng nhập mô tả" required></input>
                <label>Size</label>
                <input type="text" name="size_product" placeholder="Vui lòng nhập size" pattern="[A-Za-z]+" required></input>
                <label>Danh mục sản phẩm</label>
                <select name="iddm" id="" required>
                  <option value="0">Chọn danh mục</option>
                  <?php
                    if(isset($dmsp))
                    {
                      foreach($dmsp as $dm)
                      {
                        echo '<option value="'.$dm['id_catalog_k'].'">'.$dm['catalog_name'].'</option>';
                      }
                    }
                  ?>
                </select>
                <select name="idee" id="" required>
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
                <select name="idsup" id="" required>
                  <option value="0">Chọn nhà cung cấp</option>
                  <?php
                    if(isset($dmsup))
                    {
                      foreach($dmsup as $sup)
                      {
                          echo '<option value="'.$sup['sup_id'].'">'.$sup['sup_name'].'</option>';
                      }
                    }
                  ?>
                </select>
                <br>

                <label>Ảnh</label>
                <br>
                  <input type="file" name="img_product" accept="image/*" required></input>
                <br>
                <br>
                <input type="submit" name="submit" value="Thêm sản phẩm"></input>
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

<script>
function validateForm() {
  var name = document.getElementsByName("name_product")[0].value;
  var old_prices = document.getElementsByName("oldprices_product")[0].value;
  var prices = document.getElementsByName("prices_product")[0].value;
  var quantity = document.getElementsByName("quantity_product")[0].value;
  var view = document.getElementsByName("view_product")[0].value;
  var special = document.getElementsByName("special_product")[0].value;
  var description = document.getElementsByName("description_product")[0].value;
  var size = document.getElementsByName("size_product")[0].value;
  var iddm = document.getElementsByName("iddm")[0].value;
  var idee = document.getElementsByName("idee")[0].value;
  var idsup = document.getElementsByName("idsup")[0].value;

  if (name=="" || old_prices=="" || prices=="" || quantity=="" || view=="" || special=="" || description=="" || size=="" || iddm=="0" || idee=="0" || idsup=="0") {
    alert("Vui lòng điền đầy đủ thông tin!");
    return false;
  }

  // Kiểm tra size chỉ chứa chữ cái
  if (!/^[A-Za-z]+$/.test(size)) {
    alert("Size chỉ được chứa chữ cái!");
    return false;
  }

  // Kiểm tra giá và số lượng phải là số dương
  if (prices <= 0) {
    alert("Giá phải lớn hơn 0!");
    return false;
  }
  if (quantity <= 0) {
    alert("Số lượng phải lớn hơn 0!");
    return false;
  }

  return true;
}
</script>

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