/**
 * Mediora Clinic Theme Main JavaScript
 *
 * Handles:
 * - Sticky header on scroll
 * - Mobile drawer (offcanvas navigation)
 * - Video lazy-loading with IntersectionObserver
 * - Swiper sliders for Hero & Customer Results
 * - Smooth anchor scrolling with header offset
 * - Image fallback placeholders
 * - AJAX booking form submission
 *
 * @package Mediora_Clinic
 * @version 1.0.0
 */

(function () {
  'use strict';

  // Config object from WordPress wp_localize_script (supports both medioraData and MEDIORA)
  const medioraConfig = window.medioraData || window.MEDIORA || {
    ajaxUrl: '/wp-admin/admin-ajax.php',
    nonce: '',
    thanks: 'Cảm ơn bạn! Bác sĩ chuyên khoa MEDIORA sẽ liên hệ tư vấn trong thời gian sớm nhất.',
    error: 'Gửi chưa thành công, vui lòng kiểm tra lại thông tin hoặc gọi hotline.'
  };

  document.addEventListener('DOMContentLoaded', () => {
    initHeaderScroll();
    initMobileDrawer();
    initFacilityVideo();
    initSliders();
    initSmoothScroll();
    initImagePlaceholders();
    initBookingForms();
  });

  /**
   * 1. Sticky Header scroll listener
   */
  function initHeaderScroll() {
    const header = document.querySelector('.site-header');
    if (!header) return;

    let ticking = false;
    const onScroll = () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          if (window.scrollY > 40) {
            header.classList.add('is-scrolled');
          } else {
            header.classList.remove('is-scrolled');
          }
          ticking = false;
        });
        ticking = true;
      }
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /**
   * 2. Mobile Drawer Navigation
   */
  function initMobileDrawer() {
    const burgerBtn = document.querySelector('.btn-burger');
    const drawer = document.querySelector('.mobile-drawer');
    const overlay = document.querySelector('.mobile-drawer__overlay');
    const closeBtn = document.querySelector('.mobile-drawer__close');

    if (!drawer) return;

    const openDrawer = () => {
      drawer.classList.add('is-open');
      if (overlay) overlay.classList.add('is-open');
      document.body.style.overflow = 'hidden';
    };

    const closeDrawer = () => {
      drawer.classList.remove('is-open');
      if (overlay) overlay.classList.remove('is-open');
      document.body.style.overflow = '';
    };

    if (burgerBtn) burgerBtn.addEventListener('click', openDrawer);
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (overlay) overlay.addEventListener('click', closeDrawer);

    // Close when clicking any nav link in mobile drawer
    drawer.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', closeDrawer);
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && drawer.classList.contains('is-open')) {
        closeDrawer();
      }
    });
  }

  /**
   * 3. Facility Video Lazy-load & Intersection Observer
   */
  function initFacilityVideo() {
    const videos = document.querySelectorAll('.js-facility-video');
    if (!videos.length) return;

    const mq = window.matchMedia('(max-width: 767.98px)');

    videos.forEach((video) => {
      let currentSrc = '';
      let isInView = false;

      const playVideo = () => {
        const promise = video.play();
        if (promise !== undefined) {
          promise.catch(() => {
            // Autoplay may be restricted by browser until interacted
          });
        }
      };

      const updateSource = () => {
        const src = (mq.matches ? video.dataset.srcMb : video.dataset.srcPc) ||
          video.dataset.srcPc ||
          video.dataset.srcMb ||
          video.getAttribute('src');

        if (!src || src === currentSrc) return;
        currentSrc = src;
        video.src = src;
        video.load();
        if (isInView) playVideo();
      };

      if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
          entries.forEach((entry) => {
            isInView = entry.isIntersecting;
            if (isInView) {
              updateSource();
              playVideo();
            } else {
              video.pause();
            }
          });
        }, { rootMargin: '200px 0px', threshold: 0.1 });

        observer.observe(video);
      } else {
        // Fallback for older browsers
        isInView = true;
        updateSource();
      }

      // Responsive source switch on viewport change
      const onResize = () => {
        if (currentSrc) updateSource();
      };
      if (mq.addEventListener) {
        mq.addEventListener('change', onResize);
      } else if (mq.addListener) {
        mq.addListener(onResize);
      }
    });
  }

  /**
   * 4. Swiper Sliders
   */
  function initSliders() {
    if (typeof Swiper === 'undefined') return;

    // Hero Slider
    const heroEl = document.querySelector('.hero-slider');
    if (heroEl) {
      new Swiper(heroEl, {
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        speed: 800,
        pagination: {
          el: '.hero-pagination',
          clickable: true,
        },
      });
    }

    // Customer Result Slider
    const resultEl = document.querySelector('.result-slider');
    if (resultEl) {
      new Swiper(resultEl, {
        loop: true,
        speed: 700,
        navigation: {
          nextEl: '.result-next, .arrow-next',
          prevEl: '.result-prev, .arrow-prev',
        },
        pagination: {
          el: '.result-pagination',
          clickable: true,
        },
        slidesPerView: 1,
        spaceBetween: 20,
      });
    }
  }

  /**
   * 5. Smooth Anchor Scroll
   */
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener('click', function (e) {
        const targetId = this.getAttribute('href');
        if (!targetId || targetId === '#' || targetId === '#0') return;

        const targetEl = document.querySelector(targetId);
        if (targetEl) {
          e.preventDefault();
          const header = document.querySelector('.site-header');
          const headerHeight = header ? header.offsetHeight : 70;
          const targetPosition = targetEl.getBoundingClientRect().top + window.pageYOffset - headerHeight;

          window.scrollTo({
            top: targetPosition,
            behavior: 'smooth',
          });
        }
      });
    });
  }

  /**
   * 6. Image Placeholders & Missing Handler
   */
  function initImagePlaceholders() {
    document.querySelectorAll('.ph > img').forEach((img) => {
      const markLoaded = () => {
        if (img.parentElement) {
          img.parentElement.classList.add('is-loaded');
        }
      };
      const markMissing = () => {
        img.classList.add('is-missing');
      };

      if (img.complete) {
        img.naturalWidth > 0 ? markLoaded() : markMissing();
      }
      img.addEventListener('load', markLoaded);
      img.addEventListener('error', markMissing);
    });
  }

  /**
   * 7. Booking Form AJAX Handler
   */
  function initBookingForms() {
    const forms = document.querySelectorAll(
      '.mediora-booking-form, .js-mediora-booking-form, .consult-form:not(.wpcf7-form):not(.wpforms-form), .js-booking-form'
    );
    if (!forms.length) return;

    const setMsg = (form, text, isError) => {
      let msgBox = form.querySelector('.form-msg');
      if (!msgBox) {
        msgBox = document.createElement('div');
        msgBox.className = 'form-msg';
        form.appendChild(msgBox);
      }
      msgBox.textContent = text;
      msgBox.classList.toggle('is-error', !!isError);
      msgBox.classList.toggle('is-success', !isError && !!text);
    };

    forms.forEach((form) => {
      // Clear error status when typing
      form.addEventListener('input', () => {
        const errorMsg = form.querySelector('.form-msg.is-error');
        if (errorMsg) setMsg(form, '');
      });

      form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (form.classList.contains('is-loading')) return;

        // Clean & validate phone input
        const phoneInput = form.querySelector('[name=phone], [name=your-phone]');
        if (phoneInput) {
          const rawPhone = phoneInput.value.trim().replace(/[\s.\-()]/g, '');
          phoneInput.value = rawPhone;
          // Vietnamese phone number validation: starts with 0 or +84, 10-11 digits
          if (!/^(0|\+84)(3|5|7|8|9)[0-9]{8}$/.test(rawPhone) && !/^(0|\+84)[0-9]{9,10}$/.test(rawPhone)) {
            setMsg(form, 'Vui lòng nhập số điện thoại hợp lệ gồm 10 chữ số (VD: 0945 334 832).', true);
            phoneInput.focus();
            return;
          }
        }

        // Validate full name
        const nameInput = form.querySelector('[name=fullname], [name=your-name], [name=name]');
        if (nameInput && !nameInput.value.trim()) {
          setMsg(form, 'Vui lòng nhập họ và tên của bạn.', true);
          nameInput.focus();
          return;
        }

        const submitBtn = form.querySelector('[type=submit], .btn-receive, .btn-consult');
        const textSpan = submitBtn ? submitBtn.querySelector('.btn-receive__text, span:not(.spinner-border)') : null;
        const originalBtnText = textSpan ? textSpan.textContent : '';

        const formData = new FormData(form);

        // Ensure action & nonce
        if (!formData.get('action')) {
          formData.append('action', 'mediora_submit_booking');
        }
        if (!formData.get('nonce') && !formData.get('mediora_booking_security')) {
          formData.append('nonce', medioraConfig.nonce);
        }
        formData.append('page_url', window.location.href);

        form.classList.add('is-loading');
        if (submitBtn) {
          submitBtn.disabled = true;
          if (textSpan) {
            textSpan.textContent = 'Đang gửi thông tin...';
          }
        }
        setMsg(form, '');

        fetch(medioraConfig.ajaxUrl, {
          method: 'POST',
          body: formData,
          credentials: 'same-origin',
        })
          .then((response) => response.json().catch(() => ({})))
          .then((result) => {
            if (result && result.success) {
              form.reset();
              const thanksMsg = result.data?.message || medioraConfig.thanks;
              setMsg(form, thanksMsg, false);

              // Dispatch custom event for tracking (Google Ads, Facebook Pixel, GA4)
              try {
                const event = new CustomEvent('mediora:booking:success', {
                  detail: { leadId: result.data?.lead_id }
                });
                document.dispatchEvent(event);
              } catch (e) {
                // Fallback for older browsers
              }
            } else {
              throw new Error(result?.data?.message || medioraConfig.error);
            }
          })
          .catch((err) => {
            setMsg(form, err.message || medioraConfig.error, true);
          })
          .finally(() => {
            form.classList.remove('is-loading');
            if (submitBtn) {
              submitBtn.disabled = false;
              if (textSpan && originalBtnText) {
                textSpan.textContent = originalBtnText;
              }
            }
          });
      });
    });
  }
})();
