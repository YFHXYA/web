<?php

//empty()：检查一个变量是否为空  /  $_FILES数组：接收上传的文件
if(empty($_FILES)){ //提交的文件是否为空
  //没有文件则显示提交页面
  include 'wjtj.html';
}else{
  //把文件上传到./dir目录
  $up_root = 'dir/';
  //该目录是否存在  || 不存在创建该目录
  is_dir($up_root) || mkdir($up_root);
  //遍历上传的文件
  foreach($_FILES as $item){
    //error = 0 表示文件正常可以上传
    if($item['error'] === 0){
      //读取文件信息
      $content = file_get_contents($item['tmp_name'],'r');
      //获取一个带前缀 基于当前时间微妙数唯一的ID
      $fid = uniqid();
      //文件名和后缀以'.'分开 得到一个$suffix数组
      $suffix = explode('.',$item['name']);
      //删除数组最后一位并返回 获得后缀名
      $suffix = array_pop($suffix);
      $suffix && ($suffix = '.'.$suffix);
      
      //move_uploaded_file 将上传的文件移动到新位置
      move_uploaded_file($item['tmp_name'],$up_root.$fid.$suffix);

      echo '文件'.$item['tmp_name'].'已上传到'.$up_root.'文件夹，文件名是:'.$fid.$suffix.'访问  http://www.yfhxya.top/dir/'.$fid.$suffix.' 即可查看！';
    }else{
      echo "文件异常，上传失败";
    };
  };
};
