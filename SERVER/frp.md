# frp - windows

## 说明
frp 是一个可用于内网穿透的高性能的反向代理应用，支持 tcp, udp 协议，为 http 和 https 应用协议提供了额外的能力，且尝试性支持了点对点穿透。

## 下载
[点击下载](https://github.com/fatedier/frp/releases)

## 配置

### 服务端

frps.ini
```
[common]
# bind_port 是内部通信端口
bind_port = 7000
# vhost_http_port 是http访问端口
vhost_http_port = 8128
# token 是双方验证密钥
token = 123
```

### 客户端
frpc.ini
```
[common]
# 此处为 vps 的公网ip
server_addr = x.x.x.x
# vps上frps服务监听的端口
server_port = 7000
# token 是双方验证密钥
token = 123

[web]
type = http
# local_port 是本地端口
local_port = 80
# custom_domains 要求必须配置，可以为ip地址
custom_domains = www.yourdomain.com

[ssh]
type = tcp
local_ip = 127.0.0.1 
# 需要暴露的内网机器的端口
local_port = 22128  
# 暴露的内网机器的端口在vps上的端口，可以不一样
remote_port = 22128 

```

## windows 建立bat脚本文件，下次点击执行即可
注意： windows8和windows10的terminal命令还一不一致，使用前先查下

```
cd /d D:\soft\frp\frp_0.20.0_windows_amd64
start /b frpc -c frpc.ini
```
