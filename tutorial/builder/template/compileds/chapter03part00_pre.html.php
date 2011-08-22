<div class='page'>
	<h1><span class="title"></span>准备工作</h1>
	<blockquote class="prepare">
		准备:<br />
		* 如果你还没有在自己的开发环境中部署Jecat,请先部署Jecat.部署的方法参见教程的第一章<br />
		* 如果你不想自己构建程序的目录,可以直接下载<a href='../code/MVC_start.zip'>代码包</a><br />
	</blockquote>
	
	<h3 id='s1'>step 1.</h3>
	<div class='step'>
		<p class='purpose'>首先构建用户注册的目录结构.</p>
			<ul class='todo'>
				<li>进入framework同级的文件夹下,新建user文件夹</li>
				<li>进入user文件夹,建立inc.common.php文件</li>
				<li>建立Register.php文件</li>
				<li>新建template文件夹</li>
				<li>进入template文件夹</li>
				<li>新建Register.html文件</li>
			</ul>
		<p>都建立好后工程文件夹的结构看起来就像这样:</p>
		<pre class='code'>
			<code class='plain'>
				(工程目录)/
					framework/
					user/
						templates/
							Register.html
						inc.common.php
						Register.php
			</code>
		</pre>
	</div>
	<h3 id='s2'>step 2.</h3>
	<div class='step'>
		<p>然后我们向这些文件添加一些初始代码</p>
		<ul>
		<li>
			打开inc.common.php文件,添加如下代码:
			<pre class='code'>
				<code class='php'>
&lt;?php
namespace jc\user ;

// 初始化 jcat 框架
use jc\session\OriginalSession;
use jc\session\Session;
use jc\db\DB;
use jc\db\driver\PDODriver;
use jc\ui\xhtml\UIFactory ;
use jc\system\ApplicationFactory;

include __DIR__."/../framework/inc.entrance.php" ;

$aApp = ApplicationFactory::singleton()->create(__DIR__) ;

// 加载模板
UIFactory::singleton()->sourceFileManager()->addFolder(__DIR__.'/templates') ;

$aSession = new OriginalSession() ;
$aSession->start() ;
Session::setSingleton($aSession) ;

return $aApp ;
<? ob_flush(); echo '?','>' ; ?>
				</code>
			</pre>
		</li>
		<li>
			打开Register.php文件,添加如下代码:
			<pre class='code'>
				<code class='php'>
&lt;?php
namespace jc\user\RegisterController;

use jc\mvc\model\db\Model;
use jc\mvc\controller\Controller;
use jc\mvc\view\View;

$aApp = require_once dirname ( __DIR__ ) . '/user/inc.common.php';

class RegisterController extends Controller {
	protected function init() {
		$this->createFormView ( "Register" );
		
	}
	
	public function process() {

	}
}

$aController = new RegisterController($aApp->request () );
$aController->mainRun ( );

<? ob_flush(); echo '?','>' ; ?>
				</code>
			</pre>
		</li>
		<li>
			进入template文件夹,打开Register.html文件,添加如下代码:
			<pre class='code'>
				<code class='html'>
&lt;msgqueue for="$theView" />
&lt;form id="theform" method='post'>
	&lt;input type='submit' value='提交表单'/>
&lt;/form>
				</code>
			</pre>
		</li>
		</ul>
	</div>
	
	<h3 id='s3'>step 3.</h3>
	<div class='step'>
		<p>验证构建的代码是否正确</p>
		<ul>
			<li>运行你的浏览器,在地址栏输入这些:  http://你的域名/user/Register.php 然后回车来访问你刚刚构建的页面</li>
			<li>看看Register.php的输出内容,如果你一个名为"提交表单"的按钮,你就可以开始下一节了.如果报错,你很可能看到了Jecat的异常提示,不要灰心,看看Jecat提供的强大异常处理功能是如何帮你解决问题的.仔细读一下错误提示,找到问题并解决它!</li>
		</ul>
	</div>
</div>