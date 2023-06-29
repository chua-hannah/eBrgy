<?php
class Resident {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createResident($name, $email, $phone, $address, $profilePicture) {
        $profilePicture = $this->uploadProfilePicture($profilePicture);
        $sql = "INSERT INTO residents (name, email, phone, address, profile_picture) VALUES ('$name', '$email', '$phone', '$address', '$profilePicture')";
        return $this->conn->query($sql);
    }

    public function getResidents() {
        $sql = "SELECT * FROM residents";
        $result = $this->conn->query($sql);
        $residents = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $residents[] = $row;
            }
        }

        return $residents;
    }

    public function updateResident($id, $name, $email, $phone, $address, $profilePicture) {
        $profilePicture = $this->uploadProfilePicture($profilePicture, $id);
        $sql = "UPDATE residents SET name='$name', email='$email', phone='$phone', address='$address', profile_picture='$profilePicture' WHERE id=$id";
        return $this->conn->query($sql);
    }

    public function deleteResident($id) {
        $sql = "DELETE FROM residents WHERE id=$id";
        return $this->conn->query($sql);
    }

    private function uploadProfilePicture($file, $customerId = null) {
        $targetDirectory = "uploads/";
        $fileName = basename($file["name"]);
        $targetPath = $targetDirectory . $fileName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only specific file formats
        if ($imageFileType !== "jpg" && $imageFileType !== "jpeg" && $imageFileType !== "png" && $imageFileType !== "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Move the uploaded file to the target directory
        if ($uploadOk == 1) {
            move_uploaded_file($file["tmp_name"], $targetPath);
            return $fileName;
        } else {
            // If the upload fails, use the existing profile picture or a default picture
            $sql = "SELECT profile_picture FROM residents WHERE id=$customerId";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row["profile_picture"];
            } else {
                return "default.jpg"; // Default picture filename
            }
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
