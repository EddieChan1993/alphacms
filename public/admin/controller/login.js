/**
 * Created by EVE on 2017/6/28.
 */
/**
 * Created by Administrator on 2017/4/14 0014.
 */
$('#login_in_form').ajaxForm({
    beforeSubmit: showRequest,
    success: showResponse
});

function showRequest() {
    m_loading('数据导入中...',{
        time:-1
    })
}

function showResponse(res) {
    console.log(res);
    destory();
    if(res.code==1) {
        m_loading(res.msg,{
            time:500
        },function () {
            window.location.href = res.url;
        })
    }else{
        m_error(res.msg,{
            time:1500
        });
    }
}
