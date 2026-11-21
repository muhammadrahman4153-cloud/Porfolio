document.addEventListener('DOMContentLoaded', function () {
  // Bayangan navbar saat halaman di-scroll
  var nav = document.querySelector('.site-nav');
  if (nav) {
    var onScroll = function () { nav.classList.toggle('scrolled', window.scrollY > 10); };
    window.addEventListener('scroll', onScroll); onScroll();
  }

  // Animasi muncul + progress bar saat elemen terlihat
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (!e.isIntersecting) return;
      e.target.classList.add('show');
      e.target.querySelectorAll('.progress-bar[data-width]').forEach(function (bar) {
        bar.style.width = bar.dataset.width + '%';
      });
      io.unobserve(e.target);
    });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });

  // Notifikasi sukses hilang otomatis
  document.querySelectorAll('.alert.auto-hide').forEach(function (a) {
    setTimeout(function () { bootstrap.Alert.getOrCreateInstance(a).close(); }, 4000);
  });
});
