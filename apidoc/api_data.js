define({ "api": [
  {
    "type": "GET",
    "url": "/comment/commentInfo",
    "title": "获取评论内容",
    "name": "commentInfo",
    "group": "Comment",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "authorization-token",
            "description": "<p>token.</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单ID</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "sp_id",
            "description": "<p>评论人ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "sp_name",
            "description": "<p>评价人的姓名</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "dr_id",
            "description": "<p>司机ID</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "dr_name",
            "description": "<p>司机姓名</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "post_time",
            "description": "<p>提交时间</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "limit_ship",
            "description": "<p>发货时效几星</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "attitude",
            "description": "<p>服务态度几星</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "satisfaction",
            "description": "<p>满意度 几星</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>评论文字</p>"
          },
          {
            "group": "Success 200",
            "type": "Int",
            "optional": false,
            "field": "status",
            "description": "<p>0=正常显示，1=不显示给司机</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Comment.php",
    "groupTitle": "Comment",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//comment/commentInfo"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/comment/sendCommentInfo",
    "title": "发送评论内容",
    "name": "sendCommentInfo",
    "group": "Comment",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "authorization-token",
            "description": "<p>token.</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单ID</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "limit_ship",
            "description": "<p>发货时效几星</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "attitude",
            "description": "<p>服务态度几星</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "satisfaction",
            "description": "<p>满意度 几星</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>评论文字</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Comment.php",
    "groupTitle": "Comment",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//comment/sendCommentInfo"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index/sendCaptcha",
    "title": "发送验证码done",
    "name": "sendCaptcha",
    "group": "Common",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机号.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "opt",
            "description": "<p>验证码类型 reg=注册 resetpwd=找回密码 login=登陆 bind=绑定手机号.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "application/api/controller/BaseMessage.php",
    "groupTitle": "Common",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index/sendCaptcha"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=auth_img",
    "title": "认证图片",
    "name": "DriveImg",
    "group": "DriverPack",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "name",
            "description": "<p>认证名称</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "auth_info",
            "description": "<p>认证失败信息</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"返回成功\",\n     \"result\": {\n     \"name\": \"羊1\",\n     \"auth_status\": 1,\n     \"auth_info\": \"\",\n     \"status_text\": \"认证通过\",\n     \"img\": {\n     {\n         \"title\": \"车检证\",\n         \"img_url\": \"http://f10.baidu.com/it/u=4227954,1443099975&fm=76\"\n     },\n     {\n         \"is_must\": 1,\n         \"title\": \"驾驶证\",\n         \"img_url\": \"http://f10.baidu.com/it/u=4227954,1443099975&fm=76\"\n     },\n     {\n         \"is_must\": 1,\n         \"title\": \"手持身份证正面照\",\n         \"img_url\": \"http://f10.baidu.com/it/u=4227954,1443099975&fm=76\"\n     },\n     {\n         \"is_must\": 1,\n         \"title\": \"身份证正面\",\n         \"img_url\": \"http://f10.baidu.com/it/u=4227954,1443099975&fm=76\"\n     },\n     {\n         \"is_must\": 1,\n         \"title\": \"身份证反面\",\n         \"img_url\": \"http://f10.baidu.com/it/u=4227954,1443099975&fm=76\"\n     },\n   {\n         \"title\": \"导游证\",\n         \"img_url\": \"http://f10.baidu.com/it/u=4227954,1443099975&fm=76\"\n     },\n     {\n         \"title\": \"游艇驾驶证\",\n         \"img_url\": \"http://f10.baidu.com/it/u=4227954,1443099975&fm=76\"\n     }\n     }\n     }\n     }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "DriverPack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=auth_img"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=Pack&a=auth_img_up",
    "title": "认证图片上传",
    "name": "DriverUploadImg",
    "group": "DriverPack",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "car_check_img",
            "description": "<p>车见证</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "driver_img",
            "description": "<p>驾驶证</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "drv_hold_img",
            "description": "<p>手持身份证正面照</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "drv_front_img",
            "description": "<p>身份证正面</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "drv_back_img",
            "description": "<p>身份证反面</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "guide_img",
            "description": "<p>导游证</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "boat_img",
            "description": "<p>游艇驾驶证</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "name",
            "description": "<p>认证名称</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n\"status\": 1,\n\"msg\": \"上传成功\",\n\"result\": {}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "DriverPack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=auth_img_up"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=index",
    "title": "司导首页",
    "name": "getDriver",
    "group": "DriverPack",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"返回成功\",\n     \"result\": {\n     \"is_seller_auth\": 0,\n     \"is_drv_auth\": 1,\n     \"is_home_auth\": 0\n }\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "DriverPack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=index"
      }
    ]
  },
  {
    "type": "GET",
    "url": "index.php?m=Api&c=DriverPack&a=getDriverDetail",
    "title": "司导详情",
    "name": "getDriverDetail",
    "group": "DriverPack",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "optional": false,
            "field": "drv_id",
            "description": "<p>{String}    司导ID</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": "Http/1.1 200 OK\n{\n \"head_pic\" : \"http://xxx.jpg\",//司导头像\n \"putonghua\" : \"\",//普通话\n \"language\" : \"\",//精通外语\n \"putonghua\" : \"\",//东京\n \"putonghua\" : \"\",//职业\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/DriverPack.php",
    "groupTitle": "DriverPack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/index.php?m=Api&c=DriverPack&a=getDriverDetail"
      }
    ]
  },
  {
    "type": "GET",
    "url": "index.php?m=Api&c=PackLine&a=getLocalLine",
    "title": "得到当地司导",
    "name": "getLocalLine",
    "group": "DriverPack",
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n\"drv_id\"   : \"11\",//司导ID\n\"head_pic\" : \"http://xxx.jpg\",//司导图片\n\"user_name\" : \"司导姓名\",\n\"comment_level\" : \"1\",//评价等级\n\"local\" : \"\",//位置\n\"level\" : \"\",//等级\n\"grade\" : \"\",//评分\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/DriverPack.php",
    "groupTitle": "DriverPack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/index.php?m=Api&c=PackLine&a=getLocalLine"
      }
    ]
  },
  {
    "type": "POST",
    "url": "index.php?a=A/file/uploadImg",
    "title": "上传图片",
    "name": "uploadImg",
    "group": "File",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "authorization-token",
            "description": "<p>token.</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Image",
            "optional": false,
            "field": "file",
            "description": "<p>上传的文件 最大5M 支持'jpg', 'gif', 'png', 'jpeg'</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>下载链接(绝对路径)</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "application/api/controller/File.php",
    "groupTitle": "File",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/index.php?a=A/file/uploadImg"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=LocalTalent&a=getIndexLocalTalent",
    "title": "得到首页当地达人列表",
    "name": "LocalTalent",
    "group": "Index",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "optional": false,
            "field": "token",
            "description": "<p>{String}   token.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": "     Http/1.1    200 OK\n{\n     \"talent_id\" :   \"1\",  //视屏ID\n     \"cover_img\" :   \"http://xxxx.jpg\",  //视屏封面图\n     \"name\"      :   \"张三\",  //发布人姓名\n     \"city\" :   \"东京\",  //发布人所在城市\n     \"id_type\" :   \"\",  //身份标签（有几个身份？）\n     \"good_num\" :   \"111\",  //点赞数\n\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/LocalTalent.php",
    "groupTitle": "Index",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=LocalTalent&a=getIndexLocalTalent"
      }
    ]
  },
  {
    "type": "GET",
    "url": "index.php?m=Api&c=HotGuide&a=getIndexHotGuide",
    "title": "得到首页热门动态",
    "name": "getIndexHotGuide",
    "group": "Index",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "optional": false,
            "field": "token",
            "description": "<p>{String}   token.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": "     Http/1.1    200 OK\n{\n     \"talent_id\" :   \"1\",  //视屏ID\n     \"cover_img\" :   \"http://xxxx.jpg\",  //视屏封面图\n     \"name\"      :   \"张三\",  //发布人姓名\n     \"city\" :   \"东京\",  //发布人所在城市\n     \"id_type\" :   \"\",  //身份标签（有几个身份？）\n     \"good_num\" :   \"111\",  //点赞数\n\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/HotGuide.php",
    "groupTitle": "Index",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/index.php?m=Api&c=HotGuide&a=getIndexHotGuide"
      }
    ]
  },
  {
    "type": "GET",
    "url": "index.php?m=Api&c=NewAction&a=getIndexNewAction",
    "title": "得到首页最新消息",
    "name": "getIndexNewAction",
    "group": "Index",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "optional": false,
            "field": "token",
            "description": "<p>{String}   token.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": "     Http/1.1    200 OK\n{\n     \"talent_id\" :   \"1\",  //视屏ID\n     \"cover_img\" :   \"http://xxxx.jpg\",  //视屏封面图\n     \"title\" :   \"文章标题\",  //文章标题\n     \"name\"      :   \"张三\",  //发布人姓名\n     \"good_num\" :   \"111\",  //点赞数\n\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/NewAction.php",
    "groupTitle": "Index",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/index.php?m=Api&c=NewAction&a=getIndexNewAction"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=Order&a=order_refuse",
    "title": "接单按钮",
    "name": "OrderRefuse",
    "group": "Mine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "air_id",
            "description": "<p>已拒绝</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"已拒绝!\",\n     \"result\": {}\n}\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Order.php",
    "groupTitle": "Mine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Order&a=order_refuse"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=Order&a=air_status",
    "title": "接单按钮",
    "name": "PackAcceptOrder",
    "group": "Mine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "air_id",
            "description": "<p>要被接单的air_id值</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "per_page",
            "description": "<p>当前页数</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"接单成功!\",\n     \"result\": {}\n}\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Order.php",
    "groupTitle": "Mine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Order&a=air_status"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Order&a=myOrder",
    "title": "获取我的订单",
    "name": "PackMyOrder",
    "group": "Mine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>分页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "status",
            "description": "<p>状态</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "per_page",
            "description": "<p>当前页数</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n   \"status\": 1,\n   \"msg\": \"返回成功\",\n   \"result\": {\n   \"data\": [\n   {\n         \"air_id\": 3,\n         \"user_id\": 20,\n         \"seller_id\": 20,\n         \"allot_seller_id\": \",18,19,20,\",\n         \"customer_name\": \"中国\",\n         \"customer_phone\": 1322222222,\n         \"use_car_num\": 10,\n         \"work_at\": 22,\n         \"work_pointlng\": 123.021,\n         \"work_pointlat\": 36.25,\n         \"work_address\": \"江苏省苏州市\",\n         \"dest_pointlng\": 125.236,\n         \"dest_pointlat\": 36.23,\n         \"dest_address\": \"英格兰\",\n         \"status\": 1,\n         \"pay_way\": 1,\n         \"total_price\": 100,\n         \"real_price\": \"100.00\",\n         \"is_pay\": 1,\n         \"pay_time\": 1504858382,\n         \"start_time\": \"2017-09-08 周五 16:13\",\n         \"end_time\": 1504858382,\n         \"drv_name\": \"醉生梦死\",\n         \"drv_id\": 3,\n         \"drv_code\": \"121540215\",\n         \"req_car_id\": 11245,\n         \"req_car_type\": \"1\",\n         \"con_car_id\": 1,\n         \"con_car_type\": \"2\",\n         \"type\": 1,\n         \"mile_length\": 100,\n         \"discount_id\": 23,\n         \"create_at\": 1504858382,\n         \"update_at\": 1504858382\n   },\n   {\n         \"air_id\": 4,\n         \"user_id\": 20,\n         \"seller_id\": 20,\n         \"allot_seller_id\": \",18,19,20,\",\n         \"customer_name\": \"日本\",\n         \"customer_phone\": 1322222222,\n         \"use_car_num\": 10,\n         \"work_at\": 22,\n         \"work_pointlng\": 123.021,\n         \"work_pointlat\": 36.25,\n         \"work_address\": \"江苏省苏州市\",\n         \"dest_pointlng\": 125.236,\n         \"dest_pointlat\": 36.23,\n         \"dest_address\": \"英格兰\",\n         \"status\": 1,\n         \"pay_way\": 1,\n         \"total_price\": 100,\n         \"real_price\": \"100.00\",\n         \"is_pay\": 1,\n         \"pay_time\": 1504858382,\n         \"start_time\": \"2017-09-08 周五 16:13\",\n         \"end_time\": 1504858382,\n         \"drv_name\": \"醉生梦死\",\n         \"drv_id\": 3,\n         \"drv_code\": \"121540215\",\n         \"req_car_id\": 11245,\n         \"req_car_type\": \"1\",\n         \"con_car_id\": 1,\n         \"con_car_type\": \"2\",\n         \"type\": 1,\n         \"mile_length\": 100,\n         \"discount_id\": 23,\n         \"create_at\": 1504858382,\n         \"update_at\": 1504858382\n   }\n   ]\n   }\n   }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Order.php",
    "groupTitle": "Mine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Order&a=myOrder"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Order&a=singleWork",
    "title": "获取详细订单",
    "name": "PackSingleWork",
    "group": "Mine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "air_id",
            "description": "<p>air_id值</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "per_page",
            "description": "<p>当前页数</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n   \"status\": 1,\n   \"msg\": \"返回成功\",\n   \"result\": {\n   \"total\": 9,\n   \"per_page\": 2,\n   \"current_page\": \"3\",\n   \"data\": [\n   {\n     \"status\": 1,\n     \"msg\": \"返回成功\",\n     \"result\": {\n     \"data\": {\n     \"air_id\": 3,\n     \"user_id\": 20,\n     \"seller_id\": 20,\n     \"allot_seller_id\": \",18,19,20,\",\n     \"customer_name\": \"中国\",\n     \"customer_phone\": 1322222222,\n     \"use_car_num\": 10,\n     \"work_at\": 22,\n     \"work_pointlng\": 123.021,\n     \"work_pointlat\": 36.25,\n     \"work_address\": \"江苏省苏州市\",\n     \"dest_pointlng\": 125.236,\n     \"dest_pointlat\": 36.23,\n     \"dest_address\": \"英格兰\",\n     \"status\": 1,\n     \"pay_way\": 1,\n     \"total_price\": 100,\n     \"real_price\": \"100.00\",\n     \"is_pay\": 1,\n     \"pay_time\": 1504858382,\n     \"start_time\": \"2017-09-08 周五 16:13\",\n     \"end_time\": 1504858382,\n     \"drv_name\": \"醉生梦死\",\n     \"drv_id\": 3,\n     \"drv_code\": \"121540215\",\n     \"req_car_id\": 11245,\n     \"req_car_type\": \"1\",\n     \"con_car_id\": 1,\n     \"con_car_type\": \"2\",\n     \"type\": 1,\n     \"mile_length\": 100,\n     \"discount_id\": 23,\n     \"create_at\": 1504858382,\n     \"update_at\": 1504858382\n }\n }\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Order.php",
    "groupTitle": "Mine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Order&a=singleWork"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Order&a=WorkStation",
    "title": "获取我的工作台",
    "name": "PackWorkStation",
    "group": "Mine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>分页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "status",
            "description": "<p>状态</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "per_page",
            "description": "<p>当前页数</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n   \"status\": 1,\n   \"msg\": \"返回成功\",\n   \"result\": {\n   \"total\": 9,\n   \"per_page\": 2,\n   \"current_page\": \"3\",\n   \"data\": [\n   {\n      \"air_id\": 7,\n      \"user_id\": 20,\n      \"seller_id\": 20,\n      \"customer_name\": \"俄罗斯\",\n      \"customer_phone\": 1322222222,\n      \"use_car_num\": 10,\n      \"work_at\": 22,\n      \"work_pointlng\": 123.021,\n      \"work_pointlat\": 36.25,\n      \"work_address\": \"江苏省苏州市\",\n      \"dest_pointlng\": 125.236,\n      \"dest_pointlat\": 36.23,\n      \"dest_address\": \"英格兰\",\n      \"status\": 1,\n      \"is_comment\": 2,\n      \"pay_way\": 1,\n      \"total_price\": 100,\n      \"real_price\": \"100.00\",\n      \"is_pay\": 1,\n      \"pay_time\": 1504858382,\n      \"start_time\": 1504858382,\n      \"end_time\": 1504858382,\n      \"drv_name\": \"醉生梦死\",\n      \"drv_id\": 3,\n      \"drv_code\": \"121540215\",\n      \"req_car_id\": 11245,\n      \"req_car_type\": \"1\",\n      \"con_car_id\": 1,\n      \"con_car_type\": \"2\",\n      \"type\": 1,\n      \"mile_length\": 100,\n      \"discount_id\": 23,\n      \"create_at\": 1504858382,\n      \"update_at\": 1504858382\n   },\n   {\n      \"air_id\": 8,\n      \"user_id\": 20,\n      \"seller_id\": 20,\n      \"customer_name\": \"美国\",\n      \"customer_phone\": 1322222222,\n      \"use_car_num\": 10,\n      \"work_at\": 22,\n      \"work_pointlng\": 123.021,\n      \"work_pointlat\": 36.25,\n      \"work_address\": \"江苏省苏州市\",\n      \"dest_pointlng\": 125.236,\n      \"dest_pointlat\": 36.23,\n      \"dest_address\": \"英格兰\",\n      \"status\": 1,\n      \"is_comment\": 2,\n      \"pay_way\": 1,\n      \"total_price\": 100,\n      \"real_price\": \"100.00\",\n      \"is_pay\": 1,\n      \"pay_time\": 1504858382,\n      \"start_time\": 1504858382,\n      \"end_time\": 1504858382,\n      \"drv_name\": \"醉生梦死\",\n      \"drv_id\": 3,\n      \"drv_code\": \"121540215\",\n      \"req_car_id\": 11245,\n      \"req_car_type\": \"1\",\n      \"con_car_id\": 1,\n      \"con_car_type\": \"2\",\n      \"type\": 1,\n      \"mile_length\": 100,\n      \"discount_id\": 23,\n      \"create_at\": 1504858382,\n      \"update_at\": 1504858382\n   }\n   ]\n   }\n   }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Order.php",
    "groupTitle": "Mine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Order&a=WorkStation"
      }
    ]
  },
  {
    "type": "GET",
    "url": "index.php?m=Api&c=PackLine&a=getQualityLine",
    "title": "得到精品路线",
    "name": "getQualityLine",
    "group": "PackLine",
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n\"line_id\" : \"11\",//线路ID\n\"cover_img\" : \"http://xxx.jpg\",//线路风景\n\"line_title\" : \"线路标题\",//线路标题\n\"line_sum\" : \"\",//游玩次数\n\"line_grade\" : \"\",//线路评分\n\"line_level\" : \"\",//线路等级\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/PackLine.php",
    "groupTitle": "PackLine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/index.php?m=Api&c=PackLine&a=getQualityLine"
      }
    ]
  },
  {
    "type": "GET",
    "url": "recommend/showMyRecommInfo",
    "title": "显示我的推荐信息",
    "name": "showMyRecommInfo",
    "group": "Recommend",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "authorization-token",
            "description": "<p>token.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>推荐码</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Recommend.php",
    "groupTitle": "Recommend",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/recommend/showMyRecommInfo"
      }
    ]
  },
  {
    "type": "GET",
    "url": "recommend/showMyRecommList",
    "title": "显示我的推荐列表",
    "name": "showMyRecommList",
    "group": "Recommend",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "authorization-token",
            "description": "<p>token.</p>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "page",
            "defaultValue": "1",
            "description": "<p>页码.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": true,
            "field": "pageSize",
            "defaultValue": "20",
            "description": "<p>每页数据量.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "list",
            "description": "<p>列表</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.avatar",
            "description": "<p>被推荐人头像</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.name",
            "description": "<p>被推荐人名称</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "list.bonus",
            "description": "<p>奖励金</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<p>页码.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "pageSize",
            "description": "<p>每页数据量.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "dataTotal",
            "description": "<p>数据总数.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "pageTotal",
            "description": "<p>总页码数.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Recommend.php",
    "groupTitle": "Recommend",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/recommend/showMyRecommList"
      }
    ]
  },
  {
    "type": "GET",
    "url": "index.php?m=api&c=LocalTalent&a=getLocalTalentDetail",
    "title": "得到当地达人详情",
    "name": "getLocalTalentDetail",
    "group": "Talent",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "optional": false,
            "field": "talent_id",
            "description": "<p>{String}  当地达人</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": "     Http/1.1    200 OK\n{\n \"talent_id\" :    “”，\n \"drv_code\" :    “”，//司导CODE\n \"store_id\" :    “”，//店主ID\n \"user_id\" :    “”，//房东\n \"talent_id\" :    “”，\n \"talent_id\" :    “”，\n \"cover_img\" :   \"http://xxx.jpg\",\n \"video_url\" :   \"http://xxx.mp4\",\n \"name\"      :   \"张三\",  //发布人姓名\n \"id_type\" :   \"\",  //身份标签（有几个身份？）\n \"city\"  :   \"xxxxxx\",//所在城市地址\n \"good_num\"  :   \"111\",//点赞数\n \"desc\"  :   \"111\"//简介\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/LocalTalent.php",
    "groupTitle": "Talent",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/index.php?m=api&c=LocalTalent&a=getLocalTalentDetail"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=LocalTalent&a=getLocalTalentList",
    "title": "得到达人列表",
    "name": "getLocalTalentList",
    "group": "Talent",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "optional": false,
            "field": "token",
            "description": "<p>{String}  token.</p>"
          },
          {
            "group": "Parameter",
            "optional": true,
            "field": "p",
            "description": "<p>{String}    第几页，默认1</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": "     Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"获取成功\",\n     \"result\": [\n         {\n         \"talent_id\" :   \"1\",  //视屏ID\n         \"cover_img\" :   \"http://xxxx.jpg\",  //视屏封面图\n         \"name\"      :   \"张三\",  //发布人姓名\n         \"city\" :   \"东京\",  //发布人所在城市\n         \"id_type\" :   \"\",  //身份标签（有几个身份？）\n         \"good_num\" :   \"111\",  //点赞数\n         },\n         {\n         \"talent_id\" :   \"1\",  //视屏ID\n         \"cover_img\" :   \"http://xxxx.jpg\",  //视屏封面图\n         \"name\"      :   \"张三\",  //发布人姓名\n         \"city\" :   \"东京\",  //发布人所在城市\n         \"id_type\" :   \"\",  //身份标签（有几个身份？）\n         \"good_num\" :   \"111\",  //点赞数\n         }\n     ]\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/LocalTalent.php",
    "groupTitle": "Talent",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=LocalTalent&a=getLocalTalentList"
      }
    ]
  },
  {
    "type": "POST",
    "url": "index.php?m=Api&c=User&a=forgetPassword",
    "title": "忘记密码done",
    "name": "forgetPassword",
    "group": "User",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "      Http/1.1   200 OK\n{\n\"status\": 1,\n\"msg\": \"密码已重置,请重新登录\",\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/index.php?m=Api&c=User&a=forgetPassword"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=User&a=getMine",
    "title": "我的",
    "name": "getMine",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " Http/1.1   200 OK\n{\n     \"status\": 1,\n     \"msg\": \"登陆成功\",\n     \"result\": {\n     \"user_id\": \"1\",\n     \"email\": \"398145059@qq.com\",\n     \"password\": \"e10adc3949ba59abbe56e057f20f883e\",\n     \"sex\": \"1\",\n     \"birthday\": \"2015-12-30\",\n     \"user_money\": \"9999.39\",\n     \"frozen_money\": \"0.00\",\n     \"pay_points\": \"5281\",\n     \"address_id\": \"3\",\n     \"reg_time\": \"1245048540\",\n     \"last_login\": \"1444134213\",\n     \"last_ip\": \"127.0.0.1\",\n     \"qq\": \"3981450598\",\n     \"mobile\": \"13800138000\",\n     \"mobile_validated\": \"0\",\n     \"oauth\": \"\",\n     \"openid\": null,\n     \"head_pic\": \"/Public/upload/head_pic/2015/12-28/56812d56854d0.jpg\",\n     \"province\": \"19\",\n     \"city\": \"236\",\n     \"district\": \"2339\",\n     \"email_validated\": \"1\",\n     \"nickname\": \"的广泛地\"\n     \"token\": \"9f3de86be794f81cdfa5ff3f30b99257\"        // 用于 app 登录\n     \"paypoint\": \"0.00\",\n     \"comment_count\": 0,\n     \"order_count\": 0,\n     \"star\": 0\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "Http/1.1\n{\n    \"status\": -1,\n    \"msg\": \"请填写账号或密码\",\n    \"result\": \"\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=getMine"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=User&a=getMyInfo",
    "title": "获取商家个人信息",
    "name": "getMyInfo",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " Http/1.1   200 OK\n{\n     \"status\": 1,\n     \"msg\": \"返回成功\",\n     \"result\": {\n     \"seller_id\": 20,\n     \"sex\": \"\",\n     \"nickname\": \"13222222222\",\n     \"language\": \"\",\n     \"head_pic\": \"\",\n     \"briefing\": \"\"\n     }\n     }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " Http/1.1   404 NOT FOUND\n{\n    \"status\": -1,\n    \"msg\": \"请填写账号或密码\",\n    \"result\": \"\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=getMyInfo"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=User&a=login",
    "title": "用户登录",
    "name": "login",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>用户名.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "unique_id",
            "description": "<p>手机端唯一标识 类似web pc端sessionid.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pushToken",
            "description": "<p>消息推送token.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "capache",
            "description": "<p>图形验证码.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "push_id",
            "description": "<p>推送id，相当于第三方的reg_id.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "      Http/1.1   200 OK\n{\n\"status\": 1,\n\"msg\": \"登陆成功\",\n\"result\": {\n\"user_id\": \"1\",\n\"email\": \"398145059@qq.com\",\n\"password\": \"e10adc3949ba59abbe56e057f20f883e\",\n\"sex\": \"1\",\n\"birthday\": \"2015-12-30\",\n\"user_money\": \"9999.39\",\n\"frozen_money\": \"0.00\",\n\"pay_points\": \"5281\",\n\"address_id\": \"3\",\n\"reg_time\": \"1245048540\",\n\"last_login\": \"1444134213\",\n\"last_ip\": \"127.0.0.1\",\n\"qq\": \"3981450598\",\n\"mobile\": \"13800138000\",\n\"mobile_validated\": \"0\",\n\"oauth\": \"\",\n\"openid\": null,\n\"head_pic\": \"/Public/upload/head_pic/2015/12-28/56812d56854d0.jpg\",\n\"province\": \"19\",\n\"city\": \"236\",\n\"district\": \"2339\",\n\"email_validated\": \"1\",\n\"nickname\": \"的广泛地\"\n\"token\": \"9f3de86be794f81cdfa5ff3f30b99257\"        // 用于 app 登录\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "      Http/1.1   404 NOT FOUND\n{\n\"status\": -1,\n\"msg\": \"请填写账号或密码\",\n\"result\": \"\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=login"
      }
    ]
  },
  {
    "type": "POST",
    "url": "index.php?m=Api&c=User&a=password",
    "title": "修改用户密码done",
    "name": "password",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>token.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "      Http/1.1   200 OK\n{\n\"status\": 1,\n\"msg\": \"密码修改成功\",\n\"result\": \"\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/index.php?m=Api&c=User&a=password"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=User&a=reg",
    "title": "用户注册",
    "name": "reg",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>手机号/用户名.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "code",
            "description": "<p>手机短信验证码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "push_id",
            "description": "<p>推送id，相当于第三方的reg_id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n\"status\": 1,\n\"msg\": \"注册成功\",\n\"result\": {\n\"user_id\": 146,\n\"email\": \"\",\n\"password\": \"90600d68b0f56d90c4c34284d8dfd138\",\n\"sex\": 0,\n\"birthday\": 0,\n\"user_money\": \"0.00\",\n\"frozen_money\": \"0.00\",\n\"distribut_money\": \"0.00\",\n\"pay_points\": \"0.0000\",\n\"address_id\": 0,\n\"reg_time\": 1504596640,\n\"last_login\": 1504596640,\n\"last_ip\": \"\",\n\"qq\": \"\",\n\"mobile\": \"18451847701\",\n\"mobile_validated\": 1,\n\"oauth\": \"\",\n\"openid\": null,\n\"unionid\": null,\n\"head_pic\": null,\n\"province\": 0,\n\"city\": 0,\n\"district\": 0,\n\"email_validated\": 0,\n\"nickname\": \"18451847701\",\n\"level\": 1,\n\"discount\": \"1.00\",\n\"total_amount\": \"0.00\",\n\"is_lock\": 0,\n\"is_distribut\": 1,\n\"first_leader\": 0,\n\"second_leader\": 0,\n\"third_leader\": 0,\n\"fourth_leader\": null,\n\"fifth_leader\": null,\n\"sixth_leader\": null,\n\"seventh_leader\": null,\n\"token\": \"c34ba58aec24003f0abec19ae2688c86\",\n\"address\": null,\n\"pay_passwd\": null,\n\"pre_pay_points\": \"0.0000\",\n\"optional\": \"0.0000\",\n\"vipid\": 0,\n\"paypoint\": \"0.00\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n\"status\": -1,\n\"msg\": \"账号已存在\",\n\"result\": \"\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=reg"
      }
    ]
  },
  {
    "type": "POST",
    "url": "index.php?m=Api&c=User&a=thirdLogin",
    "title": "",
    "name": "thirdLogin",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "unique_id",
            "description": "<p>第三方唯一标识</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "from",
            "description": "<p>来源 wx weibo alipay</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "nickname",
            "description": "<p>第三方返回昵称</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "head_pic",
            "description": "<p>头像路径</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-response",
          "content": "     Http/1.1    200 Ok\n{\n\"status\": 1,\n\"msg\": \"登陆成功\",\n\"result\": {\n\"user_id\": \"12\",\n\"email\": \"\",\n\"password\": \"\",\n\"sex\": \"0\",\n\"birthday\": \"0000-00-00\",\n\"user_money\": \"0.00\",\n\"frozen_money\": \"0.00\",\n\"pay_points\": \"0\",\n\"address_id\": \"0\",\n\"reg_time\": \"1452331498\",\n\"last_login\": \"0\",\n\"last_ip\": \"\",\n\"qq\": \"\",\n\"mobile\": \"\",\n\"mobile_validated\": \"0\",\n\"oauth\": \"wx\",\n\"openid\": \"2\",\n\"head_pic\": null,\n\"province\": \"0\",\n\"city\": \"0\",\n\"district\": \"0\",\n\"email_validated\": \"0\",\n\"nickname\": \"\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-response",
          "content": "           Http/1.1    200 OK\n{\n      \"status\": -1,\n      \"msg\": \"参数有误\",\n      \"result\": \"\"\n      }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/index.php?m=Api&c=User&a=thirdLogin"
      }
    ]
  },
  {
    "type": "POST",
    "url": "index.php?m=Api&c=User&a=updateUserInfo",
    "title": "更改用户信息",
    "name": "updateUserInfo",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "nickname",
            "description": "<p>昵称</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "qq",
            "description": "<p>QQ号码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "head_pic",
            "description": "<p>头像URL</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "sex",
            "description": "<p>性别（0 保密 1 男 2 女）</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "birthday",
            "description": "<p>生日 （2015-01-05）</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "province",
            "description": "<p>省份ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "city",
            "description": "<p>城市ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "district",
            "description": "<p>地区ID</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>token</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503/index.php?m=Api&c=User&a=updateUserInfo"
      }
    ]
  }
] });
