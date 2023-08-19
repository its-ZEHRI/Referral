<?php

use GuzzleHttp\Client;

require __DIR__ . '/connection.php';

class getData
{

    protected $api_key;
    protected $db_conn;
    function __construct($DB_DATABASE, $DB_USERNAME, $DB_PASSWORD)
    {
        $this->db_conn = new Connection();
        $this->db_conn = $this->db_conn->connect($DB_DATABASE, $DB_USERNAME, $DB_PASSWORD);
        $this->db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function initalizeApiKey($id)
    {
        $query = "SELECT * from newForm WHERE id = ? LIMIT 1";
        $stmt = $this->db_conn->prepare($query);

        $stmt->execute(array($id));
        if ($stmt->rowCount() < 1) {
            return false;
        }
        $form_data = $stmt->fetch(PDO::FETCH_OBJ);
        $this->api_key = $form_data->company_token;
        return true;
    }

    public function getCountries()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.roadcube.io/v1/p/countries");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json",
            "X-Api-Token:" . $this->api_key
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        if ($response->code == 200) {
            return $response;
        }
        return [];
        echo "<pre>" . var_export($response, true) . "</pre>";
        return json_decode($response);

        var_dump($response);
    }

    public function initalizeUserRequest()
    {

        try {
            // echo var_export($_SESSION['user_registration_identifier']);
            // die;
            $mobile_number = $_POST['mobile'];
            $country_id = $_POST['country_id'];
            $company_id = $_POST['company_id'];

            $response = $this->initalizeApiKey($company_id);

            if (!$response) {
                return ['message' => 'company not found.'];
            }

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://api.roadcube.io/v1/p/users/registration/init");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            curl_setopt($ch, CURLOPT_POST, TRUE);

            curl_setopt($ch, CURLOPT_POSTFIELDS, "{
                \"mobile\": \"$mobile_number\",
                \"country_id\": $country_id,
                \"tos\": true,
                \"verify_mobile\": true
                }");
            // curl_setopt($ch, CURLOPT_POSTFIELDS, "{
            // \"mobile\": \"0980989234\",
            // \"country_id\": 1,
            // \"tos\": true,
            // \"verify_mobile\": true
            // }");

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Accept: application/json",
                "X-Api-Token:" . $this->api_key
            ));

            $response = curl_exec($ch);
            curl_close($ch);
            // var_dump($response);
            // die;
            $response = json_decode($response);
            // echo "<pre>". var_export($response,true). "</pre>";
            // echo "<br>";

            // var_dump($response);
            // echo "<br>";
            // var_dump($response['data']['user']);
            // die;
            // if($response->code == 200){
            //     // session_destroy();
            //     session_name('user_registration');
            //     session_start();
            //     $_SESSION['user_registration_identifier'] = $response->data->user->user_registration_identifier;
            // }

            return $response;
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }

    public function mobileVerification()
    {

        try {
            //code...

            $mobile_verification_code = $_POST['otp'];
            $user_registration_identifier = $_POST['user_registration_identifier'];
            $company_id = $_POST['company_id'];

            $response = $this->initalizeApiKey($company_id);

            if (!$response) {
                return ['message' => 'company not found.'];
            }

            // return $mobile_verification_code;
            // echo var_export($user_registration_identifier);

            // echo var_export($mobile_verification_code);
            // die;
            // if(!isset($_SESSION["user_registration_identifier"])){
            //     return ['message' => 'First call for mobile validate'];
            // }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.roadcube.io/v1/p/users/registration/mobile-verification");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            curl_setopt($ch, CURLOPT_POST, TRUE);

            curl_setopt($ch, CURLOPT_POSTFIELDS, "{
                \"user_registration_identifier\": \"osqegp-lhz9-przwn5-030946\",
                \"mobile_verification_code\": \"3700\"
                }");

            curl_setopt($ch, CURLOPT_POSTFIELDS, "{
                    \"user_registration_identifier\": \"$user_registration_identifier\",
                    \"mobile_verification_code\":\"$mobile_verification_code\"
                }");

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Accept: application/json",
                "X-Api-Token: " . $this->api_key
            ));

            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);


            return $response;
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }

    public function finalRegistration()
    {

        $user_registration_identifier = $_POST['user_registration_identifier'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $birthdate = $_POST['birthdate'];
        $gender = $_POST['gender'];
        $company_id = $_POST['company_id'];

        $response = $this->initalizeApiKey($company_id);

        if (!$response) {
            return ['message' => 'company not found.'];
        }
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.roadcube.io/v1/p/users/registration/finalize");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
            \"user_registration_identifier\": \"$user_registration_identifier\",
            \"gender\": \"$gender\",
            \"password\": \"$password\",
            \"email\": \"$email\",
            \"password_confirmation\": \"$c_password\",
            \"birthday\": \"$birthdate\",
            \"marketing\": true
            }");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json",
            "X-Api-Token: " . $this->api_key
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        return $response;

        var_dump($response);
    }

    public function getNewFormData($unique_identifier)
    {
        $query = "SELECT * from newForm WHERE unique_identifier = ? LIMIT 1";
        $stmt = $this->db_conn->prepare($query);

        $stmt->execute(array($unique_identifier));
        if ($stmt->rowCount() < 1) {
            return [];
        } else {
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }

    public function addNewFormData()
    {
        $company_token = $_POST['company_token'];
        $button_background_color = $_POST['button_background_color'];
        $button_text_color = $_POST['button_text_color'];
        $background_color = $_POST['background_color'];
        $title = $_POST['title'];
        $phone_text = $_POST['phone_text'];
        $verification_text = $_POST['verification_text'];
        $verification_btn_text = $_POST['verification_btn_text'];
        $full_name_text = $_POST['full_name_text'];
        $email_text = $_POST['email_text'];
        $birthday_text = $_POST['birthday_text'];
        $gender_text = $_POST['gender_text'];
        $birthday_text = $_POST['birthday_text'];
        $gender_text = $_POST['gender_text'];
        $gender_one_text = $_POST['gender_one_text'];
        $gender_two_text = $_POST['gender_two_text'];
        $gender_other_text = $_POST['gender_other_text'];
        $submit_btn_text = $_POST['submit_btn_text'];
        $terms_text = $_POST['terms_text'];
        $sms_popup_text = $_POST['sms_popup_text'];
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];

        $image_url = "assets/images/" . $filename;

        if (move_uploaded_file($tempname, $image_url)) {
        }

        $query = "INSERT INTO newForm(company_token, button_background_color, button_text_color, background_color, 
                                    title,image_url,phone_text, verification_text, verification_btn_text, full_name_text, 
                                    email_text, birthday_text, gender_text, gender_one_text, gender_two_text, 
                                    gender_other_text,submit_btn_text, terms_text, sms_popup_text) 
                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->db_conn->prepare($query);
        $resp = $stmt->execute(array(
            $company_token, $button_background_color, $button_text_color, $background_color,
            $title, $image_url, $phone_text, $verification_text, $verification_btn_text, $full_name_text,
            $email_text, $birthday_text, $gender_text, $gender_one_text, $gender_two_text,
            $gender_other_text, $submit_btn_text, $terms_text, $sms_popup_text
        ));

        if (!$resp) {
            return "Some error occured, please try later.";
        }
        $last_id = $this->db_conn->lastInsertId();
        echo "<pre>" . var_export($last_id, true) . "</pre>";

        $query = "UPDATE newForm SET unique_identifier = ? WHERE id = ? LIMIT 1";
        $stmt = $this->db_conn->prepare($query);
        $stmt->execute(array(10000 + $last_id, $last_id));

        $query = "SELECT * from newForm WHERE id = ? LIMIT 1";
        $stmt = $this->db_conn->prepare($query);
        $stmt->execute(array($last_id));

        if ($stmt->rowCount() < 1) {
            return [];
        } else {
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }


    public function storeReferralFormData()
    {
        $token = $_POST['token'];
        $points = $_POST['points'];
        $register_url = $_POST['register_url'];
        $text_one = $_POST['text_one'];
        $text_two = $_POST['text_two'];
        $text_three = $_POST['text_three'];
        $invite_text = $_POST['invite_text'];
        $invite_btn_text = $_POST['invite_btn_text'];
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];

        $image_url = "../assets/images/" . $filename;
        if (move_uploaded_file($tempname, $image_url)) {
        }





        $query = "INSERT INTO referral_form(token,points,register_url,image,text_one,text_two,text_three,invite_text,invite_btn_text) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $this->db_conn->prepare($query);
        $resp = $stmt->execute(array($token, $points, $register_url, $image_url, $text_one, $text_two, $text_three, $invite_text, $invite_btn_text));
        if (!$resp) {
            return "Some error occured, please try later.";
        }

        $last_id = $this->db_conn->lastInsertId();
        $query = "SELECT * from referral_form WHERE id = ? LIMIT 1";
        $stmt = $this->db_conn->prepare($query);
        $stmt->execute(array($last_id));

        if ($stmt->rowCount() < 1) {
            return [];
        } else {
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }

    public function getReferralData($id)
    {
        $query = "SELECT * from referral_form WHERE id = ? LIMIT 1";
        $stmt = $this->db_conn->prepare($query);

        $stmt->execute(array($id));
        if ($stmt->rowCount() < 1) {
            return [];
        } else {
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }


    public function invitationRequest()
    {
        $sender_number = $_POST['sender_number'];
        $receiver_number = $_POST['receiver_number'];

        $query = "SELECT * from requests WHERE receiver_number = ? LIMIT 1";
        $stmt = $this->db_conn->prepare($query);
        $stmt->execute(array($receiver_number)); 

        if ($stmt->rowCount() > 0) {
            return 'ok';
        }

        $query = "INSERT INTO requests(sender_number,receiver_number,done) VALUES(?,?,?)";
        $stmt = $this->db_conn->prepare($query);
        $resp = $stmt->execute(array($sender_number, $receiver_number, 0));
        if (!$resp) {
            return "Some error occured, please try later.";
        }
        return 'ok';
    }

    public function giveRefpoints()
    {
        $receiver_number = $_POST['receiver_number'];
        $company_id = $_POST['company_id'];

        $query = "SELECT * from requests WHERE receiver_number = ? LIMIT 1";
        $stmt = $this->db_conn->prepare($query);
        $stmt->execute(array($receiver_number));

        if($stmt->rowCount() < 1){
            return [ 
                'success' => false,
                "message" => "User are Not Invited." 
            ];
        }
        $data = $stmt->fetch(PDO::FETCH_OBJ);

        // echo "<pre>". var_export($data,true) . "</pre>";

        if($data->done == 1){
            return [ 
                'success' => false,
                "message" => "Already points added." 
            ];
        }

        $response = $this->initalizeApiKey($company_id);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.roadcube.io/v1/p/stores/store_id/transactions/new");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
            \"user\": \"$data->sender_number\",
            \"custom_points_provided\": true,
            \"custom_points\": 5
            }");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Accept: application/json",
            "X-Api-Token: ". $this->api_key
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);

        if($response->code == 200 && $response->success == 'success'){
            $query = "UPDATE requests SET done = ? WHERE receiver_number = ? LIMIT 1";
            $stmt = $this->db_conn->prepare($query);
            $stmt->execute(array(1, $receiver_number));

            return [ 
                'success' => true,
                "message" => "Points Added to user." 
            ];
        }

        return $response;
        

        var_dump($response);
    }
}
