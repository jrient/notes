# gitlab 安装

1. 新建 /etc/yum.repos.d/gitlab_gitlab-ce.repo
```
[gitlab-ce]
name=Gitlab CE Repository
baseurl=https://mirrors.tuna.tsinghua.edu.cn/gitlab-ce/yum/el$releasever/
gpgcheck=0
enabled=1
```

2. 安装依赖

```
sudo yum install curl openssh-server openssh-clients postfix cronie
sudo service postfix start
sudo chkconfig postfix on
#或者使用  systemctl enable postfix.service
#这句是用来做防火墙的，避免用户通过ssh方式和http来访问。
sudo lokkit -s http -s ssh
```

3. 通过yum下载安装
```
sudo yum makecache
sudo yum install gitlab-ce
sudo gitlab-ctl reconfigure  #Configure and start GitLab
```

4. 开启防火墙
查看防火墙某个端口是否开启
> firewall-cmd --query-port=80/tcp
开启防火墙端口80
> firewall-cmd --zone=public --add-port=80/tcp --permanent
关闭防火墙端口80
> firewall-cmd --zone=public --remove-port=80/tcp --permanent
更新配置
> firewall-cmd --reload
查看防火墙状态
> systemctl status firewalld
关闭防火墙
> systemctl stop firewalld
打开防火墙
> systemctl start firewalld
开放端口段
> firewall-cmd --zone=public --add-port=8121-8124/tcp --permanent
查看开放的端口列表
> firewall-cmd --zone=public --list-ports

5. 修改映射机器的端口号

1. 如果是映射机器，本机实际的端口号依旧是 80和22，
http相关配置在`/var/opt/gitlab/gitlab-rails/etc/gitlab.yml` 中做修改
ssh 相关配置在`/var/opt/gitlab/gitlab-shell` 中做修改

2. 如果是非映射机器，实际的端口已经改变，则在`/etc/gitlab/gitlab.rb`中修改，修改完成后重新运行配置`gitlab-ctl reconfigure`