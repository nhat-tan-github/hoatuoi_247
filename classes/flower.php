<?
    class Flower{
        public $id;
        public $name;
        public $description;
        public $price;
        public $imagefile;

        public $bought;

        public function __construct( $name = null, $description = null, $price = null, $imagefile = null) {
            
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
            $this->imagefile = $imagefile;
        }
        private function validate(){
            return $this->name != '' &&
                    $this->description != '' &&
                    $this->price != '' ;

        }

        
       
        
        public static function count($conn){
            try{
            $sql = "select count(id) from flowers";
            return $conn->query($sql)->fetchColumn();
            }catch(PDOException $e){
                echo $e->getMessage();
                return -1;
            }
        }

        /*
        $flower = new Flower($name);
        $cnt = $flower->count($conn);
        echo "Tồn tại $cnt sản phẩm ! <br>";
        */
        public static function getAll($conn){
            try{
                $sql ="SELECT * FROM flowers ORDER BY name ASC";
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Flower');
                if($stmt->execute()){
                    $flowers = $stmt->fetchAll();
                    return $flowers;
                }
            } catch(PDOException $e){
                echo $e->getMessage();
                return null;
            }
        }
        public static function getByID($conn, $id){
            try{
                $sql = "select * from flowers where id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id',$id, PDO::PARAM_INT);
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Flower');
                if($stmt->execute()){
                    $flowers = $stmt->fetch();
                    return $flowers;
                }
            }catch(PDOException $e){
                echo $e->getMessage();
                return null;
            }
        }
        public function add($conn) {
            if ($this->validate()) {
                try {
                    $sql = "INSERT INTO flowers (name, description, price, imagefile) VALUES (:name, :description, :price, :imagefile)";
                   
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
                    $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
                    $stmt->bindValue(':price', $this->price, PDO::PARAM_STR);
                    $stmt->bindValue(':imagefile', $this->imagefile, PDO::PARAM_STR);
                return $stmt->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }else{
            return false;
            }
        } 
        public static function getPaging($conn, $limit, $offset) {
            try{
                $sql = "select * from flowers order by name asc 
                        limit :limit
                        offset :offset";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':limit',$limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset',$offset, PDO::PARAM_INT);
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Flower');
                if($stmt->execute()) {
                    $flowers = $stmt->fetchAll();
                    return $flowers;
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return null;
            }
        }
        public function update($conn) {
            try {
                $sql = "UPDATE flowers SET name=:name, description=:description, price=:price WHERE id=:id";
                $stmt = $conn->prepare($sql);
                
                $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
                $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
                $stmt->bindValue(':price', $this->price, PDO::PARAM_STR);
                $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
                return $stmt->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function updateImage($conn) {
            try{
                $sql = "update flowers set imagefile = :imagefile where id =:id;";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
                $stmt->bindValue(':imagefile', $this->imagefile, $this->imagefile == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
                return $stmt->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
        public function delete($conn, $name) {
            
                $sql = "DELETE FROM `flowers` WHERE `flowers`.`name` = :name";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        
                // xóa và trả về kết quả 
                return $stmt->execute();
        }
        
        public function deleteByID($conn){
            try{                              
                $sql = "DELETE FROM flowers WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
                return $stmt->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
        // xác thực theo tên 
        public function authenticate($conn, $name) {
            $searchTerm = '%' . $name . '%';
            $sql = "SELECT * FROM flowers WHERE name LIKE :searchTerm";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->rowCount() > 0;
           
        }
        public static function addBought($conn, $id, $quantity) {
            try {
                $sql = "UPDATE flowers SET bought = bought + :quantity WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            } catch(PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        

    }
    
    