<div class='set_UP'>
    <div class="top-navbar">
        <img src="../images/logo_white_2.png" alt="">
    </div>
    <div class="innerShell">
        <div class="left_navbar">
            <div class="placeholder" style="flex:0"></div>
        </div>
        <iframe class="display_area" frameborder="0">
        </iframe>
    </div>
</div>

<script>
    let navbar_index = 16
    let left_navbarJOSN = [
        { name: '我的资料',     nextRouter: "M_info.php",           icon: 'gg:profile' },
        { name: '我的公司',     nextRouter: "M_Org.php",            icon: 'mdi:company' },
        { name: '认证标准',     nextRouter: "M_standard.php",       icon: 'bx:certification' },
        { name: '认证模板',     nextRouter: "M_Template.php",       icon: 'healthicons:i-certificate-paper-outline' },
        { name: '集团分支',     nextRouter: "M_GroupBranch.php",    icon: 'mingcute:department-line' },
        { name: '部门',         nextRouter: "M_Department.php",     icon: 'fluent:people-team-16-regular' },
        { name: '职位',         nextRouter: "M_Position.php",       icon: 'material-symbols:assignment-ind-outline' },
        { name: '岗位任命',     nextRouter: "M_RenMing.php",        icon: 'icon-park-outline:appointment' },
        { name: '记录清单',     nextRouter: "M_RecordList.php",     icon: 'solar:checklist-minimalistic-broken' },
        { name: '职权分配',     nextRouter: "M_ZhiQuan.php",        icon: 'fluent-mdl2:workforce-management' },
        { name: '利益分配',     nextRouter: "M_GongZiSitting.php",  icon: 'icon-park-outline:chart-proportion' },
        { name: '云账户',       nextRouter: "M_Jurisdiction.php",   icon: 'carbon:virtual-desktop' },
        { name: '数据检查',     nextRouter: "M_DataCheck.php",      icon: 'material-symbols:data-check' },
        { name: '系统设置',     nextRouter: "M_Setting.php",        icon: 'mingcute:settings-2-line' },
        { name: '密码',         nextRouter: "M_edit_password.php",  icon: 'solar:key-broken' },
        { name: '返回',         nextRouter: "",                     icon: 'typcn:arrow-back-outline' }
    ];

    $(document).ready(function() {
        $.each(left_navbarJOSN, function(index, item) {
            var newDiv = $(`
                <div class="left_navbar_box" name="${item.name}">
                    <span class="iconify" data-icon="${item.icon}" style="font-size: 16px;margin-left:20px;margin-right:10px"></span>
                    <span style="font-size: 10px;">${item.name}</span>
                </div>
            `)
            $('.left_navbar').append(newDiv)
            newDiv.click(function() {
                if(index != navbar_index){
                    if(index === 15){
                        $('.set_UP').hide()
                    }else{
                        $('.display_area').attr('src',`../m/Machine_MobileV1.0/${item.nextRouter}?end=0`)
                        $('.navbar_caches').removeClass('navbar_caches');
                        $(this).addClass('navbar_caches');
                        navbar_index = index
                    }
                }
            });
        });
        
        $('.left_navbar_box').eq(0).click();
    })
</script>

<style>

    .set_UP{
        height: 100vh;
        width: 100vw;
        background-color: #fff;

        position: absolute;
        left: 0;
        top: 0;
        z-index: 21;
    }

    .top-navbar{
        height:56px;
        width:100%;
        background: #333;
        color: #FFF;
        display: flex;
        justify-content: flex-start;
        align-items: flex-end;
        overflow: hidden;
    }

    .top-navbar>img{
        margin-left: 6px;
        height:56px;
    }

    .innerShell{
        width: 100vw;
        height: calc(100% - 56px);
        display: flex;
    }

    .left_navbar{
        width:140px;
        min-width:140px;
        height: calc(100vh - 56px);
        background: #333;
        color: #FFF;
        display: flex;
        flex-direction: column;
    }

    .placeholder{
        height: 30px;
    }

    .left_navbar>h2{
        width: 100%;
        height: 22px;
        line-height: 22px;
        font-size: 12px;
        border-bottom: 1px dotted #666;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .left_navbar_box{
        height: 25px;
        margin: 5px 10px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: left;
    }

    .left_navbar_box:hover{
        background-color: #666;
    }

    .navbar_caches{
        background-color: #666;
    }

    .display_area{
        flex:1;
        height: 100%;
        background-color: #F1F1F1;
    }

</style>