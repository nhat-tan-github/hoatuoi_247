<?
class Auth{
    /* Kiểm tra đã đăng nhập chưa*/
        public static function isLoggedIn(){
            /* có tồn tại $_SESSION['logged_in'] và $_SESSION có  ('logged_in'); hay không */
            return isset($_SESSION['logged_in']) &&
                        $_SESSION['logged_in'];
        }
    /*  Bắt buộc phải đăng nhập  */
    public static function requireLogin(){
        if(!static :: isLoggedIn()){
            // from "die ('Please login to continue !');" to
            die ('Please login to continue !');   
        }
    }
    /* Tạo sessioin sau khi login*/
    public static function login($username){
        session_regenerate_id(true);
        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $username;
    }
    /*  Xóa session, cookie sau khi đăng xuất*/
    public static function logout(){
        if(ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '', 
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"],
            );
        }
        session_destroy();
    }
    }
?>
