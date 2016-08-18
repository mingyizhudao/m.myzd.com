<?php
Yii::app()->clientScript->registerScriptFile('http://static.mingyizhudao.com/vendor/findHospital.min.1.0.js', CClientScript::POS_END);
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

$urlHomeView = $this->createUrl('home/view');
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
        <a href="<?php echo $urlHomeView; ?>">
            <div class="pl5">
                <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
            </div>
        </a>
        <a>
            <span class="ml20 pb2 br-white"></span>
        </a>
        <a onclick="javascript:history.go(0)">
            <img src="http://static.mingyizhudao.com/146975853464574" class="w24p ml20">
        </a>
    </nav>
    <h1 class="title">
        <span id="deptTitle" class="" data-dept="">科室</span>
        <span class=""><img class="w10p" src="http://static.mingyizhudao.com/146976027712626"></span>
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
        $homeView = '<?php echo $urlHomeView; ?>';

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
                                var innerDept = '<div class="grid bg-white"><div class="col-0 font-s15 pl10 pt10 pb10 color-green">请您选择' + results[i].name + '的具体科室</div><div class="col-1 text-right"><img id="backHome" class="w11p mr10 mt15" src="http://static.mingyizhudao.com/147073995097299"></div></div><ul class="list" style="max-height:290px;overflow:scroll;" data-scroll="true">';
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
            //location.href = '<?php echo $urlHomeView; ?>';
            history.go(-1);
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
            var requestCity = '<?php echo $urlCity; ?>?has_team=0&type=hospital';
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
            var innerHtml = '<div class="color-black" data-scroll="true" style="margin-top:44px;height:315px;">';
            if (results.length > 0) {
                innerHtml += '<ul class="list" data-city="">';
                for (var i = 0; i < results.length; i++) {
                    innerHtml += '<li class="cCity" data-city="' + results[i].id + '">' + results[i].city + '</li>';
                }
                innerHtml += '</ul>';
            }
            innerHtml += '</div></div>';
            return innerHtml;
        }

    });
</script>
