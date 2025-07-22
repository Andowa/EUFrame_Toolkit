![release](https://img.shields.io/github/v/release/Andowa/EUFrame_Toolkit?include_prereleases&style=social)
![license](https://img.shields.io/github/license/Andowa/EUFrame_Toolkit?style=social)
![size](https://img.shields.io/github/languages/code-size/Andowa/EUFrame_Toolkit?style=social)

### English | [简体中文](http://frame.eqmemory.cn/)

#### Introduction

EssentialUnified Framework (EU) is based on PHP multi-end development framework, class library perfect, suitable for the development of various types of applications.

#### Schematic diagram

Difference from traditional MVC  
![schematic](http://frame.eqmemory.cn/image/euyl-en.png)

#### Environment

Support Nginx/Apache/IIS.  
Support PHP5/PHP7/PHP8 and other known upward distributions.

#### Security

.eu.config configuration contains sensitive information.  
You must set in the configuration file to prohibit non local access Config file.  
[Server configuration example](http://frame.eqmemory.cn/baike/config.php)
install-dev is the installation directory of visual package on the development side. If visualization is not required, please delete this directory after deploying EU.

#### system architecture

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

#### [Development documentation](http://frame.eqmemory.cn/)
