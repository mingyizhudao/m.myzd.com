<?php
$this->setPageTitle('江北三星集团');
$showHeader = Yii::app()->request->getQuery('header', 1);
$urlResImage = Yii::app()->theme->baseUrl . "/images/";
$urlDoctorView = $this->createAbsoluteUrl('doctor/view').'/id';
$this->show_footer = false;
?>
<style>
  #medicalSevice_article .color-z2{color: #7b71b0;}
</style>
<?php if ($showHeader == 1) { ?>
    <header class="bg-green">
        <nav class="left">
            <a href="" data-target="back">
                <div class="pl5">
                    <img src="http://static.mingyizhudao.com/146975795218858" class="w11p">
                </div>
            </a>
        </nav>
        <div class="title">江北三星集团</div>
        <nav class="right">
            <a onclick="javascript:location.reload()">
                <img src="http://static.mingyizhudao.com/146975853464574"  class="w24p">
            </a>
        </nav>
    </header>
<?php } ?>
<article id="medicalSevice_article" class="active" data-scroll="true">
    <div class="mb50">
        <div>
            <img src="http://static.mingyizhudao.com/147505375737374" class="w100">
        </div>
        
        <div class="pl10 pr10 mt20">
            <div class="color-black">
                <div class="titleBg font-s18  color-white font-w800 pl5">
                   江北三星医院综合体检中心
                </div>
                <div class="text-indent-2 mt10 text-justify">
                   <span class="font-w800">最早和最佳</span>——延续韩国最早的声誉，发展成为世界最佳体检中心
                </div>
                <div class="text-indent-2 mt10 text-justify">
                   1968年开院的江北三星医院作为三星集团的一员，以技术及服务革新为基础，五十多年来，为医疗技术的发展做出了贡献。 
                </div>
                <div class="text-indent-2 mt10 text-justify">
                  1981年，最早将综合体检概念引入韩国，各领域专业医疗团队通过尖端医疗设备，提供最佳健康管理服务。江北三星医院综合体检中心作为韩国最早、最大的体检中心，实现着预防疾病及国民的健康管理，不断开启医学的未来。  
                </div>
                <div class="fontblack1 font-s12 text-center">
                  请在wifi环境下播放
                </div>
                <div >
                    <video width="300"  controls>
                    <source src="http://static.mingyizhudao.com/pc/samsungHospital.mp4" type="video/mp4">
                    </video>
                </div>
                <div class="text-center color-z font-s9">
                    江北三星医院综合体检中心宣传片
                </div>

                <div class="tupl mt20 ">
                   <img src="http://static.mingyizhudao.com/14750556427617" class="w15p"> 
                   <span class=" color-z font-s15">韩国最早、最大的体检中心</span>
                </div>
                <div class="font-w800 ml20 text-justify">
                   亮点一  是韩国最早、最大的体检中心，具备优秀的技术和服务实力。 
                </div>
                <div class="ml20 mt10 ">
                    <div class="pull-left pr10" >
                     <img src="http://static.mingyizhudao.com/147505868649683" width="120">   
                    </div>
                    <div class="text-indent-1 text-justify">
                     依靠三星集团的技术及服务实力，提供最上乘的医疗服务。   
                    </div>
                    <div class="text-indent-1 text-justify">
                       江北三星医院综合体检中心作为价值得到世界公认的三星集团的一员，共享着集团的实力。
                    </div>
                    <div class="text-indent-2 text-justify">
                        1981年，最早将综合体检概念引入韩国，开展体检服务。目前，具备有韩国最大规模的设施，保有最多的体检顾客。今后，将依靠持续开展医疗技术及服务革新，不断积累顾客的信赖。
                    </div>
                 </div>

                 <div class="tupl mt20 ">
                   <img src="http://static.mingyizhudao.com/14750556427617" class="w15p"> 
                   <span class=" color-z font-s15">最尖端检查设备</span>
                </div>
                 <div class="font-w800 ml20 text-justify">
                   亮点二  依靠最尖端医疗设备和先进医疗系统，实现快速、精确的体检。
                </div>
                 <div class="ml20 mt10 ">
                    <div class="pull-left pr10" >
                     <img src="http://static.mingyizhudao.com/147505994600558" width="120">   
                    </div>
                    <div class="text-indent-1 text-justify ">
                     使用最尖端医疗设备，更快、更准确地进行体检，为顾客的健康负责。   
                    </div>
                    <div class="text-indent-1 text-justify ">
                       江北三星医院综合体检中心引进癌症诊断设备——PET-CT，对肿瘤、脑部疾病及心脏疾病等进行更精密的检查，还具备脑肿瘤、脑梗死、脑动脉瘤、脑血管狭窄等的诊断率较高的MRI；提供腹部脏器的立体影像；提高检查精确性的MDCT；可对多种脏器的构造、移动及血流等进行精密检查的超声波设备等。
                    </div>
                 </div>

                 <div class="tupl mt20 ">
                   <img src="http://static.mingyizhudao.com/14750556427617" class="w15p"> 
                   <span class=" color-z font-s15">各领域最佳专业医疗团队，一站式诊疗</span>
                </div>
                <div class="font-w800 ml20 text-justify">
                   亮点三  拥有各领域最佳专业医疗团队，一站式诊疗 
                </div>
                 <div class="ml20 mt10 ">
                    <div class="pull-left pr10" >
                     <img src="http://static.mingyizhudao.com/147505992695474" width="120">   
                    </div>
                    <div class="text-indent-1 text-justify">
                     实力优秀的专业医疗团队提高体检的质量。
                    </div>
                    <div class="text-indent-1 text-justify">
                       江北三星医院综合体检中心综合管理各分科具有十年以上丰富经验的专业医疗团队。由此，通过精确的诊断和细致的咨询，致力于早期发现疾病。
                    </div>
                    <div class="text-indent-2 text-justify">
                      同时，由医生、护士、营养师和临床心理医生提供综合健康咨询。综合体检中心还与江北三星医院合作，从体检后分析到治疗，提供一站式诊疗服务。
                    </div class="text-indent-1 text-justify">
                  </div>

                  <div class="tupl mt20 ">
                   <img src="http://static.mingyizhudao.com/14750556427617" class="w15p"> 
                   <span class=" color-z font-s15">与约翰霍普金斯大学 签订谅解备忘录</span>
                 </div>
                 <div class="font-w800 ml20 text-justify">
                   亮点四  成为世界第一研究机构——约翰霍普金斯大学在亚洲的唯一的合作伙伴，向着世界综合体检中心的目标不断飞跃。
                 </div>
                 <div class="ml20 mt10 ">
                    <div class="pull-left pr10" >
                     <img src="http://static.mingyizhudao.com/147506060803435" width="120">   
                    </div>
                    <div class="text-indent-1 text-justify ">
                     通过与世界级研究机构开展合作，提供最佳医疗服务。
                    </div>
                    <div class="text-indent-1 text-justify ">
                       江北三星医院综合体检中心作为世界第一研究机构——约翰霍普金斯大学选择的健康体检领域唯一的合作伙伴，问诊、检查、诊断、结果、评价等所有体检系统都具备了全球标准化，提供体系化的体检服务。此外，与海外学者一起举行研讨会等，地位获得了世界认可。江北三星医院综合体检中心与世界一起开展研究，立志提供不断发展的服务。 
                    </div>
                 </div>
         </div>
         <div class="fontblack1 mt20">
             <div class="titleBg font-s18  color-white font-w800 pl5">
                   江北三星医院综合体检中心
             </div>
             <div style="background:#eee; "class="pb10">
             <div class="mt10 grid choose ">
                <div class="col-1 select active w33 font-s15 "data-select="1"data-active=1>
                    <div class="text-center mt5 mb5 color-green1 "style="border-right:1px solid #52bfb4;">套餐一</div>
                </div> 
                <div class="col-1 select w33 font-s15 "data-select="2"id="select1">
                    <div class="text-center mt5 mb5 color-green1"style="border-right:1px solid #52bfb4;">套餐二</div>
                </div> 
                <div class="col-1 select w33 font-s15"data-select="3">
                    <div class="text-center mt5 mb5 color-green1">套餐三</div>
                </div> 
            </div>
            <div class="mt10 pl10 pr10 plan"data-choose="1">
                <div class="color-z2 font-w800">套餐一  全面体检项目</div>
                <div>1. 价格：¥22,500</div>
                <div>2. 时间：行程三天两夜，一天体检。</div>
                <div>3. 体检地点：江北三星医院首尔综合体检中心</div>
                <div>4. 体检项目<span class="color-green1">（基础项目 ＋ 附加项目）</span>：</div>
                <div class="color-green1">-基础项目</div>
                <div class="text-justify">
                   咨询国际诊疗专家, 身体测量及肥胖度(身高, 体重, 体重指数, 腰围, 肌肉量, 体内脂肪量, 体内脂肪比例, 腹部脂肪量), 肺功能检查, 听力检查, 胸部X光检查, 血液检查(包括贫血, 肾功能, 肝功能, 免疫功能, 肿瘤指标, 心脑血管, 糖尿病, 甲状腺等共67种血液检查), 尿液及粪便检查, 眼科检查(视力, 眼压, 眼底检查), 心电图及血压检测, 胃镜或胃造影, 腹部超声(肝, 胆, 胰, 脾, 肾), 睡眠(疗法), 代谢综合症, 医学生物年龄, 综合诊断(专家诊断), 营养咨询, 光盘刻录。 
                </div>
                <div class="color-green1">-附加项目</div>
                <div>•男性 : 高半胱氨酸, 动脉硬化检查(PWV)</div>
                <div class="text-justify">•女性(未婚) : 甲状腺超声, 风疹, 乳房X光检查</div>
                <div class="text-justify">•女性(已婚) : 甲状腺超声, 妇科检查, 人乳头状瘤病毒(HPV), 乳房X光检查</div>
                <div class="mt30">5. 配套服务：</div>
                <div class="text-justify">签证，往返机票(出发城市北京，上海，大连)，专车服务（接送机，往返医院，首尔旅游），4星级酒店（两夜），翻译（医疗翻译＋旅游翻译），首尔旅游（N首尔塔，景福宫，明洞，包括餐费和门票费）。</div>
                <div>6. 行程安排：</div>
                <div><img src="http://static.mingyizhudao.com/14750669263907" ></div>
            </div>

            <div class="mt10 pl10 pr10 hide plan"data-choose="2">
              <div class="color-z2 font-w800">套餐二 癌症精密体检项目</div>
              <div>1. 价格：¥39,500</div>
              <div>2. 时间：行程三天两夜，一天体检。</div>
              <div class="text-justify">3. 体检地点：江北三星医院首尔综合体检中心</div>
              <div>4. 体检项目：</div>
              <div>男</div>
              <div class="text-justify">套餐A项目 + 骨密度(腰椎+大腿部), 低剂量肺部多排螺旋CT, 经颅多普勒超声(TCD), 睡眠结肠镜检查, 心脏超声, 前列腺超声, 甲状腺超声，PET-CT 或全身 MRI。</div>
              <div>女</div>
              <div class="text-justify">套餐A项目 + 骨密度(腰椎+大腿部), 低剂量肺部多排螺旋CT, 经颅多普勒超声(TCD), 睡眠结肠镜检查, 心脏超声, 乳房超声, 盆腔超声，PET-CT 或全身 MRI。</div>
              <div>5. 配套服务：</div>
              <div class="text-justify">签证，往返机票(出发城市北京，上海，大连)，专车服务（接送机，往返医院，首尔旅游），4星级酒店（两夜），翻译（医疗翻译＋旅游翻译），首尔旅游（N首尔塔，景福宫，明洞，包括餐费和门票费）。</div>
              <div>6. 行程安排：</div>
              <div><img src="http://static.mingyizhudao.com/147512121783186" ></div>
            </div>
             <div class="mt10 pl10 pr10 hide plan" data-choose="3">
               <div class="color-z2 font-w800">套餐三  深度体检中心</div>
               <div>1. 价格：¥79,500</div>
               <div class="text-justify">2. 时间：行程四天三夜，两天体检。</div>
               <div class="text-justify">3. 体检地点：江北三星医院水原综合体检中心</div>
               <div>4. 体检项目：</div>
               <div class="text-justify">套餐B项目 + 颅脑 MRI, 颅脑 MRA, 高半胱氨酸, 运动负荷检查, 冠状动脉MDCT, 腰椎X光及腰椎 MRI, 颈椎X光及颈椎 MRI。</div>
               <div>5. 配套服务：</div>
               <div class="text-justify">签证，头等舱／公务舱往返机票(出发城市北京，上海，大连)，VIP接机服务（飞机门口接机，VIP通道移动），EQUUS雅科仕豪华轿车服务（接送机，往返医院，首尔旅游），5星级酒店（三夜），翻译（医疗翻译＋旅游翻译），首尔旅游（N首尔塔，景福宫，明洞，包括餐费和门票费）。</div>
               <div>6. 行程安排：</div>
               <div><img src="http://static.mingyizhudao.com/147512121407433" ></div>
             </div>
          </div>
         </div>
         <div class="titleBg font-s18 color-white pl5 mt30">
            申请方式
         </div>
         <div class="color-black">
          拨打名医主刀热线电话<span class="color-green1 font-w800">400-6277-120</span> ，参加三星体检 项目。 
         </div>
       </div>
       </div>
</article>
<script>
    $(function(){
       $('.select').each(function(){
            if($(this).hasClass('active')){
              $(this).children().css('color','#fff') ;

            }
        })
      $('.select').click(function(){
          if($(this).attr('data-active')!=1){
                $('.select').each(function(){
                  $(this).removeAttr('data-active');
                  $(this).removeClass('active');
                  $(this).find('div').css('color','#52bfb4');
                })
            $(this).attr('data-active','1');
            $(this).addClass('active');
            $(this).find('div').css('color','#fff'); 
            var dataSelect=$(this).attr('data-select');

            $('.plan').each(function(){
              $(this).addClass('hide');
              if($(this).attr('data-choose')==dataSelect){
                hasBool=$(this).attr('data-choose');
              }

            })
           $($('.plan')[hasBool-1]).removeClass('hide');
            
           }
            
       })
        
    })
</script>