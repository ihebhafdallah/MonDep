<?php 
    
    function Profs_NB () {
        include('config.php');
        $count = 0;
        $result = $mysqli->query("SELECT * FROM `prof`");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $count++;
            }
        }
        return $count;
    }

    function Specialite_NB () {
        include('config.php');
        $count = 0;
        $result = $mysqli->query("SELECT * FROM `specialite`");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $count++;
            }
        }
        return $count;
    }

    function Module_NB () {
        include('config.php');
        $count = 0;
        $result = $mysqli->query("SELECT * FROM `module`");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $count++;
            }
        }
        return $count;
    }

    function Etudiant_NB () {
        include('config.php');
        $count = 0;
        $result = $mysqli->query("SELECT * FROM `etudiant`");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $count++;
            }
        }
        return $count;
    }
    
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function imagecreatefromfile( $filename ) {
        if (!file_exists($filename)) {
            throw new InvalidArgumentException('File "'.$filename.'" not found.');
        }
        switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
            case 'jpeg':
            case 'jpg':
                return imagecreatefromjpeg($filename);
            break;
    
            case 'png':
                return imagecreatefrompng($filename);
            break;
    
            case 'gif':
                return imagecreatefromgif($filename);
            break;
    
            default:
                throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
            break;
        }
    }

?>