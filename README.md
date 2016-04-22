# 1.谷歌公共库和字体库国内镜像服务器搭建
# 2.谷歌公共库替换成微锐公共库实现国内CDN加速

由于国内访问谷歌字体较慢或直接被墙，所以制作了国内镜像进行加速。
如果技术有限无法完成镜像搭建，可以看下方替换域名使用微锐公共库。

## 技术

 * 框架：[Lumen/Laravel](http://lumen.laravel.com/)
 * 程序：[php/apache/Docker](https://github.com/docker-library/docs/tree/master/php)
 * 容器：[DaoCloud（免费额度）](https://daocloud.io/)
 * 存储：[七牛云存储（免费额度）](https://portal.qiniu.com/signup?code=3lhfs5t7zawk2)

## 原理

用户请求 https://fonts.weirui.org/css 时，后端程序会自动获取 https://fonts.googleapis.com/css 对应的内容，把谷歌字体镜像替换为你的镜像服务器，css缓存在服务器后端，字体文件自动镜像到CDN。

比如

[https://fonts.weirui.org/css?family=Lato:400,700|Roboto+Slab:400,700|Inconsolata:400,700]
(https://fonts.weirui.org/css?family=Lato:400,700|Roboto+Slab:400,700|Inconsolata:400,700)

对应

[https://fonts.googleapis.com/css?family=Lato:400,700|Roboto+Slab:400,700|Inconsolata:400,700]
(https://fonts.googleapis.com/css?family=Lato:400,700|Roboto+Slab:400,700|Inconsolata:400,700)

## 说明

本文引用微锐公司的谷歌字体库对比360公共库：
360代理访问速度不理想而且不支持SSL（HTTPS）微锐公共库完全缓存到微锐国内CDN，速度飞快。
微锐谷歌字体库支持SSL并且访问速度比360更快，另外也有Google Ajax公共库，替换一个域名即可使用！

## 使用

如果你不会配置以上程序没有关系，手动替换以下链接就能使用微锐公共库：
把 `https://ajax.googleapis.com/` 替换为 `https://ajax.weirui.org/` 
把 `https://fonts.googleapis.com/` 替换为 `https://fonts.weirui.org/` 
需要同时支持HTTP和HTPPS方式访问，请改为相对链接`//ajax.weirui.org`或`//fonts.weirui.org`即可。
