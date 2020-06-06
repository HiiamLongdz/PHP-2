<h2>Quản Lí Loại Sản Phẩm</h2>

<table border="1px" style="border-collapse:collapse;" class="loai-san-pham">
    <tr>
        <td>Mã Hiệu</td>
        <td>Tên Hiệu</td>
        <td>Tình Trạng</td>
        <td colspan="2">Quản Lí</td>
    </tr>

    <?php
    // include('../config.php');
    $sql = "select * from quanliloaisanpham";
    $rs = mysqli_query($conn, $sql);


    // print_r($each);
    // die();

    while ($each = mysqli_fetch_assoc($rs)) {
        // echo $row;
        // die();

    ?>
        <tr>
            <td><?php echo $each['id_loai']; ?></td>
            <td><?php echo $each['ten_loai']; ?></td>
            <td>
                <?php
                $tinh_trang = $each['tinh_trang'];
                if ($tinh_trang) {
                    echo "Kích Hoạt";
                } else echo "Không Kích Hoạt";
                ?>
            </td>
            <td>
                <a href="index.php?quan-li=loai-san-pham&&thao-tac=sua&&ma-loai=<?php echo $each['id_loai']; ?>"><img src="../images/edit.png" alt="" width="15px">Sửa</a>
            </td>
            <td>
                <a href="index.php?quan-li=loai-san-pham&&thao-tac=xoa-loai&&ma-loai=<?php echo $each['id_loai']; ?>"><img src="../images/delete.png" alt="" width="15px">Xóa</a>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="5">
            <a href="index.php?quan-li=loai-san-pham&&thao-tac=them-loai"><button>Thêm Loại Sản Phẩm</button></a>
        </td>
    </tr>
</table>