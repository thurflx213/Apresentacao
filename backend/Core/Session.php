<?php
namespace App\Koketsu\Core;
<<<<<<< HEAD

class Session{
    public function __construct(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }
      public function set(string $key, $value):void {
        $_SESSION[$key] = $value;
      }
      public function get(string $key){
        return $_SESSION[$key] ?? null;
      }
      public function has(string $key): bool{
        return isset($_SESSION[$key]);
      }
      public function destroy(): void{
        $_SESSION = [];
        if (ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() + 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
        }
        session_destroy();
      }  
    }

    

=======
class Session {
    public function __construct(){
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        
    }
}
public function set(string $key, $value):void {
    $_SESSION[$key] = $value; 
}
public function get(string $key){
    return $_SESSION[$key] ?? null;
}
public function has(string $key): bool{
    return isset($_SESSION[$key]);
}
public function destroy(): void{
    $_SESSION = [];
    if(ini_get("session.use_cookies")){
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
    }
    session_destroy();
}
}
>>>>>>> 02824c7afd4b0d59fc71b10b5aa03004e6fcd33d
