# 微信小程序

## 页面

### App()生命周期函数

- onLaunch  当小程序初始化完成时，会触发 onLaunch（全局只触发一次）
- onShow    当小程序启动，或从后台进入前台显示，会触发 onShow
- onHide    当小程序从前台进入后台，会触发 onHide
- onError   当小程序发生脚本错误，或者 API 调用失败时，会触发 onError 并带上错误信息

#### onLaunch/onShow参数

| 字段 | 类型 | 描述 |
| --  |  ---  | --- |
| path | string |打开小程序的页面路径 |
| query | object |打开小程序的页面参数query|
| scene | number |打开小程序的场景值，详细场景值请参考小程序官方文档|
| shareTicket | string |shareTicket，详见小程序官方文档|
| referrerInfo | object |当场景为由从另一个小程序或公众号或App打开时，返回此字段|
| referrerInfo.appId | string | 来源小程序或公众号或App的 appId，详见下方说明|
| referrerInfo.extraData| object |来源小程序传过来的数据，scene=1037或1038时支持|

### Page()页面构造器函数

- onLoad            生命周期函数--监听页面加载，触发时机早于onShow和onReady
- onReady           生命周期函数--监听页面初次渲染完成
- onShow            生命周期函数--监听页面显示，触发事件早于onReady
- onHide            生命周期函数--监听页面隐藏
- onUnload          生命周期函数--监听页面卸载
- onPullDownRefresh 页面相关事件处理函数--监听用户下拉动作
- onReachBottom     页面上拉触底事件的处理函数
- onShareAppMessage 用户点击右上角转发
- onPageScroll      页面滚动触发事件的处理函数


### 底部tab

定义在app.json中

wx.navigateTo和wx.redirectTo只能打开非TabBar页面，wx.switchTab只能打开Tabbar页面。

```json
{
  "tabBar": {
    "list": [
      { "text": "Tab1", "pagePath": "pageA" },
      { "text": "Tab1", "pagePath": "pageF" },
      { "text": "Tab1", "pagePath": "pageG" }
    ]
  }
}
```

### 跳转
- 使用 wx.navigateTo({ url: 'pageD' }) 可以往当前页面栈多推入一个 pageD，此时页面栈变成 [ pageA, pageB, pageC, pageD ]。
- 使用 wx.navigateBack() 可以退出当前页面栈的最顶上页面，此时页面栈变成 [ pageA, pageB, pageC ]。
- 使用wx.redirectTo({ url: 'pageE' }) 是替换当前页变成pageE，此时页面栈变成 [ pageA, pageB, pageE ]，当页面栈到达10层没法再新增的时候，往往就是使用redirectTo这个API进行页面跳转。
- 小程序提供了原生的Tabbar支持，我们可以在app.json声明tabBar字段来定义Tabbar页

## 组件

组件共有属性

|属性名|类型|描述|其他说明|
| --  |  ---  | --- |
|id|String|组件的唯一标示|保持整个页面唯一|
|class|String|组件的样式类|在对应的WXSS中定义的样式类|
|style|String|组件的内联样式|可以通过数据绑定进行动态设置的内联样式|
|hidden|Boolean|组件是否显示|所有组件默认显示|
|data-*|Any|自定义属性|组件上触发的事件时，会发送给事件处理函数|
|bind / catch|EventHandler|事件||

组件都拥有各自自定义的属性，可以对该组件的功能或者样式进行修饰

## API

1. wx.on* 开头的 API 是监听某个事件发生的API接口，接受一个 Callback 函数作为参数。当该事件触发时，会调用 Callback 函数。
2. 如未特殊约定，多数 API 接口为异步接口 ，都接受一个Object作为参数。
3. API的Object参数一般由success、fail、complete三个回调来接收接口调用结果，示例代码如代码清单3-17所示，详细说明如表3-9所示。
4. wx.get* 开头的API是获取宿主环境数据的接口。
5. wx.set* 开头的API是写入数据到宿主环境的接口。

[api文档](https://mp.weixin.qq.com/debug/wxadoc/dev/api/)

## 事件

常见事件

|类型|触发条件|
| --  |  ---  |
|touchstart|手指触摸动作开始|
|touchmove|手指触摸后移动|
|touchcancel|手指触摸动作被打断，如来电提醒，弹窗|
|touchend|手指触摸动作结束|
|tap|手指触摸后马上离开|
|longpress|手指触摸后，超过350ms再离开，如果指定了事件回调函数并触发了这个事件，tap事件将不被触发|
|longtap|手指触摸后，超过350ms再离开（推荐使用longpress事件代替）|
|transitionend|会在 WXSS transition 或 wx.createAnimation 动画结束后触发|
|animationstart|会在一个 WXSS animation 动画开始时触发|
|animationiteration|会在一个 WXSS animation 一次迭代结束时触发|
|animationend|会在一个 WXSS animation 动画完成时触发|

事件回调属性

|属性|类型|说明|
| --  |  ---  | --- |
|type|String|事件类型|
|timeStamp|Integer|页面打开到触发事件所经过的毫秒数|
|target|Object|触发事件的组件的一些属性值集合|
|currentTarget|Object|当前组件的一些属性值集合|
|detail|Object|额外的信息|
|touches|Array|触摸事件，当前停留在屏幕中的触摸点信息的数组|
|changedTouches|Array|触摸事件，当前变化的触摸点信息的数组|