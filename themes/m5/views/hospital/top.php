<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/custom/findHospital.js?ts=' . time(), CClientScript::POS_END);
?>
<?php
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$city = Yii::app()->request->getQuery('city', '');
$innerDeptId = Yii::app()->request->getQuery('innerDeptId', '');
$disease = Yii::app()->request->getQuery('disease', '');
$disease_name = Yii::app()->request->getQuery('disease_name', '');
$disease_category = Yii::app()->request->getQuery('disease_category', '');
$disease_sub_category = Yii::app()->request->getQuery('disease_sub_category', '');
$page = Yii::app()->request->getQuery('page', '');

$urlHomeIndex = $this->createUrl('home/index');
$urlHospitalTop = $this->createUrl('hospital/top');
$urlDepartmentView = $this->createUrl('department/view', array('id' => ''));
$urlCity = $this->createAbsoluteUrl('/api/city');
$urlHospital = $this->createAbsoluteUrl('/api/hospital', array('api' => 7));
$urlDiseasecategory = $this->createAbsoluteUrl('/api/diseasecategory', array('api' => 7));
$urlDisease = $this->createAbsoluteUrl('/api/diseasebycategory');
$this->show_footer = false;
?>
<header id="findDept_header" class="bg-green">
    <nav class="left">
        <a href="<?php echo $urlHomeIndex; ?>">
            <div class="pl5">
                <img src="<?php echo $urlResImage; ?>back.png" class="w11p">
            </div>
        </a>
        <a>
            <span class="ml20 pb2 br-white"></span>
        </a>
        <a onclick="javascript:history.go(0)">
            <img src="<?php echo $urlResImage; ?>refresh.png" class="w24p ml20">
        </a>
    </nav>
    <h1 class="title">
        <span id="deptTitle" class="" data-dept="">科室</span>
        <span class=""><img class="w10p" src="<?php echo $urlResImage; ?>triangleWhite.png"></span>
    </h1>
    <nav id="selectCity" class="right">
        <div class="grid mt17">
            <div class="font-s16 col-0" id="cityTitle" data-city="">
                地区
            </div>
            <div class="col-0 cityImg"></div>
        </div>
    </nav>
</header>
<article id="findDept_article" class="active" data-scroll="true">
    <div id="hospitalPage">
    </div>
</article>

<script>
    $(document).ready(function () {
        //返回首页
        $homeIndex = '<?php echo $urlHomeIndex; ?>';

        $innerDeptId = '<?php echo $innerDeptId; ?>';
        $diseaseData = '';
        $deptHtml = '';
        var urlloadDiseaseCategory = '<?php echo $urlDiseasecategory; ?>';
        $.ajax({
            url: urlloadDiseaseCategory,
            async: false,
            success: function (data) {
                //console.log(data);
                $diseaseData = data;
                var results = data.results;
                if ($innerDeptId != '') {
                    if (results.length > 0) {
                        for (var i = 0; i < results.length; i++) {
                            if ($innerDeptId == results[i].id) {
                                var innerDept = '<div class="grid bg-white"><div class="col-0 font-s15 pl10 pt10 pb10 color-green">请您选择' + results[i].name + '的具体科室</div><div class="col-1 text-right"><img id="backHome" class="w11p mr10 mt15" src="<?php echo $urlResImage; ?>closeBlack.png"></div></div><ul class="list" style="max-height:290px;overflow:scroll;" data-scroll="true">';
                                var subCat = results[i].subCat;
                                //console.log(subCat);
                                if (subCat.length > 0) {
                                    for (var j = 0; j < subCat.length; j++) {
                                        innerDept += '<li class="selectDept" data-dept="' + subCat[j].id + '">' + subCat[j].name + '</li>';
                                    }
                                }
                                innerDept += '</ul>';
                                J.customAlert(innerDept);
                                return;
                            }
                        }
                    }
                } else {
                    ready('', '科室');
                }
            }
        });

        $('#backHome').click(function (e) {
            e.preventDefault();
            location.href = '<?php echo $urlHomeIndex; ?>';
        });

        //选择二级科室
        $('.selectDept').click(function (e) {
            e.preventDefault();
            ready($(this).attr('data-dept'), $(this).html());
        });

        //ready();
        function ready(readyDeptId, readyDeptName) {
            //请求医生
            $requestHospital = '<?php echo $urlHospital; ?>';
            $requestHospitalTop = '<?php echo $urlHospitalTop; ?>';

            $requestDepartment = '<?php echo $urlDepartmentView; ?>';

            $condition = new Array();
            $condition["city"] = '<?php echo $city ?>';
            $condition["innerDeptId"] = '<?php echo $innerDeptId; ?>';
            $condition["disease"] = '<?php echo $disease; ?>';
            $condition["disease_name"] = '<?php echo $disease_name; ?>';
            $condition["disease_category"] = '<?php echo $disease_category; ?>';
            $condition["disease_sub_category"] = readyDeptId;
            $condition["page"] = '<?php echo $page == '' ? 1 : $page; ?>';

            //首次进入，更新科室
            readyDeptName = readyDeptName.length > 5 ? readyDeptName.substr(0, 4) + '...' : readyDeptName;
            $('#deptTitle').html(readyDeptName);
            $('#deptTitle').attr('data-dept', readyDeptId);
            //获取医院信息
            J.showMask();
            $.ajax({
                url: '<?php echo $urlHospital; ?>' + setUrlCondition() + '&getcount=1',
                success: function (data) {
                    //console.log(data);
                    readyHospital(data);
                    setLocationUrl();
                }
            });

            $deptId = readyDeptId;
            $deptName = readyDeptName;

            //ajax异步加载科室
            //$deptHtml = readyDept(diseaseData);

            //ajax异步加载地区
            $cityHtml = ''
            var requestCity = '<?php echo $urlCity; ?>?has_team=0';
            $.ajax({
                url: requestCity,
                success: function (data) {
                    //console.log(data);
                    $cityHtml = readyCity(data);
                }
            });
        }

        function readyCity(data) {
            var results = data.results;
            var innerHtml = '<div class="grid color-black" style="margin-top:43px;height:315px;">' +
                    '<div id="leftCity" class="col-1 w50" data-scroll="true" style="height:315px;width: 50%;">' +
                    '<ul class="list">';
            if (results.length > 0) {
                for (var i = 0; i < results.length; i++) {
                    //第一个为白色
                    if (i == 0) {
                        innerHtml += '<li class="aCity bg-white" data-city="' + results[i].id + '">' + results[i].state + '</li>';
                    } else {
                        innerHtml += '<li class="aCity" data-city="' + results[i].id + '">' + results[i].state + '</li>';
                    }
                }
                innerHtml += '</ul></div><div id="rightCity" class="col-1 w50" data-scroll="true" data- style="height:315px;">'
                for (var i = 0; i < results.length; i++) {
                    var subCat = results[i].subCity;
                    //第一个不隐藏
                    if (i == 0) {
                        innerHtml += '<ul class="bCity list" data-city="' + results[i].id + '">';
                    } else {
                        innerHtml += '<ul class="bCity list hide" data-city="' + results[i].id + '">';
                    }
                    if (subCat.length > 0) {
                        for (var j = 0; j < subCat.length; j++) {
                            innerHtml += '<li class="cCity" data-city="' + subCat[j].id + '">' + subCat[j].city + '</li>';
                        }
                    }
                    innerHtml += '</ul>';
                }
            }
            innerHtml += '</div></div>';
            return innerHtml;
        }

    });
</script>
