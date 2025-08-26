function renderStars(avg){ if(avg==null||avg==='') return ''; const n=Math.round(parseFloat(avg)*2)/2; let out=''; for(let i=1;i<=5;i++){ out += (i<=n)?'★':'✩'; } return out; }
document.addEventListener('click', e=>{ const btn=e.target.closest('[data-product]'); if(!btn) return;
  const d=JSON.parse(btn.dataset.product); const img=d.image_url?`<img src="${d.image_url}" alt="${d.name}" class="img-fluid rounded mb-3" style="max-height:320px;object-fit:cover;">`:'';
  const stars=renderStars(d.rating_avg);
  document.getElementById('modalTitle').textContent=d.name;
  document.getElementById('modalBody').innerHTML=`${img}<p class="mb-1"><strong>Preço:</strong> R$ ${Number(d.price).toFixed(2).replace('.', ',')}</p><p class="mb-1"><strong>Avaliações:</strong> ${stars} ${d.rating_avg?('('+Number(d.rating_avg).toFixed(1).replace('.', ',')+')'):''} ${d.rating_count?(' · '+d.rating_count+' avaliações'):''}</p><p class="mt-2">${d.description||''}</p>`;
  new bootstrap.Modal(document.getElementById('productModal')).show();
});
document.getElementById('searchInput')?.addEventListener('input', function(){ const q=this.value.toLowerCase(); document.querySelectorAll('[data-card-name]').forEach(c=>{ const n=c.dataset.cardName.toLowerCase(); c.style.display=n.includes(q)?'':'none'; }); });
