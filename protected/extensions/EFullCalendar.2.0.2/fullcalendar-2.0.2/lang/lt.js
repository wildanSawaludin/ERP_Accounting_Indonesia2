(function (e) {
    "function" == typeof define && define.amd ? define(["jquery", "moment"], e) : e(jQuery, moment)
})(function (e, t) {
    function n(e, t, n, a) {
        return t ? "kelios sekundės" : a ? "kelių sekundžių" : "kelias sekundes"
    }

    function a(e, t, n, a) {
        return t ? i(n)[0] : a ? i(n)[1] : i(n)[2]
    }

    function r(e) {
        return 0 === e % 10 || e > 10 && 20 > e
    }

    function i(e) {
        return d[e].split("_")
    }

    function o(e, t, n, o) {
        var s = e + " ";
        return 1 === e ? s + a(e, t, n[0], o) : t ? s + (r(e) ? i(n)[1] : i(n)[0]) : o ? s + i(n)[1] : s + (r(e) ? i(n)[1] : i(n)[2])
    }

    function s(e, t) {
        var n = -1 === t.indexOf("dddd HH:mm"), a = u[e.day()];
        return n ? a : a.substring(0, a.length - 2) + "į"
    }

    var d = {m: "minutė_minutės_minutę", mm: "minutės_minučių_minutes", h: "valanda_valandos_valandą", hh: "valandos_valandų_valandas", d: "diena_dienos_dieną", dd: "dienos_dienų_dienas", M: "mėnuo_mėnesio_mėnesį", MM: "mėnesiai_mėnesių_mėnesius", y: "metai_metų_metus", yy: "metai_metų_metus"}, u = "sekmadienis_pirmadienis_antradienis_trečiadienis_ketvirtadienis_penktadienis_šeštadienis".split("_");
    t.lang("lt", {months: "sausio_vasario_kovo_balandžio_gegužės_biržėlio_liepos_rugpjūčio_rugsėjo_spalio_lapkričio_gruodžio".split("_"), monthsShort: "sau_vas_kov_bal_geg_bir_lie_rgp_rgs_spa_lap_grd".split("_"), weekdays: s, weekdaysShort: "Sek_Pir_Ant_Tre_Ket_Pen_Šeš".split("_"), weekdaysMin: "S_P_A_T_K_Pn_Š".split("_"), longDateFormat: {LT: "HH:mm", L: "YYYY-MM-DD", LL: "YYYY [m.] MMMM D [d.]", LLL: "YYYY [m.] MMMM D [d.], LT [val.]", LLLL: "YYYY [m.] MMMM D [d.], dddd, LT [val.]", l: "YYYY-MM-DD", ll: "YYYY [m.] MMMM D [d.]", lll: "YYYY [m.] MMMM D [d.], LT [val.]", llll: "YYYY [m.] MMMM D [d.], ddd, LT [val.]"}, calendar: {sameDay: "[Šiandien] LT", nextDay: "[Rytoj] LT", nextWeek: "dddd LT", lastDay: "[Vakar] LT", lastWeek: "[Praėjusį] dddd LT", sameElse: "L"}, relativeTime: {future: "po %s", past: "prieš %s", s: n, m: a, mm: o, h: a, hh: o, d: a, dd: o, M: a, MM: o, y: a, yy: o}, ordinal: function (e) {
        return e + "-oji"
    }, week: {dow: 1, doy: 4}}), e.fullCalendar.datepickerLang("lt", "lt", {closeText: "Uždaryti", prevText: "&#x3C;Atgal", nextText: "Pirmyn&#x3E;", currentText: "Šiandien", monthNames: ["Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis"], monthNamesShort: ["Sau", "Vas", "Kov", "Bal", "Geg", "Bir", "Lie", "Rugp", "Rugs", "Spa", "Lap", "Gru"], dayNames: ["sekmadienis", "pirmadienis", "antradienis", "trečiadienis", "ketvirtadienis", "penktadienis", "šeštadienis"], dayNamesShort: ["sek", "pir", "ant", "tre", "ket", "pen", "šeš"], dayNamesMin: ["Se", "Pr", "An", "Tr", "Ke", "Pe", "Še"], weekHeader: "SAV", dateFormat: "yy-mm-dd", firstDay: 1, isRTL: !1, showMonthAfterYear: !0, yearSuffix: ""}), e.fullCalendar.lang("lt", {defaultButtonText: {month: "Mėnuo", week: "Savaitė", day: "Diena", list: "Darbotvarkė"}, allDayText: "Visą dieną"})
});