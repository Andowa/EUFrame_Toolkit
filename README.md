![release](https://img.shields.io/github/v/release/Andowa/EUFrame_Toolkit?include_prereleases&style=social)
![license](https://img.shields.io/github/license/Andowa/EUFrame_Toolkit?style=social)
![size](https://img.shields.io/github/languages/code-size/Andowa/EUFrame_Toolkit?style=social)

### [完整手册与介绍](http://frame.eqmemory.cn/)

#### 项目简介

EU框架（全称EssentialUnified Framework，简写EU、EUFrame、EUFramework）是基于PHP的多端应用开发框架。EU框架内置几乎所有关系数据库或非关系数据库的类库，拥有可自定义的模板引擎、语言本地化解析器及各种函数库。轻便简易的开发模式使开发者更容易理解流程、上手开发。使用EU虽然需要PHP基础知识，但更多的是对EU函数方法的调用，这将节省更多的开发时间。

#### EU框架与传统MVC区别

![schematic](http://frame.eqmemory.cn/image/mvcyl.jpg)

![schematic](http://frame.eqmemory.cn/image/euyl-en.png)

#### 运行环境

支持 Nginx/Apache/IIS.  
支持 PHP5/PHP7/PHP8(可用但有函数错误) .

#### 安全相关

.eu.config配置包含敏感信息。  
您必须在配置文件中设置禁止非本地访问配置文件。  
[服务器配置示例](http://frame.eqmemory.cn/config-%E9%85%8D%E7%BD%AE%E6%96%87%E4%BB%B6.html)
install-dev是开发端可视包的安装目录，如果不需要可视化，请在部署EU后删除此目录

#### 程序目录

```
┌─── app /*Application*/
├────├─── assets /*Resource*/
├────├─── admin /*Admin example*/
├────├────└───index.php  /*Admin controller*/
├────├─── log /*Log*/
├────├─── modules /*Module*/
├────├────└───eu-frame
├────├────├────├─admin /*Admin model*/
├────├────├────├─cache
├────├────├────├─skin
├────├────├────├────├─admin /*Admin view*/
├────├────├────├────└─front /*Client view*/
├────├────├────├─front /*Client model*/
├────├────├────├────├─error.php
├────├────├────├────└─index.php
├────├─────────└─essentialunified.config
├────├─── plugins /*Plugin*/
├────├─── template /*Template engineering*/
├────├────└───Template name
├────├─────────├─assets
├────├─────────├─move
├────├─────────├─skin /*Module view*/
├────├─────────├───├─eu-frame
├────├─────────├───├────├─admin
├────├─────────├───├────├─cache
├────├─────────├───├────└─front
├────├─────────├───└─Other module view
├────├─────────└─essentialunified.config
├────└─── config.php /*Application configuration*/
├─── lang /*Language package*/
├─── library /*Class library*/
├─── update
├─── vendor /*Composer dependency*/
├─── .eu.config /*Global configuration*/
├─── autoload.php /*Bootloader*/
├─── index.php /*Client controller*/
├─── essentialunified /*Command line*/
└─── EUVER.ini /*Version*/
```
