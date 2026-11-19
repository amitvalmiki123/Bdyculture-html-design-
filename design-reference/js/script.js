/* BDYCULTURE — homepage interactions */
(function () {
  'use strict';
  var d = document, root = d.documentElement;
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var $ = function (s, c) { return (c || d).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || d).querySelectorAll(s)); };

  /* ---------- drawer ---------- */
  var burger = $('.burger'), drawer = $('#drawer');
  function setDrawer(open) {
    if (!burger || !drawer) return;
    burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    drawer.classList.toggle('is-open', open);
    drawer.setAttribute('aria-hidden', open ? 'false' : 'true');
    d.body.classList.toggle('no-scroll', open);
  }
  if (burger) {
    burger.addEventListener('click', function () { setDrawer(burger.getAttribute('aria-expanded') !== 'true'); });
    $$('a', drawer).forEach(function (a) { a.addEventListener('click', function () { setDrawer(false); }); });
    d.addEventListener('keydown', function (e) { if (e.key === 'Escape') setDrawer(false); });
    window.matchMedia('(min-width: 1100px)').addEventListener('change', function (m) { if (m.matches) setDrawer(false); });
  }

  /* ---------- enquire links focus the hero form (or contact form) ---------- */
  $$('[data-focus-form]').forEach(function (a) {
    a.addEventListener('click', function () {
      var id = a.getAttribute('href').slice(1);
      var box = d.getElementById(id);
      var f = box && $('input', box);
      if (f) setTimeout(function () { f.focus({ preventScroll: true }); }, 500);
    });
  });

  /* ---------- reveal on scroll ---------- */
  var revealEls = $$('.reveal, .reveal-clip');
  /* Scroll-position based (not IntersectionObserver): a clip-path-hidden element
     reports zero visible area to the observer and would never reveal. */
  if (!reduce) {
    revealEls.forEach(function (el, i) { el.style.transitionDelay = (i % 4) * 60 + 'ms'; });
    var pending = revealEls.slice(), ticking = false;
    var checkReveal = function () {
      ticking = false;
      pending = pending.filter(function (el) {
        if (el.getBoundingClientRect().top < innerHeight * 0.92) { el.classList.add('is-in'); return false; }
        return true;
      });
    };
    var onScroll = function () { if (!ticking) { ticking = true; requestAnimationFrame(checkReveal); } };
    addEventListener('scroll', onScroll, { passive: true });
    addEventListener('resize', onScroll);
    addEventListener('load', checkReveal);
    checkReveal();
  } else { revealEls.forEach(function (el) { el.classList.add('is-in'); }); }

  /* ---------- service tabs ---------- */
  $$('[data-tabs]').forEach(function (wrap) {
    var tabs = $$('[role="tab"]', wrap), panels = $$('[role="tabpanel"]', wrap);
    function select(i, focus) {
      tabs.forEach(function (t, j) {
        var on = i === j;
        t.setAttribute('aria-selected', on ? 'true' : 'false');
        t.tabIndex = on ? 0 : -1;
        panels[j].hidden = !on;
      });
      if (focus) tabs[i].focus();
    }
    tabs.forEach(function (t, i) {
      t.addEventListener('click', function () { select(i); });
      t.addEventListener('keydown', function (e) {
        var n = tabs.length, k = e.key;
        if (k === 'ArrowDown' || k === 'ArrowRight') { e.preventDefault(); select((i + 1) % n, true); }
        if (k === 'ArrowUp' || k === 'ArrowLeft') { e.preventDefault(); select((i - 1 + n) % n, true); }
        if (k === 'Home') { e.preventDefault(); select(0, true); }
        if (k === 'End') { e.preventDefault(); select(n - 1, true); }
      });
    });
  });

  /* ---------- FAQ: one open at a time ---------- */
  $$('[data-accordion]').forEach(function (acc) {
    var items = $$('details', acc);
    items.forEach(function (it) {
      it.addEventListener('toggle', function () {
        if (it.open) items.forEach(function (o) { if (o !== it) o.open = false; });
      });
    });
  });

  /* ---------- forms (mockup: success state only, nothing is sent) ---------- */
  $$('[data-form]').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (!form.checkValidity()) { form.reportValidity(); return; }
      var ok = $('.form-ok', form);
      if (ok) { ok.hidden = false; ok.focus && ok.setAttribute('tabindex', '-1'); ok.focus(); }
    });
  });

  /* ---------- range-of-motion gauge (hero signature) ---------- */
  var svg = $('.rom__svg');
  if (svg) {
    var dot = $('.rom__dot', svg), trail = $('.rom__trail', svg), val = $('.rom__val');
    var CX = 220, CY = 160, R = 168, ang = 20, dragging = false, t0 = performance.now(), auto = !reduce;
    function draw(a) {
      var r = a * Math.PI / 180;
      dot.setAttribute('cx', (CX - R * Math.cos(r)).toFixed(1));
      dot.setAttribute('cy', (CY - R * Math.sin(r)).toFixed(1));
      trail.setAttribute('stroke-dasharray', a.toFixed(1) + ' 180');
      val.textContent = Math.round(a) + '°';
      svg.setAttribute('aria-valuenow', Math.round(a));
    }
    function fromPointer(e) {
      var rect = svg.getBoundingClientRect(), s = rect.width / 440;
      var x = (e.clientX - rect.left) / s - CX, y = CY - (e.clientY - rect.top) / s;
      var a = Math.atan2(y, -x) * 180 / Math.PI;       // 0 = left end, 180 = right end
      ang = Math.max(0, Math.min(180, a < -90 ? 180 : a < 0 ? 0 : a));
      draw(ang);
    }
    svg.addEventListener('pointerdown', function (e) { dragging = true; auto = false; svg.setPointerCapture(e.pointerId); fromPointer(e); });
    svg.addEventListener('pointermove', function (e) { if (dragging) fromPointer(e); });
    ['pointerup', 'pointercancel'].forEach(function (n) { svg.addEventListener(n, function () { dragging = false; }); });
    svg.addEventListener('keydown', function (e) {
      var step = e.shiftKey ? 20 : 6;
      if (e.key === 'ArrowRight' || e.key === 'ArrowUp') { auto = false; ang = Math.min(180, ang + step); draw(ang); e.preventDefault(); }
      if (e.key === 'ArrowLeft' || e.key === 'ArrowDown') { auto = false; ang = Math.max(0, ang - step); draw(ang); e.preventDefault(); }
    });
    (function loop(now) {
      if (auto) { ang = 90 + 78 * Math.sin((now - t0) / 1100); draw(ang); }
      if (!reduce) requestAnimationFrame(loop);
    })(performance.now());
    draw(reduce ? 120 : 90);
  }

  /* ---------- photo ribbon: duplicate once for a seamless loop ---------- */
  var track = $('.ribbon__track');
  if (track) { $$('figure', track).slice().forEach(function (f) { track.appendChild(f.cloneNode(true)); }); }

  /* ---------- count-up numbers in the facts strip ---------- */
  $$('[data-count]').forEach(function (el) {
    var end = +el.getAttribute('data-count');
    if (reduce || !('IntersectionObserver' in window)) return;
    el.textContent = '0';
    var cio = new IntersectionObserver(function (en) {
      if (!en[0].isIntersecting) return; cio.disconnect();
      var s = performance.now();
      (function tick(n) { var p = Math.min(1, (n - s) / 1100); el.textContent = Math.round(end * (1 - Math.pow(1 - p, 3))); if (p < 1) requestAnimationFrame(tick); else el.textContent = end; })(s);
    }, { threshold: 0.6 });
    cio.observe(el);
    setTimeout(function () { if (el.textContent === '0') el.textContent = end; }, 4000);
  });

  /* ---------- interactive map (Leaflet / OpenStreetMap, lazy-loaded) ---------- */
  var mapEl = $('#clinic-map'), map, mapReady = false, CLINIC = [-27.3852, 153.0306];
  function loadCSS(href) { var l = d.createElement('link'); l.rel = 'stylesheet'; l.href = href; d.head.appendChild(l); }
  function initMap() {
    if (mapReady || !mapEl) return; mapReady = true;
    var btn = $('[data-load-map]', mapEl); if (btn) btn.remove();
    loadCSS('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css');
    var s = d.createElement('script');
    s.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
    s.onload = function () {
      map = L.map(mapEl, { scrollWheelZoom: false, zoomControl: false }).setView(CLINIC, 16);
      L.control.zoom({ position: 'bottomright' }).addTo(map);
      /* Esri street tiles: no API key, and not blocked (HTTP 403) when the page is opened from file:// like tile.openstreetmap.org is */
      var tiles = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', { maxZoom: 19, attribution: 'Tiles &copy; Esri' }).addTo(map);
      var tileOk = 0, tileErr = 0;
      tiles.on('tileload', function () { tileOk++; });
      tiles.on('tileerror', function () {
        tileErr++;
        if (tileErr >= 4 && !tileOk && !mapEl.querySelector('iframe')) {   /* last resort: Google Maps embed */
          mapEl.innerHTML = '<iframe title="BDYCULTURE on Google Maps" src="https://www.google.com/maps?q=671+Gympie+Road+Chermside+QLD+4032&amp;output=embed" style="width:100%;height:100%;border:0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
        }
      });
      /* satellite layer + Street / Satellite switch */
      var sat = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', { maxZoom: 19, attribution: 'Imagery &copy; Esri' });
      var Switch = L.Control.extend({
        options: { position: 'topright' },
        onAdd: function () {
          var box = L.DomUtil.create('div', 'map-switch');
          box.innerHTML = '<button type="button" class="is-on" data-layer="street">Street</button><button type="button" data-layer="sat">Satellite</button>';
          L.DomEvent.disableClickPropagation(box);
          box.addEventListener('click', function (e) {
            var b = e.target.closest('button'); if (!b) return;
            var isSat = b.getAttribute('data-layer') === 'sat';
            if (isSat) { map.removeLayer(tiles); sat.addTo(map); } else { map.removeLayer(sat); tiles.addTo(map); }
            mapEl.classList.toggle('is-sat', isSat);
            $$('button', box).forEach(function (x) { x.classList.toggle('is-on', x === b); });
          });
          return box;
        }
      });
      new Switch().addTo(map);

      /* clinic pin */
      L.marker(CLINIC, { zIndexOffset: 1000, icon: L.divIcon({ className: '', html: '<div class="map-dot"></div>', iconSize: [34, 34], iconAnchor: [17, 17] }), title: 'BDYCULTURE – 671 Gympie Road, Chermside' }).addTo(map);

      /* nearby suburb labels (clickable, linked to the chips below) */
      $$('[data-fly]').forEach(function (chip) {
        var p = chip.getAttribute('data-fly').split(',').map(Number);
        if (chip.textContent.trim() === 'Chermside') return;
        L.marker([p[0], p[1]], { icon: L.divIcon({ className: '', html: '<span class="sub-pin"><i></i>' + chip.textContent.trim() + '</span>', iconSize: [0, 0] }), keyboard: false })
          .on('click', function () { chip.click(); }).addTo(map);
      });
      map.on('focus', function () { map.scrollWheelZoom.enable(); });
      map.on('blur', function () { map.scrollWheelZoom.disable(); });
    };
    s.onerror = function () { mapEl.insertAdjacentHTML('beforeend', '<p style="padding:24px">Map unavailable offline — use “Get directions”.</p>'); };
    d.head.appendChild(s);
  }
  if (mapEl) {
    var mb = $('[data-load-map]', mapEl); if (mb) mb.addEventListener('click', initMap);
    if ('IntersectionObserver' in window) {
      var mo = new IntersectionObserver(function (en) { if (en[0].isIntersecting) { initMap(); mo.disconnect(); } }, { rootMargin: '300px' });
      mo.observe(mapEl);
    } else initMap();
  }
  $$('[data-fly]').forEach(function (chip) {
    chip.addEventListener('click', function () {
      var p = chip.getAttribute('data-fly').split(',').map(Number);
      $$('[data-fly]').forEach(function (c) { c.classList.toggle('is-on', c === chip); });
      initMap();
      (function wait() { if (map) map.flyTo([p[0], p[1]], p[2], { duration: reduce ? 0 : 1.2 }); else setTimeout(wait, 150); })();
    });
  });
})();
