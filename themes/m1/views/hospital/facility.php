<?php
$this->setPageID('pHospitalIndex');
$this->setPageTitle('专属医院');
?>

<div data-role="page" id="<?php echo $this->getPageID(); ?>" data-title="<?php echo $this->getPageTitle(); ?>" data-nav-rel="#f-nav-2">
    <div data-role="content" class="ui-content">
        <p>我们合作医院的病房干净，整洁，同时可以为病人提供最全面细致的服务。以下是部分病房，供您参考：</p>
        <div class="">
            <ul data-role="listview" data-inset="false" class="multipage-nav">
                <li>
                    <a href="#pHospitalIndex-1" data-prefetch="true" data-transition="slide">
                        <h3>专业服务</h3>                      
                    </a>                       
                </li>
                <li>
                    <a href="#pHospitalIndex-2" data-prefetch="true" data-transition="slide">
                        <h3>普通病房</h3>                      
                    </a>                       
                </li>
                <li>
                    <a href="#pHospitalIndex-3" data-prefetch="true" data-transition="slide">
                        <h3>贵宾病房</h3>                      
                    </a>                       
                </li>
            </ul>
        </div>

    </div><!-- /content -->

    <!-- Using jquery.mobile.subpage.js -->
    <div data-role="subpage" id="pHospitalIndex-1" data-title="专业服务" data-nav-rel="#f-nav-2" data-add-back-btn="true">
        <div data-role="content" class="ui-content">
            <h3>专业服务</h3>
            <p>从您选择我们的医生和医院起，我们将竭诚为您服务，用专业的服务态度，高超的医疗技术，为您营造最舒适的治疗环境，如家一般的感觉。</p>
        </div>
    </div>
    <div data-role="subpage" id="pHospitalIndex-2" data-title="普通病房" data-nav-rel="#f-nav-2" data-add-back-btn="true">
        <div data-role="content" class="ui-content">
            <h3>普通病房</h3>
            <p>普通病房，宽敞安静，房间采光充足，基础设施完善，患者间还能聊聊家常，排忧解闷。单人病房为患者提供更加舒适的私人空间和专属服务，时时感受温暖和关护。</p>
        </div>
    </div>
    <div data-role="subpage" id="pHospitalIndex-3" data-title="贵宾病房" data-nav-rel="#f-nav-2" data-add-back-btn="true">
        <div data-role="content" class="ui-content">
            <h3>贵宾病房</h3>
            <p>贵宾病房</p>
        </div>
    </div>
</div>