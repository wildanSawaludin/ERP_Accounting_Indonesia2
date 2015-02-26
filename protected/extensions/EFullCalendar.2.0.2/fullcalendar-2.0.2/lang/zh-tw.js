(function (e) {
    "function" == typeof define && define.amd ? define(["jquery", "moment"], e) : e(jQuery, moment)
})(function (e, t) {
    t.lang("zh-tw", {months: "一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月".split("_"), monthsShort: "1月_2月_3月_4月_5月_6月_7月_8月_9月_10月_11月_12月".split("_"), weekdays: "星期日_星期一_星期二_星期三_星期四_星期五_星期六".split("_"), weekdaysShort: "週日_週一_週二_週三_週四_週五_週六".split("_"), weekdaysMin: "日_一_二_三_四_五_六".split("_"), longDateFormat: {LT: "Ah點mm", L: "YYYY年MMMD日", LL: "YYYY年MMMD日", LLL: "YYYY年MMMD日LT", LLLL: "YYYY年MMMD日ddddLT", l: "YYYY年MMMD日", ll: "YYYY年MMMD日", lll: "YYYY年MMMD日LT", llll: "YYYY年MMMD日ddddLT"}, meridiem: function (e, t) {
        var a = 100 * e + t;
        return 900 > a ? "早上" : 1130 > a ? "上午" : 1230 > a ? "中午" : 1800 > a ? "下午" : "晚上"
    }, calendar: {sameDay: "[今天]LT", nextDay: "[明天]LT", nextWeek: "[下]ddddLT", lastDay: "[昨天]LT", lastWeek: "[上]ddddLT", sameElse: "L"}, ordinal: function (e, t) {
        switch (t) {
            case"d":
            case"D":
            case"DDD":
                return e + "日";
            case"M":
                return e + "月";
            case"w":
            case"W":
                return e + "週";
            default:
                return e
        }
    }, relativeTime: {future: "%s內", past: "%s前", s: "幾秒", m: "一分鐘", mm: "%d分鐘", h: "一小時", hh: "%d小時", d: "一天", dd: "%d天", M: "一個月", MM: "%d個月", y: "一年", yy: "%d年"}}), e.fullCalendar.datepickerLang("zh-tw", "zh-TW", {closeText: "關閉", prevText: "&#x3C;上月", nextText: "下月&#x3E;", currentText: "今天", monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"], monthNamesShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"], dayNames: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"], dayNamesShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"], dayNamesMin: ["日", "一", "二", "三", "四", "五", "六"], weekHeader: "周", dateFormat: "yy/mm/dd", firstDay: 1, isRTL: !1, showMonthAfterYear: !0, yearSuffix: "年"}), e.fullCalendar.lang("zh-tw", {defaultButtonText: {month: "月", week: "週", day: "天", list: "待辦事項"}, allDayText: "全天"})
});