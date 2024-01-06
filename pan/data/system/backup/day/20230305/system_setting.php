<?php exit;?>{
    "systemPassword": "aVKh9atDuubAzrYTNGEw",
    "systemName": "深网云",
    "systemDesc": "——SW.资源管理器",
    "pathHidden": "Thumb.db,.DS_Store,.gitignore,.git,.oexe,.user.ini,controller,install.lock,system_setting.php,system_member.php,utils.php,static,.js,.html,data,app,apps.php,plugins,static,system,config,index.php,User",
    "autoLogin": "0",
    "needCheckCode": "0",
    "firstIn": "desktop",
    "newUserApp": "OnlyOffice 在线编辑器,Photopea 在线PS,一起写office,微信,365日历,石墨文档,ProcessOn,计算器,人才港,人才港影视,OfficeConverter",
    "newUserFolder": "我的文档,图片,视频,音乐",
    "newGroupFolder": "share,文档,图片资料,视频资料",
    "groupShareFolder": "share",
    "desktopFolder": "desktop",
    "rootListUser": 0,
    "rootListGroup": 0,
    "csrfProtect": 0,
    "currentVersion": "4.40",
    "wallpageDesktop": "1,2,3,4,5,6,7,8,9,10,11,12,13",
    "wallpageLogin": "2,3,6,8,9,11,12",
    "menu": [
        {
            "name": "desktop",
            "type": "system",
            "url": "index.php?desktop",
            "target": "_self",
            "use": "1"
        },
        {
            "name": "explorer",
            "type": "system",
            "url": "index.php?explorer",
            "target": "_self",
            "use": "1"
        },
        {
            "name": "editor",
            "type": "system",
            "url": "index.php?editor",
            "target": "_self",
            "use": "1"
        }
    ],
    "pluginList": {
        "adminer": {
            "id": "adminer",
            "regiest": {
                "templateCommonHeader": "adminerPlugin.addMenu"
            },
            "status": 1,
            "config": {
                "pluginAuth": "role:1",
                "menuSubMenu": 1
            }
        },
        "DPlayer": {
            "id": "DPlayer",
            "regiest": {
                "user.commonJs.insert": "DPlayerPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "subtitle": "0",
                "fileSort": 200,
                "fileExt": "mp4,m4v,flv,mov,f4v,ogv,webm,webmv,mkv"
            }
        },
        "imageExif": {
            "id": "imageExif",
            "regiest": {
                "user.commonJs.insert": "imageExifPlugin.echoJs",
                "share.image": "imageExifPlugin.imageCheck",
                "explorer.image": "imageExifPlugin.imageCheck"
            },
            "status": 1,
            "config": []
        },
        "jPlayer": {
            "id": "jPlayer",
            "regiest": {
                "user.commonJs.insert": "jPlayerPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "fileExt": "mp3,wav,m4a,aac,oga,ogg,webma,mp4,m4v,flv,mov,f4v,ogv,webm,webmv,m3u8a,m3ua,flac,fla,rtmp,rtmpa",
                "fileSort": 10
            }
        },
        "officeLive": {
            "id": "officeLive",
            "regiest": {
                "user.commonJs.insert": "officeLivePlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1;user:;group:;role:",
                "pluginAuthOpen": "0",
                "openWith": "dialog",
                "apiServer": "https:\/\/owa-box.vips100.com\/op\/view.aspx?src=",
                "fileExt": "doc,docx,docm,dot,dotx,dotm,rtf,xls,xlsx,xlt,xlsb,xlsm,csv,ppt,pptx,pps,ppsx,pptm,potm,ppam,potx,ppsm,odt,ods,odp,ott,ots,otp,wps,wpt",
                "fileSort": "11"
            }
        },
        "photoSwipe": {
            "id": "photoSwipe",
            "regiest": {
                "user.commonJs.insert": "photoSwipePlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1;user:;group:;role:",
                "fileExt": "jpg,jpeg,png,bmp,gif,ico,svg,cur,webp",
                "fileSort": "20"
            }
        },
        "picasa": {
            "id": "picasa",
            "regiest": {
                "user.commonJs.insert": "picasaPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "fileExt": "jpg,jpeg,png,bmp,gif,ico,svg,cur,webp",
                "fileSort": 10
            }
        },
        "simpleClock": {
            "id": "simpleClock",
            "regiest": {
                "user.commonJs.insert": "simpleClockPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1"
            }
        },
        "toolsCommon": {
            "id": "toolsCommon",
            "regiest": {
                "user.commonJs.insert": "toolsCommonPlugin.echoJs"
            },
            "status": 1,
            "config": []
        },
        "VLCPlayer": {
            "id": "VLCPlayer",
            "regiest": {
                "user.commonJs.insert": "VLCPlayerPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "fileExt": "aac,arc,arj,asf,asx,avi,f4v,flv, m2ts,m4v,mp2,mov,mp3,mp4,mp4v,mpe,mpg,mts,mkv,ogv,3gp,mpeg,wav,wma,wmv,rm,rmvb,vob,webm,webmv,   mp3,wav,wma,m4a,aac,oga,ogg,webma",
                "fileSort": 1
            }
        },
        "webodf": {
            "id": "webodf",
            "regiest": {
                "user.commonJs.insert": "webodfPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "openWith": "dialog",
                "fileExt": "odf,odt,ods,odp",
                "fileSort": 5000
            }
        },
        "zipView": {
            "id": "zipView",
            "regiest": {
                "user.commonJs.insert": "zipViewPlugin.echoJs",
                "globalRequest": "zipViewPlugin.changeData"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "fileExt": "zip,tar,gz,tgz,ipa,apk,rar,7z,iso,bz2,zx,z,arj,epub",
                "fileSort": 10
            }
        },
        "pdfjs": {
            "id": "pdfjs",
            "regiest": {
                "user.commonJs.insert": "pdfjsPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "fileExt": "pdf,djvu,ofd",
                "fileSort": 500
            }
        },
        "epubReader": {
            "id": "epubReader",
            "regiest": {
                "user.commonJs.insert": "epubReaderPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "openWith": "dialog",
                "fileExt": "epub",
                "fileSort": 100
            }
        },
        "emlViewer": {
            "id": "emlViewer",
            "regiest": {
                "user.commonJs.insert": "emlViewerPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1",
                "openWith": "window",
                "fileSort": 1000,
                "fileExt": "eml,mht,mhtml"
            }
        },
        "CADViewer": {
            "id": "CADViewer",
            "regiest": {
                "user.commonJs.insert": "CADViewerPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1;user:;group:;role:",
                "openWith": "dialog",
                "fileExt": "dwg,dxf,dwf,hpgl,plt,step,stp,iges,igs,brep,stl,sat,sldprt,x_t,x_b,svg,pdf,emf,cgm,wmf,bmp,jpg,jpeg,png,gif,tiff,cal,tga",
                "fileSort": "10"
            }
        },
        "Photopea": {
            "id": "Photopea",
            "regiest": {
                "user.commonJs.insert": "PhotopeaPlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1;user:;group:;role:",
                "openWith": "dialog",
                "fileExt": "psd,psb,pbm,ai,xd,sketch,xcf,raw,bmp,jpg,jpeg,png,gif,tiff,iff,mpo,svg,pdf,emf,webp,ppm,ico,dds,tga",
                "fileSort": "10"
            }
        },
        "OnlyOffice": {
            "id": "OnlyOffice",
            "regiest": {
                "user.commonJs.insert": "OnlyOfficePlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1;user:;group:;role:",
                "openWith": "dialog",
                "fileExt": "doc,docm,docx,dot,dotm,dotx,epub,fodt,htm,html,mht,odt,pdf,rtf,txt,djvu,xps,fodp,odp,pot,potm,potx,pps,ppsm,ppsx,ppt,pptm,pptx,csv,fods,ods,xls,xlsm,xlsx,xlt,xltm,xltx",
                "fileSort": "100",
                "apiServer-http": "onlyoffice.dzz.cc",
                "apiServer-https": "",
                "serverApi": "",
                "wapViewMode": "edit",
                "canAutosave": "1",
                "canCopy": "1",
                "canCoAuthoring": "1",
                "chat": "1",
                "comments": "1",
                "debug": "0",
                "cdnPath": "",
                "kodAppHost": ""
            }
        },
        "onlyoffice": {
            "id": "onlyoffice",
            "regiest": {
                "user.commonJs.insert": "onlyofficePlugin.echoJs"
            },
            "status": 1,
            "config": {
                "pluginAuth": "all:1;user:;group:;role:",
                "openWith": "window",
                "fileExt": "docx,doc,odt,rtf,mht,djvu,fb2,xps,docm,dotm,dot,dotx,wps,wpt,xls,xlsx,ods,csv,xlt,xltx,xlsm,et,ett,pps,ppsx,ppt,pptx,odp,pot,potx,pptm,ppsm,potm,dps,dpt",
                "fileSort": "100",
                "apiServer-http": "121.40.145.135:8082",
                "apiServer-https": "",
                "serverApi": "",
                "wapViewMode": "edit",
                "canAutosave": "1",
                "canCopy": "1",
                "canCoAuthoring": "1",
                "chat": "1",
                "comments": "1",
                "debug": "0",
                "cdnPath": "",
                "kodAppHost": ""
            }
        }
    },
    "versionType": "A"
}