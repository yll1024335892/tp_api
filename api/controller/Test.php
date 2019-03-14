<?php
/**
 * Created by 深圳市阿翼互联网有限公司.
 * User: yinliangliang
 * Date: 2019/3/14
 * Time: 22:36
 * file: Test.php
 * email:yll1024335892@163.com
 */

namespace app\api\controller;


use app\api\common\lib\IAuth;
use app\api\common\lib\Aes;

class Test extends Common
{
    public function index(){
        echo "wefwf";
    }

    public function save(){

//        $str="id=1&ms=45&username=singwa";
//        $str1="gurMD9Dn9cFipNUjgbxnvZGM2VFHbh1qpVetgmvvSFQ=";
//        $str2="Z3VyTUQ5RG45Y0ZpcE5VamdieG52WkdNMlZGSGJoMXFwVmV0Z212dlNGUT0=";
//        echo (new Aes())->decrypt($str1); exit();

        $data=[
            'did'=>'12345',
            'version'=>1,
        ];
        $str="OWgvUkFESlZGeERyTHBkUTlwWE1SMjJVK2Y3dlVSN2c0KzVPdHJoRTFQWT0=";
        echo (new Aes())->decrypt($str);
      //  var_dump(IAuth::setSign($data)) ;

      //  echo (new Aes())->encrypt($str); exit;
        //var_dump(input('post.'));
       // return show(1, 'OK', (new Aes())->encrypt(json_encode(input('post.'))), 201);
    }
}