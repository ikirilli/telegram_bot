<?php
class WriteLogs
{
    public function mlog($bool_log, $arr = null) {
        $str = '';
        if ($bool_log) {
            $File = 'logs/logs_'.date('Y.m.d', time()).'.log';
            $Handle = fopen($File, 'a');
    
            $location = "\n".'- location = ('.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].")\n" ;
            // $datetime = date("Y-m-d H:i:s", time())."\n";
            $datetime = date("Y-m-d H:i:s", time()+3*60*60)."\n"; // for our timezone +3 hour  
            if (is_array($arr)) {
                foreach ($arr as $key => $v) {
                    if (is_array($v)) {
                        foreach ($v as $v_key => $vv) {
                            if (is_array($vv)) {
                                foreach ($vv as $v3_key => $v3) {
                                    $str .= '- '.$key.'->'.$v_key.'->'.$v3_key.' = ' . $v3."\n" ;
                                }
                            } else  $str .= '- '.$key.'->'.$v_key.' = ' . $vv ."\n";
                        }
                    } else $str .= '- '.$key.' = ' . $v ."\n";
                }
                
            } else $str = '- val = ' . $arr."\n"; 
            
            $str = $location.$datetime.$str;
            $str .= "\n******************* Close ****************\n";
            fwrite($Handle, $str);
            fclose($Handle);
        }
    }
}
