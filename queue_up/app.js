//app.js
// App({
//   onLaunch: function () { },
//   onShow: function () { },
//   toLogin: function () {
//     // 前往授权登录界面
//     wx.navigateTo({
//       url: '/pages/toLogin/toLogin',
//     })
//   },
//   ready: function () {
//     return Promise((resolve, reject) => {
//       const userkey = wx.getStorageSync('userkey')
//       const userId = wx.getStorageSync('userId')
//       const sessionData = wx.getStorageSync('sessionData')
//       // 检查用户是否具有登陆态
//       if (!userkey || !userId || !sessionData) {
//         // 如果未登录就前往登录界面
//         this.toLogin()
//       } else {
//         // 如果有就只要更改一下Promise，以继续执行后续操作
//         resolve()
//       }
//     })
//   }
// })

// App({
//   onLaunch: function () {
//     // 展示本地存储能力
//     var logs = wx.getStorageSync('logs') || []
//     logs.unshift(Date.now())
//     wx.setStorageSync('logs', logs)

//     // 登录
//     wx.login({
//       success: res => {
//         // 发送 res.code 到后台换取 openId, sessionKey, unionId
//       }
//     })
//     // 获取用户信息
//     wx.getSetting({
//       success: res => {
//         if (res.authSetting['scope.userInfo']) {
//           // 已经授权，可以直接调用 getUserInfo 获取头像昵称，不会弹框
//           wx.getUserInfo({
//             success: res => {
//               // 可以将 res 发送给后台解码出 unionId
//               this.globalData.userInfo = res.userInfo

//               // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
//               // 所以此处加入 callback 以防止这种情况
//               if (this.userInfoReadyCallback) {
//                 this.userInfoReadyCallback(res)
//               }
//             }
//           })
//         }
//       }
//     })
//   },
//   globalData: {
//     userInfo: null
//   }
// })

var common = require('./utils/common.js')
App({
  onLaunch: function () {
  },
  getUserInfo: function (cb) {
    var that = this
    if (this.globalData.userInfo) {
      typeof cb == "function" && cb(this.globalData.userInfo)
    } else {
      //调用登录接口
      wx.login({
        success: function (res) {
          wx.getUserInfo({
            success: function (res) {
              console.log(res);
              that.globalData.userInfo = res.userInfo
              typeof cb == "function" && cb(that.globalData.userInfo)
            }
          })

          if (res.code) {
            console.log(res);
            //发起网络请求
            wx.request({
              url: common.baseUrl + 'index.php/api/user/wxlogin',
              data: {
                code: res.code
              },
              success: function (res) {
                that.globalData.openid = res.data.openid
                wx.setStorage({
                  key: "openid",
                  data: res.data.openid
                })
              }
            })
          } else {
            console.log('获取用户登录态失败！' + res.errMsg)
          }
        }
      })
    }
  },
  globalData: {
    userInfo: null,
    openid: null
  }
})