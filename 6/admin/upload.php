<?php
if (is_uploaded_file($imgurl["tmp_name"])) {
  if (move_uploaded_file($imgurl["tmp_name"], "files/" . $imgurl["name"])) {
    chmod("files/" . $imgurl["name"], 0644);
    
    // echo $imgurl["name"] . "をアップロードしました。";
  } else {
    // echo "ファイルをアップロードできません。";
  }
} else {
  // echo "ファイルが選択されていません。";
}
?>