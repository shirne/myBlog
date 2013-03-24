<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<div class="container">
    <table id="listtable">
        <thead>
            <tr>
                <th colspan="4">概况</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th colspan="4">系统</th>
            </tr>
            <tr>
                <th>系统/服务器</th>
                <td><?php echo $_SERVER['OS'],' / ',$_SERVER['SERVER_SOFTWARE'];?></td>
                <th>主机/IP</th>
                <td><?php echo $_SERVER['SERVER_NAME'],' / ',gethostbyname($_SERVER['SERVER_NAME']),':',$_SERVER['SERVER_PORT'];?></td>
            </tr>
            <tr>
                <th>协议</th>
                <td><?php echo $_SERVER['GATEWAY_INTERFACE'],'	',$_SERVER['SERVER_PROTOCOL'];?></td>
                <th>目录</th>
                <td><?php echo $_SERVER['DOCUMENT_ROOT'],'	',ROOT;?></td>
            </tr>
            <tr>
                <th colspan="4">网站</th>
            </tr>
            <tr>
                <th>程序</th>
                <td><?php echo 'CodeIgniter	MyBlog 1.0'?></td>
                <th>更新</th>
                <td><a href="http://blog.shirne.com/" target="_blank">blog.shirne.com</a></td>
            </tr>
            <tr>
                <th>博文</th>
                <td></td>
                <th>评论</th>
                <td></td>
            </tr>
            <tr>
                <th>会员</th>
                <td></td>
                <th>管理员</th>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
<?php include('include/foot.php');?>