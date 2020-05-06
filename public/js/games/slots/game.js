webpackJsonp([5], {
    0: function(e, t, n) {
        n("4t5a"), n("Z3mU"), n("PWuC"), n("Ky+F"), n("byej"), n("ufoq"), n("nTfl"), n("Y2EE"), n("viqD"), n("WHGz"), n("rqKu"), n("ZN9n"), n("lFvb"), n("QGAl"), n("V0Fp"), n("qJ1m"), e.exports = n("d0W6")
    },
    "4t5a": function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var i = n("mtWM"),
            s = n.n(i),
            a = n("HNiq"),
            o = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            };
        window.game_slots_reel = function(e, t, n) {
            var i = this;
            return this.idx = e, this.self = this, this.ids = t, this.game = n, this.speed_frame = 0, this.animation_frame = 0, this.speed = 0, this.speed_max = n.speed_max, this.delta = 0, this.delta_stop = 0, this.stop_to = 0, this.position = 0, this.t = Date.now(), this.is_spin = !1, this.is_stopping = !1, this.is_spinning = !1, this.delta_pos_stop = 4, this.delta_stop_max = 200 * this.delta_pos_stop, this.syms_win = [], this.startSpin = function() {
                i.is_spin = !0, i.is_stopping = !1, i.is_spinning = !0
            }, this.stopSpin = function(e) {
                void 0 === e && (e = 0), i.stop_to = e, i.is_spin = !1
            }, this.onspinned = null, this.onstopped = null, this.win = function(e) {
                i.syms_win = e
            }, this.win_add = function(e) {
                i.syms_win.push(e)
            }, this.win_clear = function() {
                i.syms_win = []
            }, this.getReelPosition = function(e) {
                return e < 0 ? i.getReelPosition(i.ids.length + e) : e >= i.ids.length ? i.getReelPosition(e - i.ids.length) : e
            }, this.draw = function() {
                var e = i.game.canvas.getContext("2d"),
                    t = 0,
                    n = 0;
                if (i.speed > 0) {
                    for (; 100 + 200 * -t + Math.round(.5 * i.game.sym[i.ids[i.getReelPosition(i.position - 1 - t)]].speed_frames[i.speed_frame].height) + i.delta > 0;) t++;
                    for (; 100 + 200 * n - Math.round(.5 * i.game.sym[i.ids[i.getReelPosition(i.position - 1 - t)]].speed_frames[i.speed_frame].height) + i.delta < i.game.canvas.height;) n++
                }
                for (var s = null, a = -t; a < 3 + n; a++)(s = 0 == i.speed && -1 != i.syms_win.indexOf(i.getReelPosition(i.position + a)) ? null : i.game.sym[i.ids[i.getReelPosition(i.position + a)]].speed_frames[i.speed_frame]) && e.drawImage(s, 245 + 228 * i.idx - Math.round(.5 * s.width), 100 + 200 * a - Math.round(.5 * s.height) + i.delta);
                if (i.speed > 0) {
                    e.strokeStyle = "white", e.lineWidth = 5, e.shadowOffsetX = 0, e.shadowOffsetY = 10, e.shadowColor = "white", e.lineCap = "round";
                    var o = [5, 15, 30],
                        l = 1 - Math.abs((2 * i.delta - 200) / 200);
                    for (var a in i.speed < i.speed_max / 2 ? e.globalAlpha = l : e.globalAlpha = (2 - l) / 2, o) e.shadowBlur = o[a], e.beginPath(), e.moveTo(145 + 228 * i.idx + (100 - 100 * l), -10), e.lineTo(145 + 228 * i.idx + 200 - (100 - 100 * l), -10), e.stroke();
                    for (var a in e.shadowOffsetY = -10, o) e.shadowBlur = o[a], e.beginPath(), e.moveTo(145 + 228 * i.idx + (100 - 100 * l), i.game.canvas.height + 10), e.lineTo(145 + 228 * i.idx + 200 - (100 - 100 * l), i.game.canvas.height + 10), e.stroke();
                    e.globalAlpha = 1, e.strokeStyle = "white", e.lineWidth = 0, e.shadowOffsetX = 0, e.shadowOffsetY = 0, e.shadowBlur = 0, e.shadowColor = "white", e.lineCap = "round"
                }
            }, this.drawWin = function() {
                if (!(i.speed > 0))
                    for (var e = i.game.canvas.getContext("2d"), t = null, n = 0; n < 3; n++) 0 == i.speed && -1 != i.syms_win.indexOf(i.getReelPosition(i.position + n)) && (t = i.game.sym[i.ids[i.getReelPosition(i.position + n)]].animation[Math.round(i.animation_frame)]) && e.drawImage(t, 245 + 228 * i.idx - Math.round(.5 * t.width), 100 + 200 * n - Math.round(.5 * t.height) + i.delta)
            }, this.calculate = function() {
                for (i.delta += Math.round((i.game.t - i.t) * i.speed * 5e-4), i.is_spin || (i.delta_stop -= Math.round((i.game.t - i.t) * i.speed * 5e-4), i.delta_stop < 0 && (i.delta_stop = 0)); i.delta >= 200;) i.delta -= 200, i.position = i.getReelPosition(i.position - 1), i.is_spin || i.is_stopping || i.getReelPosition(i.position - i.delta_pos_stop) != i.stop_to || (i.is_stopping = !0, i.delta_stop = i.delta_stop_max - i.delta);
                for (; i.delta <= -200;) i.delta += 200, i.position = i.getReelPosition(i.position + 1);
                if (i.is_spin && i.speed < i.speed_max && (i.speed += Math.round(1e4 * (i.game.t - i.t) * 5e-4), i.speed > i.speed_max && (i.speed = i.speed_max), i.speed_frame = Math.round(i.speed / 1e3 * 2), i.speed_frame < 0 && (i.speed_frame = 0), i.speed_frame > Math.round(i.speed_max / 1e3 * 2) && (i.speed_frame = Math.round(i.speed_max / 1e3 * 2)), i.speed < i.speed_max || "function" != typeof i.onspinned || i.onspinned(i)), !i.is_spin && i.is_stopping && i.speed > 0) {
                    var e = Math.round(Math.pow(i.delta_stop / i.delta_stop_max, .5) * i.speed_max);
                    e < i.speed && (i.speed = e), Math.round(5e3 * (i.game.t - i.t) * 5e-4), i.speed < 0 && (i.speed = 0), 0 == i.speed && (i.is_spinning = !1, i.is_stopping = !1, i.delta = 0, "function" == typeof i.onstopped && i.onstopped(i)), i.speed_frame = Math.round(i.speed / 1e3 * 2), i.speed_frame < 0 && (i.speed_frame = 0), i.speed_frame > Math.round(i.speed_max / 1e3 * 2) && (i.speed_frame = Math.round(i.speed_max / 1e3 * 2))
                }
                if (0 == i.speed && i.syms_win.length > 0)
                    for (i.animation_frame += .03 * (i.game.t - i.t); Math.round(i.animation_frame) >= i.game.animation_time;) i.animation_frame -= i.game.animation_time;
                i.t = i.game.t
            }, this
        }, window.game_slots_line = function(e, t) {
            var n = this;
            return this.self = this, this.data = e, this.game = t, this.alpha = 0, this.shown_p = 0, this.t = Date.now(), this.display = !1, this.show = function() {
                n.display = !0
            }, this.hide = function() {
                n.display = !1
            }, this.draw = function() {
                if (0 != n.shown_p) {
                    var e = n.game.canvas.getContext("2d");
                    e.strokeStyle = "white", e.lineWidth = 4, e.shadowOffsetX = 0, e.shadowOffsetY = 0, e.shadowColor = "white", e.lineCap = "round", e.globalAlpha = n.alpha;
                    var t = [5 * n.alpha, 15 * n.alpha, 30 * n.alpha, 60 * n.alpha, 100 * n.alpha];
                    for (var i in t) {
                        for (var i in e.shadowBlur = t[i], e.beginPath(), e.moveTo(95, 100 + 200 * n.data[0]), n.data) e.lineTo(245 + 228 * i, 100 + 200 * n.data[i]);
                        e.lineTo(245 + 228 * i + 150, 100 + 200 * n.data[i]), e.stroke()
                    }
                    e.globalAlpha = 1, e.strokeStyle = "white", e.lineWidth = 0, e.shadowOffsetX = 0, e.shadowOffsetY = 0, e.shadowBlur = 0, e.shadowColor = "white", e.lineCap = "round"
                }
            }, this.calculate = function() {
                n.display && n.shown_p < 1 && (n.shown_p += (n.game.t - n.t) / 300, n.shown_p > 1 && (n.shown_p = 1), n.alpha = n.shown_p), !n.display && n.shown_p > 0 && (n.shown_p -= (n.game.t - n.t) / 100, n.shown_p < 0 && (n.shown_p = 0), n.alpha = n.shown_p), n.display || 0 != n.shown_p || 0 == n.alpha || (n.alpha = 1), n.t = n.game.t
            }, this
        }, window.game_slots_sound = function(e, t) {
            var n = this;
            this.id = e, this.file = e, this.is_loop = !1, this.volume = 1, this.onload = t, this.play = function() {
                var e = (new createjs.PlayPropsConfig).set({
                    interrupt: createjs.Sound.INTERRUPT_ANY,
                    loop: n.is_loop ? -1 : 0,
                    volume: n.volume
                });
                createjs.Sound.play(n.id, e)
            }, this.stop = function() {
                createjs.Sound.stop(n.id)
            }, this.onfileload = function(e) {
                "function" == typeof n.onload && n.onload()
            };
            var i = new createjs.LoadQueue;
            return createjs.Sound.alternateExtensions = ["mp3"], i.installPlugin(createjs.Sound), i.addEventListener("complete", n.onfileload), i.loadManifest([{
                id: n.id,
                src: n.file
            }]), this
        }, window.game_slots_proto = function(e) {
            var t = {
                s: 0,
                c: 0,
                fps: 0,
                is_sound: !0,
                game_id: 0,
                balance_warn_text: "",
                balance: 0,
                lines_count: 0,
                max_lines: 0,
                bet: 0,
                query_data: "",
                is_show_demo: !1,
                t_show_demo: 0,
                is_line_showig: !1,
                win: {},
                win_scatter: [],
                win_label: {},
                win_loop: [],
                container: null,
                container_inner: null,
                canvas: null,
                container_bg: null,
                label_win: null,
                label_balance: null,
                label_bet: null,
                label_lines: null,
                btns_line: {},
                btn_spin: null,
                btn_bet_max: null,
                btn_bet_minus: null,
                btn_bet_plus: null,
                btn_line_minus: null,
                btn_line_plus: null,
                btn_sound: null,
                btn_paytable: null,
                lines_show_demo: -1,
                view_preloader: null,
                label_preloader_percent: null,
                lines: [],
                reels: null,
                sym: [],
                theme: Object(a.b)("settings.theme"),
                loading_cnt: 0,
                loading_idx: 0,
                speed_max: 5e3,
                animation_time: 28,
                snd_click: null,
                snd_lose: null,
                snd_spin: null,
                snd_start: null,
                snd_stop: null,
                snd_win: null,
                game_result: null,
                sym_size: 200,
                t: 0,
                t_drawed: 0,
                requestAnimationFrame: function(e) {
                    setTimeout(e, 1)
                },
                requestAnimationFrame_get: function() {
                    var e = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || window.oRequestAnimationFrame;
                    t.requestAnimationFrame = e ? e.bind(window) : null
                },
                domInit: function() {
                    if (t.container = window.document.getElementById("game_slots_container"), !t.container) return !1;
                    t.game_slots_paytable_data = window.document.getElementById("game_slots_paytable_data"), t.label_win = window.document.getElementById("game_slots_win_line"), t.label_win_total = window.document.getElementById("game_slots_total_win_label"), t.container_bg = window.document.getElementById("game_slots_bg"), t.container_inner = t.container.getElementsByClassName("inner")[0], t.canvas = window.document.getElementById("game_slots_drawable"), t.label_balance = window.document.getElementById("game_slots_balance"), t.label_bet = window.document.getElementById("game_slots_bet"), t.label_lines = window.document.getElementById("game_slots_lines"), t.btn_spin = window.document.getElementById("game_slots_btn_spin"), t.btn_bet_max = window.document.getElementById("game_slots_btn_bet_max"), t.btn_bet_minus = window.document.getElementById("game_slots_btn_bet_minus"), t.btn_bet_plus = window.document.getElementById("game_slots_btn_bet_plus"), t.btn_line_minus = window.document.getElementById("game_slots_btn_lines_minus"), t.btn_line_plus = window.document.getElementById("game_slots_btn_lines_plus"), t.btn_sound = window.document.getElementById("game_slots_btn_sound"), t.btn_paytable = window.document.getElementById("game_slots_btn_paytable"), t.server_hash = window.document.getElementById("server-hash-input"), t.client_seed = window.document.getElementById("client-seed-input");
                    var e = window.document.getElementById("game_slots_lines_btns").getElementsByClassName("line");
                    for (var n in e) "object" == o(e[n]) && "button" == e[n].tagName.toLowerCase() && (t.btns_line[e[n].dataset.line] = e[n]);
                    t.view_preloader = t.container.getElementsByClassName("preloader")[0], t.label_preloader_percent = t.view_preloader.getElementsByClassName("value")[0]
                },
                init: function(e) {
                    if (t.domInit(), !t.container) return !1;
                    for (var n in t.query_data = e.query, t.query_play = e.play, t.requestAnimationFrame_get(), t.lbl_load(1), e.lines) t.lines.push(new window.game_slots_line(e.lines[n], t));
                    return t.game_id = e.game_id, t.balance_warn_text = Object(a.a)("Insufficient balance, please add more credits to play."), t.balance = parseFloat(e.balance), t.lines_count = parseInt(e.default_lines), t.max_lines = parseInt(e.max_lines), t.min_bet = parseFloat(e.min_bet), t.max_bet = parseFloat(e.max_bet), t.bet_change_amount = parseFloat(e.bet_change_amount), t.bet = parseFloat(e.default_bet), t.updateUIText(), t.sym_ld = e.syms, t.reels = [], t.reels_ld = e.reels, t.container.classList.add(t.theme), t.theme_path = "/images/games/slots/", t.animation_frames = e.animation_frames, t.animation_time = e.animation_time, t.animation_size = e.animation_size, t.animation = t.theme + "/gs-animation_200.png", t.sym_bg = t.theme + "/gs-sym_bg.png", t.res_ld = [t.theme_path + t.theme + "/gs-btn_bet_minus-active.png", t.theme_path + t.theme + "/gs-btn_bet_minus-hover.png", t.theme_path + t.theme + "/gs-btn_bet_minus.png", t.theme_path + t.theme + "/gs-btn_bet_plus-active.png", t.theme_path + t.theme + "/gs-btn_bet_plus-hover.png", t.theme_path + t.theme + "/gs-btn_bet_plus.png", t.theme_path + t.theme + "/gs-btn_max-active.png", t.theme_path + t.theme + "/gs-btn_max-hover.png", t.theme_path + t.theme + "/gs-btn_max.png", t.theme_path + t.theme + "/gs-btn_paytable-active.png", t.theme_path + t.theme + "/gs-btn_paytable-hover.png", t.theme_path + t.theme + "/gs-btn_paytable.png", t.theme_path + t.theme + "/gs-btn_sound_off-hover.png", t.theme_path + t.theme + "/gs-btn_sound_off.png", t.theme_path + t.theme + "/gs-btn_sound_on-hover.png", t.theme_path + t.theme + "/gs-btn_sound_on.png", t.theme_path + t.theme + "/gs-btn_spin-active.png", t.theme_path + t.theme + "/gs-btn_spin-hover.png", t.theme_path + t.theme + "/gs-btn_spin.png"], t.loading_cnt = 8 + t.res_ld.length + 1 + 1 + t.sym_ld.length * (1 + t.animation_time + t.speed_max / 1e3 * 2), t.loading_idx = 1, createjs.Sound.registerPlugins([createjs.WebAudioPlugin, createjs.HTMLAudioPlugin]), window.addEventListener("resize", t.resize), t.resize(), "hidden" in document ? document.addEventListener("visibilitychange", t.onchange_window_state) : "mozHidden" in document ? document.addEventListener("mozvisibilitychange", t.onchange_window_state) : "webkitHidden" in document ? document.addEventListener("webkitvisibilitychange", t.onchange_window_state) : "msHidden" in document && document.addEventListener("msvisibilitychange", t.onchange_window_state), t.load(), t
                },
                load: function(e) {
                    if (t.snd_click)
                        if (t.snd_lose)
                            if (t.snd_spin)
                                if (t.snd_start)
                                    if (t.snd_stop)
                                        if (t.snd_win) {
                                            var n;
                                            if (t.res_ld.length > 0) return (n = new Image).onload = function() {
                                                t.loading_idx++, t.lbl_load_update(), t.requestAnimationFrame(t.load)
                                            }, void(n.src = t.res_ld.pop());
                                            if ("object" != o(t.sym_bg)) return (n = new Image).onload = function() {
                                                t.sym_bg = this, t.loading_idx++, t.lbl_load_update(), t.requestAnimationFrame(t.load)
                                            }, void(n.src = t.theme_path + t.sym_bg);
                                            if ("object" != o(t.animation)) return (n = new Image).onload = function() {
                                                t.animation = this, t.loading_idx++, t.lbl_load_update(), t.requestAnimationFrame(t.load)
                                            }, void(n.src = t.theme_path + t.animation);
                                            if (t.sym_ld.length > 0) return (n = new Image).onload = function() {
                                                t.loading_idx++;
                                                for (var e = {
                                                        source: this,
                                                        speed_frames: [],
                                                        animation: []
                                                    }, n = 0; n <= t.speed_max / 1e3 * 2; n++) {
                                                    var i = Math.round(.001 * Math.pow(n, 5));
                                                    (o = document.createElement("canvas")).width = 200, o.height = 200 + i, (l = o.getContext("2d")).globalAlpha = 1 / (i + 1);
                                                    for (var s = 0; s < i + 1; ++s) l.drawImage(t.sym_bg, (200 - t.sym_bg.width) / 2, s + (200 - t.sym_bg.height) / 2);
                                                    for (s = 0; s < i + 1; ++s) l.drawImage(e.source, (200 - e.source.width) / 2, s + (200 - e.source.height) / 2);
                                                    e.speed_frames[n] = o, t.loading_idx++
                                                }
                                                var a = 0;
                                                for (n = 0; n < t.animation_time; n++) {
                                                    var o, l, _ = .1 * Math.cos(4 * n * Math.PI / t.animation_time) + .9;
                                                    (o = document.createElement("canvas")).width = o.height = 200, (l = o.getContext("2d")).drawImage(t.animation, t.animation_size * a, 0, t.animation_size, t.animation_size, (200 - t.animation_size) / 2, (200 - t.animation_size) / 2, t.animation_size, t.animation_size), l.drawImage(e.source, (200 - e.source.width * _) / 2, (200 - e.source.height * _) / 2, e.source.width * _, e.source.height * _), e.animation[n] = o, ++a >= t.animation_frames && (a = 0), t.loading_idx++
                                                }
                                                t.sym.push(e), t.lbl_load_update(), t.requestAnimationFrame(t.load)
                                            }, void(n.src = t.sym_ld.shift());
                                            if (0 == t.container_bg.src.length) return t.container_bg.src = t.theme_path + t.theme + "/gs-bg.png", void(t.container_bg.onload = function() {
                                                t.loading_idx++, t.lbl_load_update(), t.requestAnimationFrame(t.load)
                                            });
                                            t.loaded()
                                        } else t.snd_win = new window.game_slots_sound("/audio/games/slots/win.wav", function() {
                                            t.loading_idx++, t.lbl_load_update(), t.load()
                                        });
                    else t.snd_stop = new window.game_slots_sound("/audio/games/slots/stop.wav", function() {
                        t.loading_idx++, t.lbl_load_update(), t.load()
                    });
                    else t.snd_start = new window.game_slots_sound("/audio/games/slots/start.wav", function() {
                        t.loading_idx++, t.lbl_load_update(), t.load()
                    });
                    else t.snd_spin = new window.game_slots_sound("/audio/games/slots/spin.wav", function() {
                        t.snd_spin.is_loop = !0, t.loading_idx++, t.lbl_load_update(), t.load()
                    });
                    else t.snd_lose = new window.game_slots_sound("/audio/games/slots/lose.wav", function() {
                        t.loading_idx++, t.lbl_load_update(), t.load()
                    });
                    else t.snd_click = new window.game_slots_sound("/audio/games/slots/click.wav", function() {
                        t.loading_idx++, t.lbl_load_update(), t.load()
                    })
                },
                loaded: function(e) {
                    for (var n in t.check_bet(), t.reels_ld) t.reels.push(new game_slots_reel(n, t.reels_ld[n], t));
                    for (var n in t.btn_spin.addEventListener("click", t.btn_spin_click), t.btns_line) t.btns_line[n].addEventListener("mouseover", t.btn_line_over), t.btns_line[n].addEventListener("mouseout", t.btn_line_out), t.btns_line[n].addEventListener("click", t.btn_line_click);
                    t.btn_line_plus.addEventListener("click", t.btn_line_plus_click), t.btn_line_minus.addEventListener("click", t.btn_line_minus_click), t.btn_bet_plus.addEventListener("click", t.btn_bet_plus_click), t.btn_bet_minus.addEventListener("click", t.btn_bet_minus_click), t.btn_bet_max.addEventListener("click", t.btn_bet_max_click), t.btn_sound.addEventListener("click", t.btn_sound_click), t.btn_paytable.addEventListener("click", t.btn_paytable_click), t.game_slots_paytable_data.getElementsByClassName("remove")[0].addEventListener("click", t.btn_paytable_hide_click);
                    var i = t.game_slots_paytable_data.getElementsByClassName("switcher");
                    for (var n in i) "object" == o(i[n]) && i[n].addEventListener("click", t.btn_paytable_section_click);
                    for (var n in t.reels[4].onspinned = t.game_result_request, t.reels) t.reels[n].onstopped = t.gamestop;
                    t.t = Date.now(), t.container.classList.add("loaded"), t.run()
                },
                resize: function() {
                    t.container.offsetWidth / t.container.offsetHeight < 1.5 ? (t.container_inner.style.transform = "translate(-50%,0) scale(" + (t.container.offsetWidth / 1620).toFixed(4) + ")", t.container_inner.style.width = 1620..toFixed(8) + "px") : (t.container_inner.style.transform = "translate(-50%,0) scale(" + (t.container.offsetHeight / 1080).toFixed(4) + ")", t.container_inner.style.width = (t.container.offsetWidth / (t.container.offsetHeight / 1080)).toFixed(8) + "px")
                },
                onchange_window_state: function(e) {
                    t.requestAnimationFrame_get(), t.requestAnimationFrame(function() {
                        t.canvas.style.display = "none", t.requestAnimationFrame(function() {
                            t.canvas.style.display = "block"
                        })
                    })
                },
                lbl_load_update: function() {
                    this.loading_idx > this.loading_cnt && (this.loading_idx = this.loading_cnt), this.lbl_load(Math.round(100 * this.loading_idx / this.loading_cnt))
                },
                lbl_load: function(e) {
                    this.label_preloader_percent.textContent = e + "%"
                },
                game_result_request: function() {
                    s.a.post(t.query_play, {
                        game_id: t.game_id,
                        lines_count: t.lines_count,
                        bet: t.bet,
                        seed: t.client_seed.value || parseInt(1e6 * Math.random())
                    }).then(function(e) {
                        t.game_result = e.data, e.data.gameable.reel_positions ? (e.data.gameable.reel_positions = e.data.gameable.reel_positions.split(","), setTimeout(function() {
                            t.reels[0].stopSpin(e.data.gameable.reel_positions[0])
                        }, 0), setTimeout(function() {
                            t.reels[1].stopSpin(e.data.gameable.reel_positions[1])
                        }, 500), setTimeout(function() {
                            t.reels[2].stopSpin(e.data.gameable.reel_positions[2])
                        }, 1e3), setTimeout(function() {
                            t.reels[3].stopSpin(e.data.gameable.reel_positions[3])
                        }, 1500), setTimeout(function() {
                            t.reels[4].stopSpin(e.data.gameable.reel_positions[4])
                        }, 2e3), t.game_id = e.data.next_game.id, setTimeout(function() {
                            return t.server_hash.value = e.data.next_game.server_hash
                        }, 2e3)) : (t.reels[0].stopSpin(0), t.reels[1].stopSpin(0), t.reels[2].stopSpin(0), t.reels[3].stopSpin(0), t.reels[4].stopSpin(0))
                    }).catch(function(e) {})
                },
                gamestop: function() {
                    t.is_sound && t.snd_stop.play();
                    var e = 0;
                    for (var n in t.reels) e += t.reels[n].is_spinning ? 1 : 0;
                    0 == e && (t.is_sound && t.snd_spin.stop(), t.gameshowresult())
                },
                gameshowresult: function() {
                    if (t.game_result.account.balance && (t.balance = t.game_result.account.balance), t.updateUIText(), t.win_loop = [], t.game_result.error) t.label_win.innerHTML = t.game_result.error, t.label_win_total.textContent = "";
                    else if (t.label_win.innerHTML = "", t.label_win_total.textContent = "", !t.game_result.gameable.scatters_count && !t.game_result.gameable.lines_win || 0 == t.game_result.win) t.label_win.innerHTML = Object(a.a)("No luck. Try again.");
                    else {
                        if (t.game_result.gameable.scatters_count && (t.label_win.innerHTML = t.game_result.gameable.scatters_count + " " + (1 == t.game_result.gameable.scatters_count ? Object(a.a)("scatter") : Object(a.a)("scatters")) + " ", t.win_loop.push({
                                type: "scatter",
                                text: t.game_result.gameable.scatters_count + " " + (1 == t.game_result.gameable.scatters_count ? Object(a.a)("scatter") : Object(a.a)("scatters")) + "<br>" + Object(a.a)("Win") + " " + t.game_result.gameable.win_scatters_ttl
                            })), t.game_result.gameable.lines_win)
                            for (var e in t.label_win.innerHTML += t.game_result.gameable.lines_win + " " + (1 == t.game_result.gameable.lines_win ? Object(a.a)("line") : Object(a.a)("lines")) + " ", t.game_result.gameable.win_lines) isNaN(e) || t.win_loop.push({
                                type: "line",
                                idx: e,
                                text: Object(a.a)("Line") + " " + (parseInt(e) + 1) + "<br>" + Object(a.a)("Win") + " " + t.game_result.gameable.win_lines_ttl[e]
                            });
                        for (var n in t.label_win_total.textContent = Object(a.a)("Total win " + t.game_result.win), t.game_result.gameable.win_lines) {
                            var i = t.game_result.gameable.win_lines[n];
                            for (var s in t.btns_line[parseInt(n) + 1].classList.add("blink"), t.reels) void 0 != i[s] && i[s] >= 0 && t.reels[s].win_add(i[s])
                        }
                        for (var n in t.game_result.gameable.win_scatters) {
                            var l = t.game_result.gameable.win_scatters[n];
                            if ("object" == (void 0 === l ? "undefined" : o(l)) && l.length)
                                for (var s in l) t.reels[n].win_add(l[s])
                        }
                    }
                    t.win_loop.length ? t.is_sound && t.snd_win.play() : t.is_sound && t.snd_lose.play(), setTimeout(t.gameshowresult_demo, 2e3)
                },
                gameshowresult_demo: function() {
                    for (var e in t.reels) t.reels[e].win_clear();
                    for (var e in t.lines) t.lines[e].hide();
                    for (var e in t.btns_line) t.btns_line[e].classList.remove("blink");
                    for (var n in t.btn_spin.disabled = !1, t.btn_bet_minus.disabled = !1, t.btn_bet_plus.disabled = !1, t.btn_bet_max.disabled = !1, t.btn_line_minus.disabled = !1, t.btn_line_plus.disabled = !1, t.btns_line) t.btns_line[n].disabled = !1;
                    t.t_show_demo = -1, t.is_show_demo = !0, t.check_bet()
                },
                updateUIText: function() {
                    t.label_balance.textContent = t.balance.toFixed(2), t.label_bet.textContent = t.bet >= 1 ? Math.round(t.bet) : Math.round(10 * t.bet) / 10, t.label_lines.textContent = t.lines_count
                },
                btn_spin_click: function() {
                    for (var e in t.label_win_total.textContent = "", t.reels) t.reels[e].win_clear();
                    for (var e in t.lines) t.lines[e].hide();
                    for (var e in t.btns_line) t.btns_line[e].classList.remove("blink");
                    for (var e in t.label_win.textContent = "", t.is_show_demo = !1, t.reels) t.reels[e].win_clear();
                    for (var n in t.btn_spin.disabled = !0, t.btn_bet_minus.disabled = !0, t.btn_bet_plus.disabled = !0, t.btn_bet_max.disabled = !0, t.btn_line_minus.disabled = !0, t.btn_line_plus.disabled = !0, t.btns_line) t.btns_line[n].disabled = !0;
                    t.balance -= t.bet * t.lines_count, t.updateUIText(), t.is_sound && t.snd_start.play(), setTimeout(function() {
                        t.reels[0].startSpin(), t.is_sound && t.snd_start.play()
                    }, 0), setTimeout(function() {
                        t.reels[1].startSpin(), t.is_sound && t.snd_start.play()
                    }, 250), setTimeout(function() {
                        t.reels[2].startSpin(), t.is_sound && t.snd_start.play()
                    }, 500), setTimeout(function() {
                        t.reels[3].startSpin(), t.is_sound && t.snd_start.play()
                    }, 750), setTimeout(function() {
                        t.reels[4].startSpin(), t.is_sound && t.snd_start.play(), t.is_sound && t.snd_spin.play()
                    }, 1e3)
                },
                btn_line_over: function() {
                    for (var e in t.lines) t.lines[e].hide();
                    for (var e in t.btns_line) t.btns_line[e].classList.remove("blink");
                    t.is_line_showig = !0, t.lines[this.dataset.line - 1] && t.lines[this.dataset.line - 1].show()
                },
                btn_line_out: function() {
                    t.is_line_showig = !1, t.lines[this.dataset.line - 1] && t.lines[this.dataset.line - 1].hide()
                },
                btn_line_click: function() {
                    t.is_sound && t.snd_click.play(), t.lines_count = parseInt(this.dataset.line), t.lines_count_update()
                },
                btn_line_plus_click: function() {
                    t.is_sound && t.snd_click.play(), t.lines_count < t.max_lines && t.lines_count++, t.lines_count_update()
                },
                btn_line_minus_click: function() {
                    t.is_sound && t.snd_click.play(), t.lines_count > 1 && t.lines_count--, t.lines_count_update()
                },
                btn_bet_minus_click: function() {
                    if (t.bet <= t.min_bet) return !1;
                    t.is_sound && t.snd_click.play(), t.bet -= t.bet_change_amount, t.check_bet(), t.updateUIText()
                },
                btn_bet_plus_click: function() {
                    if (t.bet >= t.max_bet) return !1;
                    t.is_sound && t.snd_click.play(), t.bet += t.bet_change_amount, t.check_bet(), t.updateUIText()
                },
                btn_bet_max_click: function() {
                    t.is_sound && t.snd_click.play(), t.lines_count = t.max_lines, t.bet = Math.min(t.max_bet, Math.max(t.min_bet, Math.floor(t.balance / t.lines_count))), t.check_bet(), t.updateUIText()
                },
                check_bet: function() {
                    t.bet < t.min_bet && (t.bet = t.min_bet), t.bet == t.min_bet ? t.btn_bet_minus.disabled = !0 : t.btn_bet_minus.disabled = !1, t.bet > t.max_bet && (t.bet = t.max_bet), t.bet == t.max_bet || t.lines_count * (t.bet + t.bet_change_amount) > t.balance ? t.btn_bet_plus.disabled = !0 : t.btn_bet_plus.disabled = !1, t.balance < t.lines_count * t.bet ? (t.btn_bet_plus.disabled = !0, t.btn_spin.disabled = !0, t.label_win.innerHTML = t.balance_warn_text) : (t.btn_bet_plus.disabled || (t.btn_bet_plus.disabled = !1), t.btn_spin.disabled = !1, t.label_win.innerHTML == t.balance_warn_text && (t.label_win.innerHTML = ""))
                },
                lines_count_update: function() {
                    t.check_bet(), t.lines_count_show(), t.updateUIText()
                },
                lines_count_show: function() {
                    for (var e in t.lines) t.lines[e].hide();
                    for (var n in t.lines_show_demo = t.lines_count, t.lines_show_c = 0, t.lines_show_demo_t = 1, t.btns_line) t.btns_line[n].disabled = !0
                },
                render: function() {
                    if (t.is_show_demo && t.win_loop.length > 0) {
                        for (; - 1 == t.t_show_demo || t.t_show_demo > 2e3;) {
                            t.t_show_demo -= 2e3, t.t_show_demo < 0 && (t.t_show_demo = 0);
                            var e = t.win_loop.shift();
                            for (var n in t.win_loop.push(e), t.reels) t.reels[n].win_clear();
                            if (!t.is_line_showig) {
                                for (var n in t.lines) t.lines[n].hide();
                                for (var n in t.btns_line) t.btns_line[n].classList.remove("blink")
                            }
                            if ("scatter" == e.type)
                                for (var i in t.label_win.innerHTML = e.text, t.game_result.gameable.win_scatters) {
                                    var s = t.game_result.gameable.win_scatters[i];
                                    if ("object" == (void 0 === s ? "undefined" : o(s)) && s.length)
                                        for (var n in s) t.reels[i].win_add(s[n])
                                } else {
                                    t.label_win.innerHTML = e.text, t.is_line_showig || (t.btns_line[parseInt(e.idx) + 1].classList.add("blink"), t.lines[parseInt(e.idx)].show());
                                    var a = t.game_result.gameable.win_lines[e.idx];
                                    for (var n in t.reels) void 0 != a[n] && a[n] >= 0 && t.reels[n].win_add(a[n])
                                }
                        }
                        t.t_show_demo += Date.now() - t.t
                    }
                    if (-1 != t.lines_show_demo) {
                        if (t.lines_show_demo_t > 0)
                            if (0 != t.lines_show_c && t.lines[t.lines_show_c - 1].hide(), t.lines_show_c == t.lines_show_demo)
                                for (var i in t.lines[t.lines_show_demo - 1].show(), t.lines_show_demo = -1, t.lines_show_c = 0, t.btns_line) t.btns_line[i].disabled = !1;
                            else t.lines[t.lines_show_c].show(), t.lines_show_c++, t.lines_show_demo_t -= 50;
                        t.lines_show_demo_t += Date.now() - t.t
                    }
                    var l = t.canvas.getContext("2d");
                    for (var i in l.clearRect(0, 0, t.canvas.width, t.canvas.height), t.t = Date.now(), t.reels) t.reels[i].draw();
                    if (!t.is_line_showig && -1 == t.lines_show_demo)
                        for (var i in t.lines) t.lines[i].draw();
                    for (var i in t.reels) t.reels[i].drawWin();
                    if (t.is_line_showig || -1 != t.lines_show_demo)
                        for (var i in t.lines) t.lines[i].draw();
                    for (var i in t.lines) t.lines[i].calculate();
                    for (var i in t.reels) t.reels[i].calculate()
                },
                run: function() {
                    setInterval(function() {
                        t.requestAnimationFrame(t.render)
                    }, 40)
                },
                btn_sound_click: function() {
                    t.is_sound ? (t.is_sound = !1, t.btn_sound.classList.add("off"), t.snd_click.stop(), t.snd_lose.stop(), t.snd_spin.stop(), t.snd_start.stop(), t.snd_stop.stop(), t.snd_win.stop()) : (t.is_sound = !0, t.btn_sound.classList.remove("off"), t.snd_click.play())
                },
                btn_paytable_click: function() {
                    t.game_slots_paytable_data.classList.add("show")
                },
                btn_paytable_section_click: function() {
                    var e = t.game_slots_paytable_data.getElementsByClassName("switcher");
                    for (var n in e) "object" == o(e[n]) && e[n].classList.remove("active");
                    this.classList.add("active");
                    var i = this.dataset.section,
                        s = t.game_slots_paytable_data.getElementsByClassName("section-paytable");
                    for (var n in s) "object" == o(s[n]) && (s[n].dataset.section == i ? s[n].classList.add("show") : s[n].classList.remove("show"))
                },
                btn_paytable_hide_click: function() {
                    t.game_slots_paytable_data.classList.remove("show")
                }
            };
            return t.init(e)
        }
    },
    HNiq: function(e, t, n) {
        "use strict";
        t.a = function(e) {
            return void 0 !== window.i18n && void 0 !== window.i18n[e] ? window.i18n[e] : e
        }, t.b = function(e) {
            return void 0 !== window.cfg ? function(e, t) {
                var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null;
                return t.split(".").reduce(function(e, t) {
                    return e && void 0 != a(e[t]) && null != e[t] ? e[t] : n
                }, e)
            }(window.cfg, e) : e
        }, t.c = function(e) {
            e.select();
            try {
                document.execCommand("copy")
            } catch (e) {}
            document.getSelection().removeAllRanges(), document.activeElement.blur()
        }, t.g = function(e, t, n, i) {
            new(s.a.extend(e))({
                propsData: i,
                parent: t
            }).$mount(n)
        }, t.e = function(e) {
            return !isNaN(parseFloat(e)) && isFinite(e)
        }, t.h = function(e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 0,
                n = Math.pow(10, t);
            return Math.round(e * n) / n
        }, t.f = function(e, t, n) {
            e = "" + e;
            for (; e.length < n;) e = t + e;
            return e
        }, t.d = o, t.i = function(e) {
            o() ? document.exitFullscreen ? document.exitFullscreen() : document.webkitExitFullscreen ? document.webkitExitFullscreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.msExitFullscreen && document.msExitFullscreen() : e.requestFullscreen ? e.requestFullscreen() : e.mozRequestFullScreen ? e.mozRequestFullScreen() : e.webkitRequestFullScreen ? e.webkitRequestFullScreen() : e.msRequestFullscreen && e.msRequestFullscreen()
        };
        var i = n("I3G/"),
            s = n.n(i),
            a = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            };

        function o(e) {
            return document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement
        }
    },
    "Ky+F": function(e, t) {},
    PWuC: function(e, t) {},
    QGAl: function(e, t) {},
    V0Fp: function(e, t) {},
    WHGz: function(e, t) {},
    Y2EE: function(e, t) {},
    Z3mU: function(e, t) {},
    ZN9n: function(e, t) {},
    byej: function(e, t) {},
    d0W6: function(e, t) {},
    lFvb: function(e, t) {},
    nTfl: function(e, t) {},
    qJ1m: function(e, t) {},
    rqKu: function(e, t) {},
    ufoq: function(e, t) {},
    viqD: function(e, t) {}
}, [0]);