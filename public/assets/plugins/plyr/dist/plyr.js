!(function (e, t) {
	"use strict";
	"object" == typeof module && "object" == typeof module.exports
		? (module.exports = t(e, document))
		: "function" == typeof define && define.amd
		? define([], function () {
				return t(e, document);
		  })
		: (e.plyr = t(e, document));
})("undefined" != typeof window ? window : this, function (e, t) {
	"use strict";
	function n() {
		var e,
			n,
			r,
			a = navigator.userAgent,
			s = navigator.appName,
			o = "" + parseFloat(navigator.appVersion),
			i = parseInt(navigator.appVersion, 10),
			l = !1,
			u = !1,
			c = !1,
			d = !1;
		return (
			-1 !== navigator.appVersion.indexOf("Windows NT") &&
			-1 !== navigator.appVersion.indexOf("rv:11")
				? ((l = !0), (s = "IE"), (o = "11"))
				: -1 !== (n = a.indexOf("MSIE"))
				? ((l = !0), (s = "IE"), (o = a.substring(n + 5)))
				: -1 !== (n = a.indexOf("Chrome"))
				? ((c = !0), (s = "Chrome"), (o = a.substring(n + 7)))
				: -1 !== (n = a.indexOf("Safari"))
				? ((d = !0),
				  (s = "Safari"),
				  (o = a.substring(n + 7)),
				  -1 !== (n = a.indexOf("Version")) && (o = a.substring(n + 8)))
				: -1 !== (n = a.indexOf("Firefox"))
				? ((u = !0), (s = "Firefox"), (o = a.substring(n + 8)))
				: (e = a.lastIndexOf(" ") + 1) < (n = a.lastIndexOf("/")) &&
				  ((s = a.substring(e, n)),
				  (o = a.substring(n + 1)),
				  s.toLowerCase() === s.toUpperCase() && (s = navigator.appName)),
			-1 !== (r = o.indexOf(";")) && (o = o.substring(0, r)),
			-1 !== (r = o.indexOf(" ")) && (o = o.substring(0, r)),
			(i = parseInt("" + o, 10)),
			isNaN(i) &&
				((o = "" + parseFloat(navigator.appVersion)),
				(i = parseInt(navigator.appVersion, 10))),
			{
				name: s,
				version: i,
				isIE: l,
				isFirefox: u,
				isChrome: c,
				isSafari: d,
				isIos: /(iPad|iPhone|iPod)/g.test(navigator.platform),
				isIphone: /(iPhone|iPod)/g.test(navigator.userAgent),
				isTouch: "ontouchstart" in t.documentElement,
			}
		);
	}
	function r(e, t) {
		var n = e.media;
		if ("video" === e.type)
			switch (t) {
				case "video/webm":
					return !(
						!n.canPlayType ||
						!n.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/no/, "")
					);
				case "video/mp4":
					return !(
						!n.canPlayType ||
						!n
							.canPlayType('video/mp4; codecs="avc1.42E01E, mp4a.40.2"')
							.replace(/no/, "")
					);
				case "video/ogg":
					return !(
						!n.canPlayType ||
						!n.canPlayType('video/ogg; codecs="theora"').replace(/no/, "")
					);
			}
		else if ("audio" === e.type)
			switch (t) {
				case "audio/mpeg":
					return !(
						!n.canPlayType || !n.canPlayType("audio/mpeg;").replace(/no/, "")
					);
				case "audio/ogg":
					return !(
						!n.canPlayType ||
						!n.canPlayType('audio/ogg; codecs="vorbis"').replace(/no/, "")
					);
				case "audio/wav":
					return !(
						!n.canPlayType ||
						!n.canPlayType('audio/wav; codecs="1"').replace(/no/, "")
					);
			}
		return !1;
	}
	function a(e) {
		if (!t.querySelectorAll('script[src="' + e + '"]').length) {
			var n = t.createElement("script");
			n.src = e;
			var r = t.getElementsByTagName("script")[0];
			r.parentNode.insertBefore(n, r);
		}
	}
	function s(e, t) {
		return Array.prototype.indexOf && -1 !== e.indexOf(t);
	}
	function o(e, t, n) {
		return e.replace(
			new RegExp(t.replace(/([.*+?\^=!:${}()|\[\]\/\\])/g, "\\$1"), "g"),
			n
		);
	}
	function i(e, t) {
		e.length || (e = [e]);
		for (var n = e.length - 1; n >= 0; n--) {
			var r = n > 0 ? t.cloneNode(!0) : t,
				a = e[n],
				s = a.parentNode,
				o = a.nextSibling;
			return r.appendChild(a), o ? s.insertBefore(r, o) : s.appendChild(r), r;
		}
	}
	function l(e) {
		e && e.parentNode.removeChild(e);
	}
	function u(e, t) {
		e.insertBefore(t, e.firstChild);
	}
	function c(e, t) {
		for (var n in t) e.setAttribute(n, O.boolean(t[n]) && t[n] ? "" : t[n]);
	}
	function d(e, n, r) {
		var a = t.createElement(e);
		c(a, r), u(n, a);
	}
	function p(e) {
		return e.replace(".", "");
	}
	function m(e, t, n) {
		if (e)
			if (e.classList) e.classList[n ? "add" : "remove"](t);
			else {
				var r = (" " + e.className + " ")
					.replace(/\s+/g, " ")
					.replace(" " + t + " ", "");
				e.className = r + (n ? " " + t : "");
			}
	}
	function f(e, t) {
		return (
			!!e &&
			(e.classList
				? e.classList.contains(t)
				: new RegExp("(\\s|^)" + t + "(\\s|$)").test(e.className))
		);
	}
	function y(e, n) {
		var r = Element.prototype;
		return (
			r.matches ||
			r.webkitMatchesSelector ||
			r.mozMatchesSelector ||
			r.msMatchesSelector ||
			function (e) {
				return -1 !== [].indexOf.call(t.querySelectorAll(e), this);
			}
		).call(e, n);
	}
	function b(e, t, n, r, a) {
		n &&
			g(
				e,
				t,
				function (t) {
					n.apply(e, [t]);
				},
				a
			),
			g(
				e,
				t,
				function (t) {
					r.apply(e, [t]);
				},
				a
			);
	}
	function v(e, t, n, r, a) {
		var s = t.split(" ");
		if ((O.boolean(a) || (a = !1), e instanceof NodeList))
			for (var o = 0; o < e.length; o++)
				e[o] instanceof Node &&
					v(e[o], arguments[1], arguments[2], arguments[3]);
		else
			for (var i = 0; i < s.length; i++)
				e[r ? "addEventListener" : "removeEventListener"](s[i], n, a);
	}
	function g(e, t, n, r) {
		e && v(e, t, n, !0, r);
	}
	function h(e, t, n, r) {
		e && v(e, t, n, !1, r);
	}
	function k(e, t, n, r) {
		if (e && t) {
			O.boolean(n) || (n = !1);
			var a = new CustomEvent(t, { bubbles: n, detail: r });
			e.dispatchEvent(a);
		}
	}
	function w(e, t) {
		if (e)
			return (
				(t = O.boolean(t) ? t : !e.getAttribute("aria-pressed")),
				e.setAttribute("aria-pressed", t),
				t
			);
	}
	function x(e, t) {
		return 0 === e || 0 === t || isNaN(e) || isNaN(t)
			? 0
			: ((e / t) * 100).toFixed(2);
	}
	function T() {
		var e = arguments;
		if (e.length) {
			if (1 === e.length) return e[0];
			for (
				var t = Array.prototype.shift.call(e), n = e.length, r = 0;
				r < n;
				r++
			) {
				var a = e[r];
				for (var s in a)
					a[s] && a[s].constructor && a[s].constructor === Object
						? ((t[s] = t[s] || {}), T(t[s], a[s]))
						: (t[s] = a[s]);
			}
			return t;
		}
	}
	function S(e) {
		return e.match(
			/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/
		)
			? RegExp.$2
			: e;
	}
	function E(e) {
		return e.match(/^.*(vimeo.com\/|video\/)(\d+).*/) ? RegExp.$2 : e;
	}
	function _() {
		var e = {
				supportsFullScreen: !1,
				isFullScreen: function () {
					return !1;
				},
				requestFullScreen: function () {},
				cancelFullScreen: function () {},
				fullScreenEventName: "",
				element: null,
				prefix: "",
			},
			n = "webkit o moz ms khtml".split(" ");
		if (O.undefined(t.cancelFullScreen))
			for (var r = 0, a = n.length; r < a; r++) {
				if (
					((e.prefix = n[r]), !O.undefined(t[e.prefix + "CancelFullScreen"]))
				) {
					e.supportsFullScreen = !0;
					break;
				}
				if (!O.undefined(t.msExitFullscreen) && t.msFullscreenEnabled) {
					(e.prefix = "ms"), (e.supportsFullScreen = !0);
					break;
				}
			}
		else e.supportsFullScreen = !0;
		return (
			e.supportsFullScreen &&
				((e.fullScreenEventName =
					"ms" === e.prefix
						? "MSFullscreenChange"
						: e.prefix + "fullscreenchange"),
				(e.isFullScreen = function (e) {
					switch ((O.undefined(e) && (e = t.body), this.prefix)) {
						case "":
							return t.fullscreenElement === e;
						case "moz":
							return t.mozFullScreenElement === e;
						default:
							return t[this.prefix + "FullscreenElement"] === e;
					}
				}),
				(e.requestFullScreen = function (e) {
					return (
						O.undefined(e) && (e = t.body),
						"" === this.prefix
							? e.requestFullScreen()
							: e[
									this.prefix +
										("ms" === this.prefix
											? "RequestFullscreen"
											: "RequestFullScreen")
							  ]()
					);
				}),
				(e.cancelFullScreen = function () {
					return "" === this.prefix
						? t.cancelFullScreen()
						: t[
								this.prefix +
									("ms" === this.prefix ? "ExitFullscreen" : "CancelFullScreen")
						  ]();
				}),
				(e.element = function () {
					return "" === this.prefix
						? t.fullscreenElement
						: t[this.prefix + "FullscreenElement"];
				})),
			e
		);
	}
	function C(v, C) {
		function j(e, t, n, r) {
			k(e, t, n, T({}, r, { plyr: We }));
		}
		function R(t, n) {
			C.debug &&
				e.console &&
				((n = Array.prototype.slice.call(n)),
				O.string(C.logPrefix) && C.logPrefix.length && n.unshift(C.logPrefix),
				console[t].apply(console, n));
		}
		function V() {
			return {
				url: C.iconUrl,
				absolute:
					0 === C.iconUrl.indexOf("http") ||
					(Ye.browser.isIE && !e.svg4everybody),
			};
		}
		function q() {
			var e = [],
				t = V(),
				n = (t.absolute ? "" : t.url) + "#" + C.iconPrefix;
			return (
				s(C.controls, "play-large") &&
					e.push(
						'<button type="button" data-plyr="play" class="plyr__play-large">',
						'<svg><use xlink:href="' + n + '-play" /></svg>',
						'<span class="plyr__sr-only">' + C.i18n.play + "</span>",
						"</button>"
					),
				e.push('<div class="plyr__controls">'),
				s(C.controls, "restart") &&
					e.push(
						'<button type="button" data-plyr="restart">',
						'<svg><use xlink:href="' + n + '-restart" /></svg>',
						'<span class="plyr__sr-only">' + C.i18n.restart + "</span>",
						"</button>"
					),
				s(C.controls, "rewind") &&
					e.push(
						'<button type="button" data-plyr="rewind">',
						'<svg><use xlink:href="' + n + '-rewind" /></svg>',
						'<span class="plyr__sr-only">' + C.i18n.rewind + "</span>",
						"</button>"
					),
				s(C.controls, "play") &&
					e.push(
						'<button type="button" data-plyr="play">',
						'<svg><use xlink:href="' + n + '-play" /></svg>',
						'<span class="plyr__sr-only">' + C.i18n.play + "</span>",
						"</button>",
						'<button type="button" data-plyr="pause">',
						'<svg><use xlink:href="' + n + '-pause" /></svg>',
						'<span class="plyr__sr-only">' + C.i18n.pause + "</span>",
						"</button>"
					),
				s(C.controls, "fast-forward") &&
					e.push(
						'<button type="button" data-plyr="fast-forward">',
						'<svg><use xlink:href="' + n + '-fast-forward" /></svg>',
						'<span class="plyr__sr-only">' + C.i18n.forward + "</span>",
						"</button>"
					),
				s(C.controls, "progress") &&
					(e.push(
						'<span class="plyr__progress">',
						'<label for="seek{id}" class="plyr__sr-only">Seek</label>',
						'<input id="seek{id}" class="plyr__progress--seek" type="range" min="0" max="100" step="0.1" value="0" data-plyr="seek">',
						'<progress class="plyr__progress--played" max="100" value="0" role="presentation"></progress>',
						'<progress class="plyr__progress--buffer" max="100" value="0">',
						"<span>0</span>% " + C.i18n.buffered,
						"</progress>"
					),
					C.tooltips.seek && e.push('<span class="plyr__tooltip">00:00</span>'),
					e.push("</span>")),
				s(C.controls, "current-time") &&
					e.push(
						'<span class="plyr__time">',
						'<span class="plyr__sr-only">' + C.i18n.currentTime + "</span>",
						'<span class="plyr__time--current">00:00</span>',
						"</span>"
					),
				s(C.controls, "duration") &&
					e.push(
						'<span class="plyr__time">',
						'<span class="plyr__sr-only">' + C.i18n.duration + "</span>",
						'<span class="plyr__time--duration">00:00</span>',
						"</span>"
					),
				s(C.controls, "mute") &&
					e.push(
						'<button type="button" data-plyr="mute">',
						'<svg class="icon--muted"><use xlink:href="' +
							n +
							'-muted" /></svg>',
						'<svg><use xlink:href="' + n + '-volume" /></svg>',
						'<span class="plyr__sr-only">' + C.i18n.toggleMute + "</span>",
						"</button>"
					),
				s(C.controls, "volume") &&
					e.push(
						'<span class="plyr__volume">',
						'<label for="volume{id}" class="plyr__sr-only">' +
							C.i18n.volume +
							"</label>",
						'<input id="volume{id}" class="plyr__volume--input" type="range" min="' +
							C.volumeMin +
							'" max="' +
							C.volumeMax +
							'" value="' +
							C.volume +
							'" data-plyr="volume">',
						'<progress class="plyr__volume--display" max="' +
							C.volumeMax +
							'" value="' +
							C.volumeMin +
							'" role="presentation"></progress>',
						"</span>"
					),
				s(C.controls, "captions") &&
					e.push(
						'<button type="button" data-plyr="captions">',
						'<svg class="icon--captions-on"><use xlink:href="' +
							n +
							'-captions-on" /></svg>',
						'<svg><use xlink:href="' + n + '-captions-off" /></svg>',
						'<span class="plyr__sr-only">' + C.i18n.toggleCaptions + "</span>",
						"</button>"
					),
				s(C.controls, "fullscreen") &&
					e.push(
						'<button type="button" data-plyr="fullscreen">',
						'<svg class="icon--exit-fullscreen"><use xlink:href="' +
							n +
							'-exit-fullscreen" /></svg>',
						'<svg><use xlink:href="' + n + '-enter-fullscreen" /></svg>',
						'<span class="plyr__sr-only">' +
							C.i18n.toggleFullscreen +
							"</span>",
						"</button>"
					),
				e.push("</div>"),
				e.join("")
			);
		}
		function D() {
			if (
				Ye.supported.full &&
				("audio" !== Ye.type || C.fullscreen.allowAudio) &&
				C.fullscreen.enabled
			) {
				var e = N.supportsFullScreen;
				e || (C.fullscreen.fallback && !$())
					? ($e((e ? "Native" : "Fallback") + " fullscreen enabled"),
					  e || m(Ye.container, C.classes.fullscreen.fallback, !0),
					  m(Ye.container, C.classes.fullscreen.enabled, !0))
					: $e("Fullscreen not supported and fallback disabled"),
					Ye.buttons && Ye.buttons.fullscreen && w(Ye.buttons.fullscreen, !1),
					J();
			}
		}
		function H() {
			if ("video" === Ye.type) {
				X(C.selectors.captions) ||
					Ye.videoContainer.insertAdjacentHTML(
						"afterbegin",
						'<div class="' + p(C.selectors.captions) + '"></div>'
					),
					(Ye.usingTextTracks = !1),
					Ye.media.textTracks && (Ye.usingTextTracks = !0);
				for (var e, t = "", n = Ye.media.childNodes, r = 0; r < n.length; r++)
					"track" === n[r].nodeName.toLowerCase() &&
						(("captions" !== (e = n[r].kind) && "subtitles" !== e) ||
							(t = n[r].getAttribute("src")));
				if (
					((Ye.captionExists = !0),
					"" === t
						? ((Ye.captionExists = !1), $e("No caption track found"))
						: $e("Caption track found; URI: " + t),
					Ye.captionExists)
				) {
					for (var a = Ye.media.textTracks, s = 0; s < a.length; s++)
						a[s].mode = "hidden";
					if (
						(Y(),
						((Ye.browser.isIE && Ye.browser.version >= 10) ||
							(Ye.browser.isFirefox && Ye.browser.version >= 31)) &&
							($e(
								"Detected browser with known TextTrack issues - using manual fallback"
							),
							(Ye.usingTextTracks = !1)),
						Ye.usingTextTracks)
					) {
						$e("TextTracks supported");
						for (var o = 0; o < a.length; o++) {
							var i = a[o];
							("captions" !== i.kind && "subtitles" !== i.kind) ||
								g(i, "cuechange", function () {
									this.activeCues[0] && "text" in this.activeCues[0]
										? U(this.activeCues[0].getCueAsHTML())
										: U();
								});
						}
					} else if (
						($e("TextTracks not supported so rendering captions manually"),
						(Ye.currentCaption = ""),
						(Ye.captions = []),
						"" !== t)
					) {
						var l = new XMLHttpRequest();
						(l.onreadystatechange = function () {
							if (4 === l.readyState)
								if (200 === l.status) {
									var e,
										t = [],
										n = l.responseText,
										r = "\r\n";
									-1 === n.indexOf(r + r) &&
										(r = -1 !== n.indexOf("\r\r") ? "\r" : "\n"),
										(t = n.split(r + r));
									for (var a = 0; a < t.length; a++) {
										(e = t[a]), (Ye.captions[a] = []);
										var s = e.split(r),
											o = 0;
										-1 === s[o].indexOf(":") && (o = 1),
											(Ye.captions[a] = [s[o], s[o + 1]]);
									}
									Ye.captions.shift(),
										$e("Successfully loaded the caption file via AJAX");
								} else
									Je(
										C.logPrefix +
											"There was a problem loading the caption file via AJAX"
									);
						}),
							l.open("get", t, !0),
							l.send();
					}
				} else m(Ye.container, C.classes.captions.enabled);
			}
		}
		function U(e) {
			var n = X(C.selectors.captions),
				r = t.createElement("span");
			(n.innerHTML = ""),
				O.undefined(e) && (e = ""),
				O.string(e) ? (r.innerHTML = e.trim()) : r.appendChild(e),
				n.appendChild(r);
			n.offsetHeight;
		}
		function W(e) {
			function t(e, t) {
				var n = [];
				n = e.split(" --\x3e ");
				for (var a = 0; a < n.length; a++)
					n[a] = n[a].replace(/(\d+:\d+:\d+\.\d+).*/, "$1");
				return r(n[t]);
			}
			function n(e) {
				return t(e, 1);
			}
			function r(e) {
				if (null === e || void 0 === e) return 0;
				var t = [],
					n = [];
				return (
					(t = e.split(",")),
					(n = t[0].split(":")),
					Math.floor(60 * n[0] * 60) + Math.floor(60 * n[1]) + Math.floor(n[2])
				);
			}
			if (
				!Ye.usingTextTracks &&
				"video" === Ye.type &&
				Ye.supported.full &&
				((Ye.subcount = 0),
				(e = O.number(e) ? e : Ye.media.currentTime),
				Ye.captions[Ye.subcount])
			) {
				for (; n(Ye.captions[Ye.subcount][0]) < e.toFixed(1); )
					if ((Ye.subcount++, Ye.subcount > Ye.captions.length - 1)) {
						Ye.subcount = Ye.captions.length - 1;
						break;
					}
				Ye.media.currentTime.toFixed(1) >=
					(function (e) {
						return t(e, 0);
					})(Ye.captions[Ye.subcount][0]) &&
				Ye.media.currentTime.toFixed(1) <= n(Ye.captions[Ye.subcount][0])
					? ((Ye.currentCaption = Ye.captions[Ye.subcount][1]),
					  U(Ye.currentCaption))
					: U();
			}
		}
		function Y() {
			if (Ye.buttons.captions) {
				m(Ye.container, C.classes.captions.enabled, !0);
				var e = Ye.storage.captionsEnabled;
				O.boolean(e) || (e = C.captions.defaultActive),
					e &&
						(m(Ye.container, C.classes.captions.active, !0),
						w(Ye.buttons.captions, !0));
			}
		}
		function B(e) {
			return Ye.container.querySelectorAll(e);
		}
		function X(e) {
			return B(e)[0];
		}
		function $() {
			try {
				return e.self !== e.top;
			} catch (e) {
				return !0;
			}
		}
		function J() {
			var e = B("input:not([disabled]), button:not([disabled])"),
				t = e[0],
				n = e[e.length - 1];
			g(Ye.container, "keydown", function (e) {
				9 === e.which &&
					Ye.isFullscreen &&
					(e.target !== n || e.shiftKey
						? e.target === t && e.shiftKey && (e.preventDefault(), n.focus())
						: (e.preventDefault(), t.focus()));
			});
		}
		function z(e, t) {
			if (O.string(t)) d(e, Ye.media, { src: t });
			else if (t.constructor === Array)
				for (var n = t.length - 1; n >= 0; n--) d(e, Ye.media, t[n]);
		}
		function G() {
			if (C.loadSprite) {
				var e = V();
				e.absolute
					? ($e(
							"AJAX loading absolute SVG sprite" +
								(Ye.browser.isIE ? " (due to IE)" : "")
					  ),
					  F(e.url, "sprite-plyr"))
					: $e("Sprite will be used as external resource directly");
			}
			var n = C.html;
			$e("Injecting custom controls"),
				n || (n = q()),
				(n = o(
					(n = o(n, "{seektime}", C.seekTime)),
					"{id}",
					Math.floor(1e4 * Math.random())
				)),
				C.title && (n = o(n, "{title}", C.title));
			var r;
			if (
				(O.string(C.selectors.controls.container) &&
					(r = t.querySelector(C.selectors.controls.container)),
				O.htmlElement(r) || (r = Ye.container),
				r.insertAdjacentHTML("beforeend", n),
				C.tooltips.controls)
			)
				for (
					var a = B(
							[
								C.selectors.controls.wrapper,
								" ",
								C.selectors.labels,
								" .",
								C.classes.hidden,
							].join("")
						),
						s = a.length - 1;
					s >= 0;
					s--
				) {
					var i = a[s];
					m(i, C.classes.hidden, !1), m(i, C.classes.tooltip, !0);
				}
		}
		function K() {
			try {
				return (
					(Ye.controls = X(C.selectors.controls.wrapper)),
					(Ye.buttons = {}),
					(Ye.buttons.seek = X(C.selectors.buttons.seek)),
					(Ye.buttons.play = B(C.selectors.buttons.play)),
					(Ye.buttons.pause = X(C.selectors.buttons.pause)),
					(Ye.buttons.restart = X(C.selectors.buttons.restart)),
					(Ye.buttons.rewind = X(C.selectors.buttons.rewind)),
					(Ye.buttons.forward = X(C.selectors.buttons.forward)),
					(Ye.buttons.fullscreen = X(C.selectors.buttons.fullscreen)),
					(Ye.buttons.mute = X(C.selectors.buttons.mute)),
					(Ye.buttons.captions = X(C.selectors.buttons.captions)),
					(Ye.progress = {}),
					(Ye.progress.container = X(C.selectors.progress.container)),
					(Ye.progress.buffer = {}),
					(Ye.progress.buffer.bar = X(C.selectors.progress.buffer)),
					(Ye.progress.buffer.text =
						Ye.progress.buffer.bar &&
						Ye.progress.buffer.bar.getElementsByTagName("span")[0]),
					(Ye.progress.played = X(C.selectors.progress.played)),
					(Ye.progress.tooltip =
						Ye.progress.container &&
						Ye.progress.container.querySelector("." + C.classes.tooltip)),
					(Ye.volume = {}),
					(Ye.volume.input = X(C.selectors.volume.input)),
					(Ye.volume.display = X(C.selectors.volume.display)),
					(Ye.duration = X(C.selectors.duration)),
					(Ye.currentTime = X(C.selectors.currentTime)),
					(Ye.seekTime = B(C.selectors.seekTime)),
					!0
				);
			} catch (e) {
				return (
					Je("It looks like there is a problem with your controls HTML"),
					Z(!0),
					!1
				);
			}
		}
		function Q() {
			m(
				Ye.container,
				C.selectors.container.replace(".", ""),
				Ye.supported.full
			);
		}
		function Z(e) {
			e && s(C.types.html5, Ye.type)
				? Ye.media.setAttribute("controls", "")
				: Ye.media.removeAttribute("controls");
		}
		function ee(e) {
			var t = C.i18n.play;
			if (
				(O.string(C.title) &&
					C.title.length &&
					((t += ", " + C.title),
					Ye.container.setAttribute("aria-label", C.title)),
				Ye.supported.full && Ye.buttons.play)
			)
				for (var n = Ye.buttons.play.length - 1; n >= 0; n--)
					Ye.buttons.play[n].setAttribute("aria-label", t);
			O.htmlElement(e) &&
				e.setAttribute("title", C.i18n.frameTitle.replace("{title}", C.title));
		}
		function te() {
			var t = null;
			(Ye.storage = {}),
				L.supported &&
					C.storage.enabled &&
					(e.localStorage.removeItem("plyr-volume"),
					(t = e.localStorage.getItem(C.storage.key)) &&
						(/^\d+(\.\d+)?$/.test(t)
							? ne({ volume: parseFloat(t) })
							: (Ye.storage = JSON.parse(t))));
		}
		function ne(t) {
			L.supported &&
				C.storage.enabled &&
				(T(Ye.storage, t),
				e.localStorage.setItem(C.storage.key, JSON.stringify(Ye.storage)));
		}
		function re() {
			if (Ye.media) {
				if (
					Ye.supported.full &&
					(m(Ye.container, C.classes.type.replace("{0}", Ye.type), !0),
					s(C.types.embed, Ye.type) &&
						m(Ye.container, C.classes.type.replace("{0}", "video"), !0),
					m(Ye.container, C.classes.stopped, C.autoplay),
					m(Ye.container, C.classes.isIos, Ye.browser.isIos),
					m(Ye.container, C.classes.isTouch, Ye.browser.isTouch),
					"video" === Ye.type)
				) {
					var e = t.createElement("div");
					e.setAttribute("class", C.classes.videoWrapper),
						i(Ye.media, e),
						(Ye.videoContainer = e);
				}
				s(C.types.embed, Ye.type) && ae();
			} else Je("No media element found!");
		}
		function ae() {
			var n,
				r = t.createElement("div"),
				s = Ye.type + "-" + Math.floor(1e4 * Math.random());
			switch (Ye.type) {
				case "youtube":
					n = S(Ye.embedId);
					break;
				case "vimeo":
					n = E(Ye.embedId);
					break;
				default:
					n = Ye.embedId;
			}
			for (var o = B('[id^="' + Ye.type + '-"]'), i = o.length - 1; i >= 0; i--)
				l(o[i]);
			if (
				(m(Ye.media, C.classes.videoWrapper, !0),
				m(Ye.media, C.classes.embedWrapper, !0),
				"youtube" === Ye.type)
			)
				Ye.media.appendChild(r),
					r.setAttribute("id", s),
					O.object(e.YT)
						? oe(n, r)
						: (a(C.urls.youtube.api),
						  (e.onYouTubeReadyCallbacks = e.onYouTubeReadyCallbacks || []),
						  e.onYouTubeReadyCallbacks.push(function () {
								oe(n, r);
						  }),
						  (e.onYouTubeIframeAPIReady = function () {
								e.onYouTubeReadyCallbacks.forEach(function (e) {
									e();
								});
						  }));
			else if ("vimeo" === Ye.type)
				if (
					(Ye.supported.full ? Ye.media.appendChild(r) : (r = Ye.media),
					r.setAttribute("id", s),
					O.object(e.Vimeo))
				)
					ie(n, r);
				else {
					a(C.urls.vimeo.api);
					var u = e.setInterval(function () {
						O.object(e.Vimeo) && (e.clearInterval(u), ie(n, r));
					}, 50);
				}
			else if ("soundcloud" === Ye.type) {
				var d = t.createElement("iframe");
				(d.loaded = !1),
					g(d, "load", function () {
						d.loaded = !0;
					}),
					c(d, {
						src:
							"https://w.soundcloud.com/player/?url=https://api.soundcloud.com/tracks/" +
							n,
						id: s,
					}),
					r.appendChild(d),
					Ye.media.appendChild(r),
					e.SC || a(C.urls.soundcloud.api);
				var p = e.setInterval(function () {
					e.SC && d.loaded && (e.clearInterval(p), le.call(d));
				}, 50);
			}
		}
		function se() {
			Ye.supported.full && (He(), Ue()), ee(X("iframe"));
		}
		function oe(t, n) {
			Ye.embed = new e.YT.Player(n.id, {
				videoId: t,
				playerVars: {
					autoplay: C.autoplay ? 1 : 0,
					controls: Ye.supported.full ? 0 : 1,
					rel: 0,
					showinfo: 0,
					iv_load_policy: 3,
					cc_load_policy: C.captions.defaultActive ? 1 : 0,
					cc_lang_pref: "en",
					wmode: "transparent",
					modestbranding: 1,
					disablekb: 1,
					origin: "*",
				},
				events: {
					onError: function (e) {
						j(Ye.container, "error", !0, { code: e.data, embed: e.target });
					},
					onReady: function (t) {
						var n = t.target;
						(Ye.media.play = function () {
							n.playVideo(), (Ye.media.paused = !1);
						}),
							(Ye.media.pause = function () {
								n.pauseVideo(), (Ye.media.paused = !0);
							}),
							(Ye.media.stop = function () {
								n.stopVideo(), (Ye.media.paused = !0);
							}),
							(Ye.media.duration = n.getDuration()),
							(Ye.media.paused = !0),
							(Ye.media.currentTime = 0),
							(Ye.media.muted = n.isMuted()),
							"function" == typeof n.getVideoData &&
								(C.title = n.getVideoData().title),
							Ye.supported.full &&
								Ye.media.querySelector("iframe").setAttribute("tabindex", "-1"),
							se(),
							j(Ye.media, "timeupdate"),
							j(Ye.media, "durationchange"),
							e.clearInterval(Be.buffering),
							(Be.buffering = e.setInterval(function () {
								(Ye.media.buffered = n.getVideoLoadedFraction()),
									(null === Ye.media.lastBuffered ||
										Ye.media.lastBuffered < Ye.media.buffered) &&
										j(Ye.media, "progress"),
									(Ye.media.lastBuffered = Ye.media.buffered),
									1 === Ye.media.buffered &&
										(e.clearInterval(Be.buffering),
										j(Ye.media, "canplaythrough"));
							}, 200));
					},
					onStateChange: function (t) {
						var n = t.target;
						switch ((e.clearInterval(Be.playing), t.data)) {
							case 0:
								(Ye.media.paused = !0), j(Ye.media, "ended");
								break;
							case 1:
								(Ye.media.paused = !1),
									Ye.media.seeking && j(Ye.media, "seeked"),
									(Ye.media.seeking = !1),
									j(Ye.media, "play"),
									j(Ye.media, "playing"),
									(Be.playing = e.setInterval(function () {
										(Ye.media.currentTime = n.getCurrentTime()),
											j(Ye.media, "timeupdate");
									}, 100)),
									Ye.media.duration !== n.getDuration() &&
										((Ye.media.duration = n.getDuration()),
										j(Ye.media, "durationchange"));
								break;
							case 2:
								(Ye.media.paused = !0), j(Ye.media, "pause");
						}
						j(Ye.container, "statechange", !1, { code: t.data });
					},
				},
			});
		}
		function ie(n, r) {
			var a = (function (e) {
					return Object.keys(e)
						.map(function (t) {
							return encodeURIComponent(t) + "=" + encodeURIComponent(e[t]);
						})
						.join("&");
				})({
					loop: C.loop,
					autoplay: C.autoplay,
					byline: !1,
					portrait: !1,
					title: !1,
					speed: !0,
					transparent: 0,
				}),
				s = t.createElement("iframe"),
				o = "https://player.vimeo.com/video/" + n + "?" + a;
			s.setAttribute("src", o),
				s.setAttribute("allowfullscreen", ""),
				r.appendChild(s),
				(Ye.embed = new e.Vimeo.Player(s)),
				(Ye.media.play = function () {
					Ye.embed.play(), (Ye.media.paused = !1);
				}),
				(Ye.media.pause = function () {
					Ye.embed.pause(), (Ye.media.paused = !0);
				}),
				(Ye.media.stop = function () {
					Ye.embed.stop(), (Ye.media.paused = !0);
				}),
				(Ye.media.paused = !0),
				(Ye.media.currentTime = 0),
				se(),
				Ye.embed.getCurrentTime().then(function (e) {
					(Ye.media.currentTime = e), j(Ye.media, "timeupdate");
				}),
				Ye.embed.getDuration().then(function (e) {
					(Ye.media.duration = e), j(Ye.media, "durationchange");
				}),
				Ye.embed.on("loaded", function () {
					O.htmlElement(Ye.embed.element) &&
						Ye.supported.full &&
						Ye.embed.element.setAttribute("tabindex", "-1");
				}),
				Ye.embed.on("play", function () {
					(Ye.media.paused = !1), j(Ye.media, "play"), j(Ye.media, "playing");
				}),
				Ye.embed.on("pause", function () {
					(Ye.media.paused = !0), j(Ye.media, "pause");
				}),
				Ye.embed.on("timeupdate", function (e) {
					(Ye.media.seeking = !1),
						(Ye.media.currentTime = e.seconds),
						j(Ye.media, "timeupdate");
				}),
				Ye.embed.on("progress", function (e) {
					(Ye.media.buffered = e.percent),
						j(Ye.media, "progress"),
						1 === parseInt(e.percent) && j(Ye.media, "canplaythrough");
				}),
				Ye.embed.on("seeked", function () {
					(Ye.media.seeking = !1), j(Ye.media, "seeked"), j(Ye.media, "play");
				}),
				Ye.embed.on("ended", function () {
					(Ye.media.paused = !0), j(Ye.media, "ended");
				});
		}
		function le() {
			(Ye.embed = e.SC.Widget(this)),
				Ye.embed.bind(e.SC.Widget.Events.READY, function () {
					(Ye.media.play = function () {
						Ye.embed.play(), (Ye.media.paused = !1);
					}),
						(Ye.media.pause = function () {
							Ye.embed.pause(), (Ye.media.paused = !0);
						}),
						(Ye.media.stop = function () {
							Ye.embed.seekTo(0), Ye.embed.pause(), (Ye.media.paused = !0);
						}),
						(Ye.media.paused = !0),
						(Ye.media.currentTime = 0),
						Ye.embed.getDuration(function (e) {
							(Ye.media.duration = e / 1e3), se();
						}),
						Ye.embed.getPosition(function (e) {
							(Ye.media.currentTime = e), j(Ye.media, "timeupdate");
						}),
						Ye.embed.bind(e.SC.Widget.Events.PLAY, function () {
							(Ye.media.paused = !1),
								j(Ye.media, "play"),
								j(Ye.media, "playing");
						}),
						Ye.embed.bind(e.SC.Widget.Events.PAUSE, function () {
							(Ye.media.paused = !0), j(Ye.media, "pause");
						}),
						Ye.embed.bind(e.SC.Widget.Events.PLAY_PROGRESS, function (e) {
							(Ye.media.seeking = !1),
								(Ye.media.currentTime = e.currentPosition / 1e3),
								j(Ye.media, "timeupdate");
						}),
						Ye.embed.bind(e.SC.Widget.Events.LOAD_PROGRESS, function (e) {
							(Ye.media.buffered = e.loadProgress),
								j(Ye.media, "progress"),
								1 === parseInt(e.loadProgress) && j(Ye.media, "canplaythrough");
						}),
						Ye.embed.bind(e.SC.Widget.Events.FINISH, function () {
							(Ye.media.paused = !0), j(Ye.media, "ended");
						});
				});
		}
		function ue() {
			"play" in Ye.media && Ye.media.play();
		}
		function ce() {
			"pause" in Ye.media && Ye.media.pause();
		}
		function de(e) {
			return O.boolean(e) || (e = Ye.media.paused), e ? ue() : ce(), e;
		}
		function pe(e) {
			O.number(e) || (e = C.seekTime), fe(Ye.media.currentTime - e);
		}
		function me(e) {
			O.number(e) || (e = C.seekTime), fe(Ye.media.currentTime + e);
		}
		function fe(e) {
			var t = 0,
				n = Ye.media.paused,
				r = ye();
			O.number(e)
				? (t = e)
				: O.object(e) &&
				  s(["input", "change"], e.type) &&
				  (t = (e.target.value / e.target.max) * r),
				t < 0 ? (t = 0) : t > r && (t = r),
				Pe(t);
			try {
				Ye.media.currentTime = t.toFixed(4);
			} catch (e) {}
			if (s(C.types.embed, Ye.type)) {
				switch (Ye.type) {
					case "youtube":
						Ye.embed.seekTo(t);
						break;
					case "vimeo":
						Ye.embed.setCurrentTime(t.toFixed(0));
						break;
					case "soundcloud":
						Ye.embed.seekTo(1e3 * t);
				}
				n && ce(),
					j(Ye.media, "timeupdate"),
					(Ye.media.seeking = !0),
					j(Ye.media, "seeking");
			}
			$e("Seeking to " + Ye.media.currentTime + " seconds"), W(t);
		}
		function ye() {
			var e = parseInt(C.duration),
				t = 0;
			return (
				null === Ye.media.duration ||
					isNaN(Ye.media.duration) ||
					(t = Ye.media.duration),
				isNaN(e) ? t : e
			);
		}
		function be() {
			m(Ye.container, C.classes.playing, !Ye.media.paused),
				m(Ye.container, C.classes.stopped, Ye.media.paused),
				Oe(Ye.media.paused);
		}
		function ve() {
			P = { x: e.pageXOffset || 0, y: e.pageYOffset || 0 };
		}
		function ge() {
			e.scrollTo(P.x, P.y);
		}
		function he(e) {
			var n = N.supportsFullScreen;
			if (n) {
				if (!e || e.type !== N.fullScreenEventName)
					return (
						N.isFullScreen(Ye.container)
							? N.cancelFullScreen()
							: (ve(), N.requestFullScreen(Ye.container)),
						void (Ye.isFullscreen = N.isFullScreen(Ye.container))
					);
				Ye.isFullscreen = N.isFullScreen(Ye.container);
			} else (Ye.isFullscreen = !Ye.isFullscreen), (t.body.style.overflow = Ye.isFullscreen ? "hidden" : "");
			m(Ye.container, C.classes.fullscreen.active, Ye.isFullscreen),
				J(Ye.isFullscreen),
				Ye.buttons &&
					Ye.buttons.fullscreen &&
					w(Ye.buttons.fullscreen, Ye.isFullscreen),
				j(
					Ye.container,
					Ye.isFullscreen ? "enterfullscreen" : "exitfullscreen",
					!0
				),
				!Ye.isFullscreen && n && ge();
		}
		function ke(e) {
			if (
				(O.boolean(e) || (e = !Ye.media.muted),
				w(Ye.buttons.mute, e),
				(Ye.media.muted = e),
				0 === Ye.media.volume && we(C.volume),
				s(C.types.embed, Ye.type))
			) {
				switch (Ye.type) {
					case "youtube":
						Ye.embed[Ye.media.muted ? "mute" : "unMute"]();
						break;
					case "vimeo":
					case "soundcloud":
						Ye.embed.setVolume(
							Ye.media.muted ? 0 : parseFloat(C.volume / C.volumeMax)
						);
				}
				j(Ye.media, "volumechange");
			}
		}
		function we(e) {
			var t = C.volumeMax,
				n = C.volumeMin;
			if (
				(O.undefined(e) && (e = Ye.storage.volume),
				(null === e || isNaN(e)) && (e = C.volume),
				e > t && (e = t),
				e < n && (e = n),
				(Ye.media.volume = parseFloat(e / t)),
				Ye.volume.display && (Ye.volume.display.value = e),
				s(C.types.embed, Ye.type))
			) {
				switch (Ye.type) {
					case "youtube":
						Ye.embed.setVolume(100 * Ye.media.volume);
						break;
					case "vimeo":
					case "soundcloud":
						Ye.embed.setVolume(Ye.media.volume);
				}
				j(Ye.media, "volumechange");
			}
			0 === e ? (Ye.media.muted = !0) : Ye.media.muted && e > 0 && ke();
		}
		function xe(e) {
			var t = Ye.media.muted ? 0 : Ye.media.volume * C.volumeMax;
			O.number(e) || (e = C.volumeStep), we(t + e);
		}
		function Te(e) {
			var t = Ye.media.muted ? 0 : Ye.media.volume * C.volumeMax;
			O.number(e) || (e = C.volumeStep), we(t - e);
		}
		function Se() {
			var e = Ye.media.muted ? 0 : Ye.media.volume * C.volumeMax;
			Ye.supported.full &&
				(Ye.volume.input && (Ye.volume.input.value = e),
				Ye.volume.display && (Ye.volume.display.value = e)),
				ne({ volume: e }),
				m(Ye.container, C.classes.muted, 0 === e),
				Ye.supported.full && Ye.buttons.mute && w(Ye.buttons.mute, 0 === e);
		}
		function Ee(e) {
			Ye.supported.full &&
				Ye.buttons.captions &&
				(O.boolean(e) ||
					(e =
						-1 === Ye.container.className.indexOf(C.classes.captions.active)),
				(Ye.captionsEnabled = e),
				w(Ye.buttons.captions, Ye.captionsEnabled),
				m(Ye.container, C.classes.captions.active, Ye.captionsEnabled),
				j(
					Ye.container,
					Ye.captionsEnabled ? "captionsenabled" : "captionsdisabled",
					!0
				),
				ne({ captionsEnabled: Ye.captionsEnabled }));
		}
		function _e(e) {
			var t = "waiting" === e.type;
			clearTimeout(Be.loading),
				(Be.loading = setTimeout(
					function () {
						m(Ye.container, C.classes.loading, t), Oe(t);
					},
					t ? 250 : 0
				));
		}
		function Ce(e) {
			if (Ye.supported.full) {
				var t = Ye.progress.played,
					n = 0,
					r = ye();
				if (e)
					switch (e.type) {
						case "timeupdate":
						case "seeking":
							if (Ye.controls.pressed) return;
							(n = x(Ye.media.currentTime, r)),
								"timeupdate" === e.type &&
									Ye.buttons.seek &&
									(Ye.buttons.seek.value = n);
							break;
						case "playing":
						case "progress":
							(t = Ye.progress.buffer),
								(n = (function () {
									var e = Ye.media.buffered;
									return e && e.length
										? x(e.end(0), r)
										: O.number(e)
										? 100 * e
										: 0;
								})());
					}
				Fe(t, n);
			}
		}
		function Fe(e, t) {
			if (Ye.supported.full) {
				if ((O.undefined(t) && (t = 0), O.undefined(e))) {
					if (!Ye.progress || !Ye.progress.buffer) return;
					e = Ye.progress.buffer;
				}
				O.htmlElement(e)
					? (e.value = t)
					: e && (e.bar && (e.bar.value = t), e.text && (e.text.innerHTML = t));
			}
		}
		function Ae(e, t) {
			if (t) {
				isNaN(e) && (e = 0),
					(Ye.secs = parseInt(e % 60)),
					(Ye.mins = parseInt((e / 60) % 60)),
					(Ye.hours = parseInt((e / 60 / 60) % 60));
				var n = parseInt((ye() / 60 / 60) % 60) > 0;
				(Ye.secs = ("0" + Ye.secs).slice(-2)),
					(Ye.mins = ("0" + Ye.mins).slice(-2)),
					(t.innerHTML = (n ? Ye.hours + ":" : "") + Ye.mins + ":" + Ye.secs);
			}
		}
		function Ie() {
			if (Ye.supported.full) {
				var e = ye() || 0;
				!Ye.duration &&
					C.displayDuration &&
					Ye.media.paused &&
					Ae(e, Ye.currentTime),
					Ye.duration && Ae(e, Ye.duration),
					Me();
			}
		}
		function Ne(e) {
			Ae(Ye.media.currentTime, Ye.currentTime),
				(e && "timeupdate" === e.type && Ye.media.seeking) || Ce(e);
		}
		function Pe(e) {
			O.number(e) || (e = 0);
			var t = x(e, ye());
			Ye.progress && Ye.progress.played && (Ye.progress.played.value = t),
				Ye.buttons && Ye.buttons.seek && (Ye.buttons.seek.value = t);
		}
		function Me(e) {
			var t = ye();
			if (C.tooltips.seek && Ye.progress.container && 0 !== t) {
				var n = Ye.progress.container.getBoundingClientRect(),
					r = 0,
					a = C.classes.tooltip + "--visible";
				if (e) r = (100 / n.width) * (e.pageX - n.left);
				else {
					if (!f(Ye.progress.tooltip, a)) return;
					r = Ye.progress.tooltip.style.left.replace("%", "");
				}
				r < 0 ? (r = 0) : r > 100 && (r = 100),
					Ae((t / 100) * r, Ye.progress.tooltip),
					(Ye.progress.tooltip.style.left = r + "%"),
					e &&
						s(["mouseenter", "mouseleave"], e.type) &&
						m(Ye.progress.tooltip, a, "mouseenter" === e.type);
			}
		}
		function Oe(t) {
			if (C.hideControls && "audio" !== Ye.type) {
				var n = 0,
					r = !1,
					a = t,
					o = f(Ye.container, C.classes.loading);
				if (
					(O.boolean(t) ||
						(t && t.type
							? ((r = "enterfullscreen" === t.type),
							  (a = s(
									["mousemove", "touchstart", "mouseenter", "focus"],
									t.type
							  )),
							  s(["mousemove", "touchmove"], t.type) && (n = 2e3),
							  "focus" === t.type && (n = 3e3))
							: (a = f(Ye.container, C.classes.hideControls))),
					e.clearTimeout(Be.hover),
					a || Ye.media.paused || o)
				) {
					if (
						(m(Ye.container, C.classes.hideControls, !1), Ye.media.paused || o)
					)
						return;
					Ye.browser.isTouch && (n = 3e3);
				}
				(a && Ye.media.paused) ||
					(Be.hover = e.setTimeout(function () {
						((!Ye.controls.pressed && !Ye.controls.hover) || r) &&
							m(Ye.container, C.classes.hideControls, !0);
					}, n));
			}
		}
		function Le(e) {
			O.object(e) && "sources" in e && e.sources.length
				? (m(Ye.container, C.classes.ready, !1),
				  ce(),
				  Pe(),
				  Fe(),
				  qe(),
				  De(function () {
						if (
							((Ye.embed = null),
							l(Ye.media),
							"video" === Ye.type && Ye.videoContainer && l(Ye.videoContainer),
							Ye.container && Ye.container.removeAttribute("class"),
							"type" in e && ((Ye.type = e.type), "video" === Ye.type))
						) {
							var n = e.sources[0];
							"type" in n && s(C.types.embed, n.type) && (Ye.type = n.type);
						}
						switch (((Ye.supported = A(Ye.type)), Ye.type)) {
							case "video":
								Ye.media = t.createElement("video");
								break;
							case "audio":
								Ye.media = t.createElement("audio");
								break;
							case "youtube":
							case "vimeo":
							case "soundcloud":
								(Ye.media = t.createElement("div")),
									(Ye.embedId = e.sources[0].src);
						}
						u(Ye.container, Ye.media),
							O.boolean(e.autoplay) && (C.autoplay = e.autoplay),
							s(C.types.html5, Ye.type) &&
								(C.crossorigin && Ye.media.setAttribute("crossorigin", ""),
								C.autoplay && Ye.media.setAttribute("autoplay", ""),
								"poster" in e && Ye.media.setAttribute("poster", e.poster),
								C.loop && Ye.media.setAttribute("loop", "")),
							m(Ye.container, C.classes.fullscreen.active, Ye.isFullscreen),
							m(Ye.container, C.classes.captions.active, Ye.captionsEnabled),
							Q(),
							s(C.types.html5, Ye.type) && z("source", e.sources),
							re(),
							s(C.types.html5, Ye.type) &&
								("tracks" in e && z("track", e.tracks), Ye.media.load()),
							(s(C.types.html5, Ye.type) ||
								(s(C.types.embed, Ye.type) && !Ye.supported.full)) &&
								(He(), Ue()),
							(C.title = e.title),
							ee();
				  }, !1))
				: Je("Invalid source format");
		}
		function je() {
			m(X("." + C.classes.tabFocus), C.classes.tabFocus, !1);
		}
		function Re() {
			function n() {
				var e = de(),
					t = Ye.buttons[e ? "play" : "pause"],
					n = Ye.buttons[e ? "pause" : "play"];
				if ((n && (n = n.length > 1 ? n[n.length - 1] : n[0]), n)) {
					var r = f(t, C.classes.tabFocus);
					setTimeout(function () {
						n.focus(),
							r && (m(t, C.classes.tabFocus, !1), m(n, C.classes.tabFocus, !0));
					}, 100);
				}
			}
			function r() {
				var e = t.activeElement;
				return (e = e && e !== t.body ? t.querySelector(":focus") : null);
			}
			function a(e) {
				return e.keyCode ? e.keyCode : e.which;
			}
			function o(e) {
				for (var t in Ye.buttons) {
					var n = Ye.buttons[t];
					if (O.nodeList(n))
						for (var r = 0; r < n.length; r++)
							m(n[r], C.classes.tabFocus, n[r] === e);
					else m(n, C.classes.tabFocus, n === e);
				}
			}
			function i(e) {
				var t = a(e),
					n = "keydown" === e.type,
					r = n && t === u;
				if (O.number(t))
					if (n) {
						switch (
							(s(
								[
									48, 49, 50, 51, 52, 53, 54, 56, 57, 32, 75, 38, 40, 77, 39,
									37, 70, 67,
								],
								t
							) && (e.preventDefault(), e.stopPropagation()),
							t)
						) {
							case 48:
							case 49:
							case 50:
							case 51:
							case 52:
							case 53:
							case 54:
							case 55:
							case 56:
							case 57:
								r ||
									(function () {
										var e = Ye.media.duration;
										O.number(e) && fe((e / 10) * (t - 48));
									})();
								break;
							case 32:
							case 75:
								r || de();
								break;
							case 38:
								xe();
								break;
							case 40:
								Te();
								break;
							case 77:
								r || ke();
								break;
							case 39:
								me();
								break;
							case 37:
								pe();
								break;
							case 70:
								he();
								break;
							case 67:
								r || Ee();
						}
						!N.supportsFullScreen && Ye.isFullscreen && 27 === t && he(),
							(u = t);
					} else u = null;
			}
			var l = Ye.browser.isIE ? "change" : "input";
			if (C.keyboardShorcuts.focused) {
				var u = null;
				C.keyboardShorcuts.global &&
					g(e, "keydown keyup", function (e) {
						var t = a(e),
							n = r();
						1 !== I().length ||
							!s([48, 49, 50, 51, 52, 53, 54, 56, 57, 75, 77, 70, 67], t) ||
							(O.htmlElement(n) && y(n, C.selectors.editable)) ||
							i(e);
					}),
					g(Ye.container, "keydown keyup", i);
			}
			g(e, "keyup", function (e) {
				var t = a(e),
					n = r();
				9 === t && o(n);
			}),
				g(t.body, "click", je);
			for (var c in Ye.buttons) {
				var d = Ye.buttons[c];
				g(d, "blur", function () {
					m(d, "tab-focus", !1);
				});
			}
			b(Ye.buttons.play, "click", C.listeners.play, n),
				b(Ye.buttons.pause, "click", C.listeners.pause, n),
				b(Ye.buttons.restart, "click", C.listeners.restart, fe),
				b(Ye.buttons.rewind, "click", C.listeners.rewind, pe),
				b(Ye.buttons.forward, "click", C.listeners.forward, me),
				b(Ye.buttons.seek, l, C.listeners.seek, fe),
				b(Ye.volume.input, l, C.listeners.volume, function () {
					we(Ye.volume.input.value);
				}),
				b(Ye.buttons.mute, "click", C.listeners.mute, ke),
				b(Ye.buttons.fullscreen, "click", C.listeners.fullscreen, he),
				N.supportsFullScreen && g(t, N.fullScreenEventName, he),
				b(Ye.buttons.captions, "click", C.listeners.captions, Ee),
				g(Ye.progress.container, "mouseenter mouseleave mousemove", Me),
				C.hideControls &&
					(g(
						Ye.container,
						"mouseenter mouseleave mousemove touchstart touchend touchcancel touchmove enterfullscreen",
						Oe
					),
					g(Ye.controls, "mouseenter mouseleave", function (e) {
						Ye.controls.hover = "mouseenter" === e.type;
					}),
					g(
						Ye.controls,
						"mousedown mouseup touchstart touchend touchcancel",
						function (e) {
							Ye.controls.pressed = s(["mousedown", "touchstart"], e.type);
						}
					),
					g(Ye.controls, "focus blur", Oe, !0)),
				g(Ye.volume.input, "wheel", function (e) {
					e.preventDefault();
					var t = e.webkitDirectionInvertedFromDevice,
						n = C.volumeStep / 5;
					(e.deltaY < 0 || e.deltaX > 0) && (t ? Te(n) : xe(n)),
						(e.deltaY > 0 || e.deltaX < 0) && (t ? xe(n) : Te(n));
				});
		}
		function Ve() {
			if (
				(g(Ye.media, "timeupdate seeking", Ne),
				g(Ye.media, "timeupdate", W),
				g(Ye.media, "durationchange loadedmetadata", Ie),
				g(Ye.media, "ended", function () {
					"video" === Ye.type &&
						C.showPosterOnEnd &&
						("video" === Ye.type && U(), fe(), Ye.media.load());
				}),
				g(Ye.media, "progress playing", Ce),
				g(Ye.media, "volumechange", Se),
				g(Ye.media, "play pause ended", be),
				g(Ye.media, "waiting canplay seeked", _e),
				C.clickToPlay && "audio" !== Ye.type)
			) {
				var e = X("." + C.classes.videoWrapper);
				if (!e) return;
				(e.style.cursor = "pointer"),
					g(e, "click", function () {
						(C.hideControls && Ye.browser.isTouch && !Ye.media.paused) ||
							(Ye.media.paused ? ue() : Ye.media.ended ? (fe(), ue()) : ce());
					});
			}
			C.disableContextMenu &&
				g(Ye.media, "contextmenu", function (e) {
					e.preventDefault();
				}),
				g(
					Ye.media,
					C.events.concat(["keyup", "keydown"]).join(" "),
					function (e) {
						j(Ye.container, e.type, !0);
					}
				);
		}
		function qe() {
			if (s(C.types.html5, Ye.type)) {
				for (
					var e = Ye.media.querySelectorAll("source"), t = 0;
					t < e.length;
					t++
				)
					l(e[t]);
				Ye.media.setAttribute("src", C.blankUrl),
					Ye.media.load(),
					$e("Cancelled network requests");
			}
		}
		function De(n, r) {
			function a() {
				clearTimeout(Be.cleanUp),
					O.boolean(r) || (r = !0),
					O.function(n) && n.call(Xe),
					r &&
						((Ye.init = !1),
						Ye.container.parentNode.replaceChild(Xe, Ye.container),
						(Ye.container = null),
						(t.body.style.overflow = ""),
						h(t.body, "click", je),
						j(Xe, "destroyed", !0));
			}
			if (!Ye.init) return null;
			switch (Ye.type) {
				case "youtube":
					e.clearInterval(Be.buffering),
						e.clearInterval(Be.playing),
						Ye.embed.destroy(),
						a();
					break;
				case "vimeo":
					Ye.embed.unload().then(a), (Be.cleanUp = e.setTimeout(a, 200));
					break;
				case "video":
				case "audio":
					Z(!0), a();
			}
		}
		function He() {
			if (!Ye.supported.full)
				return (
					Je("Basic support only", Ye.type),
					l(X(C.selectors.controls.wrapper)),
					l(X(C.selectors.buttons.play)),
					void Z(!0)
				);
			var e = !B(C.selectors.controls.wrapper).length;
			e && G(),
				K() && (e && Re(), Ve(), Z(), D(), H(), we(), Se(), Ne(), be(), Ie());
		}
		function Ue() {
			e.setTimeout(function () {
				j(Ye.media, "ready");
			}, 0),
				m(Ye.media, M.classes.setup, !0),
				m(Ye.container, C.classes.ready, !0),
				(Ye.media.plyr = We),
				C.autoplay && ue();
		}
		var We,
			Ye = this,
			Be = {};
		Ye.media = v;
		var Xe = v.cloneNode(!0),
			$e = function () {
				R("log", arguments);
			},
			Je = function () {
				R("warn", arguments);
			};
		return (
			$e("Config", C),
			(We = {
				getOriginal: function () {
					return Xe;
				},
				getContainer: function () {
					return Ye.container;
				},
				getEmbed: function () {
					return Ye.embed;
				},
				getMedia: function () {
					return Ye.media;
				},
				getType: function () {
					return Ye.type;
				},
				getDuration: ye,
				getCurrentTime: function () {
					return Ye.media.currentTime;
				},
				getVolume: function () {
					return Ye.media.volume;
				},
				isMuted: function () {
					return Ye.media.muted;
				},
				isReady: function () {
					return f(Ye.container, C.classes.ready);
				},
				isLoading: function () {
					return f(Ye.container, C.classes.loading);
				},
				isPaused: function () {
					return Ye.media.paused;
				},
				on: function (e, t) {
					return g(Ye.container, e, t), this;
				},
				play: ue,
				pause: ce,
				stop: function () {
					ce(), fe();
				},
				restart: fe,
				rewind: pe,
				forward: me,
				seek: fe,
				source: function (e) {
					if (O.undefined(e)) {
						var t;
						switch (Ye.type) {
							case "youtube":
								t = Ye.embed.getVideoUrl();
								break;
							case "vimeo":
								Ye.embed.getVideoUrl.then(function (e) {
									t = e;
								});
								break;
							case "soundcloud":
								Ye.embed.getCurrentSound(function (e) {
									t = e.permalink_url;
								});
								break;
							default:
								t = Ye.media.currentSrc;
						}
						return t || "";
					}
					Le(e);
				},
				poster: function (e) {
					"video" === Ye.type && Ye.media.setAttribute("poster", e);
				},
				setVolume: we,
				togglePlay: de,
				toggleMute: ke,
				toggleCaptions: Ee,
				toggleFullscreen: he,
				toggleControls: Oe,
				isFullscreen: function () {
					return Ye.isFullscreen || !1;
				},
				support: function (e) {
					return r(Ye, e);
				},
				destroy: De,
			}),
			(function () {
				if (Ye.init) return null;
				if (((N = _()), (Ye.browser = n()), O.htmlElement(Ye.media))) {
					te();
					var e = v.tagName.toLowerCase();
					"div" === e
						? ((Ye.type = v.getAttribute("data-type")),
						  (Ye.embedId = v.getAttribute("data-video-id")),
						  v.removeAttribute("data-type"),
						  v.removeAttribute("data-video-id"))
						: ((Ye.type = e),
						  (C.crossorigin = null !== v.getAttribute("crossorigin")),
						  (C.autoplay = C.autoplay || null !== v.getAttribute("autoplay")),
						  (C.loop = C.loop || null !== v.getAttribute("loop"))),
						(Ye.supported = A(Ye.type)),
						Ye.supported.basic &&
							((Ye.container = i(v, t.createElement("div"))),
							Ye.container.setAttribute("tabindex", 0),
							Q(),
							$e(Ye.browser.name + " " + Ye.browser.version),
							re(),
							(s(C.types.html5, Ye.type) ||
								(s(C.types.embed, Ye.type) && !Ye.supported.full)) &&
								(He(), Ue(), ee()),
							(Ye.init = !0));
				}
			})(),
			Ye.init ? We : null
		);
	}
	function F(e, n) {
		var r = new XMLHttpRequest();
		if (!O.string(n) || !O.htmlElement(t.querySelector("#" + n))) {
			var a = t.createElement("div");
			a.setAttribute("hidden", ""),
				O.string(n) && a.setAttribute("id", n),
				t.body.insertBefore(a, t.body.childNodes[0]),
				"withCredentials" in r &&
					(r.open("GET", e, !0),
					(r.onload = function () {
						a.innerHTML = r.responseText;
					}),
					r.send());
		}
	}
	function A(e) {
		var r = n(),
			a = r.isIE && r.version <= 9,
			s = r.isIos,
			o = r.isIphone,
			i = !!t.createElement("audio").canPlayType,
			l = !!t.createElement("video").canPlayType,
			u = !1,
			c = !1;
		switch (e) {
			case "video":
				c = (u = l) && !a && !o;
				break;
			case "audio":
				c = (u = i) && !a;
				break;
			case "vimeo":
				(u = !0), (c = !a && !s);
				break;
			case "youtube":
				(u = !0), (c = !a && !s), s && !o && r.version >= 10 && (c = !0);
				break;
			case "soundcloud":
				(u = !0), (c = !a && !o);
				break;
			default:
				c = (u = i && l) && !a;
		}
		return { basic: u, full: c };
	}
	function I(e) {
		if (
			(O.string(e) ? (e = t.querySelector(e)) : O.undefined(e) && (e = t.body),
			O.htmlElement(e))
		) {
			var n = e.querySelectorAll("." + M.classes.setup),
				r = [];
			return (
				Array.prototype.slice.call(n).forEach(function (e) {
					O.object(e.plyr) && r.push(e.plyr);
				}),
				r
			);
		}
		return [];
	}
	var N,
		P = { x: 0, y: 0 },
		M = {
			enabled: !0,
			debug: !1,
			autoplay: !1,
			loop: !1,
			seekTime: 10,
			volume: 10,
			volumeMin: 0,
			volumeMax: 10,
			volumeStep: 1,
			duration: null,
			displayDuration: !0,
			loadSprite: !0,
			iconPrefix: "plyr",
			iconUrl: "https://cdn.plyr.io/2.0.17/plyr.svg') ?>",
			blankUrl: "https://cdn.plyr.io/static/blank.mp4",
			clickToPlay: !0,
			hideControls: !0,
			showPosterOnEnd: !1,
			disableContextMenu: !0,
			keyboardShorcuts: { focused: !0, global: !1 },
			tooltips: { controls: !1, seek: !0 },
			selectors: {
				html5: "video, audio",
				embed: "[data-type]",
				editable: "input, textarea, select, [contenteditable]",
				container: ".plyr",
				controls: { container: null, wrapper: ".plyr__controls" },
				labels: "[data-plyr]",
				buttons: {
					seek: '[data-plyr="seek"]',
					play: '[data-plyr="play"]',
					pause: '[data-plyr="pause"]',
					restart: '[data-plyr="restart"]',
					rewind: '[data-plyr="rewind"]',
					forward: '[data-plyr="fast-forward"]',
					mute: '[data-plyr="mute"]',
					captions: '[data-plyr="captions"]',
					fullscreen: '[data-plyr="fullscreen"]',
				},
				volume: {
					input: '[data-plyr="volume"]',
					display: ".plyr__volume--display",
				},
				progress: {
					container: ".plyr__progress",
					buffer: ".plyr__progress--buffer",
					played: ".plyr__progress--played",
				},
				captions: ".plyr__captions",
				currentTime: ".plyr__time--current",
				duration: ".plyr__time--duration",
			},
			classes: {
				setup: "plyr--setup",
				ready: "plyr--ready",
				videoWrapper: "plyr__video-wrapper",
				embedWrapper: "plyr__video-embed",
				type: "plyr--{0}",
				stopped: "plyr--stopped",
				playing: "plyr--playing",
				muted: "plyr--muted",
				loading: "plyr--loading",
				hover: "plyr--hover",
				tooltip: "plyr__tooltip",
				hidden: "plyr__sr-only",
				hideControls: "plyr--hide-controls",
				isIos: "plyr--is-ios",
				isTouch: "plyr--is-touch",
				captions: {
					enabled: "plyr--captions-enabled",
					active: "plyr--captions-active",
				},
				fullscreen: {
					enabled: "plyr--fullscreen-enabled",
					fallback: "plyr--fullscreen-fallback",
					active: "plyr--fullscreen-active",
				},
				tabFocus: "tab-focus",
			},
			captions: { defaultActive: !1 },
			fullscreen: { enabled: !0, fallback: !0, allowAudio: !1 },
			storage: { enabled: !0, key: "plyr" },
			controls: [
				"play-large",
				"play",
				"progress",
				"current-time",
				"mute",
				"volume",
				"captions",
				"fullscreen",
			],
			i18n: {
				restart: "Restart",
				rewind: "Rewind {seektime} secs",
				play: "Play",
				pause: "Pause",
				forward: "Forward {seektime} secs",
				played: "played",
				buffered: "buffered",
				currentTime: "Current time",
				duration: "Duration",
				volume: "Volume",
				toggleMute: "Toggle Mute",
				toggleCaptions: "Toggle Captions",
				toggleFullscreen: "Toggle Fullscreen",
				frameTitle: "Player for {title}",
			},
			types: {
				embed: ["youtube", "vimeo", "soundcloud"],
				html5: ["video", "audio"],
			},
			urls: {
				vimeo: { api: "https://player.vimeo.com/api/player.js" },
				youtube: { api: "https://www.youtube.com/iframe_api" },
				soundcloud: { api: "https://w.soundcloud.com/player/api.js" },
			},
			listeners: {
				seek: null,
				play: null,
				pause: null,
				restart: null,
				rewind: null,
				forward: null,
				mute: null,
				volume: null,
				captions: null,
				fullscreen: null,
			},
			events: [
				"ready",
				"ended",
				"progress",
				"stalled",
				"playing",
				"waiting",
				"canplay",
				"canplaythrough",
				"loadstart",
				"loadeddata",
				"loadedmetadata",
				"timeupdate",
				"volumechange",
				"play",
				"pause",
				"error",
				"seeking",
				"seeked",
				"emptied",
			],
			logPrefix: "[Plyr]",
		},
		O = {
			object: function (e) {
				return null !== e && "object" == typeof e;
			},
			array: function (e) {
				return null !== e && "object" == typeof e && e.constructor === Array;
			},
			number: function (e) {
				return (
					null !== e &&
					(("number" == typeof e && !isNaN(e - 0)) ||
						("object" == typeof e && e.constructor === Number))
				);
			},
			string: function (e) {
				return (
					null !== e &&
					("string" == typeof e ||
						("object" == typeof e && e.constructor === String))
				);
			},
			boolean: function (e) {
				return null !== e && "boolean" == typeof e;
			},
			nodeList: function (e) {
				return null !== e && e instanceof NodeList;
			},
			htmlElement: function (e) {
				return null !== e && e instanceof HTMLElement;
			},
			function: function (e) {
				return null !== e && "function" == typeof e;
			},
			undefined: function (e) {
				return null !== e && void 0 === e;
			},
		},
		L = {
			supported: (function () {
				try {
					e.localStorage.setItem("___test", "OK");
					var t = e.localStorage.getItem("___test");
					return e.localStorage.removeItem("___test"), "OK" === t;
				} catch (e) {
					return !1;
				}
				return !1;
			})(),
		};
	return {
		setup: function (e, n) {
			function r(e, t) {
				f(t, M.classes.hook) || a.push({ target: e, media: t });
			}
			var a = [],
				s = [],
				o = [M.selectors.html5, M.selectors.embed].join(",");
			if (
				(O.string(e)
					? (e = t.querySelectorAll(e))
					: O.htmlElement(e)
					? (e = [e])
					: O.nodeList(e) ||
					  O.array(e) ||
					  O.string(e) ||
					  (O.undefined(n) && O.object(e) && (n = e),
					  (e = t.querySelectorAll(o))),
				O.nodeList(e) && (e = Array.prototype.slice.call(e)),
				!A().basic || !e.length)
			)
				return !1;
			for (var i = 0; i < e.length; i++) {
				var l = e[i],
					u = l.querySelectorAll(o);
				if (u.length) for (var c = 0; c < u.length; c++) r(l, u[c]);
				else y(l, o) && r(l, l);
			}
			return (
				a.forEach(function (e) {
					var t = e.target,
						r = e.media,
						a = {};
					try {
						a = JSON.parse(t.getAttribute("data-plyr"));
					} catch (e) {}
					var o = T({}, M, n, a);
					if (!o.enabled) return null;
					var i = new C(r, o);
					if (O.object(i)) {
						if (o.debug) {
							var l = o.events.concat([
								"setup",
								"statechange",
								"enterfullscreen",
								"exitfullscreen",
								"captionsenabled",
								"captionsdisabled",
							]);
							g(i.getContainer(), l.join(" "), function (e) {
								console.log(
									[o.logPrefix, "event:", e.type].join(" "),
									e.detail.plyr
								);
							});
						}
						k(i.getContainer(), "setup", !0, { plyr: i }), s.push(i);
					}
				}),
				s
			);
		},
		supported: A,
		loadSprite: F,
		get: I,
	};
}),
	(function () {
		function e(e, t) {
			t = t || { bubbles: !1, cancelable: !1, detail: void 0 };
			var n = document.createEvent("CustomEvent");
			return n.initCustomEvent(e, t.bubbles, t.cancelable, t.detail), n;
		}
		"function" != typeof window.CustomEvent &&
			((e.prototype = window.Event.prototype), (window.CustomEvent = e));
	})();
