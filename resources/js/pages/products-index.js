import '../../css/pages/products-index.css';

document.addEventListener('DOMContentLoaded', () => {
  const master = document.getElementById('checkAll');
  if (master) {
    master.addEventListener('change', function () {
      document.querySelectorAll('input[name="ids[]"]').forEach(cb => {
        cb.checked = this.checked;
      });
    });
  }

  const sortSelect = document.getElementById('sortSelect');
  if (sortSelect) {
    sortSelect.addEventListener('change', () => {
      const form = document.getElementById('sortForm');
      if (form) form.submit();
    });
  }

  const exportForm = document.getElementById('exportForm');
  if (exportForm) {
    exportForm.addEventListener('submit', (e) => {
      const checked = document.querySelectorAll('input[name="ids[]"]:checked');
      if (checked.length === 0) {
        e.preventDefault();
        alert('⚠️ Vui lòng chọn ít nhất một sản phẩm để xuất!');
      }
    });
  }
});
