<h2>Quản Lí Hiệu Sản Phẩm</h2>
<form action="modules/quanlihieusanpham/process.php" method="post" >
    <table class="them-hieu">
        <tr>
            <td>Mã Hiệu:</td>
            <td><input type="text" name="ma-hieu" id="ma-hieu"></td>
        </tr>
        <tr>
            <td>Hiệu Sản Phẩm:</td>
            <td><input type="text" name="hieu-san-pham" id="hieu-san-pham"></td>
        </tr>
        <tr>
            <td>Tình trạng:</td>
            <td>
                <select name="tinh-trang" id="tinh-trang" style="width: 100%;">
                    <option value="0">Không Kích Hoạt</option>
                    <option value="1">Kích Hoạt</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="them-hieu" style="width: 100%;">Thêm Hiệu Sản Phẩm</button></td>
        </tr>
    </table>
</form>
<a href="index.php?quan-li=hieu-san-pham&&thao-tac=xem-tat-ca"><button style="width: 150px; height: 50px;">Xem tất Cả</button></a>
