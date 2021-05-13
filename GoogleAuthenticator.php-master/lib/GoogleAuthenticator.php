<?php
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//      http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.


include_once("FixedByteNotation.php");


class GoogleAuthenticator {
    static $PASS_CODE_LENGTH = 6;
    static $PIN_MODULO;
    static $SECRET_LENGTH = 10;
    
    public function __construct() {
        self::$PIN_MODULO = pow(10, self::$PASS_CODE_LENGTH);
    }
    
    public function checkCode($secret,$code) {
        $time = floor(time() / 30);
        for ( $i = -1; $i <= 1; $i++) {
            
            if ($this->getCode($secret,$time + $i) == $code) {
                return true;
            }
        }
        
        return false;
        
    }
  
  public function query_time_server ($timeserver, $socket)
  {
      $fp = fsockopen($timeserver,$socket,$err,$errstr,5);
          # parameters: server, socket, error code, error text, timeout
      if($fp)
      {
          fputs($fp, "\n");
          $timevalue = fread($fp, 49);
          fclose($fp); # close the connection
      }
      else
      {
          $timevalue = " ";
      }

      $ret = array();
      $ret[] = $timevalue;
      $ret[] = $err;     # error code
      $ret[] = $errstr;  # error text
      return($ret);
  } # function query_time_server

  
  public function test_timer(){
    $timeserver = "ntp.pads.ufrj.br";
    $timercvd = self::query_time_server($timeserver, 37);

    //if no error from query_time_server
    if(!$timercvd[1])
    {
      $timevalue = bin2hex($timercvd[0]);
      $timevalue = abs(HexDec('7fffffff') - HexDec($timevalue) - HexDec('7fffffff'));
      $tmestamp = $timevalue - 2208988800;
      $timevalue = bin2hex($timercvd[0]);
      $timevalue = abs(HexDec('7fffffff') - HexDec($timevalue) - HexDec('7fffffff'));
        /*
        $timevalue = bin2hex($timercvd[0]);
        $timevalue = abs(HexDec('7fffffff') - HexDec($timevalue) - HexDec('7fffffff'));
         # convert to UNIX epoch time stamp
        $datum = date("Y-m-d (D) H:i:s",$tmestamp - date("Z",$tmestamp));
        $doy = (date("z",$tmestamp)+1);

        echo "Time check from time server ",$timeserver," : [<font color=\"red\">",$timevalue,"</font>]";
        echo " (seconds since 1900-01-01 00:00.00).<br>\n";
        echo "The current date and universal time is ",$datum," UTC. ";
        echo "It is day ",$doy," of this year.<br>\n";
        echo "The unix epoch time stamp is $tmestamp.<br>\n";


        echo date("d/m/Y H:i:s", $tmestamp);
      */
      //echo time().'<br/>timestamp: '.$tmestamp.'<br/>timevalue: '.$timevalue.'<br/><br/>';
      return $tmestamp;
    }
    else
    {
        return time();
    }
  }
    
    public function getCode($secret,$time = null) {
        
        if (!$time) {
            $time = floor(self::test_timer() / 30);
        }
        $base32 = new FixedBitNotation(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', TRUE, TRUE);
        $secret = $base32->decode($secret);
        
        $time = pack("N", $time);
        $time = str_pad($time,8, chr(0), STR_PAD_LEFT);
        
        $hash = hash_hmac('sha1',$time,$secret,true);
        $offset = ord(substr($hash,-1));
        $offset = $offset & 0xF;
        
        $truncatedHash = self::hashToInt($hash, $offset) & 0x7FFFFFFF;
        $pinValue = str_pad($truncatedHash % self::$PIN_MODULO,6,"0",STR_PAD_LEFT);;
        return $pinValue;
    }
    
    protected  function hashToInt($bytes, $start) {
        $input = substr($bytes, $start, strlen($bytes) - $start);
        $val2 = unpack("N",substr($input,0,4));
        return $val2[1];
    }
    
    public function getUrl($issuer, $user, $secret, $width = 200, $height = 200) {
    //$url =  sprintf("otpauth://totp/%s:%s?secret=%s&issuer=%s", rawurlencode($issuer), $user, $secret, rawurlencode($issuer));
    //$encoder = sprintf("https://www.google.com/chart?chs=%dx%d&chld=M|0&cht=qr&chl=",$width,$height);
    //$encoderURL = sprintf( "%s%s",$encoder, rawurlencode($url));
    $url =  sprintf("otpauth://totp/%s:%s?secret=%s&issuer=%s", $issuer, $user, $secret, $issuer);
    return $url;
}
    
    public function generateSecret() {
        $secret = "";
        for($i = 1;  $i<= self::$SECRET_LENGTH;$i++) {
            $c = rand(0,255);
            $secret .= pack("c",$c);
        }
        $base32 = new FixedBitNotation(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', TRUE, TRUE);
        return  $base32->encode($secret);
        
        
    }
    
}

