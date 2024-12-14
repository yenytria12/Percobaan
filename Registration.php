<?php
$title = "Form RegistrasiMahasiswa";
$arr_month = [
    "1" => "Januari",
    "2" => "Februari",
    "3" => "Maret",
    "4" => "April",
    "5" => "Mei",
    "6" => "Juni",
    "7" => "Juli",
    "8" => "Agustus",
    "9" => "September",
    "10" => "Oktober",
    "11" => "November",
    "12" => "Desember",
];
$error_message = "";
if (isset($_POST["submit"])) {
    $student_name =
        htmlentities(strip_tags(trim($_POST["student_name"])));
    $student_number =
        htmlentities(strip_tags(trim($_POST["student_number"])));
    $student_address =
        htmlentities(strip_tags(trim($_POST["student_address"])));
    $student_birth_date =
        htmlentities(strip_tags(trim($_POST["student_birth_date"])));
    $student_birth_month =
        htmlentities(strip_tags(trim($_POST["student_birth_month"])));
    $student_birth_year =
        htmlentities(strip_tags(trim($_POST["student_birth_year"])));
    $student_gender =
        htmlentities(strip_tags(trim($_POST["student_gender"])));
    $student_website =
        htmlentities(strip_tags(trim($_POST["student_website"])));
    $student_email =
        htmlentities(strip_tags(trim($_POST["student_email"])));
    $student_username =
        htmlentities(strip_tags(trim($_POST["student_username"])));
    $student_password =
        htmlentities(strip_tags(trim($_POST["student_password"])));
    $student_password_confirmation =
        htmlentities(strip_tags(trim($_POST["student_password_confirmation"])));
    if (empty($student_name)) $error_message .= "-NamaMahasiwa
 belumdiisi<br>";
    if (empty($student_number)) $error_message .= "-No Induk
 Mahasiswa(NIM)belumdiisi<br>";
    if (empty($student_address)) $error_message .= "-Alamat
 Mahasiswabelumdiisi<br>";
    if (empty($student_website)) $error_message .= "-URL Website
 belumdiisi<br>";
    $upload_error = $_FILES["student_photo"]["error"];
    if ($upload_error !== 0) {
        $arr_upload_error = [
            1 => '-Ukuranfilefoto melewatibatasmaksimal<br>',
            2 => '-Ukuranfilefoto melewatibatasmaksimal1MB
 <br>',
            3 => '-Filefotohanyater-uploadsebagian<br>',
            4 => '-Fototidak ditemukan<br>',
            6 => '-ServerError(Upload Foto)<br>',
            7 => '-ServerError(Upload Foto)<br>',
            8 => '-ServerError(Upload Foto)<br>',
        ];
        $error_message .= $arr_upload_error[$upload_error];
    } else {
        $folder_name = "folder_upload";
        $file_name = $_FILES["student_photo"]["name"];
        $file_path = "$folder_name/$file_name";
        if (file_exists($file_path)) {
            $error_message .= "-Filedengannamasamasudahadadi
 server<br>";
        }
        $file_size = $_FILES["student_photo"]["size"];
        if ($file_size > 1048576) {
            $error_message .= "-Ukuranfilemelebihi700KB<br>";
        }
        $check = getimagesize($_FILES["student_photo"]["tmp_name"]);
        if ($check === false) {
            $error_message .= "-Mohonuploadfilegambar (gif, png,
 ataujpg)<br>";
        }
    }
    if (empty($student_email)) $error_message .= "-Email belum diisi
 <br>";
    if (empty($student_username)) $error_message .= "-Username belum
 diisi<br>";
    if (empty($student_password)) $error_message .= "-Password belum
 diisi<br>";
    if (empty($student_password_confirmation)) $error_message .= "
KonfirmasiPasswordbelumdiisi<br>";
    $checked_man = "";
    $checked_woman = "";
    switch ($student_gender) {
        case 'man':
            $student_gender = "Pria";
            $checked_man = "checked";
            break;
        case 'woman':
            $student_gender = "Wanita";
            $checked_woman = "checked";
            break;
    }
    $student_skill_html = "";
    $student_skill_html_text = "";
    $student_skill_css = "";
    $student_skill_css_text = "";
    $student_skill_js = "";
    $student_skill_js_text = "";
    $student_skill_php = "";
    $student_skill_php_text = "";
    $student_skill_mysql = "";
    $student_skill_mysql_text = "";
    $student_skill_laravel = "";
    $student_skill_laravel_text = "";
    $student_skill_react_native = "";
    $student_skill_react_native_text = "";
    if (isset($_POST["student_skill_html"])) {
        $student_skill_html = "checked";
        $student_skill_html_text = "HTML";
    }
    if (isset($_POST["student_skill_css"])) {
        $student_skill_css = "checked";
        $student_skill_css_text = ", CSS";
    }
    if (isset($_POST["student_skill_js"])) {
        $student_skill_js = "checked";
        $student_skill_js_text = ", Javascript";
    }
    if (isset($_POST["student_skill_php"])) {
        $student_skill_php = "checked";
        $student_skill_php_text = ", PHP";
    }
    if (isset($_POST["student_skill_mysql"])) {
        $student_skill_mysql = "checked";
        $student_skill_mysql_text = ",MySQL";
    }
    if (isset($_POST["student_skill_laravel"])) {
        $student_skill_laravel = "checked";
        $student_skill_laravel_text = ", Laravel";
    }
    if (isset($_POST["student_skill_react_native"])) {
        $student_skill_react_native = "checked";
        $student_skill_react_native_text = ",ReactNative";
    }
    if ($error_message === "") {
        $folder_name = "folder_upload";
        $tmp = $_FILES["student_photo"]["tmp_name"];
        $file_name = $_FILES["student_photo"]["name"];
        move_uploaded_file($tmp, "$folder_name/$file_name");
        include("registration_process.php");
        die();
    }
} else {
    $student_name = "";
    $student_number = "";
    $student_address = "";
    $student_birth_date = 1;
    $student_birth_month = "1";
    $student_birth_year = "1990";
    $checked_man = "checked";
    $checked_woman = "";
    $student_website = "";
    $student_email = "";
    $student_username = "";
    $student_password = "";
    $student_password_confirmation = "";
    $student_skill_html = "";
    $student_skill_css = "";
    $student_skill_js = "";
    $student_skill_php = "";
    $student_skill_mysql = "";
    $student_skill_laravel = "";
    $student_skill_react_native = "";
}
?>
<!DOCTYPEhtml>
    <htmllang="en">

        <head>
            <metacharset="UTF-8">
                <metahttp-equiv="X-UA-Compatible" content="IE=edge">
                    <metaname="viewport"content="width=device-width, initial
                        scale=1.0">
                        <metaname="author" content="Adzanil RachmadhiPutra">
                            <metaname="keyword" content="BelajarHTML,Belajar Web">
                                <metaname="description" content="Halaman praktikummodul 8mata
 kuliahpemrograman webdiprogram studisistem informasi">
                                    <metaname="robots" content="index, follow">
                                        <title><?= $title ?></title>
                                        <style>
                                            .container {
                                                width: 600px;
                                            }

                                            .error {
                                                background-color: #FFECEC;
                                                padding: 10px15px;
                                                margin: 3px 3px20px3px;
                                                border: 1px solidred;
                                            }
                                        </style>
        </head>

        <body>
            <divclass="container">
                <h2><?= $title ?></h2>
                <?php
                if ($error_message !== "")
                    echo "<divclass='error'>$error_message</div>";
                ?>
                <formaction="registration.php" method="post"
                    enctype="multipart/form-data">
                    <fieldset>
                        <legend>Biodata</legend>
                        <table>
                            <tr>
                                <td>NamaMahasiswa*</td>
                                <td>:</td>
                                <td>
                                    <input type="text" name="student_name"
                                        value="<?= $student_name ?>" size="20" placeholder="NamaAnda">
                                </td>
                            </tr>
                            <tr>
                                <td>NoIndukMahasiswa (NIM)*</td>
                                <td>:</td>
                                <td><input type="text" name="student_number"
                                        value="<?= $student_number ?>" size="20" placeholder="NIMAnda"></td>
                            </tr>
                            <tr>
                                <tdstyle="vertical-align:top;">Alamat
                                    Mahasiswa*</td>
                                    <tdstyle="vertical-align:top;">:</td>
                                        <td>
                                            <textareaname="student_address" cols="30"
                                                rows="5" placeholder="Alamat Anda"><?=
                                                                                    $student_address ?></textarea>
                                        </td>
                            </tr>
                            <tr>
                                <td>TanggalLahir*</td>
                                <td>:</td>
                                <td>
                                    <selectname="student_birth_date"
                                        id="student_birth_date">
                                        <?php
                                        for ($i = 1; $i <= 31; $i++) {
                                            if ($i == $student_birth_date) {
                                                echo "<optionvalue='$i'
 selected>";
                                            } else {
                                                echo "<optionvalue='$i'>";
                                            }
                                            echo
                                            str_pad($i, 2, "0", STR_PAD_LEFT);
                                            echo "</option>";
                                        }
                                        ?>
                                        </select>
                                        <selectname="student_birth_month">
                                            <?php
                                            foreach (
                                                $arr_monthas as $key =>
                                                $value
                                            ) {
                                                if ($key == $student_birth_month) {
                                                    echo "<optionvalue='$key'
 selected>$value</option>";
                                                } else {
                                                    echo "<option
 value='$key'>$value</option>";
                                                }
                                            }
                                            ?>
                                            </select>
                                            <selectname="student_birth_year">
                                                <?php
                                                for ($i = 1990; $i <= 2000; $i++) {
                                                    if ($i == $student_birth_year) {
                                                        echo "<optionvalue='$i'
 selected>$i</option>";
                                                    } else {
                                                        echo "<option
 value='$i'>$i</option>";
                                                    }
                                                }
                                                ?>
                                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td>JenisKelamin*</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="student_gender"
                                        value="man" id="pria" <?php echo $checked_man ?>><label
                                        for="pria">Pria</label>
                                    <input type="radio" name="student_gender"
                                        value="woman" id="wanita" <?php echo $checked_woman ?>><label
                                        for="wanita">Wanita</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Upload Foto*</td>
                                <td>:</td>
                                <td>
                                    <input type="file" name="student_photo"
                                        id="file_upload" accept="image/*">
                                    <input type="hidden" name="MAX_FILE_SIZE"
                                        value="1048576">
                                </td>
                            </tr>
                            <tr>
                                <td>URLWebsite*</td>
                                <td>:</td>
                                <td>
                                    <input type="url" name="student_website"
                                        value="<?= $student_website ?>" size="40" placeholder="URLWebsite Anda">
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>InfoAkun</legend>
                        <table>
                            <tr>
                                <td>Email*</td>
                                <td>:</td>
                                <td><input type="email" name="student_email"
                                        value="<?= $student_email ?>" size="20" placeholder="EmailAnda"></td>
                            </tr>
                            <tr>
                                <td>Username*</td>
                                <td>:</td>
                                <td><input type="text" name="student_username"
                                        value="<?= $student_username ?>" size="20" placeholder="Username
 Anda"></td>
                            </tr>
                            <tr>
                                <td>Password*</td>
                                <td>:</td>
                                <td><input type="password"
                                        name="student_password" value="<?= $student_password ?>" size="20"
                                        placeholder="PasswordAnda"></td>
                            </tr>
                            <tr>
                                <td>KonfirmasiPassword*</td>
                                <td>:</td>
                                <td><input type="password"
                                        name="student_password_confirmation" value="<?=
                                                                                    $student_password_confirmation ?>" size="20" placeholder="Password
 Anda"></td>
                            </tr>
                        </table>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>KemampuanDasar</legend>
                        <table>
                            <tr>
                                <td>
                                    <input type="checkbox"
                                        name="student_skill_html" value="html" id="html" <?=
                                                                                            $student_skill_html ?>>
                                    <labelfor="html">HTML</label>
                                        <input type="checkbox"
                                            name="student_skill_css" value="css" id="css" <?=
                                                                                            $student_skill_css ?>>
                                        <labelfor="css">CSS</label>
                                            <input type="checkbox"
                                                name="student_skill_js" value="javascript" id="javascript" <?=
                                                                                                            $student_skill_js ?>>
                                            <labelfor="javascript">Javascript</label>
                                                <input type="checkbox"
                                                    name="student_skill_php" value="php" id="php" <?=
                                                                                                    $student_skill_php ?>>
                                                <labelfor="php">PHP</label>
                                                    <input type="checkbox"
                                                        name="student_skill_mysql" value="mysql" id="mysql" <?=
                                                                                                            $student_skill_mysql ?>>
                                                    <labelfor="mysql">MySQL</label>
                                                        <input type="checkbox"
                                                            name="student_skill_laravel" value="laravel" id="laravel" <?=
                                                                                                                        $student_skill_laravel ?>>
                                                        <labelfor="laravel">Laravel</label>
                                                            <input type="checkbox"
                                                                name="student_skill_react_native" value="react_native" id="react_native"
                                                                <?= $student_skill_react_native ?>>
                                                            <labelfor="react_native">React
                                                                Native</label>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <br>
                    <div>
                        <inputtype="reset"value="Reset">
                            <inputtype="submit"name="submit" value="Simpan">
                    </div>
                    </form>
                    <div>
        </body>

        </html>