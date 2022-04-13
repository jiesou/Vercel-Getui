# Vercel-Getui

使用 Vercel 免费搭建便捷的个推后端

## 优点

仅需一次 http post 请求，无需任何逻辑计算代码即可群发消息

适合对安全性要求较低的个人业务搭配 IFTTT 等实现自动化操作

## 限制

* 每次请求都会获取一次 token
* 仅支持群发推送，也不支持全部参数（主要是我只用的到那么几个，要添加其实很简单）

## 部署

[![Deploy with Vercel](https://vercel.com/button)](https://vercel.com/new/clone?repository-url=https%3A%2F%2Fgithub.com%2Fjiesou%2FVercel-Getui%2Ftree%2Fmain)

## 使用

直接向 Vercel 上部署的链接 + pushAll.php（例如 `https://example.vercel.app/pushAll.php`）发送 http post 请求

header 中填写

* appId: [个推 AppId]
* appKey: [个推 AppKey]
* masterSecret: [个推 MasterSecret]

body 中以 json 形式填写参数。例如：

```json
{
    "title": "Title",
    "body": "Message",
    "click": ["url","https:///www.example.com"]
}
```

click 点击动作为数组，第一个可填写：

* intent：打开应用内特定页面
* url：打开网页地址
* payload：自定义消息内容启动应用
* payload_custom：自定义消息内容不启动应用
* startapp：打开应用首页
* none：纯通知，无后续动作

第二个填写动作内容
