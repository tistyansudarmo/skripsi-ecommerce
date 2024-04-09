/*! For license information please see bootstrap.js.LICENSE.txt */
(() => {
	var t, e = {
			244: (t, e, i) => {
				"use strict";
				i.r(e), i.d(e, {
					Alert: () => Ee,
					Button: () => Ce,
					Carousel: () => Re,
					Collapse: () => Ue,
					Dropdown: () => pi,
					Modal: () => Wi,
					Offcanvas: () => Xi,
					Popover: () => bn,
					ScrollSpy: () => Tn,
					Tab: () => Pn,
					Toast: () => Bn,
					Tooltip: () => gn
				});
				var n = {};
				i.r(n), i.d(n, {
					afterMain: () => E,
					afterRead: () => y,
					afterWrite: () => O,
					applyStyles: () => N,
					arrow: () => G,
					auto: () => l,
					basePlacements: () => c,
					beforeMain: () => w,
					beforeRead: () => b,
					beforeWrite: () => T,
					bottom: () => o,
					clippingParents: () => d,
					computeStyles: () => et,
					createPopper: () => St,
					createPopperBase: () => Dt,
					createPopperLite: () => It,
					detectOverflow: () => _t,
					end: () => u,
					eventListeners: () => nt,
					flip: () => bt,
					hide: () => wt,
					left: () => a,
					main: () => A,
					modifierPhases: () => x,
					offset: () => At,
					placements: () => _,
					popper: () => p,
					popperGenerator: () => Lt,
					popperOffsets: () => Et,
					preventOverflow: () => Tt,
					read: () => v,
					reference: () => g,
					right: () => r,
					start: () => h,
					top: () => s,
					variationPlacements: () => m,
					viewport: () => f,
					write: () => C
				});
				var s = "top",
					o = "bottom",
					r = "right",
					a = "left",
					l = "auto",
					c = [s, o, r, a],
					h = "start",
					u = "end",
					d = "clippingParents",
					f = "viewport",
					p = "popper",
					g = "reference",
					m = c.reduce((function(t, e) {
						return t.concat([e + "-" + h, e + "-" + u])
					}), []),
					_ = [].concat(c, [l]).reduce((function(t, e) {
						return t.concat([e, e + "-" + h, e + "-" + u])
					}), []),
					b = "beforeRead",
					v = "read",
					y = "afterRead",
					w = "beforeMain",
					A = "main",
					E = "afterMain",
					T = "beforeWrite",
					C = "write",
					O = "afterWrite",
					x = [b, v, y, w, A, E, T, C, O];

				function k(t) {
					return t ? (t.nodeName || "").toLowerCase() : null
				}

				function L(t) {
					if (null == t) return window;
					if ("[object Window]" !== t.toString()) {
						var e = t.ownerDocument;
						return e && e.defaultView || window
					}
					return t
				}

				function D(t) {
					return t instanceof L(t).Element || t instanceof Element
				}

				function S(t) {
					return t instanceof L(t).HTMLElement || t instanceof HTMLElement
				}

				function I(t) {
					return "undefined" != typeof ShadowRoot && (t instanceof L(t).ShadowRoot || t instanceof ShadowRoot)
				}
				const N = {
					name: "applyStyles",
					enabled: !0,
					phase: "write",
					fn: function(t) {
						var e = t.state;
						Object.keys(e.elements).forEach((function(t) {
							var i = e.styles[t] || {},
								n = e.attributes[t] || {},
								s = e.elements[t];
							S(s) && k(s) && (Object.assign(s.style, i), Object.keys(n).forEach((function(t) {
								var e = n[t];
								!1 === e ? s.removeAttribute(t) : s.setAttribute(t, !0 === e ? "" : e)
							})))
						}))
					},
					effect: function(t) {
						var e = t.state,
							i = {
								popper: {
									position: e.options.strategy,
									left: "0",
									top: "0",
									margin: "0"
								},
								arrow: {
									position: "absolute"
								},
								reference: {}
							};
						return Object.assign(e.elements.popper.style, i.popper), e.styles = i, e.elements.arrow && Object.assign(e.elements.arrow.style, i.arrow),
							function() {
								Object.keys(e.elements).forEach((function(t) {
									var n = e.elements[t],
										s = e.attributes[t] || {},
										o = Object.keys(e.styles.hasOwnProperty(t) ? e.styles[t] : i[t]).reduce((function(t, e) {
											return t[e] = "", t
										}), {});
									S(n) && k(n) && (Object.assign(n.style, o), Object.keys(s).forEach((function(t) {
										n.removeAttribute(t)
									})))
								}))
							}
					},
					requires: ["computeStyles"]
				};

				function P(t) {
					return t.split("-")[0]
				}
				var j = Math.max,
					M = Math.min,
					H = Math.round;

				function $(t, e) {
					void 0 === e && (e = !1);
					var i = t.getBoundingClientRect(),
						n = 1,
						s = 1;
					if (S(t) && e) {
						var o = t.offsetHeight,
							r = t.offsetWidth;
						r > 0 && (n = H(i.width) / r || 1), o > 0 && (s = H(i.height) / o || 1)
					}
					return {
						width: i.width / n,
						height: i.height / s,
						top: i.top / s,
						right: i.right / n,
						bottom: i.bottom / s,
						left: i.left / n,
						x: i.left / n,
						y: i.top / s
					}
				}

				function W(t) {
					var e = $(t),
						i = t.offsetWidth,
						n = t.offsetHeight;
					return Math.abs(e.width - i) <= 1 && (i = e.width), Math.abs(e.height - n) <= 1 && (n = e.height), {
						x: t.offsetLeft,
						y: t.offsetTop,
						width: i,
						height: n
					}
				}

				function B(t, e) {
					var i = e.getRootNode && e.getRootNode();
					if (t.contains(e)) return !0;
					if (i && I(i)) {
						var n = e;
						do {
							if (n && t.isSameNode(n)) return !0;
							n = n.parentNode || n.host
						} while (n)
					}
					return !1
				}

				function F(t) {
					return L(t).getComputedStyle(t)
				}

				function z(t) {
					return ["table", "td", "th"].indexOf(k(t)) >= 0
				}

				function R(t) {
					return ((D(t) ? t.ownerDocument : t.document) || window.document).documentElement
				}

				function q(t) {
					return "html" === k(t) ? t : t.assignedSlot || t.parentNode || (I(t) ? t.host : null) || R(t)
				}

				function V(t) {
					return S(t) && "fixed" !== F(t).position ? t.offsetParent : null
				}

				function K(t) {
					for (var e = L(t), i = V(t); i && z(i) && "static" === F(i).position;) i = V(i);
					return i && ("html" === k(i) || "body" === k(i) && "static" === F(i).position) ? e : i || function(t) {
						var e = -1 !== navigator.userAgent.toLowerCase().indexOf("firefox");
						if (-1 !== navigator.userAgent.indexOf("Trident") && S(t) && "fixed" === F(t).position) return null;
						var i = q(t);
						for (I(i) && (i = i.host); S(i) && ["html", "body"].indexOf(k(i)) < 0;) {
							var n = F(i);
							if ("none" !== n.transform || "none" !== n.perspective || "paint" === n.contain || -1 !== ["transform", "perspective"].indexOf(n.willChange) || e && "filter" === n.willChange || e && n.filter && "none" !== n.filter) return i;
							i = i.parentNode
						}
						return null
					}(t) || e
				}

				function Q(t) {
					return ["top", "bottom"].indexOf(t) >= 0 ? "x" : "y"
				}

				function X(t, e, i) {
					return j(t, M(e, i))
				}

				function Y(t) {
					return Object.assign({}, {
						top: 0,
						right: 0,
						bottom: 0,
						left: 0
					}, t)
				}

				function U(t, e) {
					return e.reduce((function(e, i) {
						return e[i] = t, e
					}), {})
				}
				const G = {
					name: "arrow",
					enabled: !0,
					phase: "main",
					fn: function(t) {
						var e, i = t.state,
							n = t.name,
							l = t.options,
							h = i.elements.arrow,
							u = i.modifiersData.popperOffsets,
							d = P(i.placement),
							f = Q(d),
							p = [a, r].indexOf(d) >= 0 ? "height" : "width";
						if (h && u) {
							var g = function(t, e) {
									return Y("number" != typeof(t = "function" == typeof t ? t(Object.assign({}, e.rects, {
										placement: e.placement
									})) : t) ? t : U(t, c))
								}(l.padding, i),
								m = W(h),
								_ = "y" === f ? s : a,
								b = "y" === f ? o : r,
								v = i.rects.reference[p] + i.rects.reference[f] - u[f] - i.rects.popper[p],
								y = u[f] - i.rects.reference[f],
								w = K(h),
								A = w ? "y" === f ? w.clientHeight || 0 : w.clientWidth || 0 : 0,
								E = v / 2 - y / 2,
								T = g[_],
								C = A - m[p] - g[b],
								O = A / 2 - m[p] / 2 + E,
								x = X(T, O, C),
								k = f;
							i.modifiersData[n] = ((e = {})[k] = x, e.centerOffset = x - O, e)
						}
					},
					effect: function(t) {
						var e = t.state,
							i = t.options.element,
							n = void 0 === i ? "[data-popper-arrow]" : i;
						null != n && ("string" != typeof n || (n = e.elements.popper.querySelector(n))) && B(e.elements.popper, n) && (e.elements.arrow = n)
					},
					requires: ["popperOffsets"],
					requiresIfExists: ["preventOverflow"]
				};

				function J(t) {
					return t.split("-")[1]
				}
				var Z = {
					top: "auto",
					right: "auto",
					bottom: "auto",
					left: "auto"
				};

				function tt(t) {
					var e, i = t.popper,
						n = t.popperRect,
						l = t.placement,
						c = t.variation,
						h = t.offsets,
						d = t.position,
						f = t.gpuAcceleration,
						p = t.adaptive,
						g = t.roundOffsets,
						m = t.isFixed,
						_ = h.x,
						b = void 0 === _ ? 0 : _,
						v = h.y,
						y = void 0 === v ? 0 : v,
						w = "function" == typeof g ? g({
							x: b,
							y
						}) : {
							x: b,
							y
						};
					b = w.x, y = w.y;
					var A = h.hasOwnProperty("x"),
						E = h.hasOwnProperty("y"),
						T = a,
						C = s,
						O = window;
					if (p) {
						var x = K(i),
							k = "clientHeight",
							D = "clientWidth";
						if (x === L(i) && "static" !== F(x = R(i)).position && "absolute" === d && (k = "scrollHeight", D = "scrollWidth"), l === s || (l === a || l === r) && c === u) C = o, y -= (m && x === O && O.visualViewport ? O.visualViewport.height : x[k]) - n.height, y *= f ? 1 : -1;
						if (l === a || (l === s || l === o) && c === u) T = r, b -= (m && x === O && O.visualViewport ? O.visualViewport.width : x[D]) - n.width, b *= f ? 1 : -1
					}
					var S, I = Object.assign({
							position: d
						}, p && Z),
						N = !0 === g ? function(t) {
							var e = t.x,
								i = t.y,
								n = window.devicePixelRatio || 1;
							return {
								x: H(e * n) / n || 0,
								y: H(i * n) / n || 0
							}
						}({
							x: b,
							y
						}) : {
							x: b,
							y
						};
					return b = N.x, y = N.y, f ? Object.assign({}, I, ((S = {})[C] = E ? "0" : "", S[T] = A ? "0" : "", S.transform = (O.devicePixelRatio || 1) <= 1 ? "translate(" + b + "px, " + y + "px)" : "translate3d(" + b + "px, " + y + "px, 0)", S)) : Object.assign({}, I, ((e = {})[C] = E ? y + "px" : "", e[T] = A ? b + "px" : "", e.transform = "", e))
				}
				const et = {
					name: "computeStyles",
					enabled: !0,
					phase: "beforeWrite",
					fn: function(t) {
						var e = t.state,
							i = t.options,
							n = i.gpuAcceleration,
							s = void 0 === n || n,
							o = i.adaptive,
							r = void 0 === o || o,
							a = i.roundOffsets,
							l = void 0 === a || a,
							c = {
								placement: P(e.placement),
								variation: J(e.placement),
								popper: e.elements.popper,
								popperRect: e.rects.popper,
								gpuAcceleration: s,
								isFixed: "fixed" === e.options.strategy
							};
						null != e.modifiersData.popperOffsets && (e.styles.popper = Object.assign({}, e.styles.popper, tt(Object.assign({}, c, {
							offsets: e.modifiersData.popperOffsets,
							position: e.options.strategy,
							adaptive: r,
							roundOffsets: l
						})))), null != e.modifiersData.arrow && (e.styles.arrow = Object.assign({}, e.styles.arrow, tt(Object.assign({}, c, {
							offsets: e.modifiersData.arrow,
							position: "absolute",
							adaptive: !1,
							roundOffsets: l
						})))), e.attributes.popper = Object.assign({}, e.attributes.popper, {
							"data-popper-placement": e.placement
						})
					},
					data: {}
				};
				var it = {
					passive: !0
				};
				const nt = {
					name: "eventListeners",
					enabled: !0,
					phase: "write",
					fn: function() {},
					effect: function(t) {
						var e = t.state,
							i = t.instance,
							n = t.options,
							s = n.scroll,
							o = void 0 === s || s,
							r = n.resize,
							a = void 0 === r || r,
							l = L(e.elements.popper),
							c = [].concat(e.scrollParents.reference, e.scrollParents.popper);
						return o && c.forEach((function(t) {
								t.addEventListener("scroll", i.update, it)
							})), a && l.addEventListener("resize", i.update, it),
							function() {
								o && c.forEach((function(t) {
									t.removeEventListener("scroll", i.update, it)
								})), a && l.removeEventListener("resize", i.update, it)
							}
					},
					data: {}
				};
				var st = {
					left: "right",
					right: "left",
					bottom: "top",
					top: "bottom"
				};

				function ot(t) {
					return t.replace(/left|right|bottom|top/g, (function(t) {
						return st[t]
					}))
				}
				var rt = {
					start: "end",
					end: "start"
				};

				function at(t) {
					return t.replace(/start|end/g, (function(t) {
						return rt[t]
					}))
				}

				function lt(t) {
					var e = L(t);
					return {
						scrollLeft: e.pageXOffset,
						scrollTop: e.pageYOffset
					}
				}

				function ct(t) {
					return $(R(t)).left + lt(t).scrollLeft
				}

				function ht(t) {
					var e = F(t),
						i = e.overflow,
						n = e.overflowX,
						s = e.overflowY;
					return /auto|scroll|overlay|hidden/.test(i + s + n)
				}

				function ut(t) {
					return ["html", "body", "#document"].indexOf(k(t)) >= 0 ? t.ownerDocument.body : S(t) && ht(t) ? t : ut(q(t))
				}

				function dt(t, e) {
					var i;
					void 0 === e && (e = []);
					var n = ut(t),
						s = n === (null == (i = t.ownerDocument) ? void 0 : i.body),
						o = L(n),
						r = s ? [o].concat(o.visualViewport || [], ht(n) ? n : []) : n,
						a = e.concat(r);
					return s ? a : a.concat(dt(q(r)))
				}

				function ft(t) {
					return Object.assign({}, t, {
						left: t.x,
						top: t.y,
						right: t.x + t.width,
						bottom: t.y + t.height
					})
				}

				function pt(t, e) {
					return e === f ? ft(function(t) {
						var e = L(t),
							i = R(t),
							n = e.visualViewport,
							s = i.clientWidth,
							o = i.clientHeight,
							r = 0,
							a = 0;
						return n && (s = n.width, o = n.height, /^((?!chrome|android).)*safari/i.test(navigator.userAgent) || (r = n.offsetLeft, a = n.offsetTop)), {
							width: s,
							height: o,
							x: r + ct(t),
							y: a
						}
					}(t)) : D(e) ? function(t) {
						var e = $(t);
						return e.top = e.top + t.clientTop, e.left = e.left + t.clientLeft, e.bottom = e.top + t.clientHeight, e.right = e.left + t.clientWidth, e.width = t.clientWidth, e.height = t.clientHeight, e.x = e.left, e.y = e.top, e
					}(e) : ft(function(t) {
						var e, i = R(t),
							n = lt(t),
							s = null == (e = t.ownerDocument) ? void 0 : e.body,
							o = j(i.scrollWidth, i.clientWidth, s ? s.scrollWidth : 0, s ? s.clientWidth : 0),
							r = j(i.scrollHeight, i.clientHeight, s ? s.scrollHeight : 0, s ? s.clientHeight : 0),
							a = -n.scrollLeft + ct(t),
							l = -n.scrollTop;
						return "rtl" === F(s || i).direction && (a += j(i.clientWidth, s ? s.clientWidth : 0) - o), {
							width: o,
							height: r,
							x: a,
							y: l
						}
					}(R(t)))
				}

				function gt(t, e, i) {
					var n = "clippingParents" === e ? function(t) {
							var e = dt(q(t)),
								i = ["absolute", "fixed"].indexOf(F(t).position) >= 0 && S(t) ? K(t) : t;
							return D(i) ? e.filter((function(t) {
								return D(t) && B(t, i) && "body" !== k(t)
							})) : []
						}(t) : [].concat(e),
						s = [].concat(n, [i]),
						o = s[0],
						r = s.reduce((function(e, i) {
							var n = pt(t, i);
							return e.top = j(n.top, e.top), e.right = M(n.right, e.right), e.bottom = M(n.bottom, e.bottom), e.left = j(n.left, e.left), e
						}), pt(t, o));
					return r.width = r.right - r.left, r.height = r.bottom - r.top, r.x = r.left, r.y = r.top, r
				}

				function mt(t) {
					var e, i = t.reference,
						n = t.element,
						l = t.placement,
						c = l ? P(l) : null,
						d = l ? J(l) : null,
						f = i.x + i.width / 2 - n.width / 2,
						p = i.y + i.height / 2 - n.height / 2;
					switch (c) {
						case s:
							e = {
								x: f,
								y: i.y - n.height
							};
							break;
						case o:
							e = {
								x: f,
								y: i.y + i.height
							};
							break;
						case r:
							e = {
								x: i.x + i.width,
								y: p
							};
							break;
						case a:
							e = {
								x: i.x - n.width,
								y: p
							};
							break;
						default:
							e = {
								x: i.x,
								y: i.y
							}
					}
					var g = c ? Q(c) : null;
					if (null != g) {
						var m = "y" === g ? "height" : "width";
						switch (d) {
							case h:
								e[g] = e[g] - (i[m] / 2 - n[m] / 2);
								break;
							case u:
								e[g] = e[g] + (i[m] / 2 - n[m] / 2)
						}
					}
					return e
				}

				function _t(t, e) {
					void 0 === e && (e = {});
					var i = e,
						n = i.placement,
						a = void 0 === n ? t.placement : n,
						l = i.boundary,
						h = void 0 === l ? d : l,
						u = i.rootBoundary,
						m = void 0 === u ? f : u,
						_ = i.elementContext,
						b = void 0 === _ ? p : _,
						v = i.altBoundary,
						y = void 0 !== v && v,
						w = i.padding,
						A = void 0 === w ? 0 : w,
						E = Y("number" != typeof A ? A : U(A, c)),
						T = b === p ? g : p,
						C = t.rects.popper,
						O = t.elements[y ? T : b],
						x = gt(D(O) ? O : O.contextElement || R(t.elements.popper), h, m),
						k = $(t.elements.reference),
						L = mt({
							reference: k,
							element: C,
							strategy: "absolute",
							placement: a
						}),
						S = ft(Object.assign({}, C, L)),
						I = b === p ? S : k,
						N = {
							top: x.top - I.top + E.top,
							bottom: I.bottom - x.bottom + E.bottom,
							left: x.left - I.left + E.left,
							right: I.right - x.right + E.right
						},
						P = t.modifiersData.offset;
					if (b === p && P) {
						var j = P[a];
						Object.keys(N).forEach((function(t) {
							var e = [r, o].indexOf(t) >= 0 ? 1 : -1,
								i = [s, o].indexOf(t) >= 0 ? "y" : "x";
							N[t] += j[i] * e
						}))
					}
					return N
				}
				const bt = {
					name: "flip",
					enabled: !0,
					phase: "main",
					fn: function(t) {
						var e = t.state,
							i = t.options,
							n = t.name;
						if (!e.modifiersData[n]._skip) {
							for (var u = i.mainAxis, d = void 0 === u || u, f = i.altAxis, p = void 0 === f || f, g = i.fallbackPlacements, b = i.padding, v = i.boundary, y = i.rootBoundary, w = i.altBoundary, A = i.flipVariations, E = void 0 === A || A, T = i.allowedAutoPlacements, C = e.options.placement, O = P(C), x = g || (O === C || !E ? [ot(C)] : function(t) {
									if (P(t) === l) return [];
									var e = ot(t);
									return [at(t), e, at(e)]
								}(C)), k = [C].concat(x).reduce((function(t, i) {
									return t.concat(P(i) === l ? function(t, e) {
										void 0 === e && (e = {});
										var i = e,
											n = i.placement,
											s = i.boundary,
											o = i.rootBoundary,
											r = i.padding,
											a = i.flipVariations,
											l = i.allowedAutoPlacements,
											h = void 0 === l ? _ : l,
											u = J(n),
											d = u ? a ? m : m.filter((function(t) {
												return J(t) === u
											})) : c,
											f = d.filter((function(t) {
												return h.indexOf(t) >= 0
											}));
										0 === f.length && (f = d);
										var p = f.reduce((function(e, i) {
											return e[i] = _t(t, {
												placement: i,
												boundary: s,
												rootBoundary: o,
												padding: r
											})[P(i)], e
										}), {});
										return Object.keys(p).sort((function(t, e) {
											return p[t] - p[e]
										}))
									}(e, {
										placement: i,
										boundary: v,
										rootBoundary: y,
										padding: b,
										flipVariations: E,
										allowedAutoPlacements: T
									}) : i)
								}), []), L = e.rects.reference, D = e.rects.popper, S = new Map, I = !0, N = k[0], j = 0; j < k.length; j++) {
								var M = k[j],
									H = P(M),
									$ = J(M) === h,
									W = [s, o].indexOf(H) >= 0,
									B = W ? "width" : "height",
									F = _t(e, {
										placement: M,
										boundary: v,
										rootBoundary: y,
										altBoundary: w,
										padding: b
									}),
									z = W ? $ ? r : a : $ ? o : s;
								L[B] > D[B] && (z = ot(z));
								var R = ot(z),
									q = [];
								if (d && q.push(F[H] <= 0), p && q.push(F[z] <= 0, F[R] <= 0), q.every((function(t) {
										return t
									}))) {
									N = M, I = !1;
									break
								}
								S.set(M, q)
							}
							if (I)
								for (var V = function(t) {
										var e = k.find((function(e) {
											var i = S.get(e);
											if (i) return i.slice(0, t).every((function(t) {
												return t
											}))
										}));
										if (e) return N = e, "break"
									}, K = E ? 3 : 1; K > 0; K--) {
									if ("break" === V(K)) break
								}
							e.placement !== N && (e.modifiersData[n]._skip = !0, e.placement = N, e.reset = !0)
						}
					},
					requiresIfExists: ["offset"],
					data: {
						_skip: !1
					}
				};

				function vt(t, e, i) {
					return void 0 === i && (i = {
						x: 0,
						y: 0
					}), {
						top: t.top - e.height - i.y,
						right: t.right - e.width + i.x,
						bottom: t.bottom - e.height + i.y,
						left: t.left - e.width - i.x
					}
				}

				function yt(t) {
					return [s, r, o, a].some((function(e) {
						return t[e] >= 0
					}))
				}
				const wt = {
					name: "hide",
					enabled: !0,
					phase: "main",
					requiresIfExists: ["preventOverflow"],
					fn: function(t) {
						var e = t.state,
							i = t.name,
							n = e.rects.reference,
							s = e.rects.popper,
							o = e.modifiersData.preventOverflow,
							r = _t(e, {
								elementContext: "reference"
							}),
							a = _t(e, {
								altBoundary: !0
							}),
							l = vt(r, n),
							c = vt(a, s, o),
							h = yt(l),
							u = yt(c);
						e.modifiersData[i] = {
							referenceClippingOffsets: l,
							popperEscapeOffsets: c,
							isReferenceHidden: h,
							hasPopperEscaped: u
						}, e.attributes.popper = Object.assign({}, e.attributes.popper, {
							"data-popper-reference-hidden": h,
							"data-popper-escaped": u
						})
					}
				};
				const At = {
					name: "offset",
					enabled: !0,
					phase: "main",
					requires: ["popperOffsets"],
					fn: function(t) {
						var e = t.state,
							i = t.options,
							n = t.name,
							o = i.offset,
							l = void 0 === o ? [0, 0] : o,
							c = _.reduce((function(t, i) {
								return t[i] = function(t, e, i) {
									var n = P(t),
										o = [a, s].indexOf(n) >= 0 ? -1 : 1,
										l = "function" == typeof i ? i(Object.assign({}, e, {
											placement: t
										})) : i,
										c = l[0],
										h = l[1];
									return c = c || 0, h = (h || 0) * o, [a, r].indexOf(n) >= 0 ? {
										x: h,
										y: c
									} : {
										x: c,
										y: h
									}
								}(i, e.rects, l), t
							}), {}),
							h = c[e.placement],
							u = h.x,
							d = h.y;
						null != e.modifiersData.popperOffsets && (e.modifiersData.popperOffsets.x += u, e.modifiersData.popperOffsets.y += d), e.modifiersData[n] = c
					}
				};
				const Et = {
					name: "popperOffsets",
					enabled: !0,
					phase: "read",
					fn: function(t) {
						var e = t.state,
							i = t.name;
						e.modifiersData[i] = mt({
							reference: e.rects.reference,
							element: e.rects.popper,
							strategy: "absolute",
							placement: e.placement
						})
					},
					data: {}
				};
				const Tt = {
					name: "preventOverflow",
					enabled: !0,
					phase: "main",
					fn: function(t) {
						var e = t.state,
							i = t.options,
							n = t.name,
							l = i.mainAxis,
							c = void 0 === l || l,
							u = i.altAxis,
							d = void 0 !== u && u,
							f = i.boundary,
							p = i.rootBoundary,
							g = i.altBoundary,
							m = i.padding,
							_ = i.tether,
							b = void 0 === _ || _,
							v = i.tetherOffset,
							y = void 0 === v ? 0 : v,
							w = _t(e, {
								boundary: f,
								rootBoundary: p,
								padding: m,
								altBoundary: g
							}),
							A = P(e.placement),
							E = J(e.placement),
							T = !E,
							C = Q(A),
							O = "x" === C ? "y" : "x",
							x = e.modifiersData.popperOffsets,
							k = e.rects.reference,
							L = e.rects.popper,
							D = "function" == typeof y ? y(Object.assign({}, e.rects, {
								placement: e.placement
							})) : y,
							S = "number" == typeof D ? {
								mainAxis: D,
								altAxis: D
							} : Object.assign({
								mainAxis: 0,
								altAxis: 0
							}, D),
							I = e.modifiersData.offset ? e.modifiersData.offset[e.placement] : null,
							N = {
								x: 0,
								y: 0
							};
						if (x) {
							if (c) {
								var H, $ = "y" === C ? s : a,
									B = "y" === C ? o : r,
									F = "y" === C ? "height" : "width",
									z = x[C],
									R = z + w[$],
									q = z - w[B],
									V = b ? -L[F] / 2 : 0,
									Y = E === h ? k[F] : L[F],
									U = E === h ? -L[F] : -k[F],
									G = e.elements.arrow,
									Z = b && G ? W(G) : {
										width: 0,
										height: 0
									},
									tt = e.modifiersData["arrow#persistent"] ? e.modifiersData["arrow#persistent"].padding : {
										top: 0,
										right: 0,
										bottom: 0,
										left: 0
									},
									et = tt[$],
									it = tt[B],
									nt = X(0, k[F], Z[F]),
									st = T ? k[F] / 2 - V - nt - et - S.mainAxis : Y - nt - et - S.mainAxis,
									ot = T ? -k[F] / 2 + V + nt + it + S.mainAxis : U + nt + it + S.mainAxis,
									rt = e.elements.arrow && K(e.elements.arrow),
									at = rt ? "y" === C ? rt.clientTop || 0 : rt.clientLeft || 0 : 0,
									lt = null != (H = null == I ? void 0 : I[C]) ? H : 0,
									ct = z + ot - lt,
									ht = X(b ? M(R, z + st - lt - at) : R, z, b ? j(q, ct) : q);
								x[C] = ht, N[C] = ht - z
							}
							if (d) {
								var ut, dt = "x" === C ? s : a,
									ft = "x" === C ? o : r,
									pt = x[O],
									gt = "y" === O ? "height" : "width",
									mt = pt + w[dt],
									bt = pt - w[ft],
									vt = -1 !== [s, a].indexOf(A),
									yt = null != (ut = null == I ? void 0 : I[O]) ? ut : 0,
									wt = vt ? mt : pt - k[gt] - L[gt] - yt + S.altAxis,
									At = vt ? pt + k[gt] + L[gt] - yt - S.altAxis : bt,
									Et = b && vt ? function(t, e, i) {
										var n = X(t, e, i);
										return n > i ? i : n
									}(wt, pt, At) : X(b ? wt : mt, pt, b ? At : bt);
								x[O] = Et, N[O] = Et - pt
							}
							e.modifiersData[n] = N
						}
					},
					requiresIfExists: ["offset"]
				};

				function Ct(t, e, i) {
					void 0 === i && (i = !1);
					var n, s, o = S(e),
						r = S(e) && function(t) {
							var e = t.getBoundingClientRect(),
								i = H(e.width) / t.offsetWidth || 1,
								n = H(e.height) / t.offsetHeight || 1;
							return 1 !== i || 1 !== n
						}(e),
						a = R(e),
						l = $(t, r),
						c = {
							scrollLeft: 0,
							scrollTop: 0
						},
						h = {
							x: 0,
							y: 0
						};
					return (o || !o && !i) && (("body" !== k(e) || ht(a)) && (c = (n = e) !== L(n) && S(n) ? {
						scrollLeft: (s = n).scrollLeft,
						scrollTop: s.scrollTop
					} : lt(n)), S(e) ? ((h = $(e, !0)).x += e.clientLeft, h.y += e.clientTop) : a && (h.x = ct(a))), {
						x: l.left + c.scrollLeft - h.x,
						y: l.top + c.scrollTop - h.y,
						width: l.width,
						height: l.height
					}
				}

				function Ot(t) {
					var e = new Map,
						i = new Set,
						n = [];

					function s(t) {
						i.add(t.name), [].concat(t.requires || [], t.requiresIfExists || []).forEach((function(t) {
							if (!i.has(t)) {
								var n = e.get(t);
								n && s(n)
							}
						})), n.push(t)
					}
					return t.forEach((function(t) {
						e.set(t.name, t)
					})), t.forEach((function(t) {
						i.has(t.name) || s(t)
					})), n
				}
				var xt = {
					placement: "bottom",
					modifiers: [],
					strategy: "absolute"
				};

				function kt() {
					for (var t = arguments.length, e = new Array(t), i = 0; i < t; i++) e[i] = arguments[i];
					return !e.some((function(t) {
						return !(t && "function" == typeof t.getBoundingClientRect)
					}))
				}

				function Lt(t) {
					void 0 === t && (t = {});
					var e = t,
						i = e.defaultModifiers,
						n = void 0 === i ? [] : i,
						s = e.defaultOptions,
						o = void 0 === s ? xt : s;
					return function(t, e, i) {
						void 0 === i && (i = o);
						var s, r, a = {
								placement: "bottom",
								orderedModifiers: [],
								options: Object.assign({}, xt, o),
								modifiersData: {},
								elements: {
									reference: t,
									popper: e
								},
								attributes: {},
								styles: {}
							},
							l = [],
							c = !1,
							h = {
								state: a,
								setOptions: function(i) {
									var s = "function" == typeof i ? i(a.options) : i;
									u(), a.options = Object.assign({}, o, a.options, s), a.scrollParents = {
										reference: D(t) ? dt(t) : t.contextElement ? dt(t.contextElement) : [],
										popper: dt(e)
									};
									var r = function(t) {
										var e = Ot(t);
										return x.reduce((function(t, i) {
											return t.concat(e.filter((function(t) {
												return t.phase === i
											})))
										}), [])
									}(function(t) {
										var e = t.reduce((function(t, e) {
											var i = t[e.name];
											return t[e.name] = i ? Object.assign({}, i, e, {
												options: Object.assign({}, i.options, e.options),
												data: Object.assign({}, i.data, e.data)
											}) : e, t
										}), {});
										return Object.keys(e).map((function(t) {
											return e[t]
										}))
									}([].concat(n, a.options.modifiers)));
									return a.orderedModifiers = r.filter((function(t) {
										return t.enabled
									})), a.orderedModifiers.forEach((function(t) {
										var e = t.name,
											i = t.options,
											n = void 0 === i ? {} : i,
											s = t.effect;
										if ("function" == typeof s) {
											var o = s({
													state: a,
													name: e,
													instance: h,
													options: n
												}),
												r = function() {};
											l.push(o || r)
										}
									})), h.update()
								},
								forceUpdate: function() {
									if (!c) {
										var t = a.elements,
											e = t.reference,
											i = t.popper;
										if (kt(e, i)) {
											a.rects = {
												reference: Ct(e, K(i), "fixed" === a.options.strategy),
												popper: W(i)
											}, a.reset = !1, a.placement = a.options.placement, a.orderedModifiers.forEach((function(t) {
												return a.modifiersData[t.name] = Object.assign({}, t.data)
											}));
											for (var n = 0; n < a.orderedModifiers.length; n++)
												if (!0 !== a.reset) {
													var s = a.orderedModifiers[n],
														o = s.fn,
														r = s.options,
														l = void 0 === r ? {} : r,
														u = s.name;
													"function" == typeof o && (a = o({
														state: a,
														options: l,
														name: u,
														instance: h
													}) || a)
												} else a.reset = !1, n = -1
										}
									}
								},
								update: (s = function() {
									return new Promise((function(t) {
										h.forceUpdate(), t(a)
									}))
								}, function() {
									return r || (r = new Promise((function(t) {
										Promise.resolve().then((function() {
											r = void 0, t(s())
										}))
									}))), r
								}),
								destroy: function() {
									u(), c = !0
								}
							};
						if (!kt(t, e)) return h;

						function u() {
							l.forEach((function(t) {
								return t()
							})), l = []
						}
						return h.setOptions(i).then((function(t) {
							!c && i.onFirstUpdate && i.onFirstUpdate(t)
						})), h
					}
				}
				var Dt = Lt(),
					St = Lt({
						defaultModifiers: [nt, Et, et, N, At, bt, Tt, G, wt]
					}),
					It = Lt({
						defaultModifiers: [nt, Et, et, N]
					});
				const Nt = "transitionend",
					Pt = t => {
						let e = t.getAttribute("data-bs-target");
						if (!e || "#" === e) {
							let i = t.getAttribute("href");
							if (!i || !i.includes("#") && !i.startsWith(".")) return null;
							i.includes("#") && !i.startsWith("#") && (i = `#${i.split("#")[1]}`), e = i && "#" !== i ? i.trim() : null
						}
						return e
					},
					jt = t => {
						const e = Pt(t);
						return e && document.querySelector(e) ? e : null
					},
					Mt = t => {
						const e = Pt(t);
						return e ? document.querySelector(e) : null
					},
					Ht = t => {
						t.dispatchEvent(new Event(Nt))
					},
					$t = t => !(!t || "object" != typeof t) && (void 0 !== t.jquery && (t = t[0]), void 0 !== t.nodeType),
					Wt = t => $t(t) ? t.jquery ? t[0] : t : "string" == typeof t && t.length > 0 ? document.querySelector(t) : null,
					Bt = t => {
						if (!$t(t) || 0 === t.getClientRects().length) return !1;
						const e = "visible" === getComputedStyle(t).getPropertyValue("visibility"),
							i = t.closest("details:not([open])");
						if (!i) return e;
						if (i !== t) {
							const e = t.closest("summary");
							if (e && e.parentNode !== i) return !1;
							if (null === e) return !1
						}
						return e
					},
					Ft = t => !t || t.nodeType !== Node.ELEMENT_NODE || (!!t.classList.contains("disabled") || (void 0 !== t.disabled ? t.disabled : t.hasAttribute("disabled") && "false" !== t.getAttribute("disabled"))),
					zt = t => {
						if (!document.documentElement.attachShadow) return null;
						if ("function" == typeof t.getRootNode) {
							const e = t.getRootNode();
							return e instanceof ShadowRoot ? e : null
						}
						return t instanceof ShadowRoot ? t : t.parentNode ? zt(t.parentNode) : null
					},
					Rt = () => {},
					qt = t => {
						t.offsetHeight
					},
					Vt = () => window.jQuery && !document.body.hasAttribute("data-bs-no-jquery") ? window.jQuery : null,
					Kt = [],
					Qt = () => "rtl" === document.documentElement.dir,
					Xt = t => {
						var e;
						e = () => {
							const e = Vt();
							if (e) {
								const i = t.NAME,
									n = e.fn[i];
								e.fn[i] = t.jQueryInterface, e.fn[i].Constructor = t, e.fn[i].noConflict = () => (e.fn[i] = n, t.jQueryInterface)
							}
						}, "loading" === document.readyState ? (Kt.length || document.addEventListener("DOMContentLoaded", (() => {
							for (const t of Kt) t()
						})), Kt.push(e)) : e()
					},
					Yt = t => {
						"function" == typeof t && t()
					},
					Ut = (t, e, i = !0) => {
						if (!i) return void Yt(t);
						const n = (t => {
							if (!t) return 0;
							let {
								transitionDuration: e,
								transitionDelay: i
							} = window.getComputedStyle(t);
							const n = Number.parseFloat(e),
								s = Number.parseFloat(i);
							return n || s ? (e = e.split(",")[0], i = i.split(",")[0], 1e3 * (Number.parseFloat(e) + Number.parseFloat(i))) : 0
						})(e) + 5;
						let s = !1;
						const o = ({
							target: i
						}) => {
							i === e && (s = !0, e.removeEventListener(Nt, o), Yt(t))
						};
						e.addEventListener(Nt, o), setTimeout((() => {
							s || Ht(e)
						}), n)
					},
					Gt = (t, e, i, n) => {
						const s = t.length;
						let o = t.indexOf(e);
						return -1 === o ? !i && n ? t[s - 1] : t[0] : (o += i ? 1 : -1, n && (o = (o + s) % s), t[Math.max(0, Math.min(o, s - 1))])
					},
					Jt = /[^.]*(?=\..*)\.|.*/,
					Zt = /\..*/,
					te = /::\d+$/,
					ee = {};
				let ie = 1;
				const ne = {
						mouseenter: "mouseover",
						mouseleave: "mouseout"
					},
					se = new Set(["click", "dblclick", "mouseup", "mousedown", "contextmenu", "mousewheel", "DOMMouseScroll", "mouseover", "mouseout", "mousemove", "selectstart", "selectend", "keydown", "keypress", "keyup", "orientationchange", "touchstart", "touchmove", "touchend", "touchcancel", "pointerdown", "pointermove", "pointerup", "pointerleave", "pointercancel", "gesturestart", "gesturechange", "gestureend", "focus", "blur", "change", "reset", "select", "submit", "focusin", "focusout", "load", "unload", "beforeunload", "resize", "move", "DOMContentLoaded", "readystatechange", "error", "abort", "scroll"]);

				function oe(t, e) {
					return e && `${e}::${ie++}` || t.uidEvent || ie++
				}

				function re(t) {
					const e = oe(t);
					return t.uidEvent = e, ee[e] = ee[e] || {}, ee[e]
				}

				function ae(t, e, i = null) {
					return Object.values(t).find((t => t.callable === e && t.delegationSelector === i))
				}

				function le(t, e, i) {
					const n = "string" == typeof e,
						s = n ? i : e || i;
					let o = de(t);
					return se.has(o) || (o = t), [n, s, o]
				}

				function ce(t, e, i, n, s) {
					if ("string" != typeof e || !t) return;
					let [o, r, a] = le(e, i, n);
					if (e in ne) {
						const t = t => function(e) {
							if (!e.relatedTarget || e.relatedTarget !== e.delegateTarget && !e.delegateTarget.contains(e.relatedTarget)) return t.call(this, e)
						};
						r = t(r)
					}
					const l = re(t),
						c = l[a] || (l[a] = {}),
						h = ae(c, r, o ? i : null);
					if (h) return void(h.oneOff = h.oneOff && s);
					const u = oe(r, e.replace(Jt, "")),
						d = o ? function(t, e, i) {
							return function n(s) {
								const o = t.querySelectorAll(e);
								for (let {
										target: r
									} = s; r && r !== this; r = r.parentNode)
									for (const a of o)
										if (a === r) return pe(s, {
											delegateTarget: r
										}), n.oneOff && fe.off(t, s.type, e, i), i.apply(r, [s])
							}
						}(t, i, r) : function(t, e) {
							return function i(n) {
								return pe(n, {
									delegateTarget: t
								}), i.oneOff && fe.off(t, n.type, e), e.apply(t, [n])
							}
						}(t, r);
					d.delegationSelector = o ? i : null, d.callable = r, d.oneOff = s, d.uidEvent = u, c[u] = d, t.addEventListener(a, d, o)
				}

				function he(t, e, i, n, s) {
					const o = ae(e[i], n, s);
					o && (t.removeEventListener(i, o, Boolean(s)), delete e[i][o.uidEvent])
				}

				function ue(t, e, i, n) {
					const s = e[i] || {};
					for (const o of Object.keys(s))
						if (o.includes(n)) {
							const n = s[o];
							he(t, e, i, n.callable, n.delegationSelector)
						}
				}

				function de(t) {
					return t = t.replace(Zt, ""), ne[t] || t
				}
				const fe = {
					on(t, e, i, n) {
						ce(t, e, i, n, !1)
					},
					one(t, e, i, n) {
						ce(t, e, i, n, !0)
					},
					off(t, e, i, n) {
						if ("string" != typeof e || !t) return;
						const [s, o, r] = le(e, i, n), a = r !== e, l = re(t), c = l[r] || {}, h = e.startsWith(".");
						if (void 0 === o) {
							if (h)
								for (const i of Object.keys(l)) ue(t, l, i, e.slice(1));
							for (const i of Object.keys(c)) {
								const n = i.replace(te, "");
								if (!a || e.includes(n)) {
									const e = c[i];
									he(t, l, r, e.callable, e.delegationSelector)
								}
							}
						} else {
							if (!Object.keys(c).length) return;
							he(t, l, r, o, s ? i : null)
						}
					},
					trigger(t, e, i) {
						if ("string" != typeof e || !t) return null;
						const n = Vt();
						let s = null,
							o = !0,
							r = !0,
							a = !1;
						e !== de(e) && n && (s = n.Event(e, i), n(t).trigger(s), o = !s.isPropagationStopped(), r = !s.isImmediatePropagationStopped(), a = s.isDefaultPrevented());
						let l = new Event(e, {
							bubbles: o,
							cancelable: !0
						});
						return l = pe(l, i), a && l.preventDefault(), r && t.dispatchEvent(l), l.defaultPrevented && s && s.preventDefault(), l
					}
				};

				function pe(t, e) {
					for (const [i, n] of Object.entries(e || {})) try {
						t[i] = n
					} catch (e) {
						Object.defineProperty(t, i, {
							configurable: !0,
							get: () => n
						})
					}
					return t
				}
				const ge = new Map,
					me = {
						set(t, e, i) {
							ge.has(t) || ge.set(t, new Map);
							const n = ge.get(t);
							n.has(e) || 0 === n.size ? n.set(e, i) : console.error(`Bootstrap doesn't allow more than one instance per element. Bound instance: ${Array.from(n.keys())[0]}.`)
						},
						get: (t, e) => ge.has(t) && ge.get(t).get(e) || null,
						remove(t, e) {
							if (!ge.has(t)) return;
							const i = ge.get(t);
							i.delete(e), 0 === i.size && ge.delete(t)
						}
					};

				function _e(t) {
					if ("true" === t) return !0;
					if ("false" === t) return !1;
					if (t === Number(t).toString()) return Number(t);
					if ("" === t || "null" === t) return null;
					if ("string" != typeof t) return t;
					try {
						return JSON.parse(decodeURIComponent(t))
					} catch (e) {
						return t
					}
				}

				function be(t) {
					return t.replace(/[A-Z]/g, (t => `-${t.toLowerCase()}`))
				}
				const ve = {
					setDataAttribute(t, e, i) {
						t.setAttribute(`data-bs-${be(e)}`, i)
					},
					removeDataAttribute(t, e) {
						t.removeAttribute(`data-bs-${be(e)}`)
					},
					getDataAttributes(t) {
						if (!t) return {};
						const e = {},
							i = Object.keys(t.dataset).filter((t => t.startsWith("bs") && !t.startsWith("bsConfig")));
						for (const n of i) {
							let i = n.replace(/^bs/, "");
							i = i.charAt(0).toLowerCase() + i.slice(1, i.length), e[i] = _e(t.dataset[n])
						}
						return e
					},
					getDataAttribute: (t, e) => _e(t.getAttribute(`data-bs-${be(e)}`))
				};
				class ye {
					static get Default() {
						return {}
					}
					static get DefaultType() {
						return {}
					}
					static get NAME() {
						throw new Error('You have to implement the static method "NAME", for each component!')
					}
					_getConfig(t) {
						return t = this._mergeConfigObj(t), t = this._configAfterMerge(t), this._typeCheckConfig(t), t
					}
					_configAfterMerge(t) {
						return t
					}
					_mergeConfigObj(t, e) {
						const i = $t(e) ? ve.getDataAttribute(e, "config") : {};
						return {
							...this.constructor.Default,
							..."object" == typeof i ? i : {},
							...$t(e) ? ve.getDataAttributes(e) : {},
							..."object" == typeof t ? t : {}
						}
					}
					_typeCheckConfig(t, e = this.constructor.DefaultType) {
						for (const n of Object.keys(e)) {
							const s = e[n],
								o = t[n],
								r = $t(o) ? "element" : null == (i = o) ? `${i}` : Object.prototype.toString.call(i).match(/\s([a-z]+)/i)[1].toLowerCase();
							if (!new RegExp(s).test(r)) throw new TypeError(`${this.constructor.NAME.toUpperCase()}: Option "${n}" provided type "${r}" but expected type "${s}".`)
						}
						var i
					}
				}
				class we extends ye {
					constructor(t, e) {
						super(), (t = Wt(t)) && (this._element = t, this._config = this._getConfig(e), me.set(this._element, this.constructor.DATA_KEY, this))
					}
					dispose() {
						me.remove(this._element, this.constructor.DATA_KEY), fe.off(this._element, this.constructor.EVENT_KEY);
						for (const t of Object.getOwnPropertyNames(this)) this[t] = null
					}
					_queueCallback(t, e, i = !0) {
						Ut(t, e, i)
					}
					_getConfig(t) {
						return t = this._mergeConfigObj(t, this._element), t = this._configAfterMerge(t), this._typeCheckConfig(t), t
					}
					static getInstance(t) {
						return me.get(Wt(t), this.DATA_KEY)
					}
					static getOrCreateInstance(t, e = {}) {
						return this.getInstance(t) || new this(t, "object" == typeof e ? e : null)
					}
					static get VERSION() {
						return "5.2.0"
					}
					static get DATA_KEY() {
						return `bs.${this.NAME}`
					}
					static get EVENT_KEY() {
						return `.${this.DATA_KEY}`
					}
					static eventName(t) {
						return `${t}${this.EVENT_KEY}`
					}
				}
				const Ae = (t, e = "hide") => {
					const i = `click.dismiss${t.EVENT_KEY}`,
						n = t.NAME;
					fe.on(document, i, `[data-bs-dismiss="${n}"]`, (function(i) {
						if (["A", "AREA"].includes(this.tagName) && i.preventDefault(), Ft(this)) return;
						const s = Mt(this) || this.closest(`.${n}`);
						t.getOrCreateInstance(s)[e]()
					}))
				};
				class Ee extends we {
					static get NAME() {
						return "alert"
					}
					close() {
						if (fe.trigger(this._element, "close.bs.alert").defaultPrevented) return;
						this._element.classList.remove("show");
						const t = this._element.classList.contains("fade");
						this._queueCallback((() => this._destroyElement()), this._element, t)
					}
					_destroyElement() {
						this._element.remove(), fe.trigger(this._element, "closed.bs.alert"), this.dispose()
					}
					static jQueryInterface(t) {
						return this.each((function() {
							const e = Ee.getOrCreateInstance(this);
							if ("string" == typeof t) {
								if (void 0 === e[t] || t.startsWith("_") || "constructor" === t) throw new TypeError(`No method named "${t}"`);
								e[t](this)
							}
						}))
					}
				}
				Ae(Ee, "close"), Xt(Ee);
				const Te = '[data-bs-toggle="button"]';
				class Ce extends we {
					static get NAME() {
						return "button"
					}
					toggle() {
						this._element.setAttribute("aria-pressed", this._element.classList.toggle("active"))
					}
					static jQueryInterface(t) {
						return this.each((function() {
							const e = Ce.getOrCreateInstance(this);
							"toggle" === t && e[t]()
						}))
					}
				}
				fe.on(document, "click.bs.button.data-api", Te, (t => {
					t.preventDefault();
					const e = t.target.closest(Te);
					Ce.getOrCreateInstance(e).toggle()
				})), Xt(Ce);
				const Oe = {
						find: (t, e = document.documentElement) => [].concat(...Element.prototype.querySelectorAll.call(e, t)),
						findOne: (t, e = document.documentElement) => Element.prototype.querySelector.call(e, t),
						children: (t, e) => [].concat(...t.children).filter((t => t.matches(e))),
						parents(t, e) {
							const i = [];
							let n = t.parentNode.closest(e);
							for (; n;) i.push(n), n = n.parentNode.closest(e);
							return i
						},
						prev(t, e) {
							let i = t.previousElementSibling;
							for (; i;) {
								if (i.matches(e)) return [i];
								i = i.previousElementSibling
							}
							return []
						},
						next(t, e) {
							let i = t.nextElementSibling;
							for (; i;) {
								if (i.matches(e)) return [i];
								i = i.nextElementSibling
							}
							return []
						},
						focusableChildren(t) {
							const e = ["a", "button", "input", "textarea", "select", "details", "[tabindex]", '[contenteditable="true"]'].map((t => `${t}:not([tabindex^="-"])`)).join(",");
							return this.find(e, t).filter((t => !Ft(t) && Bt(t)))
						}
					},
					xe = ".bs.swipe",
					ke = {
						endCallback: null,
						leftCallback: null,
						rightCallback: null
					},
					Le = {
						endCallback: "(function|null)",
						leftCallback: "(function|null)",
						rightCallback: "(function|null)"
					};
				class De extends ye {
					constructor(t, e) {
						super(), this._element = t, t && De.isSupported() && (this._config = this._getConfig(e), this._deltaX = 0, this._supportPointerEvents = Boolean(window.PointerEvent), this._initEvents())
					}
					static get Default() {
						return ke
					}
					static get DefaultType() {
						return Le
					}
					static get NAME() {
						return "swipe"
					}
					dispose() {
						fe.off(this._element, xe)
					}
					_start(t) {
						this._supportPointerEvents ? this._eventIsPointerPenTouch(t) && (this._deltaX = t.clientX) : this._deltaX = t.touches[0].clientX
					}
					_end(t) {
						this._eventIsPointerPenTouch(t) && (this._deltaX = t.clientX - this._deltaX), this._handleSwipe(), Yt(this._config.endCallback)
					}
					_move(t) {
						this._deltaX = t.touches && t.touches.length > 1 ? 0 : t.touches[0].clientX - this._deltaX
					}
					_handleSwipe() {
						const t = Math.abs(this._deltaX);
						if (t <= 40) return;
						const e = t / this._deltaX;
						this._deltaX = 0, e && Yt(e > 0 ? this._config.rightCallback : this._config.leftCallback)
					}
					_initEvents() {
						this._supportPointerEvents ? (fe.on(this._element, "pointerdown.bs.swipe", (t => this._start(t))), fe.on(this._element, "pointerup.bs.swipe", (t => this._end(t))), this._element.classList.add("pointer-event")) : (fe.on(this._element, "touchstart.bs.swipe", (t => this._start(t))), fe.on(this._element, "touchmove.bs.swipe", (t => this._move(t))), fe.on(this._element, "touchend.bs.swipe", (t => this._end(t))))
					}
					_eventIsPointerPenTouch(t) {
						return this._supportPointerEvents && ("pen" === t.pointerType || "touch" === t.pointerType)
					}
					static isSupported() {
						return "ontouchstart" in document.documentElement || navigator.maxTouchPoints > 0
					}
				}
				const Se = "next",
					Ie = "prev",
					Ne = "left",
					Pe = "right",
					je = "slid.bs.carousel",
					Me = "carousel",
					He = "active",
					$e = ".active",
					We = ".carousel-item",
					Be = {
						ArrowLeft: Pe,
						ArrowRight: Ne
					},
					Fe = {
						interval: 5e3,
						keyboard: !0,
						pause: "hover",
						ride: !1,
						touch: !0,
						wrap: !0
					},
					ze = {
						interval: "(number|boolean)",
						keyboard: "boolean",
						pause: "(string|boolean)",
						ride: "(boolean|string)",
						touch: "boolean",
						wrap: "boolean"
					};
				class Re extends we {
					constructor(t, e) {
						super(t, e), this._interval = null, this._activeElement = null, this._isSliding = !1, this.touchTimeout = null, this._swipeHelper = null, this._indicatorsElement = Oe.findOne(".carousel-indicators", this._element), this._addEventListeners(), this._config.ride === Me && this.cycle()
					}
					static get Default() {
						return Fe
					}
					static get DefaultType() {
						return ze
					}
					static get NAME() {
						return "carousel"
					}
					next() {
						this._slide(Se)
					}
					nextWhenVisible() {
						!document.hidden && Bt(this._element) && this.next()
					}
					prev() {
						this._slide(Ie)
					}
					pause() {
						this._isSliding && Ht(this._element), this._clearInterval()
					}
					cycle() {
						this._clearInterval(), this._updateInterval(), this._interval = setInterval((() => this.nextWhenVisible()), this._config.interval)
					}
					_maybeEnableCycle() {
						this._config.ride && (this._isSliding ? fe.one(this._element, je, (() => this.cycle())) : this.cycle())
					}
					to(t) {
						const e = this._getItems();
						if (t > e.length - 1 || t < 0) return;
						if (this._isSliding) return void fe.one(this._element, je, (() => this.to(t)));
						const i = this._getItemIndex(this._getActive());
						if (i === t) return;
						const n = t > i ? Se : Ie;
						this._slide(n, e[t])
					}
					dispose() {
						this._swipeHelper && this._swipeHelper.dispose(), super.dispose()
					}
					_configAfterMerge(t) {
						return t.defaultInterval = t.interval, t
					}
					_addEventListeners() {
						this._config.keyboard && fe.on(this._element, "keydown.bs.carousel", (t => this._keydown(t))), "hover" === this._config.pause && (fe.on(this._element, "mouseenter.bs.carousel", (() => this.pause())), fe.on(this._element, "mouseleave.bs.carousel", (() => this._maybeEnableCycle()))), this._config.touch && De.isSupported() && this._addTouchEventListeners()
					}
					_addTouchEventListeners() {
						for (const t of Oe.find(".carousel-item img", this._element)) fe.on(t, "dragstart.bs.carousel", (t => t.preventDefault()));
						const t = {
							leftCallback: () => this._slide(this._directionToOrder(Ne)),
							rightCallback: () => this._slide(this._directionToOrder(Pe)),
							endCallback: () => {
								"hover" === this._config.pause && (this.pause(), this.touchTimeout && clearTimeout(this.touchTimeout), this.touchTimeout = setTimeout((() => this._maybeEnableCycle()), 500 + this._config.interval))
							}
						};
						this._swipeHelper = new De(this._element, t)
					}
					_keydown(t) {
						if (/input|textarea/i.test(t.target.tagName)) return;
						const e = Be[t.key];
						e && (t.preventDefault(), this._slide(this._directionToOrder(e)))
					}
					_getItemIndex(t) {
						return this._getItems().indexOf(t)
					}
					_setActiveIndicatorElement(t) {
						if (!this._indicatorsElement) return;
						const e = Oe.findOne($e, this._indicatorsElement);
						e.classList.remove(He), e.removeAttribute("aria-current");
						const i = Oe.findOne(`[data-bs-slide-to="${t}"]`, this._indicatorsElement);
						i && (i.classList.add(He), i.setAttribute("aria-current", "true"))
					}
					_updateInterval() {
						const t = this._activeElement || this._getActive();
						if (!t) return;
						const e = Number.parseInt(t.getAttribute("data-bs-interval"), 10);
						this._config.interval = e || this._config.defaultInterval
					}
					_slide(t, e = null) {
						if (this._isSliding) return;
						const i = this._getActive(),
							n = t === Se,
							s = e || Gt(this._getItems(), i, n, this._config.wrap);
						if (s === i) return;
						const o = this._getItemIndex(s),
							r = e => fe.trigger(this._element, e, {
								relatedTarget: s,
								direction: this._orderToDirection(t),
								from: this._getItemIndex(i),
								to: o
							});
						if (r("slide.bs.carousel").defaultPrevented) return;
						if (!i || !s) return;
						const a = Boolean(this._interval);
						this.pause(), this._isSliding = !0, this._setActiveIndicatorElement(o), this._activeElement = s;
						const l = n ? "carousel-item-start" : "carousel-item-end",
							c = n ? "carousel-item-next" : "carousel-item-prev";
						s.classList.add(c), qt(s), i.classList.add(l), s.classList.add(l);
						this._queueCallback((() => {
							s.classList.remove(l, c), s.classList.add(He), i.classList.remove(He, c, l), this._isSliding = !1, r(je)
						}), i, this._isAnimated()), a && this.cycle()
					}
					_isAnimated() {
						return this._element.classList.contains("slide")
					}
					_getActive() {
						return Oe.findOne(".active.carousel-item", this._element)
					}
					_getItems() {
						return Oe.find(We, this._element)
					}
					_clearInterval() {
						this._interval && (clearInterval(this._interval), this._interval = null)
					}
					_directionToOrder(t) {
						return Qt() ? t === Ne ? Ie : Se : t === Ne ? Se : Ie
					}
					_orderToDirection(t) {
						return Qt() ? t === Ie ? Ne : Pe : t === Ie ? Pe : Ne
					}
					static jQueryInterface(t) {
						return this.each((function() {
							const e = Re.getOrCreateInstance(this, t);
							if ("number" != typeof t) {
								if ("string" == typeof t) {
									if (void 0 === e[t] || t.startsWith("_") || "constructor" === t) throw new TypeError(`No method named "${t}"`);
									e[t]()
								}
							} else e.to(t)
						}))
					}
				}
				fe.on(document, "click.bs.carousel.data-api", "[data-bs-slide], [data-bs-slide-to]", (function(t) {
					const e = Mt(this);
					if (!e || !e.classList.contains(Me)) return;
					t.preventDefault();
					const i = Re.getOrCreateInstance(e),
						n = this.getAttribute("data-bs-slide-to");
					return n ? (i.to(n), void i._maybeEnableCycle()) : "next" === ve.getDataAttribute(this, "slide") ? (i.next(), void i._maybeEnableCycle()) : (i.prev(), void i._maybeEnableCycle())
				})), fe.on(window, "load.bs.carousel.data-api", (() => {
					const t = Oe.find('[data-bs-ride="carousel"]');
					for (const e of t) Re.getOrCreateInstance(e)
				})), Xt(Re);
				const qe = "show",
					Ve = "collapse",
					Ke = "collapsing",
					Qe = '[data-bs-toggle="collapse"]',
					Xe = {
						parent: null,
						toggle: !0
					},
					Ye = {
						parent: "(null|element)",
						toggle: "boolean"
					};
				class Ue extends we {
					constructor(t, e) {
						super(t, e), this._isTransitioning = !1, this._triggerArray = [];
						const i = Oe.find(Qe);
						for (const t of i) {
							const e = jt(t),
								i = Oe.find(e).filter((t => t === this._element));
							null !== e && i.length && this._triggerArray.push(t)
						}
						this._initializeChildren(), this._config.parent || this._addAriaAndCollapsedClass(this._triggerArray, this._isShown()), this._config.toggle && this.toggle()
					}
					static get Default() {
						return Xe
					}
					static get DefaultType() {
						return Ye
					}
					static get NAME() {
						return "collapse"
					}
					toggle() {
						this._isShown() ? this.hide() : this.show()
					}
					show() {
						if (this._isTransitioning || this._isShown()) return;
						let t = [];
						if (this._config.parent && (t = this._getFirstLevelChildren(".collapse.show, .collapse.collapsing").filter((t => t !== this._element)).map((t => Ue.getOrCreateInstance(t, {
								toggle: !1
							})))), t.length && t[0]._isTransitioning) return;
						if (fe.trigger(this._element, "show.bs.collapse").defaultPrevented) return;
						for (const e of t) e.hide();
						const e = this._getDimension();
						this._element.classList.remove(Ve), this._element.classList.add(Ke), this._element.style[e] = 0, this._addAriaAndCollapsedClass(this._triggerArray, !0), this._isTransitioning = !0;
						const i = `scroll${e[0].toUpperCase()+e.slice(1)}`;
						this._queueCallback((() => {
							this._isTransitioning = !1, this._element.classList.remove(Ke), this._element.classList.add(Ve, qe), this._element.style[e] = "", fe.trigger(this._element, "shown.bs.collapse")
						}), this._element, !0), this._element.style[e] = `${this._element[i]}px`
					}
					hide() {
						if (this._isTransitioning || !this._isShown()) return;
						if (fe.trigger(this._element, "hide.bs.collapse").defaultPrevented) return;
						const t = this._getDimension();
						this._element.style[t] = `${this._element.getBoundingClientRect()[t]}px`, qt(this._element), this._element.classList.add(Ke), this._element.classList.remove(Ve, qe);
						for (const t of this._triggerArray) {
							const e = Mt(t);
							e && !this._isShown(e) && this._addAriaAndCollapsedClass([t], !1)
						}
						this._isTransitioning = !0;
						this._element.style[t] = "", this._queueCallback((() => {
							this._isTransitioning = !1, this._element.classList.remove(Ke), this._element.classList.add(Ve), fe.trigger(this._element, "hidden.bs.collapse")
						}), this._element, !0)
					}
					_isShown(t = this._element) {
						return t.classList.contains(qe)
					}
					_configAfterMerge(t) {
						return t.toggle = Boolean(t.toggle), t.parent = Wt(t.parent), t
					}
					_getDimension() {
						return this._element.classList.contains("collapse-horizontal") ? "width" : "height"
					}
					_initializeChildren() {
						if (!this._config.parent) return;
						const t = this._getFirstLevelChildren(Qe);
						for (const e of t) {
							const t = Mt(e);
							t && this._addAriaAndCollapsedClass([e], this._isShown(t))
						}
					}
					_getFirstLevelChildren(t) {
						const e = Oe.find(":scope .collapse .collapse", this._config.parent);
						return Oe.find(t, this._config.parent).filter((t => !e.includes(t)))
					}
					_addAriaAndCollapsedClass(t, e) {
						if (t.length)
							for (const i of t) i.classList.toggle("collapsed", !e), i.setAttribute("aria-expanded", e)
					}
					static jQueryInterface(t) {
						const e = {};
						return "string" == typeof t && /show|hide/.test(t) && (e.toggle = !1), this.each((function() {
							const i = Ue.getOrCreateInstance(this, e);
							if ("string" == typeof t) {
								if (void 0 === i[t]) throw new TypeError(`No method named "${t}"`);
								i[t]()
							}
						}))
					}
				}
				fe.on(document, "click.bs.collapse.data-api", Qe, (function(t) {
					("A" === t.target.tagName || t.delegateTarget && "A" === t.delegateTarget.tagName) && t.preventDefault();
					const e = jt(this),
						i = Oe.find(e);
					for (const t of i) Ue.getOrCreateInstance(t, {
						toggle: !1
					}).toggle()
				})), Xt(Ue);
				const Ge = "dropdown",
					Je = "ArrowUp",
					Ze = "ArrowDown",
					ti = "click.bs.dropdown.data-api",
					ei = "keydown.bs.dropdown.data-api",
					ii = "show",
					ni = '[data-bs-toggle="dropdown"]:not(.disabled):not(:disabled)',
					si = `${ni}.show`,
					oi = ".dropdown-menu",
					ri = Qt() ? "top-end" : "top-start",
					ai = Qt() ? "top-start" : "top-end",
					li = Qt() ? "bottom-end" : "bottom-start",
					ci = Qt() ? "bottom-start" : "bottom-end",
					hi = Qt() ? "left-start" : "right-start",
					ui = Qt() ? "right-start" : "left-start",
					di = {
						autoClose: !0,
						boundary: "clippingParents",
						display: "dynamic",
						offset: [0, 2],
						popperConfig: null,
						reference: "toggle"
					},
					fi = {
						autoClose: "(boolean|string)",
						boundary: "(string|element)",
						display: "string",
						offset: "(array|string|function)",
						popperConfig: "(null|object|function)",
						reference: "(string|element|object)"
					};
				class pi extends we {
					constructor(t, e) {
						super(t, e), this._popper = null, this._parent = this._element.parentNode, this._menu = Oe.findOne(oi, this._parent), this._inNavbar = this._detectNavbar()
					}
					static get Default() {
						return di
					}
					static get DefaultType() {
						return fi
					}
					static get NAME() {
						return Ge
					}
					toggle() {
						return this._isShown() ? this.hide() : this.show()
					}
					show() {
						if (Ft(this._element) || this._isShown()) return;
						const t = {
							relatedTarget: this._element
						};
						if (!fe.trigger(this._element, "show.bs.dropdown", t).defaultPrevented) {
							if (this._createPopper(), "ontouchstart" in document.documentElement && !this._parent.closest(".navbar-nav"))
								for (const t of [].concat(...document.body.children)) fe.on(t, "mouseover", Rt);
							this._element.focus(), this._element.setAttribute("aria-expanded", !0), this._menu.classList.add(ii), this._element.classList.add(ii), fe.trigger(this._element, "shown.bs.dropdown", t)
						}
					}
					hide() {
						if (Ft(this._element) || !this._isShown()) return;
						const t = {
							relatedTarget: this._element
						};
						this._completeHide(t)
					}
					dispose() {
						this._popper && this._popper.destroy(), super.dispose()
					}
					update() {
						this._inNavbar = this._detectNavbar(), this._popper && this._popper.update()
					}
					_completeHide(t) {
						if (!fe.trigger(this._element, "hide.bs.dropdown", t).defaultPrevented) {
							if ("ontouchstart" in document.documentElement)
								for (const t of [].concat(...document.body.children)) fe.off(t, "mouseover", Rt);
							this._popper && this._popper.destroy(), this._menu.classList.remove(ii), this._element.classList.remove(ii), this._element.setAttribute("aria-expanded", "false"), ve.removeDataAttribute(this._menu, "popper"), fe.trigger(this._element, "hidden.bs.dropdown", t)
						}
					}
					_getConfig(t) {
						if ("object" == typeof(t = super._getConfig(t)).reference && !$t(t.reference) && "function" != typeof t.reference.getBoundingClientRect) throw new TypeError(`${Ge.toUpperCase()}: Option "reference" provided type "object" without a required "getBoundingClientRect" method.`);
						return t
					}
					_createPopper() {
						if (void 0 === n) throw new TypeError("Bootstrap's dropdowns require Popper (https://popper.js.org)");
						let t = this._element;
						"parent" === this._config.reference ? t = this._parent : $t(this._config.reference) ? t = Wt(this._config.reference) : "object" == typeof this._config.reference && (t = this._config.reference);
						const e = this._getPopperConfig();
						this._popper = St(t, this._menu, e)
					}
					_isShown() {
						return this._menu.classList.contains(ii)
					}
					_getPlacement() {
						const t = this._parent;
						if (t.classList.contains("dropend")) return hi;
						if (t.classList.contains("dropstart")) return ui;
						if (t.classList.contains("dropup-center")) return "top";
						if (t.classList.contains("dropdown-center")) return "bottom";
						const e = "end" === getComputedStyle(this._menu).getPropertyValue("--bs-position").trim();
						return t.classList.contains("dropup") ? e ? ai : ri : e ? ci : li
					}
					_detectNavbar() {
						return null !== this._element.closest(".navbar")
					}
					_getOffset() {
						const {
							offset: t
						} = this._config;
						return "string" == typeof t ? t.split(",").map((t => Number.parseInt(t, 10))) : "function" == typeof t ? e => t(e, this._element) : t
					}
					_getPopperConfig() {
						const t = {
							placement: this._getPlacement(),
							modifiers: [{
								name: "preventOverflow",
								options: {
									boundary: this._config.boundary
								}
							}, {
								name: "offset",
								options: {
									offset: this._getOffset()
								}
							}]
						};
						return (this._inNavbar || "static" === this._config.display) && (ve.setDataAttribute(this._menu, "popper", "static"), t.modifiers = [{
							name: "applyStyles",
							enabled: !1
						}]), {
							...t,
							..."function" == typeof this._config.popperConfig ? this._config.popperConfig(t) : this._config.popperConfig
						}
					}
					_selectMenuItem({
						key: t,
						target: e
					}) {
						const i = Oe.find(".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)", this._menu).filter((t => Bt(t)));
						i.length && Gt(i, e, t === Ze, !i.includes(e)).focus()
					}
					static jQueryInterface(t) {
						return this.each((function() {
							const e = pi.getOrCreateInstance(this, t);
							if ("string" == typeof t) {
								if (void 0 === e[t]) throw new TypeError(`No method named "${t}"`);
								e[t]()
							}
						}))
					}
					static clearMenus(t) {
						if (2 === t.button || "keyup" === t.type && "Tab" !== t.key) return;
						const e = Oe.find(si);
						for (const i of e) {
							const e = pi.getInstance(i);
							if (!e || !1 === e._config.autoClose) continue;
							const n = t.composedPath(),
								s = n.includes(e._menu);
							if (n.includes(e._element) || "inside" === e._config.autoClose && !s || "outside" === e._config.autoClose && s) continue;
							if (e._menu.contains(t.target) && ("keyup" === t.type && "Tab" === t.key || /input|select|option|textarea|form/i.test(t.target.tagName))) continue;
							const o = {
								relatedTarget: e._element
							};
							"click" === t.type && (o.clickEvent = t), e._completeHide(o)
						}
					}
					static dataApiKeydownHandler(t) {
						const e = /input|textarea/i.test(t.target.tagName),
							i = "Escape" === t.key,
							n = [Je, Ze].includes(t.key);
						if (!n && !i) return;
						if (e && !i) return;
						t.preventDefault();
						const s = Oe.findOne(ni, t.delegateTarget.parentNode),
							o = pi.getOrCreateInstance(s);
						if (n) return t.stopPropagation(), o.show(), void o._selectMenuItem(t);
						o._isShown() && (t.stopPropagation(), o.hide(), s.focus())
					}
				}
				fe.on(document, ei, ni, pi.dataApiKeydownHandler), fe.on(document, ei, oi, pi.dataApiKeydownHandler), fe.on(document, ti, pi.clearMenus), fe.on(document, "keyup.bs.dropdown.data-api", pi.clearMenus), fe.on(document, ti, ni, (function(t) {
					t.preventDefault(), pi.getOrCreateInstance(this).toggle()
				})), Xt(pi);
				const gi = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
					mi = ".sticky-top",
					_i = "padding-right",
					bi = "margin-right";
				class vi {
					constructor() {
						this._element = document.body
					}
					getWidth() {
						const t = document.documentElement.clientWidth;
						return Math.abs(window.innerWidth - t)
					}
					hide() {
						const t = this.getWidth();
						this._disableOverFlow(), this._setElementAttributes(this._element, _i, (e => e + t)), this._setElementAttributes(gi, _i, (e => e + t)), this._setElementAttributes(mi, bi, (e => e - t))
					}
					reset() {
						this._resetElementAttributes(this._element, "overflow"), this._resetElementAttributes(this._element, _i), this._resetElementAttributes(gi, _i), this._resetElementAttributes(mi, bi)
					}
					isOverflowing() {
						return this.getWidth() > 0
					}
					_disableOverFlow() {
						this._saveInitialAttribute(this._element, "overflow"), this._element.style.overflow = "hidden"
					}
					_setElementAttributes(t, e, i) {
						const n = this.getWidth();
						this._applyManipulationCallback(t, (t => {
							if (t !== this._element && window.innerWidth > t.clientWidth + n) return;
							this._saveInitialAttribute(t, e);
							const s = window.getComputedStyle(t).getPropertyValue(e);
							t.style.setProperty(e, `${i(Number.parseFloat(s))}px`)
						}))
					}
					_saveInitialAttribute(t, e) {
						const i = t.style.getPropertyValue(e);
						i && ve.setDataAttribute(t, e, i)
					}
					_resetElementAttributes(t, e) {
						this._applyManipulationCallback(t, (t => {
							const i = ve.getDataAttribute(t, e);
							null !== i ? (ve.removeDataAttribute(t, e), t.style.setProperty(e, i)) : t.style.removeProperty(e)
						}))
					}
					_applyManipulationCallback(t, e) {
						if ($t(t)) e(t);
						else
							for (const i of Oe.find(t, this._element)) e(i)
					}
				}
				const yi = "backdrop",
					wi = "show",
					Ai = "mousedown.bs.backdrop",
					Ei = {
						className: "modal-backdrop",
						clickCallback: null,
						isAnimated: !1,
						isVisible: !0,
						rootElement: "body"
					},
					Ti = {
						className: "string",
						clickCallback: "(function|null)",
						isAnimated: "boolean",
						isVisible: "boolean",
						rootElement: "(element|string)"
					};
				class Ci extends ye {
					constructor(t) {
						super(), this._config = this._getConfig(t), this._isAppended = !1, this._element = null
					}
					static get Default() {
						return Ei
					}
					static get DefaultType() {
						return Ti
					}
					static get NAME() {
						return yi
					}
					show(t) {
						if (!this._config.isVisible) return void Yt(t);
						this._append();
						const e = this._getElement();
						this._config.isAnimated && qt(e), e.classList.add(wi), this._emulateAnimation((() => {
							Yt(t)
						}))
					}
					hide(t) {
						this._config.isVisible ? (this._getElement().classList.remove(wi), this._emulateAnimation((() => {
							this.dispose(), Yt(t)
						}))) : Yt(t)
					}
					dispose() {
						this._isAppended && (fe.off(this._element, Ai), this._element.remove(), this._isAppended = !1)
					}
					_getElement() {
						if (!this._element) {
							const t = document.createElement("div");
							t.className = this._config.className, this._config.isAnimated && t.classList.add("fade"), this._element = t
						}
						return this._element
					}
					_configAfterMerge(t) {
						return t.rootElement = Wt(t.rootElement), t
					}
					_append() {
						if (this._isAppended) return;
						const t = this._getElement();
						this._config.rootElement.append(t), fe.on(t, Ai, (() => {
							Yt(this._config.clickCallback)
						})), this._isAppended = !0
					}
					_emulateAnimation(t) {
						Ut(t, this._getElement(), this._config.isAnimated)
					}
				}
				const Oi = ".bs.focustrap",
					xi = "backward",
					ki = {
						autofocus: !0,
						trapElement: null
					},
					Li = {
						autofocus: "boolean",
						trapElement: "element"
					};
				class Di extends ye {
					constructor(t) {
						super(), this._config = this._getConfig(t), this._isActive = !1, this._lastTabNavDirection = null
					}
					static get Default() {
						return ki
					}
					static get DefaultType() {
						return Li
					}
					static get NAME() {
						return "focustrap"
					}
					activate() {
						this._isActive || (this._config.autofocus && this._config.trapElement.focus(), fe.off(document, Oi), fe.on(document, "focusin.bs.focustrap", (t => this._handleFocusin(t))), fe.on(document, "keydown.tab.bs.focustrap", (t => this._handleKeydown(t))), this._isActive = !0)
					}
					deactivate() {
						this._isActive && (this._isActive = !1, fe.off(document, Oi))
					}
					_handleFocusin(t) {
						const {
							trapElement: e
						} = this._config;
						if (t.target === document || t.target === e || e.contains(t.target)) return;
						const i = Oe.focusableChildren(e);
						0 === i.length ? e.focus() : this._lastTabNavDirection === xi ? i[i.length - 1].focus() : i[0].focus()
					}
					_handleKeydown(t) {
						"Tab" === t.key && (this._lastTabNavDirection = t.shiftKey ? xi : "forward")
					}
				}
				const Si = ".bs.modal",
					Ii = "hidden.bs.modal",
					Ni = "show.bs.modal",
					Pi = "modal-open",
					ji = "show",
					Mi = "modal-static",
					Hi = {
						backdrop: !0,
						focus: !0,
						keyboard: !0
					},
					$i = {
						backdrop: "(boolean|string)",
						focus: "boolean",
						keyboard: "boolean"
					};
				class Wi extends we {
					constructor(t, e) {
						super(t, e), this._dialog = Oe.findOne(".modal-dialog", this._element), this._backdrop = this._initializeBackDrop(), this._focustrap = this._initializeFocusTrap(), this._isShown = !1, this._isTransitioning = !1, this._scrollBar = new vi, this._addEventListeners()
					}
					static get Default() {
						return Hi
					}
					static get DefaultType() {
						return $i
					}
					static get NAME() {
						return "modal"
					}
					toggle(t) {
						return this._isShown ? this.hide() : this.show(t)
					}
					show(t) {
						if (this._isShown || this._isTransitioning) return;
						fe.trigger(this._element, Ni, {
							relatedTarget: t
						}).defaultPrevented || (this._isShown = !0, this._isTransitioning = !0, this._scrollBar.hide(), document.body.classList.add(Pi), this._adjustDialog(), this._backdrop.show((() => this._showElement(t))))
					}
					hide() {
						if (!this._isShown || this._isTransitioning) return;
						fe.trigger(this._element, "hide.bs.modal").defaultPrevented || (this._isShown = !1, this._isTransitioning = !0, this._focustrap.deactivate(), this._element.classList.remove(ji), this._queueCallback((() => this._hideModal()), this._element, this._isAnimated()))
					}
					dispose() {
						for (const t of [window, this._dialog]) fe.off(t, Si);
						this._backdrop.dispose(), this._focustrap.deactivate(), super.dispose()
					}
					handleUpdate() {
						this._adjustDialog()
					}
					_initializeBackDrop() {
						return new Ci({
							isVisible: Boolean(this._config.backdrop),
							isAnimated: this._isAnimated()
						})
					}
					_initializeFocusTrap() {
						return new Di({
							trapElement: this._element
						})
					}
					_showElement(t) {
						document.body.contains(this._element) || document.body.append(this._element), this._element.style.display = "block", this._element.removeAttribute("aria-hidden"), this._element.setAttribute("aria-modal", !0), this._element.setAttribute("role", "dialog"), this._element.scrollTop = 0;
						const e = Oe.findOne(".modal-body", this._dialog);
						e && (e.scrollTop = 0), qt(this._element), this._element.classList.add(ji);
						this._queueCallback((() => {
							this._config.focus && this._focustrap.activate(), this._isTransitioning = !1, fe.trigger(this._element, "shown.bs.modal", {
								relatedTarget: t
							})
						}), this._dialog, this._isAnimated())
					}
					_addEventListeners() {
						fe.on(this._element, "keydown.dismiss.bs.modal", (t => {
							if ("Escape" === t.key) return this._config.keyboard ? (t.preventDefault(), void this.hide()) : void this._triggerBackdropTransition()
						})), fe.on(window, "resize.bs.modal", (() => {
							this._isShown && !this._isTransitioning && this._adjustDialog()
						})), fe.on(this._element, "mousedown.dismiss.bs.modal", (t => {
							t.target === t.currentTarget && ("static" !== this._config.backdrop ? this._config.backdrop && this.hide() : this._triggerBackdropTransition())
						}))
					}
					_hideModal() {
						this._element.style.display = "none", this._element.setAttribute("aria-hidden", !0), this._element.removeAttribute("aria-modal"), this._element.removeAttribute("role"), this._isTransitioning = !1, this._backdrop.hide((() => {
							document.body.classList.remove(Pi), this._resetAdjustments(), this._scrollBar.reset(), fe.trigger(this._element, Ii)
						}))
					}
					_isAnimated() {
						return this._element.classList.contains("fade")
					}
					_triggerBackdropTransition() {
						if (fe.trigger(this._element, "hidePrevented.bs.modal").defaultPrevented) return;
						const t = this._element.scrollHeight > document.documentElement.clientHeight,
							e = this._element.style.overflowY;
						"hidden" === e || this._element.classList.contains(Mi) || (t || (this._element.style.overflowY = "hidden"), this._element.classList.add(Mi), this._queueCallback((() => {
							this._element.classList.remove(Mi), this._queueCallback((() => {
								this._element.style.overflowY = e
							}), this._dialog)
						}), this._dialog), this._element.focus())
					}
					_adjustDialog() {
						const t = this._element.scrollHeight > document.documentElement.clientHeight,
							e = this._scrollBar.getWidth(),
							i = e > 0;
						if (i && !t) {
							const t = Qt() ? "paddingLeft" : "paddingRight";
							this._element.style[t] = `${e}px`
						}
						if (!i && t) {
							const t = Qt() ? "paddingRight" : "paddingLeft";
							this._element.style[t] = `${e}px`
						}
					}
					_resetAdjustments() {
						this._element.style.paddingLeft = "", this._element.style.paddingRight = ""
					}
					static jQueryInterface(t, e) {
						return this.each((function() {
							const i = Wi.getOrCreateInstance(this, t);
							if ("string" == typeof t) {
								if (void 0 === i[t]) throw new TypeError(`No method named "${t}"`);
								i[t](e)
							}
						}))
					}
				}
				fe.on(document, "click.bs.modal.data-api", '[data-bs-toggle="modal"]', (function(t) {
					const e = Mt(this);
					["A", "AREA"].includes(this.tagName) && t.preventDefault(), fe.one(e, Ni, (t => {
						t.defaultPrevented || fe.one(e, Ii, (() => {
							Bt(this) && this.focus()
						}))
					}));
					const i = Oe.findOne(".modal.show");
					i && Wi.getInstance(i).hide();
					Wi.getOrCreateInstance(e).toggle(this)
				})), Ae(Wi), Xt(Wi);
				const Bi = "show",
					Fi = "showing",
					zi = "hiding",
					Ri = ".offcanvas.show",
					qi = "hidePrevented.bs.offcanvas",
					Vi = "hidden.bs.offcanvas",
					Ki = {
						backdrop: !0,
						keyboard: !0,
						scroll: !1
					},
					Qi = {
						backdrop: "(boolean|string)",
						keyboard: "boolean",
						scroll: "boolean"
					};
				class Xi extends we {
					constructor(t, e) {
						super(t, e), this._isShown = !1, this._backdrop = this._initializeBackDrop(), this._focustrap = this._initializeFocusTrap(), this._addEventListeners()
					}
					static get Default() {
						return Ki
					}
					static get DefaultType() {
						return Qi
					}
					static get NAME() {
						return "offcanvas"
					}
					toggle(t) {
						return this._isShown ? this.hide() : this.show(t)
					}
					show(t) {
						if (this._isShown) return;
						if (fe.trigger(this._element, "show.bs.offcanvas", {
								relatedTarget: t
							}).defaultPrevented) return;
						this._isShown = !0, this._backdrop.show(), this._config.scroll || (new vi).hide(), this._element.setAttribute("aria-modal", !0), this._element.setAttribute("role", "dialog"), this._element.classList.add(Fi);
						this._queueCallback((() => {
							this._config.scroll && !this._config.backdrop || this._focustrap.activate(), this._element.classList.add(Bi), this._element.classList.remove(Fi), fe.trigger(this._element, "shown.bs.offcanvas", {
								relatedTarget: t
							})
						}), this._element, !0)
					}
					hide() {
						if (!this._isShown) return;
						if (fe.trigger(this._element, "hide.bs.offcanvas").defaultPrevented) return;
						this._focustrap.deactivate(), this._element.blur(), this._isShown = !1, this._element.classList.add(zi), this._backdrop.hide();
						this._queueCallback((() => {
							this._element.classList.remove(Bi, zi), this._element.removeAttribute("aria-modal"), this._element.removeAttribute("role"), this._config.scroll || (new vi).reset(), fe.trigger(this._element, Vi)
						}), this._element, !0)
					}
					dispose() {
						this._backdrop.dispose(), this._focustrap.deactivate(), super.dispose()
					}
					_initializeBackDrop() {
						const t = Boolean(this._config.backdrop);
						return new Ci({
							className: "offcanvas-backdrop",
							isVisible: t,
							isAnimated: !0,
							rootElement: this._element.parentNode,
							clickCallback: t ? () => {
								"static" !== this._config.backdrop ? this.hide() : fe.trigger(this._element, qi)
							} : null
						})
					}
					_initializeFocusTrap() {
						return new Di({
							trapElement: this._element
						})
					}
					_addEventListeners() {
						fe.on(this._element, "keydown.dismiss.bs.offcanvas", (t => {
							"Escape" === t.key && (this._config.keyboard ? this.hide() : fe.trigger(this._element, qi))
						}))
					}
					static jQueryInterface(t) {
						return this.each((function() {
							const e = Xi.getOrCreateInstance(this, t);
							if ("string" == typeof t) {
								if (void 0 === e[t] || t.startsWith("_") || "constructor" === t) throw new TypeError(`No method named "${t}"`);
								e[t](this)
							}
						}))
					}
				}
				fe.on(document, "click.bs.offcanvas.data-api", '[data-bs-toggle="offcanvas"]', (function(t) {
					const e = Mt(this);
					if (["A", "AREA"].includes(this.tagName) && t.preventDefault(), Ft(this)) return;
					fe.one(e, Vi, (() => {
						Bt(this) && this.focus()
					}));
					const i = Oe.findOne(Ri);
					i && i !== e && Xi.getInstance(i).hide();
					Xi.getOrCreateInstance(e).toggle(this)
				})), fe.on(window, "load.bs.offcanvas.data-api", (() => {
					for (const t of Oe.find(Ri)) Xi.getOrCreateInstance(t).show()
				})), fe.on(window, "resize.bs.offcanvas", (() => {
					for (const t of Oe.find("[aria-modal][class*=show][class*=offcanvas-]")) "fixed" !== getComputedStyle(t).position && Xi.getOrCreateInstance(t).hide()
				})), Ae(Xi), Xt(Xi);
				const Yi = new Set(["background", "cite", "href", "itemtype", "longdesc", "poster", "src", "xlink:href"]),
					Ui = /^(?:(?:https?|mailto|ftp|tel|file|sms):|[^#&/:?]*(?:[#/?]|$))/i,
					Gi = /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[\d+/a-z]+=*$/i,
					Ji = (t, e) => {
						const i = t.nodeName.toLowerCase();
						return e.includes(i) ? !Yi.has(i) || Boolean(Ui.test(t.nodeValue) || Gi.test(t.nodeValue)) : e.filter((t => t instanceof RegExp)).some((t => t.test(i)))
					},
					Zi = {
						"*": ["class", "dir", "id", "lang", "role", /^aria-[\w-]*$/i],
						a: ["target", "href", "title", "rel"],
						area: [],
						b: [],
						br: [],
						col: [],
						code: [],
						div: [],
						em: [],
						hr: [],
						h1: [],
						h2: [],
						h3: [],
						h4: [],
						h5: [],
						h6: [],
						i: [],
						img: ["src", "srcset", "alt", "title", "width", "height"],
						li: [],
						ol: [],
						p: [],
						pre: [],
						s: [],
						small: [],
						span: [],
						sub: [],
						sup: [],
						strong: [],
						u: [],
						ul: []
					};
				const tn = {
						allowList: Zi,
						content: {},
						extraClass: "",
						html: !1,
						sanitize: !0,
						sanitizeFn: null,
						template: "<div></div>"
					},
					en = {
						allowList: "object",
						content: "object",
						extraClass: "(string|function)",
						html: "boolean",
						sanitize: "boolean",
						sanitizeFn: "(null|function)",
						template: "string"
					},
					nn = {
						entry: "(string|element|function|null)",
						selector: "(string|element)"
					};
				class sn extends ye {
					constructor(t) {
						super(), this._config = this._getConfig(t)
					}
					static get Default() {
						return tn
					}
					static get DefaultType() {
						return en
					}
					static get NAME() {
						return "TemplateFactory"
					}
					getContent() {
						return Object.values(this._config.content).map((t => this._resolvePossibleFunction(t))).filter(Boolean)
					}
					hasContent() {
						return this.getContent().length > 0
					}
					changeContent(t) {
						return this._checkContent(t), this._config.content = {
							...this._config.content,
							...t
						}, this
					}
					toHtml() {
						const t = document.createElement("div");
						t.innerHTML = this._maybeSanitize(this._config.template);
						for (const [e, i] of Object.entries(this._config.content)) this._setContent(t, i, e);
						const e = t.children[0],
							i = this._resolvePossibleFunction(this._config.extraClass);
						return i && e.classList.add(...i.split(" ")), e
					}
					_typeCheckConfig(t) {
						super._typeCheckConfig(t), this._checkContent(t.content)
					}
					_checkContent(t) {
						for (const [e, i] of Object.entries(t)) super._typeCheckConfig({
							selector: e,
							entry: i
						}, nn)
					}
					_setContent(t, e, i) {
						const n = Oe.findOne(i, t);
						n && ((e = this._resolvePossibleFunction(e)) ? $t(e) ? this._putElementInTemplate(Wt(e), n) : this._config.html ? n.innerHTML = this._maybeSanitize(e) : n.textContent = e : n.remove())
					}
					_maybeSanitize(t) {
						return this._config.sanitize ? function(t, e, i) {
							if (!t.length) return t;
							if (i && "function" == typeof i) return i(t);
							const n = (new window.DOMParser).parseFromString(t, "text/html"),
								s = [].concat(...n.body.querySelectorAll("*"));
							for (const t of s) {
								const i = t.nodeName.toLowerCase();
								if (!Object.keys(e).includes(i)) {
									t.remove();
									continue
								}
								const n = [].concat(...t.attributes),
									s = [].concat(e["*"] || [], e[i] || []);
								for (const e of n) Ji(e, s) || t.removeAttribute(e.nodeName)
							}
							return n.body.innerHTML
						}(t, this._config.allowList, this._config.sanitizeFn) : t
					}
					_resolvePossibleFunction(t) {
						return "function" == typeof t ? t(this) : t
					}
					_putElementInTemplate(t, e) {
						if (this._config.html) return e.innerHTML = "", void e.append(t);
						e.textContent = t.textContent
					}
				}
				const on = new Set(["sanitize", "allowList", "sanitizeFn"]),
					rn = "fade",
					an = "show",
					ln = ".modal",
					cn = "hide.bs.modal",
					hn = "hover",
					un = "focus",
					dn = {
						AUTO: "auto",
						TOP: "top",
						RIGHT: Qt() ? "left" : "right",
						BOTTOM: "bottom",
						LEFT: Qt() ? "right" : "left"
					},
					fn = {
						allowList: Zi,
						animation: !0,
						boundary: "clippingParents",
						container: !1,
						customClass: "",
						delay: 0,
						fallbackPlacements: ["top", "right", "bottom", "left"],
						html: !1,
						offset: [0, 0],
						placement: "top",
						popperConfig: null,
						sanitize: !0,
						sanitizeFn: null,
						selector: !1,
						template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
						title: "",
						trigger: "hover focus"
					},
					pn = {
						allowList: "object",
						animation: "boolean",
						boundary: "(string|element)",
						container: "(string|element|boolean)",
						customClass: "(string|function)",
						delay: "(number|object)",
						fallbackPlacements: "array",
						html: "boolean",
						offset: "(array|string|function)",
						placement: "(string|function)",
						popperConfig: "(null|object|function)",
						sanitize: "boolean",
						sanitizeFn: "(null|function)",
						selector: "(string|boolean)",
						template: "string",
						title: "(string|element|function)",
						trigger: "string"
					};
				class gn extends we {
					constructor(t, e) {
						if (void 0 === n) throw new TypeError("Bootstrap's tooltips require Popper (https://popper.js.org)");
						super(t, e), this._isEnabled = !0, this._timeout = 0, this._isHovered = !1, this._activeTrigger = {}, this._popper = null, this._templateFactory = null, this._newContent = null, this.tip = null, this._setListeners()
					}
					static get Default() {
						return fn
					}
					static get DefaultType() {
						return pn
					}
					static get NAME() {
						return "tooltip"
					}
					enable() {
						this._isEnabled = !0
					}
					disable() {
						this._isEnabled = !1
					}
					toggleEnabled() {
						this._isEnabled = !this._isEnabled
					}
					toggle(t) {
						if (this._isEnabled) {
							if (t) {
								const e = this._initializeOnDelegatedTarget(t);
								return e._activeTrigger.click = !e._activeTrigger.click, void(e._isWithActiveTrigger() ? e._enter() : e._leave())
							}
							this._isShown() ? this._leave() : this._enter()
						}
					}
					dispose() {
						clearTimeout(this._timeout), fe.off(this._element.closest(ln), cn, this._hideModalHandler), this.tip && this.tip.remove(), this._disposePopper(), super.dispose()
					}
					show() {
						if ("none" === this._element.style.display) throw new Error("Please use show on visible elements");
						if (!this._isWithContent() || !this._isEnabled) return;
						const t = fe.trigger(this._element, this.constructor.eventName("show")),
							e = (zt(this._element) || this._element.ownerDocument.documentElement).contains(this._element);
						if (t.defaultPrevented || !e) return;
						this.tip && (this.tip.remove(), this.tip = null);
						const i = this._getTipElement();
						this._element.setAttribute("aria-describedby", i.getAttribute("id"));
						const {
							container: n
						} = this._config;
						if (this._element.ownerDocument.documentElement.contains(this.tip) || (n.append(i), fe.trigger(this._element, this.constructor.eventName("inserted"))), this._popper ? this._popper.update() : this._popper = this._createPopper(i), i.classList.add(an), "ontouchstart" in document.documentElement)
							for (const t of [].concat(...document.body.children)) fe.on(t, "mouseover", Rt);
						this._queueCallback((() => {
							const t = this._isHovered;
							this._isHovered = !1, fe.trigger(this._element, this.constructor.eventName("shown")), t && this._leave()
						}), this.tip, this._isAnimated())
					}
					hide() {
						if (!this._isShown()) return;
						if (fe.trigger(this._element, this.constructor.eventName("hide")).defaultPrevented) return;
						const t = this._getTipElement();
						if (t.classList.remove(an), "ontouchstart" in document.documentElement)
							for (const t of [].concat(...document.body.children)) fe.off(t, "mouseover", Rt);
						this._activeTrigger.click = !1, this._activeTrigger.focus = !1, this._activeTrigger.hover = !1, this._isHovered = !1;
						this._queueCallback((() => {
							this._isWithActiveTrigger() || (this._isHovered || t.remove(), this._element.removeAttribute("aria-describedby"), fe.trigger(this._element, this.constructor.eventName("hidden")), this._disposePopper())
						}), this.tip, this._isAnimated())
					}
					update() {
						this._popper && this._popper.update()
					}
					_isWithContent() {
						return Boolean(this._getTitle())
					}
					_getTipElement() {
						return this.tip || (this.tip = this._createTipElement(this._newContent || this._getContentForTemplate())), this.tip
					}
					_createTipElement(t) {
						const e = this._getTemplateFactory(t).toHtml();
						if (!e) return null;
						e.classList.remove(rn, an), e.classList.add(`bs-${this.constructor.NAME}-auto`);
						const i = (t => {
							do {
								t += Math.floor(1e6 * Math.random())
							} while (document.getElementById(t));
							return t
						})(this.constructor.NAME).toString();
						return e.setAttribute("id", i), this._isAnimated() && e.classList.add(rn), e
					}
					setContent(t) {
						this._newContent = t, this._isShown() && (this._disposePopper(), this.show())
					}
					_getTemplateFactory(t) {
						return this._templateFactory ? this._templateFactory.changeContent(t) : this._templateFactory = new sn({
							...this._config,
							content: t,
							extraClass: this._resolvePossibleFunction(this._config.customClass)
						}), this._templateFactory
					}
					_getContentForTemplate() {
						return {
							".tooltip-inner": this._getTitle()
						}
					}
					_getTitle() {
						return this._resolvePossibleFunction(this._config.title) || this._config.originalTitle
					}
					_initializeOnDelegatedTarget(t) {
						return this.constructor.getOrCreateInstance(t.delegateTarget, this._getDelegateConfig())
					}
					_isAnimated() {
						return this._config.animation || this.tip && this.tip.classList.contains(rn)
					}
					_isShown() {
						return this.tip && this.tip.classList.contains(an)
					}
					_createPopper(t) {
						const e = "function" == typeof this._config.placement ? this._config.placement.call(this, t, this._element) : this._config.placement,
							i = dn[e.toUpperCase()];
						return St(this._element, t, this._getPopperConfig(i))
					}
					_getOffset() {
						const {
							offset: t
						} = this._config;
						return "string" == typeof t ? t.split(",").map((t => Number.parseInt(t, 10))) : "function" == typeof t ? e => t(e, this._element) : t
					}
					_resolvePossibleFunction(t) {
						return "function" == typeof t ? t.call(this._element) : t
					}
					_getPopperConfig(t) {
						const e = {
							placement: t,
							modifiers: [{
								name: "flip",
								options: {
									fallbackPlacements: this._config.fallbackPlacements
								}
							}, {
								name: "offset",
								options: {
									offset: this._getOffset()
								}
							}, {
								name: "preventOverflow",
								options: {
									boundary: this._config.boundary
								}
							}, {
								name: "arrow",
								options: {
									element: `.${this.constructor.NAME}-arrow`
								}
							}, {
								name: "preSetPlacement",
								enabled: !0,
								phase: "beforeMain",
								fn: t => {
									this._getTipElement().setAttribute("data-popper-placement", t.state.placement)
								}
							}]
						};
						return {
							...e,
							..."function" == typeof this._config.popperConfig ? this._config.popperConfig(e) : this._config.popperConfig
						}
					}
					_setListeners() {
						const t = this._config.trigger.split(" ");
						for (const e of t)
							if ("click" === e) fe.on(this._element, this.constructor.eventName("click"), this._config.selector, (t => this.toggle(t)));
							else if ("manual" !== e) {
							const t = e === hn ? this.constructor.eventName("mouseenter") : this.constructor.eventName("focusin"),
								i = e === hn ? this.constructor.eventName("mouseleave") : this.constructor.eventName("focusout");
							fe.on(this._element, t, this._config.selector, (t => {
								const e = this._initializeOnDelegatedTarget(t);
								e._activeTrigger["focusin" === t.type ? un : hn] = !0, e._enter()
							})), fe.on(this._element, i, this._config.selector, (t => {
								const e = this._initializeOnDelegatedTarget(t);
								e._activeTrigger["focusout" === t.type ? un : hn] = e._element.contains(t.relatedTarget), e._leave()
							}))
						}
						this._hideModalHandler = () => {
							this._element && this.hide()
						}, fe.on(this._element.closest(ln), cn, this._hideModalHandler), this._config.selector ? this._config = {
							...this._config,
							trigger: "manual",
							selector: ""
						} : this._fixTitle()
					}
					_fixTitle() {
						const t = this._config.originalTitle;
						t && (this._element.getAttribute("aria-label") || this._element.textContent.trim() || this._element.setAttribute("aria-label", t), this._element.removeAttribute("title"))
					}
					_enter() {
						this._isShown() || this._isHovered ? this._isHovered = !0 : (this._isHovered = !0, this._setTimeout((() => {
							this._isHovered && this.show()
						}), this._config.delay.show))
					}
					_leave() {
						this._isWithActiveTrigger() || (this._isHovered = !1, this._setTimeout((() => {
							this._isHovered || this.hide()
						}), this._config.delay.hide))
					}
					_setTimeout(t, e) {
						clearTimeout(this._timeout), this._timeout = setTimeout(t, e)
					}
					_isWithActiveTrigger() {
						return Object.values(this._activeTrigger).includes(!0)
					}
					_getConfig(t) {
						const e = ve.getDataAttributes(this._element);
						for (const t of Object.keys(e)) on.has(t) && delete e[t];
						return t = {
							...e,
							..."object" == typeof t && t ? t : {}
						}, t = this._mergeConfigObj(t), t = this._configAfterMerge(t), this._typeCheckConfig(t), t
					}
					_configAfterMerge(t) {
						return t.container = !1 === t.container ? document.body : Wt(t.container), "number" == typeof t.delay && (t.delay = {
							show: t.delay,
							hide: t.delay
						}), t.originalTitle = this._element.getAttribute("title") || "", "number" == typeof t.title && (t.title = t.title.toString()), "number" == typeof t.content && (t.content = t.content.toString()), t
					}
					_getDelegateConfig() {
						const t = {};
						for (const e in this._config) this.constructor.Default[e] !== this._config[e] && (t[e] = this._config[e]);
						return t
					}
					_disposePopper() {
						this._popper && (this._popper.destroy(), this._popper = null)
					}
					static jQueryInterface(t) {
						return this.each((function() {
							const e = gn.getOrCreateInstance(this, t);
							if ("string" == typeof t) {
								if (void 0 === e[t]) throw new TypeError(`No method named "${t}"`);
								e[t]()
							}
						}))
					}
				}
				Xt(gn);
				const mn = {
						...gn.Default,
						content: "",
						offset: [0, 8],
						placement: "right",
						template: '<div class="popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
						trigger: "click"
					},
					_n = {
						...gn.DefaultType,
						content: "(null|string|element|function)"
					};
				class bn extends gn {
					static get Default() {
						return mn
					}
					static get DefaultType() {
						return _n
					}
					static get NAME() {
						return "popover"
					}
					_isWithContent() {
						return this._getTitle() || this._getContent()
					}
					_getContentForTemplate() {
						return {
							".popover-header": this._getTitle(),
							".popover-body": this._getContent()
						}
					}
					_getContent() {
						return this._resolvePossibleFunction(this._config.content)
					}
					static jQueryInterface(t) {
						return this.each((function() {
							const e = bn.getOrCreateInstance(this, t);
							if ("string" == typeof t) {
								if (void 0 === e[t]) throw new TypeError(`No method named "${t}"`);
								e[t]()
							}
						}))
					}
				}
				Xt(bn);
				const vn = "click.bs.scrollspy",
					yn = "active",
					wn = "[href]",
					An = {
						offset: null,
						rootMargin: "0px 0px -25%",
						smoothScroll: !1,
						target: null
					},
					En = {
						offset: "(number|null)",
						rootMargin: "string",
						smoothScroll: "boolean",
						target: "element"
					};
				class Tn extends we {
					constructor(t, e) {
						super(t, e), this._targetLinks = new Map, this._observableSections = new Map, this._rootElement = "visible" === getComputedStyle(this._element).overflowY ? null : this._element, this._activeTarget = null, this._observer = null, this._previousScrollData = {
							visibleEntryTop: 0,
							parentScrollTop: 0
						}, this.refresh()
					}
					static get Default() {
						return An
					}
					static get DefaultType() {
						return En
					}
					static get NAME() {
						return "scrollspy"
					}
					refresh() {
						this._initializeTargetsAndObservables(), this._maybeEnableSmoothScroll(), this._observer ? this._observer.disconnect() : this._observer = this._getNewObserver();
						for (const t of this._observableSections.values()) this._observer.observe(t)
					}
					dispose() {
						this._observer.disconnect(), super.dispose()
					}
					_configAfterMerge(t) {
						return t.target = Wt(t.target) || document.body, t
					}
					_maybeEnableSmoothScroll() {
						this._config.smoothScroll && (fe.off(this._config.target, vn), fe.on(this._config.target, vn, wn, (t => {
							const e = this._observableSections.get(t.target.hash);
							if (e) {
								t.preventDefault();
								const i = this._rootElement || window,
									n = e.offsetTop - this._element.offsetTop;
								if (i.scrollTo) return void i.scrollTo({
									top: n,
									behavior: "smooth"
								});
								i.scrollTop = n
							}
						})))
					}
					_getNewObserver() {
						const t = {
							root: this._rootElement,
							threshold: [.1, .5, 1],
							rootMargin: this._getRootMargin()
						};
						return new IntersectionObserver((t => this._observerCallback(t)), t)
					}
					_observerCallback(t) {
						const e = t => this._targetLinks.get(`#${t.target.id}`),
							i = t => {
								this._previousScrollData.visibleEntryTop = t.target.offsetTop, this._process(e(t))
							},
							n = (this._rootElement || document.documentElement).scrollTop,
							s = n >= this._previousScrollData.parentScrollTop;
						this._previousScrollData.parentScrollTop = n;
						for (const o of t) {
							if (!o.isIntersecting) {
								this._activeTarget = null, this._clearActiveClass(e(o));
								continue
							}
							const t = o.target.offsetTop >= this._previousScrollData.visibleEntryTop;
							if (s && t) {
								if (i(o), !n) return
							} else s || t || i(o)
						}
					}
					_getRootMargin() {
						return this._config.offset ? `${this._config.offset}px 0px -30%` : this._config.rootMargin
					}
					_initializeTargetsAndObservables() {
						this._targetLinks = new Map, this._observableSections = new Map;
						const t = Oe.find(wn, this._config.target);
						for (const e of t) {
							if (!e.hash || Ft(e)) continue;
							const t = Oe.findOne(e.hash, this._element);
							Bt(t) && (this._targetLinks.set(e.hash, e), this._observableSections.set(e.hash, t))
						}
					}
					_process(t) {
						this._activeTarget !== t && (this._clearActiveClass(this._config.target), this._activeTarget = t, t.classList.add(yn), this._activateParents(t), fe.trigger(this._element, "activate.bs.scrollspy", {
							relatedTarget: t
						}))
					}
					_activateParents(t) {
						if (t.classList.contains("dropdown-item")) Oe.findOne(".dropdown-toggle", t.closest(".dropdown")).classList.add(yn);
						else
							for (const e of Oe.parents(t, ".nav, .list-group"))
								for (const t of Oe.prev(e, ".nav-link, .nav-item > .nav-link, .list-group-item")) t.classList.add(yn)
					}
					_clearActiveClass(t) {
						t.classList.remove(yn);
						const e = Oe.find("[href].active", t);
						for (const t of e) t.classList.remove(yn)
					}
					static jQueryInterface(t) {
						return this.each((function() {
							const e = Tn.getOrCreateInstance(this, t);
							if ("string" == typeof t) {
								if (void 0 === e[t] || t.startsWith("_") || "constructor" === t) throw new TypeError(`No method named "${t}"`);
								e[t]()
							}
						}))
					}
				}
				fe.on(window, "load.bs.scrollspy.data-api", (() => {
					for (const t of Oe.find('[data-bs-spy="scroll"]')) Tn.getOrCreateInstance(t)
				})), Xt(Tn);
				const Cn = "ArrowLeft",
					On = "ArrowRight",
					xn = "ArrowUp",
					kn = "ArrowDown",
					Ln = "active",
					Dn = "fade",
					Sn = "show",
					In = '[data-bs-toggle="tab"], [data-bs-toggle="pill"], [data-bs-toggle="list"]',
					Nn = `.nav-link:not(.dropdown-toggle), .list-group-item:not(.dropdown-toggle), [role="tab"]:not(.dropdown-toggle), ${In}`;
				class Pn extends we {
					constructor(t) {
						super(t), this._parent = this._element.closest('.list-group, .nav, [role="tablist"]'), this._parent && (this._setInitialAttributes(this._parent, this._getChildren()), fe.on(this._element, "keydown.bs.tab", (t => this._keydown(t))))
					}
					static get NAME() {
						return "tab"
					}
					show() {
						const t = this._element;
						if (this._elemIsActive(t)) return;
						const e = this._getActiveElem(),
							i = e ? fe.trigger(e, "hide.bs.tab", {
								relatedTarget: t
							}) : null;
						fe.trigger(t, "show.bs.tab", {
							relatedTarget: e
						}).defaultPrevented || i && i.defaultPrevented || (this._deactivate(e, t), this._activate(t, e))
					}
					_activate(t, e) {
						if (!t) return;
						t.classList.add(Ln), this._activate(Mt(t));
						this._queueCallback((() => {
							"tab" === t.getAttribute("role") ? (t.focus(), t.removeAttribute("tabindex"), t.setAttribute("aria-selected", !0), this._toggleDropDown(t, !0), fe.trigger(t, "shown.bs.tab", {
								relatedTarget: e
							})) : t.classList.add(Sn)
						}), t, t.classList.contains(Dn))
					}
					_deactivate(t, e) {
						if (!t) return;
						t.classList.remove(Ln), t.blur(), this._deactivate(Mt(t));
						this._queueCallback((() => {
							"tab" === t.getAttribute("role") ? (t.setAttribute("aria-selected", !1), t.setAttribute("tabindex", "-1"), this._toggleDropDown(t, !1), fe.trigger(t, "hidden.bs.tab", {
								relatedTarget: e
							})) : t.classList.remove(Sn)
						}), t, t.classList.contains(Dn))
					}
					_keydown(t) {
						if (![Cn, On, xn, kn].includes(t.key)) return;
						t.stopPropagation(), t.preventDefault();
						const e = [On, kn].includes(t.key),
							i = Gt(this._getChildren().filter((t => !Ft(t))), t.target, e, !0);
						i && Pn.getOrCreateInstance(i).show()
					}
					_getChildren() {
						return Oe.find(Nn, this._parent)
					}
					_getActiveElem() {
						return this._getChildren().find((t => this._elemIsActive(t))) || null
					}
					_setInitialAttributes(t, e) {
						this._setAttributeIfNotExists(t, "role", "tablist");
						for (const t of e) this._setInitialAttributesOnChild(t)
					}
					_setInitialAttributesOnChild(t) {
						t = this._getInnerElement(t);
						const e = this._elemIsActive(t),
							i = this._getOuterElement(t);
						t.setAttribute("aria-selected", e), i !== t && this._setAttributeIfNotExists(i, "role", "presentation"), e || t.setAttribute("tabindex", "-1"), this._setAttributeIfNotExists(t, "role", "tab"), this._setInitialAttributesOnTargetPanel(t)
					}
					_setInitialAttributesOnTargetPanel(t) {
						const e = Mt(t);
						e && (this._setAttributeIfNotExists(e, "role", "tabpanel"), t.id && this._setAttributeIfNotExists(e, "aria-labelledby", `#${t.id}`))
					}
					_toggleDropDown(t, e) {
						const i = this._getOuterElement(t);
						if (!i.classList.contains("dropdown")) return;
						const n = (t, n) => {
							const s = Oe.findOne(t, i);
							s && s.classList.toggle(n, e)
						};
						n(".dropdown-toggle", Ln), n(".dropdown-menu", Sn), n(".dropdown-item", Ln), i.setAttribute("aria-expanded", e)
					}
					_setAttributeIfNotExists(t, e, i) {
						t.hasAttribute(e) || t.setAttribute(e, i)
					}
					_elemIsActive(t) {
						return t.classList.contains(Ln)
					}
					_getInnerElement(t) {
						return t.matches(Nn) ? t : Oe.findOne(Nn, t)
					}
					_getOuterElement(t) {
						return t.closest(".nav-item, .list-group-item") || t
					}
					static jQueryInterface(t) {
						return this.each((function() {
							const e = Pn.getOrCreateInstance(this);
							if ("string" == typeof t) {
								if (void 0 === e[t] || t.startsWith("_") || "constructor" === t) throw new TypeError(`No method named "${t}"`);
								e[t]()
							}
						}))
					}
				}
				fe.on(document, "click.bs.tab", In, (function(t) {
					["A", "AREA"].includes(this.tagName) && t.preventDefault(), Ft(this) || Pn.getOrCreateInstance(this).show()
				})), fe.on(window, "load.bs.tab", (() => {
					for (const t of Oe.find('.active[data-bs-toggle="tab"], .active[data-bs-toggle="pill"], .active[data-bs-toggle="list"]')) Pn.getOrCreateInstance(t)
				})), Xt(Pn);
				const jn = "hide",
					Mn = "show",
					Hn = "showing",
					$n = {
						animation: "boolean",
						autohide: "boolean",
						delay: "number"
					},
					Wn = {
						animation: !0,
						autohide: !0,
						delay: 5e3
					};
				class Bn extends we {
					constructor(t, e) {
						super(t, e), this._timeout = null, this._hasMouseInteraction = !1, this._hasKeyboardInteraction = !1, this._setListeners()
					}
					static get Default() {
						return Wn
					}
					static get DefaultType() {
						return $n
					}
					static get NAME() {
						return "toast"
					}
					show() {
						if (fe.trigger(this._element, "show.bs.toast").defaultPrevented) return;
						this._clearTimeout(), this._config.animation && this._element.classList.add("fade");
						this._element.classList.remove(jn), qt(this._element), this._element.classList.add(Mn, Hn), this._queueCallback((() => {
							this._element.classList.remove(Hn), fe.trigger(this._element, "shown.bs.toast"), this._maybeScheduleHide()
						}), this._element, this._config.animation)
					}
					hide() {
						if (!this.isShown()) return;
						if (fe.trigger(this._element, "hide.bs.toast").defaultPrevented) return;
						this._element.classList.add(Hn), this._queueCallback((() => {
							this._element.classList.add(jn), this._element.classList.remove(Hn, Mn), fe.trigger(this._element, "hidden.bs.toast")
						}), this._element, this._config.animation)
					}
					dispose() {
						this._clearTimeout(), this.isShown() && this._element.classList.remove(Mn), super.dispose()
					}
					isShown() {
						return this._element.classList.contains(Mn)
					}
					_maybeScheduleHide() {
						this._config.autohide && (this._hasMouseInteraction || this._hasKeyboardInteraction || (this._timeout = setTimeout((() => {
							this.hide()
						}), this._config.delay)))
					}
					_onInteraction(t, e) {
						switch (t.type) {
							case "mouseover":
							case "mouseout":
								this._hasMouseInteraction = e;
								break;
							case "focusin":
							case "focusout":
								this._hasKeyboardInteraction = e
						}
						if (e) return void this._clearTimeout();
						const i = t.relatedTarget;
						this._element === i || this._element.contains(i) || this._maybeScheduleHide()
					}
					_setListeners() {
						fe.on(this._element, "mouseover.bs.toast", (t => this._onInteraction(t, !0))), fe.on(this._element, "mouseout.bs.toast", (t => this._onInteraction(t, !1))), fe.on(this._element, "focusin.bs.toast", (t => this._onInteraction(t, !0))), fe.on(this._element, "focusout.bs.toast", (t => this._onInteraction(t, !1)))
					}
					_clearTimeout() {
						clearTimeout(this._timeout), this._timeout = null
					}
					static jQueryInterface(t) {
						return this.each((function() {
							const e = Bn.getOrCreateInstance(this, t);
							if ("string" == typeof t) {
								if (void 0 === e[t]) throw new TypeError(`No method named "${t}"`);
								e[t](this)
							}
						}))
					}
				}
				Ae(Bn), Xt(Bn)
			}
		},
		i = {};

	function n(t) {
		var s = i[t];
		if (void 0 !== s) return s.exports;
		var o = i[t] = {
			exports: {}
		};
		return e[t](o, o.exports, n), o.exports
	}
	n.d = (t, e) => {
		for (var i in e) n.o(e, i) && !n.o(t, i) && Object.defineProperty(t, i, {
			enumerable: !0,
			get: e[i]
		})
	}, n.o = (t, e) => Object.prototype.hasOwnProperty.call(t, e), n.r = t => {
		"undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
			value: "Module"
		}), Object.defineProperty(t, "__esModule", {
			value: !0
		})
	}, t = n(244), window.bootstrap = t
})();
