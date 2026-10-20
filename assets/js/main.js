/**
 * main.js - all the interactive behaviour of the site, in plain JavaScript (no libraries).
 *   1. Header turns solid after scrolling
 *   2. Mobile menu
 *   3. FAQ accordion
 *   4. Photo fallback if an image file is missing
 *   5. Smooth scroll to #section when a page opens with one
 *   6. Quote form: validation, sending, success/error messages
 */
(function () {
  'use strict';

  /* 1. Header ------------------------------------------------------------------------------- */
  var header = document.querySelector('.header');
  function updateHeader() {
    if (header) header.classList.toggle('scrolled', window.scrollY > 40);
  }
  updateHeader();
  window.addEventListener('scroll', updateHeader, { passive: true });

  /* 2. Mobile menu -------------------------------------------------------------------------- */
  var menuButton = document.querySelector('.menu-toggle');
  var nav = document.getElementById('main-navigation');
  if (menuButton && nav) {
    var iconOpen = menuButton.querySelector('[data-menu-icon="open"]');
    var iconClose = menuButton.querySelector('[data-menu-icon="close"]');
    var setMenu = function (open) {
      nav.classList.toggle('open', open);
      menuButton.setAttribute('aria-expanded', String(open));
      menuButton.setAttribute('aria-label', menuButton.getAttribute(open ? 'data-label-close' : 'data-label-open'));
      // SVG elements have no .hidden property, so the attribute is toggled directly.
      if (iconOpen) iconOpen.toggleAttribute('hidden', open);
      if (iconClose) iconClose.toggleAttribute('hidden', !open);
    };
    menuButton.addEventListener('click', function () { setMenu(!nav.classList.contains('open')); });
    nav.addEventListener('click', function (event) { if (event.target.closest('a')) setMenu(false); });
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && nav.classList.contains('open')) {
        setMenu(false);
        menuButton.focus();
      }
    });
  }

  /* 3. FAQ accordion (one answer open at a time) --------------------------------------------- */
  document.querySelectorAll('.faq-list').forEach(function (list) {
    var items = list.querySelectorAll('.faq-item');
    list.addEventListener('click', function (event) {
      var question = event.target.closest('.faq-question');
      if (!question) return;
      var current = question.closest('.faq-item');
      var willOpen = !current.classList.contains('is-open');
      items.forEach(function (item) {
        var open = item === current && willOpen;
        item.classList.toggle('is-open', open);
        item.querySelector('.faq-question').setAttribute('aria-expanded', String(open));
        item.querySelector('.faq-answer').setAttribute('aria-hidden', String(!open));
      });
    });
  });

  /* 4. Missing-photo fallback ---------------------------------------------------------------- */
  var shell = document.querySelector('.site-shell');
  var fallbackText = (shell && shell.getAttribute('data-fallback-text')) || '';
  function showFallback(img) {
    var box = document.createElement('div');
    box.className = 'image-fallback';
    box.setAttribute('role', 'img');
    box.setAttribute('aria-label', img.getAttribute('alt') || fallbackText);
    box.textContent = fallbackText;
    img.replaceWith(box);
  }
  document.querySelectorAll('img[data-image-fallback]').forEach(function (img) {
    if (img.complete && img.naturalWidth === 0 && img.getAttribute('src')) showFallback(img);
    else img.addEventListener('error', function () { showFallback(img); }, { once: true });
  });

  /* 5. Scroll to #section on page load -------------------------------------------------------- */
  if (window.location.hash.length > 1) {
    window.requestAnimationFrame(function () {
      var target = document.getElementById(decodeURIComponent(window.location.hash.slice(1)));
      if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  }

  /* 6. Quote form ---------------------------------------------------------------------------- */
  var EMAIL_PATTERN = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  document.querySelectorAll('[data-quote-form]').forEach(function (form) {
    var statusBox = form.querySelector('[data-form-status]');
    var statusText = statusBox.querySelector('[data-status-text]');
    var submitButton = form.querySelector('button[type="submit"]');
    var submitLabel = submitButton.firstChild; // the text node before the icon
    var fallbackError = form.getAttribute('data-fallback-error');
    var submitting = false;
    var hideTimer = null;

    // Messages shown under each field. Taken from content/form.php through data attributes.
    var messages = {
      fullName: form.getAttribute('data-error-fullname'),
      email: form.getAttribute('data-error-email'),
      phone: form.getAttribute('data-error-phone'),
      service: form.getAttribute('data-error-service'),
      message: form.getAttribute('data-error-message')
    };

    function setStatus(type, message) {
      window.clearTimeout(hideTimer);
      if (!type) { statusBox.hidden = true; return; }
      statusBox.className = 'form-status ' + type;
      statusBox.setAttribute('role', type === 'error' ? 'alert' : 'status');
      statusBox.querySelector('[data-status-icon="success"]').toggleAttribute('hidden', type !== 'success');
      statusBox.querySelector('[data-status-icon="error"]').toggleAttribute('hidden', type !== 'error');
      statusText.textContent = message;
      statusBox.hidden = false;
    }

    function setFieldErrors(errors) {
      form.querySelectorAll('.field').forEach(function (field) {
        var control = field.querySelector('input, select, textarea');
        var old = field.querySelector('.field-error');
        if (old) old.remove();
        var message = errors[control.name];
        control.setAttribute('aria-invalid', message ? 'true' : 'false');
        if (message) {
          var span = document.createElement('span');
          span.className = 'field-error';
          span.id = control.id + '-error';
          span.textContent = message;
          field.appendChild(span);
          control.setAttribute('aria-describedby', span.id);
        } else {
          control.removeAttribute('aria-describedby');
        }
      });
    }

    function setSubmitting(value) {
      submitting = value;
      submitButton.disabled = value;
      form.setAttribute('aria-busy', String(value));
      submitLabel.nodeValue = form.getAttribute(value ? 'data-submitting-label' : 'data-submit-label');
    }

    function validate(values, serviceNames) {
      var errors = {};
      if (!values.fullName || values.fullName.length > 160) errors.fullName = messages.fullName;
      if (!EMAIL_PATTERN.test(values.email) || values.email.length > 254) errors.email = messages.email;
      var digits = values.phone.replace(/\D/g, '');
      if (values.phone.length > 30 || digits.length < 7 || digits.length > 15) errors.phone = messages.phone;
      if (serviceNames.indexOf(values.service) === -1) errors.service = messages.service;
      if (!values.message || values.message.length > 5000) errors.message = messages.message;
      return errors;
    }

    form.addEventListener('submit', function (event) {
      event.preventDefault();
      if (submitting) return;

      var data = new FormData(form);
      var values = {};
      ['fullName', 'phone', 'email', 'service', 'message', 'website'].forEach(function (name) {
        values[name] = String(data.get(name) || '').trim();
      });
      var serviceNames = Array.prototype.map.call(form.querySelectorAll('select[name="service"] option'), function (o) { return o.value; })
        .filter(Boolean);

      var errors = validate(values, serviceNames);
      setFieldErrors(errors);
      setStatus(null);
      if (Object.keys(errors).length) {
        var firstBad = form.querySelector('[aria-invalid="true"]');
        if (firstBad) firstBad.focus();
        return;
      }

      // Bots fill the hidden field: pretend success and send nothing.
      if (values.website) {
        setStatus('success', form.getAttribute('data-success'));
        form.reset();
        return;
      }

      setSubmitting(true);
      fetch(form.getAttribute('action'), {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(values)
      })
        .then(function (response) {
          return response.json().catch(function () { return {}; }).then(function (result) {
            return { ok: response.ok, result: result };
          });
        })
        .then(function (reply) {
          // Success is shown ONLY when the server confirms it accepted the request.
          if (!(reply.ok && reply.result.accepted === true)) {
            if (reply.result.errors && typeof reply.result.errors === 'object') setFieldErrors(reply.result.errors);
            throw new Error(reply.result.message || fallbackError);
          }
          setStatus('success', form.getAttribute('data-success'));
          form.reset();
          setFieldErrors({});
          hideTimer = window.setTimeout(function () { setStatus(null); }, 5000);
        })
        .catch(function (error) {
          // Network failures land here too; the entered values stay in the form.
          setStatus('error', error instanceof Error && error.message && error.message !== 'Failed to fetch' ? error.message : fallbackError);
        })
        .then(function () { setSubmitting(false); });
    });
  });
})();
