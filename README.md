# 简介
本书主要专注于以下开发场景：

VueJS 的后端服务器 API 接口开发；
App 的后端 API 服务器开发。
在第二本进阶课程构建的项目 LaraBBS 基础上，我们将一起开发以下功能：

接口设计原则
API 解决方案
短信验证码，手机登录
第三方登录（微信登录详解）
用户身份认证
资源数据格式化
国际化
API 基础测试
权限控制 —— 权限列表，角色列表
资源推荐接口、活跃用户接口
接口本地化处理
API 接口错误代码机制
APNS 消息推送服务器端介绍及实现
Passport 认证
通过阅读本教程，你将学到如 RESTFul 设计风格、PostMan 的使用、OAuth 流程，JWT 概念及使用 和 API 开发相关的进阶知识。不仅如此，本书还会对这些基础知识点进行延伸扩展，为你讲解一些在 API 开发中更为专业、实用的技能，如使用微信测试公众号调试 OAuth 流程、图片验证码等。这些知识将为你未来的编程开发奠定下坚实的基础。使你不论是在做自己的个人项目，或是构建一个伟大的商业产品时，都能得心应手。

获取代码  
`https://github.com/gyp719/Larabbs-Api`

安装组件  
`composer install`

`cp .env.example .env`

`php artisan key:generate`

执行数据库迁移  

`php artisan migrate:refresh --seed`

启动访问  
`http://larabbs-api.test`

Passport
`
Client ID: 1
Client secret: EvtbjguJg9B4PQI8VuopNSgS1eQsH0lKAt1Khk1h
`
