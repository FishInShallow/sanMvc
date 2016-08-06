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
