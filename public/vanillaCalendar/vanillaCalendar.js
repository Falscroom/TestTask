var vanillaCalendar = {
    month: document.querySelector('[data-calendar-area="month"]'),
    next: document.querySelector('[data-calendar-toggle="next"]'),
    previous: document.querySelector('[data-calendar-toggle="previous"]'),
    label: document.querySelector('[data-calendar-label="month"]'),
    activeDates: null,
    date: new Date,
    todaysDate: new Date,
    init: function(t) {
        this.options = t, this.date.setDate(1), this.createWeek(), this.createMonth(), this.createListeners()
    },
    dateFormat: function(date) {
        let yyyy = date.getFullYear().toString();
        let mm = (date.getMonth()+1).toString();
        let dd  = date.getDate().toString();

        if(mm.length === 1)
            mm = '0' + mm;
        if(dd.length === 1)
            dd = '0' + dd;

        return yyyy + '/' + mm + '/' + dd;
    },
    createListeners: function() {
        var t = this;
        this.next.addEventListener("click", function() {
            t.clearCalendar();
            var e = t.date.getMonth() + 1;
            t.date.setMonth(e), t.createMonth()
        }), this.previous.addEventListener("click", function() {
            t.clearCalendar();
            var e = t.date.getMonth() - 1;
            t.date.setMonth(e), t.createMonth()
        })
    },
    createDay: function(t, e, a) {
        var s = document.createElement("div"),
            n = document.createElement("span"),
            i = this.options.sundayFirst ? e : e - 1,
            r = this.options.rtl ? "marginRight" : "marginLeft";
        n.innerHTML = t, s.className = "vcal-date", s.setAttribute("data-calendar-date", this.dateFormat(this.date) ), 1 === t && (0 === e ? this.options.sundayFirst || (s.style[r] = 6 * 14.28 + "%") : s.style[r] = 14.28 * i + "%"), this.options.disablePastDays && this.date.getTime() <= this.todaysDate.getTime() - 1 ? s.classList.add("vcal-date--disabled") : (s.classList.add("vcal-date--active"), s.setAttribute("data-calendar-status", "active")), this.date.toString() === this.todaysDate.toString() && s.classList.add("vcal-date--today"), s.appendChild(n), this.month.appendChild(s)
    },
    createWeek: function() {
        var t = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            e = t.pop(),
            a = document.querySelector(".vcal-week"),
            s = "";
        this.options.rtl && a.classList.add("rtl");
        for (var n = 0; n < t.length; n++)(s = document.createElement("span")).innerHTML = t[n], a.appendChild(s);
        (s = document.createElement("span")).innerHTML = e, this.options.sundayFirst ? a.insertBefore(s, a.firstChild) : a.appendChild(s)
    },

    createMonth: function() {
        for (var t = this.date.getMonth(); this.date.getMonth() === t;) this.createDay(this.date.getDate(), this.date.getDay(), this.date.getFullYear()), this.date.setDate(this.date.getDate() + 1);
        this.date.setDate(1), this.date.setMonth(this.date.getMonth() - 1), this.label.innerHTML = this.monthsAsString(this.date.getMonth()) + " " + this.date.getFullYear(),  this.options.rtl && this.month.classList.add("rtl")
    },
    monthsAsString: function(t) {
        return ["January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][t]
    },
    clearCalendar: function() {
        vanillaCalendar.month.innerHTML = ""
    },
    removeActiveClass: function() {
        for (var t = 0; t < this.activeDates.length; t++) this.activeDates[t].classList.remove("vcal-date--selected")
    }
};