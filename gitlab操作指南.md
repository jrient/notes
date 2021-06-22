# gitlab操作指南-内网版

## 说明
使用gitlab平台将公司内部的文档进行归档和管理，版本控制
公司平台地址
> http://192.168.0.116:8128/

## 注册

1. 访问公司gitlab平台地址，进入登录界面，点击`Register now`进入注册界面。
2. 填写注册信息，点击注册。
3. 注册完成后，重新进入登录页面进行登录
4. 登录完成，点击右上角头像下拉框中的`Edit Profile`
5. 点击左侧`preference`, 下拉右侧到`Localization`栏目，选择`Language`为`简体中文`后点击保存并刷新页面。

## git工具下载

[点击下载](http://192.168.0.116:8128/root/gitlab/-/blob/master/Git-2.32.0-64-bit.exe)

选择你所需要的平台版本进行下载，这里以windows为例。
下载完成后，点击`Git-2.32.0-64-bit.exe`文件进行安装,一直点击下一步直到安装完成。

安装完成后在桌面右击，选择"Git Bash Here"，在命令行界面逐行输入以下命令
```
ssh-keygen -t rsa -C "email@email.com"
一直按回车
eval  "ssh-agent -s"
ssh-agent bash
ssh-add ~/.ssh/id_rsa
```
完成后会提示`Identity added: /c/Users/xxx/.ssh/id_rsa (jrient@qq.com)`
其中`/c/Users/xxx/.ssh/id_rsa`表示rsa文件所在的位置。
打开文件管理，在顶部地址框输入`C:/Users/xxx/.ssh`(注意，这个地址是将上一行地址的"/c"替换为"C:"),进入公钥私钥所在目录，右击`id_rsa.pub`文件选择打开方式，用记事本打开[1]。

### 配置sshkey
1. 进入gitlab后台，点击右上角头像下拉框中的`Edit Profile`
2. 选择左侧`SSH密钥`,在右侧将以上记事本[1]打开的内容复制粘贴进去，点击添加密钥。
3. 在 git bash 中执行 
```
ssh -T -p 22128 git@192.168.0.116
在提示输入的时候，输入 yes
成功后提示：
Welcome to GitLab, @xxxx！

```

### git全局配置
1. 配置用户名和密码
```
git config --global user.name "xxx"
git config --global user.email "xxx@xx.com"
```

2. 设置记住密码
```
git config --global credential.helper store
```
在下一次输入用户名和密码后，系统就会自动记住你的账号密码不需要重复输入

### 下载第一个项目
1. 在顶部(蓝色区域)的搜索框内搜索`gitlab使用说明`,点击进入
2. 在右上角找到`克隆`下拉框，复制克隆地址
3. 在你本机准备放置项目的文件管理器空白位置右击，选择"Git Bash Here"， 在命令行界面中填入 `git clone xxx(你刚刚复制的克隆地址)`，即可下载gitlab使用说明

### 新建第一个项目
1. 在首页的右上角，点击‘新建项目’，选择你需要新建的类型，这里以创建空白项目为例。
2. 填入项目名称、项目标识串(建议为英文，下载后就是目录名)，可见级别建议为内部，点击新建项目，页面跳转入新建提示页。
3. 在你项目所在的目录下空白处右击，唤起git bash
4. 在新建提示页找到‘推送现有文件夹’，按照提示的命令依此贴入命令行界面中
(cd existing_folder 是进入你所在项目目录的意思，因为刚刚已经在目录下唤起 git bash 所以不需要输入这行命令)

### 常用命令

[git基本操作](https://www.runoob.com/git/git-basic-operations.html)


| 命令 | 说明 | 示例 |
| -- | -- | -- |
| git add | 添加文件到仓库 | git add . (.代表当前目录)|
| git status | 查看仓库当前的状态，显示有变更的文件 | |
| git diff | 比较文件的不同，即暂存区和工作区的差异 | git diff README.md |
| git commit | 提交暂存区到本地仓库 | git commit -m "提交内容说明" |
| git pull | 下载远程代码并合并 | |
| git push | 上传远程代码并合并 | |
| git clone | 从服务器上下载代码 | git clone http://192.168.0.116:8128/root/gitlab.git |

操作实战
1. 在项目下新建 test.txt 文件，并写入'你好啊'，保存。
2. 在项目目录下唤起git bash
3. 执行 `git pull` 拉取远端服务器上的数据，避免存在差异
4. 执行 `git add .` 将当前文件夹下所有有变更的文件添加到暂存区
5. 执行 `git commit -m "提交测试文件"` 将暂存区中的文件提交到本地仓库
6. 执行 `git push` 将变更的文件上传到服务器
7. 进入后台查看文件是否提交