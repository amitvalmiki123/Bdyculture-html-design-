/* BDYCULTURE — Customizer live preview (Rule 19)
 * Writes each changed setting straight to the matching CSS custom property
 * on :root, so the preview updates without a refresh.
 */
(function (api) {
  'use strict';

  if (!api) return;

  var config = window.bdyCustomizer || {};
  var settings = config.settings || {};
  var root = document.documentElement;

  Object.keys(settings).forEach(function (id) {
    var meta = settings[id];
    if (!meta || !meta.var) return;

    api(id, function (value) {
      value.bind(function (next) {
        if (next === '' || next === null || String(next) === String(meta.default)) {
          root.style.removeProperty(meta.var);
          return;
        }
        root.style.setProperty(meta.var, String(next) + (meta.unit || ''));
      });
    });
  });
})(window.wp && window.wp.customize);
