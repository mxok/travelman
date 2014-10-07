<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-6-11
 * Time: 下午1:22
 */
//合并且排序
class MSortMerge {



  public   function  mergeSort($first=array(),$second=array(),$attribute=''){
        $key=0;
        $c=0;
        $d=0;
        $temp=array();
        for($a=0;$a<count($first);$a++){
            for($b=$c;$b<count($second);$b++){
                if($first[$a]['creatTime']<=$second[$b]['creatTime']){
                    $d++;
                    $temp[$key]=$first[$a];
                    $key++;
                    break;
                }
                else{
                    $c++;
                    $temp[$key]=$second[$b];
                    $key++;

                }

            }
        }

        if($first[$d-1]<=$second[$c-1]){
            for($d;$d<count($first);$d++){
                array_push($temp, $first[$d]);
            }
        }
        else{
            for($b;$b<count($second);$b++){
                array_push($temp, $second[$b]);
            }
        }
        return $temp;

    }




}