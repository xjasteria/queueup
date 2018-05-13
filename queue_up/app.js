//app.js
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



// App({
//   onLaunch: function () {
//     //调用API从本地缓存中获取数据  
//     var logs = wx.getStorageSync('logs') || []
//     logs.unshift(Date.now())
//     wx.setStorageSync('logs', logs)
//   },
//   getUserInfo: function (cb) {
//     var that = this
//     if (this.globalData.userInfo) {
//       typeof cb == "function" && cb(this.globalData.userInfo)
//     } else {
//       //调用登录接口  
//       wx.login({
//         success: function (res) {
//           var code = res.code
//           // success  
//           // 获取用户信息  
//           wx.getUserInfo({
//             success: function (data) {
//               that.globalData.userInfo = data.userInfo
//               typeof cb == "function" && cb(that.globalData.userInfo)
//               var rawData = data.rawData;
//               var signature = data.signature;
//               var encryptedData = data.encryptedData;
//               var iv = data.iv;
//               wx.request({
//                 url: common.baseUrl + 'index.php/api/user/wxlogin',
//                 data: {
//                   "code": code,
//                   " rawData": rawData,
//                   "signature": signature,
//                   " iv": iv,
//                   "encryptedData": encryptedData
//                 },
//                 method: 'GET',
//                 success: function (res) {
//                   // success  
//                   console.log(res)
//                   console.log(rawData)
//                 }
//               })
//             }
//           })
//         }
//       })
//     }
//   },
//   globalData: {
//     userInfo: null
//   },
// })  