<style type="text/css">
    .sect-comment ul.ui-listview{margin-bottom:1em;}
    .sect-comment ul.ui-listview>li{border-color:#ddd;background-color:#f6f6f6;}
    .sect-comment ul.ui-listview>li h2{overflow:visible!important;text-overflow: initial!important;white-space:normal!important;}
</style>
<?php
//$model EventYangYing
$this->setPageID('pEventYang');
$this->setPageTitle('祝福祈愿墙');
?>
<div id="<?php echo $this->getPageID(); ?>" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" <?php echo $this->createPageAttributes(); ?> data-nav-rel="#f-nav-enquiry">
    <div data-role="content" class="ui-content">
        你的祝福是对小莹最大的鼓励
        </section>
        <section class="m-panel mt1 sect-add-comment">            
            <div>
                <a id="btnPopupComment" href="#popupComment" data-rel="popup" data-position="window" class="ui-btn btn-success ui-shadow ui-icon-heart ui-btn-icon-left" data-transition="pop">我要祝福小莹</a>
            </div>
            <div data-role="popup" id="popupComment" class="ui-corner-all">
                <div style="padding:10px 20px;"><?php echo $this->renderPartial('_formYangying'); ?></div>
            </div>
            <div data-role="popup" id="popupCommentSuccess" class="ui-corner-all" data-position-to="header#btnPopupComment" style="border-color:#fff;">
                <h2 style="padding:10px 20px;color:#DAA520;">感谢你的由衷祝福！</h2>
            </div>
        </section>
        <section class="m-panel mt1 sect-comment">

            <ul id="comment-list" data-role="listview">
                <li id="comment-head" data-role="list-divider">祝福语：<span class="pull-right"><span class="count-total">0</span>条</span></li>
            </ul>

            <div class="mt2"><a id="btnLoadComment" href="javascript:void(0);" class="ui-btn ui-shadow ui-icon-arrow-d ui-btn-icon-left">查看更多祝福语（还有<span class="count-remain">0</span>条）</a></div>
        </section>
    </div>
</div>


<script>    
    /*<![CDATA[*/
    jQuery(function($) {               
        var commentCount=0;        
        
        loadComments();
        setTimeout(function(){console.log(commentCount)},1000);
        
        $("#btnSubmitComment").click(function(e){                   
            e.preventDefault();
            $(this).attr("disabled", true);
            var domForm = $("#event-comment-form");            
            var actionUrl = "<?php echo $this->createUrl('event/ajaxAddComment'); ?>";            
            //  var author='';
            //   var comment='';
            var formData = new FormData();
            formData.append('Event[event_id]',1);
            formData.append('Event[author]', domForm.find("input[name='EventYangying[author]']").val());
            formData.append('Event[comment]',domForm.find("textarea[name='EventYangying[comment]']").val());
            
            $.ajax({'url':actionUrl, 'data':formData, 'dataType':'json','type':'POST',processData: false, contentType: false,
                'success':function(data) {                                               
                    var domForm = $("#event-comment-form");
                    if(data.status=="true"){ 
                        domForm[0].reset();                  
                        $("#popupComment").popup("close"); 
                        
                        $("#comment-head").after(createCommentHtml(data.author, data.comment, data.date));
                        commentCount++;
                        
                        if(commentCount<3){
                            loadComments();
                        }
                        setTimeout(function(){$("#popupCommentSuccess").popup("open");},1000);
                        
                    }
                    else{
                        $.each(data, function(key, val) {
                            domForm.find("#"+key+"_em_").text(val);
                            domForm.find("#"+key+"_em_").show();                             
                        });
                    }       
                },
                'complete':function(){$("#btnSubmitComment").attr("disabled", false);
                }
            });
        });
        
        
        $("#btnLoadComment").click(function(e){
            e.preventDefault();
            loadComments();
        });
        
        
        function loadComments(){
            var limit=10;
            var actionUrl = "<?php echo $this->createUrl('event/ajaxLoadComment'); ?>";
            var offset=commentCount;
            actionUrl+='?id=1&limit='+limit+'&offset='+offset;
            $.ajax({
                'type':'GET',
                'url':actionUrl,
                'dataType':'json',
                'beforeSend':function(){$.mobile.loading("show");},
                'success':function(response){
                    var author,comment,date;
                    var domCommentList=$("#comment-list");
                    if(response.count===0){
                        $("#btnLoadComment").attr("disabled",true);                        
                    }
                    
                    for(var key in response.data){
                        author=response.data[key].author;
                        comment=response.data[key].comment;
                        date=response.data[key].date;                
                        domCommentList.append(createCommentHtml(author, comment, date));
                    }
                    commentCount+=response.count;  //update offset.    
                    
                    $("#btnLoadComment").find(".count-remain").html(response.remain); //update remaining no. of comments.
                    $("#comment-list").find(".count-total").html(response.total); //update total no. of comments.
                },
                'error':function(response){},
                'complete':function(){$.mobile.loading("hide");$("#btnLoadComment").removeClass("ui-btn-active");}
            });
        }
        function createCommentHtml(author, comment, date){
            return '<li class="ui-li-static ui-body-inherit"><p>'+author+'<span class="pull-right">'+date+'</span></p><h2>'+comment+'</h2></li>';
        }
    });
    
   
    /*]]>*/
</script>