document.addEventListener("DOMContentLoaded", () => {
  const checkAll = document.getElementById("checkAll");
  if (checkAll) {
    checkAll.addEventListener("change", function () {
      document.querySelectorAll('input[name="ids[]"]').forEach(cb => {
        cb.checked = this.checked;
      });
    });
  }
});
