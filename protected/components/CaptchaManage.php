<?php

class CaptchaManage
{
    private $width;
    private $height;
    private $codeNum;
    private $code;
    private $im;
    //add by wanglei
    //wap标志
    private $wap;
    //image信息
    private $image;
    //答案
    private $replay;
    function __construct($width=125, $height=26, $codeNum=6,$wap="")
    {
        $this->width = $width;
        $this->height = $height;
        $this->codeNum = $codeNum;
        $this->wap=$wap;
        $this->image=new stdClass();
        ob_clean();
    }
    public function showImg()
    {
        //创建图片
        $this->createImg();
        //设置干扰元素
        //$this->setDisturb();
        //设置验证码
        $this->setCaptcha();
        //输出图片
        if($this->wap){
            $this->outputcontent();
            $this->image->code=$this->replay;
            return $this->image;
        }
        else{
            $this->outputImg();
        }
    }

    public function getCaptcha()
    {
        return $this->code;
    }

    private function createImg()
    {
        $this->im = imagecreatetruecolor($this->width, $this->height);
        $bgColor = imagecolorallocate($this->im, 255, 255, 255);
        imagefill($this->im, 0, 0, $bgColor);
    }

    private function setDisturb()
    {
        $area = ($this->width * $this->height) / 20;
        $disturbNum = ($area > 250) ? 250 : $area;
        //加入点干扰
        for ($i = 0; $i < $disturbNum; $i++) {
            $color = imagecolorallocate($this->im, rand(0, 255), rand(0, 255), rand(0, 255));
            imagesetpixel($this->im, rand(1, $this->width - 2), rand(1, $this->height - 2), $color);
        }
        //加入弧线
        for ($i = 0; $i <= 5; $i++) {
            $color = imagecolorallocate($this->im, rand(128, 255), rand(125, 255), rand(100, 255));
            imagearc($this->im, rand(0, $this->width), rand(0, $this->height), rand(30, 300), rand(20, 200), 50, 30, $color);
        }
    }

    private function createCode()
    {
        $this->code = $this->createArithmeticExpressionCode();
    }

    private function createStrCode()
    {
        $code = '';
        $str = "0123456789";
        for ($i = 0; $i < $this->codeNum; $i++) {
            $code .= $str{rand(0, strlen($str) - 1)};
        }
        if($this->wap){
             $this->replay= $code;
             
        }
        else{
             Yii::app()->session['code'] = $code;
        }
        return $code;
    }

    private function createArithmeticExpressionCode()
    {
        //$str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ";

        $mode = rand(1,9999) % 4;
        $code = '';
        $left_num = rand(1,10);
        $right_num = rand(1,10);

        if (0 == $mode)
        {
            $oper = '+';
            $result = $left_num + $right_num;
            $code = $left_num.$oper.$right_num;
            $code = $code.'=?';
        }
        else if (1 == $mode)
        {
            $oper = '-';
            if($left_num > $right_num)
            {
                $result = $left_num - $right_num;
                $code = $left_num.$oper.$right_num;
            }
            else
            {
                $result = $right_num - $left_num;
                $code = $right_num.$oper.$left_num;
            }
            $code = $code.'=?';
        }
        else if (2 == $mode)
        {
            $mid_num = rand(1,10);
            $oper = '+';
            //$result = $left_num + $mid_num + $right_num;
            //$code = $left_num.$oper.$mid_num.$oper.$right_num;
            //$code = $code.'=?';

            if($left_num > $right_num)
            {
                $result = $left_num - $right_num;
                $code = $right_num.$oper.'?='.$left_num;
            }
            else
            {
                $result = $right_num - $left_num;
                $code = $left_num.$oper.'?='.$right_num;
            }
        }
        else
        {
            $left_num = rand(1,9);
            $right_num = rand(1,9);
            $oper = '-';
            $mid_num = rand(20,99);
            $result = $mid_num - $left_num - $right_num;
            $code = $mid_num.$oper.$left_num.$oper.$right_num;
            $code = $code.'=?';
        } 
        if($this->wap){
             $this->replay= $result;
        }
        else{
             Yii::app()->session['code'] = $result;
        }

        return $code;
    }

    private function setCaptcha()
    {
        $this->createCode();
        $len = strlen($this->code);
        for ($i = 0; $i < $len; $i++) 
        {
            $color = imagecolorallocate($this->im, 36, 85, 170);
            $size = 16;
            $angle = 2;//倾斜度
            $x = floor($this->width / $len) * $i + 6;
            $y = rand($this->height-5,$this->height);
            imagettftext($this->im, $size, $angle, $x, $y, $color, dirname(__FILE__).'/Fat-Legs-Out.ttf', $this->code{$i});
        }
    }

    private function outputImg()
    {
        if (imagetypes() & IMG_JPG) {
            header('Content-type:image/jpeg');
            imagejpeg($this->im);
        } elseif (imagetypes() & IMG_GIF) {
            header('Content-type: image/gif');
            imagegif($this->im);
        } elseif (imagetypes() & IMG_PNG) {
            header('Content-type: image/png');
            imagepng($this->im);
        } else {
            die("Don't support image type!");
        }
    }
    //生成图片
    private function outputcontent(){
        $filepath="upload/captcha/";
        $imagesrc=new stdClass();
       if (imagetypes() & IMG_JPG) {
            $filearray=$this->getfilename($filepath,"jpg");
            $imagesrc->src=$filearray['src'];
            imagejpeg($this->im,$filearray['filesrc'],100);
        } elseif (imagetypes() & IMG_GIF) {
            $filearray=$this->getfilename($filepath,"gif");
            $imagesrc->src=$filearray['src'];
            imagegif($this->im,$filearray['filesrc'],1000);
        } elseif (imagetypes() & IMG_PNG) {
            $filearray=$this->getfilename($filepath,"png");
            $imagesrc->src=$filearray['src'];
            imagepng($this->im,$filearray['filesrc'],1000);
        } else {
            die("Don't support image type!");
        }
        $this->image=$imagesrc;
        
    }
    //图片处理
    private function getfilename($filepath,$ext){
        $filename['filename']=$filepath.time().rand(1,100).".".$ext;
        $filename['filesrc']=Yii::app()->basePath.'/../'.$filename['filename'];
        $filename['src']="/".$filename['filename'];
        return $filename;
    }

}