### 2016.08.10
### view类增加分页功能paginate($totalPage),用于实现分页按钮组功能,需配合model的分页读取功能paginate($page,$lines)使用;
### $totalPage -> 总页数,$page -> 第几页,lines -> 每页条数
### 实现流程一般如下:
### 1)paginate($page,$lines) -> 得到第$page页的$lines条数据;
### 2)在数据展示页面的合适位置paginate($totalPage) -> 显示分页按钮组
### P.S $totalPage可以通过model的totalPage($lines)方法得到,也可以使用自定义的方法,反正都一样

### 2016.08.06
### 新增MVC核心类core/view,用于展示页面和传递数据,以及一些页面临时内容;
### 它目前有三个主要方法:
### withError($info)    //用于向页面发送错误的提示;
### withSuccess($info)  //用于向页面发送成功的提示;
### show($url,$data)    //$data为可选参数,$url支持页面文件路径和伪静态地址;调用页面和在页面显示数据(数组形式);
### show($url,$data)后可链式调用withError($info)和withSuccess($info)
### 例子:
### $view = new view();
### $articles = Articles::all();
### $view->show("/index",['articles' => $articles])->withSuccess("首页");
