<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Submail{
  
    public function headers($email) {
        $headers2 = "MIME-Version: 1.1\r\n";
        $headers2 .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers2 .= "From: ".$email."\r\n"; // remetente
        $headers2 .= "Return-Path: contato@syllosdoc.com\r\n"; // return-path
      return $headers2;
    }
  
    public function email($texto="", $assunto="", $logo_menor="", $logo="", $empresa="", $nome="", $email="", $nome2="", $link="")
    {
       $novo_email = "<div width='100%' style='background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;'>
                        <div style='max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px'>
                          <table border='0' cellpadding='0' cellspacing='0' style='width: 100%; margin-bottom: 20px'>
                            <tbody>
                              <tr>
                                <td style='vertical-align: top; padding-bottom:30px;' align='center'><a href='javascript:void(0)' target='_blank'><img src='".$logo_menor."' alt='Logo' width='40' style='border:none'><br/>
                                  <img src='".$logo."' width='160' alt='logo_texto' style='border:none'></a> </td>
                              </tr>
                            </tbody>
                          </table>
                          <div style='padding: 40px; background: #fff;'>
                            <table border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
                              <tbody>
                                <tr>
                                  <td style='border-bottom:1px solid #f6f6f6;'><h1 style='font-size:14px; font-family:arial; margin:0px; font-weight:bold;'>Olá ".$nome.",</h1>
                                    <p style='margin-top:0px; color:#bbbbbb;'>".$assunto."</p></td>
                                </tr>
                                <tr>
                                  <td style='padding:10px 0 30px 0;'>
                                  ".$texto."
                                    <b>- Obrigado (Administração)</b> </td>
                                </tr>
                                <tr>
                                  <td  style='border-top:1px solid #f6f6f6; padding-top:20px; color:#777'>Se você continuar a ter problemas, entre em contato conosco pelo e-mail ".$email."</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div style='text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px'>
                            <p> ".$empresa." </p>
                          </div>
                        </div>
                      </div>";
      return $novo_email;
    }
    
    public function enviar($email, $assunto, $texto, $nome=''){
      $emailsend = "suporte@agenciaennove.com.br";
      $novo_email = "<div width='100%' style='background: #efefef; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: white;'>
                        <div style='max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px'>
                          <div style='padding: 40px; background: #ffffff;'>
                            <table border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
                              <tbody>
                                <tr>
                                  <td style='border-bottom:1px solid #888888;'>
                                  <center><img src='".site_url('assets/imagens/LOGO-ESCUDO-2.png')."' style='max-width:200px;' /></center>
                                  <h1 style='font-size:14px; font-family:arial; margin:0px; font-weight:bold;color:#888888'>Olá ".$nome.",</h1>
                                    <p style='margin-top:5px; color:#767676;'>".$assunto."</p></td>
                                </tr>
                                <tr>
                                  <td style='padding:10px 0 30px 0;color:#888888'>
                                  ".$texto."
                                </tr>
                                <tr>
                                  <td  style='border-top:1px solid #888888; padding-top:20px; color:#888888'>Se voce tiver problemas, entre em contato conosco pelo e-mail ".$emailsend."</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div style='text-align: center; font-size: 12px; color: #555555; margin-top: 20px'>
                            <p> Keroser </p>
                          </div>
                        </div>
                      </div>";
      
        //echo getcwd().'/phpmailer/class.phpmailer.php';
        require_once(getcwd().'/phpmailer/PHPMailer_5.2.4/class.phpmailer.php');
        
        
        $mail = new PHPMailer(); // create a new object
        //$mail->IsSMTP(); // enable SMTP
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        //$mail->Host = "moneybemoney.com";
        //$mail->Port = 465; // or 587
        $mail->IsHTML(true);
        //$mail->Username = "support@moneybemoney.com";
        //$mail->Password = "bemoney@2020K";
        $mail->SetFrom($emailsend);
        $mail->AddAddress($email);
        $mail->Subject = $assunto;
        $mail->Body = $novo_email;
         if(!$mail->Send()){
            //echo "Mailer Error: " . $mail->ErrorInfo;
            return false;
        }
        else{
            //echo "Message has been sent";
            return true;
        }
        
    }
    
    
    public function mostra_page($email, $assunto, $texto, $nome='', $headers = ''){
      $emailSend = "support@moneybemoney.com";
      $novo_email = "<div width='100%' style='background: black; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: white;'>
                        <div style='max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px'>
                          <div style='padding: 40px; background: #232323;'>
                            <table border='0' cellpadding='0' cellspacing='0' style='width: 100%;'>
                              <tbody>
                                <tr>
                                  <td style='border-bottom:1px solid #ffffff;'>
                                  <center><img src='".site_url('uploads/mbm.png')."' /></center>
                                  <h1 style='font-size:14px; font-family:arial; margin:0px; font-weight:bold;color:#ffffff'>Olá ".$nome.",</h1>
                                    <p style='margin-top:5px; color:#dedede;'>".$assunto."</p></td>
                                </tr>
                                <tr>
                                  <td style='padding:10px 0 30px 0;color:#ffffff'>
                                  ".$texto."
                                </tr>
                                <tr>
                                  <td  style='border-top:1px solid #f6f6f6; padding-top:20px; color:#ffffff'>Se você continuar a ter problemas, entre em contato conosco pelo e-mail ".$emailSend."</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div style='text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px'>
                            <p> Moneybemoney </p>
                          </div>
                        </div>
                      </div>";
        echo $novo_email;
        
    }
}