/* BDYCULTURE — front-end interactions
 * Ported 1:1 from the original HTML design (drawer, reveal, tabs, FAQ,
 * ribbon loop, lazy Leaflet map). No jQuery, no build step.
 */
(function () {
  'use strict';

  var d = document;
  var root = d.documentElement;
  var config = window.bdyTheme || {};
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var $ = function (s, c) { return (c || d).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || d).querySelectorAll(s)); };

  root.classList.remove('no-js');

  /* Open every third-party web link in a separate tab, site-wide. */
  $$('a[href]').forEach(function (link) {
    var destination;
    try {
      destination = new window.URL(link.getAttribute('href'), window.location.href);
    } catch (error) {
      return;
    }
    if ((destination.protocol === 'http:' || destination.protocol === 'https:') && destination.host !== window.location.host) {
      link.target = '_blank';
      var rel = (link.getAttribute('rel') || '').split(/\s+/).filter(Boolean);
      ['noopener', 'noreferrer'].forEach(function (token) {
        if (rel.indexOf(token) === -1) rel.push(token);
      });
      link.setAttribute('rel', rel.join(' '));
    }
  });

  /* ---------- drawer ---------- */
  var toggle = $('.nav-toggle');
  var drawer = $('#drawer');

  function setDrawer(open) {
    if (!toggle || !drawer) return;
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    toggle.setAttribute('aria-label', (config.labels && (open ? config.labels.closeMenu : config.labels.openMenu)) || (open ? 'Close menu' : 'Open menu'));
    drawer.classList.toggle('is-open', open);
    drawer.setAttribute('aria-hidden', open ? 'false' : 'true');
    d.body.classList.toggle('no-scroll', open);
  }

  if (toggle && drawer) {
    toggle.addEventListener('click', function () {
      setDrawer(toggle.getAttribute('aria-expanded') !== 'true');
    });
    $$('a', drawer).forEach(function (a) {
      a.addEventListener('click', function () { setDrawer(false); });
    });
    $$('.drawer__sub-toggle', drawer).forEach(function (button) {
      button.addEventListener('click', function () {
        var expanded = button.getAttribute('aria-expanded') === 'true';
        var submenu = d.getElementById(button.getAttribute('aria-controls'));
        button.setAttribute('aria-expanded', expanded ? 'false' : 'true');
        button.setAttribute('aria-label', expanded ? button.getAttribute('data-show-label') : button.getAttribute('data-hide-label'));
        if (submenu) submenu.hidden = expanded;
      });
    });
    d.addEventListener('keydown', function (e) { if (e.key === 'Escape') setDrawer(false); });
    window.matchMedia('(min-width: 1100px)').addEventListener('change', function (m) { if (m.matches) setDrawer(false); });
  }

  /* ---------- "Enquire" links focus the nearest form ---------- */
  $$('[data-focus-form]').forEach(function (a) {
    a.addEventListener('click', function () {
      var href = a.getAttribute('href') || '';
      var id = href.indexOf('#') > -1 ? href.slice(href.indexOf('#') + 1) : '';
      var box = id ? d.getElementById(id) : null;
      var field = box && $('input, select, textarea', box);
      if (field) setTimeout(function () { field.focus({ preventScroll: true }); }, 500);
    });
  });

  /* ---------- reveal on scroll ---------- */
  var revealEls = $$('.reveal, .reveal-clip');

  if (!reduce && revealEls.length) {
    revealEls.forEach(function (el, i) { el.style.transitionDelay = (i % 4) * 60 + 'ms'; });
    var pending = revealEls.slice();
    var ticking = false;
    var checkReveal = function () {
      ticking = false;
      pending = pending.filter(function (el) {
        if (el.getBoundingClientRect().top < window.innerHeight * 0.92) {
          el.classList.add('is-in');
          return false;
        }
        return true;
      });
    };
    var onScroll = function () { if (!ticking) { ticking = true; requestAnimationFrame(checkReveal); } };
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    window.addEventListener('load', checkReveal);
    checkReveal();
  } else {
    revealEls.forEach(function (el) { el.classList.add('is-in'); });
  }

  /* ---------- service tabs ---------- */
  $$('[data-tabs]').forEach(function (wrap) {
    var tabs = $$('[role="tab"]', wrap);
    var panels = $$('[role="tabpanel"]', wrap);

    function select(i, focus) {
      tabs.forEach(function (t, j) {
        var on = i === j;
        t.setAttribute('aria-selected', on ? 'true' : 'false');
        t.tabIndex = on ? 0 : -1;
        if (panels[j]) panels[j].hidden = !on;
      });
      if (focus) tabs[i].focus();
    }

    tabs.forEach(function (t, i) {
      t.addEventListener('click', function () { select(i); });
      t.addEventListener('keydown', function (e) {
        var n = tabs.length;
        var k = e.key;
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
        if (it.open) {
          items.forEach(function (o) { if (o !== it) o.open = false; });
        }
      });
    });
  });

  /* ---------- designed fallback forms (success state only) ----------
   * Real submissions are handled by Contact Form 7 once a shortcode is
   * entered in the ACF field; these forms are the visual placeholder.
   */
  $$('[data-form]').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (!form.checkValidity()) { form.reportValidity(); return; }
      var ok = $('.form-ok', form);
      if (ok) {
        ok.hidden = false;
        ok.setAttribute('tabindex', '-1');
        ok.focus();
      }
    });
  });

  /* ---------- interactive map (Leaflet, lazy-loaded) ---------- */
  var mapEl = $('#clinic-map');
  var map = null;
  var mapReady = false;
  var mapConfig = config.map || {};
  var activePlace = null;

  function loadCSS(href) {
    var l = d.createElement('link');
    l.rel = 'stylesheet';
    l.href = href;
    d.head.appendChild(l);
  }

  function initMap() {
    if (mapReady || !mapEl || !mapConfig.center) return;
    mapReady = true;

    var btn = $('[data-load-map]', mapEl);
    if (btn) btn.remove();

    loadCSS(mapConfig.leafletCss);

    var s = d.createElement('script');
    s.src = mapConfig.leafletJs;
    s.onload = function () {
      map = L.map(mapEl, { scrollWheelZoom: false, zoomControl: false }).setView(mapConfig.center, mapConfig.zoom);
      L.control.zoom({ position: 'bottomright' }).addTo(map);

      var tiles = L.tileLayer(mapConfig.street, { maxZoom: 19, attribution: 'Tiles &copy; Esri' }).addTo(map);
      var tileOk = 0;
      var tileErr = 0;

      tiles.on('tileload', function () { tileOk++; });
      tiles.on('tileerror', function () {
        tileErr++;
        if (tileErr >= 4 && !tileOk && !mapEl.querySelector('iframe')) {
          mapEl.innerHTML = '<iframe title="BDYCULTURE on Google Maps" src="' + mapConfig.embedUrl + '" style="width:100%;height:100%;border:0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
        }
      });

      var satellite = L.tileLayer(mapConfig.satellite, { maxZoom: 19, attribution: 'Imagery &copy; Esri' });

      var Switch = L.Control.extend({
        options: { position: 'topright' },
        onAdd: function () {
          var box = L.DomUtil.create('div', 'map-switch');
          box.innerHTML = '<button type="button" class="is-on" data-layer="street">' + ((config.labels && config.labels.street) || 'Street') + '</button>'
            + '<button type="button" data-layer="sat">' + ((config.labels && config.labels.satellite) || 'Satellite') + '</button>';
          L.DomEvent.disableClickPropagation(box);
          box.addEventListener('click', function (e) {
            var b = e.target.closest('button');
            if (!b) return;
            var isSat = b.getAttribute('data-layer') === 'sat';
            if (isSat) { map.removeLayer(tiles); satellite.addTo(map); }
            else { map.removeLayer(satellite); tiles.addTo(map); }
            mapEl.classList.toggle('is-sat', isSat);
            $$('button', box).forEach(function (x) { x.classList.toggle('is-on', x === b); });
          });
          return box;
        }
      });
      new Switch().addTo(map);

      L.marker(mapConfig.center, {
        zIndexOffset: 1000,
        icon: L.divIcon({ className: '', html: '<div class="map-dot"></div>', iconSize: [34, 34], iconAnchor: [17, 17] }),
        title: mapConfig.title || 'BDYCULTURE'
      }).addTo(map);

      // A place chosen before the map existed (chip pressed while the lazy
      // loader was still sleeping) is applied once Leaflet is up.
      if (activePlace) {
        moveToPlace(activePlace, false);
      }

      $$('[data-fly]').forEach(function (chip) {
        var p = chip.getAttribute('data-fly').split(',').map(Number);
        if (!p.length || isNaN(p[0]) || isNaN(p[1])) return;
        if (chip.textContent.trim() === (mapConfig.title || '')) return;
        L.marker([p[0], p[1]], {
          icon: L.divIcon({ className: '', html: '<span class="sub-pin"><i></i>' + chip.textContent.trim() + '</span>', iconSize: [0, 0] }),
          keyboard: false
        }).on('click', function () { chip.click(); }).addTo(map);
      });

      map.on('focus', function () { map.scrollWheelZoom.enable(); });
      map.on('blur', function () { map.scrollWheelZoom.disable(); });
    };

    s.onerror = function () {
      mapEl.insertAdjacentHTML('beforeend', '<p style="padding:24px">' + (mapConfig.unavailable || 'Map unavailable offline.') + '</p>');
    };

    d.head.appendChild(s);
  }

  /** Fly the map to one chip's place and mark it as the active chip. */
  function moveToPlace(chip, animate) {
    if (!chip) return;

    var p = chip.getAttribute('data-fly').split(',').map(Number);
    if (isNaN(p[0]) || isNaN(p[1])) return;

    var zoom = isNaN(p[2]) ? (mapConfig.zoom || 15) : p[2];
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var smooth = animate !== false && !reduce;

    activePlace = chip;

    $$('[data-fly]').forEach(function (c) { c.classList.toggle('is-on', c === chip); });

    // The suburb pins live on the map itself (not on a tile layer), so they
    // stay put when Street and Satellite swap — no re-drawing needed.
    if (!map) return;

    if (smooth) map.flyTo([p[0], p[1]], zoom, { duration: 1.1 });
    else map.setView([p[0], p[1]], zoom);
  }

  if (mapEl) {
    var loadBtn = $('[data-load-map]', mapEl);
    if (loadBtn) loadBtn.addEventListener('click', initMap);

    if ('IntersectionObserver' in window) {
      var mo = new IntersectionObserver(function (en) {
        if (en[0].isIntersecting) { initMap(); mo.disconnect(); }
      }, { rootMargin: '300px' });
      mo.observe(mapEl);
    } else {
      initMap();
    }
  }

  /* Place chips: work even before "Load interactive map" was pressed, and the
     chosen place survives a Street → Satellite switch (the suburb pins are
     map layers, not tile layers, so swapping the tiles leaves them in place). */
  $$('[data-fly]').forEach(function (chip) {
    chip.addEventListener('click', function () {
      moveToPlace(chip, true);
      initMap();
      (function wait() {
        if (map) moveToPlace(chip, true);
        else setTimeout(wait, 150);
      })();
    });
  });
})();
