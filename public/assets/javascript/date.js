/**
 * Created by sopzhou on 2016/9/5.
 */
;(function ($) {
    $.fn.birthday = function (options) {
        var opts = $.extend({}, $.fn.birthday.defaults, options);//整合参数
        var $year = $(this).children("select[name=" + opts.year + "]");
        var $month = $(this).children("select[name=" + opts.month + "]");
        var $day = $(this).children("select[name=" + opts.day + "]");
        MonHead = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        return this.each(function () {
            var y = new Date().getFullYear();
            var con = "";
            //添加年份
            for (i = y; i < (y + 50); i++) {
                con += "<option value='" + i + "'>" + i + "年" + "</option>";
            }
            $year.append(con);
            con = "";
            //添加月份
            for (i = 1; i <= 12; i++) {
                if (i < 10) {
                    con += "<option value='0" + i + "'>" + i + "月" + "</option>";
                } else {
                    con += "<option value='" + i + "'>" + i + "月" + "</option>";
                }
            }
            $month.append(con);
            con = "";
            //添加日期
            var n = MonHead[0];//默认显示第一月
            for (i = 1; i <= n; i++) {
                if (i < 10) {
                    con += "<option value='0" + i + "'>" + i + "日" + "</option>";
                } else {
                    con += "<option value='" + i + "'>" + i + "日" + "</option>";
                }
            }
            $day.append(con);
            $.fn.birthday.change($(this));

        });
    };
    $.fn.birthday.change = function (obj) {
        obj.children("select[name=" + $.fn.birthday.defaults.year + "],select[name=" + $.fn.birthday.defaults.month + "]").change(function () {
            var $year = obj.children("select[name=" + $.fn.birthday.defaults.year + "]");
            var $month = obj.children("select[name=" + $.fn.birthday.defaults.month + "]");
            var $day = obj.children("select[name=" + $.fn.birthday.defaults.day + "]");
            $day.empty();
            var selectedYear = $year.find("option:selected").val();
            var selectedMonth = $month.find("option:selected").val();
            if (selectedMonth == 2 && $.fn.birthday.IsRunYear(selectedYear)) {//如果是闰年
                var c = "";
                for (var i = 1; i <= 29; i++) {
                    //c += "<option value='" + i + "'>" + i + "日" + "</option>";
                    if (i < 10) {
                        c += "<option value='0" + i + "'>" + i + "日" + "</option>";
                    } else {
                        c += "<option value='" + i + "'>" + i + "日" + "</option>";
                    }
                }
                $day.append(c);
            } else {//如果不是闰年也没选2月份
                var c = "";
                for (var i = 1; i <= MonHead[selectedMonth - 1]; i++) {
                    //c += "<option value='" + i + "'>" + i + "日" + "</option>";
                    if (i < 10) {
                        c += "<option value='0" + i + "'>" + i + "日" + "</option>";
                    } else {
                        c += "<option value='" + i + "'>" + i + "日" + "</option>";
                    }
                }
                $day.append(c);
            }
        });
    };
    $.fn.birthday.IsRunYear = function (selectedYear) {
        return (0 == selectedYear % 4 && (selectedYear % 100 != 0 || selectedYear % 400 == 0));
    };
    $.fn.birthday.defaults = {
        year: "year",
        month: "month",
        day: "day"
    };
})(jQuery);