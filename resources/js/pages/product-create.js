import '../../css/pages/product-form.css'; 

window.previewSingle = function(input){
  const file = input.files && input.files[0];
  if(!file) return;
  const img = document.getElementById('previewImg');
  const txt = document.getElementById('dropText');
  const url = URL.createObjectURL(file);
  img.src = url;
  img.classList.remove('d-none');
  if (txt) txt.classList.add('d-none');
  img.onload = () => URL.revokeObjectURL(url);
};
