    //反选事件
    $("#unSelect").click(function() {
        var checkbox = $(":checkbox");
        for (var i = 0; i < checkbox.length; i++) {
            checkbox[i].checked = !checkbox[i].checked;
        }
    });

    function isDel() {
        if (confirm(' \n您是否确定删除该纪录?')) {
            return true;
        } else {
            alert('取消成功！');
            return false;
        }
    }