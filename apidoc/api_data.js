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
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=auth_img",
    "title": "认证图片done",
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
    "title": "认证图片上传done",
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
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"上传成功\",\n     \"result\": {}\n}",
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
    "title": "司导首页done",
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
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"返回成功\",\n     \"result\": {\n         \"is_seller_auth\": 0,\n         \"is_drv_auth\": 1,\n         \"is_home_auth\": 0\n     }\n }",
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
    "type": "GET",
    "url": "/index.php?m=Api&c=User&a=getHxSingleUser",
    "title": "获取环信单个用户信息done",
    "name": "GetHxSingleUser",
    "group": "Mine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          },
          {
            "group": "Parameter",
            "optional": false,
            "field": "hx_user",
            "description": "<p>环信用户名</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n    \"status\": 1,\n    \"msg\": \"返回成功！\",\n    \"result\": []\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "Mine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=getHxSingleUser"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=User&a=getSellerHx",
    "title": "获取环信用户done",
    "name": "GetSellerHx",
    "group": "Mine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
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
          "content": " Http/1.1    200 OK\n{\n \"status\": 1,\n \"msg\": \"返回成功\",\n \"result\": {\n     \"nickname\": \"13222222222\",\n     \"head_pic\": \"112354521412\",\n     \"hx_user_name\": \"d53fa014dabdff84cf9d616b8cc1fabf\"\n }\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "Mine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=getSellerHx"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=User&a=getWithdrawalList",
    "title": "获取提现列表done",
    "name": "GetWithdrawalList",
    "group": "Mine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          },
          {
            "group": "Parameter",
            "optional": false,
            "field": "pagesize",
            "description": "<p>每页条数</p>"
          },
          {
            "group": "Parameter",
            "optional": false,
            "field": "page",
            "description": "<p>页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>状态：-2删除作废-1审核失败0申请中1审核通过2已转款完成</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n    \"status\": 1,\n    \"msg\": \"返回成功！\",\n    \"result\": []\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "Mine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=getWithdrawalList"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=User&a=getWithdrawals",
    "title": "获取提现金额done",
    "name": "GetWithdrawals",
    "group": "Mine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
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
            "optional": false,
            "field": "status",
            "description": "<p>状态：-2删除作废-1审核失败0申请中1审核通过2已转款完成</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"返回成功\",\n     \"result\": {\n         \"seller_id\": 20,\n         \"drv_money\": 100\n     }\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "Mine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=getWithdrawals"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Order&a=missOrder",
    "title": "获取错过订单done",
    "name": "MissOrder",
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
            "field": "pagesize",
            "description": "<p>页显示数</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "page",
            "description": "<p>页数</p>"
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
          "content": " Http/1.1    200 OK\n {\n   \"status\": 1,\n   \"msg\": \"返回成功！\",\n   \"result\": {\n       \"data\": [\n           {\n               \"type\": 1,\n               \"work_address\": \"江苏省苏州市\",\n               \"dest_address\": \"英格兰\",\n               \"real_price\": \"100.00\",\n               \"create_at\": \"2017-09-14\"\n           },\n           {\n               \"type\": 1,\n               \"work_address\": \"江苏省苏州市\",\n               \"dest_address\": \"英格兰\",\n               \"real_price\": \"100.00\",\n               \"create_at\": \"2017-09-14\"\n           },\n           {\n               \"type\": 1,\n               \"work_address\": \"江苏省苏州市\",\n               \"dest_address\": \"英格兰\",\n               \"real_price\": \"100.00\",\n               \"create_at\": \"2017-09-14\"\n           },\n           {\n               \"type\": 1,\n               \"work_address\": \"江苏省苏州市\",\n               \"dest_address\": \"英格兰\",\n               \"real_price\": \"100.00\",\n               \"create_at\": \"2017-09-14\"\n           },\n           {\n               \"type\": 1,\n               \"work_address\": \"江苏省苏州市\",\n               \"dest_address\": \"英格兰\",\n               \"real_price\": \"100.00\",\n               \"create_at\": \"2017-09-14\"\n           },\n           {\n               \"type\": 1,\n               \"work_address\": \"江苏省苏州市\",\n               \"dest_address\": \"英格兰\",\n               \"real_price\": \"100.00\",\n               \"create_at\": \"2017-09-14\"\n           },\n           {\n               \"type\": 1,\n               \"work_address\": \"江苏省苏州市\",\n               \"dest_address\": \"英格兰\",\n               \"real_price\": \"100.00\",\n               \"create_at\": \"2017-09-14\"\n           },\n           {\n               \"type\": 1,\n               \"work_address\": \"江苏省苏州市\",\n               \"dest_address\": \"英格兰\",\n               \"real_price\": \"100.00\",\n               \"create_at\": \"2017-09-14\"\n           },\n           {\n               \"type\": 1,\n               \"work_address\": \"江苏省苏州市\",\n               \"dest_address\": \"英格兰\",\n               \"real_price\": \"100.00\",\n               \"create_at\": \"2017-09-14\"\n           },\n           {\n               \"type\": 1,\n               \"work_address\": \"江苏省苏州市\",\n               \"dest_address\": \"英格兰\",\n               \"real_price\": \"100.00\",\n               \"create_at\": \"2017-09-14\"\n           }\n       ],\n       \"count\": 21\n   }\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Order.php",
    "groupTitle": "Mine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Order&a=missOrder"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=Order&a=order_refuse",
    "title": "拒绝按钮done",
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
    "title": "接单按钮done",
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
    "title": "获取我的订单done",
    "name": "PackMyOrder",
    "group": "Mine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pagesize",
            "description": "<p>页面值</p>"
          },
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
            "description": "<p>状态 3,4 表示状态的数据</p>"
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
    "title": "获取详细订单done",
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
    "title": "获取我的工作台done",
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
    "type": "POST",
    "url": "/index.php?m=Api&c=User&a=postWithdrawals",
    "title": "提交提现申请done",
    "name": "PostWithdrawals",
    "group": "Mine",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "optional": false,
            "field": "token",
            "description": "<p>token值</p>"
          },
          {
            "group": "Parameter",
            "optional": false,
            "field": "money",
            "description": "<p>提现金额</p>"
          },
          {
            "group": "Parameter",
            "optional": false,
            "field": "distill_way",
            "description": "<p>提现方式</p>"
          },
          {
            "group": "Parameter",
            "optional": false,
            "field": "account",
            "description": "<p>提现账户</p>"
          },
          {
            "group": "Parameter",
            "optional": false,
            "field": "account_name",
            "description": "<p>提现人用户名</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n    \"status\": 1,\n    \"msg\": \"返回成功！\",\n    \"result\": []\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "Mine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=postWithdrawals"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=Order&a=updateTime",
    "title": "获取我的工作台done",
    "name": "UpdateTime",
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
            "description": "<p>air_id值</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "time_new",
            "description": "<p>小时，格式 18:00</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": "Http/1.1    200 OK\n {\n    \"status\": 1,\n    \"msg\": \"返回成功!\",\n    \"result\": {}\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Order.php",
    "groupTitle": "Mine",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Order&a=updateTime"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=actionCar",
    "title": "新增/修改车辆done",
    "name": "CarInfo",
    "group": "Pack",
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
            "optional": true,
            "field": "car_id",
            "description": "<p>修改时传入</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "car_img",
            "description": "<p>车辆图片，多个以|分隔</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "brand_id",
            "description": "<p>车辆品牌id</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "car_type_id",
            "description": "<p>车型id</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "seat_num",
            "description": "<p>座位数</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "car_year",
            "description": "<p>汽车年限</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "is_customer_insurance",
            "description": "<p>是否有保险</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1  200 OK\n{\n  \"status\": 1,\n  \"msg\": \"返回成功！\",\n  \"result\": {}\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=actionCar"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=collegeList",
    "title": "司导学院文章列表done",
    "name": "College",
    "group": "Pack",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pagesize",
            "description": "<p>展示数目</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "page",
            "description": "<p>页数</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=collegeList"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=college&id=19",
    "title": "司导学院文章详情done",
    "name": "College",
    "group": "Pack",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>文章列表的article_id值</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=college&id=19"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=Pack&a=delLine",
    "title": "删除线路done",
    "name": "DelLine",
    "group": "Pack",
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
            "field": "line_id",
            "description": "<p>line_id值</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"删除成功！\",\n     \"result\": {}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=delLine"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=carInfo",
    "title": "获取车辆详情done",
    "name": "DriverCarInfo",
    "group": "Pack",
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
            "field": "car_id",
            "description": "<p>车辆id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"返回成功\",\n     \"result\": {\n     \"car_id\": 3,\n     \"seller_id\": 20,\n     \"brand_id\": 1,\n     \"car_type_id\": 29,\n     \"seat_num\": 2,\n     \"car_year\": \"20\",\n     \"is_customer_insurance\": 0,\n     \"create_at\": \"\",\n     \"update_at\": \"\",\n     \"is_state\": 0,\n     \"plate_number\": \"苏A-33333\",\n     \"seat_size\": \"小型车\",\n     \"car_img\": \"\",\n     \"pass_content\": \"\",\n     \"brand_name\": \"大众\",\n     \"car_type_name\": \"桑塔纳\"\n   }\n   }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=carInfo"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=confirmOrder",
    "title": "确认订单done",
    "name": "DriverConfirmOrder",
    "group": "Pack",
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
            "description": "<p>air_id值</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"订单确认成功！\",\n     \"result\": {}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=confirmOrder"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=Pack&a=delMyCar",
    "title": "删除车辆done",
    "name": "DriverDelMyCar",
    "group": "Pack",
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
            "field": "car_id",
            "description": "<p>车辆id，多个删除用逗号隔开</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"删除成功！\",\n     \"result\": {}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=delMyCar"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=getMyCar",
    "title": "获得我的车辆done",
    "name": "DriverGetMyCar",
    "group": "Pack",
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
          "content": " Http/1.1    200 OK\n{\n  \"status\": 1,\n  \"msg\": \"返回成功\",\n  \"result\": [\n  {\n     \"car_id\": 3,\n     \"seller_id\": 20,\n     \"brand_id\": 1,\n     \"car_type_id\": null,\n     \"seat_num\": 2,\n     \"car_year\": \"20\",\n     \"is_customer_insurance\": 0,\n     \"create_at\": null,\n     \"update_at\": null,\n     \"is_state\": 0,\n     \"plate_number\": \"苏A-33333\",\n     \"seat_size\": \"小型车\",\n     \"car_img\": null,\n     \"pass_content\": null\n  },\n  {\n     \"car_id\": 7,\n     \"seller_id\": 20,\n     \"brand_id\": 1,\n     \"car_type_id\": null,\n     \"seat_num\": 5,\n     \"car_year\": \"10\",\n     \"is_customer_insurance\": 1,\n     \"create_at\": null,\n     \"update_at\": null,\n     \"is_state\": 1,\n     \"plate_number\": \"苏A-666667\",\n     \"seat_size\": \"中型车\",\n     \"car_img\": \"312154\",\n     \"pass_content\": \"\"\n  }\n  ]\n  }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=getMyCar"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=helpCenter&pagesize=",
    "title": "司导-帮助中心done",
    "name": "DriverHelpCenter",
    "group": "Pack",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pagesize",
            "description": "<p>显示条数</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n \"status\": 1,\n \"msg\": \"返回成功！\",\n \"result\": {\n \"total\": 2,\n \"per_page\": 10,\n \"current_page\": 1,\n \"data\": [\n {\n     \"article_id\": 15,\n     \"cat_id\": 22,\n     \"title\": \"当地人服务安全吗\",\n     \"content\": \"&lt;p&gt;安全的&lt;/p&gt;\",\n     \"author\": \"\",\n     \"author_email\": \"\",\n     \"keywords\": \"\",\n     \"article_type\": 2,\n     \"is_open\": 0,\n     \"add_time\": 1505266952,\n     \"file_url\": \"\",\n     \"open_type\": 0,\n     \"link\": \"\",\n     \"description\": \"\",\n     \"click\": 1188,\n     \"publish_time\": 1505318400,\n     \"thumb\": \"\"\n },\n {\n     \"article_id\": 16,\n     \"cat_id\": 22,\n     \"title\": \"如何购买当地人服务？\",\n     \"content\": \"&lt;p&gt;请联系客服人员咨询&lt;/p&gt;\",\n     \"author\": \"\",\n     \"author_email\": \"\",\n     \"keywords\": \"\",\n     \"article_type\": 2,\n     \"is_open\": 0,\n     \"add_time\": 1505267021,\n     \"file_url\": \"\",\n     \"open_type\": 0,\n     \"link\": \"\",\n     \"description\": \"\",\n     \"click\": 1118,\n     \"publish_time\": 1505318400,\n     \"thumb\": \"\"\n  }\n     ]\n }\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=helpCenter&pagesize="
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=Pack&a=overtime",
    "title": "申请加班done",
    "name": "DriverOvertime",
    "group": "Pack",
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
            "description": "<p>air_id值</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "add_reason",
            "description": "<p>加班理由</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"申请成功！\",\n     \"result\": {}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=overtime"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=getArea",
    "title": "获取国家省市区done",
    "name": "GetArea",
    "group": "Pack",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "continent",
            "description": "<p>大洲id 0为获取所有大洲</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "country",
            "description": "<p>国家id 0为获取所有国家</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "province",
            "description": "<p>省id 0为获取所有省</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n  \"status\": 1,\n  \"msg\": \"返回成功！\",\n  \"result\":\n[\n      {\n          \"id\": 2,\n          \"name\": \"北京市\",\n          \"level\": 2,\n          \"parent_id\": 1,\n          \"is_hot\": 0,\n          \"country_id\": 7\n      },\n      {\n          \"id\": 300,\n          \"name\": \"县\",\n          \"level\": 2,\n          \"parent_id\": 1,\n          \"is_hot\": 0,\n          \"country_id\": 7\n      },\n      {\n          \"id\": 47498,\n          \"name\": \"海淀区\",\n          \"level\": 2,\n          \"parent_id\": 1,\n          \"is_hot\": 1,\n          \"country_id\": 7\n      }\n  ]\n  }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=getArea"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=getLinelist",
    "title": "线路列表/我的服务done",
    "name": "GetLinelist",
    "group": "Pack",
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
            "field": "pagesize",
            "description": "<p>显示条数</p>"
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
            "field": "is_state",
            "description": "<p>0:待审核1:审核通过2:已拒绝</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "result",
            "description": "<p>返回成功</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n {\n   \"status\": 1,\n   \"msg\": \"返回成功！\",\n   \"result\": {\n       \"total\": 4,\n       \"per_page\": 10,\n       \"current_page\": 1,\n       \"data\": [\n           {\n               \"line_id\": 5,\n               \"line_title\": \"墨西哥\",\n               \"line_price\": \"500.00RMB\",\n               \"seller_id\": 20,\n               \"car_id\": \"3\",\n               \"line_highlights\": \"亮点多多\",\n               \"line_detail\": [\n                   {\n                       \"date_num\": 1,\n                       \"summary\": \"这是摘要1\",\n                       \"port_detail\": [\n                           {\n                               \"port_num\": 1,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第一站1\"\n                           },\n                           {\n                               \"port_num\": 2,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第二站2\"\n                           }\n                       ]\n                   },\n                   {\n                       \"date_num\": 2,\n                       \"summary\": \"这是摘要1\",\n                       \"port_detail\": [\n                           {\n                               \"port_num\": 1,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第一站1\"\n                           },\n                           {\n                               \"port_num\": 2,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第二站2\"\n                           }\n                       ]\n                   }\n               ],\n               \"create_at\": null,\n               \"update_at\": null,\n               \"is_comm\": 0,\n               \"cover_img\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n               \"is_state\": 0,\n               \"pass_content\": null,\n               \"is_del\": 0\n           },\n           {\n               \"line_id\": 4,\n               \"line_title\": \"菲律宾\",\n               \"line_price\": \"500.00RMB\",\n               \"seller_id\": 20,\n               \"car_id\": \"3\",\n               \"line_highlights\": \"亮点多多\",\n               \"line_detail\": [\n                   {\n                       \"date_num\": 1,\n                       \"summary\": \"这是摘要1\",\n                       \"port_detail\": [\n                           {\n                               \"port_num\": 1,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第一站1\"\n                           },\n                           {\n                               \"port_num\": 2,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第二站2\"\n                           }\n                       ]\n                   },\n                   {\n                       \"date_num\": 2,\n                       \"summary\": \"这是摘要1\",\n                       \"port_detail\": [\n                           {\n                               \"port_num\": 1,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第一站1\"\n                           },\n                           {\n                               \"port_num\": 2,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第二站2\"\n                           }\n                       ]\n                   }\n               ],\n               \"create_at\": null,\n               \"update_at\": null,\n               \"is_comm\": 0,\n               \"cover_img\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n               \"is_state\": 0,\n               \"pass_content\": null,\n               \"is_del\": 0\n           },\n           {\n               \"line_id\": 3,\n               \"line_title\": \"新加坡\",\n               \"line_price\": \"500.00RMB\",\n               \"seller_id\": 20,\n               \"car_id\": \"3\",\n               \"line_highlights\": \"亮点多多\",\n               \"line_detail\": [\n                   {\n                       \"date_num\": 1,\n                       \"summary\": \"这是摘要1\",\n                       \"port_detail\": [\n                           {\n                               \"port_num\": 1,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第一站1\"\n                           },\n                           {\n                               \"port_num\": 2,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第二站2\"\n                           }\n                       ]\n                   },\n                   {\n                       \"date_num\": 2,\n                       \"summary\": \"这是摘要1\",\n                       \"port_detail\": [\n                           {\n                               \"port_num\": 1,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第一站1\"\n                           },\n                           {\n                               \"port_num\": 2,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第二站2\"\n                           }\n                       ]\n                   }\n               ],\n               \"create_at\": null,\n               \"update_at\": null,\n               \"is_comm\": 0,\n               \"cover_img\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n               \"is_state\": 0,\n               \"pass_content\": null,\n               \"is_del\": 0\n           },\n           {\n               \"line_id\": 2,\n               \"line_title\": \"菲律宾\",\n               \"line_price\": \"500.00RMB\",\n               \"seller_id\": 20,\n               \"car_id\": \"3\",\n               \"line_highlights\": \"亮点多多\",\n               \"line_detail\": [\n                   {\n                       \"date_num\": 1,\n                       \"summary\": \"这是摘要1\",\n                       \"port_detail\": [\n                           {\n                               \"port_num\": 1,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第一站1\"\n                           },\n                           {\n                               \"port_num\": 2,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第二站2\"\n                           }\n                       ]\n                   },\n                   {\n                       \"date_num\": 2,\n                       \"summary\": \"这是摘要1\",\n                       \"port_detail\": [\n                           {\n                               \"port_num\": 1,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第一站1\"\n                           },\n                           {\n                               \"port_num\": 2,\n                               \"port_coverImg\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n                               \"port_detail\": \"这是第二站2\"\n                           }\n                       ]\n                   }\n               ],\n               \"create_at\": null,\n               \"update_at\": null,\n               \"is_comm\": 0,\n               \"cover_img\": \"http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png\",\n               \"is_state\": 0,\n               \"pass_content\": null,\n               \"is_del\": 0\n           }\n       ]\n   }\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=getLinelist"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=getUserSingle",
    "title": "获取单个用户信息done",
    "name": "GetLinelist",
    "group": "Pack",
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
            "field": "pagesize",
            "description": "<p>显示条数</p>"
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
            "field": "is_state",
            "description": "<p>0:待审核1:审核通过2:已拒绝</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "result",
            "description": "<p>返回成功</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n {\n   \"status\": 1,\n   \"msg\": \"返回成功！\",\n   \"result\": {\n       \"total\": 4,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Emchat.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=getUserSingle"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=getOvertime",
    "title": "获取加班时间done",
    "name": "GetOvertime",
    "group": "Pack",
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
            "description": "<p>air_id值</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"申请成功！\",\n     \"result\": {}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=getOvertime"
      }
    ]
  },
  {
    "type": "GET",
    "url": "/index.php?m=Api&c=Pack&a=lineDetail&token=37cd1e8ea0c8b81f1fcc03d178625599&line_id=8",
    "title": "线路详情done",
    "name": "LineDetail",
    "group": "Pack",
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
            "field": "line_id",
            "description": "<p>line_id值</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=lineDetail&token=37cd1e8ea0c8b81f1fcc03d178625599&line_id=8"
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
    "url": "/index.php?m=Api&c=Pack&a=getCarBar",
    "title": "获取车辆信息done",
    "name": "PackGetCarBar",
    "group": "Pack",
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n  \"status\": 1,\n  \"msg\": \"返回成功\",\n  \"result\": [\n  {\n     \"id\": 2,\n     \"car_info\": \"丰田\",\n     \"pid\": 0,\n     \"status\": 1\n  }\n  ]\n  }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=getCarBar"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=Pack&a=postComment",
    "title": "提交评价done",
    "name": "PostComment",
    "group": "Pack",
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
            "field": "score",
            "description": "<p>评分值</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "description": "<p>评价内容</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单id</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "is_anonymous",
            "description": "<p>是否匿名</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"返回成功！\",\n     \"result\": []\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=postComment"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=Pack&a=publishLine",
    "title": "发布线路done",
    "name": "PublishLine",
    "group": "Pack",
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
            "field": "line_title",
            "description": "<p>线路标题</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "line_price",
            "description": "<p>线路价格</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "car_id",
            "description": "<p>车辆id,多个以逗号隔开</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "cover_img",
            "description": "<p>封面图片</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "bright_dot",
            "description": "<p>亮点</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "line_detail",
            "description": "<p>线路详情 示例： [{&quot;date_num&quot;:1,&quot;summary&quot;:&quot;\\u8fd9\\u662f\\u6458\\u89811&quot;,&quot;port_detail&quot;:[{&quot;port_num&quot;:1,&quot;port_coverImg&quot;:&quot;http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png&quot;,&quot;port_detail&quot;:&quot;\\u8fd9\\u662f\\u7b2c\\u4e00\\u7ad91&quot;},{&quot;port_num&quot;:2,&quot;port_coverImg&quot;:&quot;http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png&quot;,&quot;port_detail&quot;:&quot;\\u8fd9\\u662f\\u7b2c\\u4e8c\\u7ad92&quot;}]},{&quot;date_num&quot;:2,&quot;summary&quot;:&quot;\\u8fd9\\u662f\\u6458\\u89811&quot;,&quot;port_detail&quot;:[{&quot;port_num&quot;:1,&quot;port_coverImg&quot;:&quot;http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png&quot;,&quot;port_detail&quot;:&quot;\\u8fd9\\u662f\\u7b2c\\u4e00\\u7ad91&quot;},{&quot;port_num&quot;:2,&quot;port_coverImg&quot;:&quot;http://ovwiqces1.bkt.clouddn.com/cee31c276bb2c1ee71391ac799ed78cc.png&quot;,&quot;port_detail&quot;:&quot;\\u8fd9\\u662f\\u7b2c\\u4e8c\\u7ad92&quot;}]}]</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "line_id",
            "description": "<p>线路id 为空时为添加，存在时为修改</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n   \"status\": 1,\n   \"msg\": \"发布成功！\",\n   \"result\": []\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Pack.php",
    "groupTitle": "Pack",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Pack&a=publishLine"
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
    "url": "/index.php?m=Api&c=Sms&a=getCountry",
    "title": "获得国家区号done",
    "name": "GetCountry",
    "group": "SmsInfo",
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"返回成功！\",\n     \"result\": [\n     {\n     \"id\": 214,\n     \"country\": \"中国\",\n     \"mobile_prefix\": \"86\",\n     \"area\": \"亚洲\"\n     },\n     {\n     \"id\": 215,\n     \"country\": \"香港\",\n     \"mobile_prefix\": \"852\",\n     \"area\": \"亚洲\"\n     },\n     {\n     \"id\": 216,\n     \"country\": \"澳门\",\n     \"mobile_prefix\": \"853\",\n     \"area\": \"亚洲\"\n     },\n     {\n     \"id\": 217,\n     \"country\": \"台湾\",\n     \"mobile_prefix\": \"886\",\n     \"area\": \"亚洲\"\n     },\n     {\n     \"id\": 218,\n     \"country\": \"马来西亚\",\n     \"mobile_prefix\": \"60\",\n     \"area\": \"亚洲\"\n     },\n     {\n     \"id\": 219,\n     \"country\": \"印度尼西亚\",\n     \"mobile_prefix\": \"62\",\n     \"area\": \"亚洲\"\n     },\n     {\n     \"id\": 220,\n     \"country\": \"菲律宾\",\n     \"mobile_prefix\": \"63\",\n     \"area\": \"亚洲\"\n     },\n     {\n     \"id\": 402,\n     \"country\": \"瓦努阿图\",\n     \"mobile_prefix\": \"678\",\n     \"area\": \"大洋洲\"\n     },\n     {\n     \"id\": 403,\n     \"country\": \"斐济\",\n     \"mobile_prefix\": \"679\",\n     \"area\": \"大洋洲\"\n     },\n     {\n     \"id\": 404,\n     \"country\": \"科克群岛\",\n     \"mobile_prefix\": \"682\",\n     \"area\": \"大洋洲\"\n     },\n     {\n     \"id\": 405,\n     \"country\": \"纽埃岛\",\n     \"mobile_prefix\": \"683\",\n     \"area\": \"大洋洲\"\n     },\n     {\n     \"id\": 406,\n     \"country\": \"东萨摩亚\",\n     \"mobile_prefix\": \"684\",\n     \"area\": \"大洋洲\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Sms.php",
    "groupTitle": "SmsInfo",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Sms&a=getCountry"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=Sms&a=send",
    "title": "发送国家验证码done",
    "name": "PostSend",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "country_code",
            "description": "<p>区号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "opt",
            "description": "<p>[reg] 为注册，空或其他为登陆或忘记密码</p>"
          }
        ]
      }
    },
    "group": "SmsInfo",
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"发送成功\",\n     \"result\": []\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/Sms.php",
    "groupTitle": "SmsInfo",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=Sms&a=send"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=User&a=suggestionFeedback",
    "title": "意见反馈done",
    "name": "SuggestionFeedback",
    "group": "Suggestion",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "optional": false,
            "field": "suggest_id",
            "description": "<p>意见类型id</p>"
          },
          {
            "group": "Parameter",
            "optional": false,
            "field": "content",
            "description": "<p>要反馈的内容</p>"
          },
          {
            "group": "Parameter",
            "optional": false,
            "field": "img_url",
            "description": "<p>图片url</p>"
          },
          {
            "group": "Parameter",
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
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"申请成功！\",\n     \"result\": {}\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "Suggestion",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=suggestionFeedback"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=User&a=suggestion_type&limit=",
    "title": "获取意见反馈类型done",
    "name": "suggestion_type",
    "group": "Suggestion",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "limit",
            "description": "<p>显示条数</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response",
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"返回成功！\",\n     \"result\": [\n     \"功能异常\",\n     \"体验问题\",\n     \"新功能建议\",\n     \"其他\"\n      ]\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "Suggestion",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=suggestion_type&limit="
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
    "url": "/index.php?m=Api&c=User&a=updateMobile",
    "title": "【更换手机号】新手机修改done",
    "name": "UpdateMobile",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "optional": false,
            "field": "username",
            "description": "<p>手机号码【区号必须】</p>"
          },
          {
            "group": "Parameter",
            "optional": false,
            "field": "country_code",
            "description": "<p>区号</p>"
          },
          {
            "group": "Parameter",
            "optional": false,
            "field": "code",
            "description": "<p>验证码</p>"
          },
          {
            "group": "Parameter",
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
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"验证成功！\",\n     \"result\": []\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=updateMobile"
      }
    ]
  },
  {
    "type": "POST",
    "url": "/index.php?m=Api&c=User&a=checkSms",
    "title": "【更换手机号】验证原手机号done",
    "name": "UserCheckSms",
    "group": "User",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "optional": false,
            "field": "username",
            "description": "<p>手机号码【不带区号】</p>"
          },
          {
            "group": "Parameter",
            "optional": false,
            "field": "code",
            "description": "<p>验证码</p>"
          },
          {
            "group": "Parameter",
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
          "content": " Http/1.1    200 OK\n{\n     \"status\": 1,\n     \"msg\": \"验证成功！\",\n     \"result\": []\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=checkSms"
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
    "title": "我的done",
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
    "title": "获取商家个人信息done",
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
          "content": " Http/1.1   200 OK\n{\n     \"status\": 1,\n     \"msg\": \"返回成功\",\n     \"result\": {\n     \"seller_id\": 20,\n     \"sex\": \"\",\n     \"nickname\": \"13222222222\",\n     \"language\": \"\",\n     \"head_pic\": \"\",\n     \"briefing\": \"\",\n      \"img_url\" :{\n     }\n     }\n     }",
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
    "title": "用户登录done",
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
          "content": "Http/1.1   200 OK\n{\n  \"status\": 1,\n  \"msg\": \"登陆成功\",\n  \"result\": {\n  \"user_id\": \"1\",\n  \"email\": \"398145059@qq.com\",\n  \"password\": \"e10adc3949ba59abbe56e057f20f883e\",\n  \"sex\": \"1\",\n  \"birthday\": \"2015-12-30\",\n  \"user_money\": \"9999.39\",\n  \"frozen_money\": \"0.00\",\n  \"pay_points\": \"5281\",\n  \"address_id\": \"3\",\n  \"reg_time\": \"1245048540\",\n  \"last_login\": \"1444134213\",\n  \"last_ip\": \"127.0.0.1\",\n  \"qq\": \"3981450598\",\n  \"mobile\": \"13800138000\",\n  \"mobile_validated\": \"0\",\n  \"oauth\": \"\",\n  \"openid\": null,\n  \"head_pic\": \"/Public/upload/head_pic/2015/12-28/56812d56854d0.jpg\",\n  \"province\": \"19\",\n  \"city\": \"236\",\n  \"district\": \"2339\",\n  \"email_validated\": \"1\",\n  \"nickname\": \"的广泛地\"\n  \"token\": \"9f3de86be794f81cdfa5ff3f30b99257\"        // 用于 app 登录\n  }\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": " Http/1.1   404 NOT FOUND\n{\n   \"status\": -1,\n   \"msg\": \"请填写账号或密码\",\n   \"result\": \"\"\n}",
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
    "url": "/index.php?m=Api&c=User&a=updateInfo",
    "title": "更新用户信息done",
    "name": "postUpdateInfo",
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
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "head_pic",
            "description": "<p>头像</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>昵称</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "sex",
            "description": "<p>性别 0 保密 1 男 2 女</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "language",
            "description": "<p>语言</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "briefing",
            "description": "<p>简介</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "img_url",
            "description": "<p>多个用| 隔开</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "area",
            "description": "<p>示例：{&quot;country&quot; : &quot;1&quot;,&quot;province&quot;: &quot;100&quot;,&quot;city&quot;: &quot;200&quot;}</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": " Http/1.1   200 OK\n{\n \"status\": 1,\n \"msg\": \"修改成功！\",\n \"result\": {}\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "application/api/controller/User.php",
    "groupTitle": "User",
    "sampleRequest": [
      {
        "url": "http://shz.api.bussiness.ruitukeji.cn:8503//index.php?m=Api&c=User&a=updateInfo"
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
            "field": "country_code",
            "description": "<p>国家区号</p>"
          },
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
          "content": " HTTP/1.1 200 OK\n{\n    \"status\": 1,\n    \"msg\": \"注册成功\",\n    \"result\": {\n    \"user_id\": 146,\n    \"email\": \"\",\n    \"password\": \"90600d68b0f56d90c4c34284d8dfd138\",\n    \"sex\": 0,\n    \"birthday\": 0,\n    \"user_money\": \"0.00\",\n    \"frozen_money\": \"0.00\",\n    \"distribut_money\": \"0.00\",\n    \"pay_points\": \"0.0000\",\n    \"address_id\": 0,\n    \"reg_time\": 1504596640,\n    \"last_login\": 1504596640,\n    \"last_ip\": \"\",\n    \"qq\": \"\",\n    \"mobile\": \"18451847701\",\n    \"mobile_validated\": 1,\n    \"oauth\": \"\",\n    \"openid\": null,\n    \"unionid\": null,\n    \"head_pic\": null,\n    \"province\": 0,\n    \"city\": 0,\n    \"district\": 0,\n    \"email_validated\": 0,\n    \"nickname\": \"18451847701\",\n    \"level\": 1,\n    \"discount\": \"1.00\",\n    \"total_amount\": \"0.00\",\n    \"is_lock\": 0,\n    \"is_distribut\": 1,\n    \"first_leader\": 0,\n    \"second_leader\": 0,\n    \"third_leader\": 0,\n    \"fourth_leader\": null,\n    \"fifth_leader\": null,\n    \"sixth_leader\": null,\n    \"seventh_leader\": null,\n    \"token\": \"c34ba58aec24003f0abec19ae2688c86\",\n    \"address\": null,\n    \"pay_passwd\": null,\n    \"pre_pay_points\": \"0.0000\",\n    \"optional\": \"0.0000\",\n    \"vipid\": 0,\n    \"paypoint\": \"0.00\"\n}\n}",
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
  }
] });
