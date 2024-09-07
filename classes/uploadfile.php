<?
    include "errorfileupload.php";
    class Uploadfile{
        public static function process(){
            try{

                if(empty($_FILES)){
                    //throw new Exception('Không thể upload tập tin');
                    Dialog::show('Không thể upload tập tin');
                    return null;
                }
                $rs = Errorfileupload::error($_FILES['file']['error']);
                if($rs != 'OK'){
                    Dialog::show($rs);
                    return null;
                }
                //giới hạn kích thước file<=2M
                $filemaxsize = FILE_MAX_SIZE;
                if($_FILES['file']['size']>$filemaxsize){
                    //throw new Exception('kích thước tập tin phải <=' .$filesize);
                    Dialog::show('Kích thước tập tin phải <='. $filemaxsize);
                    return null;
                }
                //giới hạn laoij file hình ảnh 
                $mine_type = FILE_TYPE;
                //kiểm tra phần thông tin file đê đảm bảo răng là file hình ảnh 
                $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
                //file upload sẽ lưu trong tmp_name
                $file_mine_type = finfo_file($fileinfo, $_FILES['file']['tmp_name']);
                if(! in_array($file_mine_type, $mine_type)){
                    Dialog::show('Kiểu tập tin phải là hình ảnh');
                    return null;
                }
                /*
                    Thực hiện upload file lên thư mục uploads trên server
                */
                //chuẩn hóa tên file trước khi upload lên server
                $pathinfo = pathinfo($_FILES['file']['name']);
                $filename = $pathinfo['filename'];
                $filename = preg_replace('/[^a-zA-Z0-9_-]/','_',$filename);
        
                //Xử lý không ghi đè nếu đã tồn tại file trong uploads
                $fullname = $filename . '.' . $pathinfo['extension'];
                //tao đưognf đến thư mục uploads trên server
                $fileToHost = "uploads/" . $fullname;
                $i = 1;
                while(file_exists($fileToHost)){
                    $fullname = $filename ."-$i." . $pathinfo['extension'];
                    $fileToHost = "uploads/" . $fullname;
                    $i++;
                }
                //lấy file tạm trong bộ nhớ để đưa lên host
                $fileTmp = $_FILES['file']['tmp_name'];
                if(move_uploaded_file($fileTmp, $fileToHost)){
                    return $fullname;
                }else{
                    return null;
                }
            }catch(Exception $e){
                Dialog::show($e->getMessage());
            }
        }
    }
?>