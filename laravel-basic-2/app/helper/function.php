<?php 
function showErrors($errors, $name){
    if($errors->has($name)){
        echo ' <div class="alert alert-danger" role="alert">';
        echo '<strong>'.$errors->first($name).'</strong>';
        echo '</div>';
    }
}

// danh mục đệ quy
function GetCategory($mang,$parent,$shift,$active)
{
    foreach ($mang as $row) 
    {
        if ($row->parent==$parent) 
        {
            if ($row->id==$active) 
            {
                echo "<option selected value='$row->id'>".$shift.$row->name."</option>";
            }
            else
            {
                echo "<option value='$row->id'>".$shift.$row->name."</option>";
            }
            
            GetCategory($mang,$row->id,$shift.'--|',$active);
        }
    }
}

function ShowCategory($mang,$parent,$shift)
{
    foreach ($mang as $row) 
    {
        if ($row->parent==$parent) 
        {
            echo "	<div class='item-menu'><span>".$shift.$row->name."</span>
                    <div class='category-fix'>
                    <a class='btn-category btn-primary' href='/admin/category/edit/".$row->id."'><i class='fa fa-edit'></i></a>
                    <a onclick='return del_category(\"$row->name\")' class='btn-category btn-danger' href='/admin/category/del/".$row->id."'><i class='fas fa-times'></i></i></a>
                    </div>
                    </div>";
                    ShowCategory($mang,$row->id,$shift.'--|');
        }
        
    }
}

// đếm số cấp danh mục tránh vỡ giao diên frontend
function GetLevel($mang,$parent,$count)
{
    foreach ($mang as $value) 
    {
        if ($value['id']==$parent) 
        {
            $count++;
            if ($value['parent']==0) 
            {
                return $count;
            }
            return GetLevel($mang,$value['parent'],$count);
        }    
    }
}

// hiển thị thuộc tính và giá trị thuộc tính
//input : mảng giá trị thuộc tính - $mang = $product->values   
//(một sản phẩm xác định trỏ sang liên kết giá trị thuộc tính tới thuộc tính)
//output :  array('size'=>array(s,m) , 'color'=>array('do','xanh'))
function attr_values($mang)
{
    $result = array() ;
    foreach ($mang as $value) {
        $attr = $value->attribute->name ;
        $result[$attr][] = $value->value ;
    }
    return $result ;
}

// lấy ra từng cặp biến thể
// $mang = array('size'=>array('S','M'),'color'=>array('red','black'))
function get_combinations($array){
    $result = array(array());
    foreach ($array as $property => $property_values) {
        $tmp = array();
        foreach ($result as $result_item) {
            foreach ($property_values as $property_value) {
                $tmp[] = array_merge($result_item, array($property=>$property_value));
            }
        }
        $result = $tmp;
    }
    return $result;
}

// check value
function check_value($product,$value_check)
{ 
    foreach ($product->values as $value) 
    {   
        if ($value->id==$value_check) 
        {
            return true;
        }
    }
    return false;
}

// kiem tra bien the
function check_var($product,$array)
{
    foreach ($product->variant as $row) 
    {
        $mang = array();
        foreach ($row->values as $value) 
        {
            $mang[]=$value->id;
        }
        if (array_diff($mang,$array)==NULL) 
        {
            return false;
        }
    }
    return true;
}

//lấy ra giá biến thể nếu tôn tại hoặc giá chung
function getprice($product,$array)
{
    foreach($product->variant as $row)
    {
        $mang=array();
        foreach($row->values as $value)
        {
            $mang[]=$value->value;
        }

        if(array_diff($mang,$array)==NULL)
        {
            if($row->price==0)
            {
                return $product->price;
            }
            return $row->price;
        }
    }
    return $product->price;
}