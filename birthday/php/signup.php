<?php
require("config.php");
session_start();


$countryCodes = [
    "+233" => "Ghana (+233)",
    "93" => "Afghanistan (+93)",
    "355" => "Albania (+355)",
    "213" => "Algeria (+213)",
    "1684" => "American Samoa (+1684)",
    "376" => "Andorra (+376)",
    "244" => "Angola (+244)",
    "1264" => "Anguilla (+1264)",
    "672" => "Antarctica (+672)",
    "1268" => "Antigua and Barbuda (+1268)",
    "54" => "Argentina (+54)",
    "374" => "Armenia (+374)",
    "297" => "Aruba (+297)",
    "61" => "Australia (+61)",
    "43" => "Austria (+43)",
    "994" => "Azerbaijan (+994)",
    "1242" => "Bahamas (+1242)",
    "973" => "Bahrain (+973)",
    "880" => "Bangladesh (+880)",
    "1246" => "Barbados (+1246)",
    "375" => "Belarus (+375)",
    "32" => "Belgium (+32)",
    "501" => "Belize (+501)",
    "229" => "Benin (+229)",
    "1441" => "Bermuda (+1441)",
    "975" => "Bhutan (+975)",
    "591" => "Bolivia (+591)",
    "387" => "Bosnia and Herzegovina (+387)",
    "267" => "Botswana (+267)",
    "55" => "Brazil (+55)",
    "246" => "British Indian Ocean Territory (+246)",
    "1284" => "British Virgin Islands (+1284)",
    "673" => "Brunei (+673)",
    "359" => "Bulgaria (+359)",
    "226" => "Burkina Faso (+226)",
    "257" => "Burundi (+257)",
    "855" => "Cambodia (+855)",
    "237" => "Cameroon (+237)",
    "1" => "Canada (+1)",
    "238" => "Cape Verde (+238)",
    "1345" => "Cayman Islands (+1345)",
    "236" => "Central African Republic (+236)",
    "235" => "Chad (+235)",
    "56" => "Chile (+56)",
    "86" => "China (+86)",
    "+61" => "Christmas Island (+61)",
    /* "+61" => "Cocos Islands (+61)", */
    "57" => "Colombia (+57)",
    "269" => "Comoros (+269)",
    "682" => "Cook Islands (+682)",
    "506" => "Costa Rica (+506)",
    "385" => "Croatia (+385)",
    "53" => "Cuba (+53)",
    "599" => "Curacao (+599)",
    "357" => "Cyprus (+357)",
    "420" => "Czech Republic (+420)",
    "45" => "Denmark (+45)",
    "253" => "Djibouti (+253)",
    "1767" => "Dominica (+1767)",
    "1849" => "Dominican Republic (+1849)",
    "593" => "Ecuador (+593)",
    "20" => "Egypt (+20)",
    "503" => "El Salvador (+503)",
    "240" => "Equatorial Guinea (+240)",
    "291" => "Eritrea (+291)",
    "372" => "Estonia (+372)",
    "251" => "Ethiopia (+251)",
    "500" => "Falkland Islands (+500)",
    "298" => "Faroe Islands (+298)",
    "679" => "Fiji (+679)",
    "358" => "Finland (+358)",
    "33" => "France (+33)",
    "594" => "French Guiana (+594)",
    "689" => "French Polynesia (+689)",
    "241" => "Gabon (+241)",
    "220" => "Gambia (+220)",
    "995" => "Georgia (+995)",
    "49" => "Germany (+49)",
    "350" => "Gibraltar (+350)",
    "30" => "Greece (+30)",
    "299" => "Greenland (+299)",
    "1473" => "Grenada (+1473)",
    "590" => "Guadeloupe (+590)",
    "1671" => "Guam (+1671)",
    "502" => "Guatemala (+502)",
    "224" => "Guinea (+224)",
    "245" => "Guinea-Bissau (+245)",
    "592" => "Guyana (+592)",
    "509" => "Haiti (+509)",
    "504" => "Honduras (+504)",
    "852" => "Hong Kong (+852)",
    "36" => "Hungary (+36)",
    "354" => "Iceland (+354)",
    "91" => "India (+91)",
    "62" => "Indonesia (+62)",
    "98" => "Iran (+98)",
    "964" => "Iraq (+964)",
    "353" => "Ireland (+353)",
    "972" => "Israel (+972)",
    "39" => "Italy (+39)",
    "225" => "Ivory Coast (+225)",
    "1876" => "Jamaica (+1876)",
    "81" => "Japan (+81)",
    "962" => "Jordan (+962)",
    "7" => "Kazakhstan (+7)",
    "254" => "Kenya (+254)",
    "686" => "Kiribati (+686)",
    "383" => "Kosovo (+383)",
    "965" => "Kuwait (+965)",
    "996" => "Kyrgyzstan (+996)",
    "856" => "Laos (+856)",
    "371" => "Latvia (+371)",
    "961" => "Lebanon (+961)",
    "266" => "Lesotho (+266)",
    "231" => "Liberia (+231)",
    "218" => "Libya (+218)",
    "423" => "Liechtenstein (+423)",
    "370" => "Lithuania (+370)",
    "352" => "Luxembourg (+352)",
    "853" => "Macau (+853)",
    "389" => "Macedonia (+389)",
    "261" => "Madagascar (+261)",
    "265" => "Malawi (+265)",
    "60" => "Malaysia (+60)",
    "960" => "Maldives (+960)",
    "223" => "Mali (+223)",
    "356" => "Malta (+356)",
    "692" => "Marshall Islands (+692)",
    "596" => "Martinique (+596)",
    "222" => "Mauritania (+222)",
    "230" => "Mauritius (+230)",
    "262" => "Mayotte (+262)",
    "52" => "Mexico (+52)",
    "691" => "Micronesia (+691)",
    "373" => "Moldova (+373)",
    "377" => "Monaco (+377)",
    "976" => "Mongolia (+976)",
    "382" => "Montenegro (+382)",
    "1664" => "Montserrat (+1664)",
    "212" => "Morocco (+212)",
    "258" => "Mozambique (+258)",
    "95" => "Myanmar (+95)",
    "264" => "Namibia (+264)",
    "674" => "Nauru (+674)",
    "977" => "Nepal (+977)",
    "31" => "Netherlands (+31)",
    "687" => "New Caledonia (+687)",
    "64" => "New Zealand (+64)",
    "505" => "Nicaragua (+505)",
    "227" => "Niger (+227)",
    "234" => "Nigeria (+234)",
    "683" => "Niue (+683)",
    "850" => "North Korea (+850)",
    "1670" => "Northern Mariana Islands (+1670)",
    "47" => "Norway (+47)",
    "968" => "Oman (+968)",
    "92" => "Pakistan (+92)",
    "680" => "Palau (+680)",
    "970" => "Palestine (+970)",
    "507" => "Panama (+507)",
    "675" => "Papua New Guinea (+675)",
    "595" => "Paraguay (+595)",
    "51" => "Peru (+51)",
    "63" => "Philippines (+63)",
    "48" => "Poland (+48)",
    "351" => "Portugal (+351)",
    "1787" => "Puerto Rico (+1787)",
    "974" => "Qatar (+974)",
    "242" => "Republic of the Congo (+242)",
    "+262" => "Reunion (+262)",
    "40" => "Romania (+40)",
    "+7" => "Russia (+7)",
    "250" => "Rwanda (+250)",
    "290" => "Saint Helena (+290)",
    "1869" => "Saint Kitts and Nevis (+1869)",
    "1758" => "Saint Lucia (+1758)",
    "508" => "Saint Pierre and Miquelon (+508)",
    "1784" => "Saint Vincent and the Grenadines (+1784)",
    "685" => "Samoa (+685)",
    "378" => "San Marino (+378)",
    "239" => "Sao Tome and Principe (+239)",
    "966" => "Saudi Arabia (+966)",
    "221" => "Senegal (+221)",
    "381" => "Serbia (+381)",
    "248" => "Seychelles (+248)",
    "232" => "Sierra Leone (+232)",
    "65" => "Singapore (+65)",
    "1721" => "Sint Maarten (+1721)",
    "421" => "Slovakia (+421)",
    "386" => "Slovenia (+386)",
    "677" => "Solomon Islands (+677)",
    "252" => "Somalia (+252)",
    "27" => "South Africa (+27)",
    "82" => "South Korea (+82)",
    "211" => "South Sudan (+211)",
    "34" => "Spain (+34)",
    "94" => "Sri Lanka (+94)",
    "249" => "Sudan (+249)",
    "597" => "Suriname (+597)",
    "268" => "Swaziland (+268)",
    "46" => "Sweden (+46)",
    "41" => "Switzerland (+41)",
    "963" => "Syria (+963)",
    "886" => "Taiwan (+886)",
    "992" => "Tajikistan (+992)",
    "255" => "Tanzania (+255)",
    "66" => "Thailand (+66)",
    "228" => "Togo (+228)",
    "690" => "Tokelau (+690)",
    "676" => "Tonga (+676)",
    "1868" => "Trinidad and Tobago (+1868)",
    "216" => "Tunisia (+216)",
    "90" => "Turkey (+90)",
    "993" => "Turkmenistan (+993)",
    "1649" => "Turks and Caicos Islands (+1649)",
    "688" => "Tuvalu (+688)",
    "256" => "Uganda (+256)",
    "380" => "Ukraine (+380)",
    "971" => "United Arab Emirates (+971)",
    "44" => "United Kingdom (+44)",
    "+1" => "United States (+1)",
    "598" => "Uruguay (+598)",
    "998" => "Uzbekistan (+998)",
    "678" => "Vanuatu (+678)",
    "379" => "Vatican (+379)",
    "58" => "Venezuela (+58)",
    "84" => "Vietnam (+84)",
    "+1284" => "British Virgin Islands (+1284)",
    "1340" => "U.S. Virgin Islands (+1340)",
    "681" => "Wallis and Futuna (+681)",
    "+212" => "Western Sahara (+212)",
    "967" => "Yemen (+967)",
    "260" => "Zambia (+260)",
    "263" => "Zimbabwe (+263)"
];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["fname"], $_POST["lname"], $_POST["uname"], $_POST["dob"], $_POST["cntcd"], $_POST["phone"], $_POST["password"])) {
        $firstname = $conn->real_escape_string($_POST["fname"]);
        $lastname = $conn->real_escape_string($_POST["lname"]);
        $username = $conn->real_escape_string($_POST["uname"]);
        $dob = $conn->real_escape_string($_POST["dob"]);
        $country_code = ($_POST["cntcd"]);
        $phone = $conn->real_escape_string($_POST["phone"]);
        $password = $conn->real_escape_string($_POST["password"]);

        $dob_calc_age = strtotime($dob);
        $age = date("Y") - date("Y",$dob_calc_age);

        $data = "fname=".$firstname."&uname=".$username."&lname=".$lastname."&dob=".$dob."&cntcd=".$country_code."&phone=".$phone."&password=".$password;
        // Check if the password length is at least 8 characters
        if (strlen($password) < 8) {
            // echo "<script>
            //         alert('Password must be at least 8 characters long');
            //         window.location.href = '../index.php';
            //       </script>";
            // exit();

            $em = "Password must be at least 8 characters long";
               header("Location: ../index.php?error=$em&$data");
               exit;
        }


        // Check if the user already exists
        $checkUserQuery = "SELECT ru_id FROM registered_users WHERE ru_name = ?";
        $stmt = $conn->prepare($checkUserQuery);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // User already exists 
            // echo "<script>
            //         alert('Username already taken');
            //         window.location.href = '../index.php';
            //       </script>";
            $em = "Username already taken";
               header("Location: ../index.php?error=$em&$data");
               exit;
            }
        if (strlen($phone) != 10) {
            // User already exists 
            // echo "<script>
            //         alert('Username already taken');
            //         window.location.href = '../index.php';
            //       </script>";
            $em = "Phone number must be 10 digits starting from 0";
               header("Location: ../index.php?error=$em&$data");
               exit;
        } 
        if ($age < 10) {
            // User already exists 
            // echo "<script>
            //         alert('Username already taken');
            //         window.location.href = '../index.php';
            //       </script>";
            $em = "You are too young";
               header("Location: ../index.php?error=$em&$data");
               exit;
        } else {
            // User does not exist, proceed with registration
            $HashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sqlinsert = "INSERT INTO registered_users (ruf_name, rul_name, ru_name, ru_dob, ru_cntcode, ru_pnum, ru_pass)
                          VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->stmt_init();
            $stmt = $conn->prepare($sqlinsert);
            $stmt->bind_param('sssssis', $firstname, $lastname, $username, $dob, $country_code, $phone, $HashedPassword);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // $_SESSION['message'] = "Registered successfully";
                // $_SESSION['']
                // header("Location: ../index.php");
                $passretrieval = "SELECT ru_id FROM registered_users WHERE ru_name = '$username'";
                $result = $conn -> query($passretrieval);
                if($result && $result -> num_rows > 0){
                    $row = $result -> fetch_assoc();
                    $user_id = $row["ru_id"];
                    $_SESSION["user id"]= $user_id;
                    $_SESSION["username"]= $username;
                    $_SESSION['countrycodes'] = $countryCodes;
                    $_SESSION['message'] =  "You are  logged in successfully ".$username;
                    header("Location: user_account.php");
                exit();
            } else {
                echo "Problem with code: " . $conn->error;
            }
        }
    } 
}
}
?>
