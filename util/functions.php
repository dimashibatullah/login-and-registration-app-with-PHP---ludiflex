
<?php




// koneksi php dengan database
$conn = mysqli_connect("localhost", "root", "Passmysql1$", "phpdasar");


// error
$error = [];

// initially
$usernameLog = '';
$emailLog = '';

function registrasi($data) {

    // global conn
    global $conn;

    //error
    global $error;
    

    // ambil data dari $data
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $age = htmlspecialchars($data["age"]);
    $password = htmlspecialchars($data["password"]);


    // validasi nama yang sudah ada
    validateusernameExists($username);

    //validasi panjang karakter username
    validateUsernameLength($username);

    //validasi karakter username
    validateUsernamePattern($username);

    //validasi format email
    validateEmail($email);

    //validasi range age
    validateAgeRange($age);

    //validasi format password
    validatePassFormat($password);


    // akhir validasi
    if ($error) {
        return false;
    }


    //password hashing
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // buat variabel query
    $query = "INSERT INTO loginregistrationludiflex (username, email, age, password) VALUES ('$username', '$email', '$age', '$hashPassword')";

    // memasukkan data ke dalam database
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}


function validateusernameExists($username) {
    global $conn;
    global $error;

    $dataUser = mysqli_query($conn, "SELECT * FROM loginregistrationludiflex WHERE username = '$username'");
    if (mysqli_num_rows($dataUser) == 1) {
        $error['sameUsername'] = "username sudah digunakan";
    };
};

function validateusernameExistsUpdate($username, $oldUsername) {
    global $conn;
    global $error;

    // jika username !oldUsername tapi sama dengan username lainnya
    $dataUser = mysqli_query($conn, "SELECT * FROM loginregistrationludiflex WHERE username = '$username' AND username != '$oldUsername';");
    if (mysqli_num_rows($dataUser) == 1) {
        $error['sameUsername'] = "username sudah digunakan";
    };


}

function validateUsernameLength($username) {
    global $error;
    if ((strlen($username) < 2) || (strlen($username) > 50)) {
        $error["usernameLen"] = "Username harus antara 2 hingga 50 karakter.";
    };
};


function validateUsernamePattern($username) {
    global $error;
    $pattern = "/^[A-Za-z][A-Za-z0-9_]{2,19}[A-Za-z0-9]$/";
    if (!preg_match($pattern, $username)) {
        $error["invalidUsername"] = "username tidak valid";
    };
};

function validateEmail($email) {
    global $error;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error["emailFormat"] = "email anda tidak valid";
    };
};

function validateAgeRange($age) {
    global $error;
    if ($age <= 17 || $age >= 100) {
        $error["rangeAge"] = "umur anda tidak diperbolehkan";
    };
};

function validatePassFormat($password) {
    global $error;
    $patternpass = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/";
    if (!preg_match($patternpass, $password)) {
        $error["passFormat"] = "format password invalid";
    };
};




function updateProfil($data, $id, $oldUsername) {
    global $conn;
    global $error;


    // ambil data dari form dan lakukan sanitasi
    $username = htmlspecialchars($data['username']);
    $email = htmlspecialchars($data['email']);
    $age = htmlspecialchars($data['age']);


    //validasi input
    validateusernameExistsUpdate($username, $oldUsername);
    validateUsernameLength($username);
    validateUsernamePattern($username);
    validateEmail($email);
    validateAgeRange($age);

    //cek validationExist
    if ($error) {
        return false;
    }

    // update session username
    $_SESSION['username'] = $username;

    // jika newUsername dan oldUsername sama
    if ($username == $oldUsername) {
        return true;
    } else {
        // update data di database
        mysqli_query($conn, "UPDATE loginregistrationludiflex SET username = '$username', email = '$email', age = $age WHERE id = $id;");
    }

    // cek hasil update data
    if (mysqli_affected_rows($conn) > 0) {
        return true;
    }




}


?>


