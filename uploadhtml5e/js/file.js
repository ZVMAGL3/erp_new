var hcfile_ = {
	Init: function(c) {
		var t = this;
		t.opt = c;
		t.conf = {
			type: "all",
			item_yifu_weizhi: "before",
			maxnum: 10000000,
			fdsize: 1024 * 15,
			isdelfile: 0,
			bgsrc: "bt.jpg",
			big_hz: "_big",
			inserttype: "after",
			small_hz: "_small",
			fengmian_field: "src",
			iscamera: 0,
			showloadimg: 1,
			isyulan: 1,
			isbianma: 0,
			alert_time: 2000
		};
		t.result = {
			isfull: 0,
			type: "path",
			fenge: "#",
			fenge_child: "[g]",
			hiddennametype: ""
		};
		t.selectbt_show = {
			date: 0,
			size: 0,
			img: 1,
			name: 0,
			bar: 0,
			baifenbi: 0,
			del: 0,
			bg: 0,
			fengmian: 0,
			see: 0,
			chongchuan: 0,
			chongxuan: 0,
			canvas: 0,
			prev: 0,
			next: 0,
			meimiao: 0,
			down: 0,
			insert: 0,
			filesize: 0,
			barsize: 0,
			jieping: 0
		};
		t.first_show = {
			date: 0,
			size: 0,
			img: 1,
			name: 0,
			bar: 0,
			baifenbi: 0,
			del: 1,
			bg: 0,
			fengmian: 0,
			see: 0,
			chongchuan: 0,
			chongxuan: 0,
			canvas: 0,
			prev: 0,
			next: 0,
			filesize: 0,
			meimiao: 0,
			down: 0,
			insert: 0,
			filesize: 0,
			barsize: 0,
			jieping: 0
		};
		t.init_show = {
			date: 0,
			size: 0,
			img: 1,
			name: 0,
			bar: 1,
			baifenbi: 1,
			del: 0,
			bg: 1,
			fengmian: 0,
			see: 0,
			chongchuan: 0,
			chongxuan: 0,
			canvas: 0,
			prev: 0,
			next: 0,
			filesize: 0,
			meimiao: 0,
			down: 0,
			insert: 0,
			filesize: 0,
			barsize: 0,
			jieping: 0
		};
		t.upload_show = {
			date: 0,
			size: 0,
			img: 1,
			name: 0,
			bar: 1,
			baifenbi: 1,
			del: 0,
			bg: 1,
			fengmian: 0,
			see: 0,
			chongchuan: 0,
			chongxuan: 0,
			canvas: 0,
			prev: 0,
			next: 0,
			filesize: 0,
			meimiao: 0,
			down: 0,
			insert: 0,
			filesize: 0,
			barsize: 0,
			jieping: 0
		};
		t.success_show = {
			date: 0,
			size: 0,
			img: 1,
			name: 0,
			bar: 0,
			baifenbi: 0,
			del: 1,
			bg: 0,
			fengmian: 0,
			see: 0,
			chongchuan: 0,
			chongxuan: 0,
			canvas: 0,
			prev: 0,
			next: 0,
			filesize: 0,
			meimiao: 0,
			down: 0,
			insert: 0,
			filesize: 0,
			barsize: 0,
			jieping: 0
		};
		t.error_show = {
			del: 1
		};
		t.totaldetail = {
			totalnum: 0,
			totaluploadnum: 0,
			totalsuccessnum: 0,
			totaldengdainum: 0,
			totalbarnum: 0,
			totalsize: 0,
			totaluploadsize: 0,
			totalsuccesssize: 0,
			totaldengdaisize: 0,
			totalbarsize: 0,
			totalbarsize_z: 0,
			totalbaifenbi: 0,
			totalbarnum_z: 0
		};
		t.item_xg_class = {
			name: "rel_name",
			del: "rel_del",
			see: "rel_see",
			down: "rel_down",
			size: "rel_size"
		};
		t.formData = {};
		t.input_format = {};
		t.files = new Array();
		t.sjid = t.RndNum(7);
		t.input_id = "hcfile_" + t.sjid;
		t.input = document.createElement("input");
		t.input.type = "hidden";
		t.itemstyle = "";
		t.itemhoverclass = "hcitem_hover";
		t.input_fengmian = document.createElement("input");
		t.input_fengmian.type = "hidden";
		t.hcfile_path = url2017;
		t.bar_ids = Array();
		if (window.console) {
			console.log("thank you")
		};
		t.mr_class = "myitem_mr";
		t.obj_select_num = null;
		t.siteurl = g_siteurl;
		t.childs = new Array();
		t.btselect = new Array();
		if (typeof(c.input_id) != "undefined" && c.input_id != "") {
			var d = document.getElementById(c.input_id);
			if (d) {
				t.input = d;
				t.input_id = c.input_id
			}
		};
		window["hcfile" + t.input_id] = t;
		if (typeof(t.opt.showloadimg) != "undefined") {
			t.conf.showloadimg = t.opt.showloadimg
		}
		if (typeof(g_isdelfile) != "undefined") {
			t.conf.isdelfile = g_isdelfile
		}
		if (typeof(g_isnewsmall) != "undefined") {
			t.conf.isnewsmall = g_isnewsmall
		}
		if (typeof(g_isyulan) != "undefined") {
			t.conf.isyulan = g_isyulan
		}
		if (typeof(g_zifu_num) != "undefined" && g_zifu_num != "") {
			t.conf.fdsize = g_zifu_num
		};
		if (typeof(g_conf) != "undefined") {
			if (typeof(g_conf.isbianma) != "undefined") {
				t.conf.isbianma = g_conf.isbianma
			}
			if (typeof(g_conf.isnewsmall) != "undefined") {
				t.conf.isnewsmall = g_conf.isnewsmall
			}
			if (typeof(g_conf.isyulan) != "undefined") {
				t.conf.isyulan = g_conf.isyulan
			}
			if (typeof(g_conf.fdsize) != "undefined") {
				t.conf.fdsize = g_conf.fdsize
			}
		};
		if (typeof(c.item_yifu_weizhi) != "undefined") {
			t.conf.item_yifu_weizhi = c.item_yifu_weizhi
		};
		if (typeof(c.conf) != "undefined") {
			for (var k in c.conf) {
				t.conf[k] = c.conf[k]
			}
		};
		if (typeof(t.opt.input_fenge) != "undefined") {
			t.result.fenge = t.opt.input_fenge
		}
		if (typeof(t.opt.hcfile_path) != "undefined") {
			t.hcfile_path = t.opt.hcfile_path
		}
		if (typeof(t.opt.isyulan) != "undefined") {
			t.conf.isyulan = t.opt.isyulan
		}
		if (typeof(t.opt.input_fenge_child) != "undefined") {
			t.result.fenge_child = t.opt.input_fenge_child
		}
		if (typeof(t.opt.del_before) != "undefined") {
			t.delete_before = t.opt.del_before
		};
		if (typeof(t.opt.delete_before) != "undefined") {
			t.delete_before = t.opt.delete_before
		};
		if (typeof(t.opt.del_huidiao) != "undefined") {
			t.delete_huidiao = t.opt.del_huidiao
		};
		if (typeof(t.opt.delete_huidiao) != "undefined") {
			t.delete_huidiao = t.opt.delete_huidiao
		};
		if (typeof(t.opt.start_before) != "undefined") {
			t.start_before = t.opt.start_before
		};
		if (typeof(t.opt.start_all_before) != "undefined") {
			t.start_all_before = t.opt.start_all_before
		};
		if (typeof(t.opt.upload_before) != "undefined") {
			t.upload_before = t.opt.upload_before
		};
		if (typeof(t.opt.start_huidiao) != "undefined") {
			t.start_huidiao = t.opt.start_huidiao
		};
		if (typeof(t.opt.upload_start) != "undefined") {
			t.upload_start = t.opt.upload_start
		};
		if (typeof(t.opt.insert_huidiao) != "undefined") {
			t.insert_huidiao = t.opt.insert_huidiao
		};
		if (typeof(t.opt.first_init_huidiao) != "undefined") {
			t.first_init_huidiao = t.opt.first_init_huidiao
		};
		if (typeof(t.opt.select_huidiao) != "undefined") {
			t.select_huidiao = t.opt.select_huidiao
		};
		if (typeof(t.opt.init_huidiao) != "undefined") {
			t.init_huidiao = t.opt.init_huidiao
		};
		if (typeof(t.opt.upload_success) != "undefined") {
			t.upload_success = t.opt.upload_success
		};
		if (typeof(t.opt.upload_success_huidiao) != "undefined") {
			t.upload_success = t.opt.upload_success_huidiao
		};
		if (typeof(t.opt.fengmian_huidiao) != "undefined") {
			t.fengmian_huidiao = t.opt.fengmian_huidiao
		};
		if (typeof(t.opt.formData) != "undefined") {
			t.formData = t.opt.formData
		};
		if (typeof(t.opt.success_huidiao) != "undefined") {
			t.success_huidiao = t.opt.success_huidiao
		};
		if (typeof(t.opt.upload_success) == "undefined" && typeof(t.opt.success_huidiao) != "undefined") {
			t.upload_success = t.opt.success_huidiao
		};
		if (typeof(t.opt.success) != "undefined") {
			t.success = t.opt.success
		};
		if (typeof(t.opt.error_huidiao) != "undefined") {
			t.error_huidiao = t.opt.error_huidiao
		};
		if (typeof(t.opt.upload_huidiao) != "undefined") {
			t.upload_huidiao = t.opt.upload_huidiao
		};
		if (typeof(t.opt.first_init_complete) != "undefined") {
			t.first_init_complete = t.opt.first_init_complete
		};
		if (typeof(t.opt.myalert) != "undefined") {
			t.myalert = t.opt.myalert
		};
		if (typeof(t.opt.upload_beforeSend) != "undefined") {
			t.upload_beforeSend = t.opt.upload_beforeSend
		};
		if (typeof(t.opt.progress) != "undefined") {
			t.progress = t.opt.progress
		};
		if (typeof(t.opt.upload_success_result) != "undefined") {
			t.upload_success_result = t.opt.upload_success_result
		};
		if (typeof(t.opt.null_id) != "undefined") {
			t.objnull = t.getobj(t.opt.null_id);
			if (t.objnull) {
				t.reg_select_click(t.objnull)
			}
		}
		if (typeof(t.opt.status_id) != "undefined") {
			t.objstatus = t.getobj(t.opt.status_id)
		}
		if (typeof(t.opt.forced_id) != "undefined") {
			t.objforced = t.getobj(t.opt.forced_id)
		}
		if (typeof(t.opt.info_id) != "undefined") {
			t.objinfo = t.getobj(t.opt.info_id)
		}
		if (typeof(t.opt.bar_huidiao) != "undefined") {
			t.bar_huidiao = t.opt.bar_huidiao
		};
		if (typeof(t.opt.reset_huidiao) != "undefined") {
			t.reset_huidiao = t.opt.reset_huidiao
		};
		if (typeof(t.opt.usermedia_first_huidiao) != "undefined") {
			t.usermedia_first_huidiao = t.opt.usermedia_first_huidiao
		};
		if (typeof(t.opt.usermedia_success_huidiao) != "undefined") {
			t.usermedia_success_huidiao = t.opt.usermedia_success_huidiao
		};
		if (typeof(t.opt.usermedia_capture_huidiao) != "undefined") {
			t.usermedia_capture_huidiao = t.opt.usermedia_capture_huidiao
		};
		if (typeof(t.opt.upload_success_log) != "undefined") {
			t.upload_success_log = t.opt.upload_success_log
		};
		if (typeof(t.opt.upload_error_log) != "undefined") {
			t.upload_error_log = t.opt.upload_error_log
		};
		if (typeof(t.opt.upload_complete_log) != "undefined") {
			t.upload_complete_log = t.opt.upload_complete_log
		};
		if (typeof(t.opt.select_file_before) != "undefined") {
			t.select_file_before = t.opt.select_file_before
		};
		if (typeof(t.opt.select_file_log) != "undefined") {
			t.select_file_log = t.opt.select_file_log
		};
		if (typeof(t.opt.iframe_upload_huidiao) != "undefined") {
			t.iframe_upload_huidiao = t.opt.iframe_upload_huidiao
		};
		if (typeof(t.opt.down_click) != "undefined") {
			t.down_click = t.opt.down_click
		};
		if (typeof(c.input_format) != "undefined") {
			for (var k in c.input_format) {
				t.input_format[k] = c.input_format[k]
			}
		} else {
			t.input_format = {
				src: 0
			}
		};
		if (typeof(c.result) != "undefined") {
			for (var k in c.result) {
				t.result[k] = c.result[k]
			}
		}
		if (typeof(c.conf) != "undefined") {
			for (var k in c.conf) {
				t.conf[k] = c.conf[k]
			}
		}
		if (typeof(c.item_xg_class) != "undefined") {
			for (var k in c.item_xg_class) {
				t.item_xg_class[k] = c.item_xg_class[k]
			}
		};
		if (typeof(c.hiddennametype) != "undefined") {
			t.conf.hiddennametype = c.hiddennametype
		};
		if (typeof(t.opt.maxnum) != "undefined" && t.opt.maxnum != "") {
			t.conf.maxnum = parseInt(t.opt.maxnum)
		}
		if (t.input_id != "") {
			t.input = document.getElementById(t.input_id)
		};
		if (typeof(t.opt.select_id) == "undefined" && typeof(t.opt.weizhi_id) == "undefined" && t.input != null && t.conf.maxnum == 1 && typeof(t.opt.isbt) == "undefined") {
			if (typeof(t.opt.bt_select_id) == "undefined") {
				t.opt.isbt = 1;
				t.success_show["del"] = 0
			}
		};
		var f = document.getElementsByTagName("body");
		if (f.length > 0) {
			t.body = f[0]
		}
		if (typeof(t.opt.fenge) != "undefined") {
			t.result.fenge = t.opt.fenge
		}
		if (typeof(t.opt.conf) != "undefined" && typeof(t.opt.conf.fenge) != "undefined") {
			t.result.fenge = t.opt.conf.fenge
		}
		if (typeof(t.opt.conf) != "undefined" && typeof(t.opt.conf.fenge_child) != "undefined") {
			t.result.fenge_child = t.opt.fenge_child
		}
		if (typeof(t.opt.fenge_child) != "undefined") {
			t.result.fenge_child = t.opt.fenge_child
		}
		if (typeof(t.opt.isfull) != "undefined") {
			t.result.isfull = t.opt.isfull
		};
		if (typeof(t.opt.zifu_num) != "undefined" && String(t.opt.zifu_num) != "") {
			t.conf.fdsize = t.opt.zifu_num
		}
		if (typeof(t.opt.img_fdsize) != "undefined" && String(t.opt.img_fdsize) != "") {
			t.conf.fdsize = t.opt.img_fdsize
		}
		if (typeof(t.opt.fdsize) != "undefined" && String(t.opt.fdsize) != "") {
			t.conf.fdsize = t.opt.fdsize
		}
		if (typeof(t.opt.isdelfile) != "undefined") {
			t.conf.isdelfile = t.opt.isdelfile
		}
		if (typeof(t.opt.isnewsmall) != "undefined") {
			t.conf.isnewsmall = t.opt.isnewsmall
		}
		if (typeof(t.opt.type) != "undefined" && t.opt.type != "") {
			t.conf.type = t.opt.type
		};
		if (typeof(t.opt.bar_animate) != "undefined" && t.opt.bar_animate != "") {
			t.conf.bar_animate = t.opt.bar_animate
		};
		if (typeof(t.opt.inserttype) != "undefined" && t.opt.inserttype != "") {
			t.conf.inserttype = t.opt.inserttype
		};
		if (typeof(t.opt.update_before) != "undefined") {
			t.update_before = t.opt.update_before
		};
		if (typeof(t.opt.update) != "undefined") {
			t.update = t.opt.update
		};
		if (typeof(t.opt.update_success) != "undefined") {
			t.update_success = t.opt.update_success
		};
		if (typeof(t.opt.before) != "undefined") {
			t.before = t.opt.before
		};
		if (typeof(t.opt.del_all_before) != "undefined") {
			t.del_all_before = t.opt.del_all_before
		};
		if (typeof(t.opt.delete_all_before) != "undefined") {
			t.del_all_before = t.opt.delete_all_before
		};
		if (typeof(t.opt.del) != "undefined") {
			t.del = t.opt.del
		};
		if (typeof(t.opt.del_success) != "undefined") {
			t.delete_success_huidiao = t.opt.del_success
		};
		if (typeof(t.opt.delete_success) != "undefined") {
			t.delete_success_huidiao = t.opt.delete_success
		};
		if (typeof(t.opt.del_success_huidiao) != "undefined") {
			t.delete_success_huidiao = t.opt.del_success_huidiao
		};
		if (typeof(t.opt.delete_success_huidiao) != "undefined") {
			t.delete_success_huidiao = t.opt.delete_success_huidiao
		};
		if (typeof(t.opt.upload_defore) != "undefined") {
			t.upload_defore = t.opt.upload_defore
		};
		if (typeof(t.opt.error) != "undefined") {
			t.error = t.opt.error
		};
		if (typeof(t.opt.click_img) != "undefined") {
			t.click_img = t.opt.click_img
		};
		if (typeof(t.opt.click_jieping) != "undefined") {
			t.click_jieping = t.opt.click_jieping
		};
		if (typeof(t.opt.first_huidiao) != "undefined") {
			t.first_huidiao = t.opt.first_huidiao
		};
		if (typeof(t.opt.paixu_huidiao) != "undefined") {
			t.paixu_huidiao = t.opt.paixu_huidiao
		};
		if (typeof(t.opt.first_huidiao) != "undefined") {
			t.first_huidiao = t.opt.first_huidiao
		};
		if (typeof(t.opt.change_huidiao) != "undefined") {
			t.change_huidiao = t.opt.change_huidiao
		};
		if (typeof(t.opt.mytxt) == "undefined") {
			t.opt.mytxt = ""
		}
		if (typeof(t.opt.server) != "undefined") {
			t.opt.url = t.opt.server
		} else {
			t.opt.server = t.opt.url
		};
		if (typeof(t.opt.first_init) != "undefined") {
			t.first_init = t.opt.first_init
		};
		t.siteurl_file = g_siteurl_file;
		t.siteurl = g_siteurl;
		t.istouch = ("ontouchstart" in document);
		if (typeof(t.opt.siteurl_file) != "undefined") {
			t.siteurl_file = t.opt.siteurl_file;
			t.siteurl = t.opt.siteurl_file
		}
		if (typeof(t.opt.siteurl) != "undefined") {
			t.siteurl = t.opt.siteurl;
			t.siteurl_file = t.opt.siteurl
		}
		if (typeof(t.opt.ico_path) == "undefined") {
			t.ico_path = g_ico_path
		} else {
			t.ico_path = t.opt.ico_path
		}
		if (typeof(t.opt.bgsrc) != "undefined" && String(t.opt.bgsrc) != "") {
			t.conf.bgsrc = t.opt.bgsrc
		} else {
			t.conf.bgsrc = t.ico_path + t.conf.bgsrc
		}
		t.moren_bgsrc = t.conf.bgsrc;
		if ((typeof(t.opt.ischongxuan) != "undefined" && t.opt.ischongxuan == 1)) {
			t.success_show.chongxuan = 1
		};
		t.totalmiao = 0;
		if (typeof(t.opt.hcitem_hover) != "undefined") {
			t.itemhoverclass = t.opt.hcitem_hover
		}
		if (typeof(t.opt.first_show) != "undefined") {
			for (var k in t.opt.first_show) {
				t.first_show[k] = t.opt.first_show[k]
			}
		}
		if (typeof(t.opt.init_show) != "undefined") {
			for (var k in t.opt.init_show) {
				t.init_show[k] = t.opt.init_show[k]
			}
		}
		if (typeof(t.opt.error_show) != "undefined") {
			for (var k in t.opt.error_show) {
				t.error_show[k] = t.opt.error_show[k]
			}
		}
		if (typeof(t.opt.upload_show) != "undefined") {
			if (typeof(t.opt.upload_show.itemstyle) != "undefined" && t.opt.upload_show.itemstyle !== "") {
				t.itemstyle = t.opt.upload_show.itemstyle
			}
			for (var k in t.opt.upload_show) {
				t.upload_show[k] = t.opt.upload_show[k]
			}
		}
		if (typeof(t.opt.success_show) != "undefined") {
			for (var k in t.opt.success_show) {
				t.success_show[k] = t.opt.success_show[k]
			}
		}
		if (typeof(t.opt.first_show) == "undefined") {
			for (var k in t.opt.success_show) {
				t.first_show[k] = t.opt.success_show[k]
			}
		};
		t.hover_show = {};
		if (typeof(t.opt.hover_show) != "undefined") {
			for (var k in t.opt.hover_show) {
				t.hover_show[k] = t.opt.hover_show[k]
			}
		}
		if (typeof(t.opt.isfengmian) != "undefined" && t.opt.isfengmian != "") {
			t.success_show.fengmian = 1
		}
		if (typeof(t.opt.input_fengmian_id) != "undefined" && t.opt.input_fengmian_id !== "") {
			var o = document.getElementById(c.input_fengmian_id);
			if (o) {
				t.input_fengmian = o
			}
		};
		if (typeof(t.opt.border) == "undefined") {
			t.opt.border = 1
		}
		if (typeof(t.opt.width) == "undefined") {
			t.opt.width = ""
		}
		if (typeof(t.opt.maxfilesize) == "undefined") {
			t.opt.maxfilesize = 0
		}
		t.maxfilesize = t.opt.maxfilesize;
		if (typeof(t.opt.width_ys) == "undefined") {
			t.opt.width_ys = ""
		};
		if (typeof(t.opt.select_before) != "undefined") {
			t.select_before = t.opt.select_before
		};
		if (typeof(t.opt.select_num_id) != "undefined" && t.opt.select_num_id != "") {
			t.obj_select_num = document.getElementById(t.opt.select_num_id);
			if (t.obj_select_num) {
				t.obj_select_num.innerHTML = 0
			}
		};
		if (typeof(t.opt.file_attr) != "undefined") {
			t.file_attr = t.opt.file_attr
		};
		if (typeof(t.opt.iscamera) != "undefined") {
			t.conf.iscamera = t.opt.iscamera
		};
		if (typeof(t.file_attr) == "undefined") {
			t.file_attr = {}
		}
		if (t.conf.iscamera == 1) {
			t.file_attr["capture"] = "camera"
		}
		if (typeof(t.opt.accept) != "undefined") {
			t.file_attr["accept"] = t.opt.accept
		}
		t.obj_max_num = null;
		if (typeof(t.opt.max_num_id) != "undefined" && t.opt.max_num_id != "") {
			t.obj_max_num = document.getElementById(t.opt.max_num_id);
			if (t.obj_max_num) {
				t.obj_max_num.innerHTML = t.conf.maxnum
			}
		};
		t.isautosend = 1;
		if (typeof(t.opt.auto) != "undefined" && String(t.opt.auto) != "") {
			t.isautosend = t.opt.auto
		}
		if (t.isautosend) {
			t.isautosend = 1
		} else if (t.isautosend == false) {
			t.isautosend = 0
		}
		if (typeof(t.opt.shuiyin) != "undefined") {
			for (var g in t.opt.shuiyin) {
				if (typeof(t.opt.shuiyin[g]["src"]) != "undefined") {
					var h = document.createElement("img");
					h.src = t.opt.shuiyin[g]["src"];
					if (typeof(t.opt.shuiyin[g]["type"]) == "undefined") {
						t.opt.shuiyin[g]["type"] = "img"
					};
					t.opt.shuiyin[g]["img"] = h
				}
				if (typeof(t.opt.shuiyin[g]["text"]) != "undefined") {
					if (typeof(t.opt.shuiyin[g]["type"]) == "undefined") {
						t.opt.shuiyin[g]["type"] = "text"
					}
				}
			}
		};
		if (typeof(t.opt.shuiyin_newsmall) != "undefined") {
			for (var g in t.opt.shuiyin_newsmall) {
				if (typeof(t.opt.shuiyin_newsmall[g]["src"]) != "undefined") {
					var h = document.createElement("img");
					h.src = t.opt.shuiyin_newsmall[g]["src"];
					if (typeof(t.opt.shuiyin_newsmall[g]["type"]) == "undefined") {
						t.opt.shuiyin_newsmall[g]["type"] = "img"
					};
					t.opt.shuiyin_newsmall[g]["img"] = h
				}
				if (typeof(t.opt.shuiyin_newsmall[g]["text"]) != "undefined") {
					if (typeof(t.opt.shuiyin_newsmall[g]["type"]) == "undefined") {
						t.opt.shuiyin_newsmall[g]["type"] = "text"
					}
				}
			}
		};
		if (typeof(t.opt.shuiyin_newmid) != "undefined") {
			for (var g in t.opt.shuiyin_newmid) {
				if (typeof(t.opt.shuiyin_newmid[g]["src"]) != "undefined") {
					var h = document.createElement("img");
					h.src = t.opt.shuiyin_newmid[g]["src"];
					if (typeof(t.opt.shuiyin_newmid[g]["type"]) == "undefined") {
						t.opt.shuiyin_newmid[g]["type"] = "img"
					};
					t.opt.shuiyin_newmid[g]["img"] = h
				}
				if (typeof(t.opt.shuiyin_newmid[g]["text"]) != "undefined") {
					if (typeof(t.opt.shuiyin_newmid[g]["type"]) == "undefined") {
						t.opt.shuiyin_newmid[g]["type"] = "text"
					}
				}
			}
		};
		if (typeof(t.opt.newfiles) != "undefined") {
			for (var g in t.opt.newfiles) {
				if (typeof(t.opt.newfiles[g]["shuiyin"]) != "undefined" && t.opt.newfiles[g]["shuiyin"]["type"] == "img") {
					var h = document.createElement("img");
					h.src = t.opt.newfiles[g]["shuiyin"]["src"];
					if (typeof(t.opt.newfiles[g]["shuiyin"]["type"]) == "undefined") {
						t.opt.newfiles[g]["shuiyin"]["type"] = "img"
					};
					t.opt.newfiles[g]["shuiyin"]["img"] = h
				};
				if (typeof(t.opt.newfiles[g]["shuiyin"]["text"]) != "undefined") {
					if (typeof(t.opt.newfiles[g]["shuiyin"]["type"]) == "undefined") {
						t.opt.newfiles[g]["shuiyin"]["type"] = "text"
					}
				}
			}
		};
		if (typeof(FileReader) != 'undefined') {
			if (typeof(t.opt.drop_to_id) != "undefined" && t.opt.drop_to_id != "") {
				var j = null;
				if (t.opt.drop_to_id == "document") {
					j = document
				} else {
					j = document.getElementById(t.opt.drop_to_id)
				}
				if (j) {
					j.addEventListener("dragover", function(e) {
						e.stopPropagation();
						e.preventDefault()
					}, false);
					j.addEventListener("drop", function(e) {
						e.stopPropagation();
						e.preventDefault();
						t.start(e.dataTransfer.files)
					}, false)
				}
			}
		};
		if (typeof(t.opt.start_id) != "undefined" && t.opt.start_id != "") {
			t.opt.send_id = t.opt.start_id
		}
		if (typeof(t.opt.send_id) != "undefined" && t.opt.send_id != "" && t.opt.send_id != "auto") {
			var l = t.getobjs(t.opt.send_id);
			for (var i = 0; i < l.length; i++) {
				var m = l[i];
				m.onclick = function() {
					t.send()
				}
			}
		};
		t.num = 0;
		t.del_all_bt = null;
		t.panel = null;
		t.posts = {};
		t.post = {};
		t.posts_other = {};
		if (typeof(t.opt.panel_id) != "undefined" && t.opt.panel_id != "") {
			var o = document.getElementById(c.panel_id);
			if (o) {
				t.panel = o
			}
		};
		if (typeof(t.opt.filelist_id) != "undefined" && t.opt.filelist_id != "") {
			t.panel = document.getElementById(c.filelist_id)
		};
		if (typeof(t.opt.post) != "undefined") {
			t.post = t.opt.post
		};
		if (t.panel == null) {
			if (t.input) {
				t.panel = t.input.parentNode
			}
		};
		if (t.panel == null) {
			t.panel = document.createElement("div");
			t.panel.id = "panel_" + t.sjid;
			t.panel.style.display = "none";
			t.body.appendChild(t.panel)
		}
		t.panel.setAttribute("data-inputid", c.input_id);
		t.clearfloat = document.createElement("div");
		t.clearfloat.id = "mylistclearfloat_" + t.sjid;
		t.clearfloat.className = "clearfloat";
		t.clearfloat.style.cssText = "height:0px;clear:both;width:100%;line-height:0px;";
		t.yifu = t.clearfloat;
		if (t.panel) {
			t.panel.appendChild(t.clearfloat)
		};
		if (typeof(t.opt.item_yifu_id) != "undefined") {
			var n = t.getobjs(t.opt.item_yifu_id);
			if (n.length > 0) {
				t.yifu = n[0]
			}
		};
		if (typeof(t.opt.del_all_huidiao) != "undefined") {
			t.del_all_huidiao = t.opt.del_all_huidiao
		};
		if (typeof(t.opt.del_all_id) != "undefined") {
			del_all_bt = document.getElementById(t.opt.del_all_id);
			if (del_all_bt) {
				del_all_bt.onclick = function(e) {
					var a = t.getchilds();
					if (typeof(t.del_all_before) != "undefined") {
						var b = t.del_all_before(a);
						if (b == false) {
							return false
						}
					}
					if (typeof(t.del_all_huidiao) != "undefined") {
						t.del_all_huidiao(a)
					}
					t.reset_all();
					t.childs = t.getchilds();
					if (e && e.stopPropagation) {
						e.stopPropagation()
					} else {
						window.event.cancelBubble = true;
						return false
					}
				}
			}
		};
		t.parent = null;
		if (t.input && t.input.parentNode) {
			t.parent = t.input.parentNode
		} else {
			t.parent = t.body
		};
		t.create_file();
		var p = navigator.userAgent;
		if (typeof(t.opt.item_values) != "undefined" && t.input) {
			if (typeof(t.opt.item_values) == "string") {
				t.input.value = t.opt.item_values
			} else {
				t.input.value = JSON.stringify(t.opt.item_values)
			}
		};
		t.file_camera = document.createElement("input");
		t.file_camera.type = "file";
		t.file_camera.setAttribute("accept", "*");
		t.camera_attr = {
			capture: "camera"
		};
		if (typeof(t.opt.camera_attr) != "undefined") {
			for (var k in t.opt.camera_attr) {
				t.camera_attr[k] = t.opt.camera_attr[k]
			}
		}
		if (typeof(camera_attr) != "undefined") {
			for (var k in camera_attr) {
				t.file_camera.setAttribute(k, camera_attr[k])
			}
		};
		t.curgroupindex = 0;
		if (t.input) {
			t.input.onchange = function() {
				var a = t.input.value
			}
		};
		t.init_rows();
		if (typeof(FileReader) == 'undefined') {
			t.create_submit_iframe()
		} else {
			t.create_submit()
		};
		t.init_add_null();
		t.init_obj();
		t.init_item();
		t.del_items = [];
		t.bt_ewm_upload = null;
		if (typeof(t.opt.ewm_upload_id) != "undefined" && t.opt.ewm_upload_id != "") {
			t.bt_ewm_upload = t.getobjs(t.opt.ewm_upload_id)
		};
		if (typeof(hcfile_ewm) != "undefined") {
			for (var k in hcfile_ewm) {
				t[k] = hcfile_ewm[k]
			}
			if (t.bt_ewm_upload != null && t.bt_ewm_upload.length > 0) {
				for (var k in t.bt_ewm_upload) {
					t.bt_ewm_upload[k].onclick = function(e) {
						t.showerweima()
					}
				}
			}
		};
		if (typeof(t.first_init) != "undefined") {
			t.first_init({
				num: t.num,
				maxnum: t.conf.maxnum
			})
		} else if (typeof(t.opt.first_init) != "undefined") {
			t.opt.first_init.call(t, {
				num: t.num,
				maxnum: t.conf.maxnum
			})
		};
		if (typeof(t.first_all_huidiao) != "undefined") {
			t.first_all_huidiao({
				num: t.num,
				maxnum: t.conf.maxnum
			})
		};
		t.jishiqi_timer()
	},
	setAttr: function(a, b, c) {
		a.setAttribute(b, c);
		this.log("setAttr", a.attributes)
	},
	isPC: function() {
		var a = navigator.userAgent;
		var b = ['Android', 'iPhone', 'SymbianOS', 'Windows Phone', 'iPad', 'iPod'];
		var c = true;
		for (var i = 0; i < b.length; i++) {
			if (a.indexOf(b[i]) != -1) {
				c = false;
				break
			}
		};
		if (c == false) {
			if (window.screen.width > window.screen.height) {
				c = true
			}
		};
		return c
	},
	init_obj: function() {
		var t = this;
		t.obj_totalsize = null;
		t.obj_totaluploadsize = null;
		t.obj_totalsuccesssize = null;
		t.obj_totaldengdaisize = null;
		t.obj_totalnum = null;
		t.obj_totaluploadnum = null;
		t.obj_totalsuccessnum = null;
		t.obj_totaldengdainum = null;
		t.obj_totalbar = null;
		t.obj_totalbarnum = null;
		t.obj_totalbarsize = null;
		t.obj_totalbarbaifenbi = null;
		if (typeof(t.opt.totalsize_id) != "undefined" && t.opt.totalsize_id != "") {
			t.obj_totalsize = t.getobj(t.opt.totalsize_id)
		}
		if (typeof(t.opt.totaluploadsize_id) != "undefined" && t.opt.totaluploadsize_id != "") {
			t.obj_totaluploadsize = t.getobjs(t.opt.totaluploadsize_id)
		}
		if (typeof(t.opt.totalsuccesssize_id) != "undefined" && t.opt.totalsuccesssize_id != "") {
			t.obj_totalsuccesssize = t.getobjs(t.opt.totalsuccesssize_id)
		}
		if (typeof(t.opt.totaldengdaisize_id) != "undefined" && t.opt.totaldengdaisize_id != "") {
			t.obj_totaldengdaisize = t.getobjs(t.opt.totaldengdaisize_id)
		}
		if (typeof(t.opt.totalbarsize_id) != "undefined" && t.opt.totalbarsize_id != "") {
			t.obj_totalbarsize = t.getobjs(t.opt.totalbarsize_id)
		}
		if (typeof(t.opt.totalnum_id) != "undefined" && t.opt.totalnum_id != "") {
			t.obj_totalnum = t.getobjs(t.opt.totalnum_id)
		}
		if (typeof(t.opt.totaluploadnum_id) != "undefined" && t.opt.totaluploadnum_id != "") {
			t.obj_totaluploadnum = t.getobjs(t.opt.totaluploadnum_id)
		}
		if (typeof(t.opt.totalsuccessnum_id) != "undefined" && t.opt.totalsuccessnum_id != "") {
			t.obj_totalsuccessnum = t.getobjs(t.opt.totalsuccessnum_id)
		}
		if (typeof(t.opt.totaldengdainum_id) != "undefined" && t.opt.totaldengdainum_id != "") {
			t.obj_totaldengdainum = t.getobjs(t.opt.totaldengdainum_id)
		}
		if (typeof(t.opt.totalbarnum_id) != "undefined" && t.opt.totalbarnum_id != "") {
			t.obj_totalbarnum = t.getobjs(t.opt.totalbarnum_id)
		}
		if (typeof(t.opt.totalbar_id) != "undefined" && t.opt.totalbar_id != "") {
			t.obj_totalbar = t.getobjs(t.opt.totalbar_id)
		}
		if (typeof(t.opt.totalbarbaifenbi_id) != "undefined" && t.opt.totalbarbaifenbi_id != "") {
			t.obj_totalbarbaifenbi = t.getobjs(t.opt.totalbarbaifenbi_id)
		}
		t.obj_success_num = null;
		if (typeof(t.opt.success_num_id) != "undefined" && t.opt.success_num_id != "") {
			t.obj_success_num = t.getobjs(t.opt.success_num_id);
			if (t.obj_success_num) {
				t.set_obj_value(t.obj_success_num, 0)
			}
		}
	},
	init_rows: function() {
		var t = this;
		t.rows = new Array();
		if (typeof(t.opt.item_values) != "undefined") {
			if (typeof(t.opt.item_values) == "string") {
				var c = t.item_values.split("" + t.result.fenge);
				t.item_values = [];
				for (var i = 0; i < c.length; i++) {
					var d = {};
					if (c[i] != "") {
						var e = c[i].split("" + t.result.fenge_child);
						if (typeof(t.item_values_fields) == "array") {
							for (var j = 0; j < t.item_values_fields; j++) {
								var k = t.item_values_fields[j];
								d[k] = "";
								if (typeof(e[j]) != "undefined") {
									d[k] = e[j]
								}
							}
						} else {
							d["src"] = e[0];
							d["title"] = e[0];
							if (e.length > 1) {
								d["title"] = e[1]
							}
						}
						t.rows.push(d)
					}
				}
			} else {
				t.item_values = t.opt.item_values;
				for (var f in t.item_values) {
					t.rows.push(t.item_values[f])
				}
			}
		} else {
			if (t.input && t.input.value != "") {
				if (typeof(t.opt.first_info_url) != "undefined") {
					t.ajax({
						url: t.opt.first_info_url,
						type: "POST",
						data: {
							path: t.input.value
						},
						async: false,
						success: function(a) {
							var b = eval("(" + a + ")");
							t.rows = b
						}
					})
				} else {
					var n = 0;
					for (var k in t.input_format) {
						n++
					};
					if (t.result.fenge == "\r\n") {
						t.input.value = t.input.value.replace("\r\n", "\n");
						t.result.fenge = "\n"
					};
					var g = t.input.value.split(t.result.fenge);
					for (var i = 0; i < g.length; i++) {
						if (g[i] != "") {
							var h = g[i].split(t.result.fenge_child);
							var c = g[0].split("/"),
								name = "";
							if (c.length > 1) {
								name = c[c.length - 1]
							};
							var l = {
								src: g[0],
								name: name
							};
							for (var k in t.input_format) {
								var m = t.input_format[k];
								if (typeof(h[m]) != "undefined") {
									l[k] = h[m]
								}
							}
							if (typeof(l.size) == "undefined") {
								l["size"] = t.get_url_filesize({
									src: l.src
								})
							};
							t.rows.push(l)
						}
					}
				}
			}
		}
	},
	init_item: function(a) {
		var t = this,
			num = 0;
		var b = -1;
		t.num = 0;
		t.item_is_bt = false;
		if (typeof(t.opt.isbt) != "undefined" && t.opt.isbt == 1) {
			t.item_is_bt = true
		}
		if (!t.item_is_bt) {
			for (var i = 0; i < t.rows.length; i++) {
				var c = t.rows[i];
				t.fileCount++;
				t.num++;
				var d = t.NewItem({
					status: "first",
					src: t.getimgsrc(c.src),
					row: c,
					inserttype: "append"
				})
			};
			t.ResetInput()
		};
		if (typeof(t.first_init_complete) != "undefined") {
			t.first_init_complete({
				maxnum: t.conf.maxnum,
				num: t.num
			})
		};
		t.childs = t.getchilds();
		if (t.num > 0) {
			t.curgroupindex++
		} else {
			t.num = 0
		};
		t.ShowTotalFileSize();
		t.showstatus({
			num: t.num
		});
		window.setInterval(function() {
			t.end_time = (new Date()).getTime()
		}, 100)
	},
	getrowstr: function(a) {},
	getrowvalue: function(a, b) {
		var c = "",
			t = this;
		for (var k in t.input_format) {
			var d = t.input_format[k];
			if (k == b) {
				if (typeof(a[d]) != "undefined") {
					c = a[d];
					break
				}
			}
		};
		return c
	},
	select_hd: function(a) {
		var t = this;
		t.showstatus(a)
	},
	init_hd: function(a) {
		var t = this;
		t.showstatus(a)
	},
	del_hd: function(a) {
		var t = this;
		var b = a.item1;
		t.SetFengMianInput();
		t.showstatus(a)
	},
	showstatus: function(a) {
		var t = this;
		if (typeof(t.opt.not_null_id) != "undefined") {
			t.objnotnull = t.getobj(t.opt.not_null_id)
		}
		if (a.num <= 0) {
			if (t.objstatus) {
				t.hide(t.objstatus)
			}
			if (t.objnull) {
				t.show(t.objnull)
			}
			if (t.objnotnull) {
				t.hide(t.objnotnull)
			}
		} else {
			if (t.objstatus) {
				t.show(t.objstatus)
			}
			if (t.objnull) {
				t.hide(t.objnull)
			}
			if (t.objnotnull) {
				t.show(t.objnotnull)
			}
		};
		if (t.objforced) {
			t.show(t.objforced)
		}
	},
	show: function(a) {
		if (typeof(a["style"]) != "undefined") {
			a.style.display = ""
		} else {
			for (var k in a) {
				a[k].style.display = ""
			}
		}
	},
	hide: function(a) {
		if (typeof(a["onclick"]) != "undefined") {
			a.style.display = "none"
		} else {
			for (var k in a) {
				a[k].style.display = "none"
			}
		}
	},
	jishiqi_timer: function() {
		var t = this;
		t.totalmiao = 0;
		window.setInterval(function() {
			var a = false;
			for (var i = 0; i < t.childs.length; i++) {
				if (t.childs[i].getAttribute("mystatus") == "upload") {
					a = true;
					break
				}
			};
			if (a) {
				t.totalmiao++
			}
		}, 1000)
	},
	getstatuscount: function(a) {
		var t = this;
		var b = 0;
		for (var i = 0; i < t.childs.length; i++) {
			var c = t.childs[i];
			if (c.getAttribute("mystatus") == a) {
				b++
			}
		};
		return b
	},
	set_obj_value: function(a, b) {
		var c = function(o) {
				if (o.tagName.toLowerCase() == "input" || o.tagName.toLowerCase() == "textarea") {
					o.value = b
				} else {
					o.innerHTML = b
				}
			};
		if (a instanceof jQuery) {
			a.each(function() {
				c(this)
			})
		} else {
			c(a)
		}
	},
	get_url_filesize: function(a) {
		var b = a.src;
		var c = 0;
		if (b.indexOf("_size") > -1) {
			var d = b.split(".");
			var e = d[0].split("_");
			for (var k in e) {
				if (String(e[k]).indexOf("size") > -1) {
					c = parseInt(e[k].replace("size", ""));
					break
				}
			}
		};
		return c
	},
	get_obj_value: function(a) {
		var b = "";
		var c = function(o) {
				if (o.tagName.toLowerCase() == "input" || o.tagName.toLowerCase() == "textarea") {
					b += o.value
				} else {
					b += o.innerHTML
				}
			};
		if (a instanceof jQuery) {
			a.each(function() {
				c(this)
			})
		} else {
			c(a)
		};
		return b
	},
	reset_all: function() {
		var t = this;
		t.num = 0;
		if (t.input_fengmian) {
			t.input_fengmian.value = ""
		}
		if (t.input) {
			t.input.value = ""
		}
		t.ShowItemNum(t.num);
		t.EditInputName();
		var a = t.getchilds();
		for (var i = 0; i < a.length; i++) {
			var b = a[i];
			t.removeFile(b.id);
			var c = b.getAttribute("itemid");
			if (typeof(t.files[c]) != "undefined") {
				if (typeof(hc_cookie) != "undefined") {
					hc_cookie.Del(t.files[c].name)
				}
			}
		};
		for (var i = 0; i < a.length; i++) {
			t.removeItem(a[i], 1)
		};
		if (typeof(t.reset_huidiao) != "undefined") {
			t.reset_huidiao()
		}
	},
	create_file: function() {
		var t = this;
		var l = t.input_id + "_file";
		var m = window.navigator.userAgent.toLowerCase();
		if (m.indexOf("msie 6") != -1 || m.indexOf("msie 7") != -1 || m.indexOf("msie 8") != -1 || m.indexOf("msie 9") != -1) {
			return true
		};
		var n = document.getElementById(l);
		if (n) {
			n.parentNode.parentNode.removeChild(n.parentNode)
		};
		var o = document.createElement("span");
		o.style.cssText = "overflow:hidden;height:1px;display:inline;margin:0px;padding:0px; border:0px; overflow:hidden;line-height: 0px;width:1px; position:fixed;top:-20px;left:-200px;";
		o.className = "div_file";
		o.innerHTML = "<input type=\"file\"  accept=\"image/*\"  id=\"" + l + "\">";
		if (t.input != null) {
			t.parent.appendChild(o)
		} else {
			t.parent.appendChild(o)
		};
		var p = o.childNodes[0];
		p.style.cssText = "filter:alpha(opacity=0); -moz-opacity:0.01; -khtml-opacity:0.01; opacity: 0.01;height:0px;overflow:hidden;border:0px;padding:0px;margin:0px;line-height: 0px;";
		var q = function() {
				var a = window.navigator.userAgent.toLowerCase();
				if (a.indexOf("android") != -1 && a.indexOf("micromessenger") != -1) {
					return true
				} else {
					return false
				}
			};
		if (typeof(t.conf.maxnum) != "undefined" && t.conf.maxnum > 1) {
			if (!q()) {
				p.setAttribute("multiple", "multiple")
			}
		};
		p.onchange = function() {
			var j = this.files;
			if (typeof(t.select_file_log) != "undefined") {
				t.select_file_log({
					inputfileid: this.id,
					files: j
				})
			};
			if (typeof(t.select_file_before) != "undefined") {
				var k = t.select_file_before(j);
				if (!k) {
					this.value = "";
					return false
				};
				if (typeof(k) == "object") {
					j = k
				}
			};
			t.JiaoZhengFiles(j, function(h) {
				if (typeof(t.opt.cropper) != "undefined" && typeof(hcfile_cropper) != "undefined") {
					for (var i = 0; i < h.length; i++) {
						(function(f) {
							if (t.IsImg(f.name)) {
								var g = hcfile_cropper();
								g.show({
									options: t.opt.cropper,
									file: f,
									success: function(b) {
										var c = new Array();
										if (t.conf.isnewsmall == 1) {
											c.push(f);
											var d = new FileReader();
											d.readAsDataURL(b.file);
											d.onload = function(e) {
												var a = new Image();
												a.src = d.result;
												a.onload = function() {
													t.start(c)
												}
											}
										} else {
											c.push(b.file);
											t.start(c)
										};
										g = null
									}
								})
							} else {
								t.myalert("不是图片")
							}
						})(h[i])
					}
				} else {
					t.start(h)
				}
			});
			window.setTimeout(function() {
				t.create_file()
			}, 500)
		};
		if (typeof(t.conf.type) != "undefined" && t.conf.type == "img") {
			var r = window.navigator.userAgent.indexOf("Chrome") !== -1;
			if (r) {
				p.setAttribute("accept", "image/*")
			} else {
				p.setAttribute("accept", "*")
			}
		} else {
			p.setAttribute("accept", "*")
		};
		if (typeof(t.file_attr) != "undefined") {
			for (var k in t.file_attr) {
				p.setAttribute(k, t.file_attr[k])
			}
		};
		t.file = p
	},
	JiaoZhengFiles: function(b, c) {
		var d = b.length,
			success_num = 0,
			t = this;
		var e = t.IsJiaoZheng();
		if (!e) {
			c(b);
			return false
		};
		for (var i = 0; i < b.length; i++) {
			(function(i) {
				t.JiaoZheng(b[i], function(a) {
					b[i] = a.file;
					success_num++;
					if (success_num == d) {
						c(b)
					}
				})
			})(i)
		}
	},
	JiaoZheng: function(f, g) {
		var t = this;
		if (t.IsImg(f.name)) {
			if (typeof(EXIF) != "undefined") {
				var h = 0;
				EXIF.getData(f, function() {
					var b = EXIF.getTag(this, 'Orientation');
					if (typeof(b) != "undefined") {
						h = b
					};
					if (h > 0) {
						var c = new FileReader();
						c.readAsDataURL(f);
						c.onload = function(e) {
							var a = new Image();
							a.src = c.result;
							a.onload = function() {
								var d = t.getImgData({
									orient: h,
									file: f,
									img: a
								});
								if (typeof(g) != "undefined") {
									g({
										file: d.file,
										base64: d.base64
									})
								}
							}
						}
					} else {
						g({
							file: f
						})
					}
				})
			} else {
				g({
					file: f
				})
			}
		} else {
			if (typeof(g) != "undefined") {
				g({
					file: f
				})
			}
		}
	},
	IsJiaoZheng: function() {
		var a = navigator.userAgent.toLowerCase(),
			t = this;
		var b = new Array(),
			isbool = false;
		if (typeof(g_jiaozheng_ua) != "undefined") {
			b = b.concat(g_jiaozheng_ua)
		};
		if (typeof(t.opt.jiaozheng_ua) != "undefined") {
			b = b.concat(t.opt.jiaozheng_ua)
		};
		for (var i = 0; i < b.length; i++) {
			var c = (typeof(b[i]["userAgent"]) != "undefined" ? b[i]["userAgent"] : b[i]);
			if (c != "" && a.indexOf(c) > -1) {
				isbool = true;
				break
			}
		};
		return isbool
	},
	UserMediaSuccess: function(a) {
		var t = this;
		if (typeof(t.usermedia_num) == "undefined") {
			t.usermedia_num = 0
		};
		if (t.usermedia_num == 0) {
			if (typeof(t.usermedia_first_huidiao) != "undefined") {
				t.usermedia_first_huidiao(a, t.mediaStreamTrack)
			} else {
				t.FirstUserMedia(a)
			}
		};
		if (typeof(t.usermedia_success_huidiao) != "undefined") {
			t.usermedia_success_huidiao(a, t.mediaStreamTrack)
		} else {
			if (a) {
				t.ShowUserMedia(a)
			}
		};
		t.usermedia_num++
	},
	CloseUserMedia: function() {
		var t = this;
		t.usermedia_num = 0;
		if (t.umedia_stream) {
			if (typeof(t.umedia_stream.stop) != "undefined") {
				t.umedia_stream.stop()
			} else {
				t.umedia_stream.getTracks()[0].stop()
			}
		};
		if (typeof(t.umedia_parent) != "undefined") {
			t.umedia_parent.parentNode.removeChild(t.umedia_parent)
		}
	},
	FirstUserMedia: function() {
		var t = this;
		t.umedia_parent = document.createElement("div");
		t.umedia_parent.className = "umedia_parent";
		t.body.appendChild(t.umedia_parent);
		t.umedia_parent_rel = document.createElement("div");
		t.umedia_parent_rel.className = "umedia_parent_rel";
		t.umedia_parent.appendChild(t.umedia_parent_rel);
		t.umedia_parent_con = document.createElement("div");
		t.umedia_parent_con.className = "umedia_parent_con";
		t.umedia_parent_rel.appendChild(t.umedia_parent_con);
		t.umedia_parent_inner = document.createElement("div");
		t.umedia_parent_inner.className = "umedia_parent_inner";
		t.umedia_parent_con.appendChild(t.umedia_parent_inner);
		t.umedia_video = document.createElement("video");
		t.umedia_video.width = t.umedia_parent_con.offsetWidth;
		t.umedia_video.height = t.umedia_parent_con.offsetHeight;
		t.umedia_video.setAttribute("controls", "controls");
		t.umedia_parent_inner.appendChild(t.umedia_video);
		t.umedia_capture = document.createElement("input");
		t.umedia_capture.type = "button";
		t.umedia_capture.value = "拍摄";
		t.umedia_capture.className = "umedia_capture";
		t.umedia_parent_inner.appendChild(t.umedia_capture);
		t.umedia_close = document.createElement("input");
		t.umedia_close.type = "button";
		t.umedia_close.value = "×";
		t.umedia_close.className = "umedia_close";
		t.umedia_parent_inner.appendChild(t.umedia_close);
		t.umedia_canvas = document.createElement("canvas");
		t.umedia_canvas.width = t.umedia_video.offsetWidth;
		t.umedia_canvas.height = t.umedia_video.offsetHeight;
		t.umedia_capture.onclick = function() {
			if (typeof(t.opt.camera) != "undefined") {
				if (typeof(t.opt.camera.issave) == "undefined" || t.opt.camera.issave == 1) {
					var a = new Array();
					var b = t.convertBase64UrlToBlob(t.imgData);
					b.name = "capture" + t.newrand(6);
					a.push(b);
					t.start(a)
				}
			};
			if (typeof(t.usermedia_capture_huidiao) != "undefined") {
				t.usermedia_capture_huidiao({
					base64: t.imgData
				})
			};
			t.ShowUserMediaBase64();
			t.CloseUserMedia();
			window.clearInterval(t.umedia_timer)
		};
		t.umedia_timer = null;
		t.umedia_close.onclick = function() {
			t.CloseUserMedia();
			window.clearInterval(t.umedia_timer)
		};
		if (typeof(t.opt.camera) != "undefined" && typeof(t.opt.camera.time) != "undefined") {
			if (t.opt.camera.time < 20) {
				t.opt.camera.time = 20
			};
			t.umedia_timer = window.setInterval(function() {
				t.ShowUserMediaBase64()
			}, t.opt.camera.time)
		}
	},
	ShowUserMediaBase64: function() {
		var t = this;
		var a = t.umedia_canvas.getContext('2d');
		var b = t.umedia_video.videoWidth,
			_h = t.umedia_video.videoHeight;
		a.fillRect(0, 0, b, _h);
		a.drawImage(t.umedia_video, 0, 0, b, _h);
		t.imgData = t.umedia_canvas.toDataURL();
		if (typeof(t.opt.camera) != "undefined") {
			if (typeof(t.opt.camera.isautosave) != "undefined" || t.opt.camera.isautosave == 1) {
				var c = new Array();
				var d = t.convertBase64UrlToBlob(t.imgData);
				d.name = "capture" + t.newrand(6);
				c.push(d);
				t.start(c);
				if (typeof(t.usermedia_capture_huidiao) != "undefined") {
					t.usermedia_capture_huidiao({
						base64: t.imgData
					})
				}
			}
		}
	},
	ShowUserMedia: function(a) {
		var t = this;
		var b = window.URL || window.webkitURL;
		t.umedia_stream = a;
		if (typeof(t.umedia_video["srcObject"]) != "undefined") {
			t.umedia_video.srcObject = a
		} else {
			t.umedia_video.src = b.createObjectURL(a)
		}
		t.umedia_video.play()
	},
	UserMediaError: function(a) {
		var t = this;
		console.log("访问用户媒体设备失败：", a.message);
		t.myalert("访问用户媒体设备失败")
	},
	getUserMedia: function(a, b, c) {
		var t = this;
		t.umedia_video_conf = a.video;
		var d = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia;
		if (d) {
			d(a).then(b).
			catch (c)
		} else {
			t.myalert("你的浏览器不支持摄像头设备")
		}
	},
	GetSmallImg: function(a) {
		var b = a,
			t = this,
			arr2 = a.split("."),
			ext = arr2[arr2.length - 1];
		if (t.conf.isnewsmall == 1) {
			if (t.IsImg(ext)) {
				var c = a.split("/");
				var d = c[c.length - 1];
				if (a.indexOf(t.conf.small_hz) != -1) {
					b = b
				} else if (a.indexOf(t.conf.big_hz) != -1) {
					b = a.replace(t.conf.big_hz, t.conf.small_hz)
				} else if (a.indexOf("/s80/") != -1 || a.indexOf("/s100/") != -1) {
					b = a.replace("/s80/", "/s100/");
					b = a.replace("/s100/", "/s50/")
				} else if (a.indexOf("_s80.") != -1 || a.indexOf("_s100.") != -1) {
					b = a.replace("_s80.", "_s100.");
					b = a.replace("_s80.", "_s50.")
				}
			}
		};
		return b
	},
	getbigsrc: function(a) {
		if (typeof(a) == "undefined" || a == null) {
			return ""
		};
		var b = a,
			t = this,
			arr2 = a.split("."),
			ext = arr2[arr2.length - 1];
		if (t.IsImg(ext)) {
			var c = a.split("/");
			var d = c[c.length - 1];
			if (typeof(t.conf.small_hz) != "undefined" && t.conf.small_hz != "" && b.indexOf(t.conf.small_hz) != -1) {
				b = b.replace(t.conf.small_hz, t.conf.big_hz)
			} else if (a.indexOf("_s50.") != -1 || a.indexOf("_s80.") != -1 || a.indexOf("_s100.") != -1) {
				b = b.replace("_s50.", "_s100.");
				b = b.replace("_s80.", "_s100.")
			} else if (a.indexOf("/s50/") != -1 || a.indexOf("/s80/") != -1 || a.indexOf("/s100/") != -1) {
				b = b.replace("/s50/", "/s100/");
				b = b.replace("/s80/", "/s100/")
			} else if (a.indexOf("/s/") != -1 || a.indexOf("/m/") != -1) {
				b = b.replace("/s/", "/b/");
				b = b.replace("/s/", "/b/")
			} else if (a.indexOf("_small") != -1) {
				b = b.replace("_small", "")
			} else {
				if (a.indexOf("." + ext + "." + ext + "." + ext) == -1 && a.indexOf("imgs") != -1) {
					b = a + "." + ext + "." + ext
				}
			}
		};
		return b
	},
	check_bitian: function() {
		var t = this,
			isbool = true;
		if (typeof(t.opt.bitian) != "undefined") {
			for (var a in t.opt.bitian) {
				var b = t.opt.bitian[a],
					obj = t.getobj({
						id: b.id
					});
				var c = "";
				if (typeof(b.msg) != "undefined") {
					c = b.msg
				}
				if (typeof(b.placeholder) != "undefined") {
					c = b.placeholder
				}
				if (typeof(c) == "" && obj.getAttribute("placeholder") != null && typeof(obj.getAttribute("placeholder")) != "undefined") {
					c = obj.getAttribute("placeholder")
				}
				if (obj && obj.tagName == "SELECT") {
					if (obj.selectedIndex == 0) {
						if (c == "") {
							c = obj.options[0].text
						};
						t.myalert(c);
						isbool = false;
						break
					}
				} else if (obj) {
					var d = t.get_obj_value({
						obj: obj
					});
					if (d == "") {
						if (c == "") {
							c = "请先填写" + obj.id + "的值"
						};
						t.myalert(b.msg);
						isbool = false;
						break
					}
				}
			}
		};
		return isbool
	},
	getobj: function(o) {
		var a = null;
		if (typeof(o) == "string") {
			a = document.getElementById(o)
		} else {
			a = document.getElementById(o.id)
		};
		return a
	},
	getobjs: function(a, b) {
		var c = new Array();
		var d = "",
			name1 = "";
		if (typeof(b) == "undefined") {
			var e = a.split(",");
			for (var i = 0; i < e.length; i++) {
				var n = e[i];
				if (e[i].indexOf("#") != -1) {
					n = e[i].replace("#", "");
					var f = document.getElementById(n);
					if (f) {
						c.push(f)
					}
				} else {
					var f = document.getElementById(n);
					if (f) {
						c.push(f)
					}
				}
			}
		} else {
			var e = b.split(",");
			var g = a.getElementsByTagName("*");
			for (var i = 0; i < g.length; i++) {
				var h = g[i];
				for (var y = 0; y < e.length; y++) {
					name1 = String(e[y]);
					d = "id";
					if (name1.indexOf("#") != -1) {
						d = "id"
					} else if (name1.indexOf(".") != -1) {
						d = "class";
						var k = name1.split(".");
						name1 = k[0]
					};
					if (d == "class" && typeof(h.className) != "undefined" && h.className != null) {
						var e = h.className.split(" ");
						for (var j = 0; j < e.length; j++) {
							if (e[j] == (name1)) {
								c.push(h)
							}
						}
					} else if (d == "id" && typeof(h.id) != "undefined" && h.id != null && h.id == name1) {
						c.push(h)
					}
				}
			}
		};
		return c
	},
	create_submit_iframe: function(a) {
		var t = this;
		if (typeof(t.opt.select_id) != "undefined") {
			var b = t.getobjs(t.opt.select_id);
			for (var i = 0; i < t.objs.length; i++) {
				t.btselect.push(b[i])
			}
		};
		if (typeof(t.opt.weizhi_id) != "undefined") {
			var b = t.getobjs(t.opt.weizhi_id);
			for (var i = 0; i < t.objs.length; i++) {
				t.btselect.push(b[i])
			}
		};
		for (var i = 0; i < t.btselect.length; i++) {
			t.create_submit_iframe_a(t.btselect[i])
		}
	},
	create_submit_iframe_a: function(a) {
		var t = this;
		var b = "";
		var c = t.opt.url.split("/");
		for (var i = 0; i < (c.length - 1); i++) {
			b += c[i] + "/"
		};
		var d = "";
		if (t.opt.url.indexOf(".php") != -1) {
			b += "uploadiframe.php"
		} else if (t.opt.url.indexOf(".asp") != -1) {
			b += "uploadiframe.asp"
		} else {
			b += "uploadiframe.aspx"
		};
		var e = b + "?inputid=" + t.input_id + "&func=hcfilehuidiao&issmall=" + t.conf.isnewsmall;
		if (typeof(t.post) != "undefined") {
			for (var k in t.post) {
				e += "&" + k + "=" + t.post[k]
			}
		}
		if (typeof(t.opt.conf) != "undefined" && typeof(t.opt.conf.small_hz_name) != "undefined") {
			e += "&small_hz_name=" + t.opt.conf.small_hz_name
		};
		var f = document.createElement("iframe");
		f.src = e;
		f.style.border = 0;
		f.frameBorder = 0;
		f.setAttribute("frameborder", 0);
		f.setAttribute("allowtransparency", true);
		f.setAttribute("scrolling", "no");
		var g = a.offsetHeight;
		var h = a.offsetWidth;
		e += "&width=" + h + "&height=" + g;
		f.style.cssText = "width:" + h + "px;height:" + g + "px;";
		a.parentNode.insertBefore(f, a);
		a.style.display = "none"
	},
	create_submit: function() {
		var t = this;
		var a = null;
		if (t.input) {
			a = t.input.parentNode
		} else {
			a = t.body
		}
		t.weizhi = null;
		var b = 0;
		if (typeof(t.opt.select_id) != "undefined") {
			var c = t.getobjs(t.opt.select_id);
			for (var i = 0; i < c.length; i++) {
				t.btselect.push(c[i])
			}
		};
		if (typeof(t.opt.weizhi_id) != "undefined") {
			var c = t.getobjs(t.opt.weizhi_id);
			for (var i = 0; i < c.length; i++) {
				t.btselect.push(c[i])
			}
		};
		if (typeof(t.opt.bt_select_id) != "undefined") {
			var c = t.getobjs(t.opt.bt_select_id);
			for (var i = 0; i < c.length; i++) {
				t.btselect.push(c[i])
			}
		};
		for (var i = 0; i < t.btselect.length; i++) {
			b++;
			if (typeof(t.opt.bgsrc) != "undefined" && t.opt.bgsrc != "") {
				var d = t.getwh();
				t.btselect[i].innerHTML = "<img src='" + t.opt.bgsrc + "' style='width:" + d.width + ";height:" + d.height + ";'/>"
			};
			t.reg_select_click(t.btselect[i])
		};
		if (typeof(t.opt.select_camera_id) != "undefined") {
			t.btselectcamera = t.getobjs(t.opt.select_camera_id);
			for (var i = 0; i < t.btselectcamera.length; i++) {
				t.reg_select_camera_click(t.btselectcamera[i])
			}
		};
		if (b == 0) {
			var e = t.moren_bgsrc;
			var f = 100,
				btwidth = 100;
			if (typeof(t.opt.width) != "undefined") {
				btwidth = t.opt.width
			}
			if (typeof(t.opt.height) != "undefined") {
				f = t.opt.height
			}
			var g = "";
			if (t.input && t.input.value != "" && t.conf.maxnum == 1) {
				var h = t.input.value.split("" + t.result.fenge);
				e = t.getfullsrc(t.getrowvalue(h[0].split("" + t.result.fenge_child), "src"))
			}
			var j = null;
			if (typeof(t.opt.isbt) != "undefined" && t.opt.isbt == 1) {
				var k = {};
				if (t.rows.length > 0) {
					k = t.rows[0]
				}
				j = t.NewItem({
					parent: a,
					src: e,
					type: "init",
					other_type: "bt",
					width: btwidth,
					height: f,
					row: k
				});
				j.style.float = "left";
				if (typeof(t.opt.item_class) != "undefined") {
					t.addClass(j, t.opt.item_class)
				}
				var l = t.GetObjByClass(j, "rel_img");
				t.item = j;
				l.childNodes[0].src = e;
				l.childNodes[0].onclick = null;
				t.ShowYuanSu({
					myitem: j,
					conf: t.selectbt_show
				});
				t.reg_select_click(j)
			}
		};
		return false
	},
	reg_select_click: function(d) {
		var t = this;
		d.onclick = function(e) {
			if (typeof(t.select_before) != "undefined") {
				var v = t.select_before();
				if (v == false) {
					return false
				}
			};
			if (!t.check_bitian()) {
				return false
			}
			if (t.conf.maxnum == t.num && t.conf.maxnum != 1) {
				t.myalert("只能上传" + t.conf.maxnum + "个文件");
				return false
			}
			if (t.file_attr["capture"] == "camera" && typeof(t.opt.camera) != "undefined" && t.isPC()) {
				t.myalert("正在打开");
				var b = 500;
				var c = 500;
				if (typeof(t.opt.camera) != "undefined") {
					if (typeof(t.opt.camera.width) != "undefined") {
						b = t.opt.camera.width
					};
					if (typeof(t.opt.camera.height) != "undefined") {
						c = t.opt.camera.height
					}
				};
				t.getUserMedia({
					audio: false,
					video: {
						width: b,
						height: c
					}
				}, function(a) {
					t.UserMediaSuccess(a)
				}, function(a) {
					t.UserMediaError(a)
				})
			} else {
				t.file.click()
			};
			if (e && e.stopPropagation) {
				e.stopPropagation()
			} else {
				window.event.cancelBubble = true;
				return false
			}
		}
	},
	reg_select_camera_click: function(d) {
		var t = this;
		d.onclick = function(e) {
			if (typeof(t.select_before) != "undefined") {
				var v = t.select_before();
				if (v == false) {
					return false
				}
			};
			if (!t.check_bitian()) {
				return false
			}
			t.num = t.childs.length;
			if (t.conf.maxnum == t.num && t.conf.maxnum != 1) {
				t.myalert("只能上传" + t.conf.maxnum + "个文件");
				return false
			}
			if (t.camera_attr["capture"] == "camera" && t.isPC()) {
				t.myalert("正在打开");
				var b = 500;
				var c = 500;
				if (typeof(t.opt.camera) != "undefined") {
					if (typeof(t.opt.camera.width) != "undefined") {
						b = t.opt.camera.width
					};
					if (typeof(t.opt.camera.height) != "undefined") {
						c = t.opt.camera.height
					}
				};
				t.getUserMedia({
					audio: false,
					video: {
						width: b,
						height: c
					}
				}, function(a) {
					t.UserMediaSuccess(a)
				}, function(a) {
					t.UserMediaError(a)
				})
			} else {
				t.file_camera.click()
			};
			if (e && e.stopPropagation) {
				e.stopPropagation()
			} else {
				window.event.cancelBubble = true;
				return false
			}
		}
	},
	openCamera: function() {
		uexCamera.cbOpen = function(i, j, k) {
			var l = k;
			appcan.file.open({
				filePath: l,
				mode: 1,
				callback: function(d, e, f, g) {
					if (d) {
						alert(d);
						return
					};
					var h = new FileReader();
					h.readAsDataURL(e);
					h.onload = function() {
						var a = h.result;
						var b = document.getElementsByTagName("body")[0];
						var c = document.createElement("img");
						c.src = a;
						b.appendChild(c)
					}
				}
			})
		};
		uexCamera.open()
	},
	start: function(a, b) {
		var c = "";
		var t = this;
		var d = Array();
		var e = "";
		if (typeof(b) != "undefined") {
			e = b
		};
		var f = String(navigator.userAgent);
		t.childs = t.getchilds();
		var g = [];
		var h = "";
		var j = "";
		var k = t.childs.length;
		for (var i = 0; i < a.length; i++) {
			k++;
			var l = a[i];
			if (t.maxfilesize == 0 || t.maxfilesize > l.size) {
				var m = l.type;
				var n = l.name;
				var o = t.FileExt({
					file: l
				});
				if (t.IsUpload(o)) {
					if (t.conf.maxnum == 1) {
						if (g.length == 0) {
							g.push(l)
						}
					} else if (t.conf.maxnum > 0 && k <= t.conf.maxnum) {
						g.push(l)
					} else {
						t.myalert("最多只能上传" + t.conf.maxnum + "个文件")
					}
				} else {
					if (h != "") {
						h += "," + o
					} else {
						h = o
					}
					t.myalert("不允许上传" + o)
				}
			} else {
				j = "大小不能超过" + t.FormatSize(t.maxfilesize);
				t.myalert(j)
			}
		};
		if (g.length == 0) {
			return false
		};
		if (t.panel) {
			t.panel.style.display = ""
		};
		var p = g.length;
		var q = null;
		var r = [];
		if (typeof(t.opt.isbt) != "undefined" && t.opt.isbt == 1) {} else {
			if (t.conf.maxnum == 1) {
				t.num = 1;
				for (var i = 0; i < t.childs.length; i++) {
					t.childs[i].parentNode.removeChild(t.childs[i])
				}
			}
		}
		if (typeof(t.start_before) != "undefined") {
			var s = t.start_before({
				childs: t.childs,
				num: t.getstatuscount("dengdai"),
				files: g
			});
			if (typeof(s) != "undefined" && s == false) {
				return false
			}
		};
		t.startupload(g)
	},
	startupload: function(d) {
		var t = this;
		var e = d.length;
		for (var i = 0; i < e; i++) {
			(function(i) {
				var a = true;
				var b = false;
				if (typeof(t.opt.isbt) != "undefined" && t.opt.isbt == 1) {
					b = true
				}
				if (b) {
					myitem = t.item
				} else {
					myitem = t.NewItem({
						file: d[i],
						style: {
							display: "none"
						}
					})
				};
				if (typeof(myitem.id) == "undefined") {
					myitem.id = "myitem_" + t.newrand(6);
					var c = myitem.getElementsByTagName("*");
					for (var y = 0; y < c.length; y++) {
						c[y].setAttribute("itemid", myitem.id)
					}
				};
				t.posts[myitem.id] = {};
				if (typeof(t.init_huidiao) != "undefined") {
					var v = t.init_huidiao({
						item1: myitem,
						myitem: myitem,
						file: d[i]
					});
					if (typeof(v) != "undefined") {
						a = v
					}
				};
				if (a) {
					myitem.style.display = "block";
					ext = t.FileExt({
						file: d[i]
					});
					if (t.IsImg(ext) && typeof(d[i].yasuoshuiyin) == "undefined") {
						t.files[myitem.id] = {
							itemid: myitem.id,
							status: "dengdai",
							file: d[i],
							isupload: 0,
							"name": d[i].name
						};
						myitem.setAttribute("mysizeyy", d[i].size);
						t.YaSuo({
							myitem: myitem,
							file: d[i],
							title: d[i].name,
							ext: ext,
							size: d[i].size,
							autoupload: 0
						})
					} else {
						myitem.setAttribute("mysize", d[i].size);
						t.files[myitem.id] = {
							itemid: myitem.id,
							status: "dengdai",
							file: d[i],
							isupload: 1,
							"name": d[i].name
						}
					}
				} else {
					if (!b) {
						myitem.parentNode.removeChild(myiten)
					}
				}
			})(i)
		};
		t.bar_ids = Array();
		for (var f in t.files) {
			if (typeof(t.files[f]) != "undefined") {
				var g = t.files[f].status;
				if (g == "dengdai" || g == "upload") {
					t.bar_ids.push(f)
				}
			}
		};
		t.childs = t.getchilds();
		t.num = t.childs.length;
		t.ShowTotalFileSize();
		t.showstatus({
			num: t.num
		});
		window.setTimeout(function() {
			t.file.value = ""
		}, 500);
		if (t.isautosend == 1) {
			t.send()
		}
	},
	getchilds: function() {
		var t = this;
		var a = new Array();
		if (t.panel) {
			for (var j = 0; j < t.panel.childNodes.length; j++) {
				if (t.panel.childNodes[j] && t.panel.childNodes[j].getAttribute) {
					var b = t.panel.childNodes[j].getAttribute("myparent");
					if (typeof(b) != "undefined" && b) {
						a.push(t.panel.childNodes[j])
					}
				}
			}
		};
		return a
	},
	selectonefile: function(e) {
		var t = this;
		var f = document.getElementById(e.itemid + "_file");
		if (typeof(t.select_before) != "undefined") {
			var v = t.select_before();
			if (v == false) {
				return false
			}
		};
		if (!t.check_bitian()) {
			return false
		}
		f.click();
		f.value = "";
		f.onchange = function() {
			if (this.files.length > 0) {
				var a = this.files[0];
				t.files[e.itemid] = {
					itemid: e.itemid,
					status: "dengdai",
					file: a,
					isupload: 1,
					"name": a.name
				};
				var b = t.getobjs(t.panel, e.itemid);
				var c = null;
				if (b.length > 0) {
					c = b[0];
					c.setAttribute("iscx", 1);
					var d = t.GetObjByClass(c, "rel_name");
					if (d) {
						d.innerHTML = t.files[e.itemid].file.name
					};
					c.setAttribute("myuploadsize", 0);
					c.setAttribute("mysize", a.size);
					c.setAttribute("mystatus", t.files[e.itemid]["status"]);
					c.setAttribute("mysizeyy", a.size);
					ext = t.FileExt({
						file: t.files[e.itemid].file
					});
					if (t.IsImg(ext)) {
						t.files[c.id]["isupload"] = 0;
						t.YaSuo({
							myitem: c,
							file: a,
							title: a.name,
							ext: ext,
							size: a.size,
							autoupload: 0
						})
					} else {
						t.files[c.id]["isupload"] = 1
					};
					t.send()
				};
				a.value = ""
			}
		}
	},
	chongchuanfile: function(a) {
		var t = this;
		if (typeof(t.select_before) != "undefined") {
			var v = t.select_before();
			if (v == false) {
				return false
			}
		};
		if (!t.check_bitian()) {
			return false
		}
		if (typeof(t.files[a.itemid]) != "undefined") {
			t.files[a.itemid].isupload = 1;
			var b = null;
			var c = t.getobjs(t.panel, a.itemid);
			if (c.length > 0) {
				b = c[0]
			}
			var o = t.GetObjByClass(b, "rel_chongchuan");
			if (o) {
				o.style.display = "none"
			};
			var d = t.GetObjByClass(b, "rel_baifenbi");
			d.innerHTML = "等待";
			b.setAttribute("iscx", 1);
			var e = t.GetObjByClass(b, "rel_name");
			if (e) {
				e.innerHTML = t.files[a.itemid].file.name
			};
			b.setAttribute("mysize", t.files[a.itemid].file.size);
			t.uploada({
				myitem: b,
				file: t.files[a.itemid].file
			})
		}
	},
	send: function() {
		var t = this;
		var n = 0;
		if (!t.check_bitian()) {
			return false
		}
		for (var h in t.files) {
			var i = t.files[h];
			if (i.status == "dengdai") {
				n++
			}
		}
		if (n == 0) {
			t.myalert("请选择文件");
			return false
		}
		var j = 3;
		if (t.itemstyle == "1") {
			if (t.item) {
				t.item.style.display = "none"
			}
			if (t.panel) {
				t.panel.style.display = ""
			}
		};
		if (typeof(t.opt.limit) != "undefined") {
			j = t.opt.limit
		};
		var k = function() {
				var e = 0,
					d = 0,
					isbool = 1;
				for (var f in t.files) {
					if (t.files[f].status == "upload") {
						e++
					}
					if (t.files[f].isupload == 0) {
						isbool = 0
					}
					d++
				}
				if (isbool == 1) {
					for (var f in t.files) {
						var g = t.files[f];
						(function(a) {
							if (a.status == "dengdai" && (e < j || j == 0)) {
								t.files[f].status = "upload";
								var b = null;
									var c = document.getElementById(f);
								
									if (c) {
										b =c;	
										t.uploada({
										myitem: b,
										file: a.file
										});
										e++
									};
									
	
								 

							}
						})(g)
					}
				};
				if (d == 0) {
					window.clearInterval(l)
				}
			};
		k();
		var l = window.setInterval(function() {
			k()
		}, 1000)
	},
	uploada: function(a) {
console.log(a);
		var t = this;
		var b = a.file;
		var c = "";
		var d = b.name;
		var e = a.myitem;
		var f = t.RndNum(20);

		var g = b.type;
		var h = b.name;
		var i = h.split(".");
		var j = i[i.length - 1];
		j = j.toLowerCase();
		var k = t.files[e.id];
		var l = "";
		if (typeof(k["smallbase64"]) != "undefined") {
			l = k["smallbase64"]
		};
		d = d.replace(new RegExp("." + j, "gm"), "");
		c = t.FileExt({
			file: b
		});
		if (typeof(t.posts[e.id]) == "undefined") {
			t.posts[e.id] = {}
		};
		var m = true;
		if (typeof(t.start_upload) != "undefined") {
			m = t.start_upload({
				myitem: e,
				item1: e,
				file: b
			});
			if (typeof(m) == "undefined") {
				m = true
			}
		};
		if (m) {
			t.SaveFileBytes({
				myitem: e,
				file: b,
				title: d,
				ext: c,
				size: b.size,
				smallbase64: l
			})
		}
	},
	YaSuo: function(n) {
		var t = this;
		var o = new Image();
		var p = n.file.name,
			file = n.file;
	 
		var q = [];
		var r = false;
		if (typeof(t.opt.newfiles) != "undefined") {
			q = t.opt.newfiles;
			r = true
		} else {
			var s = {
				name: "file",
				type: "file"
			};
			if (typeof(t.opt.shuiyin) != "undefined") {
				s.shuiyin = t.opt.shuiyin;
				r = true
			};
			if (typeof(n.shuiyin) != "undefined") {
				s.shuiyin = n.shuiyin;
				r = true
			};
			if (typeof(t.opt.yasuo) != "undefined") {
				s.yasuo = t.opt.yasuo;
				r = true
			};
			if (typeof(n.yasuo) != "undefined") {
				s.yasuo = n.yasuo;
				r = true
			};
			q.push(s);
			if (t.conf.isnewsmall == 1) {
				var u = {
					name: "smallbase64",
					type: "base64"
				};
				if (typeof(t.opt.yasuo_newsmall) != "undefined") {
					u.yasuo = t.opt.yasuo_newsmall;
					r = true
				};
				if (typeof(n.yasuo_newsmall) != "undefined") {
					u.yasuo = n.yasuo_newsmall;
					r = true
				};
				if (typeof(t.opt.shuiyin_newsmall) != "undefined") {
					u.shuiyin = t.opt.shuiyin_newsmall;
					r = true
				};
				if (typeof(n.shuiyin_newsmall) != "undefined") {
					u.shuiyin = n.shuiyin_newsmall;
					r = true
				};
				console.log("smallconfig", u);
				q.push(u)
			}
			if (t.conf.isnewmid == 1) {
				var v = {
					name: "midfile",
					type: "file"
				};
				if (typeof(t.opt.yasuo_newmid) != "undefined") {
					v.yasuo = t.opt.yasuo_newmid;
					r = true
				};
				if (typeof(n.yasuo_newmid) != "undefined") {
					v.yasuo = n.yasuo_newmid;
					r = true
				};
				if (typeof(t.opt.shuiyin_newmid) != "undefined") {
					v.shuiyin = t.opt.shuiyin_newmid;
					r = true
				};
				if (typeof(n.shuiyin_newmid) != "undefined") {
					v.shuiyin = n.shuiyin_newmid;
					r = true
				};
				q.push(v)
			}
		};
		if (typeof(n.ext) == "undefined" && n.file) {
			n.ext = t.GetFileExt(n.file.name)
		};
		if (r) {
			var x = 0;
			var z = new FileReader();
			z.readAsDataURL(n.file);
			z.onload = function(e) {
				var j = z.result;
				o.src = j;
				if (n.myitem) {
					if (t.conf.isyulan == 1) {
						var l = t.GetObjByClass(n.myitem, "rel_img");
						if (l) {
							var m = l.getElementsByTagName("img");
							if (m.length > 0) {
								m[0].src = j
							}
						}
					}
				};
				o.onload = function() {
					if (n.myitem) {
						if (typeof(t.posts[myitem.id]) == "undefined") {
							t.posts[myitem.id] = {}
						}
					};
					var w = o.width;
					var h = o.height;
					var f = w / h;
					if (w > 1024) {
						w = 1024;
						h = w / f;
						o.width = w;
						o.height = h
					};
					if (n.myitem) {
						if (t.conf.isnewsmall == 1) {
							if (typeof(t.files[n.myitem.id]["smallbase64"]) == "undefined" || t.files[n.myitem.id]["smallbase64"] == "") {
								n["smallbase64"] = t.GetNewSmallBase64({
									img: o,
									file: n.file
								});
								t.files[n.myitem.id]["smallbase64"] = n["smallbase64"]
							}
						}
					};
					var g = 1;
					if (g > 0) {
						var i = function(c) {
								var d = q.length;
								var e = 0;
								if (n.myitem) {
									if (typeof(t.posts_other[n.myitem.id]) == "undefined") {
										t.posts_other[n.myitem.id] = {}
									}
								};
								for (var y = 0; y < q.length; y++) {
									(function(k) {
										e++;
										var b = q[k];
										t.new_shuiyin_blob(c, n.file, b, function(a) {
											if (n.myitem) {
												console.log("op.conf", a.conf);
												if (a.conf.name == "file") {
													a.file.name = n.file.name;
													t.files[n.myitem.id].file = a.file;
													n.myitem.setAttribute("mysize", a.file.size)
												} else {
													if (a.conf.type == "base64") {
														if (a.conf.name == "smallbase64") {
															t.files[n.myitem.id][a.conf.name] = a.base64
														} else {
															t.posts_other[n.myitem.id][a.conf.name] = a.base64
														}
													} else if (a.conf.type == "file") {
														a.file.name = a.conf.name + "_" + n.file.name;
														t.posts_other[n.myitem.id][a.conf.name] = a.file
													}
												}
											};
											console.log(d, e);
											if (d == e) {
												if (n.myitem) {
													t.files[n.myitem.id].isupload = 1
												};
												if (typeof(n.success) != "undefined") {
													n.success(a.file)
												}
												console.log("opt.autoupload", n.autoupload);
												if ((typeof(n.autoupload) != "undefined" && n.autoupload == 1) || typeof(n.autoupload) == "undefined") {
													if (n.myitem) {
														n.file = t.files[n.myitem.id].file;
														t.uploada(n)
													}
												}
											}
										})
									})(y)
								}
							};
						i(o)
					} else {
						if (n.myitem) {
							t.files[n.myitem.id].file = file;
							t.files[n.myitem.id].isupload = 1;
							n.myitem.setAttribute("mysize", file.size)
						}
						n.file = file;
						if (typeof(n.success) != "undefined") {
							n.success(file)
						}
						if ((typeof(n.autoupload) != "undefined" && n.autoupload) || typeof(n.autoupload) == "undefined") {
							t.uploada(n)
						}
					}
				}
			}
		} else {
			var A = function(f) {
					var g = f.myitem;
					var h = f.file.name;
					if (f.myitem) {
						if (t.conf.isyulan == 1 && t.IsImg(h)) {
							var i = new FileReader();
							i.readAsDataURL(f.file);
							i.onload = function(e) {
								var c = "";
								var d = t.GetObjByClass(g, "rel_img");
								o.src = i.result;
								o.onload = function() {
									var a = t.GetNewSmallData({
										img: o,
										file: f.file
									});
									c = a.dataurl;
									if (d) {
										var b = d.getElementsByTagName("img");
										if (b.length > 0) {
											b[0].src = c
										}
									}
								}
							}
						};
						t.files[f.myitem.id].file = file;
						t.files[f.myitem.id].isupload = 1;
						f.myitem.setAttribute("mysize", file.size)
					}
					if (typeof(f.success) != "undefined") {
						f.success(f.file)
					}
					if ((typeof(f.autoupload) != "undefined" && f.autoupload) || typeof(f.autoupload) == "undefined") {
						if (f.myitem) {
							t.uploada(f)
						}
					}
				};
			if (t.IsImg(n.ext) && t.conf.isnewsmall == 1 && n.myitem) {
				var z = new FileReader();
				z.readAsDataURL(n.file);
				z.onload = function(e) {
					o.src = z.result;
					o.onload = function() {
						n["smallbase64"] = t.GetNewSmallBase64({
							img: o,
							file: n.file
						});
						t.files[n.myitem.id].isupload = 1;
						t.files[n.myitem.id]["smallbase64"] = n["smallbase64"];
						A(n)
					}
				}
			} else {
				A(n)
			}
		}
	},
	new_shuiyin_blob: function(e, f, g, h) {
		var t = this;
		var i = document.createElement("canvas"),
			ctx = i.getContext('2d');
		i.width = e.width;
		i.height = e.height;
		ctx.fillStyle = "rgba(0,0,0,0)";
		ctx.fillRect(0, 0, i.width, i.height);
		ctx.drawImage(e, 0, 0, i.width, i.height);
		var j = [];
		if (typeof(g.shuiyin) !== "undefined") {
			if (typeof(g.shuiyin.length) == "undefined") {
				j = [];
				j.push(g.shuiyin)
			} else {
				j = g.shuiyin
			}
		};
		var k = function(a) {
				var b = "";
				if (a.zhiliang > 0 && a.zhiliang < 1 && a.isys != 3) {
					b = i.toDataURL("image/jpeg", a.zhiliang)
				} else {
					b = i.toDataURL("image/png")
				};
				var c = t.convertBase64UrlToBlob(b);
				for (var d in f) {
					if (d != "size") {
						c[d] = f[d]
					}
				};
				h({
					canvas: i,
					file: c,
					base64: b,
					conf: g
				})
			};
		if (typeof(g.yasuo) != "undefined") {
			var l = {};
			if (typeof(conf_yasuo_image) != "undefined") {
				for (var m in conf_yasuo_image) {
					l[m] = conf_yasuo_image[m]
				}
			};
			for (var m in t.opt.yasuo) {
				l[m] = t.opt.yasuo[m]
			};
			console.log(g.name, "yasuo");
			t.new_yasuo(i, e, g.yasuo, function(b) {
				console.log(g.name, "new_yasuo");
				if (j.length == 0) {
					k({
						zhiliang: b.zhiliang,
						isys: b.isys
					})
				} else {
					console.log(g.name, j);
					t.add_shuiyin(i, j, function(a) {
						console.log(g.name, "add_shuiyin");
						k({
							zhiliang: b.zhiliang,
							isys: b.isys
						})
					})
				}
			})
		} else {
			if (j.length == 0) {
				k({
					zhiliang: 1,
					isys: 0
				})
			} else {
				console.log(g.name, j);
				t.add_shuiyin(i, j, function(a) {
					console.log(g.name, "add_shuiyin");
					k({
						zhiliang: 1,
						isys: 0
					})
				})
			}
		}
	},
	new_yasuo: function(c, d, e, f) {
		var t = this;
		var g = c.getContext('2d');
		if (typeof(e) == "undefined" || e == "") {
			f({
				canvas: c,
				conf: e,
				zhiliang: 1,
				isys: 0
			});
			return false
		};
		var h = d.width / d.height;
		var i = "",
			ys_height = "",
			ys_zhiliang = 1,
			ys_family = "微软雅黑",
			ys_quality = 1;
		var j = 0;
		var k = 1024 * 1024 * 2;
		if (typeof(e.type) != "undefined") {
			j = e.type
		}
		if (typeof(e.max_zijie) != "undefined") {
			k = e.max_zijie
		}
		if (typeof(e.zijie) != "undefined") {
			k = e.zijie
		}
		if (typeof(e.quality) != "undefined") {
			ys_quality = e.quality
		}
		if (typeof(e.zhiliang) != "undefined" && e.zhiliang > 1) {
			ys_zhiliang = (e.zhiliang / 100)
		};
		if (typeof(e.width) !== "undefined") {
			i = e.width
		}
		if (typeof(e.height) !== "undefined") {
			ys_height = e.height
		}
		if (typeof(e.zhiliang) !== "undefined") {
			ys_zhiliang = e.zhiliang
		}
		var l = "#000000",
			sy_x = 10,
			sy_y = 10,
			sy_fontsize = 12,
			isys = 0,
			ys_tongyi = 0;
		if (String(j) == "0") {
			j = "width";
			i = d.width
		};
		if (j == "width" || j == "w") {
			isys = 1
		}
		if (j == "height" || j == "h") {
			isys = 2
		}
		if (j == "zijie" || j == "zj") {
			isys = 3
		}
		if (j == "old" || j == "original") {
			isys = 4
		}
		if (j == "height" && typeof(e.value) !== "undefined") {
			ys_height = e.value
		}
		if (j == "width" && typeof(e.value) !== "undefined") {
			i = e.value
		}
		if (typeof(e.tongyi) !== "undefined" && e.tongyi == 1) {
			ys_tongyi = 1
		}
		if (ys_tongyi == 0) {
			if (d.width < i) {
				i = d.width
			}
			if (d.height < ys_height) {
				ys_height = d.height
			}
		};
		if (k > 1024 * 1024 * 2) {
			k = 1024 * 1024 * 2
		};
		ys_height = i / h;
		c.width = i;
		c.height = ys_height;
		g.fillStyle = "rgba(0,0,0,0)";
		g.fillRect(0, 0, c.width, c.height);
		g.drawImage(d, 0, 0, c.width, c.height);
		var x = 0,
			y = 0;
		if (isys == 1) {
			c.width = i;
			c.height = c.width / h;
			g.drawImage(d, 0, 0, c.width, c.height);
			f({
				zhiliang: ys_zhiliang,
				isys: isys,
				canvas: c
			})
		};
		if (isys == 2) {
			c.height = ys_height;
			c.width = ys_height * h;
			g.drawImage(d, 0, 0, c.width, c.height);
			f({
				zhiliang: ys_zhiliang,
				isys: isys,
				canvas: c
			})
		}
		if (isys == 3) {
			g.drawImage(d, 0, 0, c.width, c.height);
			var m = "",
				h1 = 0,
				w2 = c.width,
				h2 = c.height;
			var n = 100;
			var o = function(b) {
					h1 = b / h;
					c.width = b;
					c.height = h1;
					console.log("w1_1", b);
					g.drawImage(d, 0, 0, c.width, c.height);
					c.toBlob(function(a) {
						if (a.size > k) {
							f({
								canvas: c,
								blob: a
							})
						} else {
							b += 70;
							o(b)
						}
					})
				};
			h1 = n / h;
			var m = c.toDataURL("image/jpeg");
			var p = t.convertBase64UrlToBlob(m);
			if (p.size > k) {
				for (var n = 100; n < w;) {
					n = n + 70;
					h1 = n / h;
					c.width = n;
					c.height = h1;
					g.drawImage(d, 0, 0, c.width, c.height);
					m = c.toDataURL("image/jpeg");
					p = t.convertBase64UrlToBlob(m);
					if (p.size > k) {
						c.width = w2;
						c.height = h2;
						break
					} else {}
					w2 = n;
					h2 = h1
				}
			};
			f({
				zhiliang: ys_zhiliang,
				isys: isys,
				canvas: c
			})
		}
		if (isys == 4) {
			c.height = d.height;
			c.width = d.width;
			g.drawImage(d, 0, 0, c.width, c.height);
			f({
				zhiliang: ys_zhiliang,
				isys: isys,
				canvas: c
			})
		};
		if (isys == 0) {
			f({
				zhiliang: ys_zhiliang,
				isys: isys,
				canvas: c
			})
		}
	},
	add_shuiyin: function(a, b, c) {
		var t = this;
		var d = a.getContext('2d');
		var e = 0;
		for (var i = 0; i < b.length; i++) {
			var f = b[i];
			if (f["type"] == "text") {
				var g = null;
				if (typeof(f.id) != "undefined") {
					g = t.getobj({
						id: f.id
					})
				};
				var h = "",
					x1 = 10,
					y1 = 10,
					fontsize1 = 12,
					ys_family1 = "微软雅黑";
				if (g) {
					h = t.get_obj_value({
						id: f.id
					})
				}
				if (typeof(f.fontsize) != "undefined") {
					fontsize1 = f.fontsize
				}
				if (typeof(f.text) != "undefined") {
					h = f.text
				}
				if (typeof(f.color) != "undefined") {
					d.fillStyle = f.color
				}
				if (typeof(f.family) != "undefined") {
					ys_family1 = f.family
				}
				var n = h.length,
					textwidth = 0;
				d.font = fontsize1 + "px " + ys_family1;
				for (var j = 0; j < h.length; j++) {
					if (h[j] != "") {
						if (h[j] == "　" || t.CheckChinese(h[j])) {
							textwidth += fontsize1
						} else {
							textwidth += Math.ceil(fontsize1 / 2)
						}
					}
				};
				f["fontsize"] = fontsize1;
				f["textwidth"] = textwidth;
				f["textheight"] = fontsize1;
				f["text"] = h;
				var k = t.get_shuiyin_xy(a, f, "text");
				if (typeof(f["x"]) != "undefined" && f["y"] != "") {
					k = {
						x: f["x"],
						y: f["y"]
					}
				}
				t.addtextshuiyin(a, d, f, k, function() {
					e++;
					if (b.length == e) {
						c({
							canvas: a,
							shuiyin: b,
							successnum: e
						})
					}
				})
			}
			if (f["type"] == "img") {
				if (typeof(f["img"]) != "undefined") {
					var k = t.get_shuiyin_xy(a, f, "img");
					if (typeof(f["x"]) != "undefined" && f["y"] != "") {
						k = {
							x: f["x"],
							y: f["y"]
						}
					}
					t.addtextshuiyin(a, d, f, k, function() {
						e++;
						if (b.length == e) {
							c({
								canvas: a,
								shuiyin: b,
								successnum: e
							})
						}
					})
				}
			}
		}
	},
	get_shuiyin_xy: function(a, b, c) {
		var t = this;
		var d = 12,
			imgh = 0,
			imgw = 0,
			qzwidth = 20,
			qzheight = 10,
			textwidth = 0,
			textheight = 0,
			sytext1 = "",
			img = null,
			x1 = 0,
			y1 = 0;
		if (typeof(b.fontsize) != "undefined" && b.fontsize != "") {
			d = parseInt(b.fontsize)
		}
		if (c == "text") {
			sytext1 = b.text
		} else {
			img = b.img
		};
		if (typeof(b.x) != "undefined" && b.x != "") {
			if (t.isInt(b.x)) {
				x1 = parseInt(b.x)
			}
		};
		if (typeof(b.y) != "undefined" && b.y != "") {
			if (t.isInt(b.y)) {
				y1 = parseInt(b.y)
			}
		};
		var e = 0;
		if (img) {
			imgh = img.height;
			imgw = img.width;
			qzwidth = 0;
			d = 0;
			qzheight = 0;
			textwidth = 0;
			e = img.width / img.height
		}
		for (var j = 0; j < sytext1.length; j++) {
			if (sytext1[j] != "") {
				if (sytext1[j] == "　" || t.CheckChinese(sytext1[j])) {
					textwidth += d
				} else {
					textwidth += Math.ceil(d / 2)
				}
			}
		};
		if (imgh != 0) {
			textwidth = 0
		};
		if (c == "text") {
			if (typeof(b.width) != "undefined" && b.width != "" && typeof(b.height) != "undefined" && b.height != "") {
				textwidth = parseInt(b.width);
				textheight = parseInt(b.height)
			}
		};
		if (c == "img") {
			if (typeof(b.width) != "undefined" && b.width != "" && typeof(b.height) != "undefined" && b.height != "") {
				textwidth = parseInt(b.width);
				textheight = parseInt(b.height)
			} else if (typeof(b.width) != "undefined") {
				textwidth = b.width;
				textheight = b.width / e
			} else if (typeof(b.height) != "undefined") {
				textheight = b.height;
				textwidth = textheight * e
			}
		};
		if (textheight == 0) {
			textheight = d
		};
		if (typeof(b.align) != "undefined") {
			if (b.align == "left" || b.align == "lefttop") {
				x1 = qzwidth;
				y1 = qzheight;
				if (c == "img") {
					x1 = (d > 0 ? d / 2 : 10);
					y1 = (d > 0 ? d / 2 : 10)
				}
			};
			if (b.align == "right" || b.align == "righttop") {
				x1 = a.width - textwidth - qzwidth;
				y1 = qzheight;
				if (c == "img") {
					x1 = a.width - textwidth - qzwidth - (d > 0 ? d / 2 : 10);
					y1 = (d > 0 ? d / 2 : 10)
				}
			};
			if (b.align == "leftbottom") {
				x1 = qzheight;
				y1 = a.height - qzheight;
				if (c == "img") {
					x1 = (d > 0 ? d / 2 : 10);
					y1 = a.height - textheight - qzheight - (d > 0 ? d / 2 : 10)
				}
			};
			if (b.align == "rightbottom") {
				x1 = a.width - textwidth - qzwidth;
				y1 = a.height - textheight - qzheight - (d > 0 ? d / 2 : 10);
				if (c == "img") {
					x1 = a.width - textwidth - 10
				}
			};
			if (b.align == "center") {
				x1 = (a.width - textwidth - qzwidth) / 2;
				y1 = (a.height - qzheight - textheight) / 2
			};
			if (b.align == "topcenter") {
				x1 = (a.width - textwidth - qzwidth) / 2;
				y1 = (qzheight + 5) + textheight;
				if (c == "img") {
					y1 = (qzheight + 5)
				}
			};
			if (b.align == "bottomcenter") {
				x1 = (a.width - textwidth - qzwidth) / 2;
				y1 = (a.height - qzheight - textheight)
			}
		};
		if (typeof(b.left) != "undefined" && b.left != "") {
			x1 = qzwidth + parseInt(b.left)
		};
		if (typeof(b.top) != "undefined" && b.top != "") {
			y1 = qzheight + parseInt(b.top)
		};
		if (typeof(b.right) != "undefined" && b.right != "") {
			x1 = a.width - textwidth - qzwidth - parseInt(b.right)
		};
		if (typeof(b.bottom) != "undefined" && b.bottom != "") {
			y1 = a.height - textheight - qzheight - parseInt(b.bottom)
		};
		return {
			x: x1,
			y: y1
		}
	},
	addimgshuiyin: function(a, b, c, d, e) {
		var f = [],
			arry = [],
			t = this;
		var g = 0,
			g = d.x,
			starty = d.y,
			marginright = 10,
			marginbottom = 10,
			textwidth = 0,
			qzwidth = 20,
			qzheight = 10,
			ctx1 = a.getContext('2d'),
			text = c.text,
			fontsize1 = 12,
			h = 0,
			w = 0;
		var w = c["img"].width,
			h = c["img"].height;
		if (typeof(c["marginright"]) != "undefined") {
			marginright = parseInt(c["marginright"])
		};
		if (typeof(c["marginbottom"]) != "undefined") {
			marginbottom = parseInt(c["marginbottom"])
		};
		var k = document.createElement("img");
		k.src = c["img"].src;
		var l = k.width / k.height;
		if (typeof(c["height"]) != "undefined" && c["height"] != "" && typeof(c["width"]) != "undefined" && c["width"] != "") {
			w = parseInt(c["width"]);
			h = parseInt(c["height"])
		} else if (typeof(c["height"]) != "undefined" && c["height"] != "") {
			h = parseInt(c["height"]);
			w = h * l
		} else if (typeof(c["width"]) != "undefined" && c["width"] != "") {
			w = parseInt(c["width"]);
			h = w / l
		};
		if (typeof(c["pingpu"]) == "undefined" || c["pingpu"] != 1) {
			b.drawImage(k, d.x, d.y, w, h);
			if (typeof(e) != "undefined") {
				e()
			};
			return false
		};
		while (g < a.width) {
			f.push(g);
			g += w + marginright
		};
		while (starty < a.height) {
			arry.push(starty);
			starty += h + marginbottom
		};
		for (var i = 0; i < f.length; i++) {
			for (var j = 0; j < arry.length; j++) {
				b.drawImage(k, f[i], arry[j], w, h)
			}
		};
		if (typeof(e) != "undefined") {
			e()
		}
	},
	addtextshuiyin: function(b, c, d, e, f) {
		var g = [],
			arry = [],
			t = this;
		console.log("xy", e);
		var k = 0,
			k = e.x,
			starty = e.y,
			marginright = 10,
			marginbottom = 10,
			textwidth = 0,
			qzwidth = 20,
			qzheight = 10,
			ctx1 = b.getContext('2d'),
			text = d.text,
			fontsize1 = 12,
			h = 0,
			w = 0;
		var w = d["textwidth"],
			h = d["textheight"];
		if (typeof(d["height"]) != "undefined") {
			h = d["height"]
		}
		if (typeof(d["width"]) != "undefined") {
			w = d["width"]
		};
		if (typeof(d["marginright"]) != "undefined") {
			marginright = parseInt(d["marginright"])
		};
		if (typeof(d["marginbottom"]) != "undefined") {
			marginbottom = parseInt(d["marginbottom"])
		};
		var l = 0;
		if ((d["type"]) == "img") {
			l = d["img"].width / d["img"].height;
			if (typeof(d["height"]) != "undefined" && d["height"] != "" && typeof(d["width"]) != "undefined" && d["width"] != "") {
				w = parseInt(d["width"]);
				h = parseInt(d["height"])
			} else if (typeof(d["height"]) != "undefined" && d["height"] != "") {
				h = parseInt(d["height"]);
				w = h * l
			} else if (typeof(d["width"]) != "undefined" && d["width"] != "") {
				w = parseInt(d["width"]);
				h = w / l
			};
			d["width"] = w;
			d["height"] = h
		};
		if (typeof(d["pingpu"]) == "undefined" || d["pingpu"] != 1) {
			var m = 100;
			var n = 100;
			if (typeof(d["height"]) != "undefined" && typeof(d["width"]) != "undefined") {
				var o = t.getshuiyinimage(d);
				var p = new Image();
				p.src = o;
				p.onload = function() {
					c.drawImage(p, e.x, e.y, w, h);
					var a = b.toDataURL("image/png");
					if (typeof(f) != "undefined") {
						f()
					}
				}
			} else {
				c.fillText(text, e.x, e.y);
				if (typeof(f) != "undefined") {
					f()
				}
			};
			return false
		};
		while (k < (b.width + 20)) {
			g.push(k);
			k += w + marginright
		};
		console.log("arrx", g);
		while (starty < (b.height + 20)) {
			arry.push(starty);
			starty += h + marginbottom
		};
		var q = 0;
		if (typeof(d["height"]) != "undefined" && typeof(d["width"]) != "undefined") {
			q = 1
		};
		var o = t.getshuiyinimage(d);
		var p = new Image();
		p.src = o;
		p.onload = function() {
			for (var i = 0; i < g.length; i++) {
				for (var j = 0; j < arry.length; j++) {
					if (q == 0) {
						c.fillText(text, g[i], arry[j])
					} else {
						c.drawImage(p, g[i], arry[j], w, h)
					}
				}
			};
			if (typeof(f) != "undefined") {
				f()
			}
		}
	},
	getshuiyinimage: function(a) {
		var t = this;
		var b = document.createElement("canvas");
		var c = b.getContext('2d');
		var d = {
			x: 0,
			y: 0
		};
		var e = 100;
		var f = 100;
		if (typeof(a.height) != "undefined" && a.height != "") {
			e = parseInt(a.height)
		};
		if (typeof(a.width) != "undefined" && a.width != "") {
			f = parseInt(a.width)
		};
		b.width = f;
		b.height = e;
		c.fillStyle = "rgba(0,0,0,0)";
		c.fillRect(0, 0, b.width, b.height);
		if (typeof(a["opacity"]) != "undefined" && a["opacity"] != "") {
			c.globalAlpha = parseFloat(a["opacity"])
		};
		var g = 15,
			fontfamily = "微软雅黑",
			color = "#ffffff",
			dushu = 0,
			text = "";
		if (typeof(a.fontsize) != "undefined") {
			g = parseInt(a.fontsize)
		};
		if (typeof(a.fontfamily) != "undefined") {
			fontfamily = parseInt(a.fontfamily)
		};
		if (typeof(a.color) != "undefined" && a.color != "") {
			color = (a.color)
		};
		if (typeof(a.dushu) != "undefined" && a.dushu != "") {
			dushu = parseInt(a.dushu)
		};
		if (typeof(a.text) != "undefined") {
			text = (a.text)
		};
		if (a.type == "text") {
			c.fillStyle = color;
			c.font = g + "px " + fontfamily;
			var w = c.measureText(text).width;
			c.beginPath();
			c.fillStyle = color;
			c.font = g + "px " + fontfamily;
			c.translate(f / 2, e / 2);
			c.rotate(dushu * Math.PI / 180);
			d.x = (f - w) / 2;
			d.y = (e - g) / 2;
			var x = -(w / 2),
				y = (g / 2);
			c.fillText(text, x, y);
			c.closePath();
			c.save()
		};
		if (a.type == "img") {
			if (dushu > 0) {
				c.translate(f / 2, e / 2);
				c.rotate(dushu * Math.PI / 180);
				c.drawImage(a["img"], -(f / 2), -(e / 2), f, e)
			} else {
				c.drawImage(a["img"], 0, 0, f, e)
			}
		};
		var h = b.toDataURL("image/png");
		return h
	},
	isInt: function(a) {
		var b = /^[0-9]+.?[0-9]*$/;
		if (!b.test(a)) {
			return false
		};
		return true
	},
	isIos: function() {
		var a = navigator.userAgent;
		var b = a.toLowerCase();
		if (b.indexOf("mac os") > -1) {
			return true
		};
		if (/(iPhone|iPad|iPod|iOS)/i.test(a)) {
			return true
		};
		return false
	},
	GetNewSmallBase64: function(a) {
		var t = this;
		var b = t.GetNewSmallData(a);
		return b.base64
	},
	GetNewSmallData: function(a) {
		var w = a.img.width,
			h = a.img.height,
			bilv = w / h,
			i = "";
		var b = document.createElement("canvas");
		var t = this;
		var c = 150;
		var d = {
			backgroundcolor: "#000"
		};
		if (typeof(g_conf.newsmall) != "undefined" && typeof(g_conf.newsmall) != "undefined") {
			for (var k in g_conf.newsmall) {
				d[k] = g_conf.newsmall[k]
			}
		};
		if (typeof(t.opt.newsmall) != "undefined") {
			for (var k in t.opt.newsmall) {
				d[k] = t.opt.newsmall[k]
			}
		};
		if (typeof(t.opt.yasuo_newsmall) != "undefined") {
			for (var k in t.opt.yasuo_newsmall) {
				d[k] = t.opt.yasuo_newsmall[k]
			}
		};
		height = 200;
		c = bilv * height;
		if (d != null && typeof(d) != "undefined") {
			if (typeof(d.width) != "undefined" && typeof(d.height) != "undefined") {
				c = d.width;
				height = d.height
			} else if (typeof(d.width) != "undefined") {
				c = d.width;
				height = c / bilv
			} else if (typeof(d.height) != "undefined") {
				height = d.height;
				c = bilv * height
			}
		};
		var x = 0,
			y = 0,
			img = a.img,
			w1 = c,
			h1 = height;
		b.width = c;
		b.height = height;
		var e = b.getContext('2d');
		if (d.backgroundcolor != "transparent") {
			e.fillStyle = d.backgroundcolor;
			e.fillRect(0, 0, c, height)
		};
		var f = c;
		var g = height;
		if (typeof(d.type) == "undefined" || d.type == "") {
			f = c;
			g = c / bilv;
			if (g < height) {
				g = height;
				f = bilv * g
			}
		} else if (d.type == "center") {
			f = c;
			g = c / bilv;
			if (g < height) {
				y = (height - g) / 2
			} else {
				g = height;
				f = bilv * g;
				x = (c - f) / 2
			}
		}
		e.drawImage(img, x, y, f, g);
		contenttype = "image/png";
		if (d.backgroundcolor != "transparent") {
			contenttype = "image/jpeg"
		};
		var i = b.toDataURL(contenttype);
		var j = i.split("base64,");
		var l = j[1];
		return {
			contenttype: contenttype,
			dataurl: i,
			base64: i,
			data: l
		}
	},
	getImgData: function(a) {
		var t = this;
		var b = document.createElement("canvas"),
			ctx1 = b.getContext('2d');
		var c = a.orient;
		var d = a.img;
		var e = 0,
			drawWidth, drawHeight, width, height;
		if (typeof(a.width) == "undefined") {
			drawWidth = a.img.width;
			drawHeight = a.img.height
		};
		b.height = height = drawHeight;
		b.width = width = drawWidth;
		switch (c) {
		case 3:
			e = 180;
			drawWidth = -width;
			drawHeight = -height;
			break;
		case 6:
			b.width = height;
			b.height = width;
			e = 90;
			drawWidth = width;
			drawHeight = -height;
			break;
		case 8:
			b.width = height;
			b.height = width;
			e = 270;
			drawWidth = -width;
			drawHeight = height;
			break
		};
		ctx1.rotate(e * Math.PI / 180);
		ctx1.drawImage(d, 0, 0, drawWidth, drawHeight);
		var f = b.toDataURL(a.file.type);
		return {
			base64: f,
			file: t.convertBase64UrlToBlob(f, a.file.name)
		}
	},
	CheckChinese: function(a) {
		var b = new RegExp("[\一-\鿿]+", "g");
		if (!b.test(a)) {
			return false
		} else {
			return true
		}
	},
	convertBase64UrlToBlob: function(a, b) {
		var c = a.split('base64,');
		var d = window.atob(c[1]);
		var e = c[0].match(/:(.*?);/);
		var g = e[1];
		var h = new ArrayBuffer(d.length);
		var j = new Uint8Array(h);
		for (var i = 0; i < d.length; i++) {
			j[i] = d.charCodeAt(i)
		};
		var f = new Blob([h], {
			type: g
		});
		if (typeof(b) != "") {
			f.name = b
		};
		return f
	},
	Base64ToBlob: function(a, b) {
		return this.convertBase64UrlToBlob(a, b)
	},
	SaveFileBytes: function(n) {
		var t = this,
			file = n.file,
			reader = new FileReader(),
			stop_old = 0;
		var o = 0,
			stop = 0,
			myitem = n.myitem,
			ext = "";
		var p = file.name;
		var q = file.type,
			limit = 1;
		var r = file.name,
			itemid = myitem.id;
		var s = file.name.split(".");
		var v = t.conf.fdsize;
		if (typeof(n.ext) == "undefined") {
			if (s.length > 1) {
				ext = s[s.length - 1].toLowerCase()
			}
		} else {
			ext = n.ext
		};
		if (typeof(t.posts[myitem.id]) == "undefined") {
			t.posts[myitem.id] = {}
		};
		if (t.conf.isnewsmall != 0) {
			t.posts[myitem.id]["isnewsmall"] = t.conf.isnewsmall
		};
		if (t.conf.isnewsmall == 1 && typeof(n.smallbase64) != "undefined") {
			t.posts[myitem.id]["smallbase64"] = n.smallbase64
		} else {
			t.posts[myitem.id]["smallbase64"] = ""
		};
		if (typeof(hc_cookie) != "undefined" && typeof(t.opt.isduandianxuchuan) != "undefined" && t.opt.isduandianxuchuan == 1) {
			t.posts[myitem.id]["isduandianxuchuan"] = t.opt.isduandianxuchuan
		};
		if (typeof(file.isnewsmall) != "undefined") {
			t.posts[myitem.id]["isnewsmall"] = file.isnewsmall
		};
		var w = {};
		var x = {};
		if (typeof(t.post) != "undefined") {
			for (var y in t.post) {
				w[y] = t.post[y]
			}
		};
		if (typeof(t.posts[myitem.id]) != "undefined") {
			for (var y in t.posts[myitem.id]) {
				w[y] = t.posts[myitem.id][y]
			}
		};
		if (typeof(t.posts_other[myitem.id]) != "undefined") {
			for (var y in t.posts_other[myitem.id]) {
				x[y] = t.posts_other[myitem.id][y]
			}
		};
		var z = t.opt.url;
		var A = n.myitem.getAttribute("iscx");
		var B = "";
		var C = "";
		var D = t.GetObjByClass(myitem, "rel_img");
		var E = myitem.getElementsByTagName("img");
		if (E.length < 1 && D) {
			D.innerHTML = "<img src='" + t.GetExtSrc(g_exts, n.ext) + "'  style='height:100%'/>"
		};
		myitem.setAttribute("myuploadsize", "0");
		myitem.setAttribute("mystatus", "upload");
		myitem.setAttribute("mysize", file.size);
		var F = (file.name);
		if (typeof(md5) != "undefined") {
			F = md5(F + String(file.size))
		} else {
			F = F.replace(/-/g, "");
			F = F.replace(/=/g, "");
			F = F.replace(/,/g, "");
			F = F.replace(/./g, "");
			F = F.replace(/:/g, "");
			F = F.replace(/;/g, "");
			F = F.replace(/；/g, "");
			F = F.replace(/，/g, "");
			F = F + String(file.size)
		};
		var G = "";
		var H = -1;
		var I = 1;
		if (typeof(hc_cookie) != "undefined" && typeof(t.opt.isduandianxuchuan) != "undefined" && t.opt.isduandianxuchuan == 1) {
			G = tmpid;
			var u = decodeURI(hc_cookie.Get(F));
			if (u != "") {
				var s = String(u).split("||");
				if (s.length > 1) {
					G = s[0];
					H = parseInt(s[1])
				} else {
					H = parseInt(u)
				}
			}
		};
		if (H > -1) {
			I = H
		}
		var J = function(a) {
				var b = a.index;
				var c = a.result;
				if (typeof(t.upload_success_log) != "undefined") {
					t.upload_success_log({
						i: b,
						result: c
					})
				};
				if (a.isoss == 1) {
					t.UploadProgress({
						myitem: myitem,
						shardIndex: (b + 1),
						success_size: file.size,
						file_size: file.size,
						file: file
					});
					if (typeof(myitem.getAttribute("oss-result")) != "undefined") {
						c = myitem.getAttribute("oss-result")
					};
					console.log("result:" + c);
					file.shardIndex = (b + 1);
					if ((b + 1) == a.shardCount) {
						cur_size = file.size;
						var d = eval("(" + c + ")");
						d["iscx"] = 0;
						d["mystatus"] = "success";
						d["myuploadsize"] = cur_size;
						console.log("attr", d);
						t.SetItem({
							myitem: myitem,
							attr: d
						});
						t.update({
							t: t,
							myitem: myitem
						});
						t.UploadProgress({
							myitem: myitem,
							shardIndex: (i),
							ext: ext,
							result: c,
							success_size: file.size,
							file_size: file.size,
							file: file
						});
						t.UploadSuccess({
							myitem: myitem,
							ext: ext,
							result: c,
							size: file.size,
							keyname: F,
							file: file
						});
						if (typeof(myitem.id) != "undefined") {
							t.removeFile(myitem.id)
						}
					};
					return false
				} else {
					var e = eval("(" + c + ")");
					if (typeof(e.upload_id) != "undefined" && e.upload_id != "") {
						B = e.upload_id
					};
					if (typeof(e.upload_path) != "undefined" && e.upload_path != "") {
						C = e.upload_path
					};
					if (typeof(e.status) != "undefined") {
						if (e.status == "dengdai") {
							var f = b;
							if (typeof(e.index) != "undefined" && (e.index == e.total || e.index == e.num)) {
								if (typeof(hc_cookie) != "undefined") {
									hc_cookie.Del(F)
								}
								f = 0;
								cur_size = 0;
								t.UploadProgress({
									myitem: myitem,
									success_size: 0,
									file_size: file.size,
									file: file
								})
							} else {
								if (typeof(hc_cookie) != "undefined" && index > H) {
									hc_cookie.Add((F), t.my_encodeURI(G + "||" + index))
								};
								f = b
							};
							b = f;
							file.shardIndex = (b + 1);
							t.UploadProgress({
								myitem: myitem,
								shard_index: (b + 1),
								success_size: e.success_size,
								file_size: file.size,
								file: file
							})
						} else if (e.status == "success") {
							cur_size = file.size;
							file.shardIndex = (b + 1);
							t.SetItem({
								myitem: myitem,
								attr: {
									iscx: 0,
									mystatus: "success",
									"myuploadsize": file.size
								}
							});
							t.update({
								t: t,
								myitem: myitem
							});
							t.UploadProgress({
								myitem: myitem,
								ext: ext,
								result: c,
								success_size: file.size,
								file_size: file.size,
								file: file
							});
							t.UploadSuccess({
								myitem: myitem,
								ext: ext,
								result: c,
								size: file.size,
								keyname: F,
								file: file
							});
							if (typeof(myitem.id) != "undefined") {
								t.removeFile(myitem.id)
							}
							if (typeof(hc_cookie) != "undefined") {
								cookie.Del(F)
							}
						} else if (e.status == "error") {
							if (typeof(myitem.id) != "undefined") {
								t.removeFile(myitem.id)
							};
							t.NewFileBar({
								myitem: myitem,
								success_size: 100,
								file_size: 100
							});
							var g = t.GetObjByClass(myitem, "rel_bt");
							if (g) {
								g.style.display = "";
								g.setAttribute("isalert", 0);
								g.click()
							};
							var h = t.GetObjByClass(myitem, "rel_see");
							if (h) {
								h.style.display = "none"
							}
							t.error_tishi(myitem);
							if (typeof(t.error_huidiao) != "undefined") {
								t.error_huidiao({
									myitem: myitem,
									item1: myitem,
									msg: j,
									result: c
								})
							};
							t.ShowYuanSu({
								myitem: myitem,
								conf: t.error_show
							});
							t.myalert(c.msg)
						} else {
							if (typeof(myitem.id) != "undefined") {
								t.removeFile(myitem.id)
							}
							if (typeof(hc_cookie) != "undefined") {
								cookie.Del(F)
							}
							t.error_tishi(myitem);
							var j = "后端出错";
							t.SetItem({
								myitem: myitem,
								attr: {
									mystatus: "error"
								}
							});
							var k = t.GetObjByClass(myitem, "rel_baifenbi");
							if (k) {
								k.innerHTML = "<span class='hc_error'>上传失败</span>"
							};
							t.ShowYuanSu({
								myitem: myitem,
								conf: t.error_show
							});
							if (typeof(t.error_huidiao) != "undefined") {
								t.error_huidiao({
									myitem: myitem,
									item1: myitem,
									msg: j,
									result: c
								})
							};
							if (typeof(t.error) != "undefined") {
								t.error({
									myitem: myitem,
									item1: myitem,
									msg: j,
									result: c
								})
							}
						};
						var l = t.getstatuscount("dengdai");
						var m = t.getstatuscount("upload");
						if (l + m == 0) {
							t.curgroupindex++
						}
					}
					if (typeof(t.upload_progress) != "undefined") {
						t.upload_progress({
							index: b + 1,
							total: shardCount,
							myitem: myitem,
							success_size: e.success_size,
							file_size: file.size,
							file: file
						})
					}
				}
			};
		var K = 0;
		if (typeof(t.opt.isoss) != "undefined") {
			K = t.opt.isoss
		}
		var I = 1;
		if (typeof(file.shardIndex) != "undefined" && typeof(file.shardSize) != "undefined" && t.conf.fdsize != 0) {
			myindex = parseInt(file.shardIndex) - 1;
			itemid = tmpid = file.itemid;
			v = parseInt(file.shardSize)
		};
		t.uploadfile({
			myitem: myitem,
			shardIndex: I,
			shardSize: v,
			isoss: K,
			file: file,
			post: w,
			post_other: x,
			upload_start: function(a) {
				a.maxnum = t.conf.maxnum;
				if (typeof(t.upload_start) != "undefined") {
					return t.upload_start(a)
				}
			},
			upload_before: function(a) {
				a.maxnum = t.conf.maxnum;
				if (typeof(t.upload_before) != "undefined") {
					t.upload_before(a)
				}
			},
			upload_success: function(a) {
				a.maxnum = t.conf.maxnum;
				J(a);
				if (typeof(t.upload_success_log) != "undefined") {
					t.upload_success_log(a)
				};
				if (typeof(t.upload_success) != "undefined") {
					t.upload_success(a)
				}
			},
			upload_error: function(a) {
				a.maxnum = t.conf.maxnum;
				if (typeof(myitem.id) != "undefined") {
					t.removeFile(myitem.id)
				}
				if (typeof(hc_cookie) != "undefined") {
					cookie.Del(F)
				}
				t.error_tishi(a.myitem);
				a.msg = "网络不好";
				t.SetItem({
					myitem: myitem,
					attr: {
						mystatus: "error"
					}
				});
				if (typeof(t.upload_error_log) != "undefined") {
					t.upload_error_log(a)
				};
				t.ShowYuanSu({
					myitem: myitem,
					conf: t.error_show
				});
				var b = t.GetObjByClass(myitem, "rel_baifenbi");
				if (typeof(t.error_huidiao) != "undefined") {
					t.error_huidiao(a)
				};
				if (typeof(t.error) != "undefined") {
					t.error(a)
				};
				if (typeof(t.upload_error) != "undefined") {
					t.upload_error(a)
				}
			},
			upload_beforeSend: function(a) {
				if (typeof(t.upload_beforeSend) != "undefined") {
					t.upload_beforeSend(a)
				}
			},
			upload_progress: function(a) {
				var e = a.e,
					myitem = n.myitem;
				if (t.conf.fdsize == 0 || a.isoss == 1) {
					var b = e.total;
					var c = e.loaded;
					var d = Math.round(e.loaded / e.total * 100);
					t.UploadProgress({
						myitem: myitem,
						success_size: c,
						file_size: b,
						file: file
					});
					if (typeof(t.upload_progress) != "undefined") {
						t.upload_progress({
							myitem: myitem,
							success_size: c,
							file_size: b,
							file: file
						})
					}
				} else {
					t.UploadProgress({
						myitem: myitem,
						success_size: a.cur_size,
						file_size: a.file_size,
						file: file
					});
					if (typeof(t.upload_progress) != "undefined") {
						t.upload_progress(a)
					}
				}
			},
			upload_complete: function(a) {
				a.maxnum = t.conf.maxnum;
				if (typeof(t.upload_complete) != "undefined") {
					t.upload_complete(a)
				}
				if (typeof(t.upload_complete_log) != "undefined") {
					t.upload_complete_log(a)
				}
			}
		})
	},
	uploadfile: function(n) {
		var t = this,
			file = n.file,
			reader = new FileReader(),
			stop_old = 0;
		var o = 0,
			stop = 0,
			cur_size = 0,
			myitem = n.myitem,
			ext = "";
		var p = file.type;
		var q = t.opt.url;
		var r = file.name;
		var s = file.type,
			cur_size = 0,
			limit = 1;
		var u = file.name;
		var v = file.size;
		var w = myitem.id;
		var x = w,
			shardSize = t.conf.fdsize;
		var y = 0;
		var z = file.name.split(".");
		if (typeof(n.ext) == "undefined") {
			if (z.length > 1) {
				ext = z[z.length - 1].toLowerCase()
			}
		} else {
			ext = n.ext
		};
		var A = 0;
		if (typeof(n.isoss) != "undefined" && n.isoss == 1) {
			A = 1
		} else {
			if (q.indexOf("?") == -1) {
				q += "?tmpid=" + x
			} else {
				q += "&tmpid=" + x
			}
		};
		var B = {};
		if (typeof(n.post) != "undefined") {
			for (var C in n.post) {
				B[C] = n.post[C]
			}
		};
		B["title"] = t.my_encodeURI(file.name);
		B["filetype"] = (file.type);
		B["size"] = file.size;
		B["ext"] = ext;
		if (typeof(file.lastModified) != "undefined") {
			B["lastModified"] = file.lastModified;
			B["lastModifiedDate"] = t.date_format(file.lastModified, "yyyy-MM-dd hh:mm:ss")
		};
		var D = 0;
		if (typeof(n.shardIndex) != "undefined" && n.shardIndex != "") {
			D = parseInt(n.shardIndex) - 1
		};
		if (typeof(n.shardSize) != "undefined" && (n.shardSize) != "") {
			shardSize = parseInt(shardSize)
		};
		if (typeof(n.shardSize) != "undefined") {
			shardSize = n.shardSize
		};
		y = Math.ceil(v / shardSize);
		file.shardCount = y;
		if (t.conf.fdsize == 0 || A == 1) {
			shardSize = file.size;
			y = 1;
			D = 0;
			file.shardCount = y
		};
		file.shardCount = y;
		var E = myitem.getAttribute("iscx");
		var F = "";
		var G = "";
		var H = t.GetObjByClass(myitem, "rel_img");
		var I = myitem.getElementsByTagName("img");
		var J = {
			myitem: myitem,
			file: file
		};
		if (typeof(n.post) != "undefined") {
			J["post"] = n.post
		};
		if (typeof(n.post_other) != "undefined") {
			J["post_other"] = n.post_other
		};
		if (typeof(n.upload_start) != "undefined") {
			var K = n.upload_start(J);
			if (typeof(K) != "undefined" && K == false) {
				return false
			}
		};
		myitem.setAttribute("mystatus", "upload");
		myitem.setAttribute("mysize", file.size);
		if (myitem.getAttribute("mystarttime") == null || typeof(myitem.getAttribute("mystarttime")) == "undefined") {
			myitem.setAttribute("mystarttime", Date.parse(new Date()))
		};
		var L = function(f) {
				if (f.i >= y) {
					return
				};
				if (!myitem) {
					return false
				};
				var g = f.i * shardSize,
					end = Math.min(v, g + shardSize);
				var h = f.i + 1;
				var i = q.split("."),
					urlfilehz = "",
					myform = new FormData(),
					contentType = false,
					processData = false,
					blob;
				var j = t.getshardfile(f.i, file, y, shardSize);
				blob = j.file;
				blob.name = file.name;
				if (String(A) == "0") {
					B["tmpid"] = w;
					B["total"] = y;
					B["index"] = h;
					B["file"] = blob;
					if (typeof(n.post_other) != "undefined") {
						for (var k in n.post_other) {
							if (k.indexOf("base64") != -1) {
								if (f.i == 0) {
									B[k] = n.post_other[k]
								} else {
									B[k] = ""
								}
							} else if (typeof(n.post_other[k]) == "object" && typeof(n.post_other[k].size) != "undefined") {
								var l = n.post_other[k];
								var m = Math.round(l.size / y);
								var j = t.getshardfile(f.i, l, y, m);
								j.file.name = l.name;
								B[k] = j.file
							}
						}
					};
					for (var k in B) {
						t.posts[myitem.id][k] = B[k]
					}
				} else {
					B["file"] = blob
				}
				cur_size = (f.i + 1) * shardSize;
				if (cur_size > file.size) {
					cur_size = file.size
				};
				if (typeof(t.upload_before) != "undefined") {
					t.upload_before({
						myitem: myitem,
						file: file,
						shardIndex: f.i + 1,
						shardCount: y,
						success_size: cur_size,
						cur_size: cur_size,
						file_size: file.size
					})
				};
				for (var k in t.posts[myitem.id]) {
					if (k == "smallbase64" && h > 1) {} else {
						if (typeof(t.posts[myitem.id][k]) == "object" && typeof(t.posts[myitem.id][k].size) != "undefined") {
							myform.append(k, t.posts[myitem.id][k], t.posts[myitem.id][k].name)
						} else {
							myform.append(k, t.posts[myitem.id][k])
						}
					}
				};
				t.ajax({
					url: q,
					type: "POST",
					data: myform,
					async: true,
					dataType: "html",
					processData: processData,
					contentType: contentType,
					success: function(a) {
						var b = {
							myitem: myitem,
							result: a,
							success_size: cur_size,
							file_size: file.size,
							isoss: A
						};
						b.index = f.i;
						b.shardCount = y;
						b.isoss = A;
						if (typeof(n.upload_progress) != "undefined") {}
						if (b.index < (y - 1)) {
							L({
								i: b.index + 1
							})
						};
						if (a.indexOf("success") != -1) {
							if (typeof(n.upload_success) != "undefined") {
								b.num = t.getchilds().length;
								n.upload_success(b)
							}
						} else if (A == 1 || t.opt.fdsize == 0) {
							if (typeof(n.upload_success) != "undefined") {
								b.num = t.getchilds().length;
								n.upload_success(b)
							}
						}
					},
					error: function(a, b, c, d) {
						if (typeof(n.upload_error) != "undefined") {
							var e = {
								myitem: myitem,
								xhr: a,
								status: b,
								responseText: c,
								urlurl: d,
								isoss: A
							};
							e.index = f.i;
							e.shardCount = y;
							n.upload_error(e)
						}
					},
					beforeSend: function(a) {
						if (typeof(n.upload_beforeSend) != "undefined") {
							var b = {
								myitem: myitem,
								xhr: a
							};
							n.upload_beforeSend(b)
						}
					},
					progress: function(e) {
						if (typeof(n.upload_progress) != "undefined") {
							var a = {
								myitem: myitem,
								e: e,
								success_size: cur_size,
								cur_size: cur_size,
								file_size: file.size,
								isoss: A
							};
							a.index = f.i;
							a.shardCount = y;
							n.upload_progress(a)
						}
					},
					complete: function(a, b, c) {
						if (typeof(n.upload_complete) != "undefined") {
							var d = {
								myitem: myitem,
								xhr: a,
								status: b,
								responseText: c,
								isoss: A
							};
							d.index = f.i;
							d.shardCount = y;
							n.upload_complete(d)
						}
					}
				})
			};
		cur_size = parseInt(D + 1) * shardSize;
		if (D == 0 && y == 1) {
			cur_size = file.size
		};
		if (cur_size > file.size) {
			cur_size = file.size
		};
		myitem.setAttribute("success_size_init", cur_size);
		t.ShowYuanSu({
			myitem: myitem,
			conf: t.upload_show
		});
		myitem.setAttribute("mystatus", "upload");
		if (t.conf.fdsize == 0) {
			L({
				i: D
			})
		} else {
			L({
				i: D
			})
		}
	},
	SetItem: function(a) {
		var b = a.myitem;
		if (typeof(a.attr) != "undefined") {
			for (var c in a.attr) {
				b.setAttribute(c, a.attr[c])
			}
		}
	},
	getshardfile: function(a, b, c, d) {
		var e = a * d,
			end = Math.min(b.size, e + d);
		var f;
		if (b.webkitSlice) {
			f = b.webkitSlice(e, end)
		} else if (b.mozSlice) {
			f = b.mozSlice(e, end)
		} else if (b.slice) {
			f = b.slice(e, end)
		} else {
			alert('不支持分段读取！');
			return false
		};
		for (var g in b) {
			if (g != "size") {
				f[g] = b[g]
			}
		};
		return {
			end: end,
			start: e,
			index: a,
			"file": f
		}
	},
	savefile: function(l) {
		var t = this,
			file = l.file,
			reader = new FileReader(),
			stop_old = 0;
		var m = 0,
			stop = 0,
			cur_size = 0,
			ext = "";
		var n = t.newrand(8);
		var o = l.url;
		var p = file.name;
		var q = file.type,
			cur_size = 0,
			limit = 1;
		var r = file.name;
		var s = file.size;
		var u = t.conf.fdsize;
		var v = 0;
		if (t.conf.fdsize == 0) {
			v = 1;
			u = file.size
		};
		var w = file.name.split(".");
		if (typeof(l.ext) == "undefined") {
			if (w.length > 1) {
				ext = w[w.length - 1].toLowerCase()
			}

		} else {
			ext = l.ext
		};
		var v = Math.ceil(s / u);
		var x = "";
		var y = "";
		var z = (file.name + s);
		if (typeof(md5) != "undefined") {
			z = md5(z)
		} else {
			z = z.replace(/-/g, "");
			z = z.replace(/=/g, "");
			z = z.replace(/,/g, "");
			z = z.replace(/./g, "");
			z = z.replace(/:/g, "");
			z = z.replace(/;/g, "");
			z = z.replace(/；/g, "");
			z = z.replace(/，/g, "");
			z = z + s
		};
		var A = "";
		var B = -1;
		var C = function(d) {
				if (d.i >= v) {
					return
				}
				var f = d.i * u,
					end = Math.min(s, f + u);
				var g = d.i + 1;
				var h = "",
					form = new FormData(),
					contentType = false,
					processData = false,
					blob;
				if (file.webkitSlice) {
					blob = file.webkitSlice(f, end)
				} else if (file.mozSlice) {
					blob = file.mozSlice(f, end)
				} else if (file.slice) {
					blob = file.slice(f, end)
				} else {
					alert('不支持分段读取！');
					return false
				};
				filetype = file.type;
				if (filetype == "") {
					for (var j in g_exts) {
						if (g_exts[j].ext == ext) {
							filetype = g_exts[j].contenttype
						}
					}
				}
				var k = {};
				if (typeof(file.lastModified) != "undefined") {
					t.post["lastModified"] = file.lastModified
				}
				if (typeof(file.lastModifiedDate) != "undefined") {
					t.post["lastModified"] = file.lastModifiedDate
				};
				k["title"] = t.my_encodeURI(file.name);
				k["filetype"] = (file.type);
				k["size"] = file.size;
				k["ext"] = ext;
				k["tmpid"] = n;
				k["total"] = v;
				k["index"] = g;
				if (x != "") {
					k["upload_id"] = x
				}
				if (y != "") {
					k["upload_path"] = y
				}
				if (typeof(l.post) != "undefined") {
					for (var j in l.post) {
						k[j] = l.post[j]
					}
				};
				if (typeof(k) != "undefined") {
					for (var j in k) {
						form.append(j, k[j])
					}
				}
				form.append("file", blob, file.name);
				cur_size = (d.i + 1) * u;
				if (cur_size > file.size) {
					cur_size = file.size
				}
				t.ajax({
					url: l.url,
					type: "POST",
					data: form,
					async: true,
					dataType: "html",
					processData: processData,
					contentType: contentType,
					success: function(a) {
						var i = d.i + 1;
						if (i > v) {
							return false
						}
						var b = eval("(" + a + ")");
						if (typeof(b.upload_id) != "undefined" && b.upload_id != "") {
							x = b.upload_id
						};
						if (typeof(b.upload_path) != "undefined" && b.upload_path != "") {
							y = b.upload_path
						};
						if (typeof(b.status) != "undefined") {
							if (b.status == "dengdai") {
								if (typeof(b.index) != "undefined" && (b.index == b.total || b.index == b.num)) {
									C({
										i: 0
									})
								} else {
									C({
										i: i
									})
								}
							} else if (b.status == "success") {
								if (typeof(l.success) != "undefined") {
									l.success({
										result: a
									})
								}
							} else if (b.status == "error") {
								t.myalert(b.msg)
							} else {
								var c = "后端出错";
								t.myalert(c)
							}
						} else {
							var c = "后端出错";
							t.myalert(c)
						}
					},
					error: function() {},
					beforeSend: function(a) {},
					progress: function(e) {}
				})
			};
		C({
			i: 0
		})
	},
	myalert: function(a, b) {
		var t = this;
		var c = t.conf.alert_time,
			timehm = t.conf.alert_time;
		var d = "hcalert",
			closebtn = 1;
		if (typeof(b) != "undefined" && typeof(b.classname) != "undefined") {
			d = b.classname
		};
		if (typeof(b) != "undefined" && typeof(b.time) != "undefined") {
			c = b.time
		};
		if (typeof(b) != "undefined" && typeof(b.closebtn) != "undefined") {
			closebtn = b.closebtn
		};
		if (typeof(b) != "undefined" && typeof(b.closeBtn) != "undefined") {
			closebtn = b.closeBtn
		};
		if (c == 0 || c < 0) {
			timehm = 1000 * 60 * 24 * 7
		} else {
			timehm = c
		}
		if (typeof(layer) != "undefined") {
			layer.msg(a, {
				time: c
			})
		} else {
			if (t.alertdiv && typeof(t.alertdiv) != "undefined") {
				t.alertdiv.parentNode.removeChild(t.alertdiv);
				window.clearTimeout(t.alerttimer)
			};
			var w = document.documentElement.scrollWidth || document.body.scrollWidth;
			var h = document.documentElement.scrollHeight || document.body.scrollHeight;
			var f = document.createElement("div");
			f.className = d;
			f.innerHTML = a;
			var g = document.createElement("a");
			g.innerHTML = "×";
			g.className = "hcbtcolse";
			t.body.appendChild(f);
			if (closebtn == 1 || closebtn === false) {
				f.append(g);
				g.onclick = function(e) {
					k(e)
				}
			};
			t.alertdiv = f;
			var i = f.offsetWidth;
			if (i > w) {
				i = w - 100;
				f.style.width = (i - 20) + "px"
			};
			var j = f.offsetHeight;
			f.style.marginLeft = -(i) / 2 + "px";
			f.style.marginTop = -(j) / 2 + "px";
			f.onclick = function(e) {
				if (e && e.stopPropagation) {
					e.stopPropagation()
				} else {
					window.event.cancelBubble = true
				}
			};
			var k = function(e) {
					if (t.alertdiv) {
						window.clearTimeout(t.alerttimer);
						t.alertdiv.parentNode.removeChild(t.alertdiv);
						t.alertdiv = null
					};
					t.removeEvent(t.body, "click", k);
					if (e && e.stopPropagation) {
						e.stopPropagation()
					} else {
						window.event.cancelBubble = true
					}
				};
			t.alerttimer = window.setTimeout(function() {
				f.parentNode.removeChild(f);
				t.alertdiv = null
			}, timehm);
			if (c > 0) {}
		}
	},
	getjsonstr: function(a) {
		var t = this;
		var b = t.getchilds();
		var c = "";
		if (typeof(a) == "undefined" || a == "") {
			a = "all"
		};
		for (var i = 0; i < b.length; i++) {
			var d = t.get_item_jsonstr(b[i]);
			if (a != "all") {
				var e = a.split(",");
				var f = false;
				for (var j = 0; j < e.length; j++) {
					if (b[i].getAttribute("mystatus") == e[j]) {
						f = true
					}
				};
				if (!f) {
					d = ""
				}
			};
			if (d != "") {
				if (c != "") {
					c += "," + d
				} else {
					c = d
				}
			}
		};
		return "[" + c + "]"
	},
	get_item_jsonstr: function(a) {
		var t = this;
		var b = "";
		for (var k in t.input_format) {
			ite = "\"" + k + "\":\"" + a.getAttribute("data-" + k) + "\"";
			if (b != "") {
				b += "," + ite
			} else {
				b = ite
			}
		};
		return "{" + b + "}"
	},
	geturlcansu: function(a, b) {
		var c = a.split("?");
		var d = "";
		if (c.length == 2) {
			var e = c[1].split("&");
			for (var i = 0; i < e.length; i++) {
				var f = e[i].split("=");
				if (f.length == 2 && b == f[0]) {
					d = f[1]
				}
			}
		};
		return d
	},
	get_obj_value: function(a) {
		var t = this,
			obj = a.obj,
			val = "";
		if (typeof(a.obj) != "undefined") {
			obj = a.obj
		} else if (typeof(a.id) != "undefined") {
			obj = t.getobj({
				id: a.id
			})
		}
		if (obj && obj.tagName == "SELECT") {
			val = t.my_encodeURI(obj.options[obj.selectedIndex].value)
		}
		if (obj && obj.tagName == "TEXTAREA") {
			val = t.my_encodeURI(obj.value)
		}
		if (obj && obj.tagName == "SELECT") {
			val = t.my_encodeURI(obj.options[obj.selectedIndex].value)
		}
		if (obj && obj.tagName == "INPUT") {
			var b = obj.name;
			if (obj.type == "radio" || obj.type == "checkbox") {
				var c = obj.parentNode.parentNode.parentNode.getElementsByTagName("input");
				for (var i = 0; i < c.length; i++) {
					var o = c[i];
					if (o && typeof(o.type) != "undefined" && o.type == "radio" || o.type == "checkbox") {
						if (o.name == b && o.checked) {
							if (val != "") {
								val += "," + t.my_encodeURI(o.value)
							} else {
								val = t.my_encodeURI(o.value)
							}
						}
					}
				}
			} else {
				val = t.my_encodeURI(obj.value)
			}
		};
		return val
	},
	error_tishi: function(a) {
		var t = this;
		var b = t.GetObjByClass(a, "rel_chongchuan");
		var c = t.GetObjByClass(a, "rel_baifenbi");
		if (b) {
			b.style.display = ""
		}
		var d = "网络不好",
			baifenbi_text = "失败";
		if (typeof(t.opt.wenzi) != "undefined" && typeof(t.opt.wenzi.chongchuan_e) != "undefined") {
			d = t.opt.wenzi.chongchuan_e
		}
		if (typeof(t.opt.wenzi) != "undefined" && typeof(t.opt.wenzi.baifenbi_e) != "undefined") {
			baifenbi_text = t.opt.wenzi.baifenbi_e
		}
		if (b) {
			b.innerHTML = d
		}
		if (c) {
			c.innerHTML = baifenbi_text
		}
	},
	UploadProgress: function(a) {
		var t = this;
		t.NewFileBar(a)
	},
	UploadSuccess: function(a) {
		var t = this;
		var b = a.myitem;
		console.log("t.num", t.num);
		var c = a.file;
		var d = a.keyname;
		var f = [];
		if (typeof(t.files[b.id]) != "undefined") {
			t.files[b.id]["file"] = null;
			t.files[b.id]["status"] = "success"
		};
		if (typeof(hc_cookie) != "undefined") {
			hc_cookie.Del(d)
		}
		if (g_isshowdata == 1) {
			t.myalert(a.result)
		};
		var g = {};
		if (typeof(t.upload_success_result) != "undefined") {
			g = t.upload_success_result(a.result)
		} else {
			if (typeof(a.result) != "undefined") {
				if (typeof(a.result) == "string") {
					if (a.result != "") {
						g = eval("(" + a.result + ")")
					}
				} else {
					g = a.result
				}
			}
		}
		if (g.status == "error") {
			var h = t.GetObjByClass(b, "rel_bt");
			if (h) {
				h.style.display = ""
			}
			t.myalert(g.msg);
			return false
		};
		var i = t.GetObjByClass(b, "rel_img");
		t.isload = 0;
		var j = "";
		var l = "",
			big_src = "";
		if (typeof(g.small_src) != "undefined") {
			l = g.small_src
		} else if (typeof(g.smallsrc) != "undefined") {
			l = g.smallsrc
		} else if (typeof(g.filepath) != "undefined") {
			l = g.filepath
		};
		if (typeof(g.big_src) != "undefined") {
			big_src = g.big_src
		} else if (typeof(g.bigsrc) != "undefined") {
			big_src = g.bigsrc
		}
		if (typeof(g.key) != "undefined") {
			l = g.key
		}
		if (typeof(g.path) != "undefined") {
			l = g.path
		}
		if (b.getAttribute("data-src") && typeof(b.getAttribute("data-src")) != "undefined" && b.getAttribute("data-src") == "") {
			l = b.getAttribute("data-src")
		};
		t.cur_small_src = l;
		console.log("small_src:", l);
		var m = l.split(".");
		var o = "",
			ext = "";
		if (m.length > 1) {
			ext = m[m.length - 1]
		};
		if (t.IsImg(ext)) {
			o = "image"
		};
		if (big_src == "") {
			big_src = t.getbigsrc(l)
		};
		if (t.panel == null) {
			j += "<table cellpadding='0' cellspacing='0' border='0' style='height:" + t.opt.height + "px;width:100%;'>";
			j += "<tr style='height:100%;'><td valign='middle' style='height:100%;'>";
			j += "<img src='" + t.siteurl_file + l + "' style='width:" + t.opt.width + "px;'/>";
			j += "</td></tr></table>";
			if (t.bt) {
				t.bt.innerHTML = j
			} else {}
		} else {};
		var p = b.getElementsByTagName("img");
		if (t.conf.maxnum > 1 && t.panel) {
			if (p.length > 0) {}
		};
		if (b != null) {
			var q = t.getbynames(b, "src");
			if (q.length > 0) {
				q[0].value = big_src
			};
			var r = t.getbynames(b, "date");
			if (r.length > 0) {
				r[0].value = date
			};
			b.setAttribute("small_src", l);
			b.setAttribute("big_src", big_src);
			if (t.conf.isyulan == 1) {
				if (i) {
					var s = i.getElementsByTagName("img");
					if (s.length > 0) {
						var u = s[0];
						if (o == "image") {
							u.src = t.getimgsrc(l)
						} else if (t.IsImg(ext) && l.indexOf("." + ext) != -1) {
							u.src = t.getimgsrc(l) + "?" + t.newrand(4)
						} else {
							u.src = t.GetExtSrc(g_exts, ext)
						}
					}
				}
			}
			var v = t.GetObjByClass(b, "rel_name");
			var w = t.GetObjByClass(b, "rel_date");
			var x = t.GetObjByClass(b, "rel_down");
			var y = t.GetObjByClass(b, "rel_see");
			var z = "";
			if (v && (typeof(t.opt.item_class) == "undefined" || t.opt.item_class == "")) {
				z = " style='color:" + v.style.color + ";'"
			}
			if (y) {
				var A = y.getElementsByTagName("a");
				if (A.length > 0) {
					A[0].href = t.getfullsrc(big_src)
				}
			}
			if (v) {
				if (v.innerHTML == "") {
					if (typeof(t.opt.down_url) != "undefined" && t.opt.down_url != "") {
						v.innerHTML = "<a href='" + t.opt.down_url + "?path=" + big_src + "&cengci=" + g.cengci + "' target='_blank'  " + z + ">" + v.innerHTML + "</a>"
					} else {
						v.innerHTML = "<a href='" + t.siteurl_file + big_src + "' target='_blank' " + z + ">" + v.innerHTML + "</a>"
					}
					var B = document.getElementsByTagName("a");
					if (B.length > 0) {
						B[0].onclick = function(e) {
							if (e && e.stopPropagation) {
								e.stopPropagation()
							} else {
								window.event.cancelBubble = true;
								return false
							}
						}
					}
				}
			}
			if (x) {
				var C = x.innerHTML;
				if (C == "") {
					C = "下载"
				}
				if (typeof(t.opt.down_url) != "undefined" && t.opt.down_url != "") {}
			}
			if (w) {
				w.innerHTML = g.date
			}
			var D = unescape(l);
			b.setAttribute("myfilePath", D);
			var n = 0;
			for (var k in t.input_format) {
				n++
			};
			var E = g.row;
			if (n == 1) {
				newval = t.getnewsrc(D);
				t.setAttr(b, "data-src", newval)
			};
			if (typeof(E) == "undefined") {
				E = {
					src: D
				}
			};
			if (typeof(E) != "undefined") {
				var F = "";
				for (var k in E) {
					if (F != "") {
						F += "," + k
					} else {
						F = k
					};
					if (k == "src") {
						t.setAttr(b, "data-" + k, t.getnewsrc(E[k]))
					} else {
						t.setAttr(b, "data-" + k, E[k])
					}
				};
				t.setAttr(b, "myrowfields", F);
				t.addhiddeninput(b, E);
				t.update_input_value({
					myitem: b,
					row: E
				})
			} else {
				t.setAttr(b, "data-src", newval)
			};
			t.ShowYuanSu({
				myitem: b,
				conf: t.success_show
			});
			t.fileCount++;
			b.setAttribute("myuploadsize", c.size);
			b.setAttribute("myvalue", t.GetItemValue(b));
			b.setAttribute("mystatus", "success");
			if (typeof(t.upload_success) != "undefined") {
				t.upload_success({
					type: "success",
					result: a.result,
					row: g.row,
					item1: b,
					myitem: b,
					file: c,
					num: t.num,
					maxnum: t.conf.maxnum,
					num_dengdai: t.getstatuscount("dengdai"),
					num_upload: t.getstatuscount("upload")
				})
			}
		}
		if (typeof(hcfile_ewm) != "undefined") {
			t.autosave()
		};
		t.ResetInput()
	},
	UploadIsFinish: function() {
		var t = this;
		var a = true;
		var b = t.getchilds();
		if (b.length != 0) {
			var n = 0;
			for (var i = 0; i < b.length; i++) {
				var c = b[i].getAttribute("mystatus");
				if (c == "dengdai" || c == "upload") {
					n++
				}
			}
			if (n > 0) {
				a = false
			}
		} else {
			a = 0
		};
		return a
	},
	GetStatusNums: function() {
		var t = this;
		var a = true;
		var b = {
			"init": 0,
			"total": 0,
			"dengdai": 0,
			"upload": 0,
			"error": 0,
			"success": 0
		};
		for (var i = 0; i < childs.length; i++) {
			var c = childs[i];
			b["total"]++;
			if (typeof(b[c]) != "undefined") {
				b[c] = b[c] + 1
			}
		};
		return b
	},
	GetItemValue: function(a) {
		var t = this;
		var b = "";
		var c = "";
		if (a) {
			for (var k in t.input_format) {
				var v = "";
				if (a.getAttribute("data-" + k) == null) {
					v = ""
				} else if (typeof(a.getAttribute("data-" + k)) == "undefined") {
					v = ""
				} else if (typeof(a.getAttribute("data-" + k)) != "undefined") {
					v = a.getAttribute("data-" + k)
				}
				if (k == "src" && (a.getAttribute("mystatus") == "success" || a.getAttribute("mystatus") == "init" || a.getAttribute("mystatus") == "first")) {
					c = v;
					v = t.getnewsrc(v)
				}
				if (b != "") {
					b += t.result.fenge_child + v
				} else {
					b = v
				}
			}
		};
		if (c == "" || typeof(c) == "undefined" || c == null) {
			b = ""
		};
		return b
	},
	PaiXu: function(a) {
		var t = this;
		var b = null;
		var c = t.getobjs(t.panel, a.getAttribute("itemid"));
		if (c.length > 0) {
			b = c[0]
		}
		var d = t.getchilds();
		var e = a.getAttribute("state");
		if (e == "prev") {
			var f = null;
			for (var i = 0; i < d.length; i++) {
				if (d[i].id == b.id && i > 0) {
					f = d[i - 1]
				}
			}
			if (f) {
				b.parentNode.insertBefore(b, f);
				if (typeof(t.paixu_huidiao) != "undefined") {
					t.paixu_huidiao(e, b, f)
				}
				t.ResetInput()
			}
		};
		if (e == "next") {
			var g = null;
			for (var i = 0; i < d.length; i++) {
				if (d[i].id == b.id && i < (d.length - 1) && d.length > 1) {
					g = d[i + 1]
				}
			}
			if (g) {
				b.parentNode.insertBefore(g, b);
				if (typeof(t.paixu_huidiao) != "undefined") {
					t.paixu_huidiao(e, b, g)
				}
				t.ResetInput()
			}
		};
		t.ResetInput()
	},
	ResetInput: function() {
		var t = this;
		var n = 0;
		for (var k in t.input_format) {
			n++
		};
		var a = 0;
		t.childs = t.getchilds();
		var b = "";
		t.num = t.childs.length;
		for (var i = 0; i < t.childs.length; i++) {
			var c = t.childs[i];
			newval = t.GetItemValue(c);
			var d = c.getAttribute("mystatus");
			if (d == "success" || d == "first") {
				a++
			}
			if (c.getAttribute("data-src") != "" && typeof(c.getAttribute("data-src")) != "undefined") {
				var e = t.GetObjByClass(myitem, "rel_index");
				if (e) {
					t.set_obj_value(e, (i + 1))
				};
				c.setAttribute("myindex", (i + 1));
				if (newval != "") {
					if (b != "") {
						b += t.result.fenge + newval
					} else {
						b = newval
					}
				};
				var f = {};
				for (var k in t.input_format) {
					var v = myitem.getAttribute("data-" + k);
					f[k] = v
				};
				t.addhiddeninput(myitem, f)
			}
		};
		if (t.input) {
			t.input.value = b
		};
		if (t.input_fengmian) {
			t.SetFengMianInput()
		};
		if (t.objnull) {
			if (t.childs.length > 0) {
				t.objnull.style.display = "none"
			} else {
				t.objnull.style.display = "block"
			}
		}
	},
	ShowBig: function(a) {
		var t = this;
		var b = t.GetParentItem(a);
		var c = b.getAttribute("data-src");
		var d = b.getAttribute("data-src");
		var e = t.getbigsrc(d);
		if (typeof(e) != "undefined") {
			if (typeof(t.click_img) != "undefined") {
				t.click_img({
					myitem: b,
					bigsrc: t.getfullsrc(e)
				});
				return false
			}
			var f = t.getfullsrc(e);
			if (f.indexOf("?") == -1) {
				f += "?" + b.id
			};
			window.open(f)
		}
	},
	NewFileBar: function(a) {
		var t = this;
		var b = a.myitem;
		if (b) {
			var c = t.GetObjByClass(b, "rel_baifenbi");
			var d = t.GetObjByClass(b, "rel_bar");
			var e = t.GetObjByClass(b, "rel_img");
			var f = t.GetObjByClass(b, "rel_size");
			var g = t.GetObjByClass(b, "rel_canvas");
			var i = t.GetObjByClass(b, "rel_filesize");
			var j = t.GetObjByClass(b, "rel_meimiao");
			var k = t.GetObjByClass(b, "rel_barsize");
			var l = t.GetObjByClass(b, "rel_see");
			var h = t.opt.height;
			var m = t.GetObjByClass(b, "rel_uploadsize");
			if (a.status == "success" && typeof(a.src) != "undefined") {
				var o = t.getbigsrc(a.src);
				if (l) {
					var p = l.getElementsByTagName("a");
					if (p.length > 0) {
						p[0].href = t.getfullsrc(o)
					}
				}
			};
			var q = t.ShowTotalFileSize();
			var r = [];
			var s = 0;
			var u = 0;
			if (typeof(a.file_size) != "undefined") {
				s = a.file_size;
				u = a.success_size
			}
			r['success_size'] = u;
			r['file_size'] = s;
			q['t'] = t;
			q['success_size'] = u;
			q['file_size'] = s;
			q['item1'] = b;
			q['myitem'] = b;
			q['file'] = a.file;
			var v = b.getAttribute("success_size_init");
			if (v == null || typeof(v) == "undefined") {
				v = 0
			};
			var n = t.FormatBaiFenBi(a.success_size, a.file_size);
			q['value'] = n;
			if (typeof(t.opt.totalbar) != "undefined") {
				t.opt.totalbar(q)
			}
			if (typeof(t.bar_huidiao) != "undefined") {
				t.bar_huidiao(q)
			}
			if (typeof(a.file_size) != "undefined") {
				if (i) {
					i.innerHTML = t.FormatSize(a.file_size)
				}
			}
			var w = parseInt(b.getAttribute("mystarttime"));
			var x = Date.parse(new Date());
			var y = parseInt((x - w) / 1000);
			if (y == 0) {
				y = 1
			}
			if (j) {
				j.innerHTML = "每秒" + t.FormatSize(((u - v) / y))
			}
			if (a.success_size != a.file_size) {
				if (c) {
					c.innerHTML = Math.round(n) + "%"
				}
				if (d) {
					if (typeof($) != "undefined" && typeof(t.conf.bar_animate) != "undefined" && t.conf.bar_animate == 1) {
						$(d).animate({
							width: n + "%"
						}, 50)
					} else {
						d.style.width = n + "%"
					}
				}
				if (g) {
					t.CanvasBar({
						canvas: g,
						n: n
					})
				}
				if (k) {
					k.innerHTML = t.FormatSize(a.success_size)
				}
				if (m) {
					m.innerHTML = t.FormatSize(a.success_size)
				}
				t.ShowYuanSu({
					myitem: b,
					conf: t.upload_show
				})
			} else {
				var n = 100;
				if (j) {
					j.innerHTML = t.FormatTime("共" + (y))
				}
				if (typeof(a.file_size) != "undefined") {
					if (i) {
						i.innerHTML = t.FormatSize(a.file_size)
					}
				}
				if (c) {
					c.innerHTML = "100%"
				}
				if (d) {
					if (typeof($) != "undefined" && typeof(t.conf.bar_animate) != "undefined") {
						$(d).animate({
							width: n + "%"
						})
					} else {
						d.style.width = n + "%"
					}
				}
				if (g) {
					t.CanvasBar({
						canvas: g,
						n: 100
					})
				}
				if (k) {
					if (a.type == "init") {
						k.innerHTML = ""
					} else {
						k.innerHTML = t.FormatSize(a.file_size)
					}
				};
				if (m) {
					if (a.type == "init") {
						m.innerHTML = ""
					} else {
						m.innerHTML = t.FormatSize(a.file_size)
					}
				};
				if (a.type != "first") {
					t.ShowYuanSu({
						myitem: b,
						conf: t.success_show
					})
				};
				if (b.className.indexOf(" hcsuccess") == -1) {
					b.className = b.className + " hcsuccess"
				};
				if (typeof(t.success) != "undefined") {
					var q = {
						type: "success",
						maxnum: t.conf.maxnum,
						num: t.childs.length,
						item1: b
					};
					if (typeof(a.src) != "undefined") {
						q.src = a.src
					}
					if (typeof(a.type) != "undefined") {
						q.type = a.type
					}
					if (typeof(a.result) != "undefined") {
						q.result = eval("(" + a.result + ")")
					}
					if (typeof(a.file) != "undefined") {
						q.file = a.file
					}
					if (typeof(a.file_small) != "undefined") {
						q.file_small = a.file_small
					}
					t.success(q)
				}
			}
		}
	},
	FormatTime: function(a) {
		if (a / 60 / 60 > 1) {
			return (a / 60 / 60).toFixed(2) + "小时"
		} else if (a / 60 > 1) {
			return (a / 60).toFixed(2) + "分钟"
		} else {
			return (a) + "秒"
		}
	},
	toFloat: function(a) {
		var b = a.value;
		if (typeof(a.weishu) != "undefined") {
			b = parseFloat(a.value).toFixed(a.weishu)
		}
		return b
	},
	CanvasBar: function(a) {
		var b = a.canvas,
			width = b.width,
			height = b.height,
			ctx = b.getContext('2d');
		var c, startAngle = 0,
			endAngle, add = Math.PI * 2 / 100;
		ctx.shadowOffsetX = 0;
		ctx.shadowOffsetY = 0;
		ctx.shadowBlur = 10;
		var d = 30,
			counterClockwise = false,
			x, y, radius, animation_interval = 20,
			n = a.n,
			timer;
		c = 1;
		startAngle = 0;
		if (a.canvas.getAttribute("data-strokeStyle") == null) {
			a.canvas.setAttribute("data-strokeStyle", '#' + ('00000' + (Math.random() * 0x1000000 << 0).toString(16)).slice(-6))
		}
		ctx.strokeStyle = a.canvas.getAttribute("data-strokeStyle");
		ctx.shadowColor = ctx.strokeStyle;
		x = parseInt(width / 2);
		y = parseInt(width / 2);
		radius = parseInt((width - d) / 2) - 10;
		var f = function() {
				if (c <= n) {
					endAngle = startAngle + add;
					g(startAngle, endAngle);
					startAngle = endAngle;
					c++
				} else {
					clearInterval(timer)
				}
			};
		var g = function(s, e) {
				ctx.beginPath();
				ctx.arc(x, y, radius, s, e, counterClockwise);
				ctx.lineWidth = d;
				ctx.stroke()
			};
		if (a.canvas.getAttribute("data-n") != null && typeof(a.canvas.getAttribute("data-n")) != "undefined") {
			c = parseInt(a.canvas.getAttribute("data-n"));
			startAngle = c * add
		} else {
			startAngle = 0;
			c = 1
		};
		a.canvas.setAttribute("data-n", a.n);
		g(startAngle, a.n * add)
	},
	FormatSize: function(a) {
		a = parseInt(a);
		if (a / (1024 * 1024 * 1024 * 1024) > 1) {
			return (a / (1024 * 1024 * 1024 * 1024)).toFixed(2) + "T"
		} else if (a / (1024 * 1024 * 1024) > 1) {
			return (a / (1024 * 1024 * 1024)).toFixed(2) + "G"
		} else if (a / (1024 * 1024) > 1) {
			return (a / (1024 * 1024)).toFixed(2) + "M"
		} else if (a / (1024) > 1) {
			return (a / 1024).toFixed(2) + "K"
		} else {
			return (a) + "B"
		}
	},
	GetObjByClass: function(a, b) {
		var c = a.getElementsByTagName("*");
		for (var i = 0; i < c.length; i++) {
			var d = c[i];
			if (typeof(d.className) != "undefined") {
				var e = d.className.split(" ");
				for (var j = 0; j < e.length; j++) {
					if (e[j] == b) {
						return d
					}
				}
			}
		}
		return null
	},
	GetObjsByClass: function(a, b) {
		var c = a.getElementsByTagName("*");
		var d = null,
			objs = new Array(),
			n = 0;
		var e = b.split(" ");
		for (var i = 0; i < c.length; i++) {
			var f = c[i];
			if (typeof(f.className) != "undefined") {
				var g = String(f.className);
				var h = g.split(" ");
				for (var j = 0; j < h.length; j++) {
					for (var y = 0; y < e.length; y++) {
						if (h[j] == e[y]) {
							objs.push(f);
							n++
						}
					}
				}
			}
		};
		return objs
	},
	GetObjByAttr: function(a, b, c) {
		var d = a.getElementsByTagName("*");
		var e = null;
		for (var i = 0; i < d.length; i++) {
			var f = d[i];
			if (f.getAttribute(b) && typeof(f.getAttribute(b)) != "undefined") {
				var g = String(f.getAttribute(b));
				if (g.indexOf(c) != -1) {
					e = f;
					break
				}
			}
		};
		return e
	},
	GetObjsByAttr: function(a, b) {
		var c = a.getElementsByTagName("*");
		var d = [];
		for (var i = 0; i < c.length; i++) {
			var e = c[i];
			if (e.getAttribute(b) && typeof(e.getAttribute(b)) != "undefined") {
				d.push(e)
			}
		};
		return d
	},
	GetChildsByAttr: function(a, b, c) {
		var d = a.childNodes;
		var e = [];
		for (var i = 0; i < d.length; i++) {
			var f = d[i];
			if (f.getAttribute(b) && typeof(f.getAttribute(b)) != "undefined") {
				e.push(f)
			}
		};
		return e
	},
	ReturnSrc: function(a) {
		var t = this,
			filename = "",
			src = "";
		if (typeof(a) == "string") {
			src = a
		} else {
			src = a.small_src;
			if (typeof(a.small_src) != "undefined") {
				src = a.small_src
			} else if (typeof(a.myitem) != "undefined") {
				src = a.myitem.getAttribute("small_src")
			};
			if (typeof(a.myitem) != "undefined") {
				filename = a.myitem.getAttribute("mytitle")
			}
		};
		var b = src,
			t = this,
			arr2 = src.split("."),
			ext = arr2[arr2.length - 1],
			path = "";
		if (t.conf.isnewsmall == 1) {
			if (t.IsImg(ext)) {
				if (typeof(t.opt.conf) != "undefined" && typeof(t.opt.conf.return_value) != "undefined" && t.opt.conf.return_value == "大图") {
					if (typeof(t.opt.conf) != "undefined" && typeof(t.opt.conf.small_hz_name) != "undefined" && t.opt.conf.small_hz_name != "") {
						b = b.replace("_" + t.opt.conf.small_hz_name + ".", ".")
					} else if (src.indexOf("/s50/") != -1) {
						b = b.replace("/s50/", "/s100/")
					}
				}
			}
		};
		if (t.result.isfull == 1 && b.indexOf("http://") == -1) {
			path = t.siteurl_file + b
		} else {
			path = b
		};
		if (t.result.type == "html") {
			var c = null,
				moban_html = "",
				obj_title = null;
			if (typeof(t.result.moban_id) != "undefined") {
				c = document.getElementById(t.result.moban_id)
			}
			if (typeof(t.result.title_id) != "undefined") {
				obj_title = document.getElementById(t.result.title_id)
			}
			if (c) {
				moban_html = c.value
			} else if (typeof(t.result.moban_html) != "undefined") {
				moban_html = t.result.moban_html
			}
			if (obj_title) {
				var d = filename;
				if (obj_title.value != "") {
					d = obj_title.value
				}
				return "<img src=\"" + path + "\" alt=\"" + d + "\"/>"
			} else if (moban_html != "") {
				html = moban_html;
				html = html.replace(/{src}/, path);
				html = html.replace(/{path}/, path);
				html = html.replace(/{alt}/, filename);
				html = html.replace(/{title}/, filename);
				html = html.replace(/{filename}/, filename);
				return html
			} else {
				return "<img src=\"" + path + "\" alt=\"" + filename + "\"/>"
			}
		} else {
			return path
		}
	},
	GetFileExt: function(a) {
		var b = a.toLowerCase().split(".");
		var c = a;
		if (b.length > 1) {
			c = b[b.length - 1]
		};
		return c
	},
	FileExt: function(a) {
		var t = this;
		var b = "";
		var c = [];
		var d = "";
		var e = "";
		var f = "";
		if (typeof(a.file) != "undefined") {
			e = a.file.type;
			f = a.file.name
		} else {
			e = a.contenttype;
			f = a.filename
		};
		t.log(a.file);
		c = f.toLowerCase().split(".");
		var g = "";
		var d = "";
		if (c.length > 1) {
			g = c[c.length - 1];
			d = g
		}
		if (d == "") {
			if (e == "" && f.indexOf("image") != -1) {
				d = "jpg"
			} else if (e == "" && c.length > 1) {
				d = c[c.length - 1]
			}
		}
		if (d == "" && typeof(a.file) != "undefined") {
			for (var i = 0; i < g_exts.length; i++) {
				if (e == g_exts[i].contenttype) {
					d = g_exts[i].ext;
					break
				}
			}
		};
		if (d == "" && c.length > 1) {
			d = c[c.length - 1]
		};
		if (d == "" && e != "") {
			c = e.toLowerCase().split('/');
			d = c[c.length - 1]
		};
		if (d == "jpeg" && g == "jpg") {
			d = g
		};
		return d
	},
	IsUpload: function(a) {
		var t = this;
		var b = 0;
		var c = 0;
		a = a.toLowerCase();
		if (typeof(t.opt.notexts) != "undefined") {
			var d = t.opt.notexts.split(",");
			for (var j = 0; j < d.length; j++) {
				if (d[j] == a) {
					c = 1;
					break
				}
			}
		};
		if (c == 1) {
			return false
		};
		if (typeof(t.opt.exts) != "undefined") {
			var d = t.opt.exts.split(",");
			for (var j = 0; j < d.length; j++) {
				if (d[j] == a) {
					b = 1;
					break
				}
			}
		} else {
			if (typeof(t.conf.type) != "undefined" && t.conf.type != "" && t.conf.type != "all") {
				if (b == 0 && a != "") {
					for (var i = 0; i < g_exts.length; i++) {
						if (a == g_exts[i].ext && g_exts[i].type == t.conf.type) {
							ext = g_exts[i].ext;
							b = 1;
							break
						}
					}
				}
			} else {
				if (b == 0 && a != "") {
					b = 1
				}
			}
		};
		if (b == 0) {
			return false
		} else {
			return true
		}
	},
	insertAfter: function(a, b) {
		var c = b.parentNode;
		if (c.lastChild == b) {
			c.appendChild(a)
		} else {
			c.insertBefore(a, b.nextSibling)
		}
	},
	insertBefore: function(a, b) {
		var c = b.parentNode;
		c.insertBefore(a, b)
	},
	NewItem: function(a) {
		var t = this,
			item_html = "";
		var b = t.conf.inserttype;
		if (typeof(a) != "undefined" && typeof(a.inserttype) != "undefined") {
			b = a.inserttype
		};
		item_html += "<div>";
		item_html += "<div class=\"relin\">";
		item_html += "<div class=\"rel_img\"></div>";
		item_html += "<div class=\"rel_bar\"></div>";
		item_html += "<div class=\"rel_baifenbi\">0%</div>";
		item_html += "<div class=\"rel_size\" myfield=\"size\">0B</div>";
		item_html += "<div class=\"rel_filesize\"  myfield=\"size\">0KB</div><div class=\"rel_name\"  myfield=\"name\">bt.jpg</div>";
		item_html += "<div class=\"rel_down\">下载</div><div class=\"rel_date\" myfield=\"date\"></div>";
		item_html += "<div class=\"rel_chongchuan\">重传</div><div class=\"rel_del\">×</div>";
		item_html += "<div class=\"rel_bg\"></div>";
		item_html += "<div class=\"rel_see\">查看</div><div state=\"prev\" class=\"rel_prev\">&lt;</div>";
		item_html += "<div class=\"rel_next\" state=\"next\" >&gt;</div>";
		if (t.upload_show.meimiao == 1) {
			item_html += "<div class=\"rel_meimiao\"></div>"
		};
		item_html += "<div class=\"rel_chongxuan\">重新选择</div>";
		item_html += "<div class=\"rel_fengmian\">√</div>";
		item_html += "<div class=\"rel_insert\">插入</div>";
		item_html += "<div class=\"rel_barsize\">0KB</div>";
		item_html += "<div class=\"rel_tishi\"></div>";
		item_html += "<div class=\"rel_jieping\">截屏</div>";
		item_html += "<div class=\"rel_successtishi\"></div>";
		if (typeof(t.opt.item_child_html) != "undefined" && t.opt.item_child_html != "") {
			item_html += t.opt.item_child_html
		};
		t.childs = t.getchilds();
		item_html += "</div>";
		item_html += "</div>";
		if (typeof(t.opt.item_html) != "undefined" && t.opt.item_html != "") {
			item_html = t.opt.item_html
		};
		var c = "";
		if (typeof(a.src) != "undefined") {
			c = a.src
		} else if (typeof(a.small_src) != "undefined") {
			c = a.small_src
		} else if (typeof(a.row) != "undefined") {
			c = a.row["src"]
		};
		a.tmpid = "item_" + t.RndNum(8);
		if (typeof(a.file) != "undefined" && typeof(a.file.tmpid) != "undefined") {
			a.tmpid = a.file.tmpid
		};
		if (typeof(a.file) != "undefined" && typeof(a.file.itemid) != "undefined") {
			a.tmpid = a.file.itemid
		};
		if (typeof(a.tmpid) != "undefined") {
			a.tmpid = a.tmpid
		};
		var d = 1009;
		var e, filesize, filesize_caption = "",
			oldfilename = "";
		var f = "";
		if (a.file) {
			var g = a.file;
			var j = g.name;
			var l = g.type;
			e = g.name;
			filesize = g.size;
			var m = e.split(".");
			var n = m[m.length - 1];
			n = n.toLowerCase();
			oldfilename = g.name;
			f = t.FileExt({
				file: g
			});
			c = (t.GetPngImg(f));
			filesize_caption = t.FormatSize(filesize)
		} else {
			if (typeof(c) != "undefined") {
				var m = c.split("/"),
					name1 = m[m.length - 1];
				e = name1
			}
		};
		var o = t.panel;
		if (a.parent) {
			o = a.parent
		};
		var p = item_html.split(" "),
			shuxing = {};
		for (var i = 0; i < p.length; i++) {
			var q = p[i].split("=");
			if (q.length == 2) {
				shuxing[q[0]] = q[1]
			}
		};
		var r = null;
		var w = "",
			h = "";
		if (typeof(t.opt.width) != "undefined" && t.opt.width != "") {
			w = t.opt.width + "px";
			if (String(t.opt.width).indexOf("%") != -1) {
				w = t.opt.width
			}
		};
		if (typeof(t.opt.height) != "undefined" && t.opt.height != "") {
			h = t.opt.height + "px";
			if (String(t.opt.height).indexOf("%") != -1) {
				h = t.opt.height
			}
		};
		if (typeof(a.width) != "undefined" && a.width != "") {
			w = a.width + "px";
			if (String(a.width).indexOf("%") != -1) {
				w = a.width
			}
		};
		if (typeof(a.height) != "undefined" && a.height != "") {
			h = a.height + "px";
			if (String(a.height).indexOf("%") != -1) {
				h = a.height
			}
		};
		if (item_html.indexOf("<td") == 0) {
			var s = document.createElement("table");
			var u = s.insertRow();
			u.innerHTML = item_html;
			r = u.cells[0].cloneNode(true)
		} else {
			t.tmpitem = document.createElement("div");
			t.tmpitem.style.display = "none";
			t.tmpitem.id = "tmpitem";
			t.tmpitem.innerHTML = item_html;
			o.appendChild(t.tmpitem);
			r = t.tmpitem.childNodes[0].cloneNode(true);
			t.tmpitem.parentNode.removeChild(t.tmpitem)
		};
		if (typeof(t.opt.item_class) != "undefined" && t.opt.item_class != "") {
			t.addClass(r, t.opt.item_class)
		}
		if (a.file) {
			t.setAttr(r, "data-name", a.file.name)
		};
		var v = false;
		if (r.className && typeof(r.className) != "undefined") {
			v = true;
			t.opt.item_class = r.className
		}
		if (typeof(t.opt.item_class) != "undefined" && t.opt.item_class != "") {
			v = true
		};
		t.addClass(r, "hcfileitem");
		if (typeof(t.opt.item_class) == "undefined" || t.opt.item_class == "") {
			r.style.cssText = g_conf.myitem.cssText;
			if (typeof(t.opt.border) != "undefined" && t.opt.border != "") {
				r.style.borderWidth = t.opt.border + "px";
				if (String(t.opt.width).indexOf("%") == -1) {
					w = (parseInt(w) - (t.opt.border * 2)) + "px";
					h = (parseInt(h) - (t.opt.border * 2)) + "px"
				}
			}
			if (typeof(r.style.margin) != "undefined" && r.style.margin != "") {
				var x = parseInt(r.style.margin);
				if (t.weizhi) {
					t.weizhi.style.margin = r.style.margin
				}
			}
		};
		if (w != "") {
			r.style.width = w
		}
		if (h != "") {
			r.style.height = h
		}
		if (typeof(a.file) != "undefined") {
			r.setAttribute("mystatus", "dengdai")
		};
		r.setAttribute("mygroupindex", t.curgroupindex);
		r.setAttribute("mytitle", e);
		r.id = a.tmpid;
		r.setAttribute("tmpid", a.tmpid);
		r.setAttribute("myparent", "hcitem");
		var y = t.conf.item_yifu_weizhi;
		if (typeof(b) == "undefined" || b == "append" || b == "" || t.conf.inserttype == "after") {
			b = "after"
		}
		// console.log(y, b);
		if (a.type != "bt") {
			if (a.status == "first111") {
				if (b == "after" && y == "after") {
					if (t.childs.length > 0) {
						t.insertAfter(r, t.childs[t.childs.length - 1])
					} else {
						t.insertBefore(r, t.yifu)
					}
				};
				if (b == "after" && y == "before") {
					if (t.childs.length > 0) {
						t.insertAfter(r, t.childs[t.childs.length - 1])
					} else {
						t.insertBefore(r, t.yifu)
					}
				};
				if (b == "before" && y == "after") {
					if (t.childs.length > 0) {
						t.insertAfter(r, t.childs[0])
					} else {
						t.insertAfter(r, t.yifu)
					}
				};
				if (b == "before" && y == "before") {
					if (t.childs.length > 0) {
						t.insertAfter(r, t.childs[t.childs.length - 1])
					} else {
						t.insertBefore(r, t.yifu)
					}
				}
			} else {
				if (y == "before" && b == "after") {
					if (t.childs.length > 0) {
						t.insertAfter(r, t.childs[t.childs.length - 1])
					} else {
						t.insertAfter(r, t.yifu)
					}
				};
				if (y == "before" && b == "before") {
					if (t.childs.length > 0) {
						t.insertBefore(r, t.childs[0])
					} else {
						t.insertAfter(r, t.yifu)
					}
				};
				if (y == "after" && b == "after") {
					if (t.childs.length > 0) {
						t.insertAfter(r, t.childs[t.childs.length - 1])
					} else {
						t.insertBefore(r, t.yifu)
					}
				};
				if (y == "after" && b == "before") {
					if (t.childs.length > 0) {
						t.insertBefore(r, t.childs[0])
					} else {
						t.insertBefore(r, t.yifu)
					}
				}
			}
		};
		o.appendChild(t.clearfloat);
		var z = document.createElement("span");
		z.id = r.id + "_hidden";
		r.appendChild(z);
		t.setAttr(r, "myindex", (t.childs.length + 1));
		if (typeof(a.row) != "undefined") {
			var A = "";
			for (var k in a.row) {
				if (A != "") {
					A += "," + k
				} else {
					A = k
				}
			};
			t.setAttr(r, "myrowfields", A);
			t.addhiddeninput(r, a.row)
		};
		if (typeof(a.other_type) != "undefined") {
			t.setAttr(r, "other_type", a.other_type)
		};
		var B = t.GetObjByAttr(r, "myname", "title");
		var C = t.GetObjByClass(r, "rel_baifenbi");
		var D = t.GetObjByClass(r, "rel_bar");
		var E = t.GetObjByClass(r, "rel_img");
		var F = t.GetObjByClass(r, "rel_del");
		var G = t.GetObjByClass(r, "rel_fengmian");
		var H = t.GetObjByClass(r, "rel_size");
		var I = t.GetObjByClass(r, "rel_date");
		var J = t.GetObjByClass(r, "rel_chongxuan");
		var K = t.GetObjByClass(r, "rel_bg");
		var L = t.GetObjByClass(r, "rel_see");
		var M = t.GetObjByClass(r, "rel_name");
		var N = t.GetObjByClass(r, "rel_chongchuan");
		var O = t.GetObjByClass(r, "rel_prev");
		var P = t.GetObjByClass(r, "rel_next");
		var Q = t.GetObjByClass(r, "rel_filesize");
		var R = t.GetObjByClass(r, "rel_down");
		var S = t.GetObjByClass(r, "rel_insert");
		var T = t.GetObjByClass(r, "rel_barsize");
		var U = t.GetObjByClass(r, "rel_jieping");
		var V = t.GetObjByClass(r, "rel_tishi");
		var W = false;
		if (typeof(a.row) != "undefined" && a.row) {
			W = true
		} else {
			if (B) {
				B.value = oldfilename
			}
		};
		var X = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC";
		var Y = t.getfullsrc(c);
		var Z = Y;
		if (typeof(Z) != "undefined") {
			if (!t.IsImg(Y)) {
				var f = t.GetFileExt(Y);
				Z = t.GetPngImg(f)
			}
		};
		if (E) {
			var ba = E.getElementsByTagName("img");
			if (ba.length == 0) {
				E.innerHTML = "<img src='" + X + "' data-original='" + Z + "'   style='" + g_conf.image.cssText + "' class='imga'/>";
				ba = E.getElementsByTagName("img")
			};
			if (typeof(a.bt_html) != "undefined") {
				E.innerHTML = a.bt_html;
				E.style.cssText = "display:none;position:absolute;left:0px;top:0px;text-align:center;z-index:" + d;
				if (w != "") {
					E.style.width = w
				}
				if (h != "") {
					E.style.height = h
				}
			} else {
				if (ba.length > 0) {
					ba[0].style.cssText = g_conf.image.cssText;
					var bb = "";
					if (typeof(ba[0].style.className) != "undefined") {
						bb = ba[0].style.className
					};
					ba[0].style.className = bb + " imga";
					ba[0].setAttribute("data-original", Y)
				};
				if (!v) {
					E.style.cssText = "width:" + w + ";height:" + h + ";position:absolute;left:0px;top:0px;text-align:center;";
					if (w != "") {
						E.style.width = w
					}
					if (h != "") {
						E.style.height = h
					}
				}
			};
			var bc = t.GetObjByClass(E, "imga");
			if (!bc && ba.length > 0) {
				bc = ba[0]
			};
			if (bc) {
				if (typeof(t.opt.islazyload) == "undefined" && t.opt.islazyload != 1) {
					bc.src = Z
				}
			}
		};
		if (typeof(a.type) != "undefined") {
			r.setAttribute("mytype", a.type)
		};
		if (H) {
			H.innerHTML = filesize_caption
		};
		if (T) {
			T.innerHTML = filesize_caption
		};
		if (M) {
			if (typeof(a.row) != "undefined") {
				if (typeof(a.row.title) != "undefined") {
					M.innerHTML = a.row.title
				}
				if (typeof(a.row.name) != "undefined") {
					M.innerHTML = a.row.name
				}
			} else {
				M.innerHTML = e
			}
		};
		var bd = t.opt.success_show;
		var be = document.createElement("span");
		be.innerHTML = "<input type=\"file\" id=\"" + r.id + "_file\" />";
		be.style.cssText = "display:block;height:1px;width:1px;overflow:hidden;opacity:0.1;";
		be.className = "filespan";
		r.appendChild(be);
		if (J) {
			if (!W) {
				J.style.display = "none";
				if (C) {
					C.style.display = "none"
				}
			}
			J.setAttribute("itemid", r.id)
		};
		if (a.file && I) {
			I.innerHTML = "待上传"
		};
		if (F) {
			var bf = t.getwenzi("del");
			if (bf != "") {
				F.innerHTML = bf
			};
			F.setAttribute("itemid", r.id)
		};
		if (O != null) {
			O.setAttribute("state", "prev")
		};
		if (P != null) {
			P.setAttribute("state", "next")
		};
		if (S) {
			if (t.opt.ueditor_id) {
				S.innerHTML = "插入"
			}
		};
		if (L) {
			var bg = L.getElementsByTagName("a");
			var bf = t.getwenzi("see");
			if (bf != "") {
				if (bg.length > 0) {
					bg[0].innerHTML = bf
				} else {
					L.innerHTML = bf
				}
			}
		};
		if (D) {
			var bf = t.getwenzi("bar");
			if (bf != "") {
				D.innerHTML = bf
			}
		};
		if (G) {
			var bf = t.getwenzi("fengmian");
			if (bf != "") {
				G.innerHTML = bf
			}
		};
		if (C) {
			var bf = t.getwenzi("baifenbi");
			if (bf != "") {
				C.innerHTML = bf
			}
		};
		if (V) {
			var bf = t.getwenzi("tishi");
			if (bf != "") {
				V.innerHTML = bf
			}
		};
		if (K) {
			var bf = t.getwenzi("bg");
			if (bf != "") {
				K.innerHTML = bf
			}
		}
		if ((typeof(t.opt.item_class) == "undefined" || t.opt.item_class == "") && v == false) {
			if (G) {
				G.style.cssText = g_conf.rel_fengmian.cssText
			};
			if (C) {
				C.style.cssText = g_conf.rel_baifenbi.cssText
			};
			if (D) {
				D.style.cssText = g_conf.rel_bar.cssText
			};
			if (E) {
				E.style.cssText = g_conf.rel_img.cssText
			};
			if (F) {
				F.style.cssText = g_conf.rel_del.cssText
			};
			if (H) {
				H.style.cssText = g_conf.rel_size.cssText
			};
			if (I) {
				I.style.cssText = g_conf.rel_date.cssText
			};
			if (J) {
				J.style.cssText = g_conf.rel_chongxuan.cssText
			};
			if (J && typeof(g_conf.rel_chongxuan.innnerHTML) != "undefined") {
				J.innnerHTML = g_conf.rel_chongxuan.innnerHTML
			};
			if (K) {
				K.style.cssText = g_conf.rel_bg.cssText
			};
			if (L) {
				L.style.cssText = g_conf.rel_see.cssText
			};
			if (M) {
				M.style.cssText = g_conf.rel_name.cssText
			};
			if (N) {
				N.style.cssText = g_conf.rel_chongchuan.cssText
			};
			if (O) {
				O.style.cssText = g_conf.rel_prev.cssText
			};
			if (P) {
				P.style.cssText = g_conf.rel_next.cssText
			};
			if (Q) {
				Q.style.cssText = g_conf.rel_filesize.cssText
			};
			if (R) {
				R.style.cssText = g_conf.rel_down.cssText
			};
			if (S) {
				S.style.cssText = g_conf.rel_insert.cssText
			};
			if (typeof(g_conf.rel_jieping) != "undefined" && U) {
				U.style.cssText = g_conf.rel_jieping.cssText
			};
			t.addClass(r, t.mr_class)
		}
		if (typeof(t.opt.item_class) != "undefined" && t.opt.item_class != "") {
			t.addClass(r, t.opt.item_class)
		}
		if (typeof(a.src) != "undefined") {
			r.setAttribute("small_src", a.small_src);
			r.setAttribute("big_src", a.big_src)
		};
		if (typeof(a.row) != "undefined") {
			t.update_input_value({
				myitem: r,
				row: a.row
			});
			if (typeof(a.row.size) != "undefined") {
				r.setAttribute("mysize", a.row.size)
			}
		};
		var bh = "init";
		if (typeof(a.type) != "undefined") {
			if (a.type == "bt") {
				bh = "bt"
			} else if (a.type == "init") {
				bh = a.type
			} else if (a.type == "success") {
				bh = a.type
			} else {
				bh = a.type
			}
		};
		if (typeof(a.status) != "undefined" && a.status != "") {
			bh = a.status
		};
		if (bh == "bt") {
			r.removeAttribute("myparent");
			r.removeAttribute("mystatus")
		} else if (bh == "first") {
			t.ShowYuanSu({
				myitem: r,
				conf: t.first_show
			})
		} else if (bh == "init" || bh == "dengdai") {
			t.ShowYuanSu({
				myitem: r,
				conf: t.init_show
			})
		} else if (bh == "upload") {
			t.ShowYuanSu({
				myitem: r,
				conf: t.upload_show
			})
		} else if (bh == "success") {
			r.setAttribute("mystatus", bh);
			t.ShowYuanSu({
				myitem: r,
				conf: t.success_show
			});
			t.ResetInput()
		} else {
			t.ShowYuanSu({
				myitem: r,
				conf: t.init_show
			})
		}
		r.setAttribute("mystatus", "init");
		if (bh != "") {
			r.setAttribute("mystatus", bh)
		}
		r.setAttribute("itemid", r.id);
		if (typeof(a.row) != "undefined" && typeof(a.row["isfengmian"]) != "undefined" && a.row["isfengmian"] == 1) {
			var bi = t.GetItemValue(r);
			t.input_fengmian.value = (bi);
			t.SetFengmianStyle({
				myitem: r
			})
		};
		if (typeof(a.style) != "undefined") {
			for (var k in a.style) {
				r.style[k] = a.style[k]
			}
		};
		t.EditInputName(r);
		t.SetChildsAttr(r);
		t.RegChangeEvent(r);
		if (bh == "init" && typeof(t.init_huidiao) != "undefined") {
			t.init_huidiao({
				myitem: r,
				file: a.file
			})
		};
		if (bh == "first") {
			var bj = a.row.src ? a.row.src : "";
			if (t.input_fengmian) {
				if (t.input_fengmian.value.indexOf(bj) != -1) {
					t.SetFengMianInput({
						myitem: r,
						isfirst: true
					})
				}
			};
			t.init_hd({
				item1: r,
				num: t.num
			});
			if (typeof(t.first_huidiao) != "undefined") {
				t.first_huidiao({
					status: "first",
					item1: r,
					myitem: r,
					num: t.num,
					maxnum: t.conf.maxnum,
					row: a.row
				})
			}
			if (typeof(a.row) != "undefined" && typeof(a.row.size) != "undefined") {
				t.NewFileBar({
					myitem: r,
					success_size: a.row.size,
					file_size: a.row.size,
					src: bj,
					type: bh
				})
			} else {
				t.NewFileBar({
					myitem: r,
					success_size: 100,
					file_size: 100,
					src: bj,
					type: bh
				})
			};
			if (typeof(t.complete_huidiao) != "undefined") {
				t.complete_huidiao({
					status: "first",
					item1: r,
					myitem: r,
					num: t.num,
					maxnum: t.conf.maxnum,
					row: a.row
				})
			}
		};
		return r
	},
	addhiddeninput: function(a, b) {
		var t = this;
		var c = document.getElementById(a.id + "_hidden");
		if (c) {
			c.innerHTML = "";
			var d = "";
			if (typeof(t.conf.hiddennametype) != "undefined") {
				d = t.conf.hiddennametype
			};
			if (d != "") {
				var e = a.getAttribute("myrowfields");
				var f = e.split(",");
				for (var i = 0; i < f.length; i++) {
					var g = f[i];
					var h = document.createElement("input");
					if (d == "array") {
						h.name = "hc_" + t.input_id + "_" + g + "[" + (parseInt(a.getAttribute("myindex")) - 1) + "]"
					} else {
						h.name = "hc_" + t.input_id + "_" + g + ""
					};
					h.type = "hidden";
					h.value = a.getAttribute("data-" + g);
					c.appendChild(h)
				}
			}
		}
	},
	getwenzi: function(a, b) {
		var c = "";
		var t = this;
		if (a == "see") {
			if (typeof(t.opt.bt_see_text) != "undefined") {
				c = t.opt.bt_see_text
			}
		};
		if (a == "del") {
			if (typeof(t.opt.bt_del_text) != "undefined") {
				c = t.opt.bt_del_text
			}
		};
		if (typeof(t.opt.wenzi) != "undefined" && typeof(t.opt.wenzi[a]) != "undefined") {
			c = t.opt.wenzi[a]
		};
		if (c == "" && typeof(b) != "undefined") {
			c = b
		};
		return c
	},
	update_input_value: function(a) {
		var t = this;
		if (typeof(a.row) != "undefined") {
			for (k in a.row) {
				t.setAttr(a.myitem, "data-" + k, a.row[k])
			}
		}
		var b = a.myitem.getElementsByTagName("*");
		for (var i = 0; i < b.length; i++) {
			var c = b[i];
			if (typeof(c) != "undefined") {
				var d = c.getAttribute("myname");
				if (c.getAttribute("myfield") && typeof(c.getAttribute("myfield")) != "undefined") {
					d = c.getAttribute("myfield")
				};
				var k = d;
				if (d && typeof(d) != "undefined") {
					var e = "";
					if (typeof(a.row[k]) != "undefined") {
						e = a.row[k]
					}
					if (c.type == "textarea" || c.type == "text" || c.type == "hidden" || c.type == "password" || c.type == "number") {
						c.value = e
					} else if (c.type == "select-one" || c.type == "select") {
						if (c.options.length > 0) {
							for (var j = 0; j < c.options.length; j++) {
								if (c.options[j].value == e) {
									c.selectedIndex = j
								}
							}
						}
					} else if (c.type == "radio" || c.type == "checkbox") {
						var f = String(e).split(",");
						for (var j = 0; j < f.length; j++) {
							if (String(f[j]) == String(c.value)) {
								c.checked = true
							}
						}
					} else {
						if (d == "size") {
							e = t.FormatSize(e)
						}
						c.innerHTML = e
					}
				}
			}
		}
	},
	getwh: function(a) {
		var t = this;
		var w = "80px",
			h = "80px";
		if (typeof(t.opt.width) != "undefined") {
			w = t.opt.width + "px";
			if (String(t.opt.width).indexOf("%") != -1) {
				w = t.opt.width
			}
		}
		if (typeof(t.opt.height) != "undefined") {
			h = t.opt.height + "px";
			if (String(t.opt.height).indexOf("%") != -1) {
				h = t.opt.height
			}
		}
		if (typeof(a) != "undefined") {
			if (typeof(a.width) != "undefined") {
				w = a.width + "px";
				if (String(a.width).indexOf("%") != -1) {
					w = a.width
				}
			}
			if (typeof(a.height) != "undefined") {
				h = a.height + "px";
				if (String(a.height).indexOf("%") != -1) {
					h = a.height
				}
			}
		};
		return {
			width: w,
			height: h
		}
	},
	DownFile: function(a) {
		var t = this;
		var b = a.getAttribute("itemid");
		var c = null;
		var d = t.getobjs(t.panel, b);
		if (d.length > 0) {
			c = d[0]
		}
		var e = c.getAttribute("data-src");
		if (typeof(t.opt.down_url) != "undefined" && typeof(e) != "undefined") {
			window.open(t.opt.down_url + "?path=" + e)
		} else {
			t.myalert("属情data-src不存在")
		}
	},
	getnewsrc: function(a) {
		var b = a,
			t = this;
		if (a.indexOf("http://") > -1 || a.indexOf("https://") > -1) {
			return b
		}
		if (t.result.isfull == 1) {
			b = t.getfullsrc(b)
		} else {
			if (a.length > 0) {
				a = a.replace("https://", "[https]");
				a = a.replace("http://", "[http]");
				a = a.replace("//", "/");
				if (a.indexOf("[http]") > -1 || a.indexOf("[https]") > -1) {
					b = a
				} else if (typeof(t.opt.src_qz) != "undefined") {
					if (a.indexOf(t.opt.src_qz) == 0) {
						b = a
					} else {
						b = t.opt.src_qz + a
					}
				} else {
					b = a
				};
				b = b.replace("[http]", "http://");
				b = b.replace("[https]", "https://")
			}
		};
		return b
	},
	getfullsrc: function(a) {
		var b = a,
			t = this;
		if (b.indexOf("https://") != -1 || b.indexOf("http://") != -1) {
			return a
		};
		if (a.length > 0) {
			a = a.replace("https://", "[https]");
			a = a.replace("http://", "[http]");
			a = a.replace("//", "/");
			if (a.indexOf("[http]") > -1 || a.indexOf("[https]") > -1) {
				b = a
			} else if (a.indexOf("/") == 0) {
				b = t.siteurl_file + a.substr(1, a.length - 1)
			} else {
				b = t.siteurl_file + a
			}
			b = b.replace("[http]", "http://");
			b = b.replace("[https]", "https://")
		};
		return b
	},
	getimgsrc: function(a) {
		var b = a,
			t = this;
		if (typeof(a) == "undefined") {
			return "null"
		};
		var c = a.split(".");
		var d = "";
		if (c.length > 0) {
			d = c[c.length - 1].toLowerCase()
		};
		if (a.toLowerCase().indexOf("https://") != -1 || a.toLowerCase().indexOf("http://") != -1) {
			b = t.GetPngImg(d);
			if (t.IsImg(d)) {
				b = a
			}
		} else {
			var c = a.split(".");
			if (a.indexOf("?") != -1) {
				var e = a.indexOf("?");
				c = e[0].split(".")
			};
			if (c.length > 1) {
				if (!t.IsImg(c[c.length - 1])) {
					if (a.indexOf(t.siteurl_file) != -1) {
						b = a
					} else {
						b = t.GetPngImg(c[c.length - 1])
					}
				} else {
					a = a.replace("https://", "[https]");
					a = a.replace("http://", "[http]");
					a = a.replace("//", "/");
					if (a.indexOf("[http]") > -1 || a.indexOf("[http]") > -1) {
						b = a
					} else if (a.indexOf("/") == 0) {
						b = t.siteurl_file + a.substr(1, a.length - 1)
					} else {
						b = t.siteurl_file + a
					};
					b = b.replace("[http]", "http://");
					b = b.replace("[https]", "https://")
				}
			}
		};
		return b
	},
	RegChangeEvent: function(h) {
		var t = this;
		var j = h.getElementsByTagName("input");
		for (var i = 0; i < j.length; i++) {
			(function(c) {
				if (c.type == "radio" || c.type == "checkbox") {
					t.addEvent(c, "click", function(e) {
						var a = e || window.event;
						var b = c;
						t.update_input({
							obj: b,
							myitem: h
						});
						t.update({
							t: t,
							myitem: h
						});
						if (t.change_huidiao) {
							t.change_huidiao({
								obj: b,
								myitem: h
							})
						};
						if (e && e.stopPropagation) {
							e.stopPropagation()
						} else {
							window.event.cancelBubble = true;
							return false
						}
					})
				} else {
					t.addEvent(c, "change", function(e) {
						var a = e || window.event;
						var b = c;
						t.update_input({
							obj: b,
							myitem: h
						});
						t.update({
							t: t,
							myitem: h
						});
						if (t.change_huidiao) {
							t.change_huidiao({
								obj: b,
								myitem: h
							})
						};
						if (e && e.stopPropagation) {
							e.stopPropagation()
						} else {
							window.event.cancelBubble = true;
							return false
						}
					})
				}
			})(j[i])
		};
		var j = h.getElementsByTagName("select");
		for (var i = 0; i < j.length; i++) {
			(function(c) {
				t.addEvent(c, "change", function(e) {
					var a = e || window.event;
					var b = c;
					t.update_input({
						obj: b,
						myitem: h
					});
					t.update({
						t: t,
						myitem: h
					});
					if (t.change_huidiao) {
						t.change_huidiao({
							obj: b,
							myitem: h
						})
					};
					if (e && e.stopPropagation) {
						e.stopPropagation()
					} else {
						window.event.cancelBubble = true;
						return false
					}
				})
			})(j[i])
		};
		var j = h.getElementsByTagName("textarea");
		for (var i = 0; i < j.length; i++) {
			(function(c) {
				t.addEvent(c, "change", function(e) {
					var a = e || window.event;
					var b = c;
					t.update_input({
						obj: b,
						myitem: h
					});
					t.update({
						t: t,
						myitem: h
					});
					if (t.change_huidiao) {
						t.change_huidiao({
							obj: b,
							myitem: h
						})
					};
					if (e && e.stopPropagation) {
						e.stopPropagation()
					} else {
						window.event.cancelBubble = true;
						return false
					}
				})
			})(j[i])
		}
		t.addEvent(h, "mouseover", function(e) {
			var a = e || window.event;
			var b = a.srcElement || a.target;
			t.ShowYuanSu({
				myitem: h,
				conf: t.hover_show
			})
		});
		t.addEvent(h, "mouseout", function(e) {
			var a = e || window.event;
			var b = h;
			var c = {};
			for (var k in t.hover_show) {
				if (t.hover_show[k] == 1) {
					c[k] = 0
				} else {
					c[k] = 1
				}
			}
			if (b.getAttribute("mystatus") == "first") {
				t.ShowYuanSu({
					myitem: b,
					conf: t.first_show
				})
			} else if (b.getAttribute("mystatus") == "init") {
				t.ShowYuanSu({
					myitem: b,
					conf: t.init_show
				})
			} else if (b.getAttribute("mystatus") == "upload") {
				t.ShowYuanSu({
					myitem: b,
					conf: t.upload_show
				})
			} else if (b.getAttribute("mystatus") == "success") {
				t.ShowYuanSu({
					myitem: b,
					conf: t.success_show
				})
			} else if (b.getAttribute("mystatus") == "error") {
				t.ShowYuanSu({
					myitem: b,
					conf: t.error_show
				})
			} else {
				t.ShowYuanSu({
					myitem: b,
					conf: c
				})
			}
		});
		t.addEvent(h, "mousedown,touchstart", function(e) {
			var a = (e || window.event);
			var b = h;
			t.start_time = (new Date()).getTime();
			b.getAttribute("start_time", (new Date()).getTime())
		});
		t.addEvent(h, "mouseup,touchend", function(e) {
			var o = this;
			var a = (e || window.event);
			t.end_time = (new Date()).getTime();
			window.setTimeout(function() {
				h.removeAttribute("start_time")
			}, 500)
		});
		var l = t.GetObjByClass(h, "rel_fengmian");
		if (l) {
			t.addEvent(l, "click", function(e) {
				var a = (e || window.event);
				var b = l;
				t.SetFengMianInput({
					obj: b
				});
				if (e && e.stopPropagation) {
					e.stopPropagation()
				} else {
					window.event.cancelBubble = true;
					return false
				}
			});
			var m = t.GetObjByClass(h, "rel_see");
			var n = l.getElementsByTagName("input");
			if (n.length > 0 && n[0].type == "radio") {
				t.addEvent(n[0], "click", function(e) {
					t.SetFengMianInput({
						obj: l
					});
					if (e && e.stopPropagation) {
						e.stopPropagation()
					} else {
						window.event.cancelBubble = true;
						return false
					}
				})
			}
			t.addEvent(l, "touchend,mouseout", function(e) {
				if (e && e.stopPropagation) {
					e.stopPropagation()
				} else {
					window.event.cancelBubble = true;
					return false
				}
			})
		};
		var m = t.GetObjByClass(h, "rel_see");
		if (m) {
			var p = m.getElementsByTagName("a");
			if (p.length == 0) {
				t.addEvent(m, "click", function(e) {
					var a = (e || window.event);
					var b = m;
					t.ShowBig(b);
					if (e && e.stopPropagation) {
						e.stopPropagation()
					} else {
						window.event.cancelBubble = true;
						return false
					}
				})
			}
		};
		var q = t.GetObjByClass(h, "rel_down");
		if (q) {
			t.addEvent(q, "click", function(e) {
				var a = (e || window.event);
				var b = a.srcElement || a.target;
				var b = q;
				if (typeof(t.down_click) != "undefined") {
					t.down_click(b)
				} else {
					t.DownFile(b)
				}
				if (e && e.stopPropagation) {
					e.stopPropagation()
				} else {
					window.event.cancelBubble = true;
					return false
				}
			})
		};
		var r = t.GetObjByClass(h, "rel_del");
		if (r) {
			t.addEvent(r, "click", function(e) {
				var a = (e || window.event);
				var b = r;
				t.removeItem(b);
				if (e && e.stopPropagation) {
					e.stopPropagation()
				} else {
					window.event.cancelBubble = true;
					return false
				}
			})
		};
		var s = t.GetObjByClass(h, "rel_prev");
		if (s) {
			t.addEvent(s, "click", function(e) {
				var a = (e || window.event);
				var b = s;
				t.PaiXu(b);
				if (e && e.stopPropagation) {
					e.stopPropagation()
				} else {
					window.event.cancelBubble = true;
					return false
				}
			})
		}
		var u = t.GetObjByClass(h, "rel_next");
		if (u) {
			t.addEvent(u, "click", function(e) {
				var a = (e || window.event);
				var b = a.srcElement || a.target;
				t.PaiXu(b);
				if (e && e.stopPropagation) {
					e.stopPropagation()
				} else {
					window.event.cancelBubble = true;
					return false
				}
			})
		};
		var v = t.GetObjByClass(h, "rel_insert");
		if (v) {
			t.addEvent(v, "click", function(e) {
				var a = (e || window.event);
				var b = a.srcElement || a.target;
				var c = h,
					src = c.getAttribute("data-src");
				var d = t.getbigsrc(t.getnewsrc(src));
				var f = t.getfullsrc(d);
				if (typeof(t.insert_huidiao) != "undefined") {
					t.insert_huidiao({
						myitem: h,
						fullbigsrc: f,
						bigsrc: d
					})
				} else {
					if (typeof(UE) != "undefined" && UE && UE.getEditor(t.opt.ueditor_id)) {
						UE.getEditor(t.opt.ueditor_id).focus();
						UE.getEditor(t.opt.ueditor_id).execCommand('insertHtml', '<img src="' + f + '"/>')
					} else {
						var g = document.getElementById(t.opt.ueditor_id);
						if (g) {
							InputInsertHtml(g, '<img src="' + f + '"/>')
						}
					}
				}
			})
		};
		var w = t.GetObjByClass(h, "rel_chongchuan");
		if (w) {
			t.addEvent(w, "click", function(e) {
				var a = (e || window.event);
				var b = w;
				t.selectonefile({
					itemid: b.getAttribute("itemid")
				});
				if (e && e.stopPropagation) {
					e.stopPropagation()
				} else {
					window.event.cancelBubble = true;
					return false
				}
			})
		};
		var x = t.GetObjByClass(h, "rel_chongxuan");
		if (x) {
			t.addEvent(x, "click", function(e) {
				var a = (e || window.event);
				var b = x;
				t.selectonefile({
					itemid: b.getAttribute("itemid")
				});
				if (e && e.stopPropagation) {
					e.stopPropagation()
				} else {
					window.event.cancelBubble = true;
					return false
				}
			})
		};
		var y = t.GetObjByClass(h, "rel_jieping");
		if (y) {
			if (typeof(t.click_jieping) != "undefined") {
				t.addEvent(y, "click", function(e) {
					var a = (e || window.event);
					t.click_jieping({
						myitem: h,
						itemid: this.getAttribute("itemid")
					});
					if (e && e.stopPropagation) {
						e.stopPropagation()
					} else {
						window.event.cancelBubble = true;
						return false
					}
				})
			}
		};
		var z = t.GetObjByClass(h, "rel_img");
		if (z) {
			var A = z.getElementsByTagName("img");
			var B = 0;
			var C = 0;
			var D = null;
			var E = 0;
			var F = 0;
			if (A.length > 0 && h.getAttribute("other_type") != "bt") {
				var G = A[0];
				t.addEvent(G, "mousedown", function(e) {
					var a = (e || window.event);
					var b = a.srcElement || a.target;
					C++;
					E = (new Date()).getTime()
				});
				t.addEvent(G, "mouseup,touchstart", function(e) {
					var a = (e || window.event);
					var b = a.srcElement || a.target;
					window.clearTimeout(D);
					F = (new Date()).getTime();
					var c = F - t.start_time;
					t.log("cz:" + c + ",num:" + C);
					var d = b;
					if (c < 300) {
						D = window.setTimeout(function() {
							if (C > 1) {
								if (typeof(t.opt.img_dblclick) != "undefined") {
									t.opt.img_dblclick({
										obj: d,
										e: e,
										myitem: h,
										item1: h,
										parent: h.parentNode
									})
								}
								C = 0
							} else if (C == 1 || C == 0) {
								if (typeof(t.opt.img_click) != "undefined") {
									t.opt.img_click({
										obj: d,
										e: e,
										myitem: h,
										item1: h,
										parent: h.parentNode
									})
								} else {
									t.ShowBig(d)
								};
								t.log("img_click");
								C = 0
							}
						}, 120)
					}
				})
			}
		};
		t.start_time = (new Date()).getTime()
	},
	update_input: function(a) {
		var t = this;
		var b = a.obj;
		var c = b.getAttribute("myname");
		if (b.getAttribute("myfield") && typeof(b.getAttribute("myfield")) != "undefined") {
			c = b.getAttribute("myfield")
		};
		var k = c;
		var d = "";
		if (c && typeof(c) != "undefined") {
			if (b.type == "textarea" || b.type == "text" || b.type == "hidden" || b.type == "password" || b.type == "number") {
				d = b.value
			};
			if (b.type == "select-one" || b.type == "select") {
				if (b.options.length > 0) {
					d = b.options[b.selectedIndex].value
				}
			};
			if (b.type == "radio" || b.type == "checkbox") {
				var e = document.getElementsByName(b.name);
				for (var j = 0; j < e.length; j++) {
					if (e[j].checked) {
						if (d != "") {
							d += "," + e[j].value
						} else {
							d += e[j].value
						}
					}
				}
			};
			a.myitem.setAttribute("data-" + k, d)
		}
		t.ResetInput()
	},
	addEvent: function(c, d, e) {
		var f = d.split(",");
		var t = this;
		for (var i = 0; i < f.length; i++) {
			(function(a) {
				if (a != "") {
					var b = e;
					if (c.addEventListener) {
						c.addEventListener(a, e, false)
					} else if (c.attachEvent) {
						c["e" + a + e] = e;
						c.attachEvent("on" + a, e)
					} else {
						c['on' + a] = e
					};
					t.addEventList(c, a, e)
				}
			})(f[i])
		}
	},
	removeEvent: function(a, b, c) {
		if (a.removeEventListener) {
			a.removeEventListener(b, c, false)
		} else if (a.detachEvent) {
			a.detachEvent("on" + b, c);
			a["e" + b + c] = null
		} else {
			a['on' + typ] = null
		}
		this.removeEventList(a, b, c)
	},
	addEventList: function(a, b, c) {
		if (a.eventList) {
			if (a.eventList[b]) {
				a.eventList[b].push({
					type: b,
					handler: c
				})
			} else {
				a.eventList[b] = [{
					type: b,
					handler: c
				}]
			}
		} else {
			a.eventList = {};
			a.eventList[b] = [{
				type: b,
				handler: c
			}]
		}
	},
	removeEventList: function(a, b, c) {
		var d = a.eventList;
		if (d) {
			if (d[b]) {
				for (var i = 0; i < d[b].length; i++) {
					if (d[b][i].handler === c) {
						d[b].splice(i, 1);
						if (d[b].length === 0) {
							delete d[b]
						}
						break
					}
				}
			}
		}
	},
	ShowYuanSu: function(a) {
		var t = this;
		myitem = a.myitem;
		var b = a.conf;
		var n = 0;
		for (var k in b) {
			n++
		};
		if (n > 0) {
			for (var k in b) {
				var c = myitem.getElementsByTagName("*");
				var d = t.GetObjsByClass(myitem, String(k) + " " + String("rel_" + k));
				if (d.length > 0) {
					for (var j = 0; j < d.length; j++) {
						var e = d[j];
						if (e) {
							if (b[k] == 1) {
								e.style.display = ""
							} else {
								e.style.display = "none"
							}
						}
					}
				}
			}
		};
		t.childs = t.getchilds()
	},
	SetChildsAttr: function(a) {
		var b = a.getElementsByTagName("*");
		for (var k in b) {
			if (b[k].setAttribute) {
				b[k].setAttribute("itemid", a.id)
			}
		}
	},
	SetFengMianInput: function(c) {
		var t = this;
		var d = null;
		if (!t.input_fengmian) {
			return false
		}
		if (typeof(c) != "undefined") {
			if (typeof(c.myitem) != "undefined") {
				d = c.myitem
			} else {
				d = t.getobj(c.obj.getAttribute("itemid"))
			}
		};
		if (!d) {
			if (t.childs.length > 0) {
				d = t.childs[0]
			}
		};
		var e = false;
		var f = function(a) {
				var b = t.GetItemValue(a);
				t.input_fengmian.value = (b);
				if (typeof(c) != "undefined") {
					if (typeof(c.isfirst) == "undefined" || c.isfirst == false) {
						if (typeof(t.fengmian_huidiao) != "undefined") {
							t.fengmian_huidiao({
								"myitem": a,
								item1: a
							})
						}
					}
				}
				t.SetFengmianStyle({
					myitem: a
				})
			};
		if (typeof(c) != "undefined" && d) {
			f(d);
			return false
		} else {
			var g = t.input_fengmian.value;
			if (g != "") {
				for (var i = 0; i < t.childs.length; i++) {
					if (g.indexOf(t.childs[i].getAttribute("data-src")) != -1) {
						t.SetFengmianStyle({
							myitem: t.childs[i]
						});
						e = true
					}
				}
			};
			if (e == false && d && t.input_fengmian.value == "") {
				f(d)
			}
		}
	},
	SetFengmianStyle: function(c) {
		var t = this;
		var d = null;
		if (c.myitem) {
			d = c.myitem
		} else {
			d = t.getobj(c.obj.getAttribute("itemid"))
		};
		var e = t.getchilds();
		var f = function(a) {
				var b = a.getElementsByTagName("input");
				if (b.length > 0 && b[0].type == "radio") {
					b[0].checked = true
				}
			};
		for (var j = 0; j < e.length; j++) {
			var g = t.GetObjByClass(e[j], "rel_fengmian");
			if (e[j].id != d.id) {
				if (typeof(t.opt.item_class) == "undefined" || t.opt.item_class == "") {
					e[j].style.borderColor = g_conf.rel.bordercolor;
					if (g) {
						g.style.color = g_conf.fengmian.color;
						g.style.backgroundColor = g_conf.fengmian.bgcolor
					}
				} else {
					t.removeClass(e[j], t.itemhoverclass);
					if (g) {
						g.className = "rel_fengmian"
					}
				}
			} else {
				if (typeof(t.opt.item_class) == "undefined" || t.opt.item_class == "") {
					e[j].style.borderColor = g_conf.rel.bordercolor1;
					if (g) {
						g.style.color = g_conf.fengmian.color1;
						g.style.backgroundColor = g_conf.fengmian.bgcolor1;
						f(g)
					}
				} else {
					if (g) {
						g.className = "rel_fengmian fengmian_hover";
						f(g)
					}
					t.addClass(d, t.itemhoverclass)
				}
			}
		}
	},
	my_encodeURI: function(a) {
		var t = this;
		if (t.conf.isbianma == 1) {
			return encodeURIComponent(a)
		} else {
			return (a)
		}
	},
	ObjStyle: function(a) {
		var b = a.className,
			t = this;
		var c = b.split("_");
		if (c.length > 1) {
			var d = c[1];
			if (typeof(t.opt.btstyle) != "undefined") {
				if (typeof(t.opt.btstyle[d]) != "undefined") {
					var e = t.opt.btstyle[d];
					a.style.top = "auto";
					a.style.left = "auto";
					a.style.bottom = "auto";
					a.style.bottom = "auto";
					for (var k in e) {
						if (k == "class") {
							t.addClass(a, e[k])
						} else {
							a.style[k] = e[k]
						}
					}
				}
			}
		}
	},
	update_before: function(a) {},
	update: function(e) {
		var t = this;
		var f = e.myitem;
		var g = t.opt.url;
		var h = f.getAttribute("mystatus");
		if (typeof(h) != "undefined" && h) {
			if (h == "dengdai" || h == "upload") {
				return false
			}
		};
		var i = t.update_before({
			itemid: f.id
		});
		if (typeof(i) != "undefined" && i == false) {
			return false
		};
		var j = {};
		for (var k in f.attributes) {
			for (var l in f.attributes[k]) {
				if (l == "name") {
					var m = String(f.attributes[k][l]);
					var n = m.split("data-");
					if (n.length > 1) {
						j[m] = String(f.attributes[k]["value"])
					}
				}
			}
		};
		var o = 0;
		var p = t.get_type_objs(f);
		for (var k in p) {
			var q = p[k][0];
			if (q.type == "textarea" || q.type == "text" || q.type == "hidden" || q.type == "password" || q.type == "number") {
				if (q.name.indexOf("hcfile") == -1) {
					j[q.getAttribute("myfield")] = q.value;
					o++
				}
			};
			if (q.type == "select-one" || q.type == "select") {
				if (q.options.length > 0) {
					j[q.getAttribute("myfield")] = q.options[q.selectedIndex].value;
					o++
				}
			};
			if (q.type == "radio" || q.type == "checkbox") {
				var r = "";
				for (var s in p[k]) {
					if (p[k][s].checked) {
						if (r != "") {
							r += "," + p[k][s].value
						} else {
							r = p[k][s].value
						}
					}
				};
				j[q.getAttribute("myfield")] = r;
				o++
			}
		};
		if (typeof(t.update_huidiao) != "undefined") {
			t.update_huidiao({
				myitem: f,
				data: j
			});
			return false
		}
		if (typeof(t.opt.update_url) != "undefined") {
			g = t.opt.update_url
		} else {
			return false
		};
		t.log("num", o);
		if (o == 0) {
			return false
		};
		t.ajax({
			url: g,
			type: "post",
			dataType: "html",
			data: j,
			success: function(a) {
				try {
					for (var k in f.attributes) {
						var b = String(f.attributes[k].name);
						if (b.indexOf("data-") != -1) {
							var c = b.split("data-");
							if (c.length > 1 && typeof(j[c[1]]) != "undefined") {
								f.setAttribute(b, j[c[1]])
							}
						}
					};
					var d = eval("(" + a + ")");
					if (typeof(d["row"]) != "undefined") {
						for (var k in d["row"]) {
							f.setAttribute("data-" + k, d["row"][k])
						}
					}
					t.ResetInput();
					if (typeof(t.update_success) != "undefined") {
						t.update_success({
							myitem: f,
							result: a
						})
					}
				} catch (err) {
					if (typeof(t.update_success) != "undefined") {
						t.update_success({
							myitem: f,
							result: a
						})
					}
					console.log("this.update error:", err.message)
				}
			}
		})
	},
	del_before: function(a) {},
	del: function(f) {
		var t = this,
			myitem = f.myitem;
		var g = myitem.id;
		var h = "";
		if (typeof(t.opt.url) != "undefined") {
			h = t.opt.url
		}
		if (typeof(t.opt.del_url) != "undefined") {
			h = t.opt.del_url
		} else {
			var i = h.split("?");
			h = i[0] + "?act=del";
			if (typeof(t.opt.url) == "undefined") {
				h = ""
			}
		};
		var j = function(d, e) {
				t.ajax({
					url: d,
					type: "post",
					dataType: "html",
					data: e,
					success: function(a) {
						if (typeof(t.delete_success_huidiao) != "undefined") {
							t.delete_success_huidiao({
								myitem: f.myitem,
								item1: f.item1,
								num: f.num,
								maxnum: t.conf.maxnum,
								itemid: g,
								result: a
							})
						}
					},
					error: function(a, b, c) {}
				})
			};
		if (typeof(t.del_items) == "undefined") {
			t.del_items = []
		};
		var l = {};
		for (var k in t.input_format) {
			l[k] = myitem.getAttribute("data-" + k)
		};
		t.del_items.push(l);
		if (typeof(t.posts_del) == "undefined") {
			t.posts_del = {}
		};
		var m = t.GetItemData(myitem);
		m["isdelfile"] = t.conf.isdelfile;
		t.posts_del[myitem.id] = m;
		var n = true;
		if (typeof(t.delete_defore) != "undefined") {
			var b = t.delete_defore({
				myitem: f.myitem,
				item1: f.item1,
				num: f.num,
				maxnum: t.conf.maxnum,
				itemid: g
			});
			if (typeof(b) != "undefined") {
				n = b
			}
		};
		if (n) {
			if (typeof(h) != "undefined" && h != "") {
				j(h, t.posts_del[myitem.id])
			} else {
				if (typeof(t.delete_success_huidiao) != "undefined") {
					t.delete_success_huidiao({
						myitem: f.myitem,
						item1: f.item1,
						num: f.num,
						maxnum: t.conf.maxnum,
						itemid: g
					})
				}
			}
		}
	},
	GetItemData: function(a) {
		var b = {};
		for (var k in a.attributes) {
			var c = String(k);
			if (typeof(a.attributes[k]) == "object" && a.attributes[k].name != null) {
				c = String(a.attributes[k].name)
			}
			if (c.indexOf("data-") == 0) {
				var d = c.split("data-");
				if (d.length > 1) {
					b[d[1]] = String(a.attributes[k].value)
				}
			}
		};
		return b
	},
	get_type_objs: function(a) {
		var b = a.getElementsByTagName("*");
		var c = new Array();
		for (var i = 0; i < b.length; i++) {
			var d = b[i];
			if (typeof(d.name) != "undefined" && d.name != null && typeof(d.type) != "undefined") {
				var e = d.name;
				if (d.type == "textarea" || d.type == "text" || d.type == "hidden" || d.type == "select" || d.type == "select-one" || d.type == "password" || d.type == "number" || d.type == "radio" || d.type == "checkbox") {
					if (typeof(c[e]) == "undefined") {
						c[e] = new Array()
					}
					c[e].push(d)
				}
			}
		};
		return c
	},
	getbynames: function(a, b) {
		var c = a.getElementsByTagName("*");
		var d = new Array();
		var e = 0;
		for (var i = 0; i < c.length; i++) {
			var f = c[i];
			if (typeof(f.name) != "undefined" && f.name != null && typeof(f.type) != "undefined") {
				var g = f.name;
				if (typeof(b) == "undefined" || g == b) {
					d.push(f);
					e++
				}
			}
		};
		return d
	},
	update_type_objs_name: function(a) {
		var b = a.getElementsByTagName("*");
		var c = new Array();
		var d = 0;
		for (var i = 0; i < b.length; i++) {
			var e = b[i];
			if (typeof(e.name) != "undefined" && e.name != null && typeof(e.type) != "undefined") {
				var f = e.name;
				if (e.type == "radio" || e.type == "checkbox") {
					e.name = e.name + a.id
				}
				if (typeof(c[f]) == "undefined") {
					c[f] = new Array()
				}
				c[f].push(e);
				d++
			}
		};
		return {
			length: d,
			objs: c
		}
	},
	EditInputName: function(a) {
		var t = this;
		var b = t.panel.childNodes;
		if (typeof(opt) != "undefined" && typeof(a) != "undefined") {
			b = Array();
			b.push(a)
		}
		if (typeof(t.divindexa) == "undefined") {
			t.divindexa = 0
		} else {
			t.divindexa++
		};
		var c = 0;
		for (var j = 0; j < b.length; j++) {
			if (typeof(b[j].id) != "undefined" && b[j].id.indexOf("item_") != -1) {
				var d = b[j].getElementsByTagName("*");
				for (var i = 0; i < d.length; i++) {
					if (d[i].getAttribute("myname") && typeof(d[i].getAttribute("myname")) != "undefined") {
						d[i].setAttribute("myfield", d[i].getAttribute("myname"));
						if (typeof(t.opt.inputnameqz) == "undefined" || t.opt.inputnameqz == "2") {
							d[i].name = d[i].getAttribute("myfield") + "[" + c + "]"
						} else if (t.opt.inputnameqz == "1") {
							d[i].name = d[i].getAttribute("myfield") + "_" + c
						} else {
							d[i].name = t.opt.inputnameqz + "[" + c + "][" + d[i].getAttribute("myfield") + "]"
						}
					}
					if (d[i].getAttribute("myfield") && typeof(d[i].getAttribute("myfield")) != "undefined") {
						if (typeof(t.opt.inputnameqz) == "undefined" || t.opt.inputnameqz == "2") {
							d[i].name = d[i].getAttribute("myfield") + "[" + c + "]"
						} else if (t.opt.inputnameqz == "1") {
							d[i].name = d[i].getAttribute("myfield") + "_" + c
						} else {
							d[i].name = t.opt.inputnameqz + "[" + c + "][" + d[i].getAttribute("myfield") + "]"
						}
					}
				}
				c++
			}
		};
		t.ShowItemNum(c)
	},
	GetParentItem: function(a) {
		var b = a;
		while (b) {
			var c = b.getAttribute("myparent");
			if (typeof(c) != "undefined" && c == "hcitem") {
				return b
			}
			b = b.parentNode
		};
		return null
	},
	addClass: function(a, b) {
		if (a.className != null && typeof(a.className) != "undefined") {
			var c = a.className,
				arr = c.split(" "),
				newcla = '';
			for (var i = 0; i < arr.length; i++) {
				if (arr[i] != b) {
					if (newcla != "") {
						newcla += " " + arr[i]
					} else {
						newcla = arr[i]
					}
				}
			};
			newcla = (newcla == "" ? b : newcla + " " + b);
			a.className = newcla
		} else {
			a.className = b
		}
	},
	hasClass: function(a, b) {
		var c = a.className,
			newval = "",
			isbool = false;
		if (c && typeof(c) != "undefined") {
			var d = c.split(" ");
			for (var i = 0; i < d.length; i++) {
				if (String(d[i]) == String(b)) {
					isbool = true
				}
			}
		};
		return isbool
	},
	removeClass: function(a, b) {
		if (a.className != null && typeof(a.className) != "undefined") {
			var c = a.className,
				arr = c.split(" "),
				newcla = '';
			for (var i = 0; i < arr.length; i++) {
				if (arr[i] != b) {
					if (newcla != "") {
						newcla += " " + arr[i]
					} else {
						newcla = arr[i]
					}
				}
			}
			if (newcla == "") {
				a.removeAttribute("class")
			} else {
				a.className = newcla
			}
		}
	},
	ShowItemNum: function(n) {
		var t = this;
		if (typeof(t.opt.item_num_id) != "undefined") {
			var a = document.getElementById(t.opt.item_num_id);
			if (a && typeof(a.value) != "undefined") {
				a.value = n
			}
			if (a && typeof(a.innerHTML) != "undefined") {
				a.innerHTML = n
			}
		}
	},
	removeItem: function(a, b) {
		var t = this;
		var c = a.getAttribute("itemid");
		var d = t.getobj(c);
		var e = d.getAttribute("src");
		var f = d.getAttribute("start_time");
		t.log("start_time:" + f);
		var g = false;
		if ((typeof(f) != "undefined" && parseInt((new Date()).getTime()) - parseInt(f) <= 500) || typeof(f) == "undefined" || f == null) {
			if (typeof(t.delete_before) != "undefined") {
				if (b != 1) {
					var h = t.delete_before({
						type: "del_before",
						item1: d,
						"myitem": d
					});
					if (typeof(h) != "undefined" && h == false) {
						return false
					}
				}
			};
			if (typeof(t.files[c]) != "undefined") {
				if (typeof(hc_cookie) != "undefined") {
					hc_cookie.Del(t.files[c].name)
				}
			};
			if (b != 1) {
				if (d) {
					t.num = t.childs.length - 1
				}
				if (t.opt.isbt == 1) {
					t.del({
						type: "del",
						t: t,
						maxnum: t.conf.maxnum,
						num: t.num,
						myitem: d,
						item1: d
					});
					g = true
				} else {
					if (typeof(t.delete_huidiao) != "undefined") {
						t.delete_huidiao({
							myitem: d,
							item1: d,
							num: t.num,
							maxnum: t.conf.maxnum
						});
						g = false
					} else {
						t.del({
							type: "del",
							t: t,
							maxnum: t.conf.maxnum,
							num: t.num,
							myitem: d,
							item1: d
						});
						g = true
					}
				}
			};
			if (t.opt.isbt == 1 && typeof(t.opt.bgsrc) != "undefined") {
				var i = t.GetObjByClass(d, "rel_img");
				if (i) {
					var j = i.getElementsByTagName("img");
					if (j.length > 0) {
						j[0].src = t.opt.bgsrc
					}
				}
				d.setAttribute("data-src", "");
				d.setAttribute("small_src", "");
				d.setAttribute("big_src", "");
				a.style.display = "none"
			} else {
				if (typeof(t.isRemoveItem) != "undefined" && t.isRemoveItem == false) {} else {
					if (g) {
						d.parentNode.removeChild(d)
					}
				}
			};
			t.removeFile(c);
			t.ResetItemsInput(c)
		}
	},
	RemoveItem: function(a) {
		var t = this;
		var b = t.getobj(a);
		t.ResetItemsInput(a);
		if (b) {
			var c = b.getAttribute("src");
			b.parentNode.removeChild(b)
		}
		t.removeFile(a);
		t.EditInputName()
	},
	ResetItemsInput: function(a) {
		var t = this;
		t.childs = t.getchilds();
		t.num = t.childs.length;
		if (t.num < 0) {
			t.num = 0
		};
		t.SetFengMianInput();
		t.showstatus({
			num: t.num
		});
		t.ShowTotalFileSize();
		t.ResetInput();
		if (typeof(a) != "") {
			var b = t.getobj(a);
			if (b) {
				var c = b.getAttribute("src");
				t.ResetEditor(c)
			}
		}
	},
	ResetEditor: function(a) {
		var t = this;
		var b = t.getbigsrc(a);
		if (typeof(t.opt.ueditor_id) != "undefined" && UE && UE.getEditor(t.opt.ueditor_id)) {
			var c = document.createElement("div");
			c.innerHTML = UE.getEditor(t.opt.ueditor_id).getContent();
			var d = c.getElementsByTagName("img");
			for (var i = 0; i < d.length; i++) {
				var e = d[i];
				if (e.src == (t.siteurl_file + b)) {
					var f = e;
					f.parentNode.removeChild(f)
				}
			}
			UE.getEditor(t.opt.ueditor_id).setContent(c.innerHTML)
		}
	},
	removeFile: function(a) {
		var b = false,
			t = this;
		var c = [];
		for (key in t.files) {
			if (key != a) {
				c[key] = t.files[key]
			} else {
				b = true
			}
		}
		t.files = c;
		t.log("files", t.files);
		return b
	},
	Alert: function(a, b) {
		var t = this;
		if (typeof(layer) != "undefined") {
			layer.msg(a)
		} else {
			var c = t.append(t.body, "<div class=\"hctishi\" style=\"" + g_conf.tishi.cssText + "\">" + a + "</div>")[0];
			if (typeof(b) != "undefined" && typeof(b.css) != "undefined") {
				t.css(c, b.css)
			}
			window.setTimeout(function() {
				c.parentNode.removeChild(c);
				c = null
			}, 2000)
		}
	},
	append: function(p, a) {
		var b = new Array();
		if (typeof(a) == "string") {
			var c = document.createElement("div");
			c.style.display = "none";
			c.innerHTML = a;
			for (var i = 0; i < c.childNodes.length; i++) {
				var d = c.childNodes[i].cloneNode(true);
				p.appendChild(d);
				b.push(d)
			}
			c = null
		} else {
			p.appendChild(a);
			b.push(a)
		}
		return b
	},
	css: function(a, b) {
		for (var k in b) {
			a.style[k] = b[k]
		}
	},
	init_add_null: function() {
		var t = this;
		if (typeof(t.opt.nullstr) != "undefined" && t.opt.nullstr != "" && t.panel && t.objnull == null) {
			if (t.panel.tagName == "TR") {
				t.objnull = t.panel.insertCell();
				t.objnull.style.width = t.panel.parentNode.parentNode.parentNode.offsetWidth + "px";
				t.objnull.innerHTML = t.opt.nullstr;
				t.reg_select_click(t.objnull)
			} else {
				t.tmpitem = document.createElement("div");
				t.tmpitem.style.display = "none";
				t.tmpitem.id = "tmpitem";
				t.tmpitem.innerHTML = t.opt.nullstr;
				if (t.tmpitem.childNodes.length > 0) {
					t.objnull = t.tmpitem.childNodes[0].cloneNode(true);
					if (typeof(t.objnull.className) != "undefined" && t.objnull.className != "") {
						t.objnull.className = t.objnull.className + " hcnull_tishi"
					} else {
						t.objnull.className = "hcnull_tishi"
					};
					if (t.clearfloat) {
						t.clearfloat.parentNode.insertBefore(t.objnull, t.clearfloat)
					} else {
						t.panel.appendChild(t.objnull)
					};
					t.reg_select_click(t.objnull)
				}
			}
		}
	},
	ShowTotalFileSize: function() {
		var t = this,
			status;
		var a = "";
		var b = t.gettotalinfo();
		if (t.obj_totalsize != null) {
			t.set_obj_value(t.obj_totalsize, t.FormatSize(b.totalsize))
		}
		if (t.obj_totaluploadsize != null) {
			t.set_obj_value(t.obj_totaluploadsize, t.FormatSize(b.totaluploadsize))
		}
		if (t.obj_totalsuccesssize != null) {
			t.set_obj_value(t.obj_totalsuccesssize, t.FormatSize(b.totalsuccesssize))
		}
		if (t.obj_totaldengdaisize != null) {
			t.set_obj_value(t.obj_totaldengdaisize, t.FormatSize(b.totaldengdaisize))
		}
		if (t.obj_totalbarsize != null) {
			t.set_obj_value(t.obj_totalbarsize, t.FormatSize(b.totalbarsize))
		}
		if (t.obj_totalnum != null) {
			t.set_obj_value(t.obj_totalnum, b.totalnum)
		};
		if (t.obj_totaluploadnum != null) {
			t.set_obj_value(t.obj_totaluploadnum, b.totaluploadnum)
		};
		if (t.obj_totalsuccessnum != null) {
			t.set_obj_value(t.obj_totalsuccessnum, b.totalsuccessnum)
		};
		if (t.obj_totaldengdainum != null) {
			t.set_obj_value(t.obj_totaldengdainum, b.totaldengdainum)
		};
		if (t.obj_totalbarnum != null) {
			t.set_obj_value(t.obj_totalbarnum, b.totalbarnum)
		};
		t.totaldetail = b;
		var c = '共<span class="totalnum">' + b.totalnum + '</span>件（<span class="totalsize">' + t.FormatSize(b.totalsize) + '</span>），已上传<class="totalsuccessnum">' + b.totalsuccessnum + '</span>件';
		c += '，本次选中<span class="totaldengdainum">' + b.totaldengdainum + '</span>张图片，共<spanclass="totaldengdaisize">' + t.FormatSize(b.totaldengdaisize) + '</span>。';
		if (t.objinfo) {
			t.set_obj_value(objinfo, c)
		};
		var n = t.FormatBaiFenBi(b.totalbarsize, b.totalbarsize_z);
		t.totaldetail.totalbaifenbi = n;
		if (t.obj_totalbar != null) {
			t.setCss(t.obj_totalbar, {
				width: n + "%"
			})
		}
		if (t.obj_totalbarbaifenbi != null) {
			t.set_obj_value(t.obj_totalbarbaifenbi, n + "%")
		}
		if (t.obj_select_num) {
			t.set_obj_value(t.obj_select_num, b.totaldengdainum)
		}
		if (t.obj_success_num) {
			t.set_obj_value(t.obj_success_num, b.totalsuccessnum)
		};
		return b
	},
	gettotalinfo: function() {
		var t = this;
		var t = this,
			totalsize = 0,
			totaluploadsize = 0,
			totalsuccesssize = 0,
			totaldengdaisize = 0,
			totalbarsize = 0,
			totalnum = 0,
			totaluploadnum = 0,
			totalsuccessnum = 0,
			totaldengdainum = 0,
			totalbarnum = 0,
			f;
		var a = 0;
		var b = 0;
		var c = "";
		for (var i = 0; i < t.bar_ids.length; i++) {
			var d = document.getElementById(t.bar_ids[i]);
			if (d) {
				var e = 0;
				var f = d.getAttribute("mystatus");
				if (typeof(d.getAttribute("mysize")) != "undefined" && d.getAttribute("mysize") != null) {
					e = parseInt(d.getAttribute("mysize"))
				};
				if (f != null && typeof(f) != "undefined" && f != "init" && f != "error") {
					a++;
					b += parseInt(e)
				};
				var g = 0;
				if (typeof(d.getAttribute("myuploadsize")) != "undefined" && d.getAttribute("myuploadsize") != null) {
					g = parseInt(d.getAttribute("myuploadsize"))
				};
				totalbarsize += parseInt(g)
			}
		};
		for (var i = 0; i < t.childs.length; i++) {
			var d = t.childs[i];
			if (d) {
				var e = 0;
				var h = 0;
				if (typeof(d.getAttribute("myuploadsize")) != "undefined" && d.getAttribute("myuploadsize") != null) {
					h = d.getAttribute("myuploadsize")
				};
				var f = d.getAttribute("mystatus");
				if (typeof(d.getAttribute("mysize")) != "undefined" && d.getAttribute("mysize") != null) {
					e = parseInt(d.getAttribute("mysize"))
				};
				if (f != "init") {
					totalnum++
				};
				if (f != "error") {};
				if (f != "init") {
					if (typeof(e) != "undefined" && e != null) {
						totalsize += parseInt(e)
					}
				};
				if (typeof(e) != "undefined" && e != null) {
					if (f == "success" || f == "first") {
						totalsuccessnum++;
						totalsuccesssize += parseInt(e)
					}
					if (f != "init" && f != "error") {
						totaluploadnum++;
						totaluploadsize += parseInt(h)
					}
					if (f == "dengdai") {
						totaldengdainum++;
						totaldengdaisize += parseInt(e)
					}
				}
			}
		};
		var j = {
			totalnum: totalnum,
			totaluploadnum: totaluploadnum,
			totalsuccessnum: totalsuccessnum,
			totaldengdainum: totaldengdainum,
			totalbarnum: totalbarnum,
			totaluploadsize: totaluploadsize,
			totalsize: totalsize,
			totalsuccesssize: totalsuccesssize,
			totaldengdaisize: totaldengdaisize,
			totalbarnum_z: a,
			totalbarsize: totalbarsize,
			totalbarsize_z: b
		};
		return j
	},
	log: function(i, j) {
		var l = "",
			str1 = "",
			str2 = "",
			typ1 = typeof(i),
			typ2 = typeof(j);
		var m = function(a) {
				var b = "";
				if (typeof(a) == "object") {
					for (var k in a) {
						if (typeof(a.length) != "undefined") {
							b += "\"" + a[k] + "\","
						} else {
							b += "\"" + k + "\":\"" + a[k] + "\","
						}
					}
					b = b.substr(0, b.length - 1);
					if (typeof(a.length) != "undefined") {
						b = "[" + b + "]"
					} else {
						b = "{" + b + "}"
					}
				} else {
					b = a
				};
				return b
			};
		var n = function(b, c) {
				var d = document.getElementById("mylog2019");
				var e = document.getElementById("mylog2019list");
				if (!d) {
					var f = document.getElementsByTagName("body")[0];
					d = document.createElement("div");
					d.style.cssText = "z-index:60000;position:fixed;_position:absolute;bottom:0px;left:0px;width:100%;overflow:hidden; height:100px;background-color:#fff;border:solid 1px #666;font-size:12px;";
					d.id = "mylog2019";
					f.appendChild(d);
					mylog2019rel = document.createElement("div");
					mylog2019rel.style.cssText = "width:100%;height:100%;position:relative;overflow:hidden;";
					d.appendChild(mylog2019rel);
					var g = function() {
							var a = document.createElement("div");
							a.style.cssText = "text-align:center;line-height:20px;background-color:#ff0000;color:#fff;position:absolute;width:100%;";
							a.innerHTML = "清空列表";
							mylog2019rel.appendChild(a);
							a.onclick = function() {
								e.innerHTML = "";
								e.scrollTop = 0;
								g()
							}
						};
					g();
					e = document.createElement("div");
					e.id = "mylog2019list";
					e.style.cssText = "width:100%;height:" + (mylog2019rel.offsetHeight - 30) + "px;padding-top:30px;overflow:auto;";
					mylog2019rel.appendChild(e)
				};
				e.scrollTop = Math.max(e.scrollHeight, e.clientHeight);
				var o = document.createElement("div");
				var h = typeof(b),
					typ2 = typeof(c);
				if (h != "undefined") {
					str1 = m(b)
				};
				if (typ2 != "undefined") {
					str2 = m(c)
				};
				if (str2 != "") {
					str2 = "<br/>" + str2
				}
				l = str1 + str2;
				o.style.cssText = "background-color:#f5f5f5;margin:5px;white-space:normal;word-wrap:break-word;height:auto;overflow:hidden;";
				o.innerHTML = l;
				e.appendChild(o)
			};
		var p = function(a, b) {
				if (typeof(b) != "undefined") {
					console.log(a, b)
				} else {
					console.log(a)
				}
			};
		var q = false;
		var r = false;
		if (typeof(window["islog"]) != "undefined") {
			q = window["islog"]
		};
		if (typeof(window.console) != "undefined") {
			if (q) {
				p(i, j)
			}
		};
		if (q) {
			n(i, j)
		}
	},
	set_obj_value: function(c, d) {
		var e = function(a, b) {
				if (a.tagName.toLowerCase() == "input" || a.tagName.toLowerCase() == "textarea") {
					a.value = b
				} else {
					a.innerHTML = b
				}
			};
		if (typeof(c.length) != "undefined") {
			for (var i = 0; i < c.length; i++) {
				e(c[i], d)
			}
		} else {
			e(c, d)
		}
	},
	GetPngImg: function(a) {
		var v = "",
			t = this;
		v = t.ico_path + a + ".png";
		for (var i = 0; i < g_exts.length; i++) {
			if (g_exts[i].ext == a) {
				v = t.ico_path + g_exts[i].src;
				break
			}
		};
		return v
	},
	FormatBaiFenBi: function(a, b) {
		if (b == 0) {
			return 0
		};
		var n = (a / b) * 100;
		n = Math.round(n * Math.pow(10, 2)) / Math.pow(10, 2);
		var c = String(n).split(".");
		if (c.length > 1 && c[1].length < 2) {
			n = n + "0"
		};
		return n
	},
	setCss: function(d, e) {
		var f = function(a, b) {
				if (a) {
					if (a instanceof jQuery) {
						a.css(b)
					} else {
						for (var c in b) {
							a.style[c] = b[c]
						}
					}
				}
			};
		if (typeof(d.length) != "undefined") {
			for (var k in d) {
				f(d[k], e)
			}
		} else {
			f(d, e)
		}
	},
	ProgressBar: function(a) {
		var t = this;
		t.NewFileBar(a)
	},
	GetItemObj: function(a) {
		if (a != "item2") {
			return window.parent.document.getElementById(a)
		} else {
			return window.document.getElementById(a)
		}
	},
	IsImg: function(a) {
		var b = a.split(".");
		if (b.length > 1) {
			ext = b[b.length - 1].toLowerCase()
		} else {
			ext = a.toLowerCase()
		}
		if (ext == "jpg" || ext == "jpeg" || ext == "gif" || ext == "png" || ext == "bmp" || ext == "webp") {
			return true
		} else {
			return false
		}
	},
	RndNum: function(n) {
		return this.newrand(n)
	},
	newrand: function(n) {
		var a = "";
		for (var i = 0; i < n; i++) {
			a += Math.floor(Math.random() * 10)
		};
		return a
	},
	ajax: function(d) {
		var t = this,
			addstr = "";
		var f = function(a) {
				if (typeof(a) === 'object') {
					var b = "";
					for (var c in a) {
						b += c + "=" + a[c] + "&"
					};
					b = b.substring(0, b.length - 1);
					return b
				} else {
					return a
				}
			};
		var g = String(typeof(d.data)).toLowerCase();
		if (typeof(d.async) == "undefined") {
			d.async = true
		}
		if (g != "undefined") {
			if (g == "string") {
				addstr = d.data
			}
			if (g == "array" || g == "object") {
				if (typeof(d.processData) != "undefined" && d.processData == false) {
					addstr = d.data
				} else {
					for (var h in d.data) {
						if (h != "undefined" && typeof(h) != "undefined") {
							if (addstr != "") {
								addstr += "&" + h + "=" + d.data[h]
							} else {
								addstr += h + "=" + d.data[h]
							}
						}
					}
				}
			}
		};
		var i = null;
		if (window.XMLHttpRequest) {
			i = new XMLHttpRequest()
		} else if (window.ActiveXObject) {
			i = new ActiveXObject("Microsoft.XMLHTTP")
		}
		if (typeof(d.type) == "undefined") {
			d.type = "GET"
		}
		d.type = d.type.toUpperCase();
		var j = d.url;
		if (d.type == "GET") {
			var k = "";
			if (addstr != "") {
				if (d.url.indexOf("?") != -1) {
					k = d.url + "&" + addstr
				} else {
					k = d.url + "?" + addstr
				}
			} else {
				k = d.url
			};
			j = k;
			i.open(d.type, k, d.async)
		} else {
			i.open(d.type, j, d.async)
		};
		var l = "text";
		if (typeof(d.dataType) != "undefined") {
			l = d.dataType
		};
		l = l.toLowerCase();
		if (typeof(d.beforeSend) != "undefined") {
			d.beforeSend(i)
		};
		var m = "";
		var n = new Array(200, 203);
		if (typeof(d.status) != "undefined") {
			if (typeof(d.status) != "undefined") {}
		};
		var o = "";
		if (typeof(g_timeout) != "undefined") {
			o = g_timeout
		};
		if (typeof(d.timeout) != "undefined") {
			o = o
		};
		if (i.timeout && o != "") {
			i.timeout = o
		};
		i.onreadystatechange = function() {
			if (i.readyState == 4) {
				if (i.status == 200 || (i.status >= 201 && i.status <= 299)) {
					m = i.responseText;
					if (d.success) {
						var a = m;
						if (l == "json") {
							try {
								a = eval("(" + m + ")");
								d.success(a, i)
							} catch (err) {
								if (typeof(window.console) != "undefined") {
									console.log("err:", err);
									console.log("err:", k + ";status:" + i.status + ",responseText:" + m)
								}
								if (typeof(d.error) != "undefined") {
									d.error(i, i.status, m)
								}
							}
						} else {
							d.success(a, i)
						}
					}
				} else {
					if (d.error) {
						d.error(i, i.status, m, j)
					};
					if (typeof(d.isxunhuan) != "undefined" && d.isxunhuan == 1) {
						t.ajax(d)
					}
				};
				if (typeof(d.complete) != "undefined") {
					d.complete(i, i.status, i.responseText)
				}
			}
		};
		if (typeof(d.progress) != "undefined") {
			i.upload.onprogress = function(e) {
				d.progress(e, i)
			}
		};
		i.setRequestHeader('X-Requested-With', "XMLHttpRequest");
		if (typeof(d.contentType) != "undefined") {
			if (d.contentType == true) {
				i.setRequestHeader('Content-Type', d.contentType)
			}
		} else {
			i.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
		};
		if (d.type == "GET") {
			i.send("")
		} else {
			i.send(addstr)
		};
		return i
	},
	GetExtSrc: function(a, b) {
		var v = "",
			t = this;
		v = t.ico_path + b + ".png";
		return v
	},
	css: function(a, b) {
		if (a) {
			for (var k in b) {
				a.style[k] = b[k]
			}
		}
	},
	createobj: function(a) {
		var b = document.createElement(a.tagName);
		if (typeof(a.className) != "undefined") {
			b.className = a.className
		}
		if (typeof(a.type) != "undefined") {
			b.type = a.type
		}
		if (typeof(a.cssText) != "undefined") {
			b.style.cssText = a.cssText
		}
		if (typeof(a.id) != "undefined") {
			b.id = a.id
		}
		if (typeof(a.name) != "undefined") {
			b.name = a.name
		}
		if (typeof(a.html) != "undefined") {
			b.innerHTML = a.html
		}
		if (typeof(a.value) != "undefined") {
			b.value = a.value
		}
		if (typeof(a.attr) != "undefined") {
			for (var k in a.attr) {
				b.setAttribute(k, a.attr[k])
			}
		};
		if (typeof(a.style) != "undefined") {
			for (var c in a.style) {
				b.style[c] = a.style[c]
			}
		};
		return b
	},
	date_format: function(a, b) {
		var c = new Date(a);
		var d = /(y+)/;
		var o = {
			"M+": c.getMonth() + 1,
			"d+": c.getDate(),
			"h+": c.getHours(),
			"m+": c.getMinutes(),
			"s+": c.getSeconds(),
			"q+": Math.floor((c.getMonth() + 3) / 3),
			"S": c.getMilliseconds()
		};
		if (d.test(b)) {
			b = b.replace(RegExp.$1, (c.getFullYear() + "").substr(4 - RegExp.$1.length))
		};
		for (var k in o) {
			if (new RegExp("(" + k + ")").test(b)) {
				b = b.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)))
			}
		};
		return b
	}
};

function hcfile(a) {
	var b = {};
	for (k in hcfile_) {
		b[k] = hcfile_[k]
	};
	b.siteurl_file = g_siteurl_file;
	b.siteurl = g_siteurl;
	b.ico_path = g_ico_path;
	if (typeof(a) != "undefined") {
		b.Init(a)
	};
	return b
};

function hcfilehuidiao(a) {
	var t = window["hcfile" + a.inputid];
	var b = "";
	if (typeof(a.small) != "undefined") {
		b = a.small
	};
	if (typeof(a.small_src) != "undefined") {
		b = a.small_src
	};
	var c = b,
		arr2 = b.split("."),
		ext = arr2[arr2.length - 1];
	var d = t.siteurl_file + b;
	var e = b.split("/");
	var f = e[e.length - 1];
	if (b.substr(0, 1) == "/") {
		d = b.substr(1, b.length - 1)
	};
	if (t.IsImg(ext)) {
		if (t.conf.isnewsmall == 0) {
			c = b
		} else {
			c = t.getbigsrc(b)
		}
	} else {
		d = t.GetExtSrc(g_exts, ext)
	};
	var g = {
		src: b,
		title: f
	};
	var h = {
		src: b
	};
	var i = 0;
	if (typeof(a.row) != "undefined") {
		g = a.row;
		if (typeof(g.size) != "undefined") {
			i = g.size
		}
	} else {
		if (typeof(a.title) != "undefined") {
			g["title"] = a.title
		}
		if (typeof(a.size) != "undefined") {
			g["size"] = a.size;
			i = a.size
		}
		if (typeof(a.ext) != "undefined") {
			g["ext"] = a.ext
		}
	};
	if (typeof(a.file_size) != "undefined") {
		i = a.file_size
	};
	h["row"] = g;
	h["status"] = "success";
	t.num++;
	var j = t.NewItem(h);
	t.showstatus({
		num: t.num
	});
	var k = "{\"small_src\":\"" + b + "\",\"big_src\":\"" + c + "\"}";
	t.NewFileBar({
		myitem: j,
		success_size: i,
		file_size: i,
		src: b,
		result: g
	});
	t.ResetInput();
	if (typeof(t.iframe_upload_huidiao) != "undefined") {
		t.iframe_upload_huidiao({
			myitem: j,
			row: g
		})
	}
}