<?php
// hiển thị lỗi ô input
function showErrors($errors,$name){
    if($errors->has($name)){
        echo ' <div class="alert alert-danger" role="alert">';
        echo '<strong>'.$errors->first($name).'</strong>';
        echo '</div>';
    }
}

// danh mục đệ quy ( add category )
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
            echo "<div class='item-menu'><span>".$shift.$row->name."</span>
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