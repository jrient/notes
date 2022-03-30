# docker笔记


## 环境说明
centos8 

## 安装
删除老的版本 
> sudo yum remove docker

设置存储库
> sudo yum install -y yum-utils
> sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo


安装docker引擎
> sudo yum install docker-ce docker-ce-cli containerd.io
检查指纹是否匹配
> 060A 61C5 1B55 8A7F 742B 77AA C52F EB6B 621E 9F35


开启守护进程
> sudo systemctl start docker

检测是否安装成功
> sudo docker run hello-world


## 使用

docker的三个概念：
- 镜像(Image) 一个静态的只读模板，开启容器的基础
- 容器(Container) 在镜像上开启的一个可以运行的实例
- 仓库(Repository) 用来存放镜像文件的地方

查看当前版本
> docker version

查询镜像
> docker search centos

pull获取镜像
> docker pull centos

查看当前系统中的镜像
> docker images

启动一个镜像
(-i 保持打开 -t 以终端的形式 -d 后台运行)
/bin/bash启动命令
> docker run -it centos:latest /bin/bash

查看容器 (-a 查看包括关闭的容器)
> docker ps -a

将容器转化为一个镜像 (72f1a8a0e394 是容器id ，通过ps查看；jrient/centos-test:git是 用户名/仓库名:tag信息)
> docker commit -m "centos test" -a "jrient" 72f1a8a0e394 jrient/centos-test:git


也可以利用 docker build  执行 dockerfile来创建镜像

删除镜像,删除镜像必须删除以此镜像为基础的容器
> docker rm container_name/container_id
> docker rmi image_name/image_id


通过log日志查看容器内的输出
> docker log container_name/container_id

操作容器 启动、停止、重启容器
> docker start container_name/container_id
> docker stop container_name/container_id
> docker restart container_name/container_id

进入一个后台启动着的容器 使用attach命令
> docker attach container_name/container_id

挂在本机地址到docker容器
docker run -it --name lnmp -v /data/www:/data/www centos


查看容器信息
docker inspect centos

修改容器配置信息 (restart重启条件)
[文档](https://www.yiibai.com/docker/container_update.html)
docker container update centos --restart=always

## 仓库

登录docker仓库
> docker login
