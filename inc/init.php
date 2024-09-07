<?
    /* Khởi tạo session */
    if(session_id() === '') session_start();
    /* 
    phương thức tự động load các class tương ứng
    */
    spl_autoload_register(
        function($className){  
            $fileName = strtolower($className) . ".php";
            $dirRoot = dirname(__DIR__);
            require $dirRoot . "/classes/{$fileName}";
          
            
        }

    );
    /*Gọi tập tin config*/
    require dirname(__DIR__) . "/config.php";
    
    function errorHandler($level, $message, $file, $line){
        throw new ErrorException($message, 0, $level, $file, $line);
    }
    //hàm quản lý exception
    function exceptionHandler($ex){
        if(DEBUG){
            echo "<h2>Lỗi</h2>";
            echo "<p>Exception: ". get_class($ex). "</p>";
            echo "<p> Nội dung: ".$ex->getMessage(). "</p>";
            echo "<p> Tập tin: ".$ex->getFile(). "dòng thứ : ".
                $ex->getLine()."</p>";
        }else{
            
           
            //sau này sẽ gọi trang 404.php ở đây  
        }
        exit();
    }
        //đăng ký với php
    set_error_handler('errorHandler');
    set_exception_handler('exceptionHandler');
    
?>