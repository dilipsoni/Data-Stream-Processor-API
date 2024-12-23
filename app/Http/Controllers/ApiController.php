<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    //test
    public function analyzeData(Request $request) {

        $data= $request->all();

        $stream = $data['stream'];
        $charCount = $data['k'];
        $top = $data['top'];
        $exclude = $data['exclude'];

        $str = $stream;
        $arr2 = str_split($str);
        //print_r($arr2);

        $exdata = $exclude;


        $temp = array();
        $tempf = array();


        $count = 1;
        $i = 0;
        $oldval = '';
        foreach($arr2 as $value) {
            if(!ctype_alpha($value))
                continue;

            if(!isset($temp[$value])) {
                //  echo $value;
                // exclude item which is not needed.
                $filterArrKey = '';
                for($i=0;$i<$charCount;$i++) {
                    $filterArrKey .=  $oldval;
                }

                // exculude item and only match those item according to k value.
                if(isset($temp[$oldval]) && $oldval != $value && (($temp[$oldval])%$charCount == 0) && !in_array($filterArrKey, $exdata)) {
                    if(!isset($tempf[$oldval])) {
                        $tempf[$oldval] = 1;
                    } else {
                        $tempf[$oldval]++;
                    }
                }
                unset($temp[$oldval]);
                $temp[$value] = $count;
                $oldval = $value;
            } else {
                $temp[$value]++;
            }
        }



        // make final array from last record.
        if($temp[$oldval]%$charCount == 0) {
            if(!isset($tempf[$oldval])) {
                $tempf[$oldval] = 1;
            } else {
                $tempf[$oldval]++;
            }
        }

        arsort($tempf);

        // create json array according to data
        $subArray = array();
        $dataArray = array();
        $topCount = 1;
        foreach($tempf as $key => $value) {

            // only show top according to parameter
            if($topCount>$top)
                break;

            $arrKey = '';
            for($i=0;$i<$charCount;$i++) {
                $arrKey .=  $key;
            }

            $subArray['subsequence'] =  $arrKey;
            $subArray['count'] =  $value;

            $dataArray[] = $subArray;
            $subArray = array();
            $topCount++;
        }

        $finalData['Data'] = $dataArray;
        print_r(json_encode($finalData));

    }
    
}
