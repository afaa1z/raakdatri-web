document.querySelector("#search-icon").onclick = () => {
    event.preventDefault();
    document.querySelector("#search-form").classList.toggle("active");
  };
  
  function closeSearchForm() {
    event.preventDefault();
    document.querySelector("#search-form").classList.remove("active");
  }

  document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('.filter');
    const products = document.querySelectorAll('.row');

    filters.forEach(filter => {
        filter.addEventListener('click', function() {
            const category = this.getAttribute('data-category');
            filterProducts(category);
        });
    });

    function filterProducts(category) {
        products.forEach(product => {
            const isNew = product.querySelector('.product-text h5')?.innerText === 'New';
            const isSale = product.querySelector('.product-text h5')?.innerText === 'Sale';
    
            if (category === 'all') {
                product.style.display = 'block';
            } else if (category === 'best-seller') {
                if (!product.querySelector('.product-text') && !product.querySelector('.product-text1')) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            } else if (category === 'new-arrivals') {
                if (isNew) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            } else if (category === 'on-sale') {
                if (isSale) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            }
        });
    }     
});

document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('.filter');

    filters.forEach(filter => {
        filter.addEventListener('click', function() {
            // Menghapus kelas 'active' dari semua filter
            filters.forEach(f => f.classList.remove('active'));

            // Menambah kelas 'active' ke filter yang diklik
            this.classList.add('active');

            // Memanggil fungsi filterProducts (disesuaikan dengan logika filter sebelumnya)
            const category = this.getAttribute('data-category');
            filterProducts(category);
        });
    });

    function filterProducts(category) {
        // Implementasikan logika filter disini (sesuai dengan kode logika filter sebelumnya)
    }
});
