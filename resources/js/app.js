require('./bootstrap');
<script>
  (function () {
    // elemen2 utama
    const container = document.querySelector('.layout-container');
    const menu = document.getElementById('layout-menu');
    const overlay = document.querySelector('.layout-overlay');
    const toggles = document.querySelectorAll('.layout-menu-toggle');

    // ---- opsi: default state & simpan preferensi ----
    // ubah ke true kalau ingin default TERBUKA
    const DEFAULT_OPEN = false;

    // baca preferensi dari localStorage (kalau ada), kalau tidak pakai DEFAULT_OPEN
    const savedPref = localStorage.getItem('menu-open');
    const initialOpen = savedPref === null ? DEFAULT_OPEN : (savedPref === 'true');
    setOpen(initialOpen);

    // klik tombol toggle (bisa ada lebih dari satu)
    toggles.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        setOpen(!container.classList.contains('menu-open'));
      });
    });

    // klik overlay menutup menu
    overlay?.addEventListener('click', () => setOpen(false));

    // tekan ESC menutup menu
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') setOpen(false);
    });

    // klik di luar sidebar menutup (opsional)
    document.addEventListener('click', (e) => {
      if (!container.classList.contains('menu-open')) return;
      const clickedInsideMenu = menu.contains(e.target);
      const clickedToggle = !!e.target.closest('.layout-menu-toggle');
      if (!clickedInsideMenu && !clickedToggle) setOpen(false);
    });

    // helper: set state buka/tutup
    function setOpen(open) {
      container.classList.toggle('menu-open', open);
      container.classList.toggle('menu-closed', !open);
      localStorage.setItem('menu-open', String(open));
      // aksesibilitas untuk tombol toggle
      toggles.forEach(btn => btn.setAttribute('aria-expanded', String(open)));
    }

    // ---- opsional: default terbuka di desktop, tertutup di mobile ----
    // uncomment kalau mau perilaku responsif
    /*
    const mq = window.matchMedia('(min-width: 1200px)'); // sesuaikan breakpoint
    function applyResponsiveDefault(e) {
      // hanya atur kalau user belum pernah memilih (tidak ada savedPref)
      if (savedPref !== null) return;
      setOpen(e.matches); // true saat desktop, false saat mobile
    }
    applyResponsiveDefault(mq);
    mq.addEventListener('change', applyResponsiveDefault);
    */
  })();
</script>
