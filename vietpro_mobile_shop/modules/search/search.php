<?php
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
}
else {
    $keyword = $_GET['keyword'];
}

//explode()
$arr_keyword = explode(' ', $keyword);
//implode()
$keyword_end = '%'.implode('%', $arr_keyword).'%';

$sql = "SELECT * FROM product WHERE prd_name LIKE '$keyword_end' ORDER BY prd_id DESC LIMIT 6";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);

?>
  
                <!--	List Product	-->
                <div class="products">
                    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword; ?></span></div>
                    <?php
                    $i=1;
                    while($row = mysqli_fetch_array($query)){
                        if ($i == 1){
                            echo '<div class="product-list card-deck">';
                        }
                    ?>
                   
                        <div class="product-item card text-center">
                        <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
                    <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name']; ?></a></h4>
                    <p>Giá Bán: <span><?php echo number_format( $row['prd_price'], 0, '', '.' ); ?>đ</span></p>
                        </div>
                        <?php
                            if ($i==3) {
                                $i=1;
                                echo '</div>';
                            }else{
                                $i++;
                            }
                        }
                        if ($num % 3!= 0) {
                            echo '</div>';
                        }
                        ?>
                </div>
                <!--	End List Product	-->
                
                <div id="pagination">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Trang trước</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Trang sau</a></li>
                    </ul> 
                </div>
                
         