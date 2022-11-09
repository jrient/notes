# 在liunx上使用shadowsocks 客户端

### 安装shadowsocks

推荐使用pip进行安装：

```
yum install python-pip
pip install shadowsocks
```

新建一个配置文件，如：`/etc/shadowsocks.json`

```json
{
    "server":"your_server_ip", #ss服务器IP
    "server_port":your_server_port, #端口
    "local_address": "127.0.0.1", #本地ip
    "local_port":1080, #本地端口
    "password":"your_server_passwd",#连接ss密码
    "timeout":300, #等待超时
    "method":"rc4-md5", #加密方式
    "fast_open": false, # true 或 false。如果你的服务器 Linux 内核在3.7+，可以开启 fast_open 以降低延迟。开启方法： echo 3 > /proc/sys/net/ipv4/tcp_fastopen 开启之后，将 fast_open 的配置设置为 true 即可
    "workers": 1 # 工作线程数
}
```

启动shadowsocks
```
sslocal -c /etc/shadowsocks.json /dev/null 2>&1 &
```

想添加开机自启动，就将上面命令添加到 `/etc/rc.local`

### 安装Privoxy

shadowsocks支持的是sock5代理，它只支持http/https代理。

我们需要在命令行使用，则需要安装`Privoxy` 将所有的http请求转发到shadowsocks

```
yum install privoxy -y
```

编辑 `/etc/privoxy/config`

查找 `listen-address 127.0.0.1:8118` , 解除注释

查找 `forward-socks5t / 127.0.0.1:1080 .` ，解除注释 (如果默认不是1080则修改成1080)

启动privoxy `systemctl restart privoxy`

添加转发配置：

```
> vim /etc/profile

export http_proxy=http://127.0.0.1:8118
export https_proxy=http://127.0.0.1:8118

> source /etc/profile
```

测试翻墙

```
curl www.google.com
```

出现问题，重启机器：

```
> nohup sslocal -c /etc/shadowsocks.json /dev/null 2>&1 &
> privoxy --user privoxy /usr/local/etc/privoxy/config
```

停止privoxy : `systemctl stop privoxy`

停止shadowsocks ： `lsof –i:1080`