! function (e, t) {
    "object" == typeof exports && "undefined" != typeof module ? t(exports) : "function" == typeof define && define.amd ? define(["exports"], t) : t(e["leaflet-simple-map-screenshoter"] = e["leaflet-simple-map-screenshoter"] || {})
}(this, function (e) {
    "use strict";

    function t(e, t) {
        return t = {
            exports: {}
        }, e(t, t.exports), t.exports
    }
    var n = "undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : {},
        o = t(function (e, t) {
            ! function (t) {
                function n(e, t) {
                    function n(e) {
                        return t.bgcolor && (e.style.backgroundColor = t.bgcolor), t.width && (e.style.width = t.width + "px"), t.height && (e.style.height = t.height + "px"), t.style && Object.keys(t.style).forEach(function (n) {
                            e.style[n] = t.style[n]
                        }), e
                    }
                    return t = t || {}, c(t), Promise.resolve(e).then(function (e) {
                        return u(e, t.filter, !0)
                    }).then(h).then(f).then(n).then(function (n) {
                        return d(n, t.width || p.width(e), t.height || p.height(e))
                    })
                }

                function o(e, t) {
                    return l(e, t || {}).then(function (t) {
                        return t.getContext("2d").getImageData(0, 0, p.width(e), p.height(e)).data
                    })
                }

                function r(e, t) {
                    return l(e, t || {}).then(function (e) {
                        return e.toDataURL()
                    })
                }

                function i(e, t) {
                    return t = t || {}, l(e, t).then(function (e) {
                        return e.toDataURL("image/jpeg", t.quality || 1)
                    })
                }

                function a(e, t) {
                    return l(e, t || {}).then(p.canvasToBlob)
                }

                function s(e, t) {
                    return l(e, t || {})
                }

                function c(e) {
                    void 0 === e.imagePlaceholder ? v.impl.options.imagePlaceholder = M.imagePlaceholder : v.impl.options.imagePlaceholder = e.imagePlaceholder, void 0 === e.cacheBust ? v.impl.options.cacheBust = M.cacheBust : v.impl.options.cacheBust = e.cacheBust, void 0 === e.useCredentials ? v.impl.options.useCredentials = M.useCredentials : v.impl.options.useCredentials = e.useCredentials
                }

                function l(e, t) {
                    function o(e, n) {
                        var o = document.createElement("canvas");
                        if (o.width = (t.width || p.width(e)) * n, o.height = (t.height || p.height(e)) * n, t.bgcolor) {
                            var r = o.getContext("2d");
                            r.fillStyle = t.bgcolor, r.fillRect(0, 0, o.width, o.height)
                        }
                        return o
                    }
                    return n(e, t).then(p.makeImage).then(p.delay(100)).then(function (n) {
                        var r = "number" != typeof t.scale ? 1 : t.scale,
                            i = o(e, r),
                            a = i.getContext("2d");
                        return n && (a.scale(r, r), a.drawImage(n, 0, 0)), i
                    })
                }

                function u(e, t, n) {
                    function o(e) {
                        return e instanceof HTMLCanvasElement ? p.makeImage(e.toDataURL()) : e.cloneNode(!1)
                    }

                    function r(e, t, n) {
                        var o = e.childNodes;
                        return 0 === o.length ? Promise.resolve(t) : function (e, t, n) {
                            var o = Promise.resolve();
                            return t.forEach(function (t) {
                                o = o.then(function () {
                                    return u(t, n)
                                }).then(function (t) {
                                    t && e.appendChild(t)
                                })
                            }), o
                        }(t, p.asArray(o), n).then(function () {
                            return t
                        })
                    }

                    function i(e, t) {
                        function n() {
                            ! function (e, t) {
                                e.cssText ? (t.cssText = e.cssText, t.font = e.font) : function (e, t) {
                                    p.asArray(e).forEach(function (n) {
                                        t.setProperty(n, e.getPropertyValue(n), e.getPropertyPriority(n))
                                    })
                                }(e, t)
                            }(window.getComputedStyle(e), t.style)
                        }

                        function o() {
                            function n(n) {
                                var o = window.getComputedStyle(e, n),
                                    r = o.getPropertyValue("content");
                                if ("" !== r && "none" !== r) {
                                    var i = p.uid(),
                                        a = t.getAttribute("class");
                                    a && t.setAttribute("class", a + " " + i);
                                    var s = document.createElement("style");
                                    s.appendChild(function (e, t, n) {
                                        var o = "." + e + ":" + t,
                                            r = n.cssText ? function (e) {
                                                var t = e.getPropertyValue("content");
                                                return e.cssText + " content: " + t + ";"
                                            }(n) : function (e) {
                                                function t(t) {
                                                    return t + ": " + e.getPropertyValue(t) + (e.getPropertyPriority(t) ? " !important" : "")
                                                }
                                                return p.asArray(e).map(t).join("; ") + ";"
                                            }(n);
                                        return document.createTextNode(o + "{" + r + "}")
                                    }(i, n, o)), t.appendChild(s)
                                }
                            } [":before", ":after"].forEach(function (e) {
                                n(e)
                            })
                        }

                        function r() {
                            e instanceof HTMLTextAreaElement && (t.innerHTML = e.value), e instanceof HTMLInputElement && t.setAttribute("value", e.value)
                        }

                        function i() {
                            t instanceof SVGElement && (t.setAttribute("xmlns", "http://www.w3.org/2000/svg"), t instanceof SVGRectElement && ["width", "height"].forEach(function (e) {
                                var n = t.getAttribute(e);
                                n && t.style.setProperty(e, n)
                            }))
                        }
                        return t instanceof Element ? Promise.resolve().then(n).then(o).then(r).then(i).then(function () {
                            return t
                        }) : t
                    }
                    return n || !t || t(e) ? Promise.resolve(e).then(o).then(function (n) {
                        return r(e, n, t)
                    }).then(function (t) {
                        return i(e, t)
                    }) : Promise.resolve()
                }

                function h(e) {
                    return g.resolveAll().then(function (t) {
                        var n = document.createElement("style");
                        return e.appendChild(n), n.appendChild(document.createTextNode(t)), e
                    })
                }

                function f(e) {
                    return w.inlineAll(e).then(function () {
                        return e
                    })
                }

                function d(e, t, n) {
                    return Promise.resolve(e).then(function (e) {
                        return e.setAttribute("xmlns", "http://www.w3.org/1999/xhtml"), (new XMLSerializer).serializeToString(e)
                    }).then(p.escapeXhtml).then(function (e) {
                        return '<foreignObject x="0" y="0" width="100%" height="100%">' + e + "</foreignObject>"
                    }).then(function (e) {
                        return '<svg xmlns="http://www.w3.org/2000/svg" width="' + t + '" height="' + n + '">' + e + "</svg>"
                    }).then(function (e) {
                        return "data:image/svg+xml;charset=utf-8," + e
                    })
                }
                var p = function () {
                    function e() {
                        var e = "application/font-woff";
                        return {
                            woff: e,
                            woff2: e,
                            ttf: "application/font-truetype",
                            eot: "application/vnd.ms-fontobject",
                            png: "image/png",
                            jpg: "image/jpeg",
                            jpeg: "image/jpeg",
                            gif: "image/gif",
                            tiff: "image/tiff",
                            svg: "image/svg+xml"
                        }
                    }

                    function t(e) {
                        var t = /\.([^\.\/]*?)(\?|$)/g.exec(e);
                        return t ? t[1] : ""
                    }

                    function n(n) {
                        var o = t(n).toLowerCase();
                        return e()[o] || ""
                    }

                    function o(e) {
                        return -1 !== e.search(/^(data:)/)
                    }

                    function r(e) {
                        return new Promise(function (t) {
                            for (var n = window.atob(e.toDataURL().split(",")[1]), o = n.length, r = new Uint8Array(o), i = 0; i < o; i++) r[i] = n.charCodeAt(i);
                            t(new Blob([r], {
                                type: "image/png"
                            }))
                        })
                    }

                    function i(e) {
                        return e.toBlob ? new Promise(function (t) {
                            e.toBlob(t)
                        }) : r(e)
                    }

                    function a(e, t) {
                        var n = document.implementation.createHTMLDocument(),
                            o = n.createElement("base");
                        n.head.appendChild(o);
                        var r = n.createElement("a");
                        return n.body.appendChild(r), o.href = t, r.href = e, r.href
                    }

                    function s(e) {
                        return "data:," === e ? Promise.resolve() : new Promise(function (t, n) {
                            var o = new Image;
                            v.impl.options.useCredentials && (o.crossOrigin = "use-credentials"), o.onload = function () {
                                t(o)
                            }, o.onerror = n, o.src = e
                        })
                    }

                    function c(e) {
                        var t = 3e4;
                        var link = e;
                        return v.impl.options.cacheBust && (e += (/\?/.test(e) ? "&" : "?") + (new Date).getTime()), new Promise(function (n) {
                            function o() {
                                //console.log('NICE => ', link)
                                if (4 === a.readyState) {
                                    if (200 !== a.status) return void (s ? n(s) : i("cannot fetch resource: " + e + ", status: " + a.status));

                                    if (typeof link != "undefined" && link != null && link.includes('idesep.senamhi.gob.pe')) {
                                        var e = a.response.base64;
                                        //console.log('NICE 2 => ', a.response)
                                        n(e);
                                    } else {
                                        //console.log('NICE 3 => ', a.response)
                                        var t = new FileReader;
                                        t.onloadend = function () {
                                            var e = t.result.split(/,/)[1];
                                            n(e)
                                        }, t.readAsDataURL(a.response)
                                    }
                                }
                            }

                            function r() {
                                s ? n(s) : i("timeout of " + t + "ms occured while fetching resource: " + e)
                            }

                            function i(e) {
                                console.error(e), n("")
                            }
                            var a = new XMLHttpRequest;
                            var datos = new FormData();
                            var url = 'ajax/ajax-image-riesgo.php'
                            datos.append('url', e);

                            //console.log('GET 2 => ', e)
                            if (typeof e != "undefined" && e != null && e.includes('idesep.senamhi.gob.pe')) {
                                a.onreadystatechange = o, a.ontimeout = r, a.responseType = "json", a.timeout = t, v.impl.options.useCredentials && (a.withCredentials = !0), a.open("POST", url, !0), a.send(datos);
                            } else {
                                a.onreadystatechange = o, a.ontimeout = r, a.responseType = "blob", a.timeout = t, v.impl.options.useCredentials && (a.withCredentials = !0), a.open("GET", e, !0), a.send();
                            }

                            var s;
                            if (v.impl.options.imagePlaceholder) {
                                var c = v.impl.options.imagePlaceholder.split(/,/);
                                c && c[1] && (s = c[1])
                            }
                        })
                    }

                    function l(e, t) {
                        //console.log('YEP => ', { t, e })
                        return "data:" + t + ";base64," + e
                    }

                    function u(e) {
                        return e.replace(/([.*+?^${}()|\[\]\/\\])/g, "\\$1")
                    }

                    function h(e) {
                        return function (t) {
                            return new Promise(function (n) {
                                setTimeout(function () {
                                    n(t)
                                }, e)
                            })
                        }
                    }

                    function f(e) {
                        for (var t = [], n = e.length, o = 0; o < n; o++) t.push(e[o]);
                        return t
                    }

                    function d(e) {
                        return e.replace(/#/g, "%23").replace(/\n/g, "%0A")
                    }

                    function p(e) {
                        var t = g(e, "border-left-width"),
                            n = g(e, "border-right-width");
                        return e.scrollWidth + t + n
                    }

                    function m(e) {
                        var t = g(e, "border-top-width"),
                            n = g(e, "border-bottom-width");
                        return e.scrollHeight + t + n
                    }

                    function g(e, t) {
                        var n = window.getComputedStyle(e).getPropertyValue(t);
                        return parseFloat(n.replace("px", ""))
                    }
                    return {
                        escape: u,
                        parseExtension: t,
                        mimeType: n,
                        dataAsUrl: l,
                        isDataUrl: o,
                        canvasToBlob: i,
                        resolveUrl: a,
                        getAndEncode: c,
                        uid: function () {
                            var e = 0;
                            return function () {
                                return "u" + function () {
                                    return ("0000" + (Math.random() * Math.pow(36, 4) << 0).toString(36)).slice(-4)
                                }() + e++
                            }
                        }(),
                        delay: h,
                        asArray: f,
                        escapeXhtml: d,
                        makeImage: s,
                        width: p,
                        height: m
                    }
                }(),
                    m = function () {
                        function e(e) {
                            return -1 !== e.search(r)
                        }

                        function t(e) {
                            for (var t, n = []; null !== (t = r.exec(e));) n.push(t[1]);
                            return n.filter(function (e) {
                                return !p.isDataUrl(e)
                            })
                        }

                        function n(e, t, n, o) {
                            function r(e) {
                                return new RegExp("(url\\(['\"]?)(" + p.escape(e) + ")(['\"]?\\))", "g")
                            }
                            return Promise.resolve(t).then(function (e) {
                                return n ? p.resolveUrl(e, n) : e
                            }).then(o || p.getAndEncode).then(function (e) {
                                return p.dataAsUrl(e, p.mimeType(t))
                            }).then(function (n) {
                                return e.replace(r(t), "$1" + n + "$3")
                            })
                        }

                        function o(o, r, i) {
                            return function () {
                                return !e(o)
                            }() ? Promise.resolve(o) : Promise.resolve(o).then(t).then(function (e) {
                                var t = Promise.resolve(o);
                                return e.forEach(function (e) {
                                    t = t.then(function (t) {
                                        return n(t, e, r, i)
                                    })
                                }), t
                            })
                        }
                        var r = /url\(['"]?([^'"]+?)['"]?\)/g;
                        return {
                            inlineAll: o,
                            shouldProcess: e,
                            impl: {
                                readUrls: t,
                                inline: n
                            }
                        }
                    }(),
                    g = function () {
                        function e() {
                            return t(document).then(function (e) {
                                return Promise.all(e.map(function (e) {
                                    return e.resolve()
                                }))
                            }).then(function (e) {
                                return e.join("\n")
                            })
                        }

                        function t() {
                            function e(e) {
                                return e.filter(function (e) {
                                    return e.type === CSSRule.FONT_FACE_RULE
                                }).filter(function (e) {
                                    return m.shouldProcess(e.style.getPropertyValue("src"))
                                })
                            }

                            function t(e) {
                                var t = [];
                                return e.forEach(function (e) {
                                    if (e.hasOwnProperty("cssRules")) try {
                                        p.asArray(e.cssRules || []).forEach(t.push.bind(t))
                                    } catch (t) {
                                        console.log("Error while reading CSS rules from " + e.href, t.toString())
                                    }
                                }), t
                            }

                            function n(e) {
                                return {
                                    resolve: function () {
                                        var t = (e.parentStyleSheet || {}).href;
                                        return m.inlineAll(e.cssText, t)
                                    },
                                    src: function () {
                                        return e.style.getPropertyValue("src")
                                    }
                                }
                            }
                            return Promise.resolve(p.asArray(document.styleSheets)).then(t).then(e).then(function (e) {
                                return e.map(n)
                            })
                        }
                        return {
                            resolveAll: e,
                            impl: {
                                readAll: t
                            }
                        }
                    }(),
                    w = function () {
                        function e(e) {
                            function t(t) {
                                return p.isDataUrl(e.src) ? Promise.resolve() : Promise.resolve(e.src).then(t || p.getAndEncode).then(function (t) {
                                    return p.dataAsUrl(t, p.mimeType(e.src))
                                }).then(function (t) {
                                    return new Promise(function (n, o) {
                                        e.onload = n, e.onerror = n, e.src = t
                                    })
                                })
                            }
                            return {
                                inline: t
                            }
                        }

                        function t(n) {
                            return n instanceof Element ? function (e) {
                                var t = e.style.getPropertyValue("background");
                                return t ? m.inlineAll(t).then(function (t) {
                                    e.style.setProperty("background", t, e.style.getPropertyPriority("background"))
                                }).then(function () {
                                    return e
                                }) : Promise.resolve(e)
                            }(n).then(function () {
                                return n instanceof HTMLImageElement ? e(n).inline() : Promise.all(p.asArray(n.childNodes).map(function (e) {
                                    return t(e)
                                }))
                            }) : Promise.resolve(n)
                        }
                        return {
                            inlineAll: t,
                            impl: {
                                newImage: e
                            }
                        }
                    }(),
                    M = {
                        imagePlaceholder: void 0,
                        cacheBust: !1,
                        useCredentials: !1
                    },
                    v = {
                        toSvg: n,
                        toPng: r,
                        toJpeg: i,
                        toBlob: a,
                        toPixelData: o,
                        toCanvas: s,
                        impl: {
                            fontFaces: g,
                            images: w,
                            util: p,
                            inliner: m,
                            options: {}
                        }
                    };
                e.exports = v
            }()
        }),
        r = t(function (e, t) {
            ! function (e, t) {
                t()
            }(0, function () {
                function t(e, t) {
                    return void 0 === t ? t = {
                        autoBom: !1
                    } : "object" != typeof t && (console.warn("Deprecated: Expected third argument to be a object"), t = {
                        autoBom: !t
                    }), t.autoBom && /^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(e.type) ? new Blob(["\ufeff", e], {
                        type: e.type
                    }) : e
                }

                function o(e, t, n) {
                    var o = new XMLHttpRequest;
                    o.open("GET", e), o.responseType = "blob", o.onload = function () {
                        s(o.response, t, n)
                    }, o.onerror = function () {
                        console.error("could not download file")
                    }, o.send()
                }

                function r(e) {
                    var t = new XMLHttpRequest;
                    t.open("HEAD", e, !1);
                    try {
                        t.send()
                    } catch (e) { }
                    return 200 <= t.status && 299 >= t.status
                }

                function i(e) {
                    try {
                        e.dispatchEvent(new MouseEvent("click"))
                    } catch (n) {
                        var t = document.createEvent("MouseEvents");
                        t.initMouseEvent("click", !0, !0, window, 0, 0, 0, 80, 20, !1, !1, !1, !1, 0, null), e.dispatchEvent(t)
                    }
                }
                var a = "object" == typeof window && window.window === window ? window : "object" == typeof self && self.self === self ? self : "object" == typeof n && n.global === n ? n : void 0,
                    s = a.saveAs || ("object" != typeof window || window !== a ? function () { } : "download" in HTMLAnchorElement.prototype ? function (e, t, n) {
                        var s = a.URL || a.webkitURL,
                            c = document.createElement("a");
                        t = t || e.name || "download", c.download = t, c.rel = "noopener", "string" == typeof e ? (c.href = e, c.origin === location.origin ? i(c) : r(c.href) ? o(e, t, n) : i(c, c.target = "_blank")) : (c.href = s.createObjectURL(e), setTimeout(function () {
                            s.revokeObjectURL(c.href)
                        }, 4e4), setTimeout(function () {
                            i(c)
                        }, 0))
                    } : "msSaveOrOpenBlob" in navigator ? function (e, n, a) {
                        if (n = n || e.name || "download", "string" != typeof e) navigator.msSaveOrOpenBlob(t(e, a), n);
                        else if (r(e)) o(e, n, a);
                        else {
                            var s = document.createElement("a");
                            s.href = e, s.target = "_blank", setTimeout(function () {
                                i(s)
                            })
                        }
                    } : function (e, t, n, r) {
                        if (r = r || open("", "_blank"), r && (r.document.title = r.document.body.innerText = "downloading..."), "string" == typeof e) return o(e, t, n);
                        var i = "application/octet-stream" === e.type,
                            s = /constructor/i.test(a.HTMLElement) || a.safari,
                            c = /CriOS\/[\d]+/.test(navigator.userAgent);
                        if ((c || i && s) && "object" == typeof FileReader) {
                            var l = new FileReader;
                            l.onloadend = function () {
                                var e = l.result;
                                e = c ? e : e.replace(/^data:[^;]*;/, "data:attachment/file;"), r ? r.location.href = e : location = e, r = null
                            }, l.readAsDataURL(e)
                        } else {
                            var u = a.URL || a.webkitURL,
                                h = u.createObjectURL(e);
                            r ? r.location = h : location.href = h, r = null, setTimeout(function () {
                                u.revokeObjectURL(h)
                            }, 4e4)
                        }
                    });
                a.saveAs = s.saveAs = s, e.exports = s
            })
        }),
        i = L.Control.extend({
            options: {
                cropImageByInnerWH: !0,
                hidden: !1,
                domtoimageOptions: {},
                position: "topleft",
                screenName: "screen",
                iconUrl: "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDMyIDMyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMiAzMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxnPjxnIGlkPSJjYW1lcmEiPjxwYXRoIHN0eWxlPSJmaWxsOiMwMTAwMDI7IiBkPSJNMTYsOS41MDFjLTQuNDE5LDAtOCwzLjU4MS04LDhjMCw0LjQxOCwzLjU4MSw4LDgsOGM0LjQxOCwwLDgtMy41ODIsOC04UzIwLjQxOCw5LjUwMSwxNiw5LjUwMXogTTIwLjU1NSwyMS40MDZjLTIuMTU2LDIuNTE2LTUuOTQzLDIuODA3LTguNDU5LDAuNjVjLTIuNTE3LTIuMTU2LTIuODA3LTUuOTQ0LTAuNjUtOC40NTljMi4xNTUtMi41MTcsNS45NDMtMi44MDcsOC40NTktMC42NUMyMi40MiwxNS4xMDIsMjIuNzExLDE4Ljg5MSwyMC41NTUsMjEuNDA2eiIvPjxwYXRoIHN0eWxlPSJmaWxsOiMwMTAwMDI7IiBkPSJNMTYsMTMuNTAxYy0yLjIwOSwwLTMuOTk5LDEuNzkxLTQsMy45OTl2MC4wMDJjMCwwLjI3NSwwLjIyNCwwLjUsMC41LDAuNXMwLjUtMC4yMjUsMC41LTAuNVYxNy41YzAuMDAxLTEuNjU2LDEuMzQzLTIuOTk5LDMtMi45OTljMC4yNzYsMCwwLjUtMC4yMjQsMC41LTAuNVMxNi4yNzYsMTMuNTAxLDE2LDEzLjUwMXoiLz48cGF0aCBzdHlsZT0iZmlsbDojMDEwMDAyOyIgZD0iTTI5LjQ5Miw4LjU0MmwtNC4zMzQtMC43MjNsLTEuMzczLTMuNDM0QzIzLjMyNiwzLjI0LDIyLjIzMiwyLjUsMjEsMi41SDExYy0xLjIzMiwwLTIuMzI2LDAuNzQtMi43ODYsMS44ODZMNi44NDIsNy44MTlMMi41MDksOC41NDJDMS4wNTUsOC43ODMsMCwxMC4wMjcsMCwxMS41djE1YzAsMS42NTQsMS4zNDYsMywzLDNoMjZjMS42NTQsMCwzLTEuMzQ2LDMtM3YtMTVDMzIsMTAuMDI3LDMwLjk0NSw4Ljc4MywyOS40OTIsOC41NDJ6IE0zMCwyNi41YzAsMC41NTMtMC40NDcsMS0xLDFIM2MtMC41NTMsMC0xLTAuNDQ3LTEtMXYtMTVjMC0wLjQ4OSwwLjM1NC0wLjkwNiwwLjgzNi0wLjk4Nkw4LjI4LDkuNjA3bDEuNzkxLTQuNDc4QzEwLjIyNCw0Ljc1LDEwLjU5MSw0LjUsMTEsNC41aDEwYzAuNDA4LDAsMC43NzUsMC4yNDksMC45MjgsMC42MjlsMS43OTEsNC40NzhsNS40NDUsMC45MDdDMjkuNjQ2LDEwLjU5NCwzMCwxMS4wMTEsMzAsMTEuNVYyNi41eiIvPjwvZz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PC9zdmc+",
                hideElementsWithSelectors: [".leaflet-control-container"],
                onCropBorderSize: 2,
                caption: null,
                captionFontSize: 15,
                captionFont: "Arial",
                captionColor: "black",
                captionBgColor: "white",
                captionOffset: 5,
                mimeType: "image/png",
                debugMode: !1,
                preventDownload: !1,
                onPixelDataFail: function (e) {
                    var t = e.node,
                        n = e.error;
                    return console.warn("Map node is very big " + t.scrollWidth + "x" + t.scrollHeight), console.warn("Add function: SimpleMapScreenshoter({\n              onPixelDataFail: function({ node, plugin, error, mapPane, domtoimageOptions }) {\n                 // Solutions:\n                 // decrease size of map\n                 // or decrease zoom level\n                 // or remove elements with big distanses\n                 // and after that return image in Promise - plugin._getPixelDataOfNormalMap\n                 return plugin._getPixelDataOfNormalMap(domtoimageOptions)\n              }\n            })"), Promise.reject(n)
                }
            },
            onAdd: function () {
                return this._container = L.DomUtil.create("div", "leaflet-control-simpleMapScreenshoter"), this._link = null, this._screenState = {
                    status: 1,
                    promise: null
                }, !1 === this.options.hidden && this._addScreenBtn(), this._onUserStartInteractWithMap = this._onUserStartInteractWithMap.bind(this), this._onUserEndInteractWithMap = this._onUserEndInteractWithMap.bind(this), this._map.on("zoomstart", this._onUserStartInteractWithMap), this._map.on("move", this._onUserStartInteractWithMap), this._map.on("zoomend", this._onUserEndInteractWithMap), this._map.on("moveend", this._onUserEndInteractWithMap), this._container
            },
            takeScreen: function () {
                var e = this,
                    t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "blob",
                    n = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                    o = {};
                for (var r in this.options) n.hasOwnProperty(r) ? o[r] = n[r] : o[r] = this.options[r];
                return 2 === this._screenState.status ? this._screenState.promise : (this._map.fire("simpleMapScreenshoter.takeScreen"), this._screenState.status = 2, this._setElementsVisible(!1), this._screenState.promise = this._waitEndOfInteractions().then(function () {
                    return e._getPixelData(o)
                }).then(function (t) {
                    return e._setElementsVisible(!0), e._toCanvas(t, o)
                }).then(function (n) {
                    return "image" === t ? e._canvasToImage(n, o) : "canvas" === t ? n : e._canvasToBlob(n, o)
                }).then(function (t) {
                    return e._screenState.status = 1, e._map.fire("simpleMapScreenshoter.done"), t
                }).catch(function (t) {
                    return e._setElementsVisible(!0), e._screenState.status = 1, e._map.fire("simpleMapScreenshoter.error", {
                        e: t
                    }), Promise.reject(t)
                }), this._screenState.promise)
            },
            _setElementsVisible: function () {
                var e = this,
                    t = arguments.length > 0 && void 0 !== arguments[0] && arguments[0];
                this.options.hideElementsWithSelectors.forEach(function (n) {
                    var o = e._map._container.querySelectorAll(n),
                        r = !0,
                        i = !1,
                        a = void 0;
                    try {
                        for (var s, c = o[Symbol.iterator](); !(r = (s = c.next()).done); r = !0) {
                            s.value.style.opacity = !1 === t ? 0 : 1
                        }
                    } catch (e) {
                        i = !0, a = e
                    } finally {
                        try {
                            !r && c.return && c.return()
                        } finally {
                            if (i) throw a
                        }
                    }
                })
            },
            _canvasToImage: function (e, t) {
                var n = t.mimeType,
                    o = e.toDataURL(n);
                return -1 === o.indexOf("base64") ? Promise.reject(new Error("Base64 image generation error")) : Promise.resolve(o)
            },
            _canvasToBlob: function (e, t) {
                var n = t.mimeType;
                return new Promise(function (t, o) {
                    e.toBlob(function (e) {
                        t(e)
                    }, n)
                })
            },
            _toCanvas: function (e, t) {
                var n = t.captionOffset,
                    o = t.caption,
                    r = t.captionFontSize,
                    i = t.captionFont,
                    a = t.captionColor,
                    s = t.captionBgColor,
                    c = this._node,
                    l = c.screenHeight,
                    u = c.screenWidth,
                    h = document.createElement("canvas");
                h.width = u, h.height = l;
                for (var f = h.getContext("2d"), d = f.createImageData(u, l), p = 0; p < e.length; ++p) d.data[p] = e[p];
                f.putImageData(d, 0, 0), d = null;
                var m = document.createElement("canvas"),
                    g = m.getContext("2d"),
                    w = 0,
                    M = 0,
                    v = l,
                    y = u;
                if (!0 === this.options.cropImageByInnerWH) {
                    for (var L = 0, x = {}, P = {}, b = [], S = 0, j = 0; j < l; ++j) {
                        S = 0;
                        for (var T = 0; T < u; ++T) L = 4 * j * u + 4 * T, 0 === e[L + 4] && S++;
                        S === u && b.push(j)
                    }
                    var C = this._getMinAndMaxOnValuesBreak(b);
                    w = C.min;
                    for (var D = u, N = C.max, E = [], I = 0, _ = M; _ < D; ++_) {
                        I = 0;
                        for (var z = 0; z < l; ++z) L = 4 * z * u + 4 * _, 0 === e[L + 4] && I++;
                        I === l && E.push(_)
                    }
                    var A = this._getMinAndMaxOnValuesBreak(E);
                    M = A.min, D = A.max, (0 === M && 0 === D || null === D) && (D = u), (0 === w && 0 === N || null === N) && (N = l), !0 === this.options.debugMode && (console.log("emptyYLine", b), console.log("minMaxY", C), console.log("emptyXLine", E), console.log("minMaxX", A), console.log("debugX", P), console.log("debugY", x)), 0 === w && N === l && 0 === M && D === u || (w += this.options.onCropBorderSize, N -= this.options.onCropBorderSize, M += this.options.onCropBorderSize, D -= this.options.onCropBorderSize), v = N - w, y = D - M, m.width = y, m.height = v
                } else m.width = y, m.height = v;
                var O = null;
                return o && (O = "function" == typeof o ? o.call(this) : o), null !== O && (m.height = m.height + (n + r + n), g.beginPath(), g.rect(0, 0, m.width, m.height), g.fillStyle = s, g.fill(), g.save()), g.drawImage(h, M, w, y, v, 0, 0, y, v), null !== O && (g.font = r + "px " + i, g.fillStyle = a, g.fillText(O, n, v + n + r)), Promise.resolve(m)
            },
            _getMinAndMaxOnValuesBreak: function (e) {
                for (var t = 0, n = 0, o = !1, r = 1; r < e.length; r++) {
                    if (e[r] - 1 !== e[r - 1]) {
                        n = e[r], o = !0;
                        break
                    }
                    t = e[r]
                }
                return !1 === o && e[0] > 1 ? (t = 0, n = e[0]) : !1 === o && (t = e[e.length - 1] || 0, n = null), {
                    min: t,
                    max: n
                }
            },
            _getPixelData: function (e) {
                var t = this,
                    n = e.domtoimageOptions,
                    o = void 0 === n ? {} : n;
                return this._getPixelDataOfNormalMap(o).catch(function (e) {
                    return console.warn("May be map size very big on that zoom level, we have error:", e.toString()), console.warn("You can manually hide map elements with large distances between them for fix that warn"), t._getPixelDataOfBigMap(o)
                })
            },
            _getPixelDataOfNormalMap: function () {
                var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                    t = this._map.getContainer();
                return this._node = {
                    node: t,
                    screenHeight: t.scrollHeight,
                    screenWidth: t.scrollWidth
                }, o.toPixelData(t, e)
            },
            _getPixelDataOfBigMap: function () {
                var e = this,
                    t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
                    n = this._map.getContainer(),
                    r = this._map.getPane("mapPane");
                r.style.width = 2 * n.clientWidth + "px", r.style.height = 2 * n.clientHeight + "px", r.style.overflow = "hidden";
                var i = function () {
                    r.style.width = "initial", r.style.height = "initial", r.style.overflow = "initial"
                };
                return this._node = {
                    node: n,
                    screenHeight: n.scrollHeight,
                    screenWidth: n.scrollWidth
                }, o.toPixelData(n, t).then(function (e) {
                    return i(), e
                }).catch(function (o) {
                    return i(), n.scrollHeight >= 4e3 || n.scrollWidth >= 4e3 ? e.options.onPixelDataFail({
                        plugin: e,
                        node: n,
                        mapPane: r,
                        error: o,
                        domtoimageOptions: t
                    }) : Promise.reject(o)
                })
            },
            _addScreenBtn: function () {
                this._link = L.DomUtil.create("a", "leaflet-control-simpleMapScreenshoter-btn", this._container), this._addCss(), L.DomEvent.addListener(this._link, "click", this._onScreenBtn, this), L.DomEvent.disableClickPropagation(this._link)
            },
            _addCss: function () {
                var e = "\n    .leaflet-control-simpleMapScreenshoter{\n       border: 2px solid rgba(0,0,0,0.2);\n       background-clip: padding-box;\n    }\n    .leaflet-control-simpleMapScreenshoter a{\n       background-color: #fff;\n       border-bottom: 1px solid #ccc;\n       width: 30px;\n       height: 30px;\n       line-height: 30px;\n       display: block;\n       text-align: center;\n       text-decoration: none;\n       color: black;\n       overflow: hidden;\n       border-radius: 2px;\n       background-image: url('" + this.options.iconUrl + "');\n       background-position: 46% 41%;\n       background-repeat: no-repeat;\n       background-size: 63%;\n    }\n    .leaflet-control-simpleMapScreenshoter a:hover{\n       cursor: pointer;\n    }\n    ",
                    t = document.head || document.getElementsByTagName("head")[0],
                    n = document.createElement("style");
                n.appendChild(document.createTextNode(e)), t.appendChild(n)
            },
            _onScreenBtn: function () {
                var e = this;
                this._map.fire("simpleMapScreenshoter.click"), this.options.preventDownload || this.takeScreen().then(function (t) {
                    var n = "function" == typeof e.options.screenName ? e.options.screenName.call(e) : e.options.screenName;
                    r.saveAs(t, n + ".png")
                }).catch(function (t) {
                    e._map.fire("simpleMapScreenshoter.error", {
                        e: t
                    })
                })
            },
            _onUserStartInteractWithMap: function () {
                this._interaction = !0
            },
            _onUserEndInteractWithMap: function () {
                this._interaction = !1
            },
            _waitEndOfInteractions: function () {
                var e = this;
                return new Promise(function (t) {
                    var n = setInterval(function () {
                        e._interaction || (t(), clearInterval(n))
                    }, 100)
                })
            }
        }),
        a = function () {
            return L.Control.SimpleMapScreenshoter = i, L.simpleMapScreenshoter = function (e) {
                return new L.Control.SimpleMapScreenshoter(e)
            }, i
        }();
    e.default = a, e.SimpleMapScreenshoter = i, Object.defineProperty(e, "__esModule", {
        value: !0
    })
});